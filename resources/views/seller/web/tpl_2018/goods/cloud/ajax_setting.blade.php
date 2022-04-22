<form id="SettingModel" class="form-horizontal" name="SettingModel" action="/goods/cloud/ajax-setting.html" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="HveN6rJqvNXzeDYSsP4Kfr97wids-mNRlKk_29hClUVOhOqS3yLFgKkcAFryi19T5UuERRqPBB768Ge0jh3yEg==">
    <div class="modal-body" style="min-height: 100%; position: relative">
        <div class="table-content p-t-30 clearfix">

            <!-- 采集商品id -->

            <input type="hidden" id="settingmodel-goods_ids" class="form-control w500" name="SettingModel[goods_ids]" value="8">

            <!-- 是否采集评论 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="settingmodel-is_comment" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">采集评论：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SettingModel[is_comment]" value="0"><label><input type="checkbox" id="settingmodel-is_comment" class="form-control b-n" name="SettingModel[is_comment]" value="1" data-on-text="是" data-off-text="否"> </label>
                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是否采集评论，如果是，仅采集前5条记录</div></div>
                    </div>
                </div>
            </div>
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



                                <option value="604" disabled="true"><span>◢</span> 文学</option>



                                <option value="610" disabled="true">     <span>◢</span> 图书</option>



                                <option value="617" >          123</option>



                                <option value="271" >生鲜食品</option>



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



                                <option value="16" disabled="true"><span>◢</span> 2018</option>



                                <option value="21" disabled="true">     <span>◢</span> 5.22</option>



                                <option value="22" disabled="true">     <span>◢</span> 5.23</option>



                                <option value="135" >          针织衫</option>



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



                                <option value="269" disabled="true"><span>◢</span> 食品饮料</option>



                                <option value="278" disabled="true">     <span>◢</span> 进口食品</option>



                                <option value="283" >          进口牛奶</option>



                                <option value="284" >          巧克力</option>



                                <option value="609" >          LeiDaGou</option>



                                <option value="279" disabled="true">     <span>◢</span> 休闲食品</option>



                                <option value="287" >          肉干肉脯</option>



                                <option value="286" >          坚果炒货</option>



                                <option value="288" >          饼干蛋糕</option>



                                <option value="289" >          糖果/巧克力</option>



                                <option value="280" disabled="true">     <span>◢</span> 茗茶</option>



                                <option value="290" >          铁观音</option>



                                <option value="291" >          红茶</option>



                                <option value="292" >          绿茶</option>



                                <option value="293" >          乌龙茶</option>



                                <option value="281" disabled="true">     <span>◢</span> 饮料冲调</option>



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


                            </select>

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">选择采集的商品存入到商城的哪个商品类型下</div></div>
                    </div>
                </div>
            </div>
            <!-- 运费模板 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="settingmodel-freight_id" class="col-sm-3 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">运费模板：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <select id="settingmodel-freight_id" class="form-control m-r-5 freight-list w150" name="SettingModel[freight_id]">
                                <option value="">--请选择--</option>
                                <option value="0">店铺统一运费（￥0）</option>
                                <option value="17">全国配送</option>
                                <option value="18">肌肤恢复</option>
                                <option value="19">张掖市区</option>
                                <option value="40">zhangye</option>
                                <option value="42">西安新城区同城</option>
                                <option value="43">西安新城区同城</option>
                                <option value="55">56</option>
                                <option value="58">jpweixw</option>
                                <option value="59">jpweixw-全国</option>
                            </select>
                            <div class="btn-group m-r-2">
                                <button type="button" data-toggle="dropdown" aria-expanded="true" class="btn btn-warning btn-sm dropdown-toggle">
                                    新建运费模板
                                    <span class="caret m-l-5"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/shop/freight/add" target="_blank">新建全国模板</a>
                                    </li>
                                    <li>
                                        <a href="/shop/freight/map-add" target="_blank">新建同城模板</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm refresh-freight-list">重新加载</a>

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 店铺内商品分类 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="settingmodel-shop_cat_ids" class="col-sm-3 control-label">

                        <span class="ng-binding">店铺内商品分类：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <div class="control-label div-scroll" style="min-width: 200px; height: 160px;">

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="549">

                                    货品类型
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="560" class="cat-two">

                                    广货
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="561" class="cat-two">

                                    杭货
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="562" class="cat-two">

                                    欧货
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="563" class="cat-two">

                                    韩货
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="552">

                                    月份波段
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="553" class="cat-two">

                                    2018.5月第二波段
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="564" class="cat-two">

                                    2018.5月第三波段
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="565" class="cat-two">

                                    2018.5月第四波段
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="566" class="cat-two">

                                    2018.6月第一波段
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="567" class="cat-two">

                                    2018.6月第二波段
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="680" class="cat-two">

                                    441
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="555">

                                    家饰家品
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="568" class="cat-two">

                                    灯具类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="569" class="cat-two">

                                    挂饰摆件类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="570" class="cat-two">

                                    置物架类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="571" class="cat-two">

                                    椅子类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="572" class="cat-two">

                                    桌子类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="573" class="cat-two">

                                    柜子类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="574" class="cat-two">

                                    餐具类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="575" class="cat-two">

                                    香薰类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="576" class="cat-two">

                                    小家电类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="577" class="cat-two">

                                    家纺类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="578" class="cat-two">

                                    收纳类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="556">

                                    女装
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="558" class="cat-two">

                                    半裙类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="583" class="cat-two">

                                    连衣裙类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="584" class="cat-two">

                                    T恤类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="585" class="cat-two">

                                    长裤类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="586" class="cat-two">

                                    短裤类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="587" class="cat-two">

                                    衬衫类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="588" class="cat-two">

                                    内搭类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="589" class="cat-two">

                                    衬衫类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="590" class="cat-two">

                                    外套类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="591" class="cat-two">

                                    针织衫类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="592" class="cat-two">

                                    打底衫类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="593" class="cat-two">

                                    家居服类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="594" class="cat-two">

                                    皮草类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="595" class="cat-two">

                                    羽绒类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="596" class="cat-two">

                                    棉衣类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="597" class="cat-two">

                                    套装类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="598" class="cat-two">

                                    皮衣类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="599" class="cat-two">

                                    毛织类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="600" class="cat-two">

                                    大衣类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="601" class="cat-two">

                                    卫衣类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="557">

                                    美妆
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="579" class="cat-two">

                                    香皂手工皂
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="580" class="cat-two">

                                    化妆品类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="581" class="cat-two">

                                    美妆工具
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="582" class="cat-two">

                                    洗护类
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="602">

                                    服装配饰
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="603" class="cat-two">

                                    手套
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="604" class="cat-two">

                                    领带
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="605" class="cat-two">

                                    披肩
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="606" class="cat-two">

                                    斗篷
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="607" class="cat-two">

                                    腰封
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="608" class="cat-two">

                                    胸针
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="609" class="cat-two">

                                    皮带
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="610" class="cat-two">

                                    围巾
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="611" class="cat-two">

                                    袜子
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="612" class="cat-two">

                                    帽子
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="613" class="cat-two">

                                    眼镜
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="614" class="cat-two">

                                    戒指
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="615" class="cat-two">

                                    手链
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="616" class="cat-two">

                                    耳饰
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="617" class="cat-two">

                                    包包
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="618" class="cat-two">

                                    单鞋
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="619" class="cat-two">

                                    手表
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="622">

                                    化药生物
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="623" class="cat-two">

                                    麻黄碱
                                </label>

                                <label>

                                    <input type="checkbox" name="SettingModel[shop_cat_ids][]" value="679">

                                    温室配套系统
                                </label>

                            </div>

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
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180726"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180726"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180726"></script>
<script src="/assets/d2eace91/js/common.js?v=20180726"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "settingmodel-goods_ids", "name": "SettingModel[goods_ids]", "attribute": "goods_ids", "rules": {"required":true,"messages":{"required":"Goods Ids不能为空。"}}},{"id": "settingmodel-goods_category", "name": "SettingModel[goods_category]", "attribute": "goods_category", "rules": {"required":true,"messages":{"required":"放入商品分类不能为空。"}}},{"id": "settingmodel-goods_type", "name": "SettingModel[goods_type]", "attribute": "goods_type", "rules": {"required":true,"messages":{"required":"放入商品类型不能为空。"}}},{"id": "settingmodel-freight_id", "name": "SettingModel[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"运费模板不能为空。"}}},{"id": "settingmodel-is_comment", "name": "SettingModel[is_comment]", "attribute": "is_comment", "rules": {"required":true,"messages":{"required":"采集评论不能为空。"}}},]
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