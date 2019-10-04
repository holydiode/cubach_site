var global = true;
function pause() {
	global = false;
	setTimeout(function(){
		global = true;
	}, 3000);
}

function notifier(data) {
	var audio = new Audio('http://firescraft.ru/uploads/alert.mp3');
	audio.play();
	audio.currentTime = 0;
	UIkit.notification({
		message: data,
		pos: 'bottom-left',
		timeout: 5000
	});
}

function myCash() {
	$.ajax({
		type: 'POST',
		url: '/ajax/main',
		data: { action: 'myCash', hash: memberHash, id: getGlobalID },
		success: function(html) { $('#balance').html(html); }
	});
}

$(document).ready(function() {
	$(".monload").load("/engine/modules/habeebjz/monitoring/output.php");
})

$('.cabinetMenu a').click(function() {
	var secid = $(this).data('id');
	$('.cabinet_section').hide();
	$('.cabinetMenu *').removeClass('btn-cabinet-active');
	$('.cabinet_section[data-sec='+secid+']').show();
	$('.cabinetMenu a[data-id='+secid+']').addClass('btn-cabinet-active');
})

$('.rules_header').click(function() {
	var spoiler = $(this).data('spoiler');
	if($('.rules_text[data-spoiler='+spoiler+']').hasClass('uk-hidden')) {
		$('.rules_text[data-spoiler='+spoiler+']').removeClass('uk-hidden');
	} else $('.rules_text[data-spoiler='+spoiler+']').addClass('uk-hidden');
})

function showChest() {
	if(global) {
		$('#chest_ajax').html("");
		$('.showChest').attr('disabled', true);
		$('.showChest').css({"pointer-events": "none", "opacity": "0.6", 'filter': "grayscale(100%)"});
		$.ajax({
			type: 'POST',
			url: '/ajax/chest',
			data: { action: 'chest_show', hash: memberHash, id: getGlobalID },
			success: function(html) {
				$('#chest_ajax').html(html);
			}
		});
	}
}

$('#changePass').click(function() {
	if(global) {
		var newPass = $('#newPass').val();
		$('#changePass').attr('disabled', true);
		pause();
		$.ajax({
			type: 'POST',
			url: '/ajax/main',
			data: { action: 'changePass', newPass: newPass, hash: memberHash, id: getGlobalID },
			success: function(html) {
				notifier(html);
				setTimeout(function(){
					$('#changePass').attr('disabled', false);
				}, 3000);
			}
		});
	}
})

$('#expire').click(function() {
	if(global) {
		pause();
		$.ajax({
			type: 'POST',
			url: '/ajax/main',
			data: { action: 'expire', hash: memberHash, id: getGlobalID },
			success: function(html) {
				$('#expire').attr('disabled', true);
				notifier(html);
				myCash();
			}
		});
	}
})

$('#unban').click(function() {
	if(global) {
		pause();
		$.ajax({
			type: 'POST',
			url: '/ajax/main',
			data: { action: 'unban', hash: memberHash, id: getGlobalID },
			success: function(html) {
				$('#unban').attr('disabled', true);
				notifier(html);
				myCash();
			}
		});
	}
})

$('#buyHD').click(function() {
	if(global) {
		pause();
		$.ajax({
			type: 'POST',
			url: '/ajax/main',
			data: { action: 'buyHD', hash: memberHash, id: getGlobalID },
			success: function(html) {
				notifier(html);
				myCash();
			}
		});
	}
})

$('#goDonate').click(function() {
	if(global) {
		var summa = $('#summaDonate').val();
		pause();
		$.ajax({
			type: 'POST',
			url: '/ajax/main',
			data: { action: 'paycheck', summa: summa, hash: memberHash, id: getGlobalID },
			success: function(html) {
				$('.donateError').html(html);
			}
		});
	}
})

function goGroup(group) {
	if(group == "deluxe" || group == "premium" || group == "vip") {
		if(global) {
			pause();
			$('.donate_buygroup').css({"pointer-events": "none", "opacity": "0.6", 'filter': "grayscale(100%)"});
			$('.donate_buygroup').attr('disabled', true);
			$.ajax({
				type: 'POST',
				url: '/ajax/main',
				data: { action: 'buyGroup', name: group, hash: memberHash, id: getGlobalID },
				success: function(html) {
					notifier(html);
					myCash();
					setTimeout(function(){
						$('.donate_buygroup').css({"pointer-events": "auto", "opacity": "1", 'filter': "grayscale(0%)"});
						$('.donate_buygroup').attr('disabled', false);
					}, 3000);
				}
			});
		}
	}
}