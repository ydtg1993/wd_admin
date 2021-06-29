<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class ConfController extends  BaseController
{

    /**
     * @api {get} /api/conf/getAllConf 基础信息
     * @apiName  获取基础信息
     * @apiGroup 网站管理
     * @apiDescription 获取后台配置的招商广告等基础信
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
     * {
     *       "code": 200,
     *       "msg": "成功！",
     *       "data": {
     *       "ad_investment": {//广告招商 type=1
     *           "url": "222",
     *           "email": "1133"
     *       },
     *       "download_setting": {//下载本站app链接 type=2
     *           "url": "334"
     *       },
     *       "about_us": {//关于我们 type=3
     *           "url": "4456",
     *           "content": "<p>44</p>"//内容 富文本形式
     *       },
     *       "friend_link": [//友情链接 type=4
     *       {
     *           "name": "2",//链接名字
     *           "url": "2"//链接
     *       },
     *       {
     *           "name": "2",//链接名字
     *           "url": "2"//链接
     *       },
     *       {
     *           "name": "2",//链接名字
     *           "url": "2"//链接
     *       }
     *       ],
     *       "private_item": {//隐私信息 type=5
     *           "url": "33555",
     *           "content": "<p>444666</p>"//内容富文本
     *       },
     *       "magnet_link": {//磁力使用教程 type=6
     *           "url": "55555566",//url
     *           "content": "<p>55566</p>"//内容富文本
     *           }
     *       }
     *   }
     */
    public function getAllConf()
    {

    }


  /**
   * @api {get} /api/conf/getOneConf 获取单个信息
   * @apiName  获取基础信息
   * @apiGroup 网站管理
   * @apiDescription 根据类型type获取单个信息 type=1 只返回一部分数据格式如上
   * @apiParam {int} type  type 1,2,3,4,5,6
   *
   * @apiSuccess {String} code 响应码 200 正确 其他错误 返回值格式参考如上
   * */
    public function getOneConf()
    {

    }



}
