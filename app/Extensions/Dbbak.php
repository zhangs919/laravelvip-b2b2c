<?php

namespace App\Extensions;

class Dbbak
{
	/**
     * 数据库主机
     * @var string
     */
	public $dbhost;
	/**
     * 数据用户名
     * @var string
     */
	public $dbuser;
	/**
     * 数据库密码
     * @var string
     */
	public $dbpw;
	/**
     * 数据库名称
     * @var string
     */
	public $dbname;
	/**
     * 备份目录
     * @var string
     */
	public $dataDir;
	/**
     * 临时存放SQL
     * @var string
     */
	protected $transfer = '';

	public function __construct($dbhost, $dbuser, $dbpw, $dbname, $charset = 'utf8', $dir = 'data/dbbak/')
	{
		$this->connect($dbhost, $dbuser, $dbpw, $dbname, $charset);
		$this->dataDir = $dir;
	}

	public function connect($dbhost, $dbuser, $dbpw, $dbname, $charset = 'utf8')
	{
		$this->dbhost = $dbhost;
		$this->dbuser = $dbuser;
		$this->dbpw = $dbpw;
		$this->dbname = $dbname;

		if (!($conn = mysql_connect($dbhost, $dbuser, $dbpw))) {
			$this->error('无法连接数据库服务器');
			return false;
		}

		mysql_select_db($this->dbname) || $this->error('选择数据库失败');
		mysql_query('set names ' . $charset);
		return true;
	}

	public function getTables($database = '')
	{
		$database = (empty($database) ? $this->dbname : $database);
		($result = mysql_query('SHOW TABLES FROM `' . $database . '`')) || exit(mysql_error());

		while ($tmpArry = mysql_fetch_row($result)) {
			$dbArry[] = $tmpArry[0];
		}

		return $dbArry;
	}

	public function exportSql($table = '', $subsection = 0)
	{
		$table = (empty($table) ? $this->getTables() : $table);

		if (!$this->_checkDir($this->dataDir)) {
			$this->error('您没有权限操作目录,备份失败');
			return false;
		}

		if ($subsection == 0) {
			if (!is_array($table)) {
				$this->_setSql($table, 0, $this->transfer);
			}
			else {
				for ($i = 0; $i < count($table); $i++) {
					$this->_setSql($table[$i], 0, $this->transfer);
				}
			}

			$fileName = $this->dataDir . date('Ymd', time()) . '_all.sql.php';

			if (!$this->_writeSql($fileName, $this->transfer)) {
				return false;
			}
		}
		else {
			if (!is_array($table)) {
				$sqlArry = $this->_setSql($table, $subsection, $this->transfer);
				$sqlArry[] = $this->transfer;
			}
			else {
				$sqlArry = array();

				for ($i = 0; $i < count($table); $i++) {
					$tmpArry = $this->_setSql($table[$i], $subsection, $this->transfer);
					$sqlArry = array_merge($sqlArry, $tmpArry);
				}

				$sqlArry[] = $this->transfer;
			}

			for ($i = 0; $i < count($sqlArry); $i++) {
				$fileName = $this->dataDir . date('Ymd', time()) . '_part' . $i . '.sql.php';

				if (!$this->_writeSql($fileName, $sqlArry[$i])) {
					return false;
				}
			}
		}

		return true;
	}

	public function importSql($dir = '')
	{
		if (is_file($dir)) {
			return $this->_importSqlFile($dir);
		}

		$dir = (empty($dir) ? $this->dataDir : $dir);

		if ($link = opendir($dir)) {
			$fileArry = scandir($dir);
			$pattern = '/_part[0-9]+.sql.php$|_all.sql.php$/';
			$num = count($fileArry);

			for ($i = 0; $i < $num; $i++) {
				if (preg_match($pattern, $fileArry[$i])) {
					if (false == $this->_importSqlFile($dir . $fileArry[$i])) {
						return false;
					}
				}
			}

			return true;
		}
	}

	protected function _importSqlFile($filename = '')
	{
		$sqls = file_get_contents($filename);
		$sqls = substr($sqls, 13);
		$sqls = explode("\n", $sqls);

		if (empty($sqls)) {
			return false;
		}

		foreach ($sqls as $sql) {
			if (empty($sql)) {
				continue;
			}

			if (!mysql_query(trim($sql))) {
				$this->error('恢复失败：' . mysql_error());
				return false;
			}
		}

		return true;
	}

	protected function _setSql($table, $subsection = 0, &$tableDom = '')
	{
		$tableDom .= 'DROP TABLE IF EXISTS ' . $table . "\n";
		$createtable = mysql_query('SHOW CREATE TABLE ' . $table);
		$create = mysql_fetch_row($createtable);
		$create[1] = str_replace("\n", '', $create[1]);
		$create[1] = str_replace('	', '', $create[1]);
		$tableDom .= $create[1] . ";\n";
		$rows = mysql_query('SELECT * FROM ' . $table);
		$numfields = mysql_num_fields($rows);
		$numrows = mysql_num_rows($rows);
		$n = 1;
		$sqlArry = array();

		while ($row = mysql_fetch_row($rows)) {
			$comma = '';
			$tableDom .= 'INSERT INTO ' . $table . ' VALUES(';

			for ($i = 0; $i < $numfields; $i++) {
				$tableDom .= $comma . '\'' . mysql_escape_string($row[$i]) . '\'';
				$comma = ',';
			}

			$tableDom .= ")\n";
			if (($subsection != 0) && (($subsection * 1000) <= strlen($this->transfer))) {
				$sqlArry[$n] = $tableDom;
				$tableDom = '';
				$n++;
			}
		}

		return $sqlArry;
	}

	protected function _checkDir($dir)
	{
		if (!is_dir($dir)) {
			@mkdir($dir, 511);
		}

		if (is_dir($dir)) {
			if ($link = opendir($dir)) {
				$fileArry = scandir($dir);

				for ($i = 0; $i < count($fileArry); $i++) {
					if (($fileArry[$i] != '.') || ($fileArry[$i] != '..')) {
						@unlink($dir . $fileArry[$i]);
					}
				}
			}
		}

		return true;
	}

	protected function _writeSql($fileName, $str)
	{
		$re = true;

		if (!($fp = @fopen($fileName, 'w+'))) {
			$re = false;
			$this->error('在打开文件时遇到错误，备份失败!');
		}

		if (!@fwrite($fp, '<?php exit;?>' . $str)) {
			$re = false;
			$this->error('在写入信息时遇到错误，备份失败!');
		}

		if (!@fclose($fp)) {
			$re = false;
			$this->error('在关闭文件 时遇到错误，备份失败!');
		}

		return $re;
	}

	public function error($str)
	{
		throw new \Exception($str, 500);
	}
}


?>
