@extends('admin.base')
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
                  method="post">
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

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">种子链接</blockquote>
                <input type="hidden" name="flux_linkage" >
                <table class="layui-table" lay-even="" lay-skin="row">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>地址</th>
                        <th>工具</th>
                        <th>数据</th>
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
                            <input type="text" name="linkage_url" data-name="tooltip"
                                   class="layui-input">
                        </td>
                        <td>
                            <input type="text" name="linkage_tooltip" data-name="meta"
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
        componentSelect('labels',[],JSON.parse('<?=json_encode($labels);?>'));
        componentSelect('actors',[],JSON.parse('<?=json_encode($actors);?>'));

        var linkpage = {
            data:[{name:'',url:'',tooltip:'',meta:'','is-small':'','is-warning':''}],
            addApply:function(){
                var html ='<tr class="linkage_content" data-key={$key}>\n' +
                    '<td>\n' +
                    '<input type="text" name="linkage_name" data-name="name" \n class="layui-input"></td>\n' +
                    '<td>\n' +
                    '<input type="text" name="linkage_url" data-name="url" class="layui-input">\n' +
                    '</td>\n' +
                    '<td>\n' +
                    ' <input type="text" name="linkage_url" data-name="tooltip" class="layui-input">\n' +
                    '</td>\n' +
                    '<td>\n' +
                    '<input type="text" name="linkage_tooltip" data-name="meta" class="layui-input">\n' +
                    '</td>\n' +
                    '<td><button type="button" class="layui-btn layui-btn-normal layui-btn-sm delete_linkage"><i class="layui-icon"></i></button></td>\n' +
                    '</tr>';
                $('#create_linkage').click(function () {
                    $('#linkage_body').append(html);
                    linkpage.data.push({name:'',url:'',tooltip:'',meta:'','is-small':'','is-warning':''});
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

        createFileInput('map',20,'image');
    });
</script>
