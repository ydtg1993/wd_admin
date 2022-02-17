<?php

class UserSeenController
{
    /**
     * @api {Get} /api/search 搜索【全站模式】
     * @apiName 搜索引擎
     * @apiGroup 首页相关
     * @apiDescription 搜索【根据条件】
     *
     * @apiParam {String} search 搜索内容
     * @apiParam {String} ty  搜索类型 movie=影片 actor=演员 series=系列 film=片商 director=导演  number=番号  piece=片单
     * @apiParam {Number} is_subtitle 状态：1.不含字幕、2.含字幕
     * @apiParam {Number} is_download 状态：1.不可下载、2.可下载
     * @apiParam {Number} is_short_comment 状态：1.不含短评、2.含短评
     * @apiParam {Number} page 分页页码 默认值1（兼容老接口）
     * @apiParam {Number} pageSize 分页长度，默认值10
     * @apiParam {Number} lastid 请求得到的最后id，用于新分页，默认值0
     *
     */

    /**
     * @api {Get} /api/search 搜索【影片，番号】
     * @apiName 搜索影片番号
     * @apiGroup 首页相关
     * @apiDescription 搜索【影片，番号】
     *
     * @apiParam {String} search 搜索内容
     * @apiParam {String} ty  搜索类型 movie=影片 number=番号
     * @apiParam {Number} is_subtitle 状态：1.不含字幕、2.含字幕
     * @apiParam {Number} is_download 状态：1.不可下载、2.可下载
     * @apiParam {Number} is_short_comment 状态：1.不含短评、2.含短评
     * @apiParam {Number} page 分页页码 默认值1（兼容老接口）
     * @apiParam {Number} pageSize 分页长度，默认值10
     * @apiParam {Number} lastid 请求得到的最后id，用于新分页，默认值0
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Number} lastid 请求得到最后id
     * @apiSuccess {string} name 搜索的内容（搜番号时）
     * @apiSuccess {Number} number_Id 番号组的id（搜番号时）
     * @apiSuccess {Object} list 列表【数组】
     * @apiSuccess {Number} list.id 影片ID
     * @apiSuccess {String} list.name 影片ID名称
     * @apiSuccess {String} list.number 影片番号
     * @apiSuccess {String} list.release_time 发行时间
     * @apiSuccess {String} list.created_at 创建时间
     * @apiSuccess {Number} list.is_download 状态：1.不可下载、2.可下载
     * @apiSuccess {Number} list.is_subtitle 状态：1.不含字幕、2.含字幕
     * @apiSuccess {Number} list.is_short_comment 状态：1.不含短评、2.含短评
     * @apiSuccess {Number} list.is_hot 是否热门待定
     * @apiSuccess {Number} list.is_new_comment 0.无状态、1.今日新评、2.无状态、3.昨日新评
     * @apiSuccess {Number} list.is_flux_linkage 0.无状态1.今日新种、2.无状态、3.昨日新种
     * @apiSuccess {Number} list.comment_num 评论数量
     * @apiSuccess {Number} list.score 评分
     * @apiSuccess {String} list.small_cover 小图
     * @apiSuccess {String} list.big_cove 大图
     *
     */

    /**
     * @api {Get} /api/search 搜索【演员】
     * @apiName 搜索演员
     * @apiGroup 首页相关
     * @apiDescription 搜索【演员】
     *
     * @apiParam {String} search 搜索内容
     * @apiParam {String} ty  搜索类型 actor=演员
     * @apiParam {Number} page 分页页码 默认值1（兼容老接口）
     * @apiParam {Number} pageSize 分页长度，默认值10
     * @apiParam {Number} lastid 请求得到的最后id，用于新分页，默认值0
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Number} lastid 请求得到最后id
     * @apiSuccess {Object} list 列表【数组】
     * @apiSuccess {Number} list.id 演员ID
     * @apiSuccess {String} list.name 演员名称
     * @apiSuccess {String} list.phote 演员图片
     * @apiSuccess {String} list.sex 演员性别
     * @apiSuccess {String} list.movie_sum 电影数
     * @apiSuccess {Number} list.like_sum 收藏数
     * @apiSuccess {Number} list.categoty_name 分类名称
     * @apiSuccess {Number} list.categoty_id 分类id
     *
     */

    /**
     * @api {Get} /api/search 搜索【系列】
     * @apiName 搜索系列
     * @apiGroup 首页相关
     * @apiDescription 搜索【系列】
     *
     * @apiParam {String} search 搜索内容
     * @apiParam {String} ty  搜索类型 series=系列
     * @apiParam {Number} page 分页页码 默认值1（兼容老接口）
     * @apiParam {Number} pageSize 分页长度，默认值10
     * @apiParam {Number} lastid 请求得到的最后id，用于新分页，默认值0
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Number} lastid 请求得到最后id
     * @apiSuccess {Object} list 列表【数组】
     * @apiSuccess {Number} list.id 系列ID
     * @apiSuccess {String} list.name 系列名称
     * @apiSuccess {String} list.movie_sum 电影数
     * @apiSuccess {Number} list.like_sum 收藏数
     * @apiSuccess {Number} list.categoty_name 分类名称
     * @apiSuccess {Number} list.categoty_id 分类id
     *
     */

    /**
     * @api {Get} /api/search 搜索【片商】
     * @apiName 搜索片商
     * @apiGroup 首页相关
     * @apiDescription 搜索【片商】
     *
     * @apiParam {String} search 搜索内容
     * @apiParam {String} ty  搜索类型 film=片商
     * @apiParam {Number} page 分页页码 默认值1（兼容老接口）
     * @apiParam {Number} pageSize 分页长度，默认值10
     * @apiParam {Number} lastid 请求得到的最后id，用于新分页，默认值0
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Number} lastid 请求得到最后id
     * @apiSuccess {Object} list 列表【数组】
     * @apiSuccess {Number} list.id 片商ID
     * @apiSuccess {String} list.name 片商名称
     * @apiSuccess {String} list.movie_sum 电影数
     * @apiSuccess {Number} list.like_sum 收藏数
     * @apiSuccess {Number} list.categoty_name 分类名称
     * @apiSuccess {Number} list.categoty_id 分类id
     *
     */

    /**
     * @api {Get} /api/search 搜索【导演】
     * @apiName 搜索导演
     * @apiGroup 首页相关
     * @apiDescription 搜索【导演】
     *
     * @apiParam {String} search 搜索内容
     * @apiParam {String} ty  搜索类型 director=导演
     * @apiParam {Number} page 分页页码 默认值1（兼容老接口）
     * @apiParam {Number} pageSize 分页长度，默认值10
     * @apiParam {Number} lastid 请求得到的最后id，用于新分页，默认值0
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Number} lastid 请求得到最后id
     * @apiSuccess {Object} list 列表【数组】
     * @apiSuccess {Number} list.id 导演ID
     * @apiSuccess {String} list.name 导演名称
     * @apiSuccess {String} list.movie_sum 电影数
     * @apiSuccess {Number} list.like_sum 收藏数
     * @apiSuccess {Number} list.categoty_name 分类名称
     * @apiSuccess {Number} list.categoty_id 分类id
     *
     */

    /**
     * @api {Get} /api/search 搜索【片单】
     * @apiName 搜索片单
     * @apiGroup 首页相关
     * @apiDescription 搜索【片单】
     *
     * @apiParam {String} search 搜索内容
     * @apiParam {String} ty  搜索类型 piece=片单
     * @apiParam {Number} page 分页页码 默认值1（兼容老接口）
     * @apiParam {Number} pageSize 分页长度，默认值10
     * @apiParam {Number} lastid 请求得到的最后id，用于新分页，默认值0
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Number} lastid 请求得到最后id
     * @apiSuccess {Object} list 列表【数组】
     * @apiSuccess {Number} list.id 片单id
     * @apiSuccess {Number} list.audit 1=审核通过
     * @apiSuccess {String} list.authority 1=公开
     * @apiSuccess {String} list.cover  封面图
     * @apiSuccess {Number} list.name  片单名称
     * @apiSuccess {Number} list.intro 片单描述
     * @apiSuccess {Number} list.movie_sum 片单影片数量
     * @apiSuccess {Number} list.like_sum 片单收藏数量
     * @apiSuccess {Number} list.uid 用户id
     * @apiSuccess {Number} list.username 用户名
     * @apiSuccess {Number} list.avatar 用户头像
     * @apiSuccess {Number} list.created_at 创建时间
     */

    public function search()
    {

    }

    /**
     * @api {Get} /api/search/hotword 搜索下面的热搜词
     * @apiName 热搜词
     * @apiGroup 首页相关
     * @apiDescription 热搜词
     *
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 列表【数组】
     * @apiSuccess {Number} list[] 关键词组数
     *
     */
    public function hotword()
    {

    }

}
