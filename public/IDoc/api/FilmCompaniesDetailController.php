<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class FilmCompaniesDetailController extends  BaseController
{
    /**
     * @api {Post} /api/company/detail 公司信息
     * @apiName 公司信息
     * @apiGroup 公司详情
     * @apiDescription 公司信息
     * @apiHeader {String} token  【header头传输 可以不传】
     *
     * @apiParam {Number} id  【公司id】
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "id": 1,
    "name": "Vixen Group",
    "movie_sum": 336,
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
     * @api {Post} /api/company/products 公司作品列表
     * @apiName 公司作品列表
     * @apiGroup 公司详情
     * @apiDescription 公司作品列表
     *
     * @apiParam {Number} id  【公司id】
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
    "sum": 9380,
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
    "id": 11974,
    "name": "オイル性感マッサージに嵌る人妻",
    "number": "122619_226",
    "release_time": "2021-05-30 02:34:35",
    "created_at": "2021-05-30T02:44:31.000000Z",
    "is_download": 2,
    "is_subtitle": 1,
    "is_hot": 1,
    "is_new_comment": 2,
    "is_flux_linkage": 2,
    "comment_num": 0,
    "score": 0,
    "small_cover": "/javdb/small_cover/cbd4dbe60597bc0275d80a1ada140ba0.jpg",
    "big_cove": "/javdb/big_cove/65b3d40d046c97620c4bbf68ea6ae05a.jpg"
    }
    ]
    }
    }
     */
    public function products()
    {

    }
}
