<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunSql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RunSql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sql = <<<EOF
alter table `movie_category` add column `show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1显示 0不显示';
EOF;
        \Illuminate\Support\Facades\DB::unprepared($sql);
        $sql = <<<EOF
alter table `movie_category` add column `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序';
EOF;
        \Illuminate\Support\Facades\DB::unprepared($sql);

        $sql = <<<EOF
alter table `batch_comment_script` add column `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型 0:影片评论批处理 1:话题评论批处理';
EOF;
        \Illuminate\Support\Facades\DB::unprepared($sql);

        $sql = <<<EOF
CREATE TABLE `article_comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '话题ID',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID/回复的用户ID',
  `cid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '归属评论ID 0表示顶级评论',
  `comment` text COLLATE utf8mb4_unicode_ci COMMENT '评论记录',
  `score` float DEFAULT '0' COMMENT '评分0代表没有评分',
  `type` tinyint(4) DEFAULT '1' COMMENT '评论类型 1.评论  2.回复  ',
  `reply_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复的目标用户ID',
  `status` tinyint(4) DEFAULT '1' COMMENT ' 1.正常  2.删除  ',
  `like` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '赞',
  `dislike` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '踩',
  `comment_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '评论时间',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `audit` tinyint(4) DEFAULT '1' COMMENT '审核状态：1.正常 0.待审核 -1.不通过',
  PRIMARY KEY (`id`),
  KEY `id_movie_comment_id` (`id`) USING BTREE,
  KEY `id_movie_comment_uid` (`uid`) USING BTREE,
  KEY `id_movie_comment_aid` (`aid`) USING BTREE,
  KEY `id_movie_comment_cid` (`cid`) USING BTREE,
  KEY `id_movie_comment_type` (`type`) USING BTREE,
  KEY `id_movie_comment_reply_uid` (`reply_uid`) USING BTREE,
  KEY `id_movie_comment_created_at` (`created_at`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='话题评论表';
EOF;
        \Illuminate\Support\Facades\DB::unprepared($sql);
    }
}
