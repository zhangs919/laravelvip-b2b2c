<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <!--<th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox" />
            </th>-->
            <th class="text-c w80" data-sortname="brand_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <th class="w120" data-sortname="brand_name" data-sortorder="asc" style="cursor: pointer;">品牌名称<span class="sort"></span></th>
            <th class="text-c w80" data-sortname="brand_letter" data-sortorder="asc" style="cursor: pointer;">首字母<span class="sort"></span></th>
            <th class="text-c w100" style="cursor: default;">品牌Logo</th>
            <th class="text-c w120" style="cursor: default;">品牌推广图</th>
            <th class="text-c w100" data-sortname="is_recommend" data-sortorder="asc" style="cursor: pointer;">是否推荐<span class="sort"></span></th>
            <th class="w200" data-sortname="site_url" data-sortorder="asc" style="cursor: pointer;">品牌网址<span class="sort"></span></th>
            <!--
            <th  class="text-c">品牌推荐</th>
            <th  class="text-c">是否显示</th>
             -->
            <th class="text-c w80" data-sortname="brand_sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
            <th class="handle w150" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <!--<td class="tcheck">
                <input type="checkbox" class="checkBox" value="{{ $v->brand_id }}" />
            </td>-->
            <td class="text-c">{{ $v->brand_id }}</td>
            <td>{{ $v->brand_name }}</td>
            <td class="text-c">{{ $v->brand_letter }}</td>
            <td class="text-c">


                @if($v->brand_logo != '')
                    <a href="javascript:void(0);" ref="{{ get_image_url($v->brand_logo) }}" class="preview">
                        <i class="fa fa-picture-o"></i>
                    </a>
                    <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-brand_logo" data-id="{{ $v->brand_id }}"> 更换 </span>
                @else
                    <a href="javascript:void(0);" ref="/backend/images/default/goods.gif" class="preview">
                        <i class="fa fa-picture-o"></i>
                    </a>
                    <span class="btn btn-primary btn-xs pos-r upload-img" data-url="upload-brand_logo" data-id="{{ $v->brand_id }}"> 添加 </span>
                @endif

            </td>
            <td class="text-c">
                @if($v->promotion_image != '')
                    <a href="javascript:void(0);" ref="{{ get_image_url($v->promotion_image) }}" class="preview">
                        <i class="fa fa-picture-o"></i>
                    </a>
                    <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-promotion_image" data-id="{{ $v->brand_id }}"> 更换 </span>
                @else
                    <a href="javascript:void(0);" ref="/backend/images/default/goods.gif" class="preview">
                        <i class="fa fa-picture-o"></i>
                    </a>
                    <span class="btn btn-primary btn-xs pos-r upload-img" data-url="upload-promotion_image" data-id="{{ $v->brand_id }}"> 添加 </span>
                @endif
            </td>
            <td class="text-c">
                @if($v->is_recommend == 1)
                    <span data-action="set-is-recommend?id={{ $v->brand_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-recommend?id={{ $v->brand_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td>
                <a href="" target="_blank"></a>
            </td>
            <!--
            <td  class="text-c"><span data-action="set-is-recommend?id={{ $v->brand_id }}" class="ico-switch" data-value='[0,1]' data-label='["\u7981\u6b62","\u5141\u8bb8"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>禁止</span></td>
            <td  class="text-c"><span data-action="set-is-show?id={{ $v->brand_id }}" class="ico-switch open" data-value='[0,1]' data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span></td>
             -->
            <td class="text-c">
                <font class="f14">
                    <a href="javascript:void(0);" class="brand_sort editable editable-click" data-brand_id="{{ $v->brand_id }}">{{ $v->brand_sort ?? '255'}}</a>
                </font>
            </td>
            <td class="handle">
                <a href="edit?id={{ $v->brand_id }}">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v->brand_id }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <!--<td  class="text-c w10">
                <input type="checkbox" class="allCheckBox checkBox">
                </input>
            </td>-->
            <td colspan="9">
                <div class="pull-left">
                    <!--
                    <input type="button" id="btn_delete" class="btn btn-danger m-r-2" value="删除" />
                    -->
                </div>
                <div class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>