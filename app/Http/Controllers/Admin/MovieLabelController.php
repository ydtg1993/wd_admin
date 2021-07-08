<?php

namespace App\Http\Controllers\Admin;

use App\Models\MovieLabel;
use App\Models\MovieLabelAss;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MovieLabelController extends Controller
{
    /**
     * 标签管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_label.index');
        }
        $model = MovieLabel::query();
        /*search*/
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('name')){
            $model = $model->where('name', $request->input('name'));
        }
        $res = $model->orderBy('id', 'desc')->paginate($request->get('limit', 30));
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
     *  @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if($request->method() == 'GET') {
            $parent_labels = MovieLabel::where('cid',0)->get();
            return View::make('admin.movie_label.create',compact('parent_labels'));
        }
        $data = $request->all();
        try{
            MovieLabel::insert(['name'=>$data['name'],'status'=>$data['status'],'cid'=>$data['cid']]);
        }catch (\Exception $exception){
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
            $parent_labels = MovieLabel::where('cid',0)->get();
            return View::make('admin.movie_label.edit', compact('label','parent_labels'));
        }
        $data = $request->all();
        try {
            MovieLabel::where('id', $id)->update(['name' => $data['name'], 'status' => $data['status'],'cid'=>$data['cid']]);
        }catch (\Exception $e){
            return Redirect::back()->withErrors('更新失败:'.$e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.label'))->with(['success' => '更新成功']);
    }

    public function list(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_label.list');
        }
        if($request->method() == 'DELETE') {
            try {
                $id = $request->input('id');
                $ass = MovieLabelAss::where('id', $id)->first();
                MovieLabelAss::where('id', $id)->delete();

                $num = MovieLabelAss::where('cid',$ass->cid)->count();
                MovieLabelAss::where('id', $ass->cid)->update(['movie_sum'=>$num]);
            }catch (\Exception $e){
                return Response::json(['code' => 1, 'msg' => $e->getMessage()]);
            }
            return Response::json(['code' => 0, 'msg' => '成功']);
        }

        $table = 'movie_label_associate.';
        $ass_id = 'cid';

        $model = MovieLabelAss::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('movie.release_time',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('number')){
            $model = $model->where('movie.number', $request->input('number'));
        }

        $res = $model->orderBy($table.'id', 'desc')
            ->join('movie_label','movie_label.id','=',$table.$ass_id)
            ->join('movie','movie.id','=',$table.'mid')
            ->leftJoin('movie_category_associate','movie_category_associate.mid','=',$table.'mid')
            ->leftJoin('movie_category','movie_category.id','=','movie_category_associate.cid')
            ->select(
                $table.'id',$table.'created_at',$table.'updated_at',
                'movie_label.name as label','movie_label.id as label_id',
                'movie.number','movie.name','movie.small_cover','movie.release_time','movie.score','movie_category.name as category')
            ->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }
}

