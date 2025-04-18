<table id="table_list" class="table table-hover">
    <thead>
    <tr>

        <th class="w200">用户ID</th>
        <th class="w150">姓名</th>
        <th class="w100" style="cursor: default;">身份证号码</th>
{{--        <th class="w100" style="cursor: default;">身份证正面</th>--}}
{{--        <th class="w100" style="cursor: default;">身份证反面</th>--}}
{{--        <th class="w100" style="cursor: default;">手持身份证</th>--}}
        <th class="w150">认证状态</th>
        <th class="w150">认证备注</th>
        <th class="handle w100">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
        <tr>

            <td>{{ $v->user_id }}</td>
            <td>
                <span title="{{ $v->user_real->real_name ?? '' }}">{{ $v->userReal->real_name ?? '' }}</span>
            </td>
            <td class="text-c">
                {{ $v->userReal->id_code }}
            </td>
{{--            <td class="text-c">--}}
{{--                <a href="javascript:void(0);" ref="@if(!empty($v->userReal->card_pic1)) {{ get_image_url($v->user_real->card_pic1) }} @else /images/default/goods.gif @endif" class="preview">--}}
{{--                    <i class="fa fa-picture-o"></i>--}}
{{--                </a>--}}
{{--            </td>--}}
{{--            <td class="text-c">--}}
{{--                <a href="javascript:void(0);" ref="@if(!empty($v->userReal->card_pic2)) {{ get_image_url($v->user_real->card_pic2) }} @else /images/default/goods.gif @endif" class="preview">--}}
{{--                    <i class="fa fa-picture-o"></i>--}}
{{--                </a>--}}
{{--            </td>--}}
{{--            <td class="text-c">--}}
{{--                <a href="javascript:void(0);" ref="@if(!empty($v->userReal->card_pic3)) {{ get_image_url($v->user_real->card_pic3) }} @else /images/default/goods.gif @endif" class="preview">--}}
{{--                    <i class="fa fa-picture-o"></i>--}}
{{--                </a>--}}
{{--            </td>--}}
            <td>{{ str_replace([0,1,2,3], ['未认证', '认证通过', '认证中', '认证不通过'], $v->live_verified) }}</td>
            <td>{{ $v->live_verified_remark }}</td>
            <td class="handle">
                @if($v->live_verified == 2)
                    <a href="javascript:void(0);" data-id="{{ $v->user_id }}" class="audit ">审核</a>
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>

        <td colspan="6">
            <div class="pull-left">
            {{--                <input type="button" id="btn_delete" class="btn btn-danger m-r-2" value="批量删除" />--}}
            <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
