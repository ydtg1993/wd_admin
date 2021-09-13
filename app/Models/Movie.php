<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movie';


    /**
     * @Description 关联演员影片表
     * @DateTime    2018-10-31
     * @copyright   [copyright]
     * @return      [type]      [description]
     */
    public function actors()
    {
        return $this->belongsToMany('App\Models\MovieActor', 'movie_actor_associate', 'mid', 'aid');
    }

    /**
     * @Description 关联演员影片表
     * @DateTime    2018-10-31
     * @copyright   [copyright]
     * @return      [type]      [description]
     */
    public function directors()
    {
        return $this->belongsToMany('App\Models\MovieDirector', 'movie_director_associate', 'mid', 'did');
    }


}
