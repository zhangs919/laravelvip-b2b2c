<div class="form-horizontal">
    <div class="table-content m-t-10 clearfix">
        <div class="simple-form-field">
            <div class="form-group">
                <label for="text4" class="col-sm-3 control-label">
                    <span class="ng-binding">发送时间：</span>
                </label>
                <div class="col-sm-8">
                    <label class="control-label">{{ $msg_info->send_time }}</label>
                </div>
            </div>
        </div>
        <div class="simple-form-field p-t-0">
            <div class="form-group">
                <label for="text4" class="col-sm-3 control-label">
                    <span class="ng-binding">消息内容：</span>
                </label>
                <div class="col-sm-8">
                    <label class="control-label text-l">{!! $msg_info->content !!}</label>
                </div>
            </div>
        </div>

    </div>
</div>