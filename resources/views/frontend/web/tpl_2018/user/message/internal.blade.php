@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <div class="user-status">
			<span class="active" id="news2" onclick="location.href='/user/message/internal.html'">
				<a href="/user/message/internal.html" target="_self">
					<span>站内信</span>
					<span class="vertical-line">|</span>
				</a>
			</span>
                    <span class="" id="news1" onclick="location.href='/user/message.html'">
				<a href="/user/message.html" target="_self">
					<span>系统公告</span>
				</a>
			</span>
                </div>
            </div>
            <div class="mg-content" id="table_list">
                <!-- -->
                @if(!empty($list))
                    <ul>

                        {{--引入列表--}}
                        @include('user.message.partials._internal_message_list')


                    </ul>
                    <p class="mg-more">
                        <a href="javascript:void(0);" class="message-more">查看更多消息</a>
                    </p>
                @else
                    <div class="tip-box">
                        <img src="{{ get_image_url(sysconf('default_noresult')) }}" class="tip-icon">
                        <div class="tip-text">没有符合条件的记录</div>
                    </div>
                @endif
                
            </div>
        </div>
        <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>
        
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
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                callback: function() {
                    $.loading.stop();
                    if ($(".con-right").height() != $(".con-left").height()) {
                        $(".con-left").height($(".con-right").height());
                    }
                }
            });
            var cur_page = 1;
            var page_count = "4";
            if (cur_page >= page_count) {
                $(".message-more").html("已经没有更多的消息了");
                $(".message-more").removeClass("message-more");
            }
            $("body").on("click", ".message-more", function() {
                $.loading.start();
                // 页数累计
                cur_page++;
                $.get("/user/message/internal.html", {
                    page: {
                        cur_page: cur_page
                    }
                }, function(result) {
                    if (result.code == 0) {
                        $("#table_list").find("ul").append(result.data);
                        if (result.count == 0 || cur_page >= page_count) {
                            $(".message-more").html("已经没有更多的消息了");
                            $(".message-more").removeClass("message-more");
                        }
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                    if ($(".con-right").height() != $(".con-left").height()) {
                        $(".con-left").height($(".con-right").height());
                    }
                });
            });
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