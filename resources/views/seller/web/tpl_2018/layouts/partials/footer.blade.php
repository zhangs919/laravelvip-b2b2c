
<div class="footer">
    <div class="wrapper">
        <p class="footer-link">

        </p>

        <font>
            {{--版权信息 备案号--}}
            {!! sysconf('site_copyright') !!}
            <a class="c-ccc m-l-10" href="javascript:;" target="_blank">{{ sysconf('site_icp') }}</a>
        </font>

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