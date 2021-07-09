<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class AnnouncementController extends  BaseController
{

    /**
     * @api {Post} /api/announcement/getAnnouncement 公告管理
     * @apiName  获取公告轮播
     * @apiGroup 网站管理
     * @apiDescription 根据类型获取公告轮播
     *
     * @apiParam {int} type  1:顶部轮播 2：内容轮播 3:消息轮播
     * @apiParam {int} page 页码 默认20一页
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示
     * @apiSuccess {count} count 数目
     * @apiSuccess {type}   type 1:顶部轮播 2：内容轮播 3:消息轮播
     * @apiSuccess {title}  title 标题
     * @apiSuccess {content} content 内容
     * @apiSuccess {string}   url 跳转链接
     * @apiSuccess {display_type}   display_type 显示方式 1.新窗口 2.内联打开
     *
     */
    public function getAnnouncement()
    {

    }






}
