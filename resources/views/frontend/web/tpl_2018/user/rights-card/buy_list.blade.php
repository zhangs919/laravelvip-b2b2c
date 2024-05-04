@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

	<!-- 正文，由view提供 -->
	<div class="con-right fr">
		<div class="con-right-text">
			<div class="tabmenu">
				<ul class="tab">
					<li class="active">付费卡购卡记录</li>
				</ul>
				<div class="user-tab-right">
					<a href="/user/rights-card/index.html">返回会员卡列表</a>
				</div>
			</div>
			<div class="content-info">
				<form id="searchForm" name="searchForm" action="/user/rights-card/buy-list.html" method="GET">        <div class="screen-term">
						<label style="width: 33%;">
							<span>关键词：</span>
							<input name="keyword" class="form-control" type="text" placeholder="权益卡名称/卡号">
						</label>
						<label style="width: 33%;">
							<span>支付状态：</span>
							<select id="is_payed" name="is_payed" class="form-control">
								<option value="all">全部</option>
								<option value="payed">已支付</option>
								<option value="unpayed">未支付</option>
							</select>
						</label>
						<label>
							<input type="submit" value="搜索" class="search" />
						</label>
					</div>
				</form>        <div class="card-list clearfix">
					<div class="floatbar">
						<div class="bar-float">
							<div class="select">
								<ul>
									<li id="all" class="sel-item active">
										<a class="sel-link" href="javascript:;">全部记录</a>
									</li>
									<li id="payed" class="sel-item ">
										<a class="sel-link" href="javascript:;">已支付记录</a>
									</li>
									<li id="unpayed" class="sel-item ">
										<a class="sel-link" href="javascript:;">未支付记录</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- 全部记录 _start -->
					<div id="con_recharge_1" class="list-type">
						<div class="list-type-text">
							<div id="table_list">
								<table class="table">
									<thead>
									<tr>
										<th>名称</th>
										<th>领取时间</th>
										<th>卡号</th>
										<th>权益/领卡礼包</th>
										<th>支付金额（元）</th>
										<th>支付状态</th>
										<th>支付方式</th>
										<th>操作</th>
									</tr>
									</thead>
								</table>
								<div class="tip-box">
									<img src="/images/noresult.png" class="tip-icon" />
									<div class="tip-text">没有符合条件的记录</div>
								</div>
							</div>
						</div>
						<!-- 全部记录 _end -->
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
            // 
		</script></div>

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
                params: $("#searchForm").serializeJson(),
            });
            $("#searchForm").submit(function() {
                // 控制下方快速选择tab样式
                if ($("#is_payed").val() != '') {
                    $("li[class^='sel-item']").removeClass('active');
                    $("li[id='" + $("#is_payed").val() + "']").addClass('active');
                } else {
                    $("li[class^='sel-item']").removeClass('active');
                    $("li[id='all'").addClass('active');
                }
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
        });
        $("li[class^='sel-item']").click(function() {
            $("li[class^='sel-item']").removeClass('active');
            $(this).addClass('active');
            $("#is_payed").val($(this).attr("id"));
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            tablelist.load();
        });
        $('body').on('click', '.del', function() {
            var id = $(this).data('id');
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $.confirm("您确定要删除此权益卡吗？", function() {
                $.ajax({
                    type: 'GET',
                    url: '/user/rights-card/delete',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 1000
                            }, function() {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message);
                        }
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