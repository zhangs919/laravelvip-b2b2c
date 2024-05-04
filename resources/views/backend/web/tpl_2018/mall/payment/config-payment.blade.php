{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form class="form-horizontal" action="/mall/payment/config-payment?pay_id={{ $info->pay_id }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" name="pay_id" value="{{ $info->pay_id }}">
            <input type="hidden" name="pay_code" value="{{ $info->pay_code }}">

            {{--引入支付方式表单元素--}}
            @include('mall.payment.partials.'.$info->pay_code)


            <!-- 确认提交 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交">

                        </div>

                        <div class="help-block help-block-t"></div>
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


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        $().ready(function() {
            $("body").on('click', '.file-attach-del', function() {
                $(this).parents('.file-attach-info').hide();
                var id = $(this).data("id");
                $("#" + id).val("");
            });

            $("body").on("change", ".upload-file", function() {
                var id = $(this).data('id');
                $("#show-" + id).html($(this).val().split("\\").pop());
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop