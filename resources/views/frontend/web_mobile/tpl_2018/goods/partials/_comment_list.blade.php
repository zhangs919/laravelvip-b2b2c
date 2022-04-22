<div class="comment-content" id="tablelist">

    @if(!empty($list))
        <div class="tablelist-append">

            @foreach($list as $v)
                <div class="blank-div"></div>
                <div class="goods-comment clearfix">
			<span class="face">
				<img src="{{ $v['headimg'] }}" class="user_img">
			</span>
                    <div class="user-info">

				<span class="user-name">

					{{ $v['user_name_encrypt'] }}

				</span>

                        <span class="user-level">
					<img alt="{{ $v['rank_name'] }}" src="{{ get_image_url($v['rank_img']) }}">
				</span>

                        <!---->
                        <!-- -->
                        <!-- -->

                        <!---->
                        <div class="goods-comment-text">{!! $v['comment_desc'] !!}</div>
                        <!---->
                        {{--判断有图片时显示--}}
                        @if(!empty($v['comment_images']))
                            <ul class="goods-comment-picture" id="gallery">

                                @foreach($v['comment-images'] as $image)
                                    <li>
                                        <a href="{{ get_image_url($image) }}">
                                            <img src="{{ get_image_url($image) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220">
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        @endif

                        <div class="goods-comment-time">{{ format_time($v['comment_time'], 'Y-m-d H:i:s') }}</div>
                        <!---->
                        {{--买家回复--}}
                        @if(!empty($v['user_reply_desc']))
                            <div class="goods-comment-again">
                                <div class="text">
                                    <em class="type">【买家回复】：</em>
                                    {!! $v['user_reply_desc'] !!}
                                </div>
                                <div class="goods-comment-time">{{ format_time($v['user_reply_time'], 'Y-m-d H:i:s') }}</div>
                            </div>
                        @endif
                        <!-- -->

                        <!-- -->
                        <!-- -->

                        <!-- -->

                        <!---->
                        {{--追加评价--}}
                        @if(!empty($v['add_comment_desc']))
                            <div class="goods-comment-again">
                                <div class="text">
                                    <em class="type">【追加评价】：</em>
                                    {!! $v['add_comment_desc'] !!}
                                </div>

                                <div class="goods-comment-time">{{ format_time($v['add_time'], 'Y-m-d H:i:s') }}</div>
                            </div>
                        @endif
                        <!-- -->

                        <!---->
                        {{--卖家回复--}}
                        @if(!empty($v['seller_reply_desc']))
                            <div class="goods-comment-again">
                                <div class="text">
                                    <em class="type">【卖家回复】：</em>
                                    {!! $v['seller_reply_desc'] !!}
                                </div>
                                <div class="goods-comment-time">{{ format_time($v['seller_reply_time'], 'Y-m-d H:i:s') }}</div>
                            </div>
                        @endif

                        <!-- -->


                    </div>


                </div>
                <!-- -->
            @endforeach

        </div>


        <!-- 分页 -->
        <div id="pagination" class="page">
            <div class="more-loader-spinner">

                <div class="is-loaded">
                    <div class="loaded-bg">我是有底线的</div>
                </div>

            </div>
            <script data-page-json="true" type="text" id="page_json">
                {!! $page_json !!}
            </script>
        </div>
    @else
        <div class="blank-div"></div>
        <!--没有评论时-->
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png" />
            </div>
            <dl>
                <dt>评价空空如也</dt>
                <dd>期待您的购买与评论~</dd>
            </dl>
        </div>
        <!-- -->
        <!-- 分页 -->
        <div id="pagination" class="page">
            <div class="more-loader-spinner">

            </div>
            <script data-page-json="true" type="text" id="page_json">
                {!! $page_json !!}
            </script>
        </div>
    @endif
</div>