{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form method="post" action="" id="form" class="form-horizontal">
            @csrf
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">扫码枪导入数据：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <textarea class="form-control w600" placeholder="" id="barcodes" name="barcodes" type="text" rows="10"></textarea>
                        </div>
                        <div class="help-block help-block-t">
                            请点击输入框，确保光标在框内，再扫描！手动输入条码，多个条码请用回车来分隔！
                            <br>
                            建议一次导入30条商品记录
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <button name="btn_submit" id="btn_submit" class="btn btn-primary">预览</button>
                        <button name="btn_download" id="btn_download" class="btn-link m-l-10">下载预览结果</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        $().ready(function() {
            $("#btn_submit").click(function() {
                var barcodes = $("#barcodes").val().trim();
                if (barcodes == '') {
                    $.msg("没有扫码数据")
                    return false;
                }
                //加载提示
                $.loading.start();

                $("#form").submit();
            });

            $("#btn_download").click(function() {
                var barcodes = $("#barcodes").val().trim();
                if (barcodes == '') {
                    $.msg("没有扫码数据")
                    return false;
                }
                $(this).val("1");
                $("#form").submit();
            });

            $("#barcodes").focus();
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop