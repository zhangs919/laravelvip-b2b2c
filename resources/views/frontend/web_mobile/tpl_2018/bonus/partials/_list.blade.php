{{--<link href="/css/bonus_message.css?v=20201012" rel="stylesheet">--}}
<div class="coupon-market-box" id="table_list">
    <div class="coupon-market-list  tablelist-append">

        @foreach($list as $item)
            <div class="coupon-market-item {{ $item['class'] ?? '' }}">
                <div class="coupon-market-msg">
                    <div class="coupon-mst-top">
                        <div class="price">
                            <em>￥</em>
                            <strong>{{ $item['bonus_amount'] }}</strong>
                        </div>
                        <div class="condition">
                            <p class="type">红包</p>
                        </div>
                    </div>
                    <p class="coupon-amount">
                        订单金额：
                        购物满{{ $item['min_goods_amount'] }}元
                    </p>
                    <p class="coupon-range">
                        限品类：
                        <a href="{{ $item['search_url'] }}">
                            全店通用
                        </a>
                    </p>
                    <p class="coupon-range">
                        发行方：                    <a href="{{ $item['search_url'] }}">{{ $item['shop_name'] }}</a>
                    </p>
                    <p class="coupon-time">{{ $item['start_time_format'] }}&nbsp;~&nbsp;{{ $item['end_time_format'] }}</p>
                    @if(isset($item['bonus_status']) && $item['bonus_status'] == 1)
                        <div class="coupon-stamp"></div>
                    @endif
                </div>
                @if(isset($item['bonus_status']) && $item['bonus_status'] == 1)
                    <a href="{{ $item['search_url'] }}" class="coupon-market-type">
                        <p>立即使用</p>
                    </a>
                @else
                    <a href="javascript:void(0);" class="coupon-market-type send" data-bonus_id={{ $item['bonus_id'] }}>
                        <p>立即领取</p>
                    </a>
                @endif
            </div>
            <script type="text/javascript">
                //
            </script>
        @endforeach
    </div>
    <!-- 分页 -->
    <div id="pagination" class="page">
        <div class="more-loader-spinner">
        </div>
        <script data-page-json="true" type="text" id="page_json">
            {!! $page_json !!}
        </script>
    </div></div>

<script>

//     $().ready(function() {
// // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
//         var act_id = "241";
//         $("#bonus_countdown" + act_id).countdown({
//             time: "-1604321833000",
//             leadingZero: true,
//
//             htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
//
//             onComplete: function(event) {
//             }
//         });
//     });
//
//     //
//
//
//
//     $().ready(function() {
// // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
//         var act_id = "240";
//         $("#bonus_countdown" + act_id).countdown({
//             time: "-1604321833000",
//             leadingZero: true,
//
//             htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
//
//             onComplete: function(event) {
//             }
//         });
//     });
//
//     //
//
//
//
//     $().ready(function() {
// // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
//         var act_id = "236";
//         $("#bonus_countdown" + act_id).countdown({
//             time: "-1604321833000",
//             leadingZero: true,
//
//             htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
//
//             onComplete: function(event) {
//             }
//         });
//     });
//
//     //
//
//
//
//     $().ready(function() {
// // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
//         var act_id = "235";
//         $("#bonus_countdown" + act_id).countdown({
//             time: "-1604321833000",
//             leadingZero: true,
//
//             htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
//
//             onComplete: function(event) {
//             }
//         });
//     });
//
//     //
//
//
//
//     $().ready(function() {
// // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
//         var act_id = "234";
//         $("#bonus_countdown" + act_id).countdown({
//             time: "-1604321833000",
//             leadingZero: true,
//
//             htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
//
//             onComplete: function(event) {
//             }
//         });
//     });
//
//     //
//
//
//
//     $().ready(function() {
// // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
//         var act_id = "233";
//         $("#bonus_countdown" + act_id).countdown({
//             time: "-1604321833000",
//             leadingZero: true,
//
//             htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
//
//             onComplete: function(event) {
//             }
//         });
//     });
//
//     //
//
//
//
//     $().ready(function() {
// // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
//         var act_id = "221";
//         $("#bonus_countdown" + act_id).countdown({
//             time: "-1604321833000",
//             leadingZero: true,
//
//             htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
//
//             onComplete: function(event) {
//             }
//         });
//     });
//
//     //
//
//
//
//     $().ready(function() {
// // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
//         var act_id = "220";
//         $("#bonus_countdown" + act_id).countdown({
//             time: "-1604321833000",
//             leadingZero: true,
//
//             htmlTemplate: "<span class='time'>%{d}</span><span class='separator'>:</span><span class='time'>%{h}</span><span class='separator'>:</span><span class='time'>%{m}</span><span class='separator'>:</span><span class='time'>%{s}</span>",
//
//             onComplete: function(event) {
//             }
//         });
//     });

    //
</script>