<div class="footer">
    <p><span>{!! sysconf('site_copyright') !!}<a class="c-777 m-l-10" href="javascript:;" target="_blank">{{ sysconf('site_icp') }}</a></span></p>
    <div class="copyright">
        <p>
            <a href="http://www.laravelvip.com/statistics.html?product_type=shop&domain=http://www.laravelvip.com" target="_blank" class="copyright-logo">
                技术支持：乐融沃
            </a>
        </p>
    </div>
</div>

<script>
    /* TODO 设置 Ajax LARAVEL 419 POST error */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
