<div class="copyright">
    <div class="text-c">
        <p>
            {{--版权信息 备案号--}}
            {!! sysconf('site_copyright') !!}
            <a class="vol m-l-10" href="javascript:;" target="_blank">{{ sysconf('site_icp') }}</a>
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