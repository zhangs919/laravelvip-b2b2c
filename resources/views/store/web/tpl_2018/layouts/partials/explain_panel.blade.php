@if(!empty($explain_panel))
<div class="explanation m-b-10">
    <div class="title explain-checkZoom" title="">
        <i class="fa fa-volume-down"></i>
        <h4>温馨提示</h4>
    </div>
    <ul class="explain-panel">
        @foreach($explain_panel as $vo)
        <li>
            <span>{!! $vo !!}</span>
        </li>
        @endforeach

    </ul>
</div>
@endif