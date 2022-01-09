<!-- 默认缓载图片 -->
<!-- 前台首页广告组模板 -->
@if($is_design)
    <div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

        <div class="w1210 img-groups img-groups-more">
            <div class="img-groups-more-left">

                @if(!empty($data['3-1']))
                    @foreach($data['3-1'] as $k=>$v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank"
                           class="@if($k == 0)img-groups-more-left-top @elseif($k == 1) img-groups-more-left-down @endif" style="">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="400px" height="190px" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0)" class="example-text dark img-groups-more-left-top">
                        <span>此处添加【400*190】图片</span>
                    </a>
                    <a href="javascript:void(0)" class="example-text dark img-groups-more-left-down">
                        <span>此处添加【400*190】图片</span>
                    </a>
                @endif

                @if($tpl_name != '' && $is_design)
                    <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="2">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

            </div>
            <ul class="img-groups-more-right">

                @if(!empty($data['3-2']))
                    @foreach($data['3-2'] as $k=>$v)
                        <li>
                            <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" style="">
                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="198px" height="190px" style="display: inline;">
                            </a>
                        </li>
                    @endforeach
                @else
                    @for($i=1; $i <= 8; $i++)
                        <li>
                            <a href="javascript:void(0)" class="example-text dark special">
                                <span>此处添加<br>【198*190】图片</span>
                            </a>
                        </li>
                    @endfor
                @endif

                @if($tpl_name != '' && $is_design)
                    <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="2" data-type="3" data-number="8">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

            </ul>
        </div>

@if($is_design)
    </div>
@endif

