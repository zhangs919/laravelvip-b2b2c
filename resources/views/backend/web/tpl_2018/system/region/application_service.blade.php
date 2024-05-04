{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content">
        <div class="section-type-box">
            <ul class="p-t-5">
                <li class="m-b-15">
                    <div class="icon section-icon col-sm-4">
                        <span class="section-logo section-logo-cloud"><i></i></span>
                    </div>
                    <div class="desc col-sm-8">
                        <h3 class="f20 section-title">云产品库</h3>
                        <p class="m-t-5">云产品库集商品分类、品牌、数据采集等功能于一身，为广大客户提供海量商品数据，节约维护成本，操作灵活简单，维护省时省力！</p>
                        <a href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=xxxxxxxxxxxxx" class="btn btn-primary m-t-20 m-r-20" target="_blank">联系客服</a>
                        <a href="http://www.yunchanpinku.com/" class="btn btn-default bg-fff m-t-20" target="_blank">了解详情</a>
                    </div>
                </li>
                <li class="m-b-15">
                    <div class="icon section-icon col-sm-4">
                        <span class="section-logo section-logo-sousou"> <i></i></span>
                    </div>
                    <div class="desc col-sm-8">
                        <h3 class="f20 section-title">云物流</h3>
                        <p class="m-t-5">轻松整合城市闲散的兼职配送人员与车辆资源为已所用，拥有定位、抢单、议价等功能，进而实现1小时快速送达，解决配送大难题！</p>
                        <a href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=xxxxxxxxxxxxx" class="btn btn-primary m-t-20 m-r-20" target="_blank">联系客服</a>
                        <a href="http://www.xxx.com/" class="btn btn-default bg-fff m-t-20" target="_blank">了解详情</a>
                    </div>
                </li>
                <li class="m-b-15">
                    <div class="icon section-icon col-sm-4">
                        <span class="section-logo section-logo-erp"> <i></i></span>
                    </div>
                    <div class="desc col-sm-8">
                        <h3 class="f20 section-title">云ERP</h3>
                        <p class="m-t-5">ERP集采购、销售、仓储、CRM、账款、售后服务等全面管理功能于一身，可与商城完美对接，解决商城管理大难题！</p>
                        <a href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=xxxxxxxxxxxxx" class="btn btn-primary m-t-20 m-r-20 " target="_blank">联系客服</a>
                        <a href="http://www.xxx.com/" class="btn btn-default bg-fff m-t-20" target="_blank">了解详情</a>
                    </div>
                </li>
                <li class="m-b-15">
                    <div class="icon section-icon col-sm-4">
                        <span class="section-logo section-logo-cashier"> <i></i></span>
                    </div>
                    <div class="desc col-sm-8">
                        <h3 class="f20 section-title">云收银</h3>
                        <p class="m-t-5">云收银可真正的将线下商务机会与互联网技术结合在一起，让互联网成为线下交易的前台，实现线上线下一体化管理，数据同步！</p>
                        <a href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=xxxxxxxxxxxxx" class="btn btn-primary m-t-20 m-r-20" target="_blank">联系客服</a>
                        <a href="http://www.xxx.com/" class="btn btn-default bg-fff m-t-20" target="_blank">了解详情</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

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

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
