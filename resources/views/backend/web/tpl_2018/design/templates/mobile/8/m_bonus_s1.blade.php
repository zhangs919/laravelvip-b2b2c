<!-- 红包模板 m_bouns_s1 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id=''
     data-tpl_name='{{ $tpl_name }}'
     data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>
    <!--内容区域 start-->
    <div class="coupon-template @if(!empty($data['99-1'][0]['roll'])){{ 'coupon-template-new' }}@endif">
        @if($tpl_name != '' && $is_design)
            <a title="编辑" href="javascript:void(0)" class="content-selector SZY-TPL-SELECTOR"
               data-uid="{{ $uid }}"
               data-cat_id="1" data-type="11" data-number="10">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        @if(!empty($data['99-1'][0]['roll']))
                @if(!empty($data['11-1']))
                    <div class="coupon-items">
                        @foreach($data['11-1'] as $v)
                            <a href="javascript:void(0)" class="swiper-slide">
                                <div class="coupon-list-new"  style="@if(!empty($data['99-1'][0]['bgcolor'])){{ 'background:'.$data['99-1'][0]['bgcolor'] }}@endif">
                                    <div class="coupon-left">
                                        <h3>
                                            <em>{{ $v['bonus_amount'] }}</em>
                                        </h3>
                                        <p class="coupon-name">{{ $v['bonus_name'] }}</p>
                                        <div class="coupon-desc">满￥{{ $v['min_goods_amount'] }}可用</div>
                                    </div>
                                    <div class="coupon-right">
                                        <span class="coupon-action-btn receive-bonus" data-bonus_id="{{ $v['bonus_id'] }}" data-shop_id="{{ $v['shop_id'] }}">立即领取</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="coupon-items">
                        @for($i=1; $i <= 3; $i++)
                            <a href="javascript:void(0)" class="swiper-slide">
                                <div class="coupon-list-new"  style="@if(!empty($data['99-1'][0]['bgcolor'])){{ 'background:'.$data['99-1'][0]['bgcolor'] }}@endif">
                                    <div class="coupon-left">
                                        <h3>
                                            <em>0.00</em>
                                        </h3>
                                        <p class="coupon-name">红包名称</p>
                                        <div class="coupon-desc">红包使用条件</div>
                                    </div>
                                    <div class="coupon-right">
                                        <span class="coupon-action-btn">立即领取</span>
                                    </div>
                                </div>
                            </a>
                        @endfor
                    </div>
                @endif
        @else
            <!--默认样式-->
                @if(!empty($data['11-1']))
                    <div class="coupon-items col{{ count($data['11-1']) > 1 ? 2 : 1 }}">
                        @foreach($data['11-1'] as $v)
                            <a href="javascript:void(0)">
                                <div class="coupon-list swiper-slide">
                                    <div class="coupon-left">
                                        <h3>
                                            <em>{{ $v['bonus_amount'] }}</em>
                                            元
                                        </h3>
                                        <div class="coupon-desc">
                        <span>
                            满￥{{ $v['min_goods_amount'] }}可用
                        </span>
                                        </div>
                                    </div>
                                    <div class="coupon-right">
                                        <span class="coupon-action-btn receive-bonus" data-bonus_id="{{ $v['bonus_id'] }}" data-shop_id="{{ $v['shop_id'] }}">立即领取</span>
                                    </div>
                                    <i class="coupon-dot-above"></i>
                                    <i class="coupon-dot-below"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="coupon-items col2">
                        @for($i=1; $i <= 3; $i++)
                            <a href="javascript:void(0)">
                                <div class="coupon-list">
                                    <div class="coupon-left">
                                        <h3>
                                            <em>0</em>
                                            元
                                        </h3>
                                        <div class="coupon-desc">
                                            <span>红包使用条件</span>
                                        </div>
                                    </div>
                                    <div class="coupon-right">
                                        <span class="coupon-action-btn">立即领取</span>
                                    </div>
                                    <i class="coupon-dot-above"></i>
                                    <i class="coupon-dot-below"></i>
                                </div>
                            </a>
                        @endfor
                    </div>
                @endif
        @endif



    </div>
    <!--内容区域 end-->
</div>

@if($is_design)
    <script type="text/javascript">
        $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-type="99" data-style_colorpicker="1" data-style_roll="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
    </script>
@endif