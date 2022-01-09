<div id="tablelist" class="table-responsive">
    <table class="table table-hover table-bordered">
        <tbody>


        @foreach($list as $regions)
        <tr>
            @foreach($regions as $v)
            <td class="handle text-c">
                <div>
                    <i class="location-icon m-r-5" title="已设置地区位置和经纬度"></i>
                    <b class="c-000">{{ $v['region_name'] }}</b>
                </div>
                <a href="/system/region/edit?id={{ $v['region_id'] }}" class="edit" data-id="{{ $v['region_id'] }}">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code={{ $v['region_code'] }}" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                @if($v['is_enable'] == 1)
                    <span data-action="set-enable?id={{ $v['region_id'] }}" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                @else
                    <span data-action="set-enable?id={{ $v['region_id'] }}" data-click="switch_enable_click" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>禁用</span>
                @endif
                {{--<span data-action="/system/region/set-enable?id={{ $v['region_id'] }}" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>--}}
                <span class="m-l-5 m-r-5">|</span>
                @if($v['is_scope'] == 1)
                    <span data-action="set-scope?id={{ $v['region_id'] }}" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
                @else
                    <span data-action="set-scope?id={{ $v['region_id'] }}" data-click="switch_scope_click" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>非经营地区</span>
                @endif
                {{--<span data-action="/system/region/set-scope?id={{ $v['region_id'] }}" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>--}}
            </td>
            @endforeach
        </tr>
        @endforeach


        {{--<tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">北京市</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="1">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=11" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=1" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=1" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">天津市</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="19">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=12" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=19" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=19" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">河北省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="37">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=13" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=37" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=37" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>

        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">山西省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="218">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=14" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=218" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=218" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">内蒙古自治区</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="349">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=15" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=349" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=349" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">辽宁省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="465">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=21" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=465" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=465" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">吉林省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="580">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=22" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=580" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=580" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">黑龙江省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="650">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=23" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=650" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=650" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">上海市</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="793">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=31" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=793" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=793" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">江苏省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="811">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=32" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=811" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=811" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">浙江省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="922">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=33" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=922" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=922" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">安徽省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="1024">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=34" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=1024" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=1024" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">福建省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="1146">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=35" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=1146" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=1146" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">江西省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="1241">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=36" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=1241" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=1241" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">山东省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="1353">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=37" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=1353" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=1353" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">河南省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="1508">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=41" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=1508" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=1508" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">湖北省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="1684">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=42" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=1684" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=1684" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">湖南省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="1801">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=43" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=1801" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=1801" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">广东省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="1938">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=44" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=1938" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=1938" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">广西壮族自治区</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="2079">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=45" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=2079" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=2079" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">海南省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="2204">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=46" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=2204" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=2204" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">重庆市</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="2235">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=50" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=2235" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=2235" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">四川省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="2275">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=51" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=2275" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=2275" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">贵州省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="2480">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=52" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=2480" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=2480" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">云南省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="2578">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=53" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=2578" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=2578" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">西藏自治区</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="2724">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=54" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=2724" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=2724" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">陕西省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="2806">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=61" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=2806" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=2806" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">甘肃省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="2924">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=62" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=2924" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=2924" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">青海省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="3025">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=63" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=3025" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=3025" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">宁夏回族自治区</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="3078">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=64" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=3078" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=3078" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">新疆维吾尔自治区</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="3106">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=65" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=3106" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=3106" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">台湾省</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="3226">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=71" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=3226" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=3226" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>



            <td class="handle text-c">
                <div>
                    <b style="color: #000">香港特别行政区</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="3227">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=81" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=3227" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=3227" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>




        <tr>

            <td class="handle text-c">
                <div>
                    <b style="color: #000">澳门特别行政区</b>
                </div>
                <a href="javascript:void(0);" class="edit" data-id="3246">编辑</a>
                <span class="m-l-5 m-r-5">|</span>

                <a href="/system/region/list?parent_code=82" onclick="javascript:$.loading.start();">下级</a>
                <span class="m-l-5 m-r-5">|</span>

                <span data-action="/system/region/set-enable?id=3246" data-click="switch_enable_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u7981\u7528&quot;,&quot;\u542f\u7528&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>启用</span>
                <span class="m-l-5 m-r-5">|</span>
                <span data-action="/system/region/set-scope?id=3246" data-click="switch_scope_click" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u975e\u7ecf\u8425\u5730\u533a&quot;,&quot;\u7ecf\u8425\u5730\u533a&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>经营地区</span>
            </td>

        </tr>--}}



        </tbody>
    </table>

    <div class="pull-right page-box">
        {!! $pageHtml !!}
    </div>

</div>