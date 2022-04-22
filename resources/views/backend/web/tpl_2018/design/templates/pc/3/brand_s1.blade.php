<!-- 默认缓载图片 -->
<!-- 前台首页楼层模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <div class="w1210">
        <div class="floors-brand" color=''>
            <div class="floor-layout">
                <div class="floor-con">
                    <div class="floor-brand">

                        @if($tpl_name != '' && $is_design)
                            <a title="编辑" class="selector brand-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="5" data-number="15">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>
                        @endif

                        <div class="tabs-brand">
                            <div class="brand">
                                <div class="brand-con">
                                    <ul class="brand-list" style="position: absolute; width: 1210px; height: 40px; top: 0px; left: 1px;">

                                        @if(!empty($data['5-1']))
                                            @foreach($data['5-1'] as $v)
                                                <li class="fore1">
                                                    <a href="{{ route('pc_goods_list', ['filter_str' => '0-0-0-0-0-0-0-0-0-0-0-'.$v['brand_id']]) }}" target="" title="{{ $v['brand_name'] }}">
                                                        <img class="" src="{{ get_image_url($v['brand_logo']) }}" data-original="{{ get_image_url($v['brand_logo']) }}" width="100" height="40" alt="{{ $v['brand_name'] }}" style="display: inline;">
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            @for($i=1; $i <= 12; $i++)
                                                <li>
                                                    <a href="javascript:void(0)" class="example-text white">
                                                        <span>添加品牌</span>
                                                    </a>
                                                </li>
                                            @endfor
                                        @endif

                                    </ul>
                                    <div class="brand-btn">
                                        <a class="brand-left" href="javascript:void(0)"><</a>
                                        <a class="brand-right" href="javascript:void(0)">></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- 1楼 _end-->
    </div>
    <!-- 楼层 _end -->

</div>


<script type="text/javascript">
    $(function() {
// 楼层品牌切换效果 注意：依赖于 js/index_tab.js
        $("#{{ $uid }}").find(".brand-con").hover(function() {
            var num = $(this).find("li").length;
            if (num > 10) {
                $(this).find(".brand-btn").fadeTo('fast', 0.4);
            }
        }, function() {
            $(this).find(".brand-btn").fadeTo('fast', 0);
        });

        $("#{{ $uid }}").find('.tabs-brand').each(function() {
            var num = 0;
            var shu = 10;
            var llishu = $(this).find(".brand-list").first().children().length;
            var liwidth = $(this).find(".brand-list").children().width();
            var boxwidth = llishu * liwidth;
            var shuliang = llishu - shu;
            $(this).find('.brand-right').click(function() {
                $(this).parents(".brand-con").find(".brand-list").css('width', boxwidth + 'px');
                num++;
                if (num > shuliang) {
                    num = shuliang;
                }
                var move = -liwidth * num;
                $(this).closest($(this).parents(".brand")).find(".brand-list").stop().animate({
                    'left': move + 'px'
                }, 500);
            })
            $(this).find('.brand-left').click(function() {
                $(this).parents(".brand-con").find(".brand-list").css('width', '' + boxwidth + 'px');
                num--;
                if (num < 0) {
                    num = 0;
                }
                var move = -liwidth * num;
                $(this).closest($(this).parents(".brand")).find(".brand-list").stop().animate({
                    'left': move + 'px'
                }, 500);
            })

        });
    });
</script>