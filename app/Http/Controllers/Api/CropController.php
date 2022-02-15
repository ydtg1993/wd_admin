<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CollectionMovie;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class CropController extends Controller
{
    //文件上传
    public function index(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit','256M');
        $id = $request->input('id');
        $points = $request->input('points');
        $start_time = time();

        $movie = Movie::where('id',$id)->first();
        if(!$movie->big_cove){
            return response()->json([
                'code' => 1,
                'msg' => '无效影片记录id',
            ]);
        }
        $img = rtrim(public_path('resources'),'/') . '/' . $movie->big_cove;
        if(!is_file($img)){
            return response()->json([
                'code' => 1,
                'msg' => '大图资源获取失败',
            ]);
        }
        $res = $this->crop($img,$movie->big_cove,$points);
        if($res == false){
            return response()->json([
                'code' => 1,
                'msg' => '裁剪失败',
            ]);
        }
        while (true){
            if(time() - $start_time > 15){
                return response()->json([
                    'code' => 1,
                    'msg' => '裁剪超时',
                ]);
            }
            if(is_file(public_path('resources') . '/' . $res)){
                break;
            }
        }
        Movie::where('id',$id)->update(['small_cover'=>$res]);
        return response()->json([
            'code' => 0,
            'msg' => $res
        ]);
    }

    public function crop($file,$filename,$points)
    {
        if(!is_file($file)){
            return false;
        }
        try {
            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
            $path = dirname($filename);
            $new_filename = substr(md5(basename($filename)), 8, 16) . '_acp.';
            $new_file = ltrim($path . '/' . $new_filename . $file_ext,'/');
            if(is_file(public_path('resources') . '/' . $new_file)){
                unlink(public_path('resources') . '/' . $new_file);
            }
            $im = new \Imagick($file);
            $src_w = $im->getImageWidth();
            $src_h = $im->getImageHeight();

            $aim_w = 285;
            $aim_h = 160;
            $im->cropImage($points[2]-$points[0], $points[3]-$points[1], $points[0], $points[1]);
            $im->setImageCompressionQuality(100);
            $im->scaleImage($aim_w, $aim_h);
            $im->writeImage(public_path('resources') . '/' . $new_file);
            $im->destroy();
        }catch (\Exception $e){
            return false;
        }
        return $new_file;
    }

}
