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
        <form id="form" class="form-horizontal" action="/user/user/user-batch-upload" method="post" enctype="multipart/form-data">
            @csrf

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label"><span class="text-danger ng-binding">*</span><span class="ng-binding">初始密码：</span></label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input class="form-control ipt m-r-5" id="password" name="password" value="" type="text"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">数据文件：</span>
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
            $("#btn_submit").click(function() {
                if($('#password').val() == '' || $('#password').val() == null){
                    $.alert('请填写初始密码！');
                    return false;
                }
                //加载提示
                $.loading.start();
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