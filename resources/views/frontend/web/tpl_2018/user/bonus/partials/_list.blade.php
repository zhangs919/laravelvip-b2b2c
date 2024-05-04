<div id="table_list">

    @if(!empty($list))
    <!---->
    <div class="coupon-items">
        @foreach($list as $v)
            {{--红包状态 默认0 0-正常 1-已使用 2-已失效--}}
        <div class="coupon-item {{ str_replace([0,1,2], ['coupon-item-ing','coupon-item-ed','coupon-item-ed'],$v['bonus_status']) }}">
            <div class="coupon-type">
                <div class="price">
                    <em>¥</em>
                    <strong>{{ $v['bonus_price'] }}</strong>
                </div>
                <div class="limit">

                    【

                    @if(!$v['is_original_price'])
                    限原价、
                    @endif
                    满{{ $v['min_goods_amount'] }}元可用
                    】

                </div>
                <div class="time">{{ $v['start_time_format'] }} ~ {{ $v['end_time_format'] }}</div>
                <div class="coupon-type-top"></div>
                <div class="coupon-type-bottom"></div>
            </div>
            <div class="coupon-msg">
                <div class="range">
                    <div class="range-item">
                        <span class="label">限品类：</span>
                        <span class="txt">
                            <a href="/shop/{{ $v['shop_id'] }}.html" target="_blank">




                            {{--自营店铺 指定分类 / 全店通用--}}
                            全店通用



                            </a>
                        </span>
                    </div>
                    <div class="range-item">
                        <span class="label">发行方：</span>
                        <span class="txt">
                            <a href="/shop/{{ $v['shop_id'] }}.html" target="_blank" title="点击进入店铺">{{ $v['shop_name'] }}</a>
                        </span>
                    </div>
                </div>

                @if($v['bonus_status'] == 0){{--正常--}}
                    <div class="op-btns">
                        <a href="/shop/{{ $v['shop_id'] }}.html" class="btn" target="_blank">
                            <span class="txt">立即使用</span>
                        </a>
                    </div>
                @endif

            </div>

            <!-- 红包左上角到期、过期提示 _start -->


            @if($v['bonus_status'] == 2){{--已失效--}}
                <!-- 已经过期的红包 _start -->
                <div class="coupon-icon coupon-expired"></div>
                <div class="coupon-icon expired-date"></div>
                <div class="coupon-icon coupon-del" title="点击删除红包" data-user-bonus-id="{{ $v['user_bonus_id'] }}"></div>
                <!-- 已经过期的红包 _end -->
            @elseif($v['bonus_status'] == 1){{--已使用--}}
                <!-- 已经使用的红包 _start -->
                <div class="coupon-icon coupon-used"></div>
                {{--<div class="coupon-icon used-date"></div>--}}
                <div class="coupon-icon coupon-del" title="点击删除红包" data-user-bonus-id="{{ $v['user_bonus_id'] }}"></div>
                <!-- 已经使用的红包 _end -->
            @else{{--正常--}}
                <div class="coupon-icon coupon-del" title="点击删除红包" data-user-bonus-id="{{ $v['user_bonus_id'] }}"></div>
            @endif

            <!-- 红包左上角到期、过期提示 _end -->
        </div>

        @endforeach
    </div>

    {!! $pageHtml !!}

    @else
        <!---->
        <div class="coupon-list clearfix">
            <div class="tip-box">
                <img src="{{ get_image_url(sysconf('default_noresult'), 'default_noresult') }}" class="tip-icon" />
                <div class="tip-text">您还没有任何红包</div>
            </div>
        </div>
        <!---->
    @endif
</div>