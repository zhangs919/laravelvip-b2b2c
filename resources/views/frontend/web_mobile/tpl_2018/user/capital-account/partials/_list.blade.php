<!--如果有明细-->
<div id="table_list" class="capital-detail-box list-type-text">
    @if(!empty($list))
        <!---->
        <div class="tablelist-append">

            @foreach($list as $v)
            <div class="list-item">
                <P>第三方话费充值缴费<br>订单编号：20190421145743007551<br>下单时间：2019-04-21 22:57:51<br>充值金额：1<br>支付方式：微信支付<br>微信支付：0.01</P>

                <span class="lose">-0.01</span>

                <p>
                    <em></em>
                    2019-04-21 22:57:51
                </p>
            </div>
            @endforeach

        </div>
        <!-- 分页 -->
        <!-- 分页 -->
        <div id="pagination" class="page">
            <div class="more-loader-spinner">

            </div>
            <script data-page-json="true" type="text" id="page_json">
                {!! $page_json !!}
            </script>
        </div>	<!---->
    @else
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png">
            </div>
            <dl>
                <dt>暂无相关记录</dt>
            </dl>

        </div>
    @endif
</div>