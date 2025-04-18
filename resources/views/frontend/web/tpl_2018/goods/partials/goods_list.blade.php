@if($params['style'] == 'grid')
    <ul class="list-grid clearfix">
    @foreach($list as $k=>$v)
    <!-- -->
        <!-- 如果是4的整数倍，给 li 标签添加class="last"值，即class="item last" -->
        <li class="item @if($k%3 == 0) last @endif">
            <div class="item-con">

                <!--售罄-->
                @if($v['goods_number'] <= 0)
                    <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" class="sell-out"></a>
                @endif

                <div class="item-pic">
                    <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}" target="_blank" style="background: url({{ get_image_url(sysconf('default_lazyload')) }}) no-repeat center;">
                        <img class="lazy" alt="" src="/images/common/blank.png" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                    </a>
                </div>

                <div class="item-info">
                    <div class="item-price">
                        <em class="sale-price second-color">￥{{ $v['goods_price'] }}</em>

                        <em class="sale-count">已售{{ $v['sale_num'] }}件</em>

                    </div>
                    <div class="item-name">
                        @if(!empty($v['act_labels']))
                            @foreach($v['act_labels'] as $act_label)
                                <!-- 活动标签 -->
                                <em class="act-type {{ $act_label['code'] }}">{{ $act_label['name'] }}</em>
                            @endforeach
                        @endif
                        <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" target="_blank" title="{{ $v['goods_name'] }}">{{ $v['goods_name'] }}</a>
                        <!-- 包邮、赠品标签  _star -->

                        @if($v['goods_freight_fee'] <= 0)
                            <i class="free-shipping">包邮</i>
                        @endif

                    <!-- 包邮、赠品标签  _end -->
                    </div>
                    <div class="item-con-info">
                        <div class="fl">
                            <div class="item-operate">
                                <a class="operate-btn compare-btn goods-comapre " data-compare-goods-id="{{ $v['goods_id'] }}" data-image-url="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">

                                    <i class="iconfont">&#xe715;</i>

                                    对比
                                </a>

                                <a href="javascript:;" onClick="toggleGoods('{{ $v['goods_id'] }}','{{ $v['sku_id'] }}',this)" class="operate-btn collet-btn @if($v['is_collected']) curr @endif goods-collect" data-goods-id="{{ $v['goods_id'] }}">
                                    @if($v['is_collected'])
                                        <i class="iconfont">&#xe6b1;</i>
                                        <span> 已收藏 </span>
                                    @else
                                        <i class="iconfont">&#xe6b3;</i>
                                        <span> 收藏 </span>
                                    @endif
                                </a>


                                <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}#goods_evaluate" target="_blank" class="operate-btn comment-btn">
                                    <i class="iconfont">&#xe6e4;</i>
                                    {{ $v['comment_num'] }}
                                </a>
                            </div>
                            <div class="item-shop">
                                <a href="{{ route('pc_shop_home',['shop_id'=>$v['shop_id']]) }}" target="_blank" title="{{ $v['shop_name'] }}">
                                    <!--   -->
                                    <span>{{ $v['shop_name'] }}</span>
                                </a>
                                <!--<em class="shop-serve iconfont color" title="联系卖家进行咨询">&#xe6ad;</em>-->
                            </div>
                        </div>
                        <div class="fr">
                            <div class="item-add-cart">

                                @if($v['goods_number'] <= 0)
                                    <a href="javascript:void(0);" data-goods-id="{{ $v['goods_id'] }}" class="add-cart sell-out-btn" title="卖光了"></a>
                                @else
                                    <a href="javascript:void(0);" style="background-image: url(/images/add-cart.jpg)" data-goods-id="{{ $v['goods_id'] }}" data-image-url="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="add-cart disable" title="加入购物车"></a>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </li>
    @endforeach
</ul>
@else
    <div class="goodsList">

        @foreach($list as $k=>$v)
            <!--售罄列表添加shouqing-bgcolor样式-->
            <ul class="clearfix ">

                <li class="thumb">
                    <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" target="_blank" title="{{ $v['goods_name'] }}" style="">
                        <img class="" alt="" src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
                    </a>
                </li>
                <li class="goodsName">
                    <a href="{{ route('pc_show_goods', ['goods_id'=>$v['goods_id']]) }}" target="_blank" title="{{ $v['goods_name'] }}">{{ $v['goods_name'] }} </a>

                </li>
                <li class="list_price">

                    市场价：
                    <font class="market">￥{{ $v['market_price'] }}</font>
                    <br>

                    本店售价：
                    <font class="shop">￥{{ $v['goods_price'] }}</font>
                    <br>
                </li>
                <li class="action">

                    <a href="javascript:;" onclick="toggleGoods('{{ $v['goods_id'] }}','{{ $v['sku_id'] }}',this)"
                       class="action-btn collet-btn @if($v['is_collected']) curr @endif"> @if($v['is_collected']) 已收藏 @else 收藏 @endif </a>


                    <!--售罄-->


                    @if($v['goods_number'] <= 0)
                        <a class="action-btn shouqing-btn" href="javascript:;">卖光了</a>
                    @else
                        <a href="javascript:;" data-goods-id="{{ $v['goods_id'] }}" data-image-url="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="action-btn addcart-btn add-cart">加入购物车</a>
                    @endif




                </li>
            </ul>
        @endforeach

    </div>
@endif

@if($total == 0)
    <!--当没有数据时，显示如下div-->
    <div class="tip-box">
        <img src="/images/noresult.png" class="tip-icon">
        <div class="tip-text">抱歉！没有搜索到您想要的结果……</div>
    </div>
@endif



<!--分页-->
<div class="pull-right page-box">



    {!! $pageHtml !!}

</div>