@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加话题评论</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.article.addComment')}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">话题ID</label>
                    <div class="layui-input-inline">
                        <input type="text" name="aid" lay-verify="required" placeholder="请输入话题ID" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">用户名</label>
                    <div class="layui-input-inline">
                        <select name="uid" lay-search  lay-filter="parent_id">
                            <?php
                            foreach ($workers as $id=>$worker){
                                echo "<option value='{$id}' >$worker</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">内容</label>
                    <div class="layui-input-inline">
                        <textarea name="comment" placeholder="请输入内容" class="layui-textarea"></textarea>
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
