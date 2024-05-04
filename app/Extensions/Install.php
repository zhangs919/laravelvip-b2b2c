<?php

namespace App\Extensions;

class Install
{
	static public function mysql($sql_path, $old_prefix = '', $new_prefix = '', $separator = ";\n")
	{
		$commenter = array('#', '--');

		if (!file_exists($sql_path)) {
			return false;
		}

		$content = file_get_contents($sql_path);
		$content = str_replace(array($old_prefix, "\r"), array($new_prefix, "\n"), $content);
		$segment = explode($separator, trim($content));
		$data = array();

		foreach ($segment as $statement) {
			$sentence = explode("\n", $statement);
			$newStatement = array();

			foreach ($sentence as $subSentence) {
				if ('' != trim($subSentence)) {
					$isComment = false;

					foreach ($commenter as $comer) {
						if (preg_match('/^(' . $comer . ')/is', trim($subSentence))) {
							$isComment = true;
							break;
						}
					}

					if (!$isComment) {
						$newStatement[] = $subSentence;
					}
				}
			}

			$data[] = $newStatement;
		}

		foreach ($data as $statement) {
			$newStmt = '';

			foreach ($statement as $sentence) {
				$newStmt = $newStmt . trim($sentence) . "\n";
			}

			if (!empty($newStmt)) {
				$result[] = $newStmt;
			}
		}

		return $result;
	}
}


?>
