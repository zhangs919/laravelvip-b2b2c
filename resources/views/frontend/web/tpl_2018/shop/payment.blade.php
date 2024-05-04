<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/css/wechat-pay.css?v=20180927"/>
</head>
<body>
<div class="header">
    <div class="header-title w990">
        <div class="alipay-logo"></div>
        <span class="logo-title">我的收银台</span>
    </div>
</div>
<div class="content w990">
    <div class="order clearfix">
        <div class="orderDetail-base">
            <span class="order-pay"> {{ $subject }} </span>
            <span class="pay-price">
					<strong>{{ $total_fee }}</strong>
					元
				</span>
        </div>
        <a class="order-ext-trigger">订单详情</a>
        <div class="order-detail-container hide">
            <table>
                <tbody><tr>
                    <td class="sub-th">订单号：</td>
                    <td>{{ $order_sn }}</td>
                </tr>
                <tr>
                    <td class="sub-th">交易金额：</td>
                    <td>￥{{ $order_info['order_amount'] }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="scan-pay">
        <div class="qrcode-area">
            <div class="qrcode-header">
                <p>扫一扫付款（元）</p>
                <p class="qrcode-header-money">{{ $total_fee }}</p>
            </div>

            <div class="qrcode-img-wrapper">
                <div class="qrcode-img-area">
                    {!! $pay_info !!}
                </div>
                <div class="qrcode-img-explain clearfix">
                    <img src="/images/wechat-scan.png" alt="扫一扫标识" />
                    <div>
                        打开手机微信
                        <br>扫一扫继续付款
                    </div>
                </div>
            </div>

            <div class="qrcode-foot">
                <a href="" class="qrcode-downloadApp" target="_blank">首次使用请下载手机微信</a>
            </div>
        </div>
        <div class="qrguide-area">
            <img src="/images/wechat-scan1.jpg" class="qrguide-area-img active">
            <img src="/images/wechat-scan2.jpg" class="qrguide-area-img background">
        </div>
    </div>
</div>
</body>
<script src="/js/jquery-1.9.1.min.js?v=20180919"></script>
<script type="text/javascript">
    $().ready(function() {
        $(".qrguide-area").on("click", "img", function() {
            $(this).removeClass("active").addClass("background").siblings("img").removeClass("background").addClass("active");
        });

        $('.order-ext-trigger').click(function() {
            if ($(this).hasClass('fn-more')) {
                $(this).removeClass('fn-more');
                $('.order-detail-container').addClass('hide');
            } else {
                $(this).addClass('fn-more');
                $(".order-detail-container").removeClass('hide');
            }
        });
    });
</script>
<script type="text/javascript">
    setInterval("checkorder()",3000);
    function checkorder(){
        $.ajax({
            url: '/shop/apply/check-is-pay',
            data: {
                order_sn: '{{ $order_sn }}'
            },
            type : 'GET',
            dataType : 'json',
            success : function (result) {
                if (result.code == 0) {
                    location.href = result.url;
                }
            }
        })
    }
</script>
</html>