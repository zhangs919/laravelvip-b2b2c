<!-- 默认缓载图片 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 内容开始 -->
    <div class="w1210 clearfix">
        <div class="main-left fl">
            <div class="industry clearfix">
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
                        <a href="javascript:void(0);" class="title">
                            <i class="title-icon"></i>
                            <span>添加标题</span>
                        </a>
                    @endif


                </h2>
                <div class="industry-content industry-content-small">
                    <ul class="industry-hot">


                        @if($tpl_name != '' && $is_design)
                            <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="3">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>
                        @endif

                        @if(!empty($data['3-1']))
                            @foreach($data['3-1'] as $k=>$v)
                                <li class="@if($k == 0) first @endif">
                                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" style="">
                                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" width="260" height="165" style="display: block;">
                                    </a>
                                </li>
                            @endforeach
                        @else
                            @for($i=1; $i <= 3; $i++)
                                <li class="@if($i == 1) first @endif">
                                    <a href="javascript:void(0);" class="example-text special">
                                        <span>此处添加<br>【260*165】图片</span>
                                    </a>
                                </li>
                            @endfor
                        @endif

                        <!---->
                    </ul>
                    <div class="clearfix">

                        @for($i= 1; $i <= 3; $i++)
                            <div class="industry-text @if($i == 1) first @endif">
                                <h3>

                                    @if($tpl_name != '' && $is_design)
                                        <a title="编辑" class="selector title-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="{{ ($i+1) }}" data-type="4" data-width="650" data-title_open_link="1">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                    @if(!empty($data['4-'.($i+1)]))
                                        @foreach($data['4-'.($i+1)] as $k=>$v)
                                            <a href="javascript:void(0);" class="title" target="_blank">{{ $v['name'] }}</a>
                                        @endforeach
                                    @else
                                        <a href="javascript:void(0);" class="title">添加标题</a>
                                    @endif


                                </h3>
                                <ul>


                                    @if($tpl_name != '' && $is_design)
                                        <a title="编辑" class="selector selector2 content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="{{ $i }}" data-type="1" data-number="4">
                                            <i class="fa fa-edit"></i>
                                            编辑
                                        </a>
                                    @endif

                                    @if(!empty($data['1-'.$i]))
                                        @foreach($data['1-'.$i] as $v)
                                            <li>
                                                <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}" target="_blank" title="{{ $v['title'] }}">
                                                    <i class="square-icon"></i>
                                                    {{ $v['title'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        @for($ai=1; $ai <= 4; $ai++)
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <i class="square-icon"></i>
                                                    文章标题
                                                </a>
                                            </li>
                                        @endfor
                                    @endif


                                </ul>

                                <div class="more">
                                    <a href="javascript:void(0);">更多></a>
                                </div>

                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="main-right fr">
            <div class="right-pic">

                @if($tpl_name != '' && $is_design)
                    <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="2">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                @if(!empty($data['3-2']))
                    @foreach($data['3-2'] as $k=>$v)
                        <div class="pic @if($k == 0) first @endif">
                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" style="">
                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" width="330" height="230" style="display: block;">
                            </a>
                        </div>
                    @endforeach
                @else
                    @for($i=1; $i <= 2; $i++)
                        <div class="pic @if($i == 1) first @endif">
                            <a href="javascript:void(0);" class="first example-text">
                                <span>此处添加【330*230】图片</span>
                            </a>
                        </div>
                    @endfor
                @endif

            </div>
        </div>
    </div>
    <!-- 内容结束 -->

</div>

<!-- 调用需要的JS -->
<script type="text/javascript">

</script>