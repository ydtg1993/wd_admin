<?php

namespace App\Models;

use App\Services\Logic\Common;
use Illuminate\Database\Eloquent\Model;

class MovieLabelCategoryAss extends Model
{
    protected $table = 'movie_label_category_associate';

    /**
     * 写入数据 
    */
    public static function associate($da,$lid)
    {
        if(count($da)>0)
        {
            foreach($da as $v)
            {
                $res = self::select('id')->where('lid',$lid)->where('cid',$v)->first();
                if($res && isset($res->id) && $res->id>0)
                {
                    self::where("id",$res->id)->update(['status'=>1]);
                }else{
                    self::insert(['lid' => $lid, 'cid' => $v]);
                }
            }
        }
    }
}
