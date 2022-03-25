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
CREATE TABLE `user_like_comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `cid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '评论ID',
  `type` tinyint(4) DEFAULT '1' COMMENT '类型 1.赞  2.踩  ',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态 1.正常  2.删除  ',
  `like_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '收藏时间',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `id_user_like_comment_id` (`id`) USING BTREE,
  KEY `id_user_like_comment_uid` (`uid`) USING BTREE,
  KEY `id_user_like_comment_type` (`type`) USING BTREE,
  KEY `id_user_like_comment_cid` (`cid`) USING BTREE,
  KEY `id_user_like_comment_like_time` (`like_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='用户点赞记录'
EOF;
        \Illuminate\Support\Facades\DB::unprepared($sql);
        $sql = <<<EOF
alter table `movie_comment` add column `m_like` int(11) NOT NULL DEFAULT '0' COMMENT '人工加赞';
EOF;
        \Illuminate\Support\Facades\DB::unprepared($sql);
        $sql = <<<EOF
alter table `movie_comment` add column `m_dislike` int(11) NOT NULL DEFAULT '0' COMMENT '人工点踩';
EOF;
        \Illuminate\Support\Facades\DB::unprepared($sql);

    }
}
