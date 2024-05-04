@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right fr">
            <div class="con-right-text">
                <div class="tabmenu">
                    <div class="user-status">
				<span class="tab-type active" data-type="1">
					<a href="javascript:void(0);" target="_self">
						<span>店铺红包</span>
						<em class="tag-em SZY-SHOP-BONUS-COUNT">{{ $shop_bonus_count }}</em>
						<span class="vertical-line">|</span>
					</a>
				</span>
                        <span class="tab-type " id="status2" data-type="0">
					<a href="javascript:;" target="_self">
						<span>平台红包</span>
						<em class="tag-em SZY-SYSTEM-BONUS-COUNT">{{ $system_bonus_count }}</em>
						<span class="vertical-line">|</span>
					</a>
				</span>
                    </div>

                    <div class="user-tab-right">


                        <a href="/user/bonus.html?show_type=1">红包历史记录</a>

                    </div>

                </div>
                <div class="content-info">
                    <!-- 红包列表页面 _start -->
                    <div class="content-list">
                        <form method="post" action="" name="" onkeydown="if(event.keyCode==13){return false;}">
                            <div class="screen-box">
                                <div class="sort-box fl">
{{--							<span class="orderby" data-sortname="ub.bonus_price" data-sortorder="asc">--}}
							<span class="orderby" data-sortname="bonus_price" data-sortorder="asc">
								<a href="javascript:;">
									红包金额
									<i class="iconfont icon-ASC"></i>
								</a>
							</span>
{{--                                    <span class="orderby" data-sortname="ub.end_time" data-sortorder="asc">--}}
                                    <span class="orderby" data-sortname="end_time" data-sortorder="asc">
								<a href="javascript:;">
									到期时间
									<i class="iconfont icon-ASC"></i>
								</a>
							</span>

{{--                                    <span class="orderby" data-sortname="ub.start_time" data-sortorder="asc">--}}
                                    <span class="orderby" data-sortname="start_time" data-sortorder="asc">
								<a href="javascript:;">
									生效时间
									<i class="iconfont icon-ASC"></i>
								</a>
							</span>

                                </div>
                                <!-- 注意：如果是“全网红包”，将店铺名称搜索隐藏 _start-->
                                <div class="content-search bonus-search fr">
                                    <input type="text" id="shop_name" placeholder="店铺名称" />
                                    <span class="order-search-btn" title="搜索" id="btn_search_bonus">搜索</span>
                                </div>
                                <!-- 注意：如果是“全网红包”，将店铺名称搜索隐藏 _end-->
                            </div>
                        </form>

                        {{--引入列表--}}
                        @include('user.bonus.partials._list')

                        <!-- 红包列表页面 _end -->
                        <div class="operat-tips">
                            <h4>我的红包注意事项</h4>
                            <ul class="operat-panel">
                                <li>
                                    <span>当您从购物车中去结算时，在订单确认页面可以选择您的红包，获得相应的优惠</span>
                                </li>
                                <li>
                                    <span>当您使用了红包的订单发生退货时，需要将使用了该红包的订单内所有商品全部退货完成后，才能退回红包</span>
                                </li>
                                <li>
                                    <span>店铺红包仅可在发行店铺使用</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 验证码脚本 -->
            <script src="/assets/d2eace91/js/jquery.captcha.js?v=201902541"></script>
            <script type="text/javascript">
                var tablelist = null;
                $().ready(function() {
                    tablelist = $("#table_list").tablelist({
                        page: {
                            // 每页显示8条记录
                            page_size: 8
                        }
                    });

                    // 红包类型
                    $("body").on("click", ".tab-type", function() {
                        $(".tab-type").removeClass('active');
                        $(this).addClass('active');

                        var type = $(this).data("type");

                        if (type == 0) {
                            $(".bonus-search").hide();
                        } else {
                            $(".bonus-search").show();
                        }

                        tablelist.load({
                            'type': type
                        });

                        return false;
                    });
                    // 排序
                    $("body").on("click", ".orderby", function() {
                        $(".orderby").removeClass('curr');
                        $(this).addClass('curr');

                        var sortname = $(this).data("sortname");
                        var sortorder = ($(this).data('sortorder') == 'desc') ? 'asc' : 'desc';

                        $(this).data('sortorder', sortorder)
                        if (sortorder == 'desc') {
                            $(this).find(".icon-order-ASCending").removeClass("icon-order-ASCending").addClass("icon-order-DESCending");
                        } else {
                            $(this).find(".icon-order-DESCending").removeClass("icon-order-DESCending").addClass("icon-order-ASCending");
                        }

                        tablelist.sort(sortname, sortorder).always(function(result) {

                        });

                        return false;
                    });

                    // 店铺搜索
                    $("body").on("click", ".order-search-btn", function() {
                        tablelist.load({
                            'shop_name': $("#shop_name").val()
                        })
                        return false;
                    });

                    // 删除红包
                    $("body").on("click", ".coupon-del", function() {
                        var user_bonus_id = $(this).data('user-bonus-id');
                        $.confirm("您确定要删除该红包吗？", function() {
                            $.post("/user/bonus/delete.html", {
                                user_bonus_id: user_bonus_id
                            }, function(result) {
                                if (result.code == 0) {
                                    $(".SZY-SYSTEM-BONUS-COUNT").html(result.system_bonus_count);
                                    $(".SZY-SHOP-BONUS-COUNT").html(result.shop_bonus_count);
                                    $.msg(result.message);
                                    tablelist.load();
                                } else {
                                    $.msg(result.message, {
                                        time: 5000
                                    });
                                }
                            }, "JSON");
                        });
                    })

                });
            </script>
        </div>
    </div>

@stop

{{--底部js--}}
@section('footer_js')
    <script src="/js/common.js"></script>
    <script src="/js/user.js"></script>
    <script src="/assets/d2eace91/js/yii.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/common.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/assets/d2eace91/js/jquery.captcha.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                page: {
                    // 每页显示8条记录
                    page_size: 8
                }
            });
            // 红包类型
            $("body").on("click", ".tab-type", function() {
                $(".tab-type").removeClass('active');
                $(this).addClass('active');
                var type = $(this).data("type");
                if (type == 0) {
                    $(".bonus-search").hide();
                } else {
                    $(".bonus-search").show();
                }
                tablelist.load({
                    'type': type
                });
                return false;
            });
            // 排序
            $("body").on("click", ".orderby", function() {
                $(".orderby").removeClass('curr');
                $(this).addClass('curr');
                var sortname = $(this).data("sortname");
                var sortorder = ($(this).data('sortorder') == 'desc') ? 'asc' : 'desc';
                $(this).data('sortorder', sortorder)
                if (sortorder == 'desc') {
                    $(this).find(".icon-order-ASCending").removeClass("icon-order-ASCending").addClass("icon-order-DESCending");
                } else {
                    $(this).find(".icon-order-DESCending").removeClass("icon-order-DESCending").addClass("icon-order-ASCending");
                }
                tablelist.sort(sortname, sortorder).always(function(result) {
                });
                return false;
            });
            // 店铺搜索
            $("body").on("click", ".order-search-btn", function() {
                tablelist.load({
                    'shop_name': $("#shop_name").val()
                })
                return false;
            });
            // 删除红包
            $("body").on("click", ".coupon-del", function() {
                var user_bonus_id = $(this).data('user-bonus-id');
                $.confirm("您确定要删除该红包吗？", function() {
                    $.post("/user/bonus/delete.html", {
                        user_bonus_id: user_bonus_id
                    }, function(result) {
                        if (result.code == 0) {
                            $(".SZY-SYSTEM-BONUS-COUNT").html(result.system_bonus_count);
                            $(".SZY-SHOP-BONUS-COUNT").html(result.shop_bonus_count);
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "JSON");
                });
            })
        });
        // 
        $(document).ready(function() {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        // 
        $().ready(function() {
        })
        // 
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        // 
    </script>
@stop