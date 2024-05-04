{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">

        <form id="AttributeModel" class="form-horizontal" name="AttributeModel" action="/goods/attribute/add-base?type_id={{ $type_id }}" method="POST" novalidate="novalidate">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="attributemodel-attr_id" class="form-control" name="AttributeModel[attr_id]">

            <input type="hidden" id="attributemodel-is_spec" class="form-control" name="AttributeModel[is_spec]" value="0">
            <!-- 商品类型 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-type_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">商品类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="attributemodel-type_id" class="form-control chosen-select" name="AttributeModel[type_id]" style="display: none;">
                                @foreach($goods_type_all as $k=>$v)
                                    <option value="{{ $v->type_id }}">{{ $v->type_name }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">属性名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="attributemodel-attr_name" class="form-control" name="AttributeModel[attr_name]">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 描述 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_remark" class="col-sm-4 control-label">

                        <span class="ng-binding">属性描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="attributemodel-attr_remark" class="form-control" name="AttributeModel[attr_remark]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 是否进行索引 -->
            <!-- <div class="simple-form-field" >
    <div class="form-group">
    <label for="attributemodel-is_index" class="col-sm-4 control-label">

    <span class="ng-binding">是否检索：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">
     -->

            <!-- <label class="control-label control-label-switch">
    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
    <input type="hidden" name="AttributeModel[is_index]" value="0"><label><input type="checkbox" id="attributemodel-is_index" class="form-control b-n" name="AttributeModel[is_index]" value="1" data-on-text="是" data-off-text="否"> </label>
    </div>
    </label> -->

            <!--
    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">选择是后，在发布以及编辑商品时，此属性所选属性值会被加入到商品的关键词中便于被检索发现</div></div>
    </div>
    </div>
    </div> -->
            <!-- 是否显示 -->
            <!-- <div class="simple-form-field" >
    <div class="form-group">
    <label for="attributemodel-is_show" class="col-sm-4 control-label">

    <span class="ng-binding">是否显示：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">
     -->

            <!-- <label class="control-label control-label-switch">
    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
    <input type="hidden" name="AttributeModel[is_show]" value="0"><label><input type="checkbox" id="attributemodel-is_show" class="form-control b-n" name="AttributeModel[is_show]" value="1" checked data-on-text="是" data-off-text="否"> </label>
    </div>
    </label> -->

            <!--
    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">属性设为无效后，如果属性为规格，则相关商品将全部下架，请及时通知相关人员，谨慎操作</div></div>
    </div>
    </div>
    </div> -->
            <!-- 显示样式 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_style" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">显示样式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="AttributeModel[attr_style]" value="0">
                            <div id="attributemodel-attr_style" class="" name="AttributeModel[attr_style]" selection="[0]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="AttributeModel[attr_style]" value="0" checked=""> 多选</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="AttributeModel[attr_style]" value="1"> 单选</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="AttributeModel[attr_style]" value="2"> 文本</label>
                            </div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">多选：以复选框的形式让商家勾选属性值；<br>单选：以下拉列表框的形式让商家选择属性值；<br>文本：以文本框的形式让商家输入属性值；<br><b style="color: red;">注意：<br>1.显示样式保存后不可变更；<br>2.品牌属性样式已被移除，请到商品分类列表为每个分类单独关联品牌；</b></div></div>
                    </div>
                </div>
            </div>
            <!-- 属性值列表 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_values" class="col-sm-4 control-label">

                        <span class="ng-binding">属性值：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <div id="values_select" class="attr-values-area">
                                <ul class="attr-values">






                                    <li class="m-b-10 new-attr-value">
                                        <input type="hidden" class="form-control" name="attr_vid" value="0">

                                        <input type="text" class="form-control" name="attr_vname" placeholder="请输入属性可选值" data-rule-maxlength="20" data-msg-maxlength="属性值最大不能超过20个字符">

                                        <input type="text" id="attrvaluemodel-attr_vsort" class="form-control small m-l-10" name="attr_vsort" value="255" placeholder="排序" data-rule-integer="true" data-rule-min="0" data-rule-max="255">
                                        <input type="button" value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value">
                                        <label style="display: none;">
                                            <input type="hidden" value="0" name="is_delete">
                                        </label>
                                    </li>
                                    <li class="m-b-10 new-attr-value">
                                        <input type="hidden" class="form-control" name="attr_vid" value="0">

                                        <input type="text" class="form-control" name="attr_vname" placeholder="请输入属性可选值" data-rule-maxlength="20" data-msg-maxlength="属性值最大不能超过20个字符">

                                        <input type="text" id="attrvaluemodel-attr_vsort" class="form-control small m-l-10" name="attr_vsort" value="255" placeholder="排序" data-rule-integer="true" data-rule-min="0" data-rule-max="255">
                                        <input type="button" value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value">
                                        <label style="display: none;">
                                            <input type="hidden" value="0" name="is_delete">
                                        </label>
                                    </li>
                                    <li class="m-b-10 new-attr-value">
                                        <input type="hidden" class="form-control" name="attr_vid" value="0">

                                        <input type="text" class="form-control" name="attr_vname" placeholder="请输入属性可选值" data-rule-maxlength="20" data-msg-maxlength="属性值最大不能超过20个字符">

                                        <input type="text" id="attrvaluemodel-attr_vsort" class="form-control small m-l-10" name="attr_vsort" value="255" placeholder="排序" data-rule-integer="true" data-rule-min="0" data-rule-max="255">
                                        <input type="button" value="移除" class="btn btn-danger btn-sm m-l-10 m-t-3 del-attr-value">
                                        <label style="display: none;">
                                            <input type="hidden" value="0" name="is_delete">
                                        </label>
                                    </li>

                                </ul>
                                <a id="add_attribute_value" href="javascript:void(0);" class="btn btn-warning btn-sm">
                                    <i class="fa fa-plus"></i>
                                    <!-- 继续添加属性值 -->
                                    继续添加属性值
                                </a>
                            </div>


                            <div id="values_text" class="attr-values-area" style="display: none;">

                                <input name="attr_vname" class="form-control disabled" disabled="disabled" placeholder="商品属性的显示样式为“文本”时，无需设置属性值。">
                            </div>


                            <div id="values_brand" class="attr-values-area" style="display: none;">

                                <select id="brand_list" class="form-control" name="brand_list[]" multiple="multiple" size="6" style="display: none;">
                                    <optgroup label="">
                                        <option value="29">宏碁</option>
                                        <option value="106">361°</option>
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
                                    </optgroup>
                                    <optgroup label="A">
                                        <option value="6">奥克斯</option>
                                        <option value="33">爱仕达</option>
                                        <option value="55">澳优</option>
                                        <option value="67">安奈儿</option>
                                        <option value="120">安踏</option>
                                        <option value="143">安睡宝</option>
                                    </optgroup>
                                    <optgroup label="B">
                                        <option value="16">博集天卷</option>
                                        <option value="36">博洋家纺</option>
                                        <option value="72">帮宝适</option>
                                        <option value="77">布朗博士</option>
                                        <option value="85">百立乐</option>
                                        <option value="112">百丽</option>
                                        <option value="144">奔腾</option>
                                        <option value="172">柏梭</option>
                                    </optgroup>
                                    <optgroup label="C">
                                        <option value="2">创维</option>
                                    </optgroup>
                                    <optgroup label="D">
                                        <option value="9">迪加伦</option>
                                        <option value="26">戴尔</option>
                                        <option value="40">得力</option>
                                        <option value="50">稻香村</option>
                                        <option value="64">大洋世家</option>
                                        <option value="66">多美</option>
                                        <option value="80">道达尔</option>
                                        <option value="105">达芙妮</option>
                                        <option value="122">稻草人</option>
                                        <option value="139">迪奥</option>
                                    </optgroup>
                                    <optgroup label="E">
                                        <option value="11">二十一世纪出版社</option>
                                    </optgroup>
                                    <optgroup label="F">
                                        <option value="3">飞利浦</option>
                                        <option value="7">飞科</option>
                                        <option value="37">富安娜</option>
                                        <option value="78">法国兰蔻</option>
                                        <option value="91">法兰琳卡</option>
                                        <option value="95">福斯</option>
                                        <option value="132">费列罗</option>
                                    </optgroup>
                                    <optgroup label="G">
                                        <option value="61">古井贡</option>
                                        <option value="123">古奇</option>
                                        <option value="127">格力</option>
                                    </optgroup>
                                    <optgroup label="H">
                                        <option value="4">海信</option>
                                        <option value="8">华帝</option>
                                        <option value="14">华为</option>
                                        <option value="17">HTC</option>
                                        <option value="30">惠普</option>
                                        <option value="32">华硕</option>
                                        <option value="34">好事达</option>
                                        <option value="41">慧乐家</option>
                                        <option value="48">韩都衣舍</option>
                                        <option value="53">花花公子</option>
                                        <option value="73">好奇</option>
                                        <option value="74">Hipp</option>
                                        <option value="75">亨氏</option>
                                        <option value="83">汉高</option>
                                        <option value="89">韩束</option>
                                        <option value="102">火枫</option>
                                        <option value="117">鸿星尔克</option>
                                        <option value="128">海尔</option>
                                    </optgroup>
                                    <optgroup label="I">
                                        <option value="15">iphone</option>
                                    </optgroup>
                                    <optgroup label="J">
                                        <option value="23">机械工业出版社</option>
                                        <option value="42">金喇叭</option>
                                        <option value="88">捷安特</option>
                                        <option value="93">嘉实多</option>
                                    </optgroup>
                                    <optgroup label="K">
                                        <option value="87">壳牌</option>
                                        <option value="107">卡饰社</option>
                                        <option value="141">卡文克莱</option>
                                    </optgroup>
                                    <optgroup label="L">
                                        <option value="1">乐视</option>
                                        <option value="24">联想</option>
                                        <option value="35">雷蛇</option>
                                        <option value="38">罗莱</option>
                                        <option value="54">乐事</option>
                                        <option value="56">罗蒙</option>
                                        <option value="68">乐高</option>
                                        <option value="115">骆驼</option>
                                        <option value="116">李宁</option>
                                        <option value="125">浪琴</option>
                                        <option value="129">老板</option>
                                        <option value="131">罗技</option>
                                        <option value="136">拉菲</option>
                                        <option value="173">浪漫之花</option>
                                    </optgroup>
                                    <optgroup label="M">
                                        <option value="5">美的</option>
                                        <option value="13">明天出版社</option>
                                        <option value="19">磨铁图书</option>
                                        <option value="44">美好家</option>
                                        <option value="47">猫城</option>
                                        <option value="57">茅台</option>
                                        <option value="71">铭佳童话</option>
                                        <option value="79">美孚</option>
                                        <option value="81">妈咪宝贝</option>
                                        <option value="118">米其林</option>
                                        <option value="138">梦妆</option>
                                    </optgroup>
                                    <optgroup label="N">
                                        <option value="58">NUK</option>
                                        <option value="97">诺可文</option>
                                        <option value="110">纳迪亚N+a</option>
                                        <option value="114">耐克</option>
                                    </optgroup>
                                    <optgroup label="O">
                                        <option value="18">oppo</option>
                                        <option value="45">ONLY</option>
                                        <option value="49">欧司朗</option>
                                        <option value="82">olay</option>
                                        <option value="101">欧亚马</option>
                                        <option value="124">欧米茄</option>
                                    </optgroup>
                                    <optgroup label="P">
                                        <option value="100">潘婷</option>
                                        <option value="103">飘柔</option>
                                        <option value="121">puma</option>
                                        <option value="130">苹果</option>
                                    </optgroup>
                                    <optgroup label="Q">
                                        <option value="21">清华大学出版社</option>
                                        <option value="31">清华同方</option>
                                        <option value="52">全友家居</option>
                                        <option value="59">强生</option>
                                        <option value="60">七匹狼</option>
                                        <option value="62">雀巢</option>
                                        <option value="90">乔山</option>
                                        <option value="142">乔曼帝</option>
                                    </optgroup>
                                    <optgroup label="R">
                                        <option value="25">人民邮电出版社</option>
                                    </optgroup>
                                    <optgroup label="S">
                                        <option value="10">苏泊尔</option>
                                        <option value="20">三星</option>
                                        <option value="39">世家洁具</option>
                                        <option value="70">十月妈咪</option>
                                        <option value="98">沙宣</option>
                                        <option value="99">斯伯丁</option>
                                        <option value="113">双星</option>
                                        <option value="134">十月稻田</option>
                                        <option value="145">三菱电机</option>
                                        <option value="146">三洋电池</option>
                                        <option value="147">三只松鼠</option>
                                        <option value="174">Suamgy/圣芝</option>
                                    </optgroup>
                                    <optgroup label="T">
                                        <option value="28">汤臣倍健</option>
                                        <option value="109">他她</option>
                                        <option value="119">特步</option>
                                        <option value="126">天梭</option>
                                    </optgroup>
                                    <optgroup label="U">
                                        <option value="111">UGG</option>
                                    </optgroup>
                                    <optgroup label="V">
                                        <option value="27">vivo</option>
                                    </optgroup>
                                    <optgroup label="W">
                                        <option value="69">湾仔码头</option>
                                        <option value="94">温碧泉</option>
                                        <option value="96">威尔胜</option>
                                    </optgroup>
                                    <optgroup label="X">
                                        <option value="12">小米</option>
                                        <option value="84">相宜本草</option>
                                        <option value="92">信乐</option>
                                        <option value="140">香奈儿</option>
                                        <option value="148">鲜农乐</option>
                                    </optgroup>
                                    <optgroup label="Y">
                                        <option value="43">友臣</option>
                                        <option value="46">伊莲娜</option>
                                        <option value="51">妖精的口袋</option>
                                        <option value="65">雅培</option>
                                        <option value="76">雅诗兰黛</option>
                                        <option value="133">伊利</option>
                                        <option value="135">艺福堂</option>
                                        <option value="137">洋河酒厂</option>
                                    </optgroup>
                                    <optgroup label="Z">
                                        <option value="22">魅族</option>
                                        <option value="63">战地吉普</option>
                                        <option value="86">ZA</option>
                                        <option value="104">中极星</option>
                                        <option value="108">卓诗尼</option>
                                    </optgroup>
                                </select><div class="ms2side__div"><div class="ms2side__select"><div class="ms2side__header">搜索：<input type="text"><a href="#" title="清除搜索内容" style="display: none;"></a></div><select title=" " name="brand_listms2side__sx" id="brand_listms2side__sx" size="6" multiple="multiple"><option value="29" selected="selected">宏碁</option><option value="106">361°</option><option value="149">.</option><option value="150">ロケット石鹸</option><option value="151">M·S·U/真想您</option><option value="152">潤佳</option><option value="153">669</option><option value="154">内斯蒂·丹特</option><option value="155">德·亿龙</option><option value="156">M·LEAD/摩兰迪</option><option value="157">1000Billion</option><option value="158">365ROSE/365朵玫瑰</option><option value="159">MENOW/美·诺</option><option value="160">3097</option><option value="161">咔咪咔咪</option><option value="162">Schuhmann Beautiful/舒曼·佳</option><option value="163">yesland 雅熙·莱帝</option><option value="164">1320/一生爱你</option><option value="165">383</option><option value="166">900</option><option value="167">500Year</option><option value="168">1900</option><option value="169">咪啵</option><option value="170">198ZCORY</option><option value="171">1825</option><option value="6">奥克斯</option><option value="33">爱仕达</option><option value="55">澳优</option><option value="67">安奈儿</option><option value="120">安踏</option><option value="143">安睡宝</option><option value="16">博集天卷</option><option value="36">博洋家纺</option><option value="72">帮宝适</option><option value="77">布朗博士</option><option value="85">百立乐</option><option value="112">百丽</option><option value="144">奔腾</option><option value="172">柏梭</option><option value="2">创维</option><option value="9">迪加伦</option><option value="26">戴尔</option><option value="40">得力</option><option value="50">稻香村</option><option value="64">大洋世家</option><option value="66">多美</option><option value="80">道达尔</option><option value="105">达芙妮</option><option value="122">稻草人</option><option value="139">迪奥</option><option value="11">二十一世纪出版社</option><option value="3">飞利浦</option><option value="7">飞科</option><option value="37">富安娜</option><option value="78">法国兰蔻</option><option value="91">法兰琳卡</option><option value="95">福斯</option><option value="132">费列罗</option><option value="61">古井贡</option><option value="123">古奇</option><option value="127">格力</option><option value="4">海信</option><option value="8">华帝</option><option value="14">华为</option><option value="17">HTC</option><option value="30">惠普</option><option value="32">华硕</option><option value="34">好事达</option><option value="41">慧乐家</option><option value="48">韩都衣舍</option><option value="53">花花公子</option><option value="73">好奇</option><option value="74">Hipp</option><option value="75">亨氏</option><option value="83">汉高</option><option value="89">韩束</option><option value="102">火枫</option><option value="117">鸿星尔克</option><option value="128">海尔</option><option value="15">iphone</option><option value="23">机械工业出版社</option><option value="42">金喇叭</option><option value="88">捷安特</option><option value="93">嘉实多</option><option value="87">壳牌</option><option value="107">卡饰社</option><option value="141">卡文克莱</option><option value="1">乐视</option><option value="24">联想</option><option value="35">雷蛇</option><option value="38">罗莱</option><option value="54">乐事</option><option value="56">罗蒙</option><option value="68">乐高</option><option value="115">骆驼</option><option value="116">李宁</option><option value="125">浪琴</option><option value="129">老板</option><option value="131">罗技</option><option value="136">拉菲</option><option value="173">浪漫之花</option><option value="5">美的</option><option value="13">明天出版社</option><option value="19">磨铁图书</option><option value="44">美好家</option><option value="47">猫城</option><option value="57">茅台</option><option value="71">铭佳童话</option><option value="79">美孚</option><option value="81">妈咪宝贝</option><option value="118">米其林</option><option value="138">梦妆</option><option value="58">NUK</option><option value="97">诺可文</option><option value="110">纳迪亚N+a</option><option value="114">耐克</option><option value="18">oppo</option><option value="45">ONLY</option><option value="49">欧司朗</option><option value="82">olay</option><option value="101">欧亚马</option><option value="124">欧米茄</option><option value="100">潘婷</option><option value="103">飘柔</option><option value="121">puma</option><option value="130">苹果</option><option value="21">清华大学出版社</option><option value="31">清华同方</option><option value="52">全友家居</option><option value="59">强生</option><option value="60">七匹狼</option><option value="62">雀巢</option><option value="90">乔山</option><option value="142">乔曼帝</option><option value="25">人民邮电出版社</option><option value="10">苏泊尔</option><option value="20">三星</option><option value="39">世家洁具</option><option value="70">十月妈咪</option><option value="98">沙宣</option><option value="99">斯伯丁</option><option value="113">双星</option><option value="134">十月稻田</option><option value="145">三菱电机</option><option value="146">三洋电池</option><option value="147">三只松鼠</option><option value="174">Suamgy/圣芝</option><option value="28">汤臣倍健</option><option value="109">他她</option><option value="119">特步</option><option value="126">天梭</option><option value="111">UGG</option><option value="27">vivo</option><option value="69">湾仔码头</option><option value="94">温碧泉</option><option value="96">威尔胜</option><option value="12">小米</option><option value="84">相宜本草</option><option value="92">信乐</option><option value="140">香奈儿</option><option value="148">鲜农乐</option><option value="43">友臣</option><option value="46">伊莲娜</option><option value="51">妖精的口袋</option><option value="65">雅培</option><option value="76">雅诗兰黛</option><option value="133">伊利</option><option value="135">艺福堂</option><option value="137">洋河酒厂</option><option value="22">魅族</option><option value="63">战地吉普</option><option value="86">ZA</option><option value="104">中极星</option><option value="108">卓诗尼</option></select></div><div class="ms2side__options" style="padding-top: 40px;"><p class="AddOne" title="添加选择项">›</p><p class="AddAll" title="添加全部">»</p><p class="RemoveOne ms2side__hide" title="移除选择项">‹</p><p class="RemoveAll ms2side__hide" title="移除全部">«</p></div><div class="ms2side__select"><div class="ms2side__header">已选择的关联品牌</div><select title="已选择的关联品牌" name="brand_listms2side__dx" id="brand_listms2side__dx" size="6" multiple="multiple"></select></div></div>

                            </div>



                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="attributemodel-attr_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="attributemodel-attr_sort" class="form-control small" name="AttributeModel[attr_sort]" value="255">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>

        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- JSON2 -->
    <script src="/assets/d2eace91/js/jquery.json-2.4.js?v=1.2"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 双向选择器:css -->
    <link rel="stylesheet" href="/assets/d2eace91/css/selector/jquery.multiselect2side.css?v=1.2">
    <!-- 双向选择器:js -->
    <script src="/assets/d2eace91/js/selector/jquery.multiselect2side.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "attributemodel-attr_name", "name": "AttributeModel[attr_name]", "attribute": "attr_name", "rules": {"required":true,"messages":{"required":"属性名称不能为空。"}}},{"id": "attributemodel-shop_id", "name": "AttributeModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop Id不能为空。"}}},{"id": "attributemodel-attr_style", "name": "AttributeModel[attr_style]", "attribute": "attr_style", "rules": {"required":true,"messages":{"required":"显示样式不能为空。"}}},{"id": "attributemodel-attr_sort", "name": "AttributeModel[attr_sort]", "attribute": "attr_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "attributemodel-type_id", "name": "AttributeModel[type_id]", "attribute": "type_id", "rules": {"required":true,"messages":{"required":"商品类型不能为空。"}}},{"id": "attributemodel-type_id", "name": "AttributeModel[type_id]", "attribute": "type_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品类型必须是整数。"}}},{"id": "attributemodel-shop_id", "name": "AttributeModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shop Id必须是整数。"}}},{"id": "attributemodel-par_attr_id", "name": "AttributeModel[par_attr_id]", "attribute": "par_attr_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级属性ID必须是整数。"}}},{"id": "attributemodel-attr_vid", "name": "AttributeModel[attr_vid]", "attribute": "attr_vid", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"属性值ID必须是整数。"}}},{"id": "attributemodel-is_spec", "name": "AttributeModel[is_spec]", "attribute": "is_spec", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为规格必须是整数。"}}},{"id": "attributemodel-attr_style", "name": "AttributeModel[attr_style]", "attribute": "attr_style", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"显示样式必须是整数。"}}},{"id": "attributemodel-is_index", "name": "AttributeModel[is_index]", "attribute": "is_index", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否检索必须是整数。"}}},{"id": "attributemodel-is_linked", "name": "AttributeModel[is_linked]", "attribute": "is_linked", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Linked必须是整数。"}}},{"id": "attributemodel-attr_sort", "name": "AttributeModel[attr_sort]", "attribute": "attr_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "attributemodel-is_show", "name": "AttributeModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "attributemodel-attr_name", "name": "AttributeModel[attr_name]", "attribute": "attr_name", "rules": {"string":true,"messages":{"string":"属性名称必须是一条字符串。","maxlength":"属性名称只能包含至多10个字符。"},"maxlength":10}},{"id": "attributemodel-attr_remark", "name": "AttributeModel[attr_remark]", "attribute": "attr_remark", "rules": {"string":true,"messages":{"string":"属性描述必须是一条字符串。","maxlength":"属性描述只能包含至多255个字符。"},"maxlength":255}},{"id": "attributemodel-attr_sort", "name": "AttributeModel[attr_sort]", "attribute": "attr_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            $("[name='AttributeModel[attr_style]']").on("change", function() {
                var value = $(this).val();
                if (value == '') {
                    return;
                }
                $(".attr-values-area").hide();
                if (value == 0 || value == 1) {
                    $("#values_select").show();
                } else if (value == 2) {
                    $("#values_text").show();
                } else {
                    $("#values_brand").show();
                }
            });
        });
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

            var validator = $("#AttributeModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }

                var url = $("#AttributeModel").attr("action");
                var data = $("#AttributeModel").not(".attr-values-area").serializeJson();

                data = {
                    _csrf: data._csrf,
                    AttributeModel: data.AttributeModel,
                    attr_values: data.attr_values
                };

                var attr_values = [];

                var message = null;

                $(".attr-values-area").not(":hidden").each(function() {

                    if ($(this).attr("id") == "values_select") {
                        $(this).find(".attr-value,.new-attr-value").each(function() {

                            if ($(this).find("[name='attr_vsort']").valid() == false) {
                                $(this).find("[name='attr_vsort']").focus();
                                message = "属性值排序输入错误！";
                                return false;
                            }

                            var object = $(this).serializeJson();
                            if ($.trim(object.attr_vname) != '') {
                                attr_values.push(object);
                            }
                        });

                        if (attr_values.length == 0) {
                            message = "属性值不能为空";
                            $(this).find(":input:visible").first().focus();
                            return false;
                        }

                    } else if ($(this).attr("id") == "values_text") {
                        var object = $(this).serializeJson();
                        object.attr_vname = "";
                        attr_values.push(object);
                    } else if ($(this).attr("id") == "values_brand") {
                        var object = $(this).serializeJson();

                        if (!object.brand_list || object.brand_list.length == 0) {
                            message = "请选择品牌";
                            return false;
                        }

                        for (var i = 0; i < object.brand_list.length; i++) {
                            attr_values.push({
                                attr_vname: object.brand_list[i]
                            });
                        }

                    }

                });

                // 显示错误信息
                if (message != null) {
                    $.msg(message, {
                        time: 3000
                    });
                    return;
                }

                data.attr_values = attr_values;

                var attr_value_count = attr_values.length;

                for (var i = 0; i < attr_values.length; i++) {

                    if (attr_values[i].is_delete == 1) {
                        attr_value_count--;
                    }
                }

                if (attr_value_count == 0) {
                    $.msg("属性值不能为空！");
                    return;
                }

                data = JSON.stringify(data);

                //加载提示
                $.loading.start();

                $.post(url, {
                    data: data
                }, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message);
                        if (result.data) {
                            $.loading.start();
                            $.go(result.data);
                        }
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });
            });

            // 模板
            var attr_value_tpl = $(".attr-values").find("li:last").clone();

            if ($(".new-attr-value").size() == 1) {
                $(".new-attr-value").find(".del-attr-value").prop("disabled", true);
            }

            // 继续添加属性值的点击事件
            $("#add_attribute_value").click(function() {
                $(".attr-values").append($(attr_value_tpl).clone());
                if ($(".new-attr-value").size() > 1) {
                    $(".new-attr-value").find(".del-attr-value").prop("disabled", false);
                }
            });

            // 删除属性
            $('body').on("click", ".del-attr-value", function() {
                $(this).parents(".new-attr-value").remove();
                if ($(".new-attr-value").size() == 1) {
                    $(".new-attr-value").find(".del-attr-value").prop("disabled", true);
                }
            })

            // 删除提示
            $(".delete_label").mouseover(function() {
                var element = this;
                $.tips("被勾选“删除”的属性值将在您点击“确认提交”按钮后被系统删除，请谨慎操作！", this, {
                    time: 0
                });
            }).mouseout(function() {
                $.closeAll("tips");
            });

            $("#brand_list").multiselect2side({
                search: "搜索：",
                selectedPosition: "right",
                moveOptions: false,
                labelsx: " ",
                labeldx: "已选择的关联品牌"
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop