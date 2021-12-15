@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新过滤词</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.user_client.filter.update')}}" method="post">
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">过滤词</label>
                    <div class="layui-input-inline">
                        <input type="hidden" name="id" value="{{ $info->id }}" >
                        <input type="hidden" name="adminer" value="{{ $info->adminer ?? old('adminer') }}" >
                        <input type="text" name="content" value="{{ $info->content ?? old('content') }}" lay-verify="required" placeholder="请输入过滤词" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.user_client.filter')}}" >返 回</a>
                    </div>
                </div>
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