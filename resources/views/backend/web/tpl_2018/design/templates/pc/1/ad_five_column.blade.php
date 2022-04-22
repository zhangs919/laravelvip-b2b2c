<!-- 默认缓载图片 -->
<!-- 前台首页5栏广告模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <div class="w1210 img-groups img-groups5">

        @if($tpl_name != '' && $is_design)
            <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}"
               data-cat_id="1" data-number="5" data-type="3">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        <div class="img-groups5-layout">
            <div class="img-groups5-list">

                @if(!empty($data['3-1']))
                    @foreach($data['3-1'] as $v)
                        <div class="item">
                            <a class="suspend-img" target="_blank" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="242px" height="350px" style="display: inline;">
                            </a>
                        </div>
                    @endforeach
                @else
                    @for($i=1; $i <= 5; $i++)
                        <div class="item">
                            <a class="suspend-img example-text {{ $i % 2 == 1 ? 'dark' : ''}}" href="javascript:void(0);">
                                <span>此处添加【242*350】图片</span>
                            </a>
                        </div>
                    @endfor
                @endif

            </div>
        </div>

    </div>

</div>

