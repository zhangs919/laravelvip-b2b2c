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
			<span class="" id="news2" onclick="location.href='/user/message/internal.html'">
				<a href="/user/message/internal.html" target="_self">
					<span>站内信</span>
					<span class="vertical-line">|</span>
				</a>
			</span>
                    <span class="active" id="news1" onclick="location.href='/user/message.html'">
				<a href="/user/message.html" target="_self">
					<span>系统公告</span>
				</a>
			</span>
                </div>
            </div>

            {{--引入 列表--}}
            @include('user.message.partials._message_list')

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
            });
        </script>
    </div>

@stop