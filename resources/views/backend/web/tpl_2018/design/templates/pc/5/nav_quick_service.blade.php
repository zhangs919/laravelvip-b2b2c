<!-- 快捷菜单-->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- banner右侧快捷菜单 _start -->
    <div class="shortcut-menu">


        @if($tpl_name != '' && $is_design)
            <a href="javascript:void(0)" class="selector SZY-TPL-SETTING" title="编辑" data-uid="{{ $uid }}" data-url="/design/nav-quick-service/list" data-title="快捷服务">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        <ul class="clearfix">

            @foreach($quickService as $v)
                <li>
                    <a target="_blank" href="{{ $v->qs_link ?? '#'}}" title="{{ $v->qs_name }}">
                        <img src="{{ get_image_url($v->qs_icon) }}">
                        <p>{{ $v->qs_name }}</p>
                    </a>
                </li>
            @endforeach

        </ul>


    </div>
    <!-- banner右侧快捷菜单 _end -->

</div>

