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
        <form id="CollectModel" class="form-horizontal" name="CollectModel" action="/shop/collect/edit?id={{ $info->shop_id }}" method="post" novalidate="novalidate">
            @csrf

            <!-- 采集店铺 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-shop_id" class="col-sm-4 control-label">

                        <span class="ng-binding">采集店铺：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label">{{ $info->shop_name }}</label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 采集商品数量 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-collect_allow_number" class="col-sm-4 control-label">

                        <span class="ng-binding">允许采集商品数量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label">{{ $info->collect_allow_number }}</label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺最多采集云产品库的商品数量</div></div>
                    </div>
                </div>
            </div>

            <!-- 调整采集商品数量 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">调整采集商品数量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select class="form-control m-r-5 change_type" name="CollectModel[change_type]">
                                <option value="0">增加</option>
                                <option value="1">减少</option>
                                <option value="2">覆盖</option>
                            </select>
                            <input type="text" id="collectmodel-change_number" class="form-control ipt" name="CollectModel[change_number]" value="0">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 已采集数量 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-collected_number" class="col-sm-4 control-label">

                        <span class="ng-binding">已采集商品数量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label">{{ $info->collected_number }}</label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>


            <!-- 采集评论次数 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-comment_allow_number" class="col-sm-4 control-label">

                        <span class="ng-binding">允许采集评论次数：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label">{{ $info->comment_allow_number }}</label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">店铺最多采集云产品库的评论次数</div></div>
                    </div>
                </div>
            </div>

            <!-- 调整采集评论次数 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">调整采集评论次数：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select class="form-control m-r-5 change_type" name="CollectModel[change_comment_type]">
                                <option value="0">增加</option>
                                <option value="1">减少</option>
                                <option value="2">覆盖</option>
                            </select>
                            <input type="text" id="collectmodel-change_comment_number" class="form-control ipt" name="CollectModel[change_comment_number]" value="0">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 已采集评论次数 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="collectmodel-comment_number" class="col-sm-4 control-label">

                        <span class="ng-binding">已采集评论次数：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label">{{ $info->comment_number }}</label>


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
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "collectmodel-change_number", "name": "CollectModel[change_number]", "attribute": "change_number", "rules": {"required":true,"messages":{"required":"调整采集商品数量不能为空。"}}},{"id": "collectmodel-change_type", "name": "CollectModel[change_type]", "attribute": "change_type", "rules": {"required":true,"messages":{"required":"Change Type不能为空。"}}},{"id": "collectmodel-change_comment_number", "name": "CollectModel[change_comment_number]", "attribute": "change_comment_number", "rules": {"required":true,"messages":{"required":"调整采集评论次数不能为空。"}}},{"id": "collectmodel-change_comment_type", "name": "CollectModel[change_comment_type]", "attribute": "change_comment_type", "rules": {"required":true,"messages":{"required":"Change Comment Type不能为空。"}}},{"id": "collectmodel-change_number", "name": "CollectModel[change_number]", "attribute": "change_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"调整采集商品数量必须是整数。","min":"调整采集商品数量必须不小于0。"},"min":0}},{"id": "collectmodel-change_comment_number", "name": "CollectModel[change_comment_number]", "attribute": "change_comment_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"调整采集评论次数必须是整数。","min":"调整采集评论次数必须不小于0。"},"min":0}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#CollectModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                $('input[name="CollectModel[shop_id]"]').val($(".search-choice").val());
                validator.form();
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#CollectModel").submit();
            });
        });
    </script>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop