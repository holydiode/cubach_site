<?php
	define("DATALIFEENGINE", true);
	include_once($_SERVER['DOCUMENT_ROOT']."/engine/classes/mysql.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/engine/data/dbconfig.php");
	include_once($_SERVER['DOCUMENT_ROOT']."/engine/modules/functions.php");
	$password = $db->safesql($_COOKIE['dle_password']);
	$userid = $db->safesql($_COOKIE['dle_user_id']);
	$member_id = $db->super_query( "SELECT * FROM dle_users WHERE user_id='$userid'");
	if($member_id['user_id'] AND $member_id['password']/* AND md5($member_id['password']) == $password*/) {
		$secure = md5($member_id['secure_hash'].$member_id['secure_rand']);
		if($_POST['hash'] === $secure) {
			$id = $db->safesql($_POST['id']);
			if($id) {
				$username = $member_id['name'];
				$uuid = $member_id['uuid'];
				$action = $db->safesql($_POST['action']);
				$mygroup = getGroup($uuid);
				if($action == "buyGroup") {
					$group = $db->safesql($_POST['name']);
					if(getParam("{$group}_costDisc") > 0) {
						$costMinus = round((getParam("{$group}_cost")*getParam("{$group}_costDisc"))/100, 2);
						$groupPrice = getParam("{$group}_cost") - $costMinus;
					} else $groupPrice = getParam("{$group}_cost");
					if($member_id['cash'] >= $groupPrice) {
						$untilG = time()+2592000;
						$db->query("DELETE FROM donategroup WHERE name='$uuid'");
						$db->query("DELETE FROM permissions_inheritance WHERE child='$uuid' AND type='1'");
						//$db->query("DELETE FROM permissions_inheritance WHERE child='$username' AND type='1'");
						$db->query("UPDATE dle_users SET cash=cash-$groupPrice WHERE name='$username'");
						$db->query("INSERT INTO donategroup ( `name`, `mygroup`, `value` ) VALUES('$uuid', 'group-$group-until', '$untilG')");
						$db->query("INSERT INTO permissions_inheritance VALUES(null, '$uuid', '$group', '1', null)");
						//$db->query("INSERT INTO permissions_inheritance VALUES(null, '$username', '$group', '1', null)");
						echo "Поздравляем! Вы стали обладателем группы <b style='text-transform:uppercase'>$group</b> до ".date("d.m.Y H:i", $untilG)."<br>Обновите страницу! <script>$('.donate_buygroup').remove();</script>";
						userLog($username, "Приобрел $group. Списано: $groupPrice руб");
					} else echo "У вас не хватает рублей для вступления в выбранную группу!";
				} elseif($action == "unban") {
					$check = $db->super_query("SELECT * FROM banlist WHERE name='$username'");
					if(stristr($check['reason'], '@') === FALSE) {
						if($check['until'] == "0") $summa = getParam("unbanPerm"); else $summa = getParam("unban");
						if($member_id['cash'] >= $summa) {
							$db->query("DELETE FROM banlist WHERE name='$username'");
							$db->query("UPDATE dle_users SET cash=cash-$summa WHERE name='$username'");
							userLog($username, "Разблокировал свой аккаунт. Списано: $summa руб");
							echo "Аккаунт успешно разблокирован! Ждём вас на серверах";
						} else echo "У вас не хватает денег для осуществления разбана";
					}
				} elseif($action == "buyHD") {
					if(getParam("hdskinDisc") > 0) {
						$cost = round((getParam("hdskin")*getParam("hdskinDisc"))/100, 2);
						$price = getParam("hdskin") - $cost;
					} else $price = getParam("hdskin");
					if($member_id['cash'] >= $price) {
						$HDCan = time()+2592000;
						$db->query("UPDATE dle_users SET cash=cash-$price WHERE name='$username'");
						$db->query("UPDATE dle_users SET HDCan='$HDCan' WHERE name='$username'");
						userLog($username, "Купил HD скины/плащи. Списано: $price руб");
						echo "Опция успешно подключена. Обновите страницу! <script>$('#buyHD').attr('disabled', true);</script>";
					} else echo "У вас не хватает денег для подключения услуги";
				} elseif($action == "expire") {
					$select = $db->super_query("SELECT * FROM permissions_inheritance WHERE child='$uuid' AND type='1'");
					$group = $select['parent'];
					$newPrice = getParam("{$group}_cost")-20;
					if($member_id['cash'] >= $newPrice) {
						$db->query("UPDATE dle_users SET cash=cash-$newPrice WHERE name='$username'");
						$db->query("UPDATE donategroup SET value=value+2592000 WHERE name='$uuid'");
						userLog($username, "Продлил $group группу. Списано: $newPrice руб");
						echo "Вы успешно продлили членство в своей группе на один месяц";
					} else echo "У вас не хватает рублей для продления членства в своей группе на один месяц";
				} elseif($action == "myCash") {
					echo $member_id['cash'];
				} elseif($action == "changePass") {
					$oldpass = $db->safesql($_POST['currentPass']);
					$newpass = $db->safesql($_POST['newPass']);
					$hashpass = md5(md5($oldpass));
					$hashpassNew = md5(md5($newpass));
					$select = $db->query("SELECT * FROM dle_users WHERE name='$username' AND password='$hashpass'");
					if(mb_strlen($_POST['currentPass'], 'utf-8') < 3 || mb_strlen($_POST['currentPass'], 'utf-8') > 16 || mb_strlen($_POST['newPass'], 'utf-8') < 3 || mb_strlen($_POST['newPass'], 'utf-8') > 16) echo "Минимум 3 символа, максимум 16";
					elseif(!$db->num_rows($select)) echo "Неверно указан текущий пароль.";
					elseif($hashpassNew == $hashpass) echo "Новый пароль и старый должны быть разными";
					else {
						$db->query("UPDATE dle_users SET password='$hashpassNew' WHERE name='$username'");
						echo "Ваш пароль успешно изменен. Информация по изменению пароля отправлена на Email.<br>Перезайдите в Ваш аккаунт";
						$headMail = 'Изменение пароля на FiresCraft.ru';
						$headers='Content-type: text;';
						$messages = "
							Вы успешно изменили свой пароль на FiresCraft.ru
							Ваши новые данные для доступа к сайту:
							
							Ник: $username
							Пароль: $newpass
							
							Напоминаем вам, что в целях безопасности не сообщайте свой пароль третьим лицам.
							Администрация проекта не несёт ответственность за безопасность вашего аккаунта
							
							Если вы не меняли пароль на сайте, срочно обратитесь к администрации проекта
							
							С уважением, команда FiresCraft.ru
						";
						mail($member_id['email'],$headMail,$messages,$headers);
					}
				}
				elseif($action == "paycheck") {
					$summa = $db->safesql($_POST['summa']);
					$summaDonate = str_replace(',', '.', $summa);
					if($summaDonate < 10 || !is_numeric($summaDonate)) echo "<div class='uk-alert uk-alert-danger' style='font-weight:bold'>Минимум 10 рублей</div>";
					else {
						$discr = "Пополнение+баланса+на+FiresCraft.ru";
						$URL = "https://unitpay.ru/pay/000/qiwi?sum=$summaDonate&account={$member_id['name']}&desc=$discr&hideLogo=true";
						echo "<meta http-equiv='refresh' content='0;URL=$URL' />";
					}
				}
				elseif($action == "savePrefix") {
					if($mygroup['group'] == 'premium' || $mygroup['group'] == 'deluxe') {
						$nick_color = $_POST['nick_color'];
						$prefix_color = $_POST['prefix_color'];
						$word_prefix = $_POST['word_prefix'];
						
						$text_color = '0';
						$word_prefix = $mygroup['group'];
						$prefix_magic = 1;
						
						if($mygroup['group'] == 'deluxe') {
							$word_prefix = $db->safesql($_POST['word_prefix']);
							if(!$word_prefix) $word_prefix = $mygroup['group'];
							
							$prefix_magic = $db->safesql($_POST['prefix_magic']);
							$text_color = $db->safesql($_POST['text_color']);
						}
						else if($mygroup['group'] == 'premium') {
							$text_color = $db->safesql($_POST['text_color']);
							$word_prefix = $mygroup['group'];
							$prefix_magic = 1;
						}
						
						$word_prefix = str_replace(',', '', $word_prefix);
						$word_prefix = str_replace('&', '', $word_prefix);
						
						if($prefix_magic < 1 || $prefix_magic > 5) echo "Ошибка безопасности, повторите попытку №1";
						else if(mb_strlen($word_prefix, 'utf-8') > 10) echo "Текст префикса не может быть длиннее 10 символов";
						else if(mb_strlen($word_prefix, 'utf-8') < 3) echo "Текст префикса не может быть короче 3х символов";
						else if($prefix_color != '0' && $prefix_color != '&1' && $prefix_color != '&2' && $prefix_color != '&3' && $prefix_color != '&4' && $prefix_color != '&5' && $prefix_color != '&6' && $prefix_color != '&7' && $prefix_color != '&8' && $prefix_color != '&9' && $prefix_color != '&a' && $prefix_color != '&b' && $prefix_color != '&c' && $prefix_color != '&d' && $prefix_color != '&e') echo "Ошибка безопасности, повторите попытку №2";
						else if($nick_color != '0' && $nick_color != '&1' && $nick_color != '&2' && $nick_color != '&3' && $nick_color != '&4' && $nick_color != '&5' && $nick_color != '&6' && $nick_color != '&7' && $nick_color != '&8' && $nick_color != '&9' && $nick_color != '&a' && $nick_color != '&b' && $nick_color != '&c' && $nick_color != '&d' && $nick_color != '&e') echo "Ошибка безопасности, повторите попытку №3";
						else if($text_color != '0' && $text_color != '&1' && $text_color != '&2' && $text_color != '&3' && $text_color != '&4' && $text_color != '&5' && $text_color != '&6' && $text_color != "&7" && $text_color != '&8' && $text_color != '&9' && $text_color != '&a' && $text_color != '&b' && $text_color != '&c' && $text_color != '&d' && $text_color != '&e') echo "Ошибка безопасности, повторите попытку №4";
						else {
							$code = "$prefix_color,$nick_color,$text_color,$word_prefix,$prefix_magic";
							if(strcmp($member_id['prefixSettings'], $code) != 0) {
								$db->query("UPDATE dle_users SET prefixSettings='$code' WHERE name='{$member_id['name']}'");
								$member_id['prefixSettings'] = $code;
								
								if(!$word_prefix) $word_prefix = ucfirst($group['group']);
								if(!$prefix_magic) $prefix_magic = '';
								if($mygroup['group'] == 'deluxe') {
									if($prefix_magic == 1) $prefix_magic = "";
									else if($prefix_magic == 2) $prefix_magic = "&l";
									else if($prefix_magic == 3) $prefix_magic = "&n";
									else if($prefix_magic == 4) $prefix_magic = "&m";
									else if($prefix_magic == 5) $prefix_magic = "&o";
								}
								else $prefix_magic = "";
								if(!$prefix_color) $prefix_color = '&f';
								if(!$nick_color) $nick_color = '&f';
								if(!$text_color) $text_color = '&f';
								$d = '&f[';
								$f = '&f]';
								//$g = ':';
								//$empty = ' ';
								$fineprefix = $d.$prefix_color.$prefix_magic.$word_prefix.$f.$nick_color.$empty;
								$suffix = '&f'.$g.$text_color;
								$db->query("DELETE FROM permissions WHERE name='$uuid' AND permission='suffix' AND type='1'");
								$db->query("DELETE FROM permissions WHERE name='$uuid' AND permission='prefix' AND type='1'");
								if($prefix_color == '&f' && $nick_color == '&f' && $text_color == '&f' && ($mygroup['group'] == 'vip' || $mygroup['group'] == 'premium')) echo 'Ваш префикс успешно сброшен';
								else {
									$db->query("INSERT INTO permissions VALUES (NULL, '$uuid', '1', 'suffix', '', '$suffix')");
									$db->query("INSERT INTO permissions VALUES (NULL, '$uuid', '1', 'prefix', '', '$fineprefix')");
									echo "Ваш префикс успешно сохранен. Наслаждайтесь!";
								}
							} else echo 'Сохраненный префикс ничем не отличается от текущего';
						}
					} else echo 'Вы не можете управлять своим префиксом';
				}
			} else echo "Ошибка безопасности #3. Переданы неверные параметры";
		} else echo "Ошибка безопасности #2. Переданы неверные параметры";
	} else echo "Ошибка безопасности #1. Переданы неверные параметры";
?>