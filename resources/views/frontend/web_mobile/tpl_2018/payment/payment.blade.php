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
</head>
<body>
</body>
<script src="/js/jquery-1.9.1.min.js?v=20180919"></script>

<script>
    callpay();
    
    //调用微信JS api 支付
    function jsApiCall()
    {

        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            {!! $payResult !!},
            function(res){
                WeixinJSBridge.log(res.err_msg);
                alert(res.err_code+res.err_desc+res.err_msg);
                // 支付失败 返回结果页
                window.location.href = "//{{ config('lrw.mobile_domain') }}/checkout/result.html?order_sn={{ $order_sn ?? '' }}"
            }
        );
    }

    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }
</script>

<script type="text/javascript">
    setInterval("checkorder()",3000);
    function checkorder(){
        $.ajax({
            url: '/payment/check-is-pay',
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