<div class="modal-body p-b-20">
    <div class="table-content clearfix">
        <form class="form-horizontal" onsubmit="return false;">

            <textarea id="mall_remark" name="mall_remark" class="form-control" placeholder="" rows="5"></textarea>
            <span id="error" class="form-control-error" style="display: none">
			<i class="fa fa-warning"></i>
			备注不能为空。
		</span>
            <input name="id" type="hidden" value="{{ $id }}">
            <input name="edit" type="hidden" value="1">
        </form>
    </div>
</div>

