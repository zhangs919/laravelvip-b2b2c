<!-- 默认缓载图片 -->
<!-- 手机端选项卡模板 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>
@endif
    
    <div class="scroll-y-menu swiper-container">
        <ul class="swiper-wrapper">
            <li class="active swiper-slide">
                @if($tpl_name != '' && $is_design)
                    <a class="title-selector content-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-length="4">
                        <i class="fa fa-edit"></i>
                    </a>
                @endif

                <a href="javascript:void(0);" class="menu-item">菜单1</a>
            </li>
            <li class="swiper-slide">
                <a href="javascript:void(0);" class="menu-item">菜单2</a>
            </li>
            <li class="swiper-slide">
                <a href="javascript:void(0);" class="menu-item">菜单3</a>
            </li>
            <li class="swiper-slide">
                <a href="javascript:void(0);" class="menu-item">菜单4</a>
            </li>
        </ul>
    </div>
    <div class="tab-floor-des">
        点击“
        <a href="javascript:void(0);" class="SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-type="99" data-style_structure_layout="1">设置样式</a>
        ”按钮，确定tab菜单个数和tab楼层
    </div>

@if($is_design)
</div>

<script type="text/javascript">
    $('#{{ $uid }}').find('.operateEdit').prepend('<a href="javascript:void(0);" class="decor-btn style-btn SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-type="99" data-style_structure_layout="1"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>设置样式</div></a>')
</script>
@endif

<script type="text/javascript">
    if ($('#{{ $uid }}').find('.goods-category-container-0').length > 0) {
        var cat_ids = $('#{{ $uid }} .category-container-0').find('input[name="cat_id"]').val();
        var is_last = '';
// 判断是否为最后一个楼层
        if ($('#{{ $uid }}').find('.goods-category-container-0').next('.floor').length > 0) {
            is_last = 0;
        }
        $.get('/site/tpl-data', {
            cat_ids: cat_ids,
            tpl_code: 'cat_goods_list',
            is_last: is_last,
            uid: '{{ $uid }}'
        }, function(result) {
            $('#{{ $uid }}').find('.goods-category-container-0').html(result.data);
            $.imgloading.loading();
        }, 'JSON');
    }

    $('#{{ $uid }} .scroll-y-menu li').click(function() {
        var event = true;
        if ($(this).hasClass('active')) {
            event = false;
        }
        $(this).addClass('active').siblings().removeClass('active');
        $('#{{ $uid }} .tab-con').eq($(this).index()).show().siblings('.tab-con').hide();
        var index = $(this).index();
        if ($('#{{ $uid }} .category-container-' + index).length > 0 && event) {
            var cat_ids = $('#{{ $uid }} .category-container-' + index).find('input[name="cat_id"]').val();
            if ($('#{{ $uid }}').find('.goods-category-container-' + index).length > 0) {
                var is_last = '';
// 判断是否为最后一个楼层
                if ($('#{{ $uid }}').find('.goods-category-container-' + index).next('.floor').length > 0) {
                    is_last = 0;
                }
                $.get('/site/tpl-data', {
                    cat_ids: cat_ids,
                    tpl_code: 'cat_goods_list',
                    is_last: is_last,
                    uid: '{{ $uid }}'
                }, function(result) {
                    $('#{{ $uid }}').find('.goods-category-container-' + index).html(result.data);
                    $.imgloading.loading();
                }, 'JSON');
            }
        }
    });
    $('#{{ $uid }} .tab-menu li').click(function() {
        var event = true;
        if ($(this).hasClass('active')) {
            event = false;
        }
        $(this).addClass('active').siblings().removeClass('active');
        $('#{{ $uid }} .tab-con').eq($(this).index()).show().siblings('.tab-con').hide();
        var index = $(this).index();
        if ($('#{{ $uid }} .category-container-' + index).length > 0 && event) {
            var cat_ids = $('#{{ $uid }} .category-container-' + index).find('input[name="cat_id"]').val();
            if ($('#{{ $uid }}').find('.goods-category-container-' + index).length > 0) {
                var is_last = '';
// 判断是否为最后一个楼层
                if ($('#{{ $uid }}').find('.goods-category-container-' + index).next('.floor').length > 0) {
                    is_last = 0;
                }
                $.get('/site/tpl-data', {
                    cat_ids: cat_ids,
                    tpl_code: 'cat_goods_list',
                    is_last: is_last,
                    uid: '{{ $uid }}',
                    shop_id: ''
                }, function(result) {
                    $('#{{ $uid }}').find('.goods-category-container-' + index).html(result.data);
                    $.imgloading.loading();
                }, 'JSON');
            }
        }
    });
    $('#{{ $uid }} .tab-nav-fold li').click(function() {
        var event = true;
        if ($(this).hasClass('current')) {
            event = false;
        }
        $(this).addClass('current').siblings().removeClass('current');
        $('#{{ $uid }} .tab-con').eq($(this).index()).show().siblings('.tab-con').hide();
        var index = $(this).index();
        if ($('#{{ $uid }} .category-container-' + index).length > 0 && event) {
            var cat_ids = $('#{{ $uid }} .category-container-' + index).find('input[name="cat_id"]').val();
            if ($('#{{ $uid }}').find('.goods-category-container-' + index).length > 0) {
                var is_last = '';
// 判断是否为最后一个楼层
                if ($('#{{ $uid }}').find('.goods-category-container-' + index).next('.floor').length > 0) {
                    is_last = 0;
                }
                $.get('/site/tpl-data', {
                    cat_ids: cat_ids,
                    tpl_code: 'cat_goods_list',
                    is_last: is_last,
                    uid: '{{ $uid }}'
                }, function(result) {
                    $('#{{ $uid }}').find('.goods-category-container-' + index).html(result.data);
                    $.imgloading.loading();
                }, 'JSON');
            }
        }
    });
    $('#{{ $uid }}').find('.tab-category-item').click(function() {
        var index = $(this).data('index');
        var cat_id = $(this).data('cat_id');
        var link = $(this).data('link');
        if ($('#{{ $uid }}').find('.goods-category-container-' + index).length > 0) {
            var is_last = '';
            if ($('#{{ $uid }}').find('.goods-category-container-' + index).next('.floor').length > 0) {
                is_last = 0;
            }
            $.get('/site/tpl-data', {
                cat_ids: cat_id,
                tpl_code: 'cat_goods_list',
                is_last: is_last,
                uid: '{{ $uid }}'
            }, function(result) {
                $('#{{ $uid }}').find('.goods-category-container-' + index).html(result.data);
                $.imgloading.loading();
            }, 'JSON');
        } else {
            $.go(link);
        }
    });
</script>