<?php

date_default_timezone_set('PRC');

return array(
    'debug' => 0,
    'mysql' => array(),
	'rewrite' => array(
		'<m>/<c>/<a>' => '<m>/<a>',
		'<c>/<a>' => '<c>/<a>',
		'/' => 'main/index',
	),
);
