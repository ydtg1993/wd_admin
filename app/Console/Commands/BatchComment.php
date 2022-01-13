<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\MovieComment;
use App\Models\UserClient;
use App\Models\BatchComment as BatchCommentModel;
use App\Services\Logic\RedisCache;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BatchComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batchComment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '评论上传评论入库';

    protected $now;
    protected $yesterday_time;
    protected $today_time;

    protected $workers = [];

    protected $node_tree = [];
    protected $parent_comment_id_hash = [];
    protected $sheet_list_children = [];
    protected $comment_ids = [];
    protected $movie_id_hash = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->now = time();
        $this->yesterday_time = $this->now - 86400;
        $this->today_time = strtotime(date('Y-m-d', $this->now));
        $this->node_tree = [];
        $this->parent_comment_id_hash = [];
        $this->sheet_list_children = [];
        /*限定账户*/
        $file = public_path('/comment_workers');
        $ids = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $users = UserClient::whereIn('id', $ids)->get();
        foreach ($users as $user) {
            $account = $user->email ? $user->email : $user->phone;
            $this->workers[$account] = $user->id;
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $batches = BatchCommentModel::where('status',0)->get();
        foreach ($batches as $batch) {
            $sheet_list = (array)json_decode($batch->data,true);

            DB::beginTransaction();
            $flag = $this->walk_sheet_parent($batch->id,$sheet_list);
            if(!$flag){
                continue;
            }

            $flag = $this->walk_sheet_children($batch->id,$this->sheet_list_children);
            if(!$flag){
                continue;
            }
            try {
                $this->statistics();
                BatchCommentModel::where('id', $batch->id)->update(['status' => 1, 'comment_ids' => json_encode($this->comment_ids)]);
            }catch (\Exception $e){
                DB::rollBack();
                BatchCommentModel::where('id',$batch->id)->update(['msg'=>(string)$e->getMessage(),'status'=>2]);
                continue;
            }
            DB::commit();
        }
    }

    protected function statistics()
    {
       foreach ($this->movie_id_hash as $mid=>$score){
           //更新评论统计数据
           $commentNum = MovieComment::where('mid',$mid)->where('status',1)->count();
           $last_comment = MovieComment::where('mid',$mid)->where('status',1)->orderBy('comment_time','DESC')->first();
           Movie::where('id',$mid)->update([
               'comment_num' =>$commentNum,
               'is_short_comment'=>($commentNum<=0?1:2),
               'new_comment_time'=>$last_comment->comment_time
           ]);
           //加权分，影片被评论一次，加1分
           Movie::where('id',$mid)->increment('weight', $score);
       }
       RedisCache::clearCacheManageAllKey('movie');
    }

    protected function walk_sheet_parent($batch_id,$sheet_list)
    {
        $insert_data = [];
        foreach ($sheet_list as $item) {
            if (!isset($this->workers[$item['account']])) {
                continue;
            }
            $uid = $this->workers[$item['account']];
            $movie = Movie::where('number', $item['number'])->first();
            if (!$movie) {
                continue;
            }
            if (($item['node'] - (int)$item['node']) == 0) {//正整数
                $date = date('Y-m-d H:i:s', rand($this->yesterday_time, $this->today_time));
                $this->node_tree[$item['node']] = $uid;
                $insert_data[] = [
                    'node' => $item['node'],
                    'comment' => $item['comment'],
                    'mid' => $movie->id,
                    'uid' => $uid,
                    'score' => rand(7, 10),
                    'comment_time' => $date,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'reply_uid' => 0,
                    'type' => 1
                ];
                if(!isset($this->movie_id_hash[$movie->id])){
                    $this->movie_id_hash[$movie->id] = 1;
                }else{
                    $this->movie_id_hash[$movie->id] += 1;
                }
                continue;
            }
            $this->sheet_list_children[] = $item;
        }
        try {
            foreach ($insert_data as $data) {
                $node = (string)$data['node'];
                unset($data['node']);
                $comment_id = MovieComment::insertGetId($data);
                $this->parent_comment_id_hash[$node] = $comment_id;
                $this->comment_ids[] = $comment_id;
            }
        }catch (\Exception $e){
            DB::rollBack();
            BatchCommentModel::where('id',$batch_id)->update(['msg'=>(string)$e->getMessage(),'status'=>2]);
            return false;
        }
        return true;
    }

    protected function walk_sheet_children($batch_id,$sheet_list_children)
    {
        $insert_data = [];
        foreach ($sheet_list_children as $child) {
            $parent_node = (int)$child['node'];
            if (!isset($this->node_tree[$parent_node])) {
                continue;
            }
            if(!isset($this->parent_comment_id_hash[$parent_node])){
                continue;
            }
            if (!isset($this->workers[$child['account']])) {
                continue;
            }
            $uid = $this->workers[$child['account']];
            $movie = Movie::where('number', $child['number'])->first();
            if (!$movie) {
                continue;
            }
            $date = date('Y-m-d H:i:s', rand($this->today_time, $this->now));
            $insert_data[] = [
                'comment' => $child['comment'],
                'mid' => $movie->id,
                'uid' => $uid,
                'score' => rand(7, 10),
                'comment_time' => $date,
                'created_at' => $date,
                'updated_at' => $date,
                'reply_uid' => $this->node_tree[$parent_node],
                'type' => 2,
                'cid'=> $this->parent_comment_id_hash[$parent_node]
            ];
        }
        try {
            foreach ($insert_data as $data) {
                $comment_id = MovieComment::insertGetId($data);
                $this->comment_ids[] = $comment_id;
            }
        }catch (\Exception $e){
            DB::rollBack();
            BatchCommentModel::where('id',$batch_id)->update(['msg'=>(string)$e->getMessage(),'status'=>2]);
            return false;
        }
        return true;
    }
}
