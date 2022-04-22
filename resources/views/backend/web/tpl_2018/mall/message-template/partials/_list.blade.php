<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <!--                     <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th> -->
        <th class="text-c w80" data-sortname="id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <th class="w200" data-sortname="name" data-sortorder="asc" style="cursor: pointer;">模板名称<span class="sort"></span></th>
        <th class="w200" data-sortname="code" data-sortorder="asc" style="cursor: pointer;">模板标识<span class="sort"></span></th>
        <th class="text-c w150" data-sortname="sys_open" data-sortorder="asc" style="cursor: pointer;">站内信开关<span class="sort"></span></th>
        <th class="text-c w120" data-sortname="sms_open" data-sortorder="asc" style="cursor: pointer;">短信开关<span class="sort"></span></th>
        <th class="text-c w120" data-sortname="email_open" data-sortorder="asc" style="cursor: pointer;">邮件开关<span class="sort"></span></th>
        <th class="text-c w120" data-sortname="wx_open" data-sortorder="asc" style="cursor: pointer;">微信开关<span class="sort"></span></th>
        <th class="w150" data-sortname="last_modify" data-sortorder="asc" style="cursor: pointer;">最后修改时间<span class="sort"></span></th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
        <tr>
            <!--                     <td class="tcheck">
                <input type="checkbox" class="checkBox" value="149" />
            </td> -->
            <td class="text-c">{{ $v->id }}</td>
            <td>{{ $v->name }}</td>
            <td>{{ $v->code }}</td>
            <td class="text-c">
                @if($v['sys_open'] == 1)
                    <span data-action="set-sys-open?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5173&quot;,&quot;\u5f00&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>开</span>
                @else
                    <span data-action="set-sys-open?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5173&quot;,&quot;\u5f00&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>关</span>
                @endif
            </td>
            <td class="text-c">
                @if($v['sms_open'] == 1)
                    <span data-action="set-sms-open?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5173&quot;,&quot;\u5f00&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>开</span>
                @else
                    <span data-action="set-sms-open?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5173&quot;,&quot;\u5f00&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>关</span>
                @endif
            </td>
            <td class="text-c">
                @if($v['email_open'] == 1)
                    <span data-action="set-email-open?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5173&quot;,&quot;\u5f00&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>开</span>
                @else
                    <span data-action="set-email-open?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5173&quot;,&quot;\u5f00&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>关</span>
                @endif
            </td>
            <td class="text-c">
                @if($v['wx_open'] == 1)
                    <span data-action="set-wx-open?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5173&quot;,&quot;\u5f00&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>开</span>
                @else
                    <span data-action="set-wx-open?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5173&quot;,&quot;\u5f00&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>关</span>
                @endif
            </td>
            <td>{{ date('Y-m-d H:i:s', $v->last_modify) }}</td>
            <td class="handle">

                <a href="set?id={{ $v->id }}&amp;type=sys">设置</a>
            </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <!--                     <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox">
            </input>
        </td> -->
        <td colspan="9">
            <!--                         <div class="pull-left">
                <input type="button" id="btn_delete" class="btn btn-danger m-r-2" value="删除" />
                当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled
            </div> -->
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
