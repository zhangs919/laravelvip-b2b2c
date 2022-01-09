@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/backend/css/welcome.css?v=1.2">
@stop

@section('content')

    <div class="row">
        <!---->
        <div class="col-lg-12 col-sm-12">
            <div class="alert alert-warning animated fadeIn">
                <a href="#" class="close" data-dismiss="alert"> × </a>
                <strong>警告！</strong>
                您的商城使用期限
                <a class="alert-href" href="javascript:;">还剩 6 天</a>
                ；逾期未续费的商城将自动被打烊。（系统当前版本：
                <a class="alert-href" href="javascript:;">2.9</a>
                ）
            </div>
        </div>
        <!--左侧内容-->
        <div class="col-md-9" style="width:74%">
            <!--使用情况-->
            <div class="panel condition">
                <div class="col-md-7 left-info">
                    <div class="user-box m-r-15">
                        <a class="user-img">
                            <img src="http://{{ env('BACKEND_DOMAIN') }}/backend/images/default/admin.jpg">
                        </a>
                        <a class="c-blue" href="javascript:;">老板</a>
                    </div>
                    <div class="user-message">
                        <h5>
                            欢迎您，
                            <strong>13333333333</strong>
                        </h5>
                        <span class="time">（2018-02-15 ~ 2018-02-22）</span>
                        <span>
							独立域名：
																							<font class="c-999">请<a class="btn-link" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=sdfsdfsdfs" target="_blank">联系客服</a>升级套餐</font>

						</span>
                        <div class="data">
                            <dl>
                                <dt>店铺数量</dt>
                                <dd>
                                    <strong>1</strong>
                                    /&nbsp;
                                    <font>不限</font>
                                </dd>
                            </dl>
                            <dl>
                                <dt>网点数量</dt>
                                <dd>
                                    <strong>1</strong>
                                    /&nbsp;
                                    <font>1个</font>
                                </dd>
                            </dl>
                            <dl>
                                <dt>会员数量</dt>
                                <dd>
                                    <strong>3</strong>
                                    /&nbsp;
                                    <font>不限</font>
                                </dd>
                            </dl>

                        </div>
                    </div>
                </div>
            </div>
            <!--当日访问量-->
            <!--
            <div class="panel">
                <div class="panel-header">
                    <h3>当日访问量</h3>
                </div>

                <div class="panel-body ">

                    <img src="/images/default/fwj2.jpg">
                </div>

            </div>
            -->
            <!--套餐数据统计-->
            <div class="panel">
                <div class="panel-header">
                    <h3>套餐数据统计</h3>
                </div>

                <div class="panel-body ">


                    {{--引入列表--}}
                    @include('index.index.partials._store_list')



                </div>
            </div>
        </div>
        <!--中间内容-->
        <div class="col-md-3" style="width:26%">
            <!--商城管理-->
            <div class="panel">
                <div class="panel-header">
                    <h3>商城管理</h3>
                </div>
                <div class="panel-body shop-set">
                    <div class="stat-icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <ul>
                        <li>
                            商城首页：
                            <span>
								<a class="c-blue" href="http://www.laravelvip.com" target="_blank">www.laravelvip.com</a>
							</span>
                        </li>
                        <li>
                            WAP首页：
                            <span>
								<a class="c-blue" href="http://m.laravelvip.com" target="_blank">m.laravelvip.com</a>
							</span>
                        </li>
                        <li>
                            卖家后台：
                            <span>
								<a class="c-blue" href="http://seller.laravelvip.com" target="_blank">seller.laravelvip.com</a>
							</span>
                        </li>
                        <!--   -->
                        <li>
                            网点后台：
                            <span>
								<a class="c-blue" href="http://store.laravelvip.com" target="_blank">store.laravelvip.com</a>
							</span>
                        </li>

                    </ul>
                </div>
            </div>

            <!--第三方对接-->
            <div class="panel">
                <div class="panel-header">
                    <h3>第三方对接</h3>
                </div>
                <div class="panel-body">
                    <ul class="product-list">
                        <li>
                            <a href="http://www.yunchanpinku.com/" target="_blank" title="点击查看详情">
                                <i class="product-icon yunchanpingku"></i>
                                <div class="product-info">
                                    <h5>云产品库</h5>
                                    <p>数据无缝衔接，轻松告别手动录入商品时代</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.laravelvip.com/laravelvip_topic/yiwuliu/" target="_blank" title="点击查看详情">
                                <i class="product-icon sousou56"></i>
                                <div class="product-info">
                                    <h5>云物流</h5>
                                    <p>快速响应，自建物流+众包，闪电送达</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.laravelvip.com/laravelvip_topic/erp/" target="_blank" title="点击查看详情">
                                <i class="product-icon yierp"></i>
                                <div class="product-info">
                                    <h5>云ERP</h5>
                                    <p>使数据得以一致性，并提升其精确性</p>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="http://www.laravelvip.com/laravelvip_topic/cashsystem/" target="_blank" title="点击查看详情">
                                <i class="product-icon yishouyin"></i>
                                <div class="product-info">
                                    <h5>收银狗</h5>
                                    <p>商品数据、库存、订单线上线下一体化管理</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <!--客服中心-->
            <div class="panel">
                <div class="panel-header">
                    <h3>客服中心</h3>
                </div>
                <div class="panel-body customer-service">
                    <div class="stat-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <ul>
                        <li>
                            客服电话：
                            <span class="c-spe f14">400-123-4567</span>
                        </li>
                        <li>
                            客服 QQ：
                            <span>123456</span>
                        </li>
                        <li>
                            QQ交流群：
                            <span>123456789</span>
                        </li>
                        <li>
                            官方邮箱：
                            <span>kefu@laravelvip.com</span>
                        </li>
                        <li>
                            官方网址：
                            <span>
								<a class="c-blue" href="http://www.laravelvip.com" target="_blank">www.laravelvip.com</a>
							</span>
                        </li>
                        <li>
                            官方网址：
                            <span>
								<a class="c-blue" href="http://www.laravelvip.com" target="_blank">www.laravelvip.com</a>
							</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!--
            <div class="panel ad-box">
                <a href="javascript:;">
                    <img src="../../images/index/ad.png">
                </a>

            </div>
            -->
        </div>
    </div>

@stop

@section('extra_html')
    <!--绑定独立域名modal-->
    <!--添加标记-->
    <div id="bind" style="display:none">
        <div class="order-step">
            <!--完成步骤为dl添加current样式，完成操作内容后会显示完成时间-->
            <dl class="current step-first" id="step_1">
                <dt>查看提示</dt>
                <dd class="bg"></dd>
                <dd class="num">1</dd>
            </dl>
            <dl class="" id="step_2">
                <dt>提交信息</dt>
                <dd class="bg"></dd>
                <dd class="num">2</dd>
            </dl>
            <dl class="" id="step_3">
                <dt>等待审核</dt>
                <dd class="bg"></dd>
                <dd class="num">3</dd>
            </dl>
        </div>
        <div class="p-20">
            <!--第一步-->
            <div class="table-content" id="div_1">
                <div class="scroll-info" style="height:220px;">
                    <p>1、为商城绑定独立域名之前，请确保域名已经完整备案，以免绑定后影响系统正常访问！！</p>
                    <p>2、请对您的域名进行CNAME解析，解析方式如下<a class="c-red" href="http://help.laravelvip.com/info/137.html" target="_blank">（猛戳这里！！！）</a>：</p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“www(或者其他前缀，例如：shop、mall、index等)”做CNAME解析跳转到“www.laravelvip.com”<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“backend”做CNAME解析跳转到“backend.laravelvip.com”<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“seller”做CNAME解析跳转到“seller.laravelvip.com”<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“store”做CNAME解析跳转到“store.laravelvip.com”<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“m”做CNAME解析跳转到“m.laravelvip.com”<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“api”做CNAME解析跳转到“api.laravelvip.com”
                </div>
                <div class="text-c"><a class="btn btn-primary" onclick="next()">下一步</a></div>
            </div>

            <!--第二步-->
            <div class="table-content m-t-30" id="div_2" style="display:none">
                <form class="form-horizontal">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="text4" class="col-sm-4 control-label">
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">
                                    <input class="form-control" type="text" id="domain">
                                </div>
                                <div class="help-block help-block-t">
                                    <a href="javascript:void(0);">请填写您要绑定的域名<br>比如您的域名是www.xxx.com,则此处填写www.xxx.com即可</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-c m-t-30"><a class="btn btn-primary" onclick="forSub()">下一步</a></div>
                </form>
            </div>

            <!--第三步-->
            <div class="table-content" id="div_3" style="margin-top:70px; display:none">
                <div class="step-form-box">
                    <div class="operat-tips">您申请绑定的域名正在审核中...</div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({});
            tablelist.load();
        });
        function bind(){
            var bind = layer.open({
                type: 1,
                title: '绑定独立域名',
                skin: 'layui-layer-tip',
                closeBtn: 1, //不显示关闭按钮
                shade: 0.6,
                area: ['700px', '460px'],
                shift: 2,
                content: $('#bind'),
                move: false,
            });
        }
        function next(){
            $('#step_2').addClass('current');
            $('#div_1').hide();
            $('#div_2').show();
        }
        function forSub(){
            var domain = $('#domain').val();
            if(domain == '' || domain == null){
                $.alert('请填写有效域名！');
            }else{
                $.loading.start();
                $.post('/index/index/commit-domain',{
                    domain_new:domain
                },function(result){
                    if(result.code == 0){
                        $('#step_3').addClass('current');
                        $('#div_2').hide();
                        $('#div_3').show();
                    }
                    $.alert(result['message']);
                },'json').always(function() {
                    $.loading.stop();
                });
            }
        }
    </script>
@stop