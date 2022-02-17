<?php

class LabelController
{

    /**
     * @api {Post} /api/label/category 标签分类
     * @apiName  获取标签分类
     * @apiGroup 影片标签
     * @apiDescription 获取标签分类列表
     *     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示
     * @apiSuccess {Object} data 列表【数组】
     * @apiSuccess {Number} data.id 分类ID
     * @apiSuccess {String} data.name 分类名称
     *
     */
    public function category()
    {

    }

    /**
     * @api {Post} /api/label/list 标签列表
     * @apiName  获取标签列表
     * @apiGroup 影片标签
     * @apiDescription 获取标签列表
     *
     * @apiParam {int} cid  标签分类id
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示
     * @apiSuccess {Object} data 列表【数组】
     * @apiSuccess {Number} data.id 父标签id
     * @apiSuccess {String} data.name 父标签名称
     * @apiSuccess {Number} data.cids 父标签所属分类id
     * @apiSuccess {Object} data.children 子标签【数组】
     * @apiSuccess {Number} data.children.id 子标签id
     * @apiSuccess {String} data.children.name 子标签名称
     * @apiSuccess {Number} data.children.parent_id 子标签所属父标签id
     *
     */
    public function list()
    {

    }


}
