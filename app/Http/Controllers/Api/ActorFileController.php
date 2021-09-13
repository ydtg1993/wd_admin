<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CollectionMovie;
use App\Models\MovieActor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ActorFileController extends Controller
{
    //文件上传
    public function upload(Request $request)
    {
        //上传文件最大大小,单位M
        $maxSize = 5;
        //支持的上传图片类型
        $allowed_extensions = ["png", "jpg", "jpeg", "gif"];
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
        $actor = MovieActor::where('id', $id)->first();
        $before_file = $actor->photo;
        $base_dir = public_path('resources') . '/';
        if (is_file($base_dir . $before_file)) {
            unlink($base_dir . $before_file);
        }
        $new_dir = '/local_actor_photo/' . date('Ym') . '/';
        if (!is_dir($base_dir . $new_dir)) {
            mkdir($base_dir . $new_dir, 0777, true);
        }
        $newFile = substr(md5($file['name'] . time()), 8, 16) . "." . $ext;
        $res = move_uploaded_file($file['tmp_name'], $base_dir . $new_dir . $newFile);
        if (!$res) {
            throw new \Exception("文件上传失败:无文件操作权限");
        }
        if ($res) {
            MovieActor::where('id', $id)->update(['photo' => $new_dir . $newFile]);
            $data = [
                'code' => 0,
                'msg' => '上传成功',
            ];
            return response()->json($data);
        }
        return response()->json($data);
    }

    public function remove(Request $request)
    {
        $id = $request->input('id');
        $actor = MovieActor::where('id', $id)->first();
        $file = public_path('resources') . '/' . $actor->photo;
        is_file($file) && unlink($file);
        if (is_dir(dirname($file)) && !(new \FilesystemIterator(dirname($file)))->valid()) {
            rmdir(dirname($file));
        }
        MovieActor::where('id', $id)->update(['photo' => '']);
        return response()->json([]);
    }

}
