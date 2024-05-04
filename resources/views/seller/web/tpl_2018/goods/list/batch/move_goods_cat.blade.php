<div id='{{ $uuid }}'>
    <div class="table-content">
        <!-- 搜索 -->
        <div class="content">
            <!--
            <div class="category-search">
            <form action="javascript:searchGoods()" name="searchForm">
            <div class="simple-form-field">
            <div class="form-group">
            <label class="control-label">
            <span>商品分类搜索：</span>
            </label>
            <div class="form-control-wrap">
            <input name="" class="form-control" type="text" placeholder="分类名称/商品名称/货号">
            </div>
            </div>
            </div>
            <div class="simple-form-field m-l-10">
            <button class="btn btn-primary">搜索</button>
            </div>
            </form>
            </div>
            -->
            <!-- 选择区域 -->
            <div class="goods-info-one m-t-0">
                <div class="choose-category">
                    <div class="final-catgory m-t-0 m-b-5">
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
            </div>

            <input type="hidden" id="{{ $uuid }}-cat_id" name="cat_id" value="" />
            <input type="hidden" id="{{ $uuid }}-goods_ids" name="goods_ids" value="{{ $goods_ids }}" />
            <div class="goods-next p-l-0 text-c">
                <button id="btn_next_step" class="btn disabled" disabled="disabled">转移商品分类</button>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $().ready(function() {
//滚动条
//$(".choose-category-list ul.category-list-name").mCustomScrollbar();

// 单击分类名称事件
        $("#{{ $uuid }}").on("click", ".category-name", function() {
            var cat_id = $(this).data("id");
            var is_parent = $(this).data("is-parent");
            var cat_level = $(this).data("level");

            $(".category-level-" + cat_level).find(".classDivClick").removeClass("classDivClick");
            $(this).addClass("classDivClick");

// 取消已经选择的内容
            for (var i = 3; i > cat_level; i--) {
                $(".category-level-" + i).html("");
            }
            if (is_parent == 1) {

                $("#{{ $uuid }}").find("#btn_next_step").prop("disabled", true);
                $("#{{ $uuid }}").find("#btn_next_step").addClass("disabled").removeClass('btn-primary');
                $("#{{ $uuid }}").find("#{{ $uuid }}-cat_id").val("");

                $.loading.start();
                $.get('/goods/publish/cat-list', {
                    id: cat_id
                }, function(result) {
                    $.loading.stop();
                    $(".category-level-" + (cat_level + 1)).html(result);
                });
            } else {
                $("#{{ $uuid }}").find("#btn_next_step").removeProp("disabled");
                $("#{{ $uuid }}").find("#btn_next_step").removeClass('disabled');
                $("#{{ $uuid }}").find("#btn_next_step").addClass("btn-primary");

                $("#{{ $uuid }}").find("#{{ $uuid }}-cat_id").val($(this).data("id"));
            }

// 改变当前选择的分类内容
            for (var i = 0; i < 3; i++) {
                var text = $(".classDivClick").eq(i).text();
                if (i == 0) {
                    $("#{{ $uuid }}").find("#current-choose-category").html(text);
                } else if (text) {
                    $("#{{ $uuid }}").find("#current-choose-category").append('<i class="fa fa-angle-right"></i>');
                    $("#{{ $uuid }}").find("#current-choose-category").append(text);
                }
            }

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

//点击下一步
        $("#{{ $uuid }}").find("#btn_next_step").click(function() {
            var goods_ids = $("#{{ $uuid }}-goods_ids").val();
            var cat_id = $("#{{ $uuid }}-cat_id").val();
            $.post('/goods/list/move', {
                goods_ids: goods_ids,
                cat_id: cat_id
            }, function(result) {
                if (result.code == 0) {
// 关闭对话框
                    $("#{{ $uuid }}").parents(".modal").find(".close").click();
// 显示消息
                    $.msg(result.message, {
                        time: 1500
                    }, function(){
                        if (typeof (tablelist) != "undefined" && tablelist) {
                            tablelist.load();
                        } else {
                            $.go('/goods/list');
                        }
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json");

        });
    });
</script>