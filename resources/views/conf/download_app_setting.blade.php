@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>下载本站APP</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.conf.save_download_app_setting')}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <input type="hidden" name="type" value="2" >
                <input type="hidden" name="id" value="{{$dataInfo['id']}}" >
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">网址</label>
                    <div class="layui-input-inline">
                        <input type="text" name="url" value="{{$dataInfo['url']??''}}"  placeholder="请输入下载地址" class="layui-input" >
                    </div>
                </div>
                @can('conf.download_app_setting.edit')
                <div class="layui-form-item">
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
@endsection
