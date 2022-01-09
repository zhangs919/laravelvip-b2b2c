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
				<span class="active" id="status1" onclick="setTab('status',1,2)">
					<a href="/user/collect/goods.html" target="_self">
						<span>商品收藏</span>
						<span class="vertical-line">|</span>
					</a>
				</span>
                        <span class="" id="status2">
					<a href="/user/collect/shop.html" target="_self">
						<span>店铺收藏</span>
					</a>
				</span>
                    </div>
                </div>
                <div class="content-info"></div>
            </div>
        </div>
        <script src="/assets/d2eace91/js/szy.cart.js?v=1.4"></script>
        <script type="text/javascript">
            $("body").on("click", ".add-cat-btn", function() {
                var this_target = $(this);
                $.cart.add(this_target.data("tip"), "1", {
                    is_sku: false
                });
            })
        </script>
        <script type='text/javascript'>
            $(document).ready(function() {
                $.loading.start();
                $.ajax({
                    type: 'GET',
                    url: '/user/collect/goods?tab=goods_list',
                    dataType: 'json',
                    success: function(result) {
                        $(".content-info").html(result.data);
                    }
                });
            })
        </script>
        <script type='text/javascript'>
            $(function() {
                $(".select li").click(function() {
                    var page = $(this).attr('id');
                    if (typeof (page) == "undefined") {
                        page = "";
                    }
                    $.ajax({
                        type: 'GET',
                        url: '/user/collect?tab=' + page + '',
                        dataType: 'json',
                        success: function(result) {
                            $(".content-info").html(result.data);
                        }
                    })
                })
            })
        </script></div>

@endsection