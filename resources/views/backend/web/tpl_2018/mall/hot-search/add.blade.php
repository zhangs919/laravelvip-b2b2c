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
        <form id="HotSearchModel" class="form-horizontal" name="HotSearchModel" action="/mall/hot-search/add" method="post">
            @csrf
            <input type="hidden" id="hotsearchmodel-id" class="form-control" name="HotSearchModel[id]" value="{{ $info->id ?? ''}}">

            <!-- 搜索词是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="hotsearchmodel-keyword" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">搜索词：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="hotsearchmodel-keyword" class="form-control" name="HotSearchModel[keyword]" value="{{ $info->keyword ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">搜索词参与搜索，例如：女装</div></div>
                    </div>
                </div>
            </div>
            <!-- 显示词是否显示-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="hotsearchmodel-show_words" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">显示词：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="hotsearchmodel-show_words" class="form-control" name="HotSearchModel[show_words]" value="{{ $info->show_words ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">显示词不参与搜索，只起显示作用，例如：元旦,女装5折狂甩</div></div>
                    </div>
                </div>
            </div>
            <!-- 是否推荐 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="hotsearchmodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否热门搜索：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="HotSearchModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="hotsearchmodel-is_show" class="form-control b-n"
                                                   name="HotSearchModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="hotsearchmodel-is_show" class="form-control b-n"
                                                   name="HotSearchModel[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启热门搜索，此搜索词将在前台搜索框弹出框中显示</div></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="hotsearchmodel-sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="hotsearchmodel-sort" class="form-control small" name="HotSearchModel[sort]" value="{{ $info->sort ?? 255 }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">控制热门搜索中显示的搜索词顺序，数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 审核是否通过 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="submit" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交" />

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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180726"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180726"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "hotsearchmodel-site_id", "name": "HotSearchModel[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点编号必须是整数。"}}},{"id": "hotsearchmodel-is_show", "name": "HotSearchModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否热门搜索必须是整数。"}}},{"id": "hotsearchmodel-sort", "name": "HotSearchModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "hotsearchmodel-show_words", "name": "HotSearchModel[show_words]", "attribute": "show_words", "rules": {"required":true,"messages":{"required":"显示词不能为空。"}}},{"id": "hotsearchmodel-keyword", "name": "HotSearchModel[keyword]", "attribute": "keyword", "rules": {"required":true,"messages":{"required":"搜索词不能为空。"}}},{"id": "hotsearchmodel-sort", "name": "HotSearchModel[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "hotsearchmodel-keyword", "name": "HotSearchModel[keyword]", "attribute": "keyword", "rules": {"string":true,"messages":{"string":"搜索词必须是一条字符串。","maxlength":"搜索词只能包含至多8个字符。"},"maxlength":8}},{"id": "hotsearchmodel-show_words", "name": "HotSearchModel[show_words]", "attribute": "show_words", "rules": {"string":true,"messages":{"string":"显示词必须是一条字符串。","minlength":"显示词应该包含至少1个字符。","maxlength":"显示词只能包含至多15个字符。"},"minlength":1,"maxlength":15}},{"id": "hotsearchmodel-show_words", "name": "HotSearchModel[show_words]", "attribute": "show_words", "rules": {"match":{"pattern":/^[\u4e00-\u9fa5a-zA-Z0-9\,]+$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入英文半角字符"}}},{"id": "hotsearchmodel-sort", "name": "HotSearchModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#HotSearchModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#HotSearchModel").submit();

            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop