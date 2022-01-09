@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

@section('content')

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=user" method="post" enctype="multipart/form-data" novalidate="novalidate">
        {{ csrf_field() }}
        <input type="hidden" name="group" value="user">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">


            <h5 class="m-b-30 m-t-0" data-anchor="用户基本信息">
                用户基本信息 		</h5>




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-username_prefix" class="col-sm-4 control-label">

                        <span class="ng-binding">会员用户名前缀：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-username_prefix" class="form-control ipt valid" name="SystemConfigModel[username_prefix]" aria-invalid="false">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">会员注册时生成会员的用户名的前缀，仅支持最多3个大写英文字母，为空则默认为“SZY”</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-user_auto_login" class="col-sm-4 control-label">

                        <span class="ng-binding">会员自动登录：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[user_auto_login]" value="0"><div id="systemconfigmodel-user_auto_login" class="" name="SystemConfigModel[user_auto_login]"><label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[user_auto_login][]" value="1" checked=""> PC端</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[user_auto_login][]" value="2" checked=""> 微商城</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制前台登录页面，是否允许自动登录，选择支持自动登录，方便会员快速登录商城系统</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-register_type" class="col-sm-4 control-label">

                        <span class="ng-binding">会员注册方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[register_type]" value="0"><div id="systemconfigmodel-register_type" class="" name="SystemConfigModel[register_type]"><label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[register_type][]" value="1" checked=""> 手机注册</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[register_type][]" value="2" checked=""> 邮箱注册</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">系统自带以上几种注册方式，如果您没有选择任何注册方式，网站将关闭注册</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-register_close_reason" class="col-sm-4 control-label">

                        <span class="ng-binding">关闭注册原因：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <textarea id="systemconfigmodel-register_close_reason" class="form-control" name="SystemConfigModel[register_close_reason]" rows="5">您好，由于网站系统升级，暂时关闭会员注册，给您带来不便敬请谅解!</textarea>




                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-show_rank_price" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">等级价格：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[show_rank_price]" value="0"><div id="systemconfigmodel-show_rank_price" class="" name="SystemConfigModel[show_rank_price]"><label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[show_rank_price]" value="0"> 查看全部等级价格</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[show_rank_price]" value="1"> 查看对应等级价格</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[show_rank_price]" value="2" checked=""> 高等级看低等级价格</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制前台商品详情页商品价格的显示规则，可设置不同会员等级对应不同商品价格<br>查看全部等级价格：等级价格对所有会员可见（包括游客）<br>查看对应等级价格：等级价格仅对对应等级会员可见<br>高等级看低等级价格：等级会员可看到对应等级及低于该等级的商品价格<br>店铺自定义商品会员价后，此等级价格设置将不起作用<br>系统开启平台统一会员等级和店铺自定义商品会员价后，此等级价格设置将不起作用</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-user_validate_password" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">登录密码身份验证：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[user_validate_password]" value="0"><div id="systemconfigmodel-user_validate_password" class="" name="SystemConfigModel[user_validate_password]"><label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[user_validate_password]" value="0" checked=""> 不支持</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[user_validate_password]" value="1"> 支持</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">在用户中心修改密码、手机号码等安全操作时，用于控制当会员绑定了手机号码或者邮箱后还是否支持通过登录密码进行身份验证；<br><span style="color: red;">如果会员未绑定手机号码或者邮箱则仅能通过登录密码进行身份验证，不受此项控制；</span></div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-monetary_rate" class="col-sm-4 control-label">

                        <span class="ng-binding">消费金额与赠送成长值比例：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-monetary_rate" class="form-control ipt" name="SystemConfigModel[monetary_rate]">



                            %


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">该值为大于0的数，例:设置为10，表明消费100元赠送10点成长值，取整计算，比如消费88.5元，则赠送8点成长值</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-max_growth_value" class="col-sm-4 control-label">

                        <span class="ng-binding">每笔订单最多赠送成长值：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-max_growth_value" class="form-control ipt" name="SystemConfigModel[max_growth_value]">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">填写0表明不限制最多赠送的成长值，例：设置为100，表明每笔订单最多赠送100点成长值</div></div>
                    </div>
                </div>
            </div>






            <h5 class="m-b-30 m-t-30" data-anchor="用户查看、购买商品权限">
                用户查看、购买商品权限 		</h5>




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-auth_enable" class="col-sm-4 control-label">

                        <span class="ng-binding">是否启用：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[auth_enable]" value="0"><label><div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-systemconfigmodel-auth_enable bootstrap-switch-animate" style="width: 54px;"><div class="bootstrap-switch-container" style="width: 78px; margin-left: -26px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 26px;">是</span><span class="bootstrap-switch-label" style="width: 26px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 26px;">否</span><input type="checkbox" id="systemconfigmodel-auth_enable" class="form-control b-n" name="SystemConfigModel[auth_enable]" value="1" data-on-text="是" data-off-text="否"></div></div> </label>
                                </div>
                            </label>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启后将控制用户查看、购买商品的权限</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-auth_see" class="col-sm-4 control-label">

                        <span class="ng-binding">查看商品价格权限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[auth_see]" value="0"><div id="systemconfigmodel-auth_see" class="" name="SystemConfigModel[auth_see]"><label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_see][]" value="-1" checked=""> 未登录用户</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_see][]" value="1" checked=""> 注册会员</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_see][]" value="2" checked=""> 铜牌会员</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_see][]" value="3" checked=""> 银牌会员</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_see][]" value="4" checked=""> 金牌会员</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_see][]" value="5" checked=""> 钻石会员</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择不同权限/会员等级的会员可查看商城商品价格，有购买商品权限必然有查看商品价格权限</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-auth_buy" class="col-sm-4 control-label">

                        <span class="ng-binding">购买商城商品权限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[auth_buy]" value="0"><div id="systemconfigmodel-auth_buy" class="" name="SystemConfigModel[auth_buy]"><label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_buy][]" value="-1" checked=""> 未登录用户</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_buy][]" value="1" checked=""> 注册会员</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_buy][]" value="2" checked=""> 铜牌会员</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_buy][]" value="3" checked=""> 银牌会员</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_buy][]" value="4" checked=""> 金牌会员</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[auth_buy][]" value="5" checked=""> 钻石会员</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择不同权限/会员等级的会员可购买商城商品，有购买商品权限必然有查看商品价格权限</div></div>
                    </div>
                </div>
            </div>






            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>

        </div></form>

@stop

@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

@section('footer_script')

    {!! $script_render !!}

@stop