<!-- 默认缓载图片 -->
<!-- 前台首页楼层模板 -->
<!-- 判断url链接 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 楼层 _star -->
    <div class="w1210 floor-list"
         data-floor_name="@if(!empty($data['4-1'])){{ $data['4-1'][0]['floor_name'] }}@endif" data-short_name="@if(!empty($data['4-1'])){{ $data['4-1'][0]['short_name'] }}@endif">
        <!-- 1楼 _start-->
        <div class="floor market-floor">
            <div class="floor-layout">
                <div class="floor-item">
                    <div class="industry-floor-item-static">
                        <div class="industry-floor-img">
                            @if($tpl_name != '' && $is_design)
                                <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="1">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif

                            @if(!empty($data['3-1']))
                                @foreach($data['3-1'] as $v)
                                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="" class="floor-img" style="">
                                        <img class="industry-floor-bannerimg" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: inline;">
                                    </a>
                                @endforeach
                            @else
                                <a class="floor-img example-text special" href="javascript:void(0)">
                                    <span>此处添加<br>【198*353】图片</span>
                                </a>
                            @endif


                        </div>
                        <div class="floor-content">
                            <div class="floor-head">

                                @if($tpl_name != '' && $is_design)
                                    <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-title_open_link="1" data-width="650" data-title_short_name="1" data-title_is_floor="1">
                                        <i class="fa fa-edit"></i>
                                        编辑
                                    </a>
                                @endif

                                <div class="floor-head-left">

                                    @if(!empty($data['4-1']))
                                        @foreach($data['4-1'] as $v)
                                            <span class="floor-name hide SZY-FLOOR-NAME"> {{ $v['floor_name'] }} </span>
                                            <input type="hidden" value="{{ $v['short_name'] }}" class="SZY-SHORT-NAME">
                                            <a href="javascript:void(0)" class="floor-title">
                                                <i style="background: #FA4862;"></i>
                                                {{ $v['name'] }}
                                            </a>
											@if(!empty($v['link']))
											<a href="{{ $v['link'] }}" class="see-more" target="_blank">查看更多 ></a>
											@endif
										@endforeach
                                    @else
                                        <a href="javascript:void(0)" class="floor-title">
                                            <i style="background: #FA4862;"></i>
                                            添加标题
                                        </a>
										<a href="javascript:void(0)" class="see-more" target="_blank">查看更多 ></a>
									@endif



                                </div>
                            </div>
                            <div class="floor-body">
                                <ul class="floor-body-left">

                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector category-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="6" data-number="24">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                    @if(!empty($data['6-1']))
                                        @php
                                            $goods_cat_datas = array_chunk($data['6-1'], 3);
                                        @endphp
                                        @foreach($goods_cat_datas as $goods_cat_data)
                                            <li>
                                            @foreach($goods_cat_data as $v)
                                                <a href="{{ $v['link'] }}" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                                            @endforeach
                                            </li>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 8; $i++)
                                            <li>
                                                <a href="javascript:void(0)" title="商品分类">商品分类</a>
                                                <a href="javascript:void(0)" title="商品分类">商品分类</a>
                                                <a href="javascript:void(0)" title="商品分类">商品分类</a>
                                            </li>
                                        @endfor
                                    @endif

                                </ul>
                                <div class="floor-body-center"></div>
                                <div class="floor-body-right logo">

                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector brand-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="5" data-number="4">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                    @if(!empty($data['5-1']))
                                        @foreach($data['5-1'] as $v)
                                            <a href="{{ route('pc_goods_list', ['filter_str' => '0-0-0-0-0-0-0-0-0-0-0-'.$v['brand_id']]) }}" title="" class="brand-logo">
                                                <img class="" src="{{ get_image_url($v['brand_logo']) }}" data-original="{{ get_image_url($v['brand_logo']) }}" alt="{{ $v['brand_name'] }}" style="display: inline-block;">
                                            </a>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 4; $i++)
                                            <a href="javascript:void(0)" class="brand-logo example-text">
                                                <span>添加品牌</span>
                                            </a>
                                        @endfor
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 1楼 _end-->
        <!-- 2楼 _start-->
        <div class="market-floor">
            <div class="floor-layout">
                <div class="floor-item">
                    <div class="industry-floor-item-static">
                        <div class="industry-floor-img">
                            @if($tpl_name != '' && $is_design)
                                <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="1">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif

                            @if(!empty($data['3-2']))
                                @foreach($data['3-2'] as $v)
                                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="" class="floor-img" style="">
                                        <img class="industry-floor-bannerimg" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" style="display: inline;">
                                    </a>
                                @endforeach
                            @else
                                <a class="floor-img example-text special" href="javascript:void(0)">
                                    <span>此处添加<br>【198*353】图片</span>
                                </a>
                            @endif

                        </div>
                        <div class="floor-content">
                            <div class="floor-head">

                                @if($tpl_name != '' && $is_design)
                                    <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="4" data-title_open_link="1" data-width="650" data-title_short_name="1" data-title_is_floor="1">
                                        <i class="fa fa-edit"></i>
                                        编辑
                                    </a>
                                @endif

                                <div class="floor-head-left">

                                    @if(!empty($data['4-2']))
                                        @foreach($data['4-2'] as $v)
                                            <span class="floor-name hide SZY-FLOOR-NAME"> {{ $v['floor_name'] }} </span>
                                            <input type="hidden" value="{{ $v['short_name'] }}" class="SZY-SHORT-NAME">
                                            <a href="javascript:void(0)" class="floor-title">
                                                <i style="background: #FA4862;"></i>
                                                {{ $v['name'] }}
                                            </a>
											@if(!empty($v['link']))
												<a href="{{ $v['link'] }}" class="see-more" target="_blank">查看更多 ></a>
											@endif
                                        @endforeach
                                    @else
                                        <a href="javascript:void(0)" class="floor-title">
                                            <i style="background: #FA4862;"></i>
                                            添加标题
                                        </a>
                                        <a href="javascript:void(0)" class="see-more" target="_blank">查看更多 ></a>
                                    @endif



                                </div>
                            </div>
                            <div class="floor-body">
                                <ul class="floor-body-left">



                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector category-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="6" data-number="24">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                    @if(!empty($data['6-2']))
                                        @php
                                            $goods_cat_datas = array_chunk($data['6-2'], 3);
                                        @endphp
                                        @foreach($goods_cat_datas as $goods_cat_data)
                                            <li>
                                                @foreach($goods_cat_data as $v)
                                                    <a href="{{ $v['link'] }}" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                                                @endforeach
                                            </li>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 8; $i++)
                                            <li>
                                                <a href="javascript:void(0)" title="商品分类">商品分类</a>
                                                <a href="javascript:void(0)" title="商品分类">商品分类</a>
                                                <a href="javascript:void(0)" title="商品分类">商品分类</a>
                                            </li>
                                        @endfor
                                    @endif


                                </ul>
                                <div class="floor-body-center"></div>
                                <div class="floor-body-right logo">



                                    @if($tpl_name != '' && $is_design)
                                        <a class="selector brand-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="5" data-number="4">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                    @if(!empty($data['5-2']))
                                        @foreach($data['5-2'] as $v)
                                            <a href="{{ route('pc_goods_list', ['filter_str' => '0-0-0-0-0-0-0-0-0-0-0-'.$v['brand_id']]) }}" title="" class="brand-logo">
                                                <img class="" src="{{ get_image_url($v['brand_logo']) }}" data-original="{{ get_image_url($v['brand_logo']) }}" alt="{{ $v['brand_name'] }}" style="display: inline-block;">
                                            </a>
                                        @endforeach
                                    @else
                                        @for($i=1; $i <= 4; $i++)
                                            <a href="javascript:void(0)" class="brand-logo example-text">
                                                <span>添加品牌</span>
                                            </a>
                                        @endfor
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2楼 _end-->
    </div>
    <!-- 楼层 _end -->

</div>
