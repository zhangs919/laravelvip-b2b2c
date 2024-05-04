<div id="{{ $uuid }}" class="p-20">
    <!--温馨提示-->
    <form id="form2" class="form-horizontal" name="EditGoodsDo" action="/dashboard/multi-store/edit-multi-goods" method="POST">
        @csrf
        <div class="simple-form-field">
            <div class="form-group">
                <label class="col-sm-2 w120 control-label">批量设置价格：</label>
                <div class="col-sm-10">
                    <div class="form-control-box">
                        <input id="goods_price" class="form-control batch-value m-r-5 w60 start-num" type="text">
                        <span class="member_message  w20 disp-inlblock">元</span>
                        <a class="btn btn-primary batch-submit m-r-5 m-l-20" onclick="setValue('goods_price')">确定</a>
                        <a class="btn btn-default clear-all" onclick="clearValue('goods_price')">清空</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <div class="form-group">
                <label class="col-sm-2 w120 control-label">批量设置库存：</label>
                <div class="col-sm-10">
                    <div class="form-control-box">
                        <input id="goods_number" class="form-control batch-value m-r-5 w60 start-num" type="text">
                        <span class="member_message  w20 disp-inlblock">  </span>
                        <a class="btn btn-primary batch-submit m-r-5 m-l-20" onclick="setValue('goods_number')">确定</a>
                        <a class="btn btn-default clear-all" onclick="clearValue('goods_number')">清空</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-spec-user-rank-region" style="overflow-y: auto; max-height: 220px; width:800px; position: relative">
            <table class="table table-bordered table-spec w800">
                <tbody>
                <tr class="left-tr">
                    <td id="goods_id" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        商品ID
                        <!-- -->
                    </td>
                    <td id="goods_name" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        商品名称
                        <!-- -->
                    </td>
                    <td id="spec_name_guige" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        规格
                        <!-- -->
                    </td>
                    <td id="shop_prices" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        店铺价格（元）
                        <!-- -->
                    </td>
                    <td id="store_prices" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        门店价格（元）
                        <!-- -->
                    </td>
                    <td id="store_goods_number" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        门店库存
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="goods_id_71765" rowspan="17" colspan="1" class="" style="width: 180px; height: 50px;">
                        71765
                        <!-- -->
                    </td>
                    <td id="goods_name_71765" rowspan="17" colspan="1" class="" style="width: 180px; height: 50px;">
                        直播-火轮 冬季编织纹PU大毛口保暖情侣居家棉...
                        <!-- -->
                    </td>
                    <td id="spec_73332" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：44/45（适合42/43码）|颜色分类：蓝色
                        <!-- -->
                    </td>
                    <td id="sku_price_73332" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73332" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73332" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73332" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73332" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73332" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="82" data-sku-id="73332" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73333" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：42/43（适合40/41码）|颜色分类：棉棉煦香
                        <!-- -->
                    </td>
                    <td id="sku_price_73333" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73333" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73333" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73333" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73333" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73333" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="13" data-sku-id="73333" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73334" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：38/39（适合36/37码）|颜色分类：水蜜桃味
                        <!-- -->
                    </td>
                    <td id="sku_price_73334" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73334" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73334" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73334" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73334" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73334" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="14" data-sku-id="73334" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73335" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：38/39（适合36/37码）|颜色分类：纯净微风
                        <!-- -->
                    </td>
                    <td id="sku_price_73335" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73335" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73335" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73335" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73335" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73335" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="8" data-sku-id="73335" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73336" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：40/41（适合38/39码）|颜色分类：天蓝色
                        <!-- -->
                    </td>
                    <td id="sku_price_73336" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73336" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73336" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73336" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73336" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73336" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="10" data-sku-id="73336" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73337" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：40/41（适合38/39码）|颜色分类：水蜜桃味
                        <!-- -->
                    </td>
                    <td id="sku_price_73337" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73337" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73337" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73337" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73337" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73337" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="20" data-sku-id="73337" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73338" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：40/41（适合38/39码）|颜色分类：纯净微风
                        <!-- -->
                    </td>
                    <td id="sku_price_73338" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73338" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73338" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73338" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73338" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73338" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="8" data-sku-id="73338" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73339" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：40/41（适合38/39码）|颜色分类：粉红色
                        <!-- -->
                    </td>
                    <td id="sku_price_73339" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73339" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73339" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73339" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73339" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73339" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="8" data-sku-id="73339" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73340" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：46/47（适合44/45码）|颜色分类：蓝色
                        <!-- -->
                    </td>
                    <td id="sku_price_73340" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73340" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73340" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73340" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73340" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73340" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="18" data-sku-id="73340" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73341" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：42/43（适合40/41码）|颜色分类：蓝色
                        <!-- -->
                    </td>
                    <td id="sku_price_73341" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73341" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73341" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73341" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73341" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73341" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="4" data-sku-id="73341" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73342" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：38/39（适合36/37码）|颜色分类：天蓝色
                        <!-- -->
                    </td>
                    <td id="sku_price_73342" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73342" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73342" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73342" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73342" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73342" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="14" data-sku-id="73342" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73343" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：42/43（适合40/41码）|颜色分类：3.6紫黑色
                        <!-- -->
                    </td>
                    <td id="sku_price_73343" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73343" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73343" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73343" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73343" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73343" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="14" data-sku-id="73343" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73344" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：38/39（适合36/37码）|颜色分类：粉红色
                        <!-- -->
                    </td>
                    <td id="sku_price_73344" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73344" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73344" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73344" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73344" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73344" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="1" data-sku-id="73344" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73345" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：46/47（适合44/45码）|颜色分类：3.6紫黑色
                        <!-- -->
                    </td>
                    <td id="sku_price_73345" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73345" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73345" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73345" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73345" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73345" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="18" data-sku-id="73345" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73346" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：46/47（适合44/45码）|颜色分类：棉棉煦香
                        <!-- -->
                    </td>
                    <td id="sku_price_73346" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73346" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73346" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73346" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73346" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73346" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="22" data-sku-id="73346" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73347" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：44/45（适合42/43码）|颜色分类：棉棉煦香
                        <!-- -->
                    </td>
                    <td id="sku_price_73347" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73347" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73347" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73347" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73347" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73347" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="21" data-sku-id="73347" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="spec_73348" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        尺码：44/45（适合42/43码）|颜色分类：3.6紫黑色
                        <!-- -->
                    </td>
                    <td id="sku_price_73348" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        19.90
                        <!-- -->
                    </td>
                    <td id="store_sku_price_73348" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-73348" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="19.90" data-sku-id="73348" data-spu-id="71765">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_73348" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-73348" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="16" data-sku-id="73348" data-spu-id="71765">
                        <!-- -->
                    </td>
                </tr>
                <tr class="left-tr">
                    <td id="goods_id_72154" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        72154
                        <!-- -->
                    </td>
                    <td id="goods_name_72154" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        条纹睡衣
                        <!-- -->
                    </td>
                    <td id="spec_74264" rowspan="1" colspan="1" class="" style="width: 180px; height: 50px;">
                        无
                        <!-- -->
                    </td>
                    <td id="sku_price_74264" rowspan="1" colspan="1" class="sku_price" style="width: 180px; height: 50px;">
                        20.00
                        <!-- -->
                    </td>
                    <td id="store_sku_price_74264" rowspan="1" colspan="1" class="store_sku_price" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_price-74264" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_price" name="EditGoodsDo[store_sku_price]" value="20.00" data-sku-id="74264" data-spu-id="72154">
                        <!-- -->
                    </td>
                    <td id="store_sku_number_74264" rowspan="1" colspan="1" class="store_sku_number" style="width: 180px; height: 50px;">
                        <input type="text" id="store_sku_number-74264" class="form-control middle sm-height m-l-5 m-r-5 start-num store_sku_number" name="EditGoodsDo[store_sku_number]" value="10" data-sku-id="74264" data-spu-id="72154">
                        <!-- -->
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!--错误提示模块 star-->
        <div class="member-handle-error"></div>
        <!--错误提示模块 end-->
        <!-- 提交 -->
        <div class="m-t-30  text-c">
            <a id="btn_submit" class="btn btn-primary btn-lg">确认提交</a>
        </div>
    </form>
</div>
<script id="client_rules" type="text">
[{"id": "editgoodsdo-store_sku_number", "name": "EditGoodsDo[store_sku_number]", "attribute": "store_sku_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"价格/库存不正确"}}},{"id": "editgoodsdo-store_sku_price", "name": "EditGoodsDo[store_sku_price]", "attribute": "store_sku_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"价格/库存不正确","min":"门店价格必须不小于0.01。","max":"门店价格必须不大于9999999。"},"min":0.01,"max":9999999}},{"id": "editgoodsdo-store_sku_number", "name": "EditGoodsDo[store_sku_number]", "attribute": "store_sku_number", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"库存不正确","min":"门店库存必须不小于0。","max":"门店库存必须不大于9999999。"},"min":0,"max":9999999}}]
</script>
<script type="text/javascript">
    // 
</script>
<script>
    $().ready(function () {
        /**
         * 初始化validator默认值
         */
        var _errorPlacement = $.validator.defaults.errorPlacement;
        var _success = $.validator.defaults.success;
        $.validator.setDefaults({
            errorPlacement: function (error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");
                if (!error_msg && error_msg == "") {
                    return;
                }
                if ($(element).parents(".member-container").find(".member-handle-error").find("div").size() == 0) {
                    $(".member-handle-error").html("<div class='form-control-warning error m-t-10'></div>");
                }
                var error_dom = $("<p id='" + error_id + "'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></p>");
                $("#{{ $uuid }}").find(".member-handle-error").find("div").append(error_dom);
            },
            // 失去焦点验证
            onfocusout: function (element) {
                $(element).valid();
            },// 成功后移除错误提示
            success: function (error, element) {
                _success.call(this, error, element);
                $("#{{ $uuid }}").find('.form-control-warning').remove();
            }
        });


        var validator = $("#form2").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        // @hezhiqiang 多门店下是否显示库位码
        var isShowMultiStock = '';

        $("#{{ $uuid }}").find("#btn_submit").click(function () {
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            var price = new Array();
            var number = new Array();
            //价格
            $("#{{ $uuid }}").find(".store_sku_price").find("input").each(function () {
                var sku_obj = new Object();
                sku_obj['sku_id'] = $(this).data('sku-id');
                sku_obj['spu_id'] = $(this).data('spu-id');
                sku_obj['store_sku_price'] = $(this).val();
                price.push(sku_obj);
            });
            //库存
            $("#{{ $uuid }}").find(".store_sku_number").find("input").each(function () {
                var sku_obj = new Object();
                sku_obj['sku_id'] = $(this).data('sku-id');
                sku_obj['spu_id'] = $(this).data('spu-id');
                sku_obj['store_sku_number'] = $(this).val();
                number.push(sku_obj);
            });

            // @hezhiqiang 多门店下是否显示库位码
            if (isShowMultiStock){
                // 库位码
                var stock = [];
                // 库位码
                $("#{{ $uuid }}").find(".stock_code").find("input").each(function () {
                    var sku_obj = new Object();
                    sku_obj['sku_id'] = $(this).data('sku-id');
                    sku_obj['spu_id'] = $(this).data('spu-id');
                    sku_obj['stock_code'] = $(this).val();
                    stock.push(sku_obj);
                });
            }
            // 传递数据信息
            var data = {
                shop_id: {{ $shop_id }},
                store_id: {{ $store_id }},
                is_edit:1,
                spu_ids: "{{ $spu_ids }}",
                price: JSON.stringify(price),
                number: JSON.stringify(number),
            };

            // @hezhiqiang 多门店下是否显示库位码
            if (isShowMultiStock){
                data.stock = JSON.stringify(stock);
            }
            $.confirm("您确定要批量更新库存或价格吗？当前操作可能会花费很长时间而且请勿中断！", function() {
                $.progress({
                    type: 'POST',
                    url: 'edit-multi-goods',
                    key: 'batchedit:multistore:goods:price:stock:{{ $store_id }}',
                    data: data,
                    end: function(result){

                        $.msg("批量修改库存或价格成功！", {
                            time: 1500
                        }, function(){

                            if(typeof tablelist != 'undefined'){
                                tablelist.load();
                            }

                            $.closeAll();
                        });

                        if(result.code != 0){
                            $(target).removeClass("disabled");
                        }
                    }
                });
            }, function(){
                $(target).removeClass("disabled");
            });

        })
    })

    // 对应的类名
    var mapClazz = {
        // 批量设置价格
        'goods_price': 'store_sku_price',
        // 批量设置库存
        'goods_number': 'store_sku_number',
        // 批量设置库位码
        'stock_code': 'stock_code'
    };

    //批量设置
    function setValue(type) {
        // 对应的类名 @hezhiqiang 修改之前的模式改为map影射
        var clazz = mapClazz[type];
        if (clazz) {
            $("#{{ $uuid }}").find("." + clazz).val($("#{{ $uuid }}").find("#" + type).val());
        }
    }

    //清空
    function clearValue(type) {
        // 对应的类名
        var clazz = mapClazz[type];
        if (clazz) {
            $("#{{ $uuid }}").find("." + clazz).val('');
        }
    }

    // 
</script>