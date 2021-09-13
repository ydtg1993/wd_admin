@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>创建顶部轮播</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.top.store_top')}}" method="post">
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
@endsection
