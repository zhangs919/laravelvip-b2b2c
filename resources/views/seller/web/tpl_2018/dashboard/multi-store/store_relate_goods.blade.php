<link href="/assets/d2eace91/css/styles.css?v=2.1" rel="stylesheet">
<!-- 温馨提示 -->
<div id="{{ $uuid }}">
    <form name="related_goods">
        <div class="table-content m-t-30">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label col-sm-3">
                            <span>关联商品：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-wrap">
                                <label class="control-label m-r-10 cur-p">
                                    <input type="radio" name="related_goods_type" value="1">
                                    店铺全部商品
                                </label>
                                <label class="control-label m-r-10 cur-p">
                                    <input type="radio" name="related_goods_type" value="2">
                                    店铺出售中商品
                                </label>
                                <label class="control-label m-r-10 cur-p">
                                    <input type="radio" name="related_goods_type" value="3">
                                    店铺已下架商品
                                </label>
                                <label class="control-label m-r-10 cur-p">
                                    <input type="radio" name="related_goods_type" value="4" checked="checked">
                                    店铺指定商品
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field goods_container ">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="widget_goods w800 m-auto">
                                <div class="choose-goods-list"
                                    style="padding-top: 250px; text-align: center; height: 568px; width: 100%; display: block;">
                                </div>
                            </div>
                            <input type="hidden" id="select_goods_id" name="select_goods_id"
                                value="{{ $select_goods_id }}" />
                            <input type="hidden" id="add_goods_ids" name="add_goods_ids" value="" />
                            <input type="hidden" id="remove_goods_ids" name="remove_goods_ids" value="" />
                        </div>
                    </div>
                </div>
                <div class="bottom-btn p-b-30 p-l-0 text-c">
                    <a href="javascript:void(0);" class="btn btn-primary btn-lg" id="select_goods_button_submit"
                        value="确认提交">确认提交</a>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- 商品选择器 -->
<script type="text/javascript">
    // 
</script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=2.1"></script>
<script>

    $().ready(function () {

        $.loading.stop();

        var type = '{{ $type }}';
        var store_id = '{{ $store_id }}';
        var group_id = '{{ $group_id ?? 0 }}';

        // <!--  -->
        selected_goods();
        // <!--  -->

        $("body").find("#{{ $uuid }}").on("click", "#select_goods_button_submit", function () {

            var target = this;

            if ($(target).hasClass("disabled")) {
                return false;
            }

            $(target).addClass("disabled");

            //获取关联方式
            var related_goods_type = $("#{{ $uuid }}").find('input[name="related_goods_type"]:checked').val();
            var goods_id = $("#{{ $uuid }}").find("#select_goods_id").val();
            var add_goods_ids = "";
            var remove_goods_ids = "";
            if (related_goods_type == 4) {
                if (goods_id == "" || goods_id == 0) {
                    $.msg("请选择商品！");

                    $(this).removeClass("disabled");

                    return false;
                }

                add_goods_ids = $("#{{ $uuid }}").find("#add_goods_ids").val();
                remove_goods_ids = $("#{{ $uuid }}").find("#remove_goods_ids").val();
            }

            $.confirm("您确定要更新门店关联的商品吗？当前操作可能会花费很长时间而且请勿中断！", function () {
                $.progress({
                    type: 'POST',
                    url: 'store-related-goods',
                    key: 'update:multistore:goods:relation:{{ $store_id }}',
                    data: {
                        type: type,
                        store_id: store_id,
                        group_id: group_id,
                        select_goods_ids: goods_id,
                        add_goods_ids: add_goods_ids,
                        remove_goods_ids: remove_goods_ids,
                        related_goods_type: related_goods_type
                    },
                    end: function (result) {
                        if (result.code == 0) {
                            $.msg("关联商品成功！", {
                                time: 1500
                            }, function () {

                                if (typeof tablelist != 'undefined') {
                                    tablelist.load();
                                }

                                $.closeAll();
                            });
                        } else {
                            $.alert(result.message);
                            $(target).removeClass("disabled");
                        }
                    }
                });
            }, function () {
                $(target).removeClass("disabled");
            });

        });

        $("#{{ $uuid }}").find(":radio").click(function () {
            if ($(this).val() == 4) {
                selected_goods();
            } else {
                $(".goods_container").addClass('hide');
            }
        });

        function selected_goods() {

            $("#{{ $uuid }}").find(".goods_container").removeClass('hide');
            var container = $("#{{ $uuid }}").find(".widget_goods");
            var values = [];

            // <!--  -->
            var selected_goods = JSON.parse('{!! $selected_goods !!}');
            $.each(selected_goods, function (index, value) {
                values[value.goods_id + '-0'] = {
                    goods_id: value.goods_id,
                    sku_id: 0,
                };
            });
            // <!--  -->

            if (!$.goodspicker(container)) {
                shop_id = '{{ $shop_id }}';
                show_seller_goods = '{{ $show_seller_goods }}';
                multi_store_id = '{{ $store_id }}';

                // 初始化组件，为容器绑定组件
                var goodspicker = $(container).goodspicker({
                    url: 'picker',
                    data: {
                        page: new Object(),
                        is_sku: 0,
                        output: true,
                        show_selected: 0,
                        shop_id: shop_id,
                        goods_status: 1,
                        show_seller_goods: show_seller_goods
                    },
                    values: values,
                    click: function (selected, sku) {
                        $("#{{ $uuid }}").find("#select_goods_id").val(this.goods_ids.toString() + ',');

                        $("#{{ $uuid }}").find("#add_goods_ids").val(this.getAddGoodsIds().join(","));
                        $("#{{ $uuid }}").find("#remove_goods_ids").val(this.getRemoveGoodsIds().join(","));
                    },
                    removeAll: function () {
                        $("#{{ $uuid }}").find("#select_goods_id").val('');

                        $("#{{ $uuid }}").find("#add_goods_ids").val(this.getAddGoodsIds().join(","));
                        $("#{{ $uuid }}").find("#remove_goods_ids").val(this.getRemoveGoodsIds().join(","));
                    }
                });
            }
        }
    })

// 
</script>