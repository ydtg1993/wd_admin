<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class UserController extends  BaseController
{
    /***
     * 【
     * 】 你面的是说明
     */
    /**
     * @api {Get} /api/user/test 文档编写魔板案例【这个是访问API路径】
     * @apiName 文档编写魔板案例【api名称】
     * @apiGroup 测试相关【分组】
     * @apiDescription 文档编写魔板案例【分组】
     *
     * @apiParam {Number} Id  【入参】
     * @apiParam {String} desc 【入参】
     *
     * @apiSuccess {Number} Id id【出参】
     * @apiSuccess {String} desc 描述【出参】
     * @apiSuccess {Object} obj 描述对象.
     * @apiSuccess {Number} obj.id 对象id【出参】
     * @apiSuccess {String} obj.desc 对象描述【出参】
     * @apiSuccess {array} obj.descs 对象描述数组【出参】
     * @apiSuccess {array} descs 描述数组【出参】
     *
     */
    public function test()
    {

    }

    /**
     * @api {Get} /api/user/login 用户登录
     * @apiName 用户登录
     * @apiGroup 用户相关
     * @apiDescription 用户登录
     *
     * @apiParam {String} account  登录账号
     * @apiParam {String} pwd 登录密码 明文
     *
     * @apiSuccess {String} token 登录token
     *
     */
    public function login(Request $request)
    {

    }

    /**
     * @api {Get} /api/user/reg 用户注册
     * @apiName 用户注册
     * @apiGroup 用户相关
     * @apiDescription 用户注册
     *
     * @apiParam {String} account  注册账号
     * @apiParam {String} pwd 注册密码
     * @apiParam {Number} type 注册类型【1.手机】【2.邮箱】
     * @apiParam {String} code 验证吗 占时后台不验证
     *
     * @apiSuccess {String} token 登录token
     *
     */
    public function register(Request $request)
    {

    }

    /**
     * @api {Post} /api/user/changeUserInfo 修改用户信息
     * @apiName 用户注册
     * @apiGroup 用户相关
     * @apiDescription 修改用户信息
     *
     * @apiParam {String} nickname 用户昵称
     * @apiParam {int} sex 用户性别 0未知 1男 2女
     * @apiParam {string} intro 用户简介
     * @apiParam {string} phone 用户手机号
     * @apiParam {string} email 用户邮箱
     * @apiParam {String} nickname 用户昵称
     * @apiParam {string} avatar 头像图片路径
     * @apiParam {int} age 用户年龄
     * @apiParam {int} le_phone_status 手机认证状态 1.认证  2.未认证 【绑定手机时传1 反之2】
     * @apiParam {int} le_email_status 邮箱认证状态 1.认证  2.未认证 【绑定邮箱时传1 反之2】
     * @apiParam {string} type 用户类型 1普通用户 2运营账户 3 VIP会员
     * @apiParam {String} token token
     *
     *
     * @apiSuccess {String} number 用户识别码-本平台
     * @apiSuccess {int} status 账号状态状态 1.正常  2.禁用/黑名单
     * @apiSuccess {string} phone 用户手机号
     * @apiSuccess {String} email 用户邮箱
     * @apiSuccess {String} nickname 用户昵称
     * @apiSuccess {int} sex 用户性别 0未知 1男 2女
     * @apiSuccess {int} type 用户类型 1普通用户 2运营账户 3 VIP会员【这个后面可能需要调整】
     * @apiSuccess {int} age 用户年龄
     * @apiSuccess {int} attention 用户关注数量
     * @apiSuccess {int} fans 用户粉丝数量
     * @apiSuccess {string} avatar 头像
     * @apiSuccess {string} intro 用户简介
     * @apiSuccess {string} le_phone_time 手机认证时间
     * @apiSuccess {int} le_phone_status 手机认证状态 1.认证  2.未认证
     * @apiSuccess {string} le_email_time 邮箱认证时间
     * @apiSuccess {int} le_email_status 邮箱认证状态 1.认证  2.未认证
     * @apiSuccess {string} login_ip 登录ip
     *
     */
    public function changeUserInfo(Request $request)
    {

    }



    /**
     * @api {Get} /api/user/getUserInfo 获取用户信息
     * @apiName 获取用户信息
     * @apiGroup 用户相关
     * @apiDescription 获取用户信息
     *
     * @apiParam {String} token 登录token
     *
     * @apiSuccess {String} number 用户识别码-本平台
     * @apiSuccess {int} status 账号状态状态 1.正常  2.禁用/黑名单
     * @apiSuccess {string} phone 用户手机号
     * @apiSuccess {String} email 用户邮箱
     * @apiSuccess {String} nickname 用户昵称
     * @apiSuccess {int} sex 用户性别 0未知 1男 2女
     * @apiSuccess {int} type 用户类型 1普通用户 2运营账户 3 VIP会员【这个后面可能需要调整】
     * @apiSuccess {int} age 用户年龄
     * @apiSuccess {int} attention 用户关注数量
     * @apiSuccess {int} fans 用户粉丝数量
     * @apiSuccess {string} avatar 头像
     * @apiSuccess {string} intro 用户简介
     * @apiSuccess {string} le_phone_time 手机认证时间
     * @apiSuccess {int} le_phone_status 手机认证状态 1.认证  2.未认证
     * @apiSuccess {string} le_email_time 邮箱认证时间
     * @apiSuccess {int} le_email_status 邮箱认证状态 1.认证  2.未认证
     * @apiSuccess {string} login_ip 登录ip
     *
     *
     */
    public function getUserInfo(Request $request)
    {

    }


    /**
     * @api {Get} /api/user/sendVerifyCode 发送验证码
     * @apiName 发送验证码
     * @apiGroup 用户相关
     * @apiDescription 发送验证码【发送前需要验证图形验证码】
     *
     * @apiParam {String} emailOrPhone 邮箱或者电话
     * @apiParam {String} key 图形验证码的key
     * @apiParam {String} captcha 图形验证码
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示

     *
     *
     */
    public function sendVerifyCodes(Request $request)
    {

    }












}
