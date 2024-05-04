<link rel="stylesheet" href="/css/mobile-style.css"/>

<div class="shop-header-edit">
    <div class="table-content m-t-10 clearfix">
        <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tabs" value="">
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-shop_header_style" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">头部样式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="hidden" id="shopconfigmodel-shop_header_style" class="form-control" name="ShopConfigModel[shop_header_style]" value="{{ $group_info['shop_header_style']->value }}">
                            <div class="col-sm-8">
                                <div class="shop-header-layout">
                                    <div class="SZY-SHOP-HEAD-STYLE shop-layout-con0 @if($group_info['shop_header_style']->value == 0){{ 'shop-layout-current' }}@endif" data-val="0">
                                        <em></em>
                                    </div>
                                    <div class="SZY-SHOP-HEAD-STYLE shop-layout-con1 @if($group_info['shop_header_style']->value == 1){{ 'shop-layout-current' }}@endif" data-val="1">
                                        <em></em>
                                    </div>
                                </div>
                                <div class="shop-header-pic">
                                    <img src="/images/mobile/shop_top_con_{{ $group_info['shop_header_style']->value }}.png" />
                                </div>
                            </div>


                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}" />
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary hide" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "shopconfigmodel-shop_header_style", "name": "ShopConfigModel[shop_header_style]", "attribute": "shop_header_style", "rules": {"string":true,"messages":{"string":"头部样式必须是一条字符串。"}}},{"id": "shopconfigmodel-shop_header_style", "name": "ShopConfigModel[shop_header_style]", "attribute": "shop_header_style", "rules": {"required":true,"messages":{"required":"头部样式不能为空。"}}},]
</script>
<script type="text/javascript">
    //
</script>


<script src="/assets/d2eace91/min/js/validate.min.js"></script>
<script src="/assets/d2eace91/min/js/upload.min.js"></script>

<script>
    $().ready(function() {
        var validator = $("#ShopConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            $(this).addClass('loading');
            validator.form();
            if (!validator.form()) {
                return;
            }
            layer.closeAll('page');
            $.loading.start();
            var data = $("#ShopConfigModel").serializeJson();
            $.post('/shop/config/index', data, function(result) {
                $.get('ref-shop-header', {
                    code: 'shop_header_style',
                    group: 'm_shop_header'
                }, function(result) {
                    if (result.code == 0) {
                        $('.SZY-SHOP-HEADER').html(result.data);
                    }
                }, 'json');
                $.msg(result.message);
            }, 'json').always(function(){
                $.loading.stop();
            });
        });
        $('body').on('click', '.SZY-SHOP-HEAD-STYLE', function() {
            var val = $(this).data('val');
            $(this).addClass('shop-layout-current').siblings().removeClass('shop-layout-current');
            $('.shop-header-pic img').attr('src', '/images/mobile/shop_top_con_' + (val) + '.png');
            $('#shopconfigmodel-shop_header_style').val(val);
        });
    });
</script>
