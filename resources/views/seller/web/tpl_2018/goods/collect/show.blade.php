{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="CollectModel" class="form-horizontal" name="CollectModel" action="/goods/collect/show.html" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_csrf" value="jummq7LCLwNUwjNhVuUAnhg3VWG7DYllLlJmrFI9iAfvs8eS2ZBAexWveCpk1HL3cWF4GINE-iQfPineA3zEVQ==">
            <!-- 采集商品id -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectmodel-goods_ids" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">批量商品详情链接：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <textarea id="collectmodel-goods_ids" class="form-control w500" name="CollectModel[goods_ids]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">多个商品详情链接，用回车隔开,<br>最多一次填写20条商品详情链接<br>eg:https://item.taobao.com/item.htm?<b>id=521436856623</b></div></div>
                    </div>
                </div>
            </div>
            <!-- 是否采集评论 -->
            <!-- <div class="simple-form-field" >
    <div class="form-group">
    <label for="collectmodel-is_comment" class="col-sm-4 control-label">

    <span class="ng-binding">采集评论：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">
     -->

            <input type="hidden" id="collectmodel-is_comment" class="form-control" name="CollectModel[is_comment]">

            <!--
    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">是否采集评论，如果是，仅采集前5条记录</div></div>
    </div>
    </div>
    </div> -->
            <!-- 是否采集销量 -->
            <!-- <div class="simple-form-field" >
    <div class="form-group">
    <label for="collectmodel-is_sale" class="col-sm-4 control-label">

    <span class="ng-binding">采集销量：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">
     -->

            <input type="hidden" id="collectmodel-is_sale" class="form-control" name="CollectModel[is_sale]">

            <!--
    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">是否采集第三方的销量</div></div>
    </div>
    </div>
    </div> -->
            <!-- 价格变动 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">价格变动：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control m-r-10" name="CollectModel[price][sige]">
                                <option value="1">+</option>
                                <option value="2">-</option>
                                <option value="3">*</option>
                                <option value="4">/</option>

                            </select>
                            <input class="form-control ipt" placeholder="" name="CollectModel[price][num]" min="0" number="true" type="text" value="0">
                        </div>
                        <div class="help-block help-block-t">在数字前台填写[+ - * /]表示算法，如原价调高2倍，则写成*2</div>
                    </div>
                </div>
            </div>
            <!-- 库存变动 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">商品库存：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control m-r-10" name="CollectModel[stock][sige]">
                                <option value="1">+</option>
                                <option value="2">-</option>
                                <option value="3">*</option>
                                <option value="4">/</option>

                            </select>
                            <input class="form-control ipt" placeholder="" name="CollectModel[stock][num]" type="text" value="0" data-rule-min="0" data-rule-digits="true">
                        </div>
                        <div class="help-block help-block-t">在数字前台填写[+ - * /]表示算法，如库存调高2倍，则写成*2</div>
                    </div>
                </div>
            </div>

            <!-- 所属分类 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectmodel-goods_category" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">放入商品分类：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="uploadmodel-category" name="CollectModel[goods_category]" class="chosen-select">


                                <option value="">-- 请选择 --</option>



                                <option value="604"  disabled="true"><span>◢</span>&nbsp;文化社区</option>



                                <option value="610"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;2018款自动四驱</option>



                                <option value="617" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;123</option>



                                <option value="271" >文化动态</option>



                                <option value="306"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;新鲜水果</option>



                                <option value="328" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时令水果</option>



                                <option value="330" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;苹果</option>



                                <option value="332" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;奇异果</option>



                                <option value="333" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大樱桃</option>



                                <option value="334" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;芒果</option>



                                <option value="336" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;梨</option>



                                <option value="337" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;桔</option>



                                <option value="338" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;柠檬</option>



                                <option value="307"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;海鲜水产</option>



                                <option value="340" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;虾</option>



                                <option value="342" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;蟹</option>



                                <option value="343" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;贝</option>



                                <option value="344" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;海参</option>



                                <option value="345" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;海产干货</option>



                                <option value="346" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;海产礼盒</option>



                                <option value="347" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;小龙虾</option>



                                <option value="348" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;三文鱼</option>



                                <option value="350" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;鳕鱼</option>



                                <option value="351" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;扇贝</option>



                                <option value="586" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 进口葡萄酒 </option>



                                <option value="308"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;猪牛羊肉</option>



                                <option value="352" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛肉</option>



                                <option value="353" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;羊肉</option>



                                <option value="354" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;猪肉</option>



                                <option value="355" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛排</option>



                                <option value="356" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛腩</option>



                                <option value="357" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛腱</option>



                                <option value="358" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛肉卷</option>



                                <option value="359" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;羊肉卷</option>



                                <option value="360" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;猪肘</option>



                                <option value="309"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;新鲜蔬菜</option>



                                <option value="361" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;叶菜类</option>



                                <option value="362" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;茄果瓜类</option>



                                <option value="364" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;鲜菌菇</option>



                                <option value="365" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;葱姜蒜椒</option>



                                <option value="366" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;半加工蔬菜</option>



                                <option value="310"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;速冻食品</option>



                                <option value="367" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;水饺</option>



                                <option value="368" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;汤圆</option>



                                <option value="369" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;面点</option>



                                <option value="370" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;火锅丸串</option>



                                <option value="371" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;方便菜</option>



                                <option value="372" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;奶酪</option>



                                <option value="373" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;黄油</option>



                                <option value="311"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;饮品甜品</option>



                                <option value="374" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;酸奶</option>



                                <option value="375" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;鲜奶</option>



                                <option value="376" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冷冻蛋糕</option>



                                <option value="377" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冰激凌</option>



                                <option value="16"  disabled="true"><span>◢</span>&nbsp;文化有约</option>



                                <option value="21"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;逛展览</option>



                                <option value="22"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;5.23</option>



                                <option value="143" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;短外套</option>



                                <option value="23"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;5.24</option>



                                <option value="152" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;连衣裙</option>



                                <option value="156" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;蕾丝连衣裙</option>



                                <option value="162" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;印花连衣裙</option>



                                <option value="213" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真丝连衣裙</option>



                                <option value="222" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;半身裙</option>



                                <option value="26"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;5.26</option>



                                <option value="169" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时尚气质套装</option>



                                <option value="177" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;休闲运动套装</option>



                                <option value="188" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;妈妈装夏款</option>



                                <option value="199" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大码女装</option>



                                <option value="206" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;职业套装</option>



                                <option value="621"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;逛展览</option>



                                <option value="622"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;听讲座</option>



                                <option value="623"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;阅读会</option>



                                <option value="624"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;乐亲子</option>



                                <option value="625"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;公益电影</option>



                                <option value="626"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;精品剧目</option>



                                <option value="627"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;比赛</option>



                                <option value="628"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;场馆设施</option>



                                <option value="269"  disabled="true"><span>◢</span>&nbsp;文游成都</option>



                                <option value="278"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;主题游</option>



                                <option value="283" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;三国游</option>



                                <option value="284" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;武侯祠门票</option>



                                <option value="609" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LeiDaGou</option>



                                <option value="279"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;周末游</option>



                                <option value="287" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;肉干肉脯</option>



                                <option value="286" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;坚果炒货</option>



                                <option value="288" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;蜀绣游玩</option>



                                <option value="289" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;成都博物馆门票</option>



                                <option value="280"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;周边</option>



                                <option value="290" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;穿越历史</option>



                                <option value="291" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;红茶</option>



                                <option value="292" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;绿茶</option>



                                <option value="293" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;乌龙茶</option>



                                <option value="281"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;在线游</option>



                                <option value="294" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛奶乳品</option>



                                <option value="295" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;饮料</option>



                                <option value="296" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冲饮谷物</option>



                                <option value="282"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;粮油调味</option>



                                <option value="297" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;米面杂粮</option>



                                <option value="298" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;食用油</option>



                                <option value="299" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;调味品</option>



                                <option value="300" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;方便食品</option>



                                <option value="595"  disabled="true"><span>◢</span>&nbsp; 饮料/酒水/冲饮</option>



                                <option value="596"  disabled="true"><span>◢</span>&nbsp; 酒类 </option>



                                <option value="597"  disabled="true"><span>◢</span>&nbsp; 白酒 </option>



                                <option value="598"  disabled="true"><span>◢</span>&nbsp; 啤酒 </option>



                                <option value="599"  disabled="true"><span>◢</span>&nbsp; 葡萄酒 </option>



                                <option value="600"  disabled="true"><span>◢</span>&nbsp; 黄酒 </option>



                                <option value="601"  disabled="true"><span>◢</span>&nbsp; 洋酒 </option>



                                <option value="602"  disabled="true"><span>◢</span>&nbsp; 其他酒类 </option>



                                <option value="603"  disabled="true"><span>◢</span>&nbsp; 保健酒 </option>



                                <option value="605"  disabled="true"><span>◢</span>&nbsp;教辅</option>



                                <option value="606"  disabled="true"><span>◢</span>&nbsp;畅销</option>



                                <option value="607"  disabled="true"><span>◢</span>&nbsp; 接口抓取</option>



                                <option value="608"  disabled="true"><span>◢</span>&nbsp; 进口商品</option>



                                <option value="614"  disabled="true"><span>◢</span>&nbsp;化药生物</option>



                                <option value="615"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;心血管</option>



                                <option value="616" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;进口药</option>



                                <option value="618"  disabled="true"><span>◢</span>&nbsp;办公文具</option>



                                <option value="619"  disabled="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;书写工具</option>



                                <option value="620" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;中性笔</option>


                            </select>

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择采集的商品存入到商城的哪个商品分类下</div></div>
                    </div>
                </div>
            </div>
            <!-- 所属类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectmodel-goods_type" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">放入商品类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="uploadmodel-type" name="CollectModel[goods_type]" class="chosen-select">


                                <option value="">-- 请选择 --</option>



                                <option value="1">家用电器</option>



                                <option value="2">手机数码</option>



                                <option value="3">服饰鞋帽</option>



                                <option value="4">食品生鲜</option>



                                <option value="5">家居家纺</option>



                                <option value="6">汽车用品</option>



                                <option value="7">电子图书</option>



                                <option value="8">个护化妆</option>



                                <option value="9">家装建材</option>



                                <option value="10">生活日用</option>



                                <option value="11">化药生物</option>



                                <option value="12">0619</option>



                                <option value="13">88</option>


                            </select>

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择采集的商品存入到商城的哪个商品类型下</div></div>
                    </div>
                </div>
            </div>
            <!-- 运费模板 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectmodel-freight_id" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">运费模板：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <select id="collectmodel-freight_id" class="form-control m-r-5 freight-list" name="CollectModel[freight_id]">
                                <option value="">--请选择--</option>
                                <option value="0">店铺统一运费（￥0）</option>
                                <option value="82">aaa</option>
                                <option value="83">ssss</option>
                            </select>
                            <div class="btn-group m-r-2">
                                <button type="button" data-toggle="dropdown" aria-expanded="true" class="btn btn-warning btn-sm dropdown-toggle">
                                    新建运费模板
                                    <span class="caret m-l-5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/shop/freight/add" target="_blank">新建全国模板</a>
                                    </li>
                                    <li>
                                        <a href="/shop/freight/map-add" target="_blank">新建同城模板</a>
                                    </li>
                                </ul>
                            </div>

                            <a href="javascript:void(0);" class="btn btn-primary btn-sm refresh-freight-list">重新加载</a>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺内商品分类 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectmodel-shop_cat_ids" class="col-sm-3 control-label">

                        <span class="ng-binding">店铺内商品分类：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <div class="control-label div-scroll" style="min-width: 150px;">

                                <label>

                                    <input type="checkbox" name="CollectModel[shop_cat_ids][]" value="690">

                                    生鲜
                                </label>

                                <label>

                                    <input type="checkbox" name="CollectModel[shop_cat_ids][]" value="691" class="cat-two">

                                    水果
                                </label>

                            </div>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 是否上架 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectmodel-goods_status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否上架：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="CollectModel[goods_status]" value="0"><label><input type="checkbox" id="collectmodel-goods_status" class="form-control b-n" name="CollectModel[goods_status]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认采集导入到产品中的商品是下架的</div></div>
                    </div>
                </div>
            </div>
            <!-- 计价方式 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="collectmodel-pricing_mode" class="col-sm-3 control-label">

                        <span class="ng-binding">计价方式：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="hidden" name="CollectModel[pricing_mode]" value=""><div id="collectmodel-pricing_mode" class="" name="CollectModel[pricing_mode]"><label class="control-label cur-p m-r-10"><input type="radio" name="CollectModel[pricing_mode]" value="0" checked> 计件</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="CollectModel[pricing_mode]" value="1"> 计重</label></div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">称重商品，请选择计重</div></div>
                    </div>
                </div>
            </div>

            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <input id="btn_submit" type="button" value="立即采集" class="btn btn-primary btn-lg">
            </div>
        </form>
    </div>
    
@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "collectmodel-goods_ids", "name": "CollectModel[goods_ids]", "attribute": "goods_ids", "rules": {"required":true,"messages":{"required":"批量商品详情链接不能为空。"}}},{"id": "collectmodel-goods_category", "name": "CollectModel[goods_category]", "attribute": "goods_category", "rules": {"required":true,"messages":{"required":"放入商品分类不能为空。"}}},{"id": "collectmodel-goods_type", "name": "CollectModel[goods_type]", "attribute": "goods_type", "rules": {"required":true,"messages":{"required":"放入商品类型不能为空。"}}},{"id": "collectmodel-freight_id", "name": "CollectModel[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"运费模板不能为空。"}}},{"id": "collectmodel-is_comment", "name": "CollectModel[is_comment]", "attribute": "is_comment", "rules": {"default":0,"messages":{"default":""}}},{"id": "collectmodel-is_sale", "name": "CollectModel[is_sale]", "attribute": "is_sale", "rules": {"default":0,"messages":{"default":""}}},]
</script>
    <script type="text/javascript">

        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };
            var validator = $("#CollectModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                if(1){
                    //加载提示
                    $.loading.start();
                    $("#CollectModel").submit();
                }else{
                    $.msg("店铺可采集条数已经不足，请联系平台方！", {
                        time: 5000
                    });
                }
            });

            // 刷新运费模板
            $(".refresh-freight-list").click(function() {
                $.loading.start();
                $.get('/goods/publish/freights', {}, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        var html = "<option value=''>--请选择--</option>";

                        for (var i = 0; i < result.data.length; i++) {
                            var item = result.data[i];
                            html += "<option value='"+item.freight_id+"'>" + item.title + "</option>";
                        }

                        $("#collectmodel-freight_id").html(html);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop