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
     * 番号采集
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.review_numbers.index');
        }

        $model = CollectNumber::query();
        $table = 'collection_number';
        /*search*/
        $data = explode('~', $request->input('date'));
        if (isset($data[0]) && isset($data[1])) {
            $model = $model->whereBetween($table.'.updated_at', [trim($data[0]), trim($data[1])]);
        }
        if($request->input('status')){
            $model = $model->where($table.'.status', $request->input('status'));
        }
        if($request->input('name')){
            $model = $model->where($table.'.name', $request->input('name'));
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
    public function edit(Request $request,$id)
    {
        if($request->method() == 'GET') {
            $number = CollectNumber::findOrFail($id);
            return View::make('admin.review_numbers.edit', compact('number'));
        }

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

