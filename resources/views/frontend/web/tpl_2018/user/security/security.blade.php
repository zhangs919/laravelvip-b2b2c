@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active">账户安全</li>
                </ul>
            </div>
            <div class="content-info">
                <div class="safe-user-info">
                    <h3>您的账户信息</h3>
                    <div class="user-pic">
				<span>
										<img src="{{ get_image_url($user_info->headimg, 'headimg') }}" />
									</span>
                    </div>
                    <div class="user-intro">
                        <dl>
                            <dt>登录账号：</dt>
                            <dd>{{ $user_info->user_name }}</dd>
                        </dl>
                        <dl>
                            <dt>绑定手机：</dt>
                            <dd> {{ hide_tel($user_info->mobile) }} </dd>
                        </dl>
                        <dl>
                            <dt>绑定邮箱：</dt>
                            <dd> 未绑定 </dd>
                        </dl>
                        <dl>
                            <dt>上次登录：</dt>
                            <dd>
    {{ $user_info->last_login }}（ |						<span> IP地址：</span>
                                {{ $user_info->last_ip }}

                                <span>
							（不是您登录的？请立即
							<a href="/user/security/edit-password.html" class="color">“更改密码”</a>
							）。
						</span>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="warn-box">
                    <p>
                        <span>当前安全级别：</span>
                        <strong>低</strong>
                        <i class="validated{{ $user_info->security_level ?? 1 }}"></i>
                        <span>（建议您启动全部安全设置，以保障账户及资金安全）</span>
                    </p>
                </div>
                <div id="safe" class="safe">
                    <div class="safe-list">
                        <div class="fore1">
                            <s class="safe-bg2"></s>
                            <strong>登录密码</strong>
                        </div>
                        <div class="fore2">
                            <span>已设置登录密码。</span>
                        </div>
                        <div class="fore3">
                            <a href="/user/security/edit-password.html" class="btn btn-specil">修改密码</a>
                        </div>
                    </div>
                    <div class="safe-list">
                        <div class="fore1">
                            <s class="safe-bg2"></s>
                            <strong>手机验证</strong>
                            <b class="icon-id01"></b>
                        </div>
                        <div class="fore2">
					<span>
						 您绑定的手机：
						<font class="color">{{ hide_tel($user_info->mobile) }}</font>
						，该手机可用于账号登录，快速找回登录密码、支付密码，接收账户余额变动提醒等。 					</span>
                        </div>
                        <div class="fore3">
                            <a href="/user/security/edit-mobile.html" class="btn btn-specil">修改手机</a>
                        </div>
                    </div>
                    <div class="safe-list">
                        <div class="fore1">
                            <s class="safe-bg1"></s>
                            <strong>邮箱验证</strong>
                            <b class="icon-id01d"></b>
                        </div>
                        <div class="fore2">
					<span>
						 绑定后，可用于账号登录，快速找回登录密码、支付密码，接收账户余额变动提醒等。 					</span>
                        </div>
                        <div class="fore3">
                            <a href="/user/security/edit-email.html" class="btn ">绑定邮箱</a>
                        </div>
                    </div>
                    <div class="safe-list">
                        <div class="fore1">
                            <s class="safe-bg1"></s>
                            <strong>支付密码</strong>
                            <!-- 未开启标签样式 注意：如果已开启标签样式为“icon-id02” _star -->
                            <b class="icon-id02d"></b>
                            <!-- 未开启标签样式  _end -->
                        </div>
                        <div class="fore2">
                            <span>启用支付密码后，可保障您账户余额的支付安全,在使用账户资产时，需通过支付密码进行支付认证。</span>
                        </div>
                        <div class="fore3">
                            <a href="/user/security/edit-surplus-password.html" class="btn">开启支付密码</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 管理支付密码弹框 _star -->
        <div id="modal-box">
            <div class="modal-box-con pay-info">
                <p class="end-info">您的支付密码已开启！</p>
                <p>
                    <a href="/user/security/close-surplus-password.html" title="关闭支付密码" class="btn">关闭支付密码</a>
                    <a href="/user/security/edit-surplus-password.html" title="修改支付密码" class="btn">修改支付密码</a>
                </p>
                <p>
                    <a href="/user/security/edit-surplus-password.html" title="前去找回密码">忘记支付密码？</a>
                </p>
            </div>
        </div>
        <script type="text/javascript">
            $("#btn").click(function() {
                var modal = $.modal({
                    title: '管理支付密码',
                    content: $('#modal-box').html(),
                });
            });
        </script>
        <!-- 管理支付密码弹框 _end -->
    </div>

@endsection