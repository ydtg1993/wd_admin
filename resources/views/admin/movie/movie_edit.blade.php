@extends('admin.bas')
<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
<link href="/bootfile/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@include('admin.movie._upload')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>影片修改</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form layui-form-pane" action="{{route('admin.movie.movie.edit',['id'=>$movie->id])}}"
                  method="post" >
                {{ method_field('put') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label class="layui-form-label">影片名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" value="{{$movie->name}}" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">番号</label>
                        <div class="layui-input-block">
                            <input type="text" name="number" value="{{$movie->number}}"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">源番号</label>
                        <div class="layui-input-block">
                            <input type="text" name="number_source" value="{{$movie->source_site}}"
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">卖家</label>
                        <div class="layui-input-block">
                            <input type="text" name="sell" value="{{$movie->sell}}"
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">影片时长(秒)</label>
                        <div class="layui-input-block">
                            <input type="text" name="time" value="{{$movie->time}}"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">发布时间</label>
                        <div class="layui-input-block">
                            <input type="text" name="release_time" id="release_time" value="{{$movie->release_time}}"
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" >导演</label>
                        <div class="layui-input-inline">
                            <select name="director" lay-search  lay-filter="parent_id">
                                <option value="0">请选择</option>
                                <?php
                                 foreach ($directors as $id=>$director){
                                     $selected = '';
                                     if($movie_director_associate && $movie_director_associate->did ==$id){
                                         $selected = 'selected';
                                     }
                                     echo "<option value='{$id}' {$selected}>$director</option>";
                                 }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">影片类别</label>
                        <div class="layui-input-block">
                            <select name="category_id" lay-search  lay-filter="parent_id">
                                <option value="0">请选择</option>
                                <?php
                                foreach ($categories as $id=>$name){
                                    $selected = '';
                                    if($movie->cid ==$id){
                                        $selected = 'selected';
                                    }
                                    echo "<option value='{$id}' {$selected}>$name</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">影片系列</label>
                        <div class="layui-input-block">
                            <select name="series" lay-search  lay-filter="parent_id">
                                <option value="0">请选择</option>
                                <?php
                                foreach ($series as $id=>$serie){
                                    $selected = '';
                                    if($movie_series_associate && $movie_series_associate->series_id ==$id){
                                        $selected = 'selected';
                                    }
                                    echo "<option value='{$id}' {$selected}>$serie</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">片商</label>
                        <div class="layui-input-block">
                            <select name="company" lay-search  lay-filter="parent_id">
                                <option value="0">请选择</option>
                                <?php
                                foreach ($companies as $id=>$company){
                                    $selected = '';
                                    if($movie_film_companies_associate && $movie_film_companies_associate->film_companies_id ==$id){
                                        $selected = 'selected';
                                    }
                                    echo "<option value='{$id}' {$selected}>$company</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">评分</label>
                        <div class="layui-input-block">
                            <input type="text" name="score" value="{{$movie->score}}"
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">是否热门</label>
                        <div class="layui-input-inline">
                            <select name="is_hot">
                                <option value="1" <?=$movie->is_hot == 1? 'selected':''  ?>>普通</option>
                                <option value="2" <?=$movie->is_hot == 2? 'selected':''  ?>>热门</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">可否下载</label>
                        <div class="layui-input-inline">
                            <select name="is_download">
                                <option value="1" <?=$movie->is_download == 1? 'selected':''  ?>>不可下载</option>
                                <option value="2" <?=$movie->is_download == 2? 'selected':''  ?>>可下载</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">含字幕</label>
                        <div class="layui-input-inline">
                            <select name="is_subtitle">
                                <option value="1" <?=$movie->is_subtitle == 1? 'selected':''  ?>>不含字幕</option>
                                <option value="2" <?=$movie->is_subtitle == 2? 'selected':''  ?>>含字幕</option>
                            </select>
                        </div>
                    </div>
                </div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">标签列表</blockquote>
                <div id="labels"></div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">演员列表</blockquote>
                <div id="actors"></div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">磁链编辑</blockquote>
                <input type="hidden" name="flux_linkage" value="{{$movie->flux_linkage}}">
                <table class="layui-table" lay-even="" lay-skin="row">
                        <?php $flux_linkage = (array)json_decode($movie->flux_linkage);
echo <<<EOF
<thead>
    <tr>
        <th>名称</th>
        <th>地址</th>
        <th>文件信息</th>
        <th>更新时间</th>
        <th>是否高清【填1为是2为否】</th>
        <th>是否含字幕【填1为是2为否】</th>
        <th>是否可下载【填1为是2为否】</th>
        <th>操作</th>
    </tr>
</thead>
<tbody id="linkage_body">
EOF;

                        foreach ($flux_linkage as $key=>$link){
                           $obj = (array)$link;
                            echo <<<EOF
<tr class="linkage_content" data-key={$key}>
<td>
<input type="text" name="linkage_name" data-name="name" value="{$link->name}"
                                   class="layui-input"></td>
<td>
<input type="text" name="linkage_url" data-name="url" value="{$link->url}"
                                   class="layui-input">
</td>
<td>
<input type="text" name="linkage_tooltip" data-name="meta" value="{$link->meta}"
                                   class="layui-input">
</td>
<td>
<input type="hidden" name="linkage_time" data-name="time" value="{$link->time}">{$link->time}
</td>
<td>
 <input type="text" name="linkage_issmall" data-name="issmall" value="{$obj['is-small']}"
                                   class="layui-input">
</td>
<td>
 <input type="text" name="linkage_iswarning" data-name="iswarning" value="{$obj['is-warning']}"
                                   class="layui-input">
</td>
<td>
 <input type="text" name="linkage_url" data-name="tooltip" value="{$link->tooltip}"
                                   class="layui-input">
</td>

<td><button type="button" class="layui-btn layui-btn-normal layui-btn-sm delete_linkage"><i class="layui-icon"></i></button></td>
</tr>
EOF;
                        }
echo '</tbody>';
                        ?>
                    <tfoot>
                        <tr><td colspan="10"><button id="create_linkage" type="button" class="layui-btn">添加</button></td></tr>
                    </tfoot>
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
                        <button type="button" id="manual_crop">手动切图</button>
                    </div>

                    <div class="layui-col-md4">
                        <label class="control-label">预告片</label>
                        <div class="file-loading">
                            <input id="trailer" name="trailer" type="file">
                        </div>
                    </div>
                </div>
                    <div id="manual_crop_area"></div>
                    <button type="button" style="display: none" id="cancel_manual_crop">取消切图</button>
                    <button type="button" style="display: none" id="confirm_manual_crop">确认裁剪</button>
                </div>
                <hr/>

                <div class="layui-form-item">
                        <label class="control-label">组图 (最多可支持20张)</label>
                        <div class="file-loading">
                            <input id="map" name="map[]" type="file" multiple accept="image/*">
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
        layui.use(['element','form','laydate'],function () {
            var laydate = layui.laydate;
            laydate.render({
                elem: '#release_time'
                ,type: 'datetime'
            });

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
            $('#'+name+'-search').blur(tagSearch);
            $('#'+name+'Category li').click(tagCategory);
            $('#'+name+'-parents li').click(tagParents);
        }
        var labelFilter = {category:<?=json_encode($labelCategory)?>,parents:<?=json_encode($labelParent)?>};

        componentSelect('labels',JSON.parse('<?=json_encode($selected_labels);?>'),JSON.parse('<?=json_encode($labels);?>'),labelFilter);
        componentSelect('actors',JSON.parse('<?=json_encode($selected_actors);?>'),JSON.parse('<?=json_encode($actors);?>'),'');

        var linkpage = {
            <?php if($flux_linkage){?>
            data:[<?php foreach ($flux_linkage as $key=>$link){
                        $obj = (array)$link;
                        echo '{name:"'.$obj['name'].'",'.
                         'url:"'.$obj['url'].'",'.
                         'meta:"'.$obj['meta'].'",'.
                         'time:"'.$obj['time'].'",'.
                         'issmall:"'.$obj['is-small'].'",'.
                         'iswarning:"'.$obj['is-warning'].'",'.
                         'tooltip:"'.$obj['tooltip'].'"'.
                         '},';
                 }?>],
            <?php }else{?>
            data:[{name:'',url:'',meta:'',time:'',issmall:'',iswarning:'',tooltip:''}],
        <?php }?>
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
                    linkpage.data.push({name:'',url:'',meta:'',time:'',issmall:'',iswarning:'',tooltip:''});
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
                $("input[name='linkage_meta']").change(linkpage.change);
                $("input[name='linkage_time']").change(linkpage.change);
                $("input[name='linkage_issmall']").change(linkpage.change);
                $("input[name='linkage_iswarning']").change(linkpage.change);
                $("input[name='linkage_tooltip']").change(linkpage.change);
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

        addFileInput("{{$movie->id}}",'big_cove','<?=$movie->big_cove?>');
        addFileInput("{{$movie->id}}",'small_cover','<?=$movie->small_cover?>');
        addFileInput("{{$movie->id}}",'trailer','<?=$movie->trailer?>',1,'video');

        addFileInput("{{$movie->id}}",'map',JSON.parse('<?=$movie->map?>'),20,'image');


        var manual_crop = {
            lock:false,
            basic:{},
            init:function () {
                $('#manual_crop').click(manual_crop.apply);
                $('#confirm_manual_crop').click(manual_crop.crop);
                $('#cancel_manual_crop').click(manual_crop.cancel);
            },
            apply:function () {
                if(!manual_crop.lock) {
                    $('#confirm_manual_crop').show();
                    $('#cancel_manual_crop').show();
                    manual_crop.lock= true;
                    manual_crop.basic = $('#manual_crop_area').croppie({
                        viewport: {
                            width: 285,
                            height: 160
                        },
                        showZoomer: false,
                    });
                    manual_crop.basic.croppie('bind', {
                        url: '<?php echo e(config('app.url')); ?>resources/' + '<?=$movie->big_cove?>',
                    });
                }else{
                    manual_crop.cancel();
                }
            },
            crop:function () {
                var result = manual_crop.basic.croppie('get');
                if(manual_crop.lock){
                    $.ajax({
                        url: "{{ route('api.autoCrop') }}",
                        type:'POST',
                        data:{id:"{{$movie->id}}",points:result.points},
                        beforeSend:function(){

                        },
                        success:function (res) {
                            manual_crop.cancel();
                            if(res.code != 0){
                                alert(res.msg);
                            }else {
                                var img = '<?php echo e(config('app.url')); ?>resources/' + res.msg + "?tempid=" + Math.random();
                                var html = "<div class=\"file-preview-frame krajee-default  file-preview-initial file-sortable kv-preview-thumb\" id=\"thumb-big_cove-init-0\" data-fileindex=\"init-0\" data-fileid=\"thumb-big_cove-init-0\" data-template=\"image\">" +
                                    "<div class=\"kv-file-content\">\n" +
                                    "<img src=\""+img+"\" class=\"file-preview-image kv-preview-data\" title=\""+res+"\" alt=\""+res+"\" style=\"width: auto; height: auto; max-width: 100%; max-height: 100%;\">\n" +
                                    "</div></div>";
                                var dom = $('#small_cover').parent().parent().parent().parent().find(".file-preview  .clearfix");
                                dom.html(html);
                            }
                        }
                    })
                }
            },
            cancel:function () {
                $('#confirm_manual_crop').hide();
                $('#cancel_manual_crop').hide();
                $('#manual_crop_area').croppie('destroy');
                manual_crop.lock= false;
            }
        };
        manual_crop.init();
    });
</script>
