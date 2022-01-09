@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=distrib" method="post" enctype="multipart/form-data" novalidate="novalidate">
            {{ csrf_field() }}
            <h5 class="m-b-30 m-t-0">基本信息</h5>
            <input type="hidden" name="group" value="distrib">
            <input type="hidden" name="tabs" value="">
            <!-- 是否开启推荐分销 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-is_distrib" class="col-sm-4 control-label">

                        <span class="ng-binding">是否开启推荐分销：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[is_distrib]" value="0"><label><div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-systemconfigmodel-is_distrib bootstrap-switch-animate" style="width: 54px;"><div class="bootstrap-switch-container" style="width: 78px; margin-left: -26px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 26px;">是</span><span class="bootstrap-switch-label" style="width: 26px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 26px;">否</span><input type="checkbox" id="systemconfigmodel-is_distrib" class="form-control b-n" name="SystemConfigModel[is_distrib]" value="1" data-on-text="是" data-off-text="否"></div></div> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 分销商申请是否需要审核 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-is_distributor_audit" class="col-sm-4 control-label">

                        <span class="ng-binding">分销商申请是否需要审核：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[is_distributor_audit]" value="0"><label><div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-systemconfigmodel-is_distributor_audit bootstrap-switch-animate" style="width: 54px;"><div class="bootstrap-switch-container" style="width: 78px; margin-left: -26px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 26px;">是</span><span class="bootstrap-switch-label" style="width: 26px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 26px;">否</span><input type="checkbox" id="systemconfigmodel-is_distributor_audit" class="form-control b-n" name="SystemConfigModel[is_distributor_audit]" value="1" data-on-text="是" data-off-text="否"></div></div> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启后，会员申请成为分销商后，需要平台进行审核，审核通过才能成为分销商</div></div>
                    </div>
                </div>
            </div>
            <!-- 成为分销商的必备条件 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-distributor_condition" class="col-sm-4 control-label">

                        <span class="ng-binding">成为分销商的必备条件：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <label class="control-label cur-p"><input type="radio" class="" name="SystemConfigModel[distributor_condition]" value="0" checked=""> 关闭</label>

                            <label class="m-r-10">
                                <label class="control-label cur-p"><input type="radio" class="" name="SystemConfigModel[distributor_condition]" value="1"> 订单金额累计达到</label>

                                <input class="form-control ipt m-r-10" name="SystemConfigModel[distrib_order_money]" type="text" value="">

                                元
                            </label>

                            <label class="m-r-10">
                                <label class="control-label cur-p"><input type="radio" class="" name="SystemConfigModel[distributor_condition]" value="2"> 成交订单笔数累计达到</label>

                                <input class="form-control ipt m-r-10" name="SystemConfigModel[distrib_order_count]" type="text" value="">

                                笔
                            </label>



                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">提示：当会员的订单金额累计达到多少元或者订单成交笔数达到多少笔后，才能申请成为分销商</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否开启邀请码 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-is_invite_code" class="col-sm-4 control-label">

                        <span class="ng-binding">是否开启邀请码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[is_invite_code]" value="0"><label><div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-systemconfigmodel-is_invite_code bootstrap-switch-animate" style="width: 54px;"><div class="bootstrap-switch-container" style="width: 78px; margin-left: -26px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 26px;">是</span><span class="bootstrap-switch-label" style="width: 26px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 26px;">否</span><input type="checkbox" id="systemconfigmodel-is_invite_code" class="form-control b-n" name="SystemConfigModel[is_invite_code]" value="1" data-on-text="是" data-off-text="否"></div></div> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启后，分销商会拥有自己的推荐码，把推荐码介绍给朋友，新会员注册时输入推荐码就会成为该分销商的下级会员</div></div>
                    </div>
                </div>
            </div>
            <!-- 分销账户预留金额 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-distrib_reserve_money" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">分销账户预留金额：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-distrib_reserve_money" class="form-control ipt pull-none m-r-5" name="SystemConfigModel[distrib_reserve_money]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">预留金额是为防止商家操作撤销分成金额时，会员的分销账户中有余额可撤销，如果账户余额不足，将不能撤回</div></div>
                    </div>
                </div>
            </div>
            <!-- 返利方式 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-distrib_rebate_type" class="col-sm-4 control-label">

                        <span class="ng-binding">返利方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label cur-p"><input type="radio" class="" name="SystemConfigModel[distrib_rebate_type]" value="0" checked=""> 自动返利</label>

                            <label class="control-label cur-p"><input type="radio" class="" name="SystemConfigModel[distrib_rebate_type]" value="1"> 手动返利</label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">手动返利：商家需手动点击分成触发分成事件；自动返利：买家确认收货后，系统自动分成</div></div>
                    </div>
                </div>
            </div>
            <!-- 订单来源 -->

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-distrib_order_from" class="col-sm-4 control-label">

                        <span class="ng-binding">以下订单来源是否参与返利：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="SystemConfigModel[distrib_order_from]" value=""><div id="systemconfigmodel-distrib_order_from" class="" name="SystemConfigModel[distrib_order_from]"><label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[distrib_order_from][]" value="order_from_6"> 收银台订单</label></div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 发布分销商品是否需要审核 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-is_distrib_goods_audit" class="col-sm-4 control-label">

                        <span class="ng-binding">发布分销商品是否需要审核：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[is_distrib_goods_audit]" value="0"><label><div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-systemconfigmodel-is_distrib_goods_audit bootstrap-switch-animate" style="width: 54px;"><div class="bootstrap-switch-container" style="width: 78px; margin-left: -26px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 26px;">是</span><span class="bootstrap-switch-label" style="width: 26px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 26px;">否</span><input type="checkbox" id="systemconfigmodel-is_distrib_goods_audit" class="form-control b-n" name="SystemConfigModel[is_distrib_goods_audit]" value="1" data-on-text="是" data-off-text="否"></div></div> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <h5 class="m-b-30 m-t-30">自定义文字</h5>
            <!-- 分销 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-distrib_text" class="col-sm-4 control-label">

                        <span class="ng-binding">分销：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-distrib_text" class="form-control" name="SystemConfigModel[distrib_text]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">微商城分销申请流程中显示，申请结果中显示，申请后用户个人中心显示，分销中心显示</div></div>
                    </div>
                </div>
            </div>
            <!-- 分销商-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-distributor_text" class="col-sm-4 control-label">

                        <span class="ng-binding">分销商：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-distributor_text" class="form-control" name="SystemConfigModel[distributor_text]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">微商城个人中心显示、申请流程中显示、申请结果中显示</div></div>
                    </div>
                </div>
            </div>
            <!-- 推广页面提示语-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-share_hint" class="col-sm-4 control-label">

                        <span class="ng-binding">推广页面提示语：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-share_hint" class="form-control" name="SystemConfigModel[share_hint]">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">已成为分销商的用户，从微商城个人中心点击我的推广进入</div></div>
                    </div>
                </div>
            </div>

            <h5 class="m-t-30">分销比例设置</h5>

            <div class="alert alert-info br-0">
                <p>提示：微信官方规定不允许分销超出三级，系统分销等级可以添加至三级，但是不建议做三级分销，最好是做二级分销</p>
                <p>比例说明：如会员A推荐B，B推荐C，C购物后，C不获得返利，A、B均可按照以上现金返利百分比获得返利奖励，0表示关闭本级奖励，分佣比例总和不得超过100%</p>
            </div>



            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">推荐等级设置：</span>
                    </label>
                    <div class="col-sm-8">
                        <div id="set_rank">
                            <div class="form-control-box disp-block pull-none m-b-10 rank-level">
                                <label class="control-label">
                                    <a class="btn-link c-blue m-r-5">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                    <span class="level">1</span>
                                    级
                                </label>
                                <label class="control-label m-l-40">现金返利百分比：</label>
                                <input class="form-control ipt m-l-10 m-r-10 rank-value" placeholder="" name="SystemConfigModel[distrib_rank_value][rank][]" type="text" value="">
                                %
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="bottom-btn p-b-30 bottom-btn-fixed">
                <button id="btn_submit" class="btn btn-primary btn-lg">确认提交</button>
            </div>
        </form>

    </div>
    <div id="copy_source" style="display: none">
        <div class="form-control-box disp-block pull-none m-b-10 rank-level">
            <label class="control-label">
                <a class="btn-link c-blue m-r-5">
                    <i class="fa"></i>
                </a>
                <span class="level">2</span>
                级
            </label>
            <label class="control-label m-l-40">现金返利百分比：</label>
            <input class="form-control ipt m-l-10 m-r-10" placeholder="" name="SystemConfigModel[distrib_rank_value][rank][]" type="text" value="">
            %
        </div>
    </div>

@stop

@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

@section('footer_script')

    {!! $script_render !!}

@stop