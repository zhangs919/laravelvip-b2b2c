<!-- 默认缓载图片 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

    <!-- 内容开始 -->
    <div class="w1210 clearfix">
        <div class="main-left fl">
            <div class="industry story clearfix">
                <h2 class="article-title">

                    @if($tpl_name != '' && $is_design)
                        <a title="编辑" class="selector title-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_open_colorpicker="1" data-title_open_link="1">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                    @endif

                    @if(!empty($data['4-1']))
                        @foreach($data['4-1'] as $k=>$v)
                            <a href="javascript:void(0);" class="title" target="_blank">
                                <i class="title-icon"></i>
                                <span style="color:{{ $v['color'] }};">{{ $v['name'] }}</span>
                            </a>
                        @endforeach
                    @else
                        <a href="javascript:;" class="title">
                            <i class="title-icon"></i>
                            <span>添加标题</span>
                        </a>
                    @endif


                </h2>
                <div class="industry-content industry-story">

                    @if($tpl_name != '' && $is_design)
                        <a title="编辑" class="selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="1" data-number="1">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                    @endif

                    <div class="story-top clearfix">

                        @if(!empty($data['1-1']))
                            @foreach($data['1-1'] as $v)
                                <div class="story-pic fl">
                                    <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}" style="">
                                        <img class="" src="{{ get_image_url($v['article_thumb']) }}" data-original="{{ get_image_url($v['article_thumb']) }}" style="display: inline;">
                                    </a>
                                </div>
                                <div class="story-detail fr">
                                    <h3>
                                        <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}">{{ $v['title'] }}</a>
                                    </h3>
                                    <p class="detail">

                                        {{ $v['summary'] }}

                                    </p>
                                    <p class="story-time">
                                        <span class="time fl">{{ $v['created_at'] }}</span>
                                        <span class="address fr">
                                            栏目：
                                            <a href="{{ route('pc_news_list', ['cat_id'=>$v['cat_id']]) }}">{{ $v['cat_name'] }}</a>
                                        </span>
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <div class="story-pic fl example-text special">
                                <a href="javascript:void(0);">
                                    <span>
                                    示例图片
                                    <br>
                                    【200*120】
                                    </span>
                                </a>
                            </div>
                            <div class="story-detail fr">
                                <h3>
                                    <a href="javascript:;">此处显示文章标题</a>
                                </h3>
                                <p class="detail">此处显示文章摘要</p>
                                <p class="story-time">
                                    <span class="time fl">20xx-xx-xx xx:xx</span>
                                    <span class="address fr">
                                        栏目：
                                        <a href="javascript:void(0);">文章分类</a>
                                    </span>
                                </p>
                            </div>
                        @endif


                    </div>

                    <div class="story-list">

                        @if($tpl_name != '' && $is_design)
                            <a title="编辑" class="selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="2" data-type="1" data-number="16">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>
                        @endif

                        <ul>


                            @if(!empty($data['1-2']))
                                @foreach($data['1-2'] as $v)
                                    <li class="left">
                                        <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}" title="{{ $v['title'] }}">
                                            <i class="icon"></i>
                                            {{ $v['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                @for($i=1; $i <= 16; $i++)
                                    <li class="left">
                                        <a href="javascript:void(0);">
                                            <i class="icon"></i>
                                            文章标题
                                        </a>
                                    </li>
                                @endfor
                            @endif


                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-right fr">
            <div class="people industry">
                <h2 class="article-title">

                    @if($tpl_name != '' && $is_design)
                        <a title="编辑" class="selector title-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="2" data-type="4" data-width="650" data-title_open_colorpicker="1" data-title_open_link="1">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                    @endif

                    @if(!empty($data['4-2']))
                        @foreach($data['4-2'] as $k=>$v)
                            <a href="javascript:void(0);" class="title" target="_blank">
                                <i class="title-icon"></i>
                                <span style="color:{{ $v['color'] }};">{{ $v['name'] }}</span>
                            </a>
                        @endforeach
                    @else
                        <a href="javascript:void(0);" class="title">
                            <i class="title-icon"></i>
                            <span>添加标题</span>
                        </a>
                    @endif


                </h2>
                <div class="industry-content article-list">


                    @if($tpl_name != '' && $is_design)
                        <a title="编辑" class="selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="3" data-type="1" data-number="4">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                    @endif


                    @if(!empty($data['1-3']))
                        @foreach($data['1-3'] as $v)
                            <dl>
                                <dt class="article-title fr">
                                    <p class="title">
                                        <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}" title="{{ $v['title'] }}">
                                            {{ $v['title'] }}
                                            <span class="grade-icon total-icon"></span>
                                        </a>
                                    </p>

                                    @if(!empty($v['source']))
                                        <p class="ip">
                                            <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}">$v['source']</a>
                                        </p>
                                    @endif

                                    <p class="detail">
                                        <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}" title="{{ $v['title'] }}">

                                            {{ $v['summary'] }}

                                        </a>
                                    </p>
                                </dt>

                                <dd class="article-img fl">
                                    <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}">
                                        <img class="" src="{{ get_image_url($v['article_thumb']) }}?x-oss-process=image/resize,m_pad,limit_0,h_75,w_125" data-original="{{ get_image_url($v['article_thumb']) }}?x-oss-process=image/resize,m_pad,limit_0,h_75,w_125" style="display: inline;">
                                    </a>
                                </dd>
                            </dl>
                        @endforeach
                    @else
                        @for($i=1; $i <= 4; $i++)
                            <dl>
                                <dt class="article-title fr">
                                    <p class="title">
                                        <a href="javascript:void(0);">
                                            文章标题
                                            <span class="grade-icon total-icon"></span>
                                        </a>
                                    </p>
                                    <p class="ip">
                                        <a href="javascript:;">文章来源</a>
                                    </p>
                                    <p class="detail">
                                        <a href="javascript:;">文章摘要</a>
                                    </p>
                                </dt>
                                <dd class="article-img fl example-text special">
                                    <a href="javascript:void(0);">
                                        <span>
                                        示例图片
                                        <br>
                                        【125*75】
                                        </span>
                                    </a>
                                </dd>
                            </dl>
                        @endfor
                    @endif


                </div>
            </div>
        </div>
    </div>
    <!-- 内容结束 -->

@if($is_design)
</div>
@endif

<!-- 调用需要的JS -->
<script type="text/javascript">

</script>