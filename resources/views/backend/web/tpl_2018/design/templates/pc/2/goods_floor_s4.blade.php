<!-- 默认缓载图片 -->
<!-- 前台首页楼层模板 -->
@if($is_design)
    <div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

        <!-- 楼层 _star -->
        <!-- 楼层颜色 -->

        <div class="w1210 floor-list">
            <div class="floor" floor="5" color="{{ @$data['99-1'][0]['bgcolor'] != null ? $data['99-1'][0]['bgcolor'] : '#8ed515' }}">
                <div class="floor-layout">
                    <div class="floor-con floor-con4">
                        <div class="floor-title">
                            <h2>

                                @if(!empty($data['4-1']))
                                    @foreach($data['4-1'] as $v)
                                        <span class="floor-name SZY-FLOOR-NAME"> {{ $v['floor_name'] }} </span>
                                        <a href="javascript:void(0)" style="color:{{ $v['color'] }};">{{ $v['name'] }}</a>
                                        <input type="hidden" value="{{ $v['short_name'] }}" class="SZY-SHORT-NAME">
                                    @endforeach
                                @else
                                    <a target="_blank" href="javascript:;">添加楼层标题</a>
                                @endif


                                @if($tpl_name != '' && $is_design)
                                    <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_short_name="1" data-title_open_colorpicker="1" data-title_open_link="1" data-title_is_floor="1">
                                        <i class="fa fa-edit"></i>
                                        编辑
                                    </a>
                                @endif


                            </h2>
                            <div class="hot-word-con">


                                @if(!empty($data['6-2']))
                                    @foreach($data['6-2'] as $v)
                                        <a class="hot-word" href="{{ route('pc_goods_list', ['cat_id'=>$v['cat_id']]) }}" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                                    @endforeach
                                @else
                                    @for($i=1; $i <= 5; $i++)
                                        <a class="hot-word" href="javascript:void(0)">添加分类</a>
                                    @endfor
                                @endif

                                @if($tpl_name != '' && $is_design)
                                    <a class="selector category-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="6" data-number="5">
                                        <i class="fa fa-edit"></i>
                                        编辑
                                    </a>
                                @endif

                            </div>
                        </div>
                        <div class="floor-content floor-content4">
                            <div class="floor-left">
                                <div class="floor-left-con">
                                    <div class="floor-left-up">


                                        @if(!empty($data['3-1']))
                                            @foreach($data['3-1'] as $v)
                                                <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                                                    <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: inline;">
                                                </a>
                                            @endforeach
                                        @else
                                            <a href="javascript:void(0)" class="example-text floor-special full-size">
                                                <span>
                                                此处添加
                                                <br>
                                                【178*440】图片
                                                </span>
                                            </a>
                                        @endif

                                        @if($tpl_name != '' && $is_design)
                                            <a class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="1">
                                                <i class="fa fa-edit"></i>
                                                编辑
                                            </a>
                                        @endif




                                    </div>
                                    <div class="floor-left-down">
                                        <div class="floor-left-bg"></div>
                                        <div class="floor-left-category clearfix">

                                            @if(!empty($data['6-1']))
                                                @foreach($data['6-1'] as $v)
                                                    <a href="{{ route('pc_goods_list', ['cat_id'=>$v['cat_id']]) }}" target="" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                                                @endforeach
                                            @else
                                                @for($i=1; $i <= 10; $i++)
                                                    <a href="javascript:void(0)" class="floor-goods-category">添加分类</a>
                                                @endfor
                                            @endif

                                        </div>

                                        @if($tpl_name != '' && $is_design)
                                            <a class="selector category-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="6" data-number="10">
                                                <i class="fa fa-edit"></i>
                                                编辑
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="floor-banner SZY-FLOOR-FOCUS">
                                    <ul>

                                        @if(!empty($data['3-2']))
                                            @foreach($data['3-2'] as $v)
                                                <li>
                                                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                                                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: inline;">
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            @for($i=1; $i <= 3; $i++)
                                                <li>
                                                    <a href="javascript:void(0)" class="example-text dark">
                                                        <span>此处添加【270*440】图片</span>
                                                    </a>
                                                </li>
                                            @endfor
                                        @endif

                                    </ul>

                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="3">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="floor-right">



                                <div class="floor-tabs-panel">

                                    @if(!empty($data['2-1']))
                                        @foreach($data['2-1'] as $v)
                                            <div class="item">
                                                <div class="wrap">
                                                    <a target="" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" style="">
                                                        <img class="" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220/format,webp/quality,q_75" alt="{{ $v['goods_name'] }}" style="width: 140px; height: 140px; display: block;">
                                                    </a>
                                                    <p class="title">
                                                        <a target="" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}">{{ $v['goods_name'] }}</a>
                                                    </p>
                                                    <p class="price">
                                                        <span class="second-color">￥{{ $v['goods_price'] }}</span>
                                                    </p>
                                                    <a class="add-cart" style="background-image: url({{ get_cart_image() }})" title="加入购物车" data-goods_id="{{ $v['goods_id'] }}" data-image_url="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 8; $i++)
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
                                                        <a href="javascript:void(0);" title="">商品名称</a>
                                                    </p>
                                                    <p class="price">
                                                        <span class="second-color">￥0.00</span>
                                                    </p>
                                                    <a class="add-cart" style="background-image: url({{ get_cart_image() }})" title="加入购物车"></a>
                                                </div>
                                            </div>
                                        @endfor
                                    @endif

                                </div>

                                @if($tpl_name != '' && $is_design)
                                    <a class="selector goods-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="8" data-width="980">
                                        <i class="fa fa-edit"></i>
                                        编辑
                                    </a>
                                @endif

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
@endif

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