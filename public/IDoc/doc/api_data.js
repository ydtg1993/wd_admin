define({ "api": [
  {
    "type": "Post",
    "url": "/api/file/uploadProfilePhoto",
    "title": "上传头像",
    "name": "上传头像",
    "group": "工具接口",
    "description": "<p>上传头像</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "file",
            "optional": false,
            "field": "file",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>响应码 200 正确 其他错误</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "success-example",
          "content": "{\n    \"code\": 200,\n    \"msg\": \"成功！\",\n    \"data\": \"/public/uploads/local/profile_photo/2021-06-22_1624359988_60d1c434b68ce.png\"//头像图片路径\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/ToolController.php",
    "groupTitle": "工具接口"
  },
  {
    "type": "Get",
    "url": "/captcha/api/math",
    "title": "图形验证码",
    "name": "图形验证码",
    "group": "工具接口",
    "description": "<p>发送图形验证码</p>",
    "success": {
      "examples": [
        {
          "title": "success-example",
          "content": "    {\n        \"sensitive\": false,\n        \"key\": \"eyJpdiI6ImtmMlY0emowd3I1VEo1NVVSbE9scEE9PSIsInZhbHVlIjoieUxnaDdLTXVsRlBjR3NiZ3EzcFduMW9qcGtoYVAxMHVGSTgzMnJwM3g1OHdFS2FwYzNGdUthMExDTEpLdWFWNWxLN2sxQStEMjJkZ0YzY09iZUswM1wvZjhtNExIZFZVUWk0dHpDOWF5Q\nTBZPSIsIm1hYyI6ImMyOGU4OWIyYjdlOTQ2ZDU4NzljYmVjYTI4MGQwYzdlMjQ0OWFlYTNkYzc4OTViMTBjMWNhZjAxZjJmMDQ5YzIifQ==\",//图形验证码的key\n        \"img\": \"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAAkCA\"//图形验证码路径\n    }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/ToolController.php",
    "groupTitle": "工具接口"
  },
  {
    "type": "Get",
    "url": "/api/user/test",
    "title": "文档编写魔板案例【这个是访问API路径】",
    "name": "文档编写魔板案例【api名称】",
    "group": "测试相关【分组】",
    "description": "<p>文档编写魔板案例【分组】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "Id",
            "description": "<p>【入参】</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "desc",
            "description": "<p>【入参】</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Id",
            "description": "<p>id【出参】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "desc",
            "description": "<p>描述【出参】</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "obj",
            "description": "<p>描述对象.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "obj.id",
            "description": "<p>对象id【出参】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "obj.desc",
            "description": "<p>对象描述【出参】</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "obj.descs",
            "description": "<p>对象描述数组【出参】</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "descs",
            "description": "<p>描述数组【出参】</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserController.php",
    "groupTitle": "测试相关【分组】"
  },
  {
    "type": "Get",
    "url": "/api/user/sendVerifyCode",
    "title": "发送验证码",
    "name": "发送验证码",
    "group": "用户相关",
    "description": "<p>发送验证码【发送前需要验证图形验证码】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "emailOrPhone",
            "description": "<p>邮箱或者电话</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>图形验证码的key</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "captcha",
            "description": "<p>图形验证码</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>响应码 200 正确 其他错误</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "msg",
            "description": "<p>错误提示</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserController.php",
    "groupTitle": "用户相关"
  },
  {
    "type": "Get",
    "url": "/api/user/reg",
    "title": "用户注册",
    "name": "用户注册",
    "group": "用户相关",
    "description": "<p>用户注册</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "account",
            "description": "<p>注册账号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pwd",
            "description": "<p>注册密码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>注册类型【1.手机】【2.邮箱】</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>验证吗 占时后台不验证</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>登录token</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserController.php",
    "groupTitle": "用户相关"
  },
  {
    "type": "Post",
    "url": "/api/user/changeUserInfo",
    "title": "修改用户信息",
    "name": "用户注册",
    "group": "用户相关",
    "description": "<p>修改用户信息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>用户昵称</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "sex",
            "description": "<p>用户性别 0未知 1男 2女</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "intro",
            "description": "<p>用户简介</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>用户手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>用户邮箱</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像图片路径</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "age",
            "description": "<p>用户年龄</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "le_phone_status",
            "description": "<p>手机认证状态 1.认证  2.未认证 【绑定手机时传1 反之2】</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "le_email_status",
            "description": "<p>邮箱认证状态 1.认证  2.未认证 【绑定邮箱时传1 反之2】</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "type",
            "description": "<p>用户类型 1普通用户 2运营账户 3 VIP会员</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "number",
            "description": "<p>用户识别码-本平台</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "status",
            "description": "<p>账号状态状态 1.正常  2.禁用/黑名单</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>用户手机号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>用户邮箱</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>用户昵称</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "sex",
            "description": "<p>用户性别 0未知 1男 2女</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>用户类型 1普通用户 2运营账户 3 VIP会员【这个后面可能需要调整】</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "age",
            "description": "<p>用户年龄</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "attention",
            "description": "<p>用户关注数量</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "fans",
            "description": "<p>用户粉丝数量</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "intro",
            "description": "<p>用户简介</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "le_phone_time",
            "description": "<p>手机认证时间</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "le_phone_status",
            "description": "<p>手机认证状态 1.认证  2.未认证</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "le_email_time",
            "description": "<p>邮箱认证时间</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "le_email_status",
            "description": "<p>邮箱认证状态 1.认证  2.未认证</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "login_ip",
            "description": "<p>登录ip</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserController.php",
    "groupTitle": "用户相关"
  },
  {
    "type": "Get",
    "url": "/api/user/login",
    "title": "用户登录",
    "name": "用户登录",
    "group": "用户相关",
    "description": "<p>用户登录</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "account",
            "description": "<p>登录账号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pwd",
            "description": "<p>登录密码 明文</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>登录token</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserController.php",
    "groupTitle": "用户相关"
  },
  {
    "type": "Get",
    "url": "/api/user/getUserInfo",
    "title": "获取用户信息",
    "name": "获取用户信息",
    "group": "用户相关",
    "description": "<p>获取用户信息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>登录token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "number",
            "description": "<p>用户识别码-本平台</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "status",
            "description": "<p>账号状态状态 1.正常  2.禁用/黑名单</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>用户手机号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>用户邮箱</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>用户昵称</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "sex",
            "description": "<p>用户性别 0未知 1男 2女</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>用户类型 1普通用户 2运营账户 3 VIP会员【这个后面可能需要调整】</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "age",
            "description": "<p>用户年龄</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "attention",
            "description": "<p>用户关注数量</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "fans",
            "description": "<p>用户粉丝数量</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "intro",
            "description": "<p>用户简介</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "le_phone_time",
            "description": "<p>手机认证时间</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "le_phone_status",
            "description": "<p>手机认证状态 1.认证  2.未认证</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "le_email_time",
            "description": "<p>邮箱认证时间</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "le_email_status",
            "description": "<p>邮箱认证状态 1.认证  2.未认证</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "login_ip",
            "description": "<p>登录ip</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserController.php",
    "groupTitle": "用户相关"
  },
  {
    "type": "Post",
    "url": "/api/report",
    "title": "举报信息",
    "name": "提交举报信息",
    "group": "网站管理",
    "description": "<p>提交举报信息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>token</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "reason",
            "description": "<p>主题</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "avid",
            "optional": false,
            "field": "avid",
            "description": "<p>番号</p>"
          },
          {
            "group": "Parameter",
            "type": "text",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>响应码 200 正确 其他错误</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "msg",
            "description": "<p>错误提示</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/ReportController.php",
    "groupTitle": "网站管理"
  },
  {
    "type": "Post",
    "url": "/api/complaint",
    "title": "意见反馈",
    "name": "提交意见反馈",
    "group": "网站管理",
    "description": "<p>意见反馈</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "topic",
            "description": "<p>主题</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Parameter",
            "type": "content",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          },
          {
            "group": "Parameter",
            "type": "connect",
            "optional": false,
            "field": "connect",
            "description": "<p>联系方式</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>响应码 200 正确 其他错误</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "msg",
            "description": "<p>错误提示</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/ComplaintController.php",
    "groupTitle": "网站管理"
  },
  {
    "type": "get",
    "url": "/api/announcement/getAnnouncement",
    "title": "公告管理",
    "name": "获取公告轮播",
    "group": "网站管理",
    "description": "<p>根据类型获取公告轮播</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "type",
            "description": "<p>top:顶部轮播 content：内容轮播 message:消息轮播</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>页码 默认20一页</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>响应码 200 正确 其他错误</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "msg",
            "description": "<p>错误提示</p>"
          },
          {
            "group": "Success 200",
            "type": "count",
            "optional": false,
            "field": "count",
            "description": "<p>数目</p>"
          },
          {
            "group": "Success 200",
            "type": "type",
            "optional": false,
            "field": "type",
            "description": "<p>1:顶部轮播 2：内容轮播 3:消息轮播</p>"
          },
          {
            "group": "Success 200",
            "type": "title",
            "optional": false,
            "field": "title",
            "description": "<p>标题</p>"
          },
          {
            "group": "Success 200",
            "type": "content",
            "optional": false,
            "field": "content",
            "description": "<p>内容</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "url",
            "description": "<p>跳转链接</p>"
          },
          {
            "group": "Success 200",
            "type": "display_type",
            "optional": false,
            "field": "display_type",
            "description": "<p>显示方式 1.新窗口 2.内联打开</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/AnnouncementController.php",
    "groupTitle": "网站管理"
  },
  {
    "type": "get",
    "url": "/api/conf/getOneConf",
    "title": "获取单个信息",
    "name": "获取基础信息",
    "group": "网站管理",
    "description": "<p>根据类型type获取单个信息 type=1 只返回一部分数据格式如上</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>type 1,2,3,4,5,6</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>响应码 200 正确 其他错误 返回值格式参考如上</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/ConfController.php",
    "groupTitle": "网站管理"
  },
  {
    "type": "get",
    "url": "/api/conf/getAllConf",
    "title": "基础信息",
    "name": "获取基础信息",
    "group": "网站管理",
    "description": "<p>获取后台配置的招商广告等基础信</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>响应码 200 正确 其他错误</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "success-example",
          "content": "{\n      \"code\": 200,\n      \"msg\": \"成功！\",\n      \"data\": {\n      \"ad_investment\": {//广告招商 type=1\n          \"url\": \"222\",\n          \"email\": \"1133\"\n      },\n      \"download_setting\": {//下载本站app链接 type=2\n          \"url\": \"334\"\n      },\n      \"about_us\": {//关于我们 type=3\n          \"url\": \"4456\",\n          \"content\": \"<p>44</p>\"//内容 富文本形式\n      },\n      \"friend_link\": [//友情链接 type=4\n      {\n          \"name\": \"2\",//链接名字\n          \"url\": \"2\"//链接\n      },\n      {\n          \"name\": \"2\",//链接名字\n          \"url\": \"2\"//链接\n      },\n      {\n          \"name\": \"2\",//链接名字\n          \"url\": \"2\"//链接\n      }\n      ],\n      \"private_item\": {//隐私信息 type=5\n          \"url\": \"33555\",\n          \"content\": \"<p>444666</p>\"//内容富文本\n      },\n      \"magnet_link\": {//磁力使用教程 type=6\n          \"url\": \"55555566\",//url\n          \"content\": \"<p>55566</p>\"//内容富文本\n          }\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/ConfController.php",
    "groupTitle": "网站管理"
  }
] });
