<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class MovieDetailController extends  BaseController
{
    /**
     * @api {Post} /api/movie/detail 影片详情
     * @apiName 影片详情
     * @apiGroup 影片
     * @apiDescription 详情
     * @apiHeader {String} token  【header头传输 可以不传】
     *
     * @apiParam {Number} id  【影片id】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "id": 15,
    "number": "IMadePorn.21.05.04",
    "name": "Change Of Plans",
    "time": null,
    "release_time": "2021-05-30 02:20:28",
    "small_cover": "/javdb/small_cover/d576bbdbc81d0e21f23ae48334cecb55.jpg",
    "big_cove": "/javdb/big_cove/28bcc64ee14a186eb3b02119a5d081e1.jpg",
    "trailer": "",
    "score": 0,
    "score_people": 0,
    "comment_num": 0,
    "flux_linkage_num": 3,
    "flux_linkage": [
    {
    "name": "IMadePorn.21.05.04.Alexia.Anders.Change.Of.Plans.XXX.1080p.MP4-WRB[rarbg]",
    "url": "magnet:?xt=urn:btih:30edf0fc48e60089453b3537d1e89e747760a46f&dn=[javdb.com]IMadePorn.21.05.04.Alexia.Anders.Change.Of.Plans.XXX.1080p.MP4-WRB[rarbg]",
    "is-small": "高清",
    "is-warning": null,
    "tooltip": null,
    "meta": "(3.35GB,4個文件)"
    },
    {
    "name": "IMadePorn.21.05.04.Alexia.Anders.Change.Of.Plans.XXX.720p.WEB.x264-GalaXXXy[XvX]",
    "url": "magnet:?xt=urn:btih:54861ceedf360f946fe6aad76c706f92f5730e5b&dn=[javdb.com]IMadePorn.21.05.04.Alexia.Anders.Change.Of.Plans.XXX.720p.WEB.x264-GalaXXXy[XvX]",
    "is-small": null,
    "is-warning": null,
    "tooltip": null,
    "meta": "(376MB,2個文件)"
    },
    {
    "name": "IMadePorn.21.05.04.Alexia.Anders.Change.Of.Plans.XXX.SD.MP4-KLEENEX",
    "url": "magnet:?xt=urn:btih:5565222e48da4812497cf1450a12a4c1f26cf854&dn=[javdb.com]IMadePorn.21.05.04.Alexia.Anders.Change.Of.Plans.XXX.SD.MP4-KLEENEX",
    "is-small": null,
    "is-warning": null,
    "tooltip": null,
    "meta": "(322MB,3個文件)"
    }
    ],
    "flux_linkage_time": "2021-05-30 02:28:23",
    "created_at": "2021-05-30T02:28:23.000000Z",
    "labels": [],
    "actors": {
    "1286": "Alexia Anders"
    },
    "director": [],
    "company": [],
    "series": {
    "719": "レズビアン大乱交"
    },
    "seen": 0,
    "want_see": 0,
    "map": []
    }
    }
     */
    public function index()
    {

    }


    /**
     *
     * @api {Post} /api/movie/show Ta还出演过
     * @apiName Ta还出演过
     * @apiGroup 影片
     * @apiDescription Ta还出演过
     *
     * @apiParam {Number} id  【影片id】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
     *
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "0": {
    "id": 260,
    "name": "La Sirena 69’s Perfect Tits and Ass",
    "number": "BigTitsRoundAsses.20.12.12",
    "release_time": "2021-05-30 02:20:41",
    "created_at": "2021-05-30T02:28:57.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/03c4bd9c2284138728e64570824c7922.jpg",
    "big_cove": "/javdb/big_cove/2f005a9e69166a8e7807ad714f4839de.jpg"
    },
    "1": {
    "id": 834,
    "name": "Fucking The Sitter",
    "number": "BangBros18.21.02.21",
    "release_time": "2021-05-30 02:21:49",
    "created_at": "2021-05-30T02:30:16.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/ffa90cf17813db7d25cb0d2051baa456.jpg",
    "big_cove": "/javdb/big_cove/dbaaf3ac4556a4dd23e57cdad777f7f9.jpg"
    },
    "2": {
    "id": 1147,
    "name": "Clara's Suitcase Sex Surprise",
    "number": "BangBros18.20.12.20",
    "release_time": "2021-05-30 02:22:07",
    "created_at": "2021-05-30T02:30:57.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/ceee6f6c6291716245d4d27c33c4e09f.jpg",
    "big_cove": "/javdb/big_cove/e4b2c7c386a71b79704d34f90b93a5b9.jpg"
    }
    }
    }
     */
    public function show()
    {

    }

    /**
     *
     * @api {Post} /api/movie/guess 猜你喜欢
     * @apiName 猜你喜欢
     * @apiGroup 影片
     * @apiDescription 猜你喜欢
     *
     * @apiParam {Number} id  【影片id】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
     *
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "0": {
    "id": 591,
    "name": "Private Dancer",
    "number": "LookAtHerNow.20.09.20",
    "release_time": "2021-05-30 02:21:09",
    "created_at": "2021-05-30 02:29:43",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/c5ed651f1e9d8bd122292825419a9c9f.jpg",
    "big_cove": "/javdb/big_cove/0c631088ac3c46004ca7b0996cab910a.jpg"
    },
    "1": {
    "id": 5850,
    "name": "Untamed",
    "number": "tushyraw.20.06.24",
    "release_time": "2021-05-30 02:28:37",
    "created_at": "2021-05-30 02:37:49",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/f7149bdee56cc16558d5c18d40393764.jpg",
    "big_cove": "/javdb/big_cove/de85cf801601d27dfba6dd2976af8915.jpg"
    }
    }
    }
     */
    public function guess()
    {

    }

    /**
     *
     * @api {Post} /api/movie/comment 评论列表
     * @apiName 评论列表
     * @apiGroup 影片
     * @apiDescription 评论列表
     *
     * @apiParam {Number} id  【影片id】
     * @apiParam {Number} page  【分页】
     * @apiParam {Number} pageSize  【分页长度】
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
    "sum": 5,
    "list": {
    "7524": {
    "id": 7524,
    "comment": "sjhdkjshdkjsdkjsdh",
    "nickname": "hk",
    "avatar": "",
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-06-30 16:16:13",
    "reply_comments": []
    },
    "7523": {
    "id": 7523,
    "comment": "sjhdkjshdkjsdkjsdh",
    "nickname": "hk",
    "avatar": "",
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-06-30 16:14:34",
    "reply_comments": []
    }
    }
    }
    }
     */
    public function comment()
    {

    }

    /**
     * @api {Post} /api/movie/detail 影片发评论
     * @apiName 影片发评论
     * @apiGroup 影片
     * @apiDescription 发评论
     *
     * @apiParam {Number} id  【影片id】
     * @apiParam {Number} uid  【用户id】
     * @apiParam {Number} comment_id  【直接发评论0 如果是回复为回复的评论id】
     * @apiParam {String} comment  【内容6-255字】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误

     */
    public function reply()
    {

    }

    /**
     * @api {Post} /api/comment/action 评论赞踩
     * @apiName 评论赞踩
     * @apiGroup 影片
     * @apiDescription 评论赞踩
     *
     * @apiParam {Number} id  【评论id】
     * @apiParam {enum} action like：赞 dislike:踩
     * @apiParam {String} token token
     *
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误

     */
    public function action()
    {

    }


}
