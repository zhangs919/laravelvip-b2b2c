<!-- 手机端附近店铺模板 -->
<div class="drop-item SZY-PAGINATION-TPL {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_id='' data-shop_id='' data-tpl_name='{{ $tpl_name }}' data-tpl_type='{{ $tpl_type ?? '' }}' data-is_valid='{{ $is_valid }}'>

    @if($tpl_name != '' && $is_design)
        <a title="编辑" class="content-selector shop-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="9" data-number="99" data-show_shop_class="1">
            <i class="fa fa-edit"></i>
            编辑
        </a>
    @endif

    <div class="nearby-shops-box">
        <!-- <div class="more-loader-spinner">
        <img src="/assets/d2eace91/images/common/search_loading.gif" width="30" height="30">
        正在搜索附近的商家
        </div> -->
    </div>
    <script type="text/javascript">
        var is_design = '{{ $is_design }}';
        var is_frontend = '';
        if(sessionStorage.near_shop_ && is_frontend){
            $('.nearby-shops-box').html(sessionStorage.near_shop_);
        }else{
            $('.nearby-shops-box').html('<div class="shop-loading-con"><img src="/assets/d2eace91/images/common/shop_loading_icon.png"><div class="shop-loading-text">正在为您定位,搜索附近店铺...</div></div>');
            if (sessionStorage.geolocation) {
                var data = $.parseJSON(sessionStorage.geolocation);
                loadlist(data);
            }else{
                setTimeout(function() {
//获取坐标
                    $.geolocation({
                        callback: function(data) {
                            loadlist(data);
                        }
                    });
                },500);
            }
        }
        function loadlist(data) {
            $.ajax({
                url: '/site/tpl-data',
                dataType: 'json',

                data: {
                    lat: data.lat,
                    lng: data.lng,
                    tpl_code: 'm_near_shop',


                    is_last: ''
                },
                success: function(result) {

                    if (result.data == null) {
                        $('.nearby-shops-box').html('<div class="shop-loading-con"><img src="/assets/d2eace91/images/common/shop_loading_icon.png"><div class="shop-loading-text">'+result.message+'</div></div>');
                    } else {
                        $('.nearby-shops-box').html(result.data);
                        is_opening();
                        sessionStorage.near_shop_ = result.data;
                    }
                }
            });
        }
        //判断商家是否休息
        function is_opening() {

        }
    </script>


</div>
<!--附近商家start-->
<!--附近商家end--->
