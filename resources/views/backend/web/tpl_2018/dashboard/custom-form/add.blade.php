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

    <div class="table-content m-t-30 clearfix">
        <form id="Form" class="form-horizontal" name="Form" action="/dashboard/custom-form/add" method="post" target="_blank" enctype="multipart/form-data">
            @csrf
            {{--隐藏域--}}
            <input type="hidden" id="form-form_id" class="form-control" name="Form[form_id]" value="{{ $info->form_id ?? '' }}">

            <!-- 表单标题 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="form-form_title" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">表单标题：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="text" id="form-form_title" class="form-control" name="Form[form_title]" value="{{ $info->form_title ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入30个字</div></div>
                    </div>
                </div>
            </div>

            <!-- 表单有效期 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="form-form_title" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">有效期：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            @if(isset($info->form_id))
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="valid_time" class="szy-valid-time valid" @if($info->start_time == 0 && $info->end_time == 0)checked="checked"@endif>
                                    无限期
                                </label>
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="valid_time" class="szy-valid-time valid" @if($info->start_time > 0 || $info->end_time > 0)checked="checked"@endif>
                                    指定时间
                                </label>
                                <input class="form-control w100 form_datetime valid" type="text" id="szy-start-time" value="@if($info->start_time == 0){{ '' }}@else{{ $info->start_time }}@endif">
                                <span class="ctime">至</span>
                                <input class="form-control w100 form_datetime" type="text" id="szy-end-time" value="@if($info->end_time == 0){{ '' }}@else{{ $info->end_time }}@endif">

                                <input type="hidden" id="start-time" class="form-control" name="start_time" value="@if($info->start_time == 0){{ '-1' }}@else{{ $info->start_time }}@endif">

                                <input type="hidden" id="end-time" class="form-control" name="end_time" value="@if($info->end_time == 0){{ '-1' }}@else{{ $info->end_time }}@endif">
                            @else
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="valid_time" class="szy-valid-time valid" checked="checked">
                                    无限期
                                </label>
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="valid_time" class="szy-valid-time valid" aria-invalid="false">
                                    指定时间
                                </label>
                                <input class="form-control w100 form_datetime valid" autocomplete="off" type="text" id="szy-start-time">
                                ~
                                <input class="form-control w100 form_datetime" autocomplete="off" type="text" id="szy-end-time">

                                <input type="hidden" id="start-time" class="form-control" name="start_time" value="-1">

                                <input type="hidden" id="end-time" class="form-control" name="end_time" value="-1">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- 参与者是否需要登录 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="form-need_login" class="col-sm-4 control-label">

                        <span class="ng-binding">是否需要登录：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="Form[need_login]" value="0">
                                    @if(isset($info->form_id))
                                        <label><input type="checkbox" id="form-need_login" class="form-control b-n" name="Form[need_login]" value="1" @if($info->need_login == 1){{ 'checked' }}@endif data-on-text="是" data-off-text="否"> </label>
                                    @else
                                        <label><input type="checkbox" id="form-need_login" class="form-control b-n" name="Form[need_login]" value="1" checked data-on-text="是" data-off-text="否"> </label>
                                    @endif
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 允许用户提交表单的次数 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="form-commit_mode" class="col-sm-4 control-label">

                        <span class="ng-binding">允许用户提交次数：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="hidden" name="Form[commit_mode]" value="0">
                            <div id="form-commit_mode" class="" name="Form[commit_mode]">
                                @if(isset($info->form_id))
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Form[commit_mode]" value="0" @if($info->commit_mode == 0){{ 'checked' }}@endif> 只允许提交一次</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Form[commit_mode]" value="1" @if($info->commit_mode == 1){{ 'checked' }}@endif> 可参与多次（取最后一次为结果）</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Form[commit_mode]" value="2" @if($info->commit_mode == 2){{ 'checked' }}@endif> 可参与多次（每天最多可以投10次，投票结果可以累加）</label>
                                @else
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Form[commit_mode]" value="0" checked> 只允许提交一次</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Form[commit_mode]" value="1"> 可参与多次（取最后一次为结果）</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="Form[commit_mode]" value="2"> 可参与多次（每天最多可以投10次，投票结果可以累加）</label>
                                @endif

                            </div>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 关键字 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="form-form_keyword" class="col-sm-4 control-label">

                        <span class="ng-binding">关键词：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="text" id="form-form_keyword" class="form-control" name="Form[form_keyword]" value="{{ $info->form_keyword ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入50个字，请用英文半角逗号分隔，主要用于SEO推广优化</div></div>
                    </div>
                </div>
            </div>
            <!-- 头部样式-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="form-header_style" class="col-sm-4 control-label">

                        <span class="ng-binding">去除头部（PC端）：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="hidden" name="Form[header_style]" value="">
                            <div id="form-header_style" class="extend_condition" name="Form[header_style]" selection='[""]'>
                                @if(isset($info->form_id))
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[header_style][]" value="1" @if(in_array(1, $info->header_style)){{ 'checked' }}@endif> 商城顶部导航</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[header_style][]" value="2" @if(in_array(2, $info->header_style)){{ 'checked' }}@endif> 头部信息</label>
                                <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[header_style][]" value="3" @if(in_array(3, $info->header_style)){{ 'checked' }}@endif> 商城主导航</label>
                                @else
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[header_style][]" value="1"> 商城顶部导航</label>
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[header_style][]" value="2"> 头部信息</label>
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[header_style][]" value="3"> 商城主导航</label>
                                @endif
                            </div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">商城顶部导航指商城最顶部导航栏；头部信息指商城logo、搜索框、搜索框左右广告图</div></div>
                    </div>
                </div>
            </div>
            <!-- 底部样式-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="form-bottom_style" class="col-sm-4 control-label">

                        <span class="ng-binding">去除底部（PC端）：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="hidden" name="Form[bottom_style]" value="">
                            <div id="form-bottom_style" class="extend_condition" name="Form[bottom_style]" selection='[""]'>
                                @if(isset($info->form_id))
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[bottom_style][]" value="1" @if(in_array(1, $info->bottom_style)){{ 'checked' }}@endif> 底部广告</label>
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[bottom_style][]" value="2" @if(in_array(2, $info->bottom_style)){{ 'checked' }}@endif> 友情链接</label>
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[bottom_style][]" value="3" @if(in_array(3, $info->bottom_style)){{ 'checked' }}@endif> 帮助中心</label>
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[bottom_style][]" value="4" @if(in_array(4, $info->bottom_style)){{ 'checked' }}@endif> 底部信息</label>
                                @else
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[bottom_style][]" value="1"> 底部广告</label>
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[bottom_style][]" value="2"> 友情链接</label>
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[bottom_style][]" value="3"> 帮助中心</label>
                                    <label class="control-label cur-p m-r-10"><input type="checkbox" name="Form[bottom_style][]" value="4"> 底部信息</label>
                                @endif
                            </div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">底部广告指帮助文章上方的广告图；帮助中心指商城底部的帮助文章；底部信息指帮助文章下方的所有内容</div></div>
                    </div>
                </div>
            </div>

            <!-- 描述 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="form-form_desc" class="col-sm-4 control-label">

                        <span class="ng-binding">描述：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <textarea id="form-form_desc" class="form-control" name="Form[form_desc]" rows="5">{!! $info->form_desc ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">最多输入100个字，请用英文半角逗号分隔，主要用于SEO推广优化</div></div>
                    </div>
                </div>
            </div>

            <!-- 分享推广图 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="form-share_image" class="col-sm-4 control-label">

                        <span class="ng-binding">分享推广图：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <div id="imagegroup_container" class="szy-imagegroup" data-size="1"></div>
                            <input type="hidden" id="form-share_image" class="form-control" name="Form[share_image]" value="{{ $info->share_image ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">此推广图应用于分享功能处显示，建议上传正方形图片，最佳显示尺寸为80*80像素</div></div>
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
        </form>	</div>

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
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190221"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190221"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190221"></script>
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190221"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190221"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190221"></script>
    <!-- 日期picker -->
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20190221"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190221"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
    [{"id": "form-shop_id", "name": "Form[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"所属店铺编号必须是整数。"}}},{"id": "form-site_id", "name": "Form[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"所属站点编号必须是整数。"}}},{"id": "form-user_id", "name": "Form[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户ID必须是整数。"}}},{"id": "form-fb_num", "name": "Form[fb_num]", "attribute": "fb_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"反馈数必须是整数。"}}},{"id": "form-add_time", "name": "Form[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "form-update_time", "name": "Form[update_time]", "attribute": "update_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"更新时间必须是整数。"}}},{"id": "form-is_publish", "name": "Form[is_publish]", "attribute": "is_publish", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否发布必须是整数。"}}},{"id": "form-need_login", "name": "Form[need_login]", "attribute": "need_login", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否需要登录必须是整数。"}}},{"id": "form-commit_mode", "name": "Form[commit_mode]", "attribute": "commit_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"允许用户提交次数必须是整数。"}}},{"id": "form-start_time", "name": "Form[start_time]", "attribute": "start_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"表单有效期开始时间必须是整数。"}}},{"id": "form-end_time", "name": "Form[end_time]", "attribute": "end_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"表单有效期结束时间必须是整数。"}}},{"id": "form-site_id", "name": "Form[site_id]", "attribute": "site_id", "rules": {"required":true,"messages":{"required":"所属站点编号不能为空。"}}},{"id": "form-form_title", "name": "Form[form_title]", "attribute": "form_title", "rules": {"required":true,"messages":{"required":"表单标题不能为空。"}}},{"id": "form-form_data", "name": "Form[form_data]", "attribute": "form_data", "rules": {"string":true,"messages":{"string":"表单设计数据必须是一条字符串。"}}},{"id": "form-form_title", "name": "Form[form_title]", "attribute": "form_title", "rules": {"string":true,"messages":{"string":"表单标题必须是一条字符串。","maxlength":"表单标题只能包含至多30个字符。"},"maxlength":30}},{"id": "form-header_style", "name": "Form[header_style]", "attribute": "header_style", "rules": {"string":true,"messages":{"string":"去除头部（PC端）必须是一条字符串。","maxlength":"去除头部（PC端）只能包含至多30个字符。"},"maxlength":30}},{"id": "form-bottom_style", "name": "Form[bottom_style]", "attribute": "bottom_style", "rules": {"string":true,"messages":{"string":"去除底部（PC端）必须是一条字符串。","maxlength":"去除底部（PC端）只能包含至多30个字符。"},"maxlength":30}},{"id": "form-form_keyword", "name": "Form[form_keyword]", "attribute": "form_keyword", "rules": {"string":true,"messages":{"string":"关键词必须是一条字符串。","maxlength":"关键词只能包含至多50个字符。"},"maxlength":50}},{"id": "form-form_desc", "name": "Form[form_desc]", "attribute": "form_desc", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多100个字符。"},"maxlength":100}},{"id": "form-share_image", "name": "Form[share_image]", "attribute": "share_image", "rules": {"string":true,"messages":{"string":"分享推广图必须是一条字符串。","maxlength":"分享推广图只能包含至多200个字符。"},"maxlength":200}},{"id": "form-commit_mode", "name": "Form[commit_mode]", "attribute": "commit_mode", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"允许用户提交次数是无效的。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var form_name = '#Form';
            var o_form = $(form_name);
            var validator = o_form.validate();

            // 隐藏的有效期
            var $startTime = $('#start-time');
            var $endTime = $('#end-time');

            // 指定时间
            var $szyStartTime = $('#szy-start-time');
            var $szyEndTime = $('#szy-end-time');

            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            /**
             * 日期控件初始化
             */
            $('.form_datetime').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2, // 精确度：默认为时分秒，2：年月日
                forceParse: 1,
                showMeridian: 1,
                format: 'yyyy-mm-dd',
            });

            /**
             * 当点击表单自定义日期的时候，切换按钮要切换到指定时间按钮上
             */
            var $validTime = $('.szy-valid-time');
            $('.form_datetime').click(function() {
                // 指定时间被选中
                $validTime.eq(1).prop('checked', true);
            });

            // 校验有效期
            function checkValidTime(startTime, endTime) {
                if ('' == startTime) {
                    $.msg('请选择表单有效期起始时间');
                    return false;
                }
                if ('' == endTime) {
                    $.msg('请选择表单有效期截止时间');
                    return false;
                }
                return true;
            }

            // 选择指定时间 && 提交的时候，设置开始时间和结束时间
            // 提交的时候将指定的值 赋值到隐藏区域内
            function setTimes() {
                var index = $validTime.filter(':checked').index('.szy-valid-time');
                var startTime = '';
                var endTime = '';
                if (0 == index) {
                    startTime = -1;
                    endTime = -1;
                } else {
                    // 校验指定时间
                    var szyStartTime = $.trim($szyStartTime.val());
                    var szyEndTime = $.trim($szyEndTime.val());
                    var res = checkValidTime(szyStartTime, szyEndTime);
                    if (!res) {
                        return false;
                    }
                    // 赋值
                    startTime = szyStartTime;
                    endTime = szyEndTime;
                }
                // 校验
                $startTime.val(startTime);
                $endTime.val(endTime);

                return true;
            }

            /**
             * 表单提交
             */
            $("#btn_submit").click(function() {
                // 设置指定时间
                var isValid = setTimes();
                if (!isValid) {
                    return false;
                }
                if (!validator.form()) {
                    return false;
                }
                //加载提示
                $.loading.start();
                        @if(!isset($info->form_id))
                var newWindow = window.open('');
                newWindow.document.write('正在加载中...');

                var data = o_form.serialize();
                $.post('/dashboard/custom-form/add.html', data, function(res) {
                    if (res.code == 0) {
                        $.msg(res.message, {
                            time: 1500
                        }, function() {
                            var form_id = res.data;
                            newWindow.location.href = '/dashboard/custom-form/template.html?form_id=' + form_id;
                            $.go('list.html');
                        });
                    } else {
                        // 关闭窗口
                        // 如果添加表单的时候报错，需要关闭打开的新窗口
                        if (newWindow) {
                            newWindow.close();
                        }
                        $.alert(res.message);
                    }
                }, 'JSON');
                        @else
                var data = o_form.serialize();
                $.post('edit-form.html?form_id={{ $info->form_id }}', data, function(res) {
                    if (res.code == 0) {
                        $.msg(res.message, {
                            time: 1500
                        }, function() {
                            var form_id = res.data;
                            $.go('list.html');
                        });
                    } else {
                        $.alert(res.message);
                    }
                }, 'JSON');
                @endif

                    return false;
            });

            // 当前模型的名称
            var model_name = 'form';
            var o_model_img = $('#' + model_name + '-share_image')
            $("#imagegroup_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: $(this).data("size"),
                values: o_model_img.val().split("|"),
                gallery: true,
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    o_model_img.val(values);
                    $.validator.clearError(o_model_img);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    o_model_img.val(values);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop