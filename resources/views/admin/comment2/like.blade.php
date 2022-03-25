@extends('admin.base')

@section('content')
    <style>.layui-table-cell{height:35px!important;} .layui-table-view .layui-table td, .layui-table-view .layui-table th{padding: 1px 0;}</style>
    <div class="layui-card">
        <h3>点赞列表</h3>
        <a href="{{route('admin.movie.movie.commentReply')}}?id={{$id}}">回复列表</a>

        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">
                <select class="layui-btn layui-btn-sm layui-btn-danger" id="listBlock" >
                    <option value="">批量禁言</option>
                    <option value="1">无禁言</option>
                    <option value="3">3天</option>
                    <option value="7">7天</option>
                    <option value="30">30天</option>
                    <option value="99999">永久</option>
                </select>
            </div>
            真实赞数:{{$comment->like}}
            手加赞数:{{$comment->m_like}}
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">

            </script>
        </div>
    </div>
@endsection

@section('script')

        <script>
            layui.use(['layer', 'table', 'form','laydate'], function () {
                var $ = layui.jquery;
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                   ,id:'table'
                    , height: 350
                    , url: "{{ route('admin.movie.movie.commentLike') }}?id={{$id}}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {checkbox: true, fixed: true}
                        ,{field: 'id', title: 'ID', sort: true, width: 80}
                        , {field: 'nickname', title: '用户名', width:200}
                        , {field: 'like_time', title:'点赞时间'}
                        ,{field: 'login_ip', title:'登录ip'}
                    ]],
                    done: function(res, curr, count){
                        res.data.forEach(function (item, index) {
                            var nickname = '<span style="width:180px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">'+item.nickname+'</span>';
                            if(item.block){
                                nickname += '<span style=display:block;line-height:0;font-size:11px;color:red>'+item.block+'</span>';
                            }
                            $("tr[data-index="+index+"] td[data-field='nickname']").children(index).html(nickname);
                        });
                    }
                });


                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值
                });

                //按钮批量禁言
                $("#listBlock").change(function () {
                    var lock = $(this).val();
                    if(lock == ''){
                        return;
                    }
                    var ids = [];
                    var hasCheck = table.checkStatus('table');
                    var hasCheckData = hasCheck.data;
                    if (hasCheckData.length > 0) {
                        $.each(hasCheckData, function (index, element) {
                            ids.push(element.uid)
                        })
                    }
                    if (ids.length > 0) {
                        layer.confirm('确认禁言吗？', function (index) {
                            layer.close(index);
                            var load = layer.load();
                            $.post("{{ route('admin.movie.movie.commentBlockUsers') }}", {
                                _method: 'delete',
                                ids: ids,
                                lock:lock
                            }, function (res) {
                                layer.close(load);
                                if (res.code == 0) {
                                    layer.msg(res.msg, {icon: 1}, function () {
                                        dataTable.reload({page: {curr: 1}});
                                    })
                                } else {
                                    layer.msg(res.msg, {icon: 2})
                                }
                            });
                        })
                    } else {
                        layer.msg('请选择禁言项', {icon: 2})
                    }
                });

                //搜索
                var laydate = layui.laydate;
                laydate.render({
                    elem: '#date'
                    ,type: 'datetime'
                    ,range: '~'
                });
                var active = {
                    reload: function(){
                        //执行重载
                        table.reload('table', {
                            page: {
                                curr: 1 //重新从第 1 页开始
                            }
                            ,where: {

                            }
                        });
                    }
                };
                $('#btn .layui-btn').on('click', function(){
                    var type = $(this).data('type');
                    active[type] ? active[type].call(this) : '';
                });
            })
        </script>

@endsection
