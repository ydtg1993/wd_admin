<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class ActorDetailController extends  BaseController
{
    /**
     * @api {Post} /api/actor/detail 演员信息
     * @apiName 演员信息
     * @apiGroup 演员详情
     * @apiDescription 演员信息
     *
     * @apiParam {Number} id  【演员id】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "id": 1,
    "name": "楓可憐",
    "photo": "/javdb_actor/avatar/36a1b3da742ab899c6fa129a27e667a8.jpg",
    "sex": "",
    "social_accounts": {
    "Twitter": "https://twitter.com/karenkaede_"
    },
    "movie_sum": 0,
    "like_sum": 0,
    "names": {
    "1": "楓可憐",
    "2": " 楓カレン"
    }
    }
    }
     */
    public function index()
    {

    }


    /**
     *
     * @api {Post} /api/actor/products 作品列表
     * @apiName 作品列表
     * @apiGroup 演员详情
     * @apiDescription 作品列表
     *
     * @apiParam {Number} id  【演员id】
     * @apiParam {Number} page  【分页】
     * @apiParam {String} filter  【1.subtitle字幕 2.download已下载 3.comment新评】
     * @apiParam {String} sort  【1.release发布时间排序 2.linkage链接更新排序】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
     *
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "0": {
    "id": 5815,
    "name": "Shelter-in-pussy",
    "number": "AssParade.20.06.29",
    "release_time": "2021-05-30 02:28:34",
    "created_at": "2021-05-30T02:37:46.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/fd3fd725516b25724409d2faad9eb739.jpg",
    "big_cove": "/javdb/big_cove/3520b9683c98bac720ad9107f866fa9c.jpg"
    },
    "1": {
    "id": 5782,
    "name": "Horny Neighbor Valentina Jewels",
    "number": "AssParade.20.07.20",
    "release_time": "2021-05-30 02:28:31",
    "created_at": "2021-05-30T02:37:42.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/7c9b546c4ec6af67b6e76cde47064785.jpg",
    "big_cove": "/javdb/big_cove/dddb6edf60152a0a440cffe734380fa4.jpg"
    },
    "2": {
    "id": 5732,
    "name": "GOT",
    "number": "TeamSkeetXCamSoda.20.07.23",
    "release_time": "2021-05-30 02:28:27",
    "created_at": "2021-05-30T02:37:39.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/f3e5fc0cbfcf556562d371ff097a13d3.jpg",
    "big_cove": "/javdb/big_cove/a1d9ba6c4cdd76a71769fb7febc79d27.jpg"
    }
    }
    }
     */
    public function products()
    {

    }
}
