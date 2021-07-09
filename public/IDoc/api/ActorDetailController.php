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
    "id": 263,
    "name": "森菜菜子",
    "photo": "/javdb_actor/avatar/68d7456eb3ed08c59e1300538a6c503c.jpg",
    "sex": "",
    "social_accounts": {
    "Twitter": "https://twitter.com/mori7ko"
    },
    "movie_sum": 0,
    "like_sum": 0,
    "names": {
    "871": "森菜菜子",
    "872": " 森ななこ",
    "873": " 森nanako"
    },
    "is_like": 0
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
     * @apiParam {Number} pageSize  【分页长度】
     * @apiParam {Number} filter  【1.subtitle字幕 2.download已下载 3.comment新评】
     * @apiParam {Number} sort  【1.release发布时间排序 2.linkage链接更新排序】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
     *
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "page": "1",
    "pageSize": "2",
    "sum": 36,
    "list": [
    {
    "id": 9278,
    "name": "House Keeper",
    "number": "RKPrime.20.01.29",
    "release_time": "2021-05-30 02:31:43",
    "created_at": "2021-05-30T02:41:34.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/d9981d98b84fba0b68674a678619b951.jpg",
    "big_cove": "/javdb/big_cove/260d65aa1d4b98f2ef7d6c4c4cd28473.jpg"
    },
    {
    "id": 12431,
    "name": "Graduation",
    "number": "vixen.20.02.03",
    "release_time": "2021-05-30 02:31:43",
    "created_at": "2021-05-30T02:45:23.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/3fcf48013c67ac3e8c5b6b01f7b52fc6.jpg",
    "big_cove": "/javdb/big_cove/837792894077b74638c1ff775e9bb7c0.jpg"
    }
    ]
    }
    }
     */
    public function products()
    {

    }
}
