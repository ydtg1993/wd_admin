<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/4
 * Time: 2:32
 */


class ToolController
{

    /**
     * @api {Post} /api/file/uploadProfilePhoto 上传头像
     * @apiName  上传头像
     * @apiGroup 工具接口
     * @apiDescription 上传头像
     *
     * @apiParam {file} file
     * @apiParam {String} token token
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     *    * @apiSuccessExample  {json} success-example
        {
            "code": 200,
            "msg": "成功！",
    "data": {
    "netUrl": "/public/uploads/avatar/2021-07-28_1627445309_6100d83ddbed3.png",//full path for display
    "saveUrl": "/public/uploads/avatar/2021-07-28_1627445309_6100d83ddbed3.png"//for save to backend
    }
        }

     */
    public function uploadProfilePhoto()
    {

    }

    /**
     * @api {Post} /api/file/upload/piece/list 上传片单图
     * @apiName  上传片单图
     * @apiGroup 工具接口
     * @apiDescription 上传片单图
     *
     * @apiParam {file} file
     * @apiParam {String} token token
     *
     * @apiSuccess {String} code 响应码 200 正确 其他错误
     *    * @apiSuccessExample  {json} success-example
    {
    "code": 200,
    "msg": "成功！",
    "data": {
    "netUrl": "/public/uploads/avatar/2021-07-28_1627445309_6100d83ddbed3.png",//full path for display
    "saveUrl": "/public/uploads/avatar/2021-07-28_1627445309_6100d83ddbed3.png"//for save to backend
    }
    }

     */
    public function uploadPieceList()
    {

    }






}
