<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/21
 * Time: 15:41
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class MoviePiece extends Model
{
    protected $table = 'movie_piece_list';

    public function pieceMovies()
    {
        return $this->hasMany(PieceListMovies::class,'plid','id');
    }
}
