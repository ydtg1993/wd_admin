@extends('admin.base')
<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
<link href="/bootfile/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@include('admin.movie._upload')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>影片审核</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form layui-form-pane" action="{{route('admin.movie.movie.update',['id'=>$movie->id])}}"
                  method="post">
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
                            <input type="text" name="number" value="{{$movie->number}}" readonly
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">来源网站</label>
                        <div class="layui-input-block">
                            <input type="text" name="source_site" value="{{$movie->source_site}}" readonly
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">卖家</label>
                        <div class="layui-input-block">
                            <input type="text" name="sell" value="{{$movie->sell}}" readonly
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">影片时长</label>
                        <div class="layui-input-block">
                            <input type="text" name="time" value="{{$movie->time}}" readonly
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">发布时间</label>
                        <div class="layui-input-block">
                            <input type="text" name="release_time" value="{{$movie->release_time}}" readonly
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">验证网址</label>
                        <div class="layui-input-block">
                            <input type="text" name="actual_source" value="{{$movie->actual_source}}"
                                   readonly class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" >导演</label>
                        <div class="layui-input-inline">
                            <select name="director" lay-search  lay-filter="parent_id">
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
                        <label class="layui-form-label">影片系列</label>
                        <div class="layui-input-block">
                            <select name="series" lay-search  lay-filter="parent_id">
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
                        <label class="layui-form-label">评分人数</label>
                        <div class="layui-input-block">
                            <input type="text" name="score_people" value="{{$movie->score_people}}"
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
                                <option value="1" <?=$movie->is_download == 1? 'selected':''  ?>>不可下载</option>
                                <option value="2" <?=$movie->is_download == 2? 'selected':''  ?>>可下载</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">含字幕</label>
                        <div class="layui-input-inline">
                            <select name="is_subtitle" lay-search  lay-filter="parent_id">
                                <option value="1" <?=!$movie->is_subtitle == 1? 'selected':''  ?>>不含字幕</option>
                                <option value="2" <?=!$movie->is_subtitle == 2? 'selected':''  ?>>含字幕</option>
                            </select>
                        </div>
                    </div>
                </div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">标签列表</blockquote>
                <div id="labels"></div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">演员列表</blockquote>
                <div id="actors"></div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">种子链接</blockquote>
                <input type="hidden" name="flux_linkage" value="{{$movie->flux_linkage}}}">
                <table class="layui-table" lay-even="" lay-skin="row">
                        <?php $flux_linkage = (array)json_decode($movie->flux_linkage);
echo <<<EOF
<thead>
    <tr>
      <th>名称</th>
      <th>地址</th>
      <th>工具</th>
      <th>数据</th>
      <th>操作</th>
    </tr>
</thead>
<tbody>
EOF;

                        foreach ($flux_linkage as $key=>$link){
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
 <input type="text" name="linkage_url" data-name="tooltip" value="{$link->tooltip}"
                                   class="layui-input">
</td>
<td>
<input type="text" name="linkage_tooltip" data-name="meta" value="{$link->meta}"
                                   class="layui-input">
</td>
<td><button type="button" class="layui-btn layui-btn-normal layui-btn-sm delete_linkage"><i class="layui-icon"></i></button></td>
</tr>
EOF;
                        }
echo '</tbody>';
                        ?>
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
        layui.use(['element','form'],function () {

        });

        function componentSelect(name,selected,options) {
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

            var selected_dom = '';
            var options_dom = '';
            var selected_tag = '';

            for(var i in options){
                var tag_name = options[i];
                tag_name = decodeURI(tag_name);

                if(selected.indexOf(parseInt(i)) > -1){
                    selected_dom+= "<div class='btn btn-success v-tag' data-id='"+i+"'  style='margin-right: 8px;margin-bottom: 8px'>"+tag_name+"</div>";
                    selected_tag+= i + ',';
                    continue;
                }
                options_dom+= "<div class='btn btn-primary v-tag' data-id='"+i+"'  style='margin-right: 8px;margin-bottom: 8px'>"+tag_name+"</div>";
            }
            selected_tag = selected_tag.replace(/,$/g, '');

            var html = '<div style="width: 100%;display: grid; grid-template-rows: 45px 140px;border: 1px solid #ccc;border-radius: 10px">\n' +
                '                    <div id="'+name+'-select" style="overflow-y: auto;border-bottom: 1px solid #ccc;padding: 5px">\n' +
                selected_dom+
                '                    </div>\n' +
                '                    <div id="'+name+'-content" style="overflow-y: auto;padding: 5px">\n' +
                options_dom +
                '                    </div>\n' +
                '                    <input type="hidden" name="'+name+'" value='+selected_tag+'>\n' +
                '                </div>';
            document.getElementById(name).innerHTML = html;

            $('#'+name+'-select .v-tag').click(tagCancel);
            $('#'+name+'-content .v-tag').click(tagSelect);
        }
        componentSelect('labels',JSON.parse('<?=json_encode($selected_labels);?>'),JSON.parse('<?=json_encode($labels);?>'));
        componentSelect('actors',JSON.parse('<?=json_encode($selected_actors);?>'),JSON.parse('<?=json_encode($actors);?>'));

        var linkpage = {
            data:JSON.parse('<?=$movie->flux_linkage?>'),
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
            },
            upApply:function(){
                $("input[name='linkage_name']").change(linkpage.change);
                $("input[name='linkage_url']").change(linkpage.change);
                $("input[name='linkage_tooltip']").change(linkpage.change);
                $("input[name='linkage_meta']").change(linkpage.change);
                return this;
            },
            change:function(){
                var name = $(this).attr('data-name');
                var index = $(this).parent().parent().attr('data-key');
                if(!isNaN(Number(index))){
                    linkpage.data[index][name] = $(this).val();
                    $("input[name='flux_linkage']").val(JSON.stringify(linkpage.data).toString());
                }
            },
            rearrange:function () {
                document.querySelectorAll('.linkage_content').forEach(function(element, index, array) {
                    element.setAttribute('data-key',index+'');
                });
            }
        };
        linkpage.delApply();

        addFileInput("{{$movie->id}}",'big_cove','<?=$movie->big_cove?>');
        addFileInput("{{$movie->id}}",'small_cover','<?=$movie->small_cover?>');
        addFileInput("{{$movie->id}}",'trailer','<?=$movie->trailer?>',1,'video');

        addFileInput("{{$movie->id}}",'map','<?=$movie->map?>',20,'image');
    });
</script>
