{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/revision-styles.css" rel="stylesheet">

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="content-panel w800" style="margin: 50px auto;">
        <div class="scan-box">
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
        <!-- <div class="banner-panel SZY-FREEBUY-AD" style="height: auto;"></div>
        <a href="javascript:void(0)" class="btn btn-warning btn-sm screen-btn launch-full-screen">
            <i class="fa fa-expand"></i>
            全屏
        </a>
        <a href="javascript:void(0)" class="btn btn-danger btn-sm screen-btn exit-full-screen hide">
            <i class="fa fa-compress"></i>
            退出
        </a> -->
    </div>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html page元素同级下面--}}
@section('extra_html')
    <script type="text" id="freebuy_ad_html">
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
    <script src="/assets/d2eace91/js/jquery.superslide.2.1.1.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        /*banner轮播*/
        /* $(".banner-panel").slide({
            titCell: ".num ul",
            mainCell: ".banner-box",
            effect: "fold",
            autoPlay: true,
            delayTime: 700,
            autoPage: true
        }); */
        window.onload = function() {
            $("#scan-input").focus();
        }
        // $('body').find('.SZY-FREEBUY-AD').html($('#freebuy_ad_html').html());
        $().ready(function() {
            $('.scan-search-btn').click(function() {
                $('body').find('.SZY-ORDER-INFO').show();
                // $('body').find('.SZY-FREEBUY-AD').html('');
                $('body').find('.SZY-ORDER-INFO').html('<span>查询中...</span>');
                var order_sn = $.trim($('#scan-input').val());
                $.get('/trade/order/get-order', {
                    order_sn: order_sn
                }, function(result) {
                    $('body').find('.SZY-ORDER-INFO').html(result.data);
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
            $('.launch-full-screen').click(function() {
                launchFullscreen(document.getElementById("revisionView"));
            });
            $('.exit-full-screen').click(function() {
                exitFullscreen();
            });
        });
        document.addEventListener("fullscreenchange", function(e) {
            if (!isFullscreenEnabled()) {
                exitFullscreen();
            }
        });
        document.addEventListener("mozfullscreenchange", function(e) {
            if (!isFullscreenEnabled()) {
                exitFullscreen();
            }
        });
        document.addEventListener("webkitfullscreenchange", function(e) {
            if (!isFullscreenEnabled()) {
                exitFullscreen();
            }
        });
        document.addEventListener("msfullscreenchange", function(e) {
            if (!isFullscreenEnabled()) {
                exitFullscreen();
            }
        });
        function isFullscreenEnabled() {
            if (document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement) {
                return true;
            } else {
                return false;
            }
        }
        //启用全屏
        function launchFullscreen(element) {
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
            $('.launch-full-screen').addClass('hide');
            $('.exit-full-screen').removeClass('hide');
            $('.item-title').find('.tab-base li').addClass('hide');
            $('.content-panel').addClass('w1100').removeClass('w800');
            $('#revisionView').css('overflow-y', 'scroll');
        }
        //退出全屏
        function exitFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
            $('.launch-full-screen').removeClass('hide');
            $('.exit-full-screen').addClass('hide');
            $('.item-title').find('.tab-base li').removeClass('hide');
            $('.content-panel').addClass('w800').removeClass('w1100');
            $('#revisionView').css('overflow-y', '');
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop