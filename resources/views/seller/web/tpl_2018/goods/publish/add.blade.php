{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2"/>
@stop

{{--content--}}
@section('content')

    <div class="table-content">
        <!--步骤-->
        <ul class="add-goods-step">
            <li id="step_1">
                <i class="fa fa-list-alt step"></i>
                <h6>STEP.1</h6>
                <h2>选择商品分类</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_2">
                <i class="fa fa-edit step"></i>
                <h6>STEP.2</h6>
                <h2>填写商品详情</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_3">
                <i class="fa fa-image step"></i>
                <h6>STEP.3</h6>
                <h2>上传商品图片</h2>
                <i class="fa fa-angle-right"></i>
            </li>
            <li id="step_4">
                <i class="fa fa-check-square-o step"></i>
                <h6>STEP.4</h6>
                <h2>商品发布成功</h2>
            </li>
        </ul>
        <script type="text/javascript">
            $().ready(function(){
                $("#step_1").addClass("current");
            });
        </script>
        <!-- 搜索 -->
        <div class="content">
            <div class="category-search">
                <form id="searchForm" name="searchForm" action="">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label class="control-label">
                                <span>商品分类搜索：</span>
                            </label>
                            <div class="form-control-wrap">
                                <input id="cat_name" name="cat_name" class="form-control" type="text" placeholder="分类名称">
                            </div>
                        </div>
                    </div>
                    <div class="simple-form-field m-l-10">
                        <button id="btn_search" class="btn btn-primary">快速查找</button>
                    </div>
                </form>

                <!-- 当没有最近使用分类的时候，以下内容可隐藏 -->
                <div class="clear"></div>
                <div class="simple-form-field m-t-10">
                    <div class="form-group">
                        <label class="control-label">
                            <span>最近使用的分类：</span>
                        </label>
                        <div class="form-control-wrap">
                            <select id="used_cat_list" class="form-control chosen-select">
                                <option value="0">--请选择--</option>



                                <option value="343" class="category-name" data-cat-ids="271,307,343" data-type="1" data-search="true" data-id="343" data-is-parent="0" data-search="贝  bei" data-level="3">生鲜食品&nbsp;>>&nbsp;海鲜水产&nbsp;>>&nbsp;贝</option>

                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 选择区域 -->
            <div class="goods-info-one">
                <div class="choose-category">
                    <div class="final-catgory">
                        <dl>
                            <dt>您当前选择的是：</dt>
                            <dd id="current-choose-category"></dd>
                        </dl>
                    </div>
                    <div class="choose-category-list">
                        <div class="grade-category-list">
                            <div class="category-list">
                                <div class="category-info-search">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="category_search" data-level="1" class="form-control" placeholder="输入名称/拼音首字母">
                                </div>
                                <ul class="category-list-name category-level-1">

                                    {{--引入分类列表--}}
                                    @include('goods.publish.partials._cat_list')

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="choose-category-list">
                        <div class="grade-category-list">
                            <div class="category-list category-list-two">
                                <div class="category-info-search">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="category_search" data-level="2" class="form-control" placeholder="输入名称/拼音首字母">
                                </div>
                                <ul class="category-list-name category-level-2">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="choose-category-list choose-category-list-last">
                        <div class="grade-category-list">
                            <div class="category-list category-list-two">
                                <div class="category-info-search">
                                    <i class="fa fa-search"></i>
                                    <input name="category_search" data-level="3" class="form-control" type="text" placeholder="输入名称/拼音首字母">
                                </div>
                                <ul class="category-list-name category-level-3">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="choose-category-search-list" style="display: none;"></div>
            </div>


            @if(!empty($id))
                <form id="catForm" action="/goods/publish/edit" method="GET">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="hidden" id="cat_id" name="cat_id" value="" />
                    <div class="goods-next p-b-30 text-c p-l-0">
                        <button id="btn_next_step" class="btn disabled" disabled="disabled">下一步，填写商品信息</button>
                    </div>
                </form>
            @else
                <form id="catForm" action="/goods/publish/index" method="GET">
                    <input type="hidden" id="cat_id" name="cat_id" value="" />
                    <div class="goods-next p-b-30 text-c p-l-0">
                        <button id="btn_next_step" class="btn disabled" disabled="disabled">下一步，填写商品信息</button>
                    </div>
                </form>
            @endif
        </div>
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

    <script type='text/javascript'>
        $().ready(function() {

            function scrollTo(container, target) {
                //动画效果
                $(container).scrollTop($(target).offset().top - $(container).offset().top + $(container).scrollTop());
            }

            //滚动条
            $("body").on("click", ".choose-category-search-close", function() {
                $(".choose-category").show();
                $(".choose-category-search-list").hide();

                $("#btn_next_step").prop("disabled", true);
                $("#btn_next_step").addClass("btn-primary").addClass('disabled');

                $("#cat_id").val("");
                $("#cat_id").data(undefined);
            });

            // 搜索
            $("#btn_search").click(function() {
                var cat_name = $("#searchForm").find("#cat_name").val();

                if ($.trim(cat_name) == "") {
                    $.msg("请输入商品分类名称！");
                    $("#searchForm").find("#cat_name").focus();
                    return false;
                }

                $("#btn_next_step").prop("disabled", true);
                $("#btn_next_step").addClass("btn-primary").addClass('disabled');

                $("#cat_id").val("");
                $("#cat_id").data(undefined);

                $.loading.start();

                $.get("/goods/publish/cat-search", {
                    cat_name: cat_name
                }, function(result) {
                    if (result.code == 0) {
                        $(".choose-category-search-list").html(result.data);
                        $(".choose-category").hide();
                        $(".choose-category-search-list").show();
                    } else {
                        $.msg(result.message, {
                            time: 3000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });

                return false;
            });

            // 双击
            $("body").on("dblclick", ".category-search-item", function() {
                var cat_id = $(this).data("id");
                var is_parent = $(this).data("is-parent");
                var cat_level = $(this).data("level");
                var cat_ids = $(this).data("cat-ids") + "";

                if (is_parent == 1) {
                    $(".choose-category").show();
                    $(".choose-category-search-list").hide();
                    cat_level = 1;
                    cat_ids = cat_ids.split(",");
                    cat_id = cat_ids[0];

                    var container = $(".category-level-" + cat_level);
                    var target = $(container).find(".category-name[data-id='" + cat_id + "']");
                    // 触发点击
                    $(target).trigger("click", [cat_ids]);
                    // 滚动定位
                    scrollTo(container, target);
                } else {
                    $("#btn_next_step").prop("disabled", false);
                    $("#btn_next_step").addClass("btn-primary").removeClass('disabled');
                    $("#cat_id").val(cat_id);
                    $("#catForm").submit();
                }

                return false;
            });

            // 单击分类名称事件
            $("body").on("click", ".category-name", function(event, cat_ids) {

                var cat_id = $(this).data("id");
                var is_parent = $(this).data("is-parent");
                var cat_level = $(this).data("level");

                if (cat_ids == undefined || cat_ids == null) {
                    cat_ids = $(this).data("cat-ids");
                } else if ($.isArray(cat_ids) == false) {
                    cat_ids = cat_ids + "";
                }

                var type = $(this).data("type");

                // type
                // 0-默认点击
                // 1-搜索
                // 2-历史
                if (type == 0) {
                    $(this).parents("ul").find(".selected").removeClass("selected");
                    $(this).addClass("selected");

                    $("#btn_next_step").prop("disabled", false);
                    $("#btn_next_step").addClass("btn-primary").removeClass('disabled');

                    $("#cat_id").val(cat_id);
                    $("#cat_id").data($(this).data());

                    return;
                } else if (type == 1) {

                    $(".choose-category").show();
                    $(".choose-category-search-list").hide();

                    if (typeof cat_ids == 'number') {
                        cat_ids = new String(cat_ids);
                    }

                    cat_level = 1;
                    cat_ids = cat_ids.split(",");
                    if (cat_ids.length > 1) {
                        is_parent = 1;
                    }
                    cat_id = cat_ids[0];

                    $(".category-level-" + cat_level).find(".classDivClick").removeClass("classDivClick");
                    $(".category-level-" + cat_level).find(".category-name[data-id='" + cat_id + "']").addClass("classDivClick");
                } else {
                    $(".category-level-" + cat_level).find(".classDivClick").removeClass("classDivClick");
                    $(this).addClass("classDivClick");
                }

                if (type > 0 && cat_level && cat_id) {
                    var container = $(".category-level-" + cat_level);
                    var target = $(container).find(".category-name[data-id='" + cat_id + "']");
                    // 滚动定位
                    scrollTo(container, target);
                }

                // 取消已经选择的内容
                for (var i = 3; i > cat_level; i--) {
                    $(".category-level-" + i).html("");
                }

                if (is_parent == 1) {

                    $("#btn_next_step").prop("disabled", true);
                    $("#btn_next_step").addClass("disabled").removeClass('btn-primary');
                    $("#cat_id").val("");

                    var data = $(document).data("cat_data_" + cat_id);

                    if (data) {
                        $.loading.start();

                        $(".category-level-" + (cat_level + 1)).html(data);

                        if (cat_ids != undefined) {
                            cat_id = cat_ids[cat_level];
                            if (cat_id != undefined) {
                                var container = $(".category-level-" + (cat_level + 1));
                                var target = $(container).find(".category-name[data-id='" + cat_id + "']");
                                // 触发点击
                                $(target).trigger("click", [cat_ids]);
                                // 滚动定位
                                scrollTo(container, target);
                            }
                        }

                        $.loading.stop();
                    } else {
                        $.loading.start();

                        $.get('/goods/publish/cat-list', {
                            id: cat_id
                        }, function(result) {
                            $(".category-level-" + (cat_level + 1)).html(result);
                            // 缓存
                            $(document).data("cat_data_" + cat_id, result);

                            if (cat_ids != undefined) {
                                cat_id = cat_ids[cat_level];
                                if (cat_id != undefined) {
                                    var container = $(".category-level-" + (cat_level + 1));
                                    var target = $(container).find(".category-name[data-id='" + cat_id + "']");
                                    // 触发点击
                                    $(target).trigger("click", [cat_ids]);
                                    // 滚动定位
                                    scrollTo(container, target);
                                }
                            }

                        }).always(function() {
                            $.loading.stop();
                        });
                    }
                } else {
                    $("#btn_next_step").prop("disabled", false);
                    $("#btn_next_step").addClass("btn-primary").removeClass('disabled');
                    $("#cat_id").val($(this).data("id"));

                    $("#cat_id").data($(this).data());
                }

                // 改变当前选择的分类内容
                var cat_names = [];
                var cat_id = null;

                $(".choose-category-list").find(".classDivClick").each(function() {
                    cat_names.push($(this).text());
                    if ($(this).data("is-parent") == 0) {
                        cat_id = $(this).data("id");
                    }
                });

                cat_names = cat_names.join('<i class="fa fa-angle-right"></i>');

                $("#current-choose-category").data("cat_id", cat_id);
                $("#current-choose-category").html(cat_names);
            });

            // 搜索功能的实现
            $("[name=category_search]").keyup(function() {
                // 搜索内容
                var text = $(this).val();
                // 绑定的级别
                var level = $(this).data("level");

                if (text == '') {
                    $(".category-level-" + level).find("li").show();
                } else {
                    $(".category-level-" + level).find("li").hide();
                    $(".category-level-" + level).find("[data-search*=" + text + "]").parents("li").show();
                }
            });

            $("#used_cat_list").change(function() {
                $(this).find("option:selected").click();
            })

            //点击下一步
            $("#btn_next_step").click(function() {

                var target = $("#cat_id");

                var cat_id = $(target).data("id");
                var is_parent = $(target).data("is-parent");
                var cat_level = $(target).data("level");
                var cat_ids = $(target).data("cat-ids") + "";

                if (is_parent == 1) {
                    $(".choose-category").show();
                    $(".choose-category-search-list").hide();
                    cat_level = 1;
                    cat_ids = cat_ids.split(",");
                    cat_id = cat_ids[0];

                    var container = $(".category-level-" + cat_level);
                    var target = $(container).find(".category-name[data-id='" + cat_id + "']");
                    // 触发点击
                    $(target).trigger("click", [cat_ids]);
                    // 滚动定位
                    scrollTo(container, target);
                } else {
                    if ($("#cat_id").val() == "") {
                        $("#cat_id").val(cat_id);
                    }

                    if ($("#cat_id").val() == "") {
                        $("#cat_id").val($("#current-choose-category").data("cat_id"));
                    }

                    if ($("#cat_id").val() == "") {
                        $.msg("请选择分类！");
                    }

                    $("#catForm").submit();
                }

                return false;
            });
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop