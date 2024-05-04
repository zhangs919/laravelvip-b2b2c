<!-- 手机端资讯板式二 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>

    <!--内容区域 start-->
    <div class="article-list">

        @if($tpl_name != '' && $is_design)
            <a href="javascript:void(0)" title="编辑" class="content-selector  article-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="1" data-number="0">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        @if(!empty($data['1-1']))
            @foreach($data['1-1'] as $v)
                <a href="/news/{{ $v['article_id'] }}.html" class="article-link">

                    <div class="article-detail">
                        <strong class="tit">{{ $v['title'] }}</strong>
                        <div class="info">
                            <span class="resource">{{ $v['created_at']->format('Y-m-d H:i') }}</span>
                            <span class="paper-views">{{ $v['click_number'] }}</span>
                        </div>
                    </div>

                </a>
            @endforeach
        @else
            <a href="javascript:void(0)" class="article-link">
                <div class="article-detail">
                    <strong class="tit">文章标题</strong>
                    <div class="info">
                        <span class="resource">20xx-xx-xx xx:xx</span>
                        <span class="paper-views">x</span>
                    </div>
                </div>
                <div class="article-img">
                    <div class="story-pic fl example-text special">
                        <span>此处显示<br>文章缩略图</span>
                    </div>
                </div>
            </a>
        @endif

    </div>
    <!--内容区域 end-->
    <!--内容区域 end-->

</div>

@if($is_design)
<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="99" data-style_layout_s1="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif
