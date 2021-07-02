@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>采集-修改评分</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.review.score.update',['id'=>$score->id])}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">番号</label>
                    <div class="layui-input-inline">
                        <input type="text" name="number" value="{{ $score->number}}" lay-verify="required" disabled class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">用户名</label>
                    <div class="layui-input-inline">
                        <input type="text" name="user_name" value="{{ $score->user_name}}" lay-verify="required" placeholder="请输名称" class="layui-input" >
                    </div>
                </div>

                <div class="layui-inline">
                    <label class="layui-form-label">发布时间</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="content_time" id="content_time" value="{{$score->content_time}}">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.review.score')}}" >返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['element','form','laydate'],function () {
            var laydate = layui.laydate;

            //常规用法
            laydate.render({
                elem: '#content_time'
                ,type: 'datetime'
            });
        })
    </script>
@endsection
