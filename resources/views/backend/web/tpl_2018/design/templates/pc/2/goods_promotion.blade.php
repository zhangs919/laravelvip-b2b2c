<!-- 默认缓载图片 -->
<!-- 前台首页促销商品模板 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!-- 推荐的商品 _start -->
    <div class="w1210 index-sale">

        <ul class="tabs-nav">
            @for($i=1; $i <= 5; $i++)

                <li @if($i == 1) class="tabs-selected" @endif>
                    @if($tpl_name != '' && $is_design)
                        <a class="selector goods-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="{{ $i }}" data-type="2" data-number="5" data-goods_open_title="1" data-width="980">
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



        @for($i=1; $i <= 5; $i++)
            <div class="tabs-panel sale-goods-list @if($i > 1) tabs-hide @endif">
                <ul>

                    @if(!empty($data['2-'.$i]))
                        @foreach($data['2-'.$i] as $v)
                            <li>
                                <dl>
                                    <dt class="goods-name">
                                        <a target="" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}">{{ $v['goods_name'] }}</a>
                                    </dt>
                                    <dd class="goods-thumb">
                                        <a target="_blank" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" style="">
                                            <img class="" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220/format,webp/quality,q_75" alt="{{ $v['goods_name'] }}" style="display: inline;">
                                        </a>
                                    </dd>
                                    <dd class="goods-price">
                                        商城价：
                                        <em class="second-color">￥{{ $v['goods_price'] }}</em>
                                    </dd>
                                </dl>
                            </li>
                        @endforeach
                    @else
                        @for($gi=1; $gi <= 5; $gi++)
                            <li>
                                <dl>
                                    <dt class="goods-name">
                                        <a href="javascript:void(0);" title="商品名称">商品名称</a>
                                    </dt>
                                    <dd class="goods-thumb">
                                        <a href="javascript:void(0);" title="商品名称" class="example-text special">
                                            <span>此处添加<br>【160*160】图片</span>
                                        </a>
                                    </dd>
                                    <dd class="goods-price">
                                        商城价：
                                        <em class="second-color"> ￥0.00</em>
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

@if($is_design)
</div>
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