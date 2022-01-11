<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\MovieComment;
use App\Models\UserClient;
use App\Models\BatchComment as BatchCommentModel;
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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
            /*限定账户*/
            $file = public_path('/comment_workers');
            $ids = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $workers = [];
            $users = UserClient::whereIn('id', $ids)->get();
            foreach ($users as $user) {
                $account = $user->email ? $user->email : $user->phone;
                $workers[$account] = $user->id;
            }

            $now = time();
            $yesterday_time = $now - 86400;
            $today_time = strtotime(date('Y-m-d', $now));
            $insert_data = [];
            $node_tree = [];
            $sheet_list_children = [];
            foreach ($sheet_list as $item) {
                if (!isset($workers[$item['nickname']])) {
                    continue;
                }
                $uid = $workers[$item['nickname']];
                $movie = Movie::where('number', $item['number'])->first();
                if (!$movie) {
                    continue;
                }
                if (is_int($item['node'])) {
                    $date = date('Y-m-d H:i:s', rand($yesterday_time, $today_time));
                    $node_tree[$item['node']] = $uid;
                    $insert_data[] = [
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
                    continue;
                }
                $sheet_list_children[] = $item;
            }

            foreach ($sheet_list_children as $child) {
                $parent_node = (int)$child['node'];
                if (!isset($node_tree[$parent_node])) {
                    continue;
                }
                if (!isset($workers[$child['nickname']])) {
                    continue;
                }
                $uid = $workers[$child['nickname']];
                $movie = Movie::where('number', $child['number'])->first();
                if (!$movie) {
                    continue;
                }
                $date = date('Y-m-d H:i:s', rand($today_time, $now));
                $insert_data[] = [
                    'comment' => $child['comment'],
                    'mid' => $movie->id,
                    'uid' => $uid,
                    'score' => rand(7, 10),
                    'comment_time' => $date,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'reply_uid' => $node_tree[$parent_node],
                    'type' => 2
                ];
            }
            try {
                DB::beginTransaction();
                $comment_ids = [];
                foreach ($insert_data as $data) {
                    $comment_ids[] = MovieComment::insertGetId($data);
                }
                BatchCommentModel::where('id',$batch->id)->update(['status'=>1,'comment_ids'=>json_encode($comment_ids)]);
            }catch (\Exception $e){
                DB::rollBack();
                BatchCommentModel::where('id',$batch->id)->update(['msg'=>(string)$e->getMessage(),'status'=>2]);
                return;
            }
            DB::commit();
            return;
        }
    }
}
