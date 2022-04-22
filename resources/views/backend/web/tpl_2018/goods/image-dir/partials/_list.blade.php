<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <!--<th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox" />
            </th>-->
            <th class="text-c w80" data-sortname="dir_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
            <th class="w200" data-sortname="dir_name" data-sortorder="asc" style="cursor: pointer;">相册名称<span class="sort"></span></th>
            <th class="w150" data-sortname="dir.site_id,dir.shop_id,dir.dir_id" data-sortorder="asc" style="cursor: pointer;">分组<span class="sort"></span></th>
            <th class="text-c w100" style="cursor: default;">封面图片</th>
            <th class="text-c w100" data-sortname="image_number" data-sortorder="asc" style="cursor: pointer;">图片数量<span class="sort"></span></th>
            <th class="w200" data-sortname="dir_desc" data-sortorder="asc" style="cursor: pointer;">描述<span class="sort"></span></th>
            <th class="handle w150" style="cursor: default;">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $v)
        <tr>
            <!--<td class="tcheck">
                <input type="checkbox" class="checkBox" value="" />
            </td>-->
            <td class="text-c">{{ $v->dir_id }}</td>
            <td>{{ $v->dir_name }}</td>
            <td>

                {{ image_dir_group($v->dir_group) }}

            </td>
            <td class="text-c">

                <a href="javascript:void(0);" ref="{{ get_image_url($v->dir_cover,1) }}" class="preview">
                    <i class="fa fa-picture-o"></i>
                </a>

            </td>
            <td class="text-c">
                {{ $v->image_count }}
            </td>
            <td>
                <font class="f14">{{ $v->dir_desc }}</font>
            </td>
            <td class="handle">




                <a href="/goods/image/list?dir_id={{ $v->dir_id }}">查看</a>

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
            <td colspan="7">
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