@extends('admin.bas')
<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
<link href="/bootfile/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@include('admin.movie._upload')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>影片创建</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form layui-form-pane" action="{{route('admin.movie.movie.create')}}"
                  method="post" enctype="multipart/form-data">
                {{ method_field('post') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label class="layui-form-label">影片名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" class="layui-input">
                        <input type="hidden" name="category" value="<?=$_GET['category']?>" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label" >番号</label>
                        <div class="layui-input-block">
                            <input type="text" name="number"
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" >卖家</label>
                        <div class="layui-input-block">
                            <input type="text" name="sell" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" >影片时长</label>
                        <div class="layui-input-block">
                            <input type="number" name="time"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" >发布时间</label>
                        <div class="layui-input-block">
                            <input type="text" name="release_time"
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" >导演</label>
                        <div class="layui-input-inline">
                            <select name="director" lay-search  lay-filter="parent_id">
                                <?php
                                 foreach ($directors as $id=>$director){
                                     echo "<option value='{$id}' >$director</option>";
                                 }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">影片系列</label>
                        <div class="layui-input-block">
                            <select name="series" lay-search  lay-filter="parent_id">
                                <?php
                                foreach ($series as $id=>$serie){
                                    echo "<option value='{$id}'>$serie</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">片商</label>
                        <div class="layui-input-block">
                            <select name="company" lay-search  lay-filter="parent_id">
                                <?php
                                foreach ($companies as $id=>$company){
                                    echo "<option value='{$id}' >$company</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">评分</label>
                        <div class="layui-input-block">
                            <input type="number" min="0" max="10" value="1" name="score"
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">是否热门</label>
                        <div class="layui-input-inline">
                            <select name="is_hot" lay-search  lay-filter="parent_id">
                                <option value="1" >普通</option>
                                <option value="2" >热门</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">可否下载</label>
                        <div class="layui-input-inline">
                            <select name="is_download" lay-search  lay-filter="parent_id">
                                <option value="1" >不可下载</option>
                                <option value="2" >可下载</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">含字幕</label>
                        <div class="layui-input-inline">
                            <select name="is_subtitle" lay-search  lay-filter="parent_id">
                                <option value="1" >不含字幕</option>
                                <option value="2" >含字幕</option>
                            </select>
                        </div>
                    </div>
                </div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">标签列表</blockquote>
                <div id="labels"></div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">演员列表</blockquote>
                <div id="actors"></div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">磁链</blockquote>
                <input type="hidden" name="flux_linkage" >
                <table class="layui-table" lay-even="" lay-skin="row">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>地址</th>
                        <th>文件信息</th>
                        <th>是否高清【填1为是2为否】</th>
                        <th>是否含字幕【填1为是2为否】</th>
                        <th>是否可下载【填1为是2为否】</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody id="linkage_body">
                    <tr class="linkage_content" data-key=0>
                        <td>
                            <input type="text" name="linkage_name" data-name="name"
                                   class="layui-input"></td>
                        <td>
                            <input type="text" name="linkage_url" data-name="url"
                                   class="layui-input">
                        </td>
                        <td>
                            <input type="text" name="linkage_meta" data-name="meta"
                                   class="layui-input">
                        </td>
                        <td>
                            <input type="text" name="linkage_issmall" data-name="issmall"
                                   class="layui-input">
                        </td>
                        <td>
                            <input type="text" name="linkage_iswarning" data-name="iswarning"
                                   class="layui-input">
                        </td>
                        <td>
                            <input type="text" name="linkage_tooltip" data-name="tooltip"
                                   class="layui-input">
                        </td>
                        <td><button type="button" class="layui-btn layui-btn-normal layui-btn-sm delete_linkage"><i class="layui-icon"></i></button></td>
                    </tr>
                    <tfoot>
                    <tr><td colspan="10"><button id="create_linkage" type="button" class="layui-btn">添加</button></td></tr>
                    </tfoot>
                    </tbody>
                </table>


                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">视图资源</blockquote>

                <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-md4">
                        <label class="control-label">封面</label>
                        <div class="file-loading">
                            <input id="big_cove" name="big_cove" type="file">
                        </div>
                    </div>

                    <div class="layui-col-md4">
                        <label class="control-label">小封面</label>
                        <div class="file-loading">
                            <input id="small_cover" name="small_cover" type="file">
                        </div>
                    </div>

                    <div class="layui-col-md4">
                        <label class="control-label">预告片</label>
                        <div class="file-loading">
                            <input id="trailer" name="trailer" type="file">
                        </div>
                    </div>
                </div>
                </div>
                <hr/>


                <div class="layui-form-item">
                        <label class="control-label">组图 (最多可支持6张)第一张</label>
                        <div class="file-loading">
                            <input id="map1" name="map[0]" type="file"  accept="image/*">
                        </div>
                </div>
                <div class="layui-form-item">
                    <label class="control-label">组图 (最多可支持6张)第二张</label>
                    <div class="file-loading">
                        <input id="map2" name="map[1]" type="file"  accept="image/*">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="control-label">组图 (最多可支持6张)第三张</label>
                    <div class="file-loading">
                        <input id="map3" name="map[2]" type="file"  accept="image/*">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="control-label">组图 (最多可支持6张)第四张</label>
                    <div class="file-loading">
                        <input id="map4" name="map[3]" type="file"  accept="image/*">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="control-label">组图 (最多可支持6张)第五张</label>
                    <div class="file-loading">
                        <input id="map5" name="map[4]" type="file"  accept="image/*">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="control-label">组图 (最多可支持6张)第六张</label>
                    <div class="file-loading">
                        <input id="map6" name="map[5]" type="file"  accept="image/*">
                    </div>
                </div>
                <hr/>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.movie.movie')}}" >返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        layui.use(['element','form'],function () {

        });

        function componentSelect(name,selected,options,multiple) {
            function tagSelect() {
                var cdom = this.cloneNode(true);
                cdom.addEventListener('click',tagCancel);
                $('#'+name+'-select').append(cdom);
                this.remove();
                addVal();
            }
            function tagCancel() {
                var cdom = this.cloneNode(true);
                cdom.addEventListener('click',tagSelect);
                $('#'+name+'-content').append(cdom);
                this.remove();
                addVal();
            }
            function addVal() {
                var val = '';
                $('#'+name+'-select').children().each(function(i,n){
                    val += parseInt(n.getAttribute('data-id'))+",";
                });
                val = val.replace(/,$/g, '');
                $("input[name="+name+"]").val(val);
            }
            function tagSearch(){
                var input = $(this).val();

                //遍历数据
                $("#"+name+"-content").children().hide();
                $("#"+name+"-content").children().each(function(da){
                    if($(this).html().indexOf(input)>=0){
                        $(this).show();
                    }
                });
            }
            function tagCategory(){
                var input = $(this).attr('title');
                var arr= new Array();   //定义一数组
                arr=input.split(",");   //选择后，下一级需要显示的

                $('#'+name+'-parents li').each(function(){
                    if(arr.indexOf($(this).attr("id"))==-1){
                        //不包含在children中隐藏
                        $(this).hide();
                    }else{
                        $(this).show();
                    }
                });
            }
            function tagParents(){
                var input = $(this).attr('title');
                var arr= new Array();   //定义一数组
                arr=input.split(",");   //选择后，下一级需要显示的

                $("#"+name+"-content").children().each(function(){
                    if(arr.indexOf($(this).attr("data-id"))==-1){
                        $(this).hide();
                    }else{
                        $(this).show();
                    }
                });
            }

            var selected_dom = '';
            var options_dom = '';
            var selected_tag = '';

            for(var i in options){
                var tag_name = options[i];
                tag_name = decodeURI(tag_name);

                if(selected.indexOf(parseInt(i)) > -1){
                    selected_dom+= "<div class='btn btn-success v-tag' data-id='"+i+"'  style='margin-right: 8px;margin-bottom: 8px'>"+tag_name+"<img src='/x_close.png' class='divX'/></div>";
                    selected_tag+= i + ',';
                    continue;
                }
                options_dom+= "<div class='btn btn-primary v-tag' data-id='"+i+"'  style='margin-right: 8px;margin-bottom: 8px'>"+tag_name+"</div>";
            }
            selected_tag = selected_tag.replace(/,$/g, '');

            //搜索条件
            var filter="";
            if(multiple!='')
            {
                if(multiple.category != undefined){
                     filter = '<div id="'+name+'Category"><div>请选择分类：</div>';
                    var options = "";
                    for(var i in multiple.category)
                    {
                        var li = multiple.category[i];
                        options = options + '<li class="btn btn-primary" title="'+li.children+'">' + li.name +'</li>';
                    }
                    filter = filter + options +'</div>';
                }

                if(multiple.parents != undefined){
                    filter = filter + '<div id="'+name+'-parents"><div>请选择父级：</div>';
                    var options = "";
                    for(var i in multiple.parents)
                    {
                        var li = multiple.parents[i];
                        options = options + '<li class="btn btn-primary" id="'+li.id+'" title="'+li.children+'">' + li.name +'</li>';
                    }
                    filter = filter + options +'</div>';
                }
            }

            var html = '<div style="width: 100%;display: grid; grid-template-rows: 45px 140px;border: 1px solid #ccc;border-radius: 10px">\n' +
                '                    <div id="'+name+'-select" style="overflow-y: auto;border-bottom: 1px solid #ccc;padding: 5px">\n' +
                selected_dom+
                '                    </div>\n' +
                '   <div style="overflow-y: auto;padding: 5px;">'+filter+'<input id="'+name+'-search" type="input" value="" placeholder="请输入名称">\n'+
                '</div>'+
                '                    <div id="'+name+'-content" style="overflow-y: auto;padding: 5px">\n' +
                options_dom +
                '                    </div>\n' +
                '                    <input type="hidden" name="'+name+'" value='+selected_tag+'>\n' +
                '                </div>';
            document.getElementById(name).innerHTML = html;

            $('#'+name+'-select .v-tag').click(tagCancel);
            $('#'+name+'-content .v-tag').click(tagSelect);
            $('#'+name+'-search').keydown(tagSearch);
            $('#'+name+'Category li').click(tagCategory);
            $('#'+name+'-parents li').click(tagParents);
        }
        var labelFilter = {category:<?=json_encode($labelCategory)?>,parents:<?=json_encode($labelParent)?>};

        componentSelect('labels',[],JSON.parse('<?=json_encode($labels);?>'),labelFilter);
        componentSelect('actors',[],JSON.parse('<?=json_encode($actors);?>'),'');

        var linkpage = {
            data:[{name:'',url:'',meta:'',issmall:'',iswarning:'',tooltip:'',}],
            addApply:function(){
                var html ='<tr class="linkage_content" data-key={$key}>\n' +
                    '<td>\n' +
                    '<input type="text" name="linkage_name" data-name="name" \n class="layui-input"></td>\n' +
                    '<td>\n' +
                    '<input type="text" name="linkage_url" data-name="url" class="layui-input">\n' +
                    '</td>\n' +
                    '<td>\n' +
                    ' <input type="text" name="linkage_meta" data-name="meta" class="layui-input">\n' +
                    '</td>\n' +
                    '<td>\n' +
                    '<input type="text" name="linkage_issmall" data-name="issmall" class="layui-input">\n' +
                    '</td>\n' +
                    '<td>\n' +
                    '<input type="text" name="linkage_iswarning" data-name="iswarning" class="layui-input">\n' +
                    '</td>\n' +
                    '<td>\n' +
                    '<input type="text" name="linkage_tooltip" data-name="tooltip" class="layui-input">\n' +
                    '</td>\n' +
                    '<td><button type="button" class="layui-btn layui-btn-normal layui-btn-sm delete_linkage"><i class="layui-icon"></i></button></td>\n' +
                    '</tr>';
                $('#create_linkage').click(function () {
                    $('#linkage_body').append(html);
                    linkpage.data.push({name:'',url:'',meta:'',issmall:'',iswarning:'',tooltip:''});
                    linkpage.rearrange();
                    linkpage.delApply().upApply();
                });
                return this;
            },
            delApply:function () {
                $(".delete_linkage").click(function(){
                    var r = confirm("确定删除链接？");
                    if (r != true) {
                        return;
                    }
                    var key = $(this).parent().parent().attr('data-key');
                    linkpage.data.splice(key,1);
                    $(this).parent().parent().remove();
                    linkpage.rearrange();
                    $("input[name='flux_linkage']").val(JSON.stringify(linkpage.data).toString());
                });
                return this;
            },
            upApply:function(){
                $("input[name='linkage_name']").change(linkpage.change);
                $("input[name='linkage_url']").change(linkpage.change);
                $("input[name='linkage_tooltip']").change(linkpage.change);
                $("input[name='linkage_meta']").change(linkpage.change);
                $("input[name='linkage_issmall']").change(linkpage.change);
                $("input[name='linkage_iswarning']").change(linkpage.change);
                return this;
            },
            change:function(){
                var name = $(this).attr('data-name');
                var index = $(this).parent().parent().attr('data-key');
                if(!isNaN(Number(index))){
                    linkpage.data[index][name] = $(this).val();
                    $("input[name='flux_linkage']").val(JSON.stringify(linkpage.data).toString());
                }
                console.log(linkpage.data)
            },
            rearrange:function () {
                document.querySelectorAll('.linkage_content').forEach(function(element, index, array) {
                    element.setAttribute('data-key',index+'');
                });
            }
        };
        linkpage.addApply().delApply().upApply();


        createFileInput('big_cove');
        createFileInput('small_cover');
        createFileInput('trailer',1,'video');

        createFileInput('map1');
        createFileInput('map2');
        createFileInput('map3');
        createFileInput('map4');
        createFileInput('map5');
        createFileInput('map6');
    });
</script>
