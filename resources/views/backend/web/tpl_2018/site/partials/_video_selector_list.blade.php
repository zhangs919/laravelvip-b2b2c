<div id="tablelist" class="attachment-box">

    @if($video_list->isEmpty())
        <div class="no-data c-999">
            <i class="fa fa-exclamation-triangle"></i>
            <span>暂无符合条件的数据记录</span>
        </div>
    @else
        <ul class="image-list">

        @foreach($video_list as $v)
            <!--点击添加selected样式，则为已选中状态-->
                <li class="image-item" title="H.264 / AVC / MPEG-4 AVC / MPEG-4 part 10 640x368 24fps 425.3642578125Kbps" data-id="{{ $v->video_id }}">
                    <img class="image-box" src="{{ get_image_url($v->path) }}!poster.png?x-oss-process=image/resize,m_pad,limit_0,h_120,w_120" data-path="{{ $v->path }}" data-url="{{ get_image_url($v->path) }}" data-poster="{{ get_image_url($v->path) }}!poster.png" data-width="{{ $v->width }}" data-height="{{ $v->height }}" />
                    <div class="image-meta">{{ $v->width }}*{{ $v->height }}</div>
                    <div class="image-title">{{ $v->name }}</div>
                    <div class="attachment-selected">
                        <i class="fa fa-check"></i>
                    </div>
                </li>
            @endforeach

        </ul>
        <!--分页-->
        <div class="text-r page-box">


            {!! $pageHtml !!}

        </div>

    @endif


</div>