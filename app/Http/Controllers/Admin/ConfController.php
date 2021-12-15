<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/31
 * Time: 17:09
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommConf;
use App\Services\Logic\Comm\ConfLogic;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ConfController  extends Controller
{
    /**
     * 广告招商
     * @return \Illuminate\Contracts\View\View
     */
    public function adInvestment()
    {
        $conf = new ConfLogic();
        $dataInfo  = $conf->getConf(CommConf::CONF_AD_INVESTMENT);
        return View::make('conf.ad_investment',compact('dataInfo'));
    }
    /**
     * 保存配置
     * @return \Illuminate\Contracts\View\View
     */
    public function saveAdInVestMent(Request $request)
    {
        return self::saveCommon($request);

    }

    /**
     * 下载本站app
     * @return \Illuminate\Contracts\View\View
     */
    public function downloadAppSettingView()
    {
        $conf = new ConfLogic();
        $dataInfo  = $conf->getConf(CommConf::CONF_DOWN_SITE);
        return View::make('conf.download_app_setting',compact('dataInfo'));
    }

    /**
     * 保存配置
     * @return \Illuminate\Contracts\View\View
     */
    public function saveDownloadAppSetting(Request $request)
    {
        return self::saveCommon($request);

    }

    /**
     * 关于我们
     * @return \Illuminate\Contracts\View\View
     */
    public function aboutUsView()
    {
        $conf = new ConfLogic();
        $dataInfo  = $conf->getConf(CommConf::CONF_ABOUT_US);
        return View::make('conf.about_us',compact('dataInfo'));
    }
    /**
     * 保存配置
     * @return \Illuminate\Contracts\View\View
     */
    public function saveAboutUs(Request $request)
    {
        return self::saveCommon($request);

    }

    /**
     * 友情链接
     * @return \Illuminate\Contracts\View\View
     */
    public function friendLinkView()
    {
        $conf = new ConfLogic();
        $dataInfo  = $conf->getConf(CommConf::CONF_FRIENDY_LINK);
//        print_r($dataInfo);
//        exit;
        return View::make('conf.friend_link',compact('dataInfo'));
    }
    /**
     * 保存配置
     * @return \Illuminate\Contracts\View\View
     */
    public function saveFriendLink(Request $request)
    {
        return self::saveCommon($request);

    }


    /**
     * 隐私条款
     * @return \Illuminate\Contracts\View\View
     */
    public function privateItemView()
    {
        $conf = new ConfLogic();
        $dataInfo  = $conf->getConf(CommConf::CONF_PRIVACY_CLAUSE);
        return View::make('conf.private_item',compact('dataInfo'));
    }
    /**
     * 保存配置
     * @return \Illuminate\Contracts\View\View
     */
    public function savePrivateItem(Request $request)
    {
        return self::saveCommon($request);

    }

    /**
     * 词条链接
     * @return \Illuminate\Contracts\View\View
     */
    public function magnetLinkView()
    {
        $conf = new ConfLogic();
        $dataInfo  = $conf->getConf(CommConf::CONF_MAGNET_LINK);

        return View::make('conf.magnet_link',compact('dataInfo'));
    }
    /**
     * 保存配置
     * @return \Illuminate\Contracts\View\View
     */
    public function saveMagnetLink(Request $request)
    {
        return self::saveCommon($request);

    }

    /**
     * 短评须知
     * @return \Illuminate\Contracts\View\View
     */
    public function commentNotesView()
    {
        $conf = new ConfLogic();
        $dataInfo  = $conf->getConf(CommConf::CONF_COMMENT_NOTES);
        return View::make('conf.comment_notes',compact('dataInfo'));
    }
    /**
     * 保存配置
     * @return \Illuminate\Contracts\View\View
     */
    public function saveCommentNotes(Request $request)
    {
        return self::saveCommon($request);

    }


    /**
     * 保存配置
     * @return \Illuminate\Contracts\View\View
     */
    public function save(Request $request)
    {

    }

    protected function saveCommon(Request $request){
        $viewMap = [
            1=>'admin.conf.ad_investment',
            2=>'admin.conf.download_app_setting',
            3=>'admin.conf.about_us',
            4=>'admin.conf.friend_link',
            5=>'admin.conf.private_item',
            6=>'admin.conf.magnet_link',
            7=>'admin.conf.comment_notes',
        ];
        $data = $request->input();
        Log::info('数据：'.json_encode($data));
        try{
            $conf = new ConfLogic();
            $conf->saveConf($data,$data['type']??0);
//            print_r(URL::route($viewMap[$data['type']]));
            return Redirect::to(URL::route($viewMap[$data['type']]))->with(['success'=>'更新成功']);
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('更新失败');
        }
    }





}
