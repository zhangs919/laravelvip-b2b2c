<!-- 默认缓载图片 -->
<!-- 店铺首页楼层模板 -->
@if($is_design)
<!-- 判断url链接 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!-- 楼层 _start -->
    <div class="w1210">
        <div class="shop-floor shop-floor2 clearfix">

            <h2 class="shop-floor-title">
                @if($tpl_name != '' && $is_design)
                    <a href="javascript:void(0)" class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_open_colorpicker="1" data-title_open_link="1">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif
                @if(!empty($data['4-1']))
                    @foreach($data['4-1'] as $v)
                        <em style="background:{{ $v['color'] }};">&nbsp;</em>
                        <a href="javascript:void(0)" target="" class="shop-floor-name" style="color:{{ $v['color'] }};">{{ $v['name'] }}</a>
                        <em style="background:{{ $v['color'] }};">&nbsp;</em>
                        <a href="javascript:void(0)" target="" class="floor-more" style="color:{{ $v['color'] }};">更多 &gt;</a>
                    @endforeach
                @else
                    <em>&nbsp;</em>
                    <a href="javascript:void(0)" target="" class="shop-floor-name">添加标题</a>
                    <em>&nbsp;</em>
                    <a href="javascript:void(0)" target="_blank" class="floor-more">更多 ></a>
                @endif

            </h2>

            <h2>

                @if(!empty($data['3-1']))
                    @foreach($data['3-1'] as $v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="shop-floor-category">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0)" class="shop-floor-category example-text full-size h70">
                        <span>此处添加【1210*高度不限】图片</span>
                    </a>
                @endif

                @if($tpl_name != '' && $is_design)
                    <a class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif
            </h2>
            <div class="shop-floor-ad">

                @if(!empty($data['3-2']))
                    @foreach($data['3-2'] as $v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="shop-floor-ad-img">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}?x-oss-process=image/format,webp/quality,q_75" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0)" target="_blank" class="shop-floor-ad-img example-text full-size h150">
                        <span>此处添加【1210*高度不限】</span>
                    </a>
                @endif

                @if($tpl_name != '' && $is_design)
                    <a class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="2" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif
            </div>
            <div class="shop-floor-goods">

                @for($i=0; $i <= 3; $i++)
                    @if(@$data['2-1'][$i] != null)
                        <div class="shop-goods @if($i == 0) shop-goods-spe @endif">
                            <a target="_blank" href="{{ route('pc_show_goods', ['goods_id'=>$data['2-1'][$i]['goods_id']]) }}" title="{{ $data['2-1'][$i]['goods_name'] }}" class="goods-img" style="">
                                <img class="" src="{{ get_image_url($data['2-1'][$i]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original="{{ get_image_url($data['2-1'][$i]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original-webp="{{ get_image_url($data['2-1'][$i]['goods_image']) }}" alt="{{ $data['2-1'][$i]['goods_name'] }}" style="display: inline;">
                            </a>
                            <div class="shop-goods-name">
                                <p class="goods-name">
                                    <a target="" href="{{ route('pc_show_goods', ['goods_id'=>$data['2-1'][$i]['goods_id']]) }}" title="{{ $data['2-1'][$i]['goods_name'] }}">{{ $data['2-1'][$i]['goods_name'] }}</a>
                                </p>
                                <p class="goods-price color">￥{{ $data['2-1'][$i]['goods_price'] }}</p>
                            </div>
                        </div>
                    @else
                        <div class="shop-goods @if($i == 0) shop-goods-spe @endif">
                            <a href="javascript:void(0)">
                                <div class="shop-goods-masked example-text">
                                    <span>
                                    示例产品
                                    <br>
                                    【290*290】
                                    </span>
                                </div>
                                <div class="shop-goods-name">
                                    <p class="goods-name">商品名称</p>
                                    <p class="goods-price color">¥0.00</p>
                                </div>
                            </a>
                        </div>
                    @endif
                @endfor

                @if($tpl_name != '' && $is_design)
                    <a class="selector goods-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="4" data-width="980">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif
            </div>
        </div>
    </div>
    <!-- 楼层 _end -->

@if($is_design)
</div>
@endif
