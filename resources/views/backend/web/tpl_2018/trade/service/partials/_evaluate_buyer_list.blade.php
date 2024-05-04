<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <!--排序样式sort默认，asc升序，desc降序-->
        <th class="w300" data-sortname="sku_name">宝贝信息</th>
        <th class="text-c w150" data-sortname="desc_mark">评分</th>
        <th class="w150" data-sortname="uss.user_id">评价人</th>
        <th class="w150" data-sortname="shop_name">店铺</th>
        <!--操作列样式handle-->
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    @if(!empty($list))
        @foreach($list as $item)
            <tr class="order-tr" name="{{ $item['comment_id'] }}">
                <td class="tcheck">
                    <input type="checkbox" class="checkBox" />
                </td>
                <td class="cur-p">
                    <div class="goodsPicBox pull-left m-r-10">
                        <img src="{{ $item['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"></img>
                    </div>
                    <div class="ng-binding refund-message">
                        <div class="name">
                            <a href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}" target="_blank" data-toggle="tooltip"
                               data-placement="auto bottom" title="{{ $item['goods_name'] }}" class="c-blue">

                                {{ $item['goods_name'] }}

                            </a>
                        </div>
                        <div class="time">

                            @if($item['ot'] > 0)
                                购买时间：{{ format_time($item['ot']) }}
                            @else
                                <label class="label label-danger">采集</label>
                            @endif

                            <!-- 新加 start -->
                            <label class="label label-success" style="display: none">{{ format_order_from($item['order_from']) }}</label>
                            <!-- end -->
                        </div>
                        <div>
                            <label class="label {{ str_replace([0,1,2],['label-warning','label-green','label-danger'], $item['comment_status']) }}">
                                {{ str_replace([0,1,2],['待审核','审核通过','审核拒绝'], $item['comment_status']) }}
                            </label>
                        </div>
                    </div>
                </td>
                <!--icon-0为实星，icon-1为虚星-->
                <td class="cur-p">
                    <div class="ng-binding">
                        <span class="text-c">
                            <a class="score-icon {{ $item['score_icon'] }} m-r-5"></a>
                            {{ $item['score'] }}
                        </span>
                        <span class="star-icon text-c">

                            @for($i=0; $i< 5;$i++)
                                <i class="icon-@if($i < $item['desc_mark']){{ 0 }}@else{{ 1 }}@endif"></i>
                            @endfor
                        </span>
                    </div>
                </td>
                <!--b_blue_5.gif为钻级用户，1为一个钻，以此类推；b_red_4.gif为红心级用户；s_cap_4.gif为冠级用户-->
                <td class="cur-p">
                    <div class="ng-binding">
                        <span>
                        买家：
                        <font class="c-blue">{{ $item['user_name'] }}</font>
                        </span>
                        <span>
                        <img src="{{ $item['user_rank_icon'] }}" style="max-width: 100px; max-height: 20px;" class="rank" title="{{ $item['user_rank_name'] }}" data-toggle="tooltip" data-placement="auto bottom" />

                        </span>
                    </div>
                </td>
                <td class="cur-p">
                    <div class="ng-binding">
                        <span>
                            店铺：
                            <a href="javascript:;" title="{{ $item['shop_name'] }}">{{ $item['shop_name'] }}</a>
                        </span>
                        <span>
                            卖家：
                            <a href="javascript:;" title="{{ $item['seller_user_name'] }}">{{ $item['seller_user_name'] }}</a>
                        </span>
                    </div>
                </td>

                <td class="handle">
                    <!-- 新加 start -->
                    <a class="replace" data-id="{{ $item['comment_id'] }}" href="javascript:;">替换文字</a>
                    <!-- end -->

                    @if($item['comment_status'] == 0)
                        <a class="is_pass" data-id="{{ $item['comment_id'] }}" href="javascript:;">通过</a>
                        <span>|</span>
                        <a class="refuse del" data-id="{{ $item['comment_id'] }}" href="javascript:;">拒绝</a>
                    @endif
                </td>
            </tr>
            <tr class="order-content" style="display: none">
                <td></td>
                <td colspan="6">
                    <div class="ng-binding">

                        {{--初次评价--}}
                        <span class="m-b-10">
                            <div class="pull-left m-r-10">[初次评价]：</div>
                            <div class="pull-left ng-binding w900">
                                <span>{!! $item['comment_desc'] !!}</span>
                                <span>
                                    <div class="photos">
                                        @if(!empty($item['comment_images']))
                                            @foreach($item['comment_images'] as $image)
                                                <span class="photosBox">
                                                    <a href="{{ $image }}" class="highslide" onclick="return hs.expand(this)">
                                                        <img src="{{ $image }}" class="goods-thumb" />
                                                    </a>
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </span>
                                <span class="c-999">[{{ format_time($item['comment_time']) }}]</span>
                            </div>
                        </span>

                        {{--卖家回复--}}
                        @if(!empty($item['seller_reply_desc']))
                            <span class="m-b-10">
                            <div class="pull-left m-r-10">[卖家回复]：</div>
                            <div class="pull-left ng-binding w900">
                                <span class="c-brown">{!! $item['seller_reply_desc'] !!}</span>
                                <span class="c-999">[{{ format_time($item['seller_reply_time']) }}]</span>
                            </div>
                        </span>
                        @endif

                        {{--买家回复--}}
                        @if(!empty($item['user_reply_desc']))
                            <span class="m-b-10">
                            <div class="pull-left m-r-10">[买家回复]：</div>
                            <div class="pull-left ng-binding w900">
                                <span class="c-brown">{!! $item['user_reply_desc'] !!}</span>
                                <span class="c-999">[{{ format_time($item['user_reply_time']) }}]</span>
                            </div>
                        </span>
                        @endif

                        {{--买家追评--}}
                        @if($item['add_status'] > 0)
                            <span class="m-b-10">
                            <div class="pull-left m-r-10">[买家追评]：</div>
                            <div class="pull-left ng-binding w900">
                                <span>{!! $item['add_comment_desc'] !!}</span>
                                <span>
                                    <div class="photos">
                                        @if(!empty($item['add_comment_images']))
                                            @foreach($item['add_comment_images'] as $image)
                                                <span class="photosBox">
                                                    <a href="{{ $image }}" class="highslide" onclick="return hs.expand(this)">
                                                        <img src="{{ $image }}" class="goods-thumb" />
                                                    </a>
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </span>
                                <span class="c-999">[{{ format_time($item['add_time']) }}]</span>
                            </div>
                        </span>
                        @endif

                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="5">
            <div class="pull-left">
                <form id="cl" method="POST" action="">
                    <!---->
                    <button id="shows" class="btn btn-success m-r-5" type="button" data-action="delete-all">批量通过</button>
                    <button id="refuse" class="btn btn-danger m-r-5" type="button" data-action="delete-all">批量拒绝</button>
                    <!---->
                    <button id="btn-primary" class="btn btn-primary m-r-5" type="button">替换文字</button>
                    <!-- 新加 start -->
                    <button class="btn btn-danger m-r-5" type="button" style="display: none">批量删除</button>
                    <!-- end -->
                </form>
            </div>
            <div id="pagination" class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
