<div id="table_list">
    <div id="fav-list">
    @if(!empty($list))
        <!---->
            <ul class="img-item-list clearfix">

            @foreach($list as $v)
                <!---->
                    <li id="shop{{ $v['collect_id'] }}" class="fav-shop-list clearfix">
                        <div class="shop-card clearfix">
                            <div class="logo">
                                <a href="{{ route('pc_shop_home',['shop_id'=>$v['shop_id']]) }}" target="_blank">
                                    <img class="logo-img" src="{{ get_image_url($v['shop_image'], 'shop_image') }}" />
                                </a>
                            </div>
                            <div class="seller">
                                <img src="/images/shop-type/shop-icon{{ $v['shop_type'] }}.png" />
                                <a href="{{ route('pc_shop_home',['shop_id'=>$v['shop_id']]) }}" target="_blank" class="seller-link">{{ $v['shop_name'] }}</a>
                                @if(!empty($customer_main))
                                    {{--客服工具 默认0 0无客服 1QQ 2旺旺--}}
                                    @if($customer_main['customer_tool'] == 2)
                                        <span class="ww-light">
                                <!-- 旺旺不在线 i 标签的 class="ww-offline" -->

                                            <!-- s等于1时带文字，等于2时不带文字 -->
                                <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $customer_main['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid={{ $customer_main['customer_account'] }}&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
                                    <span></span>
                                </a>

                            </span>
                                    @elseif($customer_main['customer_tool'] == 1)
                                    <!-- s等于1时带文字，等于2时不带文字 -->
                                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $customer_main['customer_account'] }}&site=qq&menu=yes" class="service-btn">
                                            <img border="0" onload="load_qq_customer_image(this, 'http://')" src="http://wpa.qq.com/pa?p=2:{{ $customer_main['customer_account'] }}:52" alt="QQ" title="" style="height: 20px;" />
                                            <span></span>
                                        </a>
                                    @else{{--默认 平台客服--}}
                                    <a href='{{ $customer_main['yikf_url'] ?? 'javascript:;' }}' class="ww-light  color" target="_blank" title="点击联系在线客服">
                                        <i class="iconfont">&#xe6ad;</i>
                                    </a>
                                @endif
                            @endif

                                @if($v['is_buyed'])
                                <span class="buyed">已购</span>
                                @endif
                            </div>
                            <div class="delete">
                                <!---->
                                <a data-fig="1" name="shop{{ $v['collect_id'] }}" title="删除店铺"><i class="iconfont"></i></a>
                                <!---->
                            </div>
                        </div>
                        <div class="item-list-box">
                            <div class="item-list">
                                <ul class="item-list-ul cleatfix">
                                    <!---->
                                    @if(!empty($v['goods_list']))
                                        @foreach($v['goods_list'] as $goods)
                                            <li class="item-box first">
                                                <a href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" title="{{ $goods['goods_name'] }}" target="_blank">
                                                    <img class="item-img" src="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="{{ $goods['goods_name'] }}">
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="edit-pop">
                            <input type="hidden" class="form-control" value="{{ $v['collect_id'] }}">
                            <div class="edit-pop-bg"></div>
                            <div class="edit-pop-btn">
                                <i class="edit-icon"></i>
                                <div class="item-pk-txt"></div>
                            </div>
                        </div>
                    </li>
            @endforeach
            <!---->

            </ul>
            <form name="selectPageForm" action="" method="get">
                <!--分页-->
                <div class="page">
                    <div class="page-wrap fr">
                        {!! $pageHtml !!}
                    </div>
                </div>
            </form>
        @else
            <div class="tip-box">
                <img src="/images/noresult.png" class="tip-icon">
                <div class="tip-text">暂无关注的店铺</div>
            </div>
        @endif

    </div>
    <!-- 全部店铺 _end -->
</div>