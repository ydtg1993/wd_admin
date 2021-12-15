<?php

namespace App\Http\Controllers\Admin;

use App\Models\Domain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    /**
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.domain.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $data = $request->all();

        //读取搜索日志列表
        $res = Domain::select('id','domain','created_at')
            ->orderBy('id','desc')->paginate($request->get('limit',20));
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res->total(),
            'data'  => $res->items(),
        ];

        return Response::json($data);
    }

    /**
     * 设置域名
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request ): \Illuminate\Http\JsonResponse
    {

        $req = $request->all(['content']);

        $content = $req['content'];
        $keyArr = explode(PHP_EOL, $content);

        //写入数据
        $mdb = new Domain();
        $mdb->add($keyArr);

        $data = [
                'code'  => 0,
                'msg'   => '保存成功',
            ];
        return \response()->json($data);
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(Request $request ): \Illuminate\Http\JsonResponse
    {

        $id = $request->input('id');


        //写入数据
        $mdb = new Domain();
        $mdb->del($id);

        $data = [
                'code'  => 0,
                'msg'   => '删除成功',
            ];
        return \response()->json($data);
    }

}
