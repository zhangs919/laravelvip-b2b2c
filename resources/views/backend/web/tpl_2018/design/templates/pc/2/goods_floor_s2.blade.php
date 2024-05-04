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
        <div class="floor">
            <div class="floor-con2 floor-title">

                <h2>
                    @if(!empty($data['4-1']))
                        @foreach($data['4-1'] as $v)
                            <i class="color-mark" style="background-color: {{ $v['color'] ?? '#8ed515' }}; "></i>
                            <span class="floor-name hide SZY-FLOOR-NAME"> {{ $v['floor_name'] }} </span>
                            <a href="javascript:void(0)" class="floor-name" style="color:{{ $v['color'] }};">{{ $v['name'] }}</a>
                            <input type="hidden" value="{{ $v['short_name'] }}" class="SZY-SHORT-NAME">
                        @endforeach
                    @else
                        <i class="color-mark" style='background-color: {{ $bg_color }}; '></i>
                        <a href="javascript:void(0);">添加楼层标题</a>
                    @endif

                    @if($tpl_name != '' && $is_design)
                        <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" style="margin-top: -5px;" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_short_name="1" data-title_open_colorpicker="1" data-title_open_link="1" data-title_is_floor="1">
                            <i class="fa fa-edit"></i>编辑
                        </a>
                    @endif
                </h2>

                <div class="line-body">
                    <div class="hot-word-con">

                        @if(!empty($data['6-1']))
                            @foreach($data['6-1'] as $v)
                                <a class="hot-word" target="" href="{{ $v['link'] }}" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                            @endforeach
                        @else
                            @for($i=1; $i <= 3; $i++)
                                <a class="hot-word" href="javascript:void(0)">添加分类</a>
                            @endfor
                        @endif

                        @if($tpl_name != '' && $is_design)
                            <a class="selector category-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="6" data-number="8">
                                <i class="fa fa-edit"></i>编辑
                            </a>
                        @endif


                    </div>
                    <div class="floor-con" style='border-color: {{ $bg_color }} '>
                        <div class="big-banner-con">
                            <div class="big-banner">

                                @if(!empty($data['3-1']))
                                    @foreach($data['3-1'] as $v)
                                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="big-banner-img" style="">
                                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: block;">
                                        </a>
                                    @endforeach
                                @else
                                    <a href="javascript:void(0);" class="big-banner-img example-text dark">
                                        <span>此处添加【245*441】图片</span>
                                    </a>
                                @endif


                            </div>

                            @if($tpl_name != '' && $is_design)
                                <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="1">
                                    <i class="fa fa-edit"></i>编辑
                                </a>
                            @endif

                        </div>
                        <div class="middle-column-con">


                            @if(!empty($data['3-2']))
                                @foreach($data['3-2'] as $v)
                                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="grid one-grid" style="">
                                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: block;">
                                    </a>
                                @endforeach
                            @else
                                @for($i=1; $i <= 6; $i++)
                                    <a class="grid one-grid example-text" href="javascript:void(0)">
                                        <span>此处添加【240*220】图片</span>
                                    </a>
                                @endfor
                            @endif



                            @if($tpl_name != '' && $is_design)
                                <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="6">
                                    <i class="fa fa-edit"></i>编辑
                                </a>
                            @endif

                        </div>
                        <div class="right-column-con">


                            @if(!empty($data['3-3']))
                                @foreach($data['3-3'] as $v)
                                    <a class="grid second-grid" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: block;">
                                    </a>
                                @endforeach
                            @else
                                @for($i=1; $i <= 3; $i++)
                                    <a class="grid second-grid example-text" href="javascript:void(0)">
                                        <span>此处添加【239*146】图片</span>
                                    </a>
                                @endfor
                            @endif



                            @if($tpl_name != '' && $is_design)
                                    <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="3" data-type="3" data-number="3">
                                        <i class="fa fa-edit"></i>编辑
                                    </a>
                            @endif



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 楼层 _end -->


</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>样式</div></a>');
</script>
@endif
