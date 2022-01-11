@extends('admin.base')

@section('content')
    <div class="layui-card">
        <h3>片商/收藏列表</h3>
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
                            <label class="layui-form-label">系列</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="name">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">用户名</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="nickname">
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
                    , url: "{{ route('admin.movie.companies.like') }}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: 'ID', sort: true, width: 80}
                        , {field: 'company_id', title: '公司ID'}
                        , {field: 'company', title: '公司名字'}
                        , {field: 'nickname', title: '用户名'}
                        , {field: 'like_time', title: '收藏时间'}
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
                                name:$('#name').val(),
                                nickname:$('#nickname').val()
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
