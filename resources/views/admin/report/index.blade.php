@extends('admin.base')

@section('content')
    <div class="layui-card">
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
                <label for="" class="layui-form-label">番号</label>
                <div class="layui-input-inline">
                    <input type="text" name="avid"  placeholder="番号"  class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label for="" class="layui-form-label">用户id/昵称</label>
                <div class="layui-input-inline">
                    <input type="text" name="u_number"  placeholder="用户id/昵称"  class="layui-input">
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
        </div>
    </div>
@endsection

@section('script')
    @can('report.index')
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
                    , url: "{{ route('admin.report.data') }}" //数据接口
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: '序号', sort: true, width: 80}
                        , {field: 'uuid', title: '信息id'}
                        , {field: 'u_number', title: '用户名'}
                        , {field: 'avid', title: '关联番号'}
                        , {field: 'content',  title: '举报内容'}
                        , {field: 'reason',  title: '举报原因'}
                        , {field: 'created_at', title: '举报时间'}
                        , {field: 'rremark', title: '备注'}
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
                            $.post("{{ route('admin.content.destroy_content') }}", {
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
                        location.href = '/admin/content/' + data.id + '/edit_content';
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
