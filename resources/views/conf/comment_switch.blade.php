@extends('admin.base')

@section('content')


    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>评论开关</h2>
        </div>
        <div class="layui-card-body">
            <input type="radio" id="on" name="switch" value="1" <?=($on==1)?'checked':'' ?>>
            <label for="on">开启</label><br>
            <input type="radio" id="off" name="switch" value="0" <?=($on==0)?'checked':'' ?>>
            <label for="off">关闭</label><br>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['element','form'],function () {

        })
        $('input[name=switch]').click(function () {
            var on = $(this).val();
            $.ajax({
                url: "{{ route('admin.conf.commentSwitch') }}",
                type:'POST',
                data:{on:on},
                success:function () {
                    alert('成功');
                }
            })
        })
    </script>

@endsection
