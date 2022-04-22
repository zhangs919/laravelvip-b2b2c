<!-- 默认缓载图片 -->
<!-- 手机端专题商品模板 -->
{{--背景颜色--}}
@php
    $bg_color = @$data['99-1'][0]['bgcolor'] != null ? $data['99-1'][0]['bgcolor'] : '';
    $height = @$data['99-1'][0]['height'] != null ? $data['99-1'][0]['height'] : '';
@endphp

<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>


    <div class="activity-goods-list clearfix" style='background-color: {{ $bg_color }}; '>

        @if($tpl_name != '' && $is_design)
            <a title="编辑" class="content-selector goods-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="2" data-number="-1" data-width="980">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        @if(!empty($data['2-1']))
            @foreach($data['2-1'] as $v)
                <a class="activity-good-item" href="javascript:void(0)">
                    <div class="activity-good-pic" style="background: url(http://images.68mall.com/system/config/default_image/default_lazyload_mobile_0.png) no-repeat center center; display: block; background-size: 100px;">
                        <img class="square" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $v['goods_name'] }}" style="height: 154px;">
                    </div>
                    <div class="activity-good-info">
                        <div class="activity-good-title">{{ $v['goods_name'] }}</div>
                        <div class="activity-good-price">￥{{ $v['goods_price'] }}</div>
                    </div>
                </a>
            @endforeach
        @else
            @for($i=1; $i <= 2; $i++)
                <a class="activity-good-item">
                    <div class="activity-good-pic">
                        <img src="/assets/d2eace91/images/design/example/goods_img_220_220.jpg">
                    </div>
                    <div class="activity-good-info">
                        <div class="activity-good-title">商品名称</div>
                        <div class="activity-good-price">¥0.00</div>
                    </div>
                </a>
            @endfor
        @endif

    </div>

</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_colorpicker="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif