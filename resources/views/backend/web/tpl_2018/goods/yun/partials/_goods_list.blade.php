<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="table-list-checkbox-all" title="全选/全不选">
        </th>
        <th>编号</th>
        <th class="active">商品名称</th>
        <th>成本价（元）</th>
        <th class="" style="cursor: default;">建议零售价（元）</th>
        <th class="handle" style="cursor: default;">操作</th>
    </tr>
    </thead>

    <tbody>

    @foreach($yun_goods as $item)
        <tr>
            <td class="tcheck">
            </td>
            <td class="text-c">5</td>
            <td>
                <div class="goodsPicBox pull-left m-r-10">
                    <a href="javascript:void(0);" target="_blank">
                        <img src="http://68products.oss-cn-beijing.aliyuncs.com/taobao-yun-images/531610068386/TB1O0Z.MVXXXXXPXVXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"
                             class="goods-thumb">
                    </a>
                </div>
                <div class="ng-binding goods-message w200">
                    <div class="name">
                        <a href="https://item.taobao.com/item.htm?id=531610068386" target="_blank" data-toggle="tooltip"
                           data-placement="auto bottom" title="" data-original-title="圣芝红酒 法国进口超级波尔多AOC干红葡萄酒 750ml">圣芝红酒
                            法国进口超级波尔多AOC干红葡萄酒 750ml</a>
                    </div>
                    <div id="message5"><label class="import-label">已导入</label></div>
                </div>
            </td>
            <td>59.00</td>
            <td>129.00</td>
            <td class="handle">
            </td>
        </tr>

        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkbox table-list-checkbox" value="6" id="checkbox6">
            </td>
            <td class="text-c">6</td>
            <td>
                <div class="goodsPicBox pull-left m-r-10">
                    <a href="javascript:void(0);" target="_blank">
                        <img src="http://68products.oss-cn-beijing.aliyuncs.com/taobao-yun-images/536073461760/TB1vJUnNVXXXXbIXVXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"
                             class="goods-thumb">
                    </a>
                </div>
                <div class="ng-binding goods-message w200">
                    <div class="name">
                        <a href="https://item.taobao.com/item.htm?id=536073461760" target="_blank" data-toggle="tooltip"
                           data-placement="auto bottom" title="" data-original-title="圣芝红酒 法国原瓶进口有防伪梅洛干红葡萄酒 750ml">圣芝红酒
                            法国原瓶进口有防伪梅洛干红葡萄酒 750ml</a>
                    </div>
                    <div id="message6"></div>
                </div>
            </td>
            <td>89.00</td>
            <td>99.00</td>
            <td class="handle">
                <a href="javascript:void(0);" data-id="6" class="del border-none delete-goods" id="import6"
                   onclick="onecheck(6)">导入</a>
                <a id="install6" style="display:none">正在导入...</a>
            </td>
        </tr>
    @endforeach


    </tbody>

    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox table-list-checkbox-all" title="全选/全不选">
        </td>
        <td colspan="5">
            <div class="pull-left">
                <input type="button" class="btn btn-danger m-r-2 delete-goods setting" id="batch_import" value="导入">
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>