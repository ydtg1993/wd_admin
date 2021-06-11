<?php

namespace App\Http\Controllers\Admin;

use App\Models\MovieActor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MovieActorController extends Controller
{
    /**
     * 影片演员管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.movie_actor.index');
    }

    /**
     * 资讯数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $category = DB::table('movie_actor_category')->pluck( 'name','id');
        $res = MovieActor::orderBy('id', 'desc')
            ->leftJoin('movie_actor_category_associate','movie_actor.id','=','movie_actor_category_associate.aid')
            ->select('movie_actor.*','movie_actor_category_associate.aid','movie_actor_category_associate.cid')
            ->paginate($request->get('limit', 30));
        $records = $res->toArray();
        foreach ($records['data'] as &$record){
            $record['category'] = '';
            if(isset($category->all()[$record['cid']])){
                $record['category'] = $category->all()[$record['cid']];
            }
        }

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $records['data'],
        ];
        return Response::json($data);
    }

    /**
     * 添加
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $category = DB::table('movie_actor_category')->pluck( 'name','id');
        $categories = $category->all();
        return View::make('admin.movie_actor.create',compact('categories'));
    }

    /**
     * 添加
     *  @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try{
            if (!isset($_FILES['photo']) || empty($_FILES['photo'])) {
                throw new \Exception("图片不能为空");
            }
            $file = $_FILES['photo'];
            if($file['error'] != 0){
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
            $new_dir = '/local_actor_photo/'.date('Ym').'/';
            if (!is_dir($base_dir.$new_dir)) {
                mkdir($base_dir.$new_dir, 0777, true);
            }
            $newFile = substr(md5($file['name'].time()), 8, 16) . "." . $ext;
            $res = move_uploaded_file($file['tmp_name'], $base_dir . $new_dir . $newFile);
            if (!$res) {
                throw new \Exception("文件上传失败:无文件操作权限");
            }
            $id = MovieActor::insertGetId([
                'name'=>$data['name'],
                'status'=>$data['status'],
                'sex'=>$data['sex'],
                'photo'=>$new_dir . $newFile
            ]);
            $check = DB::table('movie_actor_category_associate')->where('aid',$id)->first();
            if($check){
                DB::table('movie_actor_category_associate')->where(['id'=>$check->id])->update(['cid'=>$data['category']]);
            }else{
                DB::table('movie_actor_category_associate')->insert(['aid'=>$id,'cid'=>$data['category']]);
            }
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('添加失败 '.$exception->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.actor'))->with(['success'=>'添加成功']);
    }

    /**
     * 更新资讯
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $category = DB::table('movie_actor_category')->pluck( 'name','id');
        $categories = $category->all();
        $actor = MovieActor::leftJoin('movie_actor_category_associate','movie_actor.id','=','movie_actor_category_associate.aid')
            ->select('movie_actor.*','movie_actor_category_associate.aid','movie_actor_category_associate.cid')
            ->findOrFail($id);
        return View::make('admin.movie_actor.edit', compact('actor','categories'));
    }

    /**
     * 更新资讯
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            MovieActor::where('id', $id)->update(['name' => $data['name'], 'status' => $data['status']]);
            $check = DB::table('movie_actor_category_associate')->where('aid',$id)->first();
            if($check){
                DB::table('movie_actor_category_associate')->where(['id'=>$check->id])->update(['cid'=>$data['category']]);
            }else{
                DB::table('movie_actor_category_associate')->insert(['aid'=>$id,'cid'=>$data['category']]);
            }
        }catch (\Exception $e){
            return Redirect::back()->withErrors('更新失败:'.$e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.actor'))->with(['success' => '更新成功']);
    }



}

