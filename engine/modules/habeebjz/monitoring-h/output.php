<?php
	include('parser.php');
	$monList = array(
		array('ip'=>'srv.firescraft.ru' , 'port' => '1111' , 'name' => "Techno"),
		array('ip'=>'srv.firescraft.ru' , 'port' => '2222' , 'name' => "MagicRPG"),
		array('ip'=>'srv.firescraft.ru' , 'port' => '3333' , 'name' => "TechnoMagic"),
	);
	$i = 1;
	$totalonline = 0;
	
	function get_count($count, $form1, $form2, $form3) {
		$count = abs($count) % 100;
		$lcount = $count % 10;
		if ($count >= 11 && $count <= 19) return($form3);
		if ($lcount >= 2 && $lcount <= 4) return($form2);
		if ($lcount == 1) return($form1);
		return $form3;
	}
	
	foreach ($monList as $get) {
		$Server = false;
		$Server = new MinecraftStatus($get['ip'], $get['port']);
		if($Server->Online) {
			$proc = $Server->MaxPlayers / 100;
			$proc = $Server->CurPlayers / $proc;
			$totalonline = $totalonline+$Server->CurPlayers;
			$onlineWord = get_count($Server->CurPlayers, "игрок", "игрока", "игроков");
			$res .= "
				<div class='monitoring'>
					{$get['name']} <span>{$Server->CurPlayers} $onlineWord</span>
					<div class='monitoring-polosa'>
						<div class='monitoring-width' style='width:{$proc}%'></div>
					</div>
				</div>
			";
		} else {
			$res .= "
				<div class='monitoring'>
					{$get['name']} <span>Выключен</span>
					<div class='monitoring-polosa'>
						<div class='monitoring-width-off' style='width:100%'></div>
					</div>
				</div>
			";
		}
		$i++;
	}
	
	$totalWord = get_count($totalonline, "игрок", "игрока", "игроков");
	echo $res;
	echo "<p class='tdx-strom'><span class='online-o'></span> Общий онлайн: $totalonline $totalWord</p>";
?>					