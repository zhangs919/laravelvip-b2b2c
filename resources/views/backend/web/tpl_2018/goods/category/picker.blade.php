<div class="goods-info-one" id="{{ $page_id }}">
    <div class="choose-category m-b-10">
        <div class="final-catgory">
            <dl>
                <dd>
                    <span class="fb">您当前选择的是：</span>
                    <span id="current-choose-category"></span>
                    <span>
                        <a href="javascript:void(0);" class="select-category btn-link p-l-10 hide">选择</a>
                    </span>
                </dd>
            </dl>
        </div>
        <div class="choose-category-list">
            <div class="grade-category-list">
                <div class="category-list">
                    <div class="category-info-search">
                        <i class="fa fa-search"></i>
                        <input type="text" name="category_search" data-level="1" class="form-control p-l-20 w200" placeholder="输入名称/拼音首字母">
                    </div>
                    <ul class="category-list-name category-level-1">

                        @foreach($list as $v)
                        <li class="">
                            <a href="javascript:void(0)" class="category-name" data-is-parent="1" data-search="{{--文学 wx wenxue--}}" data-id="{{ $v->cat_id }}" data-name="{{ $v->cat_name }}" data-level="{{ $v->cat_level }}">
                                <i class="fa fa-angle-right"></i>
                                {{ $v->cat_name }}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <div class="choose-category-list">
            <div class="grade-category-list">
                <div class="category-list category-list-two">
                    <div class="category-info-search">
                        <i class="fa fa-search"></i>
                        <input type="text" name="category_search" data-level="2" class="form-control p-l-20 w200" placeholder="输入名称/拼音首字母">
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
                        <input name="category_search" data-level="3" class="form-control p-l-20 w200" type="text" placeholder="输入名称/拼音首字母">
                    </div>
                    <ul class="category-list-name category-level-3">

                    </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <input type="hidden" id="choose_cat_name" value="">
    <input type="hidden" id="choose_cat_id" value="">
</div>
<script type='text/javascript'>
    $().ready(function() {
//滚动条
//$(".choose-category-list ul.category-list-name").mCustomScrollbar();

// 单击分类名称事件
        $("#{{ $page_id }}").on("click", ".category-name", function() {
            var cat_id = $(this).data("id");
            var is_parent = $(this).data("is-parent");
            var cat_level = $(this).data("level");

            $("#{{ $page_id }}").find('#choose_cat_name').val($(this).data("name"));
            $("#{{ $page_id }}").find('#choose_cat_id').val($(this).data("id"));
            $("#{{ $page_id }}").find('.select-category').removeClass('hide');

            $("#{{ $page_id }}").find(".category-level-" + cat_level).find(".classDivClick").removeClass("classDivClick");
            $(this).addClass("classDivClick");

// 取消已经选择的内容
            for (var i = 3; i > cat_level; i--) {
                $("#{{ $page_id }}").find(".category-level-" + i).html("");
            }

            if (is_parent == 1) {

                $.loading.start();

                $.get('/goods/category/picker', {
                    id: cat_id
                }, function(result) {
                    $.loading.stop();
                    $("#{{ $page_id }}").find(".category-level-" + (cat_level + 1)).html(result.data);
                }, 'json');
            }

// 改变当前选择的分类内容
            for (var i = 0; i < 3; i++) {
                var text = $("#{{ $page_id }}").find(".classDivClick").eq(i).text();
                if (i == 0) {
                    $("#{{ $page_id }}").find("#current-choose-category").html(text);
                } else if (text) {
                    $("#{{ $page_id }}").find("#current-choose-category").append('<i class="fa fa-angle-right"></i>');
                    $("#{{ $page_id }}").find("#current-choose-category").append(text);
                }
            }
        });

// 搜索功能的实现
        $("#{{ $page_id }}").find("[name=category_search]").keyup(function() {
// 搜索内容
            var text = $(this).val();
// 绑定的级别
            var level = $(this).data("level");

            if (text == '') {
                $("#{{ $page_id }}").find(".category-level-" + level).find("li").show();
            } else {
                $("#{{ $page_id }}").find(".category-level-" + level).find("li").hide();
                $("#{{ $page_id }}").find(".category-level-" + level).find("[data-search*=" + text + "]").parents("li").show();
            }
        });
    });
</script>