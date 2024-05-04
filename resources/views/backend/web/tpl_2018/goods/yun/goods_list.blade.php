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

    <!--搜索-->
    <div class="search-term m-b-10"><form id="SearchModel" name="SearchModel" action="/goods/yun/goods-list" method="POST">
            @csrf

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>条形码：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" id="searchmodel-barcodes" class="form-control" name="barcodes" placeholder="多个请用逗号分隔">

                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" id="searchmodel-keyword" class="form-control" name="keyword" placeholder="商品ID/名称">

                    </div>
                </div>
            </div>

            {{--云产品库全部商品分类--}}
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>分类：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-cat_id" class="form-control chosen-select" name="cat_id" data-width="400" style="display: none;">
                            @if(!empty($yun_category_format))
                            @foreach($yun_category_format as $k=>$v)
                                <option value="{{ $k }}">{!! $v !!}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>品牌：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-brand_id" class="form-control chosen-select" name="brand_id" data-width="200" style="display: none;">
                            @if(!empty($yun_brand_format))
                            @foreach($yun_brand_format as $k=>$v)
                                <option value="{{ $k }}">{!! $v !!}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                </div>
            </div>




            <div class="simple-form-field">
                <input type="button" id="btn_search" value="搜索" class="btn btn-primary m-r-5">
            </div>
        </form>
    </div>
    <div class="pos-r">
        <div class="search-left">
            <div class="import-type-box">
                <div class="type-nav">
                    <ul>
                        <li class="selected"><a href="javascript:;">分类导入</a></li>
                        <li><a href="javascript:;">智能导入</a></li>
                    </ul>
                </div>
                <div class="type-info">
                    <!--<div class="type-search">
            <input  class="form-control" type="text" value="" placeholder="请输入关键字"/>
            <a class="btn btn-default" href="javascript:;">搜索</a>
            </div>-->
                    <ul class="top-level-menu">

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="1" title=" 接口抓取"> 接口抓取</a><i>&gt;</i></div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="3" title=" 进口商品"> 进口商品</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="4" title=" 进口酒水 "> 进口酒水 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="5" title=" 进口葡萄酒 "> 进口葡萄酒 </a>

                                        <a href="javascript:;" class="cattree" data-id="6" title=" 进口啤酒 "> 进口啤酒 </a>

                                        <a href="javascript:;" class="cattree" data-id="7" title=" 进口洋酒/烈酒 "> 进口洋酒/烈酒 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="8" title=" 进口饼干/糕点 "> 进口饼干/糕点 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="9" title=" 进口饼干 "> 进口饼干 </a>

                                        <a href="javascript:;" class="cattree" data-id="10" title=" 进口糕点 "> 进口糕点 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="11" title=" 进口糖果/巧克力 "> 进口糖果/巧克力 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="12" title=" 进口糖果 "> 进口糖果 </a>

                                        <a href="javascript:;" class="cattree" data-id="13" title=" 进口巧克力 "> 进口巧克力 </a>

                                        <a href="javascript:;" class="cattree" data-id="14" title=" 进口果冻/布丁 "> 进口果冻/布丁 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="15" title=" 进口冲饮 "> 进口冲饮 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="16" title=" 进口咖啡 "> 进口咖啡 </a>

                                        <a href="javascript:;" class="cattree" data-id="17" title=" 进口冲饮茶/蜂蜜 "> 进口冲饮茶/蜂蜜 </a>

                                        <a href="javascript:;" class="cattree" data-id="18" title=" 进口谷物冲饮 "> 进口谷物冲饮 </a>

                                        <a href="javascript:;" class="cattree" data-id="19" title=" 进口奶茶/可可 "> 进口奶茶/可可 </a>

                                        <a href="javascript:;" class="cattree" data-id="20" title=" 进口茶叶 "> 进口茶叶 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="21" title=" 进口零食 "> 进口零食 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="22" title=" 进口薯片/膨化 "> 进口薯片/膨化 </a>

                                        <a href="javascript:;" class="cattree" data-id="23" title=" 进口海产品 "> 进口海产品 </a>

                                        <a href="javascript:;" class="cattree" data-id="24" title=" 进口肉干 "> 进口肉干 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="25" title=" 进口速食 "> 进口速食 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="26" title=" 进口方便面 "> 进口方便面 </a>

                                        <a href="javascript:;" class="cattree" data-id="27" title=" 进口罐头 "> 进口罐头 </a>

                                        <a href="javascript:;" class="cattree" data-id="28" title=" 进口意面 "> 进口意面 </a>

                                        <a href="javascript:;" class="cattree" data-id="29" title=" 其它进口速食 "> 其它进口速食 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="30" title=" 进口牛奶/乳品 "> 进口牛奶/乳品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="31" title=" 进口常温牛奶 "> 进口常温牛奶 </a>

                                        <a href="javascript:;" class="cattree" data-id="32" title=" 进口豆奶/乳饮料 "> 进口豆奶/乳饮料 </a>

                                        <a href="javascript:;" class="cattree" data-id="33" title=" 进口成人奶粉 "> 进口成人奶粉 </a>

                                        <a href="javascript:;" class="cattree" data-id="34" title=" 进口酸奶/乳酸菌 "> 进口酸奶/乳酸菌 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="35" title=" 进口厨房调料 "> 进口厨房调料 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="36" title=" 进口调味酱 "> 进口调味酱 </a>

                                        <a href="javascript:;" class="cattree" data-id="37" title=" 进口调味汁/油 "> 进口调味汁/油 </a>

                                        <a href="javascript:;" class="cattree" data-id="38" title=" 进口调味料 "> 进口调味料 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="39" title=" 进口饮料/水 "> 进口饮料/水 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="40" title=" 进口果汁 "> 进口果汁 </a>

                                        <a href="javascript:;" class="cattree" data-id="41" title=" 进口水 "> 进口水 </a>

                                        <a href="javascript:;" class="cattree" data-id="42" title=" 进口咖啡饮料 "> 进口咖啡饮料 </a>

                                        <a href="javascript:;" class="cattree" data-id="43" title=" 进口碳酸饮料 "> 进口碳酸饮料 </a>

                                        <a href="javascript:;" class="cattree" data-id="44" title=" 进口茶饮料 "> 进口茶饮料 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="45" title=" 进口蜜饯坚果 "> 进口蜜饯坚果 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="46" title=" 进口蜜饯果干 "> 进口蜜饯果干 </a>

                                        <a href="javascript:;" class="cattree" data-id="47" title=" 进口坚果 "> 进口坚果 </a>

                                        <a href="javascript:;" class="cattree" data-id="48" title=" 进口枣类 "> 进口枣类 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="49" title=" 进口粮油 "> 进口粮油 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="50" title=" 进口橄榄油 "> 进口橄榄油 </a>

                                        <a href="javascript:;" class="cattree" data-id="51" title=" 进口其他食用油 "> 进口其他食用油 </a>

                                        <a href="javascript:;" class="cattree" data-id="52" title=" 进口大米 "> 进口大米 </a>

                                        <a href="javascript:;" class="cattree" data-id="53" title=" 进口烘焙原料 "> 进口烘焙原料 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="54" title=" 进口身体清洁护理 "> 进口身体清洁护理 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="55" title=" 进口沐浴露 "> 进口沐浴露 </a>

                                        <a href="javascript:;" class="cattree" data-id="56" title=" 进口身体护理 "> 进口身体护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="57" title=" 进口女性护理 "> 进口女性护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="58" title=" 进口香皂 "> 进口香皂 </a>

                                        <a href="javascript:;" class="cattree" data-id="59" title=" 进口洗手液 "> 进口洗手液 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="60" title=" 进口口腔护理 "> 进口口腔护理 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="61" title=" 进口牙膏 "> 进口牙膏 </a>

                                        <a href="javascript:;" class="cattree" data-id="62" title=" 进口牙刷 "> 进口牙刷 </a>

                                        <a href="javascript:;" class="cattree" data-id="63" title=" 进口口喷 "> 进口口喷 </a>

                                        <a href="javascript:;" class="cattree" data-id="64" title=" 进口漱口水 "> 进口漱口水 </a>

                                        <a href="javascript:;" class="cattree" data-id="65" title=" 进口牙线/美白 "> 进口牙线/美白 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="66" title=" 进口面部洗护 "> 进口面部洗护 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="67" title=" 进口洁面用品 "> 进口洁面用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="68" title=" 进口爽肤水 "> 进口爽肤水 </a>

                                        <a href="javascript:;" class="cattree" data-id="69" title=" 进口面部护理 "> 进口面部护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="70" title=" 进口男士护理 "> 进口男士护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="71" title=" 进口面膜 "> 进口面膜 </a>

                                        <a href="javascript:;" class="cattree" data-id="72" title=" 进口面霜 "> 进口面霜 </a>

                                        <a href="javascript:;" class="cattree" data-id="73" title=" 进口乳液/精华 "> 进口乳液/精华 </a>

                                        <a href="javascript:;" class="cattree" data-id="74" title=" 进口卸妆用品 "> 进口卸妆用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="75" title=" 进口唇部护理 "> 进口唇部护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="76" title=" 进口面部清洁工具 "> 进口面部清洁工具 </a>

                                        <a href="javascript:;" class="cattree" data-id="77" title=" 进口防晒用品 "> 进口防晒用品 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="78" title=" 进口洗发护发 "> 进口洗发护发 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="79" title=" 进口洗发水 "> 进口洗发水 </a>

                                        <a href="javascript:;" class="cattree" data-id="80" title=" 进口护发/润发 "> 进口护发/润发 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="81" title=" 进口母婴用品 "> 进口母婴用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="82" title=" 奶瓶/奶嘴/牙胶 "> 奶瓶/奶嘴/牙胶 </a>

                                        <a href="javascript:;" class="cattree" data-id="83" title=" 日常生活用品 "> 日常生活用品 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="84" title=" 进口家庭清洁 "> 进口家庭清洁 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="85" title=" 进口多用去污 "> 进口多用去污 </a>

                                        <a href="javascript:;" class="cattree" data-id="86" title=" 进口洗洁精 "> 进口洗洁精 </a>

                                        <a href="javascript:;" class="cattree" data-id="87" title=" 进口空气清新/去味 "> 进口空气清新/去味 </a>

                                        <a href="javascript:;" class="cattree" data-id="88" title=" 进口清洁工具 "> 进口清洁工具 </a>

                                        <a href="javascript:;" class="cattree" data-id="89" title=" 进口地板护理 "> 进口地板护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="90" title=" 进口卫浴清洁 "> 进口卫浴清洁 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="91" title=" 进口衣物清洁 "> 进口衣物清洁 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="92" title=" 进口衣物护理 "> 进口衣物护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="93" title=" 进口洗衣液 "> 进口洗衣液 </a>

                                        <a href="javascript:;" class="cattree" data-id="94" title=" 进口洗衣粉 "> 进口洗衣粉 </a>

                                        <a href="javascript:;" class="cattree" data-id="95" title=" 进口衣物除菌/去污 "> 进口衣物除菌/去污 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="96" title=" 进口纸尿裤 "> 进口纸尿裤 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="97" title=" 进口母婴洗护 "> 进口母婴洗护 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="98" title=" 进口滋补保健品 "> 进口滋补保健品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="99" title=" 进口营养保健品 "> 进口营养保健品 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="100" title=" 进口居家日用品 "> 进口居家日用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="101" title=" 进口一次性用品 "> 进口一次性用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="102" title=" 进口办公用品 "> 进口办公用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="103" title=" 进口居家护理 "> 进口居家护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="104" title=" 进口纸巾 "> 进口纸巾 </a>

                                        <a href="javascript:;" class="cattree" data-id="105" title=" 进口家纺/内衣服饰 "> 进口家纺/内衣服饰 </a>

                                        <a href="javascript:;" class="cattree" data-id="106" title=" 进口运动保健 "> 进口运动保健 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="107" title=" 进口婴幼儿奶粉 "> 进口婴幼儿奶粉 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="108" title=" 进口厨卫用品 "> 进口厨卫用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="109" title=" 进口厨具/锅具 "> 进口厨具/锅具 </a>

                                        <a href="javascript:;" class="cattree" data-id="110" title=" 进口餐具/水杯 "> 进口餐具/水杯 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="111" title=" 进口彩妆/美妆/香水 "> 进口彩妆/美妆/香水 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="112" title=" 进口眼部彩妆 "> 进口眼部彩妆 </a>

                                        <a href="javascript:;" class="cattree" data-id="113" title=" 进口美妆工具 "> 进口美妆工具 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="114" title=" 饮料/酒水/冲饮"> 饮料/酒水/冲饮</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="115" title=" 酒类 "> 酒类 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="116" title=" 白酒 "> 白酒 </a>

                                        <a href="javascript:;" class="cattree" data-id="117" title=" 啤酒 "> 啤酒 </a>

                                        <a href="javascript:;" class="cattree" data-id="118" title=" 葡萄酒 "> 葡萄酒 </a>

                                        <a href="javascript:;" class="cattree" data-id="119" title=" 黄酒 "> 黄酒 </a>

                                        <a href="javascript:;" class="cattree" data-id="120" title=" 洋酒 "> 洋酒 </a>

                                        <a href="javascript:;" class="cattree" data-id="121" title=" 其他酒类 "> 其他酒类 </a>

                                        <a href="javascript:;" class="cattree" data-id="122" title=" 保健酒 "> 保健酒 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="123" title=" 饮料/水/果汁 "> 饮料/水/果汁 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="124" title=" 果蔬饮料 "> 果蔬饮料 </a>

                                        <a href="javascript:;" class="cattree" data-id="125" title=" 水 "> 水 </a>

                                        <a href="javascript:;" class="cattree" data-id="126" title=" 碳酸饮料 "> 碳酸饮料 </a>

                                        <a href="javascript:;" class="cattree" data-id="127" title=" 茶饮料 "> 茶饮料 </a>

                                        <a href="javascript:;" class="cattree" data-id="128" title=" 功能饮料 "> 功能饮料 </a>

                                        <a href="javascript:;" class="cattree" data-id="129" title=" 咖啡饮料 "> 咖啡饮料 </a>

                                        <a href="javascript:;" class="cattree" data-id="130" title=" 其他饮料 "> 其他饮料 </a>

                                        <a href="javascript:;" class="cattree" data-id="131" title=" 酸梅汤 "> 酸梅汤 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="132" title=" 冲饮 "> 冲饮 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="133" title=" 蜂蜜果味冲饮 "> 蜂蜜果味冲饮 </a>

                                        <a href="javascript:;" class="cattree" data-id="134" title=" 麦片谷物冲饮 "> 麦片谷物冲饮 </a>

                                        <a href="javascript:;" class="cattree" data-id="135" title=" 冲饮果汁 "> 冲饮果汁 </a>

                                        <a href="javascript:;" class="cattree" data-id="136" title=" 豆浆 "> 豆浆 </a>

                                        <a href="javascript:;" class="cattree" data-id="137" title=" 芝麻糊/藕粉 "> 芝麻糊/藕粉 </a>

                                        <a href="javascript:;" class="cattree" data-id="138" title=" 其它冲饮 "> 其它冲饮 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="139" title=" 咖啡/奶茶 "> 咖啡/奶茶 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="140" title=" 速溶咖啡 "> 速溶咖啡 </a>

                                        <a href="javascript:;" class="cattree" data-id="141" title=" 奶茶 "> 奶茶 </a>

                                        <a href="javascript:;" class="cattree" data-id="142" title=" 咖啡豆/伴侣 "> 咖啡豆/伴侣 </a>

                                        <a href="javascript:;" class="cattree" data-id="143" title=" 可可/巧克力饮品 "> 可可/巧克力饮品 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="144" title=" 茶叶 "> 茶叶 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="145" title=" 花草茶 "> 花草茶 </a>

                                        <a href="javascript:;" class="cattree" data-id="146" title=" 绿茶 "> 绿茶 </a>

                                        <a href="javascript:;" class="cattree" data-id="147" title=" 红茶 "> 红茶 </a>

                                        <a href="javascript:;" class="cattree" data-id="148" title=" 普洱茶 "> 普洱茶 </a>

                                        <a href="javascript:;" class="cattree" data-id="149" title=" 乌龙茶 "> 乌龙茶 </a>

                                        <a href="javascript:;" class="cattree" data-id="150" title=" 其他茶叶/袋泡茶 "> 其他茶叶/袋泡茶 </a>

                                        <a href="javascript:;" class="cattree" data-id="151" title=" 白茶 "> 白茶 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="152" title=" 成人奶粉 "> 成人奶粉 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="153" title=" 成人奶粉 "> 成人奶粉 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="154" title=" 其他冲饮品 "> 其他冲饮品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="155" title=" 天然粉粉食品 "> 天然粉粉食品 </a>

                                        <a href="javascript:;" class="cattree" data-id="156" title=" 酸梅粉 "> 酸梅粉 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="157" title=" 零食/饼干/巧克力/糖果/炒货"> 零食/饼干/巧克力...</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="158" title=" 饼干/曲奇/蛋卷 "> 饼干/曲奇/蛋卷 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="159" title=" 饼干 "> 饼干 </a>

                                        <a href="javascript:;" class="cattree" data-id="160" title=" 曲奇 "> 曲奇 </a>

                                        <a href="javascript:;" class="cattree" data-id="161" title=" 蛋卷 "> 蛋卷 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="162" title=" 糖果/巧克力 "> 糖果/巧克力 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="163" title=" 糖果 "> 糖果 </a>

                                        <a href="javascript:;" class="cattree" data-id="164" title=" 巧克力 "> 巧克力 </a>

                                        <a href="javascript:;" class="cattree" data-id="165" title=" 口香糖 "> 口香糖 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="166" title=" 果干/蜜饯 "> 果干/蜜饯 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="167" title=" 梅类 "> 梅类 </a>

                                        <a href="javascript:;" class="cattree" data-id="168" title=" 枣类 "> 枣类 </a>

                                        <a href="javascript:;" class="cattree" data-id="169" title=" 其他果干 "> 其他果干 </a>

                                        <a href="javascript:;" class="cattree" data-id="170" title=" 葡萄干 "> 葡萄干 </a>

                                        <a href="javascript:;" class="cattree" data-id="171" title=" 山楂制品 "> 山楂制品 </a>

                                        <a href="javascript:;" class="cattree" data-id="172" title=" 芒果/蔬果干 "> 芒果/蔬果干 </a>

                                        <a href="javascript:;" class="cattree" data-id="173" title=" 菠萝/榴莲干 "> 菠萝/榴莲干 </a>

                                        <a href="javascript:;" class="cattree" data-id="174" title=" 樱桃/无花果/车厘子 "> 樱桃/无花果/车厘子 </a>

                                        <a href="javascript:;" class="cattree" data-id="175" title=" 薯类/笋类制品 "> 薯类/笋类制品 </a>

                                        <a href="javascript:;" class="cattree" data-id="176" title=" 李子/加应子 "> 李子/加应子 </a>

                                        <a href="javascript:;" class="cattree" data-id="177" title=" 蓝莓/橄榄 "> 蓝莓/橄榄 </a>

                                        <a href="javascript:;" class="cattree" data-id="178" title=" 香蕉/杏干 "> 香蕉/杏干 </a>

                                        <a href="javascript:;" class="cattree" data-id="179" title=" 内蒙乳酪 "> 内蒙乳酪 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="180" title=" 坚果炒货 "> 坚果炒货 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="181" title=" 花生 "> 花生 </a>

                                        <a href="javascript:;" class="cattree" data-id="182" title=" 瓜子 "> 瓜子 </a>

                                        <a href="javascript:;" class="cattree" data-id="183" title=" 其他坚果 "> 其他坚果 </a>

                                        <a href="javascript:;" class="cattree" data-id="184" title=" 豆类制品 "> 豆类制品 </a>

                                        <a href="javascript:;" class="cattree" data-id="185" title=" 腰果 "> 腰果 </a>

                                        <a href="javascript:;" class="cattree" data-id="186" title=" 核桃/核桃仁 "> 核桃/核桃仁 </a>

                                        <a href="javascript:;" class="cattree" data-id="187" title=" 杏仁/巴旦木 "> 杏仁/巴旦木 </a>

                                        <a href="javascript:;" class="cattree" data-id="188" title=" 松子/夏威夷果 "> 松子/夏威夷果 </a>

                                        <a href="javascript:;" class="cattree" data-id="189" title=" 长寿果/碧根果 "> 长寿果/碧根果 </a>

                                        <a href="javascript:;" class="cattree" data-id="190" title=" 开心果 "> 开心果 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="191" title=" 糕点/蛋黄派 "> 糕点/蛋黄派 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="192" title=" 传统糕点 "> 传统糕点 </a>

                                        <a href="javascript:;" class="cattree" data-id="193" title=" 西式糕点 "> 西式糕点 </a>

                                        <a href="javascript:;" class="cattree" data-id="194" title=" 月饼 "> 月饼 </a>

                                        <a href="javascript:;" class="cattree" data-id="195" title=" 其他糕点 "> 其他糕点 </a>

                                        <a href="javascript:;" class="cattree" data-id="196" title=" 沙琪玛 "> 沙琪玛 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="197" title=" 薯片/膨化 "> 薯片/膨化 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="198" title=" 肉类休闲零食 "> 肉类休闲零食 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="199" title=" 鸡鸭/禽肉类 "> 鸡鸭/禽肉类 </a>

                                        <a href="javascript:;" class="cattree" data-id="200" title=" 牛肉类 "> 牛肉类 </a>

                                        <a href="javascript:;" class="cattree" data-id="201" title=" 猪肉类 "> 猪肉类 </a>

                                        <a href="javascript:;" class="cattree" data-id="202" title=" 其他肉制零食 "> 其他肉制零食 </a>

                                        <a href="javascript:;" class="cattree" data-id="203" title=" 兔肉 "> 兔肉 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="204" title=" 海味零食 "> 海味零食 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="205" title=" 鱼零食 "> 鱼零食 </a>

                                        <a href="javascript:;" class="cattree" data-id="206" title=" 海苔/海带 "> 海苔/海带 </a>

                                        <a href="javascript:;" class="cattree" data-id="207" title=" 鱿鱼零食 "> 鱿鱼零食 </a>

                                        <a href="javascript:;" class="cattree" data-id="208" title=" 海味其他 "> 海味其他 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="209" title=" 豆干/蔬菜干 "> 豆干/蔬菜干 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="210" title=" 果冻/布丁/龟苓膏 "> 果冻/布丁/龟苓膏 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="211" title=" 奶制品"> 奶制品</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="212" title=" 常温奶 "> 常温奶 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="213" title=" 含乳饮料 "> 含乳饮料 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="214" title=" 酸奶 "> 酸奶 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="215" title=" 豆奶 "> 豆奶 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="216" title=" 滋补保健"> 滋补保健</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="217" title=" 传统滋补营养品 "> 传统滋补营养品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="218" title=" 蜂蜜 "> 蜂蜜 </a>

                                        <a href="javascript:;" class="cattree" data-id="219" title=" 枸杞/其他 "> 枸杞/其他 </a>

                                        <a href="javascript:;" class="cattree" data-id="220" title=" 阿胶 "> 阿胶 </a>

                                        <a href="javascript:;" class="cattree" data-id="221" title=" 药食同源物品 "> 药食同源物品 </a>

                                        <a href="javascript:;" class="cattree" data-id="222" title=" 养生茶 "> 养生茶 </a>

                                        <a href="javascript:;" class="cattree" data-id="223" title=" 山参/人参/西洋参/高丽参 "> 山参/人参/西洋参/高丽参 </a>

                                        <a href="javascript:;" class="cattree" data-id="224" title=" 其他传统滋补 "> 其他传统滋补 </a>

                                        <a href="javascript:;" class="cattree" data-id="225" title=" 燕窝 "> 燕窝 </a>

                                        <a href="javascript:;" class="cattree" data-id="226" title=" 灵芝/孢子粉 "> 灵芝/孢子粉 </a>

                                        <a href="javascript:;" class="cattree" data-id="227" title=" 冬虫夏草 "> 冬虫夏草 </a>

                                        <a href="javascript:;" class="cattree" data-id="228" title=" 药膳养生汤料 "> 药膳养生汤料 </a>

                                        <a href="javascript:;" class="cattree" data-id="229" title=" 蜂产品 "> 蜂产品 </a>

                                        <a href="javascript:;" class="cattree" data-id="230" title=" 三七 "> 三七 </a>

                                        <a href="javascript:;" class="cattree" data-id="231" title=" 五谷养生营养品 "> 五谷养生营养品 </a>

                                        <a href="javascript:;" class="cattree" data-id="232" title=" 石斛/枫斗 "> 石斛/枫斗 </a>

                                        <a href="javascript:;" class="cattree" data-id="233" title=" 山药 "> 山药 </a>

                                        <a href="javascript:;" class="cattree" data-id="234" title=" 新资源食品 "> 新资源食品 </a>

                                        <a href="javascript:;" class="cattree" data-id="235" title=" 元贝 "> 元贝 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="236" title=" 保健食品 "> 保健食品 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="237" title=" 维生素/矿物质 "> 维生素/矿物质 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="238" title=" 维生素 "> 维生素 </a>

                                        <a href="javascript:;" class="cattree" data-id="239" title=" 钙铁锌 "> 钙铁锌 </a>

                                        <a href="javascript:;" class="cattree" data-id="240" title=" 其他矿物质 "> 其他矿物质 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="241" title=" 保健饮品/其他 "> 保健饮品/其他 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="242" title=" 其他保健品 "> 其他保健品 </a>

                                        <a href="javascript:;" class="cattree" data-id="243" title=" 功能复合型膳食营养补充剂 "> 功能复合型膳食营养补充剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="244" title=" 保健饮品 "> 保健饮品 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="245" title=" 蛋白质/氨基酸/植物精华 "> 蛋白质/氨基酸/植物精华 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="246" title=" 植物精华/提取物 "> 植物精华/提取物 </a>

                                        <a href="javascript:;" class="cattree" data-id="247" title=" 其他蛋白质/氨基酸 "> 其他蛋白质/氨基酸 </a>

                                        <a href="javascript:;" class="cattree" data-id="248" title=" 胶原蛋白 "> 胶原蛋白 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="249" title=" 粮油/米面/速食"> 粮油/米面/速食</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="250" title=" 方便速食 "> 方便速食 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="251" title=" 方便面/米线/粉丝 "> 方便面/米线/粉丝 </a>

                                        <a href="javascript:;" class="cattree" data-id="252" title=" 火腿肠 "> 火腿肠 </a>

                                        <a href="javascript:;" class="cattree" data-id="253" title=" 蛋制品 "> 蛋制品 </a>

                                        <a href="javascript:;" class="cattree" data-id="254" title=" 罐头 "> 罐头 </a>

                                        <a href="javascript:;" class="cattree" data-id="255" title=" 挂面 "> 挂面 </a>

                                        <a href="javascript:;" class="cattree" data-id="256" title=" 速食汤 "> 速食汤 </a>

                                        <a href="javascript:;" class="cattree" data-id="257" title=" 意大利面 "> 意大利面 </a>

                                        <a href="javascript:;" class="cattree" data-id="258" title=" 粽子 "> 粽子 </a>

                                        <a href="javascript:;" class="cattree" data-id="259" title=" 方便米饭 "> 方便米饭 </a>

                                        <a href="javascript:;" class="cattree" data-id="260" title=" 年糕 "> 年糕 </a>

                                        <a href="javascript:;" class="cattree" data-id="261" title=" 其他 "> 其他 </a>

                                        <a href="javascript:;" class="cattree" data-id="262" title=" 方便菜肴 "> 方便菜肴 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="263" title=" 调味品 "> 调味品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="264" title=" 调味酱 "> 调味酱 </a>

                                        <a href="javascript:;" class="cattree" data-id="265" title=" 调味料 "> 调味料 </a>

                                        <a href="javascript:;" class="cattree" data-id="266" title=" 酱油 "> 酱油 </a>

                                        <a href="javascript:;" class="cattree" data-id="267" title=" 腌制品 "> 腌制品 </a>

                                        <a href="javascript:;" class="cattree" data-id="268" title=" 醋 "> 醋 </a>

                                        <a href="javascript:;" class="cattree" data-id="269" title=" 食糖 "> 食糖 </a>

                                        <a href="javascript:;" class="cattree" data-id="270" title=" 火锅调料 "> 火锅调料 </a>

                                        <a href="javascript:;" class="cattree" data-id="271" title=" 调味汁/麻油 "> 调味汁/麻油 </a>

                                        <a href="javascript:;" class="cattree" data-id="272" title=" 腐乳 "> 腐乳 </a>

                                        <a href="javascript:;" class="cattree" data-id="273" title=" 咖喱 "> 咖喱 </a>

                                        <a href="javascript:;" class="cattree" data-id="274" title=" 鸡精/味精 "> 鸡精/味精 </a>

                                        <a href="javascript:;" class="cattree" data-id="275" title=" 辣椒调料 "> 辣椒调料 </a>

                                        <a href="javascript:;" class="cattree" data-id="276" title=" 果酱/沙拉酱 "> 果酱/沙拉酱 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="277" title=" 菌菇干货 "> 菌菇干货 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="278" title=" 粉丝 "> 粉丝 </a>

                                        <a href="javascript:;" class="cattree" data-id="279" title=" 枣类 "> 枣类 </a>

                                        <a href="javascript:;" class="cattree" data-id="280" title=" 食用菌 "> 食用菌 </a>

                                        <a href="javascript:;" class="cattree" data-id="281" title=" 桂圆干 "> 桂圆干 </a>

                                        <a href="javascript:;" class="cattree" data-id="282" title=" 木耳 "> 木耳 </a>

                                        <a href="javascript:;" class="cattree" data-id="283" title=" 枸杞 "> 枸杞 </a>

                                        <a href="javascript:;" class="cattree" data-id="284" title=" 银耳 "> 银耳 </a>

                                        <a href="javascript:;" class="cattree" data-id="285" title=" 海产品 "> 海产品 </a>

                                        <a href="javascript:;" class="cattree" data-id="286" title=" 干菜/紫菜 "> 干菜/紫菜 </a>

                                        <a href="javascript:;" class="cattree" data-id="287" title=" 莲子 "> 莲子 </a>

                                        <a href="javascript:;" class="cattree" data-id="288" title=" 百合 "> 百合 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="289" title=" 大米面粉 "> 大米面粉 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="290" title=" 大米 "> 大米 </a>

                                        <a href="javascript:;" class="cattree" data-id="291" title=" 面粉 "> 面粉 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="292" title=" 健康杂粮 "> 健康杂粮 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="293" title=" 粗粮 "> 粗粮 </a>

                                        <a href="javascript:;" class="cattree" data-id="294" title=" 豆类 "> 豆类 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="295" title=" 食用油 "> 食用油 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="296" title=" 其他 "> 其他 </a>

                                        <a href="javascript:;" class="cattree" data-id="297" title=" 橄榄油 "> 橄榄油 </a>

                                        <a href="javascript:;" class="cattree" data-id="298" title=" 调和油 "> 调和油 </a>

                                        <a href="javascript:;" class="cattree" data-id="299" title=" 玉米油 "> 玉米油 </a>

                                        <a href="javascript:;" class="cattree" data-id="300" title=" 花生油 "> 花生油 </a>

                                        <a href="javascript:;" class="cattree" data-id="301" title=" 葵花籽油 "> 葵花籽油 </a>

                                        <a href="javascript:;" class="cattree" data-id="302" title=" 大豆油 "> 大豆油 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="303" title=" 腊肠/腊肉 "> 腊肠/腊肉 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="304" title=" 粽子 "> 粽子 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="305" title=" 个人洗护/口腔护理"> 个人洗护/口腔护理</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="306" title=" 洗发/护发/染发/造型 "> 洗发/护发/染发/造型 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="307" title=" 洗发水 "> 洗发水 </a>

                                        <a href="javascript:;" class="cattree" data-id="308" title=" 护发素/发膜/营养水 "> 护发素/发膜/营养水 </a>

                                        <a href="javascript:;" class="cattree" data-id="309" title=" 染发剂/啫哩水/头发造型 "> 染发剂/啫哩水/头发造型 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="310" title=" 牙膏/牙刷/漱口水/牙线 "> 牙膏/牙刷/漱口水/牙线 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="311" title=" 牙膏 "> 牙膏 </a>

                                        <a href="javascript:;" class="cattree" data-id="312" title=" 牙刷 "> 牙刷 </a>

                                        <a href="javascript:;" class="cattree" data-id="313" title=" 儿童口腔护理 "> 儿童口腔护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="314" title=" 口腔清洁套装 "> 口腔清洁套装 </a>

                                        <a href="javascript:;" class="cattree" data-id="315" title=" 漱口水 "> 漱口水 </a>

                                        <a href="javascript:;" class="cattree" data-id="316" title=" 牙线/牙线棒/牙粉 "> 牙线/牙线棒/牙粉 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="317" title=" 沐浴露/香皂/洗手液/浴盐 "> 沐浴露/香皂/洗手液/浴盐 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="318" title=" 沐浴露 "> 沐浴露 </a>

                                        <a href="javascript:;" class="cattree" data-id="319" title=" 香皂 "> 香皂 </a>

                                        <a href="javascript:;" class="cattree" data-id="320" title=" 足浴盐/浴足剂/足部磨砂 "> 足浴盐/浴足剂/足部磨砂 </a>

                                        <a href="javascript:;" class="cattree" data-id="321" title=" 洗手液 "> 洗手液 </a>

                                        <a href="javascript:;" class="cattree" data-id="322" title=" 私处洗液 "> 私处洗液 </a>

                                        <a href="javascript:;" class="cattree" data-id="323" title=" 去角质/泡澡浴盐/磨砂盐 "> 去角质/泡澡浴盐/磨砂盐 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="324" title=" 男士剃须 "> 男士剃须 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="325" title=" 剃须刀 "> 剃须刀 </a>

                                        <a href="javascript:;" class="cattree" data-id="326" title=" 剃须啫喱/剃须膏/剃须泡 "> 剃须啫喱/剃须膏/剃须泡 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="327" title=" 痱子粉/爽身粉/花露水 "> 痱子粉/爽身粉/花露水 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="328" title=" 香熏用品 "> 香熏用品 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="329" title=" 避孕套 "> 避孕套 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="330" title=" 护肤彩妆"> 护肤彩妆</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="331" title=" 面部护肤 "> 面部护肤 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="332" title=" 面部护理套装 "> 面部护理套装 </a>

                                        <a href="javascript:;" class="cattree" data-id="333" title=" 乳液面霜 "> 乳液面霜 </a>

                                        <a href="javascript:;" class="cattree" data-id="334" title=" 化妆水爽肤水喷雾 "> 化妆水爽肤水喷雾 </a>

                                        <a href="javascript:;" class="cattree" data-id="335" title=" 眼霜眼膜眼部精华 "> 眼霜眼膜眼部精华 </a>

                                        <a href="javascript:;" class="cattree" data-id="336" title=" 卸妆 "> 卸妆 </a>

                                        <a href="javascript:;" class="cattree" data-id="337" title=" 面部精华 "> 面部精华 </a>

                                        <a href="javascript:;" class="cattree" data-id="338" title=" T区护理 "> T区护理 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="339" title=" 精致彩妆 "> 精致彩妆 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="340" title=" 彩妆工具 "> 彩妆工具 </a>

                                        <a href="javascript:;" class="cattree" data-id="341" title=" 眼部彩妆 "> 眼部彩妆 </a>

                                        <a href="javascript:;" class="cattree" data-id="342" title=" BB霜隔离/妆前/打底 "> BB霜隔离/妆前/打底 </a>

                                        <a href="javascript:;" class="cattree" data-id="343" title=" 唇膏/口红 "> 唇膏/口红 </a>

                                        <a href="javascript:;" class="cattree" data-id="344" title=" 粉饼蜜粉 "> 粉饼蜜粉 </a>

                                        <a href="javascript:;" class="cattree" data-id="345" title=" 指甲油 "> 指甲油 </a>

                                        <a href="javascript:;" class="cattree" data-id="346" title=" 粉底液/膏 "> 粉底液/膏 </a>

                                        <a href="javascript:;" class="cattree" data-id="347" title=" 唇彩/唇蜜 "> 唇彩/唇蜜 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="348" title=" 面膜 "> 面膜 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="349" title=" 洁面 "> 洁面 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="350" title=" 男士护理 "> 男士护理 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="351" title=" 男士护理 "> 男士护理 </a>

                                        <a href="javascript:;" class="cattree" data-id="352" title=" 男士洁面 "> 男士洁面 </a>

                                        <a href="javascript:;" class="cattree" data-id="353" title=" 男士乳液/面霜 "> 男士乳液/面霜 </a>

                                        <a href="javascript:;" class="cattree" data-id="354" title=" 男士爽肤水/须后水 "> 男士爽肤水/须后水 </a>

                                        <a href="javascript:;" class="cattree" data-id="355" title=" 男士护理套装 "> 男士护理套装 </a>

                                        <a href="javascript:;" class="cattree" data-id="356" title=" 男士精华 "> 男士精华 </a>

                                        <a href="javascript:;" class="cattree" data-id="357" title=" 男士控油 "> 男士控油 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="358" title=" 护手霜 "> 护手霜 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="359" title=" 身体乳 "> 身体乳 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="360" title=" 防晒 "> 防晒 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="361" title=" 润唇膏 "> 润唇膏 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="362" title=" 足膜/足部护理 "> 足膜/足部护理 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="363" title=" 其他护肤用品 "> 其他护肤用品 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="364" title=" 脱毛膏 "> 脱毛膏 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="365" title=" 止汗香体 "> 止汗香体 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="366" title=" 精油护理 "> 精油护理 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="367" title=" 清洁剂/清洁工具"> 清洁剂/清洁工具</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="368" title=" 衣物清洁剂 "> 衣物清洁剂 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="369" title=" 洗衣液 "> 洗衣液 </a>

                                        <a href="javascript:;" class="cattree" data-id="370" title=" 洗衣粉 "> 洗衣粉 </a>

                                        <a href="javascript:;" class="cattree" data-id="371" title=" 洗衣皂 "> 洗衣皂 </a>

                                        <a href="javascript:;" class="cattree" data-id="372" title=" 柔顺剂 "> 柔顺剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="373" title=" 消毒液 "> 消毒液 </a>

                                        <a href="javascript:;" class="cattree" data-id="374" title=" 漂白剂/彩漂 "> 漂白剂/彩漂 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="375" title=" 衣物清洁用具 "> 衣物清洁用具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="376" title=" 衣架 "> 衣架 </a>

                                        <a href="javascript:;" class="cattree" data-id="377" title=" 洗衣袋 "> 洗衣袋 </a>

                                        <a href="javascript:;" class="cattree" data-id="378" title=" 脏衣篮 "> 脏衣篮 </a>

                                        <a href="javascript:;" class="cattree" data-id="379" title=" 刷子 "> 刷子 </a>

                                        <a href="javascript:;" class="cattree" data-id="380" title=" 手套 "> 手套 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="381" title=" 客厅/厨卫清洁剂 "> 客厅/厨卫清洁剂 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="382" title=" 蚊香/驱虫用品 "> 蚊香/驱虫用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="383" title=" 洗洁精 "> 洗洁精 </a>

                                        <a href="javascript:;" class="cattree" data-id="384" title=" 马桶清洁剂/洁厕剂 "> 马桶清洁剂/洁厕剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="385" title=" 多用途清洁剂 "> 多用途清洁剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="386" title=" 油污清洁剂 "> 油污清洁剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="387" title=" 防霉防蛀片 "> 防霉防蛀片 </a>

                                        <a href="javascript:;" class="cattree" data-id="388" title=" 管道疏通剂 "> 管道疏通剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="389" title=" 其它清洁用品 "> 其它清洁用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="390" title=" 玻璃/瓷砖清洁剂 "> 玻璃/瓷砖清洁剂 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="391" title=" 客厅/厨卫清洁用具 "> 客厅/厨卫清洁用具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="392" title=" 垃圾桶 "> 垃圾桶 </a>

                                        <a href="javascript:;" class="cattree" data-id="393" title=" 拖把 "> 拖把 </a>

                                        <a href="javascript:;" class="cattree" data-id="394" title=" 扫把/簸箕 "> 扫把/簸箕 </a>

                                        <a href="javascript:;" class="cattree" data-id="395" title=" 抹布/百洁布 "> 抹布/百洁布 </a>

                                        <a href="javascript:;" class="cattree" data-id="396" title=" 钢丝球/锅刷 "> 钢丝球/锅刷 </a>

                                        <a href="javascript:;" class="cattree" data-id="397" title=" 玻璃清洁工具 "> 玻璃清洁工具 </a>

                                        <a href="javascript:;" class="cattree" data-id="398" title=" 家务手套 "> 家务手套 </a>

                                        <a href="javascript:;" class="cattree" data-id="399" title=" 围裙/袖套 "> 围裙/袖套 </a>

                                        <a href="javascript:;" class="cattree" data-id="400" title=" 除尘掸/掸头 "> 除尘掸/掸头 </a>

                                        <a href="javascript:;" class="cattree" data-id="401" title=" 静电除尘 "> 静电除尘 </a>

                                        <a href="javascript:;" class="cattree" data-id="402" title=" 马桶/卫浴刷 "> 马桶/卫浴刷 </a>

                                        <a href="javascript:;" class="cattree" data-id="403" title=" 脸盆/桶 "> 脸盆/桶 </a>

                                        <a href="javascript:;" class="cattree" data-id="404" title=" 防油贴纸 "> 防油贴纸 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="405" title=" 家私/皮具护理品 "> 家私/皮具护理品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="406" title=" 地板护理日化用品 "> 地板护理日化用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="407" title=" 家私护理日化品 "> 家私护理日化品 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="408" title=" 甲醛清除/除臭/芳香用品 "> 甲醛清除/除臭/芳香用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="409" title=" 空气芳香剂 "> 空气芳香剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="410" title=" 干燥剂 "> 干燥剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="411" title=" 甲醛清除剂/甲醛测试 "> 甲醛清除剂/甲醛测试 </a>

                                        <a href="javascript:;" class="cattree" data-id="412" title=" 冰箱除味剂 "> 冰箱除味剂 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="413" title=" 鞋用品 "> 鞋用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="414" title=" 鞋油 "> 鞋油 </a>

                                        <a href="javascript:;" class="cattree" data-id="415" title=" 鞋套 "> 鞋套 </a>

                                        <a href="javascript:;" class="cattree" data-id="416" title=" 鞋刷 "> 鞋刷 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="417" title=" 居家日用/收纳/洗晒工具"> 居家日用/收纳/洗...</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="418" title=" 化妆/美容工具 "> 化妆/美容工具 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="419" title=" 个人清洁用具 "> 个人清洁用具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="420" title=" 浴球/浴花 "> 浴球/浴花 </a>

                                        <a href="javascript:;" class="cattree" data-id="421" title=" 棉签/棉棒 "> 棉签/棉棒 </a>

                                        <a href="javascript:;" class="cattree" data-id="422" title=" 面扑/粉扑 "> 面扑/粉扑 </a>

                                        <a href="javascript:;" class="cattree" data-id="423" title=" 牙签 "> 牙签 </a>

                                        <a href="javascript:;" class="cattree" data-id="424" title=" 指甲钳/修甲刀 "> 指甲钳/修甲刀 </a>

                                        <a href="javascript:;" class="cattree" data-id="425" title=" 浴帽 "> 浴帽 </a>

                                        <a href="javascript:;" class="cattree" data-id="426" title=" 干发帽/束发带 "> 干发帽/束发带 </a>

                                        <a href="javascript:;" class="cattree" data-id="427" title=" 喷瓶/分装瓶 "> 喷瓶/分装瓶 </a>

                                        <a href="javascript:;" class="cattree" data-id="428" title=" 浴室用品套件 "> 浴室用品套件 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="429" title=" 衣物洗晒/护理用具 "> 衣物洗晒/护理用具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="430" title=" 衣架/裤架 "> 衣架/裤架 </a>

                                        <a href="javascript:;" class="cattree" data-id="431" title=" 护洗袋 "> 护洗袋 </a>

                                        <a href="javascript:;" class="cattree" data-id="432" title=" 夹子/绳 "> 夹子/绳 </a>

                                        <a href="javascript:;" class="cattree" data-id="433" title=" 衣物除尘/粘毛 "> 衣物除尘/粘毛 </a>

                                        <a href="javascript:;" class="cattree" data-id="434" title=" 晾晒架 "> 晾晒架 </a>

                                        <a href="javascript:;" class="cattree" data-id="435" title=" 脏衣篮 "> 脏衣篮 </a>

                                        <a href="javascript:;" class="cattree" data-id="436" title=" 晒衣篮 "> 晒衣篮 </a>

                                        <a href="javascript:;" class="cattree" data-id="437" title=" 烫衣板/搓衣板 "> 烫衣板/搓衣板 </a>

                                        <a href="javascript:;" class="cattree" data-id="438" title=" 衣叉 "> 衣叉 </a>

                                        <a href="javascript:;" class="cattree" data-id="439" title=" 搓衣板 "> 搓衣板 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="440" title=" 整理/收纳用具 "> 整理/收纳用具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="441" title=" 挂钩/粘钩 "> 挂钩/粘钩 </a>

                                        <a href="javascript:;" class="cattree" data-id="442" title=" 压缩袋 "> 压缩袋 </a>

                                        <a href="javascript:;" class="cattree" data-id="443" title=" 抽气泵 "> 抽气泵 </a>

                                        <a href="javascript:;" class="cattree" data-id="444" title=" 收纳袋 "> 收纳袋 </a>

                                        <a href="javascript:;" class="cattree" data-id="445" title=" 收纳盒 "> 收纳盒 </a>

                                        <a href="javascript:;" class="cattree" data-id="446" title=" 收纳篮 "> 收纳篮 </a>

                                        <a href="javascript:;" class="cattree" data-id="447" title=" 收纳桶 "> 收纳桶 </a>

                                        <a href="javascript:;" class="cattree" data-id="448" title=" 收纳罐 "> 收纳罐 </a>

                                        <a href="javascript:;" class="cattree" data-id="449" title=" 整理架/置物架 "> 整理架/置物架 </a>

                                        <a href="javascript:;" class="cattree" data-id="450" title=" 防尘罩 "> 防尘罩 </a>

                                        <a href="javascript:;" class="cattree" data-id="451" title=" 收纳箱 "> 收纳箱 </a>

                                        <a href="javascript:;" class="cattree" data-id="452" title=" 纸巾盒 "> 纸巾盒 </a>

                                        <a href="javascript:;" class="cattree" data-id="453" title=" 收纳柜 "> 收纳柜 </a>

                                        <a href="javascript:;" class="cattree" data-id="454" title=" 收纳凳 "> 收纳凳 </a>

                                        <a href="javascript:;" class="cattree" data-id="455" title=" 收纳包 "> 收纳包 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="456" title=" 伞/雨具 "> 伞/雨具 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="457" title=" 保暖贴/热水袋/冰贴 "> 保暖贴/热水袋/冰贴 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="458" title=" 口罩 "> 口罩 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="459" title=" 鞋用品 "> 鞋用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="460" title=" 鞋油 "> 鞋油 </a>

                                        <a href="javascript:;" class="cattree" data-id="461" title=" 鞋套 "> 鞋套 </a>

                                        <a href="javascript:;" class="cattree" data-id="462" title=" 鞋垫 "> 鞋垫 </a>

                                        <a href="javascript:;" class="cattree" data-id="463" title=" 鞋刷 "> 鞋刷 </a>

                                        <a href="javascript:;" class="cattree" data-id="464" title=" 烘鞋器 "> 烘鞋器 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="465" title=" 竹炭包 "> 竹炭包 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="466" title=" 防霉驱虫 "> 防霉驱虫 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="467" title=" 卫浴用具/配件 "> 卫浴用具/配件 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="468" title=" 粘钩 "> 粘钩 </a>

                                        <a href="javascript:;" class="cattree" data-id="469" title=" 地垫 "> 地垫 </a>

                                        <a href="javascript:;" class="cattree" data-id="470" title=" 浴帘/浴帘杆 "> 浴帘/浴帘杆 </a>

                                        <a href="javascript:;" class="cattree" data-id="471" title=" 皂盒 "> 皂盒 </a>

                                        <a href="javascript:;" class="cattree" data-id="472" title=" 马桶座圈 "> 马桶座圈 </a>

                                        <a href="javascript:;" class="cattree" data-id="473" title=" 马桶刷/疏通器 "> 马桶刷/疏通器 </a>

                                        <a href="javascript:;" class="cattree" data-id="474" title=" 牙刷架/漱口杯 "> 牙刷架/漱口杯 </a>

                                        <a href="javascript:;" class="cattree" data-id="475" title=" 浴室置物架 "> 浴室置物架 </a>

                                        <a href="javascript:;" class="cattree" data-id="476" title=" 其他配件 "> 其他配件 </a>

                                        <a href="javascript:;" class="cattree" data-id="477" title=" 人体秤/体重秤 "> 人体秤/体重秤 </a>

                                        <a href="javascript:;" class="cattree" data-id="478" title=" 毛巾架 "> 毛巾架 </a>

                                        <a href="javascript:;" class="cattree" data-id="479" title=" 痰盂 "> 痰盂 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="480" title=" 家用五金/插座/零件 "> 家用五金/插座/零件 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="481" title=" 干电池/充电电池/充电套装 "> 干电池/充电电池/充电套装 </a>

                                        <a href="javascript:;" class="cattree" data-id="482" title=" 插座/转换插头 "> 插座/转换插头 </a>

                                        <a href="javascript:;" class="cattree" data-id="483" title=" 小夜灯/节能灯 "> 小夜灯/节能灯 </a>

                                        <a href="javascript:;" class="cattree" data-id="484" title=" 手电筒/灯 "> 手电筒/灯 </a>

                                        <a href="javascript:;" class="cattree" data-id="485" title=" 移动电源 "> 移动电源 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="486" title=" 小件杂货 "> 小件杂货 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="487" title=" 宠物食品 "> 宠物食品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="488" title=" 犬主粮/零食 "> 犬主粮/零食 </a>

                                        <a href="javascript:;" class="cattree" data-id="489" title=" 猫主粮/零食 "> 猫主粮/零食 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="490" title=" 锅具/刀具/水具/餐具"> 锅具/刀具/水具/...</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="491" title=" 保温杯/水杯/水壶/ "> 保温杯/水杯/水壶/ <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="492" title=" 保温杯 "> 保温杯 </a>

                                        <a href="javascript:;" class="cattree" data-id="493" title=" 玻璃杯 "> 玻璃杯 </a>

                                        <a href="javascript:;" class="cattree" data-id="494" title=" 运动水杯 "> 运动水杯 </a>

                                        <a href="javascript:;" class="cattree" data-id="495" title=" 烈酒杯/开瓶器 "> 烈酒杯/开瓶器 </a>

                                        <a href="javascript:;" class="cattree" data-id="496" title=" 创意水杯 "> 创意水杯 </a>

                                        <a href="javascript:;" class="cattree" data-id="497" title=" 吸管/杯盖/杯垫 "> 吸管/杯盖/杯垫 </a>

                                        <a href="javascript:;" class="cattree" data-id="498" title=" 保温壶/热水瓶 "> 保温壶/热水瓶 </a>

                                        <a href="javascript:;" class="cattree" data-id="499" title=" 凉水壶 "> 凉水壶 </a>

                                        <a href="javascript:;" class="cattree" data-id="500" title=" 茶壶 "> 茶壶 </a>

                                        <a href="javascript:;" class="cattree" data-id="501" title=" 茶具/茶杯 "> 茶具/茶杯 </a>

                                        <a href="javascript:;" class="cattree" data-id="502" title=" 水具套装 "> 水具套装 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="503" title=" 锅具/烧水壶 "> 锅具/烧水壶 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="504" title=" 炒锅 "> 炒锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="505" title=" 煎锅/平底锅 "> 煎锅/平底锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="506" title=" 炖锅/煲类 "> 炖锅/煲类 </a>

                                        <a href="javascript:;" class="cattree" data-id="507" title=" 蒸锅 "> 蒸锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="508" title=" 汤锅 "> 汤锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="509" title=" 其他锅具及用品 "> 其他锅具及用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="510" title=" 奶锅 "> 奶锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="511" title=" 压力锅/高压锅 "> 压力锅/高压锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="512" title=" 锅具套装 "> 锅具套装 </a>

                                        <a href="javascript:;" class="cattree" data-id="513" title=" 烧水壶 "> 烧水壶 </a>

                                        <a href="javascript:;" class="cattree" data-id="514" title=" 砂锅 "> 砂锅 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="515" title=" 刀具/剪刀/菜板/刨丝器 "> 刀具/剪刀/菜板/刨丝器 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="516" title=" 菜板/砧板 "> 菜板/砧板 </a>

                                        <a href="javascript:;" class="cattree" data-id="517" title=" 水果刀/刨丝器 "> 水果刀/刨丝器 </a>

                                        <a href="javascript:;" class="cattree" data-id="518" title=" 菜刀/切片刀/西瓜刀 "> 菜刀/切片刀/西瓜刀 </a>

                                        <a href="javascript:;" class="cattree" data-id="519" title=" 厨房剪刀/鸡骨剪 "> 厨房剪刀/鸡骨剪 </a>

                                        <a href="javascript:;" class="cattree" data-id="520" title=" 厨房套装刀具 "> 厨房套装刀具 </a>

                                        <a href="javascript:;" class="cattree" data-id="521" title=" 多功能刀 "> 多功能刀 </a>

                                        <a href="javascript:;" class="cattree" data-id="522" title=" 斩骨刀 "> 斩骨刀 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="523" title=" 筷子/调羹/碗碟/餐垫 "> 筷子/调羹/碗碟/餐垫 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="524" title=" 饭碗/汤碗/醋碟/餐盘 "> 饭碗/汤碗/醋碟/餐盘 </a>

                                        <a href="javascript:;" class="cattree" data-id="525" title=" 瓷器/其他餐具套装 "> 瓷器/其他餐具套装 </a>

                                        <a href="javascript:;" class="cattree" data-id="526" title=" 调羹/餐勺/勺子 "> 调羹/餐勺/勺子 </a>

                                        <a href="javascript:;" class="cattree" data-id="527" title=" 筷子 "> 筷子 </a>

                                        <a href="javascript:;" class="cattree" data-id="528" title=" 果盘/果碟/果篮 "> 果盘/果碟/果篮 </a>

                                        <a href="javascript:;" class="cattree" data-id="529" title=" 筷笼/餐具笼 "> 筷笼/餐具笼 </a>

                                        <a href="javascript:;" class="cattree" data-id="530" title=" 餐垫/杯垫 "> 餐垫/杯垫 </a>

                                        <a href="javascript:;" class="cattree" data-id="531" title=" 果叉/果签 "> 果叉/果签 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="532" title=" 保鲜盒/便当盒/饭盒 "> 保鲜盒/便当盒/饭盒 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="533" title=" 厨房储物/杂件/工具 "> 厨房储物/杂件/工具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="534" title=" 厨房小工具/杂件 "> 厨房小工具/杂件 </a>

                                        <a href="javascript:;" class="cattree" data-id="535" title=" 粮油储物容器 "> 粮油储物容器 </a>

                                        <a href="javascript:;" class="cattree" data-id="536" title=" 烧烤/烘焙用具 "> 烧烤/烘焙用具 </a>

                                        <a href="javascript:;" class="cattree" data-id="537" title=" 打蛋器/蛋清分离 "> 打蛋器/蛋清分离 </a>

                                        <a href="javascript:;" class="cattree" data-id="538" title=" 微波炉配套用品 "> 微波炉配套用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="539" title=" 厨房秤/计时 "> 厨房秤/计时 </a>

                                        <a href="javascript:;" class="cattree" data-id="540" title=" 保鲜盖/菜罩 "> 保鲜盖/菜罩 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="541" title=" 烹饪铲勺 "> 烹饪铲勺 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="542" title=" 锅铲 "> 锅铲 </a>

                                        <a href="javascript:;" class="cattree" data-id="543" title=" 汤勺 "> 汤勺 </a>

                                        <a href="javascript:;" class="cattree" data-id="544" title=" 漏勺 "> 漏勺 </a>

                                        <a href="javascript:;" class="cattree" data-id="545" title=" 木铲 "> 木铲 </a>

                                        <a href="javascript:;" class="cattree" data-id="546" title=" 饭勺 "> 饭勺 </a>

                                        <a href="javascript:;" class="cattree" data-id="547" title=" 全套铲勺 "> 全套铲勺 </a>

                                        <a href="javascript:;" class="cattree" data-id="548" title=" 煎铲 "> 煎铲 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="549" title=" 酒具/咖啡具/茶具 "> 酒具/咖啡具/茶具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="550" title=" 茶具 "> 茶具 </a>

                                        <a href="javascript:;" class="cattree" data-id="551" title=" 酒杯 "> 酒杯 </a>

                                        <a href="javascript:;" class="cattree" data-id="552" title=" 酒塞 "> 酒塞 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="553" title=" 烘焙/烧烤用具 "> 烘焙/烧烤用具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="554" title=" 烘焙用具 "> 烘焙用具 </a>

                                        <a href="javascript:;" class="cattree" data-id="555" title=" 烧烤用具 "> 烧烤用具 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="556" title=" 纸制品/卫生巾/成人尿裤"> 纸制品/卫生巾/成...</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="557" title=" 卫生巾/护垫 "> 卫生巾/护垫 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="558" title=" 卫生巾 "> 卫生巾 </a>

                                        <a href="javascript:;" class="cattree" data-id="559" title=" 护垫 "> 护垫 </a>

                                        <a href="javascript:;" class="cattree" data-id="560" title=" 卫生棉条 "> 卫生棉条 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="561" title=" 抽纸 "> 抽纸 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="562" title=" 塑包抽纸 "> 塑包抽纸 </a>

                                        <a href="javascript:;" class="cattree" data-id="563" title=" 盒装抽纸 "> 盒装抽纸 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="564" title=" 卫生纸 "> 卫生纸 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="565" title=" 卷筒卫生纸 "> 卷筒卫生纸 </a>

                                        <a href="javascript:;" class="cattree" data-id="566" title=" 平板卫生纸 "> 平板卫生纸 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="567" title=" 手帕纸 "> 手帕纸 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="568" title=" 湿巾 "> 湿巾 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="569" title=" 成人尿裤 "> 成人尿裤 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="570" title=" 厨房用纸 "> 厨房用纸 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="571" title=" 床品/毛巾/拖鞋/内衣裤/袜品"> 床品/毛巾/拖鞋/...</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="572" title=" 床上用品 "> 床上用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="573" title=" 家居拖鞋 "> 家居拖鞋 </a>

                                        <a href="javascript:;" class="cattree" data-id="574" title=" 冬被/羽绒被 "> 冬被/羽绒被 </a>

                                        <a href="javascript:;" class="cattree" data-id="575" title=" 枕头/枕芯/保健枕/颈椎枕 "> 枕头/枕芯/保健枕/颈椎枕 </a>

                                        <a href="javascript:;" class="cattree" data-id="576" title=" 床品套件/四件套/多件套 "> 床品套件/四件套/多件套 </a>

                                        <a href="javascript:;" class="cattree" data-id="577" title=" 床垫/靠垫/坐垫/抱枕 "> 床垫/靠垫/坐垫/抱枕 </a>

                                        <a href="javascript:;" class="cattree" data-id="578" title=" 凉席/竹席/藤席/草席/牛皮席 "> 凉席/竹席/藤席/草席/牛皮席 </a>

                                        <a href="javascript:;" class="cattree" data-id="579" title=" 枕套/枕巾 "> 枕套/枕巾 </a>

                                        <a href="javascript:;" class="cattree" data-id="580" title=" 床单/床裙/床笠/床罩 "> 床单/床裙/床笠/床罩 </a>

                                        <a href="javascript:;" class="cattree" data-id="581" title=" 被套 "> 被套 </a>

                                        <a href="javascript:;" class="cattree" data-id="582" title=" 婴儿床品 "> 婴儿床品 </a>

                                        <a href="javascript:;" class="cattree" data-id="583" title=" 蚊帐/床幔 "> 蚊帐/床幔 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="584" title=" 方巾/面巾/浴巾 "> 方巾/面巾/浴巾 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="585" title=" 成人面巾 "> 成人面巾 </a>

                                        <a href="javascript:;" class="cattree" data-id="586" title=" 浴巾/浴袍 "> 浴巾/浴袍 </a>

                                        <a href="javascript:;" class="cattree" data-id="587" title=" 童巾 "> 童巾 </a>

                                        <a href="javascript:;" class="cattree" data-id="588" title=" 方巾 "> 方巾 </a>

                                        <a href="javascript:;" class="cattree" data-id="589" title=" 方毛浴套装/礼盒 "> 方毛浴套装/礼盒 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="590" title=" 短袜/打底袜/丝袜/美腿袜 "> 短袜/打底袜/丝袜/美腿袜 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="591" title=" 内裤 "> 内裤 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="592" title=" 保暖内衣 "> 保暖内衣 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="593" title=" 背心/塑身内衣 "> 背心/塑身内衣 </a>

                                        <a href="javascript:;" class="cattree" data-id="594" title=" 成人保暖内衣 "> 成人保暖内衣 </a>

                                        <a href="javascript:;" class="cattree" data-id="595" title=" 儿童保暖内衣 "> 儿童保暖内衣 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="596" title=" 皮带/服饰配件 "> 皮带/服饰配件 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="597" title=" 家居服/情趣内衣 "> 家居服/情趣内衣 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="598" title=" 家用电器"> 家用电器</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="599" title=" 厨房小家电 "> 厨房小家电 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="600" title=" 电饼铛 "> 电饼铛 </a>

                                        <a href="javascript:;" class="cattree" data-id="601" title=" 电炖锅 "> 电炖锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="602" title=" 电茶壶 "> 电茶壶 </a>

                                        <a href="javascript:;" class="cattree" data-id="603" title=" 电饭煲 "> 电饭煲 </a>

                                        <a href="javascript:;" class="cattree" data-id="604" title=" 电压力锅 "> 电压力锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="605" title=" 料理机 "> 料理机 </a>

                                        <a href="javascript:;" class="cattree" data-id="606" title=" 豆浆机 "> 豆浆机 </a>

                                        <a href="javascript:;" class="cattree" data-id="607" title=" 煮蛋器 "> 煮蛋器 </a>

                                        <a href="javascript:;" class="cattree" data-id="608" title=" 电磁炉 "> 电磁炉 </a>

                                        <a href="javascript:;" class="cattree" data-id="609" title=" 养生壶/煎药壶 "> 养生壶/煎药壶 </a>

                                        <a href="javascript:;" class="cattree" data-id="610" title=" 酸奶机 "> 酸奶机 </a>

                                        <a href="javascript:;" class="cattree" data-id="611" title=" 烤箱 "> 烤箱 </a>

                                        <a href="javascript:;" class="cattree" data-id="612" title=" 榨汁机 "> 榨汁机 </a>

                                        <a href="javascript:;" class="cattree" data-id="613" title=" 电动打蛋器 "> 电动打蛋器 </a>

                                        <a href="javascript:;" class="cattree" data-id="614" title=" 咖啡机 "> 咖啡机 </a>

                                        <a href="javascript:;" class="cattree" data-id="615" title=" 绞肉/碎肉机 "> 绞肉/碎肉机 </a>

                                        <a href="javascript:;" class="cattree" data-id="616" title=" 电热饭盒 "> 电热饭盒 </a>

                                        <a href="javascript:;" class="cattree" data-id="617" title=" 电蒸锅 "> 电蒸锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="618" title=" 微波炉 "> 微波炉 </a>

                                        <a href="javascript:;" class="cattree" data-id="619" title=" 原汁机 "> 原汁机 </a>

                                        <a href="javascript:;" class="cattree" data-id="620" title=" 电炸锅 "> 电炸锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="621" title=" 面条机 "> 面条机 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="622" title=" 个人护理小家电 "> 个人护理小家电 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="623" title=" 剃须刀（含手动） "> 剃须刀（含手动） </a>

                                        <a href="javascript:;" class="cattree" data-id="624" title=" 电动吹风/美发器具 "> 电动吹风/美发器具 </a>

                                        <a href="javascript:;" class="cattree" data-id="625" title=" 电动牙刷 "> 电动牙刷 </a>

                                        <a href="javascript:;" class="cattree" data-id="626" title=" 电动剃（脱）毛器 "> 电动剃（脱）毛器 </a>

                                        <a href="javascript:;" class="cattree" data-id="627" title=" 其他 "> 其他 </a>

                                        <a href="javascript:;" class="cattree" data-id="628" title=" 鼻毛修剪器 "> 鼻毛修剪器 </a>

                                        <a href="javascript:;" class="cattree" data-id="629" title=" 美容修剪器 "> 美容修剪器 </a>

                                        <a href="javascript:;" class="cattree" data-id="630" title=" 护理美甲器 "> 护理美甲器 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="631" title=" 生活小家电 "> 生活小家电 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="632" title=" 电热毯 "> 电热毯 </a>

                                        <a href="javascript:;" class="cattree" data-id="633" title=" 挂烫机/电熨斗 "> 挂烫机/电熨斗 </a>

                                        <a href="javascript:;" class="cattree" data-id="634" title=" 吸尘器/除螨仪 "> 吸尘器/除螨仪 </a>

                                        <a href="javascript:;" class="cattree" data-id="635" title=" 台灯 "> 台灯 </a>

                                        <a href="javascript:;" class="cattree" data-id="636" title=" 加湿器 "> 加湿器 </a>

                                        <a href="javascript:;" class="cattree" data-id="637" title=" 电蚊拍 "> 电蚊拍 </a>

                                        <a href="javascript:;" class="cattree" data-id="638" title=" 毛球修剪器 "> 毛球修剪器 </a>

                                        <a href="javascript:;" class="cattree" data-id="639" title=" 空气净化器/烘鞋器/其他 "> 空气净化器/烘鞋器/其他 </a>

                                        <a href="javascript:;" class="cattree" data-id="640" title=" 暖风机/取暖器 "> 暖风机/取暖器 </a>

                                        <a href="javascript:;" class="cattree" data-id="641" title=" 扫地机器人 "> 扫地机器人 </a>

                                        <a href="javascript:;" class="cattree" data-id="642" title=" 足浴器/足底按摩 "> 足浴器/足底按摩 </a>

                                        <a href="javascript:;" class="cattree" data-id="643" title=" 电风扇 "> 电风扇 </a>

                                        <a href="javascript:;" class="cattree" data-id="644" title=" 擦窗机器人 "> 擦窗机器人 </a>

                                        <a href="javascript:;" class="cattree" data-id="645" title=" 按摩披肩 "> 按摩披肩 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="646" title=" 冰箱/洗衣机/空调 "> 冰箱/洗衣机/空调 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="647" title=" 冰箱 "> 冰箱 </a>

                                        <a href="javascript:;" class="cattree" data-id="648" title=" 洗衣机 "> 洗衣机 </a>

                                        <a href="javascript:;" class="cattree" data-id="649" title=" 空调 "> 空调 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="650" title=" 平板电视 "> 平板电视 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="651" title=" 厨卫大电 "> 厨卫大电 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="652" title=" 其它厨卫电器 "> 其它厨卫电器 </a>

                                        <a href="javascript:;" class="cattree" data-id="653" title=" 热水器 "> 热水器 </a>

                                        <a href="javascript:;" class="cattree" data-id="654" title=" 油烟机 "> 油烟机 </a>

                                        <a href="javascript:;" class="cattree" data-id="655" title=" 燃气灶 "> 燃气灶 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="656" title=" 宝宝食品/用具/玩具/孕妈"> 宝宝食品/用具/玩...</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="657" title=" 婴幼儿奶粉 "> 婴幼儿奶粉 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="658" title=" 清火/开胃/奶伴 "> 清火/开胃/奶伴 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="659" title=" 宝宝辅食 "> 宝宝辅食 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="660" title=" 米粉/面条/汤粥 "> 米粉/面条/汤粥 </a>

                                        <a href="javascript:;" class="cattree" data-id="661" title=" 宝宝零食 "> 宝宝零食 </a>

                                        <a href="javascript:;" class="cattree" data-id="662" title=" 果泥/肉泥/菜泥/混合泥 "> 果泥/肉泥/菜泥/混合泥 </a>

                                        <a href="javascript:;" class="cattree" data-id="663" title=" 磨牙棒/磨牙饼干 "> 磨牙棒/磨牙饼干 </a>

                                        <a href="javascript:;" class="cattree" data-id="664" title=" 肉松/鱼松 "> 肉松/鱼松 </a>

                                        <a href="javascript:;" class="cattree" data-id="665" title=" 婴幼儿调味品 "> 婴幼儿调味品 </a>

                                        <a href="javascript:;" class="cattree" data-id="666" title=" 宝宝饮品 "> 宝宝饮品 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="667" title=" 宝宝营养品 "> 宝宝营养品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="668" title=" 钙铁锌 "> 钙铁锌 </a>

                                        <a href="javascript:;" class="cattree" data-id="669" title=" DHA/核桃油 "> DHA/核桃油 </a>

                                        <a href="javascript:;" class="cattree" data-id="670" title=" 益生菌 "> 益生菌 </a>

                                        <a href="javascript:;" class="cattree" data-id="671" title=" 葡萄糖 "> 葡萄糖 </a>

                                        <a href="javascript:;" class="cattree" data-id="672" title=" 其他 "> 其他 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="673" title=" 哺育喂养用品 "> 哺育喂养用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="674" title=" 奶瓶 "> 奶瓶 </a>

                                        <a href="javascript:;" class="cattree" data-id="675" title=" 奶嘴/安抚奶嘴/牙胶 "> 奶嘴/安抚奶嘴/牙胶 </a>

                                        <a href="javascript:;" class="cattree" data-id="676" title=" 用具清洁 "> 用具清洁 </a>

                                        <a href="javascript:;" class="cattree" data-id="677" title=" 水杯/水壶 "> 水杯/水壶 </a>

                                        <a href="javascript:;" class="cattree" data-id="678" title=" 餐具/碾磨器/附件 "> 餐具/碾磨器/附件 </a>

                                        <a href="javascript:;" class="cattree" data-id="679" title=" 坐便器/凳 "> 坐便器/凳 </a>

                                        <a href="javascript:;" class="cattree" data-id="680" title=" 其他 "> 其他 </a>

                                        <a href="javascript:;" class="cattree" data-id="681" title=" 安全防护 "> 安全防护 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="682" title=" 洗浴清洁用具 "> 洗浴清洁用具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="683" title=" 宝宝牙刷 "> 宝宝牙刷 </a>

                                        <a href="javascript:;" class="cattree" data-id="684" title=" 洗浴用品 "> 洗浴用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="685" title=" 宝宝棉签/棉棒/棉球 "> 宝宝棉签/棉棒/棉球 </a>

                                        <a href="javascript:;" class="cattree" data-id="686" title=" 宝宝理发器 "> 宝宝理发器 </a>

                                        <a href="javascript:;" class="cattree" data-id="687" title=" 座便器/坐便凳 "> 座便器/坐便凳 </a>

                                        <a href="javascript:;" class="cattree" data-id="688" title=" 其他 "> 其他 </a>

                                        <a href="javascript:;" class="cattree" data-id="689" title=" 安全剪刀/指甲钳 "> 安全剪刀/指甲钳 </a>

                                        <a href="javascript:;" class="cattree" data-id="690" title=" 吸鼻器 "> 吸鼻器 </a>

                                        <a href="javascript:;" class="cattree" data-id="691" title=" 水温计/室温计 "> 水温计/室温计 </a>

                                        <a href="javascript:;" class="cattree" data-id="692" title=" 粉扑 "> 粉扑 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="693" title=" 母婴小家电 "> 母婴小家电 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="694" title=" 宝宝理发器 "> 宝宝理发器 </a>

                                        <a href="javascript:;" class="cattree" data-id="695" title=" 奶瓶消毒器/消毒锅 "> 奶瓶消毒器/消毒锅 </a>

                                        <a href="javascript:;" class="cattree" data-id="696" title=" 吸奶器 "> 吸奶器 </a>

                                        <a href="javascript:;" class="cattree" data-id="697" title=" 暖奶器/加热器 "> 暖奶器/加热器 </a>

                                        <a href="javascript:;" class="cattree" data-id="698" title=" 调奶器 "> 调奶器 </a>

                                        <a href="javascript:;" class="cattree" data-id="699" title=" BB煲/电粥锅 "> BB煲/电粥锅 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="700" title=" 宝宝家纺 "> 宝宝家纺 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="701" title=" 宝宝毛巾/围嘴 "> 宝宝毛巾/围嘴 </a>

                                        <a href="javascript:;" class="cattree" data-id="702" title=" 童装/童鞋/亲子装 "> 童装/童鞋/亲子装 </a>

                                        <a href="javascript:;" class="cattree" data-id="703" title=" 婴儿睡袋/抱被 "> 婴儿睡袋/抱被 </a>

                                        <a href="javascript:;" class="cattree" data-id="704" title=" 宝宝床品 "> 宝宝床品 </a>

                                        <a href="javascript:;" class="cattree" data-id="705" title=" 宝宝浴巾 "> 宝宝浴巾 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="706" title=" 孕妈专区 "> 孕妈专区 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="707" title=" 孕产妇奶粉 "> 孕产妇奶粉 </a>

                                        <a href="javascript:;" class="cattree" data-id="708" title=" 孕产妇护肤/洗护/祛纹 "> 孕产妇护肤/洗护/祛纹 </a>

                                        <a href="javascript:;" class="cattree" data-id="709" title=" 妈妈产前产后用品 "> 妈妈产前产后用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="710" title=" 月子营养 "> 月子营养 </a>

                                        <a href="javascript:;" class="cattree" data-id="711" title=" 吸奶器 "> 吸奶器 </a>

                                        <a href="javascript:;" class="cattree" data-id="712" title=" 产妇卫生巾/护垫 "> 产妇卫生巾/护垫 </a>

                                        <a href="javascript:;" class="cattree" data-id="713" title=" 塑腹带/产妇塑身衣 "> 塑腹带/产妇塑身衣 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="714" title=" 玩具/棋牌 "> 玩具/棋牌 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="715" title=" 早教/音乐/智能玩具 "> 早教/音乐/智能玩具 </a>

                                        <a href="javascript:;" class="cattree" data-id="716" title=" 积木拼图系列 "> 积木拼图系列 </a>

                                        <a href="javascript:;" class="cattree" data-id="717" title=" 敲打类 "> 敲打类 </a>

                                        <a href="javascript:;" class="cattree" data-id="718" title=" 幼儿响铃/爬行健身 "> 幼儿响铃/爬行健身 </a>

                                        <a href="javascript:;" class="cattree" data-id="719" title=" 模型玩具 "> 模型玩具 </a>

                                        <a href="javascript:;" class="cattree" data-id="720" title=" 棋牌玩具 "> 棋牌玩具 </a>

                                        <a href="javascript:;" class="cattree" data-id="721" title=" 遥控玩具 "> 遥控玩具 </a>

                                        <a href="javascript:;" class="cattree" data-id="722" title=" 毛绒玩具 "> 毛绒玩具 </a>

                                        <a href="javascript:;" class="cattree" data-id="723" title=" 益智玩具 "> 益智玩具 </a>

                                        <a href="javascript:;" class="cattree" data-id="724" title=" 其他 "> 其他 </a>

                                        <a href="javascript:;" class="cattree" data-id="725" title=" 戏水玩具 "> 戏水玩具 </a>

                                        <a href="javascript:;" class="cattree" data-id="726" title=" 过家家玩具 "> 过家家玩具 </a>

                                        <a href="javascript:;" class="cattree" data-id="727" title=" 彩泥/DIY "> 彩泥/DIY </a>

                                        <a href="javascript:;" class="cattree" data-id="728" title=" 学习/实验/绘画/文具 "> 学习/实验/绘画/文具 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="729" title=" 童车椅出行用品 "> 童车椅出行用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="730" title=" 童车 "> 童车 </a>

                                        <a href="javascript:;" class="cattree" data-id="731" title=" 婴儿推车 "> 婴儿推车 </a>

                                        <a href="javascript:;" class="cattree" data-id="732" title=" 儿童安全座椅 "> 儿童安全座椅 </a>

                                        <a href="javascript:;" class="cattree" data-id="733" title=" 婴儿背带/腰凳 "> 婴儿背带/腰凳 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="734" title=" 尿片/湿巾/洗护"> 尿片/湿巾/洗护</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="735" title=" 纸尿裤/拉拉裤 "> 纸尿裤/拉拉裤 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="736" title=" 纱/布尿裤 "> 纱/布尿裤 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="737" title=" 隔尿布/垫 "> 隔尿布/垫 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="738" title=" 湿巾 "> 湿巾 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="739" title=" 洗护用品 "> 洗护用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="740" title=" 润肤系列 "> 润肤系列 </a>

                                        <a href="javascript:;" class="cattree" data-id="741" title=" 洗发系列 "> 洗发系列 </a>

                                        <a href="javascript:;" class="cattree" data-id="742" title=" 沐浴系列 "> 沐浴系列 </a>

                                        <a href="javascript:;" class="cattree" data-id="743" title=" 爽身防痱 "> 爽身防痱 </a>

                                        <a href="javascript:;" class="cattree" data-id="744" title=" 花露水/金水 "> 花露水/金水 </a>

                                        <a href="javascript:;" class="cattree" data-id="745" title=" 防晒系列 "> 防晒系列 </a>

                                        <a href="javascript:;" class="cattree" data-id="746" title=" 宝宝牙膏 "> 宝宝牙膏 </a>

                                        <a href="javascript:;" class="cattree" data-id="747" title=" 护臀系列 "> 护臀系列 </a>

                                        <a href="javascript:;" class="cattree" data-id="748" title=" 婴儿皂 "> 婴儿皂 </a>

                                        <a href="javascript:;" class="cattree" data-id="749" title=" 洗手液 "> 洗手液 </a>

                                        <a href="javascript:;" class="cattree" data-id="750" title=" 礼盒套装 "> 礼盒套装 </a>

                                        <a href="javascript:;" class="cattree" data-id="751" title=" 浴盆/洗发帽/水温计 "> 浴盆/洗发帽/水温计 </a>

                                        <a href="javascript:;" class="cattree" data-id="752" title=" 其他 "> 其他 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="753" title=" 洗衣液/柔顺剂/奶瓶清洗 "> 洗衣液/柔顺剂/奶瓶清洗 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="754" title=" 洗衣液 "> 洗衣液 </a>

                                        <a href="javascript:;" class="cattree" data-id="755" title=" 柔顺剂 "> 柔顺剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="756" title=" 奶瓶果蔬清洁剂 "> 奶瓶果蔬清洁剂 </a>

                                        <a href="javascript:;" class="cattree" data-id="757" title=" 洗衣粉 "> 洗衣粉 </a>

                                        <a href="javascript:;" class="cattree" data-id="758" title=" 洗衣皂 "> 洗衣皂 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="759" title=" 驱蚊/退烧 "> 驱蚊/退烧 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="760" title=" 驱蚊手环 "> 驱蚊手环 </a>

                                        <a href="javascript:;" class="cattree" data-id="761" title=" 驱蚊贴 "> 驱蚊贴 </a>

                                        <a href="javascript:;" class="cattree" data-id="762" title=" 蚊香液 "> 蚊香液 </a>

                                        <a href="javascript:;" class="cattree" data-id="763" title=" 蚊香片 "> 蚊香片 </a>

                                        <a href="javascript:;" class="cattree" data-id="764" title=" 防蚊水 "> 防蚊水 </a>

                                        <a href="javascript:;" class="cattree" data-id="765" title=" 其他 "> 其他 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="766" title=" 宝宝日常护理 "> 宝宝日常护理 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="767" title=" 退烧贴 "> 退烧贴 </a>

                                        <a href="javascript:;" class="cattree" data-id="768" title=" 体温/耳温计 "> 体温/耳温计 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="769" title=" 体育用品/文具耗材"> 体育用品/文具耗材</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="770" title=" 笔/书写修正 "> 笔/书写修正 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="771" title=" 中性笔/中油笔 "> 中性笔/中油笔 </a>

                                        <a href="javascript:;" class="cattree" data-id="772" title=" 铅笔/自动铅笔 "> 铅笔/自动铅笔 </a>

                                        <a href="javascript:;" class="cattree" data-id="773" title=" 画笔类 "> 画笔类 </a>

                                        <a href="javascript:;" class="cattree" data-id="774" title=" 修正液/修正带/橡皮 "> 修正液/修正带/橡皮 </a>

                                        <a href="javascript:;" class="cattree" data-id="775" title=" 签字笔 "> 签字笔 </a>

                                        <a href="javascript:;" class="cattree" data-id="776" title=" 卷笔刀/削笔刀 "> 卷笔刀/削笔刀 </a>

                                        <a href="javascript:;" class="cattree" data-id="777" title=" 记号笔 "> 记号笔 </a>

                                        <a href="javascript:;" class="cattree" data-id="778" title=" 圆珠笔 "> 圆珠笔 </a>

                                        <a href="javascript:;" class="cattree" data-id="779" title=" 荧光笔 "> 荧光笔 </a>

                                        <a href="javascript:;" class="cattree" data-id="780" title=" 替芯 "> 替芯 </a>

                                        <a href="javascript:;" class="cattree" data-id="781" title=" 白板笔 "> 白板笔 </a>

                                        <a href="javascript:;" class="cattree" data-id="782" title=" 日常学习用品 "> 日常学习用品 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="783" title=" 收纳陈列 "> 收纳陈列 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="784" title=" 其他收纳用品 "> 其他收纳用品 </a>

                                        <a href="javascript:;" class="cattree" data-id="785" title=" 文件袋 "> 文件袋 </a>

                                        <a href="javascript:;" class="cattree" data-id="786" title=" 文件夹 "> 文件夹 </a>

                                        <a href="javascript:;" class="cattree" data-id="787" title=" 笔筒/笔袋/笔座 "> 笔筒/笔袋/笔座 </a>

                                        <a href="javascript:;" class="cattree" data-id="788" title=" 名片夹/名片册/名片袋 "> 名片夹/名片册/名片袋 </a>

                                        <a href="javascript:;" class="cattree" data-id="789" title=" 文件架 "> 文件架 </a>

                                        <a href="javascript:;" class="cattree" data-id="790" title=" 风琴包/事务包 "> 风琴包/事务包 </a>

                                        <a href="javascript:;" class="cattree" data-id="791" title=" 书立 "> 书立 </a>

                                        <a href="javascript:;" class="cattree" data-id="792" title=" 卡套/证件套 "> 卡套/证件套 </a>

                                        <a href="javascript:;" class="cattree" data-id="793" title=" 便签/便条/便利贴盒 "> 便签/便条/便利贴盒 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="794" title=" 其他 "> 其他 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="795" title=" 纸张本册 "> 纸张本册 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="796" title=" 便签本/便利贴 "> 便签本/便利贴 </a>

                                        <a href="javascript:;" class="cattree" data-id="797" title=" 笔记本/记事本 "> 笔记本/记事本 </a>

                                        <a href="javascript:;" class="cattree" data-id="798" title=" 复写纸 "> 复写纸 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="799" title=" 体育用品/桌游/棋牌 "> 体育用品/桌游/棋牌 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="800" title=" 装订用品 "> 装订用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="801" title=" 票夹/长尾夹 "> 票夹/长尾夹 </a>

                                        <a href="javascript:;" class="cattree" data-id="802" title=" 订书机 "> 订书机 </a>

                                        <a href="javascript:;" class="cattree" data-id="803" title=" 别针/回形针 "> 别针/回形针 </a>

                                        <a href="javascript:;" class="cattree" data-id="804" title=" 订书钉 "> 订书钉 </a>

                                        <a href="javascript:;" class="cattree" data-id="805" title=" 回形针盒 "> 回形针盒 </a>

                                        <a href="javascript:;" class="cattree" data-id="806" title=" 其他 "> 其他 </a>

                                        <a href="javascript:;" class="cattree" data-id="807" title=" 图钉 "> 图钉 </a>

                                        <a href="javascript:;" class="cattree" data-id="808" title=" 大头针 "> 大头针 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="809" title=" 胶粘用具 "> 胶粘用具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="810" title=" 胶带/胶纸/胶条 "> 胶带/胶纸/胶条 </a>

                                        <a href="javascript:;" class="cattree" data-id="811" title=" 固体胶/胶水 "> 固体胶/胶水 </a>

                                        <a href="javascript:;" class="cattree" data-id="812" title=" 胶带座/封箱器 "> 胶带座/封箱器 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="813" title=" 办公设备/办公耗材 "> 办公设备/办公耗材 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="814" title=" 书包/双肩包/电脑包 "> 书包/双肩包/电脑包 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="815" title=" 剪裁用品 "> 剪裁用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="816" title=" 剪刀 "> 剪刀 </a>

                                        <a href="javascript:;" class="cattree" data-id="817" title=" 美工刀 "> 美工刀 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="818" title=" 财会专用 "> 财会专用 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="819" title=" 账本/账册 "> 账本/账册 </a>

                                        <a href="javascript:;" class="cattree" data-id="820" title=" 印泥/印油 "> 印泥/印油 </a>

                                        <a href="javascript:;" class="cattree" data-id="821" title=" 湿手器 "> 湿手器 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="822" title=" 计算器 "> 计算器 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="823" title=" 绘图测量用品 "> 绘图测量用品 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="824" title=" 各类尺/三角板 "> 各类尺/三角板 </a>

                                        <a href="javascript:;" class="cattree" data-id="825" title=" 圆规 "> 圆规 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="826" title=" 一次性用品"> 一次性用品</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="827" title=" 垃圾袋 "> 垃圾袋 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="828" title=" 保鲜袋/密实袋 "> 保鲜袋/密实袋 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="829" title=" 保鲜膜/铝箔/烘焙纸 "> 保鲜膜/铝箔/烘焙纸 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="830" title=" 保鲜膜 "> 保鲜膜 </a>

                                        <a href="javascript:;" class="cattree" data-id="831" title=" 烧烤纸/铝箔/锡纸 "> 烧烤纸/铝箔/锡纸 </a>

                                        <a href="javascript:;" class="cattree" data-id="832" title=" 烘焙纸 "> 烘焙纸 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="833" title=" 一次性杯子 "> 一次性杯子 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="834" title=" 一次性纸杯 "> 一次性纸杯 </a>

                                        <a href="javascript:;" class="cattree" data-id="835" title=" 一次性塑杯 "> 一次性塑杯 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="836" title=" 一次性手套/鞋套 "> 一次性手套/鞋套 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="837" title=" 一次性手套 "> 一次性手套 </a>

                                        <a href="javascript:;" class="cattree" data-id="838" title=" 一次性鞋套 "> 一次性鞋套 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="839" title=" 一次性餐具 "> 一次性餐具 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="840" title=" 一次性餐盘 "> 一次性餐盘 </a>

                                        <a href="javascript:;" class="cattree" data-id="841" title=" 一次性筷子 "> 一次性筷子 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="842" title=" 一次性牙签/果签 "> 一次性牙签/果签 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="843" title=" 牙签 "> 牙签 </a>

                                        <a href="javascript:;" class="cattree" data-id="844" title=" 果签 "> 果签 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="845" title=" 一次性桌布/野餐布 "> 一次性桌布/野餐布 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="846" title=" 生鲜水果"> 生鲜水果</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="847" title=" 新鲜水果 "> 新鲜水果 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="848" title=" 苹果/蛇果/嘎啦果 "> 苹果/蛇果/嘎啦果 </a>

                                        <a href="javascript:;" class="cattree" data-id="849" title=" 奇异果/猕猴桃 "> 奇异果/猕猴桃 </a>

                                        <a href="javascript:;" class="cattree" data-id="850" title=" 凤梨/菠萝 "> 凤梨/菠萝 </a>

                                        <a href="javascript:;" class="cattree" data-id="851" title=" 牛油果 "> 牛油果 </a>

                                        <a href="javascript:;" class="cattree" data-id="852" title=" 芒果 "> 芒果 </a>

                                        <a href="javascript:;" class="cattree" data-id="853" title=" 梨 "> 梨 </a>

                                        <a href="javascript:;" class="cattree" data-id="854" title=" 橙 "> 橙 </a>

                                        <a href="javascript:;" class="cattree" data-id="855" title=" 柑/橘/桔 "> 柑/橘/桔 </a>

                                        <a href="javascript:;" class="cattree" data-id="856" title=" 蓝莓 "> 蓝莓 </a>

                                        <a href="javascript:;" class="cattree" data-id="857" title=" 木瓜 "> 木瓜 </a>

                                        <a href="javascript:;" class="cattree" data-id="858" title=" 柠檬 "> 柠檬 </a>

                                        <a href="javascript:;" class="cattree" data-id="859" title=" 火龙果 "> 火龙果 </a>

                                        <a href="javascript:;" class="cattree" data-id="860" title=" 葡萄/提子 "> 葡萄/提子 </a>

                                        <a href="javascript:;" class="cattree" data-id="861" title=" 龙眼/桂圆 "> 龙眼/桂圆 </a>

                                        <a href="javascript:;" class="cattree" data-id="862" title=" 榴莲 "> 榴莲 </a>

                                        <a href="javascript:;" class="cattree" data-id="863" title=" 柚子 "> 柚子 </a>

                                        <a href="javascript:;" class="cattree" data-id="864" title=" 桃/李/杏 "> 桃/李/杏 </a>

                                        <a href="javascript:;" class="cattree" data-id="865" title=" 哈密瓜 "> 哈密瓜 </a>

                                        <a href="javascript:;" class="cattree" data-id="866" title=" 石榴 "> 石榴 </a>

                                        <a href="javascript:;" class="cattree" data-id="867" title=" 枇杷 "> 枇杷 </a>

                                        <a href="javascript:;" class="cattree" data-id="868" title=" 西瓜 "> 西瓜 </a>

                                        <a href="javascript:;" class="cattree" data-id="869" title=" 椰子/椰青 "> 椰子/椰青 </a>

                                        <a href="javascript:;" class="cattree" data-id="870" title=" 桃 "> 桃 </a>

                                        <a href="javascript:;" class="cattree" data-id="871" title=" 枣 "> 枣 </a>

                                        <a href="javascript:;" class="cattree" data-id="872" title=" 芭乐 "> 芭乐 </a>

                                        <a href="javascript:;" class="cattree" data-id="873" title=" 其他 "> 其他 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="874" title=" 牛羊猪肉 "> 牛羊猪肉 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="875" title=" 冰鲜猪肉 "> 冰鲜猪肉 </a>

                                        <a href="javascript:;" class="cattree" data-id="876" title=" 冷冻猪肉 "> 冷冻猪肉 </a>

                                        <a href="javascript:;" class="cattree" data-id="877" title=" 牛肉 "> 牛肉 </a>

                                        <a href="javascript:;" class="cattree" data-id="878" title=" 牛排 "> 牛排 </a>

                                        <a href="javascript:;" class="cattree" data-id="879" title=" 牛腩 "> 牛腩 </a>

                                        <a href="javascript:;" class="cattree" data-id="880" title=" 牛腱 "> 牛腱 </a>

                                        <a href="javascript:;" class="cattree" data-id="881" title=" 羊肉 "> 羊肉 </a>

                                        <a href="javascript:;" class="cattree" data-id="882" title=" 火腿/香肠 "> 火腿/香肠 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="883" title=" 海鲜水产 "> 海鲜水产 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="884" title=" 鱼类 "> 鱼类 </a>

                                        <a href="javascript:;" class="cattree" data-id="885" title=" 三文鱼 "> 三文鱼 </a>

                                        <a href="javascript:;" class="cattree" data-id="886" title=" 鳕鱼 "> 鳕鱼 </a>

                                        <a href="javascript:;" class="cattree" data-id="887" title=" 鱼类制品 "> 鱼类制品 </a>

                                        <a href="javascript:;" class="cattree" data-id="888" title=" 虾类 "> 虾类 </a>

                                        <a href="javascript:;" class="cattree" data-id="889" title=" 贝类 "> 贝类 </a>

                                        <a href="javascript:;" class="cattree" data-id="890" title=" 蟹类 "> 蟹类 </a>

                                        <a href="javascript:;" class="cattree" data-id="891" title=" 其他海产 "> 其他海产 </a>

                                        <a href="javascript:;" class="cattree" data-id="892" title=" 大闸蟹 "> 大闸蟹 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="893" title=" 家禽蛋类 "> 家禽蛋类 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="894" title=" 鸡肉 "> 鸡肉 </a>

                                        <a href="javascript:;" class="cattree" data-id="895" title=" 鸭肉 "> 鸭肉 </a>

                                        <a href="javascript:;" class="cattree" data-id="896" title=" 鸽子 "> 鸽子 </a>

                                        <a href="javascript:;" class="cattree" data-id="897" title=" 鸡蛋/鸭蛋 "> 鸡蛋/鸭蛋 </a>

                                        <a href="javascript:;" class="cattree" data-id="898" title=" 鸽子蛋/鹌鹑蛋 "> 鸽子蛋/鹌鹑蛋 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="899" title=" 新鲜蔬菜 "> 新鲜蔬菜 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="900" title=" 叶菜类 "> 叶菜类 </a>

                                        <a href="javascript:;" class="cattree" data-id="901" title=" 根茎类 "> 根茎类 </a>

                                        <a href="javascript:;" class="cattree" data-id="902" title=" 茄果类 "> 茄果类 </a>

                                        <a href="javascript:;" class="cattree" data-id="903" title=" 菌菇类 "> 菌菇类 </a>

                                        <a href="javascript:;" class="cattree" data-id="904" title=" 葱蒜类 "> 葱蒜类 </a>

                                        <a href="javascript:;" class="cattree" data-id="905" title=" 其它 "> 其它 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="906" title=" 方便速食 "> 方便速食 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="907" title=" 冷冻粽子 "> 冷冻粽子 </a>

                                        <a href="javascript:;" class="cattree" data-id="908" title=" 手抓饼 "> 手抓饼 </a>

                                        <a href="javascript:;" class="cattree" data-id="909" title=" 馒头/包子/点心 "> 馒头/包子/点心 </a>

                                        <a href="javascript:;" class="cattree" data-id="910" title=" 水饺 "> 水饺 </a>

                                        <a href="javascript:;" class="cattree" data-id="911" title=" 汤圆 "> 汤圆 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="912" title=" 乳品饮料 "> 乳品饮料 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="913" title=" 饮料/咖啡 "> 饮料/咖啡 </a>

                                        <a href="javascript:;" class="cattree" data-id="914" title=" 酸奶 "> 酸奶 </a>

                                        <a href="javascript:;" class="cattree" data-id="915" title=" 鲜果汁 "> 鲜果汁 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="916" title=" 面包烘培 "> 面包烘培 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="917" title=" 蛋糕 "> 蛋糕 </a>

                                        <a href="javascript:;" class="cattree" data-id="918" title=" 面包 "> 面包 </a>

                                    </dd>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="919" title=" 汽车用品"> 汽车用品</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="920" title=" 美容清洗 "> 美容清洗 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="921" title=" 机油 "> 机油 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="922" title=" 汽车美容 "> 汽车美容 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="923" title=" 车用香水 "> 车用香水 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="924" title=" 玻璃水 "> 玻璃水 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="925" title=" 汽车内饰 "> 汽车内饰 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="926" title=" 维修保养 "> 维修保养 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="927" title=" 应急工具 "> 应急工具 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="928" title=" 箱包饰品"> 箱包饰品</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="929" title=" 学生书包 "> 学生书包 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="930" title=" 拉杆箱 "> 拉杆箱 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="931" title=" 钱包 "> 钱包 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="932" title=" 单肩包 "> 单肩包 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="933" title=" 双肩包 "> 双肩包 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="934" title=" 女包 "> 女包 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="935" title=" 福字红包 "> 福字红包 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="936" title=" 手提袋 "> 手提袋 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                        <li><div class="menu-name"><a href="javascript:;" class="cattree" data-id="937" title=" 手机/数码"> 手机/数码</a><i>&gt;</i></div>
                            <div class="sub-level-menu">

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="938" title=" 3C数码及配件 "> 3C数码及配件 <i>&gt;</i></a></dt>
                                    <dd>

                                        <a href="javascript:;" class="cattree" data-id="939" title=" 充电器/数据线/移动电源 "> 充电器/数据线/移动电源 </a>

                                        <a href="javascript:;" class="cattree" data-id="940" title=" 其他3C配件 "> 其他3C配件 </a>

                                        <a href="javascript:;" class="cattree" data-id="941" title=" 鼠标/键盘/键盘套装/耳机/U盘 "> 鼠标/键盘/键盘套装/耳机/U盘 </a>

                                        <a href="javascript:;" class="cattree" data-id="942" title=" 路由器 "> 路由器 </a>

                                    </dd>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="943" title=" 影音娱乐 "> 影音娱乐 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="944" title=" 手机 "> 手机 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="945" title=" 办公设备 "> 办公设备 <i>&gt;</i></a></dt>
                                </dl>

                                <dl>
                                    <dt><a href="javascript:;" class="cattree" data-id="946" title=" 智能设备 "> 智能设备 <i>&gt;</i></a></dt>
                                </dl>

                            </div>
                        </li>

                    </ul>

                    <div class="top-level-menu" style="display:none">
                        <div class="type-import" id="scando"><a href="javascript:;">
                                <div class="type-pic machine"></div>
                                <span>扫码枪导入</span></a>
                        </div>
                        <div class="type-import last" id="filedo"><a href="javascript:;">
                                <div class="type-pic manual"></div>
                                <span>文件导入</span></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <script type="text/javascript">
            /*鼠标点击切换tab*/
            function change_tabs(a,b,c){
                $(a).click(function(){
                    $(this).addClass(c).siblings().removeClass(c);
                    $(b).eq($(this).index()).show().siblings().hide();
                })
            }
            change_tabs(".type-nav ul li",".top-level-menu",'selected');

        </script>
        <div class="goods-list-right">
            <div class="table-responsive">

                {{--引入列表--}}
                @include('goods.yun.partials._goods_list')

            </div>
        </div>

        <!--<div class="col-lg-12 col-sm-12 text-c p-20"><a class="btn btn-primary" href="javascript:;" id="batch_import">开始导入</a></div>-->
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
    <script type="text/javascript">
        $().ready(function() {
            //条形码焦点获取
            $("#searchmodel-barcodes").focus();
            //条形码扫描触发事件
            $("#searchmodel-barcodes").bind("keypress",function(event){
                if(event.keyCode == "13")
                {
                    $("#btn_search").click();
                }
            });

            var tablelist = $("#table_list").tablelist();

            $("#btn_search").click(function() {
                var data = $("#SearchModel").serializeJson();
                tablelist.method = 'POST';
                tablelist.load(data);
            });

            //触发按分类搜索
            $("body").on("click", ".cattree",function(){

                $("#searchmodel-cat_id").val($(this).attr("data-id"));

                $("#searchmodel-cat_id").trigger("chosen:updated");

                tablelist.page.cur_page = 1;

                $("#btn_search").click();
            });


            //触发按分类搜索
            $("body").on("click", "#smq",function(){

                $.msg('功能正在开发中...', {
                    time: 2000
                });
            });

            //扫码导入
            $("body").on("click", "#scando",function(){

                $.post('/goods/yun/ajax-scan', {}, function(result) {
                    if (result.code == 0) {
                        $.open({
                            type: 1,
                            title: '对接扫码枪扫入', //样式类名
                            closeBtn: 1, //不显示关闭按钮
                            shadeClose: false, //开启遮罩关闭
                            area: ['620px', ''], //宽高
                            //scrollbar: false,
                            content: result.data
                        });

                    }else{
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON");

            });

            //文件上传导入
            $("body").on("click", "#filedo",function(){

                $.post('/goods/yun/ajax-file', {}, function(result) {
                    if (result.code == 0) {
                        $.open({
                            type: 1,
                            title: '文件上传', //样式类名
                            closeBtn: 1, //不显示关闭按钮
                            shadeClose: false, //开启遮罩关闭
                            area: ['510px', ''], //宽高
                            //scrollbar: false,
                            content: result.data
                        });

                    }else{
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON");

            });



            $("body").on("click", "#batch_import",function(){

                var goodsids = getSelectCheckbox();
                if(goodsids == false){
                    $.msg("请选择要导入的商品!");
                    return false;
                }else{
                    goodsids = goodsids.join(",");
                }
                $.loading.start();


                $.post('/goods/yun/ajax-setting', {
                    goods_ids: goodsids
                }, function(result) {
                    if (result.code == 0) {
                        $.open({
                            type: 1,
                            title: '设置导入条件', //样式类名
                            closeBtn: 1, //不显示关闭按钮
                            shadeClose: false, //开启遮罩关闭
                            area: ['600px', '51%'], //宽高
                            //scrollbar: false,
                            content: result.data
                        });

                    }else{
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON");



            });

        });

        function getSelectCheckbox()
        {
            var goods_ids = new Array();
            $(".table-list-checkbox").each(function(){
                if($(this).is(':checked')){
                    goods_ids.push($(this).val());
                }
            })
            return goods_ids.length > 0 ? goods_ids : false;
        }
        var global_setting = false;
        //导入入口
        function ajaxImport(setting){
            $.closeAll();
            //$.loading.start();
            global_setting = setting
            var goods_ids = getSelectCheckbox();
            $("#batch_import").attr("disabled",true);
            for(var i in goods_ids){
                $("#import"+goods_ids[i]).hide();
                $("#install"+goods_ids[i]).show();
            }
            loopImport();
            $("#batch_import").removeAttr("disabled");
        }

        //递归导入
        function loopImport(){
            $.loading.start();
            $.post('/goods/yun/import',{
                setting: global_setting
            },function(result){
                if (result.code == 0) {
                    $("#message"+result.data).html('<label class="import-label" >'+result.message+'</label>');
                    $("#import"+result.data).show();
                    $("#install"+result.data).hide();
                }else if(result.code == 1) {
                    $("#install"+result.data).addClass("active").html(result.message);
                    $("#checkbox"+result.data).remove();
                }else if(result.code == 2){
                    $("#install"+result.data).addClass("active").html(result.message);
                    $("#checkbox"+result.data).remove();
                }
                if(result.setting){
                    global_setting = result.setting;
                    //setTimeout("loopImport()",5000);
                    loopImport();
                }else{
                    $.msg("导入完成!");
                }
            },"json").always(function(result){
                if(result.setting){
                    $.loading.start();
                }else{
                    $.loading.stop();
                }
            });
        }

        function onecheck(id){
            $("input[type='checkbox']").removeAttr("checked");
            $("#checkbox"+id).prop("checked",true);
            $("#batch_import").click();
        }

    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop