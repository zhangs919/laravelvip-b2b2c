{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="PushMessageModel" class="form-horizontal" name="PushMessageModel" action="{{ $action }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
            @csrf

            @if($type == 5)
                <div class="simple-form-field">
                    <div class="form-group">
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="pushmessagemodel-sales_type" class="col-sm-4 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">智能营销策略：</span>
                                </label>
                                <div class="col-sm-8">
                                    <div class="form-control-box">


                                        <input type="hidden" name="PushMessageModel[sales_type]" value="1"><div id="pushmessagemodel-sales_type" class="" name="PushMessageModel[sales_type]"><label class="control-label cur-p m-r-10"><input type="radio" name="PushMessageModel[sales_type]" value="1"> 红包关怀</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="PushMessageModel[sales_type]" value="2"> 千人千面</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="PushMessageModel[sales_type]" value="3"> 短信推送</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="PushMessageModel[sales_type]" value="4"> 邮件推送</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="PushMessageModel[sales_type]" value="5" checked> APP推送</label></div>


                                    </div>

                                    <div class="help-block help-block-t"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $().ready(function() {
                        $('input:radio[name="PushMessageModel[sales_type]"]').change(function() {
                            var type = $(this).val();
                            var group_id = $("#targetsalesmodel-group_id").val();
                            if (type == 5) {
                                $.go('/app/push-message/index?from=dashboard&type=' + type + "&group_id=" + group_id);
                            } else {
                                $.go("/dashboard/customer-analysis/operation.html?type=" + type + "&group_id=" + group_id);
                            }
                        });
                    });
                </script>


                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">选择人群：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <a class="btn btn-primary btn-sm m-t-5 sel-people">
                                    <i class="fa fa-plus"></i>
                                    选择人群
                                </a>
                                <p>
                                    <label class="control-label" id="group_name"></label>
                                    <input type="hidden" id="targetsalesmodel-group_id" name="PushMessageModel[group_id]" value="">
                                    <input type="hidden" id="targetsalesmodel-group_name" name="PushMessageModel[group_name]" value="">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <script type='text/javascript'>
                    $().ready(function() {

                        $("body").on("click", ".sel-people", function() {

                            $.loading.start();
                            $.open({
                                title: "我的人群",
                                ajax: {
                                    url: '/dashboard/customer-analysis/get-people',
                                    data: {}
                                },
                                width: "950px",
                                height: "520px",
                                btn: ['确定', '取消'],
                                yes: function(index, container) {
                                    var data = $(container).serializeJson();
                                    $.loading.start();
                                    $.post('/dashboard/customer-analysis/get-people', data, function(result) {
                                        $.loading.stop();
                                        if (result.code == 0) {
                                            $("#group_name").html(result.group_name);
                                            $("#targetsalesmodel-group_name").val(result.group_name);
                                            $("#targetsalesmodel-group_id").val(result.group_id);
                                            $("#targetsalesmodel-send_number").val(result.count);
                                            layer.close(index);
                                        } else {
                                            $.msg(result.message);
                                        }
                                    }, "json");
                                },
                            });
                        });
                    });
                </script>
            @endif

            <!-- 推送标题-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="pushmessagemodel-title" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">推送标题：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="pushmessagemodel-title" class="form-control" name="PushMessageModel[title]">
                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 推送内容 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="pushmessagemodel-content" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">推送内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <textarea id="pushmessagemodel-content" class="form-control" name="PushMessageModel[content]" rows="5"></textarea>
                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 推送类型 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="pushmessagemodel-push_type" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">推送类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="pushmessagemodel-push_type" class="form-control" name="PushMessageModel[push_type]">
                                <option value="7">普通消息</option>
                                <option value="0">选择商品</option>
                                <option value="1">店铺主页</option>
                                <option value="2">文章详情</option>
                                <option value="3">分类商品</option>
                                <option value="4">团购活动</option>
                                <option value="5">品牌专题</option>
                                <option value="6">自定义链接</option>
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">应用终端读取消息时会跳转至设置的相应页面</div></div>
                    </div>
                </div>
            </div>
            <!-- 店铺主页 -->
            <div class="change shop" style="display: none">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="pushmessagemodel-shop" class="col-sm-4 control-label">

                            <span class="ng-binding">店铺主页：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="pushmessagemodel-shop" class="form-control" name="PushMessageModel[shop]">
                                    <option value="">-- 请选择 --</option>
                                    <option value="1">鲜农乐食品专营店</option>
                                </select>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 文章详情 -->
            <div class="change article" style="display: none">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="pushmessagemodel-article" class="col-sm-4 control-label">

                            <span class="ng-binding">文章详情：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="pushmessagemodel-article" class="form-control" name="PushMessageModel[article]">
                                    <option value="">-- 请选择 --</option>
                                    <option value="1">云商城火热招商中</option>
                                    <option value="2">购物流程</option>
                                    <option value="3">订单查询</option>
                                    <option value="4">常见问题</option>
                                    <option value="5">网上支付</option>
                                    <option value="6">配送范围及收费标准</option>
                                    <option value="7">订单进度查询</option>
                                    <option value="8">验货与签收</option>
                                    <option value="9">退换货政策</option>
                                    <option value="10">退换货流程</option>
                                    <option value="11">退款说明</option>
                                    <option value="13">商家入驻</option>
                                    <option value="14">招商方向</option>
                                    <option value="15">2016年度商城招商标准</option>
                                    <option value="16">2016年度商城招商资质</option>
                                    <option value="17">2016年云商城店铺续签公告</option>
                                    <option value="18">终止合作</option>
                                    <option value="19">欢迎访问云商城</option>
                                    <option value="20">云商城火热招商中</option>
                                    <option value="21">一张图看懂入驻流程</option>
                                    <option value="22">入驻小帮手</option>
                                    <option value="23">企业采购</option>
                                    <option value="24">商家品控</option>
                                    <option value="25">运营服务</option>
                                    <option value="26">企业采购</option>
                                    <option value="27">商城招商公告</option>
                                    <option value="28">2016“欢迎优质商家入驻开启零售新篇章”</option>
                                    <option value="29">产品库功能更新中</option>
                                    <option value="30">批发市场已正式上线</option>
                                    <option value="32">云商城更新啦....</option>
                                    <option value="33">B2B2B2C电商生态系统</option>
                                    <option value="34">站点—供货—入驻商家—区域配送</option>
                                    <option value="35">云商城介绍</option>
                                    <option value="36">云商城持续更新中...</option>
                                    <option value="37">企业采购</option>
                                    <option value="38">一张图看懂入驻流程</option>
                                    <option value="39">商城招商公告</option>
                                    <option value="40">批发市场已正式上线</option>
                                    <option value="41">云商城火热招商中</option>
                                    <option value="42">商家入驻</option>
                                    <option value="43">商家品控</option>
                                    <option value="44">运营服务</option>
                                    <option value="45">入驻小帮手</option>
                                    <option value="46">公司转账</option>
                                    <option value="47">货到付款</option>
                                    <option value="48">商家规则</option>
                                    <option value="49">入驻流程</option>
                                    <option value="50">让千禧一代爱上你品牌的11种方法</option>
                                    <option value="51">纯干货！电商路上要小心的7个陷阱！</option>
                                    <option value="52">支付宝发布“双12”方案 商家突破百万</option>
                                    <option value="53">优衣库的稳健和精明，凡客的文艺和草莽</option>
                                    <option value="54">中国工艺品电商何去何从？</option>
                                    <option value="55">外卖O2O：轻模式、重模式、第三方平台</option>
                                    <option value="56">2016年的VR产业为何雷声大雨点小？</option>
                                    <option value="57">移动支付走遍全球：线上线下通吃</option>
                                    <option value="58">2016年最令人振奋的人工智能技术进步</option>
                                </select>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 分类商品 -->
            <div class="change category" style="display: none">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="pushmessagemodel-category" class="col-sm-4 control-label">

                            <span class="ng-binding">分类商品：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <div class="chosen-container chosen-container-single" title="" id="pushmessagemodel_category_chosen">
                                    <a class="chosen-single" tabindex="-1"><span>-- 请选择 --</span><div><b></b></div></a>
                                    <div class="chosen-drop">
                                        <div class="chosen-search"><input type="text" autocomplete="off"></div>
                                        <ul class="chosen-results"></ul></div></div><select id="pushmessagemodel-category" name="PushMessageModel[category]" class="chosen-select" style="display: none;">

                                    <option value="0" selected="">-- 请选择 --</option>

                                    <option value="271">◢&nbsp;生鲜食品</option>
                                    <option value="306">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;◢&nbsp;新鲜水果</option>
                                    <option value="420">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浴室用品</option>

                                </select>

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 团购活动 -->
            <div class="change group" style="display: none">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="pushmessagemodel-group" class="col-sm-4 control-label">

                            <span class="ng-binding">团购活动：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="pushmessagemodel-group" class="form-control" name="PushMessageModel[group]">
                                    <option value="">-- 请选择 --</option>
                                    <option value="1">新鲜果蔬，烟台大樱桃</option>
                                    <option value="2">一骑红尘妃子笑</option>
                                    <option value="3">礼遇端午，一见“粽”情</option>
                                </select>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 品牌专题 -->
            <div class="change brand" style="display: none">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="pushmessagemodel-brand" class="col-sm-4 control-label">

                            <span class="ng-binding">品牌专题：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="pushmessagemodel-brand" class="form-control" name="PushMessageModel[brand]">
                                    <option value="">-- 请选择 --</option>
                                    <option value="1">乐视</option>
                                    <option value="2">创维</option>
                                    <option value="3">飞利浦</option>
                                    <option value="4">海信</option>
                                    <option value="5">美的</option>
                                    <option value="6">奥克斯</option>
                                    <option value="7">飞科</option>
                                </select>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 自定义链接 -->
            <div class="change link" style="display: none">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="pushmessagemodel-link" class="col-sm-4 control-label">

                            <span class="ng-binding">自定义链接：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="pushmessagemodel-link" class="form-control" name="PushMessageModel[link]">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 商品选择器 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                        <div class="goods-picker-container"></div>
                    </div>
                </div>
            </div>

            <input type="hidden" id="select_sku_id" name="select_sku_id">
            <!-- 推送对象 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="pushmessagemodel-platforms" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">推送对象平台：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <table class="table-list table-hover">
                                <tbody><tr>
                                    <td><input type="hidden" name="PushMessageModel[platforms]" value="0"><div id="pushmessagemodel-platforms" class="m-b-10" name="PushMessageModel[platforms]"><label class="control-label cur-p m-r-10"><input type="checkbox" name="PushMessageModel[platforms][]" value="ios" checked=""> IOS</label>
                                            <label class="control-label cur-p m-r-10"><input type="checkbox" name="PushMessageModel[platforms][]" value="android" checked=""> Android</label></div></td>
                                </tr>

                                <tr>
                                    <td><input type="hidden" name="PushMessageModel[target_type]" value="0"><div id="pushmessagemodel-target_type" class="m-b-10" name="PushMessageModel[target_type]"><label class="control-label cur-p m-r-10"><input type="radio" name="PushMessageModel[target_type]" value="all" checked=""> 广播（所有人）</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="PushMessageModel[target_type]" value="alias"> 设备别名(Alias)</label></div></td>
                                </tr>
                                <tr style="display: none" class="target_text">
                                    <td><input type="text" id="pushmessagemodel-target_text" class="form-control" name="PushMessageModel[target_text]" placeholder="如有多个设备标签或别名请用英文半角逗号(,)隔开"></td>
                                </tr>
                                <tr style="display: none" class="target_text">
                                    <td>
                                        <div class="help-block help-block-t">填写格式：xinge+会员编号。例如会员编号为111，应填写“xinge111”。只有在该用户登录状态下的APP终端会收到消息</div>
                                    </td>
                                </tr>

                                </tbody></table>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            @if($type == 5)
            <!-- 计划名称 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="pushmessagemodel-sales_name" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">计划名称：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <input type="text" id="pushmessagemodel-sales_name" class="form-control" name="PushMessageModel[sales_name]">


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="bottom-btn p-b-30">
                <input type="button" class="btn btn-primary btn-lg" id="btn_submit" name="btn_submit" value="确认提交">
            </div>

        </form>
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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.3"></script>
    <!-- 商品选择器 -->
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.3"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "pushmessagemodel-title", "name": "PushMessageModel[title]", "attribute": "title", "rules": {"required":true,"messages":{"required":"推送标题不能为空。"}}},{"id": "pushmessagemodel-content", "name": "PushMessageModel[content]", "attribute": "content", "rules": {"required":true,"messages":{"required":"推送内容不能为空。"}}},{"id": "pushmessagemodel-push_type", "name": "PushMessageModel[push_type]", "attribute": "push_type", "rules": {"required":true,"messages":{"required":"推送类型不能为空。"}}},{"id": "pushmessagemodel-platforms", "name": "PushMessageModel[platforms]", "attribute": "platforms", "rules": {"required":true,"messages":{"required":"推送对象平台不能为空。"}}},{"id": "pushmessagemodel-target_type", "name": "PushMessageModel[target_type]", "attribute": "target_type", "rules": {"required":true,"messages":{"required":"推送对象条件不能为空。"}}},{"id": "pushmessagemodel-sales_type", "name": "PushMessageModel[sales_type]", "attribute": "sales_type", "rules": {"required":true,"messages":{"required":"Sales Type不能为空。"}}},{"id": "pushmessagemodel-sales_name", "name": "PushMessageModel[sales_name]", "attribute": "sales_name", "rules": {"required":true,"messages":{"required":"计划名称不能为空。"}}},{"id": "pushmessagemodel-group_id", "name": "PushMessageModel[group_id]", "attribute": "group_id", "rules": {"required":true,"messages":{"required":"选择人群不能为空。"}}},{"id": "pushmessagemodel-push_type", "name": "PushMessageModel[push_type]", "attribute": "push_type", "rules": {"string":true,"messages":{"string":"推送类型必须是一条字符串。"}}},{"id": "pushmessagemodel-platforms", "name": "PushMessageModel[platforms]", "attribute": "platforms", "rules": {"string":true,"messages":{"string":"推送对象平台必须是一条字符串。"}}},{"id": "pushmessagemodel-title", "name": "PushMessageModel[title]", "attribute": "title", "rules": {"string":true,"messages":{"string":"推送标题必须是一条字符串。","maxlength":"推送标题只能包含至多15个字符。"},"maxlength":15}},{"id": "pushmessagemodel-content", "name": "PushMessageModel[content]", "attribute": "content", "rules": {"string":true,"messages":{"string":"推送内容必须是一条字符串。","maxlength":"推送内容只能包含至多255个字符。"},"maxlength":255}},{"id": "pushmessagemodel-target_text", "name": "PushMessageModel[target_text]", "attribute": "target_text", "rules": {"string":true,"messages":{"string":"设备标签或别名必须是一条字符串。","maxlength":"设备标签或别名只能包含至多255个字符。"},"maxlength":255}},{"id": "pushmessagemodel-push_type", "name": "PushMessageModel[push_type]", "attribute": "push_type", "rules": {"required":true,"messages":{"required":"推送类型不能为空。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
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

            var validator = $("#PushMessageModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                $.loading.start();
                $.ajax({
                    cache: false,
                    type: "POST",
                    data: $("#PushMessageModel").serialize(),
                    url: "index",
                    success: function(result) {
                        var result = eval('(' + result + ')');
                        if (result.code == 0) {
                            if (result.url != '') {
                                $.go(result.url);
                            }
                            $.msg(result.message);
                        } else {
                            $.alert(result.message, {
                                icon: 2
                            });
                        }
                    },
                    error: function(result) {
                        $.alert("异常", {
                            icon: 2
                        });
                    }
                });
            });
            //选择设备别名或者设备标签时显示的输入框
            $("input[name='PushMessageModel[target_type]']").click(function() {
                if ($(this).val() == 'tag' || $(this).val() == 'alias') {
                    $('.target_text').show();
                } else {
                    $('.target_text').hide();
                }
            })

            $('#pushmessagemodel-push_type').change(function() {
                $(".change").hide();
                var container = $(".goods-picker-container");
                var page_id = "GoodsPickerPage";
                if (!$.goodspickers(page_id)) {
                    if ($(this).val() == '0') {
                        $.goodspickers(page_id);
                        var goodspicker = $(container).goodspicker({
                            data: {
                                page: {
                                    // 分页唯一标识
                                    page_id: page_id
                                },
                            },
                            // 选择商品和未选择商品的按钮单击事件
                            // @param selected 点击是否选中
                            // @param sku 选中的SKU对象
                            click: function(selected, sku) {
                                for ( var key in this.values) {
                                    var goods_id = this.values[key].goods_id;
                                    var sku_id = this.values[key].sku_id;
                                    if (sku_id != sku.sku_id) {
                                        this.remove(goods_id, sku_id);
                                    }
                                }
                                $("#select_sku_id").val(sku_id);
                            },
                        });
                    }
                } else {
                    if ($(this).val() == '0') {
                        $(container).show();
                    } else {
                        $(container).hide();
                    }
                }

                // 店铺主页
                if ($(this).val() == '1') {
                    $(".shop").show();
                }
                // 文章详情
                if ($(this).val() == '2') {
                    $(".article").show();
                }
                // 分类商品
                if ($(this).val() == '3') {
                    $(".category").show();
                }
                // 团购活动
                if ($(this).val() == '4') {
                    $(".group").show();
                }
                // 品牌专题
                if ($(this).val() == '5') {
                    $(".brand").show();
                }
                // 自定义链接
                if ($(this).val() == '6') {
                    $(".link").show();
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
