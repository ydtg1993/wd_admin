<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class ToolController extends  BaseController
{

    /**
     * @api {Post} /api/file/uploadProfilePhoto 上传头像
     * @apiName  上传头像
     * @apiGroup 工具接口
     * @apiDescription 上传头像
     *
     * @apiParam {file} file
     * @apiParam {String} token token
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     *    * @apiSuccessExample  {json} success-example
        {
            "code": 200,
            "msg": "成功！",
            "data": "/public/uploads/local/profile_photo/2021-06-22_1624359988_60d1c434b68ce.png"//头像图片路径
        }

     */
    public function uploadProfilePhoto()
    {

    }
    /**
     * @api {Get} /captcha/api/math 图形验证码
     * @apiName  图形验证码
     * @apiGroup 工具接口
     * @apiDescription 发送图形验证码
     *
     *
     *
     *    * @apiSuccessExample  {json} success-example
    {
        "sensitive": false,
        "key": "eyJpdiI6ImtmMlY0emowd3I1VEo1NVVSbE9scEE9PSIsInZhbHVlIjoieUxnaDdLTXVsRlBjR3NiZ3EzcFduMW9qcGtoYVAxMHVGSTgzMnJwM3g1OHdFS2FwYzNGdUthMExDTEpLdWFWNWxLN2sxQStEMjJkZ0YzY09iZUswM1wvZjhtNExIZFZVUWk0dHpDOWF5Q
     * TBZPSIsIm1hYyI6ImMyOGU4OWIyYjdlOTQ2ZDU4NzljYmVjYTI4MGQwYzdlMjQ0OWFlYTNkYzc4OTViMTBjMWNhZjAxZjJmMDQ5YzIifQ==",//图形验证码的key
        "img": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAAkCA"//图形验证码路径
    }
     */
    public function sendCaptcha()
    {

    }










}