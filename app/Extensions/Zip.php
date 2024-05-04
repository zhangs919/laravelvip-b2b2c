<?php

namespace App\Extensions;

class Zip
{
	protected $datasec = array();
	protected $ctrl_dir = array();
	protected $eof_ctrl_dir = "PK\x05\x06\x00\x00\x00\x00";
	protected $old_offset = 0;
	protected $total_files = 0;
	protected $total_folders = 0;

	public function compress($zip_filename = 'dsc.zip', $dir = './', $path_replace = '')
	{
		if (function_exists('gzcompress')) {
			$filelist = $this->GetFileList($dir);

			if (0 < count($filelist)) {
				foreach ($filelist as $filename) {
					if (is_file($filename)) {
						$fd = fopen($filename, 'r');
						$content = fread($fd, filesize($filename));
						fclose($fd);
						$this->addFile($content, str_replace($path_replace, '', $filename));
					}
				}

				$out = $this->file();
				$fp = fopen($zip_filename, 'w');
				fwrite($fp, $out, strlen($out));
				fclose($fp);
				return true;
			}
		}

		return false;
	}

	public function decompress($zip_filename = 'cp.zip', $dir = './')
	{
		$index = array(-1);
		$ok = 0;
		$zip_fp = @fopen($zip_filename, 'rb');

		if (!$zip_fp) {
			return false;
		}

		$cdir = $this->ReadCentralDir($zip_fp, $zip_filename);
		$pos_entry = $cdir['offset'];

		if (!is_array($index)) {
			$index = array($index);
		}

		for ($i = 0; $index[$i]; $i++) {
			if ((intval($index[$i]) != $index[$i]) || ($cdir['entries'] < $index[$i])) {
				return false;
			}
		}

		for ($i = 0; $i < $cdir['entries']; $i++) {
			@fseek($zip_fp, $pos_entry);
			$header = $this->ReadCentralFileHeaders($zip_fp);
			$header['index'] = $i;
			$pos_entry = ftell($zip_fp);
			@rewind($zip_fp);
			fseek($zip_fp, $header['offset']);
			if (in_array('-1', $index) || in_array($i, $index)) {
				$stat[$header['filename']] = $this->ExtractFile($header, $dir, $zip_fp);
			}
		}

		fclose($zip_fp);
		return $stat;
	}

	private function GetFileList($dir)
	{
		$file = array();

		if (file_exists($dir)) {
			if (substr($dir, -1) != '/') {
				$dir .= '/';
			}

			$dh = opendir($dir);

			while ($files = readdir($dh)) {
				if (($files != '.') && ($files != '..')) {
					if (is_dir($dir . $files)) {
						$file = array_merge($file, $this->GetFileList($dir . $files));
					}
					else {
						$file[] = $dir . $files;
					}
				}
			}

			closedir($dh);
		}

		$file[] = '';
		return $file;
	}

	private function unix2DosTime($unixtime = 0)
	{
		$timearray = ($unixtime == 0 ? getdate() : getdate($unixtime));

		if ($timearray['year'] < 1980) {
			$timearray['year'] = 1980;
			$timearray['mon'] = 1;
			$timearray['mday'] = 1;
			$timearray['hours'] = 0;
			$timearray['minutes'] = 0;
			$timearray['seconds'] = 0;
		}

		return (($timearray['year'] - 1980) << 25) | ($timearray['mon'] << 21) | ($timearray['mday'] << 16) | ($timearray['hours'] << 11) | ($timearray['minutes'] << 5) | ($timearray['seconds'] >> 1);
	}

	private function addFile($data, $name, $time = 0)
	{
		$name = str_replace('\\', '/', $name);
		$dtime = dechex($this->unix2DosTime($time));
		$hexdtime = '\\x' . $dtime[6] . $dtime[7] . '\\x' . $dtime[4] . $dtime[5] . '\\x' . $dtime[2] . $dtime[3] . '\\x' . $dtime[0] . $dtime[1];
		eval ('$hexdtime = "' . $hexdtime . '";');
		$fr = "PK\x03\x04";
		$fr .= "\x14\x00";
		$fr .= "\x00\x00";
		$fr .= "\x08\x00";
		$fr .= $hexdtime;
		$unc_len = strlen($data);
		$crc = crc32($data);
		$zdata = gzcompress($data);
		$c_len = strlen($zdata);
		$zdata = substr(substr($zdata, 0, strlen($zdata) - 4), 2);
		$fr .= pack('V', $crc);
		$fr .= pack('V', $c_len);
		$fr .= pack('V', $unc_len);
		$fr .= pack('v', strlen($name));
		$fr .= pack('v', 0);
		$fr .= $name;
		$fr .= $zdata;
		$fr .= pack('V', $crc);
		$fr .= pack('V', $c_len);
		$fr .= pack('V', $unc_len);
		$this->datasec[] = $fr;
		$new_offset = strlen(implode('', $this->datasec));
		$cdrec = "PK\x01\x02";
		$cdrec .= "\x00\x00";
		$cdrec .= "\x14\x00";
		$cdrec .= "\x00\x00";
		$cdrec .= "\x08\x00";
		$cdrec .= $hexdtime;
		$cdrec .= pack('V', $crc);
		$cdrec .= pack('V', $c_len);
		$cdrec .= pack('V', $unc_len);
		$cdrec .= pack('v', strlen($name));
		$cdrec .= pack('v', 0);
		$cdrec .= pack('v', 0);
		$cdrec .= pack('v', 0);
		$cdrec .= pack('v', 0);
		$cdrec .= pack('V', 32);
		$cdrec .= pack('V', $this->old_offset);
		$this->old_offset = $new_offset;
		$cdrec .= $name;
		$this->ctrl_dir[] = $cdrec;
	}

	private function file()
	{
		$data = implode('', $this->datasec);
		$ctrldir = implode('', $this->ctrl_dir);
		return $data . $ctrldir . $this->eof_ctrl_dir . pack('v', sizeof($this->ctrl_dir)) . pack('v', sizeof($this->ctrl_dir)) . pack('V', strlen($ctrldir)) . pack('V', strlen($data)) . "\x00\x00";
	}

	protected function ReadFileHeader($zip)
	{
		$binary_data = fread($zip, 30);
		$data = unpack('vchk/vid/vversion/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len', $binary_data);
		$header['filename'] = fread($zip, $data['filename_len']);

		if ($data['extra_len'] != 0) {
			$header['extra'] = fread($zip, $data['extra_len']);
		}
		else {
			$header['extra'] = '';
		}

		$header['compression'] = $data['compression'];
		$header['size'] = $data['size'];
		$header['compressed_size'] = $data['compressed_size'];
		$header['crc'] = $data['crc'];
		$header['flag'] = $data['flag'];
		$header['mdate'] = $data['mdate'];
		$header['mtime'] = $data['mtime'];
		if ($header['mdate'] && $header['mtime']) {
			$hour = ($header['mtime'] & 63488) >> 11;
			$minute = ($header['mtime'] & 2016) >> 5;
			$seconde = ($header['mtime'] & 31) * 2;
			$year = (($header['mdate'] & 65024) >> 9) + 1980;
			$month = ($header['mdate'] & 480) >> 5;
			$day = $header['mdate'] & 31;
			$header['mtime'] = mktime($hour, $minute, $seconde, $month, $day, $year);
		}
		else {
			$header['mtime'] = time();
		}

		$header['stored_filename'] = $header['filename'];
		$header['status'] = 'ok';
		return $header;
	}

	protected function ReadCentralFileHeaders($zip)
	{
		$binary_data = fread($zip, 46);
		$header = unpack('vchkid/vid/vversion/vversion_extracted/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len/vcomment_len/vdisk/vinternal/Vexternal/Voffset', $binary_data);

		if ($header['filename_len'] != 0) {
			$header['filename'] = fread($zip, $header['filename_len']);
		}
		else {
			$header['filename'] = '';
		}

		if ($header['extra_len'] != 0) {
			$header['extra'] = fread($zip, $header['extra_len']);
		}
		else {
			$header['extra'] = '';
		}

		if ($header['comment_len'] != 0) {
			$header['comment'] = fread($zip, $header['comment_len']);
		}
		else {
			$header['comment'] = '';
		}

		if ($header['mdate'] && $header['mtime']) {
			$hour = ($header['mtime'] & 63488) >> 11;
			$minute = ($header['mtime'] & 2016) >> 5;
			$seconde = ($header['mtime'] & 31) * 2;
			$year = (($header['mdate'] & 65024) >> 9) + 1980;
			$month = ($header['mdate'] & 480) >> 5;
			$day = $header['mdate'] & 31;
			$header['mtime'] = mktime($hour, $minute, $seconde, $month, $day, $year);
		}
		else {
			$header['mtime'] = time();
		}

		$header['stored_filename'] = $header['filename'];
		$header['status'] = 'ok';

		if (substr($header['filename'], -1) == '/') {
			$header['external'] = 1107230736;
		}

		return $header;
	}

	protected function ReadCentralDir($zip, $zip_name)
	{
		$size = filesize($zip_name);

		if ($size < 277) {
			$maximum_size = $size;
		}
		else {
			$maximum_size = 277;
		}

		@fseek($zip, $size - $maximum_size);
		$pos = ftell($zip);
		$bytes = 0;

		while ($pos < $size) {
			$byte = @fread($zip, 1);
			$bytes = ($bytes << 8) | ord($byte);
			if (($bytes == 1347093766) || ($bytes == 3.3462893547289979E+18)) {
				$pos++;
				break;
			}

			$pos++;
		}

		$fdata = fread($zip, 18);
		$data = @unpack('vdisk/vdisk_start/vdisk_entries/ventries/Vsize/Voffset/vcomment_size', $fdata);

		if ($data['comment_size'] != 0) {
			$centd['comment'] = fread($zip, $data['comment_size']);
		}
		else {
			$centd['comment'] = '';
		}

		$centd['entries'] = $data['entries'];
		$centd['disk_entries'] = $data['disk_entries'];
		$centd['offset'] = $data['offset'];
		$centd['disk_start'] = $data['disk_start'];
		$centd['size'] = $data['size'];
		$centd['disk'] = $data['disk'];
		return $centd;
	}

	protected function ExtractFile($header, $to, $zip)
	{
		$header = $this->readfileheader($zip);

		if (substr($to, -1) != '/') {
			$to .= '/';
		}

		if ($to == './') {
			$to = '';
		}

		$pth = explode('/', $to . $header['filename']);
		$mydir = '';

		for ($i = 0; $i < (count($pth) - 1); $i++) {
			if (!$pth[$i]) {
				continue;
			}

			$mydir .= $pth[$i] . '/';
			if ((!is_dir($mydir) && @mkdir($mydir, 511)) || ((($mydir == ($to . $header['filename'])) || (($mydir == $to) && ($this->total_folders == 0))) && is_dir($mydir))) {
				@chmod($mydir, 511);
				$this->total_folders++;
			}
		}

		if (strrchr($header['filename'], '/') == '/') {
			return NULL;
		}

		if (!($header['external'] == 1107230736) && !($header['external'] == 16)) {
			if ($header['compression'] == 0) {
				$fp = @fopen($to . $header['filename'], 'wb');

				if (!$fp) {
					return -1;
				}

				$size = $header['compressed_size'];

				while ($size != 0) {
					$read_size = ($size < 2048 ? $size : 2048);
					$buffer = fread($zip, $read_size);
					$binary_data = pack('a' . $read_size, $buffer);
					@fwrite($fp, $binary_data, $read_size);
					$size -= $read_size;
				}

				fclose($fp);
				touch($to . $header['filename'], $header['mtime']);
			}
			else {
				$fp = @fopen($to . $header['filename'] . '.gz', 'wb');

				if (!$fp) {
					return -1;
				}

				$binary_data = pack('va1a1Va1a1', 35615, Chr($header['compression']), Chr(0), time(), Chr(0), Chr(3));
				fwrite($fp, $binary_data, 10);
				$size = $header['compressed_size'];

				while ($size != 0) {
					$read_size = ($size < 1024 ? $size : 1024);
					$buffer = fread($zip, $read_size);
					$binary_data = pack('a' . $read_size, $buffer);
					@fwrite($fp, $binary_data, $read_size);
					$size -= $read_size;
				}

				$binary_data = pack('VV', $header['crc'], $header['size']);
				fwrite($fp, $binary_data, 8);
				fclose($fp);
				($gzp = @gzopen($to . $header['filename'] . '.gz', 'rb')) || exit('Cette archive est compress閑');

				if (!$gzp) {
					return -2;
				}

				$fp = @fopen($to . $header['filename'], 'wb');

				if (!$fp) {
					return -1;
				}

				$size = $header['size'];

				while ($size != 0) {
					$read_size = ($size < 2048 ? $size : 2048);
					$buffer = gzread($gzp, $read_size);
					$binary_data = pack('a' . $read_size, $buffer);
					@fwrite($fp, $binary_data, $read_size);
					$size -= $read_size;
				}

				fclose($fp);
				gzclose($gzp);
				touch($to . $header['filename'], $header['mtime']);
				@unlink($to . $header['filename'] . '.gz');
			}
		}

		$this->total_files++;
		return true;
	}
}


?>
