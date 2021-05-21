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
            'CREATE TABLE IF NOT EXISTS `user_client` (
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
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'用户基础信息表\';',


        /************************采集部分表**************************/
        'CREATE TABLE IF NOT EXISTS `collection_original` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `oid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'mongoDb id\',
          `number` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'番号\',
          `db_name` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'所属mongodb表\',
          `dis_sum` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'处理计数 为防止意外一个影片数据会处理两次\',
          `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数据\',
          `status` tinyint(4) DEFAULT \'1\' COMMENT \' 1.未处理  2.已处理 3.需要重新处理  \',
          `ctime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'采集方的创建时间 最大值用于从采集那边的筛选条件\',
          `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
          `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
          PRIMARY KEY (`id`),
          KEY `id_collection_original_id` (`id`) USING BTREE,
          KEY `id_collection_original_oid` (`oid`) USING BTREE,
          KEY `id_collection_original_number` (`number`) USING BTREE,
          KEY `id_collection_original_dis_sum` (`dis_sum`) USING BTREE,
          KEY `id_collection_original_ctime` (`ctime`) USING BTREE,
          KEY `id_collection_original_created_at` (`created_at`) USING BTREE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'采集原始数据表\';',

        'CREATE TABLE IF NOT EXISTS `collection_film_companies` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'片商名称\',
          `movie_sum` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'影片数量\',
          `category` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 类别\',
          `status` tinyint(4) DEFAULT \'1\' COMMENT \' 1.未处理  2.已处理【人工处理】  3.系统处理 4.需要重新处理\',
          `admin_id` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'处理用户id\',
          `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
          `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
          PRIMARY KEY (`id`),
          KEY `id_collection_film_companies_id` (`id`) USING BTREE,
          KEY `id_collection_film_companies_name` (`name`) USING BTREE,
          KEY `id_collection_film_companies_admin_id` (`admin_id`) USING BTREE,
          KEY `id_collection_film_companies_created_at` (`created_at`) USING BTREE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'采集片商表\';',

        'CREATE TABLE IF NOT EXISTS `collection_actor` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'演员名称-主\',
          `sex` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'演员性别\',
          `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'演员照片\',
          `social_accounts` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 社交账户 产品说手动补目前保留字段\',
          `movie_sum` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'影片数量\',
          `category` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 类别\',
          `status` tinyint(4) DEFAULT \'1\' COMMENT \' 1.未处理  2.已处理【人工处理】  3.系统处理 4.需要重新处理  \',
          `source` tinyint(4) DEFAULT \'1\' COMMENT \' 1.演员处理来源  2.影片处理来源【影片处理来源的时候演员处理需要重新更新】 3.异常【这个状态表示数据冲突需要人工处理】  \',
          `admin_id` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'处理用户id\',
          `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
          `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
          PRIMARY KEY (`id`),
          KEY `id_collection_actor_id` (`id`) USING BTREE,
          KEY `id_collection_actor_name` (`name`) USING BTREE,
          KEY `id_collection_actor_admin_id` (`admin_id`) USING BTREE,
          KEY `id_collection_actor_created_at` (`created_at`) USING BTREE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'采集演员信息表\';',

        'CREATE TABLE IF NOT EXISTS `collection_actor_name` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `aid` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'演员基础表关联ID 一个演员可能有很多名称\',
          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'演员名称\',
          `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
          `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
          PRIMARY KEY (`id`),
          KEY `id_collection_actor_name_id` (`id`) USING BTREE,
          KEY `id_collection_actor_name_aid` (`aid`) USING BTREE,
          KEY `id_collection_actor_name_name` (`name`) USING BTREE,
          KEY `id_collection_actor_name_created_at` (`created_at`) USING BTREE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'采集演员名称关联表\';',

        'CREATE TABLE IF NOT EXISTS `collection_series` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'系列名称\',
          `movie_sum` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'影片数量\',
          `category` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 类别\',
          `status` tinyint(4) DEFAULT \'1\' COMMENT \' 1.未处理  2.已处理  【人工处理】  3.系统处理 4.需要重新处理\',
          `admin_id` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'处理用户id\',
          `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
          `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
          PRIMARY KEY (`id`),
          KEY `id_collection_series_id` (`id`) USING BTREE,
          KEY `id_collection_series_name` (`name`) USING BTREE,
          KEY `id_collection_series_admin_id` (`admin_id`) USING BTREE,
          KEY `id_collection_series_created_at` (`created_at`) USING BTREE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'采集系列表\';',

        'CREATE TABLE IF NOT EXISTS `collection_director` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'导演名称\',
          `movie_sum` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'影片数量\',
          `status` tinyint(4) DEFAULT \'1\' COMMENT \' 1.未处理  2.已处理【人工处理】  3.系统处理 4.需要重新处理  \',
          `admin_id` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'处理用户id\',
          `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
          `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
          PRIMARY KEY (`id`),
          KEY `id_collection_director_id` (`id`) USING BTREE,
          KEY `id_collection_director_name` (`name`) USING BTREE,
          KEY `id_collection_director_admin_id` (`admin_id`) USING BTREE,
          KEY `id_collection_director_created_at` (`created_at`) USING BTREE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'采集导演表\';',

        'CREATE TABLE IF NOT EXISTS `collection_label` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'标签名称-主\',
          `name_temp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'标签名称-临时\',
          `name_child` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'标签名称-子\',
          `movie_sum` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'影片数量\',
          `status` tinyint(4) DEFAULT \'1\' COMMENT \' 1.未处理  2.已处理  \',
          `admin_id` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'处理用户id\',
          `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
          `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
          PRIMARY KEY (`id`),
          KEY `id_collection_label_id` (`id`) USING BTREE,
          KEY `id_collection_label_name` (`name`) USING BTREE,
          KEY `id_collection_label_admin_id` (`admin_id`) USING BTREE,
          KEY `id_collection_label_created_at` (`created_at`) USING BTREE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'采集标签表\';',

        'CREATE TABLE IF NOT EXISTS `collection_movie` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `number` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'番号\',
          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'影片名称/标题\',
          `source_site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'来源网站\',
          `source_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'来源路径\',
          `director` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'导演名称\',
          `sell` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'卖家\',
          `time` int(11) unsigned DEFAULT NULL COMMENT \'播放时长/秒\',
          `release_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'发布/发行时间\',
          `small_cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'小封面\',
          `big_cove` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'大封面\',
          `trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'预告片\',
          `map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 其他组图-预览图\',
          `series` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'系列\',
          `film_companies` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'片商\',
          `issued` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'发行\',
          `actor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 演员\',
          `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'类别\',
          `label` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 标签\',
          `score` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'评分\',
          `score_people` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'评分人数\',
          `comment_num` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'评论数\',
          `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 评论数组\',
          `actual_source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'\' COMMENT \'验证网址\',
          `flux_linkage_num` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'磁链信息数\',
          `flux_linkage` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 磁链信息\',
          `is_download` tinyint(4) DEFAULT \'1\' COMMENT \'状态 1.不可下载  2.可下载  \',
          `is_subtitle` tinyint(4) DEFAULT \'1\' COMMENT \'状态 1.不含字幕  2.含字幕  \',
          `is_new` tinyint(4) DEFAULT \'2\' COMMENT \'状态 1.是今日新种  2.否今日新种 \',
          `abnormal_data_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT \'json 数组 异常数据ID组\',  
          `status` tinyint(4) DEFAULT \'1\' COMMENT \' 1.未处理  2.已处理【人工处理】 3.系统处理 4.舍弃 5.异常数据需要人工处理\',
          `admin_id` int(11) unsigned NOT NULL DEFAULT \'0\' COMMENT \'处理用户id\',
          `ctime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'同步爬取时间\',
          `utime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'同步更新时间\',
          `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
          `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
          PRIMARY KEY (`id`),
          KEY `id_collection_movie_id` (`id`) USING BTREE,
          KEY `id_collection_movie_number` (`number`) USING BTREE,
          KEY `id_collection_movie_admin_id` (`admin_id`) USING BTREE,
          KEY `id_collection_movie_name` (`name`) USING BTREE,
          KEY `id_collection_movie_status` (`status`) USING BTREE,
          KEY `id_collection_movie_created_at` (`created_at`) USING BTREE
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT=\'采集影片信息表\';'


    ];
}