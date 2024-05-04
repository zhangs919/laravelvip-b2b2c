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
					<li class="active">我的会员卡</li>
				</ul>
				<div class="user-tab-right">
					<a href="/user/rights-card/buy-list.html">付费卡-购卡记录</a>
				</div>
			</div>
			<div class="content-info">
				<form id="searchForm" name="searchForm" action="/user/rights-card/index.html" method="GET">        <div class="screen-term">
						<label style="width: 30%;">
							<span>关键词：</span>
							<input name="rank_name" class="form-control" type="text" placeholder="权益卡名称" style="width: 135px;">
						</label>
						<label style="width: 30%;">
							<span>状态：</span>
							<select name="status" class="form-control">
								<option value="">全部</option>
								<option value="1">使用中</option>
								<option value="2">已过期</option>
							</select>
						</label>
						<label style="width: 30%;">
							<span>类型：</span>
							<select name="card_type" class="form-control">
								<option value="">全部</option>
								<option value="1">直接领取</option>
								<option value="2">付费购买</option>
								<option value="0">按规则发放</option>
							</select>
						</label>
						<label>
							<input type="submit" value="搜索" class="search" />
						</label>
					</div>
				</form>

				{{--引入列表--}}
                @include('user.rights-card.partials._list')


				<!-- <div class="operat-tips">
                    <h4>注意：</h4>
                    <ul class="operat-panel">
                        <li>
                            <span>1、每个店铺可领取多张权益卡，此处调用的是店铺头像、店铺名称、权益卡使用状态、 权益卡名称、权益卡类型、权益卡有效期；</span>
                        </li>
                        <li>
                            <span>2、所有卡片只能设置一张默认的权益卡，如果没有设置默认，则调取最近领取的权益卡；</span>
                        </li>
                        <li>
                            <span>3、按规则发放的权益卡如果是特殊会员，要有特殊会员的标识；</span>
                        </li>
                        <li>
                            <span>4、被商家禁用的卡片不展示；</span>
                        </li>
                        <li>
                            <span>5、每个会员卡领取之后展示的到期时间是过了晚上12点才算过期，比如到期时间是2019-04-22 ~ 2019-04-23，那么过了23号晚上12点才算过期；</span>
                        </li>
                    </ul>
                </div> -->
			</div>
		</div>
		<script type="text/javascript">
            //
		</script>
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
        $().ready(function() {
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
                return false;
            });
        });
        // 
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
            // 设置默认权益卡
            /* $.get('set-default-card', {
            }, function(result) {
                if (result.code == 0) {
                    window.location.reload();
                    // $.msg(result.message);
                } else {
                }
            }, "json"); */
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