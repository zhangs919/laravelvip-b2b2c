<div id="{{ $page_id }}">
    <!-- 温馨提示 -->

    <form class="form-horizontal">
        <div class="table-content m-t-10 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">文本内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <textarea class="form-control mobile-text" row=6>{{ $selector_data[0]['text'] ?? '' }}</textarea>
                        </div>
                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">内容不能为空，最多输入10个字</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $().ready(function() {
        $("#{{ $page_id }}").on('focus', 'textarea', function() {
            if ($(this).hasClass('error')) {
                $(this).removeClass('error');
            }
        });
        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] }}';
        var uid = '{{ $data['uid'] }}';
        var select_count = '0';
        var max_number = '{{ $data['number'] }}';
        $("#{{ $page_id }}").find("#ok").click(function() {
            var text = $("#{{ $page_id }}").find("textarea").val();
            if ($.trim(text) == '') {
                $("#{{ $page_id }}").find("textarea").addClass('error');
                $.msg("内容不能为空");
                return false;
            } else if ($.trim(text).length > '10') {
                $("#{{ $page_id }}").find("textarea").addClass('error');
                $.msg("内容不能超过10个字");
                return false;
            }
            chk_value = [];
            chk_value.push({
                text: text
            });
//上传数据
            $.designadddata({
                data: {
                    uid: uid,
                    chk_value: chk_value,
                    type: type,
                    cat_id: cat_id,
                },
            });
        });
    });
</script>