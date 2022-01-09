<!-- 默认缓载图片 -->
<!-- 前台首页楼层模板 -->
{{--背景颜色--}}
@php
    $bg_color = @$data['4-1'][0]['bgcolor'] != null ? $data['4-1'][0]['bgcolor'] : '';
@endphp

@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!-- 楼层 _start -->
    <div class="w1210 floor-list">
        <div class="floor floor-con6">
            <div class="chn-col">
                <div class="electronic">

                    <div class="floor-title" style='background-color:{{ $bg_color }};'>
                        <h3>

                            @if(!empty($data['4-1']))
                                @foreach($data['4-1'] as $v)
                                    <span class="hide SZY-FLOOR-NAME"> {{ $v['floor_name'] }} </span>
                                    <a href="javascript:void(0)" class="floor-name" style="color:{{ $v['color'] }};">{{ $v['name'] }}</a>
                                    <input type="hidden" value="{{ $v['short_name'] }}" class="SZY-SHORT-NAME">
                                @endforeach
                            @else
                                <a href="javascript:void(0);" class="floor-name">添加楼层标题</a>
                            @endif

                            @if($tpl_name != '' && $is_design)
                                <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_short_name="1" data-title_open_colorpicker="1" data-title_open_link="1" data-title_is_floor="1" data-title_open_bgcolor="1">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif
                        </h3>

                        <div class="title-tags">


                            @if(!empty($data['6-1']))
                                @foreach($data['6-1'] as $v)
                                    <a href="{{ route('pc_goods_list', ['cat_id'=>$v['cat_id']]) }}" target="_blank" class="tags-item" style="border-color:{{ $bg_color }};">{{ $v['cat_name'] }}</a>
                                @endforeach
                            @else
                                @for($i=1; $i <= 5; $i++)
                                    <a href="javascript:void(0)" class="tags-item" style='border-color:{{ $bg_color }};'>商品分类</a>
                                @endfor
                            @endif

                            @if($tpl_name != '' && $is_design)
                                <a class="selector category-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="6" data-number="5">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif

                        </div>
                    </div>
                    <div class="floor-layout">
                        <div class="floor-content6">
                            <div class="floor-img">
                                <div class="floor-img-left">

                                    @if(!empty($data['3-1']))
                                        @foreach($data['3-1'] as $v)
                                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: block;">
                                            </a>
                                        @endforeach
                                    @else
                                        <a href="javascript:void(0)" class="example-text full-size">
                                            <span>此处添加<br>【195*260】图片</span>
                                        </a>
                                    @endif

                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector selector1 pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="1">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif
                                </div>

                                <div class="floor-img-right">
                                    <span class="img-right-line img-right-line-h"></span>
                                    <span class="img-right-line img-right-line-v"></span>

                                    @if(!empty($data['3-2']))
                                        @foreach($data['3-2'] as $v)
                                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="right-item" style="">
                                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: block;">
                                            </a>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 4; $i++)
                                            <a href="javascript:void(0)" class="right-item example-text special">
                                                <span>
                                                此处添加
                                                <br>
                                                【200*130】图片
                                                </span>
                                            </a>
                                        @endfor
                                    @endif

                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector selector2 pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="4">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif
                                </div>
                                <div class="floor-img-down">

                                    @if(!empty($data['3-3']))
                                        @foreach($data['3-3'] as $v)
                                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="down-item" style="">
                                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: block;">
                                            </a>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 3; $i++)
                                            <a href="javascript:void(0)" class="down-item example-text special">
                                                <span>
                                                此处添加
                                                <br>
                                                【195*130】图片
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
                        <div class="floor-con6-brand">

                            @if($tpl_name != '' && $is_design)
                                <a class="selector brand-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="5" data-number="10">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif

                            <div class="tabs-brand">
                                <div class="brand">
                                    <div class="brand-con">
                                        <ul class="brand-list" style="position: absolute; width: 580px; height: 36px; top: 0px; left: 0px;">

                                            @if(!empty($data['5-1']))
                                                @foreach($data['5-1'] as $v)
                                                    <li>
                                                        <a href="{{ route('pc_goods_list', ['filter_str' => '0-0-0-0-0-0-0-0-0-0-0-'.$v['brand_id']]) }}" target="" title="{{ $v['brand_name'] }}">
                                                            <img class="" src="{{ get_image_url($v['brand_logo']) }}" data-original="{{ get_image_url($v['brand_logo']) }}" width="100" height="40" alt="{{ $v['brand_name'] }}" style="display: block;">
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                @for($i=1; $i <= 5; $i++)
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

            <div class="chn-col chn-col-right">
                <div class="electronic">

                    <div class="floor-title" style='background-color:{{ @$data['4-2'][0]['bgcolor'] != null ? $data['4-2'][0]['bgcolor'] : '' }};'>
                        <h3>

                            @if(!empty($data['4-2']))
                                @foreach($data['4-2'] as $v)
                                    <span class="hide SZY-FLOOR-NAME"> {{ $v['floor_name'] ?? '' }} </span>
                                    <a href="javascript:void(0)" class="floor-name" style="color:{{ $v['color'] }};">{{ $v['name'] }}</a>
                                    <input type="hidden" value="{{ $v['short_name'] ?? '' }}" class="SZY-SHORT-NAME">
                                @endforeach
                            @else
                                <a href="javascript:void(0);" class="floor-name">添加楼层标题</a>
                            @endif

                            @if($tpl_name != '' && $is_design)
                                <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="4" data-width="650" data-title_open_colorpicker="1" data-title_open_link="1" data-title_open_bgcolor="1">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif
                        </h3>

                        <div class="title-tags">

                            @if(!empty($data['6-2']))
                                @foreach($data['6-2'] as $v)
                                    <a href="{{ route('pc_goods_list', ['cat_id'=>$v['cat_id']]) }}" target="_blank" class="tags-item" style="border-color:{{ @$data['4-2'][0]['bgcolor'] != null ? $data['4-2'][0]['bgcolor'] : '' }};">{{ $v['cat_name'] }}</a>
                                @endforeach
                            @else
                                @for($i=1; $i <= 5; $i++)
                                    <a href="javascript:void(0)" class="tags-item" style='border-color:{{ @$data['4-2'][0]['bgcolor'] != null ? $data['4-2'][0]['bgcolor'] : '' }};'>商品分类</a>
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
                    <div class="floor-layout">
                        <div class="floor-content6">
                            <div class="floor-img">
                                <div class="floor-img-left">

                                    @if(!empty($data['3-4']))
                                        @foreach($data['3-4'] as $v)
                                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: block;">
                                            </a>
                                        @endforeach
                                    @else
                                        <a href="javascript:void(0)" class="example-text full-size">
                                            <span>此处添加<br>【195*260】图片</span>
                                        </a>
                                    @endif

                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector selector1 pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="4" data-type="3" data-number="1">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif
                                </div>
                                <div class="floor-img-right">
                                    <span class="img-right-line img-right-line-h"></span>
                                    <span class="img-right-line img-right-line-v"></span>

                                    @if(!empty($data['3-5']))
                                        @foreach($data['3-5'] as $v)
                                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="right-item" style="">
                                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: block;">
                                            </a>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 4; $i++)
                                            <a href="javascript:void(0)" class="right-item example-text special">
                                                <span>
                                                此处添加
                                                <br>
                                                【200*130】图片
                                                </span>
                                            </a>
                                        @endfor
                                    @endif

                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector selector2 pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="5" data-type="3" data-number="4">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                </div>
                                <div class="floor-img-down">

                                    @if(!empty($data['3-6']))
                                        @foreach($data['3-6'] as $v)
                                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="down-item" style="">
                                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: block;">
                                            </a>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 3; $i++)
                                            <a href="javascript:void(0)" class="down-item example-text special">
                                                <span>
                                                此处添加
                                                <br>
                                                【195*130】图片
                                                </span>
                                            </a>
                                        @endfor
                                    @endif

                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="6" data-type="3" data-number="3">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="floor-con6-brand">

                            @if($tpl_name != '' && $is_design)
                                <a class="selector brand-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="5" data-number="10">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif

                            <div class="tabs-brand">
                                <div class="brand">
                                    <div class="brand-con">
                                        <ul class="brand-list" style="position: absolute; width: 580px; height: 36px; top: 0px; left: 0px;">

                                            @if(!empty($data['5-2']))
                                                @foreach($data['5-2'] as $v)
                                                    <li>
                                                        <a href="{{ route('pc_goods_list', ['filter_str' => '0-0-0-0-0-0-0-0-0-0-0-'.$v['brand_id']]) }}" target="" title="{{ $v['brand_name'] }}">
                                                            <img class="" src="{{ get_image_url($v['brand_logo']) }}" data-original="{{ get_image_url($v['brand_logo']) }}" width="100" height="40" alt="{{ $v['brand_name'] }}" style="display: block;">
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                @for($i=1; $i <= 5; $i++)
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
        </div>
    </div>
    <!-- 楼层 _end -->

@if($is_design)
</div>
@endif
