<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/16
 * Time: 9:39
 */


class UserActionController
{

    /**
     * @api {Get} /api/user/add/action 用户粉丝操作【关注或者取消关注】
     * @apiName 用户粉丝操作【关注或者取消关注】
     * @apiGroup 个人中心相关
     * @apiDescription 用户粉丝操作【关注或者取消关注】
     *
     * @apiParam {Number} action_type  动作类型传4【必须是4】
     * @apiParam {Number} goal_id 关注或者取消关注的用户ID
     * @apiParam {Number} status 操作动作【1.关注、2.取消关注】
     *
     * @apiSuccess {Number} id 关注ID.
     *
     */

    /**
     * @api {Get} /api/user/add/action 用户演员操作【收藏或者取消收藏】
     * @apiName 用户演员操作【收藏或者取消收藏】
     * @apiGroup 个人中心相关
     * @apiDescription 用户演员操作【收藏或者取消收藏】
     *
     * @apiParam {Number} action_type  动作类型传5【必须是5】
     * @apiParam {Number} aid 收藏或者取消收藏的演员ID
     * @apiParam {Number} status 操作动作【1.收藏、2.取消收藏】
     *
     * @apiSuccess {Number} id 收藏ID.
     *
     */

    /**
     * @api {Get} /api/user/add/action 用户导演操作【收藏或者取消收藏】
     * @apiName 用户导演操作【收藏或者取消收藏】
     * @apiGroup 个人中心相关
     * @apiDescription 用户导演操作【收藏或者取消收藏】
     *
     * @apiParam {Number} action_type  动作类型传6【必须是6】
     * @apiParam {Number} did 收藏或者取消收藏的导演ID
     * @apiParam {Number} status 操作动作【1.收藏、2.取消收藏】
     *
     * @apiSuccess {Number} id 收藏ID.
     *
     */

    /**
     * @api {Get} /api/user/add/action 用户片商操作【收藏或者取消收藏】
     * @apiName 用户片商操作【收藏或者取消收藏】
     * @apiGroup 个人中心相关
     * @apiDescription 用户片商操作【收藏或者取消收藏】
     *
     * @apiParam {Number} action_type  动作类型传7【必须是7】
     * @apiParam {Number} film_companies_id 收藏或者取消收藏的片商ID
     * @apiParam {Number} status 操作动作【1.收藏、2.取消收藏】
     *
     * @apiSuccess {Number} id 收藏ID
     *
     */

    /**
     * @api {Get} /api/user/add/action 用户番号操作【收藏或者取消收藏】
     * @apiName 用户番号操作【收藏或者取消收藏】
     * @apiGroup 个人中心相关
     * @apiDescription 用户番号操作【收藏或者取消收藏】
     *
     * @apiParam {Number} action_type  动作类型传8【必须是8】
     * @apiParam {Number} nid 收藏或者取消收藏的番号ID
     * @apiParam {Number} status 操作动作【1.收藏、2.取消收藏】
     *
     * @apiSuccess {Number} id 收藏ID
     *
     */

    /**
     * @api {Get} /api/user/add/action 用户系列操作【收藏或者取消收藏】
     * @apiName 用户系列操作【收藏或者取消收藏】
     * @apiGroup 个人中心相关
     * @apiDescription 用户系列操作【收藏或者取消收藏】
     *
     * @apiParam {Number} action_type  动作类型传9【必须是9】
     * @apiParam {Number} series_id 收藏或者取消收藏的番号ID
     * @apiParam {Number} status 操作动作【1.收藏、2.取消收藏】
     *
     * @apiSuccess {Number} id 收藏ID
     *
     */


    /**
     * @api {Get} /api/user/add/action 用户片单操作【创建、修改、收藏、删除】
     * @apiName 用户片单操作【收藏或者取消收藏】
     * @apiGroup 个人中心相关
     * @apiDescription 用户片单操作【收藏或者取消收藏】
     *
     * @apiParam {Number} action_type  动作类型传10【必须是10】
     * @apiParam {Number} type  创建方式【0.其他、1.简易创建、2.详细创建。仅status=1可用】
     * @apiParam {Number} status 操作动作【1.新增、2.删除、3.修改、4.收藏、5.取消收藏】
     * @apiParam {String} intro  片单简介【可选】
     * @apiParam {String} cover  片单图【可选】
     * @apiParam {Number} authority  权限【1.公开、2.仅自己可见】
     * @apiParam {Number} plid  片单ID【修改、删除、收藏必须存在】
     * @apiParam {string} name  片单名称【与片单id一起传】
     *
     * @apiSuccess {bool} data  true成功
     *
     */


    /**
     * @api {Get} /api/user/add/action 浏览影片记录
     * @apiName 浏览影片记录
     * @apiGroup 个人中心相关
     * @apiDescription 浏览影片记录
     *
     * @apiParam {Number} action_type  动作类型传1【必须是1】
     * @apiParam {Number} mid  浏览的影片列表
     *
     * @apiSuccess {Number} id 收藏ID
     *
     */

    /**
     * @api {Get} /api/user/add/action 看过操作【取消或者添加】
     * @apiName 看过操作【取消或者添加】
     * @apiGroup 个人中心相关
     * @apiDescription 看过操作【取消或者添加】
     *
     * @apiParam {Number} action_type  动作类型传3【必须是3】
     * @apiParam {Number} mid  操作的影片
     * @apiParam {Number} status  操作动作【1.添加2.取消】
     * @apiParam {Number} score  评分1-10【status=1必须传】
     * @apiParam {String} comment  评论【status=1必须传】
     *
     * @apiSuccess {Number} id 操作的ID
     *
     */

    /**
     * @api {Get} /api/user/add/action 用户想看操作【取消或者添加】
     * @apiName 用户想看操作【取消或者添加】
     * @apiGroup 个人中心相关
     * @apiDescription 用户想看操作【取消或者添加】
     *
     * @apiParam {Number} action_type  动作类型传2【必须是2】
     * @apiParam {Number} mid 想看或者取消想看的影片ID
     * @apiParam {Number} status 操作动作【1.想看、2.取消想看】
     *
     * @apiSuccess {Number} id 收藏ID
     *
     */
    
    public function add()
    {

    }

    /**
     * @api {Get} /api/user/get/action/list 获取用户关注/粉丝列表
     * @apiName 获取用户关注/粉丝列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户关注/粉丝列表
     *
     * @apiParam {Number} action_type  动作类型传4【必须是4】
     * @apiParam {Number} mid 想看或者取消想看的影片ID
     * @apiParam {Number} type 获取动作【1.关注列表、2.粉丝列表】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 关注或者粉丝列表【数组】
     * @apiSuccess {String} list.nickname 昵称
     * @apiSuccess {Number} list.id 用户ID
     * @apiSuccess {String} list.avatar 头像
     * @apiSuccess {Number} list.piece_list_num 片单数量
     * @apiSuccess {Number} list.seen_num 看过数量
     *
     */

    /**
     * @api {Get} /api/user/get/action/list 获取用户收藏演员列表
     * @apiName 获取用户收藏演员列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户收藏演员列表
     *
     * @apiParam {Number} action_type  动作类型传5【必须是5】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 关注或者粉丝列表【数组】
     * @apiSuccess {String} list.name 演员名称
     * @apiSuccess {Number} list.id 演员ID
     * @apiSuccess {String} list.sex 演员性别
     * @apiSuccess {Number} list.movie_sum 影片数量
     * @apiSuccess {Number} list.like_sum 收藏数量
     *
     */

    /**
     * @api {Get} /api/user/get/action/list 获取用户收藏导演列表
     * @apiName 获取用户收藏导演列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户收藏导演列表
     *
     * @apiParam {Number} action_type  动作类型传6【必须是6】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 导演列表【数组】
     * @apiSuccess {String} list.name 导演名称
     * @apiSuccess {Number} list.id 导演ID
     * @apiSuccess {Number} list.movie_sum 影片数量
     * @apiSuccess {Number} list.like_sum 收藏数量
     *
     */

    /**
     * @api {Get} /api/user/get/action/list 获取用户收藏片商列表
     * @apiName 获取用户收藏片商列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户收藏片商列表
     *
     * @apiParam {Number} action_type  动作类型传7【必须是7】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 片商列表【数组】
     * @apiSuccess {String} list.name 片商名称
     * @apiSuccess {Number} list.id 片商ID
     * @apiSuccess {Number} list.movie_sum 影片数量
     * @apiSuccess {Number} list.like_sum 收藏数量
     *
     */

    /**
     * @api {Get} /api/user/get/action/list 获取用户收藏番号列表
     * @apiName 获取用户收藏番号列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户收藏番号列表
     *
     * @apiParam {Number} action_type  动作类型传8【必须是8】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 番号列表【数组】
     * @apiSuccess {String} list.name 番号名称
     * @apiSuccess {Number} list.id 番号ID
     * @apiSuccess {Number} list.movie_sum 影片数量
     * @apiSuccess {Number} list.like_sum 收藏数量
     *
     */

    /**
     * @api {Get} /api/user/get/action/list 获取用户收藏系列列表
     * @apiName 获取用户收藏系列列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户收藏系列列表
     *
     * @apiParam {Number} action_type  动作类型传9【必须是9】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 系列列表【数组】
     * @apiSuccess {String} list.name 系列名称
     * @apiSuccess {Number} list.id 系列ID
     * @apiSuccess {Number} list.movie_sum 影片数量
     * @apiSuccess {Number} list.like_sum 收藏数量
     *
     */

    /**
     * @api {Get} /api/user/get/action/list 获取用户片单列表
     * @apiName 获取用户片单列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户片单列表
     *
     * @apiParam {Number} action_type  动作类型传10【必须是10】
     * @apiParam {Number} type 0.全部、1.创建、2.收藏
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} likeListSum 数据总数
     * @apiSuccess {Object} likeList 收藏片单列表
     * @apiSuccess {Number} likeList.id id
     * @apiSuccess {Number} likeList.uid 创建的用户ID
     * @apiSuccess {String} likeList.name 片单名
     * @apiSuccess {String} likeList.cover 片单图
     * @apiSuccess {Number} likeList.movie_sum 影片数量
     * @apiSuccess {Number} likeList.like_sum 收藏数量
     * @apiSuccess {Number} likeList.pv_browse_sum 浏览次数
     * @apiSuccess {String} likeList.intro 片单描述
     * @apiSuccess {Number} likeList.is_hot 是否热门【暂时好像没用】
     * @apiSuccess {Number} likeList.authority 权限1公开2私有
     * @apiSuccess {Number} likeList.type 类型1.用户创建.2.系统管理员创建、3.用户默认
     * @apiSuccess {String} likeList.created_at 创建时间
     * @apiSuccess {Number} likeList.a_id 关联ID
     * @apiSuccess {Number} createListsum 数据总数
     * @apiSuccess {Object} createList 创建片单列表
     * @apiSuccess {Number} createList.id id
     * @apiSuccess {Number} createList.uid 创建的用户ID
     * @apiSuccess {String} createList.name 片单名
     * @apiSuccess {String} createList.cover 片单图
     * @apiSuccess {Number} createList.movie_sum 影片数量
     * @apiSuccess {Number} createList.like_sum 收藏数量
     * @apiSuccess {Number} createList.pv_browse_sum 浏览次数
     * @apiSuccess {String} createList.intro 片单描述
     * @apiSuccess {Number} createList.is_hot 是否热门【暂时好像没用】
     * @apiSuccess {Number} createList.authority 权限1公开2私有
     * @apiSuccess {Number} createList.type 类型1.用户创建.2.系统管理员创建、3.用户默认
     * @apiSuccess {String} createList.created_at 创建时间
     * @apiSuccess {Number} createList.a_id 关联ID
     *
     *
     */

    /**
     * @api {Get} /api/user/get/action/list 获取用户浏览记录列表
     * @apiName 获取用户浏览记录列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户浏览记录列表
     *
     * @apiParam {Number} action_type  动作类型传1【必须是1】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
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
     * @api {Get} /api/user/get/action/list 获取用户想看记录列表
     * @apiName 获取用户想看记录列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户想看记录列表
     *
     * @apiParam {Number} action_type  动作类型传2【必须是2】
     * @apiParam {Number} type 分类ID【1.有码、2.无码、3.欧美、4.FC2】
     * @apiParam {Number} sort 排序0.默认排序、1.加入时间排序、2.发布日期排序
     * @apiParam {String} sortType 排序方式【desc、asc】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
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
     * @api {Get} /api/user/get/action/list 获取用户看过记录列表
     * @apiName 获取用户看过记录列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户看过记录列表
     *
     * @apiParam {Number} action_type  动作类型传3【必须是3】
     * @apiParam {Number} type 分类ID【1.有码、2.无码、3.欧美、4.FC2】
     * @apiParam {Number} sort 排序0.默认排序、1.加入时间排序、2.发布日期排序
     * @apiParam {Number} score 评分：0全部、【1 1-2】、【2 2-3】、【3 3-4】、【4 4-5 】、【5 5】
     * @apiParam {String} sortType 排序方式【desc、asc】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
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
    public function getList(Request $request)
    {

    }

    /**
     * @api {Get} /api/user/getHomeUser 获取用户主页信息
     * @apiName 获取用户主页信息
     * @apiGroup 个人中心相关
     * @apiDescription 获取用户主页信息
     *
     * @apiParam {Number} user_id  要获取的用户ID
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Object} userInfo 用户列表.
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
     *
     */
    public function getHomeUser()
    {

    }




    /**
     * @api {Get} /api/user/getHomeUserAction 获取其他用户片单列表
     * @apiName 获取其他用户片单列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取其他用户片单列表
     *
     * @apiParam {Number} action_type  动作类型传10【必须是10】
     * @apiParam {Number} type 0.全部、1.创建、2.收藏
     * @apiParam {Number} user_id 用户ID
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} likeListSum 数据总数
     * @apiSuccess {Object} likeList 收藏片单列表
     * @apiSuccess {Number} likeList.id id
     * @apiSuccess {Number} likeList.uid 创建的用户ID
     * @apiSuccess {String} likeList.name 片单名
     * @apiSuccess {String} likeList.cover 片单图
     * @apiSuccess {Number} likeList.movie_sum 影片数量
     * @apiSuccess {Number} likeList.like_sum 收藏数量
     * @apiSuccess {Number} likeList.pv_browse_sum 浏览次数
     * @apiSuccess {String} likeList.intro 片单描述
     * @apiSuccess {Number} likeList.is_hot 是否热门【暂时好像没用】
     * @apiSuccess {Number} likeList.authority 权限1公开2私有
     * @apiSuccess {Number} likeList.type 类型1.用户创建.2.系统管理员创建、3.用户默认
     * @apiSuccess {String} likeList.created_at 创建时间
     * @apiSuccess {Number} likeList.a_id 关联ID
     * @apiSuccess {Number} createListsum 数据总数
     * @apiSuccess {Object} createList 创建片单列表
     * @apiSuccess {Number} createList.id id
     * @apiSuccess {Number} createList.uid 创建的用户ID
     * @apiSuccess {String} createList.name 片单名
     * @apiSuccess {String} createList.cover 片单图
     * @apiSuccess {Number} createList.movie_sum 影片数量
     * @apiSuccess {Number} createList.like_sum 收藏数量
     * @apiSuccess {Number} createList.pv_browse_sum 浏览次数
     * @apiSuccess {String} createList.intro 片单描述
     * @apiSuccess {Number} createList.is_hot 是否热门【暂时好像没用】
     * @apiSuccess {Number} createList.authority 权限1公开2私有
     * @apiSuccess {Number} createList.type 类型1.用户创建.2.系统管理员创建、3.用户默认
     * @apiSuccess {String} createList.created_at 创建时间
     * @apiSuccess {Number} createList.a_id 关联ID
     *
     *
     */

    /**
     * @api {Get} /api/user/getHomeUserAction 获取其他用户浏览记录列表
     * @apiName 获取其他用户浏览记录列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取其他用户浏览记录列表
     *
     * @apiParam {Number} action_type  动作类型传1【必须是1】
     * @apiParam {Number} type 分类ID【1.有码、2.无码、3.欧美、4.FC2】
     * @apiParam {Number} user_id 用户ID
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
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
     * @api {Get} /api/user/getHomeUserAction 获取其他用户关注/粉丝列表
     * @apiName 获取其他用户关注/粉丝列表
     * @apiGroup 个人中心相关
     * @apiDescription 获取其他用户关注/粉丝列表
     *
     * @apiParam {Number} action_type  动作类型传4【必须是4】
     * @apiParam {Number} mid 想看或者取消想看的影片ID
     * @apiParam {Number} type 获取动作【1.关注列表、2.粉丝列表】
     * @apiParam {Number} user_id 用户ID
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 关注或者粉丝列表【数组】
     * @apiSuccess {String} list.nickname 昵称
     * @apiSuccess {Number} list.id 用户ID
     * @apiSuccess {String} list.avatar 头像
     * @apiSuccess {Number} list.piece_list_num 片单数量
     * @apiSuccess {Number} list.seen_num 看过数量
     * @apiSuccess {Number} list.is_like 是否关注1.关注，其他未关注
     *
     */

    public function getHomeUserAction()
    {

    }


    /**
     * @api {Get} /api/count/movie 添加影片浏览记录
     * @apiName 添加影片浏览记录
     * @apiGroup 统计相关
     * @apiDescription 添加影片浏览记录
     *
     * @apiParam {Number} mid  影片ID
     *
     * @apiSuccess {Number} id 统计ID.
     *
     */

    public function addCountMovie( )
    {

    }

    /**
     * @api {Get} /api/count/actor 添加演员浏览记录
     * @apiName 添加演员浏览记录
     * @apiGroup 统计相关
     * @apiDescription 添加演员浏览记录
     *
     * @apiParam {Number} aid  演员ID
     *
     * @apiSuccess {Number} id 统计ID.
     *
     */
    public function addCountActor( )
    {

    }
}
