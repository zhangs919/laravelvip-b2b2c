@extends('layouts.shop_layout')


@section('style_js')

@stop



@section('content')

	<!-- 内容 -->
	<div class="layout" style="min-height:400px;">
		<!-- 内容 -->

		<!-- 右侧客服 _start-->
		<!-- 右侧客服_end -->

		<div class="condition-screen w1210">
			<div class="blank15"></div>
			<div class="content-wrap category-wrap clearfix">
				<div class="fl">
					<div class="store-category">
						<h3 class="left-title">店内分类</h3>
						<div class="left-content tree">
							<ul>

								<li class="parent_li">
							<span>
								<i class="icon-minus-sign"></i>
							</span>
									<a href="/shop-list-{{ $shop_info['shop']['shop_id'] }}.html" target="_self"
									   title="全部商品" class="tree-first">全部商品</a>
									<ul>

									</ul>
								</li>
								@foreach($shop_category_list as $v)
									<li>
                                        <span>
                                            <i class="icon-minus-sign"></i>
                                        </span>
										<a href="/shop/{{ $shop_info['shop']['shop_id'] }}/list.html?cat_id={{ $v['cat_id'] }}"
										   target="_self" title="{{ $v['cat_name'] }}"
										   class="tree-first">{{ $v['cat_name'] }}</a>
										<ul>


											@if(!empty($v['_child']))
												@foreach($v['_child'] as $child)
													<li>
                                                        <span>
                                                            <i class="arrow"></i>
                                                        </span>
														<a href="/shop/{{ $shop_info['shop']['shop_id'] }}/list.html?cat_id={{ $v['cat_id'] }}"
														   target="_self"
														   title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
													</li>
												@endforeach
											@endif


										</ul>
									</li>
								@endforeach

							</ul>
						</div>
					</div>
				</div>

				<div class="main fr">
					<div class="" id="filter">
						<!--排序-->
						<form method="GET" name="listform" action="category.php">
							<div class="fore1">
								<dl class="order">
									@foreach($filter['sorts'] as $item)
										<dd class="first @if($item['selected'] == 1){{ 'curr' }}@endif">
											<a href="{{ $item['url'] }}">
												{{ $item['name'] }}
												@if(!empty($item['order']))
													<i class="iconfont icon-{{ $item['order'] }}"></i>
												@endif
											</a>
										</dd>
									@endforeach
								</dl>
								@if($page_array['page_count'] > 0)
									<div class="pagin">
										<a class="prev @if($page_array['cur_page'] == 1) disabled @else prev-page @endif">
											<span class="icon @if($page_array['cur_page'] == 1) prev-disabled @else prev-btn @endif"></span>
										</a>
										<span class="text">
											<font class="color">{{ $page_array['cur_page'] }}</font>
											/
											{{ $page_array['page_count'] }}
										</span>
										<a class="next @if($page_array['cur_page'] == $page_array['page_count']) disabled @else next-page @endif" data-go-page="2" href="javascript:;">
											<span class="icon @if($page_array['cur_page'] == $page_array['page_count']) next-disabled @else next-btn @endif"></span>
										</a>
									</div>
									<div class="total">
										共
										<span class="color">{{ $total }}</span>
										个商品
									</div>
								@endif
							</div>
							<div class="fore2">
								<div class="filter-btn">
									<!-- 选中的筛选条件给 a 标签追加类名 即  class="filter-tag curr" _star-->
									@foreach($filter['others'] as $item)
										<a href="{{ $item['url'] }}" class="filter-tag @if($item['selected'] == 1){{ 'curr' }}@endif">
											<input class="none" name="fff" onclick="" type="checkbox">
											<i class="iconfont">@if($item['selected'] == 1)&#xe6ae;@else&#xe715;@endif</i>
											<span class="text">{{ $item['name'] }}</span>
										</a>
									@endforeach
								</div>
							</div>
						</form>
					</div>

					<!--主体商品内容展示-->
					<form name="compareForm" action="compare.php" method="post" onsubmit="">
						<ul class="list-grid clearfix">
							{{--引入列表--}}
							@include('shop.partials._shop_goods')

						</ul>
						<!--当没有数据时，显示如下div-->
						@if($total == 0)
							<div class="tip-box">
								<img src="/images/noresult.png" class="tip-icon">
								<div class="tip-text">抱歉！没有搜索到您想要的结果……</div>
							</div>
						@endif

						<!--分页-->
						<div class="pull-right page-box">


							{!! $pageHtml !!}

						</div>
					</form>

				</div>
			</div>
		</div>

		<script src="/js/category.js"></script>
		<script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
		<script>
			$().ready(function () {
				var page_id = "pagination";
				$("#" + page_id + " > .pagination-goto > .goto-input").keyup(function (e) {
					$("#" + page_id + " > .pagination-goto > .goto-link").attr("data-go-page", $(this).val());
					if (e.keyCode == 13) {
						$("#" + page_id + " > .pagination-goto > .goto-link").click();
					}
				});
				$("#" + page_id + " > .pagination-goto > .goto-button").click(function () {
					var page = $("#" + page_id + " > .pagination-goto > .goto-link").attr("data-go-page");
					if ($.trim(page) == '') {
						return false;
					}
					$("#" + page_id + " > .pagination-goto > .goto-link").attr("data-go-page", page);
					$("#" + page_id + " > .pagination-goto > .goto-link").click();
					return false;
				});
			});
			//
			$().ready(function () {
				var page_url = "{{ $filter['region']['url'] }}";
				page_url = page_url.replace(/&amp;/g, '&');
				var tablelist = $("#table_list").tablelist({
					page_mode: 1,
					go: function (page) {
						page_url = page_url.replace("{0}", page);
						$.go(page_url);
					}
				});
				$(".prev-page").click(function () {
					tablelist.prePage();
				});
				$(".next-page").click(function () {
					tablelist.nextPage();
				});
				$(".add-cart").click(function (event) {
					var goods_id = $(this).data("goods-id");
					var image_url = $(this).data("image-url");
					var buy_enable = $(this).data("buy-enable");
					if (buy_enable) {
						$.msg(buy_enable);
						return false;
					}
					$.cart.add(goods_id, 1, {
						is_sku: false,
						event: event,
						image_url: image_url
					});
					return false;
				});
				//规格相册
				sildeImg(0);
			});
			//
			//
			function search_all() {
				document.getElementById('search-form').action = "/search.html";
				document.getElementById("search-form").submit();
			}

			function search_me() {
				document.getElementById('search-form').action = "/shop/{{ $shop_id }}/search.html";
				document.getElementById("search-form").submit();
			}

			function toggleShop(shop_id, obj) {
				$.collect.toggleShop(shop_id, function (result) {
					if (result.code == 0) {
						$(".collect-count").html(result.collect_count);
						$(obj).parent().toggleClass("fav-shop-box-select");
						if ($(obj).html() == "关注本店") {
							$(obj).html("取消关注");
							$(".collect-tip").html("已关注");
						} else {
							$(obj).html("关注本店");
							$(".collect-tip").html("关注");
						}
						if (result.show_collect_count == 1 && result.collect_count > 0) {
							$(".collect-tip").show();
							$(".collect-count").show();
						} else {
							$(".collect-tip").hide();
							$(".collect-count").hide();
						}
					}
				}, true);
			}

			//
			$().ready(function () {
				$.ajax({
					url: '/shop/index/info.html?shop_id={{ $shop_id }}',
					dataType: 'json',
					success: function (result) {
						var is_collect = result.data.is_collect;
						var collect_count = result.data.collect_count;
						var duration_time = result.data.duration_time;
						if (is_collect == false) {
							$(".collect-btn").html("关注本店");
							$(".collect-tip").html("关注");
						} else {
							$(".collect-btn").html("取消关注");
							$(".collect-tip").html("已关注");
						}
						$('.duration-time').html(duration_time);
						$(".collect-count").html(collect_count);
						if (result.data.show_collect_count == 1 && collect_count > 0) {
							$(".collect-tip").show();
							$(".collect-count").show();
						} else {
							$(".collect-tip").hide();
							$(".collect-count").hide();
						}
					}
				});
				//门店或店铺非营业时间是否支持下单
				$.ajax({
					type: 'get',
					url: '/shop/index/out-openhour-order-enable.html?shop_id={{ $shop_id }}',
					dataType: 'json',
					success: function (result) {
						if (result.code == 0) {
							$.open({
								title: false,
								closeBtn: 0,
								type: 1,
								area: '100% !important',
								offset: 'b',
								content: result.data,
							});
						}
					}
				});
				//加入购物车
				$('body').on('click', '.add-cart', function (event) {
					var goods_id = $(this).data('goods_id');
					var image_url = $(this).data('image_url');
					var buy_enable = $(this).data("buy-enable");
					if (buy_enable) {
						$.msg(buy_enable);
						return false;
					}
					$.cart.add(goods_id, 1, {
						is_sku: false,
						image_url: image_url,
						event: event,
						callback: function () {
							var attr_list = $('.attr-list').height();
							$('.attr-list').css({
								"overflow": "hidden"
							});
							if (attr_list >= 200) {
								$('.attr-list').addClass("attr-list-border");
								$('.attr-list').css({
									"overflow-y": "auto"
								});
							}
						}
					});
					return false;
				});
			});
			$('#shop_header_yikf').click(function () {
				$('#from_shop_yikf').submit();
			})
			//
			$().ready(function () {
				$('.site_to_yikf').click(function () {
					$(this).parent('form').submit();
				})
			});
			//
			$().ready(function () {
				// 缓载图片
				$.imgloading.loading();
				//图片预加载
				document.onreadystatechange = function () {
					if (document.readyState == "complete") {
						$.imgloading.setting({
							threshold: 1000
						});
						$.imgloading.loading();
					}
				}
			});
			//
		</script>

	</div>

@stop
