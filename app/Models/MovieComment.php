<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieComment extends Model
{
    protected $table = 'movie_comment';

    const COMMENT_SORT_TYPE =[
        0=>'未知',
        1=>'用户评论',
        2=>'虚拟用户评论',
        3=>'采集评论',
    ];
}
