<!-- 引入头部文件 -->
<header class="header-wrap">

    @if(!empty($is_design))
    <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" data-url='/design/navigation/list.html?nav_page=m_news&nav_position=2' data-title='资讯导航设置' data-tpl='@frontend/web_mobile/modules/library/news_index_nav.tpl' data-container='.SZY-TPL-HEADER'>
        <i class="fa fa-edit"></i>
        编辑导航
    </a>
    @endif


    <div id="article-category">
        <div class="scroll">
            <ul>

                @foreach($navigation as $v)
                    <li data-value="{{ $v['nav_link'] ?? 'javascript:void(0)' }}" class="@if($v['nav_link'] == '/'.request()->path()){{ 'cur' }}@endif">
                        <a href="{{ $v['nav_link'] ?? 'javascript:void(0)' }}" >{{ $v['nav_name'] }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

</header>
<div style="height: 45px; line-height: 45px;"></div>
