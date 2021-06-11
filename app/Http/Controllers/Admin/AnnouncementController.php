<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AnnouncementRequest;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ComplaintRequest;
use App\Http\Requests\TagRequest;
use App\Models\Announcement;
use App\Models\Article;
use App\Models\Category;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;


class AnnouncementController extends Controller
{
    /**
     * 标签列表
     * @return \Illuminate\Contracts\View\View
     */
    public function topIndex()
    {

        return View::make('admin.announcement.top.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $data = $request->all(['created_at_start','created_at_end','uuid','type']);
        $res = Announcement::when($data['uuid'],function ($query,$data) {
            return $query->where('uuid','like','%'.$data.'%');
        })->when($data['created_at_start'],function ($query,$data){
            return $query->where('created_at','>=',$data);
        })->when($data['created_at_end'],function ($query,$data){
            return $query->where('created_at','<=',$data);
        })->when($data['type'],function ($query,$data){
            return $query->where('type','=',$data);
        })->orderBy('id','desc')->paginate($request->get('limit',30));
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res->total(),
            'data'  => $res->items(),
        ];
        return Response::json($data);
    }



    /**
     * top
     * @return \Illuminate\Contracts\View\View
     */
    public function createTopView()
    {
        return View::make('admin.announcement.top.create');
    }

    /**
     * top
     * @param AnnouncementRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTop(AnnouncementRequest $request)
    {
        $data = $request->all();
        try{
              Announcement::createTop( $data );

//            $article->tags()->sync($request->get('tags',[]));
            return Redirect::to(URL::route('admin.top.index'))->with(['success'=>'添加成功']);
        }catch (\Exception $exception){
          print_r($exception);
          exit;
            return Redirect::back()->withErrors('添加失败');
        }
    }

    /**
     * edit top
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editTopView($id): \Illuminate\Contracts\View\View
    {
        $announcement = Announcement::getOneById( $id );
        return View::make('admin.announcement.top.edit',compact('announcement'));
    }

    /**
     * @param AnnouncementRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTop(AnnouncementRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        return $this->updateCommon( $request, $id);
    }

    public function destroyTop( Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->destroyCommon($request);
    }


    /**
     * 标签列表
     * @return \Illuminate\Contracts\View\View
     */
    public function contentIndex()
    {

        return View::make('admin.announcement.content.index');
    }
    /**
     * top
     * @return \Illuminate\Contracts\View\View
     */
    public function createContentView(): \Illuminate\Contracts\View\View
    {
        return View::make('admin.announcement.content.create');
    }

    /**
     * top
     * @param AnnouncementRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeContent(AnnouncementRequest $request)
    {
        $data = $request->all();
        try{
            Announcement::createTop( $data );
//            $article->tags()->sync($request->get('tags',[]));
            return Redirect::to(URL::route('admin.content.index'))->with(['success'=>'添加成功']);
        }catch (\Exception $exception){
            print_r($exception);
            exit;
            return Redirect::back()->withErrors('添加失败');
        }
    }

    /**
     * edit top
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editContentView($id): \Illuminate\Contracts\View\View
    {
        $announcement = Announcement::getOneById( $id );
        return View::make('admin.announcement.content.edit',compact('announcement'));
    }

    /**
     * @param AnnouncementRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateContent(AnnouncementRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        return $this->updateCommon( $request, $id);
    }

    public function destroyContent( Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->destroyCommon($request);
    }









    public function destroyCommon( $request )
    {
        try{
            Announcement::deleteById($request->id);
            return Response::json(['code'=>0,'msg'=>'删除成功']);
        }catch (\Exception $exception){
            return Response::json(['code'=>1,'msg'=>'删除失败','data'=>$exception->getMessage()]);
        }
    }

    /**
     * edit top
     * @param AnnouncementRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updateCommon(AnnouncementRequest $request, $id)
    {
        $data = $request->all();
        try{
            $mapView = [
                'top'=>'admin.top.index',
            ];

            Announcement::saveAnnouncement($id,$data);
            return Redirect::to(URL::route($mapView[$data['type']]))->with(['success'=>'更新成功']);
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('更新失败');
        }
    }

}
