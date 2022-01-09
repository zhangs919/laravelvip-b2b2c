<div id="{{ $uuid }}" class="table-content m-t-10">
    <form method="" action="" class="form-horizontal">
        <div class="simple-form-field ">
            <div class="form-group">
                <label for="text4" class="col-sm-3 control-label">
                    <span class="ng-binding">商品编号：</span>
                </label>
                <div class="col-sm-9">
                    <label class="control-label">{{ $goods_info->goods_id }}</label>
                </div>
            </div>
        </div>
        <div class="simple-form-field ">
            <div class="form-group">
                <label for="text4" class="col-sm-3 control-label">
                    <span class="ng-binding">违规商品名称：</span>
                </label>
                <div class="col-sm-9">
                    <label class="control-label">{{ $goods_info->goods_name }}</label>
                </div>
            </div>
        </div>
        <div class="simple-form-field ">
            <div class="form-group">
                <label for="text4" class="col-sm-3 control-label">
                    <span class="ng-binding">违规下架理由：</span>
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
<script type="text/javascript">
    $().ready(function() {
        var container = $("#{{ $uuid }}");
        var modal = $.modal(container);
        $(container).find(".btn_submit").click(function() {
            $.loading.start();
            var data = $(container).serializeJson();
            $.post('/goods/publish/illegal?id={{ $goods_info->goods_id }}', data, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    modal.hide();
                    $.msg(result.message);
                    window.location.reload();
                } else {
                    $.msg(result.message, {
                        time: 5000
                    })
                }
            }, "json");
        });
    });
</script>