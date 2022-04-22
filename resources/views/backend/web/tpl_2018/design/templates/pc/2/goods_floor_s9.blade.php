<!-- 默认缓载图片 -->
<!-- 前台首页楼层模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 楼层 _start -->
    <div class="w1210 ">
        <div class="floor floor-con9">
            <div class="floor-layout">

                @if($tpl_name != '' && $is_design)
                    <a class="selector goods-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="0" data-width="980">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif
                <ul>

                    @if(!empty($data['2-1']))
                        @foreach($data['2-1'] as $v)
                            <li>
                                <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" target="" style="">
                                    <img class="" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220/format,webp/quality,q_75" alt="{{ $v['goods_name'] }}" style="display: inline-block;">
                                    <div class="goods-info">
                                        <p class="goods-name">{{ $v['goods_name'] }}</p>
                                        <p class="goods-other">
                                            <span class="color">￥{{ $v['goods_price'] }}</span>
                                            <i class="add-cart" style="background-image: url({{ get_cart_image() }})" title="加入购物车" data-goods_id="{{ $v['goods_id'] }}" data-image_url="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"></i>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    @else
                        @for($i=1; $i <= 10; $i++)
                            <li>
                                <a href="javascript:void(0);" title="商品名称">
                                    <span class="example-text">
                                    <span>
                                    示例产品
                                    <br>
                                    【220*220】
                                    </span>
                                    </span>
                                    <div class="goods-info">
                                        <p class="goods-name">商品名称</p>
                                        <p class="goods-other">
                                            <span class="color">￥0.00</span>
                                            <i class="add-cart" style="background-image: url({{ get_cart_image() }})" title="加入购物"></i>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @endfor
                    @endif

                </ul>

            </div>
        </div>
    </div>
    <!-- 楼层 _end -->

</div>