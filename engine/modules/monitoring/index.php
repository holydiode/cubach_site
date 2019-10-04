<?php

header("Content-type: text/html; charset=utf-8");

ini_set('display_errors', 'On');
ini_set('html_errors', 'Off');

define('ROOT_PATH', dirname(__FILE__));

require_once ROOT_PATH . '/configs.php';
require_once ROOT_PATH . '/functions.php';
require_once ROOT_PATH . '/MinecraftQuery.class.php';

if ((file_exists($cache_file)) && ((time() - $cache_time) < filemtime($cache_file))) {

	print_template($cache_file, '', '');
	exit;

}

ob_start();
(int)$total_online=0;
for($i = 0; $i < count($servers); $i++){

	/* var */
	$data 	= 	data_server($servers[$i]['ip'], $servers[$i]['port']);
	$per 	= 	percentage($data['Players'], $data['MaxPlayers']);
	$text 	= 	null;
	
	/* functions */
	$text = text($per);
	
	if($data){
		$key = array('{online}', '{max}', '{per}', '{text}', '{title}', '{subtitle}');
		$val = array($data['Players'], $data['MaxPlayers'], $per, $text, $servers[$i]['title'], $servers[$i]['subtitle']);
		print_template('templates/online.html', $key, $val);
	}else{
		$key = array('{title}', '{subtitle}', '{text}');
		$val = array($servers[$i]['title'], $servers[$i]['subtitle'], $text);
		print_template('templates/offline.html', $key, $val);
	}
	
	$total_online += $data['Players'];
}

$ini = parse_ini_file($ini_file);

$key = array('{total_online}', '{max_online}');
$val = array($total_online, $ini['max_online']);
print_template('templates/footer.html', $key, $val);

if($total_online > $ini['max_online']){
	$ini_fp = fopen($ini_file, 'r+');
	fwrite($ini_fp, str_replace($ini['max_online'], $total_online, file_get_contents($ini_file)));
	fclose($ini_fp);
}

$buffer = ob_get_contents();
ob_end_flush();

$fp = fopen($cache_file, 'w');
fwrite($fp, $buffer);
fclose($fp);