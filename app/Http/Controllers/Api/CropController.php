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
        $id = $request->input('id');
        $start_time = time();
        $data = [
            'code' => 1,
            'msg' => '裁剪失败',
        ];

        $movie = Movie::where('id',$id)->first();
        if(!$movie->big_cove){
            return response()->json($data);
        }
        $img = public_path('resources') . '/' . $movie->big_cove;
        if(!is_file($img)){
            return response()->json($data);
        }
        $movie = Movie::where('id',$id)->first();
        $file = public_path('resources').$movie->big_cove;
        $res = $this->crop($file,$movie->big_cove);
        if($res == false){
            return response()->json($data);
        }
        while (true){
            if(time() - $start_time > 15){
                return response()->json($data);
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

    public function crop($file,$filename)
    {
        if(!is_file($file)){
            return false;
        }
        try {
            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
            $path = dirname($filename);
            $new_filename = substr(md5(basename($filename)), 8, 16) . '_acp.';
            $new_file = ltrim($path . '/' . $new_filename . $file_ext,'/');
            if(is_file($new_file)){
                unlink($new_file);
            }
            $im = new \Imagick($file);
            $src_w = $im->getImageWidth();
            $src_h = $im->getImageHeight();

            $aim_w = 183;
            $aim_h = 250;
            $scale = $aim_w / $aim_h;
            if (1.47 < ($src_w / $src_h)) {
                $im->cropImage($scale * $src_h, $src_h, $src_w - $scale * $src_h, 0);
            }
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
