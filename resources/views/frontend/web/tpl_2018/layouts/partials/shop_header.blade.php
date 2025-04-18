{{--店铺头部--}}
<div class="header">
    <div class="w1210 clearfix">
        <div class="logo-info">
            <a href="/" class="logo">

                <img src="{{ get_image_url(sysconf('mall_logo')) }}" />

            </a>
        </div>
        <div class="shop-info">
            <div class="shop">
                <div class="shop-name ">
                    <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}" title="{{ $shop_info['shop']['shop_name'] }}">{{ $shop_info['shop']['shop_name'] }}</a>
                </div>

                @if($shop_info['shop']['show_credit'])
                <p>
                    <img src="{{ get_image_url($shop_info['credit']['credit_img']) }}" title="{{ $shop_info['credit']['credit_name'] }}" />
                </p>
                @endif


            </div>
            <div class="shop-main">

                <div class="shop-score-box">
                    <div class="shop-score-item">
                        <div class="shop-score-title">描 述</div>
                        <div class="score color">
                            <span>{{ $shop_info['shop']['desc_score'] }}</span>
                        </div>
                    </div>
                    <div class="shop-score-item">
                        <div class="shop-score-title">服 务</div>
                        <div class="score color">
                            <span>{{ $shop_info['shop']['service_score'] }}</span>
                        </div>
                    </div>
                    <div class="shop-score-item">
                        <div class="shop-score-title">发 货</div>
                        <div class="score color">
                            <span>{{ $shop_info['shop']['send_score'] }}</span>
                        </div>
                    </div>
                </div>

            </div>
            <a class="slogo-triangle">
                <i class="icon-triangle"></i>
            </a>
            <div class="extra-info">
                <div class="hd">
                    <p class="shop-collect">
                        <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}" title="{{ $shop_info['shop']['shop_name'] }}" class="shop-logo">
                            <img src="{{ get_image_url($shop_info['shop']['shop_logo'], 'shop_logo') }}">
                        </a>
                        <a href="javascript:void(0);" onClick="toggleShop('{{ $shop_info['shop']['shop_id'] }}',this)" class="collect-btn bg-color">收藏本店</a>
                    </p>
                    <p class="collect-count" style="display: none;">
                        <em id="collect-count">0</em>
                    </p>
                    <p class="collect-tip" style="display: none;">收藏</p>
                    <!-- 店铺二维码 _start -->
                    <p class="shop-qr-code">
                        {{--<img src="/shop/qrcode.html?id={{ $shop_info['shop']['shop_id'] }}" alt="店铺二维码" />--}}
                        <img src="{{ $shop_info['shop']['qrcode'] ?? '' }}" alt="店铺二维码" />
                    </p>
                    <!-- 店铺二维码 end -->
                </div>
                <div class="bd">

                    <div class="shop-rate">
                        <h4>店铺动态评分</h4>
                        <ul>
                            <li>
                                描述相符：
                                <a target="_blank" href="javascript:void(0);">
                                    <em class="count color" title="">{{ $shop_info['shop']['desc_score'] }}</em>
                                </a>
                            </li>
                            <li>
                                服务态度：
                                <a target="_blank" href="javascript:void(0);">
                                    <em class="count color" title="">{{ $shop_info['shop']['service_score'] }}</em>
                                </a>
                            </li>
                            <li>
                                发货速度：
                                <a target="_blank" href="javascript:void(0);">
                                    <em class="count color" title="">{{ $shop_info['shop']['send_score'] }}</em>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="extend ">
                        <h4 class="extend-title">店铺服务</h4>
                        <ul>
                            <li>
                                <label>店铺掌柜：</label>
                                <div class="extend-right">
                                    <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}" class="color">{{ $shop_info['shop']['shop_name'] }}</a>
                                </div>
                            </li>


                            <li>
                                <label>开店时长：</label>
                                <div class="extend-right">
                                    <span class="duration-time">{{ $duration_time }}</span>
                                </div>
                            </li>

                            <li class="locus">
                                <label>所在地：</label>
                                <div class="extend-right">
                                    <span>{{ $region_name }} {{ $shop_info['shop']['address'] }}</span>
                                </div>
                            </li>


                            <li>
                                <label>工商执照：</label>
                                <div class="extend-right">

                                    @php
                                        $special_aptitude = explode('|', $shop_info['real']['special_aptitude'])
                                    @endphp
                                    @if(!empty($special_aptitude))
                                        @foreach($special_aptitude as $v)
                                            <a id="" href="/shop/index/license.html?id=1&code=special_aptitude" target="_blank">
                                                <img src="{{ get_image_url($v) }}" width="20" height="22" border="0" title="特殊行业资质" />
                                            </a>
                                        @endforeach
                                    @endif


                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="mobile-shop">
            <div class="mobile-qr-code">
                <span>手机逛</span>
                <i class="qr-code"></i>
            </div>
            <a href="javascript:void(0);" class="arrow">
                <i class="down-up"></i>
            </a>
            <div class="mobile-qr-code-box">
                <img width="140" height="140" src="" />
                <p>扫一扫，手机逛起来</p>
            </div>
        </div>
         -->
        <div class="search">
            <form class="search-form" method="get" name="" id="search-form" action="{{ route('pc_shop_search', ['shop_id' => $shop_info['shop']['shop_id']]) }}" onSubmit="">
                <!-- <input type='hidden' name='type' id="searchtype" value=""> -->
                <div class="search-info">
                    <div class="search-box">
                        <div class="search-box-con">
                            <input class="search-box-input" name="keyword" id="keyword" tabindex="9" autocomplete="off" placeholder="请输入关键词" value="{{ $keyword ?? '' }}" onFocus="if( this.value=='请输入关键词'){ this.value=''; }else{ this.value=this.value; }" onBlur="if(this.value=='')this.value='请输入关键词'" type="text">
                        </div>
                    </div>
                    <input type="button" onclick="search_all()" value="搜全站" class="button bg-color">
                </div>
                <input type="button" onclick="search_me()" value="搜本店" class="button button-spe">
            </form>
            <ul class="hot-query">
                <!-- 默认搜索词 -->

                @if(!empty($default_keywords))
                    @foreach($default_keywords as $k=>$v)
                        <li @if($k == 0)class="first"@endif>
                            <a href="{{ $v['url'] }}" title="{{ $v['keyword'] }}">{{ $v['keyword'] }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>

<!-- 右侧客服 _start-->
@if(empty($is_design))
<div class="customer-service-box">
    <div class="box-content">
        <div class="box-small">


            <div class="customer-service">
				<span class="ww-light">

					<!-- 旺旺不在线 i 标签的 class="ww-offline" -->






                    <!-- s等于1时带文字，等于2时不带文字 -->
                    <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&groupid=0&charset=utf-8">
                        <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                        <span></span>
                    </a>







				</span>
                <span class="text">客服</span>
            </div>

        </div>
        <div class="box-large">
            <ul>
                <li class="service-item">
                    <a href="" rel="nofollow" class="color">{{ $shop_info['shop']['shop_name'] }}</a>
                    <span class="ww-light">
						<!-- 旺旺不在线 i 标签的 class="ww-offline" -->






                        <!-- s等于1时带文字，等于2时不带文字 -->
                        <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&groupid=0&charset=utf-8">
                            <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=xxxxxx&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                            <span></span>
                        </a>





                        <!-- -->
					</span>
                </li>

                <li class="service-item">
                    <h4>在线客服</h4>
                    <ul class="service-info">

                        <li class="group clearfix">
                            <span>售前客服</span>
                            <div class="customer-info">


                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=xxxxxx&site=qq&menu=yes" class="ww-inline service-btn-qq">
                                    <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:xxxxxx:51" alt="QQ" title="点击这里给我发消息" style="height: 20px;"/>
                                </a>
                                </br>


                            </div>
                        </li>

                        <li class="group clearfix">
                            <span>售后客服</span>
                            <div class="customer-info">


                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=xxxxxx&site=qq&menu=yes" class="ww-inline service-btn-qq">
                                    <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:xxxxxx:51" alt="QQ" title="点击这里给我发消息" style="height: 20px;"/>
                                </a>
                                </br>


                            </div>
                        </li>

                        <!---->
                    </ul>
                </li>


                <li class="service-item">
                    <h4>工作时间</h4>
                    <ul class="service-info">
                        <li>
                            <span>{!! $shop_info['shop']['service_hours'] !!}</span>
                        </li>
                    </ul>
                </li>



            </ul>
        </div>
    </div>
</div>
@endif
<!-- 右侧客服_end -->

<div class="layout">

    {{--店铺菜单--}}
    @include('frontend.web.tpl_2018.layouts.partials.shop_menu')

</div>
<script type="text/javascript">
    //
</script>
