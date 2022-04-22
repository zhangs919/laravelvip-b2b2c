<!-- 默认缓载图片 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 内容开始 -->
    <!--banner-->
    <div class="w1210 clearfix">
        <div class="main-left fl">
            <div class="scroll-box">

                @if($tpl_name != '' && $is_design)
                    <a href="javascript:void(0)" title="编辑" class="selector pic-selector SZY-TPL-SELECTOR"
                       data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="5">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                @if(!empty($data['3-1']))
                    <div class="scroll-pic">
                        <ul>
                            @foreach($data['3-1'] as $k=>$v)
                                <li @if($k == 0) style="display: block;" @endif>
                                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="">
                                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="570px" height="345px" style="display: inline;">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="scroll-num">
                        @for($i=1; $i <= count($data['3-1']); $i++)
                            <span @if($i == 1) class="on" @endif></span>
                        @endfor
                    </div>
                @else
                    <div class="scroll-pic">
                        <ul>
                            @for($i=1; $i <= 3; $i++)
                                <li @if($i == 1) style="display: block;" @endif>
                                    <a href="javascript:;" class="example-text">
                                        <span>此处添加【570*345】图片</span>
                                    </a>
                                </li>
                            @endfor
                        </ul>
                    </div>
                    <div class="scroll-num">
                        @for($i=1; $i <= 3; $i++)
                            <span @if($i == 1) class="on" @endif></span>
                        @endfor
                    </div>
                @endif

                <div class="scroll-btn">
                    <span class="btn-left"><</span>
                    <span class="btn-right">></span>
                </div>

            </div>
            <div class="pic-group">

                @if($tpl_name != '' && $is_design)
                    <a href="javascript:void(0)" title="编辑" class="selector pic-selector SZY-TPL-SELECTOR"
                       data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="2">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif


                @if(!empty($data['3-2']))
                    @foreach($data['3-2'] as $k=>$v)
                        <div class="pic @if($k == 0) first @endif">
                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" class="" style="">
                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="275px" height="165px" style="display: inline;">
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="pic first">
                        <a href="javascript:void(0);" class="example-text">
                            <span>此处添加【275*165】图片</span>
                        </a>
                    </div>
                    <div class="pic">
                        <a href="javascript:void(0);" class="example-text">
                            <span>此处添加【275*165】图片</span>
                        </a>
                    </div>
                @endif

            </div>
        </div>
        <div class="main-right fr">
            <div class="industry article">
                <h2 class="article-title">

                    @if($tpl_name != '' && $is_design)
                    <a title="编辑" class="selector title-selector SZY-TPL-SELECTOR"
                       data-uid="{{ $uid }}" data-cat_id="1" data-type="4"
                       data-width="650" data-title_open_colorpicker="1" data-title_open_link="1">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                    @endif

                    @if(!empty($data['4-1']))
                        @foreach($data['4-1'] as $k=>$v)
                        <a href="javascript:void(0);" class="title">
                            <i class="title-icon"></i>
                            <span style="color: {{ $v['color'] }};">{{ $v['name'] }}</span>
                        </a>
                        @endforeach
                    @else
                        <a href="javascript:void(0);" class="title">
                            <i class="title-icon"></i>
                            <span>添加标题</span>
                        </a>
                    @endif

                </h2>
                <ul class="industry-content article-list">

                    @if($tpl_name != '' && $is_design)
                    <a title="编辑" class="selector selector2 content-selector SZY-TPL-SELECTOR"
                       data-uid="{{ $uid }}" data-cat_id="1" data-type="1" data-number="8">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                    @endif

                    @if(!empty($data['1-1']))
                        @foreach($data['1-1'] as $v)
                            <li>
                                <i class="circle-icon"></i>
                                <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}" title="{{ $v['title'] }}">{{ $v['title'] }}</a>
                            </li>
                        @endforeach
                    @else
                        @for($i=1; $i <= 8; $i++)
                            <li>
                                <i class="circle-icon"></i>
                                <a href="javascript:void(0);">文章标题1</a>
                            </li>
                        @endfor
                    @endif

                </ul>
            </div>
        </div>
    </div>
    <!-- 内容结束 -->


</div>

<!-- 调用需要的JS -->
<script type="text/javascript">

</script>

