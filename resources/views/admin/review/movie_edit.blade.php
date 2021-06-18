@extends('admin.base')
<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
<link href="/bootfile/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@include('admin.review._upload')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>影片审核</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form layui-form-pane" action="{{route('admin.review.movie.update',['id'=>$movie->id])}}"
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
                        <label class="layui-form-label" style="background-color: #dccbcb;">导演</label>
                        <div class="layui-input-block">
                            <input type="text" name="director" value="{{$movie->director}}" readonly
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
                        <label class="layui-form-label">影片系列</label>
                        <div class="layui-input-block">
<input type="text" name="series" value="{{$movie->series}}" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">片商</label>
                        <div class="layui-input-block">
<input type="text" name="film_companies" value="{{$movie->film_companies}}" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">评分</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" value="{{$movie->score}}"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">评分人数</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" value="{{$movie->score_people}}"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">评论人数</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" value="{{$movie->comment_num}}"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">分类</label>
                        <div class="layui-input-inline">
                            <select name="category" lay-search  lay-filter="parent_id">
                                <option value="有码" <?=$movie->category == '有码'? 'selected':''  ?>>有码</option>
                                <option value="无码" <?=$movie->category == '无码'? 'selected':''  ?>>无码</option>
                                <option value="欧美" <?=$movie->category == '欧美'? 'selected':''  ?>>欧美</option>
                                <option value="fc2" <?=$movie->category == 'fc2'? 'selected':''  ?>>fc2</option>
                            </select>
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
                            <select name="category" lay-search  lay-filter="parent_id">
                                <option value="1" <?=$movie->is_download == 1? 'selected':''  ?>>不可下载</option>
                                <option value="2" <?=$movie->is_download == 2? 'selected':''  ?>>可下载</option>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">含字幕</label>
                        <div class="layui-input-inline">
                            <select name="category" lay-search  lay-filter="parent_id">
                                <option value="1" <?=!$movie->is_subtitle == 1? 'selected':''  ?>>不含字幕</option>
                                <option value="2" <?=!$movie->is_subtitle == 2? 'selected':''  ?>>含字幕</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">标签 (换行分割)</label>
                    <?php $label = (array)json_decode($movie->label); $label_string = implode("\r\n",$label); ?>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入标签换行分割" class="layui-textarea" name="category">{{$label_string}}</textarea>
                    </div>
                </div>


                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">演员列表</blockquote>
                <input type="hidden" name="actor" value="{{$movie->actor}}}">
                <table class="layui-table" lay-even="" lay-skin="row">
                        <?php
                    echo <<<EOF
<thead>
    <tr>
      <th>名子</th>
      <th>性别</th>
      <th>操作</th>
    </tr>
</thead>
<tbody>
EOF;
                    $actors = (array)json_decode($movie->actor);
                    foreach ($actors as $k=>$actor){
                        if($actor[1] == '♀'){
                            $option_string = "女";
                        }else{
                            $option_string = "男";
                        }

                        echo <<<EOF
<tr class="movie_actor_content" data-key={$k}>
<td>
{$actor[0]}
</td>
<td>
{$option_string}
</select>
</td>
    <td><button type="button" class="layui-btn layui-btn-normal layui-btn-sm delete_actor"><i class="layui-icon"></i></button></td>
</tr>
EOF;

                    }
                        ?>
                </table>

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
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确认发布</button>
                        <a  class="layui-btn" href="{{route('admin.review.movie')}}" >返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        layui.use(['element','form'],function () {

        })
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

        var actor = {
            data:JSON.parse('<?=$movie->actor?>'),
            delApply:function () {
                $(".delete_actor").click(function(){
                    var r = confirm("确定删除演员？");
                    if (r != true) {
                        return;
                    }
                    var key = $(this).parent().parent().attr('data-key');
                    actor.data.splice(key,1);
                    $(this).parent().parent().remove();
                    actor.rearrange();
                    $("input[name='actor']").val(JSON.stringify(actor.data).toString());
                });
            },
            rearrange:function () {
                document.querySelectorAll('.movie_actor_content').forEach(function(element, index, array) {
                    element.setAttribute('data-key',index+'');
                });
            }
        };
        actor.delApply();

        addFileInput("{{$movie->id}}",'big_cove','<?=$movie->big_cove?>');
        addFileInput("{{$movie->id}}",'small_cover','<?=$movie->small_cover?>');
        addFileInput("{{$movie->id}}",'trailer','<?=$movie->trailer?>',1,'video');

        addFileInput("{{$movie->id}}",'map','<?=$movie->map?>',20,'image');
    });
</script>
