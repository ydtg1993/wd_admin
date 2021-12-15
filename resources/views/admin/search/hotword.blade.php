@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
           
        
        <form class="layui-form">

            <div class="layui-inline">
                <label for="" class="layui-form-label">热词配置</label>
                <div class="layui-input-inline">
                    <textarea name="keywords" id="keywords" rows="26" placeholder="热词" style="width:300px;"><?php foreach($keywords as $v){
                            echo $v->content.PHP_EOL;
                        }?></textarea>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="layui-btn-group" style="width:300px;text-align:center">
                <button class="layui-btn layui-btn-sm" lay-submit lay-filter="search" >刷新</button>
                <button class="layui-btn layui-btn-sm" lay-submit lay-filter="save" style="margin-left:30px;">保存</button>
            </div>
        </form>
        </div>

        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
        </div>
    </div>
@endsection

@section('script')
    @can('search.hotword')
        <script>

            layui.use(['layer', 'table', 'form'], function () {
                var $ = layui.jquery;
                var layer = layui.layer;

                var form = layui.form;
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    , autoSort: false
                    , height: 500
                    , url: "{{ route('admin.search.hotword.data') }}" //数据接口
                    , id:'queryList'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: '序号'}
                        , {field: 'keyword', title: '热词'}
                        , {field: 'nums', title: '搜索次数'}
                        , {field: 'updated_at', title: '更新时间'}
                    ]]
                });

                //刷新
                form.on('submit(search)',function (data) {
                    location.reload();
                    return false;
                });

                //保存
                form.on('submit(save)',function (data) {
                    $.post("{{route('admin.search.hotword.save')}}", {
                        keywords: $('#keywords').val(),
                    }, function (res) {
                        if (res.code == 0) {
                            layer.msg(res.msg, {icon:1});
                        } else {
                            layer.msg(res.msg, {icon: 2});
                        }
                    });
                    return false;
                })

            });

        </script>
    @endcan
@endsection
