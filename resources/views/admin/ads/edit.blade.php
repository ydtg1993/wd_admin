@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>修改广告</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.ads.list.update')}}" method="post">
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">广告名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" value="{{$info->name}}" lay-verify="required" placeholder="广告名称(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <input type="text" name="remark" value="{{$info->remark}}" placeholder="描述" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">位置</label>
                    <div class="layui-input-block">
                        <select name="location" class="layui-input">
                            <?php foreach ($ty as $key => $value) {?>
                                <option value="<?php echo $key?>" <?php if($info->location==$key){?>selected="selected"<?php }?>><?php echo $value?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">图片上传</label>
                    <div class="layui-input-block">
                        <div class="layui-upload">
                            <button type="button" class="layui-btn layui-btn-sm uploadPic"><i class="layui-icon">&#xe67c;</i>图片上传</button>
                            <div class="layui-upload-list" >
                                <ul class="layui-upload-box layui-clear">
                                    <img src="{{$info->photo}}" width="300" />
                                </ul>
                                <input type="hidden" name="photo" class="layui-upload-input" value="{{$info->photo}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">跳转链接</label>
                    <div class="layui-input-block">
                        <input type="text" name="url" value="{{$info->url}}" lay-verify="required" placeholder="链接(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">开始时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="start_time" value="{{$info->start_time}}" lay-verify="required" placeholder="广告时间(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">结束时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="end_time" value="{{$info->end_time}}" lay-verify="required" placeholder="广告时间(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">权重</label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" value="{{$info->sort}}" lay-verify="required" placeholder="权重(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">关闭</label>
                    <div class="layui-input-block" style="width:300px;">
                        <p><input type="radio" name="is_close" value="2" <?php if($info->is_close==2){?>checked="checked"<?php }?>>不可关闭</p>
                        <p><input type="radio" name="is_close" value="1" <?php if($info->is_close==1){?>checked="checked"<?php }?>>可关闭</p>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">状态</label>
                    <div class="layui-input-block" style="width:300px;">
                        <p><input type="radio" name="status" value="1" <?php if($info->status==1){?>checked="checked"<?php }?>>上架中</p>
                        <p><input type="radio" name="status" value="2" <?php if($info->status==2){?>checked="checked"<?php }?>>下架</p>
                        <p><input type="radio" name="status" value="3" <?php if($info->status==3){?>checked="checked"<?php }?>>到期</p>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <input type="hidden" name="id" value="{{$info->id}}">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.ads.list.index')}}" >返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['upload','layer','element','form','laydate'],function () {
            var $ = layui.jquery;
            var upload = layui.upload;

            //普通图片上传
            $(".uploadPic").each(function (index,elem) {
                upload.render({
                    elem: $(elem)
                    ,url: '{{ route("api.upload") }}'
                    ,multiple: false
                    ,data:{"_token":"{{ csrf_token() }}"}
                    ,done: function(res){
                        //如果上传失败
                        if(res.code == 0){
                            layer.msg(res.msg,{icon:1},function () {
                                $(elem).parent('.layui-upload').find('.layui-upload-box').html('<li><img src="'+res.url+'" /><p>上传成功</p></li>');
                                $(elem).parent('.layui-upload').find('.layui-upload-input').val(res.url);
                            })
                        }else {
                            layer.msg(res.msg,{icon:2})
                        }
                    }
                });
            })
        })
    </script>
@endsection