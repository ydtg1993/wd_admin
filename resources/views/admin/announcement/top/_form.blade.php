{{csrf_field()}}


<div class="layui-form-item">
    <label for="" class="layui-form-label">公告标题</label>
    <div class="layui-input-inline">
        <input type="text" name="title" value="{{ $announcement->title ?? '' }}" lay-verify="required" placeholder="请输入公告标题" class="layui-input" >
    </div>
</div>

<input type="hidden" name="type" value="1" >

<div class="layui-form-item">
    <label for="" class="layui-form-label">公告内容</label>
    <div class="layui-input-inline">
        <textarea name="content"  placeholder="请输入公告内容" class="layui-textarea">{{ $announcement->content ?? '' }}</textarea>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">查看方式</label>
<div class="layui-input-inline">
<select name="display_type" lay-verify="required" id="display_type">
            <option value="1" @if (isset($announcement)&&($announcement->display_type==1))  selected @endif>新窗口打开</option>
            <option value="2" @if (isset($announcement)&&($announcement->display_type==2))  selected @endif>内部页面打开</option>
    </select>
</div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">公告链接</label>
    <div class="layui-input-inline">
        <input type="text" name="url" value="{{ $announcement->url ?? '' }}" lay-verify="required" placeholder="请输入公告链接" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.content.index')}}" >返 回</a>
    </div>
</div>
