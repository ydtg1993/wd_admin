<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/31
 * Time: 19:08
 */

namespace App\Services\Logic\Comm;


use App\Models\CommConf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdInvestmentLogic extends BaseConfLogic
{
    protected $type = 1;

    public function saveConf($data)
    {
        $dataInfo = CommConf::where('type',$this->type)->first();
        $id = $dataInfo['id']??0;
        $data = [
            'email'=>$data['email'],
            'url'=>$data['url']
        ];
        $dataObj = ($id <= 0)?(new CommConf()):CommConf::find($id);

        $dataObj->type = $this->type;
        $dataObj->values = json_encode($data);
        $dataObj->status = 1;
        $dataObj->save();
        return true;
    }

    public function getConf()
    {
        $res =  [
            'id'=>0,
            'type'=>$this->type,
            'email'=>'',
            'url'=>'',
        ];
        $dataInfo = CommConf::where('type',$this->type)->first();
        $dataInfo = ($dataInfo ? ($dataInfo->toArray()):[]);
        if(empty($dataInfo)){
            return $res;
        }
        $values = json_decode($dataInfo['values'],true);
        $res =  [
            'id'=>$dataInfo['id'],
            'type'=>$this->type,
            'email'=>$values['email'],
            'url'=>$values['url'],
        ];
        return $res;
    }
}
