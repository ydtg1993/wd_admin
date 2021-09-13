@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group ">
                @can('user_client.create')
                    <a class="layui-btn layui-btn-sm" href="{{ route('admin.user_client.create') }}">添 加</a>
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
            <select name="type" lay-verify="required" id="type">
                <option value=0>用户类型</option>
                <option value="1" @if (isset($userClient)&&($userClient->type==1))  selected @endif>普通用户</option>
                <option value="2" @if (isset($userClient)&&($userClient->type==2))  selected @endif>运营用户</option>
                <option value="2" @if (isset($userClient)&&($userClient->type==3))  selected @endif>vip用户</option>
            </select>
            </div>

            <div class="layui-inline">
                <label for="" class="layui-form-label">用户id/昵称</label>
                <div class="layui-input-inline">
                    <input type="text" name="u_number"  placeholder="用户id/昵称"  class="layui-input">
                </div>
            </div>

            <div class="layui-inline">
                <select name="status" lay-verify="required" id="status">
                    <option value=0>用户状态</option>
                    <option value="0" @if (isset($userClient)&&($userClient->status==0))  selected @endif>全部</option>
                    <option value="1" @if (isset($userClient)&&($userClient->status==1))  selected @endif>正常</option>
                    <option value="2" @if (isset($userClient)&&($userClient->status==2))  selected @endif>拉黑</option>
                    <option value="3" @if (isset($userClient)&&($userClient->status==3))  selected @endif>禁言</option>
                </select>
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
                    @can('user_client.edit')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan
{{--                    @can('user_client.destroy')--}}
{{--                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>--}}
{{--                    @endcan--}}
                        @can('user_client.block_user')
                            <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">拉黑</a>
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
                    , url: "{{ route('admin.user_client.data') }}" //数据接口
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: '序号', sort: true, width: 40}
                        , {field: 'number', title: '用户id'}
                        , {field: 'nickname', title: '用户名'}
                        , {field: 'email', title: '登录邮箱'}
                        , {field: 'phone',  title: '手机号码'}
                        , {field: 'created_at', title: '注册时间'}
                        , {field: 'login_time', title: '最近登录'}
                        , {field: 'login_ip', title: '用户最近登录ip'}
                        , {field: 'type', title: '用户类型'}
                        , {field: 'status', title: '用户状态'}
                        , {field: 'my_comment', title: '我的评论'}
                        , {field: 'my_reply', title: '我的回复'}
                        , {field: 'my_like', title: '我的回复'}
                        , {field: 'like', title: '收到的赞'}
                        , {field: 'dislike', title: '收到的踩'}
                        , {field: 'report', title: '收到的举报'}
                        , {fixed: 'right', width: 100, align: 'center', toolbar: '#options'}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值
                    if (layEvent === 'del') {
                        layer.confirm('确认拉黑吗？', function (index) {
                            layer.close(index);
                            var load = layer.load();
                            $.post("{{ route('admin.user_client.block_user') }}", {
                                _method: 'put',
                                id: data.id
                            }, function (res) {
                                layer.close(load);
                                if (res.code == 0) {
                                    layer.msg(res.msg, {icon: 1}, function () {
                                        dataTable.reload({
                                        });
                                    })
                                } else {
                                    layer.msg(res.msg, {icon: 2})
                                }
                            });
                        });
                    } else if (layEvent === 'edit') {
                        location.href = '/admin/userClient/' + data.id + '/edit';
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
