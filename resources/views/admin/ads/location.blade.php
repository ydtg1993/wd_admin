@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-sm" href="{{route('admin.ads.location.create')}}" >添 加</a>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    <a class="layui-btn layui-btn-sm layui-btn-normal" lay-event="start">启用</a>
                    <a class="layui-btn layui-btn-sm layui-btn-warm" lay-event="close">关闭</a>
                    @can('ads.location.edit')
                    <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan
                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
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
                    , url: "{{ route('admin.ads.location.data') }}" //数据接口
                    , id:'queryList'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: 'id'}
                        , {field: 'location', title: '位置'}
                        , {field: 'name', title: '描述'}
                        , {field: 'status', title: '状态'}
                        , {fixed: 'right', width: 150, align: 'center', toolbar: '#options'}
                    ]],
                    done: function(res, curr, count){
                        var that = this.elem.next();
                        res.data.forEach(function (item, index) {
                            if (item.status == '启用') {
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='start']").css("display","none");
                              tr.find("[lay-event='close']").css("display","");
                            }else{
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='close']").css("display","none");
                              tr.find("[lay-event='start']").css("display","");
                            }
                        });
                    }
                });

                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值
                    if (layEvent === 'start') {
                        layer.confirm('确认启用吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.ads.location.status') }}", {
                                _method: 'post',
                                id: data.id,
                                status:1
                            }, function (res) {
                                layer.close(load);
                                if (res.code == 0) {
                                    layer.msg(res.msg, {icon: 1})
                                } else {
                                    layer.msg(res.msg, {icon: 2})
                                }
                                window.location.reload();
                            });
                        });
                    }else if (layEvent === 'close') {
                        layer.confirm('确认关闭吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.ads.location.status') }}", {
                                _method: 'post',
                                id: data.id,
                                status:2
                            }, function (res) {
                                layer.close(load);
                                if (res.code == 0) {
                                    layer.msg(res.msg, {icon: 1})
                                } else {
                                    layer.msg(res.msg, {icon: 2})
                                }
                                window.location.reload();
                            });
                        });
                    }else if (layEvent === 'edit') {
                        location.href = '/admin/ads/location/' + data.id + '/edit';
                    }
                });
                //搜索
                $('#btn .layui-btn').on('click', function(){
                    dataTable.reload({
                        where:{
                                keyword:$('#keyword').val()
                            }
                        ,page:{cur:1}
                    });
                });
            })
        </script>
@endsection