<div class="table_list">

    @if(count($image_list) > 0)
        <ul class="list">

        @foreach($image_list as $v)
            <!-- active -->
                <li class="">
                    <a href="JavaScript:void(0);">
                        <img src="{{ get_image_url($v->path) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-width="{{ $v->width }}" data-height="{{ $v->height }}" data-path="{{ $v->path }}" data-url="{{ get_image_url($v->path) }}" class="image-item" />
                        <span class="pixel">{{ $v->width }} x {{ $v->height }}</span>
                    </a>
                </li>
            @endforeach


        </ul>
        <div class="pull-right text-r page-box m-t-10">

            {!! $pageHtml !!}
        </div>

    @else
        <ul class="list null">
            <div class="warning-option">
                <i class="fa fa-exclamation-triangle c-blue"></i>
                <span>暂无符合条件的数据记录</span>
            </div>
        </ul>
    @endif

</div>