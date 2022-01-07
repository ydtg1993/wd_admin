@extends('admin.base')

@section('content')


    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>隐私条款</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.conf.save_private_item')}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <input type="hidden" name="type" value="5" >
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
                    <textarea id="container" name="content" type="text/plain" style="width:600px;height:200px;">
                        {{$dataInfo['content']}}
                    </textarea>
                </div>
                @can('conf.private_item.edit')
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
    </script>
    <script src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'container', {
                    language: 'zh-cn',
                } );
    </script>
@endsection
