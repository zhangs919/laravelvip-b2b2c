<!-- 手机端商品促销模板 m_activity_s2 -->
<!-- 默认缓载图片 -->

<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>

    <div class="together-group-box">

        @if($tpl_name != '' && $is_design)
            <a title="编辑" class="goods-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="7" data-act_type="6" data-number="10" data-title="拼团活动" data-width="980">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

            @if(!empty($data['7-1']))
                @foreach($data['7-1'] as $v)
                    <div class="goods-box">
                        <div class="goods-image">
                            <a href="javascript:void(0)" title="金色喀秋莎1000克/包玉米面条" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; display: block; background-size: 100px;">

                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/images/2019/01/11/15471852565412.jpg" />

                            </a>
                            <!--售罄-->
                            <p class="goods-name">
                                <a href="javascript:void(0)" title="金色喀秋莎1000克/包玉米面条">金色喀秋莎1000克/包玉米面条</a>
                            </p>
                        </div>
                        <div class="detail">
                            <div class="goods-info">
                                <div class="shop-name">
                                    <a href="/shop/1">
                                        <i></i>
                                        乐融沃
                                    </a>
                                </div>
                                <div class="goods-price">
                                    <span class="sale-price"> ￥6.00 </span>
                                    <del class="normal-price">单买价￥9.00</del>
                                </div>
                            </div>
                            <div class="core">
                                <a href="javascript:void(0)">
                                    <span>2人团</span>
                                    <span class="tmp"></span>
                                    <span>去开团</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="goods-box">
                    <div class="goods-image">
                        <a href="javascript:void(0)" class="example-text">
                            <span> 示例产品 </span>
                        </a>
                        <!--售罄-->
                        <p class="goods-name">
                            <a href="javascript:void(0)">商品名称</a>
                        </p>
                    </div>
                    <div class="detail">
                        <div class="goods-info">
                            <div class="shop-name">
                                <a href="javascript:void(0)">
                                    <i></i>
                                    店铺名称
                                </a>
                            </div>
                            <div class="goods-price">
                                <span class="sale-price"> ￥0.00 </span>
                                <del class="normal-price">单买价￥0.00</del>
                            </div>
                        </div>
                        <div class="core">
                            <a href="javascript:void(0)">
                                <span>33人团</span>
                                <span class="tmp"></span>
                                <span>去开团</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif


    </div>

</div>