@extends('admin.base')

@section('content')
    <div class="layui-card">
        <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px" id="btn">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">时间范围</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="date" placeholder=" ~ ">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">类别</label>
                            <div class="layui-input-inline">
                                <select id="category" lay-search  lay-filter="parent_id">
                                    <option value='' >选择分类</option>
                                    <?php
                                    foreach ($categories as $category){
                                        echo "<option value=$category >$category</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">演员名字</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="name">
                            </div>
                        </div>

                        <div class="layui-inline">
                            <button type="button" class="layui-btn layui-btn-primary"  lay-submit data-type="reload" lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('system.role.edit')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan
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
                    , url: "{{ route('admin.review.actor.error') }}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: 'ID', sort: true, width: 80}
                        , {field: 'name', title: '名称'}
                        , {field: 'names', title:'别名'}
                        , {field: 'photo', title:'照片'}
                        , {field: 'category', title:'类别'}
                        , {field: 'resources_odd_info', title:'异常原因'}
                        , {field:'source_site',title:'数据来源'}
                        , {field: 'created_at', title: '创建时间'}
                        , {fixed: 'right', width: 260, align: 'center', toolbar: '#options'}
                    ]],
                    done: function(res, curr, count){
                        $("[data-field='status']").children().each(function(){
                            // 1.未处理  2.已处理【人工处理】 3.系统处理 4.舍弃 5.异常数据需要人工处理'
                            if($(this).text()=='1'){
                                $(this).text("未处理")
                            }else if($(this).text()=='2'){
                                $(this).text("人工处理")
                            }else if($(this).text()=='3'){
                                $(this).text("系统处理")
                            }
                        });
                        $("[data-field='photo']").children().each(function(){
                            var val = "<img src={{config('app.url')}}resources/"+$(this).text()+" />";
                            if($(this).text() == '照片'){
                                return;
                            }
                            $(this).html(val)
                        });
                    }
                });

                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值
                    if (layEvent === 'edit') {
                        if(data.status == 2){
                            alert('已经发布')
                        }else {
                            location.href = '/admin/review/actor/' + data.id + '/edit';
                        }
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
                                date: $('#date').val(),
                                category:$('#category').val(),
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