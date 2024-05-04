{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--content--}}
@section('content')

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-integral_validity" class="col-sm-4 control-label">

                        <span class="ng-binding">积分有效期：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="shopconfigmodel-integral_validity" class="form-control ipt m-r-10" name="ShopConfigModel[integral_validity]" value="{{ $model['integral_validity'] }}"> 年





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">“0”表示无限制，积分获得日期开始计算，到超过积分有效期，会员积分自动清零</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-give_integral_confirm" class="col-sm-4 control-label">

                        <span class="ng-binding">主动确认收货送积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="shopconfigmodel-give_integral_confirm" class="form-control ipt m-r-10" name="ShopConfigModel[give_integral_confirm]" value="{{ $model['give_integral_confirm'] }}"> 积分





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">消费者主动点击确认收货后赠送积分</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-give_integral_comment" class="col-sm-4 control-label">

                        <span class="ng-binding">评价好评送积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="shopconfigmodel-give_integral_comment" class="form-control ipt m-r-10" name="ShopConfigModel[give_integral_comment]" value="{{ $model['give_integral_comment'] }}"> 积分





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">消费者对宝贝与描述相设置好评后赠送积分</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-give_integral_consume" class="col-sm-4 control-label">

                        <span class="ng-binding">消费金额送积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <input type="text" id="shopconfigmodel-give_integral_consume" class="form-control ipt m-r-10" name="ShopConfigModel[give_integral_consume]" value="{{ $model['give_integral_consume'] }}"> 元 = 1 积分





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">比如：设置1元=1积分，则会员消费101元，确认收货后则赠送101积分，按消费金额中的整数部分进行赠送积分，不考虑四舍五入。</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-give_integral_out_line_balance" class="col-sm-4 control-label">

                        <span class="ng-binding">线下消费余额是否累计积分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopConfigModel[give_integral_out_line_balance]" value="0">
                                    <label>
                                        <input type="checkbox" id="shopconfigmodel-give_integral_out_line_balance" class="form-control b-n"
                                               name="ShopConfigModel[give_integral_out_line_balance]" value="1" @if($model['give_integral_out_line_balance'] == 1){{ 'checked' }}@endif unselect="0" data-on-text="是" data-off-text="否">
                                    </label>
                                </div>
                            </label>





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制会员线下消费使用会员余额支付，是否可获取积分，获取的积分规则与线上一致</br> 线下消费余额：通过商家APP扫描消费者付款码，或消费者扫描商家APP收款码</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-integral_shipping" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">积分兑换配送方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="hidden" name="ShopConfigModel[integral_shipping]" value="0">
                            <div id="shopconfigmodel-integral_shipping" class="" name="ShopConfigModel[integral_shipping]">
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="ShopConfigModel[integral_shipping][]" value="0" @if(in_array(0,$model['integral_shipping'])){{ 'checked' }}@endif> 物流配送</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="ShopConfigModel[integral_shipping][]" value="1" @if(in_array(1,$model['integral_shipping'])){{ 'checked' }}@endif> 上门自提</label>
                            </div>





                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">积分兑换配送方式将影响消费者积分兑换提交页面是否展示物流配送以及上门自提选项。 <a class="c-blue" href="/goods/self-pickup/list.html" target="_Blank">设置自提点</a></div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-integral_qrcode" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺积分收款码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            {{--<input type="text" id="shopconfigmodel-integral_qrcode" class="form-control valid hidden" name="ShopConfigModel[integral_qrcode]" value="http://images.test.laravelvip.com/olpqrcode/olp_1.png">--}}
                            <input type="text" id="shopconfigmodel-integral_qrcode" class="form-control valid hidden" name="ShopConfigModel[integral_qrcode]" value="{{ $model['integral_qrcode'] }}">




                            <div class="goods-message">
                                <div class="active m-t-5">
                                    <div class="QR-code popover-box">
                                        <a href="javascript:;" class="qrcode">
                                            <i class="fa fa-qrcode"></i>
                                        </a>
                                        <div class="code-info popover-info" style="display: none;">
                                            <i class="fa fa-caret-left"></i>
                                            <a href="/dashboard/integral-mall/download-qrcode">点击下载</a>
                                            <p>
                                                {{--<img src="/assets/e8b2e423/images/common/loading_90_90.gif" data-src="http://images.test.laravelvip.com/olpqrcode/olp_1.png" />--}}
                                                <img src="/assets/e8b2e423/images/common/loading_90_90.gif" data-src="{{ $model['integral_qrcode'] }}" />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">积分收款码应用于消费者线下扫码进行消费积分和余额，该余额不累计积分</div></div>
                    </div>
                </div>
            </div>

            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ $back_url }}" />
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
            </div>
    </form>	</div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
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
    @include('shop.config.partials.integral_mall_set')
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop