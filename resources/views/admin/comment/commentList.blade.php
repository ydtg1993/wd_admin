@extends('admin.base')

@section('content')
    <div class="layui-card">
        <h3>影片/评论列表</h3>

        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">批量隐藏</button>
            </div>
        </div>

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
                            <label class="layui-form-label">用户名</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="nickname">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-inline">
                                <select id="audit" lay-search  lay-filter="audit">
                                    <option value='' >全部</option>
                                    <option value=1 >正常</option>
                                    <option value=-1 >审核不通过</option>
                                    <option value=0 >待审核</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">评论用户类型</label>
                            <div class="layui-input-inline">
                                <select id="source_type" lay-search  lay-filter="source_type">
                                    <option value='' >全部</option>
                                    <option value=1 >用户评论</option>
                                    <option value=2 >虚拟用户评论</option>
                                    <option value=3 >采集评论</option>
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
                <a class="layui-btn layui-btn-sm" id="create" data-href="{{route('admin.movie.movie.addComment')}}" >添 加</a>
                <a class="layui-btn layui-btn-sm" id="batch_create" data-href="{{route('admin.movie.movie.addCommentList')}}" >批量上传</a>
                <a class="layui-btn layui-btn-sm" id="workers" data-href="{{route('admin.movie.movie.commentWorkers')}}" >人员列表</a>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('system.role.edit')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                        <a class="layui-btn layui-btn-sm" lay-event="reply">回复</a>
                        <a class="layui-btn layui-btn-sm" lay-event="del">隐藏</a>
                        <a class="layui-btn layui-btn-sm" lay-event="show">显示</a>
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="lock">封禁</a>
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="audit">审核</a>
                    @endcan
                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('system.role')
        <script>
            $('#create').click(function () {
                location.href = $(this).attr('data-href');
            });
            $('#batch_create').click(function () {
                location.href = $(this).attr('data-href');
            });
            $('#workers').click(function () {
                location.href = $(this).attr('data-href');
            });
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
                    , url: "{{ route('admin.movie.movie.commentList') }}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {checkbox: true, fixed: true}
                        ,{field: 'id', title: 'ID', sort: true, width: 80}
                        , {field: 'number', title: '影片番号'}
                        , {field: 'movie_name', title: '影片'}
                        , {field: 'nickname', title: '用户名'}
                        , {field: 'source_type', title: '评论用户类型'}
                        , {field: 'audit', title: '审核状态'}
                        , {field: 'status', title: '显示状态'}
                        , {field: 'comment', title:'评论记录'}
                        , {field: 'comment_time', title:'评分时间'}
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

                        var that = this.elem.next();
                        res.data.forEach(function (item, index) {

                            if (item.status == '显示') {
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='show']").css("display","none");
                            }
                            if (item.status == '隐藏') {
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='del']").css("display","none");
                            }
                            if (item.audit =="正常") {
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='audit']").css("display","none");
                            }
                        });

                    }
                });


                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值

                    if (layEvent === 'add') {
                        location.href = '/admin/movie/movie.addComment/';
                    }
                    if (layEvent === 'edit') {
                        location.href = '/admin/movie/movie.commentEdit/' + data.id;
                    }
                    if (layEvent === 'reply') {
                        location.href = '/admin/movie/movie.commentReply/' + data.id;
                    }

                    if (layEvent === 'show') {
                        layer.confirm('需要恢复显示吗 '+data.id, function(index){
                            $.ajax({
                                url:'{{route('admin.movie.movie.commentShow')}}',
                                method:'post',
                                data:{"_token":"{{ csrf_token() }}",id:data.id},
                                success:function (d) {
                                    if(d.code == 0){
                                        layer.msg('恢复成功', {time: 1000},function () {
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

                    if (layEvent === 'del') {
                        layer.confirm('需要隐藏吗 '+data.id, function(index){
                            $.ajax({
                                url:'{{route('admin.movie.movie.commentDel')}}',
                                method:'delete',
                                data:{"_token":"{{ csrf_token() }}",id:data.id},
                                success:function (d) {
                                    if(d.code == 0){
                                        layer.msg('隐藏成功', {time: 1000},function () {
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

                    if (layEvent === 'lock') {
                        //封禁操作
                        var html = '<div style="margin:20px">' +
                                '<p style="margin:10px;">封禁类型：' +
                                    '<input type="radio" name="ty'+ data.id +'" value="2" checked="checked"/>禁言 ' +
                                    '<input type="radio" name="ty'+ data.id +'" value="3" />拉黑 </p>' +
                                '<p style="margin:10px;">封禁时间：<select id="unlockday'+data.id+'">'+
                                    '<option value="1">1天</option>' +
                                    '<option value="3">3天</option>' +
                                    '<option value="7">7天</option>' +
                                    '<option value="30">30天</option>' +
                                    '<option value="99999">永久</option>' +
                                '</select></p>' +
                                '<p style="margin:10px;">封禁原因：<textarea id="rk'+ data.id +'" rows="6"></textarea></p>' +
                                '</div>';

                        layer.open({
                            type: 1,
                            title:'封禁',
                            area: ['400px', '310px'], //宽高
                            content: html,
                            btn:['确认','关闭'],
                            yes: function(index, layero) {            //点击确定时的方法
                                var r = $("#rk"+ data.id +"").val();
                                if(r.length>100){
                                    alert('封禁原因不能超过100字');
                                    return ;
                                }

                                layer.close(index);
                                var load = layer.load();
                                $.post("{{route('admin.user_client.block_user')}}", {
                                    uid: data.uid,
                                    uname: data.nickname,
                                    status:$("input[name=ty"+ data.id +"]:checked").val(),
                                    unlockday:$("#unlockday"+ data.id +"").val(),
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
                                return;
                            },
                        });
                    }

                    if (layEvent === 'audit') {
                        var img = "{{config('app.url')}}/resources/" + data.cover;
                        //审核弹框
                        var html = '<div style="margin:20px">' +
                                '<p style="margin:10px;">影片番号：<input type="text" value="'+ data.number +'" readonly="readonly"/></p>' +
                                '<p style="margin:10px;">影片：<input type="text" value="'+ data.movie_name +'" readonly="readonly"/></p>' +
                                '<p style="margin:10px;">用户名：<input type="text" value="'+ data.nickname +'" readonly="readonly"/></p>' +
                                '<p style="margin:10px;">评论记录：<textarea rows="6">'+ data.comment +'</textarea></p>' +
                                '<p style="margin:10px;">审核：<input type="radio" name="ad'+ data.id +'" value="1" checked/>通过 ' +
                                '<input type="radio" name="ad'+ data.id +'" value="-1" />不通过 ' +
                                '<input type="radio" name="ad'+ data.id +'" value="0" />取消</p>' +
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
                                $.post("{{ route('admin.movie.movie.commentAudit') }}", {
                                    id: data.id,
                                    status:$("input[name=ad"+ data.id +"]:checked").val(),
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

                //按钮批量删除
                $("#listDelete").click(function () {
                    var ids = [];
                    var hasCheck = table.checkStatus('table');
                    var hasCheckData = hasCheck.data;
                    if (hasCheckData.length > 0) {
                        $.each(hasCheckData, function (index, element) {
                            ids.push(element.id)
                        })
                    }
                    if (ids.length > 0) {
                        layer.confirm('确认隐藏吗？', function (index) {
                            layer.close(index);
                            var load = layer.load();
                            $.post("{{ route('admin.movie.movie.commentDestroy') }}", {
                                _method: 'delete',
                                ids: ids
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
                        layer.msg('请选择删除项', {icon: 2})
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
                                number:$('#number').val(),
                                nickname:$('#nickname').val(),
                                audit:$('#audit').val(),
                                source_type:$('#source_type').val()
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
