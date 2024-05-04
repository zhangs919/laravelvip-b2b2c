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
            @csrf
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
                        <div id="cat_selector">
                            <div class="form-control-box">
                                <div class="tree-chosen-box"></div>
                            </div>
                        </div>
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
                            @foreach($brand_list as $v)
                                <option value="{{ $v->brand_id }}">{{ $v->brand_name }}</option>
                            @endforeach
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
                <span data-total-record="true" class="pagination-total-record"></span>
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