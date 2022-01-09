{{--首页显示--}}
<div class="category-box @if(!request()->routeIs('pc_home')){{ 'category-box-border' }}@endif">
    <div class="w1210">
        <div class="home-category @if(request()->routeIs('pc_home')){{ 'bg-color' }}@endif fl">
            <a href="/category.html" class="menu-event" title="查看全部商品分类">
                <i></i>
                全部商品分类
            </a>




            @if(!request()->routeIs('pc_home'))
                <!-- 带有二级分类的分类导航 _start -->

                    <div class="expand-menu category-layer category-layer2" style="display: none;">
                        <span class="category-layer-bg bg-color"></span>

                        @include('layouts.partials.category_layer')

                    </div>

                <!-- 带有二级分类的分类导航 _end -->
            @endif

        </div>

        <div class="all-category fl" id="nav">

            <ul>

                @foreach($navigation as $v)
                    <li class="@if($v->nav_layout == 1) fl @else fr @endif">
                        <a class="nav " href="{{ $v->nav_link ?? 'javascript:void(0)'}}"  title="{{ $v->nav_name }}">{{ $v->nav_name }}</a>
                        <!-- 导航小标签 _start -->

                        @if(!empty($v->nav_icon))
                            <span class="nav-icon">
                                <img src="{{ get_image_url($v->nav_icon) }}" />
                            </span>
                        @endif

                    <!-- 导航小标签 _end -->
                    </li>
                @endforeach

            </ul>

            @if(request()->routeIs('pc_home'))
                <div class="wrap-line">
                    <span style="left: 15px;"></span>
                </div>
            @endif

        </div>


            @if(request()->routeIs('pc_home'))
                <div class="category-layer category-layer2">

                    <span class="category-layer-bg bg-color"></span>

                    @include('layouts.partials.category_layer')

                </div>


                <!-- 带有二级分类的分类导航 _start -->

                <!-- 带有二级分类的分类导航 _end -->
            @endif

    </div>
</div>

