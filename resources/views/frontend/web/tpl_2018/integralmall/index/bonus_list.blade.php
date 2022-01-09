@extends('layouts.base')

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->

@stop



@section('content')

    <!-- 内容 -->
    <link rel="stylesheet" href="/frontend/css/exchange.css?v=20180428"/>
    <div class="w1210">
        <div class="breadcrumb clearfix">
            <a href="/" class="index">首页</a>
            <span class="crumbs-arrow">&gt;</span>
            <a href="/integralmall.html" class="index">积分商城</a>
            <span class="crumbs-arrow">&gt;</span>
            <span class="last">红包兑换</span>
        </div>
        <div class="main">

            <div class="main" id="table_list">
                <div id="filter">
                    <form method="GET" name="listform" action="category.php">
                        <div class="fore1">
                            <dl class="order">
                                <dd class="first curr">
                                    <a href="bonus-list.html">默认排序</a>
                                </dd>
                                <dd class="">
                                    <a href="bonus-list.html?sort_amount=desc">
                                        红包面值
                                        <b class="icon-order-DESCending"></b>
                                    </a>
                                </dd>
                            </dl>
                            <div class="pagin">

                                <a class="prev disabled">
                                    <span class="icon prev-disabled"></span>
                                </a>


                                <span class="text">
								<font class="color">1</font>
								/

								1

							</span>

                                <a class="next disabled" href="javascript:;">
                                    <span class="icon next-disabled"></span>
                                </a>

                            </div>
                            <div class="total">
                                共
                                <span class="color">3</span>
                                个红包
                            </div>
                        </div>
                    </form>
                </div>
                <!-- -->
                <div class="hot-bonus hot-bonus-box">
                    <div class="hot-bonus-list">
                        <div class="hot-bonus-con">

                            <div class="item first">
                                <div class="item-left">
                                    <p class="price">
                                        <em>￥</em>
                                        <strong class="num">50.00</strong>
                                    </p>
                                    <p class="row">
                                        使用条件：

                                        满399.00元可用

                                    </p>
                                    <p class="row issuer">发行方：阿迪达斯旗舰店</p>
                                    <p class="row">
                                        限品类：


                                        全店通用


                                    </p>
                                    <p class="row">发行数量：1000</p>
                                    <p class="row">使用有效期：2018-04-17 ~ 2018-12-31</p>
                                </div>
                                <div class="item-right">
                                    <b class="semi-circle"></b>
                                    <div class="item-right-con">
                                        <p class="exchange">
                                            <strong>500</strong>
                                            <em>积分</em>
                                        </p>
                                        <p>红包兑换有效期</p>
                                        <p class="time">不限</p>

                                        <a href="javascript:void(0);" class="receive">
                                            <span class="txt bonus-exchange" data-id="8" data-points="500">立即兑换</span>
                                        </a>

                                        <p class="send_number">1人兑换</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item ">
                                <div class="item-left">
                                    <p class="price">
                                        <em>￥</em>
                                        <strong class="num">10.00</strong>
                                    </p>
                                    <p class="row">
                                        使用条件：

                                        红包使用条件不限

                                    </p>
                                    <p class="row issuer">发行方：尚客联盟采购平台</p>
                                    <p class="row">
                                        限品类：


                                        全店通用


                                    </p>
                                    <p class="row">发行数量：10</p>
                                    <p class="row">使用有效期：2017-06-29 ~ 2018-11-28</p>
                                </div>
                                <div class="item-right">
                                    <b class="semi-circle"></b>
                                    <div class="item-right-con">
                                        <p class="exchange">
                                            <strong>100</strong>
                                            <em>积分</em>
                                        </p>
                                        <p>红包兑换有效期</p>
                                        <p class="time">不限</p>

                                        <a href="javascript:void(0);" class="receive">
                                            <span class="txt bonus-exchange" data-id="2" data-points="100">立即兑换</span>
                                        </a>

                                        <p class="send_number">0人兑换</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item first">
                                <div class="item-left">
                                    <p class="price">
                                        <em>￥</em>
                                        <strong class="num">5.00</strong>
                                    </p>
                                    <p class="row">
                                        使用条件：

                                        红包使用条件不限

                                    </p>
                                    <p class="row issuer">发行方：尚客联盟采购平台</p>
                                    <p class="row">
                                        限品类：


                                        全店通用


                                    </p>
                                    <p class="row">发行数量：10</p>
                                    <p class="row">使用有效期：2017-06-29 ~ 2018-11-28</p>
                                </div>
                                <div class="item-right">
                                    <b class="semi-circle"></b>
                                    <div class="item-right-con">
                                        <p class="exchange">
                                            <strong>50</strong>
                                            <em>积分</em>
                                        </p>
                                        <p>红包兑换有效期</p>
                                        <p class="time">不限</p>

                                        <a href="javascript:void(0);" class="receive">
                                            <span class="txt bonus-exchange" data-id="1" data-points="50">立即兑换</span>
                                        </a>

                                        <p class="send_number">0人兑换</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="pagination" class="page">
                        <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,100,500,1000],"record_count":3,"page_count":1,"offset":0,"url":null,"sql":null}
</script>
                        <div class="page-wrap fr">
                            <div class="total">共3条记录
                                <!-- 每页显示：
                                <select class="select m-r-5" data-page-size="10">


                                    <!--<option value="10" selected="selected">10</option>-->



                                <!--<option value="50">50</option>-->



                                <!--<option value="100">100</option>-->



                                <!--<option value="500">500</option>-->



                                <!--<option value="1000">1000</option>-->


                                <!--</select>
                                条 -->

                            </div>
                        </div>
                        <div class="page-num fr">
		<span class="num prev disabled"class="disabled" style="display: none;">
			<a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
		</span>

                            <span >
			<a class="num prev disabled " title="上一页">上一页</a>
		</span>








                            <!--   -->

                            <span class="num curr">
			<a data-cur-page="1">1</a>
		</span>







                            <span class="disabled" style="display: none;">
			<a class="num " class="fa fa-angle-double-right" data-go-page="1" title="最后一页"></a>
		</span>

                            <span >
			<a class="num next disabled" title="下一页">下一页</a>
		</span>

                        </div>
                        <!-- <div class="pagination-goto">
                                <input class="ipt form-control goto-input" type="text">
                                <button class="btn btn-default goto-button" title="点击跳转到指定页面">GO</button>
                                <a class="goto-link" data-go-page="" style="display: none;"></a>
                            </div> -->
                        <script type="text/javascript">
                            $().ready(function() {
                                $(".pagination-goto > .goto-input").keyup(function(e) {
                                    $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                                    if (e.keyCode == 13) {
                                        $(".pagination-goto > .goto-link").click();
                                    }
                                });
                                $(".pagination-goto > .goto-button").click(function() {
                                    var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                                    if ($.trim(page) == '') {
                                        return false;
                                    }
                                    $(".pagination-goto > .goto-link").attr("data-go-page", page);
                                    $(".pagination-goto > .goto-link").click();
                                    return false;
                                });
                            });
                        </script>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>
    <script type="text/javascript">
        $().ready(function() {

            var tablelist = $("#table_list").tablelist();

            $(".prev-page").click(function() {
                tablelist.prePage();
            });

            $(".next-page").click(function() {
                tablelist.nextPage();
            });

            $("body").on("click", ".bonus-exchange", function() {
                var id = $(this).data("id");
                var points = $(this).data("points");
                var current = $(this);

                $.confirm("兑换此红包，将需要扣除您 " + points + " 积分，您确定是否兑换？", function() {
                    $.ajax({
                        type: "POST",
                        url: "/integralmall/index/bonus-exchange",
                        dataType: "json",
                        data: {
                            id: id
                        },
                        success: function(result) {
                            if (result.code == 0) {
                                current.parent().next().html(result.send_number + "人兑换");
                            }
                            $.msg(result.message);
                        }
                    })
                });
            });
        });
    </script>

@stop