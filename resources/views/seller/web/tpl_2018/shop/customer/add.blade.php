{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')
    <div class="table-content m-t-30 clearfix">
        <form id="CustomerModel" class="form-horizontal" name="CustomerModel" action="/shop/customer/add" method="post">
            @csrf
            <input type="hidden" id="customermodel-customer_id" class="form-control" name="CustomerModel[customer_id]" value="{{ $info->customer_id ?? '' }}">
            <input type="hidden" id="customermodel-shop_id" class="form-control" name="CustomerModel[shop_id]" value="{{ $shop->shop_id }}">
            <!-- 客服工具 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customermodel-customer_tool" class="col-sm-4 control-label">
                        <span class="ng-binding">客服工具：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select id="customermodel-customer_tool" class="form-control w150 m-r-5" name="CustomerModel[customer_tool]">
                                @if(!isset($info->customer_id))
                                    <option value="1">QQ</option>
                                    <option value="2">旺旺</option>
                                    <option value="3">云客服</option>
                                @else
                                    <option value="1" @if($info->customer_tool == 1) selected @endif>QQ</option>
                                    <option value="2" @if($info->customer_tool == 2) selected @endif>旺旺</option>
                                    <option value="3" @if($info->customer_tool == 3) selected @endif>云客服</option>
                                @endif
                            </select>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">客服工具是QQ，则客服账号输入QQ号码；客服工具是旺旺，则客服账号输入旺旺号码；客服工具是云客服，则客服账号输入要注册的账号</div></div>
                    </div>
                </div>
            </div>
            <!-- 客服类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="customermodel-type_id" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">客服类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select id="customermodel-type_id" class="form-control w150 m-r-5" name="CustomerModel[type_id]">
                                <option value="0">-- 请选择 --</option>
                                @foreach($customer_type as $v)
                                    <option value="{{ $v->type_id }}" @if(@$info->type_id == $v->type_id) selected @endif>{{ $v->type_name }}</option>
                                @endforeach
                            </select>
                            <a href="/shop/customer-type/add" class="btn btn-warning btn-sm m-l-10" target="_blank">添加客服类型</a>
                            <a id="btn_reload" class="btn btn-primary btn-sm m-l-5">重新加载</a>
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
            <!-- 绑定管理员 -->
            <div class='user_id_div'  style='display:none'>
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="customermodel-user_id" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">店铺管理员：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <select id="customermodel-user_id" class="form-control ipt m-r-5 chosen-select" name="CustomerModel[user_id]">
                                    <option value="0">-- 请选择 --</option>
                                    <option value="2815">qdmaaaaaa</option>
                                </select>
                                <a href="/shop/account/add" class="btn btn-warning btn-sm m-l-10" target="_blank">添加管理员</a>
                                <a id="btn_user_reload" class="btn btn-primary btn-sm m-l-5">重新加载</a>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">客服绑定店铺管理员，客服人员在客服系统可一键登录卖家中心，管理员在卖家中心可一键登录客服系统</div></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 客服账号 -->
            <div class='customer_account_div'>
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
            </div>
            <!-- 是否主客服 -->
            <div class='is_main_div'>
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
                </div>        </div>
            <!-- 是否显示 -->
            <div class='is_show_div'>
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
                </div>        </div>
            <!-- 排序 -->
            <div class='customer_sort_div'>
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
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "customermodel-type_id", "name": "CustomerModel[type_id]", "attribute": "type_id", "rules": {"required":true,"messages":{"required":"客服类型不能为空。"}}},{"id": "customermodel-customer_name", "name": "CustomerModel[customer_name]", "attribute": "customer_name", "rules": {"required":true,"messages":{"required":"客服名称不能为空。"}}},{"id": "customermodel-customer_account", "name": "CustomerModel[customer_account]", "attribute": "customer_account", "rules": {"required":true,"messages":{"required":"客服账号不能为空。"}}},{"id": "customermodel-customer_sort", "name": "CustomerModel[customer_sort]", "attribute": "customer_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "customermodel-user_id", "name": "CustomerModel[user_id]", "attribute": "user_id", "rules": {"required":true,"messages":{"required":"店铺管理员不能为空。"}}},{"id": "customermodel-is_main", "name": "CustomerModel[is_main]", "attribute": "is_main", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否主客服必须是整数。"}}},{"id": "customermodel-is_show", "name": "CustomerModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "customermodel-customer_tool", "name": "CustomerModel[customer_tool]", "attribute": "customer_tool", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"客服工具必须是整数。"}}},{"id": "customermodel-admin_id", "name": "CustomerModel[admin_id]", "attribute": "admin_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"后台管理员id必须是整数。"}}},{"id": "customermodel-site_id", "name": "CustomerModel[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点id必须是整数。"}}},{"id": "customermodel-user_id", "name": "CustomerModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺管理员必须是整数。"}}},{"id": "customermodel-customer_account", "name": "CustomerModel[customer_account]", "attribute": "customer_account", "rules": {"string":true,"messages":{"string":"客服账号必须是一条字符串。","maxlength":"客服账号只能包含至多50个字符。"},"maxlength":50}},{"id": "customermodel-customer_name", "name": "CustomerModel[customer_name]", "attribute": "customer_name", "rules": {"string":true,"messages":{"string":"客服名称必须是一条字符串。","maxlength":"客服名称只能包含至多4个字符。"},"maxlength":4}},{"id": "customermodel-customer_sort", "name": "CustomerModel[customer_sort]", "attribute": "customer_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "customermodel-type_id", "name": "CustomerModel[type_id]", "attribute": "type_id", "rules": {"compare":{"operator":">","type":"number","compareValue":"0","skipOnEmpty":1},"messages":{"compare":"客服类型不能为空。"}}},]
</script>
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            var customer_tool=$('#customermodel-customer_tool').val();
            var customer_id=$('#customermodel-customer_id').val();
            if(customer_tool==3){
                $('.is_main_div').css("display","none");
                $('.is_show_div').css("display","none");
                $('.customer_sort_div').css("display","none");
                $('.user_id_div').css("display","block");
                $('#customermodel-customer_account').attr('readonly',true);
            }
            if(customer_id!=""){
                $('#customermodel-customer_tool').attr("disabled","disabled");
                if(customer_tool==3){
                    $('#customermodel-customer_account').attr('readonly',true);
                }
                $('#customermodel-user_id').attr("disabled","disabled");
            }
            $('#customermodel-customer_tool').change(function(){
                var customer_tool=$(this).val();
                if(customer_tool==3){
                    $('#customermodel-customer_account').attr('readonly',true);
                    $('.is_main_div').css("display","none");
                    $('.is_show_div').css("display","none");
                    $('.customer_sort_div').css("display","none");
                    $('.user_id_div').css("display","block");
                }else{
                    $('#customermodel-customer_account').attr('readonly',false);
                    $('.is_main_div').css("display","block");
                    $('.is_show_div').css("display","block");
                    $('.customer_sort_div').css("display","block");
                    $('.user_id_div').css("display","none");
                    $('#customermodel-user_id').val(0);
                }
            })
            $('#customermodel-user_id').change(function(){
                var options=$("#customermodel-user_id option:selected");
                $('#customermodel-customer_account').val(options.html());
            })
        })
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
            // 重新加载
            $("#btn_reload").click(function() {
                $.loading.start();
                $.get("/shop/customer/type-list", {}, function(result) {
                    if (result.code == 0) {
                        var list = result.data;
                        var html = "";
                        for ( var name in result.data) {
                            html += "<option value='"+name+"'>" + result.data[name] + "</option>";
                        }
                        $("#customermodel-type_id").html(html);
                        $(".chosen-select").chosen("destroy").chosen();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });
            $("#btn_user_reload").click(function() {
                $.loading.start();
                $.get("/shop/customer/user-list", {}, function(result) {
                    if (result.code == 0) {
                        var list = result.data;
                        var html = "";
                        for ( var name in result.data) {
                            html += "<option value='"+name+"'>" + result.data[name] + "</option>";
                        }
                        $("#customermodel-user_id").html(html);
                        $(".chosen-select").chosen("destroy").chosen();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
