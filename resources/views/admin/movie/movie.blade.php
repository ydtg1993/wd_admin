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
                            <label class="layui-form-label">发行时间</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="rdate" placeholder=" ~ ">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">标题</label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" id="name">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <div class="layui-input-inline">
                                <select id="search_key" lay-search  lay-filter="parent_id">
                                    <option value='number' >番号</option>
                                    <option value='actor' >演员</option>
                                    <option value='series' >系列</option>
                                    <option value='film_companies' >片商</option>
                                    <option value='director' >导演</option>
                                </select>
                                <input type="text" class="layui-input" id="search_value">
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
                            <label class="layui-form-label">是否上架</label>
                            <div class="layui-input-inline">
                                <select id="is_up" lay-search  lay-filter="parent_id">
                                    <option value='' >全部</option>
                                    <option value='1' >上架</option>
                                    <option value='2' >下架</option>
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
            <label class="layui-form-label">影片导入：</label>
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-sm" id="movie_download" data-href="{{route('admin.movie.movie.mvdown')}}" >导出</a>
                <a class="layui-btn layui-btn-normal layui-btn-radius" target="_blank" href="/movie_demo.csv" style="margin-left: 10px!important;">下载模板</a>
                <a class="layui-btn layui-btn-sm" id="movie_upload" data-href="{{route('admin.movie.movie.create')}}" style="margin-left: 10px!important;">导入</a>
            </div>
        </div>
        <div class="layui-card-header layuiadmin-card-header-auto">
            <label class="layui-form-label">磁链导入：</label>
            <div class="layui-btn-group">
                <!--<a class="layui-btn layui-btn-sm" id="link_down" data-href="{{route('admin.movie.movie.create')}}" >导出</a>-->
                <a class="layui-btn layui-btn-normal layui-btn-radius" target="_blank" href="/disklink_demo.csv" style="margin-left: 10px!important;">下载模板</a>
                <a class="layui-btn layui-btn-sm" id="link_up" data-href="{{route('admin.movie.movie.create')}}" style="margin-left: 10px!important;">导入</a>
            </div>
        </div>
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-sm" id="create" data-href="{{route('admin.movie.movie.create')}}" >添 加</a>
                <a class="layui-btn layui-btn-normal layui-btn-radius" target="_blank" href="{{route('admin.movie.movie.scoreList')}}" style="margin-left: 10px!important;">评分列表</a>
                <a class="layui-btn layui-btn-normal layui-btn-radius" target="_blank" href="{{route('admin.movie.movie.commentList')}}" style="margin-left: 10px!important;">评论列表</a>
                <a class="layui-btn layui-btn-normal layui-btn-radius" target="_blank" href="{{route('admin.movie.movie.wantSeeList')}}" style="margin-left: 10px!important;">想看列表</a>
                <a class="layui-btn layui-btn-normal layui-btn-radius" target="_blank" href="{{route('admin.movie.movie.sawList')}}" style="margin-left: 10px!important;">看过列表</a>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                        <a class="layui-btn layui-btn-sm layui-btn-normal" lay-event="up">上架</a>
                        <a class="layui-btn layui-btn-sm layui-btn-danger" lay-event="down">下架</a>
                    @can('movie.movie.edit')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan
                    @can('movie.movie.destroy')
                        <a class="layui-btn layui-btn-sm" lay-event="del">删除</a>
                    @endcan
                        <a class="layui-btn layui-btn-sm" lay-event="collection">传到采集内容</a>
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
                    ,autoSort: false //禁用前端自动排序
                    , height: 500
                    , url: "{{ route('admin.movie.movie') }}" //数据接口
                    , method:'POST'
                    , page: true //开启分页
                    , cols: [[ //表头
                         {field: 'id', title: 'ID', sort: true, width: 80}
                        , {field:'number',title:'番号', sort: true}
                        , {field: 'name', title: '标题'}
                        , {field:'actors',title:'演员'}
                        , {field:'score',title:'评分'}
                        , {field: 'time', title:'时长'}
                        , {field: 'small_cover', title:'封面图'}
                        , {field: 'category', title:'类别'}
                        , {field: 'comment_num', title:'评论'}
                        , {field: 'flux_linkage_num', title:'磁链'}
                        , {field: 'wan_see', title:'想看'}
                        , {field: 'seen', title:'看过'}
                        , {field: 'is_up', title:'上架'}
                        , {field: 'created_at', title: '创建时间'}
                        , {field: 'updated_at', title: '更新时间'}
                        , {field: 'release_time', title: '发行时间', sort: true}
                        , {fixed: 'right', width: 260, align: 'center', toolbar: '#options'}
                    ]],
                    done: function(res, curr, count){
                        $("[data-field='status']").children().each(function(){
                            if($(this).text()=='1'){
                                $(this).text("正常")
                            }else if($(this).text()=='2'){
                                $(this).text("禁用")
                            }
                        });

                        $("[data-field='small_cover']").children().each(function(){
                            var imgurl = "{{config('app.url')}}/resources/"+$(this).text();

                            console.log(imgurl);
                            console.log(CheckImgExists(imgurl));

                            var val = "<img src={{config('app.url')}}resources/"+$(this).text()+" />";
                            if($(this).text() == '封面图'){
                                return;
                            }
                            if($(this).text().length>5 && CheckImgExists(imgurl)==true){
                                $(this).html(val)
                            }
                        });

                        var that = this.elem.next();
                        res.data.forEach(function (item, index) {
                            if (item.is_up == '上架') {
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='down']").css("display","");
                              tr.find("[lay-event='up']").css("display","none");
                            }else{
                              var tr = that.find(".layui-table-box tbody tr[data-index='" + index + "']");
                              tr.find("[lay-event='down']").css("display","none");
                              tr.find("[lay-event='up']").css("display","");
                              tr.css("color","#ccff99");
                            }
                        });
                    }
                });

                //监听工具条
                table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        , layEvent = obj.event; //获得 lay-event 对应的值
                    if (layEvent === 'edit') {
                        location.href = '/admin/movie/movie/' + data.id + '/edit';
                    }

                    if (layEvent === 'del') {
                        layer.confirm('确认删除吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.movie.movie.destroy') }}", {
                                _method: 'delete',
                                ids: [data.id]
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

                    if (layEvent === 'up') {
                        layer.confirm('确认上架吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.movie.movie.up') }}", {
                                _method: 'delete',
                                id: data.id
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
                        });
                    }

                    if (layEvent === 'down') {
                        layer.confirm('确认下架吗？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.movie.movie.down') }}", {
                                _method: 'delete',
                                id: data.id
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
                        });
                    }

                    if (layEvent === 'collection') {
                        layer.confirm('确认下架影片，并到同步到采集内容管理？', function (index) {
                            layer.close(index)
                            var load = layer.load();
                            $.post("{{ route('admin.movie.movie.collection') }}", {
                                _method: 'delete',
                                id: data.id
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
                        });
                    }

                });

                //排序
                table.on('sort(dataTable)', function(obj){
                    //console.log(obj.field); //当前排序的字段名
                    //console.log(obj.type); //当前排序类型：desc（降序）、asc（升序）、null（空对象，默认排序）
                    //console.log(this); //当前排序的 th 对象

                    table.reload('table', {
                        initSort: obj //记录初始排序，如果不设的话，将无法标记表头的排序状态。
                        ,where: { //请求参数（注意：这里面的参数可任意定义，并非下面固定的格式）
                            date: $('#date').val(),
                            rdate: $('#rdate').val(),
                            category:$('#category').val(),
                            name:$('#name').val(),
                            search_key:$('#search_key').val(),
                            search_value:$('#search_value').val(),
                            is_up:$('#is_up').val(),
                            field: obj.field //排序字段   在接口作为参数字段  field order
                            ,order: obj.type //排序方式 
                        }
                      });
                });

                //搜索
                var laydate = layui.laydate;
                laydate.render({
                    elem: '#date'
                    ,type: 'datetime'
                    ,range: '~'
                });
                var rdate = layui.laydate;
                rdate.render({
                    elem: '#rdate'
                    ,type: 'datetime'
                    ,range: '~'
                });
                var active = {
                    reload: function(){
                        //执行重载
                        table.reload('table', {
                            page: {
                                curr: 1 //重新从第 1 页开始
                            },
                            where: {
                                date: $('#date').val(),
                                rdate: $('#rdate').val(),
                                category:$('#category').val(),
                                name:$('#name').val(),
                                search_key:$('#search_key').val(),
                                search_value:$('#search_value').val(),
                                is_up:$('#is_up').val()
                            }
                        });
                    }
                };
                $('#btn .layui-btn').on('click', function(){
                    var type = $(this).data('type');
                    active[type] ? active[type].call(this) : '';
                });

                $('#create').click(function () {
                    <?php
                        $create_html = '';
                        foreach ($categories as $category){
                            $url = route('admin.movie.movie.create',['category'=>$category]);
                            $create_html.= <<<EOF
<a class="layui-btn layui-btn-normal layui-btn-radius" target="_blank" style="margin: 10px!important;" href={$url}>{$category}</a>
EOF;
                        }
                    ?>
                    var html = '<?=$create_html?>';
                    layer.open({
                        type: 1,
                        title:'选择分类',
                        area: ['350px', '240px'], //宽高
                        content: html
                    });
                });

                /**导入影片数据*/
                $('#movie_upload').click(function () {
                    var html = '<div style="margin:20px">' + 
                                '<form method="post" target="_blank" action="{{route('admin.movie.movie.mvup')}}" enctype="multipart/form-data">@csrf'+ 
                                '<p><input type="file" name="file"/></p>' + 
                                '<p style="margin:10px;"><input type="submit" value="导入影片"/></p>'+
                                '</form>'+
                                '</div>';
                    layer.open({
                        type: 1,
                        title:'批量导入',
                        area: ['350px', '240px'], //宽高
                        content: html
                    });
                });

                /**导入磁链数据*/
                $('#link_up').click(function () {
                    var html = '<div style="margin:20px">' + 
                                '<form method="post" target="_blank" action="{{route('admin.movie.movie.linkup')}}" enctype="multipart/form-data"> @csrf'+
                                '<p><input type="file" name="file"/></p>' + 
                                '<p style="margin:10px;"><input type="submit" value="导入磁链"/></p>'+
                                '</form>'+
                                '</div>';
                    layer.open({
                        type: 1,
                        title:'批量导入',
                        area: ['350px', '240px'], //宽高
                        content: html
                    });
                });

                /**
                 * 导出影片数据 
                 */
                $('#movie_download').click(function(){
                    //获取选择的搜索条件
                    var cDate  = $('#date').val();
                    var rDate  = $('#rdate').val();
                    var title  = $('#name').val();
                    var sKey   = $('#search_key').val();
                    var sVal   = $('#search_value').val();
                    var sc     = $('#category').val();

                    var html = '<div style="margin:20px">' + 
                                '<form method="post" target="_blank" action="{{route('admin.movie.movie.mvdown')}}"> @csrf'+
                                '<p><input type="hidden" name="date" value="'+cDate+'"/></p>'+
                                '<p><input type="hidden" name="rdate" value="'+rDate+'"/></p>'+
                                '<p><input type="hidden" name="name" value="'+title+'"/></p>'+
                                '<p><input type="hidden" name="search_key" value="'+sKey+'"/></p>'+
                                '<p><input type="hidden" name="search_value" value="'+sVal+'"/></p>'+
                                '<p><input type="hidden" name="category" value="'+sc+'"/></p>'+
                                '<p><input type="hidden" name="page" value="1"/></p>'+
                                '<p><input type="hidden" name="limit" value="100"/></p>'+
                                '<p style="margin:10px;"><input type="submit" value="导出影片"/></p>'+
                                '</form>'+
                                '</div>';
                    layer.open({
                        type: 1,
                        title:'批量导出',
                        area: ['350px', '240px'], //宽高
                        content: html
                    });
                });

            })
        </script>
@endsection
