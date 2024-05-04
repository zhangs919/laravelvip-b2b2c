<?php

namespace App\Extensions;

class Encrypter
{
	private $key;
	private $iv;

	public function __construct($key)
	{
		$this->key = hash('MD5', $key, true);
		$this->iv = chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0) . chr(0);
	}

	public function encrypt($str)
	{
		$size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);
		$str = $this->pkcs5Pad($str, $size);
		$data = mcrypt_cbc(MCRYPT_DES, $this->key, $str, MCRYPT_ENCRYPT, $this->iv);
		return base64_encode($data);
	}

	public function decrypt($value)
	{
		$str = base64_decode($value);
		$str = mcrypt_cbc(MCRYPT_DES, $this->key, $str, MCRYPT_DECRYPT, $this->iv);
		return $this->pkcs5Unpad($str);
	}

	protected function pkcs5Pad($text, $blocksize)
	{
		$pad = $blocksize - (strlen($text) % $blocksize);
		return $text . str_repeat(chr($pad), $pad);
	}

	protected function pkcs5Unpad($text)
	{
		$pad = ord($text[strlen($text) - 1]);

		if (strlen($text) < $pad) {
			return false;
		}

		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
			return false;
		}

		return substr($text, 0, -1 * $pad);
	}

	public function getId()
	{
		if (function_exists('uuid_create') && !function_exists('uuid_make')) {
			$id = uuid_create(UUID_TYPE_DEFAULT);
		}
		else if (function_exists('com_create_guid')) {
			$id = strtolower(trim(com_create_guid(), '{}'));
		}
		else {
			$id = $this->createId();
		}

		return $id;
	}

	protected function createId()
	{
		$salt = substr(hash('sha256', microtime(true) . mt_rand()), 0, 64);
		$hex = substr(hash('sha256', $salt), 0, 32);
		$time_low = substr($hex, 0, 8);
		$time_mid = substr($hex, 8, 4);
		$time_hi_and_version = base_convert(substr($hex, 12, 4), 16, 10);
		$time_hi_and_version &= 4095;
		$time_hi_and_version |= 4 << 12;
		$clock_seq_hi_and_reserved = base_convert(substr($hex, 16, 4), 16, 10);
		$clock_seq_hi_and_reserved &= 63;
		$clock_seq_hi_and_reserved |= 128;
		$clock_seq_low = substr($hex, 20, 2);
		$nodes = substr($hex, 20);
		$uuid = sprintf('%s-%s-%04x-%02x%02x-%s', $time_low, $time_mid, $time_hi_and_version, $clock_seq_hi_and_reserved, $clock_seq_low, $nodes);
		return $uuid;
	}

	public function isId($uuid)
	{
		return preg_match('/^[0-9a-f]{8}-([0-9a-f]{4}-){3}[0-9a-f]{12}$/', $uuid);
	}
}


?>
