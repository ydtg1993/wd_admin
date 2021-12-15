@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加广告位</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.ads.location.store')}}" method="post">
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">位置</label>
                    <div class="layui-input-inline">
                        <input type="text" name="location" value="" lay-verify="required" placeholder="位置" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">描述</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" value="" lay-verify="required" placeholder="描述" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.ads.location.index')}}" >返 回</a>
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