
[group=5]
 <div class="right-block">
		<div class="n-m">Авторизация</div>
	<form method="post" action="" class='uk-form'>
		<div class='uk-grid uk-grid-small'>
			<div class='uk-width-1-1' style='font-weight: bold;
    margin-bottom: 4px;
    color: #ffffff;
    /* border: 1px solid aqua; */
    padding: 3px 20px 3px;'>Логин:</div>
			<div class='login-fields'><input type='text' class='uk-width-1-1' placeholder="example@mail.ru" name="login_name" id="login_name"></div>
			<div class='uk-width-1-1' style='font-weight: bold;
    margin-bottom: 4px;
    color: #ffffff;
    /* border: 1px solid aqua; */
    padding: 3px 20px 3px;'>Пароль:</div>
			<div class='login-fields'><input type='password' class='uk-width-1-1' placeholder="**********" name="login_password" id="login_password"></div>
		</div>
		<div style='margin:10px 0'>
			<input name="login" type="hidden" id="login" value="submit">
			<button class="btn-login" onclick="submit();" type="submit"><span class="ic-sx21"></span>Войти на сайт</button>
		</div>
	</form>
	<a id="lostpassword-link" href="/?do=lostpassword">Восстановить пароль</a>
 </div>
[/group]

[not-group=5]
	{include file='engine/modules/habeebjz/pages/userside.php'}
[/not-group]