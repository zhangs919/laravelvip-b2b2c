<form id="ScanSearchModel" class="form-horizontal" name="ScanSearchModel" action="/goods/yun/ajax-scan" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="table-content m-t-10 clearfix">
            <!-- 是否采集评论 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="scansearchmodel-barcodes" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">扫码枪导入数据：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="scansearchmodel-barcodes" class="form-control w400 h150" name="ScanSearchModel[barcodes]" rows="5"></textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请点击输入框，确保光标在框内，再扫描！<br>手动输入条码，多个条码请用回车来分隔！<br>建议一次导入30条商品记录</div></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer text-c">
        <a class="btn btn-primary" href="javascript:;" id="btn_submit">预览</a> <a class="btn-link m-l-10" href="javascript:;" id="filter_scan">下载预览结果</a>
    </div>

</form>


<!-- 表单验证 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180418"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180418"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180418"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180418"></script>
<script src="/assets/d2eace91/js/common.js?v=20180418"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "scansearchmodel-barcodes", "name": "ScanSearchModel[barcodes]", "attribute": "barcodes", "rules": {"required":true,"messages":{"required":"扫码枪导入数据不能为空。"}}},]
</script>
<script type="text/javascript">

    $().ready(function() {
//条形码焦点获取
//$("#scansearchmodel-barcodes").focus();

        var tablelist = $("#table_list").tablelist();

        var validator = $("#ScanSearchModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            var json = $("#ScanSearchModel").serializeJson();
            tablelist.url = "goods-list";
            tablelist.method = 'POST';
            var data = json.ScanSearchModel;
//屏掉前面的搜索条件
            data.brand_id = 0;
            data.cat_id = 0;
            data.keyword = '';
            tablelist.load(data);
            $.closeAll();
        });

        $("#filter_scan").click(function(){
            if (!validator.form()) {
                return;
            }
            var json = $("#ScanSearchModel").serializeJson();
            var data = json.ScanSearchModel;
            $.ajaxFileUpload({
                url:'filter-barcodes',
                dataType: 'json',
                data: data,
                success: function(data){
                    if(data.code == 0){

                    }else{
                        $.msg(data.message, {
                            time: 5000
                        });
                    }
                }
            });
        })

    });
</script>