<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w300" data-sortname="shop_name">店铺信息</th>
        <th class="w150 text-c" data-sortname="user_name">店主账号</th>
        <th class="w120 text-c" data-sortname="credit">店铺信誉</th>
        <th class="w150" data-sortname="score">店铺评分</th>
        <th class="w100" data-sortname="shop_id">开店时间</th>
        <th class="w100" data-sortname="">店铺经营情况</th>
        <th class="text-c w70" data-sortname="shop_sort">排序</th>
        <th class="w150" data-sortname="">店铺状态</th>

        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td>
            <div class="userPicBox pull-left m-r-10">
                <img src="{{ get_image_url($v->shop_image, 'shop_image') }}" class="user-avatar" />
            </div>
            <div class="ng-binding user-message goods-message w180">
                <span class="name" title="{{ $v->shop_name }}"> 店铺名称：{{ $v->shop_name }}</span>

                <span class="id"> 店铺ID：{{ $v->shop_id }} </span>
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
                                <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/shop/shop/qrcode?shop_id={{ $v->shop_id }}" />
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end -->
            </div>
        </td>
        <td class="text-c">
            <div class="ng-binding">
                <span class="text-c">{{ $v->user->user_name }}</span>

            </div>
        </td>
        <td class="text-c">
            <div class="ng-binding">
							<span class="text-c">
								<img  src="{{ get_image_url($v->credit_img) }}"  class="rank" title="{{ $v->credit_name }}" data-toggle="tooltip" data-placement="auto bottom" height="16" />
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
                            <div class="dd text-l">{{ $v->desc_score }}分</div>
                        </li>
                        <li>
                            <div class="dt">
                                <span>服务：</span>
                            </div>
                            <div class="dd text-l">{{ $v->service_score }}分</div>
                        </li>
                        <li>
                            <div class="dt">
                                <span>发货：</span>
                            </div>
                            <div class="dd text-l">{{ $v->send_score }}分</div>
                        </li>
                        <li>
                            <div class="dt">
                                <span>物流：</span>
                            </div>
                            <div class="dd text-l">{{ $v->logistics_score }}分</div>
                        </li>
                    </ul>
                </div>
            </div>
        </td>
        <td>{{ format_time(strtotime($v->open_time), 'Y-m-d') }}</td>
        <td>
            <div class="ng-binding">
                <span>会员数量：{{ $v->member_count }}</span>
                <span>订单数量：{{ $v->order_info_count }}</span>
            </div>
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="shop_sort" data-shop_id={{ $v->shop_id }}>{{ $v->shop_sort }}</a>
            </font>
        </td>
        <td>
            <div class="ng-binding">
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
            <a href="{{ route('pc_shop_home', ['shop_id'=>$v->shop_id]) }}" target="_blank">查看店铺</a>
            <span>|</span>
            <a href="edit?id={{ $v->shop_id }}&is_supply=0">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-shop-id="{{ $v->shop_id }}" data-shop-name="{{ $v->shop_name }}" class="del border-none">删除</a>
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
