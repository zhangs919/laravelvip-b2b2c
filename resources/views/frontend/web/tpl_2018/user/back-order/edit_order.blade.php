<div id="1542887762YdWeb9">
    <form class="form-horizontal return-apply" method="post" action="" name="">
        <div class="form-group form-group-spe">
            <label class="input-left">
                <span class="spark">*</span>
                <span>物流方式：</span>
            </label>
            <div class="form-control-box">
                <label class="control-label cur-p m-r-20">
                    <input type="radio" id="shipping_type" class="" name="shipping_type" value="0" checked>
                    第三方物流
                </label>
                <label class="control-label cur-p m-r-20">
                    <input type="radio" id="shipping_type" class="" name="shipping_type" value="1" >
                    自行配送
                </label>
            </div>
        </div>
        <div id="is_show">
            <div class="form-group form-group-spe">
                <label class="input-left">
                    <span class="spark">*</span>
                    <span>物流公司：</span>
                </label>
                <div class="form-control-box">
<span class="select">
<select id="shipping_id" class="form-control chosen-select">
<option value=''>请选择物流公司</option>

<option value='1' >安捷快递</option>


<option value='2' >安能快递</option>


<option value='3' >安信达快递</option>


<option value='4' >百福东方</option>


<option value='5' >COE东方快递</option>


<option value='6' >城市100快递</option>


<option value='7' >传喜物流</option>


<option value='8' >德邦物流</option>


<option value='9' >D速物流</option>


<option value='10' >大田物流</option>


<option value='11' >EMS快递</option>


<option value='12' >快捷快递</option>


<option value='13' >FedEx联邦快递</option>


<option value='19' >天天快递</option>


<option value='40' >顺丰快递</option>


<option value='44' >申通快递</option>


<option value='57' >韵达快递</option>


<option value='62' >圆通快递</option>


<option value='65' >宅急送</option>


<option value='67' >中铁快运</option>


<option value='68' >中通快递</option>


<option value='69' >中邮物流</option>


<option value='70' >郑州建华</option>



<option value='72' >中通快运</option>


<option value='73' >全城通快速达</option>


<option value='78' >中通</option>


</select>

</span>
                </div>
            </div>
            <div class="form-group form-group-spe">
                <label class="input-left">
                    <span class="spark">*</span>
                    <span>运单号码：</span>
                </label>
                <div class="form-control-box">
                    <input class="" type="text" placeholder="" id="shipping_sn" value="" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input id='back_id' type='hidden' value='17' />
            <button id="btn_submit" type="button" class="btn btn-primary">确认</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $().ready(function() {
        $("#1542887762YdWeb9").find("#btn_submit").click(function() {
            var back_id = $("#1542887762YdWeb9").find("#back_id").val();
            var shipping_id = $("#1542887762YdWeb9").find("#shipping_id").val();
            var shipping_sn = $("#1542887762YdWeb9").find("#shipping_sn").val();
            var shipping_type = $("#1542887762YdWeb9").find('input:radio[name="shipping_type"]:checked').val();

            if (shipping_type == 0) {
                if (shipping_id == "") {
                    $.msg("请选择物流公司");
                    return false;
                }
                if (shipping_sn == "" && shipping_id != "71") {
                    $.msg("请填写运单号码");
                    return false;
                }
            } else {
                shipping_id = "71";
                shipping_sn = "";
            }

            $.loading.start();
            $.post('/user/back/edit-order', {
                id: back_id,
                type: 'shipping',
                shipping_id: shipping_id,
                shipping_sn: shipping_sn,
            }, function(result) {
                $.msg(result.message);

                if (result.code == 0) {
                    $.go("/user/back/info?id=" + back_id);
                }
            }, 'json');
        });

        $("input[name='shipping_type']").click(function() {
            if ($(this).val() == 1) {
                $("#is_show").hide();
            } else {
                $("#is_show").show();
            }
        });

        if ("0" == "1") {
            $("#is_show").hide();
        }
    });
</script>