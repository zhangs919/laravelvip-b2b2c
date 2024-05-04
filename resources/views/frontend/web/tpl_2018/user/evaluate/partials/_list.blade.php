<div id="table_list">
    <!---->
    @if(!empty($list))
    <div id="ajax_contents">

        @foreach($list as $item)
        <!---->
        <div class="evaluate-plist">
            <div class="pro-info">
                <ul>
                    <li class="fore1 goods-info">
                        <div style="overflow: hidden;">
                            <a class="goods-img" href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}" target="_blank">
                                <img src="{{ $item['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                            </a>
                            <div class="item-con">
                                <div class="item-name">
                                    <a href="{{ route('pc_show_goods',['goods_id'=>$item['goods_id']]) }}" target="_blank">
                                        <span>{{ $item['goods_name'] }}</span>
                                    </a>
                                </div>
                                @if(!empty($item['spec_info']))
                                    <div class="item-props">
                                        <span class="sku">
                                            @foreach(explode(' ', $item['spec_info']) as $spec)
                                                <span>{{ $spec }}</span>
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                                <div class="item-time">
                                    <span>购买时间：{{ format_time($item['order_add_time']) }}</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="fore2">
                        <div class="rank">
                            <p class="rank-name">
                                <i class="score-icon {{ $item['score_icon'] }}"></i>
                                {{ $item['score_desc'] }}
                            </p>
                            <p class="rank-star">
                                <span class="star-icon star-icon{{ $item['desc_mark'] }}"></span>
                            </p>
                        </div>
                    </li>
                    <li class="fore3">

                        <div class="operate">
                            <a href="javascript:;" class="see-evaluate">查看评价</a>
                            @if($item['evaluate_status'] == 1)
                                <a href="/user/evaluate/info.html?order_id={{ $item['order_id'] }}">追加评价</a>
                            @endif

                            @if(empty($item['user_reply_desc']))
                                <a href="javascript:;" class="reply" data-comment-id="{{ $item['comment_id'] }}">回复卖家</a>
                            @endif
                        </div>
                        <!-- -->
                    </li>
                </ul>
            </div>
            <div class="evaluate-box">
                <div class="box-t"></div>
                <div class="evaluate-con">
                    <ul class="clearfix">
                        <li>
                            <div class="dt">评价内容：</div>
                            <div class="dd" data-id="{{ $item['comment_id'] }}">
                                <p>{{ $item['comment_desc'] }}</p>
                                <div data-type="befor" class="voucher">

                                    @if(!empty($item['comment_images']))
                                        @foreach($item['comment_images'] as $image)
                                            <a href="{{ $image }}" onclick="return hs.expand(this)">
                                                <img src="{{ $image }}" class="goods-thumb" />
                                            </a>
                                        @endforeach
                                    @endif

                                </div>
                                <p class="time">[{{ format_time($item['comment_time']) }}]</p>
                            </div>
                        </li>

                        {{--卖家回复--}}
                        @if(!empty($item['seller_reply_desc']))
                            <li>
                                <div class="dt">卖家回复：</div>
                                <div class="dd" data-id="{{ $item['comment_id'] }}">
                                    <p>{{ $item['seller_reply_desc'] }}</p>
                                    <p class="time">[{{ format_time($item['seller_reply_time']) }}]</p>
                                </div>
                            </li>
                        @endif

                        {{--买家回复--}}
                        @if(!empty($item['user_reply_desc']))
                            <li>
                                <div class="dt">买家回复：</div>
                                <div class="dd" data-id="{{ $item['comment_id'] }}">
                                    <p>{{ $item['user_reply_desc'] }}</p>
                                    <p class="time">[{{ format_time($item['user_reply_time']) }}]</p>
                                </div>
                            </li>
                        @endif


                        @if($item['evaluate_status'] == 2)
                            <!-- 追加评价 -->
                            <li>
                                <div class="dt">追加评价：</div>
                                <div class="dd" data-id="{{ $item['comment_id'] }}">
                                    <p>{{ $item['add_comment_desc'] }}</p>
                                    <div data-type="befor" class="voucher">

                                        @if(!empty($item['add_comment_images']))
                                            @foreach($item['add_comment_images'] as $image)
                                                <a href="{{ $image }}" onclick="return hs.expand(this)">
                                                    <img src="{{ $image }}" class="goods-thumb" />
                                                </a>
                                            @endforeach
                                        @endif

                                    </div>
                                    <p class="time">[{{ format_time($item['add_time']) }}]</p>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endforeach

        <form name="selectPageForm" action="" method="get">
            <!--分页-->
            <div class="page">
                <div class="page-wrap fr">

                    {!! $pageHtml !!}

                </div>
            </div>
        </form>
    </div>
    @else
        <div class="tip-box">
            <img src="{{ get_image_url(sysconf('default_noresult')) }}" class="tip-icon">
            <div class="tip-text">暂无评价记录</div>
        </div>
    @endif
    <!---->
</div>
