$(document).on('click', '.admin_settings_button', function () {
	var id = $(this).data('id');
	$('.admin_settings_button').attr('disabled', true);
	if(id) {
		$.post('/store', { action: 'a_edit',  hash: memberHash, id: getGlobalID, id: id }, function(data) {
			$('.admin_settings_button').attr('disabled', false);
			$('#shopOutput').html(data);
			UIkit.modal("#itemSh").toggle();
		});
	}
})

$(document).on('click', '#saveButton_one', function () {
	var id = $(this).data('id'), canen, can_buy;
	$('.saveButton_one').attr('disabled', true);
	if($("input[data-settings='canen']").is(':checked')) canen = 1; else canen = 0;
	if($("input[data-settings='can_buy']").is(':checked')) can_buy = 1; else can_buy = 0;
	if(id) {
		$.post('/store', { action: 'a_save_1',  hash: memberHash, id: getGlobalID, id: id, itemid: $("input[data-settings='itemid']").val(), itemname: $("input[data-settings='itemname']").val(), icon: $("input[data-settings='icon']").val(), price: $("input[data-settings='price']").val(), stack: $("input[data-settings='stack']").val(), diamonds: $("input[name='diamonds']:checked").val(), canen: canen, can_buy:can_buy }, function(data) {
			$('.saveButton_one').attr('disabled', false);
			if(data['text']) {
				if(data['status']) {
					notifier(data['text']);
					$.post('/store', { action: 'a_reload',  hash: memberHash, id: getGlobalID, id: data['id'] }, function(data2) { $('#shop-item-'+data['id']).html(data2); })
				}
				else UIkit.notify(data['text'], {pos:'top-center', timeout: 5000, status: 'danger'});
			}
		});
	}
})

$(document).on('click', '#saveButton_two', function () {
	var id = $(this).data('id'), canen, can_buy;
	$('.saveButton_one').attr('disabled', true);
	if(id) {
		$.post('/store', { action: 'a_save_2',  hash: memberHash, id: getGlobalID, id: id, percent: $("input[data-settings='percent']").val(), until: $("input[data-settings='until']").val() }, function(data) {
			$('.saveButton_two').attr('disabled', false);
			if(data['text']) {
				if(data['status']) {
					notifier(data['text']);
					$.post('/store', { action: 'a_reload',  hash: memberHash, id: getGlobalID, id: data['id'] }, function(data2) { $('#shop-item-'+data['id']).html(data2); })
				}
				else UIkit.notify(data['text'], {pos:'top-center', timeout: 5000, status: 'danger'});
			}
		});
	}
})

$(document).on('click', '#removeitem', function () {
	var id = $(this).data('id');
	$('#removeitem').attr('disabled', true);
	$.post('/store', { action: 'a_save_3',  hash: memberHash, id: getGlobalID, id: id }, function(data2) {
		if(data2['status']) {
			notifier(data2['text']);
			$('#shop-item-'+data2['id']).css({'opacity': 0.2});
		}
		else notifier(data2['text']);
	})
})