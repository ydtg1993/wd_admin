@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
           
        
        <form class="layui-form">
            <div class="layui-inline" >
                <label for="" class="layui-form-label">创建时间</label>
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
                <label for="" class="layui-form-label">用户id</label>
                <div class="layui-input-inline">
                    <input type="text" name="uid"  placeholder="用户id"  class="layui-input">
                </div>
            </div>

            <div class="layui-inline">
                <label for="" class="layui-form-label">用户名</label>
                <div class="layui-input-inline">
                    <input type="text" name="uname"  placeholder="用户名"  class="layui-input">
                </div>
            </div>

            <div class="layui-inline">
                <label for="" class="layui-form-label">手机号码</label>
                <div class="layui-input-inline">
                    <input type="text" name="phone"  placeholder="手机号码"  class="layui-input">
                </div>
            </div>

            <div class="layui-inline">
                <label for="" class="layui-form-label">用户邮箱</label>
                <div class="layui-input-inline">
                    <input type="text" name="email"  placeholder="用户邮箱"  class="layui-input">
                </div>
            </div>

            <div class="layui-btn-group ">
                <button class="layui-btn layui-btn-sm" lay-submit lay-filter="search" >搜 索</button>
            </div>
        </form>
        </div>

        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('user_client.block_user')
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="uplock">解封</a>
                    @endcan
                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('user_client.index')
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
                    , url: "{{ route('admin.user_client.locklistdata') }}" //数据接口
                    , id:'queryList'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'uid', title: '用户id'}
                        , {field: 'uname', title: '用户名'}
                        , {field: 'email', title: '登录邮箱'}
                        , {field: 'phone',  title: '手机号码'}
                        , {field: 'status', title: '封禁类型'}
                        , {field: 'unlock_time', title: '解封时间'}
                        , {field: 'remarks', title: '封禁原因'}
                        , {field: 'created_at', title: '创建时间'}
                        , {fixed: 'right', width: 100, align: 'center', toolbar: '#options'}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值
                    if (layEvent === 'uplock') {
                        layer.confirm('确认解封吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.user_client.unlock') }}", {
                                uid: [data.uid]
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
            });

        </script>
    @endcan
@endsection
