<div class="main" id="table_list">
    <!-- -->
    <ul class="shop-list">

        @foreach($list as $v)
        <li>
            <a href="{{ route('pc_shop_home', ['shop_id'=>$v->shop_id]) }}" target="_blank" title="{{ $v->shop_name }}">
                <div class="p-img">
                    <img alt="" src="{{ get_image_url($v->shop_poster) }}">
                </div>
                <div class="shop-info">
                    <div class="shop-name-wrap clearfix">
                        <div class="shop-logo fl">

                            <img alt="" src="{{ get_image_url($v->shop_logo, 'shop_logo') }}">

                        </div>
                        <div class="shop-name fl">{{ $v->shop_name }}</div>
                    </div>
                    <div class="line"></div>
                    <div class="shop-desc clearfix">
                        <p>{{ $v->shop_description }}</p>
                    </div>
                </div>
            </a>
        </li>
        @endforeach

    </ul>

    {!! $pageHtml !!}


</div>