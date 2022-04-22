@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

@section('content')

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=trade" method="post" enctype="multipart/form-data" novalidate="novalidate">
        {{ csrf_field() }}
        <input type="hidden" name="group" value="trade">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">


            <h5 class="m-b-30 m-t-0" data-anchor="基本设置">
                基本设置 		</h5>



            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-send_time" class="col-sm-4 control-label">

                        <span class="ng-binding">送货时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[send_time]" value="0">
                            <div id="systemconfigmodel-send_time" class="" name="SystemConfigModel[send_time]">
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[send_time][]"
                                                                                 value="1" @if(in_array(1, $group_info['send_time']->value)) checked="" @endif> 立即配送</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[send_time][]"
                                                                                 value="2" @if(in_array(2, $group_info['send_time']->value)) checked="" @endif> 工作日/周末/假日均可</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[send_time][]"
                                                                                 value="3" @if(in_array(3, $group_info['send_time']->value)) checked="" @endif> 仅周末送货</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[send_time][]"
                                                                                 value="4" @if(in_array(4, $group_info['send_time']->value)) checked="" @endif> 仅工作日送货</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[send_time][]"
                                                                                 value="5" @if(in_array(5, $group_info['send_time']->value)) checked="" @endif> 指定送货时间</label>
                            </div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制结算页面的送货时间选项</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field" @if(!in_array(5, $group_info['send_time']->value))style="display: none;"@endif>
                <div class="form-group">
                    <label for="systemconfigmodel-shipping_time" class="col-sm-4 control-label">

                        <span class="ng-binding">指定送货时间段：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">






                            @php
                                $shipping_time = json_decode($group_info['shipping_time']->value, true);
                            @endphp
                            <div class="form-control-box" id="shipping_time_box">
                                <table class="table table-bordered shop-time-table">
                                    <thead>
                                    <tr>
                                        <th>周一</th>
                                        <th>周二</th>
                                        <th>周三</th>
                                        <th>周四</th>
                                        <th>周五</th>
                                        <th>周六</th>
                                        <th>周日</th>
                                        <th class="w150 text-c">开始时间</th>
                                        <th class="w150 text-c">结束时间</th>
                                        <th class="handle w50">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach(range(0, 6) as $item)
                                            <td>
                                                @if(!empty($shipping_time['week']))
                                                    <input class="check" type="checkbox" name="shippingtime[week][]"
                                                           value="{{ $item }}" @if(in_array($item, @$shipping_time['week'])) checked="checked" @endif  />
                                                @else
                                                    <input class="check" type="checkbox" name="shippingtime[week][]"
                                                           value="{{ $item }}"  />
                                                @endif
                                            </td>
                                        @endforeach

                                        <td class="time-panel" colspan="3">
                                            <!--点击新建营业时间按钮每次添加time-subtime一个DIV内容，默认只显示一个-->

                                            @if(!empty($shipping_time['time_arr']))
                                                @foreach($shipping_time['time_arr'] as $item)
                                                    <div class="time-subtime">
                                                        <div class="time-select">
                                                            <select name="shippingtime[begin_hour][]" class="select form-control m-r-5">
                                                            @foreach(get_day_hours() as $hk=>$h)
                                                                <!--   -->
                                                                    <option value="{{ $h }}" @if($item['begin_hour'] == $h) selected="selected" @endif>{{ $h }}</option>
                                                                @endforeach

                                                            </select>
                                                            :
                                                            <select name="shippingtime[begin_minute][]" class="select form-control m-l-5">
                                                            @foreach(get_hour_minutes() as $hk=>$h)
                                                                <!--   -->
                                                                    <option value="{{ $h }}" @if($item['begin_minute'] == $h) selected="selected" @endif>{{ $h }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="time-select">
                                                            <select name="shippingtime[end_hour][]" class="select form-control m-r-5">
                                                            @foreach(get_day_hours() as $hk=>$h)
                                                                <!--   -->
                                                                    <option value="{{ $h }}" @if($item['end_hour'] == $h) selected="selected" @endif>{{ $h }}</option>
                                                                @endforeach

                                                            </select>
                                                            :
                                                            <select name="shippingtime[end_minute][]" class="select form-control m-l-5">
                                                            @foreach(get_hour_minutes() as $hk=>$h)
                                                                <!--   -->
                                                                    <option value="{{ $h }}" @if($item['end_minute'] == $h) selected="selected" @endif>{{ $h }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="handle">
                                                            <a id="del_opentime" class="c-blue" href="javascript:void(0);">删除</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="time-subtime">
                                                    <div class="time-select">
                                                        <select name="shippingtime[begin_hour][]" class="select form-control m-r-5">
                                                        @foreach(get_day_hours() as $hk=>$h)
                                                            <!--   -->
                                                                <option value="{{ $h }}" >{{ $h }}</option>
                                                            @endforeach

                                                        </select>
                                                        :
                                                        <select name="shippingtime[begin_minute][]" class="select form-control m-l-5">
                                                        @foreach(get_hour_minutes() as $hk=>$h)
                                                            <!--   -->
                                                                <option value="{{ $h }}" >{{ $h }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="time-select">
                                                        <select name="shippingtime[end_hour][]" class="select form-control m-r-5">
                                                        @foreach(get_day_hours() as $hk=>$h)
                                                            <!--   -->
                                                                <option value="{{ $h }}" >{{ $h }}</option>
                                                            @endforeach

                                                        </select>
                                                        :
                                                        <select name="shippingtime[end_minute][]" class="select form-control m-l-5">
                                                        @foreach(get_hour_minutes() as $hk=>$h)
                                                            <!--   -->
                                                                <option value="{{ $h }}" >{{ $h }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="handle">
                                                        <a id="del_opentime" class="c-blue" href="javascript:void(0);">删除</a>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="time-subtime add-btn text-c">
                                                <a id="add_opentime" class="btn btn-primary">+ 新建送货时间</a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" id="systemconfigmodel-shipping_time" class="form-control" name="SystemConfigModel[shipping_time]" value="{!! $group_info['shipping_time']->value !!}">





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">买家购物结算时，供选择的指定送货时间的时间间段 <br>说明：消费者下单时间+1个小时小于配送时间段的开始时间或消费者下单时间+1个小时小于配送时间段的结束时间，那么此时间段消费者是可以选择的</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-send_time_desc" class="col-sm-4 control-label">

                        <span class="ng-binding">送货时间描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <textarea id="systemconfigmodel-send_time_desc" class="form-control" name="SystemConfigModel[send_time_desc]" rows="5">{!! $group_info['send_time_desc']->value !!}</textarea>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置结算页面的送货时间旁边的备注说明</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-invoice_contents" class="col-sm-4 control-label">

                        <span class="ng-binding">发票内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <textarea id="systemconfigmodel-invoice_contents" class="form-control" name="SystemConfigModel[invoice_contents]" rows="5">{!! $group_info['invoice_contents']->value !!}</textarea>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制结算页面内发票的内容，如果为空则默认为：明细、办公用品、电脑配件、耗材；多个选项之间请用回车换行来区分</div></div>
                    </div>
                </div>
            </div>







            <input type="hidden" id="systemconfigmodel-pay_by_integral" class="form-control" name="SystemConfigModel[pay_by_integral]" value="1">


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-shipping_name" class="col-sm-4 control-label">

                        <span class="ng-binding">配送方式名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-shipping_name" class="form-control" name="SystemConfigModel[shipping_name]" value="{{ $group_info['shipping_name']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">结算页面，消费者选择的快递配送方式的名称，将影响平台、卖家订单列表搜索条件选项，订单详情配送方式内容展示，结算页面配送方式名称</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-self_shipping_name" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="systemconfigmodel-self_shipping_name" class="form-control" name="SystemConfigModel[self_shipping_name]" value="{{ $group_info['self_shipping_name']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">结算页面，消费者选择的自提方式的名称，将影响平台、卖家订单列表搜索条件选项，订单详情配送方式内容展示，结算页面配送方式名称、商品详情页查看自提点展示项名称</div></div>
                    </div>
                </div>
            </div>









            <h5 class="m-b-30 m-t-30" data-anchor="订单设置">
                订单设置 		</h5>



            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-pay_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">付款期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-pay_term" class="form-control" name="SystemConfigModel[pay_term]" value="{{ $group_info['pay_term']->value }}" style="width: 192px;">



                            <select id="systemconfigmodel-pay_term_unit" name="SystemConfigModel[pay_term_unit]" class="form-control m-l-5 valid pay-term-unit">
                                <option value="0" @if($group_info['pay_term_unit']->value == 0) selected="selected" @endif>天</option>
                                <option value="1" @if($group_info['pay_term_unit']->value == 1) selected="selected" @endif>小时</option>
                                <option value="2" @if($group_info['pay_term_unit']->value == 2) selected="selected" @endif>分钟</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">付款期限不能小于15分钟，默认为1天：自下单1天内，买家尚未付款的订单，系统会自动取消订单；</div></div>
                    </div>
                </div>
            </div>














            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-take_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">接单期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-take_term" class="form-control" name="SystemConfigModel[take_term]" value="{{ $group_info['take_term']->value }}" style="width: 192px;">



                            <select id="systemconfigmodel-take_term_unit" name="SystemConfigModel[take_term_unit]" class="form-control m-l-5 valid take-term-unit">
                                <option value="0" @if($group_info['pay_term_unit']->value == 0) selected="selected" @endif>天</option>
                                <option value="1" @if($group_info['pay_term_unit']->value == 1) selected="selected" @endif>小时</option>
                                <option value="2" @if($group_info['pay_term_unit']->value == 2) selected="selected" @endif>分钟</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于控制开启接单模式店铺的接单期限，接单期限不能小于5分钟，默认为10分钟：自下单付款后10分钟内，卖家尚未接单的订单，系统将会自动取消订单；</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-receiving_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">确认收货期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-receiving_term" class="form-control" name="SystemConfigModel[receiving_term]" value="{{ $group_info['receiving_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为7天：自发货起7天内，买家尚未确认收货的订单，系统会自动确认收货</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-extend_receiving_days" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">延长收货时间(天)：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




		<textarea id="systemconfigmodel-extend_receiving_days" class="form-control" name="SystemConfigModel[extend_receiving_days]" rows="5">{!! $group_info['extend_receiving_days']->value !!}</textarea>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">买家或卖家可主动延长收货时间，让买家有更多时间来“确认收货”,请用回车添加多项</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-user_close_trad_reason" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">买家关闭交易的理由：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




		<textarea id="systemconfigmodel-user_close_trad_reason" class="form-control" name="SystemConfigModel[user_close_trad_reason]" rows="5">{!! $group_info['user_close_trad_reason']->value !!}</textarea>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">买家在关闭订单时，可选择关闭该交易的理由，多个理由请使用回车换行</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-close_trad_reason" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">卖家关闭交易的理由：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




		<textarea id="systemconfigmodel-close_trad_reason" class="form-control" name="SystemConfigModel[close_trad_reason]" rows="5">{!! $group_info['close_trad_reason']->value !!}</textarea>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">卖家在关闭订单时，可选择关闭该交易的理由，多个理由请使用回车换行</div></div>
                    </div>
                </div>
            </div>






            <h5 class="m-b-30 m-t-30" data-anchor="退款退货设置">
                退款退货设置 		</h5>



            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-is_refund_review" class="col-sm-4 control-label">

                        <span class="ng-binding">退款申请是否需要审核：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[is_refund_review]" value="0">
                                    <label>
                                        <input type="checkbox"
                                               id="systemconfigmodel-is_refund_review"
                                               class="form-control b-n"
                                               name="SystemConfigModel[is_refund_review]"
                                               value="1" @if($group_info['is_refund_review']->value == 1)checked="" @endif
                                               data-on-text="是" data-off-text="否"></label>
                                </div>
                            </label>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">退款退货受交易设置处的退款申请是否需要审核控制，如果需要审核，则平台方需要对退款退货信息进行核实和确认</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-back_seller_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">申请退款卖家确认期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-back_seller_term" class="form-control" name="SystemConfigModel[back_seller_term]" value="{{ $group_info['back_seller_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为7天：自买家申请退款（仅退款/退款退货）起7天内，卖家尚未操作的，系统会自动同意申请</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-buyer_update_back_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">卖家拒绝退款申请，买家修改退款期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-buyer_update_back_term" class="form-control" name="SystemConfigModel[buyer_update_back_term]" value="{{ $group_info['buyer_update_back_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为7天：自卖家拒绝退款申请起7天内，买家未修改退款申请信息，系统自动取消申请</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-back_buyer_send_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">退款退货买家发货期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-back_buyer_send_term" class="form-control" name="SystemConfigModel[back_buyer_send_term]" value="{{ $group_info['back_buyer_send_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为7天：自卖家（系统）同意退款退货申请起7天内，买家尚未发货的，系统会自动取消申请</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-back_seller_recive_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">退款退货卖家确认收货期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-back_seller_recive_term" class="form-control" name="SystemConfigModel[back_seller_recive_term]" value="{{ $group_info['back_seller_recive_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为7天：自买家寄回退货商品起7天内，卖家尚未确认收货的，系统会自动将退款退货信息推送至平台方</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-refund_reason" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">申请退款的原因：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




		<textarea id="systemconfigmodel-refund_reason" class="form-control" name="SystemConfigModel[refund_reason]" rows="5">{!! $group_info['refund_reason']->value !!}</textarea>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">买家在申请退款时，可选择退款的原因，多个原因请使用回车换行</div></div>
                    </div>
                </div>
            </div>






            <h5 class="m-b-30 m-t-30" data-anchor="售后设置">
                售后设置 		</h5>



            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-customer_service_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">申请售后期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-customer_service_term" class="form-control" name="SystemConfigModel[customer_service_term]" value="{{ $group_info['customer_service_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为15天：自买家确认收货起15天内，可且申请退款（仅退款/退款退货）、换货维修服务</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-seller_service_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">卖家处理售后期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-seller_service_term" class="form-control" name="SystemConfigModel[seller_service_term]" value="{{ $group_info['seller_service_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为5天：自买家申请换货、维修起5天内，卖家未处理换货、维修申请，系统自动同意换货、维修</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-customer_modify_service_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">卖家拒绝售后申请，买家修改期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-customer_modify_service_term" class="form-control" name="SystemConfigModel[customer_modify_service_term]" value="{{ $group_info['customer_modify_service_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为7天：自卖家拒绝售后申请起7天内，买家未修改售后申请信息，系统会自动取消申请</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-customer_finish_service_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">买家完成售后期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-customer_finish_service_term" class="form-control" name="SystemConfigModel[customer_finish_service_term]" value="{{ $group_info['customer_finish_service_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为15天：自卖家同意换货、维修起15天内，买家未确认完成换货、维修，系统自动触发完成换货、维修</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-repair_reason" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">申请维修的原因：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <textarea id="systemconfigmodel-repair_reason" class="form-control" name="SystemConfigModel[repair_reason]" rows="5">{!! $group_info['repair_reason']->value !!}</textarea>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">买家在申请维修时，可选择维修的原因，多个原因请使用回车换行</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-exchange_reason" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">申请换货的原因：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




		<textarea id="systemconfigmodel-exchange_reason" class="form-control" name="SystemConfigModel[exchange_reason]" rows="5">{!! $group_info['exchange_reason']->value !!}</textarea>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">买家在申请换货时，可选择换货的原因，多个原因请使用回车换行</div></div>
                    </div>
                </div>
            </div>






            <h5 class="m-b-30 m-t-30" data-anchor="投诉设置">
                投诉设置 		</h5>



            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-complaint_seller_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">投诉卖家期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-complaint_seller_term" class="form-control" name="SystemConfigModel[complaint_seller_term]" value="{{ $group_info['complaint_seller_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为15天：自买家确认收货的15天内，可投诉卖家</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-seller_ps_complain_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">卖家处理投诉期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-seller_ps_complain_term" class="form-control" name="SystemConfigModel[seller_ps_complain_term]" value="{{ $group_info['seller_ps_complain_term']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认为3天：自买家发起投诉起3天内，卖家未处理或处理结果买家未满意，买家可申请平台方介入处理</div></div>
                    </div>
                </div>
            </div>







            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-complaint_reason" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">投诉卖家的原因：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




		<textarea id="systemconfigmodel-complaint_reason" class="form-control" name="SystemConfigModel[complaint_reason]" rows="5">{!! $group_info['complaint_reason']->value !!}</textarea>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">买家在投诉卖家时，可选择投诉的原因，多个原因请使用回车换行</div></div>
                    </div>
                </div>
            </div>






            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">
                {{--<input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">--}}
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>

        </div>
    </form>

@stop

@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

@section('footer_script')

    {!! $script_render !!}

@stop