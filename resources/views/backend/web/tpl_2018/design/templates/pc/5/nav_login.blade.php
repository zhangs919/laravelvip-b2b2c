<!-- 登录版式 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- banner右侧公告 _start -->
    <div class="nav-login">

        @if($tpl_name != '' && $is_design)
            <a class="selector title-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-length="50">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        @if(!empty($data['4-1']))
            @foreach($data['4-1'] as $v)
            <!-- 未登陆状态 -->
                <div class="SZY-USER-NOT-LOGIN">
                    <div class="avatar">
                        <a href="/user.html" title="查看个人资料">
                            <img src="{{ get_image_url(sysconf('default_user_portrait')) }}" class="SZY-USER-PIC" />
                        </a>
                    </div>
                    <div class="nav-login-info">

                        <span>{!! $v['name'] !!}</span>

                        <a href="javascript:void(0)" class="nav-login-btn login-btn ajax-login">请登录</a>
                        <a href="/shop/apply.html" target="_blank" class="nav-login-btn nav-apply">我要开店</a>
                    </div>
                </div>

                <!-- 登陆状态 -->
                <div class="SZY-USER-ALREADY-LOGIN hide">
                    <div class="avatar">
                        <a href="/user.html" title="查看个人资料">
                            <img src="{{ get_image_url(sysconf('default_user_portrait')) }}" class="SZY-USER-PIC" />
                        </a>
                    </div>
                    <div class="nav-login-info">

                        <span>{!! $v['name'] !!}</span>

                        <a href="/user.html" class="nav-login-btn login-btn">个人中心</a>
                        <a href="/shop/apply.html" target="_blank" class="nav-login-btn nav-apply">我要开店</a>
                    </div>
                </div>
            @endforeach
        @else
        <!-- 未登陆状态 -->
            <div class="SZY-USER-NOT-LOGIN">
                <div class="avatar">
                    <a href="/user.html" title="查看个人资料">
                        <img src="{{ get_image_url(sysconf('default_user_portrait')) }}" class="SZY-USER-PIC" />
                    </a>
                </div>
                <div class="nav-login-info">

                    <span>Hi，欢迎来到乐融沃B2B2C商城演示站！</span>

                    <a href="javascript:void(0)" class="nav-login-btn login-btn ajax-login">请登录</a>
                    <a href="/shop/apply.html" target="_blank" class="nav-login-btn nav-apply">我要开店</a>
                </div>
            </div>

            <!-- 登陆状态 -->
            <div class="SZY-USER-ALREADY-LOGIN hide">
                <div class="avatar">
                    <a href="/user.html" title="查看个人资料">
                        <img src="{{ get_image_url(sysconf('default_user_portrait')) }}" class="SZY-USER-PIC" />
                    </a>
                </div>
                <div class="nav-login-info">

                    <span>Hi，欢迎来到乐融沃B2B2C商城演示站！</span>

                    <a href="/user.html" class="nav-login-btn login-btn">个人中心</a>
                    <a href="/shop/apply.html" target="_blank" class="nav-login-btn nav-apply">我要开店</a>
                </div>
            </div>
        @endif

    </div>
    <!-- banner右侧公告 _end -->

</div>