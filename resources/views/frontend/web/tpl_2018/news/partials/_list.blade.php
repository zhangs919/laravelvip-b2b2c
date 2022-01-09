@if(!$list->isEmpty())
<div class="news-list" id="table_list">

    @foreach($list as $v)
        <div class="news-item">

            @if(!empty($v->article_thumb))
                <div class="fl news-pic">
                    <a href="{{ route('pc_show_news', ['article_id'=>$v->article_id]) }}" title="{{ $v->title }}">
                        <img class="fl" src="{{ get_image_url($v->article_thumb) }}" alt="{{ $v->title }}" />
                    </a>
                </div>
            @endif

            <div class="fl news-info @if(!empty($v->article_thumb)) news-info-pic @endif">
                <h3 class="news-title">
                    <a href="{{ route('pc_show_news', ['article_id'=>$v->article_id]) }}" title="{{ $v->title }}">{{ $v->title }}</a>
                </h3>
                <p class="news-tip">
                                <span>
                                    来源：{{ $v->source ?? '本网站' }}
                                </span>
                    <span>
                                    <i class="time"></i>{{ $v->add_time }}
                                </span>
                    <span>
                                    <i class="num"></i>
                        {{ $v->click_number }}
                                </span>
                </p>

                <p class="news-detail">{{ $v->summary }}</p>

            </div>
        </div>
    @endforeach

    <div class="page">


        {!! $pageHtml !!}
    </div>
</div>
@else
    <div class="tip-box">
        <img src="/frontend/images/noresult.png" class="tip-icon">
        <div class="tip-text">没有符合条件的记录</div>
    </div>
@endif