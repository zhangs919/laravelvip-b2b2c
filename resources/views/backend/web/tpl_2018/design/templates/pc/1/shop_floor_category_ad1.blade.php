<!-- 店铺首页分类广告模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 分类广告 _start -->
    <div class="shop-category-ad2">
        <div class="shop-category-con">


            @if(isset($data['3-1']))
                @foreach($data['3-1'] as $v)
                    <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" target="_blank" class="shop-category-item example-text special ">
                        <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="145px" height="200px" style="display: inline;">
                    </a>
                @endforeach
            @else
                <a href="javascript:void(0)" class="example-text special ">
                    <span>此处添加<br>【145*200】图片</span>
                </a>

                <a href="javascript:void(0)" class="example-text special ">
                    <span>此处添加<br>【145*200】图片</span>
                </a>

                <a href="javascript:void(0)" class="example-text special ">
                    <span>此处添加<br>【145*200】图片</span>
                </a>

                <a href="javascript:void(0)" class="example-text special ">
                    <span>此处添加<br>【145*200】图片</span>
                </a>

                <a href="javascript:void(0)" class="example-text special ">
                    <span>此处添加<br>【145*200】图片</span>
                </a>

                <a href="javascript:void(0)" class="example-text special ">
                    <span>此处添加<br>【145*200】图片</span>
                </a>

                <a href="javascript:void(0)" class="example-text special last">
                    <span>此处添加<br>【145*200】图片</span>
                </a>
            @endif


            @if($tpl_name != '' && $is_design)
                <a title="编辑" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="7">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

        </div>

    </div>
    <!-- 分类广告 _end -->

</div>

