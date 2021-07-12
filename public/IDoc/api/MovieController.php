<?php


class MovieController
{

    /**
     * @api {Get} /api/movie/search    获取影片搜索列表
     * @apiName 获取影片搜索列表
     * @apiGroup 影片相关
     * @apiDescription 获取影片搜索列表
     *
     * @apiParam {String} keyword  关键词
     * @apiParam {Number} page 分页页码
     * @apiParam {Number} pageSize 分页长度
     *
     * @apiSuccess {Number}  page 分页页码
     * @apiSuccess {Number} pageSize 分页长度
     * @apiSuccess {Number} sum 数据总数
     * @apiSuccess {Object} actors 演员列表.
     * @apiSuccess {Number} actors.id 演员ID
     * @apiSuccess {Number} actors.name 演员名称
     * @apiSuccess {String} actors.photo 演员头像
     * @apiSuccess {String} actors.sex 演员性别
     * @apiSuccess {Object} actors.social_accounts 社交账号[]
     * @apiSuccess {String} actors.social_accounts.Twitter 社交账号一一对应
     * @apiSuccess {Number} actors.movie_sum 影片数量
     * @apiSuccess {Number} actors.like_sum 关注数量
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
     *
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "more": 1,
    "total": 1845,
    "video": [
    {
    "id": 13641,
    "number": "NAD-003",
    "name": "このギャル、俺の乳首係り 氷堂りりあ",
    "time": 460800,
    "release_time": "2021-05-31 23:40:51",
    "issued": "",
    "sell": "",
    "small_cover": "/javdb/small_cover/22f4070db2756e22b95154464579e98d.jpg",
    "big_cove": "/javdb/big_cove/9bb4de69be65f31f9cbed4a253abf014.jpg",
    "trailer": "/javdb/trailer/cb5e1d1319ebd6d2eabe10f92956a952.mp4",
    "map": "[\"\\/javdb\\/map\\/1be03ae3ad1e6ea474a5044b069bb14e.jpg\",\"\\/javdb\\/map\\/46ffc100a5fefb8b968b76ea724503c8.jpg\",\"\\/javdb\\/map\\/658198ab3a702148779cb52d410ba321.jpg\",\"\\/javdb\\/map\\/2010b5bfdfa2f851baf46a187217d9fd.jpg\",\"\\/javdb\\/map\\/b317879638ef4740d98046ececb4aa33.jpg\",\"\\/javdb\\/map\\/fbeda9f4bac5d1609389b8f9cdc05a10.jpg\",\"\\/javdb\\/map\\/42cc62e130989c6f5e71556ea9ece840.jpg\",\"\\/javdb\\/map\\/b16cefda3fcc5d472caf285ae11c15fd.jpg\",\"\\/javdb\\/map\\/85266d1647ed74894391dbe355500ac5.jpg\",\"\\/javdb\\/map\\/6cc10a926615a42d5b97e7dfe541a464.jpg\",\"\\/javdb\\/map\\/a116fb83103277aba028dd1cb1897555.jpg\",\"\\/javdb\\/map\\/32e9d5381a53af08b6b3cd88f02c197c.jpg\",\"\\/javdb\\/map\\/8e958377b04c1d5c35946bc507c521dc.jpg\",\"\\/javdb\\/map\\/596d122d4f915667a343dbf9f7494e0d.jpg\",\"\\/javdb\\/map\\/441f86b1a692f50d683a4cbc31096784.jpg\",\"\\/javdb\\/map\\/874b27d646ef6499e14b66565ec085b8.jpg\",\"\\/javdb\\/map\\/8c60d8188da441e28e9c8866e868c4a0.jpg\",\"\\/javdb\\/map\\/3fa69cc1a645796d73414c7f5e69b6e7.jpg\",\"\\/javdb\\/map\\/3b2290ff788e8d633b2ce5b1fba0827e.jpg\",\"\\/javdb\\/map\\/f6e10e99573ce4a6f1c4a2a9562949a3.jpg\"]",
    "score": 0,
    "score_people": 1,
    "comment_num": 1,
    "collection_score": 10,
    "collection_score_people": 4,
    "collection_comment_num": 1,
    "wan_see": 0,
    "seen": 0,
    "flux_linkage_num": 2,
    "flux_linkage":"[{\"name\":\"NAD-003\",\"url\":\"magnet:?xt=urn:btih:c2af88bcc3e33e8e9bb0ac4571df9a59f5af0418&dn=[javdb.com]NAD-003\",\"is-small\":\"\高\清\",\"is-warning\":null,\"tooltip\":null,\"meta\":\"(5.33GB,3\個\文\件)\"},{\"name\":\"nad-003.torrent\",\"url\":\"magnet:?xt=urn:btih:8f006a6af630199f25a65b6e0279a66d4e354745&dn=[javdb.com]nad-003.torrent\",\"is-small\":\"\高\清\",\"is-warning\":null,\"tooltip\":null,\"meta\":\"(5.23GB,6\個\文\件)\"}]",
    "status": 1,
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_up": 1,
    "is_short_comment": 1,
    "new_comment_time": "2021-05-31 23:41:02",
    "flux_linkage_time": "2021-05-31 23:41:02",
    "oid": 13641,
    "created_at": "2021-05-31 23:41:02",
    "updated_at": "2021-05-31 23:41:02",
    "actors": [
    {
    "id": 4047,
    "name": "氷堂りりあ",
    "photo": "",
    "sex": "♀",
    "oid": 4047,
    "social_accounts": "[]",
    "movie_sum": 15,
    "like_sum": 0,
    "status": 1,
    "created_at": "2021-05-31 16:10:49",
    "updated_at": "2021-05-31 23:41:02",
    "pivot": {
    "mid": 13641,
    "aid": 4047
    }
    }
    ],
    "directors": [
    {
    "id": 567,
    "name": "松方ピロム",
    "movie_sum": 1,
    "like_sum": 0,
    "status": 1,
    "oid": 568,
    "created_at": "2021-05-31 23:40:58",
    "updated_at": "2021-05-31 23:41:02",
    "pivot": {
    "mid": 13641,
    "did": 567
    }
    }
    ]
    },
    {
    "id": 10619,
    "number": "TIKB-110",
    "name": "金玉からっぽ金曜日 りりたん 氷堂りりあ",
    "time": 482400,
    "release_time": "2021-05-31 16:15:35",
    "issued": "",
    "sell": "",
    "small_cover": "/javdb/small_cover/9f21fce784d9baac61b74e75d66776aa.jpg",
    "big_cove": "/javdb/big_cove/25a4028649ac7af4374f3ed124126e33.jpg",
    "trailer": "",
    "map": "[\"\\/javdb\\/map\\/d6e777b07d1fd02e0203273fad34f7d8.jpg\",\"\\/javdb\\/map\\/03ac88624fbc8ef2605935456d7aa746.jpg\",\"\\/javdb\\/map\\/d9925b1fd8628094e222f6813a655f87.jpg\",\"\\/javdb\\/map\\/e745f6452823907b67fdd5272d06abbe.jpg\",\"\\/javdb\\/map\\/16c12cd35dd183f3a6493c13538b928e.jpg\",\"\\/javdb\\/map\\/2b34bf304fefa6845628d58a6a6e4c75.jpg\",\"\\/javdb\\/map\\/d70c1b05d2df4306d5b22c845abda163.jpg\",\"\\/javdb\\/map\\/2a48d1a85ae456170afa50bb41ecc51f.jpg\",\"\\/javdb\\/map\\/53acf315eb4c607867f677d80e41d8a5.jpg\",\"\\/javdb\\/map\\/104b8da2e229c8918165259a397c9945.jpg\",\"\\/javdb\\/map\\/e5a068fb495033e7ca65ca6f0cb1235b.jpg\",\"\\/javdb\\/map\\/d6b4f096019fc38a62ae77528d75558e.jpg\",\"\\/javdb\\/map\\/62edc717573b7741e2afad64e11ce00e.jpg\",\"\\/javdb\\/map\\/455de9f5fd545f37b1d4506e6f322aba.jpg\",\"\\/javdb\\/map\\/25bda842092d6ad49513253909142515.jpg\",\"\\/javdb\\/map\\/8e751df071ac864bb7f68ab720f5006a.jpg\"]",
    "score": 0,
    "score_people": 0,
    "comment_num": 0,
    "collection_score": 0,
    "collection_score_people": 0,
    "collection_comment_num": 0,
    "wan_see": 0,
    "seen": 0,
    "flux_linkage_num": 2,
    "flux_linkage":"[{\"name\":\"TIKB-110\",\"url\":\"magnet:?xt=urn:btih:24c89a1538c95c3e0f2613552d67662e2c1a6664&dn=[javdb.com]TIKB-110\",\"is-small\":\"\高\清\",\"is-warning\":null,\"tooltip\":null,\"meta\":\"(5.60GB)\"},{\"name\":\"kpxvs-TIKB110\",\"url\":\"magnet:?xt=urn:btih:c79c25d8b8f961e4445dc4fe8ce06c3bd1779c71&dn=[javdb.com]kpxvs-TIKB110\",\"is-small\":null,\"is-warning\":null,\"tooltip\":null,\"meta\":\"(1.47GB)\"}]",
    "status": 1,
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_up": 1,
    "is_short_comment": 1,
    "new_comment_time": "2021-05-31 16:22:30",
    "flux_linkage_time": "2021-05-31 16:22:30",
    "oid": 10619,
    "created_at": "2021-05-31 16:22:30",
    "updated_at": "2021-05-31 16:22:30",
    "actors": [
    {
    "id": 4047,
    "name": "氷堂りりあ",
    "photo": "",
    "sex": "♀",
    "oid": 4047,
    "social_accounts": "[]",
    "movie_sum": 15,
    "like_sum": 0,
    "status": 1,
    "created_at": "2021-05-31 16:10:49",
    "updated_at": "2021-05-31 23:41:02",
    "pivot": {
    "mid": 10619,
    "aid": 4047
    }
    }
    ],
    "directors": []
    }
    ]
    }
    }
     */
    public function search()
    {

    }



}
