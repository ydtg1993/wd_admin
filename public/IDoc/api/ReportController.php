<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class ReportController
{


    /**
     * @api {Post} /api/report 举报信息
     * @apiName 提交举报信息
     * @apiGroup 网站管理
     * @apiDescription 提交举报信息
     * @apiParam {String} token token
     *
     *
     * @apiParam {String} reason  主题
     * @apiParam {String} title 标题
     * @apiParam {avid} avid 番号
     * @apiParam {text} content 内容【格式用户昵称+冒号+评论内容】
     * @apiParam {string} key 图形验证码key【开启了图形验证码】
     * @apiParam {string} captcha 验证码
     *
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示
     *
     */
    public function saveReport()
    {

    }






}
