@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>友情链接</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.conf.save_friend_link')}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <input type="hidden" name="type" value="4" >
                <input type="hidden" name="id" value="{{$dataInfo['id']}}" >
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">网址名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="post[0][name]" value="{{$dataInfo['post'][0]['name']??''}}"  placeholder="请输入网址名称" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">链接地址</label>
                    <div class="layui-input-inline">
                        <input type="text" name="post[0][url]" value="{{$dataInfo['post'][0]['url']??''}}"  placeholder="请输入友情链接" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">网址名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="post[1][name]" value="{{$dataInfo['post'][1]['name']??''}}"  placeholder="请输入网址名称" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">链接地址</label>
                    <div class="layui-input-inline">
                        <input type="text" name="post[1][url]" value="{{$dataInfo['post'][1]['url']??''}}"  placeholder="请输入友情链接" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">网址名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="post[2][name]" value="{{$dataInfo['post'][2]['name']??''}}"  placeholder="请输入网址名称" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">链接地址</label>
                    <div class="layui-input-inline">
                        <input type="text" name="post[2][url]" value="{{$dataInfo['post'][2]['url']??''}}"  placeholder="请输入友情链接  " class="layui-input" >
                    </div>
                </div>
                @can('conf.friend_link.edit')
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
