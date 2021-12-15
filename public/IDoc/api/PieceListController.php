<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/16
 * Time: 9:39
 */


class PieceListController
{

    /**
     * @api {Get} /api/piece/info 获取片单详情
     * @apiName 获取片单详情
     * @apiGroup 片单相关
     * @apiDescription 获取片单详情
     *
     * @apiParam {Number} pid 片单ID
     *
     * @apiSuccess {Number} id 片单id
     * @apiSuccess {Number} uid 片单创建的用户
     * @apiSuccess {String} name 片单名称
     * @apiSuccess {String} cover 片单图
     * @apiSuccess {Number} movie_sum 影片数量
     * @apiSuccess {Number} like_sum 收藏数量
     * @apiSuccess {Number} pv_browse_sum pv
     * @apiSuccess {String} intro 描述
     * @apiSuccess {Number} is_hot 是否热门【待定】
     * @apiSuccess {Number} authority 权限1.公开、2.私有
     * @apiSuccess {Number} audit 审核 1.审核通过、2.审核不通过，0.审核中
     * @apiSuccess {Number} type 片单类型1.用户创建、2.系统/管理员创建3.用户系统默认
     * @apiSuccess {String} created_at 创建时间
     * @apiSuccess {Object} userInfo 创建片单用户信息
     * @apiSuccess {Number} userInfo.phone 手机
     * @apiSuccess {Number} userInfo.email 邮箱
     * @apiSuccess {String} userInfo.nickname 昵称
     * @apiSuccess {String} userInfo.sex 性别 0.未知 1.男 2.女
     * @apiSuccess {Object} userInfo.age 年龄
     * @apiSuccess {String} userInfo.attention 关注数量
     * @apiSuccess {Number} userInfo.fans 粉丝数量
     * @apiSuccess {Number} userInfo.avatar 头像
     * @apiSuccess {Number} userInfo.intro 简介
     * @apiSuccess {Number} userInfo.user_id 用户ID
     * @apiSuccess {Number} userInfo.user_attention 是否被该用户关注【1.是、2.否】
     * @apiSuccess {Number} is_like 0未收藏 1已收藏
     *
     */
    public function getInfo( )
    {
    }


    /**
     * @api {Get} /api/piece/movie/list 获取片单影片列表
     * @apiName 获取片单影片列表
     * @apiGroup 片单相关
     * @apiDescription 获取片单影片列表
     *
     * @apiParam {Number} pid 片单ID
     * @apiParam {Number} is_subtitle 状态：1.不含字幕、2.含字幕
     * @apiParam {Number} is_download 状态：1.不可下载、2.可下载
     * @apiParam {Number} is_short_comment 状态：1.不含短评、2.含短评
     * @apiParam {Number} sort 其他发布日期。2，评分排序
     * @apiParam {Number} sortType 排序方式desc/asc
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
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
    public function getMovieList( )
    {

    }


    public function getHomeUser()
    {

    }


    public function getHomeUserAction( )
    {

    }



    /**
     * @api {Get} /api/piece/list 获取片单列表
     * @apiName 获取片单列表
     * @apiGroup 片单相关
     * @apiDescription 获取片单列表
     *
     * @apiParam {Number} type 1.全部、2.热门
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Object} list 片单列表【数组】
     * @apiSuccess {Number} list.id id
     * @apiSuccess {Number} list.uid 创建的用户ID
     * @apiSuccess {String} list.name 片单名
     * @apiSuccess {String} list.cover 片单图
     * @apiSuccess {Number} list.movie_sum 影片数量
     * @apiSuccess {Number} list.like_sum 收藏数量
     * @apiSuccess {Number} list.pv_browse_sum 浏览次数
     * @apiSuccess {String} list.intro 片单描述
     * @apiSuccess {Number} list.is_hot 是否热门【暂时好像没用】
     * @apiSuccess {Number} list.authority 权限1公开2私有
     * @apiSuccess {Number} list.audit 审核 1审核通过 2审核不通过 3审核中
     * @apiSuccess {Number} list.type 类型1.用户创建.2.系统管理员创建、3.用户默认
     * @apiSuccess {String} list.created_at 创建时间
     * @apiSuccess {String} list.avatar 用户头像
     * @apiSuccess {String} list.nickname 用户昵称
     *
     */
    public function getPieceList()
    {

    }

    /**
     * @api {Post} /api/user/piece/list/add/movie 添加或者给片单删除一个影片
     * @apiName 添加或者给片单删除一个影片
     * @apiGroup 片单相关
     * @apiDescription 添加或者给片单删除一个影片
     *
     * @apiParam {Number} pid 片单ID
     * @apiParam {Number} status 操作类型1.添加 2.删除
     * @apiParam {Number} mid 操作的影片
     *
     * @apiSuccess {Number} id 操作ID
     *
     *
     */
    public function addMovie( )
    {

    }
}
