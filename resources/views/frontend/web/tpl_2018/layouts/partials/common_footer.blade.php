<!-- 底部 _start-->


{{-- 友情链接 只有首页显示--}}
@if(request()->routeIs('pc_home'))
<div class="links-box w1210">
    <div class="links-title">
        <span>友情链接</span>
    </div>
    <div class="links-content">
        <!-- 友情链接循环开始 -->

        @foreach($links_list as $v)
        <a href="{{ $v->links_url ?? 'javascript:;' }}" target="_blank" title="{{ $v->links_name }}">{{ $v->links_name }}</a>
        @endforeach

        <!-- 友情链接循环结束 -->
    </div>
</div>
@endif

<div class="site-footer">







    <div class="footer-service">
        {!! sysconf('mall_service') !!}
    </div>


    <div class="footer-related">








        <div class="footer-article w1210">
            <dl class="col-article col-article-spe">
                <dt class="phone color">{{ sysconf('mall_phone') }}</dt>
                <dd class="email color">{{ sysconf('mall_email') }}</dd>

                <dd class="customer">
                    <span>联系我们</span>

                    <a href="javascript:void(0);" class="service-online">
                        <em class="icon-yw service-online"></em>
                    </a>


                    <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ sysconf('mall_wangwang') }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                        <em class="icon-ww"></em>
                    </a>


                    <a href="http://wpa.qq.com/msgrd?v=3&uin={{ sysconf('mall_qq') }}&site=qq&menu=yes" target="_blank">
                        <em class="icon-kfqq"></em>
                    </a>

                </dd>

            </dl>
            <!---->

            {{--底部帮助中心文章--}}
            @if(!empty($footer_help_article))
            @foreach($footer_help_article as $v)
                <dl class="col-article col-article-first">
                <dt>{{ $v['cat_name'] }}</dt>

                    @if(!empty($v['article']))
                    @foreach($v['article'] as $art)
                    <dd>

                        <a rel="nofollow" href="/help/{{ $art['article_id'] }}.html" target="_blank">{{ $art['title'] }}</a>

                    </dd>
                    @endforeach
                    @endif

                </dl>
                <!---->
            @endforeach
            @endif

            <div class="QR-code fr">


                <ul class="tabs">

                    <li class="current">APP</li>
                    <li >微信</li>

                </ul>
                <div class="code-content">

                    <div class="code">
                        <img src="{{ get_image_url(sysconf('mall_wx_qrcode')) }}">
                    </div>


                    <div class="code hide">
                        <img src="{{ get_image_url(sysconf('mall_wx_qrcode')) }}">
                    </div>

                </div>


            </div>
        </div>







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
                    {{--版权信息 备案号--}}
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