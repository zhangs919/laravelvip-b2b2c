{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="form-upload" class="form-horizontal" action="/goods/list/batch-set-pickup-timeout.html" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="8WbnogMU3TAaFv_OTOAwE5M94JAdu_f2Vkpk1AsBX3idNtbyYCGnUlR-lvsdlXFZxU-1yFnDqJAGfwyfb29qTw==">        <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">上传文件：</span>
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
                            <a class="btn-link" href="/goods/list/download.html?type=pickup_timeout">下载批量设置商品自提期限模板文件</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <div class="form-control-box">
                            <input type="button" class="btn btn-primary m-r-5" id="btn_submit" name="btn_submit" value="确认提交">
                            <input type="button" class="btn-link m-l-10" id="btn_download" name="btn_download" value="下载上传结果">
                            <input type="hidden" id="is_download" name="is_download">
                        </div>
                    </div>
                </div>
            </div>
        </form>    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html page元素同级下面--}}
@section('extra_html')

    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js?v=2.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            function validate()
            {
                var file_path=$("#filepath").html();
                var index1 = file_path.lastIndexOf(".");
                var index2 = file_path.length;
                var suffix = file_path.substring(index1 + 1, index2);
                if ($('#uploadmodel-file').val() == '') {
                    $.msg('请上传文件！');
                    return false;
                } else if (suffix != 'xls' && suffix != 'xlsx') {
                    $.msg('请上传excel格式文件！');
                    return false;
                }
                return true;
            }
            $("#btn_submit").click(function(){
                if (validate() == false) {
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
                    $.ajax({
                        url:'/goods/list/batch-set-pickup-timeout',
                        type:"POST",
                        data:new FormData($("#form-upload")[0]),
                        cache: false,//上传文件无需缓存
                        processData: false,//用于对data参数进行序列化处理 这里必须false
                        contentType: false, //必须
                        dataType: "JSON",
                        success:function(result)
                        {
                            $.loading.stop();
                            if(result.code==0){
                                $.progress({
                                    url:'/goods/list/batch-set-pickup-timeout-save',
                                    type: 'POST',
                                    key: 'seller-batch-set-pickup-timeout-key',
                                    end: function(result) {
                                        if (result.code == 0) {
                                            $.msg(result.message, {
                                                time: 2000
                                            }, function(){
                                                location.reload();
                                            });
                                        } else {
                                            $.msg(result.message, {
                                                time: 5000
                                            });
                                        }
                                    }
                                });
                            }else{
                                $.msg(result.message,{
                                    time: 5000
                                });
                            }
                        }
                    })
                }, function() {
                    $("#btn_download").click();
                });
            });
            $("#btn_download").click(function() {
                if(validate() == false) {
                    return false;
                }
                $("#is_download").val(1);
                $("#form-upload").submit();
            });
            $("body").on("change", "#uploadmodel-file", function() {
                $("#filepath").html($("#uploadmodel-file").val().split("\\").pop());
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop