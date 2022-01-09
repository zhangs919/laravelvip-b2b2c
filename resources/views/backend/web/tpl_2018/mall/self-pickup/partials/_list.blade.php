<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--<th class="tcheck"> <input type="checkbox" class="checkBox allCheckBox" /></th>-->
        <th class="text-c w70" data-sortname="pickup_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <th class="w100" data-sortname="pickup_name" data-sortorder="asc" style="cursor: pointer;">自提点名称<span class="sort"></span></th>
        <th class="w300" style="cursor: default;">自提点地址</th>
        <th class="w120" style="cursor: default;">联系电话</th>
        <th class="text-c w80" data-sortname="is_show" data-sortorder="asc" style="cursor: pointer;">是否显示<span class="sort"></span></th>
        <th class="handle w120" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <!--<td class="tcheck"><input type="checkbox" class="checkBox activitycheckbox" value="" /></td>-->
        <td class="text-c">{{ $v->pickup_id }}</td>
        <td>{{ $v->pickup_name }}</td>
        <td>{{ $v->pickup_address }}</td>
        <td>{{ $v->pickup_tel }}</td>
        <td class="text-c">
            @if($v->is_show == 1)
                <span data-action="set-is-show?id={{ $v->pickup_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v->pickup_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="handle">
            <a href="/mall/self-pickup/edit?id={{ $v->pickup_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="{{ $v->pickup_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <div class="pull-right page-box">


                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>