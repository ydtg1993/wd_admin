@extends('admin.base')
<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
<link href="/bootfile/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@include('admin.movie_actor._upload')
@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加公司</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.movie.actor.store')}}" method="post" enctype="multipart/form-data">
                {{ method_field('post') }}
                {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="required" placeholder="请输演员名称" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">状态</label>
                    <div class="layui-input-inline">
                        <select name="status" lay-search  lay-filter="parent_id">
                            <option value="1">正常</option>
                            <option value="2">弃用</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">性别</label>
                    <div class="layui-input-inline">
                        <select name="sex" lay-search  lay-filter="parent_id">
                            <option value="♀">女</option>
                            <option value="♂">男</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="" class="layui-form-label">分类</label>
                    <div class="layui-input-inline">
                        <select name="category" lay-search  lay-filter="parent_id">
                            <?php
                            foreach ($categories as $id=>$category){
                                echo "<option value=$id >$category</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <blockquote class="layui-elem-quote" style="margin-top: 30px;margin-bottom: 0">社交账户</blockquote>
                <table class="layui-table" lay-even="" lay-skin="row">
                    <thead>
                        <tr>
                          <th>渠道</th>
                          <th>地址</th>
                          <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="social_accounts_content">
                    <tbody>
                    <tr>
                        <td colspan="3">
                            <button id="add_account" type="button" class="layui-btn">新增</button>
                        </td>
                    </tr>
                </table>

                <div class="layui-col-md4">
                    <label class="control-label">头像</label>
                    <div class="file-loading">
                        <input id="photo" name="photo" type="file">
                    </div>
                </div>
                <hr/>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                        <a  class="layui-btn" href="{{route('admin.movie.actor')}}" >返 回</a>
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
        var accounts = {
            delApply: function () {
                $('#social_accounts_content').on('click','.delete_account',function(){
                    var r = confirm("确定删除？");
                    if (r != true) {
                        return;
                    }
                    $(this).parent().parent().remove();
                    accounts.rearrange();
                });
            },
            insert: function () {
                $('#add_account').click(function () {
                    $('#social_accounts_content').append("<tr class=accounts_content data-key=>\n" +
                        "<td>\n" +
                        "<input name=account_name[] value='' class=layui-input>\n" +
                        "</td>\n" +
                        "<td>\n" +
                        "<input name=account_url[] value='' class=layui-input \n" +
                        "</td>\n" +
                        "<td><button type=button class='layui-btn layui-btn-normal layui-btn-sm delete_account'><i class=layui-icon></i></button></td>\n" +
                        "</tr>");
                    accounts.rearrange();
                });
                return this;
            },
            rearrange: function () {
                document.querySelectorAll('.accounts_content').forEach(function (element, index, array) {
                    element.setAttribute('data-key', index + '');
                });
            }
        };
        accounts.insert().delApply();
        addFileInput('photo',true);
    </script>
@endsection
