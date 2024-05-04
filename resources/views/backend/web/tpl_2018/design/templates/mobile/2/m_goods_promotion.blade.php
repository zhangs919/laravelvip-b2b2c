<!-- 默认缓载图片 -->
<!-- 手机端商品促销模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>

    <section class="sale-goods-box">
        <div class="sale-goods-list">

            @if($tpl_name != '' && $is_design)
                <a class="goods-selector content-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="0" data-width="980">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif


            <div class="tempWrap swiper-container goods-promotion">


                <div class="bd swiper-wrapper">

                    @if(!empty($data['2-1']))
                        @php
                            $goods_datas = array_chunk($data['2-1'], 3);
                        @endphp
                        @foreach($goods_datas as $key=>$goods_data)
                            <ul class="swiper-slide @if($key == 0) swiper-slide-active @endif" style="width: 312px;">
                                @foreach($goods_data as $k=>$v)
                                <li>
                                    <div class="goods-info">
                                        <div class="item-tag-box">
                                            <!---->
                                            <!---->
                                        </div>
                                        <div class="goods-pic">
                                            <a href="/goods-{{ $v['goods_id'] }}.html" title="{{ $v['goods_name'] }}" style="display: block;">
                                                <img class="" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp/quality,q_75" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="goods-name">
                                            <a href="/goods-{{ $v['goods_id'] }}.html" title="{{ $v['goods_name'] }}">{{ $v['goods_name'] }}</a>
                                        </div>
                                        <div class="price">
                                            <span class="price-color">￥{{ $v['goods_price'] }}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        @endforeach
                    @else
                        @for($i=1; $i <= 2; $i++)
                            <ul class="swiper-slide">

                                @for($ii=1; $ii <= 3; $ii++)
                                <li>
                                    <div class="goods-info">
                                        <div class="goods-pic">
                                            <a href="javascript:;" title="" class="example-text">
<span>
示例产品
</span>
                                            </a>
                                        </div>
                                        <div class="goods-name">
                                            <a href="javascript:;" title="">商品名称</a>
                                        </div>
                                        <div class="price">
                                            <span class="price-color">¥0</span>
                                        </div>
                                    </div>
                                </li>
                                @endfor

                            </ul>
                        @endfor
                    @endif

                </div>

                <div class="hd pagination"></div>
            </div>
        </div>
    </section>


</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_roll="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif

<script type="text/javascript">
    {{--var swiper = $('#{{ $uid }} .goods-promotion').swiper({--}}
        {{--pagination: '#{{ $uid }} .pagination',--}}
        {{--touchRatio: 1,--}}
    {{--});--}}
    {{--var swiper = new Swiper('.seamless-rolling', {--}}
        {{--slidesPerView: 3.5,--}}
        {{--freeMode: true--}}
    {{--});--}}
</script>

