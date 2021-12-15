<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use App\Models\MoviePiece;
use App\Models\MovieSeries;
use App\Models\MovieSeriesAss;
use App\Models\PieceListMovies;
use App\Models\UserClient;
use App\Models\UserLikeSeries;
use App\Models\UserPieceList;
use App\Models\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MovieListController extends Controller
{
    /**
     * 系列管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.movie_list.index');
        }

        $model = MoviePiece::query();
        $date = explode('~', $request->input('date'));
        if (isset($date[0]) && isset($date[1])) {
            $model = $model->whereBetween('user_want_see_movie.created_at', [trim($date[0]), trim($date[1])]);
        }
        if ($request->input('id')) {
            $model = $model->where('movie_piece_list.id', $request->input('id'));
        }
        if ($request->input('type')) {
            $model = $model->where('movie_piece_list.type', $request->input('type'));
        }
        if ($request->input('nickname')) {
            $model = $model->where('user_client.nickname', $request->input('nickname'));
        } 

        if ($request->input('audit')!=='' && $request->input('audit')!==null) {
            $model = $model->where('movie_piece_list.audit', $request->input('audit'));
        }

        $res = $model->orderBy('movie_piece_list.id', 'DESC')
            ->leftJoin('user_client', 'user_client.id', '=', 'movie_piece_list.uid')
            ->select('movie_piece_list.id', 'movie_piece_list.name', 'movie_piece_list.movie_sum', 'movie_piece_list.like_sum',
                'movie_piece_list.pv_browse_sum', 'movie_piece_list.intro', 'movie_piece_list.type', 'movie_piece_list.created_at', 'movie_piece_list.updated_at','movie_piece_list.cover','movie_piece_list.authority','movie_piece_list.audit','movie_piece_list.remarks',
                'user_client.nickname')
            ->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.movie_list.create');
        }
        $data = $request->all();
        try {
            if (!isset($_FILES['cover']) || empty($_FILES['cover'])) {
                throw new \Exception("图片不能为空");
            }
            $file = $_FILES['cover'];
            if ($file['error'] != 0) {
                throw new \Exception("图片错误:{$file['error']}");
            }
            $allowed_extensions = ["png", "jpg", "jpeg", "gif"];
            $maxSize = 5;
            $ext = basename($file['type']);
            if (!in_array($ext, $allowed_extensions)) {
                throw new \Exception('图片类型错误');
            }
            if ($file['size'] > $maxSize * 1024 * 1024) {
                $data['msg'] = "图片大小限制" . $maxSize . "M";
                throw new \Exception("图片大小限制" . $maxSize . "M");
            }
            $base_dir = public_path('resources');
            $new_dir = '/local_list_photo/' . date('Ym') . '/';
            if (!is_dir($base_dir . $new_dir)) {
                mkdir($base_dir . $new_dir, 0777, true);
            }
            $newFile = substr(md5($file['name'] . time()), 8, 16) . "." . $ext;
            $res = move_uploaded_file($file['tmp_name'], $base_dir . $new_dir . $newFile);
            if (!$res) {
                throw new \Exception("文件上传失败:无文件操作权限");
            }
            DB::beginTransaction();

            $numbers = explode("\r\n", $data['numbers']);
            $movie_ids = Movie::whereIn('number', $numbers)->pluck('id')->all();

            $user = UserClient::where('id', $data['uid'])->first();
            if ($user) {
                if($user->type == 2)
                {
                    throw new \Exception("必须是运营账号！");
                }
                $uid = $user->id;
                $type = 2;
            } else {
                throw new \Exception("无效的用户ID");
            }
            //默认片单检查
            $moviePieceCount = MoviePiece::where('uid',$uid)->where('type',3)->count();
            if($moviePieceCount <= 0)
            {
                MoviePiece::insertGetId([
                    'uid' => $uid,
                    'type' => 3,
                    'name' => '系统默认片单',
                    'cover' => '',
                    'intro' => '系统默认片单',
                    'movie_sum' =>0
                ]);
            }

            $id = MoviePiece::insertGetId([
                'uid' => $uid,
                'type' => $type,
                'name' => $data['name'],
                'cover' => $new_dir . $newFile,
                'intro' => $data['intro'],
                'movie_sum' => count($movie_ids)
            ]);


            UserPieceList::insertGetId([
                'uid' => $uid,
                'type' => 2,
                'plid' => $id,
            ]);

            $insertData = [];
            foreach ($movie_ids as $movie_id) {
                $insertData[] = ['plid' => $id, 'mid' => $movie_id];
            }
            PieceListMovies::insert($insertData);
        } catch (\Exception $exception) {
            DB::rollBack();
            return Redirect::back()->withErrors('添加失败');
        }
        DB::commit();
        return Redirect::to(URL::route('admin.movie.list'))->with(['success' => '添加成功']);
    }

    /**
     * 更新资讯
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $list = MoviePiece::where('id', $id)->with('pieceMovies')->first();

            $mids = [];
            foreach ($list->pieceMovies as $movie) {
                $mids[] = $movie->mid;
            }
            $numbers = Movie::whereIn('id', $mids)->pluck('number')->all();

            return View::make('admin.movie_list.edit', compact('list', 'numbers'));
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            $user = UserClient::where('id', $data['uid'])->first();
            if ($user) {
                $uid = $user->id;
                $type = 1;
            } else {
                $uid = 0;
                $type = 2;
            }

            $has_movie_ids = PieceListMovies::where('plid',$id)->pluck('mid')->all();
            $numbers = explode("\r\n",$data['numbers']);
            $movie_ids = Movie::whereIn('number',$numbers)->pluck('id')->all();
            foreach ($movie_ids as $movie_id){
                $index = array_search($movie_id,$has_movie_ids);
                if($index !== false){
                    array_splice($has_movie_ids,$index,1);
                    continue;
                }
                //insert
                PieceListMovies::firstOrCreate(['plid'=>$id,'mid'=>$movie_id]);
            }
            !empty($has_movie_ids) && PieceListMovies::where('plid',$id)->whereIn('mid',$has_movie_ids)->delete();

            MoviePiece::where('id', $id)->update([
                'uid' => $uid,
                'type' => $type,
                'name' => $data['name'],
                'intro' => $data['intro'],
                'movie_sum' => count($movie_ids)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        DB::commit();
        return Redirect::to(URL::route('admin.movie.list'))->with(['success' => '更新成功']);
    }

    public function list(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.movie_list.list');
        }
        if ($request->method() == 'DELETE') {
            try {
                $id = $request->input('id');
                $ass = MoviePiece::where('id', $id)->first();
                MoviePiece::where('id', $id)->delete();

                $num = MoviePiece::where('series_id', $ass->series_id)->count();
                MoviePiece::where('id', $ass->series_id)->update(['movie_sum' => $num]);
            } catch (\Exception $e) {
                return Response::json(['code' => 1, 'msg' => $e->getMessage()]);
            }
            return Response::json(['code' => 0, 'msg' => '成功']);
        }

        $table = 'piece_list_movie.';
        $ass_id = 'plid';

        $model = PieceListMovies::query();
        $date = explode('~', $request->input('date'));
        if (isset($date[0]) && isset($date[1])) {
            $model = $model->whereBetween('movie.release_time', [trim($date[0]), trim($date[1])]);
        }
        if ($request->input('number')) {
            $model = $model->where('movie.number', $request->input('number'));
        }

        $res = $model->orderBy($table . 'id', 'desc')
            ->join('movie_series', 'movie_series.id', '=', $table . $ass_id)
            ->join('movie', 'movie.id', '=', $table . 'mid')
            ->leftJoin('movie_category_associate', 'movie_category_associate.mid', '=', $table . 'mid')
            ->leftJoin('movie_category', 'movie_category.id', '=', 'movie_category_associate.cid')
            ->select(
                $table . 'id', $table . 'created_at', $table . 'updated_at',
                'movie_series.name as series', 'movie_series.id as series_id',
                'movie.number', 'movie.name', 'movie.small_cover', 'movie.release_time', 'movie.score', 'movie_category.name as category')
            ->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    public function like(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.movie_list.like');
        }
        $table = 'user_piece_list.';
        $ass_id = 'plid';
        $info_table = 'movie_piece_list';

        $model = UserPieceList::query();
        $date = explode('~', $request->input('date'));
        if (isset($date[0]) && isset($date[1])) {
            $model = $model->whereBetween($table . '.created_at', [trim($date[0]), trim($date[1])]);
        }
        if ($request->input('name')) {
            $model = $model->where($info_table . '.name', $request->input('name'));
        }
        if ($request->input('nickname')) {
            $model = $model->where('user_client.nickname', $request->input('nickname'));
        }

        $res = $model->orderBy($table . 'id', 'DESC')
            ->join('user_client', 'user_client.id', '=', $table . 'uid')
            ->join($info_table, $info_table . '.id', '=', $table . $ass_id)
            ->select($table . 'id', $table . 'created_at',
                $info_table . '.id as piece_id', $info_table . '.name as piece',
                'user_client.nickname')
            ->paginate($request->get('limit', 30));
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    /**
     * 审核 
     */
    public function audit(Request $request)
    {
        $id = $request->input('id');
        $audit = $request->input('audit');
        $remarks = $request->input('remarks');

        //片单详情
        $info = MoviePiece::where('id', $id)->first();
        $authority = $info->authority;

        //判断小于10部，仅自己可见
        if($info->movie_sum<10)
        {
            $authority = 2;
        }

        //更新状态
        MoviePiece::where('id', $id)->update([
                'audit' => $audit,
                'authority' => $authority,
                'remarks' => $remarks
            ]);

        

        //发送一个消息通知
        if($audit>0)
        {
            $auditNote = ($audit==1)?'审核通过':'审核不通过';
            $msg = new Notify();
            $content = $info->name.' '.$auditNote.' '.$info->remarks;
            $msg->sysNotify(9,-9,'admin',$info->uid,$content);
        }        

        $data = [
            'code' => 0,
            'msg' => '审核完成',
        ];

        return Response::json($data);
    }
}

