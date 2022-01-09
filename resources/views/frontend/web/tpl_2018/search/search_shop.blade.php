@extends('layouts.base')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->
    <script src="/frontend/js/index.js?v=20180528"></script>
    <script src="/frontend/js/tabs.js?v=20180528"></script>
    <script src="/frontend/js/bubbleup.js?v=20180528"></script>
    <script src="/frontend/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/frontend/js/index_tab.js?v=20180528"></script>
    <script src="/frontend/js/jump.js?v=20180528"></script>
    <script src="/frontend/js/nav.js?v=20180528"></script>
@stop



@section('content')

    <!-- 内容 -->
    <link type="text/css" rel="stylesheet" href="/frontend/css/shop_street.css" />
    <div class="w1210">
        <div id="filter">
            <!--排序-->
            <form method="GET" name="listform" action="search">
                <div class="fore1">
                    <dl class="order">
                        <dd class="first curr">
                            <a href="search.html?sort=shop_sort&amp;order=ASC&amp;keyword=九&type=1">
                                默认
                                <b class="icon-order-DESCending"></b>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="search.html?sort=sale_num&amp;order=ASC&amp;keyword=九&type=1">
                                销量
                                <b class="icon-order-DESCending"></b>
                            </a>
                        </dd>
                    </dl>
                    <dl class="shop-name">
                        <dt>店铺名称：</dt>
                        <dd>
                            <input type="text" placeholder="" name="keyword" />
                            <input type='hidden' name='type' value="1">
                            <input type="submit" class="btn" value="搜索" />
                        </dd>
                    </dl>
                </div>
            </form>
        </div>
        <div class="main">
            <div class="shop-list-wall">

                <div class="shop">
                    <div class="shop-info">
                        <div class="shop-tit">
                            <a href="shop/1.html" target="_blank" title="">
                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/images/2018/05/21/15268766093993.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="shop-logo">
                            </a>
                            <div class="detail">
                                <a href="shop/1.html" target="_blank" title="">
                                    <p class="shop-name">九尘教</p>
                                </a>

                                <p class="shop-rank">
                                    <img src="http://images.68mall.com/system/credit/2016/06/07/14653016855399.gif?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" title="四星" />
                                </p>

                                <p class="shop-extend">
                                    <label>卖家：</label>
                                <div class="extend-right">
                                    <a href="shop/1.html" target="_blank" title="">
                                        <span class="btn-link">测试店铺</span>
                                    </a>
                                    <!-- -->
                                    <span class="ww-light">

									<!-- s等于1时带文字，等于2时不带文字 -->
<a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=zlww26837&site=cntaobao&s=2&groupid=0&charset=utf-8">
	<img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=zlww26837&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
	<span></span>
</a>

								</span>

                                </div>
                                </p>
                                <p class="like">
								<span>
									销量：
									<span class="num">26876</span>
								</span>
                                    <span>
									共
									<span class="num">64</span>
									件宝贝
								</span>
                                </p>
                                <div class="evaluate">
                                    <label>好评率：</label>
                                    <span>95%</span>
                                    <div class="item-icons">


                                        <img src="http://images.68mall.com/contract/2016/06/07/14653027251597.png?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="7天无理由退换货" title="7天无理由退换货"/>



                                        <img src="http://images.68mall.com/contract/2016/06/07/14653028223253.png?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="品质承诺" title="品质承诺"/>



                                        <img src="http://images.68mall.com/contract/2016/06/07/14653029228220.png?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="退货承诺" title="退货承诺"/>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="assess">
                            <li>
                                <p class="assess-name">描述相符</p>
                                <p class="assess-score ">
                                    <span class="average">4.52</span>
                                </p>
                            </li>
                            <li>
                                <p class="assess-name">服务态度</p>
                                <p class="assess-score ">
                                    <span class="average">3.33</span>
                                </p>
                            </li>
                            <li>
                                <p class="assess-name">发货速度</p>
                                <p class="assess-score ">
                                    <span class="average">3.00</span>
                                </p>
                            </li>
                        </ul>

                    </div>
                    <ul class="goods-wall">
                        <!-- -->
                        <li>
                            <a href="http://www.b2b2c.yunmall.68mall.com/goods-21.html" target="_blank" title="西班牙进口红酒浪漫之花桃红甜起泡酒葡萄酒750ml/瓶">
                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/42566859005/TB1wVs2MVXXXXcjaXXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" class="goods-pic">
                                <div class="mask">
                                    <span class="price">￥49.00</span>
                                    <span class="sell">销量 12960</span>
                                </div>
                            </a>
                        </li>
                        <!-- -->
                        <li>
                            <a href="http://www.b2b2c.yunmall.68mall.com/goods-63.html" target="_blank" title="法国原瓶进口红酒浪漫之花干红葡萄酒单支750ml/瓶">
                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/36494372594/TB18E84OpXXXXXTapXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" class="goods-pic">
                                <div class="mask">
                                    <span class="price">￥35.00</span>
                                    <span class="sell">销量 5262</span>
                                </div>
                            </a>
                        </li>
                        <!-- -->
                        <li>
                            <a href="http://www.b2b2c.yunmall.68mall.com/goods-124.html" target="_blank" title="Zespri佳沛新西兰阳光金奇异果10个81-105g">
                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/532614404434/TB1TWC6NXXXXXXlXVXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" class="goods-pic">
                                <div class="mask">
                                    <span class="price">￥72.45</span>
                                    <span class="sell">销量 3434</span>
                                </div>
                            </a>
                        </li>
                        <!-- -->
                        <li>
                            <a href="http://www.b2b2c.yunmall.68mall.com/goods-118.html" target="_blank" title="百雀羚 爽肤水 水嫩倍现盈透精华水100ml  补水保湿">
                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/13723028897/TB12w0DHpXXXXX_apXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" class="goods-pic">
                                <div class="mask">
                                    <span class="price">￥65.00</span>
                                    <span class="sell">销量 2253</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>

                <!-- 没有搜索结果的展示 -->

            </div>
            <div class="pull-right page-box">



                <div id="pagination" class="page">
                    <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":20,"page_size_list":[10,50,100,500,1000],"record_count":1,"page_count":1,"offset":0,"url":null,"sql":null}
</script>
                    <div class="page-wrap fr">
                        <div class="total">共1条记录
                            <!-- 每页显示：
                            <select class="select m-r-5" data-page-size="20">


                                <!--<option value="10">10</option>-->



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
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                page_mode: 2
            });
        });
    </script>

@stop