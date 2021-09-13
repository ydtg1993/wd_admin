<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/29
 * Time: 14:29
 */

namespace App\Services\Logic\SqlUpdate;


use App\Models\MovieCategory;
use Illuminate\Support\Facades\DB;

class InitData extends Base
{
    //主库操作处理
    public function upDateTableDB()
    {
        $array = [
            1=>'有码',
            2=>'无码',
            3=>'欧美',
            4=>'FC2',
        ];

        $tables = [
            'movie_category',
            'movie_actor_category',
            'movie_film_companies_category',
            'movie_label_category',
            'movie_series_category',
        ];

        //初始化类别数据
        foreach ($tables as $valTable)
        {
            foreach ($array as $k=> $val)
            {
                $movieCategoryDb = DB::table($valTable)->where('name',$val)->first();
                if(($movieCategoryDb['id']??0)<=0)
                {
                    $movieCategoryDbID = DB::table($valTable)->where('id',$k)->first();
                    if(($movieCategoryDbID['id']??0)<=0)
                    {
                        DB::table($valTable)->insertGetId(['id'=>$k,
                                'name'=>$val,
                                'status'=>1,
                                ]
                        );
                    }
                }
            }
        }

        
    }
}