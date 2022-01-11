@extends('admin.base')

@section('content')
    <div class="layui-card">
        <h3>影片/评分列表</h3>
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
                            <label class="layui-form-label">番号</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="number">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">评分</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="score">
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
                    , url: "{{ route('admin.movie.movie.scoreList') }}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: 'ID', sort: true, width: 80}
                        , {field: 'number', title: '影片番号'}
                        , {field: 'movie_name', title: '影片'}
                        , {field: 'score', title:'评分'}
                        , {field: 'nickname', title: '用户名'}
                        , {field: 'score_time', title:'评分时间'}
                        , {field: 'updated_at', title: '更新时间'}
                        , {fixed: 'right', width: 260, align: 'center', toolbar: '#options'}
                    ]],
                    done: function(res, curr, count){
                        $("[data-field='small_cover']").children().each(function(){
                            var val = "<img src={{config('app.url')}}resources/"+$(this).text()+" />";
                            if($(this).text() == '封面'){
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
                    if (layEvent === 'del') {
                        layer.confirm('真的删除行 '+data.id, function(index){
                            $.ajax({
                                url:'{{route('admin.movie.movie.scoreList')}}',
                                method:'delete',
                                data:{"_token":"{{ csrf_token() }}",id:data.id},
                                success:function (d) {
                                    if(d.code == 0){
                                        layer.msg('成功', {time: 1000},function () {
                                            window.location.reload();
                                        });
                                        return;
                                    }
                                    layer.msg(d.msg, {
                                        time: 2000,
                                    });
                                }
                            });
                            layer.close(index);
                        });
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
                                score: $('#score').val(),
                                number:$('#number').val()
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
