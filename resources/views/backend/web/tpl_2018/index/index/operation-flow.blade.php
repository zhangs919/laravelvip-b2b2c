@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/backend/css/welcome.css">
@stop

@section('content')

    <!--商城角色-->
    <div class="item-type-model"@if ($type != 'role') style="display: none"@endif>
        <h3 class="guide-title guide-line">商城角色</h3>
        <div class="role-module m-t-30">
            <ul>
                <li class="role1 m-l-0">
                    <i class="role-icon"></i>
                    <h4>平台方管理员</h4>
                    <p>1、设置商城基本运营条件，短信、邮件、支付方式、商城基础数据维护；</p>
                    <p>2、商城装修设计；</p>
                    <p>3、商城店铺、会员、交易、退款退货监管等；</p>
                    <p>4、商城账单、财务管理；</p>
                    <p>5、商城会员充值、提现管理。</p>
                </li>
                <li class="role2">
                    <i class="role-icon"></i>
                    <h4>店铺管理员</h4>
                    <p>1、维护店铺信息；</p>
                    <p>2、发布售卖商品；</p>
                    <p>3、处理订单、发货、退款退货；</p>
                    <p>4、店铺营业活动制定；</p>
                    <p>5、店铺财务管理；</p>
                    <p>6、店铺营业统计分析。</p>
                </li>
                <li class="role3">
                    <i class="role-icon"></i>
                    <h4>站点管理员</h4>
                    <p>1、维护站点基本信息；</p>
                    <p>2、站点装修布局设计；</p>
                    <p>3、站点下店铺、会员、交易监管；</p>
                    <p>4、站点下店铺营业活动监管；</p>
                    <p>5、站点账单结算管理。</p>
                </li>
                <li class="role4">
                    <i class="role-icon"></i>
                    <h4>网点管理员</h4>
                    <p>1、网点基本信息维护；</p>
                    <p>2、网点关联售卖的商品；</p>
                    <p>3、接收店铺众包或指派的订单；</p>
                    <p>4、处理订单、发货；</p>
                    <p>5、网点账单结算管理；</p>
                    <p>6、网点销售统计分析。</p>
                </li>
                <li class="role5">
                    <i class="role-icon"></i>
                    <h4>消费者</h4>
                    <p>1、购物；</p>
                    <p>2、申请分销商，拉取会员，分销商品，获取提成；</p>
                    <p>3、积分兑换商品；</p>
                    <p>4、推荐店铺入驻；</p>
                    <p>5、参与团购、拼团、砍价等促销活动；</p>
                    <p>6、取消订单、退款退货、投诉商家、评价商品；</p>
                    <p>7、账户充值、提现。</p>
                </li>
            </ul>
        </div>
    </div>
    <!--会员来源-->
    <div class="item-type-model"@if ($type != 'user') style="display: none"@endif>
        <h3 class="guide-title guide-line">会员来源</h3>
        <div class="guide-content">
            <img class="guide-content-image" src="/backend/images/guide/member-source.jpg" alt="会员来源" width="900">
        </div>
    </div>
    <!--店铺来源-->
    <div class="item-type-model"@if ($type != 'shop') style="display: none"@endif>
        <h3 class="guide-title guide-line">店铺来源</h3>
        <div class="guide-content">
            <img class="guide-content-image" src="/backend/images/guide/shop-source.jpg" alt="店铺来源" width="900">
        </div>
    </div>
    <!--商品数据来源-->
    <div class="item-type-model"@if ($type != 'goods') style="display: none"@endif>
        <h3 class="guide-title guide-line">商品数据来源</h3>
        <div class="guide-content">
            <img class="guide-content-image" src="/backend/images/guide/goods-source.jpg" alt="商品数据来源" width="900">
        </div>
    </div>
    <!--交易管理-->
    <div class="item-type-model"@if ($type != 'trade') style="display: none"@endif>
        <h3 class="guide-title guide-line">交易管理</h3>
        <div class="guide-content">
            <img class="guide-content-image" src="/backend/images/guide/trade.jpg" alt="交易管理" width="900">
        </div>
    </div>
    <!--佣金计算及账单结算-->
    <div class="item-type-model"@if ($type != 'bill') style="display: none"@endif>
        <h3 class="guide-title guide-line">佣金计算及账单结算</h3>
        <h5 class="guide-title text-l">佣金计算方式</h5>
        <div class="guide-content row" style="min-height: auto; padding-bottom: 10px;">
            <div class="col-sm-6" style="border-right: 1px solid #ddd;">
                <div class="guide-content-title pos-r" style="left: 10px; top: 0px;">【一、按商品分类计算佣金】</div>
                <p class="p-20">
                    <span class="c-red">举例说明：</span>
                    A、B商品所属的商品分类的佣金比例不同，则
                    <br>
                    平台佣金 = （A商品金额 * 购买数量 - A商品均分店铺红包和优惠金额）* A商品所属商品分类佣金比例）+ （B商品金额 * 购买数量 - B商品均分店铺红包和优惠金额）* B商品所属商品分类佣金比例）。
                    <br>
                    <br>
                    店铺预计收入 = 消费者实际支付金额（商品总金额 - 店铺红包 - 店铺优惠 - 平台红包 + 运费）- 平台佣金 + 平台红包。
                </p>

            </div>
            <div class="col-sm-6">
                <div class="guide-content-title pos-r" style="left: 10px; top: 0px;">【二、按店铺计算佣金】</div>
                <p class="p-20">
                    <span class="c-red">举例说明：</span>
                    统一按店铺设置的佣金比例进行计算佣金，则
                    <br>
                    平台佣金 =（商品总金额 - 店铺红包 - 店铺优惠）* 店铺佣金比例。
                    <br>
                    <br>
                    店铺预计收入 = 消费者实际支付金额（商品总金额 - 店铺红包 - 店铺优惠 - 平台红包 + 运费）- 平台佣金 + 平台红包。
                </p>
            </div>

        </div>
        <h5 class="guide-title text-l">账单结算</h5>
        <div class="guide-content">
            <img class="guide-content-image" src="/backend/images/guide/bill.jpg" alt="账单结算" width="900">
        </div>
    </div>
    <!--提现流程-->
    <div class="item-type-model"@if ($type != 'deposit') style="display: none"@endif>
        <h3 class="guide-title guide-line">提现流程</h3>
        <div class="guide-content">
            <img class="guide-content-image" src="/backend/images/guide/withdraw-cash.jpg" alt="提现流程" width="900">
        </div>
    </div>
    <!--分销-->
    <div class="item-type-model"@if ($type != 'distrib') style="display: none"@endif>
        <h3 class="guide-title guide-line">分销流程</h3>
        <div class="guide-content">
            <img class="guide-content-image" src="/backend/images/guide/distribution.jpg" alt="分销流程" width="900">
        </div>
    </div>
    <!--店铺对接嗖嗖快送系统-->
    <div class="item-type-model"@if ($type != 'logistics') style="display: none"@endif>
        <h3 class="guide-title guide-line">店铺对接同城物流系统</h3>
        <div class="guide-content">
            <img class="guide-content-image" src="/backend/images/guide/sousou56.jpg" alt="店铺对接同城物流系统" width="900">
        </div>
    </div>
    <!--店铺对接收银系统-->
    <div class="item-type-model"@if ($type != 'cash') style="display: none"@endif>
        <h3 class="guide-title guide-line">店铺对接收银系统</h3>
        <div class="guide-content">
            <img class="guide-content-image" src="/backend/images/guide/cashier.jpg" alt="店铺对接收银系统" width="900">
        </div>
    </div>
    <!--新手向导-->
    <div class="item-type-model"@if ($type != 'guide') style="display: none"@endif>
        <h3 class="guide-title guide-line">新手向导</h3>
        <div class="guide-box-clear">
            <div class="guide-box-div hide">开通商城系统，苦于无从下手，怎么办？跟随商城指引，配置一目了然！</div>
            <!-- 向导左侧导航 -->
            <div class="guide-box">
                <div class="guide-left">
                    <ul>
                        <li class="selected">接口配置</li>
                        <li>基本信息配置</li>
                        <li>清理数据</li>
                        <li>维护基础数据</li>
                        <li>装修</li>
                        <li>招商入驻</li>
                    </ul>
                </div>
                <div class="guide-center">
                    <div class="guide-item selected">
                        <h5 class="guide-item-title">接口配置</h5>
                        <p class="guide-item-desc m-t-10">接口配置是商城运营的首要工作，未设置将导致商城无法运营</p>
                        <!-- -->
                        <div class="guide-content">
                            <img class="guide-content-image" src="/backend/images/guide/step1.png" alt="第一步：接口配置" width="450">
                            <dl class="step-text left" style="top: 30px; left: 0px;">
                                <dt>1</dt>
                                <dd>
                                    邮件设置，配置后即可正常使用邮件发送验证码等信息，
                                    <a href="/system/config/index?group=smtp" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text left" style="top: 80px; left: 0px;">
                                <dt>2</dt>
                                <dd>
                                    短信设置，配置后即可正常使用短信发送验证码，会员注册等信息，
                                    <a href="/system/sms/sms-config" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text left" style="top: 130px; left: 0px;">
                                <dt>4</dt>
                                <dd>
                                    配置阿里oss，确保数据自我保留，
                                    <a href="/system/config/index?group=alioss" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text left" style="top: 280px; left: 0px;">
                                <dt>3</dt>
                                <dd>
                                    消费者结算选择的支付方式，商城运营必备的头号设置项，
                                    <a href="/mall/payment/list" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text right" style="top: 172px; right: 110px;">
                                <dd class="p-l-0">特殊客服工具，是否配置不影响商城运营</dd>
                            </dl>
                            <dl class="step-text right" style="top: 208px; right: 98px;">
                                <dd class="p-l-0">精准的定位配置，是否配置不影响商城经营</dd>
                            </dl>
                            <dl class="step-text right" style="top: 250px; right: 110px;">
                                <dd class="p-l-0">商城第三登录方式，是否配置可自行决定</dd>
                            </dl>
                            <dl class="step-text right" style="top: 320px; right: 85px;">
                                <dd class="p-l-0">发货预使用电子面单，则需要配置此设置项，否则可忽略</dd>
                            </dl>
                        </div>
                        <!-- -->
                    </div>
                    <!-- -->
                    <div class="guide-item">
                        <h5 class="guide-item-title">基本信息配置</h5>
                        <p class="guide-item-desc m-t-10">接口配置是商城运营的首要工作，商城基本配置信息，未设置将影响商城展示、商家入驻等</p>
                        <!-- -->
                        <div class="guide-content">
                            <img class="guide-content-image" src="/backend/images/guide/step2.png" alt="第二步：基本信息配置" width="600">
                            <dl class="step-text left" style="top: 30px; left: 10px; width: 160px">
                                <dt>1</dt>
                                <dd>
                                    网址设置，主要是将网站名称、头像、后台logo、版权等信息进行调整，更换为自己商城的标志，
                                    <a href="/system/config/index?group=website" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text right" style="top: 20px; right:15px; width: 170px">
                                <dt>2</dt>
                                <dd>
                                    商城设置，主要是更换商城logo、填写商城信息、以及入驻或注册协议，确保商城前台展示，
                                    <a href="/system/config/index?group=mall" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>

                        </div>
                        <!-- -->
                    </div>
                    <!-- -->
                    <div class="guide-item">
                        <h5 class="guide-item-title">清理数据</h5>
                        <p class="guide-item-desc m-t-10">清理商城初始化店铺、商品、商品分类、会员等数据，只能清理一次数据，慎用。确保商城开始运营时，无垃圾数据存在</p>
                        <!-- -->
                        <div class="guide-content">
                            <img class="guide-content-image" src="/backend/images/guide/step3.png" alt="第三步：清理数据" width="350">
                            <dl class="step-text left" style="top: 240px; left: 40px;">
                                <dd class="p-l-0">
                                    商城运营打理之前，请把系统初始化的店铺、商品、商品分类等数据进行清空，只能清理一次数据，慎用。确保数据最新，
                                    <a href="/system/clear-data/index" target="_blank" class="c-red">去清除</a>
                                </dd>
                            </dl>
                        </div>
                        <!-- -->
                    </div>
                    <!-- -->
                    <div class="guide-item">
                        <h5 class="guide-item-title">维护基础数据</h5>
                        <p class="guide-item-desc m-t-10">基础数据，商城运营必备的设置数据</p>
                        <!-- -->
                        <div class="guide-content">
                            <img class="guide-content-image m-b-30" src="/backend/images/guide/step4.png" alt="第四步：维护基础数据" width="620">
                            <dl class="step-text left" style="top: 240px; left: 0px; width: 150px;">
                                <dt>3</dt>
                                <dd>
                                    发布商品时，需选择的商品分类，
                                    <a href="/goods/category/list" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text left" style="top: 290px; left: 0px; width: 150px;">
                                <dt>2</dt>
                                <dd>
                                    添加商品分类时关联品牌，用于发布商品时选择商品所属品牌，并且品牌将会在前台商品列表展示供筛选，
                                    <a href="/goods/brand/list" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text left" style="top: 410px; left: 160px; max-width: 350px">
                                <dt>1</dt>
                                <dd>
                                    将同一类型的商品属性和规格进行汇总，用于添加商品分类时进行关联，最终应用于发布商品中进行使用，
                                    <a href="/goods/goods-type/list" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text right" style="top: 30px; right: 30px; width: 140px;">
                                <dt>1</dt>
                                <dd>
                                    商城支持商家入驻开店，因此需要设置保证金和使用费，确保商家入驻时明确具体费用，
                                    <a href="/shop/shop-setting/index" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text right" style="top: 300px; right: 30px; width: 140px">
                                <dt>2</dt>
                                <dd>
                                    店铺入驻开店时所 需要选择的店铺经营分类，必须设置，否则会导致商家无法入驻，
                                    <a href="/shop/shop-class/index" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                        </div>

                        <!-- -->
                    </div>
                    <!-- -->
                    <div class="guide-item">
                        <h5 class="guide-item-title">装修</h5>
                        <p class="guide-item-desc m-t-10">装修是为了更好的推广商城，更好的吸纳消费者</p>
                        <!-- -->
                        <div class="guide-content">
                            <img class="guide-content-image" src="/backend/images/guide/step5.png" alt="第五步：装修" width="390" style="margin-left: 190px;">
                            <dl class="step-text left" style="top: 50px; left: 0px;">
                                <dt>5</dt>
                                <dd>
                                    商城首页装修设计，
                                    <a href="/design/tpl-setting/setup" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text right" style="top: 158px; right: 70px; max-width: 280px;">
                                <dt>1</dt>
                                <dd>
                                    商城头部、底部、中间主导航设置，
                                    <a href="/design/navigation/list?nav_page=site&amp;show_all=1" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text right" style="top: 190px; right: 49px; max-width:290px;">
                                <dt>2</dt>
                                <dd>
                                    设置前台登录、注册页面广告，商城首页头部和底部广告，商家入驻提交页面广告，
                                    <a href="/system/config/index?group=login_bg" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text right" style="top: 240px; right: 80px; max-width: 290px;">
                                <dt>3</dt>
                                <dd>
                                    设置商城前台底部图像资质展示，
                                    <a href="/mall/copyright-auth/list" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                            <dl class="step-text right" style="top: 280px; right: 152px;">
                                <dt>4</dt>
                                <dd>
                                    商城前台底部展示，
                                    <a href="/mall/links/list" target="_blank" class="c-red">去设置</a>
                                </dd>
                            </dl>
                        </div>

                        <!-- -->
                    </div>
                    <!-- -->
                    <div class="guide-item">
                        <h5 class="guide-item-title">招商入驻</h5>
                        <p class="guide-item-desc m-t-10">前五步设置完成后，即可开始招商入驻啦！商城包含“自营”和“入驻”两种经营方式</p>
                        <!-- -->
                        <div class="guide-content">
                            <img class="guide-content-image" src="/backend/images/guide/step6.jpg" alt="第六步：招商入驻" width="900">
                        </div>

                        <!-- -->
                    </div>
                    <!-- -->
                </div>
            </div>
        </div>

        <div class="p-t-20" style="display: none;">
            <!--第一步-->
            <div style="display: block" class="page-1 m-b-30">
                <div class="p-b-30">
                    <h3 class="guide-title">开通商城系统，苦于无从下手，怎么办？跟随商城指引，配置一目了然！</h3>
                    <div class="guide-step">
                        <span class="selected">接口配置</span>
                        <span>基本信息配置</span>
                        <span>清理数据</span>
                        <span>维护基础数据</span>
                        <span>装修</span>
                        <span>招商入驻</span>
                    </div>
                    <p class="guide-desc">
                        <span class="c-red">接口配置是商城运营的首要工作，未设置将导致商城无法运营</span>
                    </p>
                    <div class="guide-content">
                        <img class="guide-content-image" src="/backend/images/guide/step1.png" alt="第一步：接口配置" width="505">
                        <dl class="step-text left" style="top: 40px; left: 50px;">
                            <dt>1</dt>
                            <dd>
                                邮件设置，配置后即可正常使用邮件发送验证码等信息，
                                <a href="/system/config/index?group=smtp" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text left" style="top: 100px; left: 50px;">
                            <dt>2</dt>
                            <dd>
                                短信设置，配置后即可正常使用短信发送验证码，会员注册等信息，
                                <a href="/system/sms/sms-config" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text left" style="top: 150px; left: 50px;">
                            <dt>4</dt>
                            <dd>
                                配置阿里oss，确保数据自我保留，
                                <a href="/system/config/index?group=alioss" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text left" style="top: 310px; left: 50px;">
                            <dt>3</dt>
                            <dd>
                                消费者结算选择的支付方式，商城运营必备的头号设置项，
                                <a href="/mall/payment/list" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text right" style="top: 192px; right: 170px;">
                            <dd class="p-l-0">特殊客服工具，是否配置不影响商城运营</dd>
                        </dl>
                        <dl class="step-text right" style="top: 238px; right: 160px;">
                            <dd class="p-l-0">精准的定位配置，是否配置不影响商城经营</dd>
                        </dl>
                        <dl class="step-text right" style="top: 280px; right: 170px;">
                            <dd class="p-l-0">商城第三登录方式，是否配置可自行决定</dd>
                        </dl>
                        <dl class="step-text right" style="top: 360px; right: 150px;">
                            <dd class="p-l-0">发货预使用电子面单，则需要配置此设置项，否则可忽略</dd>
                        </dl>


                    </div>
                </div>
                <div class="text-c">
                    <button class="btn btn-primary next m-l-5" data-current="1" data-next="2">已了解，下一步设置</button>
                </div>
            </div>
            <!--第二步-->
            <div style="display: none" class="page-2 m-b-30">
                <div class="p-b-30">
                    <h3 class="guide-title">开通商城系统，苦于无从下手，怎么办？跟随商城指引，配置一目了然！</h3>
                    <div class="guide-step">
                        <span>接口配置</span>
                        <span class="selected">基本信息配置</span>
                        <span>清理数据</span>
                        <span>维护基础数据</span>
                        <span>装修</span>
                        <span>招商入驻</span>
                    </div>
                    <p class="guide-desc">
                        <span class="c-red">商城基本配置信息，未设置将影响商城展示、商家入驻等</span>
                    </p>
                    <div class="guide-content">
                        <img class="guide-content-image" src="/backend/images/guide/step2.png" alt="第二步：基本信息配置" width="705">
                        <dl class="step-text left" style="top: 40px; left: 20px; width: 160px">
                            <dt>1</dt>
                            <dd>
                                网址设置，主要是将网站名称、头像、后台logo、版权等信息进行调整，更换为自己商城的标志，
                                <a href="/system/config/index?group=website" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text right" style="top: 30px; right: 20px; width: 170px">
                            <dt>2</dt>
                            <dd>
                                商城设置，主要是更换商城logo、填写商城信息、以及入驻或注册协议，确保商城前台展示，
                                <a href="/system/config/index?group=mall" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>

                    </div>
                </div>
                <div class="text-c">
                    <button class="btn btn-primary pre" data-current="2" data-pre="1">上一步</button>
                    <button class="btn btn-primary next m-l-5" data-current="2" data-next="3">已了解，下一步设置</button>
                </div>
            </div>
            <!--第三步-->
            <div style="display: none" class="page-3 m-b-30">
                <div class="p-b-30">
                    <h3 class="guide-title">开通商城系统，苦于无从下手，怎么办？跟随商城指引，配置一目了然！</h3>
                    <div class="guide-step">
                        <span>接口配置</span>
                        <span>基本信息配置</span>
                        <span class="selected">清理数据</span>
                        <span>维护基础数据</span>
                        <span>装修</span>
                        <span>招商入驻</span>
                    </div>
                    <p class="guide-desc">
                        <span class="c-red">清理商城初始化店铺、商品、商品分类、会员等数据，确保商城开始运营时，无垃圾数据存在</span>
                    </p>
                    <div class="guide-content">
                        <img class="guide-content-image" src="/backend/images/guide/step3.png" alt="第三步：清理数据" width="380">
                        <dl class="step-text left" style="top: 280px; left: 95px;">
                            <dd class="p-l-0">
                                商城运营打理之前，请把系统初始化的店铺、商品、商品分类等数据进行清空，确保数据最新，
                                <a href="/system/clear-data/index" target="_blank" class="c-red">去清除</a>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="text-c">
                    <button class="btn btn-primary pre" data-current="3" data-pre="2">上一步</button>
                    <button class="btn btn-primary next m-l-5" data-current="3" data-next="4">已了解，下一步设置</button>
                </div>
            </div>
            <!--第四步-->
            <div style="display: none" class="page-4 m-b-30">
                <div class="p-b-30">
                    <h3 class="guide-title">开通商城系统，苦于无从下手，怎么办？跟随商城指引，配置一目了然！</h3>
                    <div class="guide-step">
                        <span>接口配置</span>
                        <span>基本信息配置</span>
                        <span>清理数据</span>
                        <span class="selected">维护基础数据</span>
                        <span>装修</span>
                        <span>招商入驻</span>
                    </div>
                    <p class="guide-desc">
                        <span class="c-red">基础数据，商城运营必备的设置数据</span>
                    </p>
                    <div class="guide-content">
                        <img class="guide-content-image m-b-30" src="/backend/images/guide/step4.png" alt="第四步：维护基础数据" width="760">
                        <dl class="step-text left" style="top: 270px; left: 30px; width: 120px;">
                            <dt>3</dt>
                            <dd>
                                发布商品时，需选择的商品分类，
                                <a href="/goods/category/list" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text left" style="top: 350px; left: 30px; width: 120px;">
                            <dt>2</dt>
                            <dd>
                                添加商品分类时关联品牌，用于发布商品时选择商品所属品牌，并且品牌将会在前台商品列表展示供筛选，
                                <a href="/goods/brand/list" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text left" style="top: 500px; left: 160px; max-width: 350px">
                            <dt>1</dt>
                            <dd>
                                将同一类型的商品属性和规格进行汇总，用于添加商品分类时进行关联，最终应用于发布商品中进行使用，
                                <a href="/goods/goods-type/list" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text right" style="top: 30px; right: 40px; width: 140px;">
                            <dt>1</dt>
                            <dd>
                                商城支持商家入驻开店，因此需要设置保证金和使用费，确保商家入驻时明确具体费用，
                                <a href="/shop/shop-setting/index" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text right" style="top: 360px; right: 40px; width: 140px">
                            <dt>2</dt>
                            <dd>
                                店铺入驻开店时所 需要选择的店铺经营分类，必须设置，否则会导致商家无法入驻，
                                <a href="/shop/shop-class/index" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="text-c">
                    <button class="btn btn-primary pre" data-current="4" data-pre="3">上一步</button>
                    <button class="btn btn-primary next m-l-5" data-current="4" data-next="5">已了解，下一步设置</button>
                </div>
            </div>
            <!--第五步-->
            <div style="display: none" class="page-5 m-b-30">
                <div class="p-b-30">
                    <h3 class="guide-title">开通商城系统，苦于无从下手，怎么办？跟随商城指引，配置一目了然！</h3>
                    <div class="guide-step">
                        <span>接口配置</span>
                        <span>基本信息配置</span>
                        <span>清理数据</span>
                        <span>维护基础数据</span>
                        <span class="selected">装修</span>
                        <span>招商入驻</span>
                    </div>
                    <p class="guide-desc">
                        <span class="c-red">装修是为了更好的推广商城，更好的吸纳消费者。</span>
                    </p>
                    <div class="guide-content">
                        <img class="guide-content-image" src="/backend/images/guide/step5.png" alt="第五步：装修" width="452">
                        <dl class="step-text left" style="top: 60px; left: 120px;">
                            <dt>5</dt>
                            <dd>
                                商城首页装修设计，
                                <a href="/design/tpl-setting/setup" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text right" style="top: 165px; right: 60px;">
                            <dt>1</dt>
                            <dd>
                                商城头部、底部、中间主导航设置，
                                <a href="/design/navigation/list?nav_page=site&amp;show_all=1" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text right" style="top: 215px; right: 60px;">
                            <dt>2</dt>
                            <dd>
                                设置前台登录、注册页面广告，商城首页头部和底部广告，商家入驻提交页面广告，
                                <a href="/system/config/index?group=login_bg" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text right" style="top: 280px; right: 60px;">
                            <dt>3</dt>
                            <dd>
                                设置商城前台底部图像资质展示，
                                <a href="/mall/copyright-auth/list" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                        <dl class="step-text right" style="top: 325px; right: 113px;">
                            <dt>4</dt>
                            <dd>
                                商城前台底部展示，
                                <a href="/mall/links/list" target="_blank" class="c-red">去设置</a>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="text-c">
                    <button class="btn btn-primary pre" data-current="5" data-pre="4">上一步</button>
                    <button class="btn btn-primary next m-l-5" data-current="5" data-next="6">已了解，下一步设置</button>
                </div>
            </div>
            <!--第六步-->
            <div style="display: none" class="page-6 m-b-30">
                <div class="p-b-30">
                    <h3 class="guide-title">开通商城系统，苦于无从下手，怎么办？跟随商城指引，配置一目了然！</h3>
                    <div class="guide-step">
                        <span>接口配置</span>
                        <span>基本信息配置</span>
                        <span>清理数据</span>
                        <span>维护基础数据</span>
                        <span>装修</span>
                        <span class="selected">招商入驻</span>
                    </div>
                    <p class="guide-desc">
                        <span class="c-red">前五步设置完成后，即可开始招商入驻啦！商城包含"自营"和"入驻"两种经营方式。</span>
                    </p>
                    <div class="guide-content">
                        <img class="guide-content-image" src="/backend/images/guide/step6.jpg" alt="第六步：招商入驻" width="900">
                    </div>

                </div>
                <div class="text-c">
                    <button class="btn btn-primary pre" data-current="6" data-pre="5">上一步</button>
                </div>
            </div>
            <!-- -->
        </div>
        <script type="text/javascript">
            $().ready(function() {
                $('#next_display').click(function() {
                    var data = 0;
                    if ($(this).is(':checked')) {
                        data = 1;
                    }

                    $.get("/index/index/guide-show.html", {
                        data: data
                    }, function(result) {
                    });

                });
                $('.next').click(function() {
                    var curren = $(this).data('current');
                    var next = $(this).data('next');
                    if (curren == 6) {
                        $.closeAll();
                    }
                    $('.page-' + curren).hide();
                    $('.page-' + next).show();

                });
                $('.pre').click(function() {
                    var curren = $(this).data('current');
                    var pre = $(this).data('pre');
                    $('.page-' + curren).hide();
                    $('.page-' + pre).show();
                });

                /*新手向导鼠标滑过切换tab*/
                function mouseover_tabs(a,b,c){
                    $(a).mouseover(function(){
                        $(this).addClass(c).siblings().removeClass(c);
                        $(b).eq($(this).index()).show().siblings().hide();
                    })
                }
                mouseover_tabs(".guide-left li",".guide-center .guide-item",'selected');
            });
        </script>
    </div>

@stop

@section('style_css')
    <style>
        .tab-base.shop-row { margin-left: 0px; float: left;}
        .fixed-bar .item-title h3{ min-width: 100px !important; }
    </style>
@stop