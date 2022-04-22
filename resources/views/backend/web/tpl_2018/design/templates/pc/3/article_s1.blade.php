<!-- 默认缓载图片 -->
<!-- 文章模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='通用模板' data-is_valid='{{ $is_valid }}'>

    <div class="article-box">
        <div class="feed-index clearfix">

            @for($i=1; $i <= 3; $i++)
            <div class="notice @if($i == 2) notice-spe @endif">

                <h5 class="clearfix">
                    @if($tpl_name != '' && $is_design)
                        <a title="编辑" href="javascript:void(0)" class="title-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="{{ $i }}" data-type="4" data-width="650" data-length="8" data-title_open_link="1">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                    @endif

                    @if(!empty($data['4-'.$i]))
                        @foreach($data['4-'.$i] as $v)
                            <span class="fl">{{ $v['name'] }}</span><a class="more fr" href="{{ $v['link'] ?? 'javascript:void(0)' }}">更多 <i style="font-family:'宋体';font-style:normal">&gt;</i></a>
                        @endforeach
                    @else
                        <span class="fl">添加标题</span><a class="more fr" href="javascript:void(0)">更多 <i style="font-family:'宋体';font-style:normal">></i></a>
                    @endif
                </h5>



                <div class="article-img-box fl">

                    @if($tpl_name != '' && $is_design)
                        <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="{{ $i }}" data-type="3" data-number="1">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                    @endif

                    @if(!empty($data['3-'.$i]))
                        @foreach($data['3-'.$i] as $v)
                            <a class="article-img" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" style="display: inline;">
                            </a>
                        @endforeach
                    @else
                        <a href="javascript:void(0)" class="article-img example-text">
                    <span>
                    此处添加
                    <br>
                    【120*160】图片
                    </span>
                        </a>
                    @endif

                </div>
                <ul class="article-list fl">

                    @if($tpl_name != '' && $is_design)
                        <a title="编辑" href="javascript:void(0)" class="selector article-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="{{ $i }}" data-type="1" data-number="6" data-articlr_cat_type="1,2,11,12">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                    @endif

                    @if(!empty($data['1-'.$i]))
                        @foreach($data['1-'.$i] as $v)
                            <li>
                                <a href="{{ route('pc_show_article',['article_id'=>$v['article_id']]) }}" title="{{ $v['title'] }}" target="_blank">{{ $v['title'] }}</a>
                            </li>
                        @endforeach
                    @else
                        @for($ai=1; $ai <= 6; $ai++)
                            <li>
                                <a href="javascript:void(0)" title="文章标题--文章名称" target="_blank">文章标题--文章名称</a>
                            </li>
                        @endfor
                    @endif


                </ul>
            </div>
            @endfor

        </div>
    </div>

</div>

<script type="text/javascript">
    $.imgloading.loading();
</script>