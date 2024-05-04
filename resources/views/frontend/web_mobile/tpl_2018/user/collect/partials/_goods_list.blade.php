<form class="search-panel-focused" id="searchForm" action="">
    <input name="tab" type="hidden" value="goods_list" />
    <input name="type" type="hidden" value="1" />
</form>
<div class="collect-goods-box">

    @if(!empty($list))
        <ul class="collect-goods-list" id="table_list">
            <div class="tablelist-append">

                @foreach($list as $v)
                <li class="goods-item @if($v['goods_status'] != 1){{ 'good-info-nosale' }}@endif" id="goods_item_{{ $v['collect_id'] }}">
                    <lable class="agree-checkbox" data-id="{{ $v['collect_id'] }}"><i></i></lable>
                    <a href="{{ route('mobile_show_goods',['goods_id'=>$v['goods_id']]) }}" class="goods-link">
                        <div class="good-pic">
                            <img src="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                        </div>
                        <!-- 如果是下架的商品就给下面的div追加class="good-info-nosale" -->
                        <dl class="good-info bdr-bottom @if($v['goods_status'] != 1){{ 'good-info-nosale' }}@endif">
                            <dt class="good-name">
                                <!-- 活动色块 -->
                                {{ $v['goods_name'] }}
                            </dt>
                            <dd class="good-sale">
                                <span class="good-price price-color">
                                <em>￥{{ $v['collect_price'] }}</em>
                                </span>
                            </dd>
                        </dl>
                    </a>
                    @if($v['goods_status'] != 1)
                        <!-- 如果是下架的商品就走下面的模块 _start -->
                        <div class="cart-box cart-box-second">
                            <i class="iconfont no-sale"></i>
                        </div>
                        <!-- 如果是下架的商品就走下面的模块 _end -->
                    @else
                        <div class="cart-box cart-box-second" id="number_{{ $v['goods_id'] }}">
                            <i class="decrease remove-cart iconfont icon-jian2 hide" data-goods_id="{{ $v['goods_id'] }}"></i>
                            <input class="num hide" type="text" size="4" maxlength="5" value="0" onfocus="this.blur()">
                            <i class="increase add-cart iconfont icon-jia1" data-goods_id="{{ $v['goods_id'] }}" data-image_url="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"></i>
                        </div>
                    @endif
                </li>
                @endforeach

            </div>
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
        </ul>
    @else
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png">
            </div>
            <dl>
                <dt>居然空空如也</dt>
                <dd>收藏商品购物更方便哦~</dd>
            </dl>

        </div>
    @endif


    <div class="blank-div-footer"></div>
    <div class="colect-goods-footer">
        <!--全选后给goods-check-all增加select样式-->
        <lable class="goods-check-all"><i></i></lable>
        <span class="goods-seleted">
已选择
<em class="color">0</em>
个商品
</span>
        <a class="goods-delete bg-color" href="javascript:void(0)">删除</a>
    </div>
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
                        if ($('.goods_edit_btn').html() == "完成") {
                            $(".blank-div-footer").show();
                            $(".colect-goods-footer").show();
                            $('.agree-checkbox').show();
                            $(".shopcar").hide();
                            $('.collect-goods-list').find('.cart-box').hide();
                            $('.collect-goods-list').find('a').css("pointer-events", "none");
                        }
// 图片缓载
                        $.imgloading.loading();
                    }
                });
            }
        }
    });
</script>
<script type='text/javascript'>
    $(document).ready(function() {
//加入购物车
        $('body').on('click', '.add-cart', function(event) {
            var this_target = $(this);
            var goods_image = $(this).data('image_url');
            $.cart.add(this_target.data("goods_id"), "1", {
                image_url: goods_image,
                event: event,
                is_sku: false,
                callback: function(result) {
                    if (result.code == 0) {
                        var $numbtn = this_target.parent().find(".num");
// 点击加入购物车相应的购买数量
                        $numbtn.val(parseInt($numbtn.val()) + 1);

                        if (parseInt($numbtn.val()) > 0) {
                            $numbtn.removeClass('hide');
//减号的按钮动画显示
                            this_target.parent().find(".decrease").removeClass('hide');
                        }
                    }
                }
            });
        });

//减少购物车
        $('body').on('click', '.remove-cart', function() {
            var this_target = $(this);
            var data = {};
            data.goods_id = this_target.data("goods_id");
            data.number = 1;
            $.cart.remove(data, function(result) {
                if (result.code == 0) {
                    $numbtn = this_target.parent().find(".num");
                    if (parseInt($numbtn.val()) <= 1) {
                        $numbtn.val(0);
                        $numbtn.addClass('hide');
                        this_target.addClass('hide');
                    } else {

                        $numbtn.val(parseInt($numbtn.val()) - 1);
                    }
                }
            });
        });

    });
</script>
<script type='text/javascript'>
    $(function() {
        $('.goods-delete').click(function() {
            var ids = new Array();
            var int = 0;
            $(".collect-goods-box .agree-checkbox").each(function() {
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
                                    $('#goods_item_' + v).remove();
                                });
                                $('.goods_edit_btn').html('编辑');
                                $('.collect-goods-box').removeClass('collect-goods-edit');
                                $('.colect-goods-footer').hide();
                                $(".blank-div-footer").hide();
                                $('.shopcar').show();
                                $('.agree-checkbox').hide();
                                $('.goods-seleted').find('em').text(0);
                                $('.goods-check-all').removeClass('select');
                                $('.SYZ_COLLECT_GOODS_COUNT').html('商品(' + result.collect_count + ')');
                                $('.SYZ_COLLECT_SHOP_COUNT').html('店铺(' + result.shop_count + ')');
                                $('.collect-goods-list').find('.cart-box').show();
                            }
                        })
                    }
                });
            } else {
                $.msg("亲,请先选择要删除的的宝贝");
            }
        });

        $('.goods-check-all').click(function() {
            var i = 0;
            if ($(this).hasClass('select')) {
                $(this).removeClass('select');
                $(".collect-goods-box .agree-checkbox").each(function() {
                    $(this).removeClass('checked');
                });
                $('.goods-seleted').find('em').text(i);
            } else {
                $(this).addClass('select');
                $(".collect-goods-box .agree-checkbox").each(function() {
                    $(this).addClass('checked');
                    i++;
                });
                $('.goods-seleted').find('em').text(i);
            }
        });

    });
</script>
<script type="text/javascript">
    var tablelist = null;
    $().ready(function() {
        tablelist = $("#table_list").tablelist({
            params: $("#searchForm").serializeJson()
        });

        $("#searchForm").submit(function() {
// 序列化表单为JSON对象
            var data = $(this).serializeJson();
// Ajax加载数据
            tablelist.load(data);
// 阻止表单提交
            return false;
        });

    });
</script>