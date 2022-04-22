{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/js/ztree/zTreeStyle.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10"><form id="SearchModel" name="SearchModel" action="/goods/default/list" method="POST">
            {{ csrf_field() }}
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>条形码：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" id="searchmodel-goods_barcode" class="form-control" name="goods_barcode" placeholder="请输入正确的条形码">

                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" id="searchmodel-keyword" class="form-control" name="keyword" placeholder="商品ID/货号/名称">

                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" id="searchmodel-shop_keyword" class="form-control" name="shop_keyword" placeholder="店铺ID/名称">

                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <div id="cat_selector"><div class="form-control-box"><div class="tree-chosen-box"><div class="tree-chosen-input-box form-control"></div><div class="tree-chosen-panel-box" style="display: none;"><input type="text" class="tree-chosen-input form-control-xs m-r-5" value="" placeholder="输入关键词、简拼、全拼搜索" style="width: 200px;"><a class="btn btn-primary btn-sm tree-chosen-btn-open m-r-2" title="全部展开/收起"><i class="fa fa-plus-circle" style="margin-right: 0px;"></i></a><a class="btn btn-primary btn-sm tree-chosen-btn-clear" title="全部清除所选"><i class="fa fa-trash-o" style="margin-right: 0px;"></i></a><div class="ztree-box"><ul id="1518665625260000" class="ztree"><li id="1518665625260000_1" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_1_switch" title="" class="button level0 switch roots_close" treenode_switch=""></span><a id="1518665625260000_1_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="生鲜食品"><span id="1518665625260000_1_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_1_span" class="node_name">生鲜食品</span></a></li><li id="1518665625260000_51" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_51_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_51_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="食品饮料"><span id="1518665625260000_51_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_51_span" class="node_name">食品饮料</span></a></li><li id="1518665625260000_74" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_74_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_74_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="家用电器"><span id="1518665625260000_74_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_74_span" class="node_name">家用电器</span></a></li><li id="1518665625260000_123" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_123_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_123_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="电脑办公"><span id="1518665625260000_123_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_123_span" class="node_name">电脑办公</span></a></li><li id="1518665625260000_180" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_180_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_180_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="手机数码"><span id="1518665625260000_180_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_180_span" class="node_name">手机数码</span></a></li><li id="1518665625260000_228" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_228_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_228_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="女装"><span id="1518665625260000_228_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_228_span" class="node_name">女装</span></a></li><li id="1518665625260000_252" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_252_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_252_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="男装"><span id="1518665625260000_252_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_252_span" class="node_name">男装</span></a></li><li id="1518665625260000_280" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_280_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_280_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="个护化妆"><span id="1518665625260000_280_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_280_span" class="node_name">个护化妆</span></a></li><li id="1518665625260000_313" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_313_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_313_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="箱包鞋帽"><span id="1518665625260000_313_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_313_span" class="node_name">箱包鞋帽</span></a></li><li id="1518665625260000_338" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_338_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_338_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="童装童鞋"><span id="1518665625260000_338_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_338_span" class="node_name">童装童鞋</span></a></li><li id="1518665625260000_356" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_356_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665625260000_356_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="酒水"><span id="1518665625260000_356_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_356_span" class="node_name">酒水</span></a></li><li id="1518665625260000_367" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665625260000_367_switch" title="" class="button level0 switch bottom_close" treenode_switch=""></span><a id="1518665625260000_367_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="家居家装"><span id="1518665625260000_367_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665625260000_367_span" class="node_name">家居家装</span></a></li></ul></div></div></div></div></div>

                        <input type="hidden" id="searchmodel-cat_id" class="form-control" name="cat_id">

                    </div>
                </div>
            </div>

            <div class="simple-form-field toggle">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品状态：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-goods_status" class="form-control" name="goods_status" data-width="120">
                            <option value="">全部</option>
                            <option value="0">已下架</option>
                            <option value="1">出售中</option>
                            <option value="2">违规下架</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>审核状态：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-goods_audit" class="form-control" name="goods_audit" data-width="120">
                            <option value="">全部</option>
                            <option value="0">待审核</option>
                            <option value="1">审核通过</option>
                            <option value="2">审核未通过</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>品牌：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-brand_id" class="form-control chosen-select" name="brand_id" data-width="200" style="display: none;">
                            <option value="">请选择</option>
                            <option value="1">乐视</option>
                            <option value="2">创维</option>
                            <option value="3">飞利浦</option>
                            <option value="4">海信</option>
                            <option value="5">美的</option>
                            <option value="6">奥克斯</option>
                            <option value="7">飞科</option>
                            <option value="8">华帝</option>
                            <option value="9">迪加伦</option>
                            <option value="10">苏泊尔</option>
                            <option value="11">二十一世纪出版社</option>
                            <option value="12">小米</option>
                            <option value="13">明天出版社</option>
                            <option value="14">华为</option>
                            <option value="15">iphone</option>
                            <option value="16">博集天卷</option>
                            <option value="17">HTC</option>
                            <option value="18">oppo</option>
                            <option value="19">磨铁图书</option>
                            <option value="20">三星</option>
                            <option value="21">清华大学出版社</option>
                            <option value="22">魅族</option>
                            <option value="23">机械工业出版社</option>
                            <option value="24">联想</option>
                            <option value="25">人民邮电出版社</option>
                            <option value="26">戴尔</option>
                            <option value="27">vivo</option>
                            <option value="28">汤臣倍健</option>
                            <option value="29">宏碁</option>
                            <option value="30">惠普</option>
                            <option value="31">清华同方</option>
                            <option value="32">华硕</option>
                            <option value="33">爱仕达</option>
                            <option value="34">好事达</option>
                            <option value="35">雷蛇</option>
                            <option value="36">博洋家纺</option>
                            <option value="37">富安娜</option>
                            <option value="38">罗莱</option>
                            <option value="39">世家洁具</option>
                            <option value="40">得力</option>
                            <option value="41">慧乐家</option>
                            <option value="42">金喇叭</option>
                            <option value="43">友臣</option>
                            <option value="44">美好家</option>
                            <option value="45">ONLY</option>
                            <option value="46">伊莲娜</option>
                            <option value="47">猫城</option>
                            <option value="48">韩都衣舍</option>
                            <option value="49">欧司朗</option>
                            <option value="50">稻香村</option>
                            <option value="51">妖精的口袋</option>
                            <option value="52">全友家居</option>
                            <option value="53">花花公子</option>
                            <option value="54">乐事</option>
                            <option value="55">澳优</option>
                            <option value="56">罗蒙</option>
                            <option value="57">茅台</option>
                            <option value="58">NUK</option>
                            <option value="59">强生</option>
                            <option value="60">七匹狼</option>
                            <option value="61">古井贡</option>
                            <option value="62">雀巢</option>
                            <option value="63">战地吉普</option>
                            <option value="64">大洋世家</option>
                            <option value="65">雅培</option>
                            <option value="66">多美</option>
                            <option value="67">安奈儿</option>
                            <option value="68">乐高</option>
                            <option value="69">湾仔码头</option>
                            <option value="70">十月妈咪</option>
                            <option value="71">铭佳童话</option>
                            <option value="72">帮宝适</option>
                            <option value="73">好奇</option>
                            <option value="74">Hipp</option>
                            <option value="75">亨氏</option>
                            <option value="76">雅诗兰黛</option>
                            <option value="77">布朗博士</option>
                            <option value="78">法国兰蔻</option>
                            <option value="79">美孚</option>
                            <option value="80">道达尔</option>
                            <option value="81">妈咪宝贝</option>
                            <option value="82">olay</option>
                            <option value="83">汉高</option>
                            <option value="84">相宜本草</option>
                            <option value="85">百立乐</option>
                            <option value="86">ZA</option>
                            <option value="87">壳牌</option>
                            <option value="88">捷安特</option>
                            <option value="89">韩束</option>
                            <option value="90">乔山</option>
                            <option value="91">法兰琳卡</option>
                            <option value="92">信乐</option>
                            <option value="93">嘉实多</option>
                            <option value="94">温碧泉</option>
                            <option value="95">福斯</option>
                            <option value="96">威尔胜</option>
                            <option value="97">诺可文</option>
                            <option value="98">沙宣</option>
                            <option value="99">斯伯丁</option>
                            <option value="100">潘婷</option>
                            <option value="101">欧亚马</option>
                            <option value="102">火枫</option>
                            <option value="103">飘柔</option>
                            <option value="104">中极星</option>
                            <option value="105">达芙妮</option>
                            <option value="106">361°</option>
                            <option value="107">卡饰社</option>
                            <option value="108">卓诗尼</option>
                            <option value="109">他她</option>
                            <option value="110">纳迪亚N+a</option>
                            <option value="111">UGG</option>
                            <option value="112">百丽</option>
                            <option value="113">双星</option>
                            <option value="114">耐克</option>
                            <option value="115">骆驼</option>
                            <option value="116">李宁</option>
                            <option value="117">鸿星尔克</option>
                            <option value="118">米其林</option>
                            <option value="119">特步</option>
                            <option value="120">安踏</option>
                            <option value="121">puma</option>
                            <option value="122">稻草人</option>
                            <option value="123">古奇</option>
                            <option value="124">欧米茄</option>
                            <option value="125">浪琴</option>
                            <option value="126">天梭</option>
                            <option value="127">格力</option>
                            <option value="128">海尔</option>
                            <option value="129">老板</option>
                            <option value="130">苹果</option>
                            <option value="131">罗技</option>
                            <option value="132">费列罗</option>
                            <option value="133">伊利</option>
                            <option value="134">十月稻田</option>
                            <option value="135">艺福堂</option>
                            <option value="136">拉菲</option>
                            <option value="137">洋河酒厂</option>
                            <option value="138">梦妆</option>
                            <option value="139">迪奥</option>
                            <option value="140">香奈儿</option>
                            <option value="141">卡文克莱</option>
                            <option value="142">乔曼帝</option>
                            <option value="143">安睡宝</option>
                            <option value="144">奔腾</option>
                            <option value="145">三菱电机</option>
                            <option value="146">三洋电池</option>
                            <option value="147">三只松鼠</option>
                            <option value="148">鲜农乐</option>
                            <option value="149">.</option>
                            <option value="150">ロケット石鹸</option>
                            <option value="151">M·S·U/真想您</option>
                            <option value="152">潤佳</option>
                            <option value="153">669</option>
                            <option value="154">内斯蒂·丹特</option>
                            <option value="155">德·亿龙</option>
                            <option value="156">M·LEAD/摩兰迪</option>
                            <option value="157">1000Billion</option>
                            <option value="158">365ROSE/365朵玫瑰</option>
                            <option value="159">MENOW/美·诺</option>
                            <option value="160">3097</option>
                            <option value="161">咔咪咔咪</option>
                            <option value="162">Schuhmann Beautiful/舒曼·佳</option>
                            <option value="163">yesland 雅熙·莱帝</option>
                            <option value="164">1320/一生爱你</option>
                            <option value="165">383</option>
                            <option value="166">900</option>
                            <option value="167">500Year</option>
                            <option value="168">1900</option>
                            <option value="169">咪啵</option>
                            <option value="170">198ZCORY</option>
                            <option value="171">1825</option>
                            <option value="172">柏梭</option>
                            <option value="173">浪漫之花</option>
                            <option value="174">Suamgy/圣芝</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>销售模式：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-sales_model" class="form-control" name="sales_model" data-width="120">
                            <option value="">全部</option>
                            <option value="0">零售</option>
                            <option value="1">批发</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="button" id="btn_search" value="搜索" class="btn btn-primary m-r-5">

                <input type="button" id="btn_export" value="导出" class="btn btn-default m-r-5">

                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>
        <script type="text/javascript">
            $().ready(function() {
                $("input[name=goods_barcode]").focus();
                //条形码扫描触发事件
                $("input[type=text]").bind("keypress", function(event) {
                    if (event.keyCode == "13") {
                        $("#btn_search").click();
                    }
                });
            })
        </script>
    </div>
    <!-- 工具栏（列表名称、列表显示项设置） -->

    <div class="common-title">
        <div class="ftitle">
            <h3>商品列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('goods.default.partials._list')

    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            // 查看SKU列表
            $("body").on("click", ".sku-list", function() {
                var goods_id = $(this).data("goods-id");

                $.modal({
                    title: "商品 #" + goods_id + " 的SKU列表",
                    width: 800,
                    ajax: {
                        url: '/goods/default/sku-list',
                        data: {
                            goods_id: goods_id
                        }
                    }
                });

            });

            // 下架
            $("body").on("click", ".offsale-goods", function() {
                var id = $(this).data("id");
                $.modal({
                    title: '违规商品',
                    width: 550,
                    ajax: {
                        url: '/goods/publish/illegal',
                        data: {
                            id: id
                        }
                    },
                });
            });

            // 批量下架
            $("body").on("click", ".batch-offsale-goods", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }

                $.loading.start();
                $.post('/goods/publish/batch-illegal', {
                    ids: ids
                }, function(result) {
                    $.loading.stop();
                    $.msg(result.message);
                    tablelist.load();
                }, "json");
            });

            $("body").on("click", ".audit-goods", function() {
                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择要审核的商品");
                    return;
                }

                $.modal({
                    title: '审核商品',
                    width: 500,
                    params: {
                        tablelist: tablelist
                    },
                    ajax: {
                        url: '/goods/publish/audit',
                        data: {
                            ids: ids
                        }
                    },
                });
            });

            $("body").on("click", ".onsale-goods", function() {
                var id = $(this).data("id");
                $.loading.start();
                $.post("/goods/publish/onsale?", {
                    id: id
                }, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message, {}, function() {
                            tablelist.load();
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });

            // 批量上架
            $("body").on("click", ".batch-onsale-goods", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }

                $.loading.start();
                $.post('/goods/publish/batch-onsale', {
                    ids: ids
                }, function(result) {
                    $.loading.stop();
                    $.msg(result.message);
                    tablelist.load();
                }, "json");
            });

            $("#btn_search").click(function() {
                var data = $("#SearchModel").serializeJson();
                tablelist.load(data);
            });

            $("#btn_export").click(function() {
                var url = "/goods/default/export.html";
                url += "?goods_barcode=" + $("#searchmodel-goods_barcode").val();
                url += "&keyword=" + $("#searchmodel-keyword").val();
                url += "&shop_keyword=" + $("#searchmodel-shop_keyword").val();
                url += "&cat_id=" + $("#searchmodel-cat_id").val();
                url += "&goods_status=" + $("#searchmodel-goods_status").val();
                url += "&goods_audit=" + $("#searchmodel-goods_audit").val();
                url += "&brand_id=" + $("#searchmodel-brand_id").val();
                url += "&is_supply=" + $("#searchmodel-is_supply").val();

                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, "_blank", false);
            });

            $("body").on("mouseover", ".QR-code", function() {
                if ($(this).data("loading")) {
                    return;
                }
                var target = $(this).find("img");
                var src = $(target).data("src");
                var img = new Image();
                img.src = src;
                img.onload = function() {
                    $(target).attr("src", src);
                };
                $(this).data("loading", true);
            });

            $("#btn_build_goods_region").click(function() {

                $.confirm("【此功能用于解决导入商品、采集商品时由于未处理商品与分类的关联关系造成的前台商品列表查询不出来的问题，后期此功能将会被移除】您确定要重新构建商品-分类关联关系吗？当前操作可能会花费很长时间而且请勿中断！", function() {
                    $.progress({
                        url: '/goods/default/build-goods-region.html',
                        key: 'build-goods-region-by-freight',
                    });
                });

            });

            $("body").on("mouseover", ".goods-reason", function() {
                $.tips($(this).data("goods-reason"), $(this));
            });

            $("body").on("mouseout", ".goods-reason", function() {
                $.closeAll("tips");
            });

            var catselector = $("#cat_selector").catselector({
                size: 1,
                data: {
                    deep: 3
                },
                change: function() {
                    var cat_ids = this.getValues().join(",");
                    $("#searchmodel-cat_id").val(cat_ids);
                }
            });

            catselector.load();
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            // 商品名称
            $(".goods-sort").editable({
                type: "text",
                url: "/goods/default/edit-goods-info",
                pk: 1,
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'goods_sort';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    if (!value) {
                        return '商品排序不能为空。';
                    } else if (value > 255) {
                        return '商品排序必须是一个不大于255的整数。';
                    } else if (value < 0) {
                        return '商品排序必须是一个不小于0的整数。';
                    } else if (!/^\d+$/.test(value)) {
                        return '商品排序必须是一个整数。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function(value, sourceData) {
                    $(this).html(value);
                }
            });
        });
    </script>
    
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop