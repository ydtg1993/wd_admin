<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/31
 * Time: 16:57
 */

namespace App\Services\Logic\Comm;


use App\Models\CommConf;
use App\Services\Logic\BaseError;
use App\Services\Logic\HandleLogic;

class ConfLogic extends HandleLogic
{

    protected $namePath = 'App\\Services\\Logic\\Comm\\';
    protected $baseClassName = 'BaseConfLogic';

    protected $typeClass = array(
        0=>'BaseConfLogic',
        CommConf::CONF_AD_INVESTMENT=>'AdInvestmentLogic',//广告招商
        CommConf::CONF_DOWN_SITE=>'DownLoadSettingLogic',//下载本站
        CommConf::CONF_ABOUT_US=>'AboutUsLogic',//关于我们
        CommConf::CONF_FRIENDY_LINK=>'FriendLinkLogic',//友情链接
        CommConf::CONF_PRIVACY_CLAUSE=>'PrivateItemLogic',//隐私条款
        CommConf::CONF_MAGNET_LINK=>'MagnetLinkLogic',//磁链使用教程
        CommConf::CONF_COMMENT_NOTES=>'CommentNotesLogic',//短评须知
        CommConf::CONF_FIRST_LOGIN=>'FirstLoginLogic',//首次登陆
        CommConf::CONF_APP_SHARP=>'AppSharpLogic',//app分享
    );




    public function saveConf($data,$type)
    {
        $this->errorInfo == null?$this->errorInfo = (new BaseError()):$this->errorInfo->reset();
        $runClassName =  $this->getClassName($type??0);
        if(!class_exists($runClassName))
        {
            $this->errorInfo->setCode('500','无效的处理对象！');
            return '';
        }
        $obj = new  $runClassName;
        $redata = $obj->saveConf($data);
        $this->errorInfo = $obj->getErrorInfo();
        return $redata;
    }

    public function getConf($type)
    {
        $this->errorInfo == null?$this->errorInfo = (new BaseError()):$this->errorInfo->reset();
        $runClassName =  $this->getClassName($type??0);
        if(!class_exists($runClassName))
        {
            $this->errorInfo->setCode('500','无效的处理对象！');
            return '';
        }
        $obj = new  $runClassName;
        $redata = $obj->getConf();
        $this->errorInfo = $obj->getErrorInfo();
        return $redata;
    }

    /**
     * 解析数据
     * @param $data
     * @param $type
     * @return string
     */
    public function resolveConf($data,$type)
    {
        $this->errorInfo == null?$this->errorInfo = (new BaseError()):$this->errorInfo->reset();
        $runClassName =  $this->getClassName($type??0);
        if(!class_exists($runClassName))
        {
            $this->errorInfo->setCode('500','无效的处理对象！');
            return '';
        }
        $obj = new  $runClassName;
        $redata = $obj->resolveConf($data);
        $this->errorInfo = $obj->getErrorInfo();
        return $redata;
    }


    public function assemblyConf($data,$type)
    {
        $this->errorInfo == null?$this->errorInfo = (new BaseError()):$this->errorInfo->reset();
        $runClassName =  $this->getClassName($type??0);
        if(!class_exists($runClassName))
        {
            $this->errorInfo->setCode('500','无效的处理对象！');
            return '';
        }
        $obj = new  $runClassName;
        $redata = $obj->assemblyConf($data);
        $this->errorInfo = $obj->getErrorInfo();
        return $redata;
    }

}
