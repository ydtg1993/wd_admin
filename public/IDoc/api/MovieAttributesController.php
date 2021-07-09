<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/16
 * Time: 9:39
 */

class MovieAttributesController
{

    /**
     * @api {Get} /api/movie/attributes/actor/list 获取演员列表
     * @apiName 获取演员列表
     * @apiGroup 影片相关
     * @apiDescription 获取演员列表
     *
     * @apiParam {Number} cid  类别ID【0.全部、1.有码、2.无码、3.欧美】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number}  page 分页页码
     * @apiSuccess {Number} pageSize 分页长度
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} actorList 演员列表.
     * @apiSuccess {Number} actorList.id 演员ID
     * @apiSuccess {Number} actorList.name 演员名称
     * @apiSuccess {String} actorList.photo 演员头像
     * @apiSuccess {String} actorList.sex 演员性别
     * @apiSuccess {Object} actorList.social_accounts 社交账号[]
     * @apiSuccess {String} actorList.social_accounts.Twitter 社交账号一一对应
     * @apiSuccess {Number} actorList.movie_sum 影片数量
     * @apiSuccess {Number} actorList.like_sum 关注数量
     *
     */
    public function getActorList()
    {

    }

    /**
     * @api {Get} /api/movie/attributes/series/list 获取系列列表
     * @apiName 获取系列列表
     * @apiGroup 影片相关
     * @apiDescription 获取系列列表
     *
     * @apiParam {Number} cid  类别ID【0.全部、1.有码、2.无码、3.欧美】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number}  page 分页页码
     * @apiSuccess {Number} pageSize 分页长度
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} seriesList 系列列表.
     * @apiSuccess {Number} seriesList.id 系列ID
     * @apiSuccess {String} seriesList.name 系列名称
     * @apiSuccess {Number} seriesList.movie_sum 影片数量
     * @apiSuccess {Number} seriesList.like_sum 关注数量
     *
     */
    public function getSeriesList()
    {

    }


    /**
     * @api {Get} /api/movie/attributes/film/companies/list 获取片商列表
     * @apiName 获取片商列表
     * @apiGroup 影片相关
     * @apiDescription 获取片商列表
     *
     * @apiParam {Number} cid  类别ID【0.全部、1.有码、2.无码、3.欧美】
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number}  page 分页页码
     * @apiSuccess {Number} pageSize 分页长度
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} filmCompaniesList 片商列表.
     * @apiSuccess {Number} filmCompaniesList.id 片商ID
     * @apiSuccess {String} filmCompaniesList.name 片商名称
     * @apiSuccess {Number} filmCompaniesList.movie_sum 影片数量
     * @apiSuccess {Number} filmCompaniesList.like_sum 关注数量
     *
     */
    public function getFilmCompaniesList( )
    {

    }
}