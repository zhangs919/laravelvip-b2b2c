var CreatedOKLodop7766=null;
var LODOP = null;

//====判断是否需要安装CLodop云打印服务器:====
function needCLodop(){
	try{
		return true;
	} catch(err) {return true;};
};

//====页面引用CLodop云打印必须的JS文件：====
if (needCLodop()) {
	var head = document.head || document.getElementsByTagName("head")[0] || document.documentElement;
	var oscript = document.createElement("script");
	oscript.src ="https://localhost:8443/CLodopfuncs.js";
	head.insertBefore( oscript,head.firstChild );

	//引用双端口(8000和18000）避免其中某个被占用：
	oscript = document.createElement("script");
	oscript.src ="http://localhost:18000/CLodopfuncs.js?priority=0";
	head.insertBefore( oscript,head.firstChild );
};

//====获取LODOP对象的主过程：====
function getLodop(oOBJECT,oEMBED){
	var LODOP;
	try{
		var isIE = (navigator.userAgent.indexOf('MSIE')>=0) || (navigator.userAgent.indexOf('Trident')>=0);
		if (needCLodop()) {
			try{ LODOP=getCLodop();} catch(err) {};
			if (!LODOP && document.readyState!=="complete") {alert("打印设备还没准备好，请稍后再试！"); return;};
			if (!LODOP) {
				if (isIE) document.write(strCLodopInstall); else
					document.documentElement.innerHTML=strCLodopInstall+document.documentElement.innerHTML;
				return;
			} else {

				if (CLODOP.CVERSION<"2.1.3.0") {
					if (isIE) document.write(strCLodopUpdate); else
						document.documentElement.innerHTML=strCLodopUpdate+document.documentElement.innerHTML;
				};
				if (oEMBED && oEMBED.parentNode) oEMBED.parentNode.removeChild(oEMBED);
				if (oOBJECT && oOBJECT.parentNode) oOBJECT.parentNode.removeChild(oOBJECT);
			};
		} else {
			var is64IE  = isIE && (navigator.userAgent.indexOf('x64')>=0);
			//=====如果页面有Lodop就直接使用，没有则新建:==========
			if (oOBJECT!=undefined || oEMBED!=undefined) {
				if (isIE) LODOP=oOBJECT; else  LODOP=oEMBED;
			} else if (CreatedOKLodop7766==null){
				LODOP=document.createElement("object");
				LODOP.setAttribute("width",0);
				LODOP.setAttribute("height",0);
				LODOP.setAttribute("style","position:absolute;left:0px;top:-100px;width:0px;height:0px;");
				if (isIE) LODOP.setAttribute("classid","clsid:2105C259-1E0C-4534-8141-A753534CB4CA");
				else LODOP.setAttribute("type","application/x-print-lodop");
				document.documentElement.appendChild(LODOP);
				CreatedOKLodop7766=LODOP;
			} else LODOP=CreatedOKLodop7766;
			//=====Lodop插件未安装时提示下载地址:==========
			if ((LODOP==null)||(typeof(LODOP.VERSION)=="undefined")) {
				if (navigator.userAgent.indexOf('Chrome')>=0)
					document.documentElement.innerHTML=strHtmChrome+document.documentElement.innerHTML;
				if (navigator.userAgent.indexOf('Firefox')>=0)
					document.documentElement.innerHTML=strHtmFireFox+document.documentElement.innerHTML;
				if (is64IE) document.write(strHtm64_Install); else
				if (isIE)   document.write(strHtmInstall);    else
					document.documentElement.innerHTML=strHtmInstall+document.documentElement.innerHTML;
				return LODOP;
			};
		};
		if (LODOP.VERSION<"6.2.1.8") {
			if (!needCLodop()){
				if (is64IE) document.write(strHtm64_Update); else
				if (isIE) document.write(strHtmUpdate); else
					document.documentElement.innerHTML=strHtmUpdate+document.documentElement.innerHTML;
			};
			return LODOP;
		};
		//===如下空白位置适合调用统一功能(如注册语句、语言选择等):===

		//===========================================================
		return LODOP;
	} catch(err) {alert("您还没有安装lodop软件，请先手动执行打印，安装好lodop再执行自动打印！");};
};


/**
 * 打印html
 */
function lodop_print_html(title, html, printer, params)
{
	LODOP = getLodop();
	LODOP.PRINT_INIT(title); // 初始化
	if(printer)
	{
		// 指定打印机
		LODOP.SET_PRINTER_INDEX(printer);
	}

	// 设定纸张大小
	// http://www.c-lodop.com/demolist/PrintSample5.html
	if(params){
		console.log("纸张尺寸：", params.width * 10, params.height * 10);

		if(params.width && params.height){
			LODOP.SET_PRINT_PAGESIZE(1, params.width * 10, params.height * 10 - 50, "");
		}else if(params.width){
			LODOP.SET_PRINT_PAGESIZE(3, params.width * 10, 45, "");
		}
	}

	for(var i=1;i<= 1;i++)
	{
		LODOP.ADD_PRINT_HTM(0,"0%","100%","100%",html);
		LODOP.SET_PRINT_STYLEA(0,"Vorient",0);
		if(i <= 1)
		{
			LODOP.NewPageA();
		}
	};

	LODOP.PRINT();
}

/**
 * 预览
 */
function lodop_preview_html(title, html, printer, params)
{
	LODOP = getLodop();
	LODOP.PRINT_INIT(title); // 初始化
	if(printer)
	{
		// 指定打印机
		LODOP.SET_PRINTER_INDEX(printer);
	}

	// 设定纸张大小
	// http://www.c-lodop.com/demolist/PrintSample5.html
	if(params){
		console.log("纸张尺寸：", params.width * 10, params.height * 10);

		if(params.width && params.height){
			LODOP.SET_PRINT_PAGESIZE(1, params.width * 10, params.height * 10 - 50, "");
		}else if(params.width){
			LODOP.SET_PRINT_PAGESIZE(3, params.width * 10, 45, "");
		}
	}

	var ordernum = document.getElementsByClassName('orderdiv').length;

	for(var i=1;i<= ordernum;i++)
	{
		LODOP.ADD_PRINT_HTM(0,"0%","100%","100%",document.getElementById('div' + i).innerHTML);
		LODOP.SET_PRINT_STYLEA(0,"Vorient",0);
		if(i != ordernum)
		{
			LODOP.NewPageA();
		}
	};

	LODOP.PREVIEW();
}

/**
 * 获取打印机名称
 */
function lodop_get_printer_name()
{
	LODOP = getLodop();
	var iPrinterCount=LODOP.GET_PRINTER_COUNT();
	var arrList = new Array();
	for(var i=0;i<iPrinterCount;i++)
	{
		arrList.push(LODOP.GET_PRINTER_NAME(i));
	};
	return arrList;
}
