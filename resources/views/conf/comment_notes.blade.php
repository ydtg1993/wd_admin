@extends('admin.base')

@section('content')


    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>短评须知</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.conf.save_comment_notes')}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <input type="hidden" name="type" value="7" >
                <input type="hidden" name="id" value="{{isset($dataInfo['id'])?$dataInfo['id']:0}}" >

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">开关</label>
                    <div class="layui-input-block">
                        <input type="radio" name="isopen" value="1" title="开" class="radio" <?php if($dataInfo['isopen']==1){echo 'checked';}?>>
                        <input type="radio" name="isopen" value="2" title="关" class="radio" <?php if($dataInfo['isopen']==2){echo 'checked';}?>>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">显示时间（秒）</label>
                    <div class="layui-input-inline">
                        <input type="number" name="countdown" value="{{$dataInfo['countdown']??''}}"  placeholder="显示倒计时（秒）" class="layui-input" min="0">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">内容</label>
                </div>
                <div style="padding-left:100px">
                    <!-- 加载编辑器的容器 -->
                    <script id="container" name="content" type="text/plain" style="width:600px;height:200px;">

                    </script>
                </div>
                @can('conf.about_us.edit')
                <div class="layui-form-item" style="padding-left:230px;padding-top: 20px">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">保 存</button>
                    </div>
                </div>
                @endcan
            </form>
        </div>
    </div>
@endsection

@section('script')

<?php
    $conf = $dataInfo['content'];
    $conf =str_replace(array("\r\n", "\r", "\n"), "", $conf);  
    $conf = str_replace(PHP_EOL,'',$conf);
    $conf = str_replace('
','',$conf);
?>

    <script>
        layui.use(['element','form'],function () {

        })
        var ue = UM.getEditor("container");
        //对编辑器的操作最好在编辑器ready之后再做
        ue.ready(function(){
            var content = '<?=$conf?>';
            //设置编辑器的内容
            ue.setContent(content);
        });


    </script>
@endsection
