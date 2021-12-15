@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
           
        
        <form class="layui-form">

            <div class="layui-inline">
                <label for="" class="layui-form-label">域名配置(需要http或者https开头)</label>
                <div class="layui-input-inline">
                    <textarea name="content" id="content" rows="10" placeholder="域名" style="width:300px;"></textarea>
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
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    <a class="layui-btn layui-btn-sm" lay-event="del">删除</a>
                </div>
            </script>
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
                    , url: "{{ route('admin.conf.domain.data') }}" //数据接口
                    , id:'queryList'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: 'id'}
                        , {field: 'domain', title: '域名'}
                        , {field: 'created_at', title: '创建时间'}
                        , {fixed: 'right', width: 260, align: 'center', toolbar: '#options'}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值

                    if (layEvent === 'del') {
                        layer.confirm('确认删除吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.conf.domain.destroy') }}", {
                                ids: [data.id]
                            }, function (res) {
                                layer.close(load);
                                if (res.code == 0) {
                                    layer.msg(res.msg, {icon: 1}, function () {
                                        obj.del();
                                    })
                                } else {
                                    layer.msg(res.msg, {icon: 2})
                                }
                            });
                        });
                    }
                });

                //刷新
                form.on('submit(search)',function (data) {
                    location.reload();
                    return false;
                });

                //保存
                form.on('submit(save)',function (data) {
                    $.post("{{route('admin.conf.domain.save')}}", {
                        content: $('#content').val(),
                    }, function (res) {
                        if (res.code == 0) {
                            layer.msg(res.msg, {icon:1});
                        } else {
                            layer.msg(res.msg, {icon: 2});
                        }
                    });
                    return true;
                })

            });

        </script>
    @endcan
@endsection
