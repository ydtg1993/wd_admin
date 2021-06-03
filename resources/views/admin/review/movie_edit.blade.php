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
                            <input type="text" name="number" value="{{$movie->number}}" disabled
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">来源网站</label>
                        <div class="layui-input-block">
                            <input type="text" name="source_site" value="{{$movie->source_site}}" disabled
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">导演</label>
                        <div class="layui-input-block">
                            <input type="text" name="director" value="{{$movie->director}}" disabled
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">卖家</label>
                        <div class="layui-input-block">
                            <input type="text" name="sell" value="{{$movie->sell}}" disabled
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">影片时长</label>
                        <div class="layui-input-block">
                            <input type="text" name="time" value="{{$movie->time}}" disabled
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">发布时间</label>
                        <div class="layui-input-block">
                            <input type="text" name="release_time" value="{{$movie->release_time}}" disabled
                                   class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">影片系列</label>
                        <div class="layui-input-block">
                            <input type="text" name="series" value="{{$movie->series}}" disabled
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">片商</label>
                        <div class="layui-input-block">
                            <input type="text" name="film_companies" value="{{$movie->film_companies}}"
                                   disabled class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">验证网址</label>
                        <div class="layui-input-block">
                            <input type="text" name="actual_source" value="{{$movie->actual_source}}"
                                   disabled class="layui-input">
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
                        <select name="category" class="form-control" style="display: block!important;width: 150px;">
                            <option value="" <?=!$movie->category? 'selected':''  ?>>请选择</option>
                            <option value="有码" <?=!$movie->category == '有码'? 'selected':''  ?>>有码</option>
                            <option value="无码" <?=!$movie->category == '无码'? 'selected':''  ?>>无码</option>
                            <option value="欧美" <?=!$movie->category == '欧美'? 'selected':''  ?>>欧美</option>
                            <option value="fc2" <?=!$movie->category == 'fc2'? 'selected':''  ?>>fc2</option>
                        </select>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">可否下载</label>
                        <select name="is_download" class="form-control" style="display: block!important;width: 150px;">
                            <option value="1" <?=!$movie->is_download == 1? 'selected':''  ?>>不可下载</option>
                            <option value="2" <?=!$movie->category == 2? 'selected':''  ?>>可下载</option>
                        </select>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">含字幕</label>
                        <select name="is_subtitle" class="form-control" style="display: block!important;width: 150px;">
                            <option value="1" <?=!$movie->is_download == 1? 'selected':''  ?>>不含字幕</option>
                            <option value="2" <?=!$movie->category == 2? 'selected':''  ?>>含字幕</option>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">演员 (换行分割)</label>
                    <?php $actor = (array)json_decode($movie->actor); $actor_string = implode("\r\n",$actor); ?>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入演员换行分割" class="layui-textarea" name="actor">{{$actor_string}}</textarea>
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">标签 (换行分割)</label>
                    <?php $label = (array)json_decode($movie->label); $label_string = implode("\r\n",$label); ?>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入标签换行分割" class="layui-textarea" name="category">{{$label_string}}</textarea>
                    </div>
                </div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px">种子链接</blockquote>
                <div class="layui-collapse">
                    <div class="layui-colla-item flux_linkage_group">
                        <?php $flux_linkage = (array)json_decode($movie->flux_linkage);

                        foreach ($flux_linkage as $key=>$link){
                            echo <<<EOF
<h2 class="layui-colla-title">{$link->name}
<button type="button" class="layui-btn layui-btn-normal layui-btn-sm delete_linkage" data-key="{$key}"><i class="layui-icon"></i></button>
</h2>
<div class="layui-colla-content" style="display: block">
      <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="number" value="{$link->name}"
                                   class="layui-input">
                        </div>
                    </div>


                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">工具</label>
                        <div class="layui-input-block" style="display: block">
                            <input type="text" name="number" value="{$link->tooltip}"
                                   class="layui-input">
                        </div>
                    </div>


                    <div class="layui-inline">
                        <label class="layui-form-label" style="background-color: #dccbcb;">数据包</label>
                        <div class="layui-input-block" style="display: block">
                            <input type="text" name="number" value="{$link->meta}"
                                   class="layui-input">
                        </div>
                    </div>
      </div>
</div>
EOF;
                        }

                        ?>
                            <div style="margin: 0;">
                                <button type="button" id="add_link" class="layui-btn layui-btn-fluid">添加种子</button>
                            </div>
                    </div>
                </div>


                <blockquote class="layui-elem-quote" style="margin-top: 30px">视图资源</blockquote>

                <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-md4">
                        <label class="control-label">封面</label>
                        <div class="file-loading">
                            <?php
                            $big_cove = [];
                            if($movie->big_cove){
                                $big_cove = ['name'=>basename($movie->big_cove),'value'=>$movie->big_cove];
                            }
                            ?>
                            <input id="big_cove" name="big_cove" type="file">
                        </div>
                    </div>

                    <div class="layui-col-md4">
                        <label class="control-label">小封面</label>
                        <div class="file-loading">
                            <?php
                            $small_cover = [];
                            if($movie->small_cover){
                                $small_cover = ['name'=>basename($movie->small_cover),'value'=>$movie->small_cover];
                            }
                            ?>
                            <input id="small_cover" name="small_cover" type="file">
                        </div>
                    </div>

                    <div class="layui-col-md4">
                        <label class="control-label">预告片</label>
                        <div class="file-loading">
                            <?php
                            $trailer =[];
                            if($movie->trailer){
                                $trailer = ['name'=>basename($movie->trailer),'value'=>$movie->trailer];
                            }
                            ?>
                            <input id="trailer" name="trailer" type="file">
                        </div>
                    </div>
                </div>
                </div>
                <hr/>

                <div class="layui-form-item">
                        <label class="control-label">组图 (最多可支持20张)</label>
                        <div class="file-loading">
                            <?php
                            $map = [];
                            $movies = (array)json_decode($movie->map);
                            foreach ($movies as $m){
                                $map[] = ['name'=>basename($m),'value'=>$m];
                            }
                            ?>
                            <input id="map" name="map[]" type="file" multiple accept="image/*">
                        </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        var linkpage = {
            data:JSON.parse('<?=$movie->flux_linkage?>'),
            apply:function () {
                $('.delete_linkage').click(function () {
                    var r = confirm("确定删除链接？");
                    if (r != true) {
                        return;
                    }
                    var key = $(this).attr('data-key');
                    linkpage.data.splice(key,1);
                    $(this).parent().next().remove();
                    $(this).parent().remove();

                    document.querySelectorAll(".delete_linkage").forEach(function(element, index, array) {
                        element.setAttribute('data-key',index+'');
                    });
                });
            }
        };
        linkpage.apply();

        addFileInput("{{$movie->id}}",'big_cove',JSON.parse('<?=json_encode($big_cove)?>'));
        addFileInput("{{$movie->id}}",'small_cover',JSON.parse('<?=json_encode($small_cover)?>'));
        addFileInput("{{$movie->id}}",'trailer',JSON.parse('<?=json_encode($trailer)?>'),1,'video');

        addFileInput("{{$movie->id}}",'map',JSON.parse('<?=json_encode($map)?>'),20,'image');
    });
</script>
