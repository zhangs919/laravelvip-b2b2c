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
        <form id="UploadModel" class="form-horizontal" name="UploadModel" action="/goods/list/batch-add" method="post" enctype="multipart/form-data">
            @csrf
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">上传商品文件：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div class="file-attach-1">
                                <div class="file-attach-2">
                                    <i class="fa fa-upload"></i>
                                    上传附件
                                </div>
                                <input type="file" name="uploadfile" id="uploadfile" class="inputstyle">
                            </div>
                        </div>
                        <span id="filepath" class="c-blue m-l-20 l-h-36"></span>
                        <div class="help-block help-block-t">
                            <a class="btn-link" href="/goods/list/download.html?type=add">下载上传商品文件模板</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 运费模板 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="uploadmodel-freight_id" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">运费设置：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <select id="uploadmodel-freight_id" class="form-control m-r-5 freight-list" name="UploadModel[freight_id]">
                                <option value="0">店铺统一运费（￥0.00）</option>
                                <option value="2651">全国</option>
                                <option value="2655">111</option>
                                <option value="2657">2222</option>
                            </select>
                            <div class="btn-group m-r-2">
                                <button type="button" data-toggle="dropdown" aria-expanded="true" class="btn btn-warning btn-sm dropdown-toggle">
                                    新建运费模板
                                    <span class="caret m-l-5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/shop/freight/add" target="_blank">新建全国模板</a>
                                    </li>
                                    <li>
                                        <a href="/shop/freight/map-add" target="_blank">新建同城模板</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm refresh-freight-list">重新加载</a>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>        <div class="simple-form-field p-b-30">
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
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "uploadmodel-data_type", "name": "UploadModel[data_type]", "attribute": "data_type", "rules": {"required":true,"messages":{"required":"数据格式不能为空。"}}},{"id": "uploadmodel-category", "name": "UploadModel[category]", "attribute": "category", "rules": {"required":true,"messages":{"required":"所属分类不能为空。"}}},{"id": "uploadmodel-freight_id", "name": "UploadModel[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"运费设置不能为空。"}}},{"id": "uploadmodel-charset", "name": "UploadModel[charset]", "attribute": "charset", "rules": {"required":true,"messages":{"required":"文件编码不能为空。"}}},{"id": "uploadmodel-file", "name": "UploadModel[file]", "attribute": "file", "rules": {"required":true,"messages":{"required":"上传批量csv文件不能为空。"}}},]
</script>
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
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            function validate() {
                var filepath = $("#filepath").html();
                var index1 = filepath.lastIndexOf(".");
                var index2 = filepath.length;
                var suffix = filepath.substring(index1 + 1, index2);
                if ($('#uploadfile').val() == '') {
                    $.msg('请上传更新文件！');
                    return false;
                } else if (suffix != 'xls' && suffix != 'xlsx') {
                    $.msg('请上传excel格式文件！');
                    return false;
                }
                return true;
            }
            var validator = $("#UploadModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
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
                    $("#UploadModel").submit();
                }, function() {
                    $("#btn_download").click();
                });
            });
            $("#btn_download").click(function() {
                if (!validator.form()) {
                    return;
                }
                if (validate() == false) {
                    return false;
                }
                $("#is_download").val(1);
                $("#UploadModel").submit();
            });
            $("body").on("change", "#uploadfile", function() {
                $("#filepath").html($("#uploadfile").val().split("\\").pop());
            });
            // 刷新运费模板
            $(".refresh-freight-list").click(function() {
                $.loading.start();
                $.get('/goods/publish/freights.html', {}, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        var html = "<option value='0'>店铺统一运费（" + result.shop_freight_fee_format + "）</option>";
                        for (var i = 0; i < result.data.length; i++) {
                            var item = result.data[i];
                            html += "<option value='"+item.freight_id+"'>" + item.title + "</option>";
                        }
                        $("#uploadmodel-freight_id").html(html);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop