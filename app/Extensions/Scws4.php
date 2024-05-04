<?php

namespace App\Extensions;

class Scws4
{
	private $pscws;
	private $charset = 'utf-8';
	private $ignore = true;
	private $dictPath = false;
	private $rulePath = false;
	private $duality = true;

	public function __construct()
	{
		$pscesPath = dirname(ROOT_PATH) . '/includes/pscws4/';

		if (!file_exists($pscesPath . 'pscws4.php')) {
			throw_exception('pscws4 类文件不存在');
		}

		require_once $pscesPath . 'pscws4.php';
		$this->dictPath = $pscesPath . 'etc/dict.utf8.xdb';
		$this->rulePath = $pscesPath . 'etc/rules.utf8.ini';
		$this->pscws = new \PSCWS4($this->charset);
	}

	public function segmentate($text, $return_array = false, $top = 5, $sep = ',')
	{
		$this->pscws->set_charset($this->charset);
		$this->pscws->set_dict($this->dictPath);
		$this->pscws->set_rule($this->rulePath);
		$this->pscws->set_ignore($this->ignore);
		$this->pscws->set_multi(0);
		$this->pscws->set_duality($this->duality);
		$this->pscws->send_text($text);
		$result = array();

		while ($ret = $this->pscws->get_result()) {
			foreach ($ret as $v) {
				if (($v['len'] == 1) && ($v['word'] == "\r")) {
					continue;
				}

				if (($v['len'] == 1) && ($v['word'] == "\n")) {
					$result[] = '<br/>';
				}
				else {
					$result[] = $v['word'];
				}
			}
		}

		if (true === $return_array) {
			$result = implode(',', $result);
		}

		return $result;
	}
}


?>
