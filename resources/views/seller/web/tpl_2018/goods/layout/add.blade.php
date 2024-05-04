{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="GoodsLayoutModel" class="form-horizontal" name="GoodsLayoutModel" action="/goods/layout/add" method="post">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="goodslayoutmodel-layout_id" class="form-control" name="GoodsLayoutModel[layout_id]" value="{{ $info->layout_id ?? '' }}">
            <!-- 版式名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="goodslayoutmodel-layout_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">版式名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="goodslayoutmodel-layout_name" class="form-control" name="GoodsLayoutModel[layout_name]" value="{{ $info->layout_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 模板位置 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="goodslayoutmodel-position" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">模板位置：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" name="GoodsLayoutModel[position]" value="0">
                            <div id="goodslayoutmodel-position" class="" name="GoodsLayoutModel[position]">
                                @if(isset($info->layout_id))
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsLayoutModel[position]" value="0" @if($info->position == 0) checked @endif> 详情顶部</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsLayoutModel[position]" value="1" @if($info->position == 1) checked @endif> 详情底部</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsLayoutModel[position]" value="2" @if($info->position == 2) checked @endif> 包装清单</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsLayoutModel[position]" value="3" @if($info->position == 3) checked @endif> 售后保障</label>
                                @else
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsLayoutModel[position]" value="0" checked> 详情顶部</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsLayoutModel[position]" value="1"> 详情底部</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsLayoutModel[position]" value="2"> 包装清单</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsLayoutModel[position]" value="3"> 售后保障</label>
                                @endif
                            </div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 模板内容 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="goodslayoutmodel-content" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">模板内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="content" class="form-control" name="GoodsLayoutModel[content]" rows="5">{!! $info->content ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"></div>
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

                            <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交" />

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
[{"id": "goodslayoutmodel-layout_name", "name": "GoodsLayoutModel[layout_name]", "attribute": "layout_name", "rules": {"required":true,"messages":{"required":"分类名称不能为空。"}}},{"id": "goodslayoutmodel-position", "name": "GoodsLayoutModel[position]", "attribute": "position", "rules": {"required":true,"messages":{"required":"模板位置不能为空。"}}},{"id": "goodslayoutmodel-content", "name": "GoodsLayoutModel[content]", "attribute": "content", "rules": {"required":true,"messages":{"required":"模板内容不能为空。"}}},{"id": "goodslayoutmodel-shop_id", "name": "GoodsLayoutModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "goodslayoutmodel-position", "name": "GoodsLayoutModel[position]", "attribute": "position", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"模板位置必须是整数。"}}},{"id": "goodslayoutmodel-position", "name": "GoodsLayoutModel[position]", "attribute": "position", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"模板位置是无效的。"}}},{"id": "goodslayoutmodel-content", "name": "GoodsLayoutModel[content]", "attribute": "content", "rules": {"string":true,"messages":{"string":"模板内容必须是一条字符串。"}}},{"id": "goodslayoutmodel-layout_name", "name": "GoodsLayoutModel[layout_name]", "attribute": "layout_name", "rules": {"string":true,"messages":{"string":"分类名称必须是一条字符串。","maxlength":"分类名称只能包含至多10个字符。"},"maxlength":10}},]
</script>
    <script type="text/javascript">
        //
    </script><script type="text/javascript">
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
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        KindEditor.ready(function(K) {
            var extraFileUploadParams = [];
            extraFileUploadParams['LARAVELVIP_COM_USER_PHPSESSID'] = 'gg23t4si8o3t171kpg82ft3tj5';
            window.editor = K.create('#content', {
                width: '100%',
                minWidth: '650',
                height: '450px',
                items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', '|', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                themesPath: "/assets/d2eace91/js/editor/themes/",
                cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
                uploadJson: "/site/upload-image.html",
                extraFileUploadParams: extraFileUploadParams,
                allowImageUpload: true,
                allowFlashUpload: false,
                allowMediaUpload: false,
                allowFileManager: true,
                syncType: "form",
                // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
                pasteType: 2,
                afterCreate: function() {
                    var self = this;
                    self.sync();
                },
                afterChange: function() {
                    var self = this;
                    self.sync();
                },
                afterBlur: function() {
                    var self = this;
                    self.sync();
                }
            });
        });
        //
        $().ready(function() {
            var validator = $("#GoodsLayoutModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                var data = $("#GoodsLayoutModel").serializeJson();
                //加载提示
                $.loading.start();
                var url = $("#GoodsLayoutModel").attr("action");
                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, function(){
                            $.go('/goods/layout/list');
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
