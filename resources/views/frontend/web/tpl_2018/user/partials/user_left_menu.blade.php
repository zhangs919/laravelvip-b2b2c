{{--用户中心 左侧菜单--}}
<!-- 引入左侧导航条文件 -->
<div class="con-left fl" style="height:auto; ">
    <div class="nav-list">

        @foreach($left_menus as $key=>$left_menu)

            <div class="func func{{ $key }}">
                <p class="title">
                    <i></i>
                    <span>{{ $left_menu['title'] }}</span>
                </p>

                @foreach($left_menu['child'] as $child)
                    <a href="{{ $child['url'] }}" class="item @if(request()->path() == ltrim($child['url'], '/')) curs @endif" @if(isset($child['target']) && $child['target'] == 'blank')target="_blank"@endif>
                        <span>{{ $child['title'] }}</span>
                        <i class="iconfont">&#xe6b9;</i>
                    </a>
                @endforeach

            </div>

        @endforeach

    </div>
</div>