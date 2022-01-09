<div class="header">
    <div class="w1210">
        <div class="logo-info">
            <a href="/" class="logo">

                <img src="{{ get_image_url(sysconf('mall_logo')) }}" />

            </a>








            @if(!empty(sysconf('mall_logo_right_ad_image')) && !request()->routeIs('pc_cart_list'))
            <!-- logo右侧小广告 _start -->
            <a href="{{ sysconf('mall_logo_right_ad_url') }}" class="logo-right">
                <img src="{{ get_image_url(sysconf('mall_logo_right_ad_image')) }}" />
            </a>
            <!-- logo右侧小广告 _end -->
            @endif


        </div>
        <div class="search SZY-SEARCH-BOX">
            <form class="search-form SZY-SEARCH-BOX-FORM" method="get" action="/search.html">
                <div class="search-info">
                    <div class="search-type-box">
                        <ul class="search-type" style="display: none;">
                            @if(request('type',0) == 0)
                                <li class="search-li curr" num="0">宝贝</li>
                                <li class="search-li" num="1">店铺</li>
                                @else
                                <li class="search-li curr" num="1">店铺</li>
                                <li class="search-li" num="0">宝贝</li>
                            @endif

                        </ul>
                        <i></i>
                    </div>
                    <div class="search-box">
                        <div class="search-box-con">
                            <input type="text" class="keyword search-box-input SZY-SEARCH-BOX-KEYWORD" name="keyword" tabindex="9" autocomplete="off" data-searchwords="" placeholder="" value="" />
                        </div>
                    </div>
                    <input type='hidden' id="searchtype" name='type' value="0" class="searchtype" />
                    <input type="button" id="btn_search_box_submit" value="搜索" class="button bg-color btn_search_box_submit SZY-SEARCH-BOX-SUBMIT" />
                </div>
                <!---热门搜索热搜词显示--->
                <div class="search-results hide SZY-SEARCH-BOX-HELPER">
                    <ul class="history-results SZY-SEARCH-RECORDS">
                        <li class="title">
                            <span>最近搜索</span>
                            <a href="javascript:void(0);" class="clear-history clear">
                                <i></i>
                                清空
                            </a>
                        </li>
                        <!--
                        <li class="active rec_over" id="索引">
                            <span>
                                <a href="/search.html?keyword=关键词" title="关键词">关键词</a>
                                <i onclick="search_box_remove('索引')"></i>
                            </span>
                        </li>
                        -->
                    </ul>
                    <ul class="rec-results SZY-HOT-SEARCH">
                        <li class="title">
                            <span>正在热搜中</span>
                            <i class="close"></i>
                        </li><li><a target="_blank" href="search.html?keyword=" title=""></a></li>
                        <!--
                        <li>
                            <a target="_blank" href="" title=""></a>
                        </li>
                         -->
                    </ul>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        // 搜索框提示显示
                        $('.SZY-SEARCH-BOX .SZY-SEARCH-BOX-KEYWORD').focus(function() {
                            $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-HELPER").show();
                        });
                        // 搜索框提示隐藏
                        $(".SZY-SEARCH-BOX-HELPER .close").on('click', function() {
                            $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-HELPER").hide();
                        });
                        // 清除记录
                        $(".SZY-SEARCH-BOX-HELPER .clear").click(function() {
                            var url = '/search/clear-record.html';
                            $.post(url, {}, function(result) {
                                if (result.code == 0) {
                                    $(".history-results .active").empty();
                                } else {
                                    $.msg(result.message);
                                }
                            }, 'json');
                        });
                    });
                    function search_box_remove(key) {
                        console.info(key);
                        var url = '/search/delete-record.html';
                        $.post(url, {
                            data: key
                        }, function(result) {
                            if (result.code == 0) {
                                $("#search_record_" + key).remove();
                            } else {
                                $.msg(result.message);
                            }
                        }, 'json');
                    }
                    $(document).on("click", function(e) {
                        var target = $(e.target);
                        if (target.closest(".SZY-SEARCH-BOX").length == 0) {
                            $('.SZY-SEARCH-BOX-HELPER').hide();
                        }
                    })
                </script>
            </form>
            <ul class="hot-query SZY-DEFAULT-SEARCH">
            </ul>
        </div>


        @if(!empty(sysconf('mall_search_right_ad_image')) && !request()->routeIs('pc_cart_list'))
        <!-- 搜索框右侧小广告 _start -->

        <div class="header-right">
            <a href="{{ sysconf('mall_search_right_ad_url') }}" target="_blank" title="">
                <img src="{{ get_image_url(sysconf('mall_search_right_ad_image')) }}" />
            </a>
        </div>

        <!-- 搜索框右侧小广告 _end -->
        @endif
    </div>
</div>

<script type="text/javascript">
    //解决因为缓存导致获取分类ID不正确问题，需在ready之前执行
    $(".SZY-DEFAULT-SEARCH").data("cat_id", "{{ $cat_id ?? '' }}");
    $().ready(function() {
        $(".SZY-SEARCH-BOX-KEYWORD").val("{{ request('keyword', '') }}");
        $(".SZY-SEARCH-BOX-KEYWORD").data("search_type", "{{ request('search_type', 0) }}");
        //

        $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-SUBMIT").click(function() {
            if ($(".search-li.curr").attr('num') == 0) {
                var keyword_obj = $(this).parents(".SZY-SEARCH-BOX").find(".SZY-SEARCH-BOX-KEYWORD");
                var keywords = $(keyword_obj).val();
                if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入要搜索的关键词") {
                    keywords = $(keyword_obj).data("searchwords");
                }
                $(keyword_obj).val(keywords);
            }
            $(this).parents(".SZY-SEARCH-BOX").find(".SZY-SEARCH-BOX-FORM").submit();
        });
    });
</script>