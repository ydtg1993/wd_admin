<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectActor;
use App\Models\MovieActor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReviewActorController extends Controller
{
    /**
     * 采集演员管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET'){
            $categories = DB::table('movie_actor_category')->pluck('name', 'id')->all();
            return View::make('admin.review_actor.index',compact('categories'));
        }
        $model = CollectActor::query();
        /*search*/
        $data = explode('~',$request->input('date'));
        if(isset($data[0]) && isset($data[1])){
            $model = $model->whereBetween('collection_actor.created_at',[trim($data[0]),trim($data[1])]);
        }
        if($request->input('category')){
            $model = $model->where('collection_actor.category',$request->input('category'));
        }
        if($request->input('status')){
            $model = $model->where('collection_actor.status', $request->input('status'));
        }
        if($request->input('nickname')){
            $model = $model->where('users.nickname', $request->input('nickname'));
        }

        $res = $model->whereIn('collection_actor.status',[1,2])->orderBy('id', 'desc')
            ->join('users','users.id','=','collection_actor.admin_id')
            ->join('movie_actor_category','movie_actor_category.name','=','collection_actor.category')
            ->select('collection_actor.id','collection_actor.name', 'collection_actor.movie_sum',
                'collection_actor.status', 'collection_actor.photo','collection_actor.created_at',
                'users.nickname',
                'movie_actor_category.name as category')
            ->paginate($request->get('limit', 30));

        $records = $res->toArray();
        foreach ($records['data'] as &$record) {
            $names = DB::table('collection_actor_name')->where('aid',$record['id'])->pluck('name')->all();
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

    public function error(Request $request)
    {
        if($request->method() == 'GET'){
            $categories = DB::table('movie_actor_category')->pluck('name', 'id')->all();
            return View::make('admin.review_actor.error',compact('categories'));
        }

        $model = CollectActor::query();
        /*search*/
        $data = explode('~',$request->input('date'));
        if(isset($data[0]) && isset($data[1])){
            $model = $model->whereBetween('collection_actor.created_at',[trim($data[0]),trim($data[1])]);
        }
        if($request->input('status')){
            $model = $model->where('collection_actor.status', $request->input('status'));
        }
        if($request->input('name')){
            $model = $model->where('collection_actor.name', $request->input('name'));
        }

        $res = $model->where('collection_actor.status',5)->orderBy('id', 'desc')
            ->join('movie_actor_category','movie_actor_category.name','=','collection_actor.category')
            ->select('collection_actor.id','collection_actor.name','collection_actor.resources_odd_info',
                'collection_actor.movie_sum','collection_actor.status', 'collection_actor.photo','collection_actor.created_at',
                'movie_actor_category.name as category')
            ->paginate($request->get('limit', 30));
        $records = $res->toArray();
        foreach ($records['data'] as &$record) {
            $names = DB::table('collection_actor_name')->where('aid',$record['id'])->pluck('name')->all();
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
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request,$id)
    {
        if($request->method() == 'GET') {
            $categories = DB::table('movie_actor_category')->pluck('name', 'id')->all();
            $actor_names = DB::table('collection_actor_name')->where('aid', $id)->pluck('name')->all();
            $names = '';
            foreach ($actor_names as $actor_name) {
                $names .= trim($actor_name) . "\r\n";
            }
            $actor = CollectActor::findOrFail($id);

            return View::make('admin.review_actor.edit', compact('actor', 'names', 'categories'));
        }

        $data = $request->all();
        try {
            DB::beginTransaction();
            CollectActor::where('id', $id)->update(['status' => 2, 'admin_id' => Auth::id()]);
            $collect = CollectActor::where('id', $id)->first();
            /*social app*/
            $social_accounts = [];
            if (isset($data['account_name'])) {
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
            $actor_id = MovieActor::where('id', $id)->insertGetId([
                'name' => $data['name'],
                'sex' => $data['sex'],
                'social_accounts' => json_encode($social_accounts),
                'photo' => $collect->photo,
                'oid' => $id
            ]);
            $insertData = [];
            $names = explode("\r\n",$data['names']);
            foreach ($names as $name){
                $insertData[] = ['aid'=>$actor_id,'name'=>$name];
            }
            DB::table('movie_actor_name')->insert($insertData);
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        DB::commit();
        return Redirect::to(URL::route('admin.review.actor'))->with(['success' => '更新成功']);
    }

}

