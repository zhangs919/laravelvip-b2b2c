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
        <h3>开店类型选择</h3>
        <div class="type-box">
            <div class="info">
                <h3>请选择开店类型，一旦成功建立店铺，类型不可更改</h3>
            </div>
            <div class="select-list">
                <ul>
                    @if(@$shop_cache['shop']['shop_type'] == 1)
                        {{--个人店铺选中--}}
                        <li value="1" class="selected">
                            <dl class="type_info">
                                <dt>个人店铺</dt>
                                <dd class="type_pic personal"></dd>

                                <!--当已经选择后此类型后，并之前有过操作的，还未完成所有操作-->
                                <dd class="choose-inprogress">开店进行中...</dd>

                            </dl>
                            <p class="type_toolbar">
                                <em>
                                    <a href="javascript:void(0);" id="type_personal"> 已选择 </a>
                                    <a href="javascript:void(0);"> </a>
                                    <i class="next"></i>
                                </em>
                            </p>
                        </li>
                        <li value="2">
                            <dl class="type_info">
                                <dt>企业店铺</dt>
                                <dd class="type_pic enterprise"></dd>

                                <dd class="type_desc_sub">创建发布更多促销活动</dd>
                                <dd class="type_desc_sub">拥有更多独有功能</dd>

                            </dl>
                            <p class="type_toolbar">
                                <em>
                                    <a href="javascript:void(0);" id="type_company"> 选择并继续 </a>
                                    <i class="next"></i>
                                </em>
                            </p>
                        </li>
                    @elseif(@$shop_cache['shop']['shop_type'] == 2)
                        {{--企业店铺选中--}}
                        <li value="1">
                            <dl class="type_info">
                                <dt>个人店铺</dt>
                                <dd class="type_pic personal"></dd>

                                <dd class="type_desc_sub">免费使用图片空间</dd>
                                <dd class="type_desc_sub">低门槛创建营销活动</dd>

                            </dl>
                            <p class="type_toolbar">
                                <em>
                                    <a href="javascript:void(0);" id="type_personal"> 选择并继续 </a>
                                    <a href="javascript:void(0);"> </a>
                                    <i class="next"></i>
                                </em>
                            </p>
                        </li>
                        <li value="2" class="selected">
                            <dl class="type_info">
                                <dt>企业店铺</dt>
                                <dd class="type_pic enterprise"></dd>

                                <!--当已经选择后此类型后，并之前有过操作的，还未完成所有操作-->
                                <dd class="choose-inprogress">开店进行中...</dd>

                            </dl>
                            <p class="type_toolbar">
                                <em>
                                    <a href="javascript:void(0);" id="type_company"> 已选择 </a>
                                    <i class="next"></i>
                                </em>
                            </p>
                        </li>
                    @else
                        {{--都没选中--}}
                        <li value="1" class="selected">
                            <dl class="type_info">
                                <dt>个人店铺</dt>
                                <dd class="type_pic personal"></dd>

                                <dd class="type_desc_sub">免费使用图片空间</dd>
                                <dd class="type_desc_sub">低门槛创建营销活动</dd>

                            </dl>
                            <p class="type_toolbar">
                                <em>
                                    <a href="javascript:void(0);" id="type_personal"> 选择并继续 </a>
                                    <a href="javascript:void(0);"> </a>
                                    <i class="next"></i>
                                </em>
                            </p>
                        </li>
                        <li value="2">
                            <dl class="type_info">
                                <dt>企业店铺</dt>
                                <dd class="type_pic enterprise"></dd>

                                <dd class="type_desc_sub">创建发布更多促销活动</dd>
                                <dd class="type_desc_sub">拥有更多独有功能</dd>

                            </dl>
                            <p class="type_toolbar">
                                <em>
                                    <a href="javascript:void(0);" id="type_company">选择并继续</a>
                                    <i class="next"></i>
                                </em>
                            </p>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
        <div class="bottom">
            <p>

                <a class="btn btn-primary" href="/shop/apply/register.html"> 上一步 </a>

                @if(@$shop_cache['shop']['shop_type'] == 1)
                    <a id="next" class="btn btn-primary" href="/shop/apply/auth-info.html?is_supply={{ $shop_cache['shop']['is_supply'] }}&shop_type=1"> 下一步 </a>
                @elseif(@$shop_cache['shop']['shop_type'] == 2)
                    <a id="next" class="btn btn-primary" href="/shop/apply/auth-info.html?is_supply={{ $shop_cache['shop']['is_supply'] }}&shop_type=2"> 下一步 </a>
                @else
                    <a id="next" class="btn btn-primary disabled" href="javascript:void(0);"> 下一步 </a>
                @endif

            </p>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $("li").click(function() {
                $("li[class='selected']").removeAttr("class");
                $(this).addClass("selected");
                $("#next").removeClass("disabled");
                $("#next").attr("href", "/shop/apply/auth-info.html?is_supply=0&shop_type=" + $(this).attr('value'));

                if ($(this).attr('value') == 1) {
                    $("#type_personal").html("已选择");
                    $("#type_company").html("选择并继续");
                } else {
                    $("#type_personal").html("选择并继续");
                    $("#type_company").html("已选择");
                }
            });
        });
    </script>

@endsection