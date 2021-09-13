<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/5/31
 * Time: 16:58
 */

namespace App\Services\Logic\Comm;


use App\Services\Logic\BaseLogic;

class BaseConfLogic extends BaseLogic
{

    protected $type = 0;

    public function saveConf($data)
    {
        /*1. ad_investment 2. Download this site 3. About us 4. Friendly link 5. Privacy clause 6. Magnet link usage tutorial*/
        return $data;
    }

    public function getConf()
    {

        return [];
    }

    public function resolveConf($dataInfo)
    {
        return $dataInfo;
    }

    public function assemblyConf($data)
    {
        return $data;
    }





}
