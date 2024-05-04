<link href="/assets/d2eace91/js/ztree/zTreeStyle.css?v=2.1" rel="stylesheet">
<div id="goodspicker_{{ $page_id }}" data-is_join='1' class="simple-form-field">
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
                                <div id="site_category_container_{{ $page_id }}" class="cat-container"></div>
                                <input type="hidden" id="cat_ids" value=""/>
                            </div>
                        </div>
                        <div class="search-condition-field">
                            <span class="search-condition-label">选择标签：</span>
                            <div class="search-condition-wrap">
                                <span id="goods_tag_span">
                                    <select id="tag_id" class="form-control chosen-select m-l-2" multiple="multiple"
                                            size="4">
                                        <option value="1">左上角</option>
                                        <option value="2">右上角</option>
                                        <option value="3">左下角</option>
                                        <option value="4">右下角</option>
                                        <option value="5">中间</option>
                                        <option value="6">自定义</option>
                                        <option value="9">标签2</option>
                                        <option value="10">123</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="search-condition-field">
                            <span class="search-condition-label">选择活动：</span>
                            <div class="search-condition-wrap"><select id="activity_type"
                                                                       class="form-control chosen-select m-l-2"
                                                                       multiple="multiple" size="4" placeholder="按活动选择">
                                    <option value="3">团购</option>
                                    <option value="2">预售</option>
                                    <option value="6">拼团</option>
                                    <option value="8">砍价</option>
                                    <option value="11">限时折扣</option>
                                    <option value="14">直播</option>
                                    <option value="15">限购</option>
                                    <option value="21">第"2"件半价</option>
                                    <option value="12">满减送</option>
                                    <option value="is_virtual">虚拟商品</option>
                                </select></div>
                        </div>
                        <select id="brand_id" class="form-control chosen-select m-l-2">
                            <option value="">按品牌选择商品</option>
                            @foreach($brand_list as $v)
                                <option value="{{ $v->brand_id }}">{{ $v->brand_name }}</option>
                            @endforeach
                        </select>
                        <select id="shop_cat_id" class="form-control chosen-select m-l-2">
                            <option value="">按店铺商品分类</option>
                            @foreach($shop_cat_list as $v)
                                @if($v['cat_level'] == 1)
                                    <option value="{{ $v['cat_id'] }}"><span>◢</span>&nbsp;{{ $v['cat_name'] }}</option>
                                @elseif($v['cat_level'] == 2)
                                    <option value="{{ $v['cat_id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $v['cat_name'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="text" name="keyword" class="form-control w150 m-l-2 m-r-2" placeholder="商品名称/条形码">
                        <select id="is_stock" class="form-control chosen-select m-l-2">
                            <option value="">按库存选择</option>
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
                @include('dashboard.multi-store.partials._picker_goods_list')
            </div>
        </div>
    </div>
</div>
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
<style type="text/css">
    .tree-chosen-input-box {
        width: 100% !important;
        max-width: 100%;
        display: block;
    }

    .cat-container .form-control-box {
        width: 100% !important;
    }
</style>
<script type="text/javascript">
    // 
</script>
<script src="/assets/d2eace91/js/jquery.json-2.4.js?v=2.1"></script>
<script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=2.1"></script>
<script>

    $().ready(function () {

        var container = $("#goodspicker_{{ $page_id }}");
        var goodspicker = $.goodspicker(container);

        var catselector = $("#site_category_container_{{ $page_id }}").catselector({
            size: 0,
            data: {
                deep: 3
            },
            values: [],
            addCallback: function (id, name, node) {

            },
            removeCallback: function (id) {
                this.hide();
            },
            change: function () {
                $(container).find("#cat_ids").val(this.getValues().join(","));
            }
        });
        catselector.load();

        try {
// chosen带搜索的select框
            $('.chosen-select').chosen();
        } catch (e) {
// console.warn("初始化“chosen”发生错误：" + e);
        }


        var show_selected = null;
        var goods_status = 1;
        var tablelist = $(container).find("#table_list").tablelist({
            url: "picker",
            method: "POST",
            page_id: "#{{ $pagination_id }}",
// 提交数据前处理数据
            dataCallback: function (data) {
                if ($.goodspicker(container)) {
                    var goodspicker = $.goodspicker(container);
                    if ("0" == 1) {
                        delete data.goods_ids;
                        data.sku_ids = goodspicker.sku_ids;
                        if ($.isArray(data.sku_ids)) {
                            data.sku_ids = data.sku_ids.join(",");
                        }
                    } else {
                        delete data.sku_ids;
                        data.goods_ids = goodspicker.goods_ids;
                        if ($.isArray(data.goods_ids)) {
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
                    data.shop_cat_id = $(container).find("#shop_cat_id").val();
                    data.cat_id = $(container).find("#cat_id").val();
                    data.cat_ids = $(container).find("#cat_ids").val();
                    if ($(container).find("#shop_id").length > 0) {
                        data.shop_id = $(container).find("#shop_id").val();
                    }
                    data.keyword = $(container).find(".search-condition").find("[name='keyword']").val();
// 供货商
                    data.is_supply = goodspicker.data.is_supply;
//审核
                    data.goods_audit = goodspicker.data.goods_audit;
//多门店是否显示店铺商品
                    data.show_seller_goods = goodspicker.data.show_seller_goods;

                    data.tag_id = $(container).find("#tag_id").val();
                    data.activity_type = $(container).find("#activity_type").val();
                    data.is_stock = $(container).find("#is_stock").val();
                    data.is_join = $(container).data('is_join');
                }
                data.is_sku = "0";
                data.comstore_group_id = "0";
                return data;
            },
            callback: function (result) {
                if (result.code == 0) {
                    if (result.data.values) {
                        goodspicker.values = result.data.values;
                        goodspicker.refreshSelectedData();
                    }
                } else {
                    $.msg(result.message);
                }
            }
        });
        $(container).find(".goods-status").click(function () {
            goods_status = $(this).data("goods-status");
            show_selected = null;
            tablelist.load();
            $(container).find(".tab").find("li").removeClass("active");
            $(this).parents("li").addClass("active");
            $(container).find('.excel-upload-div').addClass('hide');
            $(container).find('#table_list,.search-condition').removeClass('hide');
        });

        $(container).find(".is-selected").click(function () {
            goods_status = null;
            show_selected = 1;
            tablelist.load();
            $(container).find(".tab").find("li").removeClass("active");
            $(this).parents("li").addClass("active");
            $(container).find('.excel-upload-div').addClass('hide');
            $(container).find('#table_list,.search-condition').removeClass('hide');
        });

        $(container).find(".excel-upload").click(function () {
            $(container).find(".tab").find("li").removeClass("active");
            $(this).parents("li").addClass("active");
            $(container).find('.excel-upload-div').removeClass('hide');
            $(container).find('#table_list,.search-condition').addClass('hide');
        });

//下载结果

        $(container).find(".btn_download").click(function () {

            var filepath = $(container).find(".filepath").html();
            var index1 = filepath.lastIndexOf(".");
            var index2 = filepath.length;
            var suffix = filepath.substring(index1 + 1, index2);

            if ($(container).find('input[name="excel-upload-{{ $page_id }}"]').val() == '') {
                $.msg('请上传文件！');
                return false;
            } else if (suffix != 'xls' && suffix != 'xlsx') {
                $.msg('请上传excel格式文件！');
                return false;
            }

            $.loading.start();
            var formData = new FormData();
            formData.append("excel-upload", $(container).find('input[name="excel-upload-{{ $page_id }}"]')[0].files[0]);
            formData.append("is_download", '1');
            formData.append("act_id", '');
            formData.append("is_join", $(container).data('is_join'));

            $.ajax({
                url: 'batch-goods-excel.html',
                data: formData,
                type: "POST",
                cache: false,//上传文件无需缓存
                processData: false,//用于对data参数进行序列化处理 这里必须false
                contentType: false, //必须
                dataType: "JSON",
                success: function (result) {
// 停止加载
                    $.loading.stop();
                    if (result.code == 0) {
                        window.open("download-result.html?key=" + result.key);
                    } else {
//询问框
                        layer.confirm(result.message, {
                            btn: ['取消']
//按钮
                        });
                    }
                }
            });
        })

//上传excel
        $(container).find(".upl-excel").click(function () {

            var filepath = $(container).find(".filepath").html();
            var index1 = filepath.lastIndexOf(".");
            var index2 = filepath.length;
            var suffix = filepath.substring(index1 + 1, index2);

            if ($(container).find('input[name="excel-upload-{{ $page_id }}"]').val() == '') {
                $.msg('请上传文件！');
                return false;
            } else if (suffix != 'xls' && suffix != 'xlsx') {
                $.msg('请上传excel格式文件！');
                return false;
            }

            $.loading.start();
            var formData = new FormData();
            formData.append("excel-upload", $(container).find('input[name="excel-upload-{{ $page_id }}"]')[0].files[0]);
            formData.append("is_download", '0');
            formData.append("act_id", '');
            formData.append("is_join", $(container).data('is_join'));

            $.ajax({
                url: 'batch-goods-excel.html',
                data: formData,
                type: "POST",
                cache: false,//上传文件无需缓存
                processData: false,//用于对data参数进行序列化处理 这里必须false
                contentType: false, //必须
                dataType: "JSON",
                success: function (result) {
// 停止加载
                    $.loading.stop();

                    if (result.code == 0) {
                        $(container).find(".upload-message").html(result.message);
                        goodspicker.uploadExcelCallback(result.data, result.selects)
                    } else {
//询问框
                        layer.confirm(result.message, {
                            btn: ['取消']
//按钮
                        });
                    }
                }
            });

        });
        $(container).on("change", "input[name='excel-upload-{{ $page_id }}']", function () {
            $(container).find("#uploadmodel-file-error").hide();
            $(container).find(".filepath").html($("input[name='excel-upload-{{ $page_id }}']").val().split("\\").pop());
        });

// 点击搜索按钮
        $(container).find(".btn-submit").click(function () {
            tablelist.page.cur_page = 1;
            tablelist.load();
        });

// 全部取消
        $(container).find(".unselectall").click(function () {

            $.loading.start();

            setTimeout(function () {
                (new Promise(function (resolve, reject) {
                    resolve();
                })).then(function () {
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

                    if ($.isFunction(goodspicker.removeAll)) {
                        goodspicker.removeAll.call(goodspicker);
                    }
                }).then(function () {
                    $.loading.stop();
                });
            }, 500);
        });

// 本页全选
        $(container).find(".selectall-page").click(function () {
            $.loading.start();
            setTimeout(function () {
                (new Promise(function (resolve, reject) {
                    resolve();
                })).then(function () {
                    $(container).find(".btn-goodspicker").each(function () {
                        var target = this;
                        if ($(target).data("selected") == false) {
                            $(target).click();
                        }
                    });
                }).then(function () {
                    $.loading.stop();
                });
            }, 500);
        });


        $("body").on("click", ".choose-goods-close", function () {
            var container = $(".goods-picker-container");
            $(container).hide();
        });

        $('#shop_id').change(function () {
            var shop_id = $(this).val();
            $.get('/goods/default/goods-tag-list.html', {
                shop_id: shop_id
            }, function (result) {
                if (result.code == 0) {
                    $('#goods_tag_span').html(result.data);
                }
            }, 'json');
        });
    });

    // 
</script>