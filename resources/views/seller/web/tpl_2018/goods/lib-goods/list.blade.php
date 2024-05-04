{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=12"/>
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="SearchModel" name="SearchModel" action="/goods/lib-goods/list" method="POST">
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
                        <span>分类：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-cat_id" class="form-control chosen-select" name="cat_id" data-width="200">
                            @foreach($category_list as $k=>$v)
                                <option value="{{ $k }}" @if(0 == $k)selected="selected"@endif @if($v['has_child'])disabled="true"@endif>{!! $v['cat_name'] !!}</option>
                            @endforeach
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

                        <select id="searchmodel-brand_id" class="form-control chosen-select" name="brand_id" data-width="200">
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
                <input type="button" id="btn_search" value="搜索" class="btn btn-primary m-r-5" />
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

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



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

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <script type='text/javascript'>
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            // 查看SKU信息
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
                    width: "980px"
                });
            });

            // 搜索
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

            // 导入
            $("body").on("click", ".import", function() {
                // 商品ID
                var ids = $(this).data("id");
                // 单个导入
                var single = $(this).data("single");

                if (!ids) {
                    ids = tablelist.checkedValues();
                    ids = ids.join(",");
                }

                if (!ids || ids.length == 0) {
                    $.msg("请选择要导入的商品");
                    return;
                }

                console.log(ids)
                $.open({
                    title: "商品导入",
                    ajax: {
                        url: '/goods/lib-goods/import',
                        data: {
                            ids: ids,
                            single: single
                        }
                    },
                    width: "650px",
                    btn: ['确定导入', '取消'],
                    yes: function(index, container) {
                        if (!validator.form()) {
                            return;
                        }

                        var data = $(container).serializeJson();
                        $.loading.start();
                        $.post('/goods/lib-goods/import', data, function(result) {
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
                    }
                });
            });
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop