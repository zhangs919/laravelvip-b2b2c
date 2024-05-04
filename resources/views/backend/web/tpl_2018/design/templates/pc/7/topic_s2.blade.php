<!-- 默认缓载图片 -->
<!-- 专题商品模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <div class="w1210 topic-goods">

        @if($tpl_name != '' && $is_design)
            <a title="编辑" class="selector goods-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="10" data-width="980">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif
        <div class="tabs-panel">
            <ul>

                @if(!empty($data['2-1']))
                    @foreach($data['2-1'] as $k=>$v)
                        <li @if($k == 0 || $k == 5) class="first" @endif>
                            <dl>
                                <dt class="goods-thumb">
                                    <a target="" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" style="">
                                        <img class="" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $v['goods_name'] }}" style="display: inline;">
                                    </a>
                                </dt>
                                <dd class="goods-info">
                                    <a target="" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" class="goods-name">{{ $v['goods_name'] }}</a>
                                    <p class="goods-price">活动价：￥{{ $v['goods_price'] }}</p>
                                    <a target="" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="立即抢购" class="topic-add-cart">立即抢购</a>
                                </dd>
                            </dl>
                        </li>
                    @endforeach
                @else
                    @for($i=1; $i <= 10; $i++)
                        <li @if($i == 1 || $i == 6) class="first" @endif>
                            <dl>
                                <dt class="goods-thumb">
                                    <a href="javascript:void(0);" title="商品名称" class="example-text special">
                                        <span>示例产品<br>【230*230】</span>
                                    </a>
                                </dt>
                                <dd class="goods-info">
                                    <a href="javascript:;" title="商品名称" class="goods-name">商品名称</a>
                                    <p class="goods-price">活动价：￥0.00</p>
                                    <a href="javascript:void(0);" title="立即抢购" class="topic-add-cart">立即抢购</a>
                                </dd>
                            </dl>
                        </li>
                    @endfor
                @endif

            </ul>
        </div>


    </div>

</div>

<script type="text/javascript">
    {{--$(function() {--}}
        {{--//首页Tab标签卡滑门切换--}}
        {{--$("#{{ $uid }}").find(".tabs-nav > li > h3").bind('mouseover', (function(e) {--}}
            {{--if (e.target == this) {--}}
                {{--var tabs = $(this).parent().parent().children("li");--}}
                {{--var panels = $(this).parent().parent().parent().children(".tabs-panel");--}}
                {{--var index = $.inArray(this, $(this).parent().parent().find("h3"));--}}
                {{--if (panels.eq(index)[0]) {--}}
                    {{--tabs.removeClass("tabs-selected").eq(index).addClass("tabs-selected");--}}
                    {{--var color = $(this).parents(".floor:first").attr("color");--}}
                    {{--$(this).parents(".tabs-nav").find("h3").css({--}}
                        {{--"border-color": "",--}}
                        {{--"color": ""--}}
                    {{--});--}}
                    {{--$(this).css({--}}
                        {{--"border-color": color + " " + color + " #fff",--}}
                        {{--"color": color--}}
                    {{--});--}}
                    {{--panels.addClass("tabs-hide").eq(index).removeClass("tabs-hide");--}}
                {{--}--}}
            {{--}--}}
        {{--}));--}}

    {{--});--}}
</script>