
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/static/admin/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/layuiadmin/style/admin.css" media="all">
    <!-- 引用jquery -->
    <script src="/jquery.min.js"></script>
    <style type="text/css">
        .divX{
            width:12px;
            height:12px;
            border-radius:60%;
            position:absolute;
            top:-6px;
            right:-6px;
        }
    </style>
</head>
<body>

<div class="layui-fluid">
    @yield('content')
</div>

<script src="/static/admin/layuiadmin/layui/layui.js"></script>
<script>
    function newTab(url,tit){
        if(top.layui.index){
            top.layui.index.openTabsPage(url,tit)
        }else{
            window.open(url)
        }
    }

    layui.config({
        base: '/static/admin/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['layer'],function () {
        var $ = layui.jquery;
        var layer = layui.layer;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //错误提示
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                layer.msg("{{$error}}",{icon:2});
                @break
            @endforeach
        @endif

        //一次性正确信息提示
        @if(session('success'))
            layer.msg("{{session('success')}}",{icon:1});
        @endif

        //一次性错误信息提示
        @if(session('error'))
        layer.msg("{{session('error')}}",{icon:2});
        @endif

    });

    //判断图片是否存在
    function CheckImgExists(imgurl) {
        var ImgObj = new Image();
        ImgObj.src = imgurl;

        console.log(ImgObj);

        //存在图片
        if (ImgObj.fileSize > 0 || (ImgObj.width > 0 && ImgObj.height > 0)) {
          return true;
        } else {
          return false;
        }
    }
</script>
@yield('script')
</body>
</html>



