<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectActor;
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
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $categories = DB::table('movie_actor_category')->pluck( 'name','id')->all();
        $res = MovieActor::orderBy('id', 'desc')
            ->leftJoin('movie_actor_category_associate','movie_actor.id','=','movie_actor_category_associate.aid')
            ->select('movie_actor.*','movie_actor_category_associate.aid','movie_actor_category_associate.cid')
            ->paginate($request->get('limit', 30));
        $records = $res->toArray();
        foreach ($records['data'] as &$record){
            $record['category'] = '';
            if(isset($categories[$record['cid']])){
                $record['category'] = $categories[$record['cid']];
            }

            $names = DB::table('movie_actor_name')->where('aid',$record['id'])->pluck('name')->all();
            $record['names'] = join(',',$names);
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
        $categories = DB::table('movie_actor_category')->pluck( 'name','id')->all();
        return View::make('admin.movie_actor.create',compact('categories'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            if(MovieActor::where('name',$data['name'])->exists()){
                throw new \Exception("演员名字重复");
            }
            if (!isset($_FILES['photo']) || empty($_FILES['photo'])) {
                throw new \Exception("图片不能为空");
            }
            $file = $_FILES['photo'];
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
            $new_dir = '/local_actor_photo/' . date('Ym') . '/';
            if (!is_dir($base_dir . $new_dir)) {
                mkdir($base_dir . $new_dir, 0777, true);
            }
            $newFile = substr(md5($file['name'] . time()), 8, 16) . "." . $ext;
            $res = move_uploaded_file($file['tmp_name'], $base_dir . $new_dir . $newFile);
            if (!$res) {
                throw new \Exception("文件上传失败:无文件操作权限");
            }

            /*social app*/
            $social_accounts = [];
            if(isset($data['account_name'])) {
                $account_name = $data['account_name'];
                $account_url = $data['account_url'];
                foreach ($account_name as $k => $name) {
                    if (!$name) {
                        continue;
                    }
                    $url = $account_url[$k];
                    if (!$url) {
                        continue;
                    }
                    $social_accounts[$name] = $url;
                }
            }
            $id = MovieActor::insertGetId([
                'name' => $data['name'],
                'status' => $data['status'],
                'sex' => $data['sex'],
                'photo' => $new_dir . $newFile,
                'social_accounts'=>json_encode($social_accounts)
            ]);
            /*names*/
            $insertData = [];
            $names = explode("\r\n",$data['names']);
            foreach ($names as $name){
                $insertData[] = ['aid'=>$id,'name'=>$name];
            }
            DB::table('movie_actor_name')->insert($insertData);
            /*category*/
            DB::table('movie_actor_category_associate')->insert(['aid'=>$id,'cid'=>$data['category']]);

        } catch (\Exception $exception) {
            return Redirect::back()->withErrors('添加失败 ' . $exception->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.actor'))->with(['success' => '添加成功']);
    }

    /**
     * 更新
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $categories = DB::table('movie_actor_category')->pluck( 'name','id')->all();
        $actor = MovieActor::leftJoin('movie_actor_category_associate','movie_actor.id','=','movie_actor_category_associate.aid')
            ->select('movie_actor.*','movie_actor_category_associate.aid','movie_actor_category_associate.cid')
            ->findOrFail($id);

        $actor_names = DB::table('movie_actor_name')->where('aid',$id)->pluck('name')->all();
        $names = '';
        foreach ($actor_names as $actor_name){
            $names.= trim($actor_name)."\r\n";
        }

        return View::make('admin.movie_actor.edit', compact('actor','categories','names'));
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            /*social app*/
            $social_accounts = [];
            if(isset($data['account_name'])) {
                $account_name = $data['account_name'];
                $account_url = $data['account_url'];
                foreach ($account_name as $k => $name) {
                    if (!$name) {
                        continue;
                    }
                    $url = $account_url[$k];
                    if (!$url) {
                        continue;
                    }
                    $social_accounts[$name] = $url;
                }
            }
            MovieActor::where('id', $id)->update(['name' => $data['name'], 'status' => $data['status'],'sex'=>$data['sex'],'social_accounts'=>json_encode($social_accounts)]);
            /*names*/
            $this->associateNames($id,explode("\r\n",$data['names']));
            /*category*/
            $check = DB::table('movie_actor_category_associate')->where('aid',$id)->first();
            if($check && ($check->cid !== $data['category'])){
                DB::table('movie_actor_category_associate')->where(['id'=>$check->id])->update(['cid'=>$data['category']]);
            }else{
                DB::table('movie_actor_category_associate')->insert(['aid'=>$id,'cid'=>$data['category']]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        DB::commit();
        return Redirect::to(URL::route('admin.movie.actor'))->with(['success' => '更新成功']);
    }

    private function associateNames($actor_id,$data)
    {
        $associate_ids = DB::table('movie_actor_name')->where('aid', $actor_id)->pluck('name','id')->all();
        foreach ($associate_ids as $id=>$associate){
            $index = array_search($associate,$data);
            if($index !== false){
                array_splice($data,$index,1);
                continue;
            }
            DB::table('movie_actor_name')->where('id', $id)->delete();
        }
        if(!empty($data)){
            $insertData = [];
            foreach ($data as $item){
                $insertData[] = ['aid'=>$actor_id,'name'=>$item];
            }
            DB::table('movie_actor_name')->insert($insertData);
        }
    }


}

