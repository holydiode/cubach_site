<?php
	if(!defined('DATALIFEENGINE')) die("Hacking attempt!");
	$header = "Команда проекта";
	//$style =  "padding: 3px 12px;";
	$content = "
		<!--table class='uk-table uk-table-condensed team_b' style='margin-top:0px'>
			<tbody>
				<tr style='background: rgba(0, 0, 0, 0.06);'>
					<td class='uk-text-center' colspan='2' style='$style'><b style='font-size:14px' class='uk-text-danger'>Главная администрация</b></td>
				</tr>
				<tr>
					<td style='$style width:80px'><b>habeebjz</b></td>
					<td style='$style'>Владелец проекта. Ответственный за работу модулей сайта</td>
				</tr>
				<tr>
					<td style='$style'><b>SkiTee3000</b></td>
					<td style='$style'>Тех.администратор. Ответственный за сборки серверов и оборудование</td>
				</tr>
			</tbody>
		</table-->
		<div class='uk-grid' style='margin-top:20px'>
			<div class='uk-width-1-3'>
				<div class='team_box'>
					<p class='team_p1'></p>
					<b>Forl1nk</b>
					<span style='color: black;'>Основатель проекта.<br>Ответственный за веб-часть</span>
				</div>
			</div>
			<div class='uk-width-1-3'>
				<div class='team_box'>
					<p class='team_p1'></p>
					<b>Anir1neles</b>
					<span style='color: black;'>Тех.администратор.<br>Ответственный за оборудование</span>
				</div>
			</div>
			<div class='uk-width-1-3'>
				<div class='team_box'>
					<p class='team_p1'></p>
					<b>Moriarty</b>
					<span style='color: black;'>Тех.администратор.<br>Ответственный за сборки серверов</span>
				</div>
			</div>
			
		</div>
	";
	$tpl->load_template('modules.tpl');
	$tpl->set('{header}', $header);
	$tpl->set('{content}', $content);
	$tpl->compile('content');
	$tpl->clear();
?>