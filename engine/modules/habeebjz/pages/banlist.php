<?php
	if(!defined('DATALIFEENGINE')) die();
	$header = "Банлист проекта";
	$perpage = 2000000;
	$page = $db->safesql($_GET['page']);
	$select = $db->query("SELECT * FROM banlist");
	$totalitems = $db->num_rows($select);
	$totalpages = ceil($totalitems/$perpage);
	if(!$page) $page = 1;
	if($page > ceil($totalitems/$perpage)) $page = ceil($totalitems/$perpage);
	$start = ($page - 1) * $perpage;
	if($db->num_rows($select)) {
		if($member_id['name']) {
			$check = $db->super_query("SELECT * FROM banlist WHERE name='{$member_id['name']}'");
			if(!$check['id']) $content .= "
			<div style='
   color: #444444;
    padding: 12px;
    font-size: 13px;
    border-left: 6px solid #da4b3e;
    margin: 0px;
    background: #ffdad7;
    margin-top: 10px;
    margin-bottom: 10px;
    max-width: 500px;
}'>Вы не найдены в списке временно заблокированных.<br>Соблюдайте <a href='/rules'>правила проекта</a> и никогда сюда не попадете.</div>";
			else $content .= "
			<style>
	.info_access {color: #444444; padding: 12px; font-size: 13px; border-left: 6px solid #92c858; margin: 0px; background: #effddf;}
	.info_access a {color: #444444; text-decoration: underline;}
	.info_access a:hover {text-decoration: none;}
	.info_warning {color: #444444; padding: 12px; font-size: 13px; border-left: 6px solid #21aeec; margin: 0px; background: #e0f5fe;}
	.info_warning a {color: #444444; text-decoration: underline;}
	.info_warning a:hover {text-decoration: none;}
	.info_error_2 {color: #444444; margin-top: 10px; margin-bottom: 10px; padding: 12px; font-size: 13px; border-left: 6px solid #da4b3e; margin: 0px; background: #ffdad7;}
	.info_error_2 a {color: #444444; text-decoration: underline;}
	.info_error_2 a:hover {text-decoration: none;}
			</style>
			<div class=info_error_2>Вы найдены в списке заблокированных.<br>Нахождение в бан-листе крайне плохо может сказаться на Вашей репутации.</div>";
		}
	}
	$content .= "<table class='lottery-history-table-head'>";
	if($db->num_rows($select)) {
		$content .= "
<tr class='banlistst'>
<style>
tbody {
font-size: 12px;
text-transform: uppercase;
}
</style>
<td width='200px'><b>Никнейм</b></td>
<td width='200px'><b>Забанил</b></td>
<td width='200px'><b>Причина</b></td>
<td width='200px'><b>Дата выдачи</b></td>
<td width='200px'><b>Дата разбана</b></td>
		</tr>";
		$select = $db->query("SELECT * FROM banlist ORDER BY time DESC LIMIT $start, $perpage");
		while($get = $db->get_row($select)) {
			$from = date("d.m.Y H:i", $get['time']);
			$until = date("d.m.Y H:i", $get['temptime']);
			if($get['temptime'] == "0") $until = "<b>Перманентно</b>";

			if(stristr($get['reason'], '@') === FALSE) $until = "<div style='color: #ca373e;'>$until</div>";
			else {
				$get['reason'] = str_replace("@", "", $get['reason']);
				$until = "<i data-uk-tooltip title='Без права на платный разбан' uk-icon='lock'></i> $until";
			}
			if($get['reason'] == "Misconduct") $get['reason'] = "<span class='uk-text-muted'>Без причины</span>";
			
			////////// замена разбана
			if($get['reason'] == "Unbanned: ") $get['reason'] = "
			<style>span.unbanned {color: green;}</style>
			<span class='unbanned'>Разбанен</span>";
			////////
			if($get['admin'] == "Server") $get['admin'] = "
			<style>span.unbanned {color: green;}</style>
			<span class='server'>Сервер</span>";
			//////////
			//if($get['reason'] == "Unbanned: ") $get['$until'] = "
			//<style>span.unbanned {color: green;}</style>
			//<span class='unbanned'>Разбанен</span>";
			////////
			
			if($get['admin'] == "CONSOLE") $get['admin'] = "forl1nk";
			$content .= "
				<tr>
					<td><b>{$get['name']}</b></td>
					<td><b class='uk-text-primary'>{$get['admin']}</b></td>
					<td><b>{$get['reason']}</b></td>
					<td>$from</td>
					<td>$until</td>
				</tr>
			";
		}
		$dopage = $page-1; 
		$nextpage = $page+1; 
		$content .= "</table>";
		
		//if(!$page || $page == 1) $prwpage = "Предыдущая страница";
		//else $prwpage = "<a href='$DURL/?do=banlist&page=$dopage$serpage'>Предыдущая страница</a>";
		
		//if($totalpages == 1 || $page == $totalpages) $nextpage = "Следующая страница";
		//else $nextpage = "<a href='$DURL/?do=banlist&page=$nextpage$serpage'>Следующая страница</a>";
		
		
		//$content .= "<div class='uk-grid'><div class='uk-width-1-2'>$prwpage</div><div class='uk-width-1-2 uk-text-right'>$nextpage</div></div>";
	} else $content .= "<tr><td align='center'>Заблокированных нет, всё спокойно!</td></tr>";
	$content .= "</table>";
	$tpl->load_template('modules.tpl');
	$tpl->set('{header}', $header);
	$tpl->set('{content}', $content);
	$tpl->set( 'Array', "" );
	$tpl->compile('content');
	$tpl->clear();
?>