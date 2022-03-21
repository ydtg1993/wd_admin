<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/31
 * Time: 16:53
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class CommConf extends Model
{
    protected $table = 'comm_conf';


    const CONF_AD_INVESTMENT = 1;//广告招商
    const CONF_DOWN_SITE = 2;//下载本站
    const CONF_ABOUT_US = 3;//关于我们
    const CONF_FRIENDY_LINK = 4;//友情链接
    const CONF_PRIVACY_CLAUSE = 5;//隐私条款
    const CONF_MAGNET_LINK = 6;//磁链使用教程
    const CONF_COMMENT_NOTES = 7; //短评须知
    const CONF_FIRST_LOGIN = 8; //首次登陆须知
    const CONF_APP_SHARP = 9; //app分享

        /*
         * 1.广告招商 2. 下载本站 3.关于我们 4.友情链接 5.隐私条款 6.磁链使用教程*/

    //通知
    public static function boot(){
        parent::boot();
        static::saved(function ($model){
             $redisPrefix = "Conf:";
              $keyMap = [
                1=>'ad_investment',
                2=>'download_setting',
                3=>'about_us',
                4=>'friend_link',
                5=>'private_item',
                6=>'magnet_link',
                7=>'comment_notes',
                8=>'first_login',
                9=>'app_sharp',
             ];
            $cacheKey = $redisPrefix.$keyMap[$model->type];
            $cacheKeyAll = $redisPrefix.'all';
            $redis = Redis::connection();
            $redis->del($cacheKey,$cacheKeyAll);
        });
    }
}
