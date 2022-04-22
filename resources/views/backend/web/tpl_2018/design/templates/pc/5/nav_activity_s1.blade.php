<!-- 促销活动版式1 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- banner右侧限时抢购 _start -->
    <div class="sale-discount">

        @if($tpl_name != '' && $is_design)
            <a href="javascript:void(0)" class="selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="7" data-act_type="3" data-number="6" data-width="980" data-title="促销活动">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        <ul class="saleDiscount">
            @if(!empty($data['7-1']))
                @foreach($data['7-1'] as $v)
                    <li>
                        <div class="sale-con">
                            <div class="goods-info">
                                <div class="goods-detail">
                                    <p class="time-remain" data-end_time="1546065055">活动已经结束啦!</p>
                                    <a href="javascript:void(0)" title="陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很" class="goods-thumb">
                                        <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036307529844.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original-webp="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036307529844.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220/format,webp/quality,q_75" alt="16">
                                    </a>
                                    <p class="goods-name">
                                        <a href="javascript:void(0)" title="陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很">陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很</a>
                                    </p>
                                    <p class="goods-price">
                                        <span class="color"> ￥109.00 </span>


                                        <span class="goods-discount color">7.4折</span>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <li>
                    <div class="sale-con">
                        <div class="goods-info">
                            <div class="goods-detail">
                                <p class="time-remain">
                        <span>
                        <span>
                        <em class="bg-color">00</em>
                        天
                        <em class="bg-color">00</em>
                        小时
                        <em class="bg-color">00</em>
                        分
                        <em class="bg-color">00</em>
                        秒
                        </span>
                        </span>
                                </p>
                                <a href="javascript:void(0)" class="goods-thumb">
                        <span class="example-text special">
                        <span>
                        示例产品
                        <br>
                        【140*140】
                        </span>
                        </span>
                                </a>
                                <p class="goods-name">
                                    <a href="javascript:void(0)">商品名称</a>
                                </p>
                                <p class="goods-price">
                                    <span class="color"> ￥0.00 </span>
                                    <span class="goods-discount color">0.0折</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            @endif

        </ul>

        <div class="arrow prev" style="opacity: 0;"></div>
        <div class="arrow next" style="opacity: 0;"></div>
        <!--<script type="text/javascript">
        Move(".next", ".pre", ".saleDiscount", ".sale-discount", "1");
        </script>-->
    </div>
    <!-- banner右侧限时抢购 _end -->

</div>

<script type="text/javascript">
    $(document).ready(function() {
        var nowtime = Date.parse(new Date());
        $('#{{ $uid }}').find(".time-remain").each(function(i) {
            var obj = $(this);
            var time = $(this).data("time") * 1000 - nowtime;
            $(obj).countdown({
                time: time,

                htmlTemplate: '<span><em class="bg-color">%{d}</em> 天 <em class="bg-color">%{h}</em> 小时 <em class="bg-color">%{m}</em> 分 <em class="bg-color">%{s}</em> 秒</span>',

                leadingZero: true,
                onComplete: function(event) {
                    $(obj).html("活动已经结束啦!");
                }
            });
        });
    });
</script>