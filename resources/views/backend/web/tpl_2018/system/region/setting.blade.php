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

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=region" method="post" enctype="multipart/form-data" novalidate="novalidate">

        {{ csrf_field() }}
        <input type="hidden" name="group" value="region">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-sale_level_names" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">经营地区行政级别名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-sale_level_names" class="form-control valid" name="SystemConfigModel[sale_level_names]" value="{{ $config_info['sale_level_names']->value }}" aria-invalid="false">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">对应经营地区列表1、2、3、4、5个行政级别的名称，数值越小，行政级别越高。行政级别名称间请用英文半角逗号“,”分割，提交后生效见效果</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-region_start" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">经营地区最高级别：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <select id="systemconfigmodel-region_start" class="form-control w120" name="SystemConfigModel[region_start]">
                                <option value="1" selected="">省</option>
                                <option value="2">市</option>
                                <option value="3">区/县</option>
                                <option value="4">镇</option>
                                <option value="5">街道/村</option>
                            </select>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制系统中经营地区选择的最高行政级别</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-region_end" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">经营地区最低级别：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <select id="systemconfigmodel-region_end" class="form-control w120" name="SystemConfigModel[region_end]">
                                <option value="1">省</option>
                                <option value="2">市</option>
                                <option value="3" selected="">区/县</option>
                                <option value="4">镇</option>
                                <option value="5">街道/村</option>
                            </select>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制系统中经营地区选择的最低行政级别</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-level_names" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">行政地区行政级别名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-level_names" class="form-control" name="SystemConfigModel[level_names]" value="{{ $config_info['level_names']->value }}">




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">对应行政地区列表1、2、3、4、5个行政级别的名称，数值越小，行政级别越高。行政级别名称间请用英文半角逗号“,”分割，提交后生效见效果</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-region_min_level" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">行政地区最低级别：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <select id="systemconfigmodel-region_min_level" class="form-control w120" name="SystemConfigModel[region_min_level]">
                                <option value="1">省</option>
                                <option value="2">市</option>
                                <option value="3">区/县</option>
                                <option value="4">镇</option>
                                <option value="5" selected="">街道/村</option>
                            </select>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制系统中非经营地区选择的最低行政级别</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-user_address_level" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">会员收货地址地区选择的最低级别：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <select id="systemconfigmodel-user_address_level" class="form-control" name="SystemConfigModel[user_address_level]">
                                <option value="0">最后一级</option>
                                <option value="1">省</option>
                                <option value="2">市</option>
                                <option value="3" selected="">区/县</option>
                                <option value="4">镇</option>
                                <option value="5">街道/村</option>
                            </select>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制会员添加/编译收货地址时选择地区的最低级别，此设置请勿小于“行政地区最低级别”</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-region_short_name" class="col-sm-4 control-label">

                        <span class="ng-binding">地区名称是否使用简写：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[region_short_name]" value="0">
                                    <label>
                                        <input type="checkbox"
                                               id="systemconfigmodel-region_short_name"
                                               class="form-control b-n"
                                               name="SystemConfigModel[region_short_name]"
                                               value="1" data-on-text="是"
                                               data-off-text="否">
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择是则地区选择控件将显示地区的简写，例如：内蒙古自治区将显示内蒙古</div></div>
                    </div>
                </div>
            </div>






            <div class="bottom-btn p-b-30">
                {{--                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">--}}
                <input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>

        </div></form>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

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
        [{"id": "systemconfigmodel-sale_level_names", "name": "SystemConfigModel[sale_level_names]", "attribute": "sale_level_names", "rules": {"string":true,"messages":{"string":"经营地区行政级别名称必须是一条字符串。"}}},{"id": "systemconfigmodel-sale_level_names", "name": "SystemConfigModel[sale_level_names]", "attribute": "sale_level_names", "rules": {"required":true,"messages":{"required":"经营地区行政级别名称不能为空。"}}},{"id": "systemconfigmodel-region_start", "name": "SystemConfigModel[region_start]", "attribute": "region_start", "rules": {"string":true,"messages":{"string":"经营地区最高级别必须是一条字符串。"}}},{"id": "systemconfigmodel-region_start", "name": "SystemConfigModel[region_start]", "attribute": "region_start", "rules": {"required":true,"messages":{"required":"经营地区最高级别不能为空。"}}},{"id": "systemconfigmodel-region_start", "name": "SystemConfigModel[region_start]", "attribute": "region_start", "rules": {"compare":{"operator":"<=","type":"string","compareAttribute":"systemconfigmodel-region_end","skipOnEmpty":1},"messages":{"compare":"地区起始行政级别不能大于结束行政级别"}}},{"id": "systemconfigmodel-region_end", "name": "SystemConfigModel[region_end]", "attribute": "region_end", "rules": {"string":true,"messages":{"string":"经营地区最低级别必须是一条字符串。"}}},{"id": "systemconfigmodel-region_end", "name": "SystemConfigModel[region_end]", "attribute": "region_end", "rules": {"required":true,"messages":{"required":"经营地区最低级别不能为空。"}}},{"id": "systemconfigmodel-region_end", "name": "SystemConfigModel[region_end]", "attribute": "region_end", "rules": {"compare":{"operator":">=","type":"string","compareAttribute":"systemconfigmodel-region_start","skipOnEmpty":1},"messages":{"compare":"地区结束行政级别不能小于起始行政级别"}}},{"id": "systemconfigmodel-level_names", "name": "SystemConfigModel[level_names]", "attribute": "level_names", "rules": {"string":true,"messages":{"string":"行政地区行政级别名称必须是一条字符串。"}}},{"id": "systemconfigmodel-level_names", "name": "SystemConfigModel[level_names]", "attribute": "level_names", "rules": {"required":true,"messages":{"required":"行政地区行政级别名称不能为空。"}}},{"id": "systemconfigmodel-region_min_level", "name": "SystemConfigModel[region_min_level]", "attribute": "region_min_level", "rules": {"string":true,"messages":{"string":"行政地区最低级别必须是一条字符串。"}}},{"id": "systemconfigmodel-region_min_level", "name": "SystemConfigModel[region_min_level]", "attribute": "region_min_level", "rules": {"required":true,"messages":{"required":"行政地区最低级别不能为空。"}}},{"id": "systemconfigmodel-region_min_level", "name": "SystemConfigModel[region_min_level]", "attribute": "region_min_level", "rules": {"compare":{"operator":">=","type":"number","compareAttribute":"systemconfigmodel-user_address_level","skipOnEmpty":1},"messages":{"compare":"“行政地区最低级别”不能高于“会员收货地址地区选择的最低级别”"}}},{"id": "systemconfigmodel-user_address_level", "name": "SystemConfigModel[user_address_level]", "attribute": "user_address_level", "rules": {"string":true,"messages":{"string":"会员收货地址地区选择的最低级别必须是一条字符串。"}}},{"id": "systemconfigmodel-user_address_level", "name": "SystemConfigModel[user_address_level]", "attribute": "user_address_level", "rules": {"required":true,"messages":{"required":"会员收货地址地区选择的最低级别不能为空。"}}},{"id": "systemconfigmodel-user_address_level", "name": "SystemConfigModel[user_address_level]", "attribute": "user_address_level", "rules": {"compare":{"operator":"<=","type":"number","compareAttribute":"systemconfigmodel-region_min_level","skipOnEmpty":1},"messages":{"compare":"“会员收货地址地区选择的最低级别”不能低于“行政地区最低级别”"}}},{"id": "systemconfigmodel-region_short_name", "name": "SystemConfigModel[region_short_name]", "attribute": "region_short_name", "rules": {"string":true,"messages":{"string":"地区名称是否使用简写必须是一条字符串。"}}},]
    </script>




    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#SystemConfigModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                validator.form();
                if (!validator.form()) {
                    return;
                }
                $.loading.start();
                $("#SystemConfigModel").submit();
                /**
                 var data = $("#SystemConfigModel").serializeJson();
                 $.post('/system/config/index', data, function(result) {
				if (result.code == 0) {
					$.msg(result.message, {
						icon: 1
					});
				} else {
					$.alert(result.message, {
						icon: 2
					});
				}
			}, "json");
                 **/
            });

            $(".szy-imagegroup").each(function() {
                var id = $(this).data("id");
                var size = $(this).data("size");
                var mode = $(this).data("mode");
                var labels = $(this).data("labels");
                var target = $("#" + id);
                var value = $(target).val() ;
                var options = $(this).data("options") ? $(this).data("options") : [];
                $(this).imagegroup({
                    host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/",
                    size: size,
                    mode: mode,
                    labels: labels,
                    options: options,
                    gallery: true,
                    values: value.split("|"),
                    // 回调函数
                    callback: function(data) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.val(values);
                    },
                    // 移除的回调函数
                    remove: function(value, values) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.val(values);
                    }
                });
            });

            $(".szy-videogroup").each(function() {
                var id = $(this).data("id");
                var size = $(this).data("size");
                var mode = $(this).data("mode");
                var labels = $(this).data("labels");

                var target = $("#" + id);
                var value = $(target).val() ;

                var options = $(this).data("options") ? $(this).data("options") : [];

                $(this).videogroup({
                    host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/",
                    size: size,
                    mode: mode,
                    labels: labels,
                    options: options,
                    values: value.split("|"),
                    // 回调函数
                    callback: function(data) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.val(values);
                    },
                    // 移除的回调函数
                    remove: function(value, values) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        target.val(values);
                    }
                });
            });
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop