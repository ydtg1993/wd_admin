<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class ConfController
{

    /**
     * @api {get} /api/conf/getAllConf 所有基础信息
     * @apiName  获取所有基础信息
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
     *      "comment_notes": {//短评须知 type=7
     *           "isopen": "1",    //开关 1=开；2=关
     *           "countdown":"5"   //关闭倒计时（秒）
     *           "content": "<p>55566</p>"//内容富文本
     *           }
     *       }
     *       "first_login": {//登陆提示 type=8
     *           "content": "<p>444666</p>"//内容富文本
     *       },
     *       "app_share": {//app分享 type=9
     *           "content": "<p>444666</p>"//内容富文本
     *       },
     *   }
     */
    public function getAllConf()
    {

    }


  /**
   * @api {get} /api/conf/getOneConf 单个基础信息
   * @apiName  获取一条基础信息
   * @apiGroup 网站管理
   * @apiDescription 根据类型type获取单个信息 type=1 只返回一部分数据格式如上 example:/api/conf/getOneConf/1
   * @apiParam {int} type  type 1,2,3,4,5,6,7
   *
   * @apiSuccess {String} code 响应码 200 正确 其他错误 返回值格式参考如上
   * */
    public function getOneConf()
    {

    }

   /**
   * @api {get} /api/conf/firstlogin 首次登陆须知
   * @apiName  获取一条基础信息
   * @apiGroup 网站管理
   *
   * @apiSuccess {String} code 响应码 200 正确 其他错误 返回值格式参考如上
   * */
    public function firstLogin()
    {

    }
    /**
   * @api {get} /api/conf/appshare  app分享
   * @apiName  获取一条基础信息
   * @apiGroup 网站管理
   *
   * @apiSuccess {String} code 响应码 200 正确 其他错误 返回值格式参考如上
   * */
    public function appshare()
    {

    }

  /**
   * @api {get} /api/conf/domain  获取后台配置的域名列表
   * @apiName  获取后台配置的域名列表
   * @apiGroup 网站管理
   * @apiDescription 获取后台配置的域名列表
   *
   * @apiSuccess {string} code 响应码 200 正确 其他错误 返回值格式参考如上
   * @apiSuccess {list} data 数据列表
   *
   * */
    public function domain()
    {

    }

    /**
   * @api {post} /api/ads/list  获取广告列表
   * @apiName  获取广告列表
   * @apiGroup 网站管理
   * @apiDescription 获取广告列表
   * @apiParam {String} type  top=顶部位置；left=左对联；right=右对联；foot=底部
   *
   * @apiSuccess {String} code 响应码 200 正确 其他错误 返回值格式参考如上
   * @apiSuccess {list} data 数据列表
   * @apiSuccess {Number} list.id       广告id
   * @apiSuccess {String} list.location 广告位
   * @apiSuccess {String} list.photo    图片
   * @apiSuccess {String} list.url      链接
   * @apiSuccess {String} list.is_close 是否可关 1=能关闭；2=不可关
   *
   * */
    public function ads()
    {

    }


}
