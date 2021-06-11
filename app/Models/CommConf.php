<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/31
 * Time: 16:53
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CommConf extends Model
{
    protected $table = 'comm_conf';

    const CONF_AD_INVESTMENT = 1;//广告招商
    const CONF_DOWN_SITE = 2;//下载本站
    const CONF_ABOUT_US = 3;//关于我们
    const CONF_FRIENDY_LINK = 4;//友情链接
    const CONF_PRIVACY_CLAUSE = 5;//隐私条款
    const CONF_MAGNET_LINK = 6;//磁链使用教程


        /*
         * 1.广告招商 2. 下载本站 3.关于我们 4.友情链接 5.隐私条款 6.磁链使用教程*/
}