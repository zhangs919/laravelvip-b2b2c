<div class="modal-body p-b-10">
    <div class="table-content clearfix">
        <form class="form-horizontal" onsubmit="return false;">
            <p class="f14 m-b-5">买家提交取消订单申请，请及时与买家进行沟通！</p>
            <div class="content m-b-10">
                <div class="alert alert-info br-0 m-t-10">
                    <p>1、同意取消订单申请后，订单金额费用全部原路返还给消费者，订单关闭。</p>
                    <p>2、如果商家已经将订单商品备货完成，可拒绝消费者取消订单申请。</p>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="order_cancel" class="col-sm-4 control-label">
                            <span class="ng-binding">审核：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">
                                <input name="order_cancel" value="0" class="valid" type="hidden">
                                <div id="order_cancel" class="" name="order_cancel">
                                    <label class="control-label cur-p m-r-10">
                                        <input name="order_cancel" value="2" checked="" aria-invalid="false" type="radio">
                                        同意
                                    </label>
                                    <label class="control-label cur-p m-r-10">
                                        <input name="order_cancel" value="3" type="radio">
                                        拒绝
                                    </label>
                                </div>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field refuse_reason" style="display: none">
                    <div class="form-group">
                        <label for="refuse_reason" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding"></span>
                            <span class="ng-binding">拒绝理由：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <textarea id="refuse_reason" class="form-control" name="refuse_reason" rows="5" aria-required="true"></textarea>
                            </div>
                            <span id="error" class="form-control-error" style="display: none">
<i class="fa fa-warning"></i>
拒绝理由不能为空。
</span>
                            <span id="error2" class="form-control-error" style="display: none">
<i class="fa fa-warning"></i>
拒绝理由只能包含至多200个字符。
</span>
                            <div class="help-block help-block-t">200字以内</div>
                        </div>
                    </div>
                </div>
            </div>
            <input name="id" type="hidden" value="{{ $id }}" />
            <input name="edit" type="hidden" value="1" />
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $(":radio").click(function() {
            var val = $(this).val();
            if (val == "2") {
                $(".refuse_reason").hide();
                $(".form-control-error").hide();
            } else {
                $(".refuse_reason").show();
            }
        });
    });
</script>