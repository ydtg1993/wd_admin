@extends('admin.base')
@section('content')
<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新标签</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.movie.label.edit',['id'=>$label->id])}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" value="{{ $label->name ?? old('name') }}" lay-verify="required" placeholder="请输公司名称" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">排序号</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort" lay-verify="required" placeholder="排序" class="layui-input" value="{{ $label->sort ?? old('sort') }}">
                    </div>
                </div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">分类</blockquote>
                <div id="category"></div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">子标签</blockquote>
                <div id="children"></div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.movie.label')}}" >返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="/bootfile/js/jquery-3.5.1.min.js"></script>
    <script>
        layui.use(['element','form'],function () {
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
                        selected_dom+= "<div class='btn btn-success v-tag' data-id='"+i+"'  style='margin-right: 8px;margin-bottom: 8px;position:relative;'>"+tag_name+"<img src='/x_close.png' class='divX'/></div>";
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

            //分类
            componentSelect('category',<?=json_encode($selectCategory);?>,JSON.parse('<?=json_encode(str_replace("'","",$categorys));?>'));
            //子标签
            componentSelect('children',<?=json_encode($selectChilden);?>,JSON.parse('<?=json_encode(str_replace("'","",$childrens));?>'));
        });
    </script>
@endsection
