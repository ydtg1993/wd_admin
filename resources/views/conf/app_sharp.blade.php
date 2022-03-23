@extends('admin.base')

@section('content')


    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>app分享</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.conf.save_first_login')}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <input type="hidden" name="type" value="9" >
                <input type="hidden" name="id" value="{{isset($dataInfo['id'])?$dataInfo['id']:0}}" >

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">内容</label>
                </div>
                <div style="padding-left:100px">
                    <!-- 加载编辑器的容器 -->
                    <textarea id="container" name="content" type="text/plain" style="width:600px;height:200px;">{{isset($dataInfo['content'])?$dataInfo['content']:''}}</textarea>
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
    $conf = isset($dataInfo['content'])?$dataInfo['content']:'';
    $conf =str_replace(array("\r\n", "\r", "\n"), "", $conf);
    $conf = str_replace(PHP_EOL,'',$conf);
    $conf = str_replace('
','',$conf);
?>

    <script>
        layui.use(['element','form'],function () {

        })
    </script>
    <script src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">

    </script>
@endsection
