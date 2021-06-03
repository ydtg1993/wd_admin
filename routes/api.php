<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//文件上传接口
Route::post('upload', 'ApiController@upload')->name('api.upload');

Route::group(['namespace'=>'Api'],function (){

    Route::any('getData','DataController@getData')->name('api.getData');//获取数据
    Route::any('getDataCount','DataController@getDataCount')->name('api.getDataCount');//获取统计参数

    Route::any('getActorData','DataController@getActorData')->name('api.getActorData');//获取数据演员
    Route::any('getActorDataCount','DataController@getActorDataCount')->name('api.getActorDataCount');//获取统计参数演员

    Route::any('movieFileUpload', 'MovieFileController@upload')->name('api.movieFileUpload');
    Route::any('movieFileBatchUpload', 'MovieFileController@batchUpload')->name('api.movieFileBatchUpload');
    Route::any('movieFileRemove', 'MovieFileController@remove')->name('api.movieFileRemove');
});
