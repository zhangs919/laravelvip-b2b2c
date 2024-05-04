<!-- 视频模板 m_video -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id=''
     data-tpl_name='{{ $tpl_name }}'
     data-tpl_type='{{ $tpl_type }}' data-is_valid='{{ $is_valid }}'>
    <div class="video-box">
        <div class="video">
            @if(!empty($video_list))
                <div class="video-introduce">ssd</div>
                <!-- 如果是一个视频class="video-list video-one"  两个视频class="video-list video-two" 三个视频class="video-list video-three"-->
                <div class="video-list @if(count($video_list) == 1){{ 'video-one' }}@elseif(count($video_list) == 2){{ 'video-two' }}@elseif(count($video_list) == 3){{ 'video-three' }}@endif">
                    @foreach($video_list as $video)
                        <!-- 视频循环此模块 _start -->
                        <div class="video-info">
                            <video id="media0" width="100%" height="100%" controls=""
                                   poster="http://xxxx/images/">
                                <source src=""
                                        type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
                            </video>
                        </div>
                        <!-- 视频循环此模块 _end -->
                    @endforeach
                </div>
            @else
                <div class="video-introduce">该店铺没有上传视频，请通过商家app上传视频</div>
            @endif
        </div>
    </div>
    <!-- 内容结束 -->
</div>

<div class="video">

</div>
