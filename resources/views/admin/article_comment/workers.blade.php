@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>人员列表</h2>
        </div>
        <div class="layui-card-body">
            <form id="uploadForm" class="layui-form" action="{{route('admin.article.commentWorkers')}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">账户(空行分割)</label>
                    <div class="layui-input-inline">
                        <textarea name="workers" placeholder="请输入内容" class="layui-textarea"><?=$workers ?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.article.commentList')}}" >返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['element','form'],function () {

        });
    </script>
@endsection
