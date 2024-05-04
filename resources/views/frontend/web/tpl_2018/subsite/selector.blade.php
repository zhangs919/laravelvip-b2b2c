<div id="welcome-bg" class="welcome-bg"></div>
<div id="welcome" class="welcome SZY-SUBSITE-SELECTER">
    <div class="site-tit">
        请选择站点：
        <a class="site-close" title="关闭" href="javascript:void(0);"></a>
        <!-- <span class="site-close" title="关闭"></span> -->
    </div>
    <div class="site-content">
        <ul>
            <li>
                <a href="/subsite/index.html?site_id=14" class="select-site" data-site-id="14" title="大同站点">大同站点</a>
            </li>
            <li>
                <a href="/subsite/index.html?site_id=21" class="select-site" data-site-id="21" title="dhds">dhds</a>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    //
</script><script>

    $().ready(function() {
//如果是第一次访问网站，弹出站点选择框
        $('#welcome').css('display', 'block');
        $('#welcome-bg').css('display', 'block');
        $('#welcome').css('left', ($(window).width() - 600) / 2);
        $('#welcome').css('top', ($(window).height() - 300) / 2);
        $('html').css({
            'height': '100%',
            'overflow': 'hidden'
        });
        $(".select-site").click(function() {
            var site_id = $(this).data("site-id");
            var exp = new Date();
            exp.setTime(exp.getTime() + 365 * 24 * 60 * 60 * 1000);
            document.cookie = "SZY_SITE=" + site_id + ";path=/;expires=" + exp.toGMTString();

            $('#welcome').hide();
            $('#welcome-bg').css('display', 'none');
            $('html').css({
                'height': 'auto',
                'overflow': 'auto'
            })

        });
        $('.site-close').click(function() {
            $('#welcome').css('display', 'none');
            $('#welcome-bg').css('display', 'none');
            $('html').css({
                'height': 'auto',
                'overflow': 'auto'
            })
        })
        $("#ui-content-wrap").jScroll();
    });

    //
</script>