<?php

namespace App\Http\Controllers\Admin;

use App\Models\SearchLog;
use App\Models\SearchHotWord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function hotword()
    {
        //读取热搜词
        $mdb = new SearchHotWord();
        $keywords = $mdb->lists();

        return View::make('admin.search.hotword',compact('keywords'));
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
        $res = SearchLog::select(DB::raw('min(`id`) as id')
            ,'content as keyword'
            ,DB::raw('count(0) as nums')
            ,DB::raw('max(created_at) as updated_at'))
            ->groupBy('content')
            ->orderBy('nums','desc')->paginate($request->get('limit',20));
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res->total(),
            'data'  => $res->items(),
        ];

        return Response::json($data);
    }

    /**
     * 设置热搜词
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request ): \Illuminate\Http\JsonResponse
    {

        $req = $request->all(['keywords']);

        //判断热搜词长度，不能多余20条
        $keywords = $req['keywords'];
        $keyArr = explode(PHP_EOL, $keywords);

        if(count($keyArr)>20)
        {
            $data = [
                'code'  => 100,
                'msg'   => '设置的热词不能超过20条',
            ];
            return \response()->json($data);
        }

        //写入数据
        $mdb = new SearchHotWord();
        $mdb->add($keyArr);

        $data = [
                'code'  => 0,
                'msg'   => '保存成功',
            ];
        return \response()->json($data);
    }

}
