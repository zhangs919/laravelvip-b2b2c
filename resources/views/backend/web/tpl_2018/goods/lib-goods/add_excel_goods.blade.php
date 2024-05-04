<div class="modal-body">
    <div class="alert alert-info br-0">
        Excel文件上传，系统根据条形码做唯一标识进行去重判断，新上传的商品将替换原有的商品信息。
        </br>
        导入商品，商品未上传主图及商品详情，所以导入的商品默认是下架状态，需手动维护商品数据后，才可上架；导入的商品文件，请提前确定导入文件中的平台方商品分类在商城系统中真实存在，否则商品将无法导入；导入的商品文件，请提前确定导入文件中的商品库商品分类在系统中真实存在， 否则导入的商品的商品库商品分类将为空
    </div>
    <div class="table-content m-t-30 clearfix">
        <form id="UploadModel" class="form-horizontal" action="/goods/lib-goods/add-excel-goods" method="post" enctype="multipart/form-data">
            @csrf
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">上传商品文件：</span>
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
                        </div>
                        <span id="filepath" class="c-blue m-l-20 l-h-36"></span>
                        <div class="help-block help-block-t">
                            <a class="btn-link" href="/goods/lib-goods/download-add" target="_blank">下载上传商品文件模板</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field p-t-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <div class="form-control-box">
                            <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交">
                            <input type="button" class="btn-link m-l-10" id="btn_download" name="btn_download" value="下载上传结果">
                            <input type="hidden" id="is_download" name="is_download">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $().ready(function() {

        function validate() {
            var filepath = $("#filepath").html();
            var index1 = filepath.lastIndexOf(".");
            var index2 = filepath.length;
            var suffix = filepath.substring(index1 + 1, index2);

            if ($('#uploadfile').val() == '') {
                $.msg('请上传更新文件！');
                return false;
            } else if (suffix != 'xls' && suffix != 'xlsx') {
                $.msg('请上传excel格式文件！');
                return false;
            }

            return true;
        }

        $("#btn_submit").click(function() {

            if (validate() == false) {
                return false;
            }

            layer.confirm('为了避免您上传的文件包含错误数据，请先下载预览结果，根据提示信息修改上传文件；如果您的文件准确无误，请直接提交。', {
                btn: ['我要提交', '我要下载预览结果']
            }, function() {
                $.loading.start();
                $("#is_download").val(0);
                $("#UploadModel").submit();
            }, function() {
                $("#btn_download").click();
            });

        });

        $("#btn_download").click(function() {
            if (validate() == false) {
                return false;
            }
            $("#is_download").val(1);
            $("#UploadModel").submit();
        });

        $("body").on("change", "#uploadfile", function() {
            $("#filepath").html($("#uploadfile").val().split("\\").pop());
        });
    });
</script>