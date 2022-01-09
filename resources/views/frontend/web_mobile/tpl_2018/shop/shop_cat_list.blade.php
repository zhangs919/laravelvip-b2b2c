<!-- 店铺分类页面 -->
<ul class="shop-submenu-left SZY-SHOP-GOODS-CAT">


    @foreach($list as $k=>$v)
    <li id="cat_item_{{ $v['cat_id'] }}" @if(current($list)['cat_id'] == $v['cat_id'])class="current"@endif data-cid="{{ $v['cat_id'] }}">
        <span class="submenu-name">{{ $v['cat_name'] }}</span>
        <span class="goods-num">{{ $v['goods_count'] }}</span>
    </li>
    @endforeach


</ul>
<div class="shop-submenu-right SZY-SHOP-GOODS-CHR">

    @foreach($list as $k=>$v)
        <ul class="@if(current($list)['cat_id'] == $v['cat_id']){{ 'hide' }}@endif" id="cat_chr_{{ $v['cat_id'] }}">

            <li>
                <span class="submenu-name" data-cat_id="{{ $v['cat_id'] }}" data-name="{{ $v['cat_name'] }}">全部</span>
                <span class="goods-num">{{ $v['goods_count'] }}</span>
            </li>

            @if(!empty($v['chr_list']))
                @foreach($v['chr_list'] as $vv)
                <li class="" id="cat_item_{{ $vv['cat_id'] }}">
                    <span class="submenu-name" data-cat_id="{{ $vv['cat_id'] }}" data-name="{{ $vv['cat_name'] }}">{{ $vv['cat_name'] }}</span>
                    <span class="goods-num">{{ $vv['goods_count'] }}</span>
                </li>
                @endforeach
            @endif

        </ul>
    @endforeach

</div>
<script type='text/javascript'>
    $('.SZY-SHOP-GOODS-CAT li').click(function() {
        var cid = $(this).data('cid');
        $(this).addClass('current').siblings().removeClass('current');
        if($('#cat_chr_' + cid).find('li').length == 1){
            $('#cat_chr_' + cid).find('li').eq(0).click();
            return;
        }
        $('#cat_chr_' + cid).siblings().hide();
        $('#cat_chr_' + cid).show();
    });

    $('.SZY-SHOP-GOODS-CHR li').click(function() {
        var form = $("#shopGoodsForm");
        var cat_id = $(this).find('span:first').data('cat_id');
        var name = $(this).find('span:first').data('name');
        if(position != 'list'){
            $.go('/shop/'+shop_id+'/list.html?cat_id='+cat_id);
            $.loading.stop();
            return;
        }
        form.find("input[name='cat_id']").val(cat_id);
        var data = form.serializeJson();
        var params = '';
        $.each(data, function(i, v) {
            params = params + '&' + i + '=' + v;
        });
        var page_url = '/shop/'+shop_id+'/list.html';
//page_url = page_url.split('?')[0];
        if (page_url.indexOf("?") == -1) {
            params = params.replace(/&/, "?");
        }
        page_url = page_url + params;
        history.pushState({}, '', page_url);
        $.go(page_url);
    });
</script>