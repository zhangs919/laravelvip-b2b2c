<div id="{{ $uuid }}">
    <div class="spread-box">
        <div class="spread-top-box"><h5>{{ $title }}</h5>
            <p>{{ $sub_title }}</p>
            <div class="flex-box m-b-10">
                <div class="flex1"><img
                            src="/dashboard/promote/qrcode?push_url={{ $url }}"
                            class="qrcode-img" alt="{{ $title }}推广码" style="border-color: #ccc; padding: 5px;"/> <a
                            href="/dashboard/promote/download-qcode?url={{ $url }}&filename={{ $title }}"
                            class="btn btn-default current m-b-10">下载二维码</a></div> <!-- -->
                <div class="flex1"><img
                            src="/dashboard/promote/miniprogram?push_url={{ $url }}"
                            class="program-img" alt="{{ $title }}推广小程序码" style="border-color: #ccc; padding: 5px;"/> <a
                            href="/dashboard/promote/download-qcode?url={{ $url }}&type=1&filename={{ $title }}"
                            class="btn btn-default current m-b-10">下载小程序码</a></div>
            </div>
            </br> <a class="c-blue copy-link" href="javascript:void(0);"
                     data-clipboard-text="{{ $url }}">复制链接</a></div>
        <h5 class="f12 c-333 m-b-10 m-t-10"><span>使用流程：</span></h5>
        <div class="widget-box small">
            <div class="procedure-box"> <!--为完成的添加active-->
                <div class="procedure-item active"><span class="number">1</span>
                    <p>下载推广码</p></div>
                <div class="procedure-item active"><span class="number">2</span>
                    <p>将下载的推广码放入宣传物料或网页中</p></div>
                <div class="procedure-item active"><span class="number">3</span>
                    <p>扫码进入推广页面</p></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> $().ready(function () {
        var obj = $("#{{ $uuid }}");
        // 复制到剪切板
        var clipboard = new Clipboard('.copy-link');
        clipboard.on('success', function (e) {
            $.msg("复制成功！");
            e.clearSelection();
        });
    })
</script>
<script src="/assets/d2eace91/js/jquery.qrcode.min.js?v=2.1"></script>
<script src="/assets/d2eace91/js/clipboard.min.js?v=2.1"></script>