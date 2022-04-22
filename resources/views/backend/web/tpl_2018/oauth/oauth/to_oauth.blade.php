<div class="modal-body">
    <div class="table-content clearfix">
        <form class="form-horizontal" onsubmit="return false;">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">对接方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label control-label-spe m-r-20">
                                <input type="radio" class="icheck" name="iCheck" onclick="oauthShow(1)" checked="">
                                嗖嗖快送
                            </label>
                            <label class="control-label control-label-spe">
                                <input type="radio" class="icheck" name="iCheck" onclick="oauthShow(2)">
                                独立物流系统
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="oauth_time" class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span>选择时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input id="oauth_begin_time" class="form-control form_datetime ipt" type="text" name="begin">
                            <span class="ctime">至</span>
                            <input id="oauth_end_time" class="form-control form_datetime ipt" type="text" name="end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">对接系统域名：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input id="oauth_type" type="hidden" value="logistics">
                            <input id="oauth_url" class="form-control" placeholder="" type="text" value="">
                        </div>
                        <div id="show_sousou" class="help-block help-block-t">对接物流系统地址，如果对接嗖嗖快送，则直接输入http://api.sousou56.com/</div>
                        <div id="show_alone" style="display: none;" class="help-block help-block-t">请输入 http://api.您的域名，例如 http://api.xxx.com</div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <button onclick="to_oauth_submit()" class="btn btn-primary">确认对接</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<!-- 日历控件-->
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.2"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
<script>
    $('.form_datetime').datetimepicker({
        language: 'zh-CN',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: true,
        showMeridian: 1,
        format: 'yyyy-mm-dd',
    });

    function oauthShow(type) {
        if (type == 1) {
            $("#oauth_time").show();
            $('#show_sousou').show();
            $("#show_alone").hide();
        } else {
            $("#oauth_time").hide();
            $("#show_alone").show();
            $('#show_sousou').hide();
        }
    }
</script>