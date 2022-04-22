{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30">
        <form id="Shop" class="form-horizontal" name="Shop" action="/goods/lib-goods/import" method="post">
            {{ csrf_field() }}
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shoprankmodel-is_special" class="col-sm-4 control-label">
                        <span class="ng-binding">导入模式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="hidden" name="import_type" value="">
                            <div id="shoprankmodel-is_special" class="">
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="import_type" value="1" checked>
                                    全部导入
                                </label>
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="import_type" value="0">
                                    单一导入
                                </label>
                            </div>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div id="shop-container">
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="shop-shop_id" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">选择店铺：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="shop-shop_id" class="form-control chosen-select" name="Shop[shop_id]">
                                    <option value="">-- 请选择 --</option>
                                    @foreach($shop_list as $v)
                                    <option value="{{ $v->shop_id }}">{{ $v->shop_name }}</option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 商品选择器 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-1 control-label"></label>
                    <div class="col-sm-10">
                        <div class="goods-picker-container"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="select_goods_id" name="select_goods_id" />

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <a class="btn btn-primary import" href="javascript:void(0);">确认提交</a>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
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


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <!-- 商品选择器 -->
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180027"></script>

    <script type='text/javascript'>
        $().ready(function() {
            $("body").on("click", ".import", function() {

                var import_type = $('input:radio[name="import_type"]:checked').val();
                var shop_id = $("#shop-shop_id").val();
                var goods_id = $("#select_goods_id").val();

                var url = "/goods/lib-goods/import?import_type=" + import_type;

                if (import_type == 1) {
                    if (shop_id == '') {
                        $.msg("请选择店铺");
                        return;
                    } else {
                        url += '&shop_id=' + shop_id;
                    }
                } else {
                    if (goods_id == '') {
                        $.msg("请选择商品");
                        return;
                    } else {
                        url += '&goods_id=' + goods_id;
                    }
                }

                // 更新
                $.confirm('您确定导入店铺商品吗？当前操作可能会花费很长时间而且请勿中断！', function() {
                    $.progress({
                        url: url,
                        type: 'POST',
                        key: 'build-lib-goods-import',
                        end: function(result) {
                            $.go("/goods/lib-goods/list");
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    });
                });
            });

            $('input:radio[name="import_type"]').change(function() {
                var container = $(".goods-picker-container");
                var page_id = "GoodsPickerPage";
                if (!$.goodspickers(page_id)) {
                    if ($(this).val() == '0') {
                        $.goodspickers(page_id);
                        var goodspicker = $(container).goodspicker({
                            data: {
                                page: {
                                    // 分页唯一标识
                                    page_id: page_id
                                },
                                is_sku: 0,
                                is_supply: 2
                            },
                            // 选择商品和未选择商品的按钮单击事件
                            // @param selected 点击是否选中
                            // @param sku 选中的SKU对象
                            click: function(selected, sku) {
                                $("#select_goods_id").val(this.goods_ids.join(","));
                            },
                        });
                        $("#shop-container").hide();
                    }
                } else {
                    if ($(this).val() == '0') {
                        $("#shop-container").hide();
                        $(container).show();
                    } else {
                        $("#shop-container").show();
                        $(container).hide();
                    }
                }
            });
        });
    </script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>
    
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop