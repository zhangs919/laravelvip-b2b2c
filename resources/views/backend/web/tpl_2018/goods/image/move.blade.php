<form id="{{ $uuid }}" class="form-horizontal" action="add" method="POST">
    {{ csrf_field() }}
    <div class="table-content m-t-10 clearfix">
        <!-- 相册名称 -->
        <div class="simple-form-field" >
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">

                    <span class="ng-binding">目标相册：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <select id="dir_id" class="form-control" name="dir_id">
                            @foreach($image_dir_list as $v)
                            <option value="{{ $v->dir_id }}">{{ $v->dir_name }}</option>
                            @endforeach
                        </select>
                        <!-- -->

                    </div>

                    <div class="help-block help-block-t"></div>
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

        var form = $("#{{ $uuid }}");

        var modal = $.modal($('#{{ $uuid }}'));
        var tablelist = modal.params.tablelist;

        var img_ids = modal.params.img_ids;

        $(form).find("#btn_submit").click(function() {

//加载提示
            $.loading.start();

            $.post('move', {
                img_ids: img_ids,
                dir_id: $("#{{ $uuid }}").find("#dir_id").val()
            }, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    $.msg(result.message);
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