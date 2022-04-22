{{--模板继承--}}
@extends('layouts.store_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/" method="post">
            <input type="hidden" name="_csrf" value="KA-jeaRG054KtQi7xp8OMZinLJW1LTyzbkJ6bTjikn1OXtYo3CKKrXvYZfiWpztF6tdByuVFcfEqCA0eQLbDNA==">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" name="keyword" class="form-control" placeholder="商品ID/商品名称" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品品牌：</span>
                    </label>
                    <div class="form-control-wrap"><select class="form-control chosen-select" name="brand_id">
                            <option value="">--请选择品牌--</option>
                            <option value="1">乐视</option>
                            <option value="2">创维</option>
                            <option value="3">飞利浦</option>
                            <option value="4">海信</option>
                            <option value="5">美的</option>
                            <option value="6">奥克斯</option>
                            <option value="7">飞科</option>
                            <option value="8">华帝</option>
                            <option value="9">迪加伦</option>
                            <option value="10">苏泊尔</option>
                            <option value="11">二十一世纪出版社</option>
                            <option value="12">小米</option>
                            <option value="13">明天出版社</option>
                            <option value="14">华为</option>
                            <option value="15">iphone</option>
                            <option value="16">博集天卷</option>
                            <option value="17">HTC</option>
                            <option value="18">oppo</option>
                            <option value="19">磨铁图书</option>
                            <option value="20">三星</option>
                            <option value="21">清华大学出版社</option>
                            <option value="22">魅族</option>
                            <option value="23">机械工业出版社</option>
                            <option value="24">联想</option>
                            <option value="25">人民邮电出版社</option>
                            <option value="26">戴尔</option>
                            <option value="27">vivo</option>
                            <option value="28">汤臣倍健</option>
                            <option value="29">宏碁</option>
                            <option value="30">惠普</option>
                            <option value="31">清华同方</option>
                            <option value="32">华硕</option>
                            <option value="33">爱仕达</option>
                            <option value="34">好事达</option>
                            <option value="35">雷蛇</option>
                            <option value="36">博洋家纺</option>
                            <option value="37">富安娜</option>
                            <option value="38">罗莱</option>
                            <option value="39">世家洁具</option>
                            <option value="40">得力</option>
                            <option value="41">慧乐家</option>
                            <option value="42">金喇叭</option>
                            <option value="43">友臣</option>
                            <option value="44">美好家</option>
                            <option value="45">ONLY</option>
                            <option value="46">伊莲娜</option>
                            <option value="47">猫城</option>
                            <option value="48">韩都衣舍</option>
                            <option value="49">欧司朗</option>
                            <option value="50">稻香村</option>
                            <option value="51">妖精的口袋</option>
                            <option value="52">全友家居</option>
                            <option value="53">花花公子</option>
                            <option value="54">乐事</option>
                            <option value="55">澳优</option>
                            <option value="56">罗蒙</option>
                            <option value="57">茅台</option>
                            <option value="58">NUK</option>
                            <option value="59">强生</option>
                            <option value="60">七匹狼</option>
                            <option value="61">古井贡</option>
                            <option value="62">雀巢</option>
                            <option value="63">战地吉普</option>
                            <option value="64">大洋世家</option>
                            <option value="65">雅培</option>
                            <option value="66">多美</option>
                            <option value="67">安奈儿</option>
                            <option value="68">乐高</option>
                            <option value="69">湾仔码头</option>
                            <option value="70">十月妈咪</option>
                            <option value="71">铭佳童话</option>
                            <option value="72">帮宝适</option>
                            <option value="73">好奇</option>
                            <option value="74">Hipp</option>
                            <option value="75">亨氏</option>
                            <option value="76">雅诗兰黛</option>
                            <option value="77">布朗博士</option>
                            <option value="78">法国兰蔻</option>
                            <option value="79">美孚</option>
                            <option value="80">道达尔</option>
                            <option value="81">妈咪宝贝</option>
                            <option value="82">olay</option>
                            <option value="83">汉高</option>
                            <option value="84">相宜本草</option>
                            <option value="85">百立乐</option>
                            <option value="86">ZA</option>
                            <option value="87">壳牌</option>
                            <option value="88">捷安特</option>
                            <option value="89">韩束</option>
                            <option value="90">乔山</option>
                            <option value="91">法兰琳卡</option>
                            <option value="92">信乐</option>
                            <option value="93">嘉实多</option>
                            <option value="94">温碧泉</option>
                            <option value="95">福斯</option>
                            <option value="96">威尔胜</option>
                            <option value="97">诺可文</option>
                            <option value="98">沙宣</option>
                            <option value="99">斯伯丁</option>
                            <option value="100">潘婷</option>
                            <option value="101">欧亚马</option>
                            <option value="102">火枫</option>
                            <option value="103">飘柔</option>
                            <option value="104">中极星</option>
                            <option value="105">达芙妮</option>
                            <option value="106">361°</option>
                            <option value="107">卡饰社</option>
                            <option value="108">卓诗尼</option>
                            <option value="109">他她</option>
                            <option value="110">纳迪亚N+a</option>
                            <option value="111">UGG</option>
                            <option value="112">百丽</option>
                            <option value="113">双星</option>
                            <option value="114">耐克</option>
                            <option value="115">骆驼</option>
                            <option value="116">李宁</option>
                            <option value="117">鸿星尔克</option>
                            <option value="118">米其林</option>
                            <option value="119">特步</option>
                            <option value="120">安踏</option>
                            <option value="121">puma</option>
                            <option value="122">稻草人</option>
                            <option value="123">古奇</option>
                            <option value="124">欧米茄</option>
                            <option value="125">浪琴</option>
                            <option value="126">天梭</option>
                            <option value="127">格力</option>
                            <option value="128">海尔</option>
                            <option value="129">老板</option>
                            <option value="130">苹果</option>
                            <option value="131">罗技</option>
                            <option value="132">费列罗</option>
                            <option value="133">伊利</option>
                            <option value="134">十月稻田</option>
                            <option value="135">艺福堂</option>
                            <option value="136">拉菲</option>
                            <option value="137">洋河酒厂</option>
                            <option value="138">梦妆</option>
                            <option value="139">迪奥</option>
                            <option value="140">香奈儿</option>
                            <option value="141">卡文克莱</option>
                            <option value="142">乔曼帝</option>
                            <option value="143">安睡宝</option>
                            <option value="144">奔腾</option>
                            <option value="145">三菱电机</option>
                            <option value="146">三洋电池</option>
                            <option value="147">三只松鼠</option>
                            <option value="148">鲜农乐</option>
                            <option value="149">.</option>
                            <option value="150">ロケット石鹸</option>
                            <option value="151">M·S·U/真想您</option>
                            <option value="152">潤佳</option>
                            <option value="153">669</option>
                            <option value="154">内斯蒂·丹特</option>
                            <option value="155">德·亿龙</option>
                            <option value="156">M·LEAD/摩兰迪</option>
                            <option value="157">1000Billion</option>
                            <option value="158">365ROSE/365朵玫瑰</option>
                            <option value="159">MENOW/美·诺</option>
                            <option value="160">3097</option>
                            <option value="161">咔咪咔咪</option>
                            <option value="162">Schuhmann Beautiful/舒曼·佳</option>
                            <option value="163">yesland 雅熙·莱帝</option>
                            <option value="164">1320/一生爱你</option>
                            <option value="165">383</option>
                            <option value="166">900</option>
                            <option value="167">500Year</option>
                            <option value="168">1900</option>
                            <option value="169">咪啵</option>
                            <option value="170">198ZCORY</option>
                            <option value="171">1825</option>
                            <option value="172">柏梭</option>
                            <option value="173">浪漫之花</option>
                            <option value="174">Suamgy/圣芝</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="button" id="btn_search" value="搜索" class="btn btn-primary m-r-5" />
            </div>
        </form>
    </div>
    <!--显示内容-->
    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>网点商品列表</h3>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>

    {{--引入列表--}}
    @include('goods.list.partials._list')

@stop

{{--extra html block--}}
@section('extra_html')

@stop

{{--script page元素内--}}
@section('script')
    <div id="goodspicker_container"></div>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();
            $("#add_goods").click(function() {
                $.modal({
                    title: "关联商品",
                    width: 800,
                    params: {
                        tablelist: tablelist
                    },
                    ajax: {
                        url: "/goods/load-picker",
                    }
                });
            });

            $("body").on("click", ".edit", function() {
                var id = $(this).data("id");

                if ($.modal($(this))) {
                    $.modal($(this)).show();
                } else {
                    $.modal({
                        title: "修改商品",
                        width: 850,
                        trigger: this,
                        params: {
                            tablelist: tablelist
                        },
                        ajax: {
                            url: "/goods/edit",
                            data: {
                                id: id
                            }
                        }
                    });
                }
            });

            $("body").on("click", ".del", function() {

                var id = $(this).data("id");

                $.confirm("您确定要删除此商品吗？", function() {

                    $.post("/goods/delete", {
                        goods_ids: [id]
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, "JSON");
                });

            });

            /**
             $("body").on("click", ".edit-goods-number", function() {
			var goods_ids = tablelist.checkedValues();

			if (goods_ids.length == 0) {
				$.msg("请选择你要操作的商品");
				return;
			}

			var modal = $.modal($(this));

			if (modal) {
				modal.params.goods_ids = goods_ids;
				modal.show();
			} else {
				$.modal({
					title: "修改商品",
					width: 400,
					trigger: this,
					params: {
						tablelist: tablelist,
						goods_ids: goods_ids
					},
					ajax: {
						url: '/goods/edit-goods-number'
					}
				});
			}
		});
             **/
            $("#btn_search").click(function() {
                var data = $("#searchForm").serializeJson();
                tablelist.load(data);
            })
        });
    </script>
@stop




{{--footer script page元素同级下面--}}
@section('footer_script')

@stop