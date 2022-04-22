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
        <form id="ContractModel" class="form-horizontal" name="ContractModel" action="/mall/contract/add" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="contractmodel-contract_id" class="form-control" name="ContractModel[contract_id]" value="{{ $info->contract_id ?? '' }}">
            <!-- 保障服务名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="contractmodel-contract_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">保障服务名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="contractmodel-contract_name" class="form-control" name="ContractModel[contract_name]" value="{{ $info->contract_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入10个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 保证金金额 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="contractmodel-contract_fee" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">保证金：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="contractmodel-contract_fee" class="form-control ipt valid" name="ContractModel[contract_fee]" value="{{ $info->contract_fee ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请输入大于或等于0的数字</div></div>
                    </div>
                </div>
            </div>
            <!-- 保障服务图标 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="contractmodel-contract_image" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">保障服务图标：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <div id="credit_img_container"></div>
                            <input type="hidden" id="contract_image" class="form-control" name="ContractModel[contract_image]" value="{{ $info->contract_image ?? '' }}">



                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最佳显示尺寸为16*16像素的图片，允许上传的图片格式：jpg、jpeg、gif、png</div></div>
                    </div>
                </div>
            </div>
            <!-- 保障类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="contractmodel-contract_type" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">保障类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="contractmodel-contract_type" class="form-control" name="ContractModel[contract_type]">
                                @if(isset($info->contract_id))
                                    <option value="0" @if($info->contract_type == 0) selected @endif>初级服务</option>
                                    <option value="1" @if($info->contract_type == 1) selected @endif>高级服务</option>
                                @else
                                    <option value="0">初级服务</option>
                                    <option value="1">高级服务</option>
                                @endif
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 保障服务描述 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="contractmodel-contract_desc" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">保障服务描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="contractmodel-contract_desc" class="form-control" name="ContractModel[contract_desc]" rows="5">{!! $info->contract_desc ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入80个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否开启 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="contractmodel-is_open" class="col-sm-4 control-label">

                        <span class="ng-binding">是否开启：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ContractModel[is_open]" value="0">
                                    <label>
                                        @if(isset($info->is_open))
                                            <input type="checkbox" id="contractmodel-is_open" class="form-control b-n"
                                                   name="ContractModel[is_open]" value="1" @if($info->is_open == 1) checked @endif
                                                   @if($info->is_in_use) disabled="" @endif
                                                   data-on-text="是" data-off-text="否">
                                        @else
                                            <input type="checkbox" id="contractmodel-is_open" class="form-control b-n"
                                                   name="ContractModel[is_open]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="contractmodel-contract_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="contractmodel-contract_sort" class="form-control small" name="ContractModel[contract_sort]" value="{{ $info->contract_sort ?? 255}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交"/>
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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180809"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180809"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180809"></script>
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180809"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180809"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180809"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "contractmodel-contract_name", "name": "ContractModel[contract_name]", "attribute": "contract_name", "rules": {"required":true,"messages":{"required":"保障服务名称不能为空。"}}},{"id": "contractmodel-contract_type", "name": "ContractModel[contract_type]", "attribute": "contract_type", "rules": {"required":true,"messages":{"required":"保障类型不能为空。"}}},{"id": "contractmodel-contract_fee", "name": "ContractModel[contract_fee]", "attribute": "contract_fee", "rules": {"required":true,"messages":{"required":"保证金不能为空。"}}},{"id": "contractmodel-contract_desc", "name": "ContractModel[contract_desc]", "attribute": "contract_desc", "rules": {"required":true,"messages":{"required":"保障服务描述不能为空。"}}},{"id": "contractmodel-contract_sort", "name": "ContractModel[contract_sort]", "attribute": "contract_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "contractmodel-contract_fee", "name": "ContractModel[contract_fee]", "attribute": "contract_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"保证金必须是一个数字。","min":"保证金必须不小于0。","max":"保证金必须不大于99999999.99。"},"min":0,"max":99999999.99}},{"id": "contractmodel-contract_fee", "name": "ContractModel[contract_fee]", "attribute": "contract_fee", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"保证金最多两位小数。"}}},{"id": "contractmodel-contract_type", "name": "ContractModel[contract_type]", "attribute": "contract_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"保障类型必须是整数。"}}},{"id": "contractmodel-is_open", "name": "ContractModel[is_open]", "attribute": "is_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否开启必须是整数。"}}},{"id": "contractmodel-contract_name", "name": "ContractModel[contract_name]", "attribute": "contract_name", "rules": {"string":true,"messages":{"string":"保障服务名称必须是一条字符串。","maxlength":"保障服务名称只能包含至多10个字符。"},"maxlength":10}},{"id": "contractmodel-contract_image", "name": "ContractModel[contract_image]", "attribute": "contract_image", "rules": {"required":true,"messages":{"required":"保障服务图标不能为空。"}}},{"id": "contractmodel-contract_image", "name": "ContractModel[contract_image]", "attribute": "contract_image", "rules": {"string":true,"messages":{"string":"保障服务图标必须是一条字符串。","maxlength":"保障服务图标只能包含至多255个字符。"},"maxlength":255}},{"id": "contractmodel-contract_desc", "name": "ContractModel[contract_desc]", "attribute": "contract_desc", "rules": {"string":true,"messages":{"string":"保障服务描述必须是一条字符串。","maxlength":"保障服务描述只能包含至多80个字符。"},"maxlength":80}},{"id": "contractmodel-contract_sort", "name": "ContractModel[contract_sort]", "attribute": "contract_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
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
            var validator = $("#ContractModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ContractModel").submit();
            });
            $("#credit_img_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: 1,
                mode: 0,
                // values: [""],
                values: $('#contract_image').val().split("|"),
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $("#contract_image").val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $("#contract_image").val(values);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop