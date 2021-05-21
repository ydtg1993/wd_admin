<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/14
 * Time: 17:45
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DataController extends Controller
{

    public function getData(Request $request)
    {
        $data  = $request->input();
        $pageSize = $data['pageSize']??100;
        $page = $data['page']??1;
        $page = ($page-1)*$pageSize;
        $tableName = $data['tableName']??'javdb';
        $beginTime = $data['beginTime']??(date('Y-m-d 00:00:00',time()));
        /*秘钥校验后面补*/

        $data = DB::connection('mongodb')->collection($tableName)->where('ctime','>=',$beginTime)->skip((int)$page)->take((int)$pageSize)->orderBy('ctime', 'asc')->get();
        return response()->json(['code'=>200,'data'=>$data,'msg'=>'ok'],200);
    }

    public function getDataCount(Request $request)
    {
        $data  = $request->input();
        $tableName = $data['tableName']??'javdb';
        $beginTime = $data['beginTime']??(date('Y-m-d 00:00:00',time()));
        /*秘钥校验后面补*/

        $data = DB::connection('mongodb')->collection($tableName)->where('ctime','>=',$beginTime)->count();
        return response()->json(['code'=>200,'data'=>$data,'msg'=>'ok'],200);
    }

    public function getActorData(Request $request)
    {
        $data  = $request->input();
        $pageSize = $data['pageSize']??100;
        $page = $data['page']??1;
        $page = ($page-1)*$pageSize;
        $tableName = $data['tableName']??'javdb_actor';
        /*秘钥校验后面补*/

        $data = DB::connection('mongodb')->collection($tableName)->skip((int)$page)->take((int)$pageSize)->get();
        return response()->json(['code'=>200,'data'=>$data,'msg'=>'ok'],200);
    }

    public function getActorDataCount(Request $request)
    {
        $data  = $request->input();
        $tableName = $data['tableName']??'javdb_actor';
        $beginTime = $data['beginTime']??(date('Y-m-d 00:00:00',time()));
        /*秘钥校验后面补*/

        $data = DB::connection('mongodb')->collection($tableName)->count();
        return response()->json(['code'=>200,'data'=>$data,'msg'=>'ok'],200);
    }

}