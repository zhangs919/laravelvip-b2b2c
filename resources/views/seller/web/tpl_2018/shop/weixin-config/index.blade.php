{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="group" value="weixin">
            <input type="hidden" name="tabs" value="">
            <h5 class="m-b-30">平台方微信公众号二维码</h5>
            <div class="wechat">
                <div class="wechat-box">
                    <!--店铺微信公共号-->
                    <div class="wechat-img">
                        <p class="m-b-10">店铺微信公众号</p>
                        <div id="shop_wechat_imagegroup_container" class="szy-imagegroup" data-id="shopconfigmodel-shop_wechat" data-size="1"></div>
                    </div>
                    <!--店铺微信公共号-->
                    <!--店铺二维码-->
                    <div class="wechat-img">
                        <p class="m-b-10">店铺二维码</p>
                        <img class="w80" src="{{ $shop_qrcode }}" alt="二维码" />
                        <!--下载暂无-->
                        <a class="btn-link" href="/shop/download-qrcode?shop_id={{ $shop_id }}">下载店铺二维码</a>
                    </div>
                    <div class="wechat-info m-t-30">
                        <p class="c-red m-t-30">注：如没有微信公众号，可以使用平台方的微信二维码推广商城</p>
                    </div>
                </div>
            </div>
            <h5 class="m-b-30">
                微信对接
                <span class="f12 m-l-20">提示：店铺如需对接微信，需配置公众号AppId及AppSecret</span>
            </h5>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-appid" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">应用ID：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="shopconfigmodel-appid" class="form-control" name="ShopConfigModel[appid]" value="{{ $model['appid'] }}">
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-appsecret" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">应用密钥：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="shopconfigmodel-appsecret" class="form-control" name="ShopConfigModel[appsecret]" value="{{ $model['appsecret'] }}">
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-auth_verify" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">授权验证码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="shopconfigmodel-auth_verify" class="form-control" name="ShopConfigModel[auth_verify]" value="{{ $model['auth_verify'] }}">
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-shop_wechat" class="col-sm-4 control-label">
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="hidden" id="shopconfigmodel-shop_wechat" class="form-control" name="ShopConfigModel[shop_wechat]" value="{{ $model['shop_wechat'] }}">
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}" />
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary" />
                        <input type="button" value="清空" class="btn btn-default m-l-10 clear" />
                    </div>
                </div>
            </div>
            <h5 class="m-b-30">
                微信配置
                <span class="f12 m-l-20">提示：URL及Token需在微信公众号平台进行配置</span>
            </h5>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">URL：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $weixin_url }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field p-t-0">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">令牌：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $weixin_token }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script id="client_rules" type="text">
[{"id": "shopconfigmodel-appid", "name": "ShopConfigModel[appid]", "attribute": "appid", "rules": {"string":true,"messages":{"string":"应用ID必须是一条字符串。"}}},{"id": "shopconfigmodel-appid", "name": "ShopConfigModel[appid]", "attribute": "appid", "rules": {"required":true,"messages":{"required":"应用ID不能为空。"}}},{"id": "shopconfigmodel-appsecret", "name": "ShopConfigModel[appsecret]", "attribute": "appsecret", "rules": {"string":true,"messages":{"string":"应用密钥必须是一条字符串。"}}},{"id": "shopconfigmodel-appsecret", "name": "ShopConfigModel[appsecret]", "attribute": "appsecret", "rules": {"required":true,"messages":{"required":"应用密钥不能为空。"}}},{"id": "shopconfigmodel-auth_verify", "name": "ShopConfigModel[auth_verify]", "attribute": "auth_verify", "rules": {"string":true,"messages":{"string":"授权验证码必须是一条字符串。"}}},{"id": "shopconfigmodel-auth_verify", "name": "ShopConfigModel[auth_verify]", "attribute": "auth_verify", "rules": {"required":true,"messages":{"required":"授权验证码不能为空。"}}},{"id": "shopconfigmodel-shop_wechat", "name": "ShopConfigModel[shop_wechat]", "attribute": "shop_wechat", "rules": {"string":true,"messages":{"string":"必须是一条字符串。"}}},]
</script>

    {!! $script_render !!}

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
