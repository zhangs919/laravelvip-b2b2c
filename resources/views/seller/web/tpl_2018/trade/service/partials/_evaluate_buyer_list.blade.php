<link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"><!-- ================== BEGIN BASE  ================== -->
<!-- ================== END BASE  ================== -->
<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <!--排序样式sort默认，asc升序，desc降序-->
        <th data-sortname="sku_name">
            宝贝信息
            <span class="sort"></span>
        </th>
        <th data-sortname="desc_mark">
            评价
            <span class="sort"></span>
        </th>
        <th data-sortname="com.user_id">
            评价人
            <span class="sort"></span>
        </th>
        <!--操作列样式handle-->
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>
    <!--以下为循环内容-->
    @if(!empty($list))
        @foreach($list as $item)
            <tr class="order-tr" name="{{$item['comment_id']}}">
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
                        <span>
                            <a class="score-icon {{ $item['score_icon'] }} m-r-5"></a>
                            {{ $item['score'] }}
                        </span>
                        <span class="star-icon">

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
                <td class="handle">
                    <a class="review_content" href="javascript:;">查看评论</a>
                    @if(empty($item['seller_reply_desc']))
                        <span>|</span>
                        <a href="javascript:void(0);" class="comment" data-id="{{$item['comment_id']}}">回复</a>
                    @endif
                </td>
            </tr>
            <tr class="order-content" style="display: none">
                <td></td>
                <td colspan="4">
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
        <td colspan="4">
            <div class="pull-left">
                <button id="delete-all" class="btn btn-danger mr5" type="button" data-action="delete-all">批量回复</button>
                <!--<button class="btn btn-default disabled mr5" type="button">禁用</button>
        <button class="btn btn-default" type="button">按钮1</button>-->
            </div>
            <div id="pagination" class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
    <script type="text/javascript">
        // 
    </script>
</table>

<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script>

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

    //



    $('.order-tr').each(function() {
        $(this).find('td:not(.tcheck,.handle)').click(function() {
            $(this).parents().addClass("active").siblings('.order-tr').removeClass('active');
            $(".order-content").not($(this).parents().next(".order-content")).hide();
            $(this).parents().next(".order-content").slideToggle(300);
        })
    });

    // 
</script>