<div id="table_list">

    @if(!empty($list))
        <div class="coupon-items tablelist-append">
            <div class="coupon-scroll-overflow">

                @foreach($list as $v)
                <div class="coupon-item {{ str_replace([0,1,2], ['coupon-item-ing','coupon-item-ed','coupon-item-ed'],$v['bonus_status']) }}">
                    <div class="coupon-scroll">
                        <div class="coupon-item-left bg-color">
                            <div class="coupon-item-left-inner">
                                <div class="coupon-num">
                                    <span>¥</span>
                                    <em>{{ $v['bonus_price'] }}</em>
                                </div>
                                <h3>



                                    @if($v['is_original_price'])
                                        限原价、
                                    @endif
                                    满{{ $v['min_goods_amount'] }}元可用



                                </h3>
                            </div>
                        </div>
                        <div class="coupon-item-right">
                            <div class="coupon-left-top">

                                <div class="coupon-range">
                                    限品类：
                                    <a href="/shop/{{ $v['shop_id'] }}.html">



                                        {{--自营店铺 指定分类 / 全店通用--}}
                                        全店通用



                                    </a>
                                </div>
                                <div class="coupon-range">
                                    发行方：	<a href="/shop/{{ $v['shop_id'] }}.html" target="_blank" title="点击进入店铺">{{ $v['shop_name'] }}</a>
                                </div>

                            </div>
                            <div class="coupon-left-bottom">
                                <div class="coupon-time">{{ $v['start_time_format'] }} ~ {{ $v['end_time_format'] }}</div>
                                <div class="op-btns">

                                    {{--未生效--}}
                                    {{--<a href="javascript:void(0);" class="no-start"></a>--}}

                                    @if($v['bonus_status'] == 2){{--已失效--}}
                                        <a href="javascript:void(0);" class="expired"></a>
                                    @elseif($v['bonus_status'] == 1){{--已使用--}}
                                        <a href="javascript:void(0);" class="already-used"></a>
                                    @else{{--正常--}}
                                        <a href="/shop/{{ $v['shop_id'] }}.html" class="btn color border-color">立即使用</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="coupon-action coupon-del" title="点击删除红包" data-user-bonus-id="{{ $v['user_bonus_id'] }}">删除</div>
                </div>
                @endforeach

            </div>
        </div>
        <!-- 分页 -->
        <div id="pagination" class="page">
            <div class="more-loader-spinner">

                <div class="is-loaded">
                    <div class="loaded-bg">我是有底线的</div>
                </div>

            </div>
            <script data-page-json="true" type="text" id="page_json">
            {!! $page_json !!}
            </script>
        </div>
    @else
        <div class="bonus-box">
            <div class="no-data-div">
                <div class="no-data-img">
                    <img src="/images/bg_empty_data.png" />
                </div>
                <dl>
                    <dt>一大~~~波优惠券即将赶来</dt>
                </dl>
            </div>
        </div>
    @endif

</div>