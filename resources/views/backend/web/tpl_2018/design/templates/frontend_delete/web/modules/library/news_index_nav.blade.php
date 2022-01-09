<!-- 引入头部文件 -->
<div class="article-header">
    <div class="header">
        <div class="w1210">
            <div class="logo-info">
                <a href="/" class="logo">
                    <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
                </a>
            </div>
            <div class="article-nav fl">

                <a href="javascript:void(0)" class="selector SZY-TPL-SETTING" data-url='/design/navigation/list?nav_page=news&nav_position=2' data-title='资讯导航设置' data-tpl='@frontend/web/modules/library/news_index_nav.tpl' data-container='.SZY-TPL-HEADER'>
                    <i class="fa fa-edit"></i>
                    编辑资讯导航
                </a>


                <ul>


                    @foreach($navigation as $v)
                    <li>
                        <a class="" href="{{ $v->nav_link ?? 'javascript:void(0)' }}" title="{{ $v->nav_name }}">{{ $v->nav_name }} </a>
                    </li>
                    @endforeach


                </ul>
            </div>
            <div class="article-search-box fr">
                <form class="article-search" id="articleSearchForm" method="get" action="/news/list.html">
                    <input class="keywords" name="keyword" type="text" value="" placeholder="请输入关键字搜索">
                    <input class="search-btn disabled" type="button">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#articleSearchForm').find('.search-btn').click(function(){
        if($(this).hasClass('disabled')){
            return false;
        }
        if($.trim($('#articleSearchForm').find("input[name='keyword']").val())==''){
            $.msg("请输入关键字");
            $('#articleSearchForm').find("input[name='keyword']").focus();
            return false;
        }
        $('#articleSearchForm').submit();
    });
</script>