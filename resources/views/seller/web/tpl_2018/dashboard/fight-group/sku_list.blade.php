<table id="{{ $uuid }}" class="table table-hover m-b-0">
    <thead>
    <tr>
        <th class="w50 text-c">序号</th>
        <th class="w200">SKU规格</th>
        <th class="w100 text-c">商品售价（元）</th>
        <th class="w100 text-c">
            拼团价（元）
            <div class="batch">
                <a class="batch-edit" title="批量设置">
                    <i class="fa fa-edit"></i>
                </a>
                <div class="batch-input" style="display: none">
                    <h6>批量设置拼团价：</h6>
                    <a class="batch-close">X</a>
                    <input class="form-control text small batch_set_act_price" type="text">
                    <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=0>设置</a>
                    <span class="arrow"></span>
                </div>
            </div>
        </th>

        @if($is_commander_discount)
        <th class="w120 text-c">
            团长享受折扣（%）<i class='fa fa-question-circle c-ccc m-l-5' data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="团长享受折扣价是以拼团价格为计算基数的；例如：商品拼团价为10元，团长享受折扣为90%，那么团长购买此商品最终的价格即为9元；"></i>
            <div class="batch">
                <a class="batch-edit" title="批量设置">
                    <i class="fa fa-edit"></i>
                </a>
                <div class="batch-input" style="display: none">
                    <h6>批量设置团长享受折扣：</h6>
                    <a class="batch-close">X</a>
                    <input class="form-control text small batch_set_first_discount" type="text">
                    <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=1>设置</a>
                    <span class="arrow"></span>
                </div>
            </div>
        </th>
        <th class="w120 text-c">
            团长优惠价格（元）<i class='fa fa-question-circle c-ccc m-l-5' data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="团长优惠价格是以拼团价为计算基数的；例如：商品拼团价为10元，团长优惠价格为2元，那么团长购买此商品最终的价格为8元；"></i>
            <div class="batch">
                <a class="batch-edit" title="批量设置">
                    <i class="fa fa-edit"></i>
                </a>
                <div class="batch-input" style="display: none">
                    <h6>批量设置团长优惠价格：</h6>
                    <a class="batch-close">X</a>
                    <input class="form-control text small batch_set_discount_price" type="text">
                    <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=2>设置</a>
                    <span class="arrow"></span>
                </div>
            </div>
        </th>
        @endif

        <th class="w100 text-c">
            活动库存
            <div class="batch">
                <a class="batch-edit" title="批量设置">
                    <i class="fa fa-edit"></i>
                </a>
                <div class="batch-input" style="display: none">
                    <h6>批量设置活动库存：</h6>
                    <a class="batch-close">X</a>
                    <input class="form-control text small batch_set_act_stock" type="text">
                    <a class="btn btn-primary btn-sm m-l-5 btn_batch_set" data-type=3>设置</a>
                    <span class="arrow"></span>
                </div>
            </div>
        </th>
        <th class="w100 text-c">总库存</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sku_list as $k=>$item)
    <tr id="sku_list_{{ $item->sku_id }}" class="sku-list-tr ">
        <td class="sku-td-index text-c">
            <div class="pos-r">
                {{ $k+1 }}
                <a class="del-btn sku-item-handle" title="点击禁用此规格">×</a>
            </div>
        </td>
        <td>
            <div class="ng-binding">{{ $item->spec_names ?? '无' }}</div>
        </td>
        <td class="text-c">
            {{ $item->goods_price }}
        </td>
        <td class="text-c">
            <input type="text" name="act_price[{{ $item->sku_id }}]"  value="0.00" class="form-control form-control-sm w60 act_price_input" onkeyup="clearNoNum(this)" data-rule-callback='list_act_price_callback'>
        </td>

        @if($is_commander_discount)
            <td class="text-c">
                <input type="text" name="first_discount[{{ $item->sku_id }}]" id="first_discount[{{ $item->sku_id }}]"  value="0.00" class="form-control form-control-sm w60 first_discount_input first_discount_{{ $item->sku_id }}" onkeyup="checkDiscount({{ $item->sku_id }},'first_discount')" data-rule-callback='list_first_discount_callback'>
            </td>
            <td class="text-c">
                <input type="text" name="discount_price[{{ $item->sku_id }}]" id="discount_price[{{ $item->sku_id }}]"  value="0.00" class="form-control form-control-sm w60 discount_price_input discount_price_{{ $item->sku_id }}" onkeyup="checkDiscount({{ $item->sku_id }},'discount_price')" data-rule-callback='list_discount_price_callback'>
            </td>
        @endif

        <td class="text-c">
            <input type="text" name="act_stock[{{ $item->sku_id }}]" id="act_stock[{{ $item->sku_id }}]"  value="" class="form-control form-control-sm w60 act_stock_input" data-rule-callback='list_act_stock_callback'>
        </td>
        <td class="text-c">{{ $item->goods_number }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
<script type="text/javascript">
    //
</script>
<script>

    $().ready(function () {
        var container = $("#{{ $uuid }}");

        $("[data-toggle='popover']").popover();

        $(container).on('click', '.del-btn', function() {
            $(this).removeClass('del-btn').addClass('allow-btn').html('√');
            $(this).parents('tr').addClass('disabled');
            $(this).parents('tr').find('input').attr('disabled', 'disabled');
        });
        $(container).on('click', '.allow-btn', function() {
            $(this).removeClass('allow-btn').addClass('del-btn').html('×');
            $(this).parents('tr').removeClass('disabled');
            $(this).parents('tr').find('input').removeAttr('disabled');
        });
    });

    function checkDiscount(sku_id,type)
    {
        if(type == 'first_discount'){
            if($('.first_discount_'+sku_id).val() == '' || $('.first_discount_'+sku_id).val() <= 0){
                $('.discount_price_'+sku_id).removeAttr("disabled");
                $('.first_discount_'+sku_id).removeAttr("disabled");
            }else{
                $('.discount_price_'+sku_id).attr("disabled","disabled");
                $('.first_discount_'+sku_id).removeAttr("disabled");
            }
        }
        else{
            if($('.discount_price_'+sku_id).val() == '' || $('.discount_price_'+sku_id).val() <= 0){
                $('.discount_price_'+sku_id).removeAttr("disabled");
                $('.first_discount_'+sku_id).removeAttr("disabled");
            }else{
                $('.discount_price_'+sku_id).removeAttr("disabled");
                $('.first_discount_'+sku_id).attr("disabled","disabled");
            }

        }
    }

    // 自定义验证规则：拼团价格
    function list_act_price_callback(element, value) {

        var regu = /^[0-9]+\.?[0-9]*$/;

        if ($(element).val() == "" || isNaN($(element).val())) {
            $(element).data("msg", "拼团价必须是数字。");
            return false;
        }
        if (parseFloat($(element).val()) < 0) {
            $(element).data("msg", "拼团价必须大于0。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "拼团价只能保留2位小数。");
                return false;
            }
        }

        return true;
    }

    // 自定义验证规则：团长享受折扣
    function list_first_discount_callback(element, value) {

        var regu = /^[0-9]+\.?[0-9]*$/;

        if ($(element).val() == "" || isNaN($(element).val())) {
            $(element).data("msg", "团长享受折扣必须是数字。");
            return false;
        }
        if (parseFloat($(element).val()) < 0) {
            $(element).data("msg", "团长享受折扣必须大于0。");
            return false;
        }
        if (parseFloat($(element).val()) > 100) {
            $(element).data("msg", "团长享受折扣必须小于100。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "团长享受折扣只能保留2位小数。");
                return false;
            }
        }

        return true;
    }

    // 自定义验证规则：团长优惠价格
    function list_discount_price_callback(element, value) {

        var regu = /^[0-9]+\.?[0-9]*$/;

        if ($(element).val() == "" || isNaN($(element).val())) {
            $(element).data("msg", "团长优惠价格必须是数字。");
            return false;
        }
        if (parseFloat($(element).val()) < 0) {
            $(element).data("msg", "团长优惠价格必须大于0。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 2) {
                $(element).data("msg", "团长优惠价格只能保留2位小数。");
                return false;
            }
        }

        return true;
    }

    // 自定义验证规则：活动库存
    function list_act_stock_callback(element, value) {

        var regu = /^[0-9]+\.?[0-9]*$/;

        if ($(element).val() == "" || isNaN($(element).val())) {
            $(element).data("msg", "活动库存必须是数字。");
            return false;
        }
        if (parseFloat($(element).val()) < 0) {
            $(element).data("msg", "活动库存必须大于等于0。");
            return false;
        }
        if ($(element).val().indexOf('.') > -1) {
            if ($(element).val().split('.')[1].length > 0) {
                $(element).data("msg", "活动库存只能是整数。");
                return false;
            }
        }

        return true;
    }

    //
</script>