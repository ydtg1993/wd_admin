<?php
/**
 *
 */

namespace App\Services\Logic\Comm;


use App\Models\CommConf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AboutUsLogic extends BaseConfLogic
{
    protected $type = 3;

    public function saveConf($data)
    {
        $dataInfo = CommConf::where('type',$this->type)->first();
        $id = $dataInfo['id']??0;

        $data = [
            'url'=>$data['url'],
            'content'=>$data['content'],
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
            'url'=>'',
            'content'=>'',
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
            'url'=>$values['url'],
            'content'=>$values['content'],
        ];
        return $res;
    }

}
