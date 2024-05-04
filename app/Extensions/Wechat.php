<?php

namespace App\Extensions;

class Wechat extends Wechat\SDK
{
	const PAY_PREFIX = 'https://api.mch.weixin.qq.com';
	const PAY_UNIFIEDORDER = '/pay/unifiedorder?';
	const PAY_ORDERQUERY = '/pay/orderquery?';
	const PAY_REFUND = '/secapi/pay/refund?';
	const PAY_REFUNDQUERY = '/pay/refundquery?';
	const TAGS_CREATE_URL = '/tags/create?';
	const TAGS_GET_URL = '/tags/get?';
	const TAGS_UPDATE_URL = '/tags/update?';
	const TAGS_DELETE_URL = '/tags/delete?';
	const USER_TAG_URL = '/user/tag/get?';
	const TAGS_MEMBER_BATCHTAGGING_URL = '/tags/members/batchtagging?';
	const TAGS_MEMBER_BATCHUNTAGGING_URL = '/tags/members/batchuntagging?';
	const TAGS_GETIDLIST_URL = '/tags/getidlist?';

	private $appid;
	private $mch_id;
	private $key;

	public function __construct($options)
	{
		$this->appid = isset($options['appid']) ? $options['appid'] : '';
		$this->mch_id = isset($options['mch_id']) ? $options['mch_id'] : '';
		$this->key = isset($options['key']) ? $options['key'] : '';
		parent::__construct($options);
	}

	public function getPaySign($arr = array())
	{
		if (empty($arr)) {
			return false;
		}

		$arr['appid'] = $this->appid;
		$arr['mch_id'] = $this->mch_id;
		$arr['nonce_str'] = $this->generateNonceStr();
		$paySign = $this->getPaySignature($arr);
		$arr['sign'] = $paySign;
		return $arr;
	}

	public function getPayJssdkSign($str)
	{
		if (empty($str)) {
			return false;
		}

		$arr = array();
		$arr['appId'] = $this->appid;
		$arr['timeStamp'] = ' ' . time();
		$arr['nonceStr'] = $this->generateNonceStr();
		$arr['package'] = 'prepay_id=' . $str;
		$arr['signType'] = 'MD5';
		$paySign = $this->getPaySignature($arr);
		$arr['paySign'] = $paySign;
		return $arr;
	}

	public function PayUnifiedOrder($arr = array(), $jsSign = false)
	{
		if (empty($arr)) {
			return false;
		}

		$arr['device_info'] = isset($arr['device_info']) ? $arr['device_info'] : 'WEB';
		$arr['fee_type'] = isset($arr['fee_type']) ? $arr['fee_type'] : 'CNY';
		$arr['trade_type'] = isset($arr['trade_type']) ? $arr['trade_type'] : 'JSAPI';
		$arrdata = $this->getPaySign($arr);
		$xmldata = $this->xml_encode($arrdata);
		$result = $this->http_post(self::PAY_PREFIX . self::PAY_UNIFIEDORDER, $xmldata);

		if ($result) {
			$json = (array) simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);

			if ($json['return_code'] != 'SUCCESS') {
				$this->errCode = $json['return_code'];
				$this->errMsg = $json['return_msg'];
				return false;
			}
			else if ($json['result_code'] != 'SUCCESS') {
				$this->errCode = $json['err_code'];
				$this->errMsg = $json['err_code_des'];
				return false;
			}

			return $jsSign == false ? $json : $this->getPayJssdkSign($json['prepay_id']);
		}

		return false;
	}

	public function getPaySignature($arrdata, $method = 'md5')
	{
		ksort($arrdata);
		$paramstring = '';

		foreach ($arrdata as $key => $value) {
			if (!$value) {
				continue;
			}

			if (strlen($paramstring) == 0) {
				$paramstring .= $key . '=' . $value;
			}
			else {
				$paramstring .= '&' . $key . '=' . $value;
			}
		}

		$paramstring = $paramstring . '&key=' . $this->key;
		$Sign = $method($paramstring);
		$Sign = strtoupper($Sign);
		return $Sign;
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

	public function postXmlSSLCurl($url, $xml, $second = 30)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_TIMEOUT, $second);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
		curl_setopt($ch, CURLOPT_SSLCERT, ROOT_PATH . 'storage/app/certs/apiclient_cert.pem');
		curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
		curl_setopt($ch, CURLOPT_SSLKEY, ROOT_PATH . 'storage/app/certs/apiclient_key.pem');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		$data = curl_exec($ch);

		if ($data) {
			curl_close($ch);
			return $data;
		}
		else {
			$error = curl_errno($ch);
			echo 'curl出错，错误码:' . $error . '<br>';
			echo '<a href=\'http://curl.haxx.se/libcurl/c/libcurl-errors.html\'>错误原因查询</a></br>';
			curl_close($ch);
			return false;
		}
	}

	public function PayQueryOrder($arr = array())
	{
		if (empty($arr)) {
			return false;
		}

		$arrdata = $this->getPaySign($arr);
		$xmldata = $this->xml_encode($arrdata);
		$result = $this->http_post(self::PAY_PREFIX . self::PAY_ORDERQUERY, $xmldata);

		if ($result) {
			$json = (array) simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);

			if ($json['return_code'] != 'SUCCESS') {
				$this->errCode = $json['return_code'];
				$this->errMsg = $json['return_msg'];
				return false;
			}
			else if ($json['result_code'] != 'SUCCESS') {
				$this->errCode = $json['err_code'];
				$this->errMsg = $json['err_code_des'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function PayRefund($arr = array())
	{
		if (empty($arr)) {
			return false;
		}

		$arr['refund_fee_type'] = isset($arr['refund_fee_type']) ? $arr['refund_fee_type'] : 'CNY';
		$arrdata = $this->getPaySign($arr);
		$xmldata = $this->xml_encode($arrdata);
		$result = $this->postXmlSSLCurl(self::PAY_PREFIX . self::PAY_REFUND, $xmldata);

		if ($result) {
			$json = (array) simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);

			if ($json['return_code'] != 'SUCCESS') {
				$this->errCode = $json['return_code'];
				$this->errMsg = $json['return_msg'];
				return false;
			}
			else if ($json['result_code'] != 'SUCCESS') {
				$this->errCode = $json['err_code'];
				$this->errMsg = $json['err_code_des'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function PayRefundQuery($arr = array())
	{
		if (empty($arr)) {
			return false;
		}

		$arrdata = $this->getPaySign($arr);
		$xmldata = $this->xml_encode($arrdata);
		$result = $this->http_post(self::PAY_PREFIX . self::PAY_REFUNDQUERY, $xmldata);

		if ($result) {
			$json = (array) simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);

			if ($json['return_code'] != 'SUCCESS') {
				$this->errCode = $json['return_code'];
				$this->errMsg = $json['return_msg'];
				return false;
			}
			else if ($json['result_code'] != 'SUCCESS') {
				$this->errCode = $json['err_code'];
				$this->errMsg = $json['err_code_des'];
				return false;
			}

			return $json;
		}

		return false;
	}

	public function createTags($name)
	{
		if (!$this->get_access_token() && !$this->checkAuth()) {
			return false;
		}

		$data = array(
			'tag' => array('name' => $name)
			);
		$result = $this->http_post(self::API_URL_PREFIX . self::TAGS_CREATE_URL . 'access_token=' . $this->get_access_token(), self::json_encode($data));

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

	public function getTags()
	{
		if (!$this->get_access_token() && !$this->checkAuth()) {
			return false;
		}

		$result = $this->http_get(self::API_URL_PREFIX . self::TAGS_GET_URL . 'access_token=' . $this->get_access_token());

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

	public function updateTags($tagid, $name)
	{
		if (!$this->get_access_token() && !$this->checkAuth()) {
			return false;
		}

		$data = array(
			'tag' => array('id' => $tagid, 'name' => $name)
			);
		$result = $this->http_post(self::API_URL_PREFIX . self::TAGS_UPDATE_URL . 'access_token=' . $this->get_access_token(), self::json_encode($data));

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

	public function deleteTags($tagid)
	{
		if (!$this->get_access_token() && !$this->checkAuth()) {
			return false;
		}

		$data = array(
			'tag' => array('id' => $tagid)
			);
		$result = $this->http_post(self::API_URL_PREFIX . self::TAGS_DELETE_URL . 'access_token=' . $this->get_access_token(), self::json_encode($data));

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

	public function getTagUserlist($tagid, $next_openid = '')
	{
		if (!$this->get_access_token() && !$this->checkAuth()) {
			return false;
		}

		$data = array('tagid' => $tagid, 'next_openid' => $next_openid);
		$result = $this->http_get(self::API_URL_PREFIX . self::USER_TAG_URL . 'access_token=' . $this->get_access_token(), self::json_encode($data));

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

	public function getUserTaglist($openid)
	{
		if (!$this->get_access_token() && !$this->checkAuth()) {
			return false;
		}

		$data = array('openid' => $openid);
		$result = $this->http_post(self::API_URL_PREFIX . self::TAGS_GETIDLIST_URL . 'access_token=' . $this->get_access_token(), self::json_encode($data));

		if ($result) {
			$json = json_decode($result, true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			else if (isset($json['tagid_list'])) {
				return $json['tagid_list'];
			}
		}

		return false;
	}

	public function batchtaggingTagsMembers($tagid, $openid_list)
	{
		if (!$this->get_access_token() && !$this->checkAuth()) {
			return false;
		}

		$data = array('openid_list' => $openid_list, 'tagid' => $tagid);
		$result = $this->http_post(self::API_URL_PREFIX . self::TAGS_MEMBER_BATCHTAGGING_URL . 'access_token=' . $this->get_access_token(), self::json_encode($data));

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

	public function batchuntaggingTagsMembers($tagid, $openid_list)
	{
		if (!$this->get_access_token() && !$this->checkAuth()) {
			return false;
		}

		$data = array('openid_list' => $openid_list, 'tagid' => $tagid);
		$result = $this->http_post(self::API_URL_PREFIX . self::TAGS_MEMBER_BATCHUNTAGGING_URL . 'access_token=' . $this->get_access_token(), self::json_encode($data));

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

	public function log($log)
	{
		$log = (is_array($log) ? var_export($log, true) : $log);
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
