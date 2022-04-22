@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

@section('content')

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=captcha" method="post" enctype="multipart/form-data" novalidate="novalidate">
        {{ csrf_field() }}
        <input type="hidden" name="group" value="captcha">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">


            <h5 class="m-b-30 m-t-0" data-anchor="图片验证码">
                图片验证码 		</h5>




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-captcha_code" class="col-sm-4 control-label">

                        <span class="ng-binding">启用图片验证码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[captcha_code]" value="0">
                            <div id="systemconfigmodel-captcha_code" class="" name="SystemConfigModel[captcha_code]">
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[captcha_code][]" value="1" @if(in_array(1,$group_info['captcha_code']->value)) checked="" @endif> 后台管理员登录</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[captcha_code][]" value="2" @if(in_array(2,$group_info['captcha_code']->value)) checked="" @endif> 前台新用户注册</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[captcha_code][]" value="3" @if(in_array(3,$group_info['captcha_code']->value)) checked="" @endif> 前台用户登录</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="SystemConfigModel[captcha_code][]" value="4" @if(in_array(4,$group_info['captcha_code']->value)) checked="" @endif> 前台动态密码登录</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">商城会员在商城内进行身份验证时，如果验证失败次数超过3次后将强制开启图片验证码，验证成功后将重置验证失败次数</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-captcha_login_fail" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">登录失败时显示图片验证码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[captcha_login_fail]" value="0">
                                    <label>
                                        <input type="checkbox"
                                               id="systemconfigmodel-captcha_login_fail"
                                               class="form-control b-n"
                                               name="SystemConfigModel[captcha_login_fail]"
                                               value="1" @if($group_info['captcha_login_fail']->value == 1)checked="" @endif
                                               data-on-text="是" data-off-text="否"></label>
                                </div>
                            </label>



                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择“是”，将在用户登录失败 3 次后才显示验证码；选择“否”，将始终在登录时显示验证码<br>注意：只有在启用了后台管理员登录和前台用户登录时本设置才有效</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-captcha_noise" class="col-sm-4 control-label">

                        <span class="ng-binding">图片验证码干扰点：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-captcha_noise" class="form-control ipt" name="SystemConfigModel[captcha_noise]" value="{{ $group_info['captcha_noise']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认无</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-captcha_curve" class="col-sm-4 control-label">

                        <span class="ng-binding">图片验证码干扰线：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-captcha_curve" class="form-control ipt" name="SystemConfigModel[captcha_curve]" value="{{ $group_info['captcha_curve']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认无</div></div>
                    </div>
                </div>
            </div>






            <h5 class="m-b-30 m-t-30" data-anchor="短信验证码">
                短信验证码 		</h5>




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-captcha_sms_max" class="col-sm-4 control-label">

                        <span class="ng-binding">短信验证码控制：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            商城在每日发送短信验证码超过


                            <input type="text" id="systemconfigmodel-captcha_sms_max" class="form-control ipt m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_max]" value="{{ $group_info['captcha_sms_max']->value }}">



                            条，将强制相关业务输入图片验证码


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">今日已发送短信验证码<span class="c-red m-l-5 m-r-5">0</span>条</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-captcha_sms_mobile_max" class="col-sm-4 control-label">

                        <span class="ng-binding">每个手机号码地址短信验证码控制：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            同一业务内，每个&nbsp;&nbsp;手机号码&nbsp;&nbsp;在<input type="text" id="systemconfigmodel-captcha_sms_mobile_time" class="form-control ipt valid m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_mobile_time]" value="{{ $group_info['captcha_sms_mobile_time']->value }}">分钟内，发送短信验证码超过


                            <input type="text" id="systemconfigmodel-captcha_sms_mobile_max" class="form-control ipt m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_mobile_max]" value="{{ $group_info['captcha_sms_mobile_max']->value }}">



                            条，将被系统认定发送验证码过于频繁，限制<input type="text" id="systemconfigmodel-captcha_sms_mobile_interval" class="form-control ipt valid m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_mobile_interval]" value="{{ $group_info['captcha_sms_mobile_interval']->value }}">分钟之后恢复正常


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">两次短信验证码发送的时间间隔为60秒</div></div>
                    </div>
                </div>
            </div>






















            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-captcha_sms_ip_max" class="col-sm-4 control-label">

                        <span class="ng-binding">每个IP地址短信验证码控制：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            同一业务内，每个&nbsp;&nbsp;&nbsp;&nbsp;IP地址&nbsp;&nbsp;&nbsp;&nbsp;在<input type="text" id="systemconfigmodel-captcha_sms_ip_time" class="form-control ipt valid m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_ip_time]" value="{{ $group_info['captcha_sms_ip_time']->value }}">分钟内，发送短信验证码超过


                            <input type="text" id="systemconfigmodel-captcha_sms_ip_max" class="form-control ipt m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_ip_max]" value="{{ $group_info['captcha_sms_ip_max']->value }}">



                            条，将被系统认定发送验证码过于频繁，限制<input type="text" id="systemconfigmodel-captcha_sms_ip_interval" class="form-control ipt valid m-l-5 m-r-5" name="SystemConfigModel[captcha_sms_ip_interval]" value="{{ $group_info['captcha_sms_ip_interval']->value }}">分钟之后恢复正常


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">两次短信验证码发送的时间间隔为60秒</div></div>
                    </div>
                </div>
            </div>






















            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-captcha_sms_limit" class="col-sm-4 control-label">

                        <span class="ng-binding">短信验证码发送频繁限制方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[captcha_sms_limit]" value="0"><div id="systemconfigmodel-captcha_sms_limit" class="" name="SystemConfigModel[captcha_sms_limit]"><label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[captcha_sms_limit]" value="0" checked=""> 禁止发送短信验证码</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[captcha_sms_limit]" value="1"> 强制输入图片验证码</label></div>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">短信验证码发送过于频繁后系统采取的策略<br><span style="color: red;">用户在禁止发送短信验证码情况下依然请求发送短信验证码的接口也会被强制要求输入图片验证码的</span></div></div>
                    </div>
                </div>
            </div>






            <div class="bottom-btn p-b-30">
                {{--<input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">--}}
                <input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">
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