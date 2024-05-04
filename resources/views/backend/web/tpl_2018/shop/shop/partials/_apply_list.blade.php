<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox"/>
        </th>
        <th class="w300" data-sortname="shop_name">店铺信息</th>
        <th class="text-c w100" data-sortname="user_name">店主帐号</th>
        <th class="w100" data-sortname="credit">申请时间</th>
        <th class="w120" data-sortname="cat_id">店铺所属分类</th>
        <th class="text-c w100" data-sortname="duration">开店时长</th>
        <th class="w150" data-sortname="insure_fee">待支付费用</th>
        <th class="text-c w100" data-sortname="shop_audit">审核状态</th>
        <!--操作列样式handle-->
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->shop_id }}" />
        </td>
        <td>
            <div class="userPicBox pull-left m-r-10">
                <img src="{{ get_image_url($v->shop_image, 'shop_image') }}" class="user-avatar"/>
            </div>
            <div class="ng-binding user-message w200">
                <span class="name" title="{{ $v->shop_name }}"> 店铺名称：{{ $v->shop_name }} </span>
                {{--<span class="name" title="北京站"> 所属站点：北京站 </span>--}}
                <span class="id">
                    店铺ID：{{ $v->shop_id }}
                    <font class="c-green m-l-10"> {{ str_replace([1,2],['个人店铺','企业店铺'], $v->shop_type) }}</font>
                </span>
            </div>
        </td>
        <td class="text-c">{{ $v->user_name }}</td>
        <td>{{ $v->created_at }}</td>
        <!-- 店铺所属分类 -->
        <td>{{ $v->cls_name }}<br></td>
        <!-- 开店时长 -->
        <td class="text-c">{{ $v->duration_format }}</td>
        <td>
            <div class="ng-binding">
							<span>
								平台使用费：
								<font class=" m-r-5">{{ $v->system_fee }}</font>
								元
							</span>
                <span>
								平台保证金：
								<font class=" m-r-5">{{ $v->insure_fee }}</font>
								元
							</span>
            </div>
        </td>
        <td class="text-c">

            @if($v->audit_status == 2)
                <font class="c-red">拒绝通过</font>
                <i class="c-yellow m-l-5 fa fa-exclamation-circle fail-info" data-fail-info="{{ $v->fail_info }}" style="cursor: pointer;"></i>
            @elseif($v->audit_status == 1)
                <font class="c-green">审核通过</font>
            @else
            <font class="c-red">待审核</font>
            @endif

        </td>
        <td class="handle">
            <a href="apply-edit?id={{ $v->shop_id }}&shop_type=1&audit=0&is_supply=0">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="{{ $v->shop_id }}" id="del" class="del">删除</a>

            @if($v->audit_status == 0)
            <a href="audit?id={{ $v->shop_id }}&audit=1&is_supply=0" data-confirm="您确定通过【{{ $v->shop_name }}】的申请吗？" class="active">通过</a>
            <span>|</span>
            <a href="apply-edit?id={{ $v->shop_id }}&shop_type=1&audit=2&is_supply=0" class="del active">拒绝</a>
            @endif

        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="8">

            <div class="pull-left">
                <input type="button" id="batch-pass" class="btn btn-primary" value="通过审核" />
            </div>

            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
