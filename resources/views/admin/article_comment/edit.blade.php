@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>编辑话题评论</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.article.commentEdit',['id'=>$comment->id])}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">话题ID</label>
                    <div class="layui-input-inline">
                        <input type="text" name="aid" value="{{ $comment->aid }}" lay-verify="required" placeholder="请输话题ID" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">用户名</label>
                    <div class="layui-input-inline">
                        <input name="nickname" value="{{ $comment->nickname }}" lay-verify="required" placeholder="请输入用昵称" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">内容</label>
                    <div class="layui-input-inline">
                        <textarea name="comment" placeholder="请输入内容" class="layui-textarea">{{$comment->comment}}</textarea>
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

        })
    </script>
@endsection
