@if(!empty($list))
    <div class="comment-con tablelist">
        <!-- 带晒单图片的评论 -->

        @foreach($list as $v)
            <div class="goods-comment">
                <div class="user-info">
                    <div class="face">
                        <img src="{{ $v['headimg'] }}" />
                    </div>
                    <div class="name-box">
                        <em>

                            {{ $v['user_name_encrypt'] }}

                        </em>
                        <span>
<img alt="{{ $v['rank_name'] }}" src="{{ get_image_url($v['rank_img']) }}">
</span>
                    </div>
                </div>
                <dl>
                    <!---->
                    <!---->
                    <!---->

                    <!---->
                    <dd class="goods-comment-con">
                        <span class="text">{!! $v['comment_desc'] !!}</span>
                    </dd>
                    <!---->
                    {{--判断有图片时显示--}}
                    @if(!empty($v['comment_images']))
                        <ul class="goods-comment-picture" id="gallery">

                            @foreach($v['comment_images'] as $image)
                                <dd>
                                    <ul class="upload-control">

                                        <li>
                                            <a href="{{ get_image_url($image) }}" class="highslide" onclick="return hs.expand(this)">
                                                <img src="{{ get_image_url($image) }}" />
                                            </a>
                                        </li>

                                    </ul>
                                </dd>
                            @endforeach

                        </ul>
                    @endif
                    <!---->
                    <dd>
                        <div class="date">
                            <span>{{ format_time($v['comment_time']) }}</span>
                            <!-- <span></span> -->
                        </div>
                    </dd>
                    <!---->
                    <!---->
                    <!---->
                    <!---->
                    {{--买家回复--}}
                    @if(!empty($v['user_reply_desc']))
                        <div class="user-reply">
                            <div class="user-box">
                                <div class="user-content">
                                    <dl class="user">
                                        <dt class="user-name">
                                            {{ $v['user_name'] }}
                                            <span>卖家回复：</span>
                                        </dt>
                                        <dd class="user-con">{{ $v['user_reply_desc'] }}</dd>
                                    </dl>
                                    <div class="date">
                                        <span class="time">{{ format_time($v['user_reply_time']) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->
                    @endif

                    <!---->
                    <!---->
                    {{--追加评价--}}
                    @if(!empty($v['add_comment_desc']))
                        <!---->
                        <dd class="goods-comment-con add-comment">
                            <span class="type">追加评价：</span>
                            <div class="text">{!! $v['add_comment_desc'] !!}</div>
                        </dd>
                        <!---->
                        <dd>
                            <div class="date">
                                <span>{{ format_time($v['add_time']) }}</span>
                            </div>
                        </dd>
                        <!---->
                    @endif
                    <!---->

                    {{--卖家回复--}}
                    @if(!empty($v['seller_reply_desc']))
                        <!---->
                        <div class="business-reply">
                            <div class="business-box">
                                <div class="admin-content">
                                    <p class="user">
                                    <span class="admin-user">
                                        {{ $v['shop_name'] }}
                                        <span>回复：</span>
                                    </span>
                                        <span class="admin-user-con">{{ $v['seller_reply_desc'] }}</span>
                                    </p>
                                    <div class="date">
                                        <span class="time">{{ format_time($v['seller_reply_time']) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---->
                    @endif
                    <!---->
                    <!---->
                    <!---->
                    <!---->
                </dl>
            </div>
        @endforeach


            <!--评论翻页-->
        <div class="right page">
            <div class="page-wrap fr">
                {!! $pageHtml !!}
            </div>
        </div>
    </div>
@else
    <div class="tip-box">
        <img src="/images/noresult.png" class="tip-icon" />
        <div class="tip-text">还没有任何评价哦</div>
    </div>
    <!-- -->
@endif