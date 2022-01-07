@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加标签</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.movie.label.min.create')}}" method="post">
                {{ method_field('post') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" placeholder="请输标签名称" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">排序号</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort" lay-verify="required" placeholder="排序" class="layui-input" value="0">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">层级</label>
                    <div class="layui-input-inline">
                        <select name="cid" lay-search>
                            <option value="0" >父级标签</option>
                            <?php
                            foreach ($parent_labels as $parent_label){
                                echo "<option value={$parent_label->id} >$parent_label->name</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.movie.label.min')}}" >返 回</a>
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
