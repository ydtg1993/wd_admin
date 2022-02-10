@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新分类</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.movie.category.edit',['id'=>$category->id])}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" value="{{ $category->name ?? old('name') }}" lay-verify="required" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">状态</label>
                    <div class="layui-input-inline">
                        <select name="status" lay-search  lay-filter="parent_id">
                            <option value="1" <?=$category->status==1?'selected':'' ?>>正常</option>
                            <option value="2" <?=$category->status==2?'selected':'' ?>>弃用</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">显示</label>
                    <div class="layui-input-inline">
                        <select name="show" lay-search  lay-filter="parent_id">
                            <option value="1" <?=$category->show==1?'selected':'' ?>>显示</option>
                            <option value="0" <?=$category->show==0?'selected':'' ?>>不显示</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">排序</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sort" value="{{ $category->sort ?? old('sort') }}" lay-verify="required" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.movie.category')}}" >返 回</a>
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
