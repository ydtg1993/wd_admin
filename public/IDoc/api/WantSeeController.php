<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/16
 * Time: 9:39
 */


class WantSeeController
{
    /**
     * @api {Get} /api/user/wantsee/add 用户想看操作【添加】
     * @apiName 用户想看操作【添加】
     * @apiGroup 个人中心相关
     * @apiDescription 用户想看操作【添加】
     *
     * @apiParam {Number} mid 想看或者取消想看的影片ID
     *
     * @apiSuccess {Number} id 收藏ID
     *
     */
    public function add()
    {

    }

    /**
     * @api {Get} /api/user/wantsee/del 用户想看操作【删除】
     * @apiName 用户想看操作【删除】
     * @apiGroup 个人中心相关
     * @apiDescription 用户想看操作【删除】
     *
     * @apiParam {Number} mid 想看或者取消想看的影片ID
     *
     * @apiSuccess {Number} id 收藏ID
     *
     */
    public function del()
    {

    }

}
