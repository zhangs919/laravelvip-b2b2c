<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--复选框列样式tcheck，一般复选框样式checkBox,全选复选框样式在一般复选框样式后再新加allCheckBox样式-->
        <th class="tcheck w10">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>

        <!--排序样式sort默认，asc升序，desc降序-->
        <th class="w70 text-c" data-sortname="user_id">编号</th>
        <th class="w300" data-sortname="user_name">会员信息</th>
        <!--<th class="text-c" data-sortname="e.type">
            个人/企业
            <span class="sort"></span>
        </th>-->
        <th class="w100" data-sortname="rank_name">
            会员等级
            <span class="sort"></span>
        </th>
        <th class="w90" data-sortname="tradin">
            交易总额
            <span class="sort"></span>
        </th>
        <th class="w90" data-sortname="tradin_count">
            交易笔数
            <span class="sort"></span>
        </th>
        <th class="w100" data-sortname="tradin_avg">
            平均交易额
            <span class="sort"></span>
        </th>
        <th class="w120" data-sortname="last_tradin">
            上次交易时间
            <span class="sort"></span>
        </th>
        <th class="handle w150">操作</th>
        <!-- -->
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <!--以下为循环内容-->
    <!---->
    <!---->
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" />
        </td>
        <td class="text-c">{{ $v->user_id }}</td>
        <td>
            <div class="userPicBox pull-left m-r-10">
                <img src="{{ get_image_url($v->user->headimg, 'headimg') }}" data-original="{{ get_image_url($v->user->headimg, 'headimg') }}" class="user-avatar lazy" />
                <!-- <span class="user-source"></span> -->
            </div>
            <div class="ng-binding user-message w200">
							<span class="name">

								{{ $v->user->nickname }}

								<font class="">
									<i class="fa card"></i>
								</font>
							</span>
                <span class="mail">
								<i class="fa fa-envelope-o"></i>
								：
							</span>
                <span class="tel yes">
								<i class="fa fa-tablet"></i>
								：{{ $v->user->mobile }} @if(!empty(get_mobile_area($v->user->mobile))){{ get_mobile_area($v->user->mobile)['type'] }}{{ get_mobile_area($v->user->mobile)['location'] }} @endif
							</span>

            </div>
        </td>
        <!--<td class="text-c"></td>-->
        <td>
            <div class="ng-binding">
                <!---->
                <span>普通会员（VIP1）</span>

                <span>折扣：10.00</span>


            </div>
        </td>
        <td>0.00</td>

        <td class="handle text-l">
            <font color="f14">
                <a href="javascript:;" class="disabled">0</a>
            </font>
        </td>

        <td>0</td>
        <td></td>
        <td class="handle">
            <div class="ng-binding">
							<span class="text-c">
								<a href="/member/member/user-info?id={{ $v->user_id }}">详情</a>
								<a href="/trade/order/list?uid={{ $v->user_id }}&from=user&order_status=finished">交易记录</a>
							</span>
                <span class="text-c">
								<a href="javascript:;" class="edit-desc" data-id="{{ $v->member_id }}" data-type="" data-order="">备注</a>

								<a href="javascript:;" class="add-to-erp" data-id="{{ $v->user_id }}">添加到erp</a>

							</span>
            </div>
        </td>
    </tr>
    @if(!empty($v->member_remark))
    <tr>
        <td colspan="9" class="userLabel">
            <p class="m-l-10">备注：{{ $v->member_remark }}</p>
        </td>
    </tr>
    @endif
    <!---->
    <!---->
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <!--<td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>  -->
        <!---->
        <td colspan="9">
            <!---->
            <!---->
            <div class="pull-left">
                <!--暂无-->
                <select class="form-control w100 m-r-5" style="display: none">
                    <option value="0">请选择批量设置项</option>
                    <option value="1">会员等级</option>
                    <option value="2">会员折扣</option>
                    <option value="3">禁止购买</option>
                </select>
                <!-- <button id="delete-all" class="btn btn-danger mr5" type="button" data-action="delete-all">批量设置</button>		<button class="btn btn-default disabled mr5" type="button">禁用</button>
                <button class="btn btn-default" type="button">按钮1</button> -->
            </div>
            <!---->
            <div id="pagination" class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>