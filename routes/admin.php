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
});

/*
|--------------------------------------------------------------------------
| 采集管理
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'operate.log']], function () {
    //审核影片管理
    Route::group(['middleware' => 'permission:review.movie'], function () {
        //审核影片
        Route::get('review/movie', 'ReviewMovieController@index')->name('admin.review.movie');
        Route::get('review/movie/data', 'ReviewMovieController@data')->name('admin.review_movie.data');
        //编辑
        Route::get('review/movie/{id}/edit', 'ReviewMovieController@edit')->name('admin.review.movie.edit')->middleware('permission:review.movie.edit');
        Route::put('review/movie/{id}/update', 'ReviewMovieController@update')->name('admin.review.movie.update')->middleware('permission:review.movie.update');
    });
    //审核采集演员
    Route::group(['middleware' => 'permission:review.actor'], function () {
        Route::get('review/actor', 'ReviewActorController@index')->name('admin.review.actor');
        Route::get('review/actor/data', 'ReviewActorController@data')->name('admin.review_actor.data');
        //编辑
        Route::get('review/actor/{id}/edit', 'ReviewActorController@edit')->name('admin.review.actor.edit')->middleware('permission:review.actor.edit');
        Route::put('review/actor/{id}/update', 'ReviewActorController@update')->name('admin.review.actor.update')->middleware('permission:review.actor.update');
    });
    //导演
    Route::group(['middleware' => 'permission:review.actor'], function () {
        Route::get('review/director', 'ReviewDirectorController@index')->name('admin.review.director');
        Route::get('review/director/data', 'ReviewDirectorController@data')->name('admin.review_director.data');
        //编辑
        Route::get('review/director/{id}/edit', 'ReviewDirectorController@edit')->name('admin.review.director.edit')->middleware('permission:review.director.edit');
        Route::put('review/director/{id}/update', 'ReviewDirectorController@update')->name('admin.review.director.update')->middleware('permission:review.director.update');
    });
    //发行商
    Route::group(['middleware' => 'permission:review.companies'], function () {
        Route::get('review/companies', 'ReviewFilmCompaniesController@index')->name('admin.review.companies');
        Route::get('review/companies/data', 'ReviewFilmCompaniesController@data')->name('admin.review_companies.data');
        Route::get('review/companies/{id}/edit', 'ReviewFilmCompaniesController@edit')->name('admin.review.companies.edit')->middleware('permission:review.companies.edit');
        Route::put('review/companies/{id}/update', 'ReviewFilmCompaniesController@update')->name('admin.review.companies.update')->middleware('permission:review.companies.update');
    });
    //系列
    Route::group(['middleware' => 'permission:review.series'], function () {
        Route::get('review/series', 'ReviewSeriesController@index')->name('admin.review.series');
        Route::get('review/series/data', 'ReviewSeriesController@data')->name('admin.review_series.data');
        Route::get('review/series/{id}/edit', 'ReviewSeriesController@edit')->name('admin.review.series.edit')->middleware('permission:review.series.edit');
        Route::put('review/series/{id}/update', 'ReviewSeriesController@update')->name('admin.review.series.update')->middleware('permission:review.series.update');
    });
    //番号
    Route::group(['middleware' => 'permission:review.numbers'], function () {
        Route::get('review/numbers', 'ReviewNumbersController@index')->name('admin.review.numbers');
        Route::get('review/numbers/data', 'ReviewNumbersController@data')->name('admin.review_numbers.data');
        Route::get('review/numbers/{id}/edit', 'ReviewNumbersController@edit')->name('admin.review.numbers.edit')->middleware('permission:review.numbers.edit');
        Route::put('review/numbers/{id}/update', 'ReviewNumbersController@update')->name('admin.review.numbers.update')->middleware('permission:review.numbers.update');
    });
    //标签
    Route::group(['middleware' => 'permission:review.label'], function () {
        Route::get('review/label', 'ReviewLabelController@index')->name('admin.review.label');
        Route::get('review/label/data', 'ReviewLabelController@data')->name('admin.review_label.data');
        Route::get('review/label/{id}/edit', 'ReviewLabelController@edit')->name('admin.review.label.edit')->middleware('permission:review.label.edit');
        Route::put('review/label/{id}/update', 'ReviewLabelController@update')->name('admin.review.label.update')->middleware('permission:review.label.update');
    });
});
/*
|--------------------------------------------------------------------------
| 内容管理
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'operate.log']], function () {
    //影片
    Route::group(['middleware' => 'permission:movie.movie'], function () {
        Route::get('movie/movie', 'MovieController@index')->name('admin.movie.movie');
        Route::get('movie/movie/data', 'MovieController@data')->name('admin.movie_movie.data');
        Route::get('movie/movie/create', 'MovieController@create')->name('admin.movie.movie.create')->middleware('permission:movie.movie.create');
        Route::post('movie/movie/store', 'MovieController@store')->name('admin.movie.movie.store')->middleware('permission:movie.movie.store');
        Route::get('movie/movie/{id}/edit', 'MovieController@edit')->name('admin.movie.movie.edit')->middleware('permission:movie.movie.edit');
        Route::put('movie/movie/{id}/update', 'MovieController@update')->name('admin.movie.movie.update')->middleware('permission:movie.movie.update');
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
    //番号
    Route::group(['middleware' => 'permission:movie.numbers'], function () {
        Route::get('movie/numbers', 'MovieNumbersController@index')->name('admin.movie.numbers');
        Route::get('movie/numbers/data', 'MovieNumbersController@data')->name('admin.movie_numbers.data');
        Route::get('movie/numbers/create', 'MovieNumbersController@create')->name('admin.movie.numbers.create')->middleware('permission:movie.numbers.create');
        Route::post('movie/numbers/store', 'MovieNumbersController@store')->name('admin.movie.numbers.store')->middleware('permission:movie.numbers.store');
        Route::get('movie/numbers/{id}/edit', 'MovieNumbersController@edit')->name('admin.movie.numbers.edit')->middleware('permission:movie.numbers.edit');
        Route::put('movie/numbers/{id}/update', 'MovieNumbersController@update')->name('admin.movie.numbers.update')->middleware('permission:movie.numbers.update');
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
    //导演
    Route::group(['middleware' => 'permission:movie.director'], function () {
        Route::get('movie/director', 'MovieDirectorController@index')->name('admin.movie.director');
        Route::get('movie/director/data', 'MovieDirectorController@data')->name('admin.movie_director.data');
        Route::get('movie/director/create', 'MovieDirectorController@create')->name('admin.movie.director.create')->middleware('permission:movie.director.create');
        Route::post('movie/director/store', 'MovieDirectorController@store')->name('admin.movie.director.store')->middleware('permission:movie.director.store');
        Route::get('movie/director/{id}/edit', 'MovieDirectorController@edit')->name('admin.movie.director.edit')->middleware('permission:movie.director.edit');
        Route::put('movie/director/{id}/update', 'MovieDirectorController@update')->name('admin.movie.director.update')->middleware('permission:movie.director.update');
    });
    //分类管理
    Route::group(['middleware' => 'permission:movie.category'], function () {
        Route::get('movie/category', 'MovieCategoryController@index')->name('admin.movie.category');
        Route::get('movie/category/data', 'MovieCategoryController@data')->name('admin.movie_category.data');
        Route::get('movie/category/create', 'MovieCategoryController@create')->name('admin.movie.category.create')->middleware('permission:movie.category.create');
        Route::post('movie/category/store', 'MovieCategoryController@store')->name('admin.movie.category.store')->middleware('permission:movie.category.store');
        Route::get('movie/category/{id}/edit', 'MovieCategoryController@edit')->name('admin.movie.category.edit')->middleware('permission:movie.category.edit');
        Route::put('movie/category/{id}/update', 'MovieCategoryController@update')->name('admin.movie.category.update')->middleware('permission:movie.category.update');
    });
});



/*
|--------------------------------------------------------------------------
| 网站管理模块
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:conf', 'operate.log']], function () {
    //广告招商
    Route::group(['middleware' => 'permission:conf.ad_investment'], function () {
        Route::get('conf/ad_investment', 'ConfController@adInvestment')->name('admin.conf.ad_investment');
        Route::put('conf/save_ad_investment', 'ConfController@saveAdInVestMent')->name('admin.conf.save_ad_investment');
    });
    //下载本站APP
    Route::group(['middleware' => 'permission:conf.download_app_setting'], function () {
        Route::get('conf/download_app_setting', 'ConfController@downloadAppSettingView')->name('admin.conf.download_app_setting');
        Route::put('conf/save_download_app_setting', 'ConfController@saveDownloadAppSetting')->name('admin.conf.save_download_app_setting');
    });
    //关于我们
    Route::group(['middleware' => 'permission:conf.about_us'], function () {
        Route::get('conf/about_us', 'ConfController@aboutUsView')->name('admin.conf.about_us');
        Route::put('conf/save_about_us', 'ConfController@saveDownloadAppSetting')->name('admin.conf.save_about_us');
    });
    //意见反馈
    Route::group(['middleware' => 'permission:conf.complaint'], function () {
        Route::get('complaint/data', 'ComplaintController@data')->name('admin.complaint.data');
        Route::get('complaint', 'ComplaintController@index')->name('admin.complaint');
    });
    //友情链接
    Route::group(['middleware' => 'permission:conf.friend_link'], function () {
        Route::get('conf/friend_link', 'ConfController@friendLinkView')->name('admin.conf.friend_link');
        Route::put('conf/save_friend_link', 'ConfController@saveFriendLink')->name('admin.conf.save_friend_link');
    });
    //隐私条款
    Route::group(['middleware' => 'permission:conf.private_item'], function () {
        Route::get('conf/private_item', 'ConfController@privateItemView')->name('admin.conf.private_item');
        Route::put('conf/save_private_item', 'ConfController@saveprivateItem')->name('admin.conf.save_private_item');
    });
    //磁力教程
    Route::group(['middleware' => 'permission:conf.magnet_link'], function () {
        Route::get('conf/magnet_link', 'ConfController@magnetLinkView')->name('admin.conf.magnet_link');
        Route::put('conf/save_magnet_link', 'ConfController@saveMagnetLink')->name('admin.conf.save_magnet_link');
    });
});


/*
|--------------------------------------------------------------------------
| 公告管理模块
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:announcement', 'operate.log']], function () {

    Route::get('top/data', 'AnnouncementController@data')->name('admin.top.data');

    //顶部轮播图
    Route::group(['middleware' => 'permission:announcement.top'], function () {
        Route::get('top/index', 'AnnouncementController@topIndex')->name('admin.top.index');
        //添加
        Route::get('top/create_top', 'AnnouncementController@createTopView')->name('admin.top.create_top')->middleware('permission:announcement.top.create_top');
        Route::post('top/store_top', 'AnnouncementController@storeTop')->name('admin.top.store_top')->middleware('permission:announcement.top.create_top');
        //编辑
        Route::get('top/{id}/edit_top', 'AnnouncementController@editTopView')->name('admin.top.edit_top')->middleware('permission:announcement.top.edit_top');
        Route::put('top/{id}/update_top', 'AnnouncementController@updateTop')->name('admin.top.update_top')->middleware('permission:announcement.top.edit_top');
        //删除
        Route::delete('top/destroy_top', 'AnnouncementController@destroyTop')->name('admin.top.destroy_top')->middleware('permission:announcement.top.destroy_top');

    });
    //内容轮播图
    Route::group(['middleware' => 'permission:announcement.content'], function () {
        Route::get('content/index', 'AnnouncementController@contentIndex')->name('admin.content.index');
        //添加
        Route::get('content/create_content', 'AnnouncementController@createContentView')->name('admin.content.create_content')->middleware('permission:announcement.content.create_content');
        Route::post('content/store_content', 'AnnouncementController@storeContent')->name('admin.content.store_content')->middleware('permission:announcement.content.create_content');
        //编辑
        Route::get('content/{id}/edit_content', 'AnnouncementController@editContentView')->name('admin.content.edit_content')->middleware('permission:announcement.content.edit_content');
        Route::put('content/{id}/update_content', 'AnnouncementController@updateContent')->name('admin.content.edit_content')->middleware('permission:announcement.content.edit_content');
        //删除
        Route::delete('content/destroy_content', 'AnnouncementController@destroyContent')->name('admin.content.destroy_content')->middleware('permission:announcement.content.destroy_content');

    });

});
