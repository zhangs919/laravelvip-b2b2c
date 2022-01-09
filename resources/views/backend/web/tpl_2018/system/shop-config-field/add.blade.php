@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=1.2">
@stop

@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="ConfigModel" class="form-horizontal" name="ConfigModel" action="" method="post" novalidate="novalidate">
        {{ csrf_field() }}

        @if(isset($info->id))
            <!-- 隐藏域 -->
                <input type="hidden" id="configmodel-id" class="form-control" name="ConfigModel[id]" value="{{ $info->id ?? '' }}">
        @endif

            {{--是否必须--}}
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-required" class="col-sm-4 control-label">

                        <span class="ng-binding">是否必须：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    @if(!isset($info->required))
                                        <input type="hidden" name="ConfigModel[required]" value="0">
                                        <label>
                                            <input type="checkbox"
                                                   id="configmodel-required"
                                                   class="form-control b-n"
                                                   name="ConfigModel[required]"
                                                   value="1" checked=""
                                                   data-on-text="是" data-off-text="否"></label>
                                    @else
                                        <input type="hidden" name="ConfigModel[required]" value="0">
                                        <label>
                                            <input type="checkbox"
                                                   id="configmodel-required"
                                                   class="form-control b-n"
                                                   name="ConfigModel[required]"
                                                   value="1" @if($info->required == 1)checked="" @endif
                                                   data-on-text="是" data-off-text="否"></label>
                                    @endif

                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是否必须</div></div>
                    </div>
                </div>
            </div>

        <!-- 配置分组 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-group" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">配置分组：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <select id="configmodel-group" name="ConfigModel[group]" class="form-control chosen-select" style="display: none;">

                                <option value="" selected="true">-- 请选择分组 --</option>
                                @foreach($configGroups as $vo)
                                    <option value="{{ $vo['name'] }}" @if(isset($info->id) && $info->group == $vo['name'])selected="true"@endif>{{ $vo['title'] }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 配置类型 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-type" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">配置类型：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <select id="configmodel-type" name="ConfigModel[type]" class="form-control chosen-select" style="display: none;">

                                <option value="" selected="true">-- 请选择类型 --</option>
                                @foreach($formItemTypes as $vo)
                                    <option value="{{ $vo['name'] }}" @if(isset($info->id) && $info->type == $vo['name'])selected="true"@endif>{{ $vo['title'] }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 配置标题 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-title" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">配置标题：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="configmodel-title" class="form-control" name="ConfigModel[title]" value="{{ $info->title ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入40个字</div></div>
                    </div>
                </div>
            </div>

            <!-- 配置code -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-code" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">配置code：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="configmodel-code" class="form-control" name="ConfigModel[code]" value="{{ $info->code ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入40个字</div></div>
                    </div>
                </div>
            </div>

            {{--页面导航 anchor--}}
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-anchor" class="col-sm-3 control-label">
                        <span class="ng-binding">页面导航 anchor：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="configmodel-anchor" class="form-control" name="ConfigModel[anchor]" value="{{ $info->anchor ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置助手 页面导航分组显示</div></div>
                    </div>
                </div>
            </div>

            <!-- 配置值 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-value" class="col-sm-3 control-label">

                        <span class="ng-binding">配置值：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <textarea id="configmodel-default_value" class="form-control" name="ConfigModel[default_value]" rows="5">{{ $info->default_value ?? ''}}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">该配置的具体内容</div></div>
                    </div>
                </div>
            </div>

            <!-- 配置项 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-options" class="col-sm-3 control-label">

                        <span class="ng-binding">配置项：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <textarea id="configmodel-options" class="form-control" name="ConfigModel[options]" rows="5">{{ $info->options ?? ''}}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于单选、多选、下拉、联动等类型</div></div>
                    </div>
                </div>
            </div>

            {{--配置项Label--}}
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-labels" class="col-sm-3 control-label">

                        <span class="ng-binding">配置项Label：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <textarea id="configmodel-labels" class="form-control" name="ConfigModel[labels]" rows="5">{{ $info->labels ?? ''}}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">用于图片组等类型，多个label以逗号分隔</div></div>
                    </div>
                </div>
            </div>

            <!-- 配置说明 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-tips" class="col-sm-3 control-label">

                        <span class="ng-binding">配置说明：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <textarea id="configmodel-tips" class="form-control" name="ConfigModel[tips]" rows="5">{{ $info->tips ?? ''}}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">该配置的具体说明</div></div>
                    </div>
                </div>
            </div>

            <!-- 是否启用 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否启用：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    @if(!isset($info->status))
                                    <input type="hidden" name="ConfigModel[status]" value="0">
                                        <label>
                                        <input type="checkbox"
                                               id="configmodel-status"
                                               class="form-control b-n"
                                               name="ConfigModel[status]"
                                               value="1" checked=""
                                               data-on-text="是" data-off-text="否"></label>
                                    @else
                                        <input type="hidden" name="ConfigModel[status]" value="0">
                                        <label>
                                            <input type="checkbox"
                                                   id="configmodel-status"
                                                   class="form-control b-n"
                                                   name="ConfigModel[status]"
                                                   value="1" @if($info->status == 1)checked="" @endif
                                                   data-on-text="是" data-off-text="否"></label>
                                    @endif

                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是否启用该配置</div></div>
                    </div>
                </div>
            </div>

            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="configmodel-sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="configmodel-sort" class="form-control small" name="ConfigModel[sort]" value="{{ $info->sort ?? '255'}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围0~9999，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="bottom-btn p-b-30">
                <button id="btn_submit" class="btn btn-primary btn-lg">确认提交</button>
            </div>
        </form>
    </div>

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>

    <script id="client_rules" type="text">
    [{"id": "configmodel-group", "name": "ConfigModel[group]", "attribute": "group", "rules": {"required":true,"messages":{"required":"配置分组不能为空。"}}},{"id": "configmodel-type", "name": "ConfigModel[type]", "attribute": "type", "rules": {"required":true,"messages":{"required":"配置类型不能为空。"}}},{"id": "configmodel-title", "name": "ConfigModel[title]", "attribute": "title", "rules": {"required":true,"messages":{"required":"配置标题不能为空。"}}},{"id": "configmodel-code", "name": "ConfigModel[code]", "attribute": "code", "rules": {"required":true,"messages":{"required":"配置code不能为空。"}}},{"id": "configmodel-sort", "name": "ConfigModel[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "configmodel-id", "name": "ConfigModel[id]", "attribute": "id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"配置ID必须是整数。"}}},{"id": "configmodel-status", "name": "ConfigModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"配置状态必须是整数。"}}},{"id": "configmodel-title", "name": "ConfigModel[title]", "attribute": "title", "rules": {"string":true,"messages":{"string":"配置标题必须是一条字符串。","maxlength":"配置标题只能包含至多40个字符。"},"maxlength":40}},{"id": "configmodel-code", "name": "ConfigModel[code]", "attribute": "code", "rules": {"string":true,"messages":{"string":"配置code必须是一条字符串。","maxlength":"配置code只能包含至多40个字符。"},"maxlength":40}},{"id": "configmodel-sort", "name": "ConfigModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于9999。"},"min":0,"max":9999}},]
    </script>

@stop

@section('footer_script')
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
            var validator = $("#ConfigModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#ConfigModel").submit();

            });

        });
    </script>
@stop