{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/revision-styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <form id="ShopConfig" class="form-horizontal" name="ShopConfig" action="/dashboard/shop-auth/set-auth?shop_id={{ $shop_info->shop_id }}"
          method="post" enctype="multipart/form-data" novalidate="novalidate">
        @csrf

        {{--<input type="hidden" id="shopconfig-id" class="form-control" name="ShopConfig[id]" value="4">--}}

        <input type="hidden" id="shopconfig-shop_id" class="form-control" name="ShopConfig[shop_id]" value="{{ $shop_info->shop_id }}">
        <div class="table-content m-t-30 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">店铺ID：</span>
                    </label>
                    <div class="col-sm-4">
                        <label class="control-label text-l">{{ $shop_info->shop_id }}</label>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">店铺名称：</span>
                    </label>
                    <div class="col-sm-4">
                        <label class="control-label text-l">{{ $shop_info->shop_name }}</label>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="ng-binding">设置权限：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <label class="control-label cur-p">
                                <input type="checkbox" id="all_auth" data-id="{{ $shop_info->shop_id }}" @if($shop_auth == 'all_auth')checked="checked"@endif>
                                全部权限
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="content">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">营销权限：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="authset-all" style="width: 780px;">
                                <!--一级循环-->
                                @foreach($shop_application_list as $shop_app)
                                    <dl class="simple-form-field">
                                        <dt class="tit">
                <span>
                    <label> {{ $shop_app['name'] }} </label>
                </span>
                                        </dt>
                                        <dd class="form-group-t">
                                            <div class="authset-list">
                                                <div class="col-sm-12 control-label control-label-t">
                                                    <ul class="authset-section b-n">

                                                        @if(!empty($shop_app['child']))
                                                            @foreach($shop_app['child'] as $child)
                                                                <li class="w180 p-l-0 m-b-20">
                                                                    <label class="control-label w80 text-r pull-left m-r-5"
                                                                           style="margin-top: -2px;">{{ $child['name'] }}：</label>
                                                                    <label class="control-label control-label-switch">
                                                                        <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                                                            <label>
                                                                                <input name="{{ $child['field'] }}"
                                                                                       class="onoffswitch-checkbox"
                                                                                       type="checkbox"
                                                                                       data-on-text="启用" data-off-text="禁用" @if($shop_auth == 'all_auth' || in_array($child['field'], $shop_auth))checked="checked" @endif>
                                                                            </label>
                                                                        </div>
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        @endif

                                                    </ul>
                                                </div>
                                            </div>
                                        </dd>
                                    </dl>
                            @endforeach

                            <!--一级循环 end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交">
            </div>
        </div>

    </form>



@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <script id="client_rules" type="text">
        [{"id": "shopconfig-code", "name": "ShopConfig[code]", "attribute": "code", "rules": {"required":true,"messages":{"required":"代码标识不能为空。"}}},{"id": "shopconfig-shop_id", "name": "ShopConfig[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺编号不能为空。"}}},{"id": "shopconfig-value", "name": "ShopConfig[value]", "attribute": "value", "rules": {"string":true,"messages":{"string":"值必须是一条字符串。"}}},{"id": "shopconfig-shop_id", "name": "ShopConfig[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺编号必须是整数。"}}},{"id": "shopconfig-parent_code", "name": "ShopConfig[parent_code]", "attribute": "parent_code", "rules": {"string":true,"messages":{"string":"上级code值必须是一条字符串。","maxlength":"上级code值只能包含至多60个字符。"},"maxlength":60}},{"id": "shopconfig-code", "name": "ShopConfig[code]", "attribute": "code", "rules": {"string":true,"messages":{"string":"代码标识必须是一条字符串。","maxlength":"代码标识只能包含至多60个字符。"},"maxlength":60}},{"id": "shopconfig-remark", "name": "ShopConfig[remark]", "attribute": "remark", "rules": {"string":true,"messages":{"string":"备注说明必须是一条字符串。","maxlength":"备注说明只能包含至多60个字符。"},"maxlength":60}},]
    </script>
    <script type="text/javascript">
        $().ready(function () {
            //悬浮显示上下步骤按钮
            window.onscroll = function () {
                $(window).scroll(function () {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };
            var validator = $("#ShopConfig").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function () {
                if (!validator.form()) {
                    return;
                }
                $.loading.start();
                $("#ShopConfig").submit();
            });

            $("#all_auth").change(function () {
                var shop_id = $(this).data("id");
                if ($(this).is(':checked')) {
                    var is_all = 1;
                } else {
                    var is_all = 0;
                }
                $.loading.start();

                $.ajax({
                    type: 'GET',
                    url: 'all-auth',
                    data: {
                        is_all: is_all,
                        shop_id: shop_id
                    },
                    dataType: 'json',
                    success: function (result) {
                        location.reload();
                        // $("#content").html(result.data);
                    }
                }).always(function () {
                    $.loading.stop();
                });
            });

            //悬浮显示上下步骤按钮
            window.onscroll = function () {
                $(window).scroll(function () {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop