{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <!--表单内容-->
    <div class="table-content m-t-30 clearfix">
        <form class='form-horizontal'>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <span class="ng-binding">自动发货：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div class="chose-delivery-type">
                                <label class="btn m-r-10 zb btn-warning">
                                    <i class="fa fa-check-circle "></i>
                                    禁用
                                    <input type="radio" class="hide" name="delivery_type" onclick="changeType(this.value)" value="0" checked="checked">
                                </label>
                                <label class="btn m-r-10 zb btn-default">
                                    <i class="fa fa-check-circle hide"></i>
                                    自动无需物流
                                    <input type="radio" class="hide" name="delivery_type" onclick="changeType(this.value)" value="1" >
                                </label>

                            </div>
                        </div>
                        <!-- 温馨提示 -->
                        <div id="explain" class="help-block help-block-t">
                            <div class="help-block help-block-t ">店铺禁用自动发货后，需店铺运营者人为选择订单的配送方式进行发货</div>
                            <div class="help-block help-block-t hide">店铺运营者对订单点击一键发货后，自动触发无需物流配送方式，无需选择配送方式，成功发货</div>
                            <div class="help-block help-block-t hide">店铺运营者对订单一键发货后，自动触发对接的嗖嗖物流系统的已设置好的物流快递员</div>
                            <div class="help-block help-block-t hide">自动众包：店铺运营者对订单一键发货后，自动触发对接的嗖嗖物流系统的已设置好的众包人员</div>
                            <div class="help-block help-block-t hide">店铺运营者对订单一键发货后，自动触发对接的嗖嗖物流系统中已设置好的物流跑腿公司</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg" value="确认提交" />
            </div>
        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')
@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        var oDtypeBtn = $('.chose-delivery-type .btn');
        var oRadios = oDtypeBtn.find("input[type='radio']");
        // 众包区域对象
        var obj_crowd = $('#crowdsourcing');
        // 高亮样式
        oDtypeBtn.click(function() {
            var _self = $(this);
            var idx = _self.index();
            _self.addClass('btn-warning').removeClass('btn-default').siblings('.btn').removeClass('btn-warning').addClass('btn-default');
            _self.find("i").removeClass('hide').parent().siblings().find("i").addClass('hide');
            // 温馨提示切换
            $('#explain .help-block').addClass('hide').eq(idx).removeClass('hide');
        });
        // 当前按钮选中
        oRadios.click(function() {
            // 此处必须为prop
            oRadios.prop('checked', false);
            $(this).prop('checked', true);
        });
        // 众包
        var crowdsourcing = $("#crowdsourcing");
        // 指派
        var assign = $("#assign");
        // 关联跑腿公司指派
        var relation = $('#relation');
        // 映射与调用方法
        var mapFuncs = {
            // 禁用
            "0" : function() {
                crowdsourcing.hide();
                assign.hide();
                relation.hide();
            },
            // 自动无需物流
            "1" : function() {
                crowdsourcing.hide();
                assign.hide();
                relation.hide();
            },
            // 自动指派
            "2" : function() {
                crowdsourcing.hide();
                assign.show();
                relation.hide();
            },
            // 自动众包
            "3" : function() {
                // 当众包范围的时候如果没选中自动选中第一个
                if (obj_crowd.find('input[name="crowd_type"]:checked').length == 0) {
                    obj_crowd.find('input[name="crowd_type"]').first().prop('checked', true);
                }
                crowdsourcing.show();
                assign.hide();
                relation.hide();
            },
            // 关联跑腿自动指派
            "4" : function() {
                crowdsourcing.hide();
                assign.hide();
                relation.show();
            }
        };
        //改变众包类型
        function changeType(type) {
            // 获取对应类型的操作func
            var func = mapFuncs[type];
            if (func) {
                func();
            }
        }
        /**
         * 选择快递员
         */
        $('.assign-deliver').click(function() {
            var _self = $(this);
            //---------------- 弹出选择相关的信息
            // 加载
            $.loading.start();
            var type = _self.data("type");
            var id = _self.data("id");
            var title = "选择快递员";
            var width = '800px';
            var height = '550px';
            $.open({
                // 标题
                type: 1,
                title: title,
                width: width,
                height: height,
                btn: false,
                // ajax加载的设置
                ajax: {
                    url: '/shop/config/get-postmen.html',
                    data: {
                        type: type,
                        id: id
                    }
                },
            }).always(function() {
                $.loading.stop();
            });
        });
        // 表单提交: 防止只有一个文本框的时候表单会自动提交的情况
        $('form').submit(submit);
        // 按钮提交
        $('#btn_submit').click(submit);
        var delivery_content = $('#delivery_content');
        var deliver_ids = $('#deliver_ids');
        function submit()
        {
            // 获取当前的点击类型
            var current_type = oRadios.filter(':checked').val();
            // 众包|指派 - 校验运费
            if (current_type == 2 || current_type == 3) {
                // 当指派的时候
                if(current_type == 2)
                {
                    //必须选择指派人
                    if (delivery_content.val() == '' || deliver_ids.val() == '')
                    {
                        $.msg('请输入选择快递员');
                        return false;
                    }
                }
                // 当众包的时候
                if(current_type == 3)
                {
                    var crowd_type = obj_crowd.find('input[name="crowd_type"]:checked');
                    // 必须指定众包范围
                    if (crowd_type.length == 0)
                    {
                        $.msg('请输入众包范围');
                        return false;
                    }
                }
            }
            var data = $('form').serialize();
            $.loading.start();
            // 数据提交
            $.post('/shop/config/auto-delivery.html', data, function(res) {
                if (res.code == 0) {
                    $.msg(res.message, {
                        time: 1500
                    }, function() {
                        $.go('/shop/config/auto-delivery.html');
                    });
                } else {
                    $.msg(res.message);
                }
            }, 'JSON').always(function() {
                $.loading.stop();
            });
            return false;
        }
        /**
         * 移除快递员并修改deliver_ids
         **/
        function _close(deliver_id) {
            // 处理ids
            var deliver_ids_string = $("#deliver_ids").val();
            deliver_ids_string = ',' + deliver_ids_string + ',';
            deliver_ids_string = deliver_ids_string.replace(',' + deliver_id + ',', ',');
            deliver_ids_string = deliver_ids_string.substr(1, deliver_ids_string.length - 2);
            // 处理隐藏content
            var content = delivery_content.val();
            var params = JSON.parse(content);
            if (params.length > 0)
            {
                for(var i = 0; i <params.length; i++ )
                {
                    // 从内容中移除被删除的快递员信息
                    var tmp = params[i];
                    if (deliver_id == tmp['id'])
                    {
                        params.splice(i, 1);
                        // 如果都删除不显示空数组
                        if (params.length == 0)
                        {
                            params = '';
                        }
                    }
                }
            }
            $("#deliver_ids").val(deliver_ids_string);
            $("#postmen_div_" + deliver_id).remove();
            /**
             * 将隐藏的快递员信息加入原来的位置
             * 如果params为空则不进行json序列化
             */
            if(params == '')
            {
                delivery_content.val(params);
            } else {
                delivery_content.val(JSON.stringify(params));
            }
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop