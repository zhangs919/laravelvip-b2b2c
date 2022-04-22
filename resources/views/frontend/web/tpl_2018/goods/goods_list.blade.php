@extends('layouts.base')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->
    <script src="/js/index.js?v=20180528"></script>
    <script src="/js/tabs.js?v=20180528"></script>
    <script src="/js/bubbleup.js?v=20180528"></script>
    <script src="/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/js/index_tab.js?v=20180528"></script>
    <script src="/js/jump.js?v=20180528"></script>
    <script src="/js/nav.js?v=20180528"></script>
@stop



@section('content')

    <!-- 内容 -->

    <!-- css -->
    <link rel="stylesheet" href="/css/category.css?v=20180428"/>
    <!-- 筛选条件数量 -->
    <!-- 占位符 -->
    <script type="text/javascript">
        var begin_hidden = "2";

        function Show_More_Attrgroup() {

            if("2" == 0){
                $(".attr-group-more").hide();
            }

            if (begin_hidden == 0) {
                $("[name='attr-group-dl']").each(function(i){
                    $(this).show();
                });
                $('#attr-group-more-text').html("收起");
                begin_hidden = "2";
            }else{
                var more_text = "";
                var attr_names = [];
                $("[name='attr-group-dl']").each(function(i){
                    if(i >= begin_hidden){
                        $(this).hide();
                        attr_names.push($(this).data("attr-name"));
                    }else{
                        $(this).show();
                    }
                });

                if(attr_names.length > 4){
                    attr_names = attr_names.slice(0, 4);
                    more_text = "更多选项（"+attr_names.join("、")+" 等）";
                }else{
                    attr_names = attr_names.slice(0, attr_names.length);
                    more_text = "更多选项（"+attr_names.join("、")+"）";
                }

                $('#attr-group-more-text').html(more_text);
                begin_hidden = 0;
            }

            var kuan1 = $("#attr-list-ul").width();
            var kuan2 = $("#attr-group-more").width();
            var kuan = (kuan1 - kuan2) / 2;
            $('#attr-group-more').css("margin-left", kuan + "px");
        }

        $().ready(function(){
            Show_More_Attrgroup();
        })

        // 是否显示“更多”__初始化
        function init_more(boxid, moreid, height) {
            var obj_brand = document.getElementById(boxid);
            var more_brand = document.getElementById(moreid);
            if (obj_brand.clientHeight > height) {
                obj_brand.style.height = height + "px";
                obj_brand.style.overflow = "hidden";
                more_brand.innerHTML = '<a href="javascript:void(0);"  onclick="slideDiv(this, \'' + boxid + '\', \'' + height + '\');" class="more" >更多</a>';
            }
        }
        // 收起
        function slideDiv(thisobj, divID, Height) {
            var obj = document.getElementById(divID).style;
            if (obj.height == "") {
                obj.height = Height + "px";
                obj.overflow = "hidden";
                thisobj.innerHTML = "更多";
                thisobj.className = "more";
                // 如果是品牌，额外处理
                if (divID == 'brand-abox') {
                    // obj.width="456px";
                    getBrand_By_Zimu(document.getElementById('brand-zimu-all'), '');
                    document.getElementById('brand-sobox').style.display = "none";
                    document.getElementById('brand-zimu').style.display = "none";
                    document.getElementById('brand-abox-father').className = "";
                }
            } else {
                obj.height = "";
                obj.overflow = "";
                thisobj.innerHTML = "收起";
                thisobj.className = "more opened";
                // 如果是品牌，额外处理
                if (divID == 'brand-abox') {
                    // obj.width="456px";
                    document.getElementById('brand-sobox').style.display = "block";
                    document.getElementById('brand-zimu').style.display = "block";
                    // getBrand_By_Zimu(document.getElementById('brand-zimu-all'),'');
                    document.getElementById('brand-abox-father').className = "brand-more";
                }
            }
        }
        function getBrand_By_Name(val) {
            val = val.toLocaleLowerCase();
            var brand_list = document.getElementById('brand-abox').getElementsByTagName('li');
            for (var i = 0; i < brand_list.length; i++) {
                // document.getElementById('brand-abox').style.width="auto";
                var name_attr_value = brand_list[i].getAttribute("name").toLocaleLowerCase();
                if (brand_list[i].title.indexOf(val) == 0 || name_attr_value.indexOf(val) == 0 || val == '') {
                    brand_list[i].style.display = 'block';
                } else {
                    brand_list[i].style.display = 'none';
                }
            }
        }
        // 点击字母切换品牌
        function getBrand_By_Zimu(obj, zimu) {
            document.getElementById('brand-sobox-input').value = "可搜索拼音、汉字查找品牌";
            obj.focus();
            var brand_zimu = document.getElementById('brand-zimu');
            var zimu_span_list = brand_zimu.getElementsByTagName('span');
            for (var i = 0; i < zimu_span_list.length; i++) {
                zimu_span_list[i].className = '';
            }
            var thisspan = obj.parentNode;
            thisspan.className = 'span';
            var brand_list = document.getElementById('brand-abox').getElementsByTagName('li');
            for (var i = 0; i < brand_list.length; i++) {
                // document.getElementById('brand-abox').style.width="auto";
                if (brand_list[i].getAttribute('rel') == zimu || zimu == '') {
                    brand_list[i].style.display = 'block';
                } else {
                    brand_list[i].style.display = 'none';
                }
            }
        }
        var duoxuan_a_valid = new Array();
        // 点击多选， 显示多选区
        function showDuoXuan(dx_divid, a_valid_id) {
            var dx_dl_div = document.getElementById('attr-list-ul').getElementsByTagName('dl');
            for (var i = 0; i < dx_dl_div.length; i++) {
                dx_dl_div[i].className = '';
                //dx_dl_div[0].className = 'selected-attr-dl';
            }
            var dxDiv = document.getElementById(dx_divid);
            dxDiv.className = "duoxuan";
            duoxuan_a_valid[a_valid_id] = 1;

            // 显示更多
            if($("#"+dx_divid).find(".more").hasClass("opened") == false){
                $("#"+dx_divid).find(".more").click();
            }
        }
        function hiddenDuoXuan(dx_divid, a_valid_id) {
            var dxDiv = document.getElementById(dx_divid);
            dxDiv.className = "";
            duoxuan_a_valid[a_valid_id] = 0;
            if (a_valid_id == 'brand') {
                var ul_obj_div = document.getElementById('brand-abox');
                var li_list_div = ul_obj_div.getElementsByTagName('li');
                if (li_list_div) {
                    for (var j = 0; j < li_list_div.length; j++) {
                        li_list_div[j].className = "";
                    }
                }
            } else {
                var ul_obj_div = document.getElementById('attr-abox-' + a_valid_id);
            }
            var input_list = ul_obj_div.getElementsByTagName('input');
            var span_list = ul_obj_div.getElementsByTagName('span');
            for (var j = 0; j < input_list.length; j++) {
                input_list[j].checked = false;
            }
            if (span_list.length) {
                for (var j = 0; j < span_list.length; j++) {
                    span_list[j].className = "";
                }
            }
            // 隐藏更多
            if($("#"+dx_divid).find(".more").hasClass("opened") == true){
                $("#"+dx_divid).find(".more").click();
            }
        }
        function duoxuan_Onclick(a_valid_id, idid, thisobj) {
            if (duoxuan_a_valid[a_valid_id]) {
                if (thisobj) {
                    var fatherObj = thisobj.parentNode;
                    if (a_valid_id == "brand") {
                        fatherObj.className = fatherObj.className == "brand-seled" ? "" : "brand-seled";
                    } else {
                        fatherObj.className = fatherObj.className == "" ? "selected" : "";
                    }
                }
                document.getElementById('chk-' + a_valid_id + '-' + idid).checked = !document.getElementById('chk-' + a_valid_id + '-' + idid).checked;
                return false;
            }

            var url = $(thisobj).data("url");

            $.go(url);
        }

        function duoxuan_Submit(dxid, indexid, url) {

            var theForm = document.forms['theForm'];
            var chklist = theForm.elements['checkbox_' + dxid + '[]'];
            var value = "";
            var mm = 0;

            for (var k = 0; k < chklist.length; k++) {
                if (chklist[k].checked) {
                    value += mm > 0 ? "_" : "";
                    value += chklist[k].value;
                    mm++;
                }
            }

            if (mm == 0) {
                return false;
            }

            if (dxid == 'brand') {
                url = url.replace("{0}", value);
            } else {
                url = url.replace("{0}", value);
            }

            $.go(url);
        }

        //自定义价格
        function setPrice(url) {
            var min = $('#price_min').val();
            var max = $('#price_max').val();

            if(min == "" && max == ""){
                return;
            }

            if(!isNaN(min) && min != "" && min >= 0){
                url = url.replace("{0}", min);
            }else{
                url = url.replace("{0}", 0);
            }

            if(!isNaN(max) && max != "" && max >= 0){
                url = url.replace("{1}", max);
            }else{
                url = url.replace("{1}", 0);
            }

            $.go(url);
        }
    </script>
    <!-- 缓载图片 -->
    <div class="blank"></div>
    <div class="w1210">
        <!--热卖推荐-->

        @include('frontend.web.tpl_2018.goods.partials.hot_sale_goods')

        <!--当前位置，面包屑-->
        @include('frontend.web.modules.library.url_here')

        <form action="" method="post" name="theForm">
            <!--筛选条件-->
            <div class="search-wrap" id="attr-list-ul" style="border-top: none;">
                <!--已选条件-->
                @if(!empty($filter_condition))
                <dl class="selected-attr-dl" style="border-bottom: none;">
                    <dt>已选条件：</dt>
                    <dd class="moredd">
                        <a href="{{ $filter['url'] }}">全部撤销</a>
                    </dd>
                    <dd>
                        <ul class="selected-attr">
                            <!-- 已选择的筛选属性、品牌、价格 -->
                            @foreach($filter_condition as $v)
                                <li>
                                    <a href="{{ $v['url'] }}">
                                        {{ $v['name'] }}：
                                        <b class="color">{{ $v['value'] }}</b>
                                        <i>×</i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </dd>
                </dl>
                @endif

                <!-- -->
                <!-- 品牌 -->
                @if(!empty($filter['brand']['items'] && $filter['brand']['selected'] == 0))
                <dl class="" id="attr-group-dl-brand">
                    <dt>品牌：</dt>
                    <dd class="moredd">
                        <label id="brand-more"></label>
                        <label>
                            <a href="javascript:void(0)" class="multiple" onclick="showDuoXuan('attr-group-dl-brand','brand');">
                                <font class="duo-b">+</font>
                                多选
                            </a>
                        </label>
                    </dd>
                    <dd>
                        <div id="brand-sobox">
                            <input id="brand-sobox-input" value="可搜索拼音、汉字查找品牌" type="text" onkeyup="getBrand_By_Name(this.value);" />
                        </div>
                        <div id="brand-zimu" class="clearfix">
						<span class="span">
							<a href="javascript:void(0);" onmouseover="getBrand_By_Zimu(this,'')" id="brand-zimu-all">所有品牌</a>
							<b></b>
						</span>


                            @foreach($filter['brand']['letters'] as $letter)
                            <span>
                                <a href="javascript:void(0);" onmouseover="getBrand_By_Zimu(this,'{{ $letter }}')">{{ $letter }}</a>
                                <b></b>
                            </span>
                            @endforeach


                        </div>
                        <div id="brand-abox-father">
                            <ul id="brand-abox" class="brand-abox-imgul">
                                <!-- 品牌选中状态为brand-seled样式 -->

                                @foreach($filter['brand']['items'] as $k=>$v)
                                <li class="brand" title=" {{ $v['name'] }}" rel="{{ $v['letter'] }}" name="{{ $v['letter'] }}">
                                    <input type="checkbox" style="display: none;" name="checkbox_brand[]" id="chk-brand-{{ $k+1 }}" value="{{ $v['value'] }}">
                                    <a href="javascript:void(0);" data-url="{{ $v['url'] }}"
                                       onclick="return duoxuan_Onclick('brand','{{ $k+1 }}', this);">
                                        @if(!empty($v['image']))
                                            <img class="" src="{{ get_image_url($v['image']) }}" data-original="{{ get_image_url($v['image']) }}" style="display: block;">
                                        @else
                                        {{ $v['name'] }}
                                        @endif
                                        <span class="color"> {{ $v['name'] }}</span>
                                        <i></i>
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="duoxuan-btnbox">
                            <!-- 当没有选中任何品牌时，确定按钮为禁用状态disabled;当选中品牌后，确定按钮添加select-button-sumbit样式 -->
                            <a id="button-brand"></a>
                            <a class="select-button disabled" onclick="duoxuan_Submit('brand',0,'{{ $filter['brand']['url'] }}');">确定</a>
                            <a href="javascript:void(0);" onclick="hiddenDuoXuan('attr-group-dl-brand', 'brand');" class="select-button">取消</a>
                        </div>
                    </dd>
                </dl>
                <script type="text/javascript">
                    duoxuan_a_valid['brand'] = 0;
                    init_more('brand-abox', 'brand-more', '83');
                </script>
                @endif

                <!-- 价格 -->
                @if(!empty($filter['price']['items']) && $filter['price']['start'] == 0 && $filter['price']['end'] == 0)
                <dl>
                    <dt>价格：</dt>
                    <dd class="moredd">&nbsp;</dd>
                    <dd>
                        <ul>

                            @foreach($filter['price']['items'] as $v)
                            <li>
                                <a href="javascript:void(0);" data-go="{{ $v['url'] }}">{!! $v['name'] !!}</a>
                            </li>
                            @endforeach

                            <li>
                                <input name="price_min" id="price_min" value="" class="input-txt" autocomplete="off" type="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                                <i></i>
                                <input name="price_max" id="price_max" value="" class="input-txt" autocomplete="off" type="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
                                <a class="select-button" href="javascript:void(0);" onclick="setPrice('{{ $filter['price']['url'] }}');">确定</a>
                            </li>
                        </ul>
                    </dd>
                </dl>
                @endif

                <!-- 当展开时，为dl添加duoxuan样式 -->
                <!-- 颜色 -->
                @if(!empty($filter['filter_attr']['items']))
                    @foreach($filter['filter_attr']['items'] as $k=>$v)
                    <dl id="attr-group-dl-1" name="attr-group-dl" data-attr-name="{{ $v['name'] }}" class="filter-attr">
                        <dt>{{ $v['name'] }}：</dt>
                        <dd class="moredd">
                            <label id="attr-more-1"></label>

                            <label>
                                <a href="javascript:void(0)" class="multiple" onclick="showDuoXuan('attr-group-dl-{{ $k+1 }}', '{{ $k+1 }}');">
                                    <font class="duo-b">+</font>
                                    多选
                                </a>
                            </label>

                        </dd>
                        <dd>
                            <ul id="attr-abox-1" class="color-value">

                                <!-- -->
                                @foreach($v['items'] as $ak=>$av)
                                <li class="other-vattr-li">
                                    <input class="checkBox" type="checkbox" value="{{ $av['value'] }}" id="chk-{{ $k+1 }}-{{ $ak+1 }}" name="checkbox_{{ $k+1 }}[]">
                                    <a href="javascript:void(0);" data-url="{{ $av['url'] }}" onclick="return duoxuan_Onclick('{{ $k+1 }}','{{ $ak+1 }}', this);" class="duo-vattr">{{ $av['name'] }}</a>
                                </li>
                                @endforeach

                            </ul>
                            <div class="duoxuan-btnbox">
                                <a id="button-1"></a>
                                <a id="select-button-1" class="select-button disabled" onclick="duoxuan_Submit({{ $k+1 }}, '{{ $k }}', '{{ $v['url'] }}');">确定</a>
                                <a href="javascript:void(0);" onclick="hiddenDuoXuan('attr-group-dl-{{ $k+1 }}', '{{ $k+1 }}');" class="select-button">取消</a>
                            </div>
                        </dd>
                    </dl>
                    <script type="text/javascript">
                        init_more('attr-abox-{{ $k+1 }}', 'attr-more-{{ $k+1 }}', '29');
                    </script>
                    @endforeach

                @endif

            </div>

            {{--显示更多选项--}}
            @if(!empty($filter['filter_attr']['items']) && count($filter['filter_attr']['items']) > 2)
            <div id="attr-group-more" class="attr-group-more" style="margin-left: 493px;">
                <a id="attr-group-more-text" href="javascript:void(0);" onclick="Show_More_Attrgroup();">更多选项（{{ implode('、',array_column($filter['filter_attr']['items'], 'name')) }}）</a>
            </div>
            @endif

        </form>
        <script type="text/javascript">
            $(function(){
                $('.other-vattr-li').bind('click',function(){
                    var seled_input_num = $(this).parents('ul').find('input[type="checkbox"]:checked').length;
                    if(seled_input_num>0){
                        $(this).parents('dd').find('.select-button').eq(0).attr('class','select-button select-button-sumbit');
                    }else if(seled_input_num == 0){
                        $(this).parents('dd').find('.select-button').eq(0).attr('class','select-button disabled');
                    }
                })
            })
        </script>
        <div class="blank15"></div>
        <div class="content-wrap category-wrap clearfix">
            <!--左侧内容-->
            <div class="aside" >
                <span class="slide-aside" ></span>
                <div class="aside-inner">
                    <!--新品推荐-->

                    @include('frontend.web.tpl_2018.goods.partials.new_goods')

                    <!--销量排行榜-->

                    @include('frontend.web.tpl_2018.goods.partials.sale_rank_goods')

                </div>
            </div>
            <!--右侧内容-->
            <div class="main "  >
                <div class="" id="filter">
                    <!--排序-->
                    <form method="GET" name="listform" action="">
                        <div class="fore1">
                            <dl class="order">

                                @foreach($filter['sorts'] as $v)
                                <dd class="@if($v['selected'] == 1){{ 'first curr' }}@endif">
                                    <a href="javascript:void(0);" data-go="{{ $v['url'] }}">
                                        {{ $v['name'] }}

                                        @if($v['value'] != 0)
                                            <i class="iconfont icon-{{ $v['order'] }}"></i>
                                        @endif
                                    </a>
                                </dd>
                                @endforeach

                            </dl>
                            <div class="pagin">

                                <!---->
                                <a class="prev disabled">
                                    <span class="icon prev-disabled"></span>
                                </a>
                                <!---->

                                <span class="text">
								<font class="color">1</font>
								/

								1

							</span>
                                <!-- -->
                                <a class="next disabled" href="javascript:;">
                                    <span class="icon next-disabled"></span>
                                </a>

                            </div>
                            <div class="total">
                                共
                                <span class="color">{{ $total }}</span>
                                个商品
                            </div>
                        </div>
                        <div class="fore2">
                            <div class="filter-btn">
                                <span class="distribution">配送至</span>
                                <div class="region-chooser-container" style="z-index: 3"></div>
                                <!-- 选中的筛选条件给 a 标签追加类名 即  class="filter-tag curr" _star-->

                                @foreach($filter['others'] as $v)
                                <a href="javascript:void(0);" data-go="{{ $v['url'] }}" class="filter-tag @if($v['selected'] == 1){{ 'curr' }}@endif">
                                    <input class="none" name="fff" onclick="" type="checkbox">
                                    <i class="iconfont">@if($v['selected'] == 1){!! '&#xe6ae;' !!}@else{!! '&#xe715;' !!}@endif</i>
                                    <span class="text">{{ $v['name'] }}</span>
                                </a>
                                @endforeach

                            </div>
                            <div class="filter-mod">
                                <!--选中样式为a标签添加curr样式-->

                                @foreach($filter['styles'] as $v)
                                <a href="javascript:void(0);" data-go="{{ $v['url'] }}" title="{{ $v['name'] }}" class="filter-type filter-type-{{ $v['value'] }} @if($v['selected'] == 1) curr @endif">
                                    <i class="iconfont icon-{{ $v['value'] }}"></i>
                                </a>
                                @endforeach

                            </div>
                        </div>
                    </form>
                </div>
                <!--主体商品内容展示-->

                <form name="compareForm" action="compare.php" method="post" onsubmit="" id="table_list">



                    @include('goods.partials.goods_list')



                </form>

                <!--对比栏-->
            </div>
        </div>
        <!--历史记录和猜你喜欢-->
        {{--todo 如果为空 则不显示--}}
        <div class="browse-history">
            <div class="browse-history-tab clearfix">
                <!--当前选中color-->
                <span class="tab-span color">猜您喜欢</span>
                <span class="tab-span">浏览历史</span>
                <div class="browse-history-line bg-color"></div>
                <div class="browse-history-other">
                    <a href="javascript:change_like()" class="history-recommend-change">
                        <i class="iconfont"></i>
                        <em class="text">换一批</em>
                    </a>
                    <a href="javascript:;" class="clear_history none">
                        <i class="iconfont"></i>
                        <em id="del-history" class="text">清空</em>
                    </a>
                </div>
            </div>


            <div class="browse-history-con">
                <div class="browse-history-inner">
                    <!--猜您喜欢-->
                    <ul id="user_like" class="recommend-panel">
                        <input type="hidden" id="user_like_page" value="">
                    </ul>
                    <!--浏览历史-->
                    @include('frontend.web.tpl_2018.goods.partials.history_goods')


                </div>
            </div>
        </div>
        <script type="text/javascript">
            $("body").on("click", ".clear_history", function() {
                $.confirm("是否清空历史足迹？", function(s) {
                    if (s) {
                        $.ajax({
                            type: 'GET',
                            url: '/user/history/del-all',
                            dataType: 'json',
                            success: function(data) {
                                if (data.code == 0) {
                                    $("#history_list").html("<div class='tip-box'><img src='/images/noresult.png' class='tip-icon' /><div class='tip-text'>暂无历史足迹</div></div>");
                                }
                            }
                        })
                    }
                })
            })

            function change_like() {
                var page = $("#user_like_page").val();

                $.ajax({
                    type: 'GET',
                    url: '/guess/like',
                    data: {
                        page: page,
                        num: 6,
                        tpl: 'guess_like_list'
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.code == 0) {
                            $('#user_like').html(data.data);
                        }
                    }
                });
            }

            // 初始化加载
            change_like();
        </script>

    </div>

    <script src="/assets/d2eace91/js/jquery.region.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>
    <!-- 选中当前分类弹出同级分类JS -->
    <script type="text/javascript">
        $(function() {
            $('.breadcrumb .crumbs-nav').hover(function() {
                $(this).toggleClass('curr');
            })
        });
    </script>

    <script type="text/javascript">
        $().ready(function() {

            var page_url = "{{ $filter['page']['url'] }}";
            page_url = page_url.replace(/&amp;/g, '&');

            var tablelist = $("#table_list").tablelist({
                page_mode: 1,
                go: function(page){
                    page_url = page_url.replace("{0}", page);
                    $.go(page_url);
                }
            });

            $(".prev-page").click(function(){
                tablelist.prePage();
            });

            $(".next-page").click(function(){
                tablelist.nextPage();
            });

            $(".add-cart").click(function(event) {
                var goods_id = $(this).data("goods-id");
                var image_url = $(this).data("image-url");
                var buy_enable = $(this).data("buy-enable");
                if(buy_enable){
                    $.msg(buy_enable);
                    return false;
                }
                $.cart.add(goods_id, 1, {
                    is_sku: false,
                    event: event,
                    image_url: image_url,
                    callback: function(){
                        var attr_list = $('.attr-list').height();
                        $('.attr-list').css({
                            "overflow":"hidden"
                        });
                        if(attr_list>=200){
                            $('.attr-list').addClass("attr-list-border");
                            $('.attr-list').css({
                                "overflow-y":"auto"
                            });
                        }
                    }
                });
                return false;
            });
            $(".compare-btn").click(function(event) {
                var goods_id = $(this).data("compare-goods-id");
                var image_url = $(this).data("image-url");
                var that = $(this);
                if ($(this).hasClass("curr")) {
                    $.compare.remove(goods_id, function(result) {
                        if (result.code == 0) {
                            that.removeClass('curr');
                            that.find('i').html('&#xe715;');
                        }
                    });
                } else {
                    $.compare.add(goods_id, image_url, event, function(result) {
                        if (result.code == 0) {
                            that.addClass('curr');
                            that.find('i').html('&#xe6ae;');
                        }
                    });
                }
            });

            // 移除对对比商品
            $.compare.removeCallback = function(goods_id, result) {
                $("[data-compare-goods-id='" + goods_id + "']").removeClass('curr');
            }
            // 清空对比商品
            $.compare.clearCallback = function(goods_id, result) {
                $("[data-compare-goods-id]").removeClass('curr');
            }

            //规格相册
            sildeImg(0);

            <!-- 获取当前地址 -->
            //地区组件
            var region_chooser = $(".region-chooser-container").regionchooser({
                value: "{{ $filter['region']['value'] }}",
                change: function(value, names, is_last) {
                    if (value == '') {
                        var values = this.values();
                        if (values.length > 0) {
                            value = values[values.length - 1].region_code;
                        }
                    }

                    var region_code = "{{ $filter['region']['value'] }}";
                    if (is_last && value != region_code ) {
                        value = value + "";
                        value = value.replace(/,/g, "_");
                        var url = "{{ $filter['region']['url'] }}";
                        url = url.replace(/&amp;/g, '&');
                        url = url.replace("{0}", value);
                        $.go(url);
                    }
                }
            });
            var goods_ids = '{{ $goods_ids }}';
            $.collect.getGoodsList(goods_ids, null, function(result){
                var goods_list = result.data;
                $(".goods-collect").each(function(){
                    var goods_id = $(this).data("goods-id");
                    if(result.code == 0){
                        if(goods_list[goods_id]){
                            $(this).addClass("curr");
                            $(this).find("span").html("已收藏");
                            $(this).find("i").html('&#xe6b3;');
                        }else{
                            $(this).removeClass("curr");
                            $(this).find("span").html("收藏");
                            $(this).find("i").html('&#xe6b3;');
                        }
                    }
                });
            });
            $.compare.getGoodsList(goods_ids, function(result){
                var goods_list = result.data;
                $(".goods-comapre").each(function(){
                    var goods_id = $(this).data("compare-goods-id");
                    if(result.code == 0){
                        if(goods_list[goods_id]){
                            $(this).addClass("curr");
                            $(this).find("i").html('&#xe6ae;');
                        }else{
                            $(this).removeClass("curr");
                            $(this).find("i").html('&#xe715;');
                        }
                    }
                });
            });

            // 跳转页面
            $("[data-go]").click(function(){
                $.go($(this).data("go"));
            });
        });
    </script>
    <!-- 暂时去掉 滚动条定位功能
<script type="text/javascript">
window.onbeforeunload = function() {
    var scrollPos;
    if (typeof window.pageYOffset != 'undefined') {
        scrollPos = window.pageYOffset;
    } else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
        scrollPos = document.documentElement.scrollTop;
    } else if (typeof document.body != 'undefined') {
        scrollPos = document.body.scrollTop;
    }
    document.cookie = "SZY_GOODS_LIST_SCROLLTOP=" + scrollPos; //存储滚动条位置到cookies中
}
if (document.cookie.match(/SZY_GOODS_LIST_SCROLLTOP=([^;]+)(;|$)/) != null) {
    //cookies中不为空，则读取滚动条位置
    var arr = document.cookie.match(/SZY_GOODS_LIST_SCROLLTOP=([^;]+)(;|$)/);
    document.documentElement.scrollTop = parseInt(arr[1]);
    document.body.scrollTop = parseInt(arr[1]);
}
</script> -->
    <script src="/js/category.js?v=20180528"></script>
    <!--[if lte IE 9]>
    <script src="/js/requestAnimationFrame.js?v=20180528"></script>
    <![endif]-->
    <!-- 飞入购物车js _end -->

@stop