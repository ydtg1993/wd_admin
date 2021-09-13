@extends('admin.base')

@section('content')


    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>关于我们</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.conf.save_about_us')}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <input type="hidden" name="type" value="3" >
                <input type="hidden" name="id" value="{{$dataInfo['id']}}" >
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">网址</label>
                    <div class="layui-input-inline">
                        <input type="text" name="url" value="{{$dataInfo['url']??''}}"  placeholder="请输入下载地址" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">富文本编辑</label>
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


    <script>
        layui.use(['element','form'],function () {

        })
        var ue = UM.getEditor("container");
        //对编辑器的操作最好在编辑器ready之后再做
        ue.ready(function(){
            var content = "{!! $dataInfo['content'] !!}";
            //设置编辑器的内容
            ue.setContent(content);
        });


    </script>
@endsection
