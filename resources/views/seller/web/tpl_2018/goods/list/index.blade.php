{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    <link href="/assets/d2eace91/js/ztree/zTreeStyle.css" rel="stylesheet">
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css?v=2" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="SearchModel" name="SearchModel" action="/goods/list/index" method="POST">
            @csrf
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <div id="cat_selector"></div>
                        <input type="hidden" id="searchmodel-cat_id" class="form-control" name="cat_id">
                    </div>
                </div>
            </div>
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
                        <span>商品搜索：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="searchmodel-keyword_type" class="form-control w120 m-r-2" name="keyword_type">
                            <option value="0">商品名称</option>
                            <option value="1">商品ID</option>
                            <option value="2">商品货号</option>
                        </select>
                        <input type="text" id="searchmodel-keyword" class="form-control" name="keyword" placeholder="请输入关键字">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品标签：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="hidden" name="tag_id" value="">
                        <select id="searchmodel-tag_id" class="form-control chosen-select" name="tag_id[]" multiple="multiple" size="4">
                            @foreach($tag_list as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>计价方式：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-pricing_mode" class="form-control chosen-select" name="pricing_mode" data-width="200">
                            @foreach($pricing_mode['items'] as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品状态：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-status" class="form-control" name="status" data-width="120">
                            @foreach($status['items'] as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
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

                        <select id="searchmodel-brand_id" class="form-control chosen-select" name="brand_id" data-width="200">
                            @foreach($brand_list as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide" style="display: none;">
                <div class="form-group">
                    <label class="control-label">
                        <span>隶属网点：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-store_id" class="form-control chosen-select" name="store_id" data-width="120">
                            @foreach($store_list as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺商品分类：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-scid" class="form-control chosen-select" name="scid" data-width="120">
                            <option value="">-- 请选择分类 --</option>
                            @foreach($shop_cat_list as $v)
                                @if($v['cat_level'] == 1)
                                    <option value="{{ $v['cat_id'] }}"><span>◢</span>&nbsp;{{ $v['cat_name'] }}</option>
                                @elseif($v['cat_level'] == 2)
                                    <option value="{{ $v['cat_id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $v['cat_name'] }}</option>
                                @endif
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <!--新加 start-->
            <div class="simple-form-field toggle hide" style="display:none">
                <div class="form-group">
                    <label class="control-label">
                        <span>预售商品：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select class="form-control">
                            <option value="0">请选择</option>
                            <option value="1">是</option>
                            <option value="2">否</option>
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
                            @foreach($sales_model['items'] as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品类别：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="searchmodel-goods_mode" class="form-control" name="goods_mode" data-width="120">
                            <option value="">全部</option>
                            <option value="0">实物商品</option>
                            <option value="1">电子卡券</option>
                            <option value="2">服务商品</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>库存：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" id="searchmodel-start_stock" class="form-control small" name="start_stock">
                        -
                        <input type="text" id="searchmodel-start_stock" class="form-control small" name="end_stock">

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>是否关联店铺商品分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="searchmodel-shop_goods_cat_id" name="shop_goods_cat_id">
                            <option value="">全部</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>
            </div>
            <!--新加 end-->
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>是否自定义会员价：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="searchmodel-member_price" name="member_price">
                            <option value="">全部</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>是否参与会员打折：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="searchmodel-user_discount" name="user_discount">
                            <option value="">全部</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>是否有库存：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="searchmodel-goods_number" name="goods_number">
                            <option value="">全部</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>运费模板：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="searchmodel-freight_id" class="form-control" name="freight_id" data-width="120">
                            @foreach($freight_list as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>是否有商品图：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="searchmodel-is_img" name="is_img">
                            <option value="">全部</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>是否有赠品：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="searchmodel-has_gift" name="has_gift">
                            <option value="">全部</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>参与活动：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" id="searchmodel-activity" name="activity">
                            <option value="0">不限</option>
                            <option value="3">团购</option>
                            <option value="11">限时折扣</option>
                            <option value="17">打包一口价</option>
                            <option value="12">满减送</option>
                            <option value="6">拼团</option>
                            <option value="8">砍价</option>
                            <option value="2">预售</option>
                            <option value="15">限购</option>
                            <option value="is_virtual">虚拟商品</option>
                            <option value="21">第"2"件半价</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="button" id="btn_search" value="搜索" class="btn btn-primary m-r-5" />
                <input type="button" id="btn_export" value="导出" class="btn btn-default m-r-5" />
                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>
        <script type="text/javascript">
            //
        </script>
        <style type="text/css">
            .search-term .tree-chosen-input-box.form-control {
                width: auto;
                min-width: 150px;
            }
        </style>
    </div>
    <!-- 工具栏（列表名称、列表显示项设置） -->
    <div class="common-title">
        <div class="ftitle">
            <h3>商品列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
    </div>
    <!--列表内容-->

    @include('goods.list.partials._list')

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <!-- 图片缓载js -->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js?v=2"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js?v=2"></script>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="/assets/d2eace91/js/jquery.qrcode.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            $("input[name=goods_barcode]").focus();
            //条形码扫描触发事件
            $("input[type=text]").bind("keypress", function(event) {
                if (event.keyCode == "13") {
                    $("#btn_search").click();
                }
            });
            // ajax获取运费模板下拉选项
            $.ajax({
                type:'get',
                url : '/goods/list/get-freight-list',
                data:{
                    freight_id:'0'
                },
                success:function(result){
                    $('#searchmodel-freight_id').html(result);
                }
            });
        })
        var catselector = $("#cat_selector").catselector({
            //size: 1,
            data: {
                deep: 3
            },
            change: function() {
                var cat_ids = this.getValues().join(",");
                $("#searchmodel-cat_id").val(cat_ids);
            }
        });
        catselector.load();
        //
        $().ready(function() {
            var page_id = "pagination";
            $("#"+page_id+" > .pagination-goto > .goto-input").keyup(function(e) {
                $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $("#"+page_id+" > .pagination-goto > .goto-link").click();
                }
            });
            $("#"+page_id+" > .pagination-goto > .goto-button").click(function() {
                var page = $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page", page);
                $("#"+page_id+" > .pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        var tablelist = null;
        $().ready(function () {
            tablelist = $("#table_list").tablelist();
            $("#btn_export").click(function () {
                var url = "/goods/list/export.html?title=导出商品列表";
                var params = {
                    goods_barcode: $("#searchmodel-goods_barcode").val(),
                    keyword: $("#searchmodel-keyword").val(),
                    keyword_type: $("#searchmodel-keyword_type").val(),
                    cat_id: $("#searchmodel-cat_id").val(),
                    tag_id: $("#searchmodel-tag_id").val(),
                    status: $("#searchmodel-status").val(),
                    brand_id: $("#searchmodel-brand_id").val(),
                    store_id: $("#searchmodel-store_id").val(),
                    scid: $("#searchmodel-scid").val(),
                    pricing_mode: $("#searchmodel-pricing_mode").val(),
                    sales_model: $("#searchmodel-sales_model").val(),
                    start_stock: $("#searchmodel-start_stock").val(),
                    end_stock: $("#searchmodel-end_stock").val(),
                    erp_goods_id: $("#searchmodel-erp_goods_id").val(),
                    shop_goods_cat_id: $("#searchmodel-shop_goods_cat_id").val(),
                    freight_id: $("#searchmodel-freight_id").val(),
                    is_img: $("#searchmodel-is_img").val(),
                    has_gift: $("#searchmodel-has_gift").val(),
                    member_price: $("#searchmodel-member_price").val(),
                    user_discount: $("#searchmodel-user_discount").val(),
                    goods_number: $("#searchmodel-goods_number").val(),
                    shipper_id: $("#searchmodel-shipper_id").val(),
                    goods_mode: $("#searchmodel-goods_mode").val(),
                    activity: $("#searchmodel-activity").val()
                };
                // @hezhiqiang 增加重量货号的筛选
                if ($('#searchmodel-goods_sn').length > 0) {
                    params['goods_sn'] = $('#searchmodel-goods_sn').val();
                }
                if ($('#searchmodel-goods_weight').length > 0) {
                    params['goods_weight'] = $('#searchmodel-goods_weight').val();
                }
                // 剔除 undefined 的值
                for (var name in params) {
                    if (params[name] != undefined) {
                        url += "&" + name + "=" + params[name];
                    }
                }
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go('/site/export?url=' + encodeURIComponent($.base64.encode(url)), '_blank', false);
            });
            // 查看SKU信息
            $("body").on("click", ".sku-list", function () {
                var goods_id = $(this).data("goods-id");
                $.loading.start();
                $.open({
                    title: "商品 #" + goods_id + " 的SKU列表",
                    ajax: {
                        url: '/goods/list/sku-list',
                        data: {
                            goods_id: goods_id
                        }
                    },
                    width: "980px",
                    end: function (index, object) {
                        // 判断SKU信息是否发生变化
                        if ($(document).data("sku-change")) {
                            tablelist.load();
                        }
                        $(document).data("sku-change", false);
                    }
                });
            });
            // 设置SKU会员价格
            $("body").on("click", ".sku_member", function () {
                var goods_id = $(this).data("goods-id");
                $.loading.start();
                $.open({
                    title: "自定义会员价",
                    ajax: {
                        url: '/goods/list/sku-member',
                        data: {
                            goods_id: goods_id
                        }
                    },
                    width: "980px",
                    end: function (index, object) {
                        // 判断SKU信息是否发生变化
                        if ($(document).data("sku-change")) {
                            tablelist.load();
                        }
                        $(document).data("sku-change", false);
                    }
                });
            });
            //设置阶梯价格
            $("body").on("click", ".sku_step_price", function () {
                var goods_id = $(this).data("goods-id");
                $.loading.start();
                $.open({
                    title: "自定义阶梯价",
                    ajax: {
                        url: '/goods/list/sku-step-price',
                        data: {
                            goods_id: goods_id
                        }
                    },
                    width: "840px",
                    end: function (index, object) {
                        // 判断SKU信息是否发生变化
                        if ($(document).data("sku-change")) {
                            tablelist.load();
                        }
                        $(document).data("sku-change", false);
                    }
                });
            });
            $("body").on("click", ".offsale-goods", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要下架的商品");
                    return;
                }
                $.confirm("您确定要下架此商品吗？", {}, function () {
                    $.loading.start();
                    $.post("/goods/publish/offsale", {
                        ids: ids
                    }, function (result) {
                        if (result.code == 0) {
                            $.msg(result.message, function () {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json").always(function () {
                        $.loading.stop();
                    });
                });
            });
            $("body").on("click", ".onsale-goods", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids) {
                    $.msg("请选择要上架的商品");
                    return;
                }
                $.loading.start();
                $.post("/goods/publish/onsale", {
                    ids: ids
                }, function (result) {
                    if (result.code == 0) {
                        $.msg(result.message, function () {
                            tablelist.load();
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        }, function () {
                            tablelist.load();
                        });
                    }
                }, "json").always(function () {
                    $.loading.stop();
                });
            });
            $("body").on("click", ".delete-goods", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids) {
                    $.msg("请选择要删除的商品");
                    return;
                }
                $.confirm("您确定要删除此商品吗？", function () {
                    $.loading.start();
                    $.post('/goods/publish/delete', {
                        ids: ids
                    }, function (result) {
                        if (result.code == 0) {
                            $.msg(result.message, function () {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json").always(function () {
                        $.loading.stop();
                    });
                });
            })
            $("body").on("click", ".miniprogram-live-check", function (data) {
                let
                    goods_id = $(this).data("id");
                $.loading.start();
                $.open({
                    // 标题
                    title: '直播商品审核',
                    width: 680,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/live-check-goods',
                        data: {
                            goods_id: goods_id
                        }
                    },
                });
            });
            //转移商城商品分类
            $("body").on("click", ".move-goods", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要转移分类的商品");
                    return;
                }
                $.modal({
                    // 标题
                    title: '转移商城商品分类',
                    width: 900,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/move-goods-cat',
                        data: {
                            ids: ids
                        }
                    },
                });
            });
            // 转移店铺商品分类
            $("body").on("click", ".move-shop-goods", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置分类的商品");
                    return;
                }
                $.loading.start();
                $.open({
                    // 标题
                    title: '设置店铺商品分类',
                    width: '590px',
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/show-shop-goods-cat',
                        data: {
                            ids: ids
                        }
                    },
                    btn: ['确定', '取消'],
                    yes: function(index, obj) {
                    }
                });
            });
            //商品标签
            $("body").on("click", ".goods-tag", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置标签的商品");
                    return;
                }
                $.open({
                    // 标题
                    title: '商品标签设置',
                    height: '200px',
                    width: '500px',
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-goods-tag',
                        data: {
                            ids: ids
                        }
                    },
                });
            });
            //商品单位
            $("body").on("click", ".goods-unit", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置单位的商品");
                    return;
                }
                $.open({
                    // 标题
                    title: '商品单位设置',
                    width: 500,
                    height: 200,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-goods-unit',
                        data: {
                            ids: ids
                        }
                    }
                });
            });
            //计价方式
            $("body").on("click", ".goods-pricing-mode", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置计价方式的商品");
                    return;
                }
                $.open({
                    // 标题
                    title: '计价方式设置',
                    width: 500,
                    height: 200,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-goods-pricing-mode',
                        data: {
                            ids: ids
                        }
                    }
                });
            });
            // 会员打折
            $("body").on("click", ".user-discount", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置会员打折的商品");
                    return;
                }
                $.open({
                    // 标题
                    title: '会员打折设置',
                    width: 600,
                    height: 340,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-user-discount',
                        data: {
                            ids: ids
                        }
                    }
                });
            });
            // 自提设置
            $("body").on("click", ".set-pickup", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置自提的商品");
                    return;
                }
                $.open({
                    // 标题
                    title: '自提设置',
                    width: 500,
                    height: 200,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/batch-set-is-pickup',
                        data: {
                            ids: ids
                        }
                    }
                });
            });
            // 普通快递配送
            $("body").on("click", ".set-common-package", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置普通快递的商品");
                    return;
                }
                $.open({
                    // 标题
                    title: '普通快递配送设置',
                    width: 500,
                    height: 200,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/batch-set-is-common-package',
                        data: {
                            ids: ids
                        }
                    }
                });
            });
            // 库存计数
            $("body").on("click", ".stock-mode", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置库存计数的商品");
                    return;
                }
                $.open({
                    // 标题
                    title: '库存计数设置',
                    width: 600,
                    height: 310,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-goods-stock-mode',
                        data: {
                            ids: ids
                        }
                    }
                });
            });
            //最小起订量
            $("body").on("click", ".goods-moq", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置最小起订量的商品");
                    return;
                }
                $.modal({
                    // 标题
                    title: '最小起订量设置',
                    width: 500,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-goods-moq-modal',
                        data: {
                            ids: ids
                        }
                    },
                });
            });
            //开具发票
            $("body").on("click", ".invoice-type", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要开具发票的商品");
                    return;
                }
                $.modal({
                    // 标题
                    title: '开具发票设置',
                    width: 800,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-goods-invoice-type',
                        data: {
                            ids: ids
                        }
                    },
                });
            });
            //详情版式
            $("body").on("click", ".goods-layout", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置详情版式的商品");
                    return;
                }
                $.modal({
                    // 标题
                    title: '详情版式',
                    width: 500,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-goods-layout',
                        data: {
                            ids: ids
                        }
                    },
                });
            });
            //服务保障
            $("body").on("click", ".contract", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置服务保障的商品");
                    return;
                }
                $.modal({
                    // 标题
                    title: '服务保障',
                    width: 500,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-goods-contract',
                        data: {
                            ids: ids
                        }
                    },
                });
            });
            //会员价
            $("body").on("click", ".sku-member", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置自定义会员价的商品");
                    return;
                }
                $.loading.start();
                $.open({
                    title: "自定义会员价",
                    ajax: {
                        url: '/goods/list/batch-sku-member',
                        data: {
                            ids: ids
                        }
                    },
                    width: "980px",
                    end: function (index, object) {
                        // 判断SKU信息是否发生变化
                        if ($(document).data("sku-change")) {
                            tablelist.load();
                        }
                        $(document).data("sku-change", false);
                    }
                });
            });
            //运费模板
            $("body").on("click", ".goods-freight", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置运费模板的商品");
                    return;
                }
                $.modal({
                    // 标题
                    title: '运费设置',
                    width: 550,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-goods-freight',
                        data: {
                            ids: ids
                        }
                    },
                });
            });
            // 设置价格
            $("body").on("click", ".set-price", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要调整价格的商品");
                    return;
                }
                $.open({
                    title: "调整价格",
                    ajax: {
                        url: '/goods/list/set-price',
                        data: {
                            ids: ids
                        }
                    },
                    hight: "300px",
                    width: "500px",
                });
            });
            // 批量修改商品库存
            $("body").on('click', '.set-goods-number', function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要修改库存的商品");
                    return;
                }
                $.open({
                    title: "调整库存",
                    width: "480px",
                    hight: "300px",
                    ajax: {
                        url: '/goods/list/batch-edit-goods-number',
                        data: {
                            ids: ids
                        }
                    },
                    end: function (index, object) {
                        // 判断SKU信息是否发生变化
                        if ($(document).data("sku-change")) {
                            tablelist.load();
                        }
                        $(document).data("sku-change", false);
                    }
                });
                $.loading.start();
            })
            // 批量设置定时出售
            $("body").on("click", ".regular_time_sale", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要设置定时出售的商品");
                    return;
                }
                $.open({
                    // 标题
                    title: '定时出售设置',
                    width: 850,
                    height: 500,
                    trigger: $(this),
                    // ajax加载的设置
                    ajax: {
                        url: '/goods/list/set-regular-time-sale',
                        data: {
                            ids: ids
                        }
                    }
                });
            });
            //
            // 设置价格
            $("body").on("click", ".set-keywords", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要调整关键词的商品");
                    return;
                }
                $.open({
                    title: "调整关键词",
                    ajax: {
                        url: '/goods/list/set-keywords',
                        data: {
                            ids: ids
                        }
                    },
                    hight: "300px",
                    width: "500px",
                });
            });
            // 设置商品自提超时期限
            $("body").on("click", ".set-pickup-timeout", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要调整自提超时期限的商品");
                    return;
                }
                $.open({
                    title: "自提超时期限设置",
                    ajax: {
                        url: '/goods/list/set-pickup-timeout',
                        data: {
                            ids: ids
                        }
                    },
                    hight: "300px",
                    width: "500px",
                });
            });
            $("#btn_search").click(function () {
                var data = $("#SearchModel").serializeJson();
                tablelist.load(data);
            });
            // 下载商品二维码
            $("body").on("click", ".download-qrcode", function () {
                var canvas = $(this).parents(".QR-code").find("canvas").get(0);
                var goods_id = $(this).data("goods_id");
                $.exportCanvasAsPNG(canvas, "商品二维码_" + goods_id);
            });
            // 生成商品二维码
            $("body").on("mouseover", ".QR-code", function () {
                if ($(this).data("loading")) {
                    return;
                }
                $(this).data("loading", true);
                var target = $(this).find(".goods-qrcode")
                var goods_id = $(target).data("goods_id");
                $(target).qrcode({
                    render: "canvas", //也可以替换为table
                    width: 120,
                    height: 120,
                    text: "https://m.xxxx.com/mn06d12/goods-" + goods_id
                });
            });
            $("body").on("mouseover", ".goods-reason", function () {
                $.tips($(this).data("goods-reason"), $(this));
            });
            $("body").on("mouseout", ".goods-reason", function () {
                $.closeAll("tips");
            });
            // 备注
            $("body").on("click", ".remark", function () {
                var id = $(this).data("id");
                var tablelist = $("#table_list").tablelist();
                $.open({
                    title: "备注",
                    ajax: {
                        url: '/goods/list/remark',
                        data: {
                            id: id
                        }
                    },
                    width: "600px",
                    btn: ['确定', '取消'],
                    yes: function (index, container) {
                        var data = $(container).serializeJson();
                        var value = $("#remark").val().trim();
                        if (value == "") {
                            $("#error").show();
                            return;
                        }
                        $.loading.start();
                        $.post('/goods/list/remark', data, function (result) {
                            if (result.code == 0) {
                                layer.close(index);
                                $.msg(result.message, function () {
                                    tablelist.load();
                                });
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                })
                            }
                        }, "json").always(function () {
                            $.loading.stop();
                        });
                    }
                });
            });
        });
        //
        $(document).ready(function () {
            // 图片懒加载
            $("img.lazy").lazyload({
                skip_invisible: false,
                effect: 'fadeIn',
                failurelimit: $.imgloading.settings.failurelimit,
                threshold: $.imgloading.settings.threshold,
                data_attribute: $.imgloading.settings.data_attribute,
                load: function () {
                    $(this).removeClass('lazy');
                    // 删除背景图片
                    $(this).parent('a').css("background", "");
                    if ($(this).hasClass('square')) {
                        if ($(this).height() != $(this).width()) {
                            $(this).height($(this).width());
                        } else {
                            $(this).removeClass('square');
                        }
                    }
                }
            });
            // toggle `popup` / `inline` mode
            // $.fn.editable.defaults.mode = "inline";
            // 商品价格
            $(".goods_price").editable({
                type: "text",
                url: "/goods/list/edit-goods-info",
                pk: 1,
                // title: "本店价（元）",
                ajaxOptions: {
                    type: "post"
                },
                params: function (params) {
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
                success: function (response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function (value, sourceData) {
                    // 保留两位小数
                    $(this).html((Number(value)).toFixed(2));
                },
                error: function (response, newValue) {
                }
            });
            // 商品库存
            $(".goods_number").editable({
                type: "text",
                url: "/goods/list/edit-goods-info",
                pk: 1,
                // title: "商品库存",
                ajaxOptions: {
                    type: "post"
                },
                params: function (params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'goods_number';
                    return params;
                },
                /* validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '商品库存不能为空。';
                    } else if (!ex.test(value)) {
                        return '商品库存必须是正整数。';
                    } else if (value > 999999999) {
                        return '商品库存不能大于999999999';
                    }
                }, */
                success: function (response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function (value, sourceData) {
                    // 显示整数
                    $(this).html((Number(value)).toFixed(0));
                },
                error: function (response, newValue) {
                }
            });
            $('.goods_name_controller').click(function (e) {
                e.stopPropagation();
                $(this).parent().children(":first").editable('toggle');
            });
            // 商品名称
            $(".goods_name").editable({
                type: "text",
                url: "/goods/list/edit-goods-info",
                pk: 1,
                // title: "商品名称",
                ajaxOptions: {
                    type: "post"
                },
                params: function (params) {
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
                success: function (response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function (value, sourceData) {
                    if (value.length > 25) {
                        $(this).html(value.substring(0, 25) + '...');
                    } else {
                        $(this).html(value);
                    }
                },
                error: function (response, newValue) {
                }
            });
            // 复制商品名称
            var clipboard = new Clipboard('.goods_name_controller_copy');
            clipboard.on('success', function (e) {
                console.log(e);
                $.msg("复制商品名称成功！")
            });
            clipboard.on('error', function (e) {
                console.log(e);
                $.msg("复制商品名称失败！请手动复制")
            });
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
