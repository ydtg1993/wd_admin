<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/16
 * Time: 9:39
 */


class UserSeenController
{
    /**
     * @api {Get} /api/user/seen/add 用户看过添加
     * @apiName 用户看过操作【添加】
     * @apiGroup 个人中心相关
     * @apiDescription 用户看过操作【添加】
     *
     * @apiParam {Number} validate  网易验证码
     * @apiParam {Number} mid  操作的影片
     * @apiParam {Number} score  评分1-10
     * @apiParam {String} comment  评论
     *
     * @apiSuccess {Number} id 操作的ID
     * @apiSuccess {string} warning 当碰到过滤词时，提示的警告
     *
     */
    public function add(Request $request)
    {

    }

    /**
     * @api {Get} /api/user/seen/get 用户看过读取之前数据
     * @apiName 用户看过操作【读取之前数据】
     * @apiGroup 个人中心相关
     * @apiDescription 用户看过操作【读取之前数据】
     *
     * @apiParam {Number} mid  操作的影片
     *
     * @apiSuccess {Number} score 评分
     * @apiSuccess {String} comment 评论
     *
     */
    public function get(Request $request)
    {

    }

    /**
     * @api {Get} /api/user/seen/edit 用户看过修改
     * @apiName 用户看过操作【修改】
     * @apiGroup 个人中心相关
     * @apiDescription 用户看过操作【修改】
     *
     * @apiParam {Number} mid  操作的影片
     * @apiParam {Number} score  评分1-10
     * @apiParam {String} comment  评论
     *
     * @apiSuccess {Number} id 操作的ID
     *
     */
    public function edit(Request $request)
    {

    }

    /**
     * @api {Get} /api/user/seen/del 用户看过删除
     * @apiName 用户看过操作【删除】
     * @apiGroup 个人中心相关
     * @apiDescription 用户看过操作【删除】
     *
     * @apiParam {Number} mid  操作的影片
     * @apiSuccess {string} warning 当碰到过滤词时，提示的警告
     *
     */
    public function del(Request $request)
    {

    }

    /**
     * @api {Post} /api/nologin/batch_hand_send 批量评论
     * @apiName 批量评论
     * @apiGroup 工具接口
     * @apiDescription 批量评论
     *
     * @apiParam {String} number  影片番号
     * @apiParam {Json} data  json格式[{"username":"{用户昵称}","comment":"{评论内容}","child":[{"username":"{用户昵称}","comment":"{回复评论}"]}]
     *
     * @apiSuccess {Number} code 200=操作完成
     * @apiSuccess {String} msg 错误提示
     * @apiSuccess {String} warning 警告
     */
    public function batch_hand_send(Request $request)
    {

    }
   
}
