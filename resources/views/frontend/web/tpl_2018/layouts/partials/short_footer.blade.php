<!-- 底部 _start-->
<div class="site-footer">
    <div class="footer-related">
        <div class="footer-info">
            <div class="info-text">
                <!-- 底部导航 -->
                <p class="nav-bottom">
                    @if(!empty($footer_navigation))
                        @foreach($footer_navigation as $k=>$v)
                            <a href="{{ $v['nav_link'] ?? 'javascript:void(0)'}}" target="@if($v['new_open']) _blank @else _self @endif">{{ $v['nav_name'] }}</a>

                            @if((count($footer_navigation)-($k+1)) != 0)
                                <em>|</em>
                            @endif

                        @endforeach
                    @endif
                </p>
                <p>
                    {!! sysconf('site_copyright') !!}
                    <a href="http://www.miibeian.gov.cn/" target="_blank">{{ sysconf('site_icp') }}</a>
                </p>
                <p class="company-info" style="display: none;">{{ sysconf('mall_address') }}</p>
                <p class="qualified">
                    @foreach($copyright_auth as $v)
                        <a href="{{ $v->links_url }}" target="_blank">
                            <img src="{{ get_image_url($v->auth_image) }}" alt="{{ $v->auth_name }}" />
                        </a>
                    @endforeach
                </p>
            </div>
            <div class="info-text">
                {{--第三方统计代码--}}
                {!! sysconf('stats_code') !!}
            </div>
        </div>
    </div>
</div>
<!-- 底部 _end-->