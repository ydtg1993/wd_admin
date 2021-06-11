<?php

/*
|--------------------------------------------------------------------------
| 后台路由
|--------------------------------------------------------------------------
|
| 统一命名空间 Admin
| 统一前缀 admin
| 用户认证统一使用 auth 中间件
| 权限认证统一使用 permission:权限名称
|
*/

/*
|--------------------------------------------------------------------------
| 用户登录、退出、更改密码
|--------------------------------------------------------------------------
*/
Route::group(['namespace'=>'Admin','prefix'=>'admin/user'],function (){
    //登录
    Route::get('login','UserController@showLoginForm')->name('admin.user.loginForm');
    Route::post('login','UserController@login')->name('admin.user.login');
    //退出
    Route::get('logout','UserController@logout')->name('admin.user.logout')->middleware('auth');
    //更改密码
    Route::get('change_my_password_form','UserController@changeMyPasswordForm')->name('admin.user.changeMyPasswordForm')->middleware('auth');
    Route::post('change_my_password','UserController@changeMyPassword')->name('admin.user.changeMyPassword')->middleware('auth');
});

/*
|--------------------------------------------------------------------------
| 后台公共页面
|--------------------------------------------------------------------------
*/
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth'],function (){
    //后台布局
    Route::get('/','IndexController@layout')->name('admin.layout');
    //后台首页
    Route::get('/index','IndexController@index')->name('admin.index');
});


/*
|--------------------------------------------------------------------------
| 系统管理模块
|--------------------------------------------------------------------------
*/
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>['auth','permission:system']],function (){

    //用户管理
    Route::group(['middleware'=>['permission:system.user']],function (){
        Route::get('user','UserController@index')->name('admin.user');
        Route::get('user/data','UserController@data')->name('admin.user.data');
        //添加
        Route::get('user/create','UserController@create')->name('admin.user.create')->middleware('permission:system.user.create');
        Route::post('user/store','UserController@store')->name('admin.user.store')->middleware('permission:system.user.create');
        //编辑
        Route::get('user/{id}/edit','UserController@edit')->name('admin.user.edit')->middleware('permission:system.user.edit');
        Route::put('user/{id}/update','UserController@update')->name('admin.user.update')->middleware('permission:system.user.edit');
        //删除
        Route::delete('user/destroy','UserController@destroy')->name('admin.user.destroy')->middleware('permission:system.user.destroy');
        //分配角色
        Route::get('user/{id}/role','UserController@role')->name('admin.user.role')->middleware('permission:system.user.role');
        Route::put('user/{id}/assignRole','UserController@assignRole')->name('admin.user.assignRole')->middleware('permission:system.user.role');
        //分配权限
        Route::get('user/{id}/permission','UserController@permission')->name('admin.user.permission')->middleware('permission:system.user.permission');
        Route::put('user/{id}/assignPermission','UserController@assignPermission')->name('admin.user.assignPermission')->middleware('permission:system.user.permission');
    });

    //角色管理
    Route::group(['middleware'=>'permission:system.role'],function (){
        Route::get('role','RoleController@index')->name('admin.role');
        Route::get('role/data','RoleController@data')->name('admin.role.data');
        //添加
        Route::get('role/create','RoleController@create')->name('admin.role.create')->middleware('permission:system.role.create');
        Route::post('role/store','RoleController@store')->name('admin.role.store')->middleware('permission:system.role.create');
        //编辑
        Route::get('role/{id}/edit','RoleController@edit')->name('admin.role.edit')->middleware('permission:system.role.edit');
        Route::put('role/{id}/update','RoleController@update')->name('admin.role.update')->middleware('permission:system.role.edit');
        //删除
        Route::delete('role/destroy','RoleController@destroy')->name('admin.role.destroy')->middleware('permission:system.role.destroy');
        //分配权限
        Route::get('role/{id}/permission','RoleController@permission')->name('admin.role.permission')->middleware('permission:system.role.permission');
        Route::put('role/{id}/assignPermission','RoleController@assignPermission')->name('admin.role.assignPermission')->middleware('permission:system.role.permission');
    });

    //权限管理
    Route::group(['middleware'=>'permission:system.permission'],function (){
        Route::get('permission','PermissionController@index')->name('admin.permission');
        Route::get('permission/data','PermissionController@data')->name('admin.permission.data');
        //添加
        Route::get('permission/create','PermissionController@create')->name('admin.permission.create')->middleware('permission:system.permission.create');
        Route::post('permission/store','PermissionController@store')->name('admin.permission.store')->middleware('permission:system.permission.create');
        //编辑
        Route::get('permission/{id}/edit','PermissionController@edit')->name('admin.permission.edit')->middleware('permission:system.permission.edit');
        Route::put('permission/{id}/update','PermissionController@update')->name('admin.permission.update')->middleware('permission:system.permission.edit');
        //删除
        Route::delete('permission/destroy','PermissionController@destroy')->name('admin.permission.destroy')->middleware('permission:system.permission.destroy');
    });

    //配置组
    Route::group(['middleware'=>'permission:system.config_group'],function (){
        Route::get('config_group','ConfigGroupController@index')->name('admin.config_group');
        Route::get('config_group/data','ConfigGroupController@data')->name('admin.config_group.data');
        //添加
        Route::get('config_group/create','ConfigGroupController@create')->name('admin.config_group.create')->middleware('permission:system.config_group.create');
        Route::post('config_group/store','ConfigGroupController@store')->name('admin.config_group.store')->middleware('permission:system.config_group.create');
        //编辑
        Route::get('config_group/{id}/edit','ConfigGroupController@edit')->name('admin.config_group.edit')->middleware('permission:system.config_group.edit');
        Route::put('config_group/{id}/update','ConfigGroupController@update')->name('admin.config_group.update')->middleware('permission:system.config_group.edit');
        //删除
        Route::delete('config_group/destroy','ConfigGroupController@destroy')->name('admin.config_group.destroy')->middleware('permission:system.config_group.destroy');
    });

    //配置项
    Route::group(['middleware'=>'permission:system.configuration'],function (){
        Route::get('configuration','ConfigurationController@index')->name('admin.configuration');
        //添加
        Route::get('configuration/create','ConfigurationController@create')->name('admin.configuration.create')->middleware('permission:system.configuration.create');
        Route::post('configuration/store','ConfigurationController@store')->name('admin.configuration.store')->middleware('permission:system.configuration.create');
        //编辑
        Route::put('configuration/update','ConfigurationController@update')->name('admin.configuration.update')->middleware('permission:system.configuration.edit');
        //删除
        Route::delete('configuration/destroy','ConfigurationController@destroy')->name('admin.configuration.destroy')->middleware('permission:system.configuration.destroy');
    });

    //登录日志
    Route::group(['middleware'=>'permission:system.login_log'],function (){
        Route::get('login_log','LoginLogController@index')->name('admin.login_log');
        Route::get('login_log/data','LoginLogController@data')->name('admin.login_log.data');
        Route::delete('login_log/destroy','LoginLogController@destroy')->name('admin.login_log.destroy');
    });

    //操作日志
    Route::group(['middleware'=>'permission:system.operate_log'],function (){
        Route::get('operate_log','OperateLogController@index')->name('admin.operate_log');
        Route::get('operate_log/data','OperateLogController@data')->name('admin.operate_log.data');
        Route::delete('operate_log/destroy','OperateLogController@destroy')->name('admin.operate_log.destroy');
    });

});

/*
|--------------------------------------------------------------------------
| 资讯管理模块
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:information', 'operate.log']], function () {
    //分类管理
    Route::group(['middleware' => 'permission:information.category'], function () {
        Route::get('category/data', 'CategoryController@data')->name('admin.category.data');
        Route::get('category', 'CategoryController@index')->name('admin.category');
        //添加分类
        Route::get('category/create', 'CategoryController@create')->name('admin.category.create')->middleware('permission:information.category.create');
        Route::post('category/store', 'CategoryController@store')->name('admin.category.store')->middleware('permission:information.category.create');
        //编辑分类
        Route::get('category/{id}/edit', 'CategoryController@edit')->name('admin.category.edit')->middleware('permission:information.category.edit');
        Route::put('category/{id}/update', 'CategoryController@update')->name('admin.category.update')->middleware('permission:information.category.edit');
        //删除分类
        Route::delete('category/destroy', 'CategoryController@destroy')->name('admin.category.destroy')->middleware('permission:information.category.destroy');
    });
    //文章管理
    Route::group(['middleware' => 'permission:information.article'], function () {
        Route::get('article/data', 'ArticleController@data')->name('admin.article.data');
        Route::get('article', 'ArticleController@index')->name('admin.article');
        //添加
        Route::get('article/create', 'ArticleController@create')->name('admin.article.create')->middleware('permission:information.article.create');
        Route::post('article/store', 'ArticleController@store')->name('admin.article.store')->middleware('permission:information.article.create');
        //编辑
        Route::get('article/{id}/edit', 'ArticleController@edit')->name('admin.article.edit')->middleware('permission:information.article.edit');
        Route::put('article/{id}/update', 'ArticleController@update')->name('admin.article.update')->middleware('permission:information.article.edit');
        //删除
        Route::delete('article/destroy', 'ArticleController@destroy')->name('admin.article.destroy')->middleware('permission:information.article.destroy');
    });
    //标签管理
    Route::group(['middleware' => 'permission:information.tag'], function () {
        Route::get('tag/data', 'TagController@data')->name('admin.tag.data');
        Route::get('tag', 'TagController@index')->name('admin.tag');
        //添加
        Route::get('tag/create', 'TagController@create')->name('admin.tag.create')->middleware('permission:information.tag.create');
        Route::post('tag/store', 'TagController@store')->name('admin.tag.store')->middleware('permission:information.tag.create');
        //编辑
        Route::get('tag/{id}/edit', 'TagController@edit')->name('admin.tag.edit')->middleware('permission:information.tag.edit');
        Route::put('tag/{id}/update', 'TagController@update')->name('admin.tag.update')->middleware('permission:information.tag.edit');
        //删除
        Route::delete('tag/destroy', 'TagController@destroy')->name('admin.tag.destroy')->middleware('permission:information.tag.destroy');
    });

    //审核管理
    Route::group(['middleware' => 'permission:review.movie'], function () {
        //审核影片
        Route::get('review/movie', 'ReviewMovieController@index')->name('admin.review.movie');
        Route::get('review/movie/data', 'ReviewMovieController@data')->name('admin.review_movie.data');
        //编辑
        Route::get('review/movie/{id}/edit', 'ReviewMovieController@edit')->name('admin.review.movie.edit')->middleware('permission:review.movie.edit');
        Route::put('review/movie/{id}/update', 'ReviewMovieController@update')->name('admin.review.movie.update')->middleware('permission:review.movie.update');
    });
    //发行商
    Route::group(['middleware' => 'permission:movie.companies'], function () {
        Route::get('movie/companies', 'MovieFilmCompaniesController@index')->name('admin.movie.companies');
        Route::get('movie/companies/data', 'MovieFilmCompaniesController@data')->name('admin.movie_companies.data');
        Route::get('movie/companies/create', 'MovieFilmCompaniesController@create')->name('admin.movie.companies.create')->middleware('permission:movie.companies.create');
        Route::post('movie/companies/store', 'MovieFilmCompaniesController@store')->name('admin.movie.companies.store')->middleware('permission:movie.companies.store');
        Route::get('movie/companies/{id}/edit', 'MovieFilmCompaniesController@edit')->name('admin.movie.companies.edit')->middleware('permission:movie.companies.edit');
        Route::put('movie/companies/{id}/update', 'MovieFilmCompaniesController@update')->name('admin.movie.companies.update')->middleware('permission:movie.companies.update');
    });
    //系列
    Route::group(['middleware' => 'permission:movie.series'], function () {
        Route::get('movie/series', 'MovieSeriesController@index')->name('admin.movie.series');
        Route::get('movie/series/data', 'MovieSeriesController@data')->name('admin.movie_series.data');
        Route::get('movie/series/create', 'MovieSeriesController@create')->name('admin.movie.series.create')->middleware('permission:movie.series.create');
        Route::post('movie/series/store', 'MovieSeriesController@store')->name('admin.movie.series.store')->middleware('permission:movie.series.store');
        Route::get('movie/series/{id}/edit', 'MovieSeriesController@edit')->name('admin.movie.series.edit')->middleware('permission:movie.series.edit');
        Route::put('movie/series/{id}/update', 'MovieSeriesController@update')->name('admin.movie.series.update')->middleware('permission:movie.series.update');
    });
    //标签
    Route::group(['middleware' => 'permission:movie.label'], function () {
        Route::get('movie/label', 'MovieLabelController@index')->name('admin.movie.label');
        Route::get('movie/label/data', 'MovieLabelController@data')->name('admin.movie_label.data');
        Route::get('movie/label/create', 'MovieLabelController@create')->name('admin.movie.label.create')->middleware('permission:movie.label.create');
        Route::post('movie/label/store', 'MovieLabelController@store')->name('admin.movie.label.store')->middleware('permission:movie.label.store');
        Route::get('movie/label/{id}/edit', 'MovieLabelController@edit')->name('admin.movie.label.edit')->middleware('permission:movie.label.edit');
        Route::put('movie/label/{id}/update', 'MovieLabelController@update')->name('admin.movie.label.update')->middleware('permission:movie.label.update');
    });
    //演员
    Route::group(['middleware' => 'permission:movie.actor'], function () {
        Route::get('movie/actor', 'MovieActorController@index')->name('admin.movie.actor');
        Route::get('movie/actor/data', 'MovieActorController@data')->name('admin.movie_actor.data');
        Route::get('movie/actor/create', 'MovieActorController@create')->name('admin.movie.actor.create')->middleware('permission:movie.actor.create');
        Route::post('movie/actor/store', 'MovieActorController@store')->name('admin.movie.actor.store')->middleware('permission:movie.actor.store');
        Route::get('movie/actor/{id}/edit', 'MovieActorController@edit')->name('admin.movie.actor.edit')->middleware('permission:movie.actor.edit');
        Route::put('movie/actor/{id}/update', 'MovieActorController@update')->name('admin.movie.actor.update')->middleware('permission:movie.actor.update');
    });

});
