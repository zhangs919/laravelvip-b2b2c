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

    <div class="swiper-container backend">
        <ul class="swiper-ul">

            <li>
                <div class="swiper-box-item">
                    <img src="/images/oauth/logistics.png">
                    <div class="needs-cont">
                        <h1>对接同城物流</h1>
                        <p title="轻松整合城市闲散的兼职配送人员与车辆资源为己所用，拥有定位、抢单、议价等功能，进而实现1小时快速送达，解决配送大难题！">轻松整合城市闲散的兼职配送人员与车辆资源为己所用，拥有定位、抢单、议价等功能，进而实现1小时快速送达...</p>


                        {{--todo 需要判断是否授权--}}
                        {{--0 - 未授权--}}
                        {{--<a class="swiper-btn" href="javascript:to_oauth('logistics')">去授权&nbsp;&gt;&gt;</a>--}}

                        {{--1 - 已授权--}}
                        <p class="h20 m-t-10">接口地址：https://api.sousou56.com/</p>
                        <p class="time m-t-0">有效期：2018-06-27 ~ 2018-07-26</p>
                        <span class="pull-left swiper-btn disabled">审核通过</span>
                        <!-- 暂时限定只能删除审核通过的同城物流授权 -->
                        <a href="javascript:;" id="del-oauth" class="swiper-btn">删除授权</a>

                    </div>
                </div>
            </li>

            <li>
                <div class="swiper-box-item">
                    <img src="/images/oauth/cash.png">
                    <div class="needs-cont">
                        <h1>对接收银系统</h1>
                        <p title="商品数据、库存、订单线上线下一体化管理，轻松上手，满足多行业、多场景收银需求。线下网点收银支持采购、销售、盘点、结算等各个环节，帮您轻松实现业绩翻倍涨，成本直线降！">商品数据、库存、订单线上线下一体化管理，轻松上手，满足多行业、多场景收银需求。线下网点收银支持采购、...</p>


                        <a class="swiper-btn" href="javascript:void(0)">已购买</a>
                        <a class="swiper-btn" href="http://68shouyintai.oss-cn-shanghai.aliyuncs.com/68cash/68cash.exe">下载收银狗</a>


                    </div>
                </div>
            </li>

        </ul>
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
    <script>
        function to_oauth(type) {
            $.loading.start();
            $.open({
                title: '对接',
                width: '670px',
                ajax: {
                    url: '/oauth/oauth/to-oauth',
                    data: {
                        type: type
                    }
                },
                btn: false,
            }).always(function() {
                $.loading.stop();
            });
        }
        // 删除授权操作
        $('#del-oauth').click(function() {
            $.confirm('请谨慎操作!删除此授权,那么您旗下所有的店铺授权将被删除！确认删除此授权么?', function() {
                $.loading.start();
                $.post('/oauth/oauth/del-oauth.html', {}, function(data) {
                    $.loading.stop();
                    $.msg(data.message);
                    if (data.code == 0) {
                        $.go("/oauth/oauth/index.html");
                    }
                }, 'json');
            })

        });

        function to_oauth_submit() {
            /** 数据校验 **/
            var $obj = $('input[name="iCheck"]');
            // 第一个radio按钮
            var $fObj = $obj.first();
            // 授权的对接方式
            var authType = $("#oauth_type").val();
            // 授权域名
            var $authUrl = $("#oauth_url");
            var valUrl = $.trim($authUrl.val());
            // 开始时间
            var $begin = $("#oauth_begin_time");
            var valBegin = $.trim($begin.val());
            // 结束时间
            var $end = $("#oauth_end_time");
            var valEnd = $.trim($end.val());

            // 验证对接方式
            if (authType == '') {
                $.msg('请选择对接方式');
                return false;
            }
            // 验证对接域名
            if (valUrl == '') {
                $.tips('请输入对接系统域名', $authUrl);
                return false;
            }

            // 第一个按钮被选中
            if ($fObj.prop('checked')) {
                // 验证开始时间
                if (valBegin == '') {
                    $.tips('请输入正确的开始时间', $begin);
                    return false;
                }
                // 验证结束时间
                if (valEnd == '') {
                    $.tips('请输入正确的结束时间', $end);
                    return false;
                }
            }
            var data = {
                'type': authType,
                'oauth_url': valUrl,
                'oauth_begin_time': valBegin,
                'oauth_end_time': valEnd
            };
            $.loading.start();
            $.post('/oauth/oauth/to-oauth', data, function(result) {
                $.loading.stop();
                $.msg(result.message);
                if (result.code == 0) {
                    $.go("/oauth/oauth/index");
                }
            }, "json");
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop