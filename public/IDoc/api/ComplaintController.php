<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class ComplaintController extends  BaseController
{

    /**
     * @api {Post} /api/complaint 意见反馈
     * @apiName 提交意见反馈
     * @apiGroup 网站管理
     * @apiDescription 意见反馈
     *
     * @apiParam {String} topic  主题
     * @apiParam {String} title 标题
     * @apiParam {content} content 内容
     * @apiParam {connect} connect 联系方式
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示
     *
     */
    public function saveComplaint()
    {

    }






}
