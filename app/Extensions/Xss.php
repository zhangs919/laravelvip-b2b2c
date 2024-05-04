<?php

namespace App\Extensions;

class Xss
{
	/**
     * 允许的标签
     * 先剔除不允许的,再过滤允许的
     *
     * 以 a 标签为例:
     *   1. 允许a的所有 ['a'] => ''
     *   2. 不允许a的 style ['a'] => array('disallowed' => array('style'))
     *   3. 只允许a的 href rel ['a'] = array('allowed' => array('href', 'rel'))
     *
     */
	protected $allowedTags = array();
	/**
     * 允许的style属性
     */
	protected $allowedStyleProperties = array();
	/**
     * 允许的style域名
     */
	protected $allowedStyleDomain = array();

	public function filter($string, $allowedTags = array(), $allowedStyleProperties = array())
	{
		if (!$this->isUTF8($string)) {
			return '';
		}

		$this->setAllowedTags($allowedTags);
		$this->setAllowedStyleProperties($allowedStyleProperties);
		$string = str_replace(chr(0), '', $string);
		$string = preg_replace('%&\\s*\\{[^}]*(\\}\\s*;?|$)%', '', $string);
		$string = str_replace('&', '&amp;', $string);
		$string = preg_replace('/&amp;#([0-9]+;)/', '&#\\1', $string);
		$string = preg_replace('/&amp;#[Xx]0*((?:[0-9A-Fa-f]{2})+;)/', '&#x\\1', $string);
		$string = preg_replace('/&amp;([A-Za-z][A-Za-z0-9]*;)/', '&\\1', $string);
		return preg_replace_callback("%\r\n          (\r\n          <(?=[^a-zA-Z!/])  # a lone <\r\n          |                 # or\r\n          <!--.*?-->        # a comment\r\n          |                 # or\r\n          <[^>]*(>|\$)       # a string that starts with a <, up until the > or the end of the string\r\n          |                 # or\r\n          >                 # just a >\r\n          )%x", array($this, 'split'), $string);
	}

	public function split($matches)
	{
		$string = $matches[1];

		if (substr($string, 0, 1) != '<') {
			return '&gt;';
		}
		else if (strlen($string) == 1) {
			return '&lt;';
		}

		if (!preg_match('%^<\\s*(/\\s*)?([a-zA-Z0-9]+)([^>]*)>?|(<!--.*?-->)$%', $string, $matches)) {
			return '';
		}

		$slash = trim($matches[1]);
		$elem = &$matches[2];
		$attrlist = &$matches[3];
		$comment = &$matches[4];
		$elem = strtolower($elem);

		if ($comment) {
			$elem = '!--';
		}

		if (!isset($this->allowedTags[$elem])) {
			return '';
		}

		if ($comment) {
			return $comment;
		}

		if ($slash != '') {
			return '</' . $elem . '>';
		}

		$attrlist = preg_replace('%(\\s?)/\\s*$%', '\\1', $attrlist, -1, $count);
		$xhtml_slash = ($count ? ' /' : '');

		if (($attr2 = $this->attributes($attrlist, $elem)) === false) {
			return '';
		}

		$attr2 = implode(' ', $attr2);
		$attr2 = preg_replace('/[<>]/', '', $attr2);
		$attr2 = (strlen($attr2) ? ' ' . $attr2 : '');
		return '<' . $elem . $attr2 . $xhtml_slash . '>';
	}

	public function attributes($attributes, $elem = '')
	{
		$return = array();
		$mode = 0;
		$attrname = '';
		$skip = false;

		while (strlen($attributes) != 0) {
			$working = 0;

			switch ($mode) {
			case 0:
				if (preg_match('/^([-a-zA-Z]+)/', $attributes, $match)) {
					$working = 1;
					$mode = 1;
					$attrname = strtolower($match[1]);
					$skip = substr($attrname, 0, 2) == 'on';
					$attributes = preg_replace('/^[-a-zA-Z]+/', '', $attributes);
				}

				break;

			case 1:
				if (preg_match('/^\\s*=\\s*/', $attributes)) {
					$working = 1;
					$mode = 2;
					$attributes = preg_replace('/^\\s*=\\s*/', '', $attributes);
					break;
				}

				if (preg_match('/^\\s+/', $attributes)) {
					$working = 1;
					$mode = 0;

					if (!$skip) {
						$return[$attrname] = array();
					}

					$attributes = preg_replace('/^\\s+/', '', $attributes);
				}

				break;

			case 2:
				if (preg_match('/^"([^"]*)"(\\s+|$)/', $attributes, $match)) {
					$working = 1;
					$mode = 0;

					if (!$skip) {
						$return[$attrname] = array('value' => $match[1], 'delimiter' => '"');
					}

					$attributes = preg_replace('/^"[^"]*"(\\s+|$)/', '', $attributes);
					break;
				}

				if (preg_match('/^\'([^\']*)\'(\\s+|$)/', $attributes, $match)) {
					$working = 1;
					$mode = 0;

					if (!$skip) {
						$return[$attrname] = array('value' => $match[1], 'delimiter' => '\'');
					}

					$attributes = preg_replace('/^\'[^\']*\'(\\s+|$)/', '', $attributes);
					break;
				}

				if (preg_match('%^([^\\s"\']+)(\\s+|$)%', $attributes, $match)) {
					$working = 1;
					$mode = 0;

					if (!$skip) {
						$return[$attrname] = array('value' => $match[1], 'delimiter' => '"');
					}

					$attributes = preg_replace('%^[^\\s"\']+(\\s+|$)%', '', $attributes);
				}

				break;
			}

			if ($working == 0) {
				$attributes = preg_replace("/\r\n                  ^\r\n                  (\r\n                  \"[^\"]*(\"|\$)     # - a string that starts with a double quote, up until the next double quote or the end of the string\r\n                  |               # or\r\n                  '[^']*('|\$)| # - a string that starts with a quote, up until the next quote or the end of the string\r\n                  |               # or\r\n                  \\S              # - a non-whitespace character\r\n                  )*              # any number of the above three\r\n                  \\s*             # any number of whitespaces\r\n                  /x", '', $attributes);
				$mode = 0;
			}
		}

		if (($mode == 1) && !$skip) {
			$return[$attrname] = array();
		}

		$tag = (isset($this->allowedTags[$elem]) ? $this->allowedTags[$elem] : array());

		foreach ($return as $name => $info) {
			if (!isset($info['value'])) {
				continue;
			}

			if (isset($tag['disallowed']) && in_array($name, $tag['disallowed'])) {
				unset($return[$name]);
				continue;
			}

			if (isset($tag['allowed']) && !in_array($name, $tag['allowed'])) {
				unset($return[$name]);
				continue;
			}

			if ($name == 'style') {
				$sanitized_properties = array();
				$properties = array_filter(array_map('trim', explode(';', $this->decodeEntities($info['value']))));

				foreach ($properties as $property) {
					if (!preg_match('#^([a-zA-Z][-a-zA-Z]*)\\s*:\\s*(.*)$#', $property, $property_matches)) {
						continue;
					}

					$property_name = strtolower($property_matches[1]);
					$property_value = &$property_matches[2];

					if (!isset($this->allowedStyleProperties[$property_name])) {
						continue;
					}

					if (strpos($property_value, 'url(') !== false) {
						if (!preg_match('`url\\(\\s*(([\'"]?)(?:[^)]|(?<=\\\\)\\))+[\'"]?)\\s*\\)`', $property_value, $url) || empty($url[1])) {
							continue;
						}

						if (!empty($url[2])) {
							if (substr($url[1], -1) != $url[2]) {
								continue;
							}

							$url[1] = substr($url[1], 1, -1);
						}

						$url = preg_replace('`\\\\([(),\'"\\s])`', '\\1', $url[1]);

						if ($this->filterBadProtocol($url) != $url) {
							continue;
						}

						if (!preg_match('`^/[^/]+`', $url)) {
							$match = false;

							foreach ($this->allowedStyleDomain as $reg) {
								if (preg_match($reg, $url)) {
									$match = true;
									break;
								}
							}

							if (!$match) {
								continue;
							}
						}
					}

					$sanitized_properties[] = $property_name . ':' . $this->checkPlain($property_value);
				}

				if (empty($sanitized_properties)) {
					unset($return[$name]);
					continue;
				}

				$info['value'] = implode('; ', $sanitized_properties);
			}
			else {
				$info['value'] = $this->filterBadProtocol($info['value']);
			}

			$return[$name] = $name . '=' . $info['delimiter'] . $info['value'] . $info['delimiter'];
		}

		return $return;
	}

	public function setAllowedTags($tags)
	{
		foreach ($tags as $k => $tag) {
			if (is_int($k) && is_string($tag)) {
				unset($tags[$k]);
				$tags[$tag] = array();
			}
		}

		$this->allowedTags = $tags;
	}

	public function setAllowedStyleProperties($properties)
	{
		$this->allowedStyleProperties = array_flip($properties);
	}

	public function setAllowedStyleDomain($domain)
	{
		if (is_string($domain)) {
			$this->allowedStyleDomain[] = '`^(https?://|//)' . $domain . '`i';
		}
		else if (is_array($domain)) {
			foreach ($domain as $d) {
				$this->allowedStyleDomain[] = '`^(https?://|//)' . $d . '`i';
			}
		}

		return $this;
	}

	public function isUTF8($text)
	{
		if (strlen($text) == 0) {
			return true;
		}

		return preg_match('/^./us', $text) == 1;
	}

	public function filterBadProtocol($string)
	{
		$string = static::decodeEntities($string);
		return static::checkPlain($this->stripDangerousProtocols($string));
	}

	public function stripDangerousProtocols($uri)
	{
		$allowed_protocols = array('http' => true, 'https' => true);

		do {
			$before = $uri;
			$colonpos = strpos($uri, ':');

			if (0 < $colonpos) {
				$protocol = substr($uri, 0, $colonpos);

				if (preg_match('![/?#]!', $protocol)) {
					break;
				}

				if (!isset($allowed_protocols[strtolower($protocol)])) {
					$uri = substr($uri, $colonpos + 1);
				}
			}
		} while ($before != $uri);

		return $uri;
	}

	public function checkPlain($text)
	{
		return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
	}

	public function decodeEntities($text)
	{
		return html_entity_decode($text, ENT_QUOTES, 'UTF-8');
	}
}


?>
