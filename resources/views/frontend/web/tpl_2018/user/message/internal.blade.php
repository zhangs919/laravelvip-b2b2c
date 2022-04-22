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


        <script type="text/javascript">
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
                var page_count = "{{ $page_count }}";

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
        </script>
    </div>

@endsection