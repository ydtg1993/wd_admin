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
                            <label class="layui-form-label">片单id</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="id">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">用户名</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="nickname">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">用户类别</label>
                            <div class="layui-input-inline">
                                <select id="type" lay-search  lay-filter="parent_id">
                                    <option value='' >选择分类</option>
                                    <option value=1 >用户创建</option>
                                    <option value=2 >管理员创建</option>
                                    <option value=3 >用户默认</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-inline">
                                 <select id="audit" lay-search  lay-filter="audit">
                                    <option value='' >全部</option>
                                    <option value=1 >正常</option>
                                    <option value=2 >审核不通过</option>
                                    <option value=0 >待审核</option>
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
                <a class="layui-btn layui-btn-sm" href="{{route('admin.movie.list.create')}}" >添 加</a>
                <a class="layui-btn layui-btn-normal layui-btn-radius" target="_blank" href="{{route('admin.movie.list.list')}}" style="margin-left: 10px!important;">影片列表</a>
                <a class="layui-btn layui-btn-normal layui-btn-radius" target="_blank" href="{{route('admin.movie.list.like')}}" style="margin-left: 10px!important;">收藏列表</a>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('movie.list.edit')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan
                    @can('movie.list.audit')
                        <a class="layui-btn layui-btn-sm" lay-event="audit">审核</a>
                    @endcan
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
                    , url: "{{ route('admin.movie.list') }}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: 'ID', sort: true, width: 80}
                        , {field: 'name', title: '名称'}
                        , {field: 'intro', title: '简介'}
                        , {field: 'nickname', title: '用户名'}
                        , {field: 'cover', title: '封面图'}
                        , {field: 'authority', title: '隐私'}
                        , {field: 'type', title:'用户类型'}
                        , {field: 'movie_sum', title:'影片数量'}
                        , {field: 'like_sum', title:'收藏数量'}
                        , {field: 'pv_browse_sum', title: 'pv'}
                        , {field: 'audit', title: '状态'}
                        , {field: 'created_at', title: '创建时间'}
                        , {field: 'updated_at', title: '更新时间'}
                        , {title:'操作',fixed: 'right', width: 260, align: 'center', toolbar: '#options'}
                    ]],
                    done: function(res, curr, count){
                        $("[data-field='type']").children().each(function(){
                            // 1.未处理  2.已处理【人工处理】 3.系统处理 4.舍弃 5.异常数据需要人工处理'
                            if($(this).text()=='1'){
                                $(this).text("用户创建")
                            }else if($(this).text()=='2'){
                                $(this).text("管理员创建")
                            }else if($(this).text()=='3'){
                                $(this).text("用户默认")
                            }
                        });
                        $("[data-field='cover']").children().each(function(){
                            var val = "<img src={{config('app.url')}}/resources/"+$(this).text()+" />";
                            if($(this).text() == '封面图'){
                                return;
                            }
                            if($(this).text() == ''){
                                return;
                            }
                            $(this).html(val)
                        });
                        $("[data-field='authority']").children().each(function(){
                            // 1.公开  2.仅自己
                            if($(this).text()=='1'){
                                $(this).text("公开")
                            }else{
                                $(this).text("仅自己")
                            }
                        });

                        var that = this.elem.next();
                        res.data.forEach(function (item, index) {
                            if (item.audit == '1') {
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='audit']").css("display","none");
                            }else{
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='audit']").css("display","");
                            }
                        });

                        $("[data-field='audit']").children().each(function(){
                            // 1.审核通过  2.审核不通过，0.待审核
                            if($(this).text()=='1'){
                                $(this).text("正常");
                            }else if($(this).text()=='2'){
                                $(this).text("审核不通过")
                            }else{
                                $(this).text("审核中");
                            }
                        });
                    }
                });

                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值
                    if (layEvent === 'edit') {
                        location.href = '/admin/movie/list/' + data.id + '/edit';
                    }
                    if (layEvent === 'audit') {
                        var img = "{{config('app.url')}}/resources/" + data.cover;
                        //审核弹框
                        var html = '<div style="margin:20px">' +
                                '<p><input type="hidden" name="id" value="'+ data.id +'"/></p>' +
                                '<p style="margin:10px;">名称：<input type="text" value="'+ data.name +'"/></p>' +
                                '<p style="margin:10px;">简介：<input type="text" value="'+ data.intro +'"/></p>' +
                                '<p style="margin:10px;">用户：<input type="text" value="'+ data.nickname +'"/></p>' +
                                '<p style="margin:10px;">封面：<img src="'+ img +'" width="100" height="100"></p>' +
                                '<p style="margin:10px;">备注：<textarea id="rk'+ data.id +'">'+ data.remarks +'</textarea></p>' +
                                '<p style="margin:10px;">审核：<input type="radio" name="ad'+ data.id +'" value="1" />通过 ' +
                                '<input type="radio" name="ad'+ data.id +'" value="2" />不通过 ' +
                                '<input type="radio" name="ad'+ data.id +'" value="0" />待审核</p>' +
                                '</div>';
                        layer.open({
                            type: 1,
                            title:'片单审核',
                            area: ['400px', '400px'], //宽高
                            content: html,
                            btn:['确认','关闭'],
                            yes: function(index, layero) {            //点击确定时的方法
                                layer.close(index);
                                var load = layer.load();
                                $.post("{{ route('movie.list.audit') }}", {
                                    id: data.id,
                                    audit:$("input[name=ad"+ data.id +"]:checked").val(),
                                    remarks:$("#rk"+ data.id +"").val(),
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
                            },
                            success:function(){
                                $("input[name=ad"+ data.id +"][value="+ data.audit +"]").attr("checked",true);
                            },
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
                                id:$('#id').val(),
                                type:$('#type').val(),
                                nickname:$('#nickname').val(),
                                audit:$('#audit').val()
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
