<!-- 默认缓载图片 -->
<!-- 前台首页楼层模板 -->
<!-- 判断url链接 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 楼层 _star -->
    <!-- 楼层颜色 -->

    <div class="w1210 floor-list"
         data-floor_name="@if(!empty($data['4-1'])){{ $data['4-1'][0]['floor_name'] }}@endif" data-short_name="@if(!empty($data['4-1'])){{ $data['4-1'][0]['short_name'] }}@endif">
        <div class="floor">

            <h2 class="floor-title3 floor-title">

                @if(!empty($data['4-1']))
                    @foreach($data['4-1'] as $v)
                        <span class="floor-name hide SZY-FLOOR-NAME"> {{ $v['floor_name'] }} </span>
                        <a href="javascript:void(0)" class="floor-name" style="color:{{ $v['color'] }};">{{ $v['name'] }}</a>
                        <input type="hidden" value="{{ $v['short_name'] }}" class="SZY-SHORT-NAME">
                    @endforeach
                @else
                    <a href="javascript:void(0);" class="floor-name">添加楼层标题</a>
                @endif

                @if($tpl_name != '' && $is_design)
                    <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_short_name="1" data-title_open_colorpicker="1" data-title_open_link="1" data-title_is_floor="1">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif
            </h2>
            <div class="floor-con3">
                <div class="floor-ad3">
                    <div class="first">

                        @if(!empty($data['3-1']))
                            @foreach($data['3-1'] as $v)
                                <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                                    <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: inline;">
                                </a>
                            @endforeach
                        @else
                            <a href="javascript:void(0)" class="example-text full-size">
                                <span>此处添加【595*285】图片</span>
                            </a>
                        @endif

                        @if($tpl_name != '' && $is_design)
                            <a class="selector selector1 pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="1">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>
                        @endif
                    </div>
                    <div class="up-three-ad">


                        @if(!empty($data['3-2']))
                            @foreach($data['3-2'] as $v)
                                <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="three-ad" style="">
                                    <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: inline;">
                                </a>
                            @endforeach
                        @else
                            @for($i=1; $i <= 3; $i++)
                                <a href="javascript:void(0)" class="three-ad example-text special">
                                    <span>
                                    此处添加
                                    <br>
                                    【195*285】图片
                                    </span>
                                </a>
                            @endfor
                        @endif


                        @if($tpl_name != '' && $is_design)
                            <a class="selector selector2 pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="3">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>
                        @endif
                    </div>
                </div>
                <div class="floor-goods3">
                    <div class="floor-category3">

                        @if(!empty($data['6-1']))
                            @foreach($data['6-1'] as $v)
                                <a href="{{ $v['link'] }}" target="_blank" class="floor-goods-category">{{ $v['cat_name'] }}</a>
                            @endforeach
                        @else
                            @for($i=1; $i <= 15; $i++)
                                <a href="javascript:void(0)" class="floor-goods-category">商品分类</a>
                            @endfor
                        @endif

                        @if($tpl_name != '' && $is_design)
                            <a class="selector category-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="6" data-number="15">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>
                        @endif
                    </div>
                    <div class="down-three-ad">


                        @if(!empty($data['3-3']))
                            @foreach($data['3-3'] as $v)
                                <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="ad" style="">
                                    <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: inline;">
                                </a>
                            @endforeach
                        @else
                            @for($i=1; $i <= 3; $i++)
                                <a href="javascript:void(0)" class="ad example-text special">
                                    <span>
                                    此处添加
                                    <br>
                                    【297*220】图片
                                    </span>
                                </a>
                            @endfor
                        @endif


                        @if($tpl_name != '' && $is_design)
                            <a class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="3" data-type="3" data-number="3">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 楼层 _end -->

</div>


