<!---->
<form id="searchForm" action="">
    <input name="tab" type="hidden" value="all_shop" />
    <input name="type" type="hidden" value="1" />
</form>
<!---->
<div class="collect-shop-box" id="table_list">

    @if(!empty($list))
    <ul class="collect-shop-list tablelist-append">

        @foreach($list as $v)
            <li class="shop-item" id="shop_item_{{ $v['collect_id'] }}">
                <a class="shop_info" href="{{ shop_prefix_url($v['shop_id']) }}">
                    <span class="shop-logo">
                    <img src="{{ get_image_url($v['shop_logo'], 'shop_logo') }}">
                    </span>
                    <span class="shop-name">{{ $v['shop_name'] }}</span>
                </a>
                <lable class="agree-checkbox" data-id="{{ $v['collect_id'] }}"></lable>
            </li>
        @endforeach

    </ul>
    <!-- 分页 -->
    <div id="pagination" class="page">
        <div class="more-loader-spinner">

            <div class="is-loaded">
                <div class="loaded-bg">我是有底线的</div>
            </div>

        </div>
        <script data-page-json="true" type="text" id="page_json">
            {!! $page_json !!}
        </script>
    </div>
    @else
    <!--没有收藏店铺时-->
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png" />
            </div>
            <dl>
                <dt>居然空空如也</dt>
                <dd>收藏店铺购物更方便哦~</dd>
            </dl>
        </div>
    @endif
</div>
<!---->
<div class="blank-div-footer"></div>
<div class="colect-shop-footer">
    <!--全选后给shop-check-all增加select样式-->
    <lable class="shop-check-all"><i></i></lable>
    <span class="shop-seleted">
已选择
<em class="color">0</em>
个店铺
</span>
    <a class="shop-delete bg-color" href="javascript:void(0)">删除</a>
</div>
<!-- more.js -->
<script src="/assets/d2eace91/js/szy.page.more.js?v=20190121"></script>
<script type="text/javascript">
    // 滚动加载数据
    $(window).on('scroll', function() {
        if ($(document).scrollTop() + $(window).height() > $(document).height() - 10) {
            if ($.isFunction($.pagemore)) {
                $.pagemore({
                    callback: function(result) {
                        if ($('.shop-edit-btn').html() == "完成") {
                            $('.shop_info').addClass('shop-info-eidt');
                            $(".blank-div-footer").show();
                            $('.colect-shop-footer').show();
                            $('.agree-checkbox').show();
                            $('.collect-shop-box').find('a').css("pointer-events", "none");
                        }
                    }
                });
            }
        }
    });
</script>
<script type="text/javascript">
    var tablelist = null;
    $().ready(function() {
        tablelist = $("#table_list").tablelist({
            params: $("#searchForm").serializeJson()
        });
    });
</script>

<script type='text/javascript'>
    $(function() {
        $('.shop-delete').click(function() {
            var ids = new Array();
            var int = 0;
            $(".collect-shop-list .agree-checkbox").each(function() {
                if ($(this).hasClass('checked')) {
                    ids[int] = $(this).data('id');
                    int++;
                }
            });
            if (int > 0) {
                $.confirm("是否删除选定内容？", function(s) {
                    if (s) {
                        $.loading.start();
                        $.ajax({
                            type: 'GET',
                            url: '/user/collect/delete-collect?id=' + ids,
                            dataType: 'json',
                            success: function(result) {
                                $.msg("删除成功");
                                $.each(ids, function(i, v) {
                                    $('#shop_item_' + v).remove();
                                });
                                $('.shop-edit-btn').html('编辑');
                                $('.collect-shop-list').removeClass('collect-shop-edit');
                                $('.blank-div-footer').hide();
                                $('.colect-shop-footer').hide();
                                $('.shopcar').show();
                                $('.agree-checkbox').hide();
                                $('.shop-seleted').find('em').text(0);
                                $('.shop-check-all').removeClass('select');
                                $('.SYZ_COLLECT_GOODS_COUNT').html('商品(' + result.collect_count + ')');
                                $('.SYZ_COLLECT_SHOP_COUNT').html('店铺(' + result.shop_count + ')');
                            }
                        })
                    }
                });
            } else {
                $.msg("亲,请先选择要删除的的店铺");
            }
        });

        $('.shop-check-all').click(function() {
            var i = 0;
            if ($(this).hasClass('select')) {
                $(this).removeClass('select');
                $(".collect-shop-list .agree-checkbox").each(function() {
                    $(this).removeClass('checked');
                });
                $('.shop-seleted').find('em').text(i);
            } else {
                $(this).addClass('select');
                $(".collect-shop-list .agree-checkbox").each(function() {
                    $(this).addClass('checked');
                    i++;
                });
                $('.shop-seleted').find('em').text(i);
            }
        });

    });
</script>

<!---->