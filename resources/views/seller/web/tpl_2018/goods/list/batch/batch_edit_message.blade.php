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
        <form method="post" action="" id="form" class="form-horizontal" enctype="multipart/form-data">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">上传批量更新文件：</span>
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
                            <a class="btn-link" href="/goods/list/download.html?type=edit_message">下载上传批量更新文件模板</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 商品库存是否更新 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-status" class="col-sm-4 control-label">
                        <span class="ng-binding">商品库存是否更新：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="update_goods_count" value="0">
                                    <label>
                                        <input type="checkbox" id="" class="form-control b-n" name="update_goods_count" value="1" checked data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 商品分类是否更新 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-status" class="col-sm-4 control-label">
                        <span class="ng-binding">商品分类是否更新：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="update_goods_cat" value="0">
                                    <label>
                                        <input type="checkbox" id="" class="form-control b-n" name="update_goods_cat" value="1" checked data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">如果同一个商品多个规格，不同规格条形码不同，上传文件中，每个规格的商品分类都不相同，那么商品分类是否自动更新设置项即使设置是，也将不起作用</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 是否更新商品名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="usermodel-status" class="col-sm-4 control-label">
                        <span class="ng-binding">商品名称是否更新：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="update_goods_name" value="0">
                                    <label>
                                        <input type="checkbox" id="" class="form-control b-n" name="update_goods_name" value="1" checked data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">如果同一个商品多个规格，不同规格条形码不同，上传文件中，每个规格的商品名称都不相同，那么商品名称是否自动更新设置项即使设置是，也将不起作用</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <div class="form-control-box">
                            <button name="btn_submit" id="btn_submit" class="btn btn-primary m-r-5">预览</button>
                            <!-- <button name="btn_download" id="btn_download" class="btn-link m-l-10">下载预览结果</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
            $("#btn_submit").click(function() {
                if (validate() == false) {
                    return false;
                }
                //加载提示
                $.loading.start();
                $("#form").submit();
            });
            /* $("#btn_download").click(function() {
                $(this).val("1");
                $("#form").submit();
            }); */
            $("body").on("change", "#uploadfile", function() {
                $("#filepath").html($("#uploadfile").val().split("\\").pop());
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop