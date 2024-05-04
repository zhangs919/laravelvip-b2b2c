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

    <div class="table-content m-t-30 clearfix">
        <form id="ShopCreditModel" class="form-horizontal" name="ShopCreditModel" action="/shop/shop-credit/add" method="post" enctype="multipart/form-data" novalidate="novalidate">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="shopcreditmodel-credit_id" class="form-control" name="ShopCreditModel[credit_id]" value="{{ $info->credit_id ?? '' }}">
            <!-- 店铺信誉名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopcreditmodel-credit_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺信誉名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopcreditmodel-credit_name" class="form-control" name="ShopCreditModel[credit_name]" value="{{ $info->credit_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 上传等级图标 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopcreditmodel-credit_img" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">店铺信誉图标：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            @if(!empty($info->credit_img))
                                <div id="credit_img_container">
                                    <ul class="image-group">
                                        <li data-label-index="0" title="点击预览图片">
                                            <span title="删除图片" class="image-group-remove">删除图片</span>
                                            <a href="javascript:void(0);" data-value="{{ get_image_url($info->credit_img) }}"
                                               data-url="{{ get_image_url($info->credit_img) }}">
                                                <img src="{{ get_image_url($info->credit_img) }}"
                                                     data-value="{{ get_image_url($info->credit_img) }}"
                                                     data-url="{{ get_image_url($info->credit_img) }}">
                                            </a>
                                        </li>
                                        <li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"
                                            style="display: none;">
                                            <div class="image-group-bg"></div>
                                        </li>
                                    </ul>
                                </div>
                                <input type="hidden" id="credit_img" class="form-control" name="ShopCreditModel[credit_img]" value="{{ $info->credit_img }}">
                            @else
                                <div id="credit_img_container"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                                <input type="hidden" id="credit_img" class="form-control" name="ShopCreditModel[credit_img]">
                            @endif



                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">因每个店铺信誉图标所展示的内容依次累积，则最佳显示尺寸高度为16像素，宽度可根据自身情况设定，但最大宽度不要超过90像素</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">信誉值范围：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select class="form-control m-r-5 rangeSelect" name="range">
                                <option value="0">介于</option>
                                <option value="1">大于</option>
                            </select>
                            <input type="text" id="shopcreditmodel-min_point" class="form-control ipt" name="ShopCreditModel[min_point]" value="{{ $info->min_point ?? '' }}">
                            <span class="ctime m-t-5 between">~</span>
                            <input type="text" id="shopcreditmodel-max_point" class="form-control ipt between" name="ShopCreditModel[max_point]" value="{{ $info->max_point ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 备注 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="shopcreditmodel-remark" class="col-sm-4 control-label">

                        <span class="ng-binding">备注：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="shopcreditmodel-remark" class="form-control" name="ShopCreditModel[remark]" rows="5">{!! $info->remark ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交">

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
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

    <script src="/assets/d2eace91/js/individual.js?v=1.2"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    @if(isset($info->credit_id))
        [{"id": "shopcreditmodel-credit_id", "name": "ShopCreditModel[credit_id]", "attribute": "credit_id", "rules": {"required":true,"messages":{"required":"Credit Id不能为空。"}}},{"id": "shopcreditmodel-credit_img", "name": "ShopCreditModel[credit_img]", "attribute": "credit_img", "rules": {"required":true,"messages":{"required":"店铺信誉图标不能为空。"}}},{"id": "shopcreditmodel-credit_name", "name": "ShopCreditModel[credit_name]", "attribute": "credit_name", "rules": {"required":true,"messages":{"required":"店铺信誉名称不能为空。"}}},{"id": "shopcreditmodel-min_point", "name": "ShopCreditModel[min_point]", "attribute": "min_point", "rules": {"required":true,"messages":{"required":"信誉值最小值不能为空。"}}},{"id": "shopcreditmodel-min_point", "name": "ShopCreditModel[min_point]", "attribute": "min_point", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"信誉值最小值必须是整数。","min":"信誉值最小值必须不小于0。","max":"信誉值最小值必须不大于9999999。"},"min":0,"max":9999999}},{"id": "shopcreditmodel-max_point", "name": "ShopCreditModel[max_point]", "attribute": "max_point", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"信誉值最大值必须是整数。","min":"信誉值最大值必须不小于0。","max":"信誉值最大值必须不大于9999999。"},"min":0,"max":9999999}},{"id": "shopcreditmodel-min_point", "name": "ShopCreditModel[min_point]", "attribute": "min_point", "rules": {"compare":{"operator":"<=","type":"number","compareAttribute":"shopcreditmodel-max_point","skipOnEmpty":1},"messages":{"compare":"信誉最小值不能大于最大值"}}},{"id": "shopcreditmodel-max_point", "name": "ShopCreditModel[max_point]", "attribute": "max_point", "rules": {"compare":{"operator":">=","type":"number","compareAttribute":"shopcreditmodel-min_point","skipOnEmpty":1},"messages":{"compare":"信誉最大值不能小于最小值"}}},{"id": "shopcreditmodel-credit_name", "name": "ShopCreditModel[credit_name]", "attribute": "credit_name", "rules": {"string":true,"messages":{"string":"店铺信誉名称必须是一条字符串。","maxlength":"店铺信誉名称只能包含至多30个字符。"},"maxlength":30}},{"id": "shopcreditmodel-remark", "name": "ShopCreditModel[remark]", "attribute": "remark", "rules": {"string":true,"messages":{"string":"备注必须是一条字符串。","maxlength":"备注只能包含至多255个字符。"},"maxlength":255}},{"id": "shopcreditmodel-credit_name", "name": "ShopCreditModel[credit_name]", "attribute": "credit_name", "rules": {"ajax":{"url":"/shop/shop-credit/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcU2hvcENyZWRpdE1vZGVs","attribute":"credit_name","params":["ShopCreditModel[credit_id]"],"scenario":"update"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @else
        [{"id": "shopcreditmodel-credit_img", "name": "ShopCreditModel[credit_img]", "attribute": "credit_img", "rules": {"required":true,"messages":{"required":"店铺信誉图标不能为空。"}}},{"id": "shopcreditmodel-credit_name", "name": "ShopCreditModel[credit_name]", "attribute": "credit_name", "rules": {"required":true,"messages":{"required":"店铺信誉名称不能为空。"}}},{"id": "shopcreditmodel-min_point", "name": "ShopCreditModel[min_point]", "attribute": "min_point", "rules": {"required":true,"messages":{"required":"信誉值最小值不能为空。"}}},{"id": "shopcreditmodel-min_point", "name": "ShopCreditModel[min_point]", "attribute": "min_point", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"信誉值最小值必须是整数。","min":"信誉值最小值必须不小于0。","max":"信誉值最小值必须不大于9999999。"},"min":0,"max":9999999}},{"id": "shopcreditmodel-max_point", "name": "ShopCreditModel[max_point]", "attribute": "max_point", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"信誉值最大值必须是整数。","min":"信誉值最大值必须不小于0。","max":"信誉值最大值必须不大于9999999。"},"min":0,"max":9999999}},{"id": "shopcreditmodel-min_point", "name": "ShopCreditModel[min_point]", "attribute": "min_point", "rules": {"compare":{"operator":"<=","type":"number","compareAttribute":"shopcreditmodel-max_point","skipOnEmpty":1},"messages":{"compare":"信誉最小值不能大于最大值"}}},{"id": "shopcreditmodel-max_point", "name": "ShopCreditModel[max_point]", "attribute": "max_point", "rules": {"compare":{"operator":">=","type":"number","compareAttribute":"shopcreditmodel-min_point","skipOnEmpty":1},"messages":{"compare":"信誉最大值不能小于最小值"}}},{"id": "shopcreditmodel-credit_name", "name": "ShopCreditModel[credit_name]", "attribute": "credit_name", "rules": {"string":true,"messages":{"string":"店铺信誉名称必须是一条字符串。","maxlength":"店铺信誉名称只能包含至多30个字符。"},"maxlength":30}},{"id": "shopcreditmodel-remark", "name": "ShopCreditModel[remark]", "attribute": "remark", "rules": {"string":true,"messages":{"string":"备注必须是一条字符串。","maxlength":"备注只能包含至多255个字符。"},"maxlength":255}},{"id": "shopcreditmodel-credit_name", "name": "ShopCreditModel[credit_name]", "attribute": "credit_name", "rules": {"ajax":{"url":"/shop/shop-credit/client-validate","model":"YXBwXG1vZHVsZXNcc2hvcFxtb2RlbHNcU2hvcENyZWRpdE1vZGVs","attribute":"credit_name","params":[],"scenario":"create"},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @endif
    </script>

    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ShopCreditModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                validator.form();
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ShopCreditModel").submit();
            });

            // 标识是否清空最大值
            var flg = false;
            $(".rangeSelect").change(function() {
                if ($(this).val() == 0) {
                    if (flg) {
                        $("#shopcreditmodel-max_point").val('');
                    }
                    $(".between").show();
                } else {
                    $("#shopcreditmodel-max_point").val('9999999999');
                    $(".between").hide();
                }
                flg = true;
                //$("#shopcreditmodel-max_point").valid();
                //$("#shopcreditmodel-min_point").valid();
            });

            $(".rangeSelect").change();

            $("#credit_img_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: 1,
                mode: 0,
                values: ["@if(!empty($info->credit_img)){{ get_image_url($info->credit_img)  }}@endif"], // system/credit
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $("#credit_img").val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $("#credit_img").val(values);
                }
            });

        });
    </script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop