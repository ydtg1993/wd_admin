@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新系列</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.movie.series.edit',['id'=>$series->id])}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" value="{{ $series->name ?? old('name') }}" lay-verify="required" placeholder="请输系列名称" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">状态</label>
                    <div class="layui-input-inline">
                        <select name="status" lay-search  lay-filter="parent_id">
                            <option value="1" <?=$series->status==1?'selected':'' ?>>正常</option>
                            <option value="2" <?=$series->status==2?'selected':'' ?>>弃用</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">分类</label>
                    <div class="layui-input-inline">
                        <select name="category" lay-search  lay-filter="parent_id">
                            <?php
                            foreach ($categories as $id=>$category){
                                if($series->cid == $id){
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
                    <label for="" class="layui-form-label">关联影片(换行分割)</label>
                    <div class="layui-input-block">
                        <textarea name="numbers" placeholder="请输入影片番号 换行分割" class="layui-textarea"><?php
                                foreach ($numbers as $number){
                                    echo $number."\r\n";
                                }?></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.movie.series')}}" >返 回</a>
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
