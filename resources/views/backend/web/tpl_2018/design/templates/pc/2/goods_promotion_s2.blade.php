<!-- 默认缓载图片 -->
<!-- 前台首页促销商品模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 推荐的商品 _start -->
    <div class="w1210 index-sale2">
        <div class="sale2-title-box">
            <h2 class="index-sale-title">

                @if($tpl_name != '' && $is_design)
                    <a href="javascript:void(0)" class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                @if(!empty($data['4-1']))
                    @foreach($data['4-1'] as $v)
                        {{ $v['name'] }}
                    @endforeach
                @else
                    添加标题
                @endif

            </h2>

            <ul class="tabs-nav">
                @for($i=1; $i <= 5; $i++)

                    <li @if($i == 1) class="tabs-selected" @endif>
                        @if($tpl_name != '' && $is_design)
                            <a class="selector goods-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" title="编辑" data-cat_id="{{ $i }}" data-type="2" data-number="5" data-goods_open_title="1" data-width="980">
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

        </div>


        @for($i=1; $i <= 5; $i++)
            <div class="tabs-panel @if($i > 1) tabs-hide @endif">
                <ul>

                    @if(!empty($data['2-'.$i]))
                        @foreach($data['2-'.$i] as $v)
                            <li>
                                <dl>
                                    <dt class="goods-thumb">
                                        <a target="_blank" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" style="">
                                            <img class="" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220/format,webp/quality,q_75" alt="{{ $v['goods_name'] }}" style="display: inline;">
                                        </a>
                                    </dt>
                                    <dd class="goods-info">
                                        <a target="" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" class="goods-name">{{ $v['goods_name'] }}</a>
                                        <em class="goods-price second-color">{{ $v['goods_price'] }}</em>
                                    </dd>
                                </dl>
                            </li>
                        @endforeach
                    @else
                        @for($gi=1; $gi <= 5; $gi++)
                            <li>
                                <dl>
                                    <dt class="goods-thumb">
                                        <a href="javascript:void(0);" title="商品名称" class="example-text special">
                                            <span>示例产品<br>【220*220】</span>
                                        </a>
                                    </dt>
                                    <dd class="goods-info">
                                        <a href="javascript:void(0);" title="商品名称" class="goods-name">商品名称</a>
                                        <em class="goods-price second-color">￥0.00</em>
                                    </dd>
                                </dl>
                            </li>
                        @endfor
                    @endif

                </ul>
            </div>
        @endfor


    </div>
    <!-- 推荐的商品 _end -->

</div>


<script type="text/javascript">
    $(function() {
        //首页Tab标签卡滑门切换
        $("#{{ $uid }}").find(".tabs-nav > li > h3").bind('mouseover', (function(e) {
            if (e.target == this) {
                var tabs = $(this).parent().parent().children("li");
                var panels = $(this).parents().children(".tabs-panel");
                var index = $.inArray(this, $(this).parent().parent().find("h3"));
                if (panels.eq(index)[0]) {
                    tabs.removeClass("tabs-selected").eq(index).addClass("tabs-selected");
                    var color = $(this).parents(".floor:first").attr("color");
                    $(this).parents(".tabs-nav").find("h3").css({
                        "border-color": "",
                        "color": ""
                    });
                    $(this).css({
                        "border-color": color + " " + color + " #fff",
                        "color": color
                    });
                    panels.addClass("tabs-hide").eq(index).removeClass("tabs-hide");
                }
            }
        }));

    });
</script>