<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--复选框列样式tcheck，一般复选框样式checkBox,全选复选框样式在一般复选框样式后再新加allCheckBox样式-->
        <!--<th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox"></input>
            </th>-->
        <!--排序样式sort默认，asc升序，desc降序-->
        <th class="text-c w70" data-sortname="user_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <th class="w350" style="cursor: default;">会员信息</th>
        <th class="w120" style="cursor: default;">会员等级</th>
        <th class="w150">账户资金</th>
        <th class="w100">注册时间</th>
        <th class="w100">上次登录时间</th>
        <th class="w120" style="cursor: default;">会员状态</th>
        <!--操作列样式handle-->
        <th class="handle w150" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->

    @foreach($list as $v)
    <tr>
        <!--<td class="tcheck">
                <input value="{{ $v->user_id }}" type="checkbox" class="checkBox" />
            </td>-->

        <td class="text-c">{{ $v->user_id }}</td>

        <td class="va-top h100">
            <div class="userPicBox pull-left m-r-10">

                <!-- 头像、来源、角色 -->
                <img src="{{ get_image_url($v->headimg, 'headimg') }}" class="user-avatar">
                <span class="user-source">{{ format_user_reg_from($v->reg_from) }}</span>

                @if($v->is_seller == 1){{--店主--}}
                    <span class="user-label m-t-3 shopkeeper">店主</span>
                @elseif($v->is_seller == 2){{--网点管理员--}}
                    <span class="user-label m-t-3 store">网点管理员</span>
                @else
                    <span class="user-label m-t-3 person">个人</span>
                @endif

                <!--鼠标经过弹出显示用户信息-->
                <div class="user-info">
                    <ul>
                        <li class="user-title">
                            <h5>会员基本信息</h5>
                        </li>
                        <li class="form-group">
                            <span class="control-label">用户名：</span>
                            <span class="form-control-wrap"> {{ $v->user_name }} </span>
                        </li>
                        <li class="form-group">
                            <span class="control-label">昵称：</span>
                            <span class="form-control-wrap">{{ $v->nickname }}</span>
                        </li>
                        <li class="form-group">
                            <span class="control-label">性别：</span>
                            <span class="form-control-wrap">{{ format_sex($v->sex) }}</span>
                        </li>
                        <li class="form-group">
                            <span class="control-label">出生日期：</span>
                            <span class="form-control-wrap">{{ format_time(strtotime($v->birthday), 'Y-m-d') }}</span>
                        </li>
                        <li class="form-group">
                            <span class="control-label">邮箱：</span>
                            <span class="form-control-wrap">{{ $v->email }}</span>
                        </li>
                        <li class="form-group">
                            <span class="control-label">手机号：</span>
                            <span class="form-control-wrap">{{ $v->mobile }}</span>
                        </li>
                        <li class="form-group" style="width: 100%;">
                            <span class="control-label">现居住地址：</span>
                            <span class="form-control-wrap">{{ get_region_names_by_region_code($v->address_now) }} {{ $v->detail_address }}</span>
                        </li>

                        <li class="form-group">
                            <span class="control-label">注册来源：</span>
                            <span class="form-control-wrap">{{ format_user_reg_from($v->reg_from) }}</span>
                        </li>

                        <li class="form-group">
                            <span class="control-label">登录次数：</span>
                            <span class="form-control-wrap">{{ $v->visit_count }}</span>
                        </li>

                        <li class="form-group">
                            <span class="control-label">注册IP地址：</span>
                            <span class="form-control-wrap">{{ $v->reg_ip }}</span>
                        </li>
                        <li class="form-group">
                            <span class="control-label">上次登录IP：</span>
                            <span class="form-control-wrap">{{ $v->last_ip }}</span>
                        </li>
                        <!-- <li class="form-group">
                                <span class="control-label">IP所在地：</span>
                                <span class="form-control-wrap"></span>
                            </li>
                            <li class="form-group">
                                <span class="control-label">上次登录IP所在地：</span>
                                <span class="form-control-wrap"></span>
                            </li> -->

                        <li class="form-group">
                            <span class="control-label">注册时间：</span>
                            <span class="form-control-wrap">{{ $v->reg_time }}</span>
                        </li>
                        <li class="form-group">
                            <span class="control-label">上次登录时间：</span>
                            <span class="form-control-wrap">{{ $v->last_login }}</span>
                        </li>
                        <li class="user-title p-t-5">
                            <h5>会员实名认证信息</h5>
                        </li>
                        @if($v->is_real)
                            <li class="form-group">
									<span class="control-label  yes">
										<i class="fa card"></i>
										真实姓名：
									</span>
                                <span class="form-control-wrap">{{ $v->userReal->real_name }}</span>
                            </li>
                            <li class="form-group">
                                <span class="control-label">身份证号码：</span>
                                <span class="form-control-wrap">{{ $v->userReal->id_code }}</span>
                            </li>
                        @else
                            <li class="form-group">
                            <span class="control-label ">
                                <i class="fa card"></i>
                                真实姓名：
                            </span>
                                <span class="form-control-wrap">未认证</span>
                            </li>
                            <li class="form-group">
                                <span class="control-label">身份证号码：</span>
                                <span class="form-control-wrap"></span>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>

            <div class="ng-binding user-message w250">
                @if($v->is_real)
                    <span class="name yes">

                        {{ $v->user_name }}

                        <font class="c-blue">
                            <i class="fa card"></i>
                        </font>
                    </span>
                @else
                    <span class="name">

                        {{ $v->user_name }}

                        <font class="">
                            <i class="fa card"></i>
                        </font>
                    </span>
                @endif


                <span class="mail">
							<i class="fa fa-envelope-o"></i>
							：{{ $v->email }}
						</span>
                <span class="tel">
							<i class="fa fa-tablet"></i>
							：{{ $v->mobile }}
						</span>

                @if($v->is_seller == 1){{--店主--}}
                    <span title="{{ $v->shop->shop_name }}">（{{ $v->shop->shop_name }}）</span>
                @elseif($v->is_seller == 2){{--网点管理员--}}
                    <span title="{{ $v->shop->shop_name }}-{{ $v->store->store_name }}网点管理员">（{{ $v->shop->shop_name }}-{{ $v->store->store_name }}网点管理员）</span>
                @endif
                <!-- 会员标签
                <span class="m-b-0 m-t-5"> <em class="tag">新用户</em> </span>
                 -->
            </div>
        </td>

        <td>
            <div class="ng-binding">
                <span>注册会员</span>
                <span>成长值：0点</span>
            </div>
        </td>

        <td>
            <div class="ng-binding">
                <span>可用余额：￥{{ $v->user_money }}</span>
                <span>冻结资金：￥{{ $v->user_money_limit }}</span>
            </div>
        </td>

        <td>
            <div class="ng-binding">
                <span>{{ $v->reg_time }}</span>
            </div>
        </td>

        <td>
            <div class="ng-binding">
                <span>{{ $v->last_login }}</span>
            </div>
        </td>

        <td>
            <div class="ng-binding">
                <span>
                    允许登录：
                    @if($v->status == 1)
                        <span data-action="set-status?id={{ $v->user_id }}&amp;type=status" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                    @else
                        <span data-action="set-status?id={{ $v->user_id }}&amp;type=status" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                    @endif
                </span>
                <span>
                    允许购物：
                    @if($v->shopping_status == 1)
                        <span data-action="set-status?id={{ $v->user_id }}&amp;type=shopping_status" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                    @else
                        <span data-action="set-status?id={{ $v->user_id }}&amp;type=shopping_status" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                    @endif
                </span>
                <span>
                    允许评价：
                    @if($v->comment_status == 1)
                        <span data-action="set-status?id={{ $v->user_id }}&amp;type=comment_status" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                    @else
                        <span data-action="set-status?id={{ $v->user_id }}&amp;type=comment_status" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                    @endif
                </span>
            </div>
        </td>

        <td class="handle">

            <a href="/trade/order/list?uid={{ $v->user_id }}&amp;from=user">交易记录</a>
            <span>|</span>
            <a href="javascript:void(0);" class="edit-desc" data-id="{{ $v->user_id }}">备注</a>

            <a href="edit?id={{ $v->user_id }}">编辑</a>
            <span>|</span>
            <a href="del?id={{ $v->user_id }}" data-confirm="您确定要删除【{{ $v->user_name }}】此会员吗？" class="del border-none">删除</a>

        </td>
    </tr>
    {{--会员备注信息--}}
    @if(!empty($v->user_remark))
        <tr>
            <td colspan="8" class="userLabel">
                <p class="m-l-10">备注：{!! $v->user_remark !!}</p>
            </td>
        </tr>
    @endif
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <!--<td class="text-c w10">
                 <input type="checkbox" class="allCheckBox checkBox">
                </input>
            </td>-->
        <td colspan="8">
            <!-- <div class="pull-left">
                    <button class="btn btn-danger m-r-2" type="button">删除</button> -->
            <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            <!-- <button class="btn btn-default" type="button">批量设置</button>
                </div> -->
            <div id="pagination" class="pull-right page-box">


                {{--分页--}}
                {!! $pageHtml !!}


            </div>
        </td>
    </tr>
    </tfoot>
</table>