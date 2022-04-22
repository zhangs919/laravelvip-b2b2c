@if(!empty($list))
    <div id="compare">
        <!---->
        <div class="compare compare-current">
            <div class="compare-header">
                <span class="compare-header-title">当前对比</span>
            </div>
            <div class="compare-content clearfix">
                <div class="compare-side">
                    <ul class="clearfix">
                        <li class="list-row-item info">
                            <span class="side-label">商品信息</span>
                        </li>
                        <li class="list-row-item price">
                            <span class="side-label">一口价/现价</span>
                        </li>
                        <li class="list-row-item freight">
                            <span class="side-label">运费</span>
                        </li>
                        <li class="list-row-item sales">
                            <span class="side-label">销量</span>
                        </li>
                        <li class="list-row-item reputation">
                            <span class="side-label">评价</span>
                        </li>
                    </ul>
                </div>
                <div class="compare-list">
                    <ul class="compare-list-con clearfix">
                        @foreach($list as $k=>$v)
                        @if($k <= 3)
                        <!---->
                        <!---->
                        <li class="compare-goods" name="goods_id{{ $v['goods_id'] }}">
                            <ul class="clearfix">
                                <li class="list-row-item goods-info">
                                    <div class="list-item-slide">
                                        <div class="tab-con item-pic-box">
                                            <div class="tab-content j-tab-con">
                                                <!---->
                                                @foreach(array_first($v['sku_images']) as $ik=>$image)
                                                    @if($ik <= 2)
                                                        <div class="tab-con-item" style="display: block;">
                                                            <p>
                                                                <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" class="item-link" target="_blank">
                                                                    <img src="{{ get_image_url($image,'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="" title="" />
                                                                </a>
                                                            </p>
                                                        </div>
                                                        @endif
                                                    @endforeach

                                                <!---->
                                            </div>
                                        </div>
                                        <div class="tab-nav j-tab-nav clearfix">
                                            @foreach(array_first($v['sku_images']) as $ik=>$image)
                                                @if($ik <= 2)
                                                <!---->
                                                <a href="javascript:;" class="slide-nav-btn @if($ik == 0){{ 'current' }}@endif">
                                                    <img class="slide-nav-img" src="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="" title="">
                                                </a>
                                                <!---->
                                                @endif
                                            @endforeach

                                        </div>
                                        <script type="text/javascript">
                                            $('.list-item-slide').each(function() {
                                                $(this).rTabs({
                                                    bind: 'hover',
                                                    animation: 'up'
                                                });
                                            });
                                        </script>
                                    </div>
                                    <p class="goods-name">
                                        <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target="_blank" class="">{{ $v['goods_name'] }}</a>
                                    </p>
                                    <div class="slide-buy-box clearfix">
                                        <div class="btns clearfix">

                                            <a data-tip="11" class="cart-btn add-to-cart">加入购物车</a>

                                            <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" class="cart-btn" target="_blank">查看详情</a>
                                        </div>
                                        <div class="edit-btns clearfix">
                                            <a class="del btn-del-sku">移出对比</a>
                                            <input type="hidden" value="{{ $v['goods_id'] }}">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-row-item price">
                                    <strong class="rmb cur_price">
                                        <span class="rmb-num"> ￥{{ $v['goods_price'] }} </span>
                                    </strong>
                                </li>
                                <li class="list-row-item freight">
                                    <p>
                                        <strong class="rmb">
                                            <span class="rmb-num freught">￥0.00</span>
                                        </strong>
                                    </p>

                                    <p class="distance">
                                        北京市&nbsp;至&nbsp;
                                        <span style="color: #999;"></span>
                                    </p>
                                </li>
                                <li class="list-row-item sales">{{ $v['sale_num'] }}件</li>
                                <li class="list-row-item reputation">
                                    <div class="pi-con" style="text-align: center; padding-top: 10%;">
                                            <span class="kcharts-label">
                                                好评
                                                <span class="kcharts-donut-val kcharts-label-good">({{ $v['evaluate']['best_count'] }})</span>
                                            </span>
                                        <span class="kcharts-label">
                                                中评
                                                <span class="kcharts-donut-val kcharts-label-normal">({{ $v['evaluate']['middle_count'] }})</span>
                                            </span>
                                        <span class="kcharts-label">
                                                差评
                                                <span class="kcharts-donut-val kcharts-label-bad">({{ $v['evaluate']['bad_count'] }})</span>
                                            </span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!---->
                        <!---->
                        @endif
                        @endforeach
                        <!---->
                    </ul>
                </div>
            </div>
        </div>
        <div class="compare compare-current compare-shop">
            <div class="compare-header">
                <span class="compare-header-title">店铺信息</span>
            </div>
            <div class="compare-content clearfix">
                <div class="compare-side">
                    <ul class="clearfix">
                        <li class="list-row-item">
                            <span class="side-label">来源店铺</span>
                        </li>
                        <li class="list-row-item">
                            <span class="side-label">店铺星级</span>
                        </li>
                        <li class="list-row-item grade">
                            <span class="side-label">店铺动态评分</span>
                        </li>
                        <li class="list-row-item more-shop-info">
                            <span class="side-label">店铺好评率</span>
                        </li>
                        <li class="list-row-item complaint_rate more-shop-info">
                            <span class="side-label">近30天投诉率</span>
                        </li>
                        <li class="list-row-item penalties_count more-shop-info">
                            <span class="side-label">近30天处罚数</span>
                        </li>
                        <li class="list-row-item security_services more-shop-info">
                            <span class="side-label">保障服务</span>
                        </li>
                        <li class="list-row-item operating_time more-shop-info">
                            <span class="side-label">开店时间</span>
                        </li>
                    </ul>
                </div>
                <div class="compare-list">
                    <ul class="compare-list-con clearfix">
                    @foreach($list as $k=>$v)
                        @if($k <= 3)
                        <!---->
                        <!---->
                        <li class="compare-goods" name="goods_id{{ $v['goods_id'] }}">
                            <ul class="clearfix">
                                <li class="list-row-item">
                                    <div class="clearfix">
                                        <a href="{{ route('pc_shop_home',['shop_id'=>$v['shop_id']]) }}" title="" target="_blank" class="btn-link">{{ $v['shop_name'] }}</a>
                                        <span class="ww-light">
                                                <!-- 客服 -->
                                            <!-- -->
                                            <!---->
                                            <!-- s等于1时带文字，等于2时不带文字 -->
    <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=zlww26837&site=cntaobao&s=2&groupid=0&charset=utf-8">
        <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=zlww26837&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
        <span></span>
    </a>
                                            <!---->
                                            <!-- -->
                                            </span>
                                    </div>
                                </li>
                                <li class="list-row-item">
                                    <img src="{{ get_image_url($v['credit_img']) }}" class="rank" title="{{ $v['credit_name'] }}" />
                                </li>

                                <li class="list-row-item grade">
                                    <p class="item_dsr_info">描述相符：{{ $v['desc_score'] }}</p>
                                    <p class="item_dsr_info">服务态度：{{ $v['service_score'] }}</p>
                                    <p class="item_dsr_info">发货速度：{{ $v['send_score'] }}</p>
                                </li>
                                <li class="list-row-item more-shop-info">{{ $v['evaluate']['per_best_one'] }}%</li>
                                <li class="list-row-item more-shop-info">0%</li>
                                <li class="list-row-item more-shop-info">0次</li>

                                <li class="list-row-item security_services more-shop-info">

                                    <!---->
                                    <!---->
                                    <a class="item-icon" href="javascript:void(0)" title="破损补寄" target="_blank">
                                        <img src="http://images.68mall.com/contract/2016/06/07/14653028611314.jpg" />
                                    </a>
                                    <!---->
                                    <a class="item-icon" href="javascript:void(0)" title="品质承诺" target="_blank">
                                        <img src="http://images.68mall.com/contract/2016/06/07/14653028223253.png" />
                                    </a>
                                    <!---->

                                    <!---->
                                </li>
                                <li class="list-row-item more-shop-info">{{ $v['shop_time'] }} 天</li>
                            </ul>
                        </li>
                        <!---->
                        <!---->
                        @endif
                    @endforeach
                    </ul>
                    <ul class="clearfix">
                        <li class="list-row-item shop_item_blank">展开详细信息</li>
                    </ul>
                </div>
            </div>
        </div>
        <!---->
        <!-- 当页面滚动到一定位置时，此模块展示出来——商品信息在头部定位 _start -->
        <div class="compare compare-current fixed-nav">
            <div class="compare-content clearfix">
                <div class="compare-side">
                    <ul class="clearfix">
                        <li>
                            <span class="side-label">商品信息</span>
                        </li>
                    </ul>
                </div>
                <div class="compare-list clearfix">
                    <!---->
                    <!---->
                    @foreach($list as $k=>$v)
                        @if($k <= 3)
                        <div class="box-list-item clearfix">
                            <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target="_blank">
                                <img class="list-item-pic" src="{{ get_image_url($v['goods_image'],'goods_image') }}" alt="" title="">
                            </a>
                            <div class="box-content clearfix">
                                    <span class="list-item-title">
                                        <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target="_blank">{{ $v['goods_name'] }}</a>
                                    </span>

                                <a data-tip="{{ $v['goods_id'] }}" class="list-item-btn add-to-cart">加入购物车</a>


                                <a class="list-item-btn buy" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target="_blank">查看详情</a>
                                <a class="list-item-btn list-item-del">移出对比</a>
                                <input type="hidden" value="{{ $v['goods_id'] }}">
                            </div>
                        </div>
                        @endif
                    @endforeach
                    <!---->
                    <!---->

                </div>
            </div>
        </div>
        <!-- 当页面滚动到一定位置时，此模块展示出来——商品信息在头部定位 _end -->
    </div>

@else
    <!---->
    <div id="compare">
        <!---->
        <div class="compare compare-current compare-none" style="display: block;">
            <div class="compare-header">
                <span class="compare-header-title">商品信息</span>
            </div>
            <div class="compare-content clearfix">
                <div class="compare-side">
                    <ul class="clearfix">
                        <li class="list-row-item">
                            <span class="side-label">当前对比</span>
                        </li>
                    </ul>
                </div>
                <div class="compare-list compare-none-info">
                    <div class="compare-none-info-cry"></div>
                    <p class="compare-none-text">
                        没有宝贝进行对比，请
                        <span class="notice">勾选你要对比的宝贝</span>
                    </p>
                </div>
            </div>
        </div>
        <!---->
        <!-- 当页面滚动到一定位置时，此模块展示出来——商品信息在头部定位 _start -->
        <div class="compare compare-current fixed-nav">
            <div class="compare-content clearfix">
                <div class="compare-side">
                    <ul class="clearfix">
                        <li>
                            <span class="side-label">商品信息</span>
                        </li>
                    </ul>
                </div>
                <div class="compare-list clearfix">
                    <!---->
                </div>
            </div>
        </div>
        <!-- 当页面滚动到一定位置时，此模块展示出来——商品信息在头部定位 _end -->
    </div>
    <!-- -->

@endif