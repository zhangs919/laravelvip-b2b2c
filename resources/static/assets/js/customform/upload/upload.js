accessid = '';
accesskey = '';
host = '';
policyBase64 = '';
signature = '';
callbackbody = '';
filename = '';
key = '';
expire = 0;
g_object_name = '';
uploadPath = '';
// local_name 上传文件名字保持本地文件名字
// random_name 上传文件名字是随机文件名, 后缀保留
g_object_name_type = 'local_name';
now = timestamp = Date.parse(new Date()) / 1000; 

function send_request()
{
    var xmlhttp = null;
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  
    if (xmlhttp!=null)
    {
        // serverUrl是 用户获取 '签名和Policy' 等信息的应用服务器的URL，请将下面的IP和Port配置为您自己的真实信息。
        // serverUrl =
		// 'http://88.88.88.88:8888/aliyun-oss-appserver-php/php/get.php'
        serverUrl = aliUrl
		
        xmlhttp.open( "GET", serverUrl, false );
        xmlhttp.send( null );
        return xmlhttp.responseText
    }
    else
    {
        alert("Your browser does not support XMLHTTP.");
    }
};

function get_signature()
{
    // 可以判断当前expire是否超过了当前时间， 如果超过了当前时间， 就重新取一下，3s 作为缓冲。
    now = timestamp = Date.parse(new Date()) / 1000; 
    if (expire < now + 3)
    {
        body = send_request()
        var obj = eval ("(" + body + ")");
        host = obj['host']
        policyBase64 = obj['policy']
        accessid = obj['accessid']
        signature = obj['signature']
        expire = parseInt(obj['expire'])
        callbackbody = obj['callback'] 
        key = obj['dir']
        return true;
    }
    return false;
};

function random_string(len) {
　　len = len || 32;
　　var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';   
　　var maxPos = chars.length;
　　var pwd = '';
　　for (i = 0; i < len; i++) {
    　　pwd += chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
}

function get_suffix(filename) {
    pos = filename.lastIndexOf('.')
    suffix = ''
    if (pos != -1) {
        suffix = filename.substring(pos)
    }
    return suffix;
}

function calculate_object_name(filename)
{
    if (g_object_name_type == 'local_name')
    {
        g_object_name += "${filename}"
    }
    else if (g_object_name_type == 'random_name')
    {
        suffix = get_suffix(filename)
        g_object_name = key + random_string(10) + suffix
    }
    return ''
}

function get_uploaded_object_name(filename)
{
    if (g_object_name_type == 'local_name')
    {
        tmp_name = g_object_name
        tmp_name = tmp_name.replace("${filename}", filename);
        return tmp_name
    }
    else if(g_object_name_type == 'random_name')
    {
        return g_object_name
    }
}

function set_upload_param(up, filename, ret)
{
    if (ret == false)
    {
        ret = get_signature()
    }
    // 保留文件名称
    // user/xxx/xxx/xxx/xx/xx/${filename} -> user/xxx/xxx/xx/xx/xx/
    uploadPath = key.replace('${filename}', '');
    uploadPath = '/' + uploadPath;
    g_object_name = key;
    if (filename != '') { suffix = get_suffix(filename)
        calculate_object_name(filename)
    }
    new_multipart_params = {
        'key' : g_object_name,
        'policy': policyBase64,
        'OSSAccessKeyId': accessid, 
        'success_action_status' : '200', // 让服务端返回200,不然，默认会返回204
        // 'callback' : callbackbody,
        'signature': signature,
    };

    up.setOption({
        'url': host,
        'multipart_params': new_multipart_params
    });

    up.start();
}

/**
 * @param string
 *            container 外层的包裹的ID
 * @param string
 *            ossfile oss提示层的ID
 * @param string
 *            selectfiles 选择文件的ID
 * @param string
 *            postfiles 开始上传的ID
 * @param string
 *            szy_filename 文件名的ID
 * @param string
 *            szy_filetext 原始文件名的ID
 */
function initUploader(container, ossfile, selectfiles, postfiles, szy_filename, szy_filetext)
{
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : selectfiles, 
		multi_selection: false,
		container: document.getElementById(container),
		flash_swf_url : 'lib/plupload-2.1.2/js/Moxie.swf',
		silverlight_xap_url : 'lib/plupload-2.1.2/js/Moxie.xap',
	    url : 'http://oss.aliyuncs.com',
	
	    filters: {
	        max_file_size : '500mb', // 最大只能上传10mb的文件
	        prevent_duplicates : false // 不允许选取重复文件
	    },
	
		init: {
			PostInit: function() {
				document.getElementById(ossfile).innerHTML = '';
				document.getElementById(postfiles).onclick = function() {
					var currFiles = uploader.files;
					if (currFiles.length == 0) {
						$.msg('请先选择要上传的文件');
						return false;
					}
					$.loading.start();
		            set_upload_param(uploader, '', false);
		            return false;
				};
			},
	
			FilesAdded: function(up, files) {
				// 获取当前的所有的文件内容
				var currentFiles = up.files;
				// 情况oss提示区域内容
				var oOssfile = document.getElementById(ossfile);
				oOssfile.innerHTML = '';
				// 移除files
				if (currentFiles.length > 1) {
					var firstFile = currentFiles[0];
					up.removeFile(firstFile);
				}
				// 隐藏txt name
				$container = $('#' + container);
				$container.closest('.upload-box').find('.txt_name').hide();
				
				// 如果 > 0 则弹出第一个
				plupload.each(files, function(file) {
					oOssfile.innerHTML += '<div id="' + file.id + '" style="text-align: right;">' + file.name + ' (' + plupload.formatSize(file.size) + ')<b></b>'
					+'<div class="progress m-t-10"><div class="progress-bar" style="width: 0%;background-color:#078AEB;"></div></div>'
					+'</div>';
				});
			},
	
			BeforeUpload: function(up, file) {
	            set_upload_param(up, file.name, true);
	        },
	
			UploadProgress: function(up, file) {
				 $.loading.stop();
				var d = document.getElementById(file.id);
				d.getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
	            var prog = d.getElementsByTagName('div')[0];
				var progBar = prog.getElementsByTagName('div')[0]
				progBar.style.width= 2*file.percent+'%';
				progBar.setAttribute('aria-valuenow', file.percent);
			},
	
			FileUploaded: function(up, file, info) {
	            if (info.status == 200)
	            {
	            	// 完整路径 + 上传名称
	            	var fileName = file.name;
	            	uploadPath += fileName;
	                $.msg('上传成功');
	                console.info(arguments);
	                // 将返回内容写入到对应的隐藏域中
	                document.getElementById(szy_filename).value = uploadPath;
	                document.getElementById(szy_filetext).value = file.name;
	            }
	            else if (info.status == 203)
	            {
	                $.msg('上传到OSS成功，但是oss访问用户设置的上传回调服务器失败，失败原因是:' + info.response);
	            }
	            else
	            {
	            	$.msg(info.response);
	            } 
			},
	
			Error: function(up, err) {
	            if (err.code == -600) {
	            	$.msg('选择的文件太大了');
	            }
	            else if (err.code == -601) {
	            	$.msg('选择的文件后缀不对');
	            }
	            else if (err.code == -602) {
	            	$.msg('这个文件已经上传过一遍了');
	            }
	            else 
	            {
	            	$.msg('上传失败');
	            	console.error(err.response);
	            }
			}
		}
	});
	
	uploader.init();
	
}

