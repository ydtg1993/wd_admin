@extends('admin.base')
@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更改顶部轮播</h2>
        </div>
        <div class="layui-card-body">
                <form class="layui-form" action="{{route('admin.top.update_top',['id'=>$announcement->id])}}" method="post">
                    {{ method_field('put') }}
                @include('admin.announcement.top._form')
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