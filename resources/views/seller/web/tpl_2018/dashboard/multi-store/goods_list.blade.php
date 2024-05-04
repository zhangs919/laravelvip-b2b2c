{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=2.1" rel="stylesheet">
@stop

{{--content--}}
@section('content')

    @if(!$is_manage)
        <!--门店名称-->
        <div class="multistore-title">
            <h5>门店名称：{{ $store_name }}</h5>
        </div>
    @endif
    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="SearchModel" name="SearchModel" action="/dashboard/multi-store/goods-list?store_id={{ $store_id }}"
              method="POST">
            @csrf
            <!-- -->
            @if($is_manage)
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>门店：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input type="hidden" class="is-search" name="is_search" value="0">
                            <select id="searchmodel-store_id" class="form-control chosen-select chosen-store-id" name="store_id" data-width="120" style="display: none;">
                                @foreach($store_list as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>条形码：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="hidden" id="searchmodel-store_id" class="form-control" name="store_id"
                               value="{{ $store_id }}">
                        <input type="text" id="searchmodel-goods_barcode" class="form-control"
                               name="goods_barcode" placeholder="请输入正确的条形码">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="searchmodel-keyword_type" class="form-control w120 m-r-2" name="keyword_type">
                            @foreach($keyword_type_list as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="searchmodel-keyword" class="form-control" name="keyword"
                               placeholder="请输入关键字">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
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
            <!-- -->
            <!--当搜索条件过来时并需要默认隐藏的时候在simple-form-field后面新加toggle hide样式，并且在最后新加ID为searchMore的链接按钮（更多筛选条件按钮）-->
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
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>库存：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="searchmodel-start_stock" class="form-control small"
                               name="start_stock">
                        -
                        <input type="text" id="searchmodel-end_stock" class="form-control small"
                               name="end_stock">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>预警值：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="searchmodel-start_warn_number" class="form-control small"
                               name="start_warn_number">
                        -
                        <input type="text" id="searchmodel-end_warn_number" class="form-control small"
                               name="end_warn_number">
                    </div>
                </div>
            </div>
            <!--新加 end-->
            <div class="simple-form-field">
                <input type="button" id="btn_search" value="搜索" class="btn btn-primary m-r-5"/>
                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出"/>
                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>
        <script type="text/javascript">
            //
        </script>
    </div>
    <!-- 工具栏（列表名称、列表显示项设置） -->
    <div class="common-title">
        <div class="ftitle">
            <h3>管理列表</h3>
            <h5>
                (&nbsp;共
                <span data-total-record=true class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive" style="overflow: visible;">
        @include('dashboard.multi-store.partials._goods_list')
    </div>

    <script type="text/javascript">
        //
    </script>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <!-- 自提点设置层 -->
    <div id="ziti_txt" style="display:none">
        <div class="modal-body  p-b-20">
            <div class="table-content  m-t-10  clearfix">
                <form class="form-horizontal">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                <span class="ng-binding">支持自提：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">
                                    <label class="control-label cur-p m-r-20">
                                        <input type="radio" name="self_mention" checked value="1"/>
                                        开启
                                    </label>
                                    <label class="control-label cur-p m-r-20">
                                        <input type="radio" name="self_mention" value="0"/>
                                        关闭
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer pos-r">
            <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
        </div>
    </div>
    <!-- 自提点结束 -->
    <!-- 表单验证 -->
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
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/jquery.qrcode.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=2.1"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js?v=2.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        //
        var tablelist = null;
        var store_id = "{{ $store_id }}";
        var shop_id = "{{ $shop_id }}";
        $().ready(function () {
            tablelist = $("#table_list").tablelist();
            //批量上，下架
            $("body").on("click", ".batch-sale-goods", function () {
                var ids = $(this).data("id");
                var status = $(this).data("status");
                var msg = '上架';
                if (status == 'off') {
                    msg = '下架';
                }
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要" + msg + "的商品");
                    return;
                }
                $.confirm("您确定要" + msg + "商品吗？", {}, function () {
                    $.post("batch-is-sell", {
                        store_id: store_id,
                        shop_id: shop_id,
                        status: status,
                        spu_ids: ids,
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
                    }, "json");
                });
            });
            $("#btn_export").click(function () {
                var url = "/dashboard/multi-store/export.html";
                var data = $("#SearchModel").serializeJson();
                var params = $.param(data);
                if (params != "") {
                    url += "?" + params;
                }
                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go('/site/export?url=' + encodeURIComponent($.base64.encode(url)) + '&title=导出商品列表', '_blank', false);
            });
            //单商品删除
            $("body").on("click", ".delete-goods", function () {
                var ids = $(this).data("id");
                var msg = '此';
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                    msg = '这些';
                }
                if (!ids) {
                    $.msg("请选择要删除的商品");
                    return;
                }
                $.confirm("您确定要删除" + msg + "商品吗？", function () {
                    $.loading.start();
                    $.post('goods-delete', {
                        store_id: store_id,
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
            //单商品编辑
            $("body").on("click", ".edit_goods", function () {
                var goods_id = $(this).data("goods_id");
                var store_id = $(this).data("store_id");
                $.loading.start();
                $.open({
                    title: "商品信息编辑",
                    ajax: {
                        url: 'edit-goods',
                        data: {
                            goods_id: goods_id,
                            store_id: store_id,
                            shop_id: shop_id
                        }
                    },
                    width: "980px",
                    end: function (index, object) {
                    }
                });
            });
            //自提点设置层
            $("body").on("click", ".sku-member", function () {
                var ids = $(this).data("id");
                var status = $('input:radio[name=self_mention]:checked').val();
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids) {
                    $.msg("请选择要编辑的商品");
                    return;
                }
                $.open({
                    title: '自提设置',
                    type: 1,
                    content: $("#ziti_txt"),
                    width: "500px"
                })
            })
            //自提点设置操作
            $("body").on("click", "#ok", function () {
                var ids = $(this).data("id");
                var status = $('input:radio[name=self_mention]:checked').val();
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids) {
                    $.msg("请选择要编辑的商品");
                    return;
                }
                $.closeAll();
                $.loading.start();
                $.post("batch-is-self-mention", {
                    spu_ids: ids,
                    store_id: store_id,
                    shop_id: shop_id,
                    status: status
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
                }, "json");
            });
            //多商品编辑
            $("body").on("click", ".goods-multi-edit", function () {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids) {
                    $.msg("请选择要编辑的商品");
                    return;
                }
                $.loading.start();
                $.ajax({
                    type: "POST",
                    url: "edit-multi-goods",
                    data: {
                        store_id: store_id,
                        shop_id: shop_id,
                        spu_ids: ids,
                    },
                    success: function (res) {
                        var html = JSON.parse(res).data;
                        $.open({
                            type: 1,
                            area: ["900px", "520px"],
                            title: "商品库存、价格设置",
                            content: html
                        });
                    }
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
                var url = $(target).data("url");
                $(target).qrcode({
                    render: "canvas", //也可以替换为table
                    width: 120,
                    height: 120,
                    text: url
                });
            });
            $("body").on("mouseover", ".goods-reason", function () {
                $.tips($(this).data("goods-reason"), $(this));
            });
            $("body").on("mouseout", ".goods-reason", function () {
                $.closeAll("tips");
            });
            // 批量更新商品价格,库存,状态
            $("body").on("click", "#upload_goods", function () {
            })
            //关联商品
            $("body").on("click", "#related_goods", function () {
                var func = function (type) {
                    var url = "store-related-goods";
                    var store_id = '{{ $store_id }}';
                    var show_seller_goods = '';
                    var type_name = type == 0 ? "增量式" : "覆盖式";
                    $.loading.start();
                    $.open({
                        type: 1,
                        title: "门店关联商品",
                        title: "为门店【{{ $store_name }}】 <b>" + type_name + "</b> 关联商品",
                        width: '850px',
                        height: '250px',
                        ajax: {
                            url: url,
                            data: {
                                store_id: store_id,
                                show_seller_goods: show_seller_goods,
                                type: type
                            }
                        },
                        success: function (layero, index) {
                            if ($(layero).find(":radio:checked").val() == 4) {
                                layer.style(index, {
                                    height: ($(window).height() - 100) + "px",
                                    top: '50px',
                                });
                            } else {
                                layer.style(index, {
                                    height: '250px',
                                    top: '180px'
                                });
                            }
                            $(layero).find(":radio").click(function () {
                                var val = $(this).val();
                                if (val == 4) {
                                    layer.style(index, {
                                        height: ($(window).height() - 100) + "px",
                                        top: '50px'
                                    });
                                } else {
                                    layer.style(index, {
                                        height: '250px',
                                        top: '180px'
                                    });
                                }
                            });
                        }
                    });
                }
                // 覆盖
                func(1);
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
            $('.goods_name_controller').click(function (e) {
                e.stopPropagation();
                $(this).parent().children(":first").editable('toggle');
            });
            // 商品名称
            /*  $(".goods_name").editable({
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
              /!* validate: function(value) {
                  value = $.trim(value);
                  if (!value) {
                      return '商品名称不能为空。';
                  } else if (value.length < 3) {
                      return '商品名称应该包含至少3个字。';
                  } else if (value.length > 60) {
                      return '商品名称只能包含至多60个字。';
                  }
              }, *!/
              success: function (response, newValue) {
                  var response = eval('(' + response + ')');
                  // 错误处理
                  if (response.code == -1) {
                      return response.message;
                  }
              },
              display: function (value, sourceData) {
                  if (value.length > 28) {
                      $(this).html(value.substring(0, 28) + '...');
                  } else {
                      $(this).html(value);
                  }
              }
            });*/
        });

        //初始推广图片点击事件
        function push(obj) {
            var poa = $(obj).parent().find('.popover-por');
            var bonus_id = poa.attr('goods_id');
            $.open({
                title: '商品推广码',
                type: 1,
                content: poa.html(),
                width: "800px",
                height: "500px",
                success: function (obj) {
                    // 复制到剪切板
                    /*  var clipboard = new Clipboard('.copy-link');
                     clipboard.on('success', function(e) {
                         $.msg("复制成功！");
                         e.clearSelection();
                         clipboard.destroy();
                     }); */
                }
            })
        };

        // function copy(obj) {
        //     // 复制到剪切板
        //     var clipboard = new Clipboard('.copy-link');
        //     clipboard.on('success', function (e) {
        //         $.msg("复制成功！");
        //         e.clearSelection();
        //         clipboard.destroy();
        //     });
        // }

        // 推广码
        $("body").off("click", ".popularize");
        $("body").on("click", ".popularize", function () {
            var id = $(this).data("id");
            var name = $(this).data("name");
            var url = $(this).data("url");
            var url_ = '/dashboard/promote/view-big';
            $.loading.start();
            $.open({
                title: "门店商品推广码",
                width: "800px",
                height: "500px",
                ajax: {
                    url: url_,
                    data: {
                        url: url,
                        title: "【" + name + "】推广码",
                        sub_title: "手机扫码访问门店商品",
                    }
                },
                end: function (index, object) {
                    $.loading.stop();
                }
            });
        });
        // @hezhiqiang 手动上下架功能
        $('#manual_nf').click(function () {
            $.confirm('是否确定手动上下架当前门店商品?', function () {
                $.loading.start();
                // 当前的门店id
                $.getJSON('/shop/sync/manual-nf?store_id=' + store_id, function (res) {
                    $.loading.stop();
                    if (res.code == 0) {
                        $.msg(res.message);
                    } else {
                        $.alert(res.message);
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop