@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新标签</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.movie.label.update',['id'=>$label->id])}}" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" value="{{ $label->name ?? old('name') }}" lay-verify="required" placeholder="请输公司名称" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">层级</label>
                    <div class="layui-input-inline">
                        <select name="cid" >
                            <option value="0" <?=$label->cid==0?'selected':'' ?>>顶级标签</option>
                            <?php
                            foreach ($parent_labels as $parent_label){
                                $selected =  '';
                                if($parent_label->id == $label->cid){
                                    $selected = 'selected';
                                }
                                echo "<option value={$parent_label->id} {$selected}>$parent_label->name</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="" class="layui-form-label">状态</label>
                    <div class="layui-input-inline">
                        <select name="status" >
                            <option value="1" <?=$label->status==1?'selected':'' ?>>正常</option>
                            <option value="2" <?=$label->status==2?'selected':'' ?>>弃用</option>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.movie.label')}}" >返 回</a>
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
