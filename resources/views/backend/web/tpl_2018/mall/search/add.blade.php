{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30">
        <form id="DefaultSearchModel" class="form-horizontal" name="DefaultSearchModel" action="/mall/search/add" method="post" novalidate="novalidate">
            {{ csrf_field() }}

            <input type="hidden" id="defaultsearchmodel-id" class="form-control" name="DefaultSearchModel[id]" value="{{ $info->id ?? ''}}">

            <!-- 搜索类型 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="defaultsearchmodel-search_type" class="col-sm-4 control-label">

                        <span class="ng-binding">搜索类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="DefaultSearchModel[search_type]" value="" class="valid">
                            <div id="defaultsearchmodel-search_type" class="" name="DefaultSearchModel[search_type]" selection="0">
                                @if(isset($info->id))
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="DefaultSearchModel[search_type]" value="0" @if($info->search_type == 0) checked="" @endif> 默认</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="DefaultSearchModel[search_type]" value="1" @if($info->search_type == 1) checked="" @endif> 商品分类</label>
                                @else
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="DefaultSearchModel[search_type]" value="0" checked=""> 默认</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="DefaultSearchModel[search_type]" value="1"> 商品分类</label>
                                @endif
                            </div>
                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <div class=" deduct" style="display: none;">
                <!-- 分类ID -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="defaultsearchmodel-type_id" class="col-sm-4 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">商品分类：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="defaultsearchmodel-type_id" class="form-control" name="DefaultSearchModel[type_id]">
                                    <option value="0">-- 请选择 --</option>
                                    @foreach($category_list as $v)
                                        <option value="{{ $v->cat_id }}" @if(@$info->type_id == $v->cat_id) selected="selected" @endif>{{ $v->cat_name }}</option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 搜索词 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="defaultsearchmodel-search_keywords" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">搜索关键词：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="defaultsearchmodel-search_keywords" class="form-control" name="DefaultSearchModel[search_keywords]" rows="5">{!! $info->search_keywords ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">搜索词参与搜索，按回车区分词</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否显示 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="defaultsearchmodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="DefaultSearchModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="defaultsearchmodel-is_show" class="form-control b-n"
                                                   name="DefaultSearchModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="defaultsearchmodel-is_show" class="form-control b-n"
                                                   name="DefaultSearchModel[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启默认搜索，此搜索词将在前台搜索框下方显示</div></div>
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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "defaultsearchmodel-search_type", "name": "DefaultSearchModel[search_type]", "attribute": "search_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"搜索类型必须是整数。"}}},{"id": "defaultsearchmodel-type_id", "name": "DefaultSearchModel[type_id]", "attribute": "type_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品分类必须是整数。"}}},{"id": "defaultsearchmodel-is_show", "name": "DefaultSearchModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "defaultsearchmodel-sort", "name": "DefaultSearchModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "defaultsearchmodel-search_keywords", "name": "DefaultSearchModel[search_keywords]", "attribute": "search_keywords", "rules": {"required":true,"messages":{"required":"搜索关键词不能为空。"}}},{"id": "defaultsearchmodel-type_id", "name": "DefaultSearchModel[type_id]", "attribute": "type_id", "rules": {"required":true,"messages":{"required":"商品分类不能为空。"}}},{"id": "defaultsearchmodel-search_keywords", "name": "DefaultSearchModel[search_keywords]", "attribute": "search_keywords", "rules": {"string":true,"messages":{"string":"搜索关键词必须是一条字符串。","maxlength":"搜索关键词只能包含至多255个字符。"},"maxlength":255}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#DefaultSearchModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {

                if (!validator.form()) {
                    return;
                }

                var data = $("#DefaultSearchModel").serializeJson();
                var url = $("#DefaultSearchModel").attr("action");
                //加载提示
                $.loading.start();
                $.post(url, data, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.go('/mall/search/default-search');
                        $.msg(result.message);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });
            $('.deduct').hide();
            if('{{ $info->search_type ?? 0 }}' > 0){
                $('.deduct').show();
            }

            //$('#defaultsearchmodel-type_id').find("option:selected").val(0);

            $("input:radio").click(function() {
                if ($(this).val() == 0) {
                    if($('#defaultsearchmodel-type_id').find("option:selected").val()==''){
                        $('#defaultsearchmodel-type_id').find("option:selected").val(0);
                    }
                    $('.deduct').hide();
                } else {
                    if($('#defaultsearchmodel-type_id').find("option:selected").val()==0){
                        $('#defaultsearchmodel-type_id').find("option:selected").val('');
                    }
                    $('.deduct').show();
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop