<?php
	define("DATALIFEENGINE", true);
	include_once($_SERVER['DOCUMENT_ROOT']."/engine/classes/mysql.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/engine/data/dbconfig.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/engine/modules/functions.php");
	$password = $db->safesql($_COOKIE['dle_password']);
	$userid = $db->safesql($_COOKIE['dle_user_id']);
	$member_id = $db->super_query( "SELECT * FROM dle_users WHERE user_id='$userid'");
	if($member_id['user_id'] AND $member_id['password'] AND $member_id['password'] == md5($password)) {
		$secure = md5($member_id['secure_hash'].$member_id['secure_rand']);
		if($_POST['hash'] === $secure) {
			$id = $db->safesql($_POST['id']);
			if($id) {
				$action = $db->safesql($_POST['action']);
				if($action == "chest_show") {
					if($member_id['chests'] > 0) {
						$chestsWord = get_count($member_id['chests'], "сундук", "сундука", "сундуков");
						$openChest = "
							<center class='uk-text-primary' style='margin: 15px 0; font-size: 18px;'>У вас есть <b>{$member_id['chests']} $chestsWord с секретом</b></center>
							<button class='uk-button btn-cabinet-green uk-width-1-1 openChest' style='margin-top: 0px !important;' onclick=\"openChest()\">Открыть один сундук с секретом</button>
						";
					} else $openChest = "
						<center class='uk-text-danger' style='margin: 15px 0; font-size: 18px;'>У вас нет сундуков с секретом.<br>Порголосуйте за нас на TopCraft и получите свой сундук</center>
						<a href='https://topcraft.ru/servers/8984/' target='_blank'><center class='uk-text-primary' style='margin-top:-10px; font-size: 18px;'><b><u>Перейти к голосованию прямо сейчас!</b></u></center></a>
					";
					echo "
						<div id='chest_show' uk-modal>
							<div class='uk-modal-dialog uk-modal-body' style='width:650px'>
								<button class='uk-modal-close-default' type='button' uk-close></button>
								<h4>Сундук с секретом</h4>
								<div id='chestText' style='margin-top:10px; font-size:14px'>
									<center style='margin-bottom:20px'><img src='http://firescraft.ru/uploads/chest.png?1' style='width:200px'></center>
									Мы особо ценим игроков, которые изо дня в день голосуют за наш проект!<br>
									И специально для Вас мы создали отличную систему поощрения особо активно голосующих.<br><br>
									За отданный голос Вы мгновенно получаете сундук с секретом, который можете сразу же открыть.<br>
									В сундуке вы сможете найти любой товар из онлайн-магазина на любой сервер.<br>
									А что попадёт тебе? Скорее открой сундук и узнай!<br>
									$openChest
								</div>
								<div id='openProcess' style='display:none' >
									<center>
										<img src='http://firescraft.ru/uploads/chest.png?1' style='width:200px'>
										<div style='margin-top:50px; font-size:24px'><i class='fas fa-spinner fa-spin'></i> Открываем сундук...</div>
									</center>
								</div>
							</div>
						</div>
						
						<script>
							function openChest() {
								if(global) {
									$('.openChest').attr('disabled', true);
									$.ajax({
										type: 'POST',
										url: '/ajax/chest',
										data: { action: 'chest_open', hash: '$secure', id: '{$member_id['user_id']}' },
										success: function(html) {
											$('#chestText').empty();
											$('#chestText').hide();
											$('#chestText').html(html);
											$('#openProcess').show();
											setTimeout(function() {
												$('#openProcess').fadeOut(1500);
											}, 1000);
										}
									});
								}
							}
							UIkit.modal('#chest_show').toggle();
						</script>
					";
				}
				elseif($action == "chest_open") {
					if($member_id['chests'] > 0) {
						$select = $db->super_query("SELECT * FROM shop_items WHERE shopid='1' ORDER BY rand() LIMIT 1");
						$db->query("UPDATE dle_users SET chests=chests-1 WHERE name='{$member_id['name']}'");
						$db->query("INSERT INTO shop_buys1 VALUES (null, 'item', '{$select['itemid']}', '{$member_id['name']}', '{$select['stack']}', null, '{$select['itemname']}')");
						echo "
							<div style='margin-top:10px; font-size:16px'>
								<center>
									<img src='{$select['icon']}' style='width:200px'>
									<div style='margin-top:50px;'>
										<div style='font-size:22px'>Вам попалось:</div>
										<div style='font-size:24px; margin-top:5px'><b>{$select['itemname']}</b> ({$select['stack']} шт.) на сервер <b>Techno</b></div>
										<div style='font-size:16px; margin-top:25px'>Для того, чтобы получить этот товар на сервере, введите /cart all или /cart gui</div>
									</div>
								</center>
							</div>
							
							<script>
								setTimeout(function() {
									var audio = new Audio('http://firescraft.ru/uploads/chest.mp3');
									audio.play();
									audio.currentTime = 0;
									audio.volume = 0.2;
									$('#chestText').show();
								}, 2500);
							</script>
						";
					} else echo "
						<script>
							notifier('У вас нет сундуков с секретом');
							$('#chest_ajax').empty();
						</script>
					";
				} else echo "Ошибка безопасности #4. Переданы неверные параметры";
			} else echo "Ошибка безопасности #3. Переданы неверные параметры";
		} else echo "Ошибка безопасности #2. Переданы неверные параметры";
	} else echo "Ошибка безопасности #1. Переданы неверные параметры";
	//$('.showChest').attr('disabled', false);
	//$('.showChest').css({"pointer-events": "auto", "opacity": "1", 'filter': "grayscale(0%)"});
?>