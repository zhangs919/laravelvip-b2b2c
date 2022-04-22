<!-- 底部 _start-->



<div class="site-footer">








    <div class="footer-related">














        <div class="footer-info">
            <div class="info-text">
                <!-- 底部导航 -->
                <p class="nav-bottom">

                    {{--<a href="/shop/1.html" target="_blank">经营者信息</a>--}}

                </p>
                <p>
                    {{--版权信息 备案号--}}
                    {!! sysconf('site_copyright') !!}
                    <a href="http://www.miibeian.gov.cn/" target="_blank">{{ sysconf('site_icp') }}</a>
                </p>
                <p class="company-info" style="display: none;"></p>
                <p class="qualified">

                    @foreach($copyright_auth as $v)
                        <a href="{{ $v->links_url }}" target="_blank">
                            <img src="{{ get_image_url($v->auth_image) }}" alt="{{ $v->auth_name }}" />
                        </a>
                    @endforeach

                </p>
            </div>

            <div class="info-text"></div>

        </div>

    </div>
</div>
<!-- 底部 _end-->