<?php

namespace App\Extensions\Wechat;

class SDK
{
	const MSGTYPE_TEXT = 'text';
	const MSGTYPE_IMAGE = 'image';
	const MSGTYPE_LOCATION = 'location';
	const MSGTYPE_LINK = 'link';
	const MSGTYPE_EVENT = 'event';
	const MSGTYPE_MUSIC = 'music';
	const MSGTYPE_NEWS = 'news';
	const MSGTYPE_VOICE = 'voice';
	const MSGTYPE_VIDEO = 'video';
	const MSGTYPE_SHORTVIDEO = 'shortvideo';
	const EVENT_SUBSCRIBE = 'subscribe';
	const EVENT_UNSUBSCRIBE = 'unsubscribe';
	const EVENT_SCAN = 'SCAN';
	const EVENT_LOCATION = 'LOCATION';
	const EVENT_MENU_VIEW = 'VIEW';
	const EVENT_MENU_CLICK = 'CLICK';
	const EVENT_MENU_SCAN_PUSH = 'scancode_push';
	const EVENT_MENU_SCAN_WAITMSG = 'scancode_waitmsg';
	const EVENT_MENU_PIC_SYS = 'pic_sysphoto';
	const EVENT_MENU_PIC_PHOTO = 'pic_photo_or_album';
	const EVENT_MENU_PIC_WEIXIN = 'pic_weixin';
	const EVENT_MENU_LOCATION = 'location_select';
	const EVENT_SEND_MASS = 'MASSSENDJOBFINISH';
	const EVENT_SEND_TEMPLATE = 'TEMPLATESENDJOBFINISH';
	const EVENT_KF_SEESION_CREATE = 'kfcreatesession';
	const EVENT_KF_SEESION_CLOSE = 'kfclosesession';
	const EVENT_KF_SEESION_SWITCH = 'kfswitchsession';
	const EVENT_CARD_PASS = 'card_pass_check';
	const EVENT_CARD_NOTPASS = 'card_not_pass_check';
	const EVENT_CARD_USER_GET = 'user_get_card';
	const EVENT_CARD_USER_DEL = 'user_del_card';
	const EVENT_MERCHANT_ORDER = 'merchant_order';
	const API_URL_PREFIX = 'https://api.weixin.qq.com/cgi-bin';
	const AUTH_URL = '/token?grant_type=client_credential&';
	const MENU_CREATE_URL = '/menu/create?';
	const MENU_GET_URL = '/menu/get?';
	const MENU_DELETE_URL = '/menu/delete?';
	const GET_TICKET_URL = '/ticket/getticket?';
	const CALLBACKSERVER_GET_URL = '/getcallbackip?';
	const QRCODE_CREATE_URL = '/qrcode/create?';
	const QR_SCENE = 0;
	const QR_LIMIT_SCENE = 1;
	const QRCODE_IMG_URL = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=';
	const SHORT_URL = '/shorturl?';
	const USER_GET_URL = '/user/get?';
	const USER_INFO_URL = '/user/info?';
	const USER_UPDATEREMARK_URL = '/user/info/updateremark?';
	const GROUP_GET_URL = '/groups/get?';
	const USER_GROUP_URL = '/groups/getid?';
	const GROUP_CREATE_URL = '/groups/create?';
	const GROUP_UPDATE_URL = '/groups/update?';
	const GROUP_MEMBER_UPDATE_URL = '/groups/members/update?';
	const GROUP_MEMBER_BATCHUPDATE_URL = '/groups/members/batchupdate?';
	const CUSTOM_SEND_URL = '/message/custom/send?';
	const MEDIA_UPLOADNEWS_URL = '/media/uploadnews?';
	const MASS_SEND_URL = '/message/mass/send?';
	const TEMPLATE_SET_INDUSTRY_URL = '/template/api_set_industry?';
	const TEMPLATE_GET_INDUSTRY_URL = '/template/get_industry?';
	const TEMPLATE_ADD_TPL_URL = '/template/api_add_template?';
	const TEMPLATE_DEL_TPL_URL = '/template/del_private_template?';
	const TEMPLATE_SEND_URL = '/message/template/send?';
	const MASS_SEND_GROUP_URL = '/message/mass/sendall?';
	const MASS_DELETE_URL = '/message/mass/delete?';
	const MASS_PREVIEW_URL = '/message/mass/preview?';
	const MASS_QUERY_URL = '/message/mass/get?';
	const UPLOAD_MEDIA_URL = 'https://file.api.weixin.qq.com/cgi-bin';
	const MEDIA_UPLOAD_URL = '/media/upload?';
	const MEDIA_UPLOADIMG_URL = '/media/uploadimg?';
	const MEDIA_GET_URL = '/media/get?';
	const MEDIA_VIDEO_UPLOAD = '/media/uploadvideo?';
	const MEDIA_FOREVER_UPLOAD_URL = '/material/add_material?';
	const MEDIA_FOREVER_NEWS_UPLOAD_URL = '/material/add_news?';
	const MEDIA_FOREVER_NEWS_UPDATE_URL = '/material/update_news?';
	const MEDIA_FOREVER_GET_URL = '/material/get_material?';
	const MEDIA_FOREVER_DEL_URL = '/material/del_material?';
	const MEDIA_FOREVER_COUNT_URL = '/material/get_materialcount?';
	const MEDIA_FOREVER_BATCHGET_URL = '/material/batchget_material?';
	const OAUTH_PREFIX = 'https://open.weixin.qq.com/connect/oauth2';
	const OAUTH_AUTHORIZE_URL = '/authorize?';
	const CUSTOM_SERVICE_GET_RECORD = '/customservice/getrecord?';
	const CUSTOM_SERVICE_GET_KFLIST = '/customservice/getkflist?';
	const CUSTOM_SERVICE_GET_ONLINEKFLIST = '/customservice/getonlinekflist?';
	const API_BASE_URL_PREFIX = 'https://api.weixin.qq.com';
	const OAUTH_TOKEN_URL = '/sns/oauth2/access_token?';
	const OAUTH_REFRESH_URL = '/sns/oauth2/refresh_token?';
	const OAUTH_USERINFO_URL = '/sns/userinfo?';
	const OAUTH_AUTH_URL = '/sns/auth?';
	const CUSTOM_SESSION_CREATE = '/customservice/kfsession/create?';
	const CUSTOM_SESSION_CLOSE = '/customservice/kfsession/close?';
	const CUSTOM_SESSION_SWITCH = '/customservice/kfsession/switch?';
	const CUSTOM_SESSION_GET = '/customservice/kfsession/getsession?';
	const CUSTOM_SESSION_GET_LIST = '/customservice/kfsession/getsessionlist?';
	const CUSTOM_SESSION_GET_WAIT = '/customservice/kfsession/getwaitcase?';
	const CS_KF_ACCOUNT_ADD_URL = '/customservice/kfaccount/add?';
	const CS_KF_ACCOUNT_UPDATE_URL = '/customservice/kfaccount/update?';
	const CS_KF_ACCOUNT_DEL_URL = '/customservice/kfaccount/del?';
	const CS_KF_ACCOUNT_UPLOAD_HEADIMG_URL = '/customservice/kfaccount/uploadheadimg?';
	const CARD_CREATE = '/card/create?';
	const CARD_DELETE = '/card/delete?';
	const CARD_UPDATE = '/card/update?';
	const CARD_GET = '/card/get?';
	const CARD_BATCHGET = '/card/batchget?';
	const CARD_MODIFY_STOCK = '/card/modifystock?';
	const CARD_LOCATION_BATCHADD = '/card/location/batchadd?';
	const CARD_LOCATION_BATCHGET = '/card/location/batchget?';
	const CARD_GETCOLORS = '/card/getcolors?';
	const CARD_QRCODE_CREATE = '/card/qrcode/create?';
	const CARD_CODE_CONSUME = '/card/code/consume?';
	const CARD_CODE_DECRYPT = '/card/code/decrypt?';
	const CARD_CODE_GET = '/card/code/get?';
	const CARD_CODE_UPDATE = '/card/code/update?';
	const CARD_CODE_UNAVAILABLE = '/card/code/unavailable?';
	const CARD_TESTWHILELIST_SET = '/card/testwhitelist/set?';
	const CARD_MEETINGCARD_UPDATEUSER = '/card/meetingticket/updateuser?';
	const CARD_MEMBERCARD_ACTIVATE = '/card/membercard/activate?';
	const CARD_MEMBERCARD_UPDATEUSER = '/card/membercard/updateuser?';
	const CARD_MOVIETICKET_UPDATEUSER = '/card/movieticket/updateuser?';
	const CARD_BOARDINGPASS_CHECKIN = '/card/boardingpass/checkin?';
	const CARD_LUCKYMONEY_UPDATE = '/card/luckymoney/updateuserbalance?';
	const SEMANTIC_API_URL = '/semantic/semproxy/search?';
	const SHAKEAROUND_DEVICE_APPLYID = '/shakearound/device/applyid?';
	const SHAKEAROUND_DEVICE_UPDATE = '/shakearound/device/update?';
	const SHAKEAROUND_DEVICE_SEARCH = '/shakearound/device/search?';
	const SHAKEAROUND_DEVICE_BINDLOCATION = '/shakearound/device/bindlocation?';
	const SHAKEAROUND_DEVICE_BINDPAGE = '/shakearound/device/bindpage?';
	const SHAKEAROUND_MATERIAL_ADD = '/shakearound/material/add?';
	const SHAKEAROUND_PAGE_ADD = '/shakearound/page/add?';
	const SHAKEAROUND_PAGE_UPDATE = '/shakearound/page/update?';
	const SHAKEAROUND_PAGE_SEARCH = '/shakearound/page/search?';
	const SHAKEAROUND_PAGE_DELETE = '/shakearound/page/delete?';
	const SHAKEAROUND_USER_GETSHAKEINFO = '/shakearound/user/getshakeinfo?';
	const SHAKEAROUND_STATISTICS_DEVICE = '/shakearound/statistics/device?';
	const SHAKEAROUND_STATISTICS_PAGE = '/shakearound/statistics/page?';
	const MERCHANT_ORDER_GETBYID = '/merchant/order/getbyid?';
	const MERCHANT_ORDER_GETBYFILTER = '/merchant/order/getbyfilter?';
	const MERCHANT_ORDER_SETDELIVERY = '/merchant/order/setdelivery?';
	const MERCHANT_ORDER_CLOSE = '/merchant/order/close?';

	static public $DATACUBE_URL_ARR = array(
		'user'        => array('summary' => '/datacube/getusersummary?', 'cumulate' => '/datacube/getusercumulate?'),
		'article'     => array('summary' => '/datacube/getarticlesummary?', 'total' => '/datacube/getarticletotal?', 'read' => '/datacube/getuserread?', 'readhour' => '/datacube/getuserreadhour?', 'share' => '/datacube/getusershare?', 'sharehour' => '/datacube/getusersharehour?'),
		'upstreammsg' => array('summary' => '/datacube/getupstreammsg?', 'hour' => '/datacube/getupstreammsghour?', 'week' => '/datacube/getupstreammsgweek?', 'month' => '/datacube/getupstreammsgmonth?', 'dist' => '/datacube/getupstreammsgdist?', 'distweek' => '/datacube/getupstreammsgdistweek?', 'distmonth' => '/datacube/getupstreammsgdistmonth?'),
		'interface'   => array('summary' => '/datacube/getinterfacesummary?', 'summaryhour' => '/datacube/getinterfacesummaryhour?')
		);
	private $token;
	private $encodingAesKey;
	private $encrypt_type;
	private $appid;
	private $appsecret;
	private $access_token;
	private $jsapi_ticket;
	private $api_ticket;
	private $user_token;
	private $partnerid;
	private $partnerkey;
	private $paysignkey;
	private $postxml;
	private $_msg;
	private $_funcflag = false;
	private $_receive;
	private $_text_filter = true;
	public $debug = false;
	public $errCode = 40001;
	public $errMsg = 'no access';
	public $logcallback;

	public function __construct($options)
	{
		$this->token = isset($options['token']) ? $options['token'] : '';
		$this->encodingAesKey = isset($options['encodingaeskey']) ? $options['encodingaeskey'] : '';
		$this->appid = isset($options['appid']) ? $options['appid'] : '';
		$this->appsecret = isset($options['appsecret']) ? $options['appsecret'] : '';
		$this->debug = isset($options['debug']) ? $options['debug'] : false;
		$this->logcallback = isset($options['logcallback']) ? $options['logcallback'] : false;
	}

	private function checkSignature($str = '')
	{
		$signature = (isset($_GET['signature']) ? $_GET['signature'] : '');
		$signature = (isset($_GET['msg_signature']) ? $_GET['msg_signature'] : $signature);
		$timestamp = (isset($_GET['timestamp']) ? $_GET['timestamp'] : '');
		$nonce = (isset($_GET['nonce']) ? $_GET['nonce'] : '');
		$token = $this->token;
		$tmpArr = array($token, $timestamp, $nonce, $str);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if ($tmpStr == $signature) {
			return true;
		}
		else {
			return false;
		}
	}

	public function valid($return = false)
	{
		$encryptStr = '';

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$postStr = file_get_contents('php://input');
			$array = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$this->encrypt_type = isset($_GET['encrypt_type']) ? $_GET['encrypt_type'] : '';

			if ($this->encrypt_type == 'aes') {
				$encryptStr = $array['Encrypt'];
				$pc = new Prpcrypt($this->encodingAesKey);
				$array = $pc->decrypt($encryptStr, $this->appid);
				if (!isset($array[0]) || ($array[0] != 0)) {
					if (!$return) {
						exit('decrypt error!');
					}
					else {
						return false;
					}
				}

				$this->postxml = $array[1];

				if (!$this->appid) {
					$this->appid = $array[2];
				}
			}
			else {
				$this->postxml = $postStr;
			}
		}
		else if (isset($_GET['echostr'])) {
			$echoStr = $_GET['echostr'];

			if ($return) {
				if ($this->checkSignature()) {
					return $echoStr;
				}
				else {
					return false;
				}
			}
			else if ($this->checkSignature()) {
				exit($echoStr);
			}
			else {
				exit('no access');
			}
		}

		if (!$this->checkSignature($encryptStr)) {
			if ($return) {
				return false;
			}
			else {
				exit('no access');
			}
		}

		return true;
	}

	public function Message($msg = '', $append = false)
	{
		if (is_null($msg)) {
			$this->_msg = array();
		}
		else if (is_array($msg)) {
			if ($append) {
				$this->_msg = array_merge($this->_msg, $msg);
			}
			else {
				$this->_msg = $msg;
			}

			return $this->_msg;
		}
		else {
			return $this->_msg;
		}
	}

	public function setFuncFlag($flag)
	{
		$this->_funcflag = $flag;
		return $this;
	}

	protected function log($log)
	{
		if ($this->debug && function_exists($this->logcallback)) {
			if (is_array($log)) {
				$log = print_r($log, true);
			}

			return call_user_func($this->logcallback, $log);
		}
	}

	public function getRev()
	{
		if ($this->_receive) {
			return $this;
		}

		$postStr = (!empty($this->postxml) ? $this->postxml : file_get_contents('php://input'));

		if (!empty($postStr)) {
			$this->_receive = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		}

		return $this;
	}

	public function getRevData()
	{
		return $this->_receive;
	}

	public function getRevFrom()
	{
		if (isset($this->_receive['FromUserName'])) {
			return $this->_receive['FromUserName'];
		}
		else {
			return false;
		}
	}

	public function getRevTo()
	{
		if (isset($this->_receive['ToUserName'])) {
			return $this->_receive['ToUserName'];
		}
		else {
			return false;
		}
	}

	public function getRevType()
	{
		if (isset($this->_receive['MsgType'])) {
			return $this->_receive['MsgType'];
		}
		else {
			return false;
		}
	}

	public function getRevID()
	{
		if (isset($this->_receive['MsgId'])) {
			return $this->_receive['MsgId'];
		}
		else {
			return false;
		}
	}

	public function getRevCtime()
	{
		if (isset($this->_receive['CreateTime'])) {
			return $this->_receive['CreateTime'];
		}
		else {
			return false;
		}
	}

	public function getRevContent()
	{
		if (isset($this->_receive['Content'])) {
			return $this->_receive['Content'];
		}
		else if (isset($this->_receive['Recognition'])) {
			return $this->_receive['Recognition'];
		}
		else {
			return false;
		}
	}

	public function getRevPic()
	{
		if (isset($this->_receive['PicUrl'])) {
			return array('mediaid' => $this->_receive['MediaId'], 'picurl' => (string) $this->_receive['PicUrl']);
		}
		else {
			return false;
		}
	}

	public function getRevLink()
	{
		if (isset($this->_receive['Url'])) {
			return array('url' => $this->_receive['Url'], 'title' => $this->_receive['Title'], 'description' => $this->_receive['Description']);
		}
		else {
			return false;
		}
	}

	public function getRevGeo()
	{
		if (isset($this->_receive['Location_X'])) {
			return array('x' => $this->_receive['Location_X'], 'y' => $this->_receive['Location_Y'], 'scale' => $this->_receive['Scale'], 'label' => $this->_receive['Label']);
		}
		else {
			return false;
		}
	}

	public function getRevEventGeo()
	{
		if (isset($this->_receive['Latitude'])) {
			return array('x' => $this->_receive['Latitude'], 'y' => $this->_receive['Longitude'], 'precision' => $this->_receive['Precision']);
		}
		else {
			return false;
		}
	}

	public function getRevEvent()
	{
		if (isset($this->_receive['Event'])) {
			$array['event'] = $this->_receive['Event'];
		}

		if (isset($this->_receive['EventKey'])) {
			$array['key'] = $this->_receive['EventKey'];
		}

		if (isset($array) && (0 < count($array))) {
			return $array;
		}
		else {
			return false;
		}
	}

	public function getRevScanInfo()
	{
		if (isset($this->_receive['ScanCodeInfo'])) {
			if (!is_array($this->_receive['ScanCodeInfo'])) {
				$array = (array) $this->_receive['ScanCodeInfo'];
				$this->_receive['ScanCodeInfo'] = $array;
			}
			else {
				$array = $this->_receive['ScanCodeInfo'];
			}
		}

		if (isset($array) && (0 < count($array))) {
			return $array;
		}
		else {
			return false;
		}
	}

	public function getRevSendPicsInfo()
	{
		if (isset($this->_receive['SendPicsInfo'])) {
			if (!is_array($this->_receive['SendPicsInfo'])) {
				$array = (array) $this->_receive['SendPicsInfo'];

				if (isset($array['PicList'])) {
					$array['PicList'] = (array) $array['PicList'];
					$item = $array['PicList']['item'];
					$array['PicList']['item'] = array();

					foreach ($item as $key => $value) {
						$array['PicList']['item'][$key] = (array) $value;
					}
				}

				$this->_receive['SendPicsInfo'] = $array;
			}
			else {
				$array = $this->_receive['SendPicsInfo'];
			}
		}

		if (isset($array) && (0 < count($array))) {
			return $array;
		}
		else {
			return false;
		}
	}

	public function getRevSendGeoInfo()
	{
		if (isset($this->_receive['SendLocationInfo'])) {
			if (!is_array($this->_receive['SendLocationInfo'])) {
				$array = (array) $this->_receive['SendLocationInfo'];

				if (empty($array['Poiname'])) {
					$array['Poiname'] = '';
				}

				if (empty($array['Label'])) {
					$array['Label'] = '';
				}

				$this->_receive['SendLocationInfo'] = $array;
			}
			else {
				$array = $this->_receive['SendLocationInfo'];
			}
		}

		if (isset($array) && (0 < count($array))) {
			return $array;
		}
		else {
			return false;
		}
	}

	public function getRevVoice()
	{
		if (isset($this->_receive['MediaId'])) {
			return array('mediaid' => $this->_receive['MediaId'], 'format' => $this->_receive['Format']);
		}
		else {
			return false;
		}
	}

	public function getRevVideo()
	{
		if (isset($this->_receive['MediaId'])) {
			return array('mediaid' => $this->_receive['MediaId'], 'thumbmediaid' => $this->_receive['ThumbMediaId']);
		}
		else {
			return false;
		}
	}

	public function getRevTicket()
	{
		if (isset($this->_receive['Ticket'])) {
			return $this->_receive['Ticket'];
		}
		else {
			return false;
		}
	}

	public function getRevSceneId()
	{
		if (isset($this->_receive['EventKey'])) {
			return str_replace('qrscene_', '', $this->_receive['EventKey']);
		}
		else {
			return false;
		}
	}

	public function getRevTplMsgID()
	{
		if (isset($this->_receive['MsgID'])) {
			return $this->_receive['MsgID'];
		}
		else {
			return false;
		}
	}

	public function getRevStatus()
	{
		if (isset($this->_receive['Status'])) {
			return $this->_receive['Status'];
		}
		else {
			return false;
		}
	}

	public function getRevResult()
	{
		if (isset($this->_receive['Status'])) {
			$array['Status'] = $this->_receive['Status'];
		}

		if (isset($this->_receive['MsgID'])) {
			$array['MsgID'] = $this->_receive['MsgID'];
		}

		if (isset($this->_receive['TotalCount'])) {
			$array['TotalCount'] = $this->_receive['TotalCount'];
		}

		if (isset($this->_receive['FilterCount'])) {
			$array['FilterCount'] = $this->_receive['FilterCount'];
		}

		if (isset($this->_receive['SentCount'])) {
			$array['SentCount'] = $this->_receive['SentCount'];
		}

		if (isset($this->_receive['ErrorCount'])) {
			$array['ErrorCount'] = $this->_receive['ErrorCount'];
		}

		if (isset($array) && (0 < count($array))) {
			return $array;
		}
		else {
			return false;
		}
	}

	public function getRevKFCreate()
	{
		if (isset($this->_receive['KfAccount'])) {
			return $this->_receive['KfAccount'];
		}
		else {
			return false;
		}
	}

	public function getRevKFClose()
	{
		if (isset($this->_receive['KfAccount'])) {
			return $this->_receive['KfAccount'];
		}
		else {
			return false;
		}
	}

	public function getRevKFSwitch()
	{
		if (isset($this->_receive['FromKfAccount'])) {
			$array['FromKfAccount'] = $this->_receive['FromKfAccount'];
		}

		if (isset($this->_receive['ToKfAccount'])) {
			$array['ToKfAccount'] = $this->_receive['ToKfAccount'];
		}

		if (isset($array) && (0 < count($array))) {
			return $array;
		}
		else {
			return false;
		}
	}

	public function getRevCardPass()
	{
		if (isset($this->_receive['CardId'])) {
			return $this->_receive['CardId'];
		}
		else {
			return false;
		}
	}

	public function getRevCardGet()
	{
		if (isset($this->_receive['CardId'])) {
			$array['CardId'] = $this->_receive['CardId'];
		}

		if (isset($this->_receive['IsGiveByFriend'])) {
			$array['IsGiveByFriend'] = $this->_receive['IsGiveByFriend'];
		}

		$array['OldUserCardCode'] = $this->_receive['OldUserCardCode'];
		if (isset($this->_receive['UserCardCode']) && !empty($this->_receive['UserCardCode'])) {
			$array['UserCardCode'] = $this->_receive['UserCardCode'];
		}

		if (isset($array) && (0 < count($array))) {
			return $array;
		}
		else {
			return false;
		}
	}

	public function getRevCardDel()
	{
		if (isset($this->_receive['CardId'])) {
			$array['CardId'] = $this->_receive['CardId'];
		}

		if (isset($this->_receive['UserCardCode']) && !empty($this->_receive['UserCardCode'])) {
			$array['UserCardCode'] = $this->_receive['UserCardCode'];
		}

		if (isset($array) && (0 < count($array))) {
			return $array;
		}
		else {
			return false;
		}
	}

	public function getRevOrderId()
	{
		if (isset($this->_receive['OrderId'])) {
			return $this->_receive['OrderId'];
		}
		else {
			return false;
		}
	}

	static public function xmlSafeStr($str)
	{
		return '<![CDATA[' . preg_replace('/[\\x00-\\x08\\x0b-\\x0c\\x0e-\\x1f]/', '', $str) . ']]>';
	}

	static public function data_to_xml($data)
	{
		$xml = '';

		foreach ($data as $key => $val) {
			is_numeric($key) && ($key = 'item id="' . $key . '"');
			$xml .= '<' . $key . '>';
			$xml .= (is_array($val) || is_object($val) ? self::data_to_xml($val) : self::xmlSafeStr($val));
			list($key) = explode(' ', $key);
			$xml .= '</' . $key . '>';
		}

		return $xml;
	}

	public function xml_encode($data, $root = 'xml', $item = 'item', $attr = '', $id = 'id', $encoding = 'utf-8')
	{
		if (is_array($attr)) {
			$_attr = array();

			foreach ($attr as $key => $value) {
				$_attr[] = $key . '="' . $value . '"';
			}

			$attr = implode(' ', $_attr);
		}

		$attr = trim($attr);
		$attr = (empty($attr) ? '' : ' ' . $attr);
		$xml = '<' . $root . $attr . '>';
		$xml .= self::data_to_xml($data, $item, $id);
		$xml .= '</' . $root . '>';
		return $xml;
	}

	private function _auto_text_filter($text)
	{
		if (!$this->_text_filter) {
			return $text;
		}

		return str_replace("\r\n", "\n", $text);
	}

	public function text($text = '')
	{
		$FuncFlag = ($this->_funcflag ? 1 : 0);
		$msg = array('ToUserName' => $this->getRevFrom(), 'FromUserName' => $this->getRevTo(), 'MsgType' => self::MSGTYPE_TEXT, 'Content' => $this->_auto_text_filter($text), 'CreateTime' => time(), 'FuncFlag' => $FuncFlag);
		$this->Message($msg);
		return $this;
	}

	public function image($mediaid = '')
	{
		$FuncFlag = ($this->_funcflag ? 1 : 0);
		$msg = array(
			'ToUserName'   => $this->getRevFrom(),
			'FromUserName' => $this->getRevTo(),
			'MsgType'      => self::MSGTYPE_IMAGE,
			'Image'        => array('MediaId' => $mediaid),
			'CreateTime'   => time(),
			'FuncFlag'     => $FuncFlag
			);
		$this->Message($msg);
		return $this;
	}

	public function voice($mediaid = '')
	{
		$FuncFlag = ($this->_funcflag ? 1 : 0);
		$msg = array(
			'ToUserName'   => $this->getRevFrom(),
			'FromUserName' => $this->getRevTo(),
			'MsgType'      => self::MSGTYPE_VOICE,
			'Voice'        => array('MediaId' => $mediaid),
			'CreateTime'   => time(),
			'FuncFlag'     => $FuncFlag
			);
		$this->Message($msg);
		return $this;
	}

	public function video($mediaid = '', $title = '', $description = '')
	{
		$FuncFlag = ($this->_funcflag ? 1 : 0);
		$msg = array(
			'ToUserName'   => $this->getRevFrom(),
			'FromUserName' => $this->getRevTo(),
			'MsgType'      => self::MSGTYPE_VIDEO,
			'Video'        => array('MediaId' => $mediaid, 'Title' => $title, 'Description' => $description),
			'CreateTime'   => time(),
			'FuncFlag'     => $FuncFlag
			);
		$this->Message($msg);
		return $this;
	}

	public function music($title, $desc, $musicurl, $hgmusicurl = '', $thumbmediaid = '')
	{
		$FuncFlag = ($this->_funcflag ? 1 : 0);
		$msg = array(
			'ToUserName'   => $this->getRevFrom(),
			'FromUserName' => $this->getRevTo(),
			'CreateTime'   => time(),
			'MsgType'      => self::MSGTYPE_MUSIC,
			'Music'        => array('Title' => $title, 'Description' => $desc, 'MusicUrl' => $musicurl, 'HQMusicUrl' => $hgmusicurl),
			'FuncFlag'     => $FuncFlag
			);

		if ($thumbmediaid) {
			$msg['Music']['ThumbMediaId'] = $thumbmediaid;
		}

		$this->Message($msg);
		return $this;
	}

	public function news($newsData = array())
	{
		$FuncFlag = ($this->_funcflag ? 1 : 0);
		$count = count($newsData);
		$msg = array('ToUserName' => $this->getRevFrom(), 'FromUserName' => $this->getRevTo(), 'MsgType' => self::MSGTYPE_NEWS, 'CreateTime' => time(), 'ArticleCount' => $count, 'Articles' => $newsData, 'FuncFlag' => $FuncFlag);
		$this->Message($msg);
		return $this;
	}

	public function reply($msg = array(), $return = false)
	{
		if (empty($msg)) {
			if (empty($this->_msg)) {
				return false;
			}

			$msg = $this->_msg;
		}

		$xmldata = $this->xml_encode($msg);

		if ($this->encrypt_type == 'aes') {
			$pc = new Prpcrypt($this->encodingAesKey);
			$array = $pc->encrypt($xmldata, $this->appid);
			$ret = $array[0];

			if ($ret != 0) {
				$this->log('encrypt err!');
				return false;
			}

			$timestamp = time();
			$nonce = rand(77, 999) * rand(605, 888) * rand(11, 99);
			$encrypt = $array[1];
			$tmpArr = array($this->token, $timestamp, $nonce, $encrypt);
			sort($tmpArr, SORT_STRING);
			$signature = implode($tmpArr);
			$signature = sha1($signature);
			$xmldata = $this->generate($encrypt, $signature, $timestamp, $nonce);
		}

		if ($return) {
			return $xmldata;
		}
		else {
			echo $xmldata;
		}
	}

	private function generate($encrypt, $signature, $timestamp, $nonce)
	{
		$format = "<xml>\r\n<Encrypt><![CDATA[%s]]></Encrypt>\r\n<MsgSignature><![CDATA[%s]]></MsgSignature>\r\n<TimeStamp>%s</TimeStamp>\r\n<Nonce><![CDATA[%s]]></Nonce>\r\n</xml>";
		return sprintf($format, $encrypt, $signature, $timestamp, $nonce);
	}

	private function http_get($url)
	{
		$oCurl = curl_init();

		if (stripos($url, 'https://') !== false) {
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
		}

		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);

		if (intval($aStatus['http_code']) == 200) {
			return $sContent;
		}
		else {
			return false;
		}
	}

	private function http_post($url, $param, $post_file = false)
	{
		$oCurl = curl_init();

		if (stripos($url, 'https://') !== false) {
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
		}

		if (is_string($param) || $post_file) {
			$strPOST = $param;
		}
		else {
			$aPOST = array();

			foreach ($param as $key => $val) {
				$aPOST[] = $key . '=' . urlencode($val);
			}

			$strPOST = join('&', $aPOST);
		}

		if (class_exists('\\CURLFile')) {
			curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, true);
		}
		else if (defined('CURLOPT_SAFE_UPLOAD')) {
			curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
		}

		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_POST, true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);

		if (intval($aStatus['http_code']) == 200) {
			return $sContent;
		}
		else {
			return false;
		}
	}

	protected function setCache($cachename, $value, $expired)
	{
		return false;
	}

	protected function getCache($cachename)
	{
		return false;
	}

	protected function removeCache($cachename)
	{
		return false;
	}

	public function get_access_token()
	{
		return $this->access_token;
	}

	public function checkAuth($appid = '', $appsecret = '', $token = '')
	{
		if (!$appid || !$appsecret) {
			$appid = $this->appid;
			$appsecret = $this->appsecret;
		}

		if ($token) {
			$this->access_token = $token;
			return $this->access_token;
		}

		$authname = 'wechat_access_token' . $appid;

		if ($rs = $this->getCache($authname)) {
			$this->access_token = $rs;
			return $rs;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::AUTH_URL . 'appid=' . $appid . '&secret=' . $appsecret);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			$this->access_token = $json['access_token'];
			$expire = ($json['expires_in'] ? intval($json['expires_in']) - 100 : 3600);
			$this->setCache($authname, $this->access_token, $expire);
			return $this->access_token;
		}

		return false;
	}

	public function resetAuth($appid = '')
	{
		if (!$appid) {
			$appid = $this->appid;
		}

		$this->access_token = '';
		$authname = 'wechat_access_token' . $appid;
		$this->removeCache($authname);
		return true;
	}

	public function resetJsTicket($appid = '')
	{
		if (!$appid) {
			$appid = $this->appid;
		}

		$this->jsapi_ticket = '';
		$authname = 'wechat_jsapi_ticket' . $appid;
		$this->removeCache($authname);
		return true;
	}

	public function getJsTicket($appid = '', $jsapi_ticket = '')
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!$appid) {
			$appid = $this->appid;
		}

		if ($jsapi_ticket) {
			$this->jsapi_ticket = $jsapi_ticket;
			return $this->jsapi_ticket;
		}

		$authname = 'wechat_jsapi_ticket' . $appid;

		if ($rs = $this->getCache($authname)) {
			$this->jsapi_ticket = $rs;
			return $rs;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::GET_TICKET_URL . 'access_token=' . $this->access_token . '&type=jsapi');

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			$this->jsapi_ticket = $json['ticket'];
			$expire = ($json['expires_in'] ? intval($json['expires_in']) - 100 : 3600);
			$this->setCache($authname, $this->jsapi_ticket, $expire);
			return $this->jsapi_ticket;
		}

		return false;
	}

	public function getJsSign($url, $timestamp = 0, $noncestr = '', $appid = '')
	{
		if ((!$this->jsapi_ticket && !$this->getJsTicket($appid)) || !$url) {
			return false;
		}

		if (!$timestamp) {
			$timestamp = time();
		}

		if (!$noncestr) {
			$noncestr = $this->generateNonceStr();
		}

		$ret = strpos($url, '#');

		if ($ret) {
			$url = substr($url, 0, $ret);
		}

		$url = trim($url);

		if (empty($url)) {
			return false;
		}

		$arrdata = array('timestamp' => $timestamp, 'noncestr' => $noncestr, 'url' => $url, 'jsapi_ticket' => $this->jsapi_ticket);
		$sign = $this->getSignature($arrdata);

		if (!$sign) {
			return false;
		}

		$signPackage = array('appId' => $this->appid, 'nonceStr' => $noncestr, 'timestamp' => $timestamp, 'url' => $url, 'signature' => $sign);
		return $signPackage;
	}

	static public function json_encode($arr)
	{
		if (count($arr) == 0) {
			return '[]';
		}

		$parts = array();
		$is_list = false;
		$keys = array_keys($arr);
		$max_length = count($arr) - 1;
		if (($keys[0] === 0) && ($keys[$max_length] === $max_length)) {
			$is_list = true;

			for ($i = 0; $i < count($keys); $i++) {
				if ($i != $keys[$i]) {
					$is_list = false;
					break;
				}
			}
		}

		foreach ($arr as $key => $value) {
			if (is_array($value)) {
				if ($is_list) {
					$parts[] = self::json_encode($value);
				}
				else {
					$parts[] = '"' . $key . '":' . self::json_encode($value);
				}
			}
			else {
				$str = '';

				if (!$is_list) {
					$str = '"' . $key . '":';
				}

				if (!is_string($value) && is_numeric($value) && ($value < 2000000000)) {
					$str .= $value;
				}
				else if ($value === false) {
					$str .= 'false';
				}
				else if ($value === true) {
					$str .= 'true';
				}
				else {
					$str .= '"' . addslashes($value) . '"';
				}

				$parts[] = $str;
			}
		}

		$json = implode(',', $parts);

		if ($is_list) {
			return '[' . $json . ']';
		}

		return '{' . $json . '}';
	}

	public function getSignature($arrdata, $method = 'sha1')
	{
		if (!function_exists($method)) {
			return false;
		}

		ksort($arrdata);
		$paramstring = '';

		foreach ($arrdata as $key => $value) {
			if (strlen($paramstring) == 0) {
				$paramstring .= $key . '=' . $value;
			}
			else {
				$paramstring .= '&' . $key . '=' . $value;
			}
		}

		$Sign = $method($paramstring);
		return $Sign;
	}

	public function getJsCardTicket($appid = '', $api_ticket = '')
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!$appid) {
			$appid = $this->appid;
		}

		if ($api_ticket) {
			$this->api_ticket = $api_ticket;
			return $this->api_ticket;
		}

		$authname = 'wechat_api_ticket_wxcard' . $appid;

		if ($rs = $this->getCache($authname)) {
			$this->api_ticket = $rs;
			return $rs;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::GET_TICKET_URL . 'access_token=' . $this->access_token . '&type=wx_card');

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			$this->api_ticket = $json['ticket'];
			$expire = ($json['expires_in'] ? intval($json['expires_in']) - 100 : 3600);
			$this->setCache($authname, $this->api_ticket, $expire);
			return $this->api_ticket;
		}

		return false;
	}

	public function getTicketSignature($arrdata, $method = 'sha1')
	{
		if (!function_exists($method)) {
			return false;
		}

		$newArray = array();

		foreach ($arrdata as $key => $value) {
			array_push($newArray, (string) $value);
		}

		sort($newArray, SORT_STRING);
		return $method(implode($newArray));
	}

	public function generateNonceStr($length = 16)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$str = '';

		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}

		return $str;
	}

	public function getServerIp()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::CALLBACKSERVER_GET_URL . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json['ip_list'];
		}

		return false;
	}

	public function createMenu($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MENU_CREATE_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function getMenu()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::MENU_GET_URL . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function deleteMenu()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::MENU_DELETE_URL . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function uploadMedia($data, $type)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MEDIA_UPLOAD_URL . 'access_token=' . $this->access_token . '&type=' . $type, $data, true);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getMedia($media_id, $is_video = false)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$url_prefix = ($is_video ? str_replace('https', 'http', self::API_URL_PREFIX) : self::API_URL_PREFIX);
		$result = $this->http_get($url_prefix . self::MEDIA_GET_URL . 'access_token=' . $this->access_token . '&media_id=' . $media_id);

		if ($result) {
			if (is_string($result)) {
				$json = json_decode($result, true);

				if (isset($json['errcode'])) {
					$this->errCode = $json['errcode'];
					$this->errMsg = $json['errmsg'];
					return false;
				}
			}

			return $result;
		}

		return false;
	}

	public function uploadImg($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MEDIA_UPLOADIMG_URL . 'access_token=' . $this->access_token, $data, true);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function uploadForeverMedia($data, $type, $is_video = false, $video_info = array())
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if ($is_video) {
			$data['description'] = self::json_encode($video_info);
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MEDIA_FOREVER_UPLOAD_URL . 'access_token=' . $this->access_token . '&type=' . $type, $data, true);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function uploadForeverArticles($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MEDIA_FOREVER_NEWS_UPLOAD_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateForeverArticles($media_id, $data, $index = 0)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!isset($data['media_id'])) {
			$data['media_id'] = $media_id;
		}

		if (!isset($data['index'])) {
			$data['index'] = $index;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MEDIA_FOREVER_NEWS_UPDATE_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getForeverMedia($media_id, $is_video = false)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('media_id' => $media_id);
		$result = $this->http_post(self::API_URL_PREFIX . self::MEDIA_FOREVER_GET_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			if (is_string($result)) {
				$json = json_decode($result, true);

				if ($json) {
					if (isset($json['errcode'])) {
						$this->errCode = $json['errcode'];
						$this->errMsg = $json['errmsg'];
						return false;
					}

					return $json;
				}
				else {
					return $result;
				}
			}

			return $result;
		}

		return false;
	}

	public function delForeverMedia($media_id)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('media_id' => $media_id);
		$result = $this->http_post(self::API_URL_PREFIX . self::MEDIA_FOREVER_DEL_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function getForeverList($type, $offset, $count)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('type' => $type, 'offset' => $offset, 'count' => $count);
		$result = $this->http_post(self::API_URL_PREFIX . self::MEDIA_FOREVER_BATCHGET_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);

			if (isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getForeverCount()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::MEDIA_FOREVER_COUNT_URL . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);

			if (isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function uploadArticles($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MEDIA_UPLOADNEWS_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function uploadMpVideo($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::UPLOAD_MEDIA_URL . self::MEDIA_VIDEO_UPLOAD . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function sendMassMessage($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MASS_SEND_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function sendGroupMassMessage($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MASS_SEND_GROUP_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function deleteMassMessage($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MASS_DELETE_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function previewMassMessage($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MASS_PREVIEW_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function queryMassMessage($msg_id)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::MASS_QUERY_URL . 'access_token=' . $this->access_token, self::json_encode(array('msg_id' => $msg_id)));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getQRCode($scene_id, $type = 0, $expire = 604800)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!isset($scene_id)) {
			return false;
		}

		switch ($type) {
		case '0':
			if (!is_numeric($scene_id)) {
				return false;
			}

			$action_name = 'QR_SCENE';
			$action_info = array(
				'scene' => array('scene_id' => $scene_id)
				);
			break;

		case '1':
			if (!is_numeric($scene_id)) {
				return false;
			}

			$action_name = 'QR_LIMIT_SCENE';
			$action_info = array(
				'scene' => array('scene_id' => $scene_id)
				);
			break;

		case '2':
			if (!is_string($scene_id)) {
				return false;
			}

			$action_name = 'QR_LIMIT_STR_SCENE';
			$action_info = array(
				'scene' => array('scene_str' => $scene_id)
				);
			break;

		case '3':
			if (!is_string($scene_id)) {
				return false;
			}

			$action_name = 'QR_STR_SCENE';
			$action_info = array(
				'scene' => array('scene_str' => $scene_id)
				);
			break;

		default:
			return false;
		}

		$data = array('action_name' => $action_name, 'expire_seconds' => $expire, 'action_info' => $action_info);
		if (($type == 1) || ($type == 2)) {
			unset($data['expire_seconds']);
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::QRCODE_CREATE_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getQRUrl($ticket)
	{
		return self::QRCODE_IMG_URL . urlencode($ticket);
	}

	public function getShortUrl($long_url)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('action' => 'long2short', 'long_url' => $long_url);
		$result = $this->http_post(self::API_URL_PREFIX . self::SHORT_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json['short_url'];
		}

		return false;
	}

	public function getDatacube($type, $subtype, $begin_date, $end_date = '')
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!isset(self::$DATACUBE_URL_ARR[$type]) || !isset(self::$DATACUBE_URL_ARR[$type][$subtype])) {
			return false;
		}

		$data = array('begin_date' => $begin_date, 'end_date' => $end_date ? $end_date : $begin_date);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::$DATACUBE_URL_ARR[$type][$subtype] . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return isset($json['list']) ? $json['list'] : $json;
		}

		return false;
	}

	public function getUserList($next_openid = '')
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::USER_GET_URL . 'access_token=' . $this->access_token . '&next_openid=' . $next_openid);

		if ($result) {
			$json = json_decode($result, true);

			if (isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getUserInfo($openid, $lang = 'zh_CN')
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::USER_INFO_URL . 'access_token=' . $this->access_token . '&openid=' . $openid . '&lang=' . $lang);

		if ($result) {
			$json = json_decode($result, true);

			if (isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateUserRemark($openid, $remark)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('openid' => $openid, 'remark' => $remark);
		$result = $this->http_post(self::API_URL_PREFIX . self::USER_UPDATEREMARK_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getGroup()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::GROUP_GET_URL . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);

			if (isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getUserGroup($openid)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('openid' => $openid);
		$result = $this->http_post(self::API_URL_PREFIX . self::USER_GROUP_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			else if (isset($json['groupid'])) {
				return $json['groupid'];
			}
		}

		return false;
	}

	public function createGroup($name)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array(
			'group' => array('name' => $name)
			);
		$result = $this->http_post(self::API_URL_PREFIX . self::GROUP_CREATE_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateGroup($groupid, $name)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array(
			'group' => array('id' => $groupid, 'name' => $name)
			);
		$result = $this->http_post(self::API_URL_PREFIX . self::GROUP_UPDATE_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateGroupMembers($groupid, $openid)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('openid' => $openid, 'to_groupid' => $groupid);
		$result = $this->http_post(self::API_URL_PREFIX . self::GROUP_MEMBER_UPDATE_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function batchUpdateGroupMembers($groupid, $openid_list)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('openid_list' => $openid_list, 'to_groupid' => $groupid);
		$result = $this->http_post(self::API_URL_PREFIX . self::GROUP_MEMBER_BATCHUPDATE_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function sendCustomMessage($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::CUSTOM_SEND_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getOauthRedirect($callback, $state = '', $scope = 'snsapi_userinfo')
	{
		return self::OAUTH_PREFIX . self::OAUTH_AUTHORIZE_URL . 'appid=' . $this->appid . '&redirect_uri=' . urlencode($callback) . '&response_type=code&scope=' . $scope . '&state=' . $state . '#wechat_redirect';
	}

	public function getOauthAccessToken()
	{
		$code = (isset($_GET['code']) ? $_GET['code'] : '');

		if (!$code) {
			return false;
		}

		$result = $this->http_get(self::API_BASE_URL_PREFIX . self::OAUTH_TOKEN_URL . 'appid=' . $this->appid . '&secret=' . $this->appsecret . '&code=' . $code . '&grant_type=authorization_code');

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			$this->user_token = $json['access_token'];
			return $json;
		}

		return false;
	}

	public function getOauthRefreshToken($refresh_token)
	{
		$result = $this->http_get(self::API_BASE_URL_PREFIX . self::OAUTH_REFRESH_URL . 'appid=' . $this->appid . '&grant_type=refresh_token&refresh_token=' . $refresh_token);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			$this->user_token = $json['access_token'];
			return $json;
		}

		return false;
	}

	public function getOauthUserinfo($access_token, $openid, $lang = 'zh_CN')
	{
		$result = $this->http_get(self::API_BASE_URL_PREFIX . self::OAUTH_USERINFO_URL . 'access_token=' . $access_token . '&openid=' . $openid . '&lang=' . $lang);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getOauthAuth($access_token, $openid)
	{
		$result = $this->http_get(self::API_BASE_URL_PREFIX . self::OAUTH_AUTH_URL . 'access_token=' . $access_token . '&openid=' . $openid);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			else if ($json['errcode'] == 0) {
				return true;
			}
		}

		return false;
	}

	public function setTMIndustry($id1, $id2 = '')
	{
		if ($id1) {
			$data['industry_id1'] = $id1;
		}

		if ($id2) {
			$data['industry_id2'] = $id2;
		}

		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::TEMPLATE_SET_INDUSTRY_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getTMIndustry()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::TEMPLATE_GET_INDUSTRY_URL . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function addTemplateMessage($tpl_id)
	{
		$data = array('template_id_short' => $tpl_id);
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::TEMPLATE_ADD_TPL_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json['template_id'];
		}

		return false;
	}

	public function delTemplate($template_id)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('template_id' => $template_id);
		$result = $this->http_post(self::API_URL_PREFIX . self::TEMPLATE_DEL_TPL_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function sendTemplateMessage($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::TEMPLATE_SEND_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getCustomServiceMessage($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::CUSTOM_SERVICE_GET_RECORD . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function transfer_customer_service($customer_account = '')
	{
		$msg = array('ToUserName' => $this->getRevFrom(), 'FromUserName' => $this->getRevTo(), 'CreateTime' => time(), 'MsgType' => 'transfer_customer_service');

		if ($customer_account) {
			$msg['TransInfo'] = array('KfAccount' => $customer_account);
		}

		$this->Message($msg);
		return $this;
	}

	public function getCustomServiceKFlist()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::CUSTOM_SERVICE_GET_KFLIST . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getCustomServiceOnlineKFlist()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::CUSTOM_SERVICE_GET_ONLINEKFLIST . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function createKFSession($openid, $kf_account, $text = '')
	{
		$data = array('openid' => $openid, 'kf_account' => $kf_account);

		if ($text) {
			$data['text'] = $text;
		}

		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CUSTOM_SESSION_CREATE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function closeKFSession($openid, $kf_account, $text = '')
	{
		$data = array('openid' => $openid, 'kf_account' => $kf_account);

		if ($text) {
			$data['text'] = $text;
		}

		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CUSTOM_SESSION_CLOSE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getKFSession($openid)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_BASE_URL_PREFIX . self::CUSTOM_SESSION_GET . 'access_token=' . $this->access_token . '&openid=' . $openid);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getKFSessionlist($kf_account)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_BASE_URL_PREFIX . self::CUSTOM_SESSION_GET_LIST . 'access_token=' . $this->access_token . '&kf_account=' . $kf_account);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getKFSessionWait()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_BASE_URL_PREFIX . self::CUSTOM_SESSION_GET_WAIT . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function addKFAccount($account, $nickname, $password)
	{
		$data = array('kf_account' => $account, 'nickname' => $nickname, 'password' => md5($password));
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CS_KF_ACCOUNT_ADD_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateKFAccount($account, $nickname, $password)
	{
		$data = array('kf_account' => $account, 'nickname' => $nickname, 'password' => md5($password));
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CS_KF_ACCOUNT_UPDATE_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function deleteKFAccount($account)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_BASE_URL_PREFIX . self::CS_KF_ACCOUNT_DEL_URL . 'access_token=' . $this->access_token . '&kf_account=' . $account);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function setKFHeadImg($account, $imgfile)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CS_KF_ACCOUNT_UPLOAD_HEADIMG_URL . 'access_token=' . $this->access_token . '&kf_account=' . $account, array('media' => '@' . $imgfile), true);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function querySemantic($uid, $query, $category, $latitude = 0, $longitude = 0, $city = '', $region = '')
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('query' => $query, 'category' => $category, 'appid' => $this->appid, 'uid' => '');

		if ($latitude) {
			$data['latitude'] = $latitude;
			$data['longitude'] = $longitude;
		}
		else if ($city) {
			$data['city'] = $city;
		}
		else if ($region) {
			$data['region'] = $region;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SEMANTIC_API_URL . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function createCard($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_CREATE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateCard($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_UPDATE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function delCard($card_id)
	{
		$data = array('card_id' => $card_id);
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_DELETE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function getCardInfo($card_id)
	{
		$data = array('card_id' => $card_id);
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_GET . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getCardColors()
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_BASE_URL_PREFIX . self::CARD_GETCOLORS . 'access_token=' . $this->access_token);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getCardLocations($offset = 0, $count = 0)
	{
		$data = array('offset' => $offset, 'count' => $count);
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_LOCATION_BATCHGET . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function addCardLocations($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_LOCATION_BATCHADD . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function createCardQrcode($card_id, $code = '', $openid = '', $expire_seconds = 0, $is_unique_code = false, $balance = '')
	{
		$card = array('card_id' => $card_id);
		$data = array('action_name' => 'QR_CARD');

		if ($code) {
			$card['code'] = $code;
		}

		if ($openid) {
			$card['openid'] = $openid;
		}

		if ($is_unique_code) {
			$card['is_unique_code'] = $is_unique_code;
		}

		if ($balance) {
			$card['balance'] = $balance;
		}

		if ($expire_seconds) {
			$data['expire_seconds'] = $expire_seconds;
		}

		$data['action_info'] = array('card' => $card);
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_QRCODE_CREATE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function consumeCardCode($code, $card_id = '')
	{
		$data = array('code' => $code);

		if ($card_id) {
			$data['card_id'] = $card_id;
		}

		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_CODE_CONSUME . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function decryptCardCode($encrypt_code)
	{
		$data = array('encrypt_code' => $encrypt_code);
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_CODE_DECRYPT . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function checkCardCode($code)
	{
		$data = array('code' => $code);
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_CODE_GET . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getCardIdList($offset = 0, $count = 50)
	{
		if (50 < $count) {
			$count = 50;
		}

		$data = array('offset' => $offset, 'count' => $count);
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_BATCHGET . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateCardCode($code, $card_id, $new_code)
	{
		$data = array('code' => $code, 'card_id' => $card_id, 'new_code' => $new_code);
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_CODE_UPDATE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function unavailableCardCode($code, $card_id = '')
	{
		$data = array('code' => $code);

		if ($card_id) {
			$data['card_id'] = $card_id;
		}

		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_CODE_UNAVAILABLE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function modifyCardStock($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_MODIFY_STOCK . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function updateMeetingCard($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_MEETINGCARD_UPDATEUSER . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function activateMemberCard($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_MEMBERCARD_ACTIVATE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function updateMemberCard($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_MEMBERCARD_UPDATEUSER . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateLuckyMoney($code, $balance, $card_id = '')
	{
		$data = array('code' => $code, 'balance' => $balance);

		if ($card_id) {
			$data['card_id'] = $card_id;
		}

		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_LUCKYMONEY_UPDATE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function setCardTestWhiteList($openid = array(), $user = array())
	{
		$data = array();

		if (0 < count($openid)) {
			$data['openid'] = $openid;
		}

		if (0 < count($user)) {
			$data['username'] = $user;
		}

		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::CARD_TESTWHILELIST_SET . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function applyShakeAroundDevice($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_DEVICE_APPLYID . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateShakeAroundDevice($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_DEVICE_UPDATE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function searchShakeAroundDevice($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_DEVICE_SEARCH . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function bindLocationShakeAroundDevice($device_id, $poi_id, $uuid = '', $major = 0, $minor = 0)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!$device_id) {
			if (!$uuid || !$major || !$minor) {
				return false;
			}

			$device_identifier = array('uuid' => $uuid, 'major' => $major, 'minor' => $minor);
		}
		else {
			$device_identifier = array('device_id' => $device_id);
		}

		$data = array('device_identifier' => $device_identifier, 'poi_id' => $poi_id);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_DEVICE_BINDLOCATION . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function bindPageShakeAroundDevice($device_id, $page_ids = array(), $bind = 1, $append = 1, $uuid = '', $major = 0, $minor = 0)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!$device_id) {
			if (!$uuid || !$major || !$minor) {
				return false;
			}

			$device_identifier = array('uuid' => $uuid, 'major' => $major, 'minor' => $minor);
		}
		else {
			$device_identifier = array('device_id' => $device_id);
		}

		$data = array('device_identifier' => $device_identifier, 'page_ids' => $page_ids, 'bind' => $bind, 'append' => $append);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_DEVICE_BINDPAGE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function uploadShakeAroundMedia($data)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_post(self::API_URL_PREFIX . self::SHAKEAROUND_MATERIAL_ADD . 'access_token=' . $this->access_token, $data, true);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function addShakeAroundPage($title, $description, $icon_url, $page_url, $comment = '')
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('title' => $title, 'description' => $description, 'icon_url' => $icon_url, 'page_url' => $page_url, 'comment' => $comment);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_PAGE_ADD . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function updateShakeAroundPage($page_id, $title, $description, $icon_url, $page_url, $comment = '')
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('page_id' => $page_id, 'title' => $title, 'description' => $description, 'icon_url' => $icon_url, 'page_url' => $page_url, 'comment' => $comment);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_PAGE_UPDATE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function searchShakeAroundPage($page_ids = array(), $begin = 0, $count = 1)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!empty($page_ids)) {
			$data = array('page_ids' => $page_ids);
		}
		else {
			$data = array('begin' => $begin, 'count' => $count);
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_PAGE_SEARCH . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function deleteShakeAroundPage($page_ids = array())
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('page_ids' => $page_ids);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_PAGE_DELETE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getShakeInfoShakeAroundUser($ticket)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('ticket' => $ticket);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_USER_GETSHAKEINFO . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function deviceShakeAroundStatistics($device_id, $begin_date, $end_date, $uuid = '', $major = 0, $minor = 0)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!$device_id) {
			if (!$uuid || !$major || !$minor) {
				return false;
			}

			$device_identifier = array('uuid' => $uuid, 'major' => $major, 'minor' => $minor);
		}
		else {
			$device_identifier = array('device_id' => $device_id);
		}

		$data = array('device_identifier' => $device_identifier, 'begin_date' => $begin_date, 'end_date' => $end_date);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_STATISTICS_DEVICE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function pageShakeAroundStatistics($page_id, $begin_date, $end_date)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array('page_id' => $page_id, 'begin_date' => $begin_date, 'end_date' => $end_date);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::SHAKEAROUND_STATISTICS_DEVICE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function getOrderByID($order_id)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!$order_id) {
			return false;
		}

		$data = array('order_id' => $order_id);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::MERCHANT_ORDER_GETBYID . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (isset($json['errcode']) && $json['errcode']) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json['order'];
		}

		return false;
	}

	public function getOrderByFilter($status = NULL, $begintime = NULL, $endtime = NULL)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		$data = array();
		$valid_status = array(2, 3, 5, 8);
		if (is_numeric($status) && in_array($status, $valid_status)) {
			$data['status'] = $status;
		}

		if (is_numeric($begintime) && is_numeric($endtime)) {
			$data['begintime'] = $begintime;
			$data['endtime'] = $endtime;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::MERCHANT_ORDER_GETBYFILTER . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (isset($json['errcode']) && $json['errcode']) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json['order_list'];
		}

		return false;
	}

	public function setOrderDelivery($order_id, $need_delivery = 0, $delivery_company = NULL, $delivery_track_no = NULL, $is_others = 0)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!$order_id) {
			return false;
		}

		$data = array();
		$data['order_id'] = $order_id;

		if ($need_delivery) {
			$data['delivery_company'] = $delivery_company;
			$data['delivery_track_no'] = $delivery_track_no;
			$data['is_others'] = $is_others;
		}
		else {
			$data['need_delivery'] = $need_delivery;
		}

		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::MERCHANT_ORDER_SETDELIVERY . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (isset($json['errcode']) && $json['errcode']) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	public function closeOrder($order_id)
	{
		if (!$this->access_token && !$this->checkAuth()) {
			return false;
		}

		if (!$order_id) {
			return false;
		}

		$data = array('order_id' => $order_id);
		$result = $this->http_post(self::API_BASE_URL_PREFIX . self::MERCHANT_ORDER_CLOSE . 'access_token=' . $this->access_token, self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (isset($json['errcode']) && $json['errcode']) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return true;
		}

		return false;
	}

	private function parseSkuInfo($skuInfo)
	{
		$skuInfo = str_replace('$', '', $skuInfo);
		$matches = explode(';', $skuInfo);
		$result = array();

		foreach ($matches as $matche) {
			$arrs = explode(':', $matche);
			$result[$arrs[0]] = $arrs[1];
		}

		return $result;
	}

	public function getRevOrderSkuInfo()
	{
		if (isset($this->_receive['SkuInfo'])) {
			return $this->parseSkuInfo($this->_receive['SkuInfo']);
		}
		else {
			return false;
		}
	}
}

class PKCS7Encoder
{
	static public $block_size = 32;

	public function encode($text)
	{
		$block_size = PKCS7Encoder::$block_size;
		$text_length = strlen($text);
		$amount_to_pad = PKCS7Encoder::$block_size - ($text_length % PKCS7Encoder::$block_size);

		if ($amount_to_pad == 0) {
			$amount_to_pad = PKCS7Encoder::block_size;
		}

		$pad_chr = chr($amount_to_pad);
		$tmp = '';

		for ($index = 0; $index < $amount_to_pad; $index++) {
			$tmp .= $pad_chr;
		}

		return $text . $tmp;
	}

	public function decode($text)
	{
		$pad = ord(substr($text, -1));
		if (($pad < 1) || (PKCS7Encoder::$block_size < $pad)) {
			$pad = 0;
		}

		return substr($text, 0, strlen($text) - $pad);
	}
}

class Prpcrypt
{
	public $key;

	public function __construct($k)
	{
		$this->key = base64_decode($k . '=');
	}

	public function Prpcrypt($k)
	{
		$this->key = base64_decode($k . '=');
	}

	public function encrypt($text, $appid)
	{
		try {
			$random = $this->getRandomStr();
			$text = $random . pack('N', strlen($text)) . $text . $appid;
			$size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
			$module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
			$iv = substr($this->key, 0, 16);
			$pkc_encoder = new PKCS7Encoder();
			$text = $pkc_encoder->encode($text);
			mcrypt_generic_init($module, $this->key, $iv);
			$encrypted = mcrypt_generic($module, $text);
			mcrypt_generic_deinit($module);
			mcrypt_module_close($module);
			return array(ErrorCode::$OK, base64_encode($encrypted));
		}
		catch (Exception $e) {
			return array(ErrorCode::$EncryptAESError, null);
		}
	}

	public function decrypt($encrypted, $appid)
	{
		try {
			$ciphertext_dec = base64_decode($encrypted);
			$module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
			$iv = substr($this->key, 0, 16);
			mcrypt_generic_init($module, $this->key, $iv);
			$decrypted = mdecrypt_generic($module, $ciphertext_dec);
			mcrypt_generic_deinit($module);
			mcrypt_module_close($module);
		}
		catch (Exception $e) {
			return array(ErrorCode::$DecryptAESError, null);
		}

		try {
			$pkc_encoder = new PKCS7Encoder();
			$result = $pkc_encoder->decode($decrypted);

			if (strlen($result) < 16) {
				return '';
			}

			$content = substr($result, 16, strlen($result));
			$len_list = unpack('N', substr($content, 0, 4));
			$xml_len = $len_list[1];
			$xml_content = substr($content, 4, $xml_len);
			$from_appid = substr($content, $xml_len + 4);

			if (!$appid) {
				$appid = $from_appid;
			}
		}
		catch (Exception $e) {
			return array(ErrorCode::$IllegalBuffer, null);
		}

		if ($from_appid != $appid) {
			return array(ErrorCode::$ValidateAppidError, null);
		}

		return array(0, $xml_content, $from_appid);
	}

	public function getRandomStr()
	{
		$str = '';
		$str_pol = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$max = strlen($str_pol) - 1;

		for ($i = 0; $i < 16; $i++) {
			$str .= $str_pol[mt_rand(0, $max)];
		}

		return $str;
	}
}

class ErrorCode
{
	static public $OK = 0;
	static public $ValidateSignatureError = 40001;
	static public $ParseXmlError = 40002;
	static public $ComputeSignatureError = 40003;
	static public $IllegalAesKey = 40004;
	static public $ValidateAppidError = 40005;
	static public $EncryptAESError = 40006;
	static public $DecryptAESError = 40007;
	static public $IllegalBuffer = 40008;
	static public $EncodeBase64Error = 40009;
	static public $DecodeBase64Error = 40010;
	static public $GenReturnXmlError = 40011;
	static public $errCode = array(0 => '处理成功', 40001 => '校验签名失败', 40002 => '解析xml失败', 40003 => '计算签名失败', 40004 => '不合法的AESKey', 40005 => '校验AppID失败', 40006 => 'AES加密失败', 40007 => 'AES解密失败', 40008 => '公众平台发送的xml不合法', 40009 => 'Base64编码失败', 40010 => 'Base64解码失败', 40011 => '公众帐号生成回包xml失败');

	static public function getErrText($err)
	{
		if (isset(self::$errCode[$err])) {
			return self::$errCode[$err];
		}
		else {
			return false;
		}
	}
}


?>
