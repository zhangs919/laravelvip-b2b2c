<div id="tablelist" class="attachment-box">


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
        {{--<div id="pagination">
            <script data-page-json="true" type="text">
{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":2,"page_size":"10","page_size_list":[10,50,500,1000],"record_count":19,"page_count":2,"offset":10,"url":null,"sql":null}
</script>


            <ul class="pagination">
                <li class="" style="display: none;">
                    <a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
                </li>

                <li>
                    <a class="fa fa-angle-left" data-go-page="1" title="上一页"></a>
                </li>
                <!-- 不要问我这里写的什么逻辑，因为我看着就头疼 -->








                <!-- -->

                <li>
                    <a href="javascript:void(0);" data-go-page="1">1</a>
                </li>


                <!-- -->

                <li class="active">
                    <a data-cur-page="2">2</a>
                </li>







                <li class="disabled">
                    <a class="fa fa-angle-right" title="下一页"></a>
                </li>

                <li class="disabled" style="display: none;">
                    <a class="fa fa-angle-double-right" data-go-page="2" title="最后一页"></a>
                </li>
            </ul>

        </div>--}}

    </div>


</div>


