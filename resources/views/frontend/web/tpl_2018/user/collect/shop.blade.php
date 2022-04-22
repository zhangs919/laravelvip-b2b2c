@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr"><!---->
        <div class="con-right fr">
            <div class="con-right-text">
                <div class="tabmenu">
                    <div class="user-status">
				<span class="" id="status1">
					<a href="/user/collect/goods.html" target="_self">
						<span>商品收藏</span>
						<span class="vertical-line">|</span>
					</a>
				</span>
                        <span class="active" id="status2">
					<a href="/user/collect/shop.html" target="_self">
						<span>店铺收藏</span>
					</a>
				</span>
                    </div>
                </div>
                <!---->
                <div class="collect-list" id="con_status_2" style=""></div>
                <!---->
            </div>
        </div>
        <script type='text/javascript'>
            $(document).ready(function() {
                $.loading.start();
                $.ajax({
                    type: 'GET',
                    url: '/user/collect/shop?tab=all_shop',
                    dataType: 'json',
                    success: function(result) {
                        $(".collect-list").html(result.data);
                    }
                });
            })
        </script>
        <script type='text/javascript'>
            $(function() {
                $(".select li").on('click', function() {
                    var page = $(this).attr('id');
                    $.ajax({
                        type: 'GET',
                        url: '/user/collect?type=1&tab=' + page + '',
                        dataType: 'json',
                        success: function(result) {
                            $(".collect-list").html(result.data);
                        }
                    })
                })
            })
        </script>
        <!---->
    </div>

@endsection