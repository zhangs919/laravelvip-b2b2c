{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/js/ztree/zTreeStyle.css?v=1.2">
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10"><form id="SearchModel" name="SearchModel" action="/goods/lib-goods/list" method="POST">
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
                        <span>平台方商品分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <div id="cat_selector"><div class="form-control-box"><div class="tree-chosen-box"><div class="tree-chosen-input-box form-control"></div><div class="tree-chosen-panel-box"><input type="text" class="tree-chosen-input form-control-xs m-r-5" value="" placeholder="输入关键词、简拼、全拼搜索" style="width: 200px;"><a class="btn btn-primary btn-sm tree-chosen-btn-open m-r-2" title="全部展开/收起"><i class="fa fa-plus-circle" style="margin-right: 0px;"></i></a><a class="btn btn-primary btn-sm tree-chosen-btn-clear" title="全部清除所选"><i class="fa fa-trash-o" style="margin-right: 0px;"></i></a><div class="ztree-box"><ul id="1518665869002000" class="ztree"><li id="1518665869002000_1" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_1_switch" title="" class="button level0 switch roots_close" treenode_switch=""></span><a id="1518665869002000_1_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="生鲜食品"><span id="1518665869002000_1_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_1_span" class="node_name">生鲜食品</span></a></li><li id="1518665869002000_51" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_51_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_51_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="食品饮料"><span id="1518665869002000_51_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_51_span" class="node_name">食品饮料</span></a></li><li id="1518665869002000_74" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_74_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_74_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="家用电器"><span id="1518665869002000_74_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_74_span" class="node_name">家用电器</span></a></li><li id="1518665869002000_123" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_123_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_123_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="电脑办公"><span id="1518665869002000_123_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_123_span" class="node_name">电脑办公</span></a></li><li id="1518665869002000_180" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_180_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_180_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="手机数码"><span id="1518665869002000_180_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_180_span" class="node_name">手机数码</span></a></li><li id="1518665869002000_228" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_228_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_228_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="女装"><span id="1518665869002000_228_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_228_span" class="node_name">女装</span></a></li><li id="1518665869002000_252" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_252_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_252_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="男装"><span id="1518665869002000_252_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_252_span" class="node_name">男装</span></a></li><li id="1518665869002000_280" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_280_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_280_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="个护化妆"><span id="1518665869002000_280_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_280_span" class="node_name">个护化妆</span></a></li><li id="1518665869002000_313" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_313_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_313_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="箱包鞋帽"><span id="1518665869002000_313_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_313_span" class="node_name">箱包鞋帽</span></a></li><li id="1518665869002000_338" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_338_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_338_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="童装童鞋"><span id="1518665869002000_338_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_338_span" class="node_name">童装童鞋</span></a></li><li id="1518665869002000_356" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_356_switch" title="" class="button level0 switch center_close" treenode_switch=""></span><a id="1518665869002000_356_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="酒水"><span id="1518665869002000_356_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_356_span" class="node_name">酒水</span></a></li><li id="1518665869002000_367" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="1518665869002000_367_switch" title="" class="button level0 switch bottom_close" treenode_switch=""></span><a id="1518665869002000_367_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="家居家装"><span id="1518665869002000_367_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="1518665869002000_367_span" class="node_name">家居家装</span></a></li></ul></div></div></div></div></div>

                        <input type="hidden" id="searchmodel-cat_id" class="form-control" name="cat_id">

                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品状态：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-goods_status" class="form-control" name="goods_status" data-width="120">
                            <option value="">全部</option>
                            <option value="1">上架中</option>
                            <option value="0">已下架</option>
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

                        <div class="chosen-container chosen-container-single" title="" style="width: 200px;" id="searchmodel_brand_id_chosen"><a class="chosen-single" tabindex="-1"><span>请选择</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div><select id="searchmodel-brand_id" class="form-control chosen-select" name="brand_id" data-width="200" style="display: none;">
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
                        <span>本地商品库分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <div class="chosen-container chosen-container-single" title="" id="searchmodel_lib_cat_id_chosen"><a class="chosen-single" tabindex="-1"><span>-- 请选择 --</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div><select id="searchmodel-lib_cat_id" class="form-control chosen-select" name="lib_cat_id" style="display: none;">


                            <option value="0">-- 请选择 --</option>


                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="button" id="btn_search" value="搜索" class="btn btn-primary m-r-5">
                <!--
                <input type="button" id="btn_export" value="导出" class="btn btn-default m-r-5" />
                 -->
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
        </script></div>
    <!-- 工具栏（列表名称、列表显示项设置） -->

    <div class="common-title">
        <div class="ftitle">
            <h3>商品列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true">5</span>
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

        <table id="table_list" class="table table-hover">
            <thead>
            <tr>
                <th class="tcheck w10">
                    <input type="checkbox" class="table-list-checkbox-all" title="全选/全不选">
                </th>
                <th class="text-c w70" data-sortname="goods_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
                <th class="w300" data-sortname="goods_name" data-sortorder="asc" style="cursor: pointer;">商品名称<span class="sort"></span></th>
                <th class="w150" data-sortname="lib_cat_name" data-sortorder="asc" style="cursor: pointer;">商品库商品分类<span class="sort"></span></th>
                <th class="w120" data-sortname="goods_barcode" data-sortorder="asc" style="cursor: pointer;">商品条形码<span class="sort"></span></th>
                <th class="text-c w120" data-sortname="goods_price" data-sortorder="asc" style="cursor: pointer;">本店价（元）<span class="sort"></span></th>
                <!-- <th class="text-c" data-sortname="goods_number">库存</th> -->
                <th class="w80 text-c" data-sortname="goods_status" data-sortorder="asc" style="cursor: pointer;">状态<span class="sort"></span></th>
                <th class="w120" data-sortname="add_time" data-sortorder="asc" style="cursor: pointer;">发布时间<span class="sort"></span></th>
                <th class="handle w180">操作</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td class="tcheck">
                    <input type="checkbox" class="checkbox table-list-checkbox" value="5">
                </td>
                <td class="text-c">5</td>
                <td>
                    <div class="goodsPicBox pull-left m-r-10">
                        <a>
                            <!-- 图片缩略图 -->
                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/taobao-yun-images/531610068386/TB1O0Z.MVXXXXXPXVXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb">
                            <!-- 虚拟商品 -->

                        </a>
                    </div>
                    <div class="ng-binding goods-message w200">
                        <div class="name">
                            <a class="goods_name editable editable-pre-wrapped editable-click" data-goods_id="5" target="_blank">圣芝红酒 法国进口超级波尔多AOC干红葡萄酒 750ml</a>

                            <a href="javascript:void(0);" class="goods_name_controller c-blue m-l-5">修改</a>
                        </div>
                        <div class="active">

                            <div class="goods-mobile">
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="此宝贝尚未发布手机端宝贝详情">
                                    <i class="fa fa-tablet"></i>
                                </a>
                            </div>

                            <div class="QR-code popover-box">
                                <a href="javascript:;" class="qrcode">
                                    <i class="fa fa-qrcode"></i>
                                </a>
                                <div class="code-info popover-info">
                                    <i class="fa fa-caret-left"></i>
                                    <a href="/goods/lib-goods/download-qrcode?id=5">商品二维码</a>
                                    <p>
                                        <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/lib-goods/qrcode?id=5">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="store" style="display: none">
                            <label class="label label-primary">xx旗舰店提供</label>
                        </div> -->
                    </div>
                </td>
                <td class=""></td>

                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_barcode editable editable-click editable-empty" data-goods_id="5">无</a>
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_price editable editable-click" data-goods_id="5">59.00</a>
                </td>


                <td class="text-c">

                    <font class="c-green">已上架</font>

                </td>

                <td>
                    2018-02-15
                    <br>
                    11:20:30
                </td>
                <td class="handle">
                    <a href="http://www.cp6znq.yunmall.68mall.com/lib-goods-5.html" target="_blank">预览</a>
                    <span>|</span>
                    <a href="javascript:void(0);" class="sku-list" data-goods-id="5">SKU</a>
                    <!-- <span>|</span>
                    <a href="" target="_blank">查看</a> -->
                    <br>
                    <a href="/goods/lib-goods/edit?id=5">编辑</a>
                    <!-- <span>|</span>
                    <a href="javascript:void(0);">复制</a> -->


                    <span>|</span>
                    <a href="javascript:void(0);" data-id="5" class="offsale-goods del">下架</a>

                    <span>|</span>
                    <a href="javascript:void(0);" data-id="5" class="del border-none delete-goods">删除</a>
                </td>
            </tr>

            <tr>
                <td class="tcheck">
                    <input type="checkbox" class="checkbox table-list-checkbox" value="4">
                </td>
                <td class="text-c">4</td>
                <td>
                    <div class="goodsPicBox pull-left m-r-10">
                        <a>
                            <!-- 图片缩略图 -->
                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/taobao-yun-images/36494372594/TB18E84OpXXXXXTapXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb">
                            <!-- 虚拟商品 -->

                        </a>
                    </div>
                    <div class="ng-binding goods-message w200">
                        <div class="name">
                            <a class="goods_name editable editable-pre-wrapped editable-click" data-goods_id="4" target="_blank">法国原瓶进口红酒浪漫之花干红葡萄酒单支750ml/瓶</a>

                            <a href="javascript:void(0);" class="goods_name_controller c-blue m-l-5">修改</a>
                        </div>
                        <div class="active">

                            <div class="goods-mobile">
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="此宝贝尚未发布手机端宝贝详情">
                                    <i class="fa fa-tablet"></i>
                                </a>
                            </div>

                            <div class="QR-code popover-box">
                                <a href="javascript:;" class="qrcode">
                                    <i class="fa fa-qrcode"></i>
                                </a>
                                <div class="code-info popover-info">
                                    <i class="fa fa-caret-left"></i>
                                    <a href="/goods/lib-goods/download-qrcode?id=4">商品二维码</a>
                                    <p>
                                        <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/lib-goods/qrcode?id=4">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="store" style="display: none">
                            <label class="label label-primary">xx旗舰店提供</label>
                        </div> -->
                    </div>
                </td>
                <td class=""></td>

                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_barcode editable editable-click editable-empty" data-goods_id="4">无</a>
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_price editable editable-click" data-goods_id="4">35.00</a>
                </td>


                <td class="text-c">

                    <font class="c-green">已上架</font>

                </td>

                <td>
                    2018-02-15
                    <br>
                    11:20:26
                </td>
                <td class="handle">
                    <a href="http://www.cp6znq.yunmall.68mall.com/lib-goods-4.html" target="_blank">预览</a>
                    <span>|</span>
                    <a href="javascript:void(0);" class="sku-list" data-goods-id="4">SKU</a>
                    <!-- <span>|</span>
                    <a href="" target="_blank">查看</a> -->
                    <br>
                    <a href="/goods/lib-goods/edit?id=4">编辑</a>
                    <!-- <span>|</span>
                    <a href="javascript:void(0);">复制</a> -->


                    <span>|</span>
                    <a href="javascript:void(0);" data-id="4" class="offsale-goods del">下架</a>

                    <span>|</span>
                    <a href="javascript:void(0);" data-id="4" class="del border-none delete-goods">删除</a>
                </td>
            </tr>

            <tr>
                <td class="tcheck">
                    <input type="checkbox" class="checkbox table-list-checkbox" value="3">
                </td>
                <td class="text-c">3</td>
                <td>
                    <div class="goodsPicBox pull-left m-r-10">
                        <a>
                            <!-- 图片缩略图 -->
                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/taobao-yun-images/42566859005/TB1wVs2MVXXXXcjaXXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb">
                            <!-- 虚拟商品 -->

                        </a>
                    </div>
                    <div class="ng-binding goods-message w200">
                        <div class="name">
                            <a class="goods_name editable editable-pre-wrapped editable-click" data-goods_id="3" target="_blank">西班牙进口红酒浪漫之花桃红甜起泡酒葡萄酒750ml/瓶</a>

                            <a href="javascript:void(0);" class="goods_name_controller c-blue m-l-5">修改</a>
                        </div>
                        <div class="active">

                            <div class="goods-mobile">
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="此宝贝尚未发布手机端宝贝详情">
                                    <i class="fa fa-tablet"></i>
                                </a>
                            </div>

                            <div class="QR-code popover-box">
                                <a href="javascript:;" class="qrcode">
                                    <i class="fa fa-qrcode"></i>
                                </a>
                                <div class="code-info popover-info">
                                    <i class="fa fa-caret-left"></i>
                                    <a href="/goods/lib-goods/download-qrcode?id=3">商品二维码</a>
                                    <p>
                                        <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/lib-goods/qrcode?id=3">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="store" style="display: none">
                            <label class="label label-primary">xx旗舰店提供</label>
                        </div> -->
                    </div>
                </td>
                <td class=""></td>

                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_barcode editable editable-click editable-empty" data-goods_id="3">无</a>
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_price editable editable-click" data-goods_id="3">49.00</a>
                </td>


                <td class="text-c">

                    <font class="c-green">已上架</font>

                </td>

                <td>
                    2018-02-15
                    <br>
                    11:20:21
                </td>
                <td class="handle">
                    <a href="http://www.cp6znq.yunmall.68mall.com/lib-goods-3.html" target="_blank">预览</a>
                    <span>|</span>
                    <a href="javascript:void(0);" class="sku-list" data-goods-id="3">SKU</a>
                    <!-- <span>|</span>
                    <a href="" target="_blank">查看</a> -->
                    <br>
                    <a href="/goods/lib-goods/edit?id=3">编辑</a>
                    <!-- <span>|</span>
                    <a href="javascript:void(0);">复制</a> -->


                    <span>|</span>
                    <a href="javascript:void(0);" data-id="3" class="offsale-goods del">下架</a>

                    <span>|</span>
                    <a href="javascript:void(0);" data-id="3" class="del border-none delete-goods">删除</a>
                </td>
            </tr>

            <tr>
                <td class="tcheck">
                    <input type="checkbox" class="checkbox table-list-checkbox" value="2">
                </td>
                <td class="text-c">2</td>
                <td>
                    <div class="goodsPicBox pull-left m-r-10">
                        <a>
                            <!-- 图片缩略图 -->
                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/taobao-yun-images/536500767511/TB1cV73MVXXXXb7apXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb">
                            <!-- 虚拟商品 -->

                        </a>
                    </div>
                    <div class="ng-binding goods-message w200">
                        <div class="name">
                            <a class="goods_name editable editable-pre-wrapped editable-click" data-goods_id="2" target="_blank">拉菲红酒 法国进口尚品波尔多AOC干红葡萄酒 750ml</a>

                            <a href="javascript:void(0);" class="goods_name_controller c-blue m-l-5">修改</a>
                        </div>
                        <div class="active">

                            <div class="goods-mobile">
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="此宝贝尚未发布手机端宝贝详情">
                                    <i class="fa fa-tablet"></i>
                                </a>
                            </div>

                            <div class="QR-code popover-box">
                                <a href="javascript:;" class="qrcode">
                                    <i class="fa fa-qrcode"></i>
                                </a>
                                <div class="code-info popover-info">
                                    <i class="fa fa-caret-left"></i>
                                    <a href="/goods/lib-goods/download-qrcode?id=2">商品二维码</a>
                                    <p>
                                        <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/lib-goods/qrcode?id=2">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="store" style="display: none">
                            <label class="label label-primary">xx旗舰店提供</label>
                        </div> -->
                    </div>
                </td>
                <td class=""></td>

                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_barcode editable editable-click editable-empty" data-goods_id="2">无</a>
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_price editable editable-click" data-goods_id="2">128.00</a>
                </td>


                <td class="text-c">

                    <font class="c-green">已上架</font>

                </td>

                <td>
                    2018-02-15
                    <br>
                    11:20:15
                </td>
                <td class="handle">
                    <a href="http://www.cp6znq.yunmall.68mall.com/lib-goods-2.html" target="_blank">预览</a>
                    <span>|</span>
                    <a href="javascript:void(0);" class="sku-list" data-goods-id="2">SKU</a>
                    <!-- <span>|</span>
                    <a href="" target="_blank">查看</a> -->
                    <br>
                    <a href="/goods/lib-goods/edit?id=2">编辑</a>
                    <!-- <span>|</span>
                    <a href="javascript:void(0);">复制</a> -->


                    <span>|</span>
                    <a href="javascript:void(0);" data-id="2" class="offsale-goods del">下架</a>

                    <span>|</span>
                    <a href="javascript:void(0);" data-id="2" class="del border-none delete-goods">删除</a>
                </td>
            </tr>

            <tr>
                <td class="tcheck">
                    <input type="checkbox" class="checkbox table-list-checkbox" value="1">
                </td>
                <td class="text-c">1</td>
                <td>
                    <div class="goodsPicBox pull-left m-r-10">
                        <a>
                            <!-- 图片缩略图 -->
                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/taobao-yun-images/523027241195/TB1AFGyOpXXXXcGXXXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb">
                            <!-- 虚拟商品 -->

                        </a>
                    </div>
                    <div class="ng-binding goods-message w200">
                        <div class="name">
                            <a class="goods_name editable editable-pre-wrapped editable-click" data-goods_id="1" target="_blank">法国原瓶进口红酒 柏梭干红葡萄酒单支750ml新品特价</a>

                            <a href="javascript:void(0);" class="goods_name_controller c-blue m-l-5">修改</a>
                        </div>
                        <div class="active">

                            <div class="goods-mobile">
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="此宝贝尚未发布手机端宝贝详情">
                                    <i class="fa fa-tablet"></i>
                                </a>
                            </div>

                            <div class="QR-code popover-box">
                                <a href="javascript:;" class="qrcode">
                                    <i class="fa fa-qrcode"></i>
                                </a>
                                <div class="code-info popover-info">
                                    <i class="fa fa-caret-left"></i>
                                    <a href="/goods/lib-goods/download-qrcode?id=1">商品二维码</a>
                                    <p>
                                        <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/lib-goods/qrcode?id=1">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="store" style="display: none">
                            <label class="label label-primary">xx旗舰店提供</label>
                        </div> -->
                    </div>
                </td>
                <td class=""></td>

                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_barcode editable editable-click editable-empty" data-goods_id="1">无</a>
                </td>
                <td class="text-c">
                    <a href="javascript:void(0);" class="goods_price editable editable-click" data-goods_id="1">39.00</a>
                </td>


                <td class="text-c">

                    <font class="c-green">已上架</font>

                </td>

                <td>
                    2018-02-15
                    <br>
                    11:20:11
                </td>
                <td class="handle">
                    <a href="http://www.cp6znq.yunmall.68mall.com/lib-goods-1.html" target="_blank">预览</a>
                    <span>|</span>
                    <a href="javascript:void(0);" class="sku-list" data-goods-id="1">SKU</a>
                    <!-- <span>|</span>
                    <a href="" target="_blank">查看</a> -->
                    <br>
                    <a href="/goods/lib-goods/edit?id=1">编辑</a>
                    <!-- <span>|</span>
                    <a href="javascript:void(0);">复制</a> -->


                    <span>|</span>
                    <a href="javascript:void(0);" data-id="1" class="offsale-goods del">下架</a>

                    <span>|</span>
                    <a href="javascript:void(0);" data-id="1" class="del border-none delete-goods">删除</a>
                </td>
            </tr>


            </tbody>
            <tfoot>
            <tr>
                <td class="text-c w10">
                    <input type="checkbox" class="checkBox table-list-checkbox-all" title="全选/全不选">
                </td>
                <td colspan="8">
                    <div class="pull-left">
                        <div class="btn-group dropup m-r-2">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                批量操作
                                <span class="caret m-l-5"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a class="onsale-goods">商品上架</a>
                                </li>
                                <li>
                                    <a class="offsale-goods">商品下架</a>
                                </li>
                                <li>
                                    <a class="move-goods">转移商城商品分类</a>
                                </li>
                                <li>
                                    <a class="move-lib-goods">转移商品库商品分类</a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-danger delete-goods m-r-2">批量删除</a>
                    </div>
                    <div class="pull-right page-box">


                        <div id="pagination">
                            <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":5,"page_count":1,"offset":0,"url":null,"sql":null}
</script>


                            <div class="pagination-info">
                                共5条记录

                                ，每页显示：
                                <select class="select m-r-5" data-page-size="10">


                                    <option value="10" selected="selected">10</option>



                                    <option value="50">50</option>



                                    <option value="500">500</option>



                                    <option value="1000">1000</option>


                                </select>
                                条

                            </div>

                            <ul class="pagination">
                                <li class="disabled" style="display: none;">
                                    <a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
                                </li>

                                <li class="disabled">
                                    <a class="fa fa-angle-left" title="上一页"></a>
                                </li>








                                <!--   -->

                                <li class="active">
                                    <a data-cur-page="1">1</a>
                                </li>







                                <li class="disabled">
                                    <a class="fa fa-angle-right" title="下一页"></a>
                                </li>

                                <li class="disabled" style="display: none;">
                                    <a class="fa fa-angle-double-right" data-go-page="1" title="最后一页"></a>
                                </li>
                            </ul>

                            <div class="pagination-goto">
                                <input class="ipt form-control goto-input" type="text">
                                <button class="btn btn-default goto-button" title="点击跳转到指定页面">GO</button>
                                <a class="goto-link" data-go-page="" style="display: none;"></a>
                            </div>
                            <script type="text/javascript">
                                $().ready(function() {
                                    $(".pagination-goto > .goto-input").keyup(function(e) {
                                        $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                                        if (e.keyCode == 13) {
                                            $(".pagination-goto > .goto-link").click();
                                        }
                                    });
                                    $(".pagination-goto > .goto-button").click(function() {
                                        var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                                        if ($.trim(page) == '') {
                                            return false;
                                        }
                                        $(".pagination-goto > .goto-link").attr("data-go-page", page);
                                        $(".pagination-goto > .goto-link").click();
                                        return false;
                                    });
                                });
                            </script>

                        </div>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>

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

            $("body").on("click", ".sku-list", function() {
                var goods_id = $(this).data("goods-id");

                $.open({
                    title: "商品 #" + goods_id + " 的SKU列表",
                    ajax: {
                        url: '/goods/lib-goods/sku-list',
                        data: {
                            goods_id: goods_id
                        }
                    },
                    width: "980px",
                    end: function(index, object) {
                        // 判断SKU信息是否发生变化
                        if ($(document).data("sku-change")) {
                            tablelist.load();
                        }
                        $(document).data("sku-change", false);
                    }
                });
            });

            $("body").on("click", ".offsale-goods", function() {
                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择要下架的商品");
                    return;
                }

                $.confirm("您确定要下架选中的商品吗？", {}, function() {
                    $.post("/goods/lib-goods/offsale", {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json");
                });
            });

            $("body").on("click", ".onsale-goods", function() {
                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids) {
                    $.msg("请选择要上架的商品");
                    return;
                }

                $.post("/goods/lib-goods/onsale", {
                    ids: ids
                }, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message);
                        tablelist.load();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });

            $("body").on("click", ".delete-goods", function() {

                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids) {
                    $.msg("请选择要删除的商品");
                    return;
                }

                $.confirm("商品库商品删除后将无法恢复，您确定要删除吗？", function() {
                    $.post('/goods/lib-goods/delete', {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json");
                });
            })

            //转移分类
            $("body").on("click", ".move-goods", function() {

                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择要转移分类的商品");
                    return;
                }

                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        // 标题
                        title: '转移分类',
                        width: 900,
                        trigger: $(this),
                        // ajax加载的设置
                        ajax: {
                            url: '/goods/lib-goods/move-goods-cat',
                            data: {
                                ids: ids
                            }
                        },
                    });
                }

            });

            //转移商品库商品分类
            $("body").on("click", ".move-lib-goods", function() {

                var ids = $(this).data("id");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择要转移分类的商品");
                    return;
                }

                $.open({
                    title: "转移商品库商品分类",
                    ajax: {
                        url: '/goods/lib-goods/move-lib-goods',
                        data: {
                            ids: ids
                        }
                    },
                    width: "480px",
                    btn: ['确定', '取消'],
                    yes: function(index, container) {
                        if (!validator.form()) {
                            return;
                        }

                        var data = $(container).serializeJson();
                        $.loading.start();
                        $.post('/goods/lib-goods/move-lib-goods', data, function(result) {
                            $.loading.stop();
                            if (result.code == 0) {
                                tablelist.load();
                                layer.close(index);
                            }
                            $.msg(result.message);
                        }, "json");
                    }
                });
            });

            $("body").on("click", "#add-excel-goods", function() {
                $.loading.start();
                $.open({
                    title: "导入Excel商品",
                    ajax: {
                        url: '/goods/lib-goods/add-excel-goods',
                        data: {}
                    },
                    width: "600px",
                    /* btn: ['确定', '取消'],
                    yes: function(index, container) {
    
                        var data = $(container).serializeJson();
                        $.loading.start();
                        $.post('/goods/lib-goods/add-excel-goods', data, function(result) {
                            $.loading.stop();
                            if (result.code == 0) {
                                tablelist.load();
                                $.msg(result.message);
                                $.closeDialog(index);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                })
                            }
                        }, "json");
                    } */
                });
            });

            $("#btn_search").click(function() {
                var data = $("#SearchModel").serializeJson();
                tablelist.load(data);
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
        $(document).ready(function() {
            // toggle `popup` / `inline` mode
            // $.fn.editable.defaults.mode = "inline";

            $('.goods_name_controller').click(function(e) {
                e.stopPropagation();
                $(this).parent().children(":first").editable('toggle');
            });

            // 商品条形码
            $(".goods_barcode").editable({
                type: "text",
                url: "/goods/lib-goods/edit-lib-goods-info",
                pk: 1,
                emptytext: '无',
                // title: "商品条形码",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'goods_barcode';
                    return params;
                },
                /* validate: function(value) {
                    value = $.trim(value);
                    if (value.length > 14) {
                        return '商品条形码只能包含至多14个字。';
                    }
                }, */
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });

            // 商品价格
            $(".goods_price").editable({
                type: "text",
                url: "/goods/lib-goods/edit-lib-goods-info",
                pk: 1,
                // title: "本店价（元）",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'goods_price';
                    return params;
                },
                /* validate: function(value) {
                    value = $.trim(value);
                    if (!value) {
                        return '商品价格不能为空。';
                    } else if (isNaN(value)) {
                        return '商品价格必须是一个数字。';
                    } else if (value < 0.01) {
                        return '价格必须是0.01~9999999之间的数字。';
                    } else if (value > 9999999) {
                        return '价格必须是0.01~9999999之间的数字。';
                    }
                }, */
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function(value, sourceData) {
                    // 保留两位小数
                    $(this).html((Number(value)).toFixed(2));
                }
            });

            // 商品名称
            $(".goods_name").editable({
                type: "textarea",
                url: "/goods/lib-goods/edit-lib-goods-info",
                pk: 1,
                // title: "商品名称",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'goods_name';
                    return params;
                },
                /* validate: function(value) {
                    value = $.trim(value);
                    if (!value) {
                        return '商品名称不能为空。';
                    } else if (value.length < 3) {
                        return '商品名称应该包含至少3个字。';
                    } else if (value.length > 60) {
                        return '商品名称只能包含至多60个字。';
                    }
                }, */
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function(value, sourceData) {
                    if (value.length > 28) {
                        $(this).html(value.substring(0, 28) + '...');
                    } else {
                        $(this).html(value);
                    }
                }
            });
        });
    </script>
    
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop