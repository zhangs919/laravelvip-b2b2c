<div class="order-center-content" id="table_list">

    @if(!empty($list))
        <div class="tablelist-append">
            @foreach($list as $v)
                <div class="order-list">
                    <h2>
                        <a href="/shop/{{ $v['shop_id'] }}.html">
                            <i class="shop-icon"></i>
                            <span>{{ $v['shop_name'] }}</span>
                        </a>
                        <strong class="color">{{ format_complaint_status($v['complaint_status'],1) }}</strong>
                    </h2>
                    <div class="complaint-other">
                        <p>
                            投诉编号：
                            <span>{{ $v['complaint_sn'] }}</span>
                        </p>
                        <p>
                            订单编号：
                            <a href="/user/order/info?id={{ $v['order_id'] }}.html">{{ $v['order_sn'] }}</a>
                        </p>
                        <p>
                            投诉卖家：
                            <span>{{ $v['user_name'] }}</span>
                        </p>
                        <p>
                            投诉原因：
                            <span>{{ format_complaint_type($v['complaint_type']) }}</span>
                        </p>
                        <p>
                            申请时间：
                            <span>{{ format_time($v['add_time']) }}</span>
                        </p>
                    </div>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/complaint/view.html?complaint_id={{ $v['complaint_id'] }}"
                               class="color">查看详情</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- 分页 -->
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
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png">
            </div>
            <dl>
                <dt>没有任何投诉记录哦~</dt>
            </dl>
        </div>
    @endif


</div>
