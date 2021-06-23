@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新公司</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.review.companies.update',['id'=>$company->id])}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" value="{{ $company->name ?? old('name') }}" lay-verify="required" placeholder="请输公司名称" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">分类</label>
                    <div class="layui-input-inline">
                        <select name="category" lay-search  lay-filter="parent_id">
                            <?php
                            foreach ($categories as $id=>$category){
                                if($company->category == $category){
                                    echo "<option value=$id selected>$category</option>";
                                    continue;
                                }
                                echo "<option value=$id >$category</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.review.companies')}}" >返 回</a>
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
