<div class="modal-body p-b-20">
    <div class="table-content clearfix">
        <form class="form-horizontal" onsubmit="return false;">

            @if(!empty($goods_remark))
            @foreach($goods_remark as $v)
            <p class="m-b-10">
                <span class="m-r-20">备注人：{{ $v['admin_name']}}</span>
                <span class="m-r-20">备注时间：{{ $v['created_at']}}</span>
                <span class="m-r-30">备注内容：{!! $v['content'] !!}</span>
            </p>
            @endforeach
            @endif

            <textarea id="remark" name="remark" class="form-control" placeholder="" rows="5"></textarea>
            <span id="error" class="form-control-error" style="display: none">
<i class="fa fa-warning"></i>
备注不能为空。
</span>
            <input name="id" type="hidden" value="{{ $id }}" />
            <input name="edit" type="hidden" value="1" />
        </form>
    </div>
</div>
