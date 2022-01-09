<!-- 默认缓载图片 -->
<!-- 店铺首页楼层模板 -->
@if($is_design)
<!-- 判断url链接 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!-- 楼层 _start -->
    <div class="w1210 shop-floor">

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



        <div class="shop-goods-list">
            @if($tpl_name != '' && $is_design)
                <a class="selector goods-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="10" data-width="980">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

            <ul>

                @for($i=0; $i <= 9; $i++)
                    @if(@$data['2-1'][$i] != null)
                        <li @if($i % 5 == 0) class="first" @endif>
                            <dl>
                                <dt class="goods-thumb">
                                    <a target="" href="{{ route('pc_show_goods',['goods_id'=>$data['2-1'][$i]['goods_id']]) }}" title="{{ $data['2-1'][$i]['goods_name'] }}" style="">
                                        <img class="" src="{{ get_image_url($data['2-1'][$i]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original="{{ get_image_url($data['2-1'][$i]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original-webp="{{ get_image_url($data['2-1'][$i]['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp/quality,q_75" alt="{{ $data['2-1'][$i]['goods_name'] }}" style="display: inline;">
                                    </a>
                                </dt>
                                <dd class="goods-info">
                                    <a target="" href="{{ route('pc_show_goods',['goods_id'=>$data['2-1'][$i]['goods_id']]) }}" title="{{ $data['2-1'][$i]['goods_name'] }}" class="goods-name">{{ $data['2-1'][$i]['goods_name'] }}</a>
                                    <p>
                                        <span class="goods-price color fl">￥{{ $data['2-1'][$i]['goods_price'] }}</span>
                                        <a target="_blank" href="{{ route('pc_show_goods', ['goods_id'=>$data['2-1'][$i]['goods_id']]) }}" title="立即抢购" class="shop-add-cart fr">立即抢购</a>
                                    </p>
                                </dd>
                            </dl>
                        </li>
                    @else
                        <li @if($i % 5 == 0) class="first" @endif>
                            <dl>
                                <dt class="goods-thumb">
                                    <a href="javascript:void(0);" title="商品名称" class="example-text special">
                                <span>
                                示例产品
                                <br>
                                【230*230】
                                </span>
                                    </a>
                                </dt>
                                <dd class="goods-info">
                                    <a href="javascript:void(0);" title="商品名称" class="goods-name">商品名称</a>
                                    <p>
                                        <span class="goods-price color fl">￥0.00</span>
                                        <a target="_blank" href="javascript:;" title="立即抢购" class="shop-add-cart fr">立即抢购</a>
                                    </p>

                                </dd>
                            </dl>
                        </li>
                    @endif
                @endfor

            </ul>
        </div>

    </div>
    <!-- 楼层 _end -->

@if($is_design)
</div>
@endif
