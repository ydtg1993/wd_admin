@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-sm" href="{{route('admin.ads.list.create')}}" >添 加</a>
            </div>
        </div>
         <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px" id="btn">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        
                        <div class="layui-inline">
                            <label class="layui-form-label">广告id</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="id">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">广告名称</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="name">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">广告位置</label>
                            <div class="layui-input-inline">
                                <select id="location" lay-search  lay-filter="parent_id">
                                    <option value='' >全部</option>
                                    <?php foreach ($ty as $key => $value): ?>
                                        <option value="<?php echo $key?>"><?php echo $value?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-inline">
                                 <select id="status" lay-search  lay-filter="status">
                                    <option value='' >全部</option>
                                    <option value=1 >上架中</option>
                                    <option value=2 >下架</option>
                                    <option value=3 >到期</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">到期时间</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="date" placeholder=" ~ ">
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
                    <a class="layui-btn layui-btn-sm layui-btn-normal" lay-event="start">上架</a>
                    <a class="layui-btn layui-btn-sm layui-btn-warm" lay-event="close">下架</a>
                    <a class="layui-btn layui-btn-sm layui-btn-danger" lay-event="del">删除</a>
                    @can('ads.location.edit')
                    <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
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
                    , autoSort: false
                    , height: 500
                    , url: "{{ route('admin.ads.list.data') }}" //数据接口
                    , id:'queryList'
                    , page: true //开启分页
                    , cols: [[ //表头
                        {field: 'id', title: '广告id'}
                        , {field: 'name', title: '广告名称'}
                        , {field: 'location', title: '位置'}
                        , {field: 'photo', title: '图片'}
                        , {field: 'url', title: '跳转链接'}
                        , {field: 'start_time', title: '有效时间'}
                        , {field: 'sort', title: '权重'}
                        , {field: 'status', title: '状态'}
                        , {field: 'adminer', title: '操作人'}
                        , {fixed: 'right', width: 150, align: 'center', toolbar: '#options'}
                    ]],
                    done: function(res, curr, count){
                        var that = this.elem.next();
                        res.data.forEach(function (item, index) {
                            if (item.status == '上架中') {
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='start']").css("display","none");
                              tr.find("[lay-event='close']").css("display","");
                            }else if(item.status == '下架') {
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='close']").css("display","none");
                              tr.find("[lay-event='start']").css("display","");
                            }else{
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='close']").css("display","none");
                              tr.find("[lay-event='start']").css("display","none");
                            }
                        });

                        $("[data-field='photo']").children().each(function(){
                            var val = "<img src={{config('app.url')}}/"+$(this).text()+" />";
                            if($(this).text().indexOf('http')!=-1){
                                val = "<img src="+$(this).text()+" />";
                            }
                            if($(this).text() == '图片'){
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
                    if (layEvent === 'start') {
                        layer.confirm('确认上架吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.ads.list.status') }}", {
                                _method: 'post',
                                id: data.id,
                                status:1
                            }, function (res) {
                                layer.close(load);
                                if (res.code == 0) {
                                    layer.msg(res.msg, {icon: 1})
                                } else {
                                    layer.msg(res.msg, {icon: 2})
                                }
                                window.location.reload();
                            });
                        });
                    }else if (layEvent === 'close') {
                        layer.confirm('确认下架吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.ads.list.status') }}", {
                                _method: 'post',
                                id: data.id,
                                status:2
                            }, function (res) {
                                layer.close(load);
                                if (res.code == 0) {
                                    layer.msg(res.msg, {icon: 1})
                                } else {
                                    layer.msg(res.msg, {icon: 2})
                                }
                                window.location.reload();
                            });
                        });
                    }else if (layEvent === 'del') {
                        layer.confirm('确认删除吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.ads.list.del') }}", {
                                _method: 'post',
                                id: data.id,
                                status:2
                            }, function (res) {
                                layer.close(load);
                                if (res.code == 0) {
                                    layer.msg(res.msg, {icon: 1})
                                } else {
                                    layer.msg(res.msg, {icon: 2})
                                }
                                window.location.reload();
                            });
                        });
                    }else if (layEvent === 'edit') {
                        location.href = '/admin/ads/list/' + data.id + '/edit';
                    }
                });

                var laydate = layui.laydate;
                laydate.render({
                    elem: '#date'
                    ,type: 'datetime'
                    ,range: '~'
                });

                //搜索
                $('#btn .layui-btn').on('click', function(){
                    dataTable.reload({
                        where:{
                                id:$('#id').val(),
                                name:$('#name').val(),
                                location:$('#location').val(),
                                status:$('#status').val(),
                                date: $('#date').val(),
                            }
                        ,page:{cur:1}
                    });
                });
            })
        </script>
@endsection