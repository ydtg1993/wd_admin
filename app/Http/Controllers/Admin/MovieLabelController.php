<?php

namespace App\Http\Controllers\Admin;

use App\Models\MovieCategory;
use App\Models\MovieLabel;
use App\Models\MovieLabelAss;
use App\Models\MovieLabelCategory;
use App\Models\MovieLabelCategoryAss;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class MovieLabelController extends Controller
{
    /**
     * 标签管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //读取分类
        $category = MovieCategory::select('id','name')->where(['status'=>1,'show'=>1])->get();

        if($request->method() == 'GET') {
            return View::make('admin.movie_label.index',compact('category'));
        }

        $MD = new MovieLabel();
        //分页
        $page = intval($request->input('page'));
        $limit = intval($request->input('limit'));
        $limit = $limit?$limit:20;
        $offset = ($page-1)*$limit;

        /*search*/
        $name = $request->input('name');
        $cid = intval($request->input('cid'));

        $data = $MD->listForCid($name,$cid,$offset,$limit);
        $count = $MD->countForCid($name,$cid);

        //不走联表模式
        if($cid<1 && $name){
            $data = $MD->listForName($name,$offset,10);
            $count = $MD->countForName($name);
        }

        //处理数据
        $cArr = array();
        foreach($category as $v)
        {
            $cArr[$v->id]=$v->name;
        }
        if($data){
            foreach($data as $k=>$v)
            {
                //处理所属分类
                $cl = explode(',',$v->cids);
                for($i=0;$i<count($cl);$i++)
                {
                    $cl[$i] = isset($cArr[$cl[$i]])?$cArr[$cl[$i]]:'';
                }
                $v->cids = join(',',$cl);
                $data[$k] = $v;
            }
        }

        $out = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $count,
            'data' => $data,
        ];
        return Response::json($out);
    }


    /**
     * 添加
     *  @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if($request->method() == 'GET') {
            //分类
            $categorys = MovieLabelCategory::where('status',1)->pluck('name', 'id')->all();
            //子标签
            $childrens = MovieLabel::where('cid','>',0)->pluck('name', 'id')->all();

            return View::make('admin.movie_label.create',compact('categorys','childrens'));
        }
        $data = $request->all();

        //处理数据
        $category = $data['category']?explode(',', $data['category']):[];
        $children = $data['children']?explode(',', $data['children']):[];

         DB::beginTransaction();
        try{
            $lid = MovieLabel::create($data['name'],$data['sort'],0);

            //更新分类
            MovieLabelCategoryAss::associate($category,$lid);

            //更新父级
            MovieLabel::childrenEditParent($children,$lid);

            //更新子标签数量
            MovieLabel::countChildren($lid);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return Redirect::back()->withErrors('添加失败');
        }
        return Redirect::to(URL::route('admin.movie.label'))->with(['success'=>'添加成功']);
    }


    /**
     * 更新资讯
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        if($request->method() == 'GET') {
            $label = MovieLabel::findOrFail($id);

            //分类
            $categorys = MovieLabelCategory::where('status',1)->pluck('name', 'id')->all();
            //子标签
            $childrens = MovieLabel::where('cid','>',0)->pluck('name', 'id')->all();

            //读取已经选择的数据
            $selectCategory = [];
            $MA = MovieLabelCategoryAss::select('cid')->where('status',1)->where('lid',$id)->get();
            foreach($MA as $v)
            {
                $selectCategory[]=$v->cid;
            }

            $selectChilden = [];
            $MC = MovieLabel::select('id')->where('status',1)->where('cid',$id)->get();
            foreach($MC as $v)
            {
                $selectChilden[]=$v->id;
            }

            return View::make('admin.movie_label.edit', compact('label','categorys','childrens','selectCategory','selectChilden'));
        }
        $data = $request->all();

        //处理数据
        $category = $data['category']?explode(',', $data['category']):[];
        $children = $data['children']?explode(',', $data['children']):[];

        DB::beginTransaction();
        try {

            //更新标签信息
            MovieLabel::edit($data,$id);

            //更新分类
            MovieLabelCategoryAss::associate($category,$id);

            //更新父级
            MovieLabel::childrenEditParent($children,$id);

            //更新子标签数量
            MovieLabel::countChildren($id);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return Redirect::back()->withErrors('更新失败:'.$e->getMessage());
        }

        return Redirect::to(URL::route('admin.movie.label'))->with(['success' => '更新成功']);
    }

     /**
     * 标签管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index_min(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_label.min');
        }
        $model = MovieLabel::query();
        $model = $model->where('cid','>',0)->where('status',1);
        /*search*/
        if($request->input('name')){
            $model = $model->where('name','like', $request->input('name').'%');
        }
        if($request->input('parent')){
            //读取上一级，根据名称来读取id
            $parent = MovieLabel::select('id')->where('cid',0)->where('name','like', $request->input('parent').'%')->first();

            $md = MovieLabel::select('id')->where('name','like', $request->input('parent').'%');

            $cid = 0;
            if(isset($parent->id) && $parent->id>0)
            {
                $cid = $parent->id;
            }
            $model = $model->where('cid',$cid);
        }
        $res = $model->orderBy('sort','asc')->orderBy('id', 'desc')->paginate($request->get('limit', 30));

        $data = $res->items();

        //遍历数据，读取父级
        $parentArr=array();
        if($data)
        {
            $cids = [];
            foreach($data as $k=>$v)
            {
                $cids[] = $v->cid;
            }

            //读取父级
            if(count($cids)>0)
            {
                $parents = MovieLabel::select('id','name')->whereIn('id',$cids)->get();
                foreach($parents as $val)
                {
                    $parentArr[$val->id] = $val->name;
                }
            }

        }

        //遍历，更新数据
        foreach($data as $k=>$v)
        {
            $v->cname = $parentArr[$v->cid];
            $data[$k] = $v;
        }

        $out = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $data,
        ];
        return Response::json($out);
    }

    /**
     * 添加
     *  @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create_min(Request $request)
    {
        if($request->method() == 'GET') {
            $parent_labels = MovieLabel::where('cid',0)->get();
            return View::make('admin.movie_label.min_create',compact('parent_labels'));
        }
        $data = $request->all();
        try{
            MovieLabel::create($data['name'],$data['sort'],$data['cid']);
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('添加失败');
        }
        return Redirect::to(URL::route('admin.movie.label.min'))->with(['success'=>'添加成功']);
    }


    /**
     * 更新资讯
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit_min(Request $request, $id)
    {
        if($request->method() == 'GET') {
            $label = MovieLabel::findOrFail($id);
            $parent_labels = MovieLabel::where('cid',0)->get();
            return View::make('admin.movie_label.min_edit', compact('label','parent_labels'));
        }
        $data = $request->all();
        try {
            MovieLabel::where('id', $id)->update(['name' => $data['name'], 'sort' => $data['sort'],'cid'=>$data['cid']]);
        }catch (\Exception $e){
            return Redirect::back()->withErrors('更新失败:'.$e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.label.min'))->with(['success' => '更新成功']);
    }

    /**
     * 删除
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        if($id<1){
            return Response::json(['code' => 1, 'msg' => '缺少id']);
        }

        //判断分类下面有内容，不可用删除
        $ass = MovieLabel::where('id', $id)->where('status',1)->first();
        if($ass && $ass->item_num>0){
            return Response::json(['code' => 1, 'msg' => '该标签下存在数据不能直接删除，请先移除标签下的内容']);
        }

        MovieLabel::where('id', $id)->update(['status'=>2]);

        //更新上一层数量(子标签)
        if(isset($ass) && $ass->cid>0){
            $lid = $ass->cid;

            //更新上一层数量
            MovieLabel::countChildren($lid);
        }else{
            //删除分类关联
            MovieLabelCategoryAss::where('lid',$id)->delete();
        }

        return Response::json(['code'=>0,'msg'=>'删除成功']);
    }
}

