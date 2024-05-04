<div id="table_list">
    <form method="GET" name="listform" action="">
        <div class="fore1 filter">
            <dl class="order">
                @foreach($filter['sorts'] as $key=>$item)
                <dd class="@if($key == 0){{ 'first' }}@endif @if($item['selected']){{ 'curr' }}@endif">
                    <a href="{{ $item['url'] }}">
                        {{ $item['name'] }}
                    </a>
                </dd>
                @endforeach
            </dl>
            <div class="pagin">
                <a class="prev prev-page" data-go-page="0">
                    <span class="icon prev-disabled"></span>
                </a>
                <span class="text">
                        <font class="color">{{ $go }}</font>
                        /
                        {{ $filter['page']['value'] }}
                    </span>
                <a class="next next-page" data-go-page="2" href="javascript:;">
                    <span class="icon next-btn"></span>
                </a>
            </div>
            <div class="total">
                共
                <span class="color">{{ $total }}</span>
                个红包
            </div>
        </div>
    </form>
    <!--红包列表-->
    <!--已经领取的红包增加样式：coupon-box-receive,已抢光coupon-box-received-->
    <!-- -->
    <div class="coupon-box-list clearfix">
        @foreach($list as $item)
            <div class="coupon-box {{ $item['class'] ?? '' }}">
                <div class="type">
                    <div class="price">
                        <em>￥</em>
                        <strong>{{ $item['bonus_amount'] }}</strong>
                        <div class="txt">
                            <p>红包</p>
                        </div>
                    </div>
                    <div class="range">
                        <p>
                            订单金额：
                            <span>
                                    购物满{{ $item['min_goods_amount'] }}元
                                </span>
                        </p>
                        <p>
                            限品类：
                            <a href="{{ $item['search_url'] }}" target="_blank">
                                全店通用
                            </a>
                        </p>
                        <p>
                            发行方： <a href="{{ $item['search_url'] }}" target="_blank" title="点击进入店铺">{{ $item['shop_name'] }}</a>
                        </p>
                        <p>{{ $item['start_time_format'] }}&nbsp;~&nbsp;{{ $item['end_time_format'] }}</p>
                    </div>
                </div>
                @if(isset($item['bonus_status']) && $item['bonus_status'] == 1)
                    <div class="op-btns">
                        <a href="{{ $item['search_url'] }}" class="bonus-receive">
                            <b></b>
                            立即使用
                        </a>
                    </div>
                    <div class="coupon-icon coupon-geted"></div>
                @else
                    <div class="op-btns">
                        <a href="javascript:void(0);" class="bonus-receive send" data-bonus_id={{ $item['bonus_id'] }}>
                            <b></b>
                            立即领取
                        </a>
                    </div>
                @endif

            </div>
            <script type="text/javascript">
                //
            </script>
        @endforeach
    </div>


    <div class="pull-right page-box">
        {!! $pageHtml !!}
    </div>
</div>
