<form id="SettingModel" class="form-horizontal" name="SettingModel" action="/goods/yun/ajax-setting.html" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="9NfznE7eKj8qIt20rpwB0Pd2eZEH2KerdIUnbJUY4P2C5YLqdplIVHsTkv6D73PmmyUP5mXrxdEl9h4h2GKWyw==">
    <div class="modal-body">
        <div class="table-content clearfix">

            <!-- 采集商品id -->

            <input type="hidden" id="settingmodel-goods_ids" class="form-control w500" name="SettingModel[goods_ids]" value="12">

            <!-- 是否采集评论 -->
            <!--<div class="simple-form-field" >
            <div class="form-group">
            <label for="settingmodel-is_comment" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">采集评论：</span>
            </label>
            <div class="col-sm-8">
            <div class="form-control-box">
            -->

            <!--<label class="control-label control-label-switch">
            <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
            <input type="hidden" name="SettingModel[is_comment]" value="0"><label><input type="checkbox" id="settingmodel-is_comment" class="form-control b-n" name="SettingModel[is_comment]" value="1" data-on-text="是" data-off-text="否"> </label>
            </div>
            </label>-->
            <input type="hidden" id="settingmodel-is_comment" class="form-control" name="SettingModel[is_comment]" value="0">

            <!--
            </div>

            <div class="help-block help-block-t"><div class="help-block help-block-t">是否采集评论，如果是，仅采集前5条记录</div></div>
            </div>
            </div>
            </div>-->
            <!-- 是否采集销量 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="settingmodel-is_sale" class="col-sm-4 control-label">

                        <span class="ng-binding">采集销量：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SettingModel[is_sale]" value="0"><label><input type="checkbox" id="settingmodel-is_sale" class="form-control b-n" name="SettingModel[is_sale]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是否采集第三方的销量</div></div>
                    </div>
                </div>
            </div>
            <!-- 价格变动 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">价格变动：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control m-r-10" name="SettingModel[price][sige]">
                                <option value="1">+</option>
                                <option value="2">-</option>
                                <option value="3">*</option>
                                <option value="4">/</option>

                            </select>
                            <input class="form-control ipt" placeholder="" name="SettingModel[price][num]" min="0" number="true" type="text" value="0">
                        </div>
                        <div class="help-block help-block-t">在数字前台填写[+ - * /]表示算法，如原价调高2倍，则写成*2</div>
                    </div>
                </div>
            </div>
            <!-- 库存变动 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">商品库存：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select class="form-control m-r-10" name="SettingModel[stock][sige]">
                                <option value="1">+</option>
                                <option value="2">-</option>
                                <option value="3">*</option>
                                <option value="4">/</option>

                            </select>
                            <input class="form-control ipt" placeholder="" name="SettingModel[stock][num]" type="text" value="0" data-rule-min="0" data-rule-digits="true">
                        </div>
                        <div class="help-block help-block-t">在数字前台填写[+ - * /]表示算法，如库存调高2倍，则写成*2</div>
                    </div>
                </div>
            </div>

            <!-- 所属分类 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="settingmodel-goods_category" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">放入商品分类：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="uploadmodel-category" name="SettingModel[goods_category]" class="chosen-select">


                                <option value="">-- 请选择 --</option>



                                <option value="604" disabled="true"><span>◢</span> 文化社区</option>



                                <option value="610" disabled="true">     <span>◢</span> 2018款自动四驱</option>



                                <option value="617" >          123</option>



                                <option value="271" >文化动态</option>



                                <option value="306" disabled="true">     <span>◢</span> 新鲜水果</option>



                                <option value="328" >          时令水果</option>



                                <option value="330" >          苹果</option>



                                <option value="332" >          奇异果</option>



                                <option value="333" >          大樱桃</option>



                                <option value="334" >          芒果</option>



                                <option value="336" >          梨</option>



                                <option value="337" >          桔</option>



                                <option value="338" >          柠檬</option>



                                <option value="307" disabled="true">     <span>◢</span> 海鲜水产</option>



                                <option value="340" >          虾</option>



                                <option value="342" >          蟹</option>



                                <option value="343" >          贝</option>



                                <option value="344" >          海参</option>



                                <option value="345" >          海产干货</option>



                                <option value="346" >          海产礼盒</option>



                                <option value="347" >          小龙虾</option>



                                <option value="348" >          三文鱼</option>



                                <option value="350" >          鳕鱼</option>



                                <option value="351" >          扇贝</option>



                                <option value="586" >           进口葡萄酒 </option>



                                <option value="308" disabled="true">     <span>◢</span> 猪牛羊肉</option>



                                <option value="352" >          牛肉</option>



                                <option value="353" >          羊肉</option>



                                <option value="354" >          猪肉</option>



                                <option value="355" >          牛排</option>



                                <option value="356" >          牛腩</option>



                                <option value="357" >          牛腱</option>



                                <option value="358" >          牛肉卷</option>



                                <option value="359" >          羊肉卷</option>



                                <option value="360" >          猪肘</option>



                                <option value="309" disabled="true">     <span>◢</span> 新鲜蔬菜</option>



                                <option value="361" >          叶菜类</option>



                                <option value="362" >          茄果瓜类</option>



                                <option value="364" >          鲜菌菇</option>



                                <option value="365" >          葱姜蒜椒</option>



                                <option value="366" >          半加工蔬菜</option>



                                <option value="310" disabled="true">     <span>◢</span> 速冻食品</option>



                                <option value="367" >          水饺</option>



                                <option value="368" >          汤圆</option>



                                <option value="369" >          面点</option>



                                <option value="370" >          火锅丸串</option>



                                <option value="371" >          方便菜</option>



                                <option value="372" >          奶酪</option>



                                <option value="373" >          黄油</option>



                                <option value="311" disabled="true">     <span>◢</span> 饮品甜品</option>



                                <option value="374" >          酸奶</option>



                                <option value="375" >          鲜奶</option>



                                <option value="376" >          冷冻蛋糕</option>



                                <option value="377" >          冰激凌</option>



                                <option value="16" disabled="true"><span>◢</span> 文化有约</option>



                                <option value="21" disabled="true">     <span>◢</span> 逛展览</option>



                                <option value="22" disabled="true">     <span>◢</span> 5.23</option>



                                <option value="143" >          短外套</option>



                                <option value="23" disabled="true">     <span>◢</span> 5.24</option>



                                <option value="152" >          连衣裙</option>



                                <option value="156" >          蕾丝连衣裙</option>



                                <option value="162" >          印花连衣裙</option>



                                <option value="213" >          真丝连衣裙</option>



                                <option value="222" >          半身裙</option>



                                <option value="26" disabled="true">     <span>◢</span> 5.26</option>



                                <option value="169" >          时尚气质套装</option>



                                <option value="177" >          休闲运动套装</option>



                                <option value="188" >          妈妈装夏款</option>



                                <option value="199" >          大码女装</option>



                                <option value="206" >          职业套装</option>



                                <option value="621" disabled="true">     <span>◢</span> 逛展览</option>



                                <option value="622" disabled="true">     <span>◢</span> 听讲座</option>



                                <option value="623" disabled="true">     <span>◢</span> 阅读会</option>



                                <option value="624" disabled="true">     <span>◢</span> 乐亲子</option>



                                <option value="625" disabled="true">     <span>◢</span> 公益电影</option>



                                <option value="626" disabled="true">     <span>◢</span> 精品剧目</option>



                                <option value="627" disabled="true">     <span>◢</span> 比赛</option>



                                <option value="628" disabled="true">     <span>◢</span> 场馆设施</option>



                                <option value="269" disabled="true"><span>◢</span> 文游成都</option>



                                <option value="278" disabled="true">     <span>◢</span> 主题游</option>



                                <option value="283" >          三国游</option>



                                <option value="284" >          武侯祠门票</option>



                                <option value="609" >          LeiDaGou</option>



                                <option value="279" disabled="true">     <span>◢</span> 周末游</option>



                                <option value="287" >          肉干肉脯</option>



                                <option value="286" >          坚果炒货</option>



                                <option value="288" >          蜀绣游玩</option>



                                <option value="289" >          成都博物馆门票</option>



                                <option value="280" disabled="true">     <span>◢</span> 周边</option>



                                <option value="290" >          穿越历史</option>



                                <option value="291" >          红茶</option>



                                <option value="292" >          绿茶</option>



                                <option value="293" >          乌龙茶</option>



                                <option value="281" disabled="true">     <span>◢</span> 在线游</option>



                                <option value="294" >          牛奶乳品</option>



                                <option value="295" >          饮料</option>



                                <option value="296" >          冲饮谷物</option>



                                <option value="282" disabled="true">     <span>◢</span> 粮油调味</option>



                                <option value="297" >          米面杂粮</option>



                                <option value="298" >          食用油</option>



                                <option value="299" >          调味品</option>



                                <option value="300" >          方便食品</option>



                                <option value="595" disabled="true"><span>◢</span>  饮料/酒水/冲饮</option>



                                <option value="596" disabled="true"><span>◢</span>  酒类 </option>



                                <option value="597" disabled="true"><span>◢</span>  白酒 </option>



                                <option value="598" disabled="true"><span>◢</span>  啤酒 </option>



                                <option value="599" disabled="true"><span>◢</span>  葡萄酒 </option>



                                <option value="600" disabled="true"><span>◢</span>  黄酒 </option>



                                <option value="601" disabled="true"><span>◢</span>  洋酒 </option>



                                <option value="602" disabled="true"><span>◢</span>  其他酒类 </option>



                                <option value="603" disabled="true"><span>◢</span>  保健酒 </option>



                                <option value="605" disabled="true"><span>◢</span> 教辅</option>



                                <option value="606" disabled="true"><span>◢</span> 畅销</option>



                                <option value="607" disabled="true"><span>◢</span>  接口抓取</option>



                                <option value="608" disabled="true"><span>◢</span>  进口商品</option>



                                <option value="614" disabled="true"><span>◢</span> 化药生物</option>



                                <option value="615" disabled="true">     <span>◢</span> 心血管</option>



                                <option value="616" >          进口药</option>



                                <option value="618" disabled="true"><span>◢</span> 办公文具</option>



                                <option value="619" disabled="true">     <span>◢</span> 书写工具</option>



                                <option value="620" >          中性笔</option>


                            </select>

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择采集的商品存入到商城的哪个商品分类下</div></div>
                    </div>
                </div>
            </div>
            <!-- 所属类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="settingmodel-goods_type" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">放入商品类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="uploadmodel-type" name="SettingModel[goods_type]" class="chosen-select">


                                <option value="">-- 请选择 --</option>



                                <option value="1">家用电器</option>



                                <option value="2">手机数码</option>



                                <option value="3">服饰鞋帽</option>



                                <option value="4">食品生鲜</option>



                                <option value="5">家居家纺</option>



                                <option value="6">汽车用品</option>



                                <option value="7">电子图书</option>



                                <option value="8">个护化妆</option>



                                <option value="9">家装建材</option>



                                <option value="10">生活日用</option>



                                <option value="11">化药生物</option>



                                <option value="12">0619</option>



                                <option value="13">88</option>


                            </select>

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择采集的商品存入到商城的哪个商品类型下</div></div>
                    </div>
                </div>
            </div>
            <!-- 系统产品库分类 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="settingmodel-lib_cat_ids" class="col-sm-4 control-label">

                        <span class="ng-binding">商品库商品分类：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <select id="libgoodsmodel-lib_cat_id" class="form-control chosen-select" name="SettingModel[lib_cat_ids]">


                                <option value="0"></option>



                                <option disabled="true" value="1">女装 内衣</option>



                                <option value="2">        卫衣</option>



                                <option value="3">        连衣裙</option>



                                <option value="4">        衬衫</option>



                                <option value="6">        外套</option>



                                <option value="7">        牛仔裤</option>



                                <option value="27">        测试</option>



                                <option disabled="true" value="8">男装 运动</option>



                                <option value="9">        外套</option>



                                <option value="10">        夹克</option>



                                <option value="11">        衬衫</option>



                                <option value="12">        西服</option>



                                <option value="13">        牛仔裤</option>



                                <option disabled="true" value="23">化妆品</option>



                                <option disabled="true" value="24">文学</option>



                                <option disabled="true" value="29">123</option>


                            </select>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 是否上架-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="settingmodel-goods_status" class="col-sm-4 control-label">

                        <span class="ng-binding">是否上架：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SettingModel[goods_status]" value="0"><label><input type="checkbox" id="settingmodel-goods_status" class="form-control b-n" name="SettingModel[goods_status]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">默认采集导入到产品中的商品是下架的</div></div>
                    </div>
                </div>
            </div>

            <!-- 计价方式 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="settingmodel-pricing_mode" class="col-sm-3 control-label">

                        <span class="ng-binding">计价方式：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="hidden" name="SettingModel[pricing_mode]" value=""><div id="settingmodel-pricing_mode" class="" name="SettingModel[pricing_mode]"><label class="control-label cur-p m-r-10"><input type="radio" name="SettingModel[pricing_mode]" value="0" checked> 计件</label>
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SettingModel[pricing_mode]" value="1"> 计重</label></div>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">称重商品，请选择计重</div></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="modal-footer text-c pos-r">
        <input id="btn_submit" type="button" value="立即导入" class="btn btn-primary">
    </div>

</form>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
<script src="/assets/d2eace91/js/common.js?v=20180027"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "settingmodel-goods_ids", "name": "SettingModel[goods_ids]", "attribute": "goods_ids", "rules": {"required":true,"messages":{"required":"Goods Ids不能为空。"}}},{"id": "settingmodel-goods_category", "name": "SettingModel[goods_category]", "attribute": "goods_category", "rules": {"required":true,"messages":{"required":"放入商品分类不能为空。"}}},{"id": "settingmodel-goods_type", "name": "SettingModel[goods_type]", "attribute": "goods_type", "rules": {"required":true,"messages":{"required":"放入商品类型不能为空。"}}},{"id": "settingmodel-is_comment", "name": "SettingModel[is_comment]", "attribute": "is_comment", "rules": {"required":true,"messages":{"required":"采集评论不能为空。"}}},]
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#SettingModel").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            var json = $("#SettingModel").serializeJson()
            ajaxImport(json.SettingModel);
        });

// 刷新运费模板
        $(".refresh-freight-list").click(function() {
            $.loading.start();
            $.get('/goods/publish/freights', {}, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    var html = "<option value=''>--请选择--</option>";

                    for (var i = 0; i < result.data.length; i++) {
                        var item = result.data[i];
                        html += "<option value='"+item.freight_id+"'>" + item.title + "</option>";
                    }

                    $("#settingmodel-freight_id").html(html);
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json");
        });

    });
</script>