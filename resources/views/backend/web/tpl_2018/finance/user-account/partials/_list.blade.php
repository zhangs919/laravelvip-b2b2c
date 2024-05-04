<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w80 text-c" data-sortname="" style="cursor: default;">编号</th>
        <th class="w300" data-sortname="" style="cursor: pointer;">会员信息</th>
        <th class="w150" data-sortname="" style="cursor: pointer;">会员等级</th>
        <th class="w200" data-sortname="user_money" data-sortorder="asc" style="cursor: pointer;">账户资金<span class="sort"></span></th>
        <th class="handle w200" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $item)
        <tr>
            <td class="text-c">{{ $item->id }}</td>
            <td>
                会员账号：{{ $item->user->user_name ?? '' }}
                <br>
                会员昵称：{{ $item->user->nickname ?? '' }}
                <br>
                真实姓名：{{ $item->user->userReal->real_name ?? '' }}
                <br>
                手机号码：{{ $item->user->mobile ?? '' }}
            </td>
            <td>{{ $item->user->userRank->rank_name ?? '' }}</td>
            <td>{{ $item->amount }}</td>
            <td class="handle">
{{--                <a href="javascript:void(0);" data-id="{{ $item->id }}" class="del border-none">删除</a>--}}
            </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
