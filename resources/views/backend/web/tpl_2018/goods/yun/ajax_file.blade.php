<form id="fileform" class="form-horizontal" action="goods-list" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="table-content m-t-10 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 w150 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">上传商品库文件：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <div class="file-attach-1">
                                <div class="file-attach-2">
                                    <i class="fa fa-upload"></i>
                                    上传附件
                                </div>
                                <input type="file" name="uploadfile" id="uploadfile" class="inputstyle">
                            </div>
                            <div class="file-attach-info">
                                <span id="filepath"></span>
                            </div>


                        </div>
                        <div class="help-block help-block-t p-t-10">
                            <a class="btn-link" href="/goods/yun/download">下载上传商品库文件模板</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer text-c">
        <a class="btn btn-primary" href="javascript:;" id="btn_submit_file">预览</a>
        <a class="btn-link m-l-10" href="javascript:;" id="filter_file">下载预览结果</a>
    </div>
</form> <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180418"></script>
<script type="text/javascript">
    $().ready(function() {
        var tablelist = $("#table_list").tablelist();

        $("body").on("change", "#uploadfile", function() {
            $("#filepath").html($("#uploadfile").val().split("\\").pop());
        });

        $("body").on("click", "#btn_submit_file", function() {
            $.ajaxFileUpload({
                url: 'ajax-read-excel',
                fileElementId: 'uploadfile',
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        search(data.data, tablelist);
//console.info(data.data);
                    } else {
                        $.msg(data.message, {
                            time: 5000
                        });
                    }
                }
            });
        });

        $("body").on("click", "#filter_file", function() {
            $.ajaxFileUpload({
                url: 'filter-excel',
                fileElementId: 'uploadfile',
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {

                    } else {
                        $.msg(data.message, {
                            time: 5000
                        });
                    }
                }
            });
        });

    });

    function search(barcodes, tablelist) {
        tablelist.url = "goods-list";
        tablelist.method = 'POST';
        var data = new Object();
//屏掉前面的搜索条件
        data.barcodes = barcodes;
        data.brand_id = 0;
        data.cat_id = 0;
        data.keyword = '';
        tablelist.load(data);
        $.closeAll();
    }
</script>