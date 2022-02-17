<?php

class ArticleController
{

    /**
     * @api {Get} /api/article/list 话题列表
     * @apiName  获取话题列表
     * @apiGroup 话题管理
     * @apiDescription 获取话题列表
     *
     * @apiParam {int} page     页码 默认1
     * @apiParam {int} pageSize 页码 每页夺取多少条
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示
     * @apiSuccess {int} sum 数目
     * @apiSuccess {object}  list 列表
     * @apiSuccess {string}  list.id            话题id
     * @apiSuccess {string}  list.title         标题
     * @apiSuccess {string}  list.discription   描述
     * @apiSuccess {string}  list.thumb         图片
     * @apiSuccess {string}  list.link          外链视频
     * @apiSuccess {int}     list.ishot         是否热推
     * @apiSuccess {string}  list.update_at     更新时间
     */

    /**
     * @api {Get} /api/article/list 话题热推列表
     * @apiName  获取话题热推列表
     * @apiGroup 话题管理
     * @apiDescription 获取话题热推列表
     *
     * @apiParam {int} ishot    这里填写1
     * @apiParam {int} page     页码 默认1
     * @apiParam {int} pageSize 页码 填写10
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示
     * @apiSuccess {int} sum 数目
     * @apiSuccess {int} space 轮播播放间隔
     * @apiSuccess {object}  list 列表
     * @apiSuccess {string}  list.id            话题id
     * @apiSuccess {string}  list.title         标题
     * @apiSuccess {string}  list.discription   描述
     * @apiSuccess {string}  list.thumb         图片
     * @apiSuccess {string}  list.link          外链视频
     * @apiSuccess {int}     list.ishot         是否热推
     * @apiSuccess {int}     list.sort          排序
     * @apiSuccess {string}  list.update_at     更新时间
     */
    public function lsit()
    {

    }

    /**
     * @api {Post} /api/article/info 话题详情
     * @apiName  获取话题详情
     * @apiGroup 话题管理
     * @apiDescription 获取话题详情
     *
     * @apiParam {int} id    这里填写
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示
     * @apiSuccess {string}  id            话题id
     * @apiSuccess {string}  title         标题
     * @apiSuccess {string}  discription   描述
     * @apiSuccess {string}  thumb         图片
     * @apiSuccess {string}  link          外链视频
     * @apiSuccess {string}  content       话题内容
     * @apiSuccess {string}  update_at     更新时间
     * @apiSuccess {object}  label         话题标签
     * @apiSuccess {int}     label.id      标签id
     * @apiSuccess {int}     label.name    标签名称
     */
    public function info()
    {

    }

    /**
     * @api {Get} /api/article/related 话题相关列表
     * @apiName  获取话题相关列表
     * @apiGroup 话题管理
     * @apiDescription 获取话题相关列表
     *
     * @apiParam {int} int   话题id
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示
     * @apiSuccess {object}  list 列表
     * @apiSuccess {string}  list.id            话题id
     * @apiSuccess {string}  list.title         标题
     * @apiSuccess {string}  list.discription   描述
     * @apiSuccess {string}  list.thumb         图片
     * @apiSuccess {string}  list.link          外链视频
     * @apiSuccess {int}     list.ishot         是否热推
     * @apiSuccess {string}  list.update_at     更新时间
     */
    public function related()
    {

    }

}
