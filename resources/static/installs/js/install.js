$(function() {
    document.onkeydown = function () {
        if (window.event && window.event.keyCode == 13) {
            window.event.returnValue = false;
        }
    }

    // 许可协议
    $('#protocol').click(() => {
        let checked = $(protocol).is(':checked')
        if (checked) {
            $('#protocol_next').css({ "background-color": "#fd3539" }).attr("disabled", false)
        } else {
            $('#protocol_next').css({ "background-color": "#febbbd" }).attr("disabled", true)
        }
    })

    // 连接数据库
    $('#passinfo').blur(function () {
        layer.load(1);

        var params = {
            db_host: $('#host').val(),
            db_port: $('#port').val(),
            db_user: $('#userinfo').val(),
            db_pass: $('#passinfo').val(),
        }

        $.post('/install/databases', params, function (result) {
            if (result.code === -1) {
                layer.closeAll('loading');
                layer.msg("连不上数据库，用户名或密码不正确！");
                return false;
            }

            // 填充 select 参数
            var databases = result.data
            var content = '<option value="">已有数据库</option>';
            for (var i = 0; i < databases.length; i++) {
                content += '<option value="' + databases[i] + '">' + databases[i] + '</option>';
            }
            $("#j-databases").empty().append(content);

            layer.closeAll('loading');
        }, 'json')
    })

    // 手动选择数据库
    $("#j-databases").change(function () {
        var currentDb = $(this).val();
        $('#names').val(currentDb)
    })

    //假定你的信息提示方法为showmsg， 在方法里可以接收参数msg，当然也可以接收到o及cssctl;
    var showmsg = function(msg){
        layer.msg(msg);
    }

    var interval = null;
    var percentage = 0;
    var showDialog = function(){
        $('#x-error').show();
        percentage = 0;
        interval = setInterval(function () {
            if (percentage < 550) {
                percentage++;
                var widthTemp = (percentage / 1)
                $('#progressBar').css('width', widthTemp);
            } else {
                percentage = 0;
            }
        }, 10);
    }

    var closeDialog = function(){
        $('#x-error').hide();
        clearInterval(interval);
    }

    $("#js-setting").Validform({
        tiptype:function(msg,o){
            if(o.type !== 1){
                showmsg(msg);
            } else {
                showDialog();
            }
        },
        ajaxPost:true,
        postonce:true, // 防止二次提交
        tipSweep:true, //为true时提示信息将只会在表单提交时触发显示，各表单元素blur时不会被触发显示;
        callback:function(data){
            closeDialog();
            if(data.code === 0) {
                window.location.href = '/install/success.html';
            } else {
                showmsg(data.message);
            }
        }
    })

})
