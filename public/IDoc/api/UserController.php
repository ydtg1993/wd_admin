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
     * @api {Post} /api/user/login 用户登录
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
     * @api {Post} /api/user/reg 用户注册
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


    /**
     * @api {get} /api/notify/getNotifyList 消息通知列表
     * @apiName  消息通知列表
     * @apiGroup 用户相关
     * @apiDescription 获取消息通知列表
     *
     * @apiParam {String} token 登录token
     * @apiParam {int} type 消息类型 1.赞2.踩3.我的评论4.回复我的【5.关注99.公告内容 系统占时无】
     * @apiParam {int} isRead 是否已读 0.未读 1.已读
     * @apiParam {int} page 页码
     * @apiParam {int} pageSize 每页数量
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccessExample  {json} success-example
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "list": [
        {
            "content": [
                "我的评论：香肠嘴把"//除去发送人一行的内容。当type=3 and type=4时数组长度位2 按原型顺序放置即可
            ],
            "id": 9,//批量删除和阅读传入
            "target_id": 948,
            "target_id": 948,
            "target_source_id": 7512,
            "is_read": 0,//是否已读
            "type": 2,//赞和踩的content格式一样
            "sender_id": 2,
            "sender_avatar": 'uploads/avatar/my.jpg',//头像路径
            "sender_name": "user"//发送人的昵称
        },
        {
            "content": [
                "我的评论：封面很像橘波留"
            ],
            "target_id": 949,
            "target_source_id": 7513,
            "is_read": 0,
            "type": 4,//回复我的
            "sender_id": 3,
            "sender_name": "user"
            },
            {
            "content": [
                "原以为是仓多真央，看完出演员名字才知道是大岛。",
                "我的评论：那个负责清理的。。。看着有点恶心"
            ],
            "target_id": 953,
            "target_source_id": 7514,
            "is_read": 0,
            "type": 3,
            "sender_id": 1,
            "sender_name": "user"
        },
        {
            "content": [
                "相马茜的长相真是长到我的审美上了。",
                "影片番号：FC2-1729752 ※無※旦那様すいません( ;∀;)人妻KUREHA出産直前妊娠8か月！最後の濃厚不倫生ハメSEXで鬼イキ♡"
            ],
            "target_id": 954,
            "target_source_id": 7515,
            "is_read": 0,
            "type": 3,//评价
            "sender_id": 2,
            "sender_name": "user"
            },
            {
            "content": [
                "我的评论：被艹时候的样子太丑了。"
            ],
            "target_id": 955,
            "target_source_id": 7516,
            "is_read": 0,
            "type": 2,
            "sender_id": 2,
            "sender_name": "user"
        },
        ],
        "count": 10
        }
    }

     */


    /**
     * @api {Post} /api/notify/setRead 设置消息已读
     * @apiName 设置消息已读
     * @apiGroup 用户相关
     * @apiDescription 设置消息已读
     *
     * @apiParam {String} token 登录token
     * @apiParam {int} id 消息主键id
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示

     *
     *
     */
    public function setRead(Request $request)
    {

    }

    /**
     * @api {Post} /api/notify/delete 删除消息
     * @apiName 删除消息
     * @apiGroup 用户相关
     * @apiDescription 删除消息
     *
     * @apiParam {String} token 登录token
     * @apiParam {array} ids[] 主键id数组
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示

     *
     *
     */
    public function delete(Request $request)
    {

    }


    /**
     * @api {Post} api/user/forgetPassword 忘记密码
     * @apiName 忘记密码
     * @apiGroup 用户相关
     * @apiDescription 忘记密码
     *
     * @apiParam {String} account 账号
     * @apiParam {String} pwd 密码【明文】
     * @apiParam {String} code 短信或者邮箱验证码
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     * @apiSuccess {String} msg 错误提示

     *
     *
     */
    public function forgetPassword(Request $request)
    {

    }








}
