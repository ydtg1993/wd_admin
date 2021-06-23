<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectNumber;
use App\Models\MovieActor;
use App\Models\MovieNumbers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReviewNumbersController extends Controller
{
    /**
     * 采集演员管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.review_numbers.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = CollectNumber::where('status',1)->orderBy('id', 'desc')
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
        $number = CollectNumber::findOrFail($id);

        return View::make('admin.review_numbers.edit', compact('number'));
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
            if(MovieNumbers::where('name',$data['name'])->exists()){
                throw new \Exception('番号名重复');
            }
            CollectNumber::where('id', $id)->update(['status' => 2,'admin_id'=>Auth::id()]);
            MovieNumbers::insert(['name'=>$data['name'],'oid'=>$id]);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        return Redirect::to(URL::route('admin.review.numbers'))->with(['success' => '更新成功']);
    }


}

