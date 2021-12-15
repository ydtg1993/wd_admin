@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加广告</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.ads.list.store')}}" method="post">
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">广告名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" value="" lay-verify="required" placeholder="广告名称(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <input type="text" name="remark" value="" placeholder="描述" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">位置</label>
                    <div class="layui-input-block">
                        <select name="location" class="layui-input">
                            <?php foreach ($ty as $key => $value) {?>
                                <option value="<?php echo $key?>"><?php echo $value?></option>
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
                                    
                                </ul>
                                <input type="hidden" name="photo" class="layui-upload-input" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">跳转链接</label>
                    <div class="layui-input-block">
                        <input type="text" name="url" value="" lay-verify="required" placeholder="链接(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">开始时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="start_time" value="" lay-verify="required" placeholder="广告时间(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">结束时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="end_time" value="" lay-verify="required" placeholder="广告时间(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">权重</label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" value="0" lay-verify="required" placeholder="权重(必填)" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">关闭</label>
                    <div class="layui-input-block" style="width:300px;">
                        <p><input type="radio" name="is_close" value="2"  checked="checked" >不可关闭</p>
                        <p><input type="radio" name="is_close" value="1">可关闭</p>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">状态</label>
                    <div class="layui-input-block" style="width:300px;">
                        <p><input type="radio" name="status" value="1" checked="checked">上架中</p>
                        <p><input type="radio" name="status" value="2">下架</p>
                        <p><input type="radio" name="status" value="3">到期</p>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
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

            var laydate = layui.laydate;
                laydate.render({
                    elem: '#adstime'
                    ,type: 'datetime'
                    ,range: '~'
                });

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