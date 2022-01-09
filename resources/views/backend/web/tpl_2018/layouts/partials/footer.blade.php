<div class="platform-footer">

    <p>
        {{--版权信息 备案号--}}
        {!! sysconf('site_copyright') !!}
        <a class="btn-link m-l-10" href="http://www.miibeian.gov.cn/" target="_blank">{{ sysconf('site_icp') }}</a>
    </p>

    {{--<div class="copyright">
        <p>
            <a href="http://www.laravelvip.com" target="_blank" class="copyright-logo">
                <img src="/frontend/images/power-by-logo.png">
                提供技术支持
            </a>
        </p>
    </div>--}}



</div>


<a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>



<script>
    /* TODO 设置 Ajax LARAVEL 419 POST error */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>