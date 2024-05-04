<div id="goodspicker_{{ $page_id }}" class="simple-form-field">
    <div class="form-group">
        <label for="text4" class="col-sm-0 control-label"></label>
        <div class="col-sm-0">
            <div class="choose-goods-list">
                <div class="tabmenu">
                    <!-- <a class="choose-goods-close">×</a> -->
                    <ul class="tab">
                        <li class="active">
                            <a href="javascript:void(0)" class="goods-status" data-goods-status="1">出售中</a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" class="goods-status" data-goods-status="0">仓库中</a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" class="is-selected">
                                已选择（
                                <span class="selected_number">0</span>
                                ）
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="search-condition">
                    <div class="search-condition-box">
                        <div class="search-condition-field">
                            <span class="search-condition-label">选择分类：</span>
                            <div class="search-condition-wrap">
                                <select id="cat_ids" class="form-control chosen-select m-l-2" multiple="multiple" size="4" placeholder="--按分类选择商品--">
                                    @foreach($category_list as $v)
                                        <option value="{{ $v['cat_id'] }}">{!! $v['title_show'] !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="search-condition-field">
                            <span class="search-condition-label">选择活动：</span><div class="search-condition-wrap"><select id="activity_type" class="form-control chosen-select m-l-2" multiple="multiple" size="4" placeholder="--按活动选择--">
                                    <option value="3">团购</option>
                                    <option value="2">预售</option>
                                    <option value="6">拼团</option>
                                    <option value="8">砍价</option>
                                    <option value="11">限时折扣</option>
                                    <option value="14">直播</option>
                                    <option value="15">限购</option>
                                    <option value="17">打包一口价</option>
                                    <option value="12">满减送</option>
                                    <option value="is_virtual">虚拟商品</option>
                                </select></div>
                        </div>
                        <select id="brand_id" class="form-control chosen-select m-l-2">
                            <option value="">--按品牌选择商品--</option>
                            @foreach($brand_list as $v)
                                <option value="{{ $v->brand_id }}">{{ $v->brand_name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="keyword" class="form-control w150 m-l-2 m-r-2" placeholder="商品名称/条形码">
                        <select id="is_stock" class="form-control chosen-select m-l-2">
                            <option value="">--按库存选择--</option>
                            <option value="0">无库存</option>
                            <option value="1">有库存</option>
                        </select>
                        <input type="button" class="btn btn-primary m-l-2 m-r-2 btn-submit" value="搜索商品">
                        <span class="text-explode m-r-2">|</span>
                        <input type="button" class="btn btn-default m-r-2 selectall-page" value="本页全选">
                        <input type="button" class="btn btn-default m-r-2 unselectall" value="全部取消">
                        <!--
                        <input type="button" class="btn btn-default m-r-2 selectall" value="一键全选">
                        <span class="text-explode m-r-2">|</span>
                        <label class="input-label">
                            <input class="checkBox" type="checkbox" id="select_show" />
                            不看已选择商品
                        </label>
                         -->
                    </div>
                    <div class="clear"></div>
                </div>

                {{--引入列表--}}
                @include('dashboard.goods-mix.partials._picker_goods_list')

            </div>
        </div>
    </div>
</div>
<script src="/assets/d2eace91/js/jquery.json-2.4.js?v=20180027"></script>
<script id="btn_checked_template" type="text">
<a data-selected="true" href="javascript:void(0);" class="btn btn-xs btn-default btn-goodspicker">
<i class="fa fa-check"></i>
<span>已选</span>
</a>
</script>
<script id="btn_unchecked_template" type="text">
<a data-selected="false" href="javascript:void(0);" class="btn btn-xs btn-primary btn-goodspicker">
<i class="fa fa-plus"></i>
<span>选择</span>
</a>
</script>
<script type="text/javascript">
    $().ready(function() {

        try {
// chosen带搜索的select框
            $('.chosen-select').chosen();
        } catch (e) {
// console.warn("初始化“chosen”发生错误：" + e);
        }

        var container = $("#goodspicker_{{ $page_id }}");
        var goodspicker = $.goodspicker(container);


        var show_selected = null;
        var goods_status = 1;
        var tablelist = $(container).find("#table_list").tablelist({
            url: "/goods/default/picker",
            method: "POST",
            page_id: "#{{ $pagination_id }}",
            // 提交数据前处理数据
            dataCallback: function(data) {
                if ($.goodspicker(container)) {
                    var goodspicker = $.goodspicker(container);
                    if ("0" == 1) {
                        delete data.goods_ids;
                        data.sku_ids = goodspicker.sku_ids;
                        if($.isArray(data.sku_ids)){
                            data.sku_ids = data.sku_ids.join(",");
                        }
                    } else {
                        delete data.sku_ids;
                        data.goods_ids = goodspicker.goods_ids;
                        if($.isArray(data.goods_ids)){
                            data.goods_ids = data.goods_ids.join(",");
                        }
                    }
                    if (goods_status == null) {
                        delete data.goods_status;
                    } else {
                        data.goods_status = goods_status;
                    }
                    if (show_selected == null) {
                        delete data.show_selected;
                    } else {
                        data.show_selected = show_selected;
                    }
                    data.brand_id = $(container).find("#brand_id").val();
                    data.cat_id = $(container).find("#cat_id").val();
                    if($(container).find("#shop_id").length > 0){
                        data.shop_id = $(container).find("#shop_id").val();
                    }
                    data.keyword = $(container).find(".search-condition").find("[name='keyword']").val();
// 供货商
                    data.is_supply = goodspicker.data.is_supply;
//审核
                    data.goods_audit = goodspicker.data.goods_audit;
                }
                data.is_sku = "0";
                return data;
            },
            callback: function(result) {
                if (result.data.values) {
                    goodspicker.values = result.data.values;
                    goodspicker.refreshSelectedData();
                }
            }
        });
        $(container).find(".goods-status").click(function() {
            goods_status = $(this).data("goods-status");
            show_selected = null;
            tablelist.load();
            $(".tab").find("li").removeClass("active");
            $(this).parents("li").addClass("active");

        });

        $(container).find(".is-selected").click(function() {
            goods_status = null;
            show_selected = 1;
            tablelist.load();
            $(".tab").find("li").removeClass("active");
            $(this).parents("li").addClass("active");
        });

// 点击搜索按钮
        $(container).find(".btn-submit").click(function() {
            tablelist.page.cur_page = 1;
            tablelist.load();
        });

// 全部取消
        $(container).find(".unselectall").click(function(){
// 渲染页面
            var values = goodspicker.values;
            for (key in values) {
                var sku_id = values[key].sku_id;
                var goods_id = values[key].goods_id;
                goodspicker.render(false, goods_id, sku_id);
            }
// 清空数据
            goodspicker.values = [];
            goodspicker.refreshSelectedData();
            $(".group-buy-goods").find("#goods_list").find("table").remove();
            $(".limit-discount-goods").find("#goods_list").find("table").remove();
            $(".goods-mix-goods").find("#goods_list").find("table").remove();

            if($.isFunction(goodspicker.removeAll)){
                goodspicker.removeAll.call(goodspicker);
            }
        });

// 本页全选
        $(container).find(".selectall-page").click(function(){
            $(container).find(".btn-goodspicker").each(function(){
                if($(this).data("selected") == false){
                    $(this).click();
                }
            });
        });


        $("body").on("click", ".choose-goods-close", function() {
            var container = $(".goods-picker-container");
            $(container).hide();
        });
    });
</script>