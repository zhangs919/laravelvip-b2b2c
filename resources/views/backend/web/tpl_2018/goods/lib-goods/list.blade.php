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
                        <span>平台方商品分类：</span>
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
                        <span>本地商品库分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="searchmodel-lib_cat_id" class="form-control chosen-select" name="lib_cat_id" style="display: none;">
                            @foreach($lib_category_list as $k=>$v)
                                <option value="{{ $k }}" @if(0 == $k)selected="selected"@endif @if($v['has_child'])disabled="true"@endif>{!! $v['cat_name'] !!}</option>
                            @endforeach
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
        @include('goods.lib-goods.partials._list')

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