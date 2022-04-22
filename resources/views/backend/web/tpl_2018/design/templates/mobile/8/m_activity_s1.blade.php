<!-- 手机端商品促销模板 m_activity_s1-->
<!-- 默认缓载图片 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>

    <div class="pro-goods-box">

        @if($tpl_name != '' && $is_design)
            <a title="编辑" class="goods-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="7" data-act_type="3" data-number="10" data-title="团购活动" data-width="980">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        <div class="tablelist-append">

            @if(!empty($data['7-1']))
                @foreach($data['7-1'] as $v)
                    <a href="javascript:void(0)" title="1" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; display: block; background-size: 100px;">
                        <li class="pro-goods-item">
                            <div class="pro-goods-img">
                                <img class="lazy square" src="/assets/d2eace91/images/common/blank.png" data-original="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/system/config/default_image/default_goods_image_0.png?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original-webp="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/system/config/default_image/default_goods_image_0.png?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp" />
                                <div class="settime" data-end_time="1547884095" data-countdown="604703">
                                    <span>00天00时00分00秒</span>
                                </div>
                            </div>
                            <div class="pro-goods-info" id="SZY_ACT_GOODS_INFO_2788">
                                <div class="pro-goods-name">红茶200g</div>
                                <div class="item-status">
                                    <div class="status-bar">
                                        <div class="status-progress" style="width: 0%;"></div>
                                        <div class="status-soldrate">0%</div>
                                    </div>
                                    <div class="status-num">
<span>
已抢
<em>2</em>
件
</span>
                                        <span>
仅剩
<em class="color">1</em>
件
</span>
                                    </div>
                                </div>
                                <div class="item-wrap">
                                    <div class="item-price">
                                        <ins class="item-newprice">
                                            <span>￥1.00</span>
                                        </ins>
                                        <del class="item-oldprice">￥1.00</del>
                                    </div>
                                    <div class="item-action coming">立即抢购</div>
                                </div>
                            </div>
                        </li>
                    </a>
                @endforeach
            @else
                <a href="javascript:void(0);" class="example-text">
                    <li class="pro-goods-item">
                        <div class="pro-goods-img example-text">
                            <span>示例产品 </span>
                            <div class="settime">
                                <span>00天00时00分00秒</span>
                            </div>
                        </div>
                        <div class="pro-goods-info">
                            <div class="pro-goods-name">商品名称</div>
                            <div class="item-status">
                                <div class="status-bar">
                                    <div class="status-progress" style="width: 0%;"></div>
                                    <div class="status-soldrate">0%</div>
                                </div>
                                <div class="status-num">
<span>
已抢
<em>0</em>
件
</span>
                                    <span>
仅剩
<em class="color">0</em>
件
</span>
                                </div>
                            </div>
                            <div class="item-wrap">
                                <div class="item-price">
                                    <ins class="item-newprice">
                                        <span>￥0.00</span>
                                    </ins>
                                    <del class="item-oldprice">￥0.00</del>
                                </div>
                                <div class="item-action coming">立即抢购</div>
                            </div>
                        </div>
                    </li>
                </a>
            @endif


        </div>
    </div>

</div>

<script type="text/javascript">
    $.each($('#{{ $uid }}').find(".settime"),function(){
        var time = $(this).data('countdown')*1000;
        $(this).countdown({
            time: time,
            leadingZero: true,

            htmlTemplate: "<span>%{d}天%{h}时%{m}分%{s}秒</span>",

            onComplete: function(event) {
                $(this).html("活动已结束！");
            }
        });
    });
</script>
<script type="text/javascript">
    //
    $.get('/site/tpl-data', {
        tpl_code: 'act_goods_info',
        act_goods_ids: '2788',
    }, function(result) {
        if (result.data) {
            $.each(result.data, function(i, v) {
                $('#{{ $uid }}').find('#SZY_ACT_GOODS_INFO_' + i).find('.status-num span').eq(0).find('em').html(v.act_total_sale);
                $('#{{ $uid }}').find('#SZY_ACT_GOODS_INFO_' + i).find('.status-num span').eq(1).find('em').html(v.act_surplus);
                $('#{{ $uid }}').find('#SZY_ACT_GOODS_INFO_' + i).find('.status-progress').css('width', v.rate + '%');
                $('#{{ $uid }}').find('#SZY_ACT_GOODS_INFO_' + i).find('.status-soldrate').html(v.rate + '%');
            });
        }
    }, 'JSON');
    //
</script>	<!-- 手机端商品促销模板 m_activity_s2 -->
<!-- 默认缓载图片 -->
