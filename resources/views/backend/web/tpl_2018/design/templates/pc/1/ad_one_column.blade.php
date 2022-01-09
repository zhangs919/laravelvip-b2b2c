<!-- 默认缓载图片 -->
<!-- 前台首页通栏广告模板 -->
@if($is_design)
    <div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

        <!-- banner下广告组 _star -->
        <div class="w1210 img-groups img-groups1">

            @if($tpl_name != '' && $is_design)
            <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}"
               data-cat_id="1" data-type="3">
                <i class="fa fa-edit"></i>
                编辑
            </a>
            @endif

            @if(!empty($data['3-1']))
            @foreach($data['3-1'] as $v)
            <a class="images-one" target="_blank" href="{{ $v['link'] ?? 'javascript:void(0)' }}" style="">
                <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="1210px" height="100px" style="display: inline;">
            </a>
            @endforeach
            @else
            <a class="images-one example-text" href="javascript:void(0);">
                <span>此处添加【1210*100】图片</span>
            </a>
            @endif

        </div>
        <!-- banner下广告组 _end -->

@if($is_design)
    </div>
@endif
