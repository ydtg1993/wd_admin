<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class NumberDetailController extends  BaseController
{
    /**
     * @api {Post} /api/number/detail 番号信息
     * @apiName 番号信息
     * @apiGroup 番号详情
     * @apiDescription 番号信息
     *
     * @apiParam {Number} id  【番号id】
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
     * @api {Post} /api/number/products 番号作品列表
     * @apiName 番号作品列表
     * @apiGroup 番号详情
     * @apiDescription 番号作品列表
     *
     * @apiParam {Number} id  【番号id】
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
    "id": 12693,
    "name": "Anal Approach",
    "number": "BangBus.21.05.19",
    "release_time": "2021-05-30 02:32:58",
    "created_at": "2021-05-30T02:46:03.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/f88b0d90fc090edef5ea0e31fc66f74f.jpg",
    "big_cove": "/javdb/big_cove/73b2b712c23f4fc8c84ad2cb9099135e.jpg"
    },
    "1": {
    "id": 9361,
    "name": "Hottie With Perfect Tits Fucks for Money",
    "number": "BangBus.21.03.24",
    "release_time": "2021-05-30 02:31:48",
    "created_at": "2021-05-30T02:41:41.000000Z",
    "is_download": 2,
    "is_subtitle": 2,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/1c54f4cd99d37ca0412d2f5eb07153b9.jpg",
    "big_cove": "/javdb/big_cove/6e964d480c353edcac7c2847f5ae0cbc.jpg"
    },
    "2": {
    "id": 9287,
    "name": "Slutty Tourist Fucks For Extra Cash",
    "number": "BangBus.20.01.29",
    "release_time": "2021-05-30 02:31:43",
    "created_at": "2021-05-30T02:41:35.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/e9130476da453b14fe54190d31b306a3.jpg",
    "big_cove": "/javdb/big_cove/297288474112e27f89df8c707877b952.jpg"
    }
    }
    }
     */
    public function products()
    {

    }
}
