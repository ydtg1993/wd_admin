@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>编辑用户</h2>
        </div>
        <div class="layui-card-body">
                <form class="layui-form" action="{{route('admin.user_client.update',['id'=>$userClient->id])}}" method="post">
                    {{ method_field('put') }}
                @include('admin.user_client._form_edit')
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
