{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="CustomerModel" class="form-horizontal" name="CustomerModel" action="/shop/customer/add" method="post">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="customermodel-customer_id" class="form-control" name="CustomerModel[customer_id]" value="{{ $info->customer_id ?? '' }}">
            <input type="hidden" id="customermodel-shop_id" class="form-control" name="CustomerModel[shop_id]" value="{{ $shop_info->shop_id }}">
            <!-- 客服类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customermodel-type_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">客服类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="customermodel-type_id" class="form-control ipt m-r-5" name="CustomerModel[type_id]">
                                @foreach($customer_type as $v)
                                <option value="{{ $v->type_id }}" @if(@$info->type_id == $v->type_id) selected @endif>{{ $v->type_name }}</option>
                                @endforeach
                            </select>

                            <div class="help-block help-block-t">如果没有您需要的客服类型，您可以点此<a href="/shop/customer-type/add" class="btn-link">添加客服类型</a></div>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 客服名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customermodel-customer_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">客服名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="customermodel-customer_name" class="form-control" name="CustomerModel[customer_name]" value="{{ $info->customer_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">客服与用户在线聊天时显示的名称，为保证页面美观度，建议客服名称不要超过4个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 客服工具 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customermodel-customer_tool" class="col-sm-4 control-label">

                        <span class="ng-binding">客服工具：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="customermodel-customer_tool" class="form-control ipt m-r-5" name="CustomerModel[customer_tool]">
                                @if(!isset($info->customer_id))
                                    <option value="1">QQ</option>
                                    <option value="2">旺旺</option>
                                @else
                                    <option value="1" @if($info->customer_tool == 1) selected @endif>QQ</option>
                                    <option value="2" @if($info->customer_tool == 2) selected @endif>旺旺</option>
                                @endif
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">客服工具是QQ，则客服账号输入QQ号码；客服工具是旺旺，则客服账号输入旺旺号码</div></div>
                    </div>
                </div>
            </div>
            <!-- 客服账号 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customermodel-customer_account" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">客服账号：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="customermodel-customer_account" class="form-control" name="CustomerModel[customer_account]" value="{{ $info->customer_account ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 是否主客服 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customermodel-is_main" class="col-sm-4 control-label">

                        <span class="ng-binding">是否主客服：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            {{--需要判断是否存在主客服 如果存在 则不能修改 否则可以修改--}}
                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="CustomerModel[is_main]" value="0">
                                    @if(!isset($info->is_main))
                                        <label><input type="checkbox" id="customermodel-is_main" class="form-control b-n"
                                                      name="CustomerModel[is_main]" value="1" disabled="" data-on-text="是"
                                                      data-off-text="否"> </label>
                                    @else
                                        <label><input type="checkbox" id="customermodel-is_main" class="form-control b-n"
                                                      name="CustomerModel[is_main]" value="1" disabled="" @if($info->is_main == 1)checked @endif data-on-text="是"
                                                      data-off-text="否"> </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">主客服会显示在商品详情页右侧客服联系部分，每个店铺只能设置一个主客服</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customermodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="CustomerModel[is_show]" value="0">
                                    @if(!isset($info->is_show))
                                        <label><input type="checkbox" id="customermodel-is_show" class="form-control b-n"
                                                      name="CustomerModel[is_show]" value="1" checked data-on-text="是"
                                                      data-off-text="否"> </label>
                                    @else
                                        <label><input type="checkbox" id="customermodel-is_show" class="form-control b-n"
                                                      name="CustomerModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                      data-off-text="否"> </label>
                                    @endif
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
                    <label for="customermodel-customer_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="customermodel-customer_sort" class="form-control" name="CustomerModel[customer_sort]" value="{{ $info->customer_sort ?? 255 }}" style="width: 60px;">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交" />

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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "customermodel-type_id", "name": "CustomerModel[type_id]", "attribute": "type_id", "rules": {"required":true,"messages":{"required":"客服类型不能为空。"}}},{"id": "customermodel-customer_name", "name": "CustomerModel[customer_name]", "attribute": "customer_name", "rules": {"required":true,"messages":{"required":"客服名称不能为空。"}}},{"id": "customermodel-customer_account", "name": "CustomerModel[customer_account]", "attribute": "customer_account", "rules": {"required":true,"messages":{"required":"客服账号不能为空。"}}},{"id": "customermodel-customer_sort", "name": "CustomerModel[customer_sort]", "attribute": "customer_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "customermodel-is_main", "name": "CustomerModel[is_main]", "attribute": "is_main", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否主客服必须是整数。"}}},{"id": "customermodel-is_show", "name": "CustomerModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "customermodel-customer_tool", "name": "CustomerModel[customer_tool]", "attribute": "customer_tool", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"客服工具必须是整数。"}}},{"id": "customermodel-customer_account", "name": "CustomerModel[customer_account]", "attribute": "customer_account", "rules": {"string":true,"messages":{"string":"客服账号必须是一条字符串。","maxlength":"客服账号只能包含至多50个字符。"},"maxlength":50}},{"id": "customermodel-customer_name", "name": "CustomerModel[customer_name]", "attribute": "customer_name", "rules": {"string":true,"messages":{"string":"客服名称必须是一条字符串。","maxlength":"客服名称只能包含至多4个字符。"},"maxlength":4}},{"id": "customermodel-customer_sort", "name": "CustomerModel[customer_sort]", "attribute": "customer_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#CustomerModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#CustomerModel").submit();

            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop