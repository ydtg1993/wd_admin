<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/11
 * Time: 16:39
 */

namespace App\Services\Logic\SqlUpdate;


class Sql
{

    public static $sqlTable = [

        /************************公共部分表**************************/
            'CREATE TABLE IF NOT EXISTS `comm_conf` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'配置名称\',
              `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'识别KEY\',
              `type` tinyint(4) DEFAULT \'1\' COMMENT \' 数据类型 1.广告招商 2. 下载本站 3.关于我们 4.隐私条款  \',
              `values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 配置的值根据数据类型解析\',
              `status` tinyint(4) DEFAULT \'1\' COMMENT \' 1.正常  2.弃用  \',
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
              `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
              PRIMARY KEY (`id`),
              KEY `id_comm_conf_id` (`id`) USING BTREE,
              KEY `id_comm_conf_key` (`key`) USING BTREE,
              KEY `id_comm_conf_name` (`name`) USING BTREE,
              KEY `id_comm_conf_type` (`type`) USING BTREE
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'公共配置表\';',//公共配置表

            'CREATE TABLE IF NOT EXISTS `comm_links` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `num` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'编号\',
              `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'网站名称\',
              `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'网站链接\',
              `sort` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'排序值\',
              `status` tinyint(4) DEFAULT \'1\' COMMENT \' 1.正常  2.弃用  \',
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
              `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
              PRIMARY KEY (`id`),
              KEY `id_comm_links_id` (`id`) USING BTREE,
              KEY `id_comm_links_num` (`num`) USING BTREE,
              KEY `id_comm_links_name` (`name`) USING BTREE,
              KEY `id_comm_links_sort` (`sort`) USING BTREE
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'友情链接表\';',//友情链接表

        /************************用户部分表**************************/
            'CREATE TABLE `user_client` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `number` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'用户识别码-本平台\',
              `status` tinyint(4) DEFAULT \'1\' COMMENT \'账号状态状态 1.正常  2.禁用/黑名单  \',
              `phone` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'用户手机号\',
              `email` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'用户邮箱\',
              `nickname` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'用户昵称\',
              `pwd` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'用户密码\',
              `sex` tinyint(4) DEFAULT \'0\' COMMENT \'用户性别 0未知 1男 2女\',
              `type` tinyint(4) DEFAULT \'1\' COMMENT \'用户类型 1普通用户 2运营账户 3 VIP会员【这个后面可能需要调整】\',
              `age` int(11) unsigned DEFAULT NULL COMMENT \'用户年龄\',
              `attention` int(11) unsigned DEFAULT NULL COMMENT \'用户关注数量-冗余\',
              `fans` int(11) unsigned DEFAULT NULL COMMENT \'用户粉丝数量-冗余\',
              `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'头像\',
              `intro` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'用户简介\',
              `le_phone_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'手机认证时间\',
              `le_phone_status` tinyint(4) DEFAULT \'2\' COMMENT \'手机认证状态 1.认证  2.未认证 \',
              `le_email_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'邮箱认证时间\',
              `le_email_status` tinyint(4) DEFAULT \'2\' COMMENT \'邮箱认证状态 1.认证  2.未认证 \',
              `login_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'用户最近登录时间\',
              `login_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'用户最近登录ip\',
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
              `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
              PRIMARY KEY (`id`),
              UNIQUE KEY `number` (`number`),
              KEY `id_user_id` (`id`) USING BTREE,
              KEY `id_user_number` (`number`) USING BTREE,
              KEY `id_user_phone` (`phone`) USING BTREE,
              KEY `id_user_email` (`email`) USING BTREE,
              KEY `id_user_nickname` (`nickname`) USING BTREE,
              KEY `id_user_type` (`type`) USING BTREE
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'用户基础信息表\';'


    ];
}