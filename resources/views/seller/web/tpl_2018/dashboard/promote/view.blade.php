<div class="popover-tab-box p-20" style="margin-top: -10px;">
    <ul class="pop-tab-item">
        <li data-type="0" class="tablink" id="defaultOpen">
            <a>微商城</a>
        </li>
        <li data-type="1" class="tablink">
            <a>小程序</a>
        </li>
    </ul>
    <div class="pop-tab-content">
        <div class="pop-tab-pane">
            <p class="m-b-10"></p>
            <div class="input-button-box m-b-10">
                <input class="p-input" value="{{ $push_url }}" type="text">
                <a class="input-button" data-clipboard-text="{{ $push_url }}">复制</a>
            </div>
            <div class="m-b-10" style="border:1px solid #ddd">
                <div class="qr-code-border qr-code-bg">
                    <div class="bonus-img qrcode qrcode-promote">
                        <img src="/assets/d2eace91/images/common/loading_90_90.gif" width="200">
                    </div>
                    <div class="bonus-ft">
                        <p>长按扫码进入</p>
                    </div>
                </div>
            </div>
            <a class="c-blue pull-left" href="/dashboard/promote/download-qcode?url={{ $url }}">下载二维码</a>
            <!-- <a class="c-blue pull-right" href="/dashboard/promote/download-push-picture?url={{ $url }}">下载推广图</a> -->
        </div>
        <div class="pop-tab-pane">
            <p class="m-b-10"></p>
            <div class="input-button-box m-b-10">
                <input class="p-input" value="{{ $push_url }}" type="text">
                <a class="input-button" data-clipboard-text="{{ $push_url }}">复制</a>
            </div>
            <div class="m-b-10" style="border:1px solid #ddd">
                <div class="qr-code-border qr-code-bg">
                    <div class="bonus-img miniprogram">
                        <img src="/assets/d2eace91/images/common/loading_90_90.gif" width="200">
                    </div>
                    <div class="bonus-ft">
                        <p>长按扫码进入</p>
                    </div>
                </div>
            </div>
            <a class="c-blue pull-left" href="/dashboard/promote/download-qcode?url={{ $url }}&type=1">下载小程序码</a>
            <!-- <a class="c-blue pull-right" href="/dashboard/promote/download-push-picture?url={{ $url }}&type=1">下载推广图</a> -->
        </div>
    </div>
</div>
<script type="text/javascript">
    //
</script>
<script type="text/javascript">
    //
</script><script src="/assets/d2eace91/js/clipboard.min.js?v=20200924"></script>
<script>

    $().ready(function() {
        $('.pop-tab-item li').click(function() {
            $(this).addClass('selected').siblings().removeClass('selected');
            $('.pop-tab-pane').eq($(this).index()).addClass('selected').siblings().removeClass('selected');
        })

        var html = '<image src="/dashboard/promote/qrcode?push_url={{ $push_url }}" width=200>';
        $('.qrcode-promote').html(html);
        var show_weixin_programs = "1";
        if (show_weixin_programs == 1) {
            var html = '<image src="/dashboard/promote/miniprogram?push_url={{ $push_url }}" width=200>';
            $('.miniprogram').html(html);
        }

        var clipboard = new Clipboard('.input-button');
        clipboard.on('success', function(e) {
//console.log(e);
            $.msg("复制成功！")
        });
        clipboard.on('error', function(e) {
//console.log(e);
            $.msg("复制失败！请手动复制")
        });
    })

    //



    $(".tablink").click(function() {
// 清除所有标签按钮的背景颜色
        var tablinks = $(".tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks.eq(i).removeClass('selected');
        }
        $(this).addClass('selected');

// 隐藏所有内容页面
        var tabcontent = $(".pop-tab-pane");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent.eq(i).css("display", "none")
        }
// 显示标签对应的内容页面
        var tabindex = $(this).index();
        var pageindex = $(".pop-tab-pane").eq(tabindex);
        pageindex.css("display", "block")
    })
    // 触发点击事件
    $("#defaultOpen").click();

    //
</script>