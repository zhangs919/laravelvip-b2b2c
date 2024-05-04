<form class="form-horizontal" onsubmit="return false;">
    <input type="hidden" name="user_id" value="{{ $info->user_id }}">
    <div class="table-content clearfix m-10">
        <textarea id="user_remark" name="user_remark" class="form-control" placeholder="" rows="5">{!! $info->member_remark !!}</textarea>
    </div>
</form>