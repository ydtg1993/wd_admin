<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class NumberDetailController
{
    /**
     * @api {Post} /api/number/detail 番号信息
     * @apiName 番号信息
     * @apiGroup 番号详情
     * @apiDescription 番号信息
     * @apiHeader {String} token  【header头传输 可以不传】
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
    "name": "BangBus",
    "movie_sum": 0,
    "like_sum": 0,
    "is_like": 0
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
    "sum": 44,
    "list": [
    {
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
    {
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
    }
    ]
    }
    }
     */
    public function products()
    {

    }
}
