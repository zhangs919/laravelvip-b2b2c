<table class="table table-hover m-b-0">
    <thead>
    <tr>
        <th class="w50 text-c">序号</th>
        <th class="w200">SKU规格</th>
        <th class="w100 text-c">商品售价（元）</th>
        <th class="w100 text-c">
            预售价（元）
            <div class="batch">
                <a class="batch-edit" title="批量设置">
                    <i class="fa fa-edit"></i>
                </a>
                <div class="batch-input" style="display: none">
                    <h6>批量设置预售价：</h6>
                    <a class="batch-close">X</a>
                    <input class="form-control text small batch_set_act_price" type="text">
                    <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=0>设置</a>
                    <span class="arrow"></span>
                </div>
            </div>
        </th>

        <th class="w100 text-c">
            定金（元）
            <div class="batch">
                <a class="batch-edit" title="批量设置">
                    <i class="fa fa-edit"></i>
                </a>
                <div class="batch-input" style="display: none">
                    <h6>批量设置定金：</h6>
                    <a class="batch-close">X</a>
                    <input class="form-control text small batch_set_earnest_money" type="text">
                    <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=1>设置</a>
                    <span class="arrow"></span>
                </div>
            </div>
        </th>
        <th class="w120 text-c">
            尾款金额（元）
            <div class="batch">
                <a class="batch-edit" title="批量设置">
                    <i class="fa fa-edit"></i>
                </a>
                <div class="batch-input" style="display: none">
                    <h6>批量设置尾款：</h6>
                    <a class="batch-close">X</a>
                    <input class="form-control text small batch_set_tail_money" type="text">
                    <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=2>设置</a>
                    <span class="arrow"></span>
                </div>
            </div>
        </th>

    </tr>
    </thead>
    <tbody>

    <tr id="sku_list_16" class="sku-list-tr ">
        <td class="sku-td-index text-c">
            1 <a class="del-btn sku-item-handle" title="点击禁用此规格">×</a>
        </td>
        <td>
            <div class="ng-binding">无</div>
        </td>
        <td class="text-c">18.00</td>
        <td class="text-c">
            <input type="text" name="act_price[16]" value="0.00" class="form-control form-control-sm w60 act_price_input" onkeyup="clearNoNum(this)">
        </td>

        <td class="text-c">
            <input type="text" name="earnest_money[16]" value="0.00" class="form-control form-control-sm w60 earnest_money_input" onkeyup="clearNoNum(this)">
        </td>
        <td class="text-c">
            <input type="text" name="tail_money[16]" value="0.00" class="form-control form-control-sm w60 tail_money_input" onkeyup="clearNoNum(this)">
        </td>

    </tr>

    </tbody>
</table>

<div class="help-block help-block-t">
    <div class="help-block help-block-t">
        预售价：预定活动期间商品优惠价格

        </br>
        定金：即预定商品第一阶段应付款，建议定金设置不应超过预定总价的20%。
        </br>
        尾款金额：系统将根据预售价和定金自动计算第二阶段应支付的尾款金额

    </div>
</div>
<script type='text/javascript'>
    $('body').on('click', '.del-btn', function() {
        $(this).removeClass('del-btn').addClass('allow-btn').html('√');
        $(this).parents('tr').addClass('disabled');
        $(this).parents('tr').find('input').attr('disabled', 'disabled');
    });
    $('body').on('click', '.allow-btn', function() {
        $(this).removeClass('allow-btn').addClass('del-btn').html('×');
        $(this).parents('tr').removeClass('disabled');
        $(this).parents('tr').find('input').removeAttr('disabled');
    });
</script>