<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class SeriesDetailController extends  BaseController
{
    /**
     * @api {Post} /api/series/detail 系列信息
     * @apiName 系列信息
     * @apiGroup 系列详情
     * @apiDescription 系列信息
     *
     * @apiParam {Number} id  【系列id】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "id": 719,
    "name": "レズビアン大乱交",
    "movie_sum": 2,
    "like_sum": 0
    }
    }
     */
    public function index()
    {

    }


    /**
     *
     * @api {Post} /api/series/products 系列作品列表
     * @apiName 系列作品列表
     * @apiGroup 系列详情
     * @apiDescription 系列作品列表
     *
     * @apiParam {Number} id  【系列id】
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
    "sum": 5979,
    "list": [
    {
    "id": 12894,
    "name": "チーム木村番外編生挿入 -- 綺羅千沙斗",
    "number": "kb1599",
    "release_time": "2021-05-30 02:34:35",
    "created_at": "2021-05-30T02:46:16.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/19a1d1391e24d38156f4d9963b303540.jpg",
    "big_cove": "/javdb/big_cove/1aff3c8a06de43155efcebd08dd3bcac.jpg"
    },
    {
    "id": 11962,
    "name": "ときめき ～もっと何々して…を連発する俺の彼女～",
    "number": "010720_956",
    "release_time": "2021-05-30 02:34:34",
    "created_at": "2021-05-30T02:44:30.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/21d9072ece98b7ee91d35b61c887fdb3.jpg",
    "big_cove": "/javdb/big_cove/9e63f250d5a8b21baf6cbf24efd7c2e9.jpg"
    }
    ]
    }
    }
     */
    public function products()
    {

    }
}
