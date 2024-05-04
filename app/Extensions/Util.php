<?php

namespace App\Extensions;

class Util
{
	static public function escapeHtml($str)
	{
		$search = array('\'<script[^>]*?>.*?</script>\'si', '\'<iframe[^>]*?>.*?</iframe>\'si');
		$replace = array('', '');
		$str = preg_replace($search, $replace, $str);
		$str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
		return $str;
	}

	static public function getIp()
	{
		if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
		else {
			if (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
				$ip = getenv('HTTP_X_FORWARDED_FOR');
			}
			else {
				if (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
					$ip = getenv('REMOTE_ADDR');
				}
				else {
					if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
						$ip = $_SERVER['REMOTE_ADDR'];
					}
					else {
						$ip = 'unknown';
					}
				}
			}
		}

		return $ip;
	}

	static public function msubstr($str, $start = 0, $length, $charset = 'utf-8', $suffix = true)
	{
		if ($charset != 'utf-8') {
			$str = mb_convert_encoding($str, 'utf8', $charset);
		}

		$osLen = mb_strlen($str);

		if ($osLen <= $length) {
			return $str;
		}

		$string = mb_substr($str, $start, $length, 'utf8');
		$sLen = mb_strlen($string, 'utf8');
		$bLen = strlen($string);
		$sCharCount = ((3 * $sLen) - $bLen) / 2;

		if ($osLen <= $sCharCount + $length) {
			$arr = preg_split('/(?<!^)(?!$)/u', mb_substr($str, $length + 1, $osLen, 'utf8'));
		}
		else {
			$arr = preg_split('/(?<!^)(?!$)/u', mb_substr($str, $length + 1, $sCharCount, 'utf8'));
		}

		foreach ($arr as $value) {
			if ((ord($value) < 128) && (0 < ord($value))) {
				$sCharCount = $sCharCount - 1;
			}
			else {
				$sCharCount = $sCharCount - 2;
			}

			if ($sCharCount <= 0) {
				break;
			}

			$string .= $value;
		}

		return $string;

		if ($suffix) {
			return $string . '…';
		}

		return $string;
	}

	static public function isUtf8($string)
	{
		if (!empty($string)) {
			$ret = json_encode(array('code' => $string));

			if ($ret == '{"code":null}') {
				return false;
			}
		}

		return true;
	}

	static public function auto_charset($fContents, $from = 'gbk', $to = 'utf-8')
	{
		$from = (strtoupper($from) == 'UTF8' ? 'utf-8' : $from);
		$to = (strtoupper($to) == 'UTF8' ? 'utf-8' : $to);
		if ((strtoupper($from) === strtoupper($to)) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
			return $fContents;
		}

		if (is_string($fContents)) {
			if (function_exists('mb_convert_encoding')) {
				return mb_convert_encoding($fContents, $to, $from);
			}
			else if (function_exists('iconv')) {
				return iconv($from, $to, $fContents);
			}
			else {
				return $fContents;
			}
		}
		else if (is_array($fContents)) {
			foreach ($fContents as $key => $val) {
				$_key = self::auto_charset($key, $from, $to);
				$fContents[$_key] = self::auto_charset($val, $from, $to);

				if ($key != $_key) {
					unset($fContents[$key]);
				}
			}

			return $fContents;
		}
		else {
			return $fContents;
		}
	}

	static public function cpEncode($data, $key = '', $expire = 0)
	{
		$string = serialize($data);
		$ckey_length = 4;
		$key = md5($key);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = substr(md5(microtime()), 0 - $ckey_length);
		$cryptkey = $keya . md5($keya . $keyc);
		$key_length = strlen($cryptkey);
		$string = sprintf('%010d', $expire ? $expire + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
		$string_length = strlen($string);
		$result = '';
		$box = range(0, 255);
		$rndkey = array();

		for ($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}

		for ($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}

		for ($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ $box[($box[$a] + $box[$j]) % 256]);
		}

		return $keyc . str_replace('=', '', base64_encode($result));
	}

	static public function cpDecode($string, $key = '')
	{
		$ckey_length = 4;
		$key = md5($key);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = substr($string, 0, $ckey_length);
		$cryptkey = $keya . md5($keya . $keyc);
		$key_length = strlen($cryptkey);
		$string = base64_decode(substr($string, $ckey_length));
		$string_length = strlen($string);
		$result = '';
		$box = range(0, 255);
		$rndkey = array();

		for ($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}

		for ($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}

		for ($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ $box[($box[$a] + $box[$j]) % 256]);
		}

		if (((substr($result, 0, 10) == 0) || (0 < (substr($result, 0, 10) - time()))) && (substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16))) {
			return unserialize(substr($result, 26));
		}
		else {
			return '';
		}
	}

	static public function delDir($dir)
	{
		if (!is_dir($dir)) {
			return false;
		}

		$handle = opendir($dir);

		while (($file = readdir($handle)) !== false) {
			if (($file != '.') && ($file != '..')) {
				is_dir($dir . '/' . $file) ? self::delDir($dir . '/' . $file) : @unlink($dir . '/' . $file);
			}
		}

		if (readdir($handle) == false) {
			closedir($handle);
			@rmdir($dir);
		}
	}
}


?>
