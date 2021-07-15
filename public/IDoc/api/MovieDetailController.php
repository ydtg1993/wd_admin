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
     *
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "id": 12895,
    "number": "061320_001",
    "name": "レズビアン大乱交〜ルナ&須藤なこ〜",
    "time": 212400,
    "release_time": "2021-05-30 02:34:12",
    "small_cover": "/d41d8cd98f00b204e9800998ecf8427e/0d9d74d1a77c2a4f.jpeg",
    "big_cove": "/d41d8cd98f00b204e9800998ecf8427e/9dd08f6a93072331.jpeg",
    "trailer": "/d41d8cd98f00b204e9800998ecf8427e/a2105f1833731ade.mp4",
    "score": 0,
    "score_people": 5,
    "comment_num": 0,
    "flux_linkage_num": 1,
    "flux_linkage": [
    {
    "name": "测试",
    "url": "dsdsd",
    "tooltip": "本地下载",
    "meta": "2g",
    "is-small": "",
    "is-warning": ""
    }
    ],
    "flux_linkage_time": "2021-05-30 03:09:29",
    "created_at": "2021-05-30T03:09:29.000000Z",
    "labels": {
    "38": "女同性戀",
    "377": "熟女"
    },
    "actors": {
    "18": "真木今日子",
    "21": "三上悠亜",
    "822": "ルナ"
    },
    "director": {
    "414": "［Jo］Style"
    },
    "company": {
    "1": "Vixen Group"
    },
    "series": {
    "1": "Bang Bus"
    },
    "numbers": {
    "96": "Momsincontrol"
    },
    "seen": 0,
    "want_see": 0,
    "map": [
    "/d41d8cd98f00b204e9800998ecf8427e/ea2db2a5e7f9a74e.jpeg"
    ]
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
