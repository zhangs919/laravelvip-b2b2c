<!--有评价信息时-->
<div class="user-comment-content" id="table_list">
@if(!empty($list))
    <!-- -->
        <!--我的评价列表-->
        <div class="tablelist-append">
            @foreach($list as $item)
                <div class="user-comment-list">
                    <div class="user-comment-title">
				<span class="rank-name">
					{{ $item['score_desc'] }}
				</span>
                        <div class="rank-stars">
                            <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                            <span class="star-icon star-icon{{ $item['desc_mark'] }}"></span>
                        </div>
                        <div class="comment-time">购买时间：{{ format_time($item['order_add_time']) }}</div>
                    </div>
                    <div class="user-comment-item">
                        <div class="user-comment-pic">
                            <a href="/goods-{{ $item['goods_id'] }}.html">
                                <img src="{{ $item['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320"/>
                            </a>
                        </div>
                        <dl class="user-comment-info">
                            <dt class="comment-goods-name">{{ $item['goods_name'] }}</dt>
                            <dd class="comment-content">{{ $item['comment_desc'] }}</dd>
                            <!--晒图-->
                            <dd class="comment-pic-list">
                                <ul id="gallery">

                                    @if(!empty($item['comment_images']))
                                        @foreach($item['comment_images'] as $image)
                                            <li>
                                                <a href="{{ $image }}"
                                                   class="img-gallery">
                                                    <img src="{{ $image }}?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </dd>
                            <dd class="goods-comment-time">{{ format_time($item['comment_time']) }}</dd>
                            <!---->
                            <!-- -->

                            {{--追加评价--}}
                            @if($item['evaluate_status'] == 2)
                                <dd class="goods-comment-other">
                                    <div class="text">
                                        <em class="type">【追加评价】：</em>
                                        {{ $item['add_comment_desc'] }}
                                    </div>
                                </dd>
                                <!--晒图-->
                                <dd class="comment-pic-list">
                                    <ul id="gallery">
                                        @if(!empty($item['add_comment_images']))
                                            @foreach($item['add_comment_images'] as $image)
                                                <li>
                                                    <a href="{{ $image }}"
                                                       class="img-gallery">
                                                        <img src="{{ $image }}?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </dd>
                                <dd class="goods-comment-time">{{ format_time($item['add_time']) }}</dd>
                            @endif

                        </dl>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- 分页 -->
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
    <!--没有评价信息时-->
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png"/>
            </div>
            <dl>
                <dt>评价空空如也</dt>
            </dl>
        </div>
    @endif
</div>