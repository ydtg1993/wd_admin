{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">ID</label>
    <div class="layui-input-inline">
        <input type="text" name="name" value="{{ $tag->name ?? old('name') }}" lay-verify="required" placeholder="请输入名称" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">反馈主题</label>
    <div class="layui-input-inline">
        <input type="number" name="sort" value="{{ $tag->sort ?? 10 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">反馈标题</label>
    <div class="layui-input-inline">
        <input type="number" name="sort" value="{{ $tag->sort ?? 10 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">具体描述</label>
    <div class="layui-input-inline">
        <input type="number" name="sort" value="{{ $tag->sort ?? 10 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">创建时间</label>
    <div class="layui-input-inline">
        <input type="number" name="sort" value="{{ $tag->sort ?? 10 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">登录设备</label>
    <div class="layui-input-inline">
        <input type="number" name="sort" value="{{ $tag->sort ?? 10 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">联系方式</label>
    <div class="layui-input-inline">
        <input type="number" name="sort" value="{{ $tag->sort ?? 10 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">备注</label>
    <div class="layui-input-inline">
        <input type="number" name="sort" value="{{ $tag->sort ?? 10 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>
{{--<div class="layui-form-item">--}}
{{--    <div class="layui-input-block">--}}
{{--        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>--}}
{{--        <a  class="layui-btn" href="{{route('admin.tag')}}" >返 回</a>--}}
{{--    </div>--}}
{{--</div>--}}
