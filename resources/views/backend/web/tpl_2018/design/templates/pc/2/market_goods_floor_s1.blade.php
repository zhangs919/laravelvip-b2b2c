<!-- 默认缓载图片 -->
<!-- 前台首页楼层模板 -->
<!-- 判断url链接 -->
{{--背景颜色--}}
@php
	$bg_color = !empty($data['99-1'][0]['bgcolor']) ? $data['99-1'][0]['bgcolor'] : '#8ed515';
@endphp

<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 楼层 _star -->
    <!-- 楼层颜色 -->

    <div class="w1210 floor-list"
         data-floor_name="@if(!empty($data['4-1'])){{ $data['4-1'][0]['floor_name'] }}@endif" data-short_name="@if(!empty($data['4-1'])){{ $data['4-1'][0]['short_name'] }}@endif">
        <!-- 1楼 _start-->
        <div class="floor" color='{{ $bg_color }}'>
            <div class="floor-layout">
                <div class="floor-con">
                    <div class="floor-title">
                        <h2>

                            @if(!empty($data['4-1']))
                                @foreach($data['4-1'] as $v)
                                    <span class="floor-name SZY-FLOOR-NAME"> {{ $v['floor_name'] }} </span>
                                    <a href="javascript:void(0)" target="" style="color:{{ $v['color'] }};">{{ $v['name'] }}</a>
                                    <input type="hidden" value="{{ $v['short_name'] }}" class="SZY-SHORT-NAME">
                                @endforeach
                            @else
                                <a href="javascript:void(0);">添加楼层标题</a>
                            @endif


                            @if($tpl_name != '' && $is_design)
                                <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_short_name="1" data-title_open_colorpicker="1" data-title_open_link="1" data-title_is_floor="1">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif
                        </h2>
                    </div>
                    <div class="floor-content">
                        <div class="floor-left" style='border-top: 1px {{ $bg_color }} solid;'>
                            <div class="floor-banner floor-focus SZY-FLOOR-FOCUS">

                                @if($tpl_name != '' && $is_design)
                                    <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="3">
                                        <i class="fa fa-edit"></i>
                                        编辑
                                    </a>
                                @endif


                                <ul>

                                    @if(!empty($data['3-1']))
                                        @foreach($data['3-1'] as $v)
                                            <li>
                                                <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" class="image-lazyload" style="">
                                                    <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" width="270" height="475" style="display: inline;">
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 3; $i++)
                                            <li>
                                                <a href="javascript:void(0);" class="example-text floor-special">
                                                    <span>此处添加【270*475】图片</span>
                                                </a>
                                            </li>
                                        @endfor
                                    @endif

                                </ul>

                            </div>
                            <ul class="floor-words">

                                @if($tpl_name != '' && $is_design)
                                    <a class="selector category-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="6" data-number="8">
                                        <i class="fa fa-edit"></i>
                                        编辑
                                    </a>
                                @endif

                                @if(!empty($data['6-1']))
                                    @foreach($data['6-1'] as $v)
                                        <li>
                                            <a href="{{ $v['link'] }}" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                                        </li>
                                    @endforeach
                                @else
                                    @for($i=1; $i <= 8; $i++)
                                        <li>
                                            <a href="javascript:void(0);" title="商品分类">商品分类</a>
                                        </li>
                                    @endfor
                                @endif


                            </ul>
                        </div>
                        <div class="floor-right">

                            @if($tpl_name != '' && $is_design)
                                <a class="selector goods-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="8" data-width="980">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif

                            <div class="floor-tabs-panel " style='border-top: 1px {{ $bg_color }} solid;'>

                                @for($i=0; $i <= 7; $i++)
                                    @if(!empty($data['2-1'][$i]))
                                        <div class="item">
                                            <div class="wrap">
                                                <a target="" href="{{ route('pc_show_goods',['goods_id'=>$data['2-1'][$gi]['goods_id']]) }}" title="{{ $data['2-1'][$i]['goods_name'] }}" style="">
                                                    <img class="" src="{{ get_image_url($data['2-1'][$i]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original="{{ get_image_url($data['2-1'][$i]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="{{ $data['2-1'][$i]['goods_name'] }}" style="width: 140px; height: 140px; display: block;">
                                                </a>
                                                <p class="title">
                                                    <a target="" href="{{ route('pc_show_goods',['goods_id'=>$data['2-1'][$gi]['goods_id']]) }}" title="{{ $data['2-1'][$i]['goods_name'] }}">{{ $data['2-1'][$i]['goods_name'] }}</a>
                                                </p>
                                                <p class="price">
                                                    <span class="second-color">￥{{ $data['2-1'][$i]['goods_price'] }}</span>
                                                </p>
                                                <a class="add-cart" style="background-image: url({{ get_cart_image() }})" title="加入购物车" data-goods_id="{{ $data['2-1'][$i]['goods_id'] }}" data-image_url="{{ get_image_url($data['2-1'][$i]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"></a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="item">
                                            <div class="wrap">
                                                <a href="javascript:;" title="" class="example-text special">
<span>
示例产品
<br>
【140*140】
</span>
                                                </a>
                                                <p class="title">
                                                    <a href="javascript:;" title="">商品名称</a>
                                                </p>
                                                <p class="price">
                                                    <span>￥0.00</span>
                                                </p>
                                                <a class="add-cart" style="background-image: url({{ get_cart_image() }})" title="加入购物车"></a>
                                            </div>
                                        </div>
                                    @endif
                                @endfor


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 1楼 _end-->
    </div>
    <!-- 楼层 _end -->



@if($is_design)
    <div class="operateEdit" style="right: 157px">
        <a class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid='{{ $uid }}' data-cat_id='1' data-type='99' data-style_colorpicker='1'>
            <div class="selector-box">
                <div class="arrow"></div>
                <i class="fa fa-arrow-circle-o-up"></i>
                样式
            </div>
        </a>
    </div>
@endif

</div>


<script type="text/javascript">
    {{--$(function() {--}}
        {{--var $floor_focus = $("#{{ $uid }}").find(".SZY-FLOOR-FOCUS");--}}
        {{--var sWidth = $floor_focus.width();--}}
        {{--var len = $floor_focus.find("ul li").length; //获取焦点图个数--}}
        {{--var index = 0;--}}
        {{--var picTimer;--}}
{{--//以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮--}}
        {{--var btn = "<div class='focus-btn'>";--}}

        {{--for (var i = 0; i < len; i++) {--}}
            {{--btn += "<span></span>";--}}
        {{--}--}}
        {{--btn += "</div>";--}}
        {{--$floor_focus.append(btn);--}}
        {{--$floor_focus.find(".btnBg").css("opacity", 0.5);--}}

{{--//为小按钮添加鼠标滑入事件，以显示相应的内容--}}
        {{--$floor_focus.find(".focus-btn span").css("opacity", 0.3).mouseover(function() {--}}
            {{--index = $floor_focus.find(".focus-btn span").index(this);--}}
            {{--showPics(index);--}}
        {{--}).eq(0).trigger("mouseover");--}}

{{--//本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度--}}
        {{--$floor_focus.find("ul").css("width", sWidth * (len));--}}

{{--//鼠标滑上焦点图时停止自动播放，滑出时开始自动播放--}}
        {{--$floor_focus.hover(function() {--}}
            {{--clearInterval(picTimer);--}}
        {{--}, function() {--}}
            {{--picTimer = setInterval(function() {--}}
                {{--showPics(index);--}}
                {{--index++;--}}
                {{--if (index == len) {--}}
                    {{--index = 0;--}}
                {{--}--}}
            {{--}, 3000); //此4000代表自动播放的间隔，单位：毫秒--}}
        {{--}).trigger("mouseleave");--}}

{{--//显示图片函数，根据接收的index值显示相应的内容--}}
        {{--function showPics(index) { //普通切换--}}
            {{--var nowLeft = -index * sWidth; //根据index值计算ul元素的left值--}}
            {{--$floor_focus.find("ul").stop(true, false).animate({--}}
                {{--"left": nowLeft--}}
            {{--}, 300);--}}
            {{--$floor_focus.find(".focus-btn span").stop(true, false).animate({--}}
                {{--"opacity": "0.3"--}}
            {{--}, 300).eq(index).stop(true, false).animate({--}}
                {{--"opacity": "0.7"--}}
            {{--}, 300); //为当前的按钮切换到选中的效果--}}
        {{--}--}}
    {{--});--}}
</script>
