@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">

            </div>
        </div>
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
            layui.use(['layer', 'table', 'form'], function () {
                var $ = layui.jquery;
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    , height: 500
                    , url: "{{ route('admin.review_movie.data') }}" //数据接口
                    , page: true //开启分页
                    , cols: [[ //表头
                         {field: 'id', title: 'ID', sort: true, width: 80}
                        , {field:'number',title:'番号'}
                        , {field: 'name', title: '名称'}
                        , {field: 'time', title:'时长'}
                        , {field: 'resources_status', title:'资源状态'}
                        , {field: 'small_cover', title:'封面图'}
                        , {field: 'status', title:'审核状态'}
                        , {field:'release_time',title:'发布时间'}
                        , {field: 'created_at', title: '创建时间'}
                        , {field: 'updated_at', title: '更新时间'}
                        , {fixed: 'right', width: 260, align: 'center', toolbar: '#options'}
                    ]],
                    done: function(res, curr, count){
                        $("[data-field='status']").children().each(function(){
                            // 1.未处理  2.已处理【人工处理】 3.系统处理 4.舍弃 5.异常数据需要人工处理'
                            if($(this).text()=='1'){
                                $(this).text("未处理")
                            }else if($(this).text()=='2'){
                                $(this).text("已处理")
                            }else if($(this).text()=='3'){
                                $(this).text("系统处理")
                            }else if($(this).text()=='4'){
                                $(this).text("舍弃")
                            }else if($(this).text()=='5'){
                                $(this).text("异常数据")
                            }
                        });
                        $("[data-field='small_cover']").children().each(function(){
                            var val = "<img src={{config('app.url')}}resources/"+$(this).text()+" />";
                            if($(this).text() == '封面图'){
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
                            alert('已经发布');
                        }else {
                            location.href = '/admin/review/movie/' + data.id + '/edit';
                        }
                    }
                });
            })
        </script>
    @endcan
@endsection
