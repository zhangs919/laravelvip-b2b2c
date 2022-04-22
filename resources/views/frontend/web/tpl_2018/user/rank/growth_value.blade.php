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
				<span class="active" id="status1" onclick="setTab('status',1,2)">
					<a href="javascript:;" target="_self">
						<span>成长值规则</span>
						<span class="vertical-line">|</span>
					</a>
				</span>
                        <span class="" id="status2" onclick="setTab('status',2,2)">
					<a href="javascript:;" target="_self">
						<span>我的成长值</span>
					</a>
				</span>
                    </div>
                    <div class="user-tab-right">
				<span>
					我的成长值：
					<font class="second-color">{{ $user_info->rank_point ?? 0 }}</font>
				</span>
                        <span>
					会员级别：
					<font class="second-color">{{ $user_rank_info['rank_name'] }}</font>
				</span>

                        <span>
					再积累
					<font class="second-color">{{ $user_rank_info['less_exppoints'] }}</font>
					成长值可升级{{ $user_rank_info['downrank_name'] }}
				</span>

                    </div>
                </div>
                <div class="content-info">
                    <div id="con_status_1">
                        <div class="growth-value-text">
                            <h2 class="text-title">
                                <span>成长值介绍</span>
                            </h2>
                            <ul class="text-info">
                                <li>1、成长值是商城会员通过购物获得</li>
                                <li>2、累积的成长值总额决定会员等级，成长值越高，会员等级越高。会员成长值 ≈ 累计购物金额*消费金额与赠送成长值比例，取整数部分</li>
                                <li>3、成长值：购物获得的成长值是根据确认收货时间计算，成长值小数点后部分不计入积分：例如会员的订单是88.2元，消费金额与赠送成长值比例是10%，则确认收货后并无退款退货，即可得到8点成长值</li>
                                <li>4、确认收货后退款退货，会扣减成长值，扣除的成长值与当时获得的值相同</li>
                            </ul>
                        </div>
                        <div class="growth-value-text">
                            <h2 class="text-title">
                                <span>升级条件</span>
                            </h2>
                            <table class="growth-table">
                                <thead>
                                <tr>
                                    <th>会员等级</th>
                                    <th>成长值</th>
                                    <th>等级图标</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $v)
                                <tr>
                                    <td>{{ $v->rank_name }}</td>
                                    <!---->
                                    <td>{{ $v->min_points }}--{{ $v->max_points }}</td>
                                    <!---->
                                    <td class="rank-img">
                                        <img src="{{ get_image_url($v->rank_img) }}" />
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="con_status_2" style="display: none;">
                        <!---->
                        <div class="growth-value-text">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 35%;">来源/用途</th>
                                    <th style="width: 15%;">订单号/退款编号</th>
                                    <th style="width: 15%;">实付款</th>
                                    <th style="width: 10%;">成长值</th>
                                    <th style="width: 25%;">获取时间</th>
                                </tr>
                                </thead>
                            </table>
                            <div class="tip-box">
                                <img src="/images/noresult.png" class="tip-icon" />
                                <div class="tip-text">暂无成长值</div>
                            </div>
                        </div>
                        <!---->
                        <div class="growth-value-text">
                            <!---->
                            <!---->
                            <!---->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var tablelist = null;
            $().ready(function() {
                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                $("#searchForm").submit(function() {
                    // 序列化表单为JSON对象
                    var data = $(this).serializeJson();
                    console.info(data);
                    // Ajax加载数据
                    tablelist.load(data);
                    // 阻止表单提交
                    return false;
                });

            });
        </script>
        <!---->
    </div>

@endsection