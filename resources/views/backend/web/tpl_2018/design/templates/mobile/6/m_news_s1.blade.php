<!-- 手机端资讯板式二 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>

    <!--内容区域 start-->
    <div class="article-list">
        <div class="article-link-type">
            <div class="article-name">

                @if($tpl_name != '' && $is_design)
                    <a href="javascript:void(0)" title="编辑" class="content-selector  article-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="1" data-number="1" style="right:-16px; top:-12px;">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                @if(!empty($data['1-1']))
                    <a class="tit" href="/news/{{ $data['1-1'][0]['article_id'] }}.html">{{ $data['1-1'][0]['title'] }}</a>
                @else
                    <a class="tit" href="javascript:void(0)">文章名称</a>
                @endif


            </div>
            <div class="infonews-u-img">

                @if($tpl_name != '' && $is_design)
                    <a href="javascript:void(0)" title="编辑" class="pic-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

                @if(!empty($data['3-1']))
                    @foreach($data['3-1'] as $k=>$v)
                        <a class="img-wrap" href="{{ $v['link'] }}">
                            <img src="{{ get_image_url($v['path']) }}">
                        </a>
                    @endforeach
                @else
                    @for($i=1; $i <= 3; $i++)
                        <span class="img-wrap">
                            <img src="/assets/d2eace91/images/design/example/ad_img_110_135_2.png">
                        </span>
                    @endfor
                @endif

            </div>
            <div class="info">

                @if(!empty($data['1-1']))
                    <span class="resource">{{ $data['1-1'][0]['created_at']->format('Y-m-d H:i') }}</span>
                    <span class="paper-views">{{ $data['1-1'][0]['click_number'] }}</span>
                @else
                    <span class="resource">20xx-xx-xx xx:xx</span>
                    <span class="paper-views">x</span>
                @endif

            </div>
        </div>
    </div>
    <!--内容区域 end-->

</div>