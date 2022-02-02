@extends('admin.base')

@section('content')
    <div class="layui-card">
        <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px" id="btn">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">更新时间</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="date" placeholder=" ~ ">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">处理状态</label>
                            <div class="layui-input-inline">
                                <select id="status" lay-search  lay-filter="parent_id">
                                    <option value='' >选择状态</option>
                                    <option value=1 selected>未处理</option>
                                    <option value=2 >已同步</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">番号</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="number">
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
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                </div>
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
                    , height: 500
                    , url: "{{ route('admin.review.disklink') }}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                         {field: 'id', title: 'ID', sort: true, width: 80}
                        , {field:'number',title:'番号'}
                        , {field: 'displayname', title: '显示名称'}
                        , {field: 'ext', title:'文件类型'}
                        , {field: 'xt', title:'哈希方法'}
                        , {field: 'resolution', title:'分辨率'}
                        , {field: 'size', title:'文件大小'}
                        , {field: 'sd', title:'标清'}
                        , {field: 'hd', title:'高清'}
                        , {field: 'bluray', title:'蓝光'}
                        , {field: 'subtitle', title:'字幕'}
                        , {field: 'download', title:'下载'}
                        , {field: 'meta', title:'描述'}
                        , {field: 'link', title:'链接'}
                        , {field: 'filelists', title:'文件列表'}
                        , {field: 'ip', title:'采集ip'}
                        , {field: 'status', title:'状态'}
                        , {field:'created_at',title:'创建时间'}
                        , {field:'updated_at',title:'更新时间'}
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
                        location.href = '/admin/review/movie/' + data.id + '/edit';
                    }
                    if (layEvent === 'synch') {
                        //手工同步
                        layer.confirm('确认要同步这个数据吗？id='+data.id, function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.review.movie.synch') }}", {
                                id: data.id
                            }, function (res) {
                                layer.close(load);
                                if (res.code == 0) {
                                    layer.msg(res.msg, {icon: 1}, function () {
                                        window.location.reload();
                                    })
                                } else {
                                    layer.msg(res.msg, {icon: 2})
                                }
                            });
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
                                status: $('#status').val(),
                                resources_status:$('#resources_status').val(),
                                username: $('#username').val(),
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
@endsection
