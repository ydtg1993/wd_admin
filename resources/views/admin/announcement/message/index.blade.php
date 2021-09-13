@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group ">
                @can('announcement.message.create_message')
                    <a class="layui-btn layui-btn-sm" href="{{ route('admin.message.create_message') }}">添 加</a>
                @endcan
            </div>
        </div>
        <form class="layui-form">
            <div class="layui-inline" >
                <label for="" class="layui-form-label">日期时间</label>
                <div class="layui-input-inline">
                    <input type="text" name="created_at_start" id="created_at_start" placeholder="开始时间" readonly class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <div class="layui-form-mid">-</div>
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="created_at_end" id="created_at_end" placeholder="结束时间" readonly class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label for="" class="layui-form-label">公告id</label>
                <div class="layui-input-inline">
                    <input type="text" name="uuid"  placeholder="公告id"  class="layui-input">
                </div>
            </div>
            <div class="layui-btn-group ">
                {{--                    @can('system.operate_log.destroy')--}}
                {{--                        <button type="button" class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">删 除</button>--}}
                {{--                    @endcan--}}
                <button class="layui-btn layui-btn-sm" lay-submit lay-filter="search" >搜 索</button>
            </div>
        </form>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('announcement.message.edit_message')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan
                    @can('announcement.message.destroy_message')
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                    @endcan
                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('announcement.message')
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
                    , url: "{{ route('admin.top.data') }}"+"?type=3" //数据接口
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: '序号', sort: true, width: 80}
                        , {field: 'uuid', title: '公告id'}
                        , {field: 'title', title: '公告标题'}
                        , {field: 'content', title: '公告内容'}
                        , {field: 'url',  title: '公告链接'}
                        , {field: 'created_at', title: '创建时间'}
                        , {fixed: 'right', width: 100, align: 'center', toolbar: '#options'}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值
                    if (layEvent === 'del') {
                        layer.confirm('确认删除吗？', function (index) {
                            layer.close(index);
                            var load = layer.load();
                            $.post("{{ route('admin.message.destroy_message') }}", {
                                _method: 'delete',
                                id: data.id
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
                    } else if (layEvent === 'edit') {
                        location.href = '/admin/message/' + data.id + '/edit_message';
                    }
                });
                //搜索
                form.on('submit(search)',function (data) {
                    dataTable.reload({
                        where:data.field,
                        page:{cur:1}
                    });
                    return false;
                })
                layui.use('laydate', function(){
                    var laydate = layui.laydate;

                    //执行一个laydate实例
                    laydate.render({
                        elem: '#created_at_start', //指定元素
                    });
                });
                layui.use('laydate', function(){
                    var laydate = layui.laydate;

                    //执行一个laydate实例
                    laydate.render({
                        elem: '#created_at_end', //指定元素
                    });
                });
            })

        </script>
    @endcan
@endsection
