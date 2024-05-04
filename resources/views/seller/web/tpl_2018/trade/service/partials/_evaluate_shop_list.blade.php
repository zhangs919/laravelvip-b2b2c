<link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css"
      rel="stylesheet"><!-- ================== BEGIN BASE  ================== -->
<!-- ================== END BASE  ================== -->
<!-- -->
<table id="table_list" class="table table-hover">
    <colgroup>
        <!--评价人-->
        <col class="w120"/>
        <!--评价状态-->
        <col class="w50"/>
        <!--卖家的服务态度-->
        <col class="w100"/>
        <!--卖家的发货速度-->
        <col class="w100"/>
        <!--物流公司的服务-->
        <col class="w100"/>
        <!--评价订单-->
        <col class="w100"/>
        <!--评价时间-->
        <col class="w100"/>
    </colgroup>
    <thead>
    <tr>
        <th data-sortname="sc.user_id">
            评价人
            <span class="sort"></span>
        </th>
        <th>评价状态</th>
        <!--排序样式sort默认，asc升序，desc降序-->
        <th data-sortname="shop_service">卖家的服务态度</th>
        <th data-sortname="shop_speed">
            卖家的发货速度
            <span class="sort desc"></span>
        </th>
        <th data-sortname="logistics_speed">
            物流公司的服务
            <span class="sort"></span>
        </th>
        <th data-sortname="order_sn">
            评价订单
            <span class="sort"></span>
        </th>
        <th data-sortname="shop_comment_add_time">
            评价时间
            <span class="sort"></span>
        </th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    @if(!empty($list))
        @foreach($list as $item)
            <tr>
                <!--b_blue_5.gif为钻级用户，1为一个钻，以此类推；b_red_4.gif为红心级用户；s_cap_4.gif为冠级用户-->
                <td>
                    <div class="ng-binding">
							<span>
								买家：
								<font class="c-blue">{{ $item['user_name'] }}</font>
							</span>
                        <span>
								<img src="{{ $item['user_rank_icon'] }}" class="rank" title="{{ $item['user_rank_name'] }}" data-toggle="tooltip" data-placement="auto bottom" />
							</span>
                    </div>
                </td>
                <td>
                    <label class="label {{ str_replace([0,1,2],['label-warning','label-green','label-danger'], $item['shop_comment_status']) }} m-l-0">
                        {{ str_replace([0,1,2],['待审核','审核通过','审核拒绝'], $item['shop_comment_status']) }}
                    </label>
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

            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td colspan="7">
            <div class="pull-left">
                <!--     <button id="delete-all" class="btn btn-danger mr5" type="button" data-action="delete-all" >删除</button>
                <button class="btn btn-default disabled mr5" type="button">禁用</button>
                <button class="btn btn-default" type="button">按钮1</button> -->
            </div>
            <div id="pagination" class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script>

    $().ready(function () {
        $(".pagination-goto > .goto-input").keyup(function (e) {
            $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
            if (e.keyCode == 13) {
                $(".pagination-goto > .goto-link").click();
            }
        });
        $(".pagination-goto > .goto-button").click(function () {
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
</script>