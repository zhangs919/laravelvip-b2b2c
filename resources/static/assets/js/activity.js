$(function () {

    /**
     * 获取 baseurl
     * @param function|string baseurl url
     * @param target 目标元素
     * @returns {*}
     */
    function getBaseUrl(baseurl, target) {
        if ($.isFunction(baseurl)) {
            return baseurl(target);
        }
        return baseurl;
    }

    // 活动列表
    $.activityList = function (settings) {
        var defaults = {
            // 为空或者必须以 "/" 结尾
            // 支持回调函数
            baseurl: "",
            tablelist: null,
            container: $("body"),
            promote: {
                // 推广码的选择器
                selector: ".promote-activity",
                // 标题
                title: "活动推广码",
                // 推广链接
                url: null
            },
            // 结束或的选择器
            endSelector: ".end-activity",
            // 删除活动的选择器
            deleteSelector: ".delete-activity",
            // 上传活动图片的选择器
            editImageSelector: ".edit-activity-image",
            // 编辑活动排序的选择器
            editSortSelector: ".edit-activity-sort",
            // 重新加载
            reload: function () {
                var settings = this;
                if ($.isFunction($().editable)) {
                    // 编辑排序，需要提供给 data-id 属性
                    $(settings.container).find(settings.editSortSelector).each(function () {
                        var target = this;
                        $(this).editable({
                            type: "text",
                            url: getBaseUrl(settings.baseurl, target) + "edit-activity",
                            pk: 1,
                            ajaxOptions: {
                                type: "post",
                                dataType: "JSON",
                            },
                            params: function (params) {
                                params.act_id = $(this).data("id");
                                params.title = 'sort';
                                return params;
                            },
                            validate: function (value) {
                                value = $.trim(value);
                                var ex = /^\d+$/;
                                if (!value) {
                                    return '排序不能为空。';
                                } else if (!ex.test(value)) {
                                    return '排序必须是0~255的正整数。';
                                } else if (value > 255) {
                                    return '排序必须是0~255的正整数。';
                                }
                            },
                            success: function (result, newValue) {
                                // 错误处理
                                if (result.code == 0) {
                                    $.msg(result.message, {
                                        time: 1500
                                    });
                                    return true;
                                } else if (result.message) {
                                    $.msg(result.message, {
                                        time: 3000
                                    });
                                }
                                return false;
                            },
                            display: function (value, sourceData) {
                                // 显示整数
                                $(this).html((Number(value)).toFixed(0));
                            },
                            error: function (response, newValue) {
                                console.error(response)
                            }
                        });
                    });

                    // 编辑活动库存，需要提供给 data-id 属性
                    $(settings.container).find(settings.editActStockSelector).each(function () {
                        var target = this;
                        $(this).editable({
                            type: "text",
                            url: getBaseUrl(settings.baseurl, target) + "edit-activity",
                            pk: 1,
                            ajaxOptions: {
                                type: "post",
                                dataType: "JSON",
                            },
                            params: function (params) {
                                params.act_id = $(this).data("id");
                                params.title = 'act_stock';
                                return params;
                            },
                            validate: function (value) {
                                value = $.trim(value);
                                if (!value) {
                                    return '活动库存不能为空。';
                                } else if (!/^\d+$/.test(value)) {
                                    return '活动库存必须是正整数。';
                                }
                            },
                            success: function (result, newValue) {
                                // 错误处理
                                if (result.code == 0) {
                                    $.msg(result.message, {
                                        time: 1500
                                    });
                                    return true;
                                } else if (result.message) {
                                    $.msg(result.message, {
                                        time: 3000
                                    });
                                }
                                return false;
                            },
                            display: function (value, sourceData) {
                                // 显示整数
                                $(this).html((Number(value)).toFixed(0));
                            },
                            error: function (response, newValue) {
                                console.error(response)
                            }
                        });
                    })
                }
            },
        };

        settings = $.extend({}, defaults, settings);

        if (settings.tablelist == null && typeof tablelist != 'undefined') {
            settings.tablelist = tablelist;
        }

        // 设置活动结束
        $(settings.container).on("click", settings.endSelector, function () {
            var act_id = $(this).data("id");
            var act_name = $(this).data("name");
            if (act_name != '') {
                act_name = '【' + act_name + '】';
            }

            var target = this;

            $.confirm("您确定要结束活动" + act_name + "吗？", function () {
                $.loading.start();
                $.post(getBaseUrl(settings.baseurl, target) + "end-activity", {
                    act_id: act_id
                }, function (result) {
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 1500
                        }, function () {
                            if (settings.tablelist) {
                                settings.tablelist.load();
                            }
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function () {
                    $.loading.stop();
                });
            });
        });

        // 删除活动结束
        $(settings.container).on("click", settings.deleteSelector, function () {

            var ids = [];
            var act_id = $(this).data("id");
            var act_name = $(this).data("name");
            var message = "您确定要删除选中的活动吗？";

            if (act_id && act_name) {
                message = "您确定删除活动【" + act_name + "】吗？";
            }

            if (!act_id) {
                ids = settings.tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
            } else {
                ids.push(act_id);
            }

            var target = this;

            $.confirm(message, function () {
                $.loading.start();
                $.post(getBaseUrl(settings.baseurl, target) + "delete-activity", {
                    ids: ids
                }, function (result) {
                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 1500
                        }, function () {
                            if (settings.tablelist) {
                                settings.tablelist.load();
                            }
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function () {
                    $.loading.stop();
                });
            });
        });

        // <a href="javascript:void(0);" ref="{if $object.act_img}{imageurl($object.act_img)}{else}{static}/images/default/goods.gif{/if}" className="preview">
        //     <i className="fa fa-picture-o"></i>
        // </a>
        // <span className="btn btn-success btn-xs pos-r edit-activity-image" data-id="{$object.act_id}">更换</span>
        $(settings.container).on("click", settings.editImageSelector, function () {
            var act_id = $(this).data("id");

            if (!act_id) {
                $.msg("活动ID不能为空");
                return;
            }

            var image = $(this).siblings("a");
            var target = $(this);

            $.imageupload({
                url: getBaseUrl(settings.baseurl, target) + "edit-activity-image",
                data: {
                    act_id: act_id
                },
                callback: function (result) {
                    if (result.code == 0) {
                        $(image).attr("ref", result.data.url);
                        $(target).attr("class", "btn btn-success btn-xs pos-r edit-activity-image");
                        $.msg(result.message, {
                            time: 1500
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            });
        });

        // 推广码
        if (settings.promote.url && settings.promote.selector) {
            $(settings.container).on("click", settings.promote.selector, function () {

                var data = {};
                var act_id = $(this).data('id');

                if (act_id) {
                    data.id = act_id;
                }

                $.loading.start();
                $.open({
                    title: "活动推广码",
                    ajax: {
                        url: '/dashboard/promote/view?url=' + settings.promote.url,
                        data: data
                    },
                    width: "300px",
                    end: function (index, object) {
                        //
                    }
                });
            });
        }

        if ($().datetimepicker) {
            $('.form_datetime').datetimepicker({
                format: 'yyyy-mm-dd',
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
            });
        }

        settings.reload();

        return settings;
    };

    // 活动详情页
    $.activityInfo = function (settings) {
        var defaults = {
            // 列表页 URL
            listPageUrl: null,
            // 进度唯一标识
            progressKey: null,
            // 活动开始时间元素
            start_time_el: null,
            // 活动截至时间元素
            end_time_el: null,
            // 提交发送请求
            request: function (url, data, target, okFun, cancelFun) {

                var settings = this;

                var ok = function (result) {
                    if ($.isFunction(okFun)) {
                        okFun(result);
                    } else if (settings.listPageUrl) {
                        $.go(settings.listPageUrl);
                    } else {
                        $.closeDialog();
                    }
                }

                var cancel = function (result) {
                    $(target).removeClass("disabled");
                    $(target).prop("disabled", false);

                    if ($.isFunction(cancelFun)) {
                        cancelFun(result);
                    } else {
                        $.closeDialog();
                    }
                }

                return $.progress({
                    url: url,
                    type: 'POST',
                    ajaxContentType: "application/json",
                    dataType: "JSON",
                    data: data,
                    key: settings.progressKey,
                    endClose: false,
                    start: function () {
                        $(target).removeClass("disabled");
                    },
                    end: function (result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 1500
                            }, function () {
                                ok(result);
                            });
                            return;
                        } else if (result.code == 800) { // 活动商品冲突
                            $.alert(result.message, {
                                btn: ['下载失败列表', '取消'],
                                yes: function () {
                                    // 下载冲突商品
                                    $.toCSV(result.data.csv_data);
                                },
                                btn2: function () {
                                    cancel(result);
                                }
                            });
                        } else if (result.code == 801) { // 活动商品冲突
                            $.alert(result.message, {
                                btn: ['下载失败列表', '继续', '取消'],
                                yes: function () {
                                    // 下载冲突商品
                                    $.toCSV(result.data.csv_data);
                                },
                                btn2: function () {
                                    data.confirm_continue = 1;
                                    settings.request(url, data, target, okFun, cancelFun);
                                },
                                btn3: function () {
                                    cancel(result);
                                }
                            });
                        } else if (result.code == 802) { // 活动操作成功，但存在部分失败的商品
                            $.alert(result.message, {
                                btn: ['下载失败列表', '确定'],
                                yes: function () {
                                    // 下载冲突商品
                                    $.toCSV(result.data.csv_data);
                                },
                                btn2: function () {
                                    ok(result);
                                }
                            });
                        } else if (result.code == 803) { // 添加活动商品成功，但存在部分失败的商品
                            $.alert(result.message, {
                                btn: ['下载失败列表', '确定'],
                                yes: function () {
                                    // 下载冲突商品
                                    $.toCSV(result.data.csv_data);
                                },
                                btn2: function () {
                                    ok(result);
                                }
                            });
                        } else {
                            $.alert(result.message, function () {
                                cancel(result);
                            });
                        }
                    }
                });
            }
        }

        settings = $.extend({}, defaults, settings);

        var formName = $("form").attr("name");

        if (!settings.start_time_el) {
            var start_time_name = formName + "[start_time]";
            settings.start_time_el = $("[name='" + start_time_name + "']");
        }

        if (!settings.end_time_el) {
            var end_time_name = formName + "[end_time]";
            settings.end_time_el = $("[name='" + end_time_name + "']");
        }

        // 日期选择
        $(settings.start_time_el).datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd hh:ii:ss',
        }).on('changeDate', function(ev) {
            $(this).trigger("blur");
            $(settings.end_time_el).datetimepicker("setStartDate", $(this).val());
        });

        $(settings.end_time_el).datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd hh:ii:ss',
        }).on('changeDate', function(ev) {
            $(this).trigger("blur");
            $(settings.start_time_el).datetimepicker("setEndDate", $(this).val());
        });

        var now = new Date();
        var end = new Date(now.getTime() + 24 * 3600 * 90 * 1000);

        $(settings.start_time_el).datetimepicker('setStartDate', now.format());
        $(settings.end_time_el).datetimepicker('setStartDate', now.format());
        $(settings.end_time_el).datetimepicker('setEndDate', end.format());

        // 预售
        if($(".form_datetime-deliver-time").size() > 0) {
            $(".form_datetime-deliver-time").datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1,
                format: 'yyyy-mm-dd hh:ii:ss',
            }).on('changeDate', function(ev) {
                $(this).trigger("blur");
            });
            $(".form_datetime-deliver-time").datetimepicker('setStartDate', now.format());
        }

        return settings;
    };

    // 活动商品列表
    $.activityGoodsList = function (settings) {
        var defaults = {
            // 为空或者必须以 "/" 结尾
            baseurl: "",
            tablelist: null,
            container: $("body"),
            // 编辑活动库存的选择器
            editSelector: ".edit-activity-goods",
            // 重新加载
            reload: function () {
                var settings = this;
                if ($.isFunction($().editable)) {
                    // 编辑排序，需要提供给 data-id 属性
                    $(settings.container).find(settings.editSelector).each(function () {
                        var target = this;
                        $(this).editable({
                            type: "text",
                            url: getBaseUrl(settings.baseurl, target) + "edit-activity-goods",
                            pk: 1,
                            ajaxOptions: {
                                type: "post",
                                dataType: "JSON",
                            },
                            params: function (params) {
                                params.id = $(this).data("id");
                                params.name = $(this).data("name");
                                params.title = $(this).data("title");
                                return params;
                            },
                            validate: function (value) {
                                var title = $(this).data("title");
                                value = $.trim(value);
                                if (!value) {
                                    return title + '不能为空。';
                                }
                            },
                            success: function (result, newValue) {
                                // 错误处理
                                if (result.code == 0) {
                                    $.msg(result.message, {
                                        time: 1500
                                    });
                                    return true;
                                } else if (result.message) {
                                    $.msg(result.message, {
                                        time: 3000
                                    });
                                }
                                return false;
                            },
                            display: function (value, sourceData) {
                                // 显示整数
                                $(this).html((Number(value)).toFixed(0));
                            },
                            error: function (response, newValue) {
                                console.error(response)
                            }
                        });
                    });
                }
            },
        };

        settings = $.extend({}, defaults, settings);

        if (settings.tablelist == null && typeof tablelist != 'undefined') {
            settings.tablelist = tablelist;
        }

        settings.reload();

        return settings;
    };

    // 展示错误信息
    $.showError = function (element, error_message) {

        if (!error_message || error_message == "") {
            $.removeErrors(element);
            return;
        }

        var errorEl = $(element).data("errorElement");

        if (errorEl) {
            $(errorEl).html('<i class="fa fa-warning"></i>' + error_message);
        } else {
            errorEl = $('<span class="m-r-10 form-control-warning error m-t-10 m-r-10"><i class="fa fa-warning"></i>' + error_message + '</span>');

            if ($(element).parents(".form-group").size() > 0) {
                if ($(element).parents(".form-group").find(".form-control-error").size() == 0) { // 放在错误的元素旁边
                    $(element).parents(".form-control-box").after('<div class="form-control-error"></div>')
                }
                $(element).parents(".form-group").find(".form-control-error").append(errorEl);
            } else if ($(element).parents("form").find(".errors-container").size() > 0) { // 放在错误容器中
                $(element).parents("form").find(".errors-container").append(errorEl);
            }
        }

        $(errorEl).click(function () {
            $(element).focus();
        }).css("cursor", "pointer");

        $(element).data("errorElement", errorEl);
    }

    // 移除错误信息
    $.removeErrors = function (element) {
        var errorEl = $(element).data("errorElement");
        if (errorEl) {
            $(errorEl).remove();
            $(element).data("errorElement", null);
        }
    }
});

// 展示错误信息
function showError(element, error) {
    $.showError(element, error);
}

function clearNoNum(obj) {
    obj.value = obj.value.replace(/[^\d.]/g, "");  //清除“数字”和“.”以外的字符
    obj.value = obj.value.replace(/\.{2,}/g, "."); //只保留第一个. 清除多余的
    obj.value = obj.value.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
    obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3');//只能输入两个小数
    if (obj.value.indexOf(".") < 0 && obj.value != "") {//以上已经过滤，此处控制的是如果没有小数点，首位不能为类似于 01、02的金额
        obj.value = parseFloat(obj.value);
    }
}