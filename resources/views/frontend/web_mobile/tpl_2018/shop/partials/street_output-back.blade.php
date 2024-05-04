
<form id="searchForm">
    <input type='hidden' name='name' value=''>
    <input type='hidden' name='lat' value=''>
    <input type='hidden' name='lng' value=''>
    <input type='hidden' name='distance' value=''>
    <input type='hidden' name='sort' value='distance-asc'>
    <input type='hidden' name='cls_id' value=''>
</form>

{{--引入店铺列表--}}
@include('shop.partials.street_shop_list')

<!-- more.js -->
<script src="/assets/d2eace91/js/szy.page.more.js?v=20180813"></script>
<script type="text/javascript">
    $().ready(function() {
        tablelist = $("#table_list").tablelist({
            params: $("#searchForm").serializeJson()
        });
    });
</script>

<script type="text/javascript">
    // 滚动加载数据
    $(window).on('scroll', function() {
        if (($(document).scrollTop() + $(window).height() + 2000) > $(document).height()) {
            $.pagemore({
                callback: function(result) {
                    is_opening($('#shop_ids').val());
                }
            });
        }
    });
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    //一键导航
    var mapclicked = false;
    $('body').on('click', '.SZY-MAP-NAV', function() {
        var shoplat = $(this).data('lat');
        var shoplng = $(this).data('lng');
        var title = $(this).data('title');
        var content = $(this).data('content');
        if (mapclicked == true) {
            return;
        }
        mapclicked = true;
        if (isWeiXin()) {
            $.loading.start();
            var url = location.href.split('#')[0];
            $.ajax({
                url: "/index/information/get-weixinconfig.html",
                data: {
                    url: url
                },
                dataType: 'json',
                success: function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        wx.config({
                            debug: false,
                            appId: result.data.appId,
                            timestamp: result.data.timestamp,
                            nonceStr: result.data.nonceStr,
                            signature: result.data.signature,
                            jsApiList: [
// 所有要调用的 API 都要加到这个列表中
                                'openLocation', 'getLocation']
                        });
                        wx.openLocation({
                            latitude: shoplat, // 纬度，浮点数，范围为90 ~ -90
                            longitude: shoplng, // 经度，浮点数，范围为180 ~ -180。
                            name: title, // 位置名
                            address: content, // 地址详情说明
                            scale: 15, // 地图缩放级别,整形值,范围从1~28。默认为最大
                            infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
                        });
                    } else {
                        if (window.__wxjs_environment === 'miniprogram') {
                            $.msg("导航功能需要去后台微信设置里填写正确的信息");
                        } else {
                            var url = '/index/information/amap?start=102.75567,25.06147&dest=' + shoplng + ',' + shoplat + '&title=' + title;
                            window.location.href = url;
                        }
                    }
                }
            });
        } else {
            var url = '/index/information/amap?start=102.75567,25.06147&dest=' + shoplng + ',' + shoplat + '&title=' + title;
            window.location.href = url;
        }
        setTimeout(function() {
            mapclicked = false;
        }, 1000);
    });
</script>