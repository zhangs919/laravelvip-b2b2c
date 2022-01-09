<div id="{{ $uuid }}">
    <form class="form-horizontal" onsubmit="return false;">
        <div class="table-content clearfix">
            <textarea id="user_remark" name="user_remark" class="form-control" placeholder="" rows="5">{!! $info->user_remark !!}</textarea>
        </div>
        <div class="modal-footer m-t-15">
            <button id="btn_submit" class="btn btn-primary">确认提交</button>
            <input id="user_id" name="user_id" type="hidden" value="{{ $info->user_id }}" />
        </div>
    </form>
</div>

<script>
    $().ready(function() {
        $("#{{ $uuid }}").find("#btn_submit").click(function() {
            var id = $("#{{ $uuid }}").find("#user_id").val();
            var user_remark = $.trim($("#{{ $uuid }}").find("#user_remark").val());

            if (user_remark.length == 0) {
                $.msg("会员备注不能为空！");
                return false;
            }

            $.post('/user/user/edit-desc', {
                id: id,
                user_remark: user_remark,
                edit: 1
            }, function(result) {
                $.msg(result.message);

                if (result.code == 0) {
                    $.go("/user/user/list");
                }
            }, 'json');
        });
    });
</script>