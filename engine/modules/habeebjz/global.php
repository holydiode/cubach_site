<?php
	if(!defined('DATALIFEENGINE')) die("Hacking attempt!");
	if($member_id['name']) {
		$random = rand(1000000, 9999999);
		if(!$member_id['secure_rand']) $db->query("UPDATE dle_users SET secure_rand='$random' WHERE name='{$member_id['name']}'");
		$secure = md5($member_id['secure_hash'].$member_id['secure_rand']);
		if(!$member_id['secure_hash']) $db->query("UPDATE dle_users SET secure_hash='$secure' WHERE name='{$member_id['name']}'");
		
		echo "<script>var memberHash = '$secure'; var getGlobalID = '{$member_id['user_id']}';</script>";
	}
?>