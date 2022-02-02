<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectLabel;
use App\Models\MovieActor;
use App\Models\MovieLabel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReviewLabelController extends Controller
{
    /**
     * 标签采集
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET'){
            return View::make('admin.review_label.index');
        }

        $model = CollectLabel::query();
        $table = 'collection_label';
        /*search*/
        $data = explode('~', $request->input('date'));
        if (isset($data[0]) && isset($data[1])) {
            $model = $model->whereBetween($table.'.updated_at', [trim($data[0]), trim($data[1])]);
        }
        if($request->input('status')){
            $model = $model->where($table.'.status', $request->input('status'));
        }
        if($request->input('name')){
            $model = $model->where($table.'.name_child', $request->input('name'));
        }
        if($request->input('nickname')){
            $model = $model->where('users.nickname', $request->input('nickname'));
        }
        $res = $model->whereIn($table.'.status',[1,2])
            ->leftJoin('users', 'users.id', '=', $table.'.admin_id')
            ->orderBy($table.'.updated_at', 'desc')
            ->select($table.'.*','users.nickname')
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
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        if($request->method() == 'GET') {
            $categories = DB::table('movie_label_category')->pluck('name', 'id')->all();
            $label = CollectLabel::findOrFail($id);

            return View::make('admin.review_label.edit', compact('label', 'categories'));
        }

        $data = $request->all();
        try {
            if(MovieLabel::where('name',$data['name_child'])->exists()){
                throw new \Exception('标签名重复');
            }
            CollectLabel::where('id',$id)->update(['status'=>2,'admin_id'=>Auth::id()]);
            $parent = MovieLabel::where('name',$data['name'])->where('cid',0)->first();
            if(!$parent){
                $parent_id = MovieLabel::insertGetId(['name'=>$data['name'],'cid'=>0,'oid'=>$id]);
            }else {
                $parent_id = $parent->id;
            }

            MovieLabel::insert(['name'=>$data['name_child'],'cid'=>$parent_id,'oid'=>$id]);

            /*category*/
            $check = DB::table('movie_label_category_associate')->where(['lid'=>$id])->first();
            if($check && ($check->cid !== $data['category'])){
                DB::table('movie_label_category_associate')->where('id',$check->id)->update(['cid'=>$data['category']]);
            }else{
                DB::table('movie_label_category_associate')->insert(['lid'=>$id,'cid'=>$data['category']]);
            }
        } catch (\Exception $e) {
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        return Redirect::to(URL::route('admin.review.label'))->with(['success' => '更新成功']);
    }


}

