<!-- 红包模板 bouns_s1 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id=''
     data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '营销模板' }}' data-is_valid='{{ $is_valid }}'>
    <!--内容区域 start-->
    <div class="coupon-template">
        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="selector bonus-selector SZY-TPL-SELECTOR"
               data-uid="{{ $uid }}" data-cat_id="1" data-type="11" data-number="5">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif
        <div class="coupon-wrap clearfix @if(!empty($data['99-1'][0]['roll'])){{ 'coupon-wrap-new' }}@endif">

            @if(!empty($data['99-1'][0]['roll']))
                @if(!empty($data['99-1'][0]['bgimage']))
                    <div class="coupon-head " style="background: url({{ get_image_url($data['99-1'][0]['bgimage']) }}) no-repeat top; background-size: cover">
                        <a href="javascript:void(0)">
                        </a>
                    </div>
                @else
                    <div class="coupon-head " style="">
                        <a href="/bonus-list.html" target="_blank">
                        </a>
                    </div>
                @endif

                <div class="coupon-body ">

                    @if(!empty($data['11-1']))
                        @foreach($data['11-1'] as $v)
                            <div class="coupon-item">
                                <a href="javascript:void(0)">
                                    <div class="left">
                                        <div class="price">
                                            <span>￥</span><strong>{{ $v['bonus_amount'] }}</strong>
                                        </div>
                                        <p class="desc">
                                            -
                                            满￥{{ $v['min_goods_amount'] }}可用
                                            -
                                        </p>
                                        <div class="bonus-name">{{ $v['bonus_name'] }}</div>
                                    </div>
                                    <div class="right bg-color">
                                        <b></b>
                                        <i class="i1"></i>
                                        <i class="i2"></i>
                                        <div class="btn bg-color receive-bonus" data-bonus_id="{{ $v['bonus_id'] }}" data-shop_id="{{ $v['shop_id'] }}">立即领取</div>
                                    </div>
                                </a>
                            </div>

{{--                            <div class="coupon-item">--}}
{{--                                <a href="javascript:void(0)">--}}
{{--                                    <div class="price color ">--}}
{{--                                        <strong>{{ $v['bonus_amount'] }}</strong>--}}
{{--                                        <span>￥</span>--}}
{{--                                    </div>--}}
{{--                                    <p class="desc">--}}
{{--                                        ---}}
{{--                                        满￥{{ $v['min_goods_amount'] }}可用--}}
{{--                                        ---}}
{{--                                    </p>--}}
{{--                                    <div>--}}
{{--                                        <div class="btn bg-color receive-bonus" data-bonus_id="{{ $v['bonus_id'] }}" data-shop_id="{{ $v['shop_id'] }}">立即领取</div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                        @endforeach
                    @else
                        @for($i=1; $i <= 5; $i++)
                            <div class="coupon-item">
                                <a href="javascript:void(0)">
                                    <div class="left">
                                        <div class="price">
                                            <span>￥</span><strong>0</strong>
                                        </div>
                                        <p class="desc">红包使用条件</p>
                                        <div class="bonus-name">红包名称</div>
                                    </div>
                                    <div class="right bg-color">
                                        <b></b>
                                        <i class="i1"></i>
                                        <i class="i2"></i>
                                        <div class="btn bg-color receive-bonus">立即领取</div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                    @endif

                </div>
            @else
                @if(!empty($data['99-1'][0]['bgimage']))
                    <div class="coupon-head fl" style="background: url({{ get_image_url($data['99-1'][0]['bgimage']) }}) no-repeat top; background-size: cover">
                        <a href="javascript:void(0)">
                        </a>
                    </div>
                @else
                    <div class="coupon-head fl" style="">
                        <a href="/bonus-list.html" target="_blank">
                        </a>
                    </div>
                @endif

                <div class="coupon-body fl">

                    @if(!empty($data['11-1']))
                        @foreach($data['11-1'] as $v)
                            <div class="coupon-item">
                                <a href="javascript:void(0)">
                                    <div class="price color ">
                                        <strong>{{ $v['bonus_amount'] }}</strong>
                                        <span>￥</span>
                                    </div>
                                    <p class="desc">
                                        -
                                        满￥{{ $v['min_goods_amount'] }}可用
                                        -
                                    </p>
                                    <div>
                                        <div class="btn bg-color receive-bonus" data-bonus_id="{{ $v['bonus_id'] }}" data-shop_id="{{ $v['shop_id'] }}">立即领取</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        @for($i=1; $i <= 5; $i++)
                            <div class="coupon-item">
                                <a href="javascript:void(0)">
                                    <div class="price">
                                        <strong>0</strong>
                                        <span>￥</span>
                                    </div>
                                    <p class="desc">-红包使用条件-</p>
                                    <div class="btn bg-color receive-bonus">立即领取</div>
                                </a>
                            </div>
                        @endfor
                    @endif

                </div>
            @endif

        </div>
        <!--内容区域 end-->
    </div>
</div>

@if($is_design)
    <script type="text/javascript">
        $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-type="99" data-style_image="1" data-style_roll="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
    </script>
@endif
