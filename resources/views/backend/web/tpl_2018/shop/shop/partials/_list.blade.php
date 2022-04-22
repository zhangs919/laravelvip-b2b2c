<!--列表内容-->


<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w300" data-sortname="shop_name" data-sortorder="asc" style="cursor: pointer;">店铺信息<span class="sort"></span></th>
        <th class="text-c w100" data-sortname="user_name" data-sortorder="asc" style="cursor: pointer;">店主帐号<span class="sort"></span></th>
        <th class="text-c w90" data-sortname="credit" data-sortorder="asc" style="cursor: pointer;">店铺信誉<span class="sort"></span></th>
        <th class="w100" data-sortname="score" data-sortorder="asc" style="cursor: pointer;">店铺评分<span class="sort"></span></th>
        <th class="w120" data-sortname="end_time" data-sortorder="asc" style="cursor: pointer;">开店起止时间<span class="sort"></span></th>
        <th class="w120" data-sortname="" style="cursor: default;">店铺经营情况</th>
        <th class="w70 text-c" data-sortname="shop_sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
        <th class="w150" data-sortname="" style="cursor: pointer;">店铺状态</th>
        <th class="w120 handle" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
        <tr>
            <td>
                <div class="userPicBox pull-left m-r-10">
                    <img src="{{ get_image_url($v->shop_image, 'shop_image') }}" class="user-avatar">
                </div>
                <div class="ng-binding user-message goods-message w180">
                    <span class="name" title="{{ $v->shop_name }}"> 店铺名称：{{ $v->shop_name }}</span>

                    <span class="id">
								店铺ID：{{ $v->shop_id }}
								<font class="c-green m-l-10"> 个人店铺</font>
							</span>
                    <!-- 新加start -->
                    <div class="active">
                        <div class="QR-code popBox">
                            <a href="javascript:;" class="qrcode">
                                <i class="fa fa-qrcode"></i>
                            </a>
                            <div class="code-info popover-info">
                                <i class="fa fa-caret-left"></i>
                                <a href="javascript:;">店铺二维码</a>
                                <p>
                                    <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/shop/shop/qrcode?shop_id={{ $v->shop_id }}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end -->
                </div>
            </td>
            <td class="text-c">
                <div class="ng-binding">
                    <span class="text-c">{{ $v->user_name }}</span>

                    <span class="tool text-c">

								<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=2697138383&amp;site=qq&amp;menu=yes">
									<img border="0" src="http://wpa.qq.com/pa?p=2:2697138383:51" alt="点击这里给我发消息" title="点击这里给我发消息">
								</a>

							</span>

                </div>
            </td>
            <td class="text-c">
                <div class="ng-binding">
							<span class="text-c">
								<img src="http://images.68mall.com/system/credit/2016/06/07/14653016253926.gif" class="rank" title="" data-toggle="tooltip" data-placement="auto bottom" height="16" data-original-title="一星">
							</span>
                    <span class="text-c">{{ $v->credit }} 分</span>
                </div>
            </td>
            <td>
                <div class="ng-binding popover-box">
							<span>
								综合：
								<font class=" m-r-5">{{ $v->score }}</font>
								分
							</span>
                    <div class="popover-info">
                        <i class="fa fa-caret-left"></i>
                        <ul>
                            <li>
                                <div class="dt">
                                    <span>描述：</span>
                                </div>
                                <div class="dd text-l">5.00分</div>
                            </li>
                            <li>
                                <div class="dt">
                                    <span>服务：</span>
                                </div>
                                <div class="dd text-l">5.00分</div>
                            </li>
                            <li>
                                <div class="dt">
                                    <span>发货：</span>
                                </div>
                                <div class="dd text-l">5.00分</div>
                            </li>
                            <li>
                                <div class="dt">
                                    <span>物流：</span>
                                </div>
                                <div class="dd text-l">5.00分</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
            <td>

                {{ format_time(strtotime($v->begin_time), 'Y-m-d') }}
                <br>
                ~
                <br>
                {{ format_time(strtotime($v->end_time), 'Y-m-d') }}

            </td>
            <td>
                <div class="ng-binding">
                    <span>会员数量：0</span>
                    <span>订单数量：1</span>
                    <span>佣金比例：{{ $v->take_rate }}%</span>
                </div>
            </td>
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="shop_sort editable editable-click" data-shop_id="{{ $v->shop_id }}">{{ $v->shop_sort }}</a>
                </font>
            </td>
            <td>
                <div class="ng-binding">
                    <span class="shop-state">
                        店铺状态：
                        @if($v->shop_status == 1)
                            <span data-action="set-status?id={{ $v->shop_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5173\u95ed&quot;,&quot;\u5f00\u542f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>开启</span>
                        @else
                            <span data-action="set-status?id={{ $v->shop_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5173\u95ed&quot;,&quot;\u5f00\u542f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>关闭</span>
                        @endif
                    </span>
                    <span>
                        信誉显示：
                        @if($v->show_credit == 1)
                            <span data-action="set-show-credit?id={{ $v->shop_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                        @else
                            <span data-action="set-show-credit?id={{ $v->shop_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                        @endif
                    </span>
                    <span>
                        商品显示：
                        @if($v->goods_is_show == 1)
                            <span data-action="set-goods-is-show?id={{ $v->shop_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                        @else
                            <span data-action="set-goods-is-show?id={{ $v->shop_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                        @endif
                    </span>
                    <span>
                        店铺街显示：
                        @if($v->show_in_street == 1)
                            <span data-action="set-show-in-street?id={{ $v->shop_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                        @else
                            <span data-action="set-show-in-street?id={{ $v->shop_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                        @endif
                    </span>
                </div>
            </td>
            <td class="handle">


                <a href="edit?id={{ $v->shop_id }}&amp;shop_type={{ $v->shop_type }}&amp;is_supply={{ $v->is_supply }}">编辑</a>
                <span>|</span>



                <a href="{{ route('pc_shop_home', ['shop_id'=>$v->shop_id]) }}" target="_blank">查看店铺</a>


                <a href="pay-add?id={{ $v->shop_id }}&amp;shop_type=1&amp;is_supply=0">添加付款单</a>
                <span>|</span>
                <a href="javascript:void(0);" data-shop-id="{{ $v->shop_id }}" data-shop-name="{{ $v->shop_name }}" class="del border-none">删除</a>
                <!-- <span class="text-r">
                        <a href="http://seller.cp6znq.yunmall.68mall.com/login?account=测试店铺" target="_blank">登录卖家中心</a>
                    </span> -->


            </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="9">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>