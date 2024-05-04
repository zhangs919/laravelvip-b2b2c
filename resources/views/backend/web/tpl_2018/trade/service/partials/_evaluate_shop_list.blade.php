<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox"/>
        </th>
        <!--排序样式sort默认，asc升序，desc降序-->
        <th data-sortname="s.shop_id">被评店铺</th>
        <th data-sortname="sc.user_id">评价人</th>
        <th data-sortname="shop_service">卖家的服务态度</th>
        <th data-sortname="shop_speed">卖家的发货速度</th>
        <th data-sortname="logistics_speed">物流公司的服务</th>
        <th data-sortname="order_sn">评价订单</th>
        <th data-sortname="shop_comment_add_time">评价时间</th>
        <!--操作列样式handle-->
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    @if(!empty($list))
        @foreach($list as $item)
            <tr name="{{ $item['shop_comment_id'] }}">
                <td class="tcheck">
                    <input type="checkbox" class="checkBox"/>
                </td>
                <!--被评店铺-->
                <td>
                    <div class="ng-binding">
							<span>
								店铺：
								<font class="c-blue" title="{{ $item['shop_name'] }}">{{ $item['shop_name'] }}</font>
							</span>
                        <span>
								卖家：
								<font class="c-blue" title="{{ $item['seller_user_name'] }}">{{ $item['seller_user_name'] }}</font>
							</span>
                    </div>
                    <div>
                        <label class="label {{ str_replace([0,1,2],['label-warning','label-green','label-danger'], $item['shop_comment_status']) }} m-l-0">
                            {{ str_replace([0,1,2],['待审核','审核通过','审核拒绝'], $item['shop_comment_status']) }}
                        </label>
                    </div>
                </td>
                <!--b_blue_5.gif为钻级用户，1为一个钻，以此类推；b_red_4.gif为红心级用户；s_cap_4.gif为冠级用户-->
                <td>
                    <div class="ng-binding">
							<span>
								买家：
								<font class="c-blue">{{ $item['user_name'] }}</font>
							</span>
                        <span>
								<img src="{{ $item['user_rank_icon'] }}" class="rank"
                                     title="{{ $item['user_rank_name'] }}" data-toggle="tooltip"
                                     data-placement="auto bottom"/>
							</span>
                    </div>
                </td>
                <!--icon-0为实星，icon-1为虚星-->
                <td>
                    <div class="ng-binding">
							<span class="star-icon popover-box">
								@for($i=0; $i< 5;$i++)
                                    <i class="icon-@if($i < $item['shop_service']){{ 0 }}@else{{ 1 }}@endif"></i>
                                @endfor

                                <div class="popover-info">
									<i class="fa fa-caret-left"></i>
									<ul>
										<li>
											<p>{!! $raty['service_desc'][$item['shop_service']] !!}</p>
										</li>
									</ul>
								</div>
							</span>
                    </div>
                </td>
                <td>
                    <div class="ng-binding">
						<span class="star-icon popover-box">
							@for($i=0; $i< 5;$i++)
                                <i class="icon-@if($i < $item['shop_speed']){{ 0 }}@else{{ 1 }}@endif"></i>
                            @endfor

                            <div class="popover-info">
								<i class="fa fa-caret-left"></i>
								<ul>
									<li>
										<p>{!! $raty['send_desc'][$item['shop_speed']] !!}</p>
									</li>
								</ul>
							</div>
						</span>
                    </div>
                </td>
                <td>
                    <div class="ng-binding">
						<span class="star-icon popover-box">
							@for($i=0; $i< 5;$i++)
                                <i class="icon-@if($i < $item['logistics_speed']){{ 0 }}@else{{ 1 }}@endif"></i>
                            @endfor

                            <div class="popover-info">
								<i class="fa fa-caret-left"></i>
								<ul>
									<li>
										<p>{!! $raty['logistics_speed'][$item['logistics_speed']] !!}</p>
									</li>
								</ul>
							</div>
						</span>
                    </div>
                </td>
                <td>
                    <a href="javascript:;">{{ $item['order_sn'] }}</a>
                </td>
                <td>{{ format_time($item['shop_comment_add_time']) }}</td>
                <td class="handle">
                    <div class="ng-binding">
							<span class="text-c">


                                @if($item['shop_comment_status'] == 0)
                                    <a class="is_pass" data-id="{{ $item['shop_comment_id'] }}" href="javascript:;">通过</a>
                                    <a class="refuse del" data-id="{{ $item['shop_comment_id'] }}" href="javascript:;">拒绝</a>
                                @endif


							</span>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox"/>
        </td>
        <td colspan="8">
            <div class="pull-left">
                <form id="cl" method="POST" action="">
                    <!---->
                    <button id="shows" class="btn btn-danger mr5" type="button" data-action="delete-all">批量通过</button>
                    <button id="refuse" class="btn btn-danger mr5" type="button" data-action="delete-all">批量拒绝</button>
                    <!---->
                </form>
            </div>
            <div id="pagination" class="pull-right page-box">

                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
