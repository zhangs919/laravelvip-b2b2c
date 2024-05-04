@foreach($list as $item)
    <div class="evaluate-plist evaluate-plist-info comment-goods">
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
                <li class="fore3">
                    <div class="operate">
                        @if($item['evaluate_status'] == 0)
                        <!--点击评价-->
                        <a href="javascript:;" class="go-to-evaluate">点击评价</a>
                        @elseif($item['evaluate_status'] == 1)
                        <!-- 追加评价 -->
                        <a href="javascript:;" class="go-to-evaluate">追加评价</a>
                        @else
                        @endif
                    </div>
                </li>
            </ul>
        </div>

        @if($item['evaluate_status'] == 0)
            <!-- 点击评价 -->
                <div class="evaluate-box evaluate-box-spe">
                    <div class="box-t"></div>
                    <div class="evaluate-con">
                        <form class="form-horizontal comment-form" method="post" action="">
                            <div class="form-group form-group-spe">
                                <label class="input-left">
                                    <span>描述相符：</span>
                                </label>
                                <div class="rank">
                                    <div id="rank_star" name="rank_star" class="star rank_star">
                                        <span style="display: none; color: red; float: right;" class="comment-score-error">必填哦~</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-spe">
                                <label class="input-left">
                                    <span>评价商品：</span>
                                </label>
                                <div class="form-control-box">
                                    <textarea placeholder="请输入评价内容..." name="content" class="comment-content"></textarea>
                                </div>
                            </div>
                            <div class="form-group form-group-spe">
                                <label class="input-left">
                                    <span>晒图片：</span>
                                </label>
                                <div class="comment-images" data-sku-id="{{ $item['sku_id'] }}"></div>
                                <input type="hidden" id="images_{{ $item['sku_id'] }}" name="images" value="" class="comment-images">
                                <span class="hint">每张图片大小不超过2048KiB，最多上传5张图片，支持gif、png、jpg格式</span>
                            </div>
                            <span class="hint comment-content-error" style="display: none; color: red;">亲，请先添加评论或上传图片再提交</span>
                            <div class="act">
                                <input type="button" class="btn btn-submit" value="发表评价" data-record-id="{{ $item['record_id'] }}" />
                                <label>
                                    <input type="hidden" name="is_anonymous" value="0" />
                                    <input type="checkbox" name="is_anonymous" checked="checked" value="1" />
                                    <span>匿名评价</span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
        @elseif($item['evaluate_status'] == 1)
            <!-- 追加评价 -->
                <div id="{{ $item['goods_id'] }}" class="evaluate-box evaluate-box-spe">
                    <div class="box-t"></div>
                    <div class="evaluate-con">
                        <ul class="clearfix">
                            <li>
                                <div class="dt">评价内容：</div>
                                <div class="dd">
                                    <p>{{ $item['comment_desc'] }}</p>
                                    <div class="voucher">
                                        @if(!empty($item['comment_images']))
                                            @foreach($item['comment_images'] as $image)
                                                <a href="{{ $image }}" onclick="return hs.expand(this)">
                                                    <img src="{{ $image }}" class="goods-thumb" />
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                    <p class="time">{{ format_time($item['comment_time']) }}</p>
                                </div>
                            </li>

                            {{--卖家回复--}}
                            @if(!empty($item['seller_reply_desc']))
                                <li>
                                    <div class="dt">卖家回复：</div>
                                    <div class="dd" data-id="{{ $item['comment_id'] }}">
                                        <p>{{ $item['seller_reply_desc'] }}</p>
                                        <div data-type="befor" class="voucher">

                                        </div>
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
                                        <div data-type="befor" class="voucher">

                                        </div>
                                        <p class="time">[{{ format_time($item['user_reply_time']) }}]</p>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        <form class="form-horizontal comment-form" method="post" action="">
                            <div class="form-group form-group-spe">
                                <label class="input-left">
                                    <span>追加评价：</span>
                                </label>
                                <div class="form-control-box">
                                    <textarea placeholder="请输入追加评价内容..." name="content" class="comment-content"></textarea>
                                </div>
                            </div>
                            <div class="form-group form-group-spe">
                                <label class="input-left">
                                    <span>晒图片：</span>
                                </label>
                                <div class="comment-images" data-sku-id="{{ $item['sku_id'] }}"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                                <span class="hint">每张图片大小不超过4096KiB，最多上传5张图片，支持gif、png、jpg格式</span>
                                <input type="hidden" id="images_{{ $item['sku_id'] }}" name="images" value="">
                            </div>
                            <span class="hint comment-content-error" style="display: none; color: red;">亲，请先添加评论或上传图片再提交</span>
                            <div class="act">
                                <input type="button" class="btn btn-append" value="发表评价" data-record-id="{{ $item['record_id'] }}" data-comment-id="{{ $item['comment_id'] }}">
                            </div>
                        </form>
                    </div>
                </div>
        @else
            <!-- 查看评价 -->
                <div class="evaluate-box evaluate-box-spe">
                    <div class="box-t"></div>
                    <div class="evaluate-con">
                        <ul class="clearfix">
                            <li>
                                <div class="dt">评价内容：</div>
                                <div class="dd">
                                    <p>{{ $item['comment_desc'] }}</p>
                                    <div class="voucher">
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
                                        <div data-type="befor" class="voucher">

                                        </div>
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
                                        <div data-type="befor" class="voucher">

                                        </div>
                                        <p class="time">[{{ format_time($item['user_reply_time']) }}]</p>
                                    </div>
                                </li>
                            @endif

                            <!-- 追加评价 -->
                            <!---->
                            <li>
                                <div class="dt color-light">[追加评价]：</div>
                                <div class="dd">
                                    <p>{{ $item['add_comment_desc'] }}</p>
                                    <div class="voucher">
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
                            <!---->
                            <!-- 买家回复 -->
                            <!-- -->
                        </ul>
                    </div>
                </div>
        @endif

    </div>
@endforeach

<script type='text/javascript'>
    @if(request()->method() == 'POST')
    //商品星级评价 依赖于js/jquery.raty.js
    $().ready(function() {
        $.fn.raty.defaults.path = '/images/star-rank';
        $.fn.raty.defaults.scoreName = "score";
        $.fn.raty.defaults.hints = {!! json_encode($score_desc['desc']) !!};
        $("div[class='star rank_star']").raty();
    });
    //
    var imgpath = "";
    $().ready(function() {
        $(".comment-images").each(function() {
            var sku_id = $(this).data("sku-id");
            var imagegorup = $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: 5,
                mode: 0,
                callback: function(data) {
                    var value = this.values.join(",");
                    var empty_size = 0;
                    for (var i = 0; i < this.values.length; i++) {
                        if ($.trim(this.values[i]) == "") {
                            empty_size++;
                        }
                    }
                    if (this.values.length == empty_size) {
                        $("#images_" + sku_id).val("");
                    } else {
                        $("#images_" + sku_id).val(value);
                    }
                },
                remove: function(value, values) {
                    var value = this.values.join(",");
                    var empty_size = 0;
                    for (var i = 0; i < this.values.length; i++) {
                        if ($.trim(this.values[i]) == "") {
                            empty_size++;
                        }
                    }
                    if (this.values.length == empty_size) {
                        $("#images_" + sku_id).val("");
                    } else {
                        $("#images_" + sku_id).val(value);
                    }
                },
                change: function(value, values){
                    $("#images_" + sku_id).val(value);
                }
            });
        });
    });
    @endif
</script>