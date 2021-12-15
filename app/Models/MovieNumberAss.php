<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MovieNumberAss extends Model
{
    protected $table = 'movie_number_associate';

    /**
     * 计算番号组的影片数量
    */
    public static function getCount($nid = 0)
    {
        return self::where('nid',$nid)->count();
    }
}
