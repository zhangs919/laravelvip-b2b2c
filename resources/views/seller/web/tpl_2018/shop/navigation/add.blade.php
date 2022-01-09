{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <form id="ShopNavigationModel" class="form-horizontal" name="ShopNavigationModel" action="/shop/navigation/add?is_design={{ $is_design ?? 0 }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="ShopNavigationModel[nav_id]" value="{{ $info->nav_id ?? '' }}">
        <div class="table-content m-t-30 clearfix">
            <!-- 导航名称  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopnavigationmodel-nav_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">导航名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopnavigationmodel-nav_name" class="form-control" name="ShopNavigationModel[nav_name]" value="{{ $info->nav_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">建议添加2~4个字显示效果最佳</div></div>
                    </div>
                </div>
            </div>
            <!-- 导航类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopnavigationmodel-nav_type" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">导航类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select name="ShopNavigationModel[nav_type]" class="form-control chosen-select" id="select_nav_type">

                                @foreach(link_type() as $k=>$v)
                                    @if(isset($info->nav_id))
                                        <option value="{{ $k }}" @if($k == $info->nav_type) selected="true" @endif>{{ $v }}</option>
                                    @else
                                        <option value="{{ $k }}" @if($k == 0) selected="true" @endif>{{ $v }}</option>
                                    @endif
                                @endforeach

                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 链接地址  -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopnavigationmodel-nav_link" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">链接地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <div id="nav_link"></div>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopnavigationmodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopNavigationModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="shopnavigationmodel-is_show" class="form-control b-n"
                                                   name="ShopNavigationModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="shopnavigationmodel-is_show" class="form-control b-n"
                                                   name="ShopNavigationModel[is_show]" value="1" checked data-on-text="是"
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
            <!-- 新窗口打开 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopnavigationmodel-new_open" class="col-sm-4 control-label">

                        <span class="ng-binding">新窗口打开：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="ShopNavigationModel[new_open]" value="0">
                                    <label>
                                        @if(isset($info->new_open))
                                            <input type="checkbox" id="shopnavigationmodel-new_open" class="form-control b-n"
                                                   name="ShopNavigationModel[new_open]" value="1" @if($info->new_open == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="shopnavigationmodel-new_open" class="form-control b-n"
                                                   name="ShopNavigationModel[new_open]" value="1" checked data-on-text="是"
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
                    <label for="shopnavigationmodel-nav_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shopnavigationmodel-nav_sort" class="form-control" name="ShopNavigationModel[nav_sort]" value="{{ $info->nav_sort ?? 255 }}" style="width: 60px;">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="simple-form-field" >
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
        </div>
    </form>

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
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        @if(!isset($info->id))
            [{"id": "shopnavigationmodel-nav_type", "name": "ShopNavigationModel[nav_type]", "attribute": "nav_type", "rules": {"required":true,"messages":{"required":"导航类型不能为空。"}}},{"id": "shopnavigationmodel-nav_name", "name": "ShopNavigationModel[nav_name]", "attribute": "nav_name", "rules": {"required":true,"messages":{"required":"导航名称不能为空。"}}},{"id": "shopnavigationmodel-nav_link", "name": "ShopNavigationModel[nav_link]", "attribute": "nav_link", "rules": {"required":true,"messages":{"required":"链接地址不能为空。"}}},{"id": "shopnavigationmodel-nav_sort", "name": "ShopNavigationModel[nav_sort]", "attribute": "nav_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shopnavigationmodel-nav_type", "name": "ShopNavigationModel[nav_type]", "attribute": "nav_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"导航类型必须是整数。"}}},{"id": "shopnavigationmodel-is_show", "name": "ShopNavigationModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "shopnavigationmodel-new_open", "name": "ShopNavigationModel[new_open]", "attribute": "new_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"新窗口打开必须是整数。"}}},{"id": "shopnavigationmodel-nav_sort", "name": "ShopNavigationModel[nav_sort]", "attribute": "nav_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "shopnavigationmodel-nav_name", "name": "ShopNavigationModel[nav_name]", "attribute": "nav_name", "rules": {"string":true,"messages":{"string":"导航名称必须是一条字符串。","maxlength":"导航名称只能包含至多10个字符。"},"maxlength":10}},{"id": "shopnavigationmodel-nav_link", "name": "ShopNavigationModel[nav_link]", "attribute": "nav_link", "rules": {"string":true,"messages":{"string":"链接地址必须是一条字符串。","maxlength":"链接地址只能包含至多255个字符。"},"maxlength":255}},{"id": "shopnavigationmodel-is_show", "name": "ShopNavigationModel[is_show]", "attribute": "is_show", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否显示是无效的。"}}},{"id": "shopnavigationmodel-new_open", "name": "ShopNavigationModel[new_open]", "attribute": "new_open", "rules": {"in":{"range":["0","1"]},"messages":{"in":"新窗口打开是无效的。"}}},]
        @else
            [{"id": "shopnavigationmodel-nav_id", "name": "ShopNavigationModel[nav_id]", "attribute": "nav_id", "rules": {"required":true,"messages":{"required":"Nav Id不能为空。"}}},{"id": "shopnavigationmodel-nav_type", "name": "ShopNavigationModel[nav_type]", "attribute": "nav_type", "rules": {"required":true,"messages":{"required":"导航类型不能为空。"}}},{"id": "shopnavigationmodel-nav_name", "name": "ShopNavigationModel[nav_name]", "attribute": "nav_name", "rules": {"required":true,"messages":{"required":"导航名称不能为空。"}}},{"id": "shopnavigationmodel-nav_link", "name": "ShopNavigationModel[nav_link]", "attribute": "nav_link", "rules": {"required":true,"messages":{"required":"链接地址不能为空。"}}},{"id": "shopnavigationmodel-nav_sort", "name": "ShopNavigationModel[nav_sort]", "attribute": "nav_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "shopnavigationmodel-nav_type", "name": "ShopNavigationModel[nav_type]", "attribute": "nav_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"导航类型必须是整数。"}}},{"id": "shopnavigationmodel-is_show", "name": "ShopNavigationModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "shopnavigationmodel-new_open", "name": "ShopNavigationModel[new_open]", "attribute": "new_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"新窗口打开必须是整数。"}}},{"id": "shopnavigationmodel-nav_sort", "name": "ShopNavigationModel[nav_sort]", "attribute": "nav_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "shopnavigationmodel-nav_name", "name": "ShopNavigationModel[nav_name]", "attribute": "nav_name", "rules": {"string":true,"messages":{"string":"导航名称必须是一条字符串。","maxlength":"导航名称只能包含至多10个字符。"},"maxlength":10}},{"id": "shopnavigationmodel-nav_link", "name": "ShopNavigationModel[nav_link]", "attribute": "nav_link", "rules": {"string":true,"messages":{"string":"链接地址必须是一条字符串。","maxlength":"链接地址只能包含至多255个字符。"},"maxlength":255}},{"id": "shopnavigationmodel-is_show", "name": "ShopNavigationModel[is_show]", "attribute": "is_show", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否显示是无效的。"}}},{"id": "shopnavigationmodel-new_open", "name": "ShopNavigationModel[new_open]", "attribute": "new_open", "rules": {"in":{"range":["0","1"]},"messages":{"in":"新窗口打开是无效的。"}}},]
        @endif
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ShopNavigationModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ShopNavigationModel").submit();
            });

            //改变类型
            $("#select_nav_type").change(function() {
                var nav_type = $(this).val();
                $.ajax({
                    url: 'get-type-list',
                    dataType: 'json',
                    data: {
                        nav_type: nav_type,
                        nav_link: '{{ $info->nav_link ?? '' }}',
                    },
                    success: function(result) {
                        if (nav_type == 0) {
                            $("#nav_link").html("<input type='text' class='form-control valid' value='{{ $info->nav_link ?? '' }}' name='ShopNavigationModel[nav_link]' placeholder='添加链接地址'>");
                        } else {
                            $("#nav_link").html(result.data);
                        }
                    }
                });
            });

            $("#select_nav_type").change();
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop