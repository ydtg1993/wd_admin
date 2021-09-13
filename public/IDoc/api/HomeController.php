<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/12
 * Time: 15:24
 */

class HomeController
{

    /**
     * @api {Get} /api/home 获取首页热门信息
     * @apiName 获取首页热门信息
     * @apiGroup 首页相关
     * @apiDescription 获取首页热门信息
     *
     * @apiParam {Number} home_type 首页类型1必须传1
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
     * @api {Get} /api/home 获取首页关注信息
     * @apiName 获取首页关注信息
     * @apiGroup 首页相关
     * @apiDescription 获取首页关注信息
     *
     * @apiParam {Number} home_type 首页类型2必须传2
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
     * @api {Get} /api/home 获取首页类别信息
     * @apiName 获取首页类别信息
     * @apiGroup 首页相关
     * @apiDescription 获取首页类别信息
     *
     * @apiParam {Number} home_type 首页类型3必须传3
     * @apiParam {Number} cid 类别id【0.全部、1.有码、2.无码、3.欧美】
     * @apiParam {Number} is_subtitle 状态：1.不含字幕、2.含字幕
     * @apiParam {Number} is_download 状态：1.不可下载、2.可下载
     * @apiParam {Number} is_short_comment 状态：1.不含短评、2.含短评
     * @apiParam {Number} release_time 发行时间排序：1.是asc、2.是desc
     * @apiParam {Number} flux_linkage_time 磁链更新时间：1.是asc、2.是desc
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

    public function index(Request $request)
    {

    }


    /**
     * @api {Get} /api/home 获取影片排行版
     * @apiName 获取影片排行版
     * @apiGroup 排行相关
     * @apiDescription 获取影片排行版
     *
     * @apiParam {Number} type 类别id【0.全部、1.有码、2.无码、3.欧美】
     * @apiParam {Number} time 时间类型【0.全部、1.日版、2.周榜、3.月榜】
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
     * @apiSuccess {String} list.rank 排行版名词
     *
     */

    public function rank( )
    {

    }

    /**
     * @api {Get} /api/actor/rank 获取演员月排行版
     * @apiName 获取演员月排行版
     * @apiGroup 排行相关
     * @apiDescription 获取演员月排行版
     *
     * @apiParam {Number} type 类别id【0.全部、1.有码、2.无码、3.欧美】
     * @apiParam {Number} time 时间戳【例如：2021年5月1日的时间戳是1619798400】【备注最好加上】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 列表【数组】
     * @apiSuccess {Object} list 演员列表.
     * @apiSuccess {Number} list.id 演员ID
     * @apiSuccess {Number} list.name 演员名称
     * @apiSuccess {String} list.photo 演员头像
     * @apiSuccess {String} list.sex 演员性别
     * @apiSuccess {Object} list.social_accounts 社交账号[]
     * @apiSuccess {String} list.social_accounts.Twitter 社交账号一一对应
     * @apiSuccess {Number} list.movie_sum 影片数量
     * @apiSuccess {Number} list.like_sum 关注数量
     * @apiSuccess {String} list.rank 排行版名次
     *
     */
    public function actorRank()
    {

    }

    /**
     * @api {Get} /api/search 搜索【简易】
     * @apiName 搜索【简易】
     * @apiGroup 首页相关
     * @apiDescription 搜索【简易】
     *
     * @apiParam {String} search 搜索内容
     * @apiParam {Number} is_subtitle 状态：1.不含字幕、2.含字幕
     * @apiParam {Number} is_download 状态：1.不可下载、2.可下载
     * @apiParam {Number} is_short_comment 状态：1.不含短评、2.含短评
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
    public function search( )
    {

    }


    /**
     * @api {Get} /api/search/log 搜索历史【登录可用】
     * @apiName 搜索历史【登录可用】
     * @apiGroup 首页相关
     * @apiDescription 搜索历史【登录可用】
     *
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} list 列表【数组】
     * @apiSuccess {String} list.content 搜索内容
     *
     */
    public function searchLog( )
    {

    }

    /**
     * @api {Get} /api/search/log/clear 清除搜索历史【登录可用】
     * @apiName 清除搜索历史【登录可用】
     * @apiGroup 首页相关
     * @apiDescription 清除搜索历史【登录可用】
     *
     *
     * @apiSuccess {Object} data 空
     *
     */
    public function searchLogClear( )
    {

    }


}