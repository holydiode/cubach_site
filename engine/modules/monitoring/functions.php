<?php

function data_server($ip, $port, $time = 1){
	$info = false;
	$query = new MinecraftQuery();
	try{
		$query->Connect($ip, $port, $time);
		$info = $query->GetInfo();
	}catch(MinecraftQueryException $e){
		return false;
	}
	return $info;
}

function percentage($online, $max){
	if($max == 0) return false;
	return intval(($online/$max)*100);
}

function print_template($file, $key, $value){
	echo str_replace($key, $value, file_get_contents($file, true));
}

function text($per){
	global $title;
	if($per === false) return $title[7];
	if($per == 0) return $title[0];
	if($per >= 0  && $per <= 20) return $title[1];
	if($per >= 21 && $per <= 40) return $title[2];
	if($per >= 41 && $per <= 60) return $title[3];
	if($per >= 61 && $per <= 80) return $title[4];
	if($per >= 81 && $per <= 99) return $title[5];
	if($per == 100) return $title[6];
}