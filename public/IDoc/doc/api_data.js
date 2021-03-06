define({ "api": [
  {
    "type": "Get",
    "url": "/api/user/add/action",
    "title": "浏览影片记录",
    "name": "浏览影片记录",
    "group": "个人中心相关",
    "description": "<p>浏览影片记录</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传1【必须是1】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>浏览的影片列表</p>"
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
            "field": "id",
            "description": "<p>收藏ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/add/action",
    "title": "用户导演操作【收藏或者取消收藏】",
    "name": "用户导演操作【收藏或者取消收藏】",
    "group": "个人中心相关",
    "description": "<p>用户导演操作【收藏或者取消收藏】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传6【必须是6】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "did",
            "description": "<p>收藏或者取消收藏的导演ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>操作动作【1.收藏、2.取消收藏】</p>"
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
            "field": "id",
            "description": "<p>收藏ID.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/wantsee/del",
    "title": "用户想看操作【删除】",
    "name": "用户想看操作【删除】",
    "group": "个人中心相关",
    "description": "<p>用户想看操作【删除】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>想看或者取消想看的影片ID</p>"
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
            "field": "id",
            "description": "<p>收藏ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/WantSeeController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/wantsee/add",
    "title": "用户想看操作【添加】",
    "name": "用户想看操作【添加】",
    "group": "个人中心相关",
    "description": "<p>用户想看操作【添加】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>想看或者取消想看的影片ID</p>"
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
            "field": "id",
            "description": "<p>收藏ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/WantSeeController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/add/action",
    "title": "用户演员操作【收藏或者取消收藏】",
    "name": "用户演员操作【收藏或者取消收藏】",
    "group": "个人中心相关",
    "description": "<p>用户演员操作【收藏或者取消收藏】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传5【必须是5】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "aid",
            "description": "<p>收藏或者取消收藏的演员ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>操作动作【1.收藏、2.取消收藏】</p>"
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
            "field": "id",
            "description": "<p>收藏ID.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/add/action",
    "title": "用户片单操作【创建、修改、收藏、删除】",
    "name": "用户片单操作【收藏或者取消收藏】",
    "group": "个人中心相关",
    "description": "<p>用户片单操作【收藏或者取消收藏】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传10【必须是10】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>创建方式【0.其他、1.简易创建、2.详细创建。仅status=1可用】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>操作动作【1.新增、2.删除、3.修改、4.收藏、5.取消收藏】</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "intro",
            "description": "<p>片单简介【可选】</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cover",
            "description": "<p>片单图【可选】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "authority",
            "description": "<p>权限【1.公开、2.仅自己可见】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "plid",
            "description": "<p>片单ID【修改、删除、收藏必须存在】</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>片单名称【与片单id一起传】</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "bool",
            "optional": false,
            "field": "data",
            "description": "<p>true成功</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/add/action",
    "title": "用户片商操作【收藏或者取消收藏】",
    "name": "用户片商操作【收藏或者取消收藏】",
    "group": "个人中心相关",
    "description": "<p>用户片商操作【收藏或者取消收藏】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传7【必须是7】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "film_companies_id",
            "description": "<p>收藏或者取消收藏的片商ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>操作动作【1.收藏、2.取消收藏】</p>"
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
            "field": "id",
            "description": "<p>收藏ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/add/action",
    "title": "用户番号操作【收藏或者取消收藏】",
    "name": "用户番号操作【收藏或者取消收藏】",
    "group": "个人中心相关",
    "description": "<p>用户番号操作【收藏或者取消收藏】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传8【必须是8】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "nid",
            "description": "<p>收藏或者取消收藏的番号ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>操作动作【1.收藏、2.取消收藏】</p>"
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
            "field": "id",
            "description": "<p>收藏ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/seen/edit",
    "title": "用户看过修改",
    "name": "用户看过操作【修改】",
    "group": "个人中心相关",
    "description": "<p>用户看过操作【修改】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>操作的影片</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>评分1-10</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "comment",
            "description": "<p>评论</p>"
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
            "field": "id",
            "description": "<p>操作的ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserSeenController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/seen/del",
    "title": "用户看过删除",
    "name": "用户看过操作【删除】",
    "group": "个人中心相关",
    "description": "<p>用户看过操作【删除】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>操作的影片</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "warning",
            "description": "<p>当碰到过滤词时，提示的警告</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserSeenController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/seen/add",
    "title": "用户看过添加",
    "name": "用户看过操作【添加】",
    "group": "个人中心相关",
    "description": "<p>用户看过操作【添加】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "validate",
            "description": "<p>网易验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>操作的影片</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>评分1-10</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "comment",
            "description": "<p>评论</p>"
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
            "field": "id",
            "description": "<p>操作的ID</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "warning",
            "description": "<p>当碰到过滤词时，提示的警告</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserSeenController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/seen/get",
    "title": "用户看过读取之前数据",
    "name": "用户看过操作【读取之前数据】",
    "group": "个人中心相关",
    "description": "<p>用户看过操作【读取之前数据】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>操作的影片</p>"
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
            "field": "score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "comment",
            "description": "<p>评论</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserSeenController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/add/action",
    "title": "用户粉丝操作【关注或者取消关注】",
    "name": "用户粉丝操作【关注或者取消关注】",
    "group": "个人中心相关",
    "description": "<p>用户粉丝操作【关注或者取消关注】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传4【必须是4】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "goal_id",
            "description": "<p>关注或者取消关注的用户ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>操作动作【1.关注、2.取消关注】</p>"
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
            "field": "id",
            "description": "<p>关注ID.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/add/action",
    "title": "用户系列操作【收藏或者取消收藏】",
    "name": "用户系列操作【收藏或者取消收藏】",
    "group": "个人中心相关",
    "description": "<p>用户系列操作【收藏或者取消收藏】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传9【必须是9】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "series_id",
            "description": "<p>收藏或者取消收藏的番号ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>操作动作【1.收藏、2.取消收藏】</p>"
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
            "field": "id",
            "description": "<p>收藏ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/give_score",
    "title": "电影点星评分",
    "name": "电影点星评分",
    "group": "个人中心相关",
    "description": "<p>电影点星评分</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>评分1-10</p>"
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
            "field": "score",
            "description": "<p>当前影片分数</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/getHomeUserAction",
    "title": "获取其他用户关注/粉丝列表",
    "name": "获取其他用户关注/粉丝列表",
    "group": "个人中心相关",
    "description": "<p>获取其他用户关注/粉丝列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传4【必须是4】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>想看或者取消想看的影片ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>获取动作【1.关注列表、2.粉丝列表】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>关注或者粉丝列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.nickname",
            "description": "<p>昵称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>用户ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.piece_list_num",
            "description": "<p>片单数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.seen_num",
            "description": "<p>看过数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_like",
            "description": "<p>是否关注1.关注，其他未关注</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/getHomeUserAction",
    "title": "获取其他用户浏览记录列表",
    "name": "获取其他用户浏览记录列表",
    "group": "个人中心相关",
    "description": "<p>获取其他用户浏览记录列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传1【必须是1】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>分类ID【1.有码、2.无码、3.欧美、4.FC2】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/getHomeUserAction",
    "title": "获取其他用户片单列表",
    "name": "获取其他用户片单列表",
    "group": "个人中心相关",
    "description": "<p>获取其他用户片单列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传10【必须是10】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>0.全部、1.创建、2.收藏</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "likeListSum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "likeList",
            "description": "<p>收藏片单列表</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.id",
            "description": "<p>id</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.uid",
            "description": "<p>创建的用户ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "likeList.name",
            "description": "<p>片单名</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "likeList.cover",
            "description": "<p>片单图</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.like_sum",
            "description": "<p>收藏数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.pv_browse_sum",
            "description": "<p>浏览次数</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "likeList.intro",
            "description": "<p>片单描述</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.is_hot",
            "description": "<p>是否热门【暂时好像没用】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.authority",
            "description": "<p>权限1公开2私有</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.type",
            "description": "<p>类型1.用户创建.2.系统管理员创建、3.用户默认</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "likeList.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.a_id",
            "description": "<p>关联ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createListsum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "createList",
            "description": "<p>创建片单列表</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.id",
            "description": "<p>id</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.uid",
            "description": "<p>创建的用户ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "createList.name",
            "description": "<p>片单名</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "createList.cover",
            "description": "<p>片单图</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.like_sum",
            "description": "<p>收藏数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.pv_browse_sum",
            "description": "<p>浏览次数</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "createList.intro",
            "description": "<p>片单描述</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.is_hot",
            "description": "<p>是否热门【暂时好像没用】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.authority",
            "description": "<p>权限1公开2私有</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.type",
            "description": "<p>类型1.用户创建.2.系统管理员创建、3.用户默认</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "createList.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.a_id",
            "description": "<p>关联ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Get",
    "url": "/api/user/getHomeUser",
    "title": "获取用户主页信息",
    "name": "获取用户主页信息",
    "group": "个人中心相关",
    "description": "<p>获取用户主页信息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>要获取的用户ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "userInfo",
            "description": "<p>用户列表.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.phone",
            "description": "<p>手机</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.email",
            "description": "<p>邮箱</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "userInfo.nickname",
            "description": "<p>昵称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "userInfo.sex",
            "description": "<p>性别 0.未知 1.男 2.女</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "userInfo.age",
            "description": "<p>年龄</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "userInfo.attention",
            "description": "<p>关注数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.fans",
            "description": "<p>粉丝数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.intro",
            "description": "<p>简介</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.user_id",
            "description": "<p>用户ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.user_attention",
            "description": "<p>是否被该用户关注【1.是、2.否】</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户关注/粉丝列表",
    "name": "获取用户关注/粉丝列表",
    "group": "个人中心相关",
    "description": "<p>获取用户关注/粉丝列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传4【必须是4】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>想看或者取消想看的影片ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>获取动作【1.关注列表、2.粉丝列表】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>关注或者粉丝列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.nickname",
            "description": "<p>昵称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>用户ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.piece_list_num",
            "description": "<p>片单数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.seen_num",
            "description": "<p>看过数量</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户想看记录列表",
    "name": "获取用户想看记录列表",
    "group": "个人中心相关",
    "description": "<p>获取用户想看记录列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传2【必须是2】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>分类ID【1.有码、2.无码、3.欧美、4.FC2】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>排序0.默认排序、1.加入时间排序、2.发布日期排序</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sortType",
            "description": "<p>排序方式【desc、asc】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户收藏导演列表",
    "name": "获取用户收藏导演列表",
    "group": "个人中心相关",
    "description": "<p>获取用户收藏导演列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传6【必须是6】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>导演列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>导演名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>导演ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数量</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户收藏演员列表",
    "name": "获取用户收藏演员列表",
    "group": "个人中心相关",
    "description": "<p>获取用户收藏演员列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传5【必须是5】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>关注或者粉丝列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>演员名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>演员ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.sex",
            "description": "<p>演员性别</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数量</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户收藏片商列表",
    "name": "获取用户收藏片商列表",
    "group": "个人中心相关",
    "description": "<p>获取用户收藏片商列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传7【必须是7】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>片商列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>片商名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>片商ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数量</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户收藏番号列表",
    "name": "获取用户收藏番号列表",
    "group": "个人中心相关",
    "description": "<p>获取用户收藏番号列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传8【必须是8】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>番号列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>番号名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>番号ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数量</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户收藏系列列表",
    "name": "获取用户收藏系列列表",
    "group": "个人中心相关",
    "description": "<p>获取用户收藏系列列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传9【必须是9】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>系列列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>系列名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>系列ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数量</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户浏览记录列表",
    "name": "获取用户浏览记录列表",
    "group": "个人中心相关",
    "description": "<p>获取用户浏览记录列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传1【必须是1】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户片单列表",
    "name": "获取用户片单列表",
    "group": "个人中心相关",
    "description": "<p>获取用户片单列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传10【必须是10】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>0.全部、1.创建、2.收藏</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "likeListSum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "likeList",
            "description": "<p>收藏片单列表</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.id",
            "description": "<p>id</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.uid",
            "description": "<p>创建的用户ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "likeList.name",
            "description": "<p>片单名</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "likeList.cover",
            "description": "<p>片单图</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.like_sum",
            "description": "<p>收藏数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.pv_browse_sum",
            "description": "<p>浏览次数</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "likeList.intro",
            "description": "<p>片单描述</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.is_hot",
            "description": "<p>是否热门【暂时好像没用】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.authority",
            "description": "<p>权限1公开2私有</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.type",
            "description": "<p>类型1.用户创建.2.系统管理员创建、3.用户默认</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "likeList.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "likeList.a_id",
            "description": "<p>关联ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createListsum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "createList",
            "description": "<p>创建片单列表</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.id",
            "description": "<p>id</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.uid",
            "description": "<p>创建的用户ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "createList.name",
            "description": "<p>片单名</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "createList.cover",
            "description": "<p>片单图</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.like_sum",
            "description": "<p>收藏数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.pv_browse_sum",
            "description": "<p>浏览次数</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "createList.intro",
            "description": "<p>片单描述</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.is_hot",
            "description": "<p>是否热门【暂时好像没用】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.authority",
            "description": "<p>权限1公开2私有</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.audit",
            "description": "<p>审核状态，1=审核通过；0=待审核；2=审核不通过</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.type",
            "description": "<p>类型1.用户创建.2.系统管理员创建、3.用户默认</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "createList.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "createList.a_id",
            "description": "<p>关联ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/user/get/action/list",
    "title": "获取用户看过记录列表",
    "name": "获取用户看过记录列表",
    "group": "个人中心相关",
    "description": "<p>获取用户看过记录列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "action_type",
            "description": "<p>动作类型传3【必须是3】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>分类ID【1.有码、2.无码、3.欧美、4.FC2】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>排序0.默认排序、1.加入时间排序、2.发布日期排序</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "score",
            "description": "<p>评分：0全部、【1 1-2】、【2 2-3】、【3 3-4】、【4 4-5 】、【5 5】</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sortType",
            "description": "<p>排序方式【desc、asc】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "个人中心相关"
  },
  {
    "type": "Post",
    "url": "/api/company/products",
    "title": "公司作品列表",
    "name": "公司作品列表",
    "group": "公司详情",
    "description": "<p>公司作品列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【公司id】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>【分页】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>【分页长度】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "filter",
            "description": "<p>【1.subtitle字幕 2.download已下载 3.comment新评】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>【1.release发布时间排序 2.linkage链接更新排序】</p>"
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"page\": \"1\",\n\"pageSize\": \"2\",\n\"sum\": 9380,\n\"list\": [\n{\n\"id\": 12894,\n\"name\": \"チーム木村番外編生挿入 -- 綺羅千沙斗\",\n\"number\": \"kb1599\",\n\"release_time\": \"2021-05-30 02:34:35\",\n\"created_at\": \"2021-05-30T02:46:16.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/19a1d1391e24d38156f4d9963b303540.jpg\",\n\"big_cove\": \"/javdb/big_cove/1aff3c8a06de43155efcebd08dd3bcac.jpg\"\n},\n{\n\"id\": 11974,\n\"name\": \"オイル性感マッサージに嵌る人妻\",\n\"number\": \"122619_226\",\n\"release_time\": \"2021-05-30 02:34:35\",\n\"created_at\": \"2021-05-30T02:44:31.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/cbd4dbe60597bc0275d80a1ada140ba0.jpg\",\n\"big_cove\": \"/javdb/big_cove/65b3d40d046c97620c4bbf68ea6ae05a.jpg\"\n}\n]\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/FilmCompaniesDetailController.php",
    "groupTitle": "公司详情"
  },
  {
    "type": "Post",
    "url": "/api/company/detail",
    "title": "公司信息",
    "name": "公司信息",
    "group": "公司详情",
    "description": "<p>公司信息</p>",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>【header头传输 可以不传】</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【公司id】</p>"
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
          "content": "{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"id\": 1,\n\"name\": \"Vixen Group\",\n\"movie_sum\": 336,\n\"like_sum\": 0,\n\"is_like\": 0\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/FilmCompaniesDetailController.php",
    "groupTitle": "公司详情"
  },
  {
    "type": "Post",
    "url": "/api/actor/products",
    "title": "作品列表",
    "name": "作品列表",
    "group": "导演详情",
    "description": "<p>作品列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【导演id】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>【分页】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>【分页长度】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "filter",
            "description": "<p>【1.subtitle字幕 2.download已下载 3.comment新评】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>【1.release发布时间排序 2.linkage链接更新排序】</p>"
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"page\": \"1\",\n\"pageSize\": \"2\",\n\"sum\": 81,\n\"list\": [\n{\n\"id\": 9371,\n\"name\": \"In The Moment\",\n\"number\": \"blacked.20.10.17\",\n\"release_time\": \"2021-05-30 02:31:49\",\n\"created_at\": \"2021-05-30T02:41:43.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 2,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 2,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/779a92979710ba7e6722f9d1f7ab9bb6.jpg\",\n\"big_cove\": \"/javdb/big_cove/7420d70cac02d921301bfd927bc2b7dc.jpg\"\n},\n{\n\"id\": 9362,\n\"name\": \"Wanna Chill?\",\n\"number\": \"blackedraw.18.11.18\",\n\"release_time\": \"2021-05-30 02:31:48\",\n\"created_at\": \"2021-05-30T02:41:42.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 2,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 1,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/e4e0cc3cb425f18504a8b7f6e3e50a6f.jpg\",\n\"big_cove\": \"/javdb/big_cove/bbb31c1c5285482180637982c2497289.jpg\"\n}\n]\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/DirectorDetailController.php",
    "groupTitle": "导演详情"
  },
  {
    "type": "Post",
    "url": "/api/director/detail",
    "title": "导演信息",
    "name": "导演信息",
    "group": "导演详情",
    "description": "<p>导演信息</p>",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>【header头传输 可以不传】</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【导演id】</p>"
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
          "content": "{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"id\": 1,\n\"name\": \"Derek Dozer\",\n\"movie_sum\": 81,\n\"like_sum\": 0,\n\"is_like\": 0\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/DirectorDetailController.php",
    "groupTitle": "导演详情"
  },
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
          "content": "    {\n        \"code\": 200,\n        \"msg\": \"成功！\",\n\"data\": {\n\"netUrl\": \"/public/uploads/avatar/2021-07-28_1627445309_6100d83ddbed3.png\",//full path for display\n\"saveUrl\": \"/public/uploads/avatar/2021-07-28_1627445309_6100d83ddbed3.png\"//for save to backend\n}\n    }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/ToolController.php",
    "groupTitle": "工具接口"
  },
  {
    "type": "Post",
    "url": "/api/file/upload/piece/list",
    "title": "上传片单图",
    "name": "上传片单图",
    "group": "工具接口",
    "description": "<p>上传片单图</p>",
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
          "content": "{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"netUrl\": \"/public/uploads/avatar/2021-07-28_1627445309_6100d83ddbed3.png\",//full path for display\n\"saveUrl\": \"/public/uploads/avatar/2021-07-28_1627445309_6100d83ddbed3.png\"//for save to backend\n}\n}",
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
    "url": "/api/captcha/cors/math",
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
    "type": "Post",
    "url": "/api/nologin/batch_hand_send",
    "title": "批量评论",
    "name": "批量评论",
    "group": "工具接口",
    "description": "<p>批量评论</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Parameter",
            "type": "Json",
            "optional": false,
            "field": "data",
            "description": "<p>json格式[{&quot;username&quot;:&quot;{用户昵称}&quot;,&quot;comment&quot;:&quot;{评论内容}&quot;,&quot;child&quot;:[{&quot;username&quot;:&quot;{用户昵称}&quot;,&quot;comment&quot;:&quot;{回复评论}&quot;]}]</p>"
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
            "field": "code",
            "description": "<p>200=操作完成</p>"
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
            "type": "String",
            "optional": false,
            "field": "warning",
            "description": "<p>警告</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserSeenController.php",
    "groupTitle": "工具接口"
  },
  {
    "type": "Post",
    "url": "/api/movie/show",
    "title": "Ta还出演过",
    "name": "Ta还出演过",
    "group": "影片",
    "description": "<p>Ta还出演过</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【影片id】</p>"
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"0\": {\n\"id\": 260,\n\"name\": \"La Sirena 69’s Perfect Tits and Ass\",\n\"number\": \"BigTitsRoundAsses.20.12.12\",\n\"release_time\": \"2021-05-30 02:20:41\",\n\"created_at\": \"2021-05-30T02:28:57.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/03c4bd9c2284138728e64570824c7922.jpg\",\n\"big_cove\": \"/javdb/big_cove/2f005a9e69166a8e7807ad714f4839de.jpg\"\n},\n\"1\": {\n\"id\": 834,\n\"name\": \"Fucking The Sitter\",\n\"number\": \"BangBros18.21.02.21\",\n\"release_time\": \"2021-05-30 02:21:49\",\n\"created_at\": \"2021-05-30T02:30:16.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/ffa90cf17813db7d25cb0d2051baa456.jpg\",\n\"big_cove\": \"/javdb/big_cove/dbaaf3ac4556a4dd23e57cdad777f7f9.jpg\"\n},\n\"2\": {\n\"id\": 1147,\n\"name\": \"Clara's Suitcase Sex Surprise\",\n\"number\": \"BangBros18.20.12.20\",\n\"release_time\": \"2021-05-30 02:22:07\",\n\"created_at\": \"2021-05-30T02:30:57.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/ceee6f6c6291716245d4d27c33c4e09f.jpg\",\n\"big_cove\": \"/javdb/big_cove/e4b2c7c386a71b79704d34f90b93a5b9.jpg\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/MovieDetailController.php",
    "groupTitle": "影片"
  },
  {
    "type": "Post",
    "url": "/api/movie/reply",
    "title": "影片发评论",
    "name": "影片发评论",
    "group": "影片",
    "description": "<p>发评论</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【影片id】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "uid",
            "description": "<p>【用户id】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "comment_id",
            "description": "<p>【直接发评论0 如果是回复为回复的评论id】</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "comment",
            "description": "<p>【内容6-255字】</p>"
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
            "type": "string",
            "optional": false,
            "field": "warning",
            "description": "<p>当碰到过滤词时，提示的警告</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/MovieDetailController.php",
    "groupTitle": "影片"
  },
  {
    "type": "Post",
    "url": "/api/movie/detail",
    "title": "影片详情",
    "name": "影片详情",
    "group": "影片",
    "description": "<p>详情</p>",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>【header头传输 可以不传】</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【影片id】</p>"
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
            "field": "flux_linkage",
            "description": "<p>磁链说明</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "flux_linkage.time",
            "description": "<p>磁链更新时间【必填】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "flux_linkage.name",
            "description": "<p>磁链名称 【必填】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "flux_linkage.meta",
            "description": "<p>磁链描述【必填】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "flux_linkage.url",
            "description": "<p>磁链下载地址【必填】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "flux_linkage.is-small",
            "description": "<p>1=高清【必填】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "flux_linkage.is-warning",
            "description": "<p>1=字幕【必填】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "flux_linkage.tooltip",
            "description": "<p>1=离线下载【必填】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "flux_linkage.bluray",
            "description": "<p>1=蓝光 【选填】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "flux_linkage.resolution",
            "description": "<p>分辨率 【选填】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "flux_linkage.size",
            "description": "<p>文件大小 [选填]</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "flux_linkage.ext",
            "description": "<p>文件类型 [选填]</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "flux_linkage.xt",
            "description": "<p>加密类型 [选填]</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "flux_linkage.md5",
            "description": "<p>文件校验码 [选填]</p>"
          },
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
          "content": "{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"id\": 12895,\n\"number\": \"061320_001\",\n\"name\": \"レズビアン大乱交〜ルナ&須藤なこ〜\",\n\"time\": 212400,\n\"release_time\": \"2021-05-30 02:34:12\",\n\"small_cover\": \"http://www.wd.com/d41d8cd98f00b204e9800998ecf8427e/0d9d74d1a77c2a4f.jpeg\",\n\"big_cove\": \"http://www.wd.com/d41d8cd98f00b204e9800998ecf8427e/9dd08f6a93072331.jpeg\",\n\"trailer\": \"http://www.wd.com/d41d8cd98f00b204e9800998ecf8427e/a2105f1833731ade.mp4\",\n\"map\": [\n\"http://www.wd.com/d41d8cd98f00b204e9800998ecf8427e/ea2db2a5e7f9a74e.jpeg\"\n],\n\"score\": 0,\n\"score_people\": 5,\n\"comment_num\": 0,\n\"flux_linkage_num\": 1,\n\"flux_linkage\": [\n{\n\"name\": \"测试\",\n\"url\": \"dsdsd\",\n\"tooltip\": \"本地下载\",\n\"meta\": \"2g\",\n\"is-small\": \"\",\n\"is-warning\": \"\"\n}\n],\n\"flux_linkage_time\": \"2021-05-30 03:09:29\",\n\"created_at\": \"2021-05-30T03:09:29.000000Z\",\n\"labels\": [\n{\n\"name\": \"女同性戀\",\n\"id\": 38\n},\n{\n\"name\": \"熟女\",\n\"id\": 377\n}\n],\n\"actors\": [\n{\n\"name\": \"真木今日子\",\n\"id\": 18,\n\"is_like\": 0\n},\n{\n\"name\": \"三上悠亜\",\n\"id\": 21,\n\"is_like\": 0\n},\n{\n\"name\": \"ルナ\",\n\"id\": 822,\n\"is_like\": 0\n}\n],\n\"director\": [\n{\n\"name\": \"［Jo］Style\",\n\"id\": 414,\n\"is_like\": 0\n}\n],\n\"company\": [\n{\n\"name\": \"Vixen Group\",\n\"id\": 1,\n\"is_like\": 0\n}\n],\n\"series\": [\n{\n\"name\": \"Bang Bus\",\n\"id\": 1,\n\"is_like\": 0\n}\n],\n\"numbers\": [\n{\n\"name\": \"Momsincontrol\",\n\"id\": 96\n}\n],\n\"seen\": 0,\n\"want_see\": 0\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/MovieDetailController.php",
    "groupTitle": "影片"
  },
  {
    "type": "Post",
    "url": "/api/movie/my_score",
    "title": "我的评分",
    "name": "我的评分",
    "group": "影片",
    "description": "<p>我对影片的评分</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【影片id】</p>"
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n    \"score\":5\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/MovieDetailController.php",
    "groupTitle": "影片"
  },
  {
    "type": "Post",
    "url": "/api/label/category",
    "title": "标签分类",
    "name": "获取标签分类",
    "group": "影片标签",
    "description": "<p>获取标签分类列表 *</p>",
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
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "data.id",
            "description": "<p>分类ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data.name",
            "description": "<p>分类名称</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/LabelController.php",
    "groupTitle": "影片标签"
  },
  {
    "type": "Post",
    "url": "/api/label/list",
    "title": "标签列表",
    "name": "获取标签列表",
    "group": "影片标签",
    "description": "<p>获取标签列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "cid",
            "description": "<p>标签分类id</p>"
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
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "data.id",
            "description": "<p>父标签id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data.name",
            "description": "<p>父标签名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "data.cids",
            "description": "<p>父标签所属分类id</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data.children",
            "description": "<p>子标签【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "data.children.id",
            "description": "<p>子标签id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data.children.name",
            "description": "<p>子标签名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "data.children.parent_id",
            "description": "<p>子标签所属父标签id</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/LabelController.php",
    "groupTitle": "影片标签"
  },
  {
    "type": "Post",
    "url": "/api/movie/guess",
    "title": "猜你喜欢",
    "name": "猜你喜欢",
    "group": "影片",
    "description": "<p>猜你喜欢</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【影片id】</p>"
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"0\": {\n\"id\": 591,\n\"name\": \"Private Dancer\",\n\"number\": \"LookAtHerNow.20.09.20\",\n\"release_time\": \"2021-05-30 02:21:09\",\n\"created_at\": \"2021-05-30 02:29:43\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/c5ed651f1e9d8bd122292825419a9c9f.jpg\",\n\"big_cove\": \"/javdb/big_cove/0c631088ac3c46004ca7b0996cab910a.jpg\"\n},\n\"1\": {\n\"id\": 5850,\n\"name\": \"Untamed\",\n\"number\": \"tushyraw.20.06.24\",\n\"release_time\": \"2021-05-30 02:28:37\",\n\"created_at\": \"2021-05-30 02:37:49\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/f7149bdee56cc16558d5c18d40393764.jpg\",\n\"big_cove\": \"/javdb/big_cove/de85cf801601d27dfba6dd2976af8915.jpg\"\n}\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/MovieDetailController.php",
    "groupTitle": "影片"
  },
  {
    "type": "Get",
    "url": "/api/movie/search",
    "title": "获取影片搜索列表",
    "name": "获取影片搜索列表",
    "group": "影片相关",
    "description": "<p>获取影片搜索列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "keyword",
            "description": "<p>关键词</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "actors",
            "description": "<p>演员列表.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "actors.id",
            "description": "<p>演员ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "actors.name",
            "description": "<p>演员名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "actors.photo",
            "description": "<p>演员头像</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "actors.sex",
            "description": "<p>演员性别</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "actors.social_accounts",
            "description": "<p>社交账号[]</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "actors.social_accounts.Twitter",
            "description": "<p>社交账号一一对应</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "actors.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "actors.like_sum",
            "description": "<p>关注数量</p>"
          },
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"more\": 1,\n\"total\": 1845,\n\"video\": [\n{\n\"id\": 13641,\n\"number\": \"NAD-003\",\n\"name\": \"このギャル、俺の乳首係り 氷堂りりあ\",\n\"time\": 460800,\n\"release_time\": \"2021-05-31 23:40:51\",\n\"issued\": \"\",\n\"sell\": \"\",\n\"small_cover\": \"/javdb/small_cover/22f4070db2756e22b95154464579e98d.jpg\",\n\"big_cove\": \"/javdb/big_cove/9bb4de69be65f31f9cbed4a253abf014.jpg\",\n\"trailer\": \"/javdb/trailer/cb5e1d1319ebd6d2eabe10f92956a952.mp4\",\n\"map\": \"[\\\"\\\\/javdb\\\\/map\\\\/1be03ae3ad1e6ea474a5044b069bb14e.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/46ffc100a5fefb8b968b76ea724503c8.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/658198ab3a702148779cb52d410ba321.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/2010b5bfdfa2f851baf46a187217d9fd.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/b317879638ef4740d98046ececb4aa33.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/fbeda9f4bac5d1609389b8f9cdc05a10.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/42cc62e130989c6f5e71556ea9ece840.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/b16cefda3fcc5d472caf285ae11c15fd.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/85266d1647ed74894391dbe355500ac5.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/6cc10a926615a42d5b97e7dfe541a464.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/a116fb83103277aba028dd1cb1897555.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/32e9d5381a53af08b6b3cd88f02c197c.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/8e958377b04c1d5c35946bc507c521dc.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/596d122d4f915667a343dbf9f7494e0d.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/441f86b1a692f50d683a4cbc31096784.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/874b27d646ef6499e14b66565ec085b8.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/8c60d8188da441e28e9c8866e868c4a0.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/3fa69cc1a645796d73414c7f5e69b6e7.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/3b2290ff788e8d633b2ce5b1fba0827e.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/f6e10e99573ce4a6f1c4a2a9562949a3.jpg\\\"]\",\n\"score\": 0,\n\"score_people\": 1,\n\"comment_num\": 1,\n\"collection_score\": 10,\n\"collection_score_people\": 4,\n\"collection_comment_num\": 1,\n\"wan_see\": 0,\n\"seen\": 0,\n\"flux_linkage_num\": 2,\n\"flux_linkage\":\"[{\\\"name\\\":\\\"NAD-003\\\",\\\"url\\\":\\\"magnet:?xt=urn:btih:c2af88bcc3e33e8e9bb0ac4571df9a59f5af0418&dn=[javdb.com]NAD-003\\\",\\\"is-small\\\":\\\"\\高\\清\\\",\\\"is-warning\\\":null,\\\"tooltip\\\":null,\\\"meta\\\":\\\"(5.33GB,3\\個\\文\\件)\\\"},{\\\"name\\\":\\\"nad-003.torrent\\\",\\\"url\\\":\\\"magnet:?xt=urn:btih:8f006a6af630199f25a65b6e0279a66d4e354745&dn=[javdb.com]nad-003.torrent\\\",\\\"is-small\\\":\\\"\\高\\清\\\",\\\"is-warning\\\":null,\\\"tooltip\\\":null,\\\"meta\\\":\\\"(5.23GB,6\\個\\文\\件)\\\"}]\",\n\"status\": 1,\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_up\": 1,\n\"is_short_comment\": 1,\n\"new_comment_time\": \"2021-05-31 23:41:02\",\n\"flux_linkage_time\": \"2021-05-31 23:41:02\",\n\"oid\": 13641,\n\"created_at\": \"2021-05-31 23:41:02\",\n\"updated_at\": \"2021-05-31 23:41:02\",\n\"actors\": [\n{\n\"id\": 4047,\n\"name\": \"氷堂りりあ\",\n\"photo\": \"\",\n\"sex\": \"♀\",\n\"oid\": 4047,\n\"social_accounts\": \"[]\",\n\"movie_sum\": 15,\n\"like_sum\": 0,\n\"status\": 1,\n\"created_at\": \"2021-05-31 16:10:49\",\n\"updated_at\": \"2021-05-31 23:41:02\",\n\"pivot\": {\n\"mid\": 13641,\n\"aid\": 4047\n}\n}\n],\n\"directors\": [\n{\n\"id\": 567,\n\"name\": \"松方ピロム\",\n\"movie_sum\": 1,\n\"like_sum\": 0,\n\"status\": 1,\n\"oid\": 568,\n\"created_at\": \"2021-05-31 23:40:58\",\n\"updated_at\": \"2021-05-31 23:41:02\",\n\"pivot\": {\n\"mid\": 13641,\n\"did\": 567\n}\n}\n]\n},\n{\n\"id\": 10619,\n\"number\": \"TIKB-110\",\n\"name\": \"金玉からっぽ金曜日 りりたん 氷堂りりあ\",\n\"time\": 482400,\n\"release_time\": \"2021-05-31 16:15:35\",\n\"issued\": \"\",\n\"sell\": \"\",\n\"small_cover\": \"/javdb/small_cover/9f21fce784d9baac61b74e75d66776aa.jpg\",\n\"big_cove\": \"/javdb/big_cove/25a4028649ac7af4374f3ed124126e33.jpg\",\n\"trailer\": \"\",\n\"map\": \"[\\\"\\\\/javdb\\\\/map\\\\/d6e777b07d1fd02e0203273fad34f7d8.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/03ac88624fbc8ef2605935456d7aa746.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/d9925b1fd8628094e222f6813a655f87.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/e745f6452823907b67fdd5272d06abbe.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/16c12cd35dd183f3a6493c13538b928e.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/2b34bf304fefa6845628d58a6a6e4c75.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/d70c1b05d2df4306d5b22c845abda163.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/2a48d1a85ae456170afa50bb41ecc51f.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/53acf315eb4c607867f677d80e41d8a5.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/104b8da2e229c8918165259a397c9945.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/e5a068fb495033e7ca65ca6f0cb1235b.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/d6b4f096019fc38a62ae77528d75558e.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/62edc717573b7741e2afad64e11ce00e.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/455de9f5fd545f37b1d4506e6f322aba.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/25bda842092d6ad49513253909142515.jpg\\\",\\\"\\\\/javdb\\\\/map\\\\/8e751df071ac864bb7f68ab720f5006a.jpg\\\"]\",\n\"score\": 0,\n\"score_people\": 0,\n\"comment_num\": 0,\n\"collection_score\": 0,\n\"collection_score_people\": 0,\n\"collection_comment_num\": 0,\n\"wan_see\": 0,\n\"seen\": 0,\n\"flux_linkage_num\": 2,\n\"flux_linkage\":\"[{\\\"name\\\":\\\"TIKB-110\\\",\\\"url\\\":\\\"magnet:?xt=urn:btih:24c89a1538c95c3e0f2613552d67662e2c1a6664&dn=[javdb.com]TIKB-110\\\",\\\"is-small\\\":\\\"\\高\\清\\\",\\\"is-warning\\\":null,\\\"tooltip\\\":null,\\\"meta\\\":\\\"(5.60GB)\\\"},{\\\"name\\\":\\\"kpxvs-TIKB110\\\",\\\"url\\\":\\\"magnet:?xt=urn:btih:c79c25d8b8f961e4445dc4fe8ce06c3bd1779c71&dn=[javdb.com]kpxvs-TIKB110\\\",\\\"is-small\\\":null,\\\"is-warning\\\":null,\\\"tooltip\\\":null,\\\"meta\\\":\\\"(1.47GB)\\\"}]\",\n\"status\": 1,\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_up\": 1,\n\"is_short_comment\": 1,\n\"new_comment_time\": \"2021-05-31 16:22:30\",\n\"flux_linkage_time\": \"2021-05-31 16:22:30\",\n\"oid\": 10619,\n\"created_at\": \"2021-05-31 16:22:30\",\n\"updated_at\": \"2021-05-31 16:22:30\",\n\"actors\": [\n{\n\"id\": 4047,\n\"name\": \"氷堂りりあ\",\n\"photo\": \"\",\n\"sex\": \"♀\",\n\"oid\": 4047,\n\"social_accounts\": \"[]\",\n\"movie_sum\": 15,\n\"like_sum\": 0,\n\"status\": 1,\n\"created_at\": \"2021-05-31 16:10:49\",\n\"updated_at\": \"2021-05-31 23:41:02\",\n\"pivot\": {\n\"mid\": 10619,\n\"aid\": 4047\n}\n}\n],\n\"directors\": []\n}\n]\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/MovieController.php",
    "groupTitle": "影片相关"
  },
  {
    "type": "Get",
    "url": "/api/movie/attributes/actor/list",
    "title": "获取演员列表",
    "name": "获取演员列表",
    "group": "影片相关",
    "description": "<p>获取演员列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "cid",
            "description": "<p>类别ID【0.全部、1.有码、2.无码、3.欧美、10.国产】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "actorList",
            "description": "<p>演员列表.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "actorList.id",
            "description": "<p>演员ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "actorList.name",
            "description": "<p>演员名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "actorList.photo",
            "description": "<p>演员头像</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "actorList.sex",
            "description": "<p>演员性别</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "actorList.social_accounts",
            "description": "<p>社交账号[]</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "actorList.social_accounts.Twitter",
            "description": "<p>社交账号一一对应</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "actorList.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "actorList.like_sum",
            "description": "<p>关注数量</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/MovieAttributesController.php",
    "groupTitle": "影片相关"
  },
  {
    "type": "Get",
    "url": "/api/movie/attributes/film/companies/list",
    "title": "获取片商列表",
    "name": "获取片商列表",
    "group": "影片相关",
    "description": "<p>获取片商列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "cid",
            "description": "<p>类别ID【0.全部、1.有码、2.无码、3.欧美、10.国产】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "filmCompaniesList",
            "description": "<p>片商列表.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "filmCompaniesList.id",
            "description": "<p>片商ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "filmCompaniesList.name",
            "description": "<p>片商名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "filmCompaniesList.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "filmCompaniesList.like_sum",
            "description": "<p>关注数量</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/MovieAttributesController.php",
    "groupTitle": "影片相关"
  },
  {
    "type": "Get",
    "url": "/api/movie/attributes/series/list",
    "title": "获取系列列表",
    "name": "获取系列列表",
    "group": "影片相关",
    "description": "<p>获取系列列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "cid",
            "description": "<p>类别ID【0.全部、1.有码、2.无码、3.欧美、10.国产】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "seriesList",
            "description": "<p>系列列表.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "seriesList.id",
            "description": "<p>系列ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "seriesList.name",
            "description": "<p>系列名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "seriesList.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "seriesList.like_sum",
            "description": "<p>关注数量</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/MovieAttributesController.php",
    "groupTitle": "影片相关"
  },
  {
    "type": "Post",
    "url": "/api/movie/comment",
    "title": "评论列表",
    "name": "评论列表",
    "group": "影片",
    "description": "<p>评论列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【影片id】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>【分页】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>【分页长度】</p>"
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"page\": \"1\",\n\"pageSize\": \"10\",\n\"sum\": 1,\n\"list\": [\n{\n\"id\": 7521,\n\"comment\": \"那个牙是真的丑\\n逼略肥但是不是粉的，片不好看逼也不好看\",\n\"nickname\": \"ja***y\",\n\"like\": 0,\n\"dislike\": 0,\n\"avatar\": \"\",\n\"score\": null,\n\"type\": 1,\n\"reply_uid\": 0,\n\"comment_time\": \"2021-05-30 02:46:16\",\n\"reply_comments\": [\n{\n\"id\": 7516,\n\"comment\": \"剧情不错.无码有字幕本身就少见.感觉妈妈拍的话比女儿更吸引人\",\n\"nickname\": \"se***o\",\n\"like\": 0,\n\"dislike\": 0,\n\"avatar\": \"\",\n\"score\": null,\n\"type\": 1,\n\"reply_uid\": 0,\n\"comment_time\": \"2021-05-30 02:46:14\",\n\"reply_comments\": [],\n\"uid\": -1,\n\"is_like\": 1,//本人是点赞\n\"is_dislike\": 1//本人是否踩\n},\n{\n\"id\": 7517,\n\"comment\": \"举报的死马\",\n\"nickname\": \"al***o\",\n\"like\": 0,\n\"dislike\": 0,\n\"avatar\": \"\",\n\"score\": null,\n\"type\": 1,\n\"reply_uid\": 0,\n\"comment_time\": \"2021-05-30 02:46:14\",\n\"reply_comments\": [],\n\"uid\": -1,\n\"is_like\": 0,\n\"is_dislike\": 0\n},\n{\n\"id\": 7518,\n\"comment\": \"橹度不是很高\",\n\"nickname\": \"hu***i\",\n\"like\": 0,\n\"dislike\": 0,\n\"avatar\": \"\",\n\"score\": null,\n\"type\": 1,\n\"reply_uid\": 0,\n\"comment_time\": \"2021-05-30 02:46:14\",\n\"reply_comments\": [],\n\"uid\": -1,\n\"is_like\": 0,\n\"is_dislike\": 0\n},\n{\n\"id\": 7519,\n\"comment\": \"还是东京热的味道：够狠，够折磨\\n某人说东京热就是一群猪拱了一个好白菜\\n此话不假，而且白菜的身材还真的不错\\n还是比较推荐的\\n唯独缺少了片头曲，那首激情片头能唤醒多少人的精液啊\",\n\"nickname\": \"ja***y\",\n\"like\": 0,\n\"dislike\": 0,\n\"avatar\": \"\",\n\"score\": null,\n\"type\": 1,\n\"reply_uid\": 0,\n\"comment_time\": \"2021-05-30 02:46:15\",\n\"reply_comments\": [],\n\"uid\": -1,\n\"is_like\": 0,\n\"is_dislike\": 1\n},\n{\n\"id\": 7520,\n\"comment\": \"眼睛挺大但是做爱的时候哪个表情感觉丝毫都不会让人硬\\n一般般\",\n\"nickname\": \"ja***y\",\n\"like\": 0,\n\"dislike\": 0,\n\"avatar\": \"\",\n\"score\": null,\n\"type\": 1,\n\"reply_uid\": 0,\n\"comment_time\": \"2021-05-30 02:46:15\",\n\"reply_comments\": [],\n\"uid\": -1,\n\"is_like\": 0,\n\"is_dislike\": 1\n}\n],\n\"uid\": -1,\n\"is_like\": 1,//本人是点赞\n\"is_dislike\": 1//本人是否踩\n}\n]\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/MovieDetailController.php",
    "groupTitle": "影片"
  },
  {
    "type": "Post",
    "url": "/api/comment/action",
    "title": "评论赞踩",
    "name": "评论赞踩",
    "group": "影片",
    "description": "<p>评论赞踩</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【评论id】</p>"
          },
          {
            "group": "Parameter",
            "type": "enum",
            "optional": false,
            "field": "action",
            "description": "<p>like：赞 dislike:踩</p>"
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
      }
    },
    "version": "0.0.0",
    "filename": "api/MovieDetailController.php",
    "groupTitle": "影片"
  },
  {
    "type": "Get",
    "url": "/api/rank",
    "title": "获取影片排行版",
    "name": "获取影片排行版",
    "group": "排行相关",
    "description": "<p>获取影片排行版</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>类别id【0.全部、1.有码、2.无码、3.欧美、10.国产】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "time",
            "description": "<p>时间戳【例如：2021年5月1日的时间戳是1619798400】时间类型【0.全部、1.日版、2.周榜、3.月榜】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>影片缩图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>影片大图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>磁链数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.rank",
            "description": "<p>排序，从小到大</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/HomeController.php",
    "groupTitle": "排行相关"
  },
  {
    "type": "Get",
    "url": "/api/actor/rank",
    "title": "获取演员月排行版",
    "name": "获取演员月排行版",
    "group": "排行相关",
    "description": "<p>获取演员月排行版</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>类别id【0.全部、1.有码、2.无码、3.欧美、10.国产】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "time",
            "description": "<p>时间戳【例如：2021年5月1日的时间戳是1619798400】【备注最好加上】时间类型【0.全部、1.日版、2.周榜、3.月榜】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>演员ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.name",
            "description": "<p>演员名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.photo",
            "description": "<p>演员头像</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.sex",
            "description": "<p>演员性别</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list.social_accounts",
            "description": "<p>社交账号[]</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.social_accounts.Twitter",
            "description": "<p>社交账号一一对应</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>关注数量</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.rank",
            "description": "<p>排行版名次</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/HomeController.php",
    "groupTitle": "排行相关"
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
    "type": "Post",
    "url": "/api/actor/products",
    "title": "作品列表",
    "name": "作品列表",
    "group": "演员详情",
    "description": "<p>作品列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【演员id】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>【分页】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>【分页长度】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "filter",
            "description": "<p>【1.subtitle字幕 2.download已下载 3.comment新评】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>【1.release发布时间排序 2.linkage链接更新排序】</p>"
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"page\": \"1\",\n\"pageSize\": \"2\",\n\"sum\": 36,\n\"list\": [\n{\n\"id\": 9278,\n\"name\": \"House Keeper\",\n\"number\": \"RKPrime.20.01.29\",\n\"release_time\": \"2021-05-30 02:31:43\",\n\"created_at\": \"2021-05-30T02:41:34.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/d9981d98b84fba0b68674a678619b951.jpg\",\n\"big_cove\": \"/javdb/big_cove/260d65aa1d4b98f2ef7d6c4c4cd28473.jpg\"\n},\n{\n\"id\": 12431,\n\"name\": \"Graduation\",\n\"number\": \"vixen.20.02.03\",\n\"release_time\": \"2021-05-30 02:31:43\",\n\"created_at\": \"2021-05-30T02:45:23.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/3fcf48013c67ac3e8c5b6b01f7b52fc6.jpg\",\n\"big_cove\": \"/javdb/big_cove/837792894077b74638c1ff775e9bb7c0.jpg\"\n}\n]\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/ActorDetailController.php",
    "groupTitle": "演员详情"
  },
  {
    "type": "Post",
    "url": "/api/actor/detail",
    "title": "演员信息",
    "name": "演员信息",
    "group": "演员详情",
    "description": "<p>演员信息</p>",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>【header头传输 可以不传】</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【演员id】】</p>"
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
          "content": "{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"id\": 263,\n\"name\": \"森菜菜子\",\n\"photo\": \"/javdb_actor/avatar/68d7456eb3ed08c59e1300538a6c503c.jpg\",\n\"sex\": \"\",\n\"social_accounts\": {\n\"Twitter\": \"https://twitter.com/mori7ko\"\n},\n\"movie_sum\": 0,\n\"like_sum\": 0,\n\"names\": {\n\"871\": \"森菜菜子\",\n\"872\": \" 森ななこ\",\n\"873\": \" 森nanako\"\n},\n\"is_like\": 0\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/ActorDetailController.php",
    "groupTitle": "演员详情"
  },
  {
    "type": "Post",
    "url": "/api/user/piece/list/add/movie",
    "title": "添加或者给片单删除一个影片",
    "name": "添加或者给片单删除一个影片",
    "group": "片单相关",
    "description": "<p>添加或者给片单删除一个影片</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pid",
            "description": "<p>片单ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>操作类型1.添加 2.删除</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>操作的影片</p>"
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
            "field": "id",
            "description": "<p>操作ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/PieceListController.php",
    "groupTitle": "片单相关"
  },
  {
    "type": "Get",
    "url": "/api/piece/list",
    "title": "获取片单列表",
    "name": "获取片单列表",
    "group": "片单相关",
    "description": "<p>获取片单列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>1.全部、2.热门</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>片单列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>id</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.uid",
            "description": "<p>创建的用户ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>片单名</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.cover",
            "description": "<p>片单图</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.pv_browse_sum",
            "description": "<p>浏览次数</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.intro",
            "description": "<p>片单描述</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门【暂时好像没用】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.authority",
            "description": "<p>权限1公开2私有</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.audit",
            "description": "<p>审核 1审核通过 2审核不通过 3审核中</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.type",
            "description": "<p>类型1.用户创建.2.系统管理员创建、3.用户默认</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.avatar",
            "description": "<p>用户头像</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.nickname",
            "description": "<p>用户昵称</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/PieceListController.php",
    "groupTitle": "片单相关"
  },
  {
    "type": "Get",
    "url": "/api/piece/movie/list",
    "title": "获取片单影片列表",
    "name": "获取片单影片列表",
    "group": "片单相关",
    "description": "<p>获取片单影片列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pid",
            "description": "<p>片单ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>其他发布日期。2，评分排序</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "sortType",
            "description": "<p>排序方式desc/asc</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/PieceListController.php",
    "groupTitle": "片单相关"
  },
  {
    "type": "Get",
    "url": "/api/piece/info",
    "title": "获取片单详情",
    "name": "获取片单详情",
    "group": "片单相关",
    "description": "<p>获取片单详情</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pid",
            "description": "<p>片单ID</p>"
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
            "field": "id",
            "description": "<p>片单id</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "uid",
            "description": "<p>片单创建的用户</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>片单名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "cover",
            "description": "<p>片单图</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "movie_sum",
            "description": "<p>影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "like_sum",
            "description": "<p>收藏数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "pv_browse_sum",
            "description": "<p>pv</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "intro",
            "description": "<p>描述</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "is_hot",
            "description": "<p>是否热门【待定】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "authority",
            "description": "<p>权限1.公开、2.私有</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "audit",
            "description": "<p>审核 1.审核通过、2.审核不通过，0.审核中</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>片单类型1.用户创建、2.系统/管理员创建3.用户系统默认</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "userInfo",
            "description": "<p>创建片单用户信息</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.phone",
            "description": "<p>手机</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.email",
            "description": "<p>邮箱</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "userInfo.nickname",
            "description": "<p>昵称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "userInfo.sex",
            "description": "<p>性别 0.未知 1.男 2.女</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "userInfo.age",
            "description": "<p>年龄</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "userInfo.attention",
            "description": "<p>关注数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.fans",
            "description": "<p>粉丝数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.intro",
            "description": "<p>简介</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.user_id",
            "description": "<p>用户ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "userInfo.user_attention",
            "description": "<p>是否被该用户关注【1.是、2.否】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "is_like",
            "description": "<p>0未收藏 1已收藏</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/PieceListController.php",
    "groupTitle": "片单相关"
  },
  {
    "type": "Post",
    "url": "/api/notify/delete",
    "title": "删除消息",
    "name": "删除消息",
    "group": "用户相关",
    "description": "<p>删除消息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>登录token</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "ids[]",
            "description": "<p>主键id数组</p>"
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
    "type": "Post",
    "url": "api/user/forgetPassword",
    "title": "忘记密码",
    "name": "忘记密码",
    "group": "用户相关",
    "description": "<p>忘记密码</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "account",
            "description": "<p>账号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pwd",
            "description": "<p>密码【明文】</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>短信或者邮箱验证码</p>"
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
    "type": "get",
    "url": "/api/notify/getNotifyList",
    "title": "消息通知列表",
    "name": "消息通知列表",
    "group": "用户相关",
    "description": "<p>获取消息通知列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>登录token</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>消息类型 1.赞 2.踩 3.我的评论 4.回复我的 5.关注 9. 系统消息【99.公告内容 系统占时无】</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "isRead",
            "description": "<p>是否已读 0.未读 1.已读</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>页码</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pageSize",
            "description": "<p>每页数量</p>"
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
          "content": "{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"list\": [\n    {\n        \"content\": [\n            \"我的评论：香肠嘴把\"//除去发送人一行的内容。当type=3 and type=4时数组长度位2 按原型顺序放置即可\n        ],\n        \"id\": 9,//批量删除和阅读传入\n        \"target_id\": 948,\n        \"target_id\": 948,\n        \"target_source_id\": 7512,\n        \"is_read\": 0,//是否已读\n        \"type\": 2,//赞和踩的content格式一样\n        \"sender_id\": -9,  （系统消息=-9）\n        \"sender_avatar\": 'uploads/avatar/my.jpg',//头像路径\n        \"sender_name\": \"system\"//发件人(系统消息=-1)\n    },\n    {\n        \"content\": [\n            \"我的评论：封面很像橘波留\"\n        ],\n        \"target_id\": 949,\n        \"target_source_id\": 7513,\n        \"is_read\": 0,\n        \"type\": 4,//回复我的\n        \"sender_id\": 3,      //用户id\n        \"sender_name\": \"user\" //发件人\n        },\n        {\n        \"content\": [\n            \"原以为是仓多真央，看完出演员名字才知道是大岛。\",\n            \"我的评论：那个负责清理的。。。看着有点恶心\"\n        ],\n        \"target_id\": 953,\n        \"target_source_id\": 7514,\n        \"is_read\": 0,\n        \"type\": 3,\n        \"sender_id\": 1,\n        \"sender_name\": \"user\"\n    },\n    {\n        \"content\": [\n            \"相马茜的长相真是长到我的审美上了。\",\n            \"影片番号：FC2-1729752 ※無※旦那様すいません( ;∀;)人妻KUREHA出産直前妊娠8か月！最後の濃厚不倫生ハメSEXで鬼イキ♡\"\n        ],\n        \"target_id\": 954,\n        \"target_source_id\": 7515,\n        \"is_read\": 0,\n        \"type\": 3,//评价\n        \"sender_id\": 2,\n        \"sender_name\": \"user\"\n        },\n        {\n        \"content\": [\n            \"我的评论：被艹时候的样子太丑了。\"\n        ],\n        \"target_id\": 955,\n        \"target_source_id\": 7516,\n        \"is_read\": 0,\n        \"type\": 2,\n        \"sender_id\": 2,\n        \"sender_name\": \"user\"\n    },\n    ],\n    \"count\": 10\n    }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/UserController.php",
    "groupTitle": "用户相关"
  },
  {
    "type": "Post",
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
    "type": "Post",
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
            "description": "<p>账号状态状态 1.正常  2.禁言  3.黑名单</p>"
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
    "url": "/api/notify/setRead",
    "title": "设置消息已读",
    "name": "设置消息已读",
    "group": "用户相关",
    "description": "<p>设置消息已读</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>登录token</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>消息主键id</p>"
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
    "url": "/api/user/loginwithcode",
    "title": "通过验证码登陆",
    "name": "通过验证码登陆",
    "group": "用户相关",
    "description": "<p>通过验证码登陆</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "emailOrPhone",
            "description": "<p>手机号码或电子邮箱</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>验证码</p>"
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
    "url": "/api/number/products",
    "title": "番号作品列表",
    "name": "番号作品列表",
    "group": "番号详情",
    "description": "<p>番号作品列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【番号id】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>【分页】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>【分页长度】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "filter",
            "description": "<p>【1.subtitle字幕 2.download已下载 3.comment新评】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>【1.release发布时间排序 2.linkage链接更新排序】</p>"
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"page\": \"1\",\n\"pageSize\": \"2\",\n\"sum\": 44,\n\"list\": [\n{\n\"id\": 12693,\n\"name\": \"Anal Approach\",\n\"number\": \"BangBus.21.05.19\",\n\"release_time\": \"2021-05-30 02:32:58\",\n\"created_at\": \"2021-05-30T02:46:03.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/f88b0d90fc090edef5ea0e31fc66f74f.jpg\",\n\"big_cove\": \"/javdb/big_cove/73b2b712c23f4fc8c84ad2cb9099135e.jpg\"\n},\n{\n\"id\": 9361,\n\"name\": \"Hottie With Perfect Tits Fucks for Money\",\n\"number\": \"BangBus.21.03.24\",\n\"release_time\": \"2021-05-30 02:31:48\",\n\"created_at\": \"2021-05-30T02:41:41.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 2,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/1c54f4cd99d37ca0412d2f5eb07153b9.jpg\",\n\"big_cove\": \"/javdb/big_cove/6e964d480c353edcac7c2847f5ae0cbc.jpg\"\n}\n]\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/NumberDetailController.php",
    "groupTitle": "番号详情"
  },
  {
    "type": "Post",
    "url": "/api/number/detail",
    "title": "番号信息",
    "name": "番号信息",
    "group": "番号详情",
    "description": "<p>番号信息</p>",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>【header头传输 可以不传】</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【番号id】</p>"
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
          "content": "{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"id\": 1,\n\"name\": \"BangBus\",\n\"movie_sum\": 0,\n\"like_sum\": 0,\n\"is_like\": 0\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/NumberDetailController.php",
    "groupTitle": "番号详情"
  },
  {
    "type": "Post",
    "url": "/api/series/products",
    "title": "系列作品列表",
    "name": "系列作品列表",
    "group": "系列详情",
    "description": "<p>系列作品列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【系列id】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>【分页】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>【分页长度】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "filter",
            "description": "<p>【1.subtitle字幕 2.download已下载 3.comment新评】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>【1.release发布时间排序 2.linkage链接更新排序】</p>"
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
          "content": "\n{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"page\": \"1\",\n\"pageSize\": \"2\",\n\"sum\": 5979,\n\"list\": [\n{\n\"id\": 12894,\n\"name\": \"チーム木村番外編生挿入 -- 綺羅千沙斗\",\n\"number\": \"kb1599\",\n\"release_time\": \"2021-05-30 02:34:35\",\n\"created_at\": \"2021-05-30T02:46:16.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/19a1d1391e24d38156f4d9963b303540.jpg\",\n\"big_cove\": \"/javdb/big_cove/1aff3c8a06de43155efcebd08dd3bcac.jpg\"\n},\n{\n\"id\": 11962,\n\"name\": \"ときめき ～もっと何々して…を連発する俺の彼女～\",\n\"number\": \"010720_956\",\n\"release_time\": \"2021-05-30 02:34:34\",\n\"created_at\": \"2021-05-30T02:44:30.000000Z\",\n\"is_download\": 2,\n\"is_subtitle\": 1,\n\"is_hot\": 1,\n\"is_new_comment\": 2,\n\"is_flux_linkage\": 2,\n\"comment_num\": 0,\n\"score\": 0,\n\"small_cover\": \"/javdb/small_cover/21d9072ece98b7ee91d35b61c887fdb3.jpg\",\n\"big_cove\": \"/javdb/big_cove/9e63f250d5a8b21baf6cbf24efd7c2e9.jpg\"\n}\n]\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/SeriesDetailController.php",
    "groupTitle": "系列详情"
  },
  {
    "type": "Post",
    "url": "/api/series/detail",
    "title": "系列信息",
    "name": "系列信息",
    "group": "系列详情",
    "description": "<p>系列信息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>【系列id】</p>"
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
          "content": "{\n\"code\": 200,\n\"msg\": \"成功！\",\n\"data\": {\n\"id\": 719,\n\"name\": \"レズビアン大乱交\",\n\"movie_sum\": 2,\n\"like_sum\": 0\n}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/SeriesDetailController.php",
    "groupTitle": "系列详情"
  },
  {
    "type": "Get",
    "url": "/api/count/movie",
    "title": "添加影片浏览记录",
    "name": "添加影片浏览记录",
    "group": "统计相关",
    "description": "<p>添加影片浏览记录</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mid",
            "description": "<p>影片ID</p>"
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
            "field": "id",
            "description": "<p>统计ID.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "统计相关"
  },
  {
    "type": "Get",
    "url": "/api/count/actor",
    "title": "添加演员浏览记录",
    "name": "添加演员浏览记录",
    "group": "统计相关",
    "description": "<p>添加演员浏览记录</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "aid",
            "description": "<p>演员ID</p>"
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
            "field": "id",
            "description": "<p>统计ID.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/UserActionController.php",
    "groupTitle": "统计相关"
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
            "description": "<p>内容【格式用户昵称+冒号+评论内容】</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "key",
            "description": "<p>图形验证码key【开启了图形验证码】</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "captcha",
            "description": "<p>验证码</p>"
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
            "type": "String",
            "optional": false,
            "field": "avid",
            "description": "<p>AV番号</p>"
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
    "url": "/api/conf/getOneConf",
    "title": "单个基础信息",
    "name": "获取一条基础信息",
    "group": "网站管理",
    "description": "<p>根据类型type获取单个信息 type=1 只返回一部分数据格式如上 example:/api/conf/getOneConf/1</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>type 1,2,3,4,5,6,7</p>"
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
    "type": "Post",
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
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>1:顶部轮播 2：内容轮播 3:消息轮播</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>页码 默认20一页</p>"
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
    "url": "/api/conf/domain",
    "title": "获取后台配置的域名列表",
    "name": "获取后台配置的域名列表",
    "group": "网站管理",
    "description": "<p>获取后台配置的域名列表</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "code",
            "description": "<p>响应码 200 正确 其他错误 返回值格式参考如上</p>"
          },
          {
            "group": "Success 200",
            "type": "list",
            "optional": false,
            "field": "data",
            "description": "<p>数据列表</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/ConfController.php",
    "groupTitle": "网站管理"
  },
  {
    "type": "post",
    "url": "/api/ads/list",
    "title": "获取广告列表",
    "name": "获取广告列表",
    "group": "网站管理",
    "description": "<p>获取广告列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>top=顶部位置；left=左对联；right=右对联；foot=底部</p>"
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
          },
          {
            "group": "Success 200",
            "type": "list",
            "optional": false,
            "field": "data",
            "description": "<p>数据列表</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>广告id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.location",
            "description": "<p>广告位</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.photo",
            "description": "<p>图片</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.url",
            "description": "<p>链接</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.is_close",
            "description": "<p>是否可关 1=能关闭；2=不可关</p>"
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
    "title": "所有基础信息",
    "name": "获取所有基础信息",
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
          "content": "{\n      \"code\": 200,\n      \"msg\": \"成功！\",\n      \"data\": {\n      \"ad_investment\": {//广告招商 type=1\n          \"url\": \"222\",\n          \"email\": \"1133\"\n      },\n      \"download_setting\": {//下载本站app链接 type=2\n          \"url\": \"334\"\n      },\n      \"about_us\": {//关于我们 type=3\n          \"url\": \"4456\",\n          \"content\": \"<p>44</p>\"//内容 富文本形式\n      },\n      \"friend_link\": [//友情链接 type=4\n      {\n          \"name\": \"2\",//链接名字\n          \"url\": \"2\"//链接\n      },\n      {\n          \"name\": \"2\",//链接名字\n          \"url\": \"2\"//链接\n      },\n      {\n          \"name\": \"2\",//链接名字\n          \"url\": \"2\"//链接\n      }\n      ],\n      \"private_item\": {//隐私信息 type=5\n          \"url\": \"33555\",\n          \"content\": \"<p>444666</p>\"//内容富文本\n      },\n      \"magnet_link\": {//磁力使用教程 type=6\n          \"url\": \"55555566\",//url\n          \"content\": \"<p>55566</p>\"//内容富文本\n          }\n      }\n     \"comment_notes\": {//短评须知 type=7\n          \"isopen\": \"1\",    //开关 1=开；2=关\n          \"countdown\":\"5\"   //关闭倒计时（秒）\n          \"content\": \"<p>55566</p>\"//内容富文本\n          }\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "api/ConfController.php",
    "groupTitle": "网站管理"
  },
  {
    "type": "Get",
    "url": "/api/search/log",
    "title": "搜索历史【登录可用】",
    "name": "搜索历史【登录可用】",
    "group": "首页相关",
    "description": "<p>搜索历史【登录可用】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.content",
            "description": "<p>搜索内容</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/HomeController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/search",
    "title": "搜索【导演】",
    "name": "搜索导演",
    "group": "首页相关",
    "description": "<p>搜索【导演】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "search",
            "description": "<p>搜索内容</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ty",
            "description": "<p>搜索类型 director=导演</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码 默认值1（兼容老接口）</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度，默认值10</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到的最后id，用于新分页，默认值0</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到最后id</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>导演ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>导演名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>电影数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.categoty_name",
            "description": "<p>分类名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.categoty_id",
            "description": "<p>分类id</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/SearchController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/search",
    "title": "搜索【全站模式】",
    "name": "搜索引擎",
    "group": "首页相关",
    "description": "<p>搜索【根据条件】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "search",
            "description": "<p>搜索内容</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ty",
            "description": "<p>搜索类型 movie=影片 actor=演员 series=系列 film=片商 director=导演  number=番号  piece=片单</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码 默认值1（兼容老接口）</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度，默认值10</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到的最后id，用于新分页，默认值0</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/SearchController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/search",
    "title": "搜索【影片，番号】",
    "name": "搜索影片番号",
    "group": "首页相关",
    "description": "<p>搜索【影片，番号】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "search",
            "description": "<p>搜索内容</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ty",
            "description": "<p>搜索类型 movie=影片 number=番号</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码 默认值1（兼容老接口）</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度，默认值10</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到的最后id，用于新分页，默认值0</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到最后id</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>搜索的内容（搜番号时）</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "number_Id",
            "description": "<p>番号组的id（搜番号时）</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/SearchController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/search",
    "title": "搜索【演员】",
    "name": "搜索演员",
    "group": "首页相关",
    "description": "<p>搜索【演员】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "search",
            "description": "<p>搜索内容</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ty",
            "description": "<p>搜索类型 actor=演员</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码 默认值1（兼容老接口）</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度，默认值10</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到的最后id，用于新分页，默认值0</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到最后id</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>演员ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>演员名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.phote",
            "description": "<p>演员图片</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.sex",
            "description": "<p>演员性别</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>电影数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.categoty_name",
            "description": "<p>分类名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.categoty_id",
            "description": "<p>分类id</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/SearchController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/search",
    "title": "搜索【片单】",
    "name": "搜索片单",
    "group": "首页相关",
    "description": "<p>搜索【片单】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "search",
            "description": "<p>搜索内容</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ty",
            "description": "<p>搜索类型 piece=片单</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码 默认值1（兼容老接口）</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度，默认值10</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到的最后id，用于新分页，默认值0</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到最后id</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>片单id</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.audit",
            "description": "<p>1=审核通过</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.authority",
            "description": "<p>1=公开</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.cover",
            "description": "<p>封面图</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.name",
            "description": "<p>片单名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.intro",
            "description": "<p>片单描述</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>片单影片数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>片单收藏数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.uid",
            "description": "<p>用户id</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.username",
            "description": "<p>用户名</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.avatar",
            "description": "<p>用户头像</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/SearchController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/search",
    "title": "搜索【片商】",
    "name": "搜索片商",
    "group": "首页相关",
    "description": "<p>搜索【片商】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "search",
            "description": "<p>搜索内容</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ty",
            "description": "<p>搜索类型 film=片商</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码 默认值1（兼容老接口）</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度，默认值10</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到的最后id，用于新分页，默认值0</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到最后id</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>片商ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>片商名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>电影数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.categoty_name",
            "description": "<p>分类名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.categoty_id",
            "description": "<p>分类id</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/SearchController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/search",
    "title": "搜索【系列】",
    "name": "搜索系列",
    "group": "首页相关",
    "description": "<p>搜索【系列】</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "search",
            "description": "<p>搜索内容</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ty",
            "description": "<p>搜索类型 series=系列</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码 默认值1（兼容老接口）</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度，默认值10</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到的最后id，用于新分页，默认值0</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "lastid",
            "description": "<p>请求得到最后id</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>系列ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>系列名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.movie_sum",
            "description": "<p>电影数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.like_sum",
            "description": "<p>收藏数</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.categoty_name",
            "description": "<p>分类名称</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.categoty_id",
            "description": "<p>分类id</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/SearchController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/search/log/clear",
    "title": "清除搜索历史【登录可用】",
    "name": "清除搜索历史【登录可用】",
    "group": "首页相关",
    "description": "<p>清除搜索历史【登录可用】</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>空</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/HomeController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/search/hotword",
    "title": "搜索下面的热搜词",
    "name": "热搜词",
    "group": "首页相关",
    "description": "<p>热搜词</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list[]",
            "description": "<p>关键词组数</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/SearchController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/home",
    "title": "获取首页关注信息",
    "name": "获取首页关注信息",
    "group": "首页相关",
    "description": "<p>获取首页关注信息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "home_type",
            "description": "<p>首页类型2必须传2</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/HomeController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/home",
    "title": "获取首页新种信息",
    "name": "获取首页新种信息",
    "group": "首页相关",
    "description": "<p>获取首页新种信息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "home_type",
            "description": "<p>首页类型4必须传4</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/HomeController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/home",
    "title": "获取首页标签影片列表",
    "name": "获取首页标签影片列表",
    "group": "首页相关",
    "description": "<p>获取首页标签影片列表</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "home_type",
            "description": "<p>首页类型5必须传5</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "cid",
            "description": "<p>标签的id</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/HomeController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/home",
    "title": "获取首页热门信息",
    "name": "获取首页热门信息",
    "group": "首页相关",
    "description": "<p>获取首页热门信息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "home_type",
            "description": "<p>首页类型1必须传1</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/HomeController.php",
    "groupTitle": "首页相关"
  },
  {
    "type": "Get",
    "url": "/api/home",
    "title": "获取首页类别信息",
    "name": "获取首页类别信息",
    "group": "首页相关",
    "description": "<p>获取首页类别信息</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "home_type",
            "description": "<p>首页类型3必须传3</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "cid",
            "description": "<p>类别id【0.全部、1.有码、2.无码、3.欧美、10.国产】</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "release_time",
            "description": "<p>发行时间排序：1.是asc、2.是desc</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "flux_linkage_time",
            "description": "<p>磁链更新时间：1.是asc、2.是desc</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>分页页码</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>分页长度</p>"
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
            "field": "sum",
            "description": "<p>数据总数</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "list",
            "description": "<p>列表【数组】</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.id",
            "description": "<p>影片ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>影片ID名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.number",
            "description": "<p>影片番号</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.release_time",
            "description": "<p>发行时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.created_at",
            "description": "<p>创建时间</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_download",
            "description": "<p>状态：1.不可下载、2.可下载</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_subtitle",
            "description": "<p>状态：1.不含字幕、2.含字幕</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_short_comment",
            "description": "<p>状态：1.不含短评、2.含短评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_hot",
            "description": "<p>是否热门待定</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_new_comment",
            "description": "<p>0.无状态、1.今日新评、2.无状态、3.昨日新评</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.is_flux_linkage",
            "description": "<p>0.无状态1.今日新种、2.无状态、3.昨日新种</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.comment_num",
            "description": "<p>评论数量</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "list.score",
            "description": "<p>评分</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.small_cover",
            "description": "<p>小图</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.big_cove",
            "description": "<p>大图</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "api/HomeController.php",
    "groupTitle": "首页相关"
  }
] });
