@extends('layouts.shop_apply_layout')

@section('content')

    <!--头部信息-->
    <div class="header-layout">
        <div class="header-conter">
            <h2 class="header_logo">
                <a href="/">
                    <img src="{{ get_image_url(sysconf('mall_logo')) }}">
                </a>
            </h2>
            <div class="header-extra">
                <div class="progress">
                    <div class="progress-wrap">
                        <div class="progress-item ongoing">
                            <div class="number">1</div>
                            <div class="progress-desc">开店申请</div>
                        </div>
                    </div>
                    <div class="progress-wrap">
                        <div class="progress-item  tobe ">
                            <div class="number">2</div>
                            <div class="progress-desc">网站审核</div>
                        </div>
                    </div>
                    <div class="progress-wrap">
                        <div class="progress-item  tobe ">
                            <div class="number">3</div>
                            <div class="progress-desc">支付开店款项</div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <div class="progress-item  tobe ">
                            <div class="number">√</div>
                            <div class="progress-desc">创建店铺</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 内容 -->
    <div class="content">
        <!--开店条件-->
        <div class="item-box">
            <div class="title">
                <span>请完善开店条件</span>
                <span class="notes">（开店审核结果将会以短信形式发送至您以下绑定账号）</span>
            </div>
            <div class="item-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>认证项名称</th>
                        <th>认证信息</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>手机</td>
                        <td>{{ $user_info['mobile'] ?? '' }}</td>
                        <td>

                            @if($user_info['mobile_validated'] == 1)
                                <font class="success">
                                    <i></i>
                                    已认证
                                </font>
                                @else
                                <font class="unfinished">
                                    <i></i>
                                    未认证
                                </font>
                            @endif

                        </td>
                        <td>

                            @if($user_info['mobile_validated'] == 1)
                                <a class="btn-link" href="/user/security.html" target="_blank">查看</a>
                            @else
                                <a class="btn-link" href="/user/security/edit-mobile.html" target="_blank">立即认证</a>
                            @endif

                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--当全部满足开店条件时，显示下面DIV，否则显示表格内容-->

                @if($user_info['mobile_validated'] == 1 && $user_info['is_seller'] == 0)
                <div class="text-info">
                    <font class="success">
                        <i></i>
                    </font>
                    亲，恭喜您满足开店条件，请继续！
                </div>
                @endif

            </div>
        </div>
        <div class="bottom">
            <p>
                <a class="btn btn-primary" href="/shop/apply/agreement.html"> 上一步 </a>

                <a id="next" class="btn btn-primary @if(!$user_info['mobile_validated']){{ 'disabled' }}@endif" href="/shop/apply/agreement-type1.html"> 下一步 </a>

            </p>
        </div>
    </div>

@endsection