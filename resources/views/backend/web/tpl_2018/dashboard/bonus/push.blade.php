<div class="popover-tab-box p-20" style="margin-top: -10px;">
    <ul class="pop-tab-item">
        <li class="selected" data-type='0'>
            <a>微商城</a>
        </li>

    </ul>
    <div class="pop-tab-content">
        <div class="pop-tab-pane selected">
            <div class="input-button-box m-b-10">
                <input class="p-input" value="http://{{ config('lrw.mobile_domain') }}/bonus-{{ $bonus_id }}" type="text">
                <a class="input-button" data-clipboard-text="http://{{ config('lrw.mobile_domain') }}/bonus-{{ $bonus_id }}">复制</a>
            </div>
            <div class="qr-code-border qr-code-bg">
                <p class="shop-name">{{ $bonus_info->shop_name }}</p>
                <p class="bonus-info">送你一个{{ $bonus_info->bonus_amount }}元红包</p>
                <div class="bonus-img qrcode">
                    <img src="/assets/d2eace91/images/common/loading_90_90.gif" />
                </div>
                <div class="bonus-ft">
                    <p>长按扫描进入</p>
                </div>
            </div>
            <a class="c-blue pull-left" href="/dashboard/bonus/download-qcode?bonus_id={{ $bonus_id }}">下载二维码</a>
            <a class="c-blue pull-right" href="/dashboard/bonus/download-push-picture?bonus_id={{ $bonus_id }}">下载推广图</a>
        </div>
        <div class="pop-tab-pane">
            <div class="input-button-box m-b-10">
                <input value="http://{{ config('lrw.mobile_domain') }}/bonus-{{ $bonus_id }}" type="text">
                <a class="input-button" data-clipboard-text="http://{{ config('lrw.mobile_domain') }}/bonus-{{ $bonus_id }}">复制</a>
            </div>
            <div class="qr-code-border qr-code-bg">
                <p class="shop-name">{{ $bonus_info->shop_name }}</p>
                <p class="bonus-info">送你一个{{ $bonus_info->bonus_amount }}元红包</p>
                <div class="bonus-img miniprogram">
                    <img src="/assets/d2eace91/images/common/loading_90_90.gif" />
                </div>
                <div class="bonus-ft">
                    <p>长按扫描进入</p>
                </div>
            </div>
            <a class="c-blue pull-left" href="/dashboard/bonus/download-qcode?bonus_id={{ $bonus_id }}&type=1">下载小程序码</a>
            <a class="c-blue pull-right" href="/dashboard/bonus/download-push-picture?bonus_id={{ $bonus_id }}&type=1">下载推广图</a>
        </div>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    $().ready(function() {
        $('.pop-tab-item li').click(function(){
            $(this).addClass('selected').siblings().removeClass('selected');
            $('.pop-tab-pane').eq($(this).index()).addClass('selected').siblings().removeClass('selected');
        })
        var html = '<image src="qrcode?bonus_id={{ $bonus_id }}" width=200>';
        $('.qrcode').html(html);
        var show_weixin_programs = '0';
        if (show_weixin_programs==1)
        {
            var html = '<image src="miniprogram?bonus_id={{ $bonus_id }}" width=200>';
            $('.miniprogram').html(html);
        }
        var clipboard = new Clipboard('.input-button');
        clipboard.on('success', function(e) {
            console.log(e);
            $.msg("复制成功！")
        });
        clipboard.on('error', function(e) {
            console.log(e);
            $.msg("复制失败！请手动复制")
        });
    })
</script>