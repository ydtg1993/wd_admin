@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>创建内容插播</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.message.store_message')}}" method="post">
                @include('admin.announcement.message._form')
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
