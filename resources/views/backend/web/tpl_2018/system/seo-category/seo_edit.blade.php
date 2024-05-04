<div id="{{ $uuid }}">
    <form id="{{ $uuid }}" class="form-horizontal" action="/system/seo-category/seo-edit?cat_id={{ $cat_id }}" method="post">
        @csrf
        <div class="table-content m-t-10 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">title：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input class="form-control" type="text" value="" name="title">
                        </div>
                        <div class="help-block help-block-t">默认 ：{name}-{site_name}</div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">keywords：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input class="form-control" type="text" value="" name="keywords">
                        </div>
                        <div class="help-block help-block-t">默认 ：【{name}】{keywords}-{site_name} </div>
                    </div></div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="ng-binding">discription：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input class="form-control" type="text" value="" name="discription">
                        </div>
                        <div class="help-block help-block-t">默认 ：【{name}】{discription}-{site_name}</div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal-footer">
        <input type="hidden" name="cat_id" value="{{ $cat_id }}">
        <input type="hidden" name="type" value="">
        <input type="button" id="btn_validate" class="btn btn-primary" value="确定">

        <input type="button" class="btn btn-default" data-dismiss="modal" value="取消">

    </div>
</div>

<script type="text/javascript">
    $().ready(function() {
        $("#{{ $uuid }}").find("#btn_validate").click(function() {
            var data = $("#{{ $uuid }}").serializeJson();

            $.post('/system/seo-category/seo-save', data, function(result) {
                if (result.code == 0) {
                    $.msg(result.message);
                    $.go('/system/seo-category/list');
                }
            }, "json");
        });
    });
</script>