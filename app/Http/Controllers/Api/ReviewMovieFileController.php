<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CollectionMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ReviewMovieFileController extends Controller
{
    //文件上传
    public function upload(Request $request)
    {
        //上传文件最大大小,单位M
        $maxSize = 10;
        //支持的上传图片类型
        $allowed_extensions = ["png", "jpg", "jpeg", "gif","mp4", "mpg", "mpeg","avi","rmvb"];
        //返回信息json
        $data = ['code' => 1, 'msg' => '上传失败', 'data' => ''];

        $name = $request->name;
        $id = $request->id;
        if (!isset($_FILES[$name]) || empty($_FILES[$name])) {
            return response()->json($data);
        }
        $file = $_FILES[$name];
        //检查文件是否上传完成
        $ext = basename($file['type']);
        if (!in_array($ext, $allowed_extensions)) {
            $data['msg'] = "请上传" . implode(",", $allowed_extensions) . "格式的图片";
            return response()->json($data);
        }
        if ($file['size'] > $maxSize * 1024 * 1024) {
            $data['msg'] = "图片大小限制" . $maxSize . "M";
            return response()->json($data);
        }
        $movie = CollectionMovie::where('id', $id)->first();
        $before_file = $movie->{$name};
        $base_dir = public_path('resources') . '/';
        if (is_file($base_dir . $before_file)) {
            unlink($base_dir . $before_file);
        }
        $newDir = $base_dir . '/' . $movie->source_site . '/' . md5($movie->source_url);
        if (!is_dir($newDir)) {
            mkdir($newDir, 0777, true);
            chmod($newDir, 0777);
        }
        $newFile = substr(md5($file['name']), 8, 16) . "." . $ext;
        $res = move_uploaded_file($file['tmp_name'], $newDir . '/' . $newFile);
        if ($res) {
            CollectionMovie::where('id', $id)->update([$name => $movie->source_site . '/' . md5($movie->source_url) . '/' . $newFile]);
            $data = [
                'code' => 0,
                'msg' => '上传成功',
            ];
            return response()->json($data);
        }
        return response()->json($data);
    }

    //文件上传
    public function batchUpload(Request $request)
    {
        //上传文件最大大小,单位M
        $maxSize = 5;
        //支持的上传图片类型
        $allowed_extensions = ["png", "jpg", "jpeg", "gif"];
        //返回信息json
        $data = ['code' => 1, 'msg' => '上传失败', 'data' => ''];

        $name = $request->name;
        $id = $request->id;

        if (!isset($_FILES[$name])) {
            return response()->json($data);
        }

        $index = 0;
        $total = count($_FILES[$name]['name']);
        while (true) {
            if($index>=$total){
                break;
            }
            $file = $_FILES[$name];
            //检查文件是否上传完成
            $ext = basename($file['type'][$index]);
            if (!in_array($ext, $allowed_extensions)) {
                $data['msg'] = "请上传" . implode(",", $allowed_extensions) . "格式的图片";
                return response()->json($data);
            }
            if ($file['size'][$index] > $maxSize * 1024 * 1024) {
                $data['msg'] = "图片大小限制" . $maxSize . "M";
                return response()->json($data);
            }
            $movie = CollectionMovie::where('id', $id)->first();
            $before_file = $movie->{$name};
            $base_dir = public_path('resources') . '/';
            if (is_file($base_dir . $before_file)) {
                unlink($base_dir . $before_file);
            }
            $newDir = $base_dir . '/' . $movie->source_site . '/' . md5($movie->source_url);
            if (!is_dir($newDir)) {
                mkdir($newDir, 0777, true);
                chmod($newDir, 0777);
            }
            $newFile = substr(md5($file['name'][$index]), 8, 16) . "." . $ext;
            $res = move_uploaded_file($file['tmp_name'][$index], $newDir . '/' . $newFile);
            if ($res) {
                $map = (array)json_decode($movie->map);
                $map[] = $movie->source_site . '/' . md5($movie->source_url) . '/' . $newFile;
                CollectionMovie::where('id', $id)->update([$name => json_encode($map)]);
            }
            $index++;
        }
        return response()->json($data);
    }

    public function remove(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $key = $request->input('key');

        if ($name == 'big_cove' || $name == 'small_cover' || $name == 'trailer') {
            $movie = CollectionMovie::where('id', $id)->first();
            $file = public_path('resources') . '/' . $movie->{$name};
            is_file($file) && unlink($file);
            if(is_dir(dirname($file)) && !(new \FilesystemIterator(dirname($file)))->valid()){
                rmdir(dirname($file));
            }
            CollectionMovie::where('id', $id)->update([$name => '']);
        } elseif ($name == 'map') {
            $movie = CollectionMovie::where('id', $id)->first();
            $map = (array)json_decode($movie->map);
            if (in_array($key, $map)) {
                $file = public_path('resources') . '/' . $key;
                is_file($file) && unlink($file);
                if(!(new \FilesystemIterator(dirname($file)))->valid()){
                    rmdir(dirname($file));
                }
                array_splice($map, array_search($key, $map), 1);
                CollectionMovie::where('id', $id)->update(['map' => $map]);
            }
        }

        return response()->json([]);
    }

}
