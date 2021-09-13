<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ComplaintRequest;
use App\Http\Requests\TagRequest;
use App\Models\Complaint;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * 标签列表
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.report.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(ComplaintRequest $request)
    {
        $data = $request->all(['created_at_start','created_at_end','avid','u_number']);

        $res = Report::when($data['avid'],function ($query,$data) {
            return $query->where('avid','like','%'.$data.'%');
        })->when($data['u_number'],function ($query,$data) {
            return $query->where(
                function ($query) use($data){
                    return $query->where('u_number','like','%'.$data.'%')->orWhere('uid','like','%'.$data.'%');
                });

        })->when($data['created_at_start'],function ($query,$data){
            return $query->where('created_at','>=',$data);
        })->when($data['created_at_end'],function ($query,$data){
            return $query->where('created_at','<=',$data);
        })->orderBy('id','desc')->paginate($request->get('limit',30));
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res->total(),
            'data'  => $res->items(),
        ];
        return Response::json($data);
    }

}
