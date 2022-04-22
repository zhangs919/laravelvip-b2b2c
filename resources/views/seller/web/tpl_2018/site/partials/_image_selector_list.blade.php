<div id="tablelist" class="attachment-box">

    @if($image_list->isEmpty())
        <div class="no-data c-999">
            <i class="fa fa-exclamation-triangle"></i>
            <span>暂无符合条件的数据记录</span>
        </div>
    @else
        <ul class="image-list">

            @foreach($image_list as $v)
            <!--点击添加selected样式，则为已选中状态-->
            <li class="image-item" title="上传时间：{{ $v->created_at }}" data-id="{{ $v->img_id }}">
                <img class="image-box" src="{{ get_image_url($v->path) }}?x-oss-process=image/resize,m_pad,limit_0,h_120,w_120" data-path="{{ $v->path }}" data-url="{{ get_image_url($v->path) }}" data-width="{{ $v->width }}" data-height="{{ $v->height }}" />
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


