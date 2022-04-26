@extends('admin.base')

@section('content')


    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>清除网站缓存</h2>
        </div>
        <div class="layui-card-body">
            <button class="clear" data-id="0">首页列表</button>
            <button class="clear" data-id="1">演员影片列表</button>
            <button class="clear" data-id="2">系列影片列表</button>
            <button class="clear" data-id="3">片商影片列表</button>
            <button class="clear" data-id="4">片单影片列表</button>
            <button class="clear" data-id="5">标签分类列表</button>
            <button class="clear" data-id="6">影片排行榜列表</button>
            <button class="clear" data-id="8">演员排行榜列表</button>
            <button class="clear" data-id="7">公共配置</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['element','form'],function () {

        })
        $('.clear').click(function () {
            var type = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('admin.conf.clearCache') }}",
                type:'POST',
                data:{type:type},
                success:function () {
                    alert('成功');
                }
            })
        })
    </script>

@endsection
