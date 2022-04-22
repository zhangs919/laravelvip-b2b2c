{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180027"></script>
@stop

{{--content--}}
@section('content')

    <form id="ShopRankModel" class="form-horizontal" name="ShopRankModel" action="/member/rank/add" method="post">
        {{ csrf_field() }}
        <div class="table-content m-t-30 clearfix">
            <!-- 等级ID -->
            <input type="hidden" id="shoprankmodel-rank_id" class="form-control" name="ShopRankModel[rank_id]" value="{{ $info->rank_id ?? '' }}">
            <!-- 店铺ID -->
            <input type="hidden" id="shoprankmodel-shop_id" class="form-control" name="ShopRankModel[shop_id]" value="{{ $shop_info->shop_id }}">
            <!-- 特殊会员等级 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoprankmodel-is_special" class="col-sm-4 control-label">

                        <span class="ng-binding">特殊会员等级：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            @if(!isset($info->rank_id))
                                <input type="hidden" name="ShopRankModel[is_special]" value="">
                                <div id="shoprankmodel-is_special" class="" name="ShopRankModel[is_special]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="ShopRankModel[is_special]" value="1"> 是</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="ShopRankModel[is_special]" value="0" checked> 否</label>
                                </div>
                            @else
                                <label class="control-label">否</label>
                                <input type="hidden" id="shoprankmodel-is_special" class="form-control" name="ShopRankModel[is_special]" value="0">
                            @endif

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 会员级别 -->

            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoprankmodel-rank_level" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">会员级别：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="shoprankmodel-rank_level" class="form-control" name="ShopRankModel[rank_level]">
                                <option value="">-- 请选择 --</option>
                                @foreach($rank_level_list as $v)
                                <option value="{{ $v }}" @if(@$info->rank_level == $v) selected @endif>{{ $v }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字越大等级越高，高会员级别的会员累计消费金额及累计成功交易次数要大于低会员级别</div></div>
                    </div>
                </div>
            </div>

            <!-- 会员等级名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoprankmodel-rank_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">等级名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label rank-name">{{ $info->rank_name ?? '' }}</label>
                            <input type="hidden" id="shoprankmodel-rank_name" class="form-control" name="ShopRankModel[rank_name]" value="{{ $info->rank_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">非特殊会员等级名称自动调取会员级别关联的等级名称，无法修改；特殊会员等级名称需自行添加</div></div>
                    </div>
                </div>
            </div>
            <!-- 会员折扣 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoprankmodel-discount" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">折扣：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="shoprankmodel-discount" class="form-control ipt m-r-10" name="ShopRankModel[discount]" value="{{ $info->discount ?? '' }}"> 折


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 交易总额 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoprankmodel-min_amount" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">会员等级条件：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label">累计消费金额</label>
                            <input type="text" id="shoprankmodel-min_amount" class="form-control ipt m-l-10 m-r-10" name="ShopRankModel[min_amount]" value="{{ $info->min_amount ?? 0 }}"> 元


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 交易次数 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shoprankmodel-min_times" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">或：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label">累计成功交易</label>
                            <input type="text" id="shoprankmodel-min_times" class="form-control ipt m-l-10 m-r-10" name="ShopRankModel[min_times]" value="{{ $info->min_times ?? 0 }}"> 笔


                        </div>

                        <div class="help-block help-block-t"></div>
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


{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    @if(!isset($info->rank_id))
        [{"id": "shoprankmodel-rank_name", "name": "ShopRankModel[rank_name]", "attribute": "rank_name", "rules": {"required":true,"messages":{"required":"等级名称不能为空。"}}},{"id": "shoprankmodel-rank_level", "name": "ShopRankModel[rank_level]", "attribute": "rank_level", "rules": {"required":true,"messages":{"required":"会员级别不能为空。"}}},{"id": "shoprankmodel-min_amount", "name": "ShopRankModel[min_amount]", "attribute": "min_amount", "rules": {"required":true,"messages":{"required":"会员等级条件不能为空。"}}},{"id": "shoprankmodel-min_times", "name": "ShopRankModel[min_times]", "attribute": "min_times", "rules": {"required":true,"messages":{"required":"或不能为空。"}}},{"id": "shoprankmodel-shop_id", "name": "ShopRankModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"所属店铺ID必须是整数。"}}},{"id": "shoprankmodel-rank_level", "name": "ShopRankModel[rank_level]", "attribute": "rank_level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"会员级别必须是整数。"}}},{"id": "shoprankmodel-is_special", "name": "ShopRankModel[is_special]", "attribute": "is_special", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"特殊会员等级必须是整数。"}}},{"id": "shoprankmodel-expired_level", "name": "ShopRankModel[expired_level]", "attribute": "expired_level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"过期设置必须是整数。"}}},{"id": "shoprankmodel-min_amount", "name": "ShopRankModel[min_amount]", "attribute": "min_amount", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"会员等级条件必须是一个数字。","min":"会员等级条件必须不小于0。"},"min":0}},{"id": "shoprankmodel-min_times", "name": "ShopRankModel[min_times]", "attribute": "min_times", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"或必须是整数。","min":"或必须不小于0。"},"min":0}},{"id": "shoprankmodel-valid_days", "name": "ShopRankModel[valid_days]", "attribute": "valid_days", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"有效天数必须是整数。","min":"有效天数必须不小于0。"},"min":0}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-rank_name", "name": "ShopRankModel[rank_name]", "attribute": "rank_name", "rules": {"string":true,"messages":{"string":"等级名称必须是一条字符串。","maxlength":"等级名称只能包含至多60个字符。"},"maxlength":60}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"required":true,"messages":{"required":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"compare":{"operator":">=","type":"string","compareValue":1,"skipOnEmpty":1},"messages":{"compare":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"compare":{"operator":"<=","type":"string","compareValue":10,"skipOnEmpty":1},"messages":{"compare":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"match":{"pattern":/^[1-9][0-9]{0,1}(\.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-rank_name", "name": "ShopRankModel[rank_name]", "attribute": "rank_name", "rules": {"ajax":{"url":"/member/rank/client-validate","model":"YXBwXG1vZHVsZXNcbWVtYmVyXG1vZGVsc1xTaG9wUmFua01vZGVs","attribute":"rank_name","params":["ShopRankModel[shop_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @else
        [{"id": "shoprankmodel-rank_name", "name": "ShopRankModel[rank_name]", "attribute": "rank_name", "rules": {"required":true,"messages":{"required":"等级名称不能为空。"}}},{"id": "shoprankmodel-rank_level", "name": "ShopRankModel[rank_level]", "attribute": "rank_level", "rules": {"required":true,"messages":{"required":"会员级别不能为空。"}}},{"id": "shoprankmodel-min_amount", "name": "ShopRankModel[min_amount]", "attribute": "min_amount", "rules": {"required":true,"messages":{"required":"会员等级条件不能为空。"}}},{"id": "shoprankmodel-min_times", "name": "ShopRankModel[min_times]", "attribute": "min_times", "rules": {"required":true,"messages":{"required":"或不能为空。"}}},{"id": "shoprankmodel-shop_id", "name": "ShopRankModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"所属店铺ID必须是整数。"}}},{"id": "shoprankmodel-rank_level", "name": "ShopRankModel[rank_level]", "attribute": "rank_level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"会员级别必须是整数。"}}},{"id": "shoprankmodel-is_special", "name": "ShopRankModel[is_special]", "attribute": "is_special", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"特殊会员等级必须是整数。"}}},{"id": "shoprankmodel-expired_level", "name": "ShopRankModel[expired_level]", "attribute": "expired_level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"过期设置必须是整数。"}}},{"id": "shoprankmodel-min_amount", "name": "ShopRankModel[min_amount]", "attribute": "min_amount", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"会员等级条件必须是一个数字。","min":"会员等级条件必须不小于0。"},"min":0}},{"id": "shoprankmodel-min_times", "name": "ShopRankModel[min_times]", "attribute": "min_times", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"或必须是整数。","min":"或必须不小于0。"},"min":0}},{"id": "shoprankmodel-valid_days", "name": "ShopRankModel[valid_days]", "attribute": "valid_days", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"有效天数必须是整数。","min":"有效天数必须不小于0。"},"min":0}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-rank_name", "name": "ShopRankModel[rank_name]", "attribute": "rank_name", "rules": {"string":true,"messages":{"string":"等级名称必须是一条字符串。","maxlength":"等级名称只能包含至多60个字符。"},"maxlength":60}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"required":true,"messages":{"required":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"compare":{"operator":">=","type":"string","compareValue":1,"skipOnEmpty":1},"messages":{"compare":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"compare":{"operator":"<=","type":"string","compareValue":10,"skipOnEmpty":1},"messages":{"compare":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-discount", "name": "ShopRankModel[discount]", "attribute": "discount", "rules": {"match":{"pattern":/^[1-9][0-9]{0,1}(\.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"折扣率不能低于1，折扣范围为1~10之间，2位小数"}}},{"id": "shoprankmodel-rank_name", "name": "ShopRankModel[rank_name]", "attribute": "rank_name", "rules": {"ajax":{"url":"/member/rank/client-validate","model":"YXBwXG1vZHVsZXNcbWVtYmVyXG1vZGVsc1xTaG9wUmFua01vZGVs","attribute":"rank_name","params":["ShopRankModel[rank_id]","ShopRankModel[shop_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
    @endif
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ShopRankModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                // 加载提示
                $.loading.start();
                $("#ShopRankModel").submit();
            });

            // 改变会员级别
            $("#shoprankmodel-rank_level").change(function() {
                var level = $(this).val();
                $.ajax({
                    url: 'get-level-name',
                    dataType: 'json',
                    data: {
                        level: level
                    },
                    success: function(result) {
                        $(".rank-name").html(result.data);
                        $("#shoprankmodel-rank_name").val(result.data);
                    }
                });
            });

            $('input[name="ShopRankModel[is_special]"]').click(function() {
                $.go("add?is_special=" + $(this).val());
            });

            $('input[name="ShopRankModel[use_between]"]').click(function() {
                var val = $(this).val();
                if (val == 0) {
                    $("#div_expired_level").hide();
                } else {
                    $("#div_expired_level").show();
                }
            });

            // 初始化时间选择控件
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2, // 只选年月日
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd'
            });
            $('#shoprankmodel-start_time').datetimepicker().on('changeDate', function(ev) {
                $('#shoprankmodel-end_time').datetimepicker('setStartDate', ev.date);
            });
            $('#shoprankmodel-end_time').datetimepicker().on('changeDate', function(ev) {
                $('#shoprankmodel-start_time').datetimepicker('setEndDate', ev.date);
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop