<?php
//zend WEBSC商城资源  禁止倒卖 一经发现停止任何服务
namespace App\Extensions;

class Wxapp
{
	const API_URL_PREFIX = 'https://api.weixin.qq.com';
	const AUTH_ORIZATION = '/sns/jscode2session?';
	const GET_ACCESS_TOKEN = '/cgi-bin/token?';
	const GET_USER_INFO = '/cgi-bin/user/info?';
	const GET_WXA_CODE = '/wxa/getwxacode?';
	const GET_WXA_CODE_UNLIMIT = '/wxa/getwxacodeunlimit?';
	const GET_WXA_QRCODE = '/cgi-bin/wxaapp/createwxaqrcode?';
	const GET_WXA_KEYWORD_LIST = '/cgi-bin/wxopen/template/library/get?';
	const GET_WXA_TEMPLATE_ADD = '/cgi-bin/wxopen/template/add?';
	const GET_WXA_TEMPLATE_DEL = '/cgi-bin/wxopen/template/del?';
	const GET_WXA_TEMPLATE_SEND_URL = '/cgi-bin/message/wxopen/template/send?';

	private $wx_mini_appid;
	private $wx_mini_secret;
	public $debug = false;
	public $errCode = 40001;
	public $errMsg = 'no access';

	public function __construct(array $options)
	{
		$this->wx_mini_appid = isset($options['appid']) ? $options['appid'] : '';
		$this->wx_mini_secret = isset($options['secret']) ? $options['secret'] : '';
	}

	public function getOauthOrization($code)
	{
		$params = array('appid' => $this->wx_mini_appid, 'secret' => $this->wx_mini_secret, 'js_code' => $code, 'grant_type' => 'authorization_code');
		$result = $this->curlGet(self::API_URL_PREFIX . self::AUTH_ORIZATION . http_build_query($params, '', '&'));

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

	public function getUnionid($token, $openid)
	{
		$params = array('withCredentials' => true, 'access_token' => $token, 'openid' => $openid, 'lang' => 'zh_CN');
		$result = $this->curlPost(self::API_URL_PREFIX . self::GET_USER_INFO, self::json_encode($params));

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

	public function getAccessToken()
	{
		$result = $this->curlGet(self::API_URL_PREFIX . self::GET_ACCESS_TOKEN . 'grant_type=client_credential&appid=' . $this->wx_mini_appid . '&secret=' . $this->wx_mini_secret);

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}

			return $json['access_token'];
		}

		return false;
	}

	public function getWaCode($path, $width = '430', $auto_color = true, $line_color = '')
	{
		$data = array('path' => $path, 'width' => $width, 'auto_color' => $auto_color, 'line_color' => $line_color);

		if ($auto_color === false) {
			unset($data['line_color']);
		}

		$result = $this->curlPost(self::API_URL_PREFIX . self::GET_WXA_CODE . 'access_token=' . self::getAccessToken(), self::json_encode($data));
		return $result;
	}

	public function getWaCodeUnlimit($scene = '', $path, $width, $auto_color = false, $line_color = '')
	{
		$data = array('scene' => $scene, 'page' => $path, 'width' => $width, 'auto_color' => $auto_color, 'line_color' => $line_color);

		if ($auto_color === false) {
			unset($data['line_color']);
		}

		$result = $this->curlPost(self::API_URL_PREFIX . self::GET_WXA_CODE_UNLIMIT . 'access_token=' . self::getAccessToken(), self::json_encode($data));
		return $result;
	}

	public function getWxaCode($path, $width = '430')
	{
		$data = array('path' => $path, 'width' => $width);
		$result = $this->curlPost(self::API_URL_PREFIX . self::GET_WXA_QRCODE . 'access_token=' . self::getAccessToken(), self::json_encode($data));
		return $result;
	}

	public function getWxTemplateKeywordList($tpl_id)
	{
		$tpl_id = array('id' => $tpl_id);
		$result = $this->curlPost(self::API_URL_PREFIX . self::GET_WXA_KEYWORD_LIST . 'access_token=' . self::getAccessToken(), self::json_encode($tpl_id));
		return json_decode($result, true);
	}

	public function wxaddTemplateMessage($tpl_id, $keyword_id)
	{
		$tpl_id = array('id' => $tpl_id, 'keyword_id_list' => $keyword_id);
		$result = $this->curlPost(self::API_URL_PREFIX . self::GET_WXA_TEMPLATE_ADD . 'access_token=' . self::getAccessToken(), self::json_encode($tpl_id));

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

	public function wxDelTemplate($template_id)
	{
		$data = array('template_id' => $template_id);
		$result = $this->curlPost(self::API_URL_PREFIX . self::GET_WXA_TEMPLATE_DEL . 'access_token=' . self::getAccessToken(), self::json_encode($data));

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
		$result = $this->curlPost(self::API_URL_PREFIX . self::GET_WXA_TEMPLATE_SEND_URL . 'access_token=' . self::getAccessToken(), self::json_encode($data));

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

	protected function curlGet($url, $timeout = 5, $header = '')
	{
		$ch = curl_init();

		if (stripos($url, 'https://') !== false) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		}

		curl_setopt($ch, CURLOPT_HTTP_VERSION, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
		$result = curl_exec($ch);
		$aStatus = curl_getinfo($ch);
		curl_close($ch);

		if (intval($aStatus['http_code']) == 200) {
			return $result;
		}
		else {
			return false;
		}
	}

	protected function curlPost($url, $post_data, $timeout = 5)
	{
		$ch = curl_init();

		if (stripos($url, 'https://') !== false) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		}

		$header = empty($header) ? '' : $header;

		if (is_string($post_data)) {
			$strPOST = $post_data;
		}
		else {
			$aPOST = array();

			foreach ($post_data as $key => $val) {
				$aPOST[] = $key . '=' . urlencode($val);
			}

			$strPOST = join('&', $aPOST);
		}

		curl_setopt($ch, CURLOPT_HTTP_VERSION, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $strPOST);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		$result = curl_exec($ch);
		$aStatus = curl_getinfo($ch);
		curl_close($ch);

		if (intval($aStatus['http_code']) == 200) {
			return $result;
		}
		else {
			return false;
		}
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
		if ($keys[0] === 0 && $keys[$max_length] === $max_length) {
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

				if (!is_string($value) && is_numeric($value) && $value < 2000000000) {
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

	public function log($log)
	{
		$log = is_array($log) ? var_export($log, true) : $log;
		if ($this->debug && function_exists('logResult')) {
			logResult($log);
		}
	}

	protected function setCache($cachename, $value, $expired)
	{
		return S($cachename, $value, $expired);
	}

	protected function getCache($cachename)
	{
		return S($cachename);
	}

	protected function removeCache($cachename)
	{
		return S($cachename, null);
	}
}


?>
