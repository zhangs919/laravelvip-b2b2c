<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="table-list-checkbox-all" title="全选/全不选">
        </th>
        <th class="text-c" data-sortname="goods_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <th class="" data-sortname="goods_name" data-sortorder="asc" style="cursor: pointer;">商品名称<span class="sort"></span></th>
        <th class="" data-sortname="goods_price" data-sortorder="asc" style="cursor: pointer;">本店价（元）<span class="sort"></span></th>
        <th class="" data-sortname="goods_number" data-sortorder="asc" style="cursor: pointer;">库存<span class="sort"></span></th>
        <th class="" data-sortname="goods_status" data-sortorder="asc" style="cursor: pointer;">状态<span class="sort"></span></th>
        <th class="" data-sortname="is_new,is_best,is_hot" data-sortorder="asc" style="cursor: pointer;">标签<span class="sort"></span></th>
        <th class="" data-sortname="add_time" data-sortorder="asc" style="cursor: pointer;">发布时间<span class="sort"></span></th>
        <th class="text-c" data-sortname="goods_sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
        <th class="handle" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $v->goods_id }}">
        </td>
        <td class="text-c">{{ $v->goods_id }}</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">
                    <!-- 图片缩略图 -->
                    <img src="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb">
                    <!-- 虚拟商品 -->

                </a>
            </div>
            <div class="ng-binding goods-message w200">
                <div class="name">
                    <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank" title="{{ $v->goods_name }}">{{ msubstr($v->goods_name, 0, 30) }}</a>
                </div>
                <div class="active">
                    <!--判断是否发布手机端宝贝详情：
                                    默认、未发布（为灰色小图标）：默认的给class值goods-mobile
                                    已发布（为蓝色小图标）:在默认的基础上追加class值open
                                    注意：在已发布及未发布的小图标鼠标经过的title值有所不同
                    -->

                    <div class="goods-mobile @if(!empty($v->mobile_desc)) open @endif">
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="此宝贝@if(empty($v->mobile_desc))尚未@else已@endif发布手机端宝贝详情">
                            <i class="fa fa-tablet"></i>
                        </a>
                    </div>

                    <div class="QR-code popover-box">
                        <a href="javascript:;" class="qrcode">
                            <i class="fa fa-qrcode"></i>
                        </a>
                        <div class="code-info popover-info" style="display: none;">
                            <i class="fa fa-caret-left"></i>
                            <a href="/goods/default/download-qrcode?id={{ $v->goods_id }}">商品二维码</a>
                            <p>
                                <img src="/assets/d2eace91/images/common/loading_90_90.gif" data-src="/goods/default/qrcode?id={{ $v->goods_id }}">
                            </p>
                        </div>
                    </div>
                    <!--新加批发 start-->
                    <div class="pull-left">

                        <label class="model-label blue">零售</label>

                    </div>
                    <!--新加 end-->
                    <!--以下为区分不同的活动，分别给不同的活动名称不同的背景颜色(对注释下面的div追加以下class名)：
                                        积分： exchange
                                        拍卖： auction
                                        预售： pre-sale
                                        0元购：zero-buy
                                        众筹： crowdfund
                                        促销活动: pro-sale

                    <div class="goods-active pre-sale">
                        <a href="" target="_blank" data-toggle="tooltip" data-placement="auto bottom" title="该商品参与XX预售活动，点击进入商品详情页查看">预售</a>
                    </div>
                     -->
                </div>
                <div class="store">
                    个人店铺：
                    <a class="c-green" title="{{ $v->shop_name }}" href="{{ route('pc_shop_home', ['shop_id'=>$v->shop_id]) }}" target="_blank">{{ $v->shop_name }}</a>
                </div>
            </div>
        </td>
        <td>

            <font class="f14">￥{{ $v->goods_price }}</font>

        </td>
        <td>
            <font class="f14">{{ $v->goods_number }}</font>
        </td>
        <td>
            <!-- 审核未通过的商品不显示商品状态 -->

            @if($v->goods_audit == 0)
                <font class="c-red">待审核</font>
            @elseif($v->goods_audit == 1)
                <font class="c-green">出售中</font>
                <br>
            @elseif($v->goods_audit == 2)
                @if($v->goods_status == 0)
                    <font class="c-red" data-goods-reason="{{ $v->goods_reason }}">已下架</font>
                @elseif($v->goods_status == 2)
                    <font class="c-red" data-goods-reason="{{ $v->goods_reason }}">违规下架</font>
                @else
                    <font class="c-red">审核未通过</font>
                    <i class="c-yellow m-l-5 fa fa-exclamation-circle goods-reason" data-goods-reason="{{ $v->goods_reason }}" style="cursor: pointer;"></i>
                @endif
            @endif


        </td>
        <td>
            <div class="ng-binding">
                @if($v->is_new == 1)
                    <span>新品：<span data-action="/goods/publish/is-new?id={{ $v->goods_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span></span>
                @else
                    <span>新品：<span data-action="/goods/publish/is-new?id={{ $v->goods_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span></span>
                @endif
                @if($v->is_best == 1)
                    <span>精品：<span data-action="/goods/publish/is-best?id={{ $v->goods_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span></span>
                @else
                    <span>精品：<span data-action="/goods/publish/is-best?id={{ $v->goods_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span></span>
                @endif
                @if($v->is_hot == 1)
                    <span>热销：<span data-action="/goods/publish/is-hot?id={{ $v->goods_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span></span>
                @else
                    <span>热销：<span data-action="/goods/publish/is-hot?id={{ $v->goods_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span></span>
                @endif
            </div>
        </td>
        <td>
            {{ $v->created_at->format('Y-m-d') }}
            <br>
            {{ $v->created_at->format('H:i:s') }}
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="goods-sort editable editable-click" data-goods_id="{{ $v->goods_id }}">{{ $v->goods_sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a href="javascript:void(0);" class="sku-list" data-goods-id="{{ $v->goods_id }}">SKU</a>
            <span>|</span>
            <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">查看</a>
            <!--
            <span>|</span>
            <a href="javascript:void(0);">复制</a>
             -->


            <span>|</span>
            @if($v->goods_audit == 0)
                <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="audit-goods">审核</a>
            @elseif($v->goods_audit == 1)
                <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="offsale-goods  del">强制下架</a>
            @elseif($v->goods_audit == 2)
                <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="onsale-goods">恢复上架</a>
            @endif


            <!--
            <span>|</span>
            <a href="/goods/publish/delete?id={{ $v->goods_id }}" class="del border-none">删除</a>
             -->
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="table-list-checkbox-all" title="全选/全不选">
        </td>
        <td colspan="9">
            <div class="pull-left">

                @if($type == 'list')
                    <input type="button" class="btn btn-primary m-r-2 batch-onsale-goods" value="上架">
                    <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->

                    <input type="button" class="btn btn-danger m-r-2 batch-offsale-goods" value="下架">
                    <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
                @elseif($type == 'illegal')
                    <input type="button" class="btn btn-primary m-r-2 batch-onsale-goods" value="上架">
                    <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
                @elseif($type == 'wait-audit')
                    <input type="button" class="btn btn-primary m-r-2 audit-goods" value="批量审核">
                    <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
                @endif



            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>