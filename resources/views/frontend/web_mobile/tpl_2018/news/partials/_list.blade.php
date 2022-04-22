@foreach($list as $v)
    <div class="article-list">
        <a href="{{ route('mobile_show_news', ['article_id'=>$v->article_id]) }}" class="article-link">

            <div class="article-detail">
                <strong class="tit">{{ $v->title }}</strong>
                <div class="info">
                    <span class="resource">{{ $v->add_time }}</span>
                    <span class="paper-views">{{ $v->click_number }}</span>
                </div>
            </div>

            <div class="article-img">
                <img class="img" src="{{ get_image_url($v->article_thumb) }}">
            </div>

        </a>
    </div>
@endforeach