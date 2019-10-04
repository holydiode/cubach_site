var regPost = false, sec = 3;
$('#registerStart').click(function() {
	if(!regPost) {
		regPost = true;
		$('#registerStart').html("Регистрируем аккаунт...");
		$('#registerStart').css({"pointer-events": "none", 'filter': "grayscale(100%)"});
		$('#registerTable *').attr('disabled', true);
		var nickname = $('#nickname').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var password2 = $('#password2').val();
		$.post('/ajax/register', { nickname: nickname, email: email, password: password, password2: password2, captcha: grecaptcha.getResponse(), ajax: true }, function(data) {
			if(data['text']) $('#regoutput').html(data['text']);
			$('#registerStart').html("Подождите, пожалуйста ["+sec+"c.]");
			grecaptcha.reset();
			if(!data['status']) {
				var timer = setInterval(function() {
					sec--;
					$('#registerStart').html("Подождите, пожалуйста ["+sec+"c.]");
					if(sec <= 0) {
						sec = 3;
						regPost = false;
						clearInterval(timer);
						$('#registerStart').html("Завершить регистрацию!");
						$('#registerStart').css({"pointer-events": "auto", 'filter': "grayscale(0%)"});
						$('#registerTable *').attr('disabled', false);
					}
				}, 1000);
			}
			else {
				$('#registerTable').slideUp(500).delay(500).remove();
			}
		});
	}
})