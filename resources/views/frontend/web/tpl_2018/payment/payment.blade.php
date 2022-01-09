<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>微信支付</title>
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
    <link rel="stylesheet" href="/frontend/css/wechat-pay.css?v=20180927"/>
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
        <span class="order-pay"> 乐融沃-订单支付 </span>
        <span class="pay-price">
				<strong>1880</strong>
				元
			</span>
    </div>
    <div class="scan-pay">
        <div class="qrcode-area">
            <div class="qrcode-header">
                <p>扫一扫付款（元）</p>
                <p class="qrcode-header-money">1880</p>
            </div>

            <div class="qrcode-img-wrapper">
                <div class="qrcode-img-area">
                    <img src='http://qr.liantu.com/api.php?text=weixin://wxpay/bizpayurl?pr=vnSFDEs132' alt='扫码支付'>
                </div>
                <div class="qrcode-img-explain clearfix">
                    <img src="/frontend/images/wechat-scan.png" alt="扫一扫标识" />
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
            <img src="/frontend/images/wechat-scan1.jpg" class="qrguide-area-img active">
            <img src="/frontend/images/wechat-scan2.jpg" class="qrguide-area-img background">
        </div>
    </div>
</div>
</body>
<script src="/frontend/js/jquery-1.9.1.min.js?v=20180919"></script>
<script type="text/javascript">
    $().ready(function() {
        $(".qrguide-area").on("click", "img", function() {
            $(this).removeClass("active").addClass("background").siblings("img").removeClass("background").addClass("active");
        });
    });
</script>
<script type="text/javascript">
    setInterval("checkorder()",3000);
    function checkorder(){
        $.ajax({
            url: '/payment/check-is-pay',
            data: {
                order_sn: 'MP201810031228356202598'
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