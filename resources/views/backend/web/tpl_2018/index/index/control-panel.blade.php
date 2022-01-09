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
                <a href="#" class="close" data-dismiss="alert"> &times; </a>
                <strong>警告！</strong>
                您的商城使用期限
                <a class="alert-href" href="javascript:;">还剩 7129 天</a>
                ；逾期未续费的商城将自动被打烊。（系统当前版本：
                <a class="alert-href" href="javascript:;">{{ config('version.version') }}</a>
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
                            <img src="/backend/images/default/admin.jpg">
                        </a>
                        <a class="c-blue" href="javascript:;">{{ $admin->adminRole->role_name ?? '' }}</a>
                    </div>
                    <div class="user-message">
                        <h5>
                            欢迎您，
                            <strong>{{ $admin->real_name }}</strong>
                        </h5>
                        <span class="time">（2018-03-16 ~ 2038-01-19）</span>
                        <span>
							独立域名：
																																	<a class="btn btn-sm btn-warning" onclick="bind()">去绑定</a>

						</span>
                        <div class="data">
                            <dl>
                                <dt>店铺数量</dt>
                                <dd>
                                    <strong>{{ $shop_total }}</strong>
                                    /&nbsp;
                                    <font>不限</font>
                                </dd>
                            </dl>
                            <dl>
                                <dt>网点数量</dt>
                                <dd>
                                    <strong>{{ $store_total }}</strong>
                                    /&nbsp;
                                    <font>不限</font>
                                </dd>
                            </dl>
                            <dl>
                                <dt>会员数量</dt>
                                <dd>
                                    <strong>{{ $user_total }}</strong>
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
								<a class="c-blue" href="http://{{ env('FRONTEND_DOMAIN') }}" target="_blank">{{ env('FRONTEND_DOMAIN') }}</a>
							</span>
                        </li>
                        <li>
                            WAP首页：
                            <span>
								<a class="c-blue" href="http://{{ env('MOBILE_DOMAIN') }}" target="_blank">{{ env('MOBILE_DOMAIN') }}</a>
							</span>
                        </li>
                        <li>
                            卖家后台：
                            <span>
								<a class="c-blue" href="http://{{ env('SELLER_DOMAIN') }}" target="_blank">{{ env('SELLER_DOMAIN') }}</a>
							</span>
                        </li>
                        <!--   -->
                        <li>
                            网点后台：
                            <span>
								<a class="c-blue" href="http://{{ env('STORE_DOMAIN') }}" target="_blank">{{ env('STORE_DOMAIN') }}</a>
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
            <div class="table-content"  id="div_1">
                <div class="scroll-info" style="height:220px;">
                    <p>1、为商城绑定独立域名之前，请确保域名已经完整备案，以免绑定后影响系统正常访问！！</p>
                    <p>2、请对您的域名进行CNAME解析，解析方式如下<a class="c-red" href="http://help.laravelvip.com/info/137.html" target="_blank">（猛戳这里！！！）</a>：</p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“www(或者其他前缀，例如：shop、mall、index等)”做CNAME解析跳转到“www.b2b2c.yunmall.laravelvip.com”</br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“backend”做CNAME解析跳转到“{{ env('BACKEND_DOMAIN') }}”</br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“seller”做CNAME解析跳转到“{{ env('SELLER_DOMAIN') }}”</br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“store”做CNAME解析跳转到“{{ env('STORE_DOMAIN') }}”</br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“m”做CNAME解析跳转到“{{ env('MOBILE_DOMAIN') }}”</br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将“api”做CNAME解析跳转到“{{ env('API_DOMAIN') }}”
                </div>
                <div class="text-c"><a class="btn btn-primary" onclick="next()">下一步</a></div>
            </div>

            <!--第二步-->
            <div class="table-content m-t-30" id="div_2"  style="display:none">
                <form class="form-horizontal">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="text4" class="col-sm-4 control-label">
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">
                                    <input class="form-control" type="text" id="domain"/>
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
            <div class="table-content"  id="div_3" style="margin-top:70px; display:none">
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