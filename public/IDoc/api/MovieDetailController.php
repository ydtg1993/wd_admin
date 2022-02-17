<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class MovieDetailController
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
     * @apiSuccess {String} flux_linkage 磁链说明
     * @apiSuccess {String} flux_linkage.time 磁链更新时间【必填】
     * @apiSuccess {String} flux_linkage.name 磁链名称 【必填】
     * @apiSuccess {String} flux_linkage.meta 磁链描述【必填】
     * @apiSuccess {String} flux_linkage.url 磁链下载地址【必填】
     * @apiSuccess {Number} flux_linkage.is-small 1=高清【必填】
     * @apiSuccess {Number} flux_linkage.is-warning 1=字幕【必填】
     * @apiSuccess {Number} flux_linkage.tooltip 1=离线下载【必填】
     * @apiSuccess {Number} flux_linkage.bluray 1=蓝光 【选填】
     * @apiSuccess {String} flux_linkage.resolution 分辨率 【选填】
     * @apiSuccess {Number} flux_linkage.size 文件大小 [选填]
     * @apiSuccess {String} flux_linkage.ext 文件类型 [选填]
     * @apiSuccess {String} flux_linkage.xt 加密类型 [选填]
     * @apiSuccess {String} flux_linkage.md5 文件校验码 [选填]
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "id": 12895,
    "number": "061320_001",
    "name": "レズビアン大乱交〜ルナ&須藤なこ〜",
    "time": 212400,
    "release_time": "2021-05-30 02:34:12",
    "small_cover": "http://www.wd.com/d41d8cd98f00b204e9800998ecf8427e/0d9d74d1a77c2a4f.jpeg",
    "big_cove": "http://www.wd.com/d41d8cd98f00b204e9800998ecf8427e/9dd08f6a93072331.jpeg",
    "trailer": "http://www.wd.com/d41d8cd98f00b204e9800998ecf8427e/a2105f1833731ade.mp4",
    "map": [
    "http://www.wd.com/d41d8cd98f00b204e9800998ecf8427e/ea2db2a5e7f9a74e.jpeg"
    ],
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
    "labels": [
    {
    "name": "女同性戀",
    "id": 38
    },
    {
    "name": "熟女",
    "id": 377
    }
    ],
    "actors": [
    {
    "name": "真木今日子",
    "id": 18,
    "is_like": 0
    },
    {
    "name": "三上悠亜",
    "id": 21,
    "is_like": 0
    },
    {
    "name": "ルナ",
    "id": 822,
    "is_like": 0
    }
    ],
    "director": [
    {
    "name": "［Jo］Style",
    "id": 414,
    "is_like": 0
    }
    ],
    "company": [
    {
    "name": "Vixen Group",
    "id": 1,
    "is_like": 0
    }
    ],
    "series": [
    {
    "name": "Bang Bus",
    "id": 1,
    "is_like": 0
    }
    ],
    "numbers": [
    {
    "name": "Momsincontrol",
    "id": 96
    }
    ],
    "seen": 0,
    "want_see": 0
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
    "pageSize": "10",
    "sum": 1,
    "list": [
    {
    "id": 7521,
    "comment": "那个牙是真的丑\n逼略肥但是不是粉的，片不好看逼也不好看",
    "nickname": "ja***y",
    "like": 0,
    "dislike": 0,
    "avatar": "",
    "score": null,
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-05-30 02:46:16",
    "reply_comments": [
    {
    "id": 7516,
    "comment": "剧情不错.无码有字幕本身就少见.感觉妈妈拍的话比女儿更吸引人",
    "nickname": "se***o",
    "like": 0,
    "dislike": 0,
    "avatar": "",
    "score": null,
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-05-30 02:46:14",
    "reply_comments": [],
    "uid": -1,
    "is_like": 1,//本人是点赞
    "is_dislike": 1//本人是否踩
    },
    {
    "id": 7517,
    "comment": "举报的死马",
    "nickname": "al***o",
    "like": 0,
    "dislike": 0,
    "avatar": "",
    "score": null,
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-05-30 02:46:14",
    "reply_comments": [],
    "uid": -1,
    "is_like": 0,
    "is_dislike": 0
    },
    {
    "id": 7518,
    "comment": "橹度不是很高",
    "nickname": "hu***i",
    "like": 0,
    "dislike": 0,
    "avatar": "",
    "score": null,
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-05-30 02:46:14",
    "reply_comments": [],
    "uid": -1,
    "is_like": 0,
    "is_dislike": 0
    },
    {
    "id": 7519,
    "comment": "还是东京热的味道：够狠，够折磨\n某人说东京热就是一群猪拱了一个好白菜\n此话不假，而且白菜的身材还真的不错\n还是比较推荐的\n唯独缺少了片头曲，那首激情片头能唤醒多少人的精液啊",
    "nickname": "ja***y",
    "like": 0,
    "dislike": 0,
    "avatar": "",
    "score": null,
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-05-30 02:46:15",
    "reply_comments": [],
    "uid": -1,
    "is_like": 0,
    "is_dislike": 1
    },
    {
    "id": 7520,
    "comment": "眼睛挺大但是做爱的时候哪个表情感觉丝毫都不会让人硬\n一般般",
    "nickname": "ja***y",
    "like": 0,
    "dislike": 0,
    "avatar": "",
    "score": null,
    "type": 1,
    "reply_uid": 0,
    "comment_time": "2021-05-30 02:46:15",
    "reply_comments": [],
    "uid": -1,
    "is_like": 0,
    "is_dislike": 1
    }
    ],
    "uid": -1,
    "is_like": 1,//本人是点赞
    "is_dislike": 1//本人是否踩
    }
    ]
    }
    }
     */
    public function comment()
    {

    }

    /**
     * @api {Post} /api/movie/reply 影片发评论
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
     * @apiSuccess {string} warning 当碰到过滤词时，提示的警告

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

    /**
     * @api {Post} /api/movie/my_score 我的评分
     * @apiName 我的评分
     * @apiGroup 影片
     * @apiDescription 我对影片的评分
     *
     * @apiParam {Number} id  【影片id】
     *
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
     *
    {
    "code": 200,
    "msg": "成功！",
    "data": {
        "score":5
    }
    }
     */
    public function myScore()
    {

    }
}
