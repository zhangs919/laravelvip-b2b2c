{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/js/ztree/zTreeStyle.css" rel="stylesheet">
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="SearchModel" name="SearchModel" action="/goods/list/trash" method="POST">
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
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="searchmodel-keyword" class="form-control" name="keyword" placeholder="商品ID/货号/名称">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品标签：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="hidden" name="tag_id" value=""><select id="searchmodel-tag_id" class="form-control chosen-select" name="tag_id[]" multiple="multiple" size="4">
                            <option value="0">请选择</option>
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
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>隶属网点：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-store_id" class="form-control chosen-select" name="store_id" data-width="120">
                            <option value="">请选择</option>
                            <option value="1">鲜农乐一号门店</option>
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
            <h3>回收站商品列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">

        @include('goods.list.partials._trash_list')


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

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
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
        })
        // 
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
        // 
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();
            // 还原商品
            $("body").on("click", ".recover-goods", function() {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要还原的商品");
                    return;
                }
                $.confirm("您确定要还原选中的商品吗？", function() {
                    $.loading.stop();
                    $.post("/goods/publish/recover", {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, function() {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json").always(function() {
                        $.loading.stop();
                    });
                });
            });
            // 彻底删除商品
            $("body").on("click", ".forever-delete", function() {
                var ids = $(this).data("id");
                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }
                if (!ids || ids.length == 0) {
                    $.msg("请选择要彻底删除的商品");
                    return;
                }
                $.confirm("彻底删除商品后将无法恢复，您确定要继续彻底删除选中的商品吗？", function() {
                    $.loading.start();
                    $.post("/goods/publish/forever-delete", {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, function() {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json").always(function() {
                        $.loading.stop();
                    });
                });
            });
            $("#btn_search").click(function() {
                var data = $("#SearchModel").serializeJson();
                tablelist.load(data);
            });
        });

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
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop