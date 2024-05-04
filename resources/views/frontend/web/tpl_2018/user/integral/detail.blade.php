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
                <span class="user-statu active">
                    <a href="" class="color">
                        <span>积分明细</span>
                        <span class="vertical-line">|</span>
                    </a>
                </span>
                        <span class="user-statu">
                    <a href="/user/integral/order-list.html">
                        <span>积分兑换</span>
                    </a>
                </span>
                    </div>
                </div>
                <div class="content-info">
                    <div class="exchange-list clearfix">
                        <div class="use-detail clearfix">
                    <span class="fl">
                        线上可用积分：
                        <strong class="second-color SZY-PAY-POINT"></strong>
                        积分
                    </span>
                            <span class="fl">
                        线上冻结积分
                        <strong class="second-color SZY-FROZEN-POINT"></strong>
                        积分
                    </span>
                            <span class="fl">
                        线下会员积分：
                        <strong class="second-color ERP-PAY-POINT">0</strong>
                        积分
                    </span>
                            <a href="javascript:void(0);" title="查看各商家账户积分" class="see-btn">查看各商家账户积分</a>
                        </div>

                        @include('user.integral.partials._detail')

                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            // 
        </script>
        <script type="text/javascript">
            // 
        </script>
    </div>

@stop

{{--底部js--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.page.more.js?v=1.1"></script>
    <script src="/js/common.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <script src="/js/placeholder.js?v=1.1"></script>
    <script src="/js/user.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/common.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/message.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/message/messageWS.js?v=1.1"></script>
    <script>
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                callback: function() {
                    $.loading.stop();
                }
            });
            //ajax校验
            $.get('/integralmall/index/validate', function(result) {
                if (result.code == 0) {
                    $('.SZY-TOTAL-POINT').html(result.data);
                    $('.SZY-PAY-POINT').html(result.pay_point);
                    $('.SZY-FROZEN-POINT').html(result.frozen_point);
                }
            }, 'json');
        });
        // 
        $().ready(function() {
            // var click_lock = false;
            $("body").on("click", ".see-btn", function() {
                // if (!click_lock) {
                // click_lock = true;
                $.loading.start();
                $.open({
                    title: "查看各商家账户积分",
                    ajax: {
                        url: "/user/integral/view",
                        data: {}
                    },
                    width: "700px",
                    end: function(index, object) {
                        // $.go('/user/integral/detail.html');
                    }
                });
                // }
            });
            $.ajax({
                url: '/user/capital-account/get-data',
                dataType: 'json',
                success: function(data) {
                    $('.ERP-PAY-POINT').html(data.points);
                }
            });
        });
        $('#sync-btn').click(function(){
            //ajax校验
            $.loading.start();
            $.post('/user/integral/sync-integral', {},function(result) {
                if (result.code == 0) {
                    $.msg(result.message, {
                        time: 3000
                    },function(){
                        location.reload();
                    })
                }else{
                    $.msg(result.message, {
                        time: 3000
                    },function(){
                        $.loading.stop();
                    })
                }
            }, 'json');
        })
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
            $('.site_to_yikf').click(function() {
                $(this).parent('form').submit();
            })
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