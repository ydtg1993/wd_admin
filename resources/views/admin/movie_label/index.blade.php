@extends('admin.base')

@section('content')
    <div class="layui-card">
        <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px" id="btn">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">名称</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="name">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">分类</label>
                            <div class="layui-input-inline">
                                <select id="cid" name="cid" lay-search>
                                    <option value="0" >请选择</option>
                                    <?php
                                    foreach ($category as $v){
                                        echo "<option value={$v->id} >$v->name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="layui-inline">
                            <button type="button" class="layui-btn layui-btn-primary"  lay-submit data-type="reload" lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-sm" href="{{route('admin.movie.label.create')}}" >添 加</a>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    <a class="layui-btn layui-btn-sm" lay-event="del">删除</a>
                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('system.role')
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
                    , height: 500
                    , url: "{{ route('admin.movie.label') }}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: 'ID', sort: true, width: 80}
                        , {field: 'name', title: '名称'}
                        , {field: 'item_num', title:'子标签数量'}
                        , {field: 'cids', title:'分类'}
                        , {field: 'sort', title: '排序号'}
                        , {field: 'created_at', title: '创建时间'}
                        , {fixed: 'right', width: 260, align: 'center', toolbar: '#options'}
                    ]],
                });

                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值
                    if (layEvent === 'edit') {
                        location.href = '/admin/movie/label/' + data.id + '/edit';
                    }

                    if (layEvent === 'del') {
                        layer.confirm('确认删除吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.movie.label.destroy') }}", {
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
                    }
                });

                //搜索
                var active = {
                    reload: function(){
                        //执行重载
                        table.reload('table', {
                            page: {
                                curr: 1 //重新从第 1 页开始
                            }
                            ,where: {
                                cid: $('#cid').val(),
                                name:$('#name').val()
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
    @endcan
@endsection
