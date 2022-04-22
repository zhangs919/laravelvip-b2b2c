<label class="control-label control-label-switch">
    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
        @if(!isset($info->status))
            <input type="hidden" name="ConfigModel[status]" value="0">
            <label>
                <input type="checkbox"
                       id="configmodel-status"
                       class="form-control b-n"
                       name="ConfigModel[status]"
                       value="1" checked=""
                       data-on-text="是" data-off-text="否"></label>
        @else
            <input type="hidden" name="ConfigModel[status]" value="0">
            <label>
                <input type="checkbox"
                       id="configmodel-status"
                       class="form-control b-n"
                       name="ConfigModel[status]"
                       value="1" @if($info->status == 1)checked="" @endif
                       data-on-text="是" data-off-text="否"></label>
        @endif

    </div>
</label>