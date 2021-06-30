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
     *
     * @apiParam {Number} id  【影片id】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "id": 1,
    "number": "BangBus.21.05.05",
    "name": "Young and Innocent on the Bus",
    "time": 194400,
    "release_time": "2021-05-30 02:20:27",
    "small_cover": "/javdb/small_cover/85f3020a8f42d8613bcd3261cc82cd93.jpg",
    "big_cove": "/javdb/big_cove/f85add990cdf586de23fad132afb7897.jpg",
    "trailer": "",
    "score": 0,
    "score_people": 2,
    "comment_num": 2,
    "wan_see": 0,
    "seen": 0,
    "flux_linkage_num": 5,
    "flux_linkage": [
    {
    "name": "BangBus.21.05.05.Emma.Sirus.XXX.480p.MP4-XXX",
    "url": "magnet:?xt=urn:btih:5a4c4ae79a057571f7d7659702f0ac9846df92bc&dn=[javdb.com]BangBus.21.05.05.Emma.Sirus.XXX.480p.MP4-XXX",
    "is-small": null,
    "is-warning": null,
    "tooltip": null,
    "meta": "(440MB,1個文件)"
    },
    {
    "name": "BangBus.21.05.05.Emma.Sirus.XXX.1080p.MP4-WRB[XvX]",
    "url": "magnet:?xt=urn:btih:8fd24b477b2cc5fed9234396ba8334226e9c8ba0&dn=[javdb.com]BangBus.21.05.05.Emma.Sirus.XXX.1080p.MP4-WRB[XvX]",
    "is-small": "高清",
    "is-warning": null,
    "tooltip": null,
    "meta": "(3.81GB,2個文件)"
    },
    {
    "name": "BangBus.21.05.05.Emma.Sirus.XXX.1080p.MP4-WRB[rarbg]",
    "url": "magnet:?xt=urn:btih:91a8bb06f4ad0b9b27528a4be6d7721d01109657&dn=[javdb.com]BangBus.21.05.05.Emma.Sirus.XXX.1080p.MP4-WRB[rarbg]",
    "is-small": "高清",
    "is-warning": null,
    "tooltip": null,
    "meta": "(3.81GB,4個文件)"
    },
    {
    "name": "BangBus.21.05.05.Emma.Sirus.XXX.720p.HEVC.x265.PRT",
    "url": "magnet:?xt=urn:btih:5e56f10235e8ac74cb160b8a4f2c2f89e0313e37&dn=[javdb.com]BangBus.21.05.05.Emma.Sirus.XXX.720p.HEVC.x265.PRT",
    "is-small": null,
    "is-warning": null,
    "tooltip": null,
    "meta": "(835MB,2個文件)"
    },
    {
    "name": "BangBus.21.05.05.Emma.Sirus.XXX.SD.MP4-KLEENEX",
    "url": "magnet:?xt=urn:btih:2e52a1a97edba910744c1a8be526ae9a766d7d81&dn=[javdb.com]BangBus.21.05.05.Emma.Sirus.XXX.SD.MP4-KLEENEX",
    "is-small": null,
    "is-warning": null,
    "tooltip": null,
    "meta": "(438MB,3個文件)"
    }
    ],
    "flux_linkage_time": "2021-05-30 02:28:22",
    "created_at": "2021-05-30T02:28:22.000000Z",
    "labels": {
    "198": "顏射",
    "200": "口交",
    "461": "業餘",
    "473": "貧乳",
    "474": "金髮",
    "479": "大屁股",
    "488": "白虎",
    "501": "背入式",
    "502": "騎乘位",
    "504": "傳教士",
    "506": "射精",
    "587": "少女"
    },
    "actors": {
    "1257": "Tyler Steel",
    "1258": "Emma Sirus"
    },
    "director": [],
    "company": [],
    "series": {
    "719": "レズビアン大乱交"
    },
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
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
     *
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "2": {
    "id": 2,
    "comment": "白妞也有奶子这么小的，长见识了",
    "nickname": "lo***r",
    "avatar": "",
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-05-30 02:28:22",
    "reply_comments": []
    },
    "1": {
    "id": 1,
    "comment": "这妹纸屁股顶逼粉上位骑乘那段nice",
    "nickname": "sy***_",
    "avatar": "",
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-05-30 02:28:22",
    "reply_comments": []
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
     * @apiSuccessExample  {json} success-example

     */
    public function reply()
    {

    }

}
