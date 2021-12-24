@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>批量上传</h2>
        </div>
        <div class="layui-card-body">
            <form id="uploadForm" class="layui-form" enctype="multipart/form-data" method="post">
                {{ method_field('put') }}
                {{csrf_field()}}

                <div class="layui-form-item">
                    <ul>
                        <?php
                        foreach ($batches as $batch){
                            echo "<li>任务:{$batch->id} 状态:处理中 上传时间:{$batch->created_at} 上传人:{$batch->admin_id}</li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">上传</label>
                    <div class="layui-input-inline">
                        <input type="file" name="list" id="#csv_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required />
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" id="import" class="layui-btn" >确 认</button>
                        <a  class="layui-btn" href="{{route('admin.movie.movie.commentList')}}" >返 回</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['element','form'],function () {

        });
        var importFile = {
            lock:false,
            init:function () {
                $("#import").click(importFile.apply)
            },
            apply:function () {
                if(importFile.lock == true){
                    alert('任务处理中。。。');
                }
                importFile.lock = true;
                var formData = new FormData($( "#uploadForm" )[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.movie.movie.addCommentList')}}",
                    data: formData,
                    success: function (res) {
                        importFile.lock = false;
                        if(res['code'] !== 0){
                            alert(res['msg']);
                            return
                        }
                        alert(res['msg']);
                        location.reload();
                    }
                });
            }
        };
    </script>
@endsection
