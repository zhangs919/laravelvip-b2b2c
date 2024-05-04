<link href="/css/swiper.min.css" rel="stylesheet">
<form id="searchForm">
    <input type='hidden' name='name' value=''>
    <input type='hidden' name='lat' value='0'>
    <input type='hidden' name='lng' value='0'>
    <input type='hidden' name='distance' value=''>
    <input type='hidden' name='sort' value='distance-asc'>
    <input type='hidden' name='cls_id' value=''>
</form>

{{--引入店铺列表--}}
{{--@include('shop.partials.street_shop_list')--}}
@include('shop.partials.street_shop_list_normal')