<!-- 店铺首页广告模板 -->
@if($is_design)
    <div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
@endif

        <!-- 广告 _start -->
        <div class="shop-ad-group2">
            <div class="shop-ad shop-ad1">


                @if(isset($data['3-1']))
                    @foreach($data['3-1'] as $v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="{{ $tpl_info['width'] }}px" height="{{ $tpl_info['height'] }}px" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0)" class="example-text full-size">
                        <span>此处添加【650*580】图片</span>
                    </a>
                @endif



                @if($tpl_name != ''  && $is_design)
                    <a title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

            </div>
            <div class="shop-ad shop-ad2">

                @if(isset($data['3-2']))
                    @foreach($data['3-2'] as $v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="{{ $tpl_info['width'] }}px" height="{{ $tpl_info['height'] }}px" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0)" class="example-text full-size">
                        <span>此处添加【540*580】图片</span>
                    </a>
                @endif


                @if($tpl_name != '' && $is_design)
                    <a title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="2" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

            </div>
            <div class="shop-ad shop-ad3">

                @if(isset($data['3-3']))
                    @foreach($data['3-3'] as $v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="{{ $tpl_info['width'] }}px" height="{{ $tpl_info['height'] }}px" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0)" class="example-text full-size">
                        <span>此处添加【380*380】图片</span>
                    </a>
                @endif


                @if($tpl_name != ''  && $is_design)
                    <a title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="3" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

            </div>
            <div class="shop-ad shop-ad4">

                @if(isset($data['3-4']))
                    @foreach($data['3-4'] as $v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="810px" height="380px" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0)" class="example-text full-size">
                        <span>此处添加【810*380】图片</span>
                    </a>
                @endif

                @if($tpl_name != ''  && $is_design)
                    <a title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="4" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

            </div>
        </div>
        <!-- 广告 _end -->

@if($is_design)
    </div>
@endif

