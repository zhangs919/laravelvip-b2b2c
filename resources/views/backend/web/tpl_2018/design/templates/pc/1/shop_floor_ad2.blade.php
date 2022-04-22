<!-- 店铺首页广告模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 广告 _start -->
    <div class="shop-ad-group3">


        <h2 class="shop3-title">

            @if(isset($data['3-1']))
                @foreach($data['3-1'] as $v)
                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" class="title">
                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="px" height="px" style="display: inline;">
                    </a>
                @endforeach
            @else
                <a href="javascript:void(0)" class="title example-text h70">
                    <span>此处添加【宽度、高度不限】图片</span>
                </a>
            @endif

            @if($tpl_name != '' && $is_design)
                <a title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

        </h2>


        <div class="shop-ad-group3-con">
            <div class="shop-ad-group-up">

                @if(isset($data['3-2']))
                    @foreach($data['3-2'] as $v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" class="shop-ad1">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="px" height="px" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0)" class="shop-ad1 example-text full-size h300">
                        <span>此处添加【1210*高度不限】图片</span>
                    </a>
                @endif



                @if($tpl_name != '' && $is_design)
                    <a title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="2" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

            </div>
            <div class="shop-ad-group-middle">

                @if(isset($data['3-3']))
                    @foreach($data['3-3'] as $k=>$v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" class="shop-ad{{ $k + 2 }}">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="595px" height="245px" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="" target="_blank" class="shop-ad2 example-text">
                        <span>此处添加【595*245】图片</span>
                    </a>
                    <a href="" target="_blank" class="shop-ad3 example-text">
                        <span>此处添加【595*245】图片</span>
                    </a>
                @endif



                @if($tpl_name != '' && $is_design)
                    <a title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="3" data-type="3" data-number="2">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

            </div>
            <div class="shop-ad-group-down">

                @if(isset($data['3-4']))
                    @foreach($data['3-4'] as $k=>$v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" class="shop-ad{{ $k + 4 }}">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="390px" height="175px" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0)" class="shop-ad4 example-text">
                        <span>此处添加【390*175】图片</span>
                    </a>
                    <a href="javascript:void(0)" class="shop-ad5 example-text">
                        <span>此处添加【390*175】图片</span>
                    </a>
                    <a href="javascript:void(0)" class="shop-ad6 example-text">
                        <span>此处添加【390*175】图片</span>
                    </a>
                @endif


                @if($tpl_name != '' && $is_design)
                    <a title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="4" data-type="3" data-number="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif

            </div>
        </div>
    </div>
    <!-- 广告 _end -->

</div>