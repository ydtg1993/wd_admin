<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class DirectorDetailController
{
    /**
     * @api {Post} /api/director/detail 导演信息
     * @apiName 导演信息
     * @apiGroup 导演详情
     * @apiDescription 导演信息
     * @apiHeader {String} token  【header头传输 可以不传】
     *
     * @apiParam {Number} id  【导演id】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "id": 1,
    "name": "Derek Dozer",
    "movie_sum": 81,
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
     * @api {Post} /api/actor/products 作品列表
     * @apiName 作品列表
     * @apiGroup 导演详情
     * @apiDescription 作品列表
     *
     * @apiParam {Number} id  【导演id】
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
    "sum": 81,
    "list": [
    {
    "id": 9371,
    "name": "In The Moment",
    "number": "blacked.20.10.17",
    "release_time": "2021-05-30 02:31:49",
    "created_at": "2021-05-30T02:41:43.000000Z",
    "is_download": 2,
    "is_subtitle": 2,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 2,
    "score": 0,
    "small_cover": "/javdb/small_cover/779a92979710ba7e6722f9d1f7ab9bb6.jpg",
    "big_cove": "/javdb/big_cove/7420d70cac02d921301bfd927bc2b7dc.jpg"
    },
    {
    "id": 9362,
    "name": "Wanna Chill?",
    "number": "blackedraw.18.11.18",
    "release_time": "2021-05-30 02:31:48",
    "created_at": "2021-05-30T02:41:42.000000Z",
    "is_download": 2,
    "is_subtitle": 2,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 1,
    "score": 0,
    "small_cover": "/javdb/small_cover/e4e0cc3cb425f18504a8b7f6e3e50a6f.jpg",
    "big_cove": "/javdb/big_cove/bbb31c1c5285482180637982c2497289.jpg"
    }
    ]
    }
    }
     */
    public function products()
    {

    }
}
