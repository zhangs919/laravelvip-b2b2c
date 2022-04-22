<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" />
        </th>
        <th >编号</th>
        <th class="active" >商品名称</th>
        <th>成本价（元）</th>
        <th>建议零售价（元）</th>
        <th class="handle">操作</th>
    </tr>
    </thead>

    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
        </td>
        <td class="text-c">3</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="javascript:void(0);" target="_blank">
                    <img src="http://68products.oss-cn-beijing.aliyuncs.com/taobao-yun-images/42566859005/TB1wVs2MVXXXXcjaXXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"></img>
                </a>
            </div>
            <div class="ng-binding goods-message w200">
                <div class="name">
                    <!-- https://item.taobao.com/item.htm?id=42566859005 -->
                    <a href="javascript:void(0)"  data-toggle="tooltip" data-placement="auto bottom" title="西班牙进口红酒浪漫之花桃红甜起泡酒葡萄酒750ml/瓶">西班牙进口红酒浪漫之花桃红甜起泡酒葡萄酒750ml/瓶</a>
                </div>
                <div id="message3"><label class="import-label" >已导入</label></div>
            </div>
        </td>
        <td>49.00</td>
        <td>118.00</td>
        <td class="handle">
        </td>
    </tr>

    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkbox" value="54" id="checkbox54"></input>					</td>
        <td class="text-c">54</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="javascript:void(0);" target="_blank">
                    <img src="http://68products.oss-cn-beijing.aliyuncs.com/taobao-yun-images/536573298695/TB19BOFNFXXXXX6apXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"></img>
                </a>
            </div>
            <div class="ng-binding goods-message w200">
                <div class="name">
                    <!-- https://item.taobao.com/item.htm?id=536573298695 -->
                    <a href="javascript:void(0)"  data-toggle="tooltip" data-placement="auto bottom" title="法国进口红酒 罗莎克罗斯红葡萄酒 罗莎红酒 750ml">法国进口红酒 罗莎克罗斯红葡萄酒 罗莎红酒 750ml</a>
                </div>
                <div id="message54"></div>
            </div>
        </td>
        <td>29.90</td>
        <td>69.00</td>
        <td class="handle">
            <a href="javascript:void(0);" data-id="54" class="del border-none delete-goods" id="import54" onclick="onecheck(54)">导入</a>
            <a id="install54" style="display:none">正在导入...</a>
        </td>
    </tr>
    @endforeach





    </tbody>

    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" />
        </td>
        <td colspan="5">
            <div class="pull-left">
                <input type="button" class="btn btn-danger m-r-2 delete-goods setting" id="batch_import" value="导入"/>
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>