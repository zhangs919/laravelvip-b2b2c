<!-- 默认缓载图片 -->
<!-- 商品楼层1 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>


    <section class="goods-floor">
        <div class="floor-box">

            @if($tpl_name != '' && $is_design)
                <a class="goods-selector content-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="0" data-width="980">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif
            <ul class="m-t-0" style='background-color: {{ @$data['99-1'][0]['bgcolor'] != null ? $data['99-1'][0]['bgcolor'] : '' }}; '>

                @if(!empty($data['2-1']))
                    @foreach($data['2-1'] as $k=>$v)
                        <li class="goods-col02 ">
                            <div class="goods-info">
                                <div class="item-tag-box">
                                    <!---->
                                    <!---->
                                </div>
                                <div class="goods-pic">
                                    <a href="{{ route('mobile_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" style="display: block;">
                                        <img class="" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $v['goods_name'] }}" data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp/quality,q_75" style="display: block;">
                                    </a>
                                </div>
                                <div class="goods-name">
                                    <a href="{{ route('mobile_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}">{{ $v['goods_name'] }}</a>
                                </div>
                                <div class="price">
                                    <span class="price-color">￥{{ $v['goods_price'] }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    @for($i=1; $i <= 2; $i++)
                    <li class="goods-col02 ">
                        <div class="goods-info">
                            <div class="goods-pic">
                                <a href="javascript:;" title="" class="example-text">
<span>
示例产品
</span>
                                </a>
                            </div>
                            <div class="goods-name">
                                <a href="javascript:;" title="商品名称">商品名称</a>
                            </div>
                            <div class="price">
                                <span class="price-color"> ￥0元</span>
                            </div>
                        </div>
                    </li>
                    @endfor
                @endif

            </ul>
            <!---->
        </div>
    </section>
    <!--新品上市 end-->



</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-type="99" data-style_colorpicker="1" data-style_border="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif

