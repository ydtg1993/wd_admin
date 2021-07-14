@extends('admin.base')
<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
<link href="/bootfile/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@include('admin.movie_list._upload')
@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加片单</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.movie.list.create')}}" method="post" enctype="multipart/form-data">
                {{ method_field('post') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">标题</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" placeholder="请输片单名称" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">简介</label>
                    <div class="layui-input-block">
                        <textarea name="intro" placeholder="请输入简介" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">创建人</label>
                    <div class="layui-input-block">
                        <input name="uid" placeholder="创建用户id" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">关联影片(换行分割)</label>
                    <div class="layui-input-block">
                        <textarea name="numbers" placeholder="请输入影片番号 换行分割" class="layui-textarea"></textarea>
                    </div>
                </div>

                <div class="layui-col-md4">
                    <label class="control-label">封面</label>
                    <div class="file-loading">
                        <input id="cover" name="cover" type="file">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a class="layui-btn" href="{{route('admin.movie.list')}}">返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['element', 'form'], function () {

        });
        addFileInput('cover',true);
    </script>
@endsection
