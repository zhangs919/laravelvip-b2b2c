<form id="{{ $uuid }}" class="form-horizontal" action="/goods/image-dir/add" method="POST">
    {{ csrf_field() }}
    <div class="table-content m-t-10 clearfix">
        <input type="hidden" id="imagedir-dir_id" class="form-control" name="ImageDir[dir_id]" value="{{ $info->dir_id ?? '' }}">
        <!-- 相册名称 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="imagedir-dir_name" class="col-sm-3 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">目录名称：</span>
                </label>
                <div class="col-sm-9">
                    <div class="form-control-box">


                        <input type="text" id="imagedir-dir_name" class="form-control" name="ImageDir[dir_name]" value="{{ $info->dir_name ?? '' }}">
                        <!-- -->

                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
        <!-- 相册描述 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="imagedir-dir_desc" class="col-sm-3 control-label">

                    <span class="ng-binding">描述：</span>
                </label>
                <div class="col-sm-9">
                    <div class="form-control-box">


                        <textarea id="imagedir-dir_desc" class="form-control" name="ImageDir[dir_desc]" rows="5">{{ $info->dir_desc ?? '' }}</textarea>
                        <!-- -->

                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
        <!-- 相册排序 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="imagedir-dir_sort" class="col-sm-3 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">排序：</span>
                </label>
                <div class="col-sm-9">
                    <div class="form-control-box">


                        <input type="text" id="imagedir-dir_sort" class="form-control small" name="ImageDir[dir_sort]" value="{{ $info->dir_sort ?? '255' }}">


                    </div>

                    <div class="help-block help-block-t"><div class="help-block help-block-t">排序为0~255的数字，默认为255</div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" id="btn_submit" class="btn btn-primary" value="确定" />
        <input type="button" class="btn btn-default" data-dismiss="modal" value="取消" />
    </div>
</form>

<script type="text/javascript">
    $().ready(function() {

        var validator = null;

        var form = $("#{{ $uuid }}");

        validator = $(form).validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html(), {
            form: $(form)
        });

        var modal = $.modal($('#{{ $uuid }}'));
        var tablelist = modal.params.tablelist;

        $(form).find("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
//加载提示
//$.loading.start();
            var data = $(form).serializeJson();
            var url = $(form).attr("action");

            $.post(url, data, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    $.msg(result.message);
                    $(form).get(0).reset();
                    modal.hide();
                    tablelist.load();
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, 'json');
        });
    });
</script>
