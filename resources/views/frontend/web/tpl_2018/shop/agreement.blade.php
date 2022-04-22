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
        <h3>入驻协议</h3>
        <div class="agreement-info">
            {!! $seller_protocol !!}
        </div>
        <div class="bottom">
            <p>
                <label class="agreement-label">
                    <input class="checkBox" type="checkbox">
                    我已阅读并同意以上协议
                </label>
            </p>
            <p>
                <a class="btn btn-default" href="/shop/apply/index.html"> 返回入驻首页 </a>
                <a id="next" class="btn btn-primary disabled" href="javascript:void(0);"> 下一步 </a>
            </p>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $("input[type='checkbox']").click(function() {
                if ($(this).is(":checked")) {
                    $("#next").removeClass("disabled");
                    $("#next").attr("href", "/shop/apply/register.html");
                } else {
                    $("#next").addClass("disabled");
                    $("#next").attr("href", "javascript:void(0);");
                }
            });
        });
    </script>

@endsection