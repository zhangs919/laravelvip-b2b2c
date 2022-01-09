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

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <div class="simple-form-field simple-form-search">
            <div class="form-group">
                <label class="control-label">
                    <i class="fa fa-search"></i>
                </label>
            </div>
        </div>
        <div class="simple-form-field">
            <div class="form-group">
                <label class="control-label">
                    <span>分类名称：</span>
                </label>
                <div class="form-control-wrap">
                    <div id="cat_selector">
                        {{--<div class="form-control-box">
                            <div class="tree-chosen-box">
                                <div class="tree-chosen-input-box form-control"></div>
                                <div class="tree-chosen-panel-box" style="display: none;"><input type="text"
                                                                                                 class="tree-chosen-input form-control-xs m-r-5"
                                                                                                 value=""
                                                                                                 placeholder="输入关键词、简拼、全拼搜索"
                                                                                                 style="width: 200px;"><a
                                            class="btn btn-primary btn-sm tree-chosen-btn-open m-r-2" title="全部展开/收起"><i
                                                class="fa fa-plus-circle" style="margin-right: 0px;"></i></a><a
                                            class="btn btn-primary btn-sm tree-chosen-btn-clear" title="全部清除所选"><i
                                                class="fa fa-trash-o" style="margin-right: 0px;"></i></a>
                                    <div class="ztree-box">
                                        <ul id="1518666672603000" class="ztree">
                                            <li id="1518666672603000_1" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_1_switch" title=""
                                                                  class="button level0 switch roots_close"
                                                                  treenode_switch=""></span><a id="1518666672603000_1_a"
                                                                                               class="level0"
                                                                                               treenode_a="" onclick=""
                                                                                               target="_blank" style=""
                                                                                               title="生鲜食品"><span
                                                            id="1518666672603000_1_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_1_span"
                                                            class="node_name">生鲜食品</span></a></li>
                                            <li id="1518666672603000_51" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_51_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_51_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="食品饮料"><span
                                                            id="1518666672603000_51_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_51_span" class="node_name">食品饮料</span></a>
                                            </li>
                                            <li id="1518666672603000_74" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_74_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_74_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="家用电器"><span
                                                            id="1518666672603000_74_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_74_span" class="node_name">家用电器</span></a>
                                            </li>
                                            <li id="1518666672603000_123" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_123_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_123_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="电脑办公"><span
                                                            id="1518666672603000_123_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_123_span" class="node_name">电脑办公</span></a>
                                            </li>
                                            <li id="1518666672603000_180" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_180_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_180_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="手机数码"><span
                                                            id="1518666672603000_180_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_180_span" class="node_name">手机数码</span></a>
                                            </li>
                                            <li id="1518666672603000_228" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_228_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_228_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="女装"><span
                                                            id="1518666672603000_228_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_228_span"
                                                            class="node_name">女装</span></a></li>
                                            <li id="1518666672603000_252" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_252_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_252_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="男装"><span
                                                            id="1518666672603000_252_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_252_span"
                                                            class="node_name">男装</span></a></li>
                                            <li id="1518666672603000_280" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_280_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_280_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="个护化妆"><span
                                                            id="1518666672603000_280_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_280_span" class="node_name">个护化妆</span></a>
                                            </li>
                                            <li id="1518666672603000_313" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_313_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_313_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="箱包鞋帽"><span
                                                            id="1518666672603000_313_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_313_span" class="node_name">箱包鞋帽</span></a>
                                            </li>
                                            <li id="1518666672603000_338" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_338_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_338_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="童装童鞋"><span
                                                            id="1518666672603000_338_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_338_span" class="node_name">童装童鞋</span></a>
                                            </li>
                                            <li id="1518666672603000_356" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_356_switch" title=""
                                                                  class="button level0 switch center_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_356_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="酒水"><span
                                                            id="1518666672603000_356_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_356_span"
                                                            class="node_name">酒水</span></a></li>
                                            <li id="1518666672603000_367" class="level0" tabindex="0" hidefocus="true"
                                                treenode=""><span id="1518666672603000_367_switch" title=""
                                                                  class="button level0 switch bottom_close"
                                                                  treenode_switch=""></span><a
                                                        id="1518666672603000_367_a" class="level0" treenode_a=""
                                                        onclick="" target="_blank" style="" title="家居家装"><span
                                                            id="1518666672603000_367_ico" title="" treenode_ico=""
                                                            class="button ico_close" style=""></span><span
                                                            id="1518666672603000_367_span" class="node_name">家居家装</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                    <input type="hidden" id="cat_id" name="cat_id" class="form-control">
                    <input type="hidden" id="cat_name" name="cat_name" class="form-control">
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <input type="button" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">

            <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出">

        </div>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>商品分类列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true"></span>
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

    {{--引入分类列表--}}
    @include('goods.category.partials._list')

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
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/table/jquery.treetable.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/table/css/jquery.treetable.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/js/table/css/jquery.treetable.theme.default.css?v=1.2">
    <script type="text/javascript">
        var catselector = $("#cat_selector").catselector({
            size: 1,
            data: {
                deep: 3
            },
            addCallback: function(id, name, node) {
                this.hide();
                $("#cat_id").val(id);
                $("#btn_submit").click();
            },
            removeCallback: function(id) {
                this.hide();
                $("#cat_id").val("");
                if ($("#cat_id").val() == "") {
                    $("#btn_submit").click();
                }
            }
        });

        function expandAll() {
            if ($(this).data("expandAll")) {
                $(".treetable").treetable("collapseAll");
                $(this).data("expandAll", false);
            } else {
                $(".treetable").treetable("expandAll");
                $(this).data("expandAll", true);
            }

        }

        function edit($cat_id) {
            top.$.open({
                type: 2,
                area: ['900px', '700px'],
                content: "/goods/category/edit?id=" + $cat_id
            });
        }

        var tablelist = null;

        function switch_callback(result, object, value) {
            if (result.code == 0) {
                var cat_ids = result.cat_ids;
                if ($.isArray(cat_ids)) {
                    for (var i = 1; i < cat_ids.length; i++) {
                        var target = $("#cat_" + cat_ids[i]).find(".ico-switch");
                        tablelist.changeSwitch(target, value);
                    }
                }
            }
        }

        $().ready(function() {

            $("[data-toggle='popover']").popover();

            $(".treetable").treetable({
                expandable: true,
            });

            tablelist = $("#table_list").tablelist({
                callback: function() {
                    $(".treetable").treetable({
                        expandable: true,
                    });
                }
            });

            catselector.load();

            $("#btn_submit").click(function() {
                tablelist.load({
                    'cat_id': $("#cat_id").val(),
                    'cat_name': $("#cat_name").val(),
                });
                return false;
            });

            // 删除记录
            $("body").on('click', '.del', function() {
                var goods_count = $(this).data("goods-count");
                var cat_name = $(this).data("cat-name");

                var message;

                if (!isNaN(goods_count) && goods_count > 0) {
                    message = "商品分类【" + cat_name + "】下存在商品，删除后这些商品将自动下架，需要重新编辑商品的分类后才能够上架销售，会为店铺经营带来一定影响，请您删除前通知相关店铺以免对商城造成不必要的影响，您确定仍然要删除此分类吗？";
                } else {
                    message = "您确定要删除分类【" + cat_name + "】吗？";
                }

                var id = $(this).data("object-id");

                $.confirm(message, function() {
                    $.post('/goods/category/delete', {
                        id: id
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            if (result.parent_id == 0) {
                                $.loading.start();
                                $.go('/goods/category/list');
                            } else {
                                tablelist.load();
                            }

                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "JSON");
                });

            });

            // 转移分类
            $("body").on('click', '.move-cat', function() {
                var cat_id = $(this).attr("cat_id");
                var cat_level = $(this).attr("cat_level");

                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    if (cat_level == 2) {
                        $.modal({
                            // 标题
                            title: '转移分类',
                            width: 600,
                            trigger: $(this),
                            // ajax加载的设置
                            ajax: {
                                url: '/goods/category/move-cat',
                                data: {
                                    cat_id: cat_id
                                }
                            },
                        });
                    }

                    if (cat_level == 3) {
                        $.modal({
                            // 标题
                            title: '转移分类',
                            width: 600,
                            trigger: $(this),
                            // ajax加载的设置
                            ajax: {
                                url: '/goods/category/move-cat',
                                data: {
                                    cat_id: cat_id
                                }
                            },
                        });
                    }

                }
            });

            $("body").on("click", ".upload-img", function() {
                var image = $(this).siblings("a");
                var span = $(this);
                $.imageupload({
                    url: $(this).data("url"),
                    data: {
                        id: $(this).data("id")
                    },
                    callback: function(result) {
                        if (result.code == 0) {
                            $(image).attr("ref", result.data.url);
                            $(span).html("更换");
                            $(span).attr("class", "btn btn-success btn-xs pos-r upload-img");
                            $.msg(result.message, {
                                time: 2000
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                });
            });

        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $("input[name=cat_name]").focus();
            //条形码扫描触发事件
            $("input[type=text]").bind("keypress", function(event) {
                if (event.keyCode == "13") {
                    $("#btn_submit").click();
                }
            });

            $("#btn_export").click(function() {
                var url = "/goods/category/export?cat_id=" + $("#cat_id").val();
                $.go(url, null, false);
            });
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".cat_sort").editable({
                type: "text",
                url: "/goods/category/edit-category",
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.cat_id = $(this).data("cat_id");
                    params.title = 'cat_sort';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '排序不能为空。';
                    } else if (!ex.test(value)) {
                        return '排序必须是0~255的正整数。';
                    } else if (value > 255) {
                        return '排序必须是0~255的正整数。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });
        });

        $(".take_rate").editable({
            type: "text",
            url: "/goods/category/edit-category",
            pk: 1,
            ajaxOptions: {
                type: "post"
            },
            params: function(params) {
                params.cat_id = $(this).data("cat_id");
                params.title = 'take_rate';
                return params;
            },
            success: function(response, newValue) {
                var response = eval('(' + response + ')');
                // 错误处理
                if (response.code == -1) {
                    return response.message;
                }
            },
            display: function(value, sourceData) {
                value = value.replace("%", "");
                // 保留两位小数
                $(this).html((Number(value)).toFixed(2) + "%");
            }
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop