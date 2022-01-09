<!-- 默认缓载图片 -->
<!-- 前台首页楼层模板 -->
{{--背景颜色--}}
@php
    $bg_color = @$data['99-1'][0]['bgcolor'] != null ? $data['99-1'][0]['bgcolor'] : '#8ed515';
@endphp

@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!-- 楼层 _star -->
    <!-- 楼层颜色 -->

    <div class="w1210 floor-list">
        <div class="floor" color='{{ $bg_color }}'>
            <div class="floor-layout">
                <div class="floor-con floor-con5">
                    <div class="floor-title">
                        <h2>

                            @if(!empty($data['4-1']))
                                @foreach($data['4-1'] as $v)
                                    <span class="floor-name SZY-FLOOR-NAME"> {{ $v['floor_name'] }} </span>
                                    <a href="javascript:void(0)" style="color:{{ $v['color'] }};">{{ $v['name'] }}</a>
                                    <input type="hidden" value="{{ $v['short_name'] }}" class="SZY-SHORT-NAME">
                                @endforeach
                            @else
                                <a target="_blank" href="javascript:void(0);">添加楼层标题</a>
                            @endif

                            @if($tpl_name != '' && $is_design)
                                <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_short_name="1" data-title_open_colorpicker="1" data-title_open_link="1" data-title_is_floor="1">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif


                        </h2>

                        <ul class="floor-tabs-nav">

                            {{--广告tab 标题--}}
                            <li class="floor-tabs-selected">

                                @if($tpl_name != '' && $is_design)
                                    <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="4" data-width="650">
                                        <i class="fa fa-edit"></i>
                                        编辑
                                    </a>
                                @endif

                                @if(!empty($data['4-2']))
                                    @foreach($data['4-2'] as $v)
                                        <h3 style='border-color: {{ $bg_color }} {{ $bg_color }} #fff; color: {{ $bg_color }};'>

                                            {{ $v['name'] }}

                                        </h3>
                                    @endforeach
                                @else
                                    <h3 style='border-color: {{ $bg_color }} {{ $bg_color }} #fff; color: {{ $bg_color }};'>

                                        添加标题

                                    </h3>
                                @endif

                            </li>

                            {{--商品tab 标题--}}
                            @for($i=1; $i <= 3; $i++)

                                <li>

                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector goods-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="{{ $i }}" data-type="2" data-number="6" data-goods_open_title="1" data-width="980">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                    <h3>{{ $ext_info['cat'][$i] ?? '添加商品'}}</h3>
                                </li>

                            @endfor


                        </ul>

                    </div>
                    
                    <div class="floor-content floor-content5" style='border-top: 1px {{ $bg_color }} solid;'>
                        <div class="floor-left">
                            <div class="floor-suspend">

                                @if($tpl_name != '' && $is_design)
                                    <a href="javascript:void(0)" title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="1">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                    </a>
                                @endif
                                
                                @if(!empty($data['3-1']))
                                    @foreach($data['3-1'] as $v)
                                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="floor-suspend-img" style="">
                                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" width="210" height="485" style="display: inline;">
                                        </a>
                                    @endforeach
                                @else
                                    <a href="javascript:void(0)" class="floor-suspend-img example-text floor-special dark">
                                        <span>
                                        此处添加
                                        <br>
                                        【210*485】图片
                                        </span>
                                    </a>
                                @endif


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
                                            <a href="{{ route('pc_goods_list', ['cat_id'=>$v['cat_id']]) }}" target="" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                                        </li>
                                    @endforeach
                                @else
                                    @for($i=1; $i <= 8; $i++)
                                        <li>
                                            <a href="javascript:void(0)" title="添加分类">添加分类</a>
                                        </li>
                                    @endfor
                                @endif


                            </ul>
                        </div>
                        <div class="floor-middle">
                            <div class="floor-banner">

                                @if($tpl_name != '' && $is_design)
                                    <a href="javascript:void(0)" title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="3">
                                        <i class="fa fa-edit"></i>
                                        编辑
                                    </a>
                                @endif

                                <ul class="hiSlider SZY-FLOOR-HISLIDER">

                                    @if(!empty($data['3-2']))
                                        @foreach($data['3-2'] as $v)
                                            <li class="hiSlider-item">
                                                <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" >
                                                    <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['path']) }}" width="390" height="485" />
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 2; $i++)
                                            <li class="hiSlider-item example-text">
                                                <a href="javascript:void(0)">
                                                    <span>此处添加【390*485】图片</span>
                                                </a>
                                            </li>
                                        @endfor
                                    @endif
                                </ul>

                            </div>
                        </div>
                        <div class="floor-right">
                            <!-- 第一屏广告 _start -->
                            <div class="floor-tabs-panel">
                                <div class="floor-tabs-suspend-up">

                                    @if($tpl_name != '' && $is_design)
                                        <a href="javascript:void(0)" title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="3" data-type="3" data-number="3">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                    @if(!empty($data['3-3']))
                                        @foreach($data['3-3'] as $k=>$v)
                                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="floor-tabs-suspend-img @if($k == 0) first @endif" style="">
                                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: inline;">
                                            </a>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 3; $i++)
                                            <a href="javascript:void(0)" class="floor-tabs-suspend-img  @if($i == 1) first @endif example-text special dark">
                                                <span>
                                                此处添加
                                                <br>
                                                【202*300】图片
                                                </span>
                                            </a>
                                        @endfor
                                    @endif


                                </div>
                                <div class="floor-tabs-suspend-down">

                                    @if($tpl_name != '' && $is_design)
                                        <a href="javascript:void(0)" title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="4" data-type="3" data-number="2">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                    @if(!empty($data['3-4']))
                                        @foreach($data['3-4'] as $k=>$v)
                                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="floor-tabs-suspend-img @if($k == 0) first @endif">
                                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: inline;">
                                            </a>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 2; $i++)
                                            <a href="javascript:void(0)" class="floor-tabs-suspend-img @if($i == 1) first @endif example-text dark">
                                                <span>此处添加【303*185】图片</span>
                                            </a>
                                        @endfor
                                    @endif

                                </div>
                            </div>
                            <!-- 第一屏广告 _end -->


                            @for($i=1; $i <= 3; $i++)
                                <div class="floor-tabs-panel floor-tabs-hide">

                                    @for($gi = 0; $gi < 8; $gi++)
                                        @if(@$data['2-'.$i][$gi] != null)
                                            <div class="item">
                                                <div class="wrap">
                                                    <a target="" href="{{ route('pc_show_goods',['goods_id'=>$data['2-'.$i][$gi]['goods_id']]) }}" title="{{ $data['2-'.$i][$gi]['goods_name'] }}" style="background: url({{ get_image_url(sysconf('default_lazyload')) }}) no-repeat center center">
                                                        <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($data['2-'.$i][$gi]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="{{ $data['2-'.$i][$gi]['goods_name'] }}" style="width: 140px; height: 140px;">
                                                    </a>
                                                    <p class="title">
                                                        <a href="{{ route('pc_show_goods',['goods_id'=>$data['2-'.$i][$gi]['goods_id']]) }}" title="{{ $data['2-'.$i][$gi]['goods_name'] }}">{{ $data['2-'.$i][$gi]['goods_name'] }}</a>
                                                    </p>
                                                    <p class="price">
                                                        <span class="second-color">￥{{ $data['2-'.$i][$gi]['goods_price'] }}</span>
                                                    </p>
                                                    <a href="javascript:void(0)" class="add-cart" style="background-image: url({{ get_cart_image() }})" title="加入购物车"></a>
                                                </div>
                                            </div>

                                        @else
                                            <div class="item">
                                                <div class="wrap">
                                                    <a href="javascript:void(0);" title="商品名称">
                                                        <img src="/assets/d2eace91/images/design/example/goods_img_140_140.jpg" alt="" height="140" width="140">
                                                    </a>
                                                    <p class="title">
                                                        <a href="javascript:void(0);" title="商品名称">商品名称</a>
                                                    </p>
                                                    <p class="price">
                                                        <span class="second-color">￥0.00</span>
                                                    </p>
                                                    <a href="javascript:void(0)" class="add-cart" style="background-image: url({{ get_cart_image() }})" title="加入购物车"></a>
                                                </div>
                                            </div>
                                        @endif
                                    @endfor

                                </div>
                            @endfor


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 楼层 _end -->

@if($is_design)
</div>
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>样式</div></a>');
</script>


<script type="text/javascript">
    $(function() {
        var sWidth = $("#focus_3").width(); //获取焦点图的宽度（显示面积）
        var len = $("#focus_3 ul li").length; //获取焦点图个数
        var index = 0;
        var picTimer;
//以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
        var btn = "<div class='focus-btn'>";

        for (var i = 0; i < len; i++) {
            btn += "<span></span>";
        }
        btn += "</div>";
        $("#focus_3").append(btn);
        $("#focus_3 .btnBg").css("opacity", 0.5);

//为小按钮添加鼠标滑入事件，以显示相应的内容
        $("#focus_3 .focus-btn span").css("opacity", 0.3).mouseover(function() {
            index = $("#focus_3 .focus-btn span").index(this);
            showPics(index);
        }).eq(0).trigger("mouseover");

//本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
        $("#focus_3 ul").css("width", sWidth * (len));

//鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
        $("#focus_3").hover(function() {
            clearInterval(picTimer);
        }, function() {
            picTimer = setInterval(function() {
                showPics(index);
                index++;
                if (index == len) {
                    index = 0;
                }
            }, 3000); //此4000代表自动播放的间隔，单位：毫秒
        }).trigger("mouseleave");

//显示图片函数，根据接收的index值显示相应的内容
        function showPics(index) { //普通切换
            var nowLeft = -index * sWidth; //根据index值计算ul元素的left值
            $("#focus_3 ul").stop(true, false).animate({
                "left": nowLeft
            }, 300);
            $("#focus_3 .focus-btn span").stop(true, false).animate({
                "opacity": "0.3"
            }, 300).eq(index).stop(true, false).animate({
                "opacity": "0.7"
            }, 300); //为当前的按钮切换到选中的效果
        }
    });
</script>

<script type="text/javascript">
    //楼层广告切换效果 注意：依赖于 js/jquery.hiSlider.js
    $("#{{ $uid }}").find('.SZY-FLOOR-HISLIDER').hiSlider();
</script>
<script type="text/javascript">
    //首页楼层Tab标签卡滑门切换
    $(function() {
        $("#{{ $uid }}").find(".floor-tabs-nav > li").bind('mouseover', (function(e) {
            var color = $(this).parents(".floor").attr("color");
            $(this).addClass('floor-tabs-selected').siblings().removeClass('floor-tabs-selected');
            $(this).find('h3').css({
                "border-color": color + " " + color + " #fff",
                "color": color
            }).parents('li').siblings('li').find('h3').css({
                "border-color": "",
                "color": ""
            });
            $(this).parents('.floor-con').find('.floor-tabs-panel').eq($(this).index()).removeClass('floor-tabs-hide').siblings().addClass('floor-tabs-hide');
        }));
    });
</script>
@endif