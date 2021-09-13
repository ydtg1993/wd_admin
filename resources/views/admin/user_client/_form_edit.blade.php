{{csrf_field()}}


<div class="layui-form-item">
    <label for="" class="layui-form-label">用户id</label>
    <div class="layui-input-inline">
        <input type="text" disabled value="{{ $userClient->number ?? '' }}" lay-verify="required" placeholder="请输入用户昵称" class="layui-input"  style="width: 150%" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">用户昵称</label>
    <div class="layui-input-inline">
        <input type="text" name="nickname" value="{{ $userClient->nickname ?? '' }}" lay-verify="required" placeholder="请输入用户昵称" class="layui-input" >
    </div>
</div>



<div class="layui-form-item">
    <label for="" class="layui-form-label">登录邮箱</label>
    <div class="layui-input-inline">
        <input name="email"  placeholder="请输入登录邮箱" class="layui-input" value="{{ $userClient->email ?? '' }}"></input>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">用户类型</label>
    <div class="layui-input-inline">
        <select name="type" lay-verify="required" id="type">
            <option value="1" @if (isset($userClient)&&($userClient->type==1))  selected @endif>普通用户</option>
            <option value="2" @if (isset($userClient)&&($userClient->type==2))  selected @endif>运营用户</option>
            <option value="3" @if (isset($userClient)&&($userClient->type==3))  selected @endif>vip用户</option>
        </select>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">性别</label>
    <div class="layui-input-inline">
        <select name="sex" lay-verify="required" id="sex">
            <option value="0" @if (isset($userClient)&&($userClient->sex==0))  selected @endif>未知</option>
            <option value="1" @if (isset($userClient)&&($userClient->sex==1))  selected @endif>男</option>
            <option value="2" @if (isset($userClient)&&($userClient->sex==2))  selected @endif>女</option>
        </select>
    </div>
</div>


{{--<div class="layui-form-item">--}}
{{--    <label for="" class="layui-form-label">上传头像</label>--}}
{{--    <button type="button" class="layui-btn" id="upload">--}}
{{--        <i class="layui-icon">&#xe67c;</i>上传头像--}}
{{--    </button>--}}
{{--</div>--}}


<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.user_client.index')}}" >返 回</a>
    </div>
</div>


<script>
    // layui.use('upload', function(){
    //     var upload = layui.upload;
    //
    //     //执行实例
    //     var uploadInst = upload.render({
    //         elem: '#upload' //绑定元素
    //         ,url: '/upload/' //上传接口
    //         ,done: function(res){
    //             //上传完毕回调
    //         }
    //         ,error: function(){
    //             //请求异常回调
    //         }
    //     });
    // });
</script>
