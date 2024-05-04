<div class="article-header">
    <div class="header">
        <div class="w1210">
            <div class="logo-info">
                <a href="/" class="logo">
                    <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
                </a>
            </div>
            <div class="article-nav fl">

                <ul>

                    @foreach($navigation as $v)
                        <li>
                            <a class=""  href="{{ $v['nav_link'] ?? 'javascript:void(0)' }}" target="_blank"  title="{{ $v['nav_name'] }} ">{{ $v['nav_name'] }} </a>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="article-search-box fr">
                <form class="article-search" id="articleSearchForm" method="get" action="/news/list.html">
                    <input class="keywords" name="keyword" type="text" value="" placeholder="请输入关键字搜索">
                    <input class="search-btn " type="button">
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