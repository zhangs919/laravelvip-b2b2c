<div id="{{ $uuid }}" class="table-content m-t-10">
    <form method="" action="" class="form-horizontal">
        <input type="hidden" name="id" value="{{ $info->user_id}}" />
        <div class="simple-form-field ">
            <div class="form-group">
                <label for="text4" class="col-sm-3 control-label">
                    <span class="ng-binding">审核是否通过：</span>
                </label>
                <div class="col-sm-9"><input type="hidden" name="is_pass" value="0"><div class="" name="is_pass" value="1"><label class="control-label cur-p m-r-10"><input type="radio" name="is_pass" value="1" checked> 是</label>
                        <label class="control-label cur-p m-r-10"><input type="radio" name="is_pass" value="3"> 否</label></div></div>
            </div>
        </div>
        <div class="simple-form-field reason" style="display: none;">
            <div class="form-group">
                <label for="text4" class="col-sm-3 control-label">
                    <span class="ng-binding">未通过理由：</span>
                </label>
                <div class="col-sm-9">
                    <textarea name="reason" class="form-control" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <div class="form-group m-b-0">
                <label for="" class="col-sm-5 control-label"> </label>
                <div class="col-sm-7">
                    <div class="form-control-box">
                        <input type="button" class="btn btn-primary btn_submit" value="确认提交" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="/assets/d2eace91/js/common.js?v=20180528"></script>
<script type="text/javascript">
    $().ready(function() {
        var container = $("#{{ $uuid }}");
        var modal = $.modal(container);
        var tablelist = modal.params.tablelist;

        $(container).find("[name='is_pass']").change(function(event) {
            if ($(container).find("[name='is_pass']:checked").val() == "1") {
                $(container).find(".reason").hide();
            } else {
                $(container).find(".reason").show();
            }
        });

        $(container).find(".btn_submit").click(function() {
            var data = $(container).serializeJson();
            $.loading.start();
            $.post('/user/live-user/audit', data, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    modal.hide();
                    $.msg(result.message);
                    if (tablelist) {
                        tablelist.load();
                    } else {
                        window.location.reload();
                    }
                } else {
                    $.msg(result.message, {
                        time: 5000
                    })
                }
            }, "json");
        });
    });
</script>