<div id="table_list">
    @if(!empty($list))
        <div class="card-list clearfix">
            <div class="card-container">
                <div class="card-inner "style="background-color:#00b0f0">
                    <a href="/user/rights-card/info?id=192">
                        <div class="shop-info">
                            <img src="https://xxxx/images/shop/309/images/2019/01/25/15484069028906.png?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                            <span>三只松鼠旗舰店</span>
                        </div>
                        <div class="card-title">
                            <span>高级会员(VIP2)</span>
                            <span class="default">默认</span>
                        </div>
                        <div class="card-type">
                            类型：
                            按规则发放
                        </div>
                        <div class="card-time">
                            永久有效
                        </div>
                        <div class="card-state">
                            使用中
                        </div>
                    </a>
                </div>
                <div class="card-inner "style="background-color:#00b0f0">
                    <a href="/user/rights-card/info?id=200">
                        <div class="shop-info">
                            <img src="https://xxxx/images/shop/5/images/2019/01/28/15486572353455.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                            <span>夏色萌动自营旗舰店</span>
                        </div>
                        <div class="card-title">
                            <span>高级会员(VIP2)</span>
                            <span class="default">默认</span>
                        </div>
                        <div class="card-type">
                            类型：
                            按规则发放
                        </div>
                        <div class="card-time">
                            永久有效
                        </div>
                        <div class="card-state">
                            使用中
                        </div>
                    </a>
                </div>
                <div class="card-inner "style="background-color:#00b0f0">
                    <a href="/user/rights-card/info?id=211">
                        <div class="shop-info">
                            <img src="https://xxxx/images/shop/6/images/2019/01/28/15486555936392.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                            <span>吃子之心零食店</span>
                        </div>
                        <div class="card-title">
                            <span>VIP会员(VIP3)</span>
                            <span class="default">默认</span>
                        </div>
                        <div class="card-type">
                            类型：
                            按规则发放
                        </div>
                        <div class="card-time">
                            永久有效
                        </div>
                        <div class="card-state">
                            使用中
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <form name="selectPageForm" action="" method="get">
            <!--分页-->
            <div class="page">
                <div class="page-wrap fr">
                    <div id="pagination" class="page">
                        {!! $pageHtml !!}
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="card-list clearfix">
            <div class="card-container">
                <div class="tip-box">
                    <img src="/images/noresult.png" class="tip-icon" />
                    <div class="tip-text">没有符合条件的记录</div>
                </div>
            </div>
        </div>
    @endif
</div>
<script>

    // $().ready(function() {
    //     $(".pagination-goto > .goto-input").keyup(function(e) {
    //         $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
    //         if (e.keyCode == 13) {
    //             $(".pagination-goto > .goto-link").click();
    //         }
    //     });
    //     $(".pagination-goto > .goto-button").click(function() {
    //         var page = $(".pagination-goto > .goto-link").attr("data-go-page");
    //         if ($.trim(page) == '') {
    //             return false;
    //         }
    //         $(".pagination-goto > .goto-link").attr("data-go-page", page);
    //         $(".pagination-goto > .goto-link").click();
    //         return false;
    //     });
    // });

    //
</script>
