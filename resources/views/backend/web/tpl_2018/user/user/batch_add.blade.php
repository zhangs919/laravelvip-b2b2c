{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30">
        <form id="form" class="form-horizontal" action="/user/user/batch-add" method="post" enctype="multipart/form-data">
            @csrf

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">初始密码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input class="form-control ipt m-r-5" id="password" name="password" value="" type="text" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">上传会员文件：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div class="file-attach-1">
                                <div class="file-attach-2">
                                    <i class="fa fa-upload"></i>
                                    上传附件
                                </div>
                                <input type="file" name="uploadfile" id="uploadmodel-file" class="inputstyle">
                            </div>
                        </div>
                        <span id="filepath" class="c-blue m-l-20 l-h-36"></span>
                        <div class="help-block help-block-t">
                            <a class="btn-link" href="/user/user/download" target="_blank">下载上传会员文件模板</a>
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary">
                        <input type="button" class="btn-link m-l-10" id="btn_download" name="btn_download" value="下载上传结果">
                        <input type="hidden" id="is_download" name="is_download">
                    </div>
                </div>
            </div>
        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    </script>
    <script type="text/javascript">
        $().ready(function() {

            function validate() {
                var password = $('#password').val();
                var filepath = $("#filepath").html();
                var index1 = filepath.lastIndexOf(".");
                var index2 = filepath.length;
                var suffix = filepath.substring(index1 + 1,index2);

                if (password == '' || password == null) {
                    $.msg('请填写初始密码！');
                    return false;
                } else if (password.length < 6 || password.length > 20) {
                    $.msg('密码长度为6-20个字符，建议由字母、数字和符号两种以上。');
                    return false;
                } else if ((/[\u4e00-\u9fa5]+/).test(password)) {
                    $.msg('密码中不能包含汉字。');
                    return false;
                } else if ($('#uploadmodel-file').val() == '') {
                    $.msg('请上传会员文件！');
                    return false;
                }else if (suffix != 'xls' && suffix != 'xlsx') {
                    $.msg('请上传excel格式文件！');
                    return false;
                }

                return true;
            }
            $("#btn_submit").click(function() {
                if(validate() == false) {
                    return false;
                }
                //询问框
                layer.confirm('为了避免您上传的文件包含错误数据，请先下载预览结果，根据提示信息修改上传文件；如果您的文件准确无误，请直接提交。', {
                    btn: ['我要提交', '我要下载预览结果']
                    //按钮
                }, function() {
                    // 加载提示
                    $.loading.start();
                    $("#is_download").val(0);
                    $("#form").submit();
                }, function() {
                    $("#btn_download").click();
                });

            });

            $("#btn_download").click(function() {
                if(validate() == false) {
                    return false;
                }
                $("#is_download").val(1);
                $("#form").submit();
            });

            $("body").on("change", "#uploadmodel-file", function() {
                $("#uploadmodel-file-error").hide();
                $("#filepath").html($("#uploadmodel-file").val().split("\\").pop());
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop