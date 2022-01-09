<!-- 默认缓载图片 -->
<!-- 前台首页6栏广告模板 -->
@if($is_design)
    <div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

        <div class="quality-box">
            <div class="quality-list">
                <ul class="clearfix">

                    @for($i=1; $i <= 6; $i++)
                        <li class="quality-item">

                            @if(!empty($data['4-'.$i]))
                                @foreach($data['4-'.$i] as $v)
                                    <div class="quality-bg" style="background-color: {{ $v['bgcolor'] }}; ">
                                        <div class="quality-info">

                                            @if($tpl_name != '' && $is_design)
                                                <a href="javascript:void(0)" class=" title-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="{{ $i }}" data-title_open_colorpicker="1" data-title_open_second="1" data-title_open_bgcolor="1" data-number="5" data-type="4">
                                                    <i class="fa fa-edit"></i>
                                                    编辑
                                                </a>
                                            @endif

                                            <h4 class="quality-info-tit" style="color:{{ $v['color'] }};">{{ $v['name'] }}</h4>

                                            <p class="quality-info-desc">{{ $v['second_name'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="quality-bg" style="background: #59b07d;">
                                    <div class="quality-info">
                                        @if($tpl_name != '' && $is_design)
                                            <a href="javascript:void(0)" class=" title-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="{{ $i }}" data-title_open_colorpicker="1" data-title_open_second="1" data-title_open_bgcolor="1" data-number="5" data-type="4">
                                                <i class="fa fa-edit"></i>
                                                编辑
                                            </a>
                                        @endif

                                        <h4 class="quality-info-tit">填写主标题</h4>
                                        <p class="quality-info-desc">填写副标题</p>
                                    </div>
                                </div>
                            @endif


                            @if(!empty($data['3-'.$i]))
                                @foreach($data['3-'.$i] as $v)
                                    <a class="quality-href" target="_blank" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="400px" height="170px" style="display: inline;">
                                    </a>
                                @endforeach
                            @else
                                <a class="example-text full-size" href="javascript:void(0);">
                                    <span>此处添加【400*170】图片</span>
                                </a>
                            @endif

                            @if($tpl_name != '' && $is_design)
                                <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}"
                                   data-cat_id="{{ $i }}" data-number="1" data-type="3">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif

                        </li>
                    @endfor


                </ul>
            </div>
        </div>

@if($is_design)
    </div>
@endif
