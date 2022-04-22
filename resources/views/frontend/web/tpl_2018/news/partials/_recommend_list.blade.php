<div class="main-right fr">
    <!--推荐文章-->
    <div class="industry">
        <h2 class="article-title">
            <a class="title" href="javascript:void(0)">
                <i class="title-icon"></i>
                <span>推荐文章</span>
            </a>
        </h2>
        <div class="industry-content article-recommend">

            @foreach($recommend as $k=>$v)
                <div class="content @if($k == 0) first @endif">

                    @if(!empty($v['article_thumb']))
                        <a class="pic" href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}">
                            <img src="{{ get_image_url($v['article_thumb']) }}" alt="{{ $v['title'] }}" />
                        </a>
                    @endif

                    <h3>
                        <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}" target="_blank">{{ $v['title'] }}</a>
                    </h3>

                    <p>
                        <a href="{{ route('pc_show_news', ['article_id'=>$v['article_id']]) }}" target="_blank">
                            {!! $v['summary'] !!}
                        </a>
                    </p>

                </div>
            @endforeach

        </div>
    </div>
    <!--联系我们-->
    <div class="article contact hide">
        <h2 class="article-title">
            <a class="title" href="javascript:void(0);">
                <i class="title-icon"></i>
                <span>联系我们</span>
            </a>
        </h2>
        <div class="contact-content">
            <div class="contact-code fl first">
                <div class="pic">
                    <img src="images/code1.jpg" alt="微信公众号" />
                </div>
                <h3>公众号</h3>
            </div>
            <div class="contact-code fl">
                <div class="pic">
                    <img src="images/code2.jpg" alt="手机客户端" />
                </div>
                <h3>APP</h3>
            </div>
            <div class="clear"></div>
            <div class="contact-type phone">
                <i class="icon"></i>
                <p>
                    <a href="#">垂询热线：xxx-xxxx-xxx</a>
                </p>
            </div>
            <div class="contact-type email">
                <i class="icon"></i>
                <p>
                    <a href="#">商务合作：lvli@laravelvip.com</a>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>