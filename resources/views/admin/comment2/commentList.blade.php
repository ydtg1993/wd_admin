@extends('admin.base')

@section('content')
    <style>.layui-table-cell{height:45px!important;} .layui-table-view .layui-table td, .layui-table-view .layui-table th{padding: 1px 0;}</style>
    <div class="layui-card">
        <h3>影片/评论列表</h3>

        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">
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
                            <label class="layui-form-label">用户ID</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="uid">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">用户名</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="nickname">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">评论用户</label>
                            <div class="layui-input-inline">
                                <select id="silence" lay-search  lay-filter="audit">
                                    <option value='' >全部</option>
                                    <option value=1 >正常</option>
                                    <option value=2 >禁言用户</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">审核状态</label>
                            <div class="layui-input-inline">
                                <select id="status" lay-search  lay-filter="status">
                                    <option value='' >全部</option>
                                    <option value=1 >显示</option>
                                    <option value=2 >隐藏</option>
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
                <a class="layui-btn layui-btn-sm layui-btn-danger" href="javascript:void(0);" id="listDelete" >批量隐藏</a>
                <a class="layui-btn layui-btn-sm" id="expert" href="javascript:void(0);" >导出</a>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                   <a class="layui-btn layui-btn-sm" lay-event="detail">详情</a>
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
                    , height: 600
                    , url: "{{ route('admin.movie.movie.commentList') }}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {checkbox: true, fixed: true}
                        ,{field: 'id', title: 'ID', sort: true, width: 80}
                        , {field: 'number', title: '影片番号'}
                        , {field: 'uid', title: '用户ID', width:80}
                        , {field: 'nickname', title: '用户名', width:200}
                        , {field: 'score', title: '评分', width:60}
                        , {field: 'comment', title:'内容'}
                        , {field: 'status', title: '审核状态'}
                        , {field: 'like', title:'赞数'}
                        , {field: 'dislike', title:'踩数'}
                        , {field: 'comment_time', title:'评论时间'}
                        , {fixed: 'right', width: 70, align: 'center', toolbar: '#options'}
                    ]],
                    done: function(res, curr, count){
                        var that = this.elem.next();
                        res.data.forEach(function (item, index) {
                            $("tr[data-index="+index+"] td[data-field='uid']").children(index).html('<a href=javascript:void(0) class=uid_info>'+item.uid+'</a>');

                            var nickname = '<input style=width:120px; value='+item.nickname+' /><a class=\"layui-btn layui-btn-danger layui-btn-sm\" lay-event=\"lock\">封</a>';
                            if(item.block){
                                nickname += '<span style=display:block;line-height:0;font-size:12px;color:red>'+item.block+'</span>';
                            }
                            $("tr[data-index="+index+"] td[data-field='nickname']").children(index).html(nickname);

                            var status;
                            if(item.status == 1){
                                status = '<button style=background-color:#d2d2d2 class="status_switch" data-v=2 data-id='+item.id+'>显示<button/>';
                            }else{
                                status = '<button class="status_switch" data-v=1 data-id='+item.id+'>隐藏<button/>';
                            }
                            $("tr[data-index="+index+"] td[data-field='status']").children(index).html(status);

                            var total_like = item.m_like + item.like;
                            if(item.m_like > 0){
                                $("tr[data-index="+index+"] td[data-field='like']").children(index).html('<input data-id='+item.id+' style=width:40px; class=add_like style="color:red" value='+total_like+' />');
                            }else{
                                $("tr[data-index="+index+"] td[data-field='like']").children(index).html('<input data-id='+item.id+' style=width:40px; class=add_like value='+total_like+' />');
                            }
                        });

                        $('.uid_info').click(function () {
                            $.ajax({
                                url:'{{route('admin.movie.movie.commentGetUserInfo')}}',
                                method:'post',
                                data:{"_token":"{{ csrf_token() }}",id:$(this).text()},
                                success:function (d) {
                                    if(d.code == 0){
                                        var html = '<div><img width="80px" height="80px" src={{config("app.url")}}resources/'+d.data.avatar+' /></div>'+
                                            '<div>用户名: '+d.data.nickname+'</div>'+
                                            '<div>ID: '+d.data.id+'</div>'+
                                            '<div>手机号: '+d.data.phone+'</div>'+
                                            '<div>邮箱: '+d.data.email+'</div>'+
                                            '<div>最后登录IP: '+d.data.login_ip+'</div>';
                                        layer.open({
                                            type: 1
                                            ,content: html
                                            ,btn: '关闭'
                                            ,area: ['280px', '300px']
                                            ,btnAlign: 'c' //按钮居中
                                            ,shade: 0 //不显示遮罩
                                            ,yes: function(index){
                                                layer.close(index);
                                            }
                                        });
                                    }
                                }
                            });
                        });

                        $('.status_switch').click(function () {
                            $.ajax({
                                url:'{{route('admin.movie.movie.commentShow')}}',
                                method:'post',
                                data:{"_token":"{{ csrf_token() }}",id:$(this).attr('data-id'),status:$(this).attr('data-v')},
                                success:function (d) {
                                    if(d.code == 0){
                                        window.location.reload();
                                    }
                                }
                            });
                        });

                        $('.add_like').blur(function () {
                            $.ajax({
                                url:'{{route('admin.movie.movie.commentAddLike')}}',
                                method:'post',
                                data:{"_token":"{{ csrf_token() }}",id:$(this).attr('data-id'),add:$(this).val()},
                                success:function (d) {
                                    if(d.code == 0){
                                        window.location.reload();
                                    }else if(d.code == 1){
                                        layer.msg(d.msg, {
                                            time: 2000,
                                        });
                                    }
                                }
                            });
                        });

                        $('#expert').click(function () {
                            var heads = ['序号ID','影片番号','用户ID','用户名','评分','内容','审核状态','赞数','踩数','评论时间'];
                            var records = [];
                            for(var d in res.data){
                                var v = res.data[d]
                                var record = [v.id,v.number,v.uid,v.nickname,v.score,v.comment,v.status,v.like,v.dislike,v.comment_time];
                                records.push(record)
                            }
                            table.exportFile(heads, records, 'csv'); //默认导出 csv，也可以为：xls
                        });
                    }
                });


                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值

                    if (layEvent === 'lock') {
                        //封禁操作
                        var html = '<div style="margin:20px">' +
                                '<p style="margin:10px;">封禁时间：<select id="unlockday'+data.id+'">'+
                                    '<option value="1">无禁言</option>' +
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
                                $.post("{{route('admin.movie.movie.commentBlockUser')}}", {
                                    id:data.id,
                                    uid: data.uid,
                                    status:2,
                                    uname: data.nickname,
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

                    if (layEvent === 'detail') {
                        layer.open({
                            type: 2
                            ,content: '{{route('admin.movie.movie.commentLike')}}?id='+data.id
                            ,btn: '关闭'
                            ,area: ['800px', '640px']
                            ,btnAlign: 'c' //按钮居中
                            ,shade: 0 //不显示遮罩
                            ,yes: function(index){
                                layer.close(index);
                            }
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
                                uid:$('#uid').val(),
                                nickname:$('#nickname').val(),
                                status:$('#status').val(),
                                source_type:$('#source_type').val(),
                                silence: $('#silence').val(),
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
