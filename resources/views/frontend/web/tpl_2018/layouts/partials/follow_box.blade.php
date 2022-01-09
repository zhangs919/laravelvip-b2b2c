<!-- 头部滚动通栏悬浮框 _start -->
<!-- 注意此效果只在首页面展示 -->
<div class="as-shelter"></div>
<div class="follow-box">
    <div class="follow-box-con">
        <a href="/" class="logo">
            <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
        </a>
        <div class="search SZY-SEARCH-BOX-TOP">
            <form class="search-form SZY-SEARCH-BOX-FORM" method="get" name="" action="/search.html">
                <div class="search-info">
                    <div class="search-type-box">
                        <ul class="search-type">
                            <li class="search-li-top curr" num="0">宝贝</li>
                            <li class="search-li-top" num="1">店铺</li>
                        </ul>
                        <i></i>
                    </div>
                    <div class="search-box">
                        <div class="search-box-con">
                            <input type="text" class="search-box-input SZY-SEARCH-BOX-KEYWORD" name="keyword" tabindex="9" autocomplete="off" data-searchwords="榨汁机" placeholder="榨出营养,喝出健康" value="" />
                        </div>
                    </div>
                    <input type='hidden' id="searchtypeTop" name='type' value="0" class="searchtype" />
                    <input type="button" id="btn_search_box_submit_top" value="搜索" class="button bg-color SZY-SEARCH-BOX-SUBMIT-TOP" />
                </div>
            </form>
        </div>
        <div class="login-info">
            <font id="login-info" class="login-info SZY-USER-NOT-LOGIN">
                <a class="login color" href="/login.html" target="_top">登录</a>
                <a class="register bg-color" href="/register.html" target="_top">免费注册</a>
            </font>
            <font id="login-info" class="login-info SZY-USER-ALREADY-LOGIN" style="display: none;">
                <em>
                    <a href="/user.html" target="_blank" class="color SZY-USER-NAME"></a>
                </em>
                <a href="/site/logout.html" data-method="post" class="logout bg-color">退出</a>
            </font>
        </div>
    </div>
</div>
<!-- 头部滚动通栏悬浮框 _end -->