<?php
	if(!defined('DATALIFEENGINE')) die("Hacking attempt!");
	$check = "
		<div class='uk-grid'>
			<div class='uk-width-1-2' style='font-size:14px'><i class='fas fa-times uk-text-muted uk-text-large uk-text-danger' style='font-size:13pt'></i> - Возможности в группе нет</div>
			<div class='uk-width-1-2' style='font-size:14px;margin-top:3px'><i class='fas fa-check uk-text-success' style='font-size:13pt'></i> - Возможность в группе есть!</div>
			<div class='uk-width-1-2' style='font-size:14px;margin-top:10px'><i class='fas fa-check-circle uk-text-success' style='font-size:13pt'></i> - Конечно же есть в <b>Deluxe группе</b></div>
			<div class='uk-width-1-2' style='font-size:14px;margin-top:10px'><i class='fas fa-thumbs-up uk-text-primary' style='font-size:13pt'></i> - Доступно для вас!</div>
		</div>
	";
	$mygroup = getGroup($member_id['uuid']);
	//$style = "style='padding: 10px;color: #4a4a4a;background: rgba(0, 0, 0, 0.09);'";
	$style = "style='padding: 10px;box-shadow: 0px 2px #c7c7c7;color: rgb(52, 58, 74);background: rgb(245, 245, 245);font-size: 13px;'";
	$no = "style='opacity:.6'";
	if($mygroup['group'] == "vip") {
		$vip = "<i class='fas fa-thumbs-up uk-text-primary uk-icon-small'></i>";
		$prem = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$elite = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$lux = "<i class='fas fa-check-circle uk-text-success' style='font-size:20pt'></i>";
		$textbox = "<div $style>
		Вы состоите в <b>VIP группе</b> до {$mygroup['until_text']}. Не забудьте продлить своё членство в личном кабинете<br>
		Ваша группа имеет <b>8 новых возможностей</b> о которых Вы можете почитать ниже</div>";
	} elseif($mygroup['group'] == "premium") {
		$vip = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$prem = "<i class='fas fa-thumbs-up uk-text-primary uk-icon-small'></i>";
		$elite = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$lux = "<i class='fas fa-check-circle uk-text-success' style='font-size:18pt'></i>";
		$textbox = "<div $style>
		Вы состоите в <b>Premium группе</b> до {$mygroup['until_text']}. Не забудьте продлить своё членство в личном кабинете<br>
		Ваша группа имеет <b>15 новых возможностей</b> о которых Вы можете почитать ниже</div>";
	} elseif($mygroup['group'] == "deluxe") {
		$vip = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$prem = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$elite = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$lux = "<i class='fas fa-thumbs-up uk-text-primary' style='font-size:18pt'></i>";
		$textbox = "<div $style>
		Вы состоите в <b>Deluxe группе</b> до {$mygroup['until_text']}. Не забудьте продлить своё членство в личном кабинете<br>
		Ваша группа имеет <b>24 новых возможностей</b> о которых Вы можете почитать ниже</div>";
	} else {
		$vip = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$prem = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$elite = "<i class='fas fa-check uk-text-success uk-icon-small'></i>";
		$lux = "<i class='fas fa-check-circle uk-text-success' style='font-size:18pt'></i>";
		$textbox = "<div $style>
		Сейчас вы <b>обычный игрок</b>, а давайте сравним Вашу группу с другими:<br><br>
		<b>VIP группа</b> - откроет для вас <b>8 новых возможностей</b><br>
		<b>Premium группа</b> - откроет для вас <b>15 новых возможностей</b><br>
		<b style='font-size:13pt'>Deluxe группа</b> - откроет для вас <b>максимальное</b> кол-во возможностей (<b>их 24</b>)</div>";
	}
	
	$header = "Донат услуги";
$content = "Наш проект не предоставляет донат-групп. ";
	/* $content = "$textbox
		<div style='margin-top:10px; padding:5px'>$check</div>
		<table class='uk-table uk-table-hover uk-table-striped uk-table-condensed donate-table'>
			<thead>
				<tr style='background: rgba(0, 0, 0, 0.09);'>
					<th><b style='padding-left: 5px'>Возможности:</b></th>
					<th class='uk-text-center'><b>Игрок</b></th>
					<th class='uk-text-center' style='width: 50px'><b style='color:#9F641E'>VIP</b></th>
					<th class='uk-text-center'><b style='color:blue'>Premium</b></th>
					<th class='uk-text-center'><div style='color:Purple'><b>Deluxe</b></div></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td></td>
					<td class='uk-text-center' style='font-size: 15px'>Бесплатно</td>
					<td colspan='3'><a href='$DURL/cabinet'><button class='uk-button btn-cabinet-green uk-width-1-1' style='margin-top:0px !important'>Узнать цены на группы</button></a></td>
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td>Размер привата:</td>
					<td class='uk-text-center'>180к</td>
					<td class='uk-text-center'>240к</td>
					<td class='uk-text-center'>300к</td>
					<td class='uk-text-center'>500к</td>
				</tr>
				<tr>
					<td>Количество приватов</td>
					<td class='uk-text-center'>4</td>
					<td class='uk-text-center'>6</td>
					<td class='uk-text-center'>8</td>
					<td class='uk-text-center'>10</td>
				</tr>
				<tr>
					<td>Флаги на приват 1: <i class='fas fa-question' data-uk-tooltip title='pvp - Пвп на регионе<br>fire-spread - Распространение огня<br>lava-flow - Разлив лавы<br>water-flow - Разлив воды<br>use - Использование люков, плит'></i></td>
					<td class='uk-text-center'><i class='fas fa-check fas fa-small uk-text-success'></i></td>
					<td class='uk-text-center'><i $vip</i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Флаги на приват 2: <i class='fas fa-question' data-uk-tooltip title='greeting - Приветствие<br>mob-spawning - Спавн мобов<br>potion-splash - Зелья'></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $vip</i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Флаги на приват 3: <i class='fas fa-question' data-uk-tooltip title='enderman-grief - Гриф эндерменов<br>mob-damage - Урон от мобов<br>snow-fall - Выпадение снега<br>damage-animals - Урон мобам'></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Флаги на приват <b>4</b>: <i class='fas fa-question' data-uk-tooltip title='ice-melt - Таянье льда<br>item-drop - Выброс вещей'></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
				   <td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Создание варпов</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Скидка в Онлайн-магазине 25%</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
				  <td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Возврат на предыдущую позицию</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
			    <tr>
					<td>Kit Start</td>
					<td class='uk-text-center'><i class='fas fa-check fas fa-small uk-text-success'></i></td>
					<td class='uk-text-center'><i $vip</i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Kit Vip</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $vip</i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Kit Premium</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Kit Deluxe</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='/call'>Телепортация к другим игрокам</td>
					<td class='uk-text-center'><i class='fas fa-check fas fa-small uk-text-success'></i></td>
					<td class='uk-text-center'><i $vip</i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Смена плаща</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='Высокое разрешение картинки.'>Смена плаща <b>HD</b></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='Высокое разрешение картинки.'>Смена скина <b>HD</b></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='/hat'>Возможность надеть на голову блок</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $vip</i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='/feed'>Восстановление голода</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $vip</i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='/heal'>Восстановление жизни</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='Не рекомендуется использовать на вещах из модов!'>Ремонт вещей с зачарованием</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
				   <td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='/fly'>Полет</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td>Писать в чат цветом</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='/workbench'>Портативный верстак</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $vip</i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>
				<tr>
					<td data-uk-tooltip title='Набор включает в себя фул зачарованный сет! Для каждого сервера индивидуален и уникален!'>Экстра набор раз в день!</td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i class='fas fa-times uk-text-danger fas fa-small' $no></i></td>
					<td class='uk-text-center'><i $prem</i></td>
					<td class='uk-text-center'><i $lux</i></td>
				</tr>					        					        					        					        					        
			</tbody>
		</table>
	"; */
	$tpl->load_template('modules.tpl');
	$tpl->set('{header}', $header);
	$tpl->set('{content}', $content);
	$tpl->compile('content');
	$tpl->clear();
?>