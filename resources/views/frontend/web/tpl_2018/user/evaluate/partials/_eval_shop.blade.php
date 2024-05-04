<div class="content-info comment-shop">
    <div id="raty_stars">
        <div class="shop-evaluate clearfix">
            <div class="shop-logo">
                <a href="/shop/{{ $shop_info['shop_id'] }}.html" target="_blank" title="进入店铺">
                    <img src="{{ get_image_url($shop_info['shop_image']) }}" />
                </a>
            </div>
            <div class="shop-info">
                <p>
                    <img src="/images/shop-type/shop-icon{{ $shop_info['shop_type'] }}.png" />
                    <a href="/shop/{{ $shop_info['shop_id'] }}.html" target="_blank" class="shop-name">{{ $shop_info['shop_name'] }}</a>

                    {{--客服工具 默认0 0无客服 1QQ 2旺旺--}}
                    @if($shop_customer['customer_tool'] == 2)
                        <span class="ww-light">
                                <!-- 旺旺不在线 i 标签的 class="ww-offline" -->

                            <!-- s等于1时带文字，等于2时不带文字 -->
                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $shop_customer['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid={{ $shop_customer['customer_account'] }}&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                    <span></span>
                                </a>

                            </span>
                    @elseif($shop_customer['customer_tool'] == 1)
                    <!-- s等于1时带文字，等于2时不带文字 -->
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $shop_customer['customer_account'] }}&site=qq&menu=yes" class="service-btn">
                            <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $shop_customer['customer_account'] }}:52" alt="QQ" title="" style="height: 20px;" />
                            <span></span>
                        </a>
                    @else{{--默认 平台客服--}}
                    <a href='{{ $yikf_url ?? 'javascript:;' }}' class="ww-light  color" target="_blank" title="点击联系在线客服">
                        <i class="iconfont">&#xe6ad;</i>
                    </a>
                    @endif

                </p>
                <ul>
                    <li>
                        描述相符：
                        <span class="color" id="desc_core">{{ $shop_info['desc_score'] }}</span>
                    </li>
                    <li>
                        服务态度：
                        <span class="color">{{ $shop_info['service_score'] }}</span>
                    </li>
                    <li>
                        发货速度：
                        <span class="color">{{ $shop_info['send_score'] }}</span>
                    </li>
                    <li>
                        物流服务：
                        <span class="color">{{ $shop_info['logistics_score'] }}</span>
                    </li>
                </ul>
            </div>

            @if(empty($shop_comment))
                <form class="comment-form" method="POST" action="">
                    <div class="evaluate-shop">
                        <ul>
                            <li>
                                <span class="spark">*</span>
                                服务态度
                                <span class="rank-star">
                                    <div id="default-demo1"></div>
                                </span>
                            </li>
                            <li>
                                <span class="spark">*</span>
                                发货速度
                                <span class="rank-star">
                                    <div id="default-demo2"></div>
                                </span>
                            </li>
                            <li>
                                <span class="spark">*</span>
                                物流服务
                                <span class="rank-star">
                                    <div id="default-demo3"></div>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="act clearfix">
                        <input type="button" class="btn btn-eval-shop" value="提交" data-order-id="{{ $order_id }}" />
                    </div>
                </form>
            @else
                <div class="evaluate-shop">
                    <ul>
                        <li>
                            <span class="spark">*</span>
                            服务态度
                            <span class="rank-star">
                                                <div style="width: 205px;">

                                                    @foreach($score_desc['service_desc'] as $key=>$item)
                                                        <img src="/images/star-rank/star-@if($key+1 <= $shop_comment['shop_service']){{ 'on' }}@else{{ 'off' }}@endif.png" alt="{{ $key+1 }}" title="{{ $item }}">
                                                    @endforeach

                                                </div>
                                            </span>
                        </li>
                        <li>
                            <span class="spark">*</span>
                            发货速度
                            <span class="rank-star">
                                                <div style="width: 205px;">

                                                    @foreach($score_desc['send_desc'] as $key=>$item)
                                                        <img src="/images/star-rank/star-@if($key+1 <= $shop_comment['shop_speed']){{ 'on' }}@else{{ 'off' }}@endif.png" alt="{{ $key+1 }}" title="{{ $item }}">
                                                    @endforeach

                                                </div>
                                            </span>
                        </li>
                        <li>
                            <span class="spark">*</span>
                            物流服务
                            <span class="rank-star">
                                                <div style="width: 205px;">

                                                    @foreach($score_desc['logistics_speed'] as $key=>$item)
                                                        <img src="/images/star-rank/star-@if($key+1 <= $shop_comment['logistics_speed']){{ 'on' }}@else{{ 'off' }}@endif.png" alt="{{ $key+1 }}" title="{{ $item }}">
                                                    @endforeach

                                                </div>
                                            </span>
                        </li>
                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>
<script type='text/javascript'>
    @if(request()->method() == 'POST')
    //商品星级评价 依赖于js/jquery.raty.js
    $().ready(function() {
        $.fn.raty.defaults.path = '/images/star-rank';
        $.fn.raty.defaults.scoreName = "service_desc_score";
        $.fn.raty.defaults.hints = {!! json_encode($score_desc['service_desc']) !!};
        $('#default-demo1').raty();
        $.fn.raty.defaults.scoreName = "send_desc_score";
        $.fn.raty.defaults.hints = {!! json_encode($score_desc['send_desc']) !!};
        $('#default-demo2').raty();
        $.fn.raty.defaults.scoreName = "logistics_speed_score";
        $.fn.raty.defaults.hints = {!! json_encode($score_desc['logistics_speed']) !!};
        $('#default-demo3').raty();
    });
    @endif
</script>