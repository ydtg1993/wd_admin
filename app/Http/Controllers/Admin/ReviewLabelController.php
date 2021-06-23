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
     * 采集演员管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.review_label.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = CollectLabel::where('status',1)->orderBy('id', 'desc')
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
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $categories = DB::table('movie_label_category')->pluck('name', 'id')->all();
        $label = CollectLabel::findOrFail($id);

        return View::make('admin.review_label.edit', compact('label', 'categories'));
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

