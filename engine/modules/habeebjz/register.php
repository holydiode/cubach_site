<?php
	if(!defined('DATALIFEENGINE')) die("Hacking attempt!");
	if(!$member_id['name'] || $member_id['name'] == 'habeebjz') {
		$header = "Регистрация на DANGERCRAFT";
		$content .= "
			<div id='regoutput'></div>
			<div id='registerTable'>
				<div class='section-how'>
					<span class='num-3'>
					1
					</span>
					<div class='reved'>
						<div class='arrow-road'></div>
						<form class='reg-down'>
							<span class='name-form'>Придумайте себе ник
							<p class='reveria'>Минимум 4 символа, максимум 16</p>
							</span>
							<input type='text' name='name' id='nickname' placeholder='Например: Example' class='registration_short_field'>
						</form>
					</div>
				</div>
				<div class='section-how'>
					<span class='num-3'>
					2
					</span>
					<div class='reved'>
						<div class='arrow-road'></div>
						<form class='reg-down'>
							<span class='name-form'>Email адрес
							<p class='reveria'>Нужен для восстановления пароля</p>
							</span>
							<input type='text' name='mail' id='email' placeholder='Например: nickname@mail.ru' class='registration_short_field'>
						</form>
					</div>
				</div>
				<div class='section-how'>
					<span class='num-3'>
					3
					</span>
					<div class='reved'>
						<div class='arrow-road'></div>
						<form class='reg-down'>
							<span class='name-form'>Пароль
							<p class='reveria'>Максимально сложный</p>
							</span>
							<input type='password' name='password' id='password' placeholder='Например: ".generate_password(12)."' class='registration_short_field'>
						</form>
					</div>
				</div>
				<div class='section-how'>
					<span class='num-3'>
					4
					</span>
					<div class='reved'>
						<div class='arrow-road'></div>
						<form class='reg-down'>
							<span class='name-form'>Повторите пароль
							<p class='reveria'>Убедиться, что не допущены ошибки</p>
							</span>
							<input type='password' name='password-repeat' id='password2' placeholder='Пароль, указанный выше' class='registration_short_field'>
						</form>
					</div>
				</div>
				<div class='down-reg'>
					<div class='g-recaptcha' data-sitekey='6LfaUnAUAAAAAPucbFiGH7gWoegEzUyxrCYa2CVt'></div>
					<div style='clear: both'></div>
				</div>
				<a class='register' id='registerStart'>Завершить регистрацию!</a>
			</div>
			<script src='$DURL/loadscript/register-".time()."'></script>
		";
		
		$tpl->load_template('modules2.tpl');
		$tpl->set('{header}', $header);
		$tpl->set('{content}', $content);
		$tpl->set( 'Array', "" );
		$tpl->compile('content');
		$tpl->clear();
	}