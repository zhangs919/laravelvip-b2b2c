{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/revision-styles.css?v=20180428"/>
    <script src="/assets/d2eace91/js/jquery.superslide.2.1.1.js?v=20180528"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="content-panel w800" style="margin: 50px auto;">

        <div class="scan-box backend">
            <div class="scan-icon">
                <i></i>
            </div>
            <div class="scan-input-box">
                <input id="scan-input" class="scan-input" type="text" placeholder="扫描订单二维码核销" />
                <i class="scan-delete">×</i>
                <a href="javascript:void(0)" class="scan-search-btn">搜索</a>
            </div>
        </div>
        <div class="SZY-ORDER-INFO" style="display: none"></div>
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
    <script type="text/javascript">

        window.onload = function() {
            $("#scan-input").focus();
        }


        $().ready(function() {
            $('.scan-search-btn').click(function() {
                $('body').find('.SZY-ORDER-INFO').show();
                $('body').find('.SZY-FREEBUY-AD').html('');
                $('body').find('.SZY-ORDER-INFO').html('查询中...');
                $.loading.start();
                var order_sn = $.trim($('#scan-input').val());
                $.get('/dashboard/integral-mall/get-order', {
                    order_sn: order_sn
                }, function(result) {
                    $('body').find('.SZY-ORDER-INFO').html(result.data);
                    $.loading.stop();
                }, 'json')
            });

            $('.scan-delete').click(function() {
                $(this).prev().val('');
            });

            $("#scan-input").on('input', function(e) {
                if ($(this).val().length == 20) {
                    $('.scan-search-btn').click();
                } else if ($(this).val().length > 20) {
                    var value = e.target.value.substr(20, e.target.value.length)
                    $(this).val(value);
                    if ($(this).val().length == 20) {
                        $('.scan-search-btn').click();
                    }
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop