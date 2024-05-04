{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181217"/>
    <script src="/assets/d2eace91/js/datetime/dateselector.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30">
        <form id="form" class="form-horizontal" action="/system/subsite/add" method="post">
            @csrf

            <input type="hidden" id="sitemodel-site_id" class="form-control" name="SiteModel[site_id]" value="{{ $info->site_id ?? '' }}">
            <!-- 站点名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">站点名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <!-- 北京快乐峰 -->
                            <input type="text" id="sitemodel-site_name" class="form-control" name="SiteModel[site_name]" value="{{ $info->site_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">显示在商城前台，不能随意更改</div></div>
                    </div>
                </div>
            </div>

            <!-- 站点地区 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-region_code" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">站点地区：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="region_container"></div>
                            <input type="hidden" id="region_code" name="SiteModel[region_code]">
                            <!--<label class="control-label">北京-北京市</label>-->


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">站点所在地区</div></div>
                    </div>
                </div>
            </div>

            <!--站点域名-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_domain" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">站点域名：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-site_domain" class="form-control" name="SiteModel[site_domain]" value="{{ $info->site_domain ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!--站点管理员-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_admin" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">站点管理员：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="sitemodel-site_admin" name="SiteModel[site_admin]" class="chosen-select" style="display: none;">

                                <option value="">-- 请选择 --</option>
                                <option value="1">bj_admin</option>
                                <option value="2">tj_admin</option>


                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!--站点费用-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_expenses" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">站点费用：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-site_expenses" class="form-control" name="SiteModel[site_expenses]" value="{{ $info->site_expenses ?? '' }}">


                        </div>

                        <div class="help-block help-block-t">站点每年需向平台方缴纳的固定费用，0表示无需缴纳费用。请与站长协商后，再修改此费用，站点续费将以此金额为准。</div>
                    </div>
                </div>
            </div>

            <!--结算周期-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-clearing_cycle" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">结算周期：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="sitemodel-clearing_cycle" name="SiteModel[clearing_cycle]" class="chosen-select" style="display: none;">

                                <option value="">-- 请选择 --</option>
                                @if(isset($info->clearing_cycle))
                                <option value="0" @if($info->clearing_cycle == 0)selected="selected"@endif>1个月</option>
                                <option value="1" @if($info->clearing_cycle == 1)selected="selected"@endif>1周</option>
                                <option value="2" @if($info->clearing_cycle == 2)selected="selected"@endif>1天</option>
                                <option value="3" @if($info->clearing_cycle == 3)selected="selected"@endif>3天</option>
                                @else
                                    <option value="0">1个月</option>
                                    <option value="1">1周</option>
                                    <option value="2">1天</option>
                                    <option value="3">3天</option>
                                @endif

                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!--到期时间-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-end_time" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">到期时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-end_time" class="form-control form_datetime middle pull-none" name="SiteModel[end_time]" value="{{ $info->end_time ?? '' }}">
                            <label class="control-label cur-p m-l-10 m-r-10">
                                <input type="checkbox" name="SiteModel[forever]" value="1" @if(isset($info->end_time) && $info->end_time > 0)checked=""@endif>
                                永久
                            </label>

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t"></div></div>
                    </div>
                </div>
            </div>

            <!--佣金比例-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-take_rate" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">佣金比例：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-take_rate" class="form-control middle" name="SiteModel[take_rate]" value="{{ $info->take_rate ?? '' }}">
                            <span data-type="text" class="m-l-10">%</span>

                        </div>

                        <div class="help-block help-block-t">平台从店铺抽取佣金后，站点可以按照此比例分得部分佣金。</div>
                    </div>
                </div>
            </div>

            <!-- 站点Logo -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_logo" class="col-sm-4 control-label">

                        <span class="ng-binding">站点Logo：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="site_logo_container"></div>
                            <input type="hidden" id="site_logo" class="form-control" name="SiteModel[site_logo]" value="{{ $info->site_logo ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置后站点的商城前台将显示此Logo，不设置将显示商城Logo，建议上传图片尺寸为240*80像素</div></div>
                    </div>
                </div>
            </div>

            <!-- 站点客服服务电话 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_phone" class="col-sm-4 control-label">

                        <span class="ng-binding">站点客服服务电话：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-site_phone" class="form-control" name="SiteModel[site_phone]" value="{{ $info->site_phone ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">在商城首页和卖家中心欢迎页展示，用于消费者和卖家联系站点</div></div>
                    </div>
                </div>
            </div>

            <!-- 站点邮箱 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_email" class="col-sm-4 control-label">

                        <span class="ng-binding">站点邮箱：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-site_email" class="form-control" name="SiteModel[site_email]" value="{{ $info->site_email ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">在商城首页和卖家中心欢迎页展示，用于消费者和卖家联系站点</div></div>
                    </div>
                </div>
            </div>

            <!-- QQ客服 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_qq" class="col-sm-4 control-label">

                        <span class="ng-binding">QQ客服：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-site_qq" class="form-control" name="SiteModel[site_qq]" value="{{ $info->site_qq ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">在卖家中心欢迎页展示，供卖家联系站点</div></div>
                    </div>
                </div>
            </div>

            <!-- 旺旺客服 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_wangwang" class="col-sm-4 control-label">

                        <span class="ng-binding">旺旺客服：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-site_wangwang" class="form-control" name="SiteModel[site_wangwang]" value="{{ $info->site_wangwang ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">在卖家中心欢迎页展示，供卖家联系站点</div></div>
                    </div>
                </div>
            </div>

            <!-- 站点联系人 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="sitemodel-site_manager" class="col-sm-4 control-label">

                        <span class="ng-binding">站点负责人：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-site_manager" class="form-control" name="SiteModel[site_manager]" value="{{ $info->site_manager ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!--是否启用站点-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="sitemodel-site_status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否启用站点：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SiteModel[site_status]" value="0">
                                    <label>
                                        @if(isset($info->site_status))
                                            <input type="checkbox" id="sitemodel-site_status" class="form-control b-n" name="SiteModel[site_status]" value="1" @if($info->site_status)checked=""@endif data-on-text="是" data-off-text="否">
                                        @else
                                            <input type="checkbox" id="sitemodel-site_status" class="form-control b-n" name="SiteModel[site_status]" value="1" checked="" data-on-text="是" data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!--关闭原因-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="sitemodel-close_reason" class="col-sm-4 control-label">
                        <span class="ng-binding">关闭原因：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <textarea id="sitemodel-close_reason" class="form-control valid" name="SiteModel[close_reason]" rows="5">{!! $info->close_reason ?? '' !!}</textarea>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 站点排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="sitemodel-site_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">站点排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="sitemodel-site_sort" class="form-control small" name="SiteModel[site_sort]" value="{{ $info->site_sort ?? '255' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>

            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
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
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
    <script id="clientRules" type="text">
[{"id": "sitemodel-site_name", "name": "SiteModel[site_name]", "attribute": "site_name", "rules": {"required":true,"messages":{"required":"站点名称不能为空。"}}},{"id": "sitemodel-region_code", "name": "SiteModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"站点地区不能为空。"}}},{"id": "sitemodel-clearing_cycle", "name": "SiteModel[clearing_cycle]", "attribute": "clearing_cycle", "rules": {"required":true,"messages":{"required":"结算周期不能为空。"}}},{"id": "sitemodel-site_admin", "name": "SiteModel[site_admin]", "attribute": "site_admin", "rules": {"required":true,"messages":{"required":"站点管理员不能为空。"}}},{"id": "sitemodel-site_domain", "name": "SiteModel[site_domain]", "attribute": "site_domain", "rules": {"required":true,"messages":{"required":"站点域名不能为空。"}}},{"id": "sitemodel-end_time", "name": "SiteModel[end_time]", "attribute": "end_time", "rules": {"required":true,"messages":{"required":"到期时间不能为空。"}}},{"id": "sitemodel-site_expenses", "name": "SiteModel[site_expenses]", "attribute": "site_expenses", "rules": {"required":true,"messages":{"required":"站点费用不能为空。"}}},{"id": "sitemodel-take_rate", "name": "SiteModel[take_rate]", "attribute": "take_rate", "rules": {"required":true,"messages":{"required":"佣金比例不能为空。"}}},{"id": "sitemodel-site_admin", "name": "SiteModel[site_admin]", "attribute": "site_admin", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点管理员必须是整数。","min":"站点管理员必须不小于0。"},"min":0}},{"id": "sitemodel-site_expenses", "name": "SiteModel[site_expenses]", "attribute": "site_expenses", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点费用必须是整数。","min":"站点费用必须不小于0。"},"min":0}},{"id": "sitemodel-add_time", "name": "SiteModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。","min":"创建时间必须不小于0。"},"min":0}},{"id": "sitemodel-site_expenses", "name": "SiteModel[site_expenses]", "attribute": "site_expenses", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点费用必须是整数。","min":"站点费用必须不小于0。"},"min":0}},{"id": "sitemodel-site_sort", "name": "SiteModel[site_sort]", "attribute": "site_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"站点排序必须是整数。","min":"站点排序必须不小于0。"},"min":0}},{"id": "sitemodel-site_status", "name": "SiteModel[site_status]", "attribute": "site_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用站点必须是整数。","min":"是否启用站点必须不小于0。"},"min":0}},{"id": "sitemodel-site_qq", "name": "SiteModel[site_qq]", "attribute": "site_qq", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"QQ客服必须是一个数字。","min":"QQ客服必须不小于0。"},"min":0}},{"id": "sitemodel-take_rate", "name": "SiteModel[take_rate]", "attribute": "take_rate", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入正整数或保留2位小数。"}}},{"id": "sitemodel-site_phone", "name": "SiteModel[site_phone]", "attribute": "site_phone", "rules": {"match":{"pattern":/^((0[0-9]{2,3}-[0-9]{7,8})|([0-9]{2,4}-[0-9]{2,4}-[0-9]{2,4})|([0-9]{2,4}[0-9]{2,4}[0-9]{2,4})|(13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}))$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入有效电话号码。"}}},{"id": "sitemodel-site_email", "name": "SiteModel[site_email]", "attribute": "site_email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"站点邮箱不是有效的邮箱地址。"}}},{"id": "sitemodel-site_name", "name": "SiteModel[site_name]", "attribute": "site_name", "rules": {"string":true,"messages":{"string":"站点名称必须是一条字符串。","maxlength":"站点名称只能包含至多20个字符。"},"maxlength":20}},{"id": "sitemodel-region_code", "name": "SiteModel[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"站点地区必须是一条字符串。","maxlength":"站点地区只能包含至多20个字符。"},"maxlength":20}},{"id": "sitemodel-site_manager", "name": "SiteModel[site_manager]", "attribute": "site_manager", "rules": {"string":true,"messages":{"string":"站点负责人必须是一条字符串。","maxlength":"站点负责人只能包含至多20个字符。"},"maxlength":20}},{"id": "sitemodel-site_domain", "name": "SiteModel[site_domain]", "attribute": "site_domain", "rules": {"string":true,"messages":{"string":"站点域名必须是一条字符串。","maxlength":"站点域名只能包含至多20个字符。"},"maxlength":20}},{"id": "sitemodel-close_reason", "name": "SiteModel[close_reason]", "attribute": "close_reason", "rules": {"string":true,"messages":{"string":"关闭原因必须是一条字符串。","maxlength":"关闭原因只能包含至多100个字符。"},"maxlength":100}},{"id": "sitemodel-site_wangwang", "name": "SiteModel[site_wangwang]", "attribute": "site_wangwang", "rules": {"string":true,"messages":{"string":"旺旺客服必须是一条字符串。","maxlength":"旺旺客服只能包含至多100个字符。"},"maxlength":100}},{"id": "sitemodel-site_logo", "name": "SiteModel[site_logo]", "attribute": "site_logo", "rules": {"string":true,"messages":{"string":"站点Logo必须是一条字符串。","maxlength":"站点Logo只能包含至多255个字符。"},"maxlength":255}},{"id": "sitemodel-site_domain", "name": "SiteModel[site_domain]", "attribute": "site_domain", "rules": {"match":{"pattern":/^[a-zA-Z0-9]{1,20}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"站点域名仅能由1~20个英文字母、数字组成"}}},{"id": "sitemodel-site_domain", "name": "SiteModel[site_domain]", "attribute": "site_domain", "rules": {"match":{"pattern":/^www|admin|administrator|api|backend|seller|store|api|forentend|market|mobile|test|web|index$/i,"not":true,"skipOnEmpty":1},"messages":{"match":"此域名已被系统占用，请重新输入"}}},{"id": "sitemodel-site_name", "name": "SiteModel[site_name]", "attribute": "site_name", "rules": {"ajax":{"url":"/subsite/site-config/client-validate","model":"YXBwXG1vZHVsZXNcc3Vic2l0ZVxtb2RlbHNcU2l0ZU1vZGVs","attribute":"site_name","params":["SiteModel[site_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},{"id": "sitemodel-site_domain", "name": "SiteModel[site_domain]", "attribute": "site_domain", "rules": {"ajax":{"url":"/subsite/site-config/client-validate","model":"YXBwXG1vZHVsZXNcc3Vic2l0ZVxtb2RlbHNcU2l0ZU1vZGVs","attribute":"site_domain","params":["SiteModel[site_id]"]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
</script>
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
            var validator = $("#form").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#clientRules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return false;
                }

                //清空文件
                var data = $("#form").serializeJson();
                var url = $("#form").attr("action");

                //加载提示
                $.loading.start();

                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, function() {
                            $.go('/system/subsite/list');
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });

                return false;
            });

            //地区组件
            $("#region_container").regionselector({
                value: '{{ $info->region_code ?? '' }}',
                select_class: "form-control",
                change: function(value, names, is_last) {
                    if (value == '') {
                        var values = this.values();
                        if (values.length > 0) {
                            value = values[values.length - 1].region_code;
                        }
                    }
                    $("#region_code").val(value);
                    $("#region_code").data("is_last", is_last);
                    $("#region_code").valid();
                }
            });

            // 初始化时间选择控件
            $('.form_datetime.middle').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2, // 0- 1- 2-只选年月日
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd'
            });

            $("#site_logo_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: 1,
                mode: 0,
                values: ["@if(!empty($info->site_logo)){{ get_image_url($info->site_logo) }}@endif"],
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $("#site_logo").val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    $("#site_logo").val(values);
                }
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop