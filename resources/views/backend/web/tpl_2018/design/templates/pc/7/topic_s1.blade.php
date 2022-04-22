<!-- 默认缓载图片 -->
<!-- 专题模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>







    <!-- 推荐的商品 _start -->
    <div class="w1210 topic-tab" style='background-color: #FFC63E; '>

        <ul class="tabs-nav">
            @for($i=1; $i <= 4; $i++)

                <li @if($i == 1) class="tabs-selected" @endif>
                    @if($tpl_name != '' && $is_design)
                        <a title="编辑" class="selector goods-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="{{ $i }}" data-type="2" data-number="4" data-goods_open_title="1" data-width="980">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                    @endif

                    <i class="arrow"></i>
                    <h3>{{ $ext_info['cat'][$i] ?? '添加商品'}}</h3>
                </li>
            @endfor
            <!-- 当前展示的推荐商品 class="tabs-selected" _end -->
        </ul>


        @for($i=1; $i <= 4; $i++)
            <div class="tabs-panel @if($i > 1) tabs-hide @endif">
                <ul>
                    @for($gi = 0; $gi <= 3; $gi++)
                        @if(@$data['2-'.$i][$gi] != null)
                            <li>
                                <dl>
                                    <dt class="goods-thumb">
                                        <a target="" href="{{ route('pc_show_goods',['goods_id'=>$data['2-'.$i][$gi]['goods_id']]) }}" title="{{ $data['2-'.$i][$gi]['goods_name'] }}" style="">
                                            <img class="" src="{{ get_image_url($data['2-'.$i][$gi]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original="{{ get_image_url($data['2-'.$i][$gi]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $data['2-'.$i][$gi]['goods_name'] }}" style="display: inline;">
                                        </a>
                                    </dt>
                                    <dd class="goods-info">
                                        <a target="" href="{{ route('pc_show_goods',['goods_id'=>$data['2-'.$i][$gi]['goods_id']]) }}" title="{{ $data['2-'.$i][$gi]['goods_name'] }}" class="goods-name">{{ $data['2-'.$i][$gi]['goods_name'] }}</a>
                                        <p class="goods-price">活动价：￥{{ $data['2-'.$i][$gi]['goods_price'] }}</p>
                                        <a target="" href="{{ route('pc_show_goods',['goods_id'=>$data['2-'.$i][$gi]['goods_id']]) }}" title="立即抢购" class="topic-add-cart">立即抢购</a>
                                    </dd>
                                </dl>
                            </li>
                        @else
                            <li>
                                <dl>
                                    <dt class="goods-thumb">
                                        <a href="javascript:void(0);" title="商品名称" class="example-text special">
    <span>
    示例产品
    <br>
    【280*280】
    </span>
                                        </a>
                                    </dt>
                                    <dd class="goods-info">
                                        <a href="javascript:;" title="商品名称" class="goods-name">商品名称</a>
                                        <p class="goods-price">活动价：￥0.00</p>
                                        <a href="javascript:void(0);" title="立即抢购" class="topic-add-cart">立即抢购</a>
                                    </dd>
                                </dl>
                            </li>
                        @endif
                    @endfor
                </ul>
            </div>
        @endfor


    </div>
    <!-- 推荐的商品 _end -->


</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.handle').prepend('<button type="button" class="decor-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1"><i class="fa fa-arrow-circle-o-up"></i>设置</button>');
</script>
@endif

<script type="text/javascript">
    $(function() {
        //首页Tab标签卡滑门切换
        $("#{{ $uid }}").find(".tabs-nav > li > h3").bind('mouseover', (function(e) {
            if (e.target == this) {
                var tabs = $(this).parent().parent().children("li");
                var panels = $(this).parent().parent().parent().children(".tabs-panel");
                var index = $.inArray(this, $(this).parent().parent().find("h3"));

                if (panels.eq(index)[0]) {

                    tabs.removeClass("tabs-selected").eq(index).addClass("tabs-selected");
                    var color = $(this).parents(".floor:first").attr("color");
                    $(this).parents(".tabs-nav").find("h3").css({
                        "border-color": "",
                    });
                    $(this).css({
                        "border-color": color + " " + color + " #fff",
                    });
                    panels.addClass("tabs-hide").eq(index).removeClass("tabs-hide");
                }
            }
        }));

    });
</script>