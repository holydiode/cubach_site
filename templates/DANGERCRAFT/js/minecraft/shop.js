var showItem = false;
var showenId = 0;
var bui_item = false;
var changePage = false;

$('#showSettings').click(function() {
	if($('#shopSettings').is(":visible")) $('#shopSettings').hide();
	else $('#shopSettings').show();
})

$(document).on('click', '#enchantButton', function () {
	if($('#enchtable').is(":visible")) $('#enchtable').hide();
	else $('#enchtable').show();
})

$(document).on('click', '.shop-show-item', function () {
	if(!showItem) {
		showItem = true;
		var id = $(this).data('id');
		showenId = id;
		$('.shop-show-item').attr('disabled', true);
		$.post('/store', { action: 'show',  hash: memberHash, id: getGlobalID, id: id }, function(data) {
			if(data['status']) notifier(data['text']);
			else {
				$('#currentStack').val("1");
				$('#shopOutput').html(data);
				UIkit.modal("#itemSh").toggle();
				showItem = false
				$('.shop-show-item').attr('disabled', false);
			}
		});
	}
})

$(document).on('click', '.showset', function () {
	if(!showItem) {
		showItem = true;
		var id = $(this).data('id');
		showenId = id;
		$('.showset').attr('disabled', true);
		$.post('/store', { action: 'showsets',  hash: memberHash, id: getGlobalID, id: id }, function(data) {
			if(data['status']) notifier(data['text']);
			else {
				$('#shopOutput').html(data);
				UIkit.modal("#itemSh").toggle();
				showItem = false
				$('.showset').attr('disabled', false);
			}
		});
	}
})

$(document).on('click', '.showchest', function () {
	if(!showItem) {
		showItem = true;
		var id = $(this).data('id');
		showenId = id;
		$('.showchest').attr('disabled', true);
		$.post('/store', { action: 'showchest',  hash: memberHash, id: getGlobalID, id: id }, function(data) {
			if(data['status']) notifier(data['text']);
			else {
				$('#shopOutput').html(data);
				UIkit.modal("#itemSh").toggle();
				showItem = false
				$('.showchest').attr('disabled', false);
			}
		});
	}
})

var processed = false;
$(".my_chest_all").click(function() {
	if(!processed) {
		processed = true;
		var id = $(this).data('id');
		console.log(id);
		$.post('/store', { action: 'chest_open',  hash: memberHash, id: getGlobalID, id: id }, function(data) {
			if(data['status']) notifier(data['text']);
			else {
				if(!data['change']) $('.my_chest_all[data-id="'+id+'"]').html(data);
			}
			processed = false;
		});
	}
})

$(document).on('click', '#buychest', function () {
	if(!showItem) {
		var timeOut = 1;
		showItem = true;
		var id = $(this).data('id');
		showenId = id;
		$('#buychest').attr('disabled', true);
		$(this).html("<i class='uk-icon-spin uk-icon-circle-o-notch'></i> Покупаем сундук...");
		$.post('/store', { action: 'buychest',  hash: memberHash, id: getGlobalID, id: id }, function(data) {
			if(data['status']) notifier(data['text']);
			else {
				$('#setOutput').html(data);
				$('#buychest').html("Подождите пожалуйста "+timeOut+" сек.");
				var timer = setInterval(function() {
					timeOut--;
					$('#buychest').html("Подождите пожалуйста "+timeOut+" сек.");
					if(timeOut <= 0) {
						clearInterval(timer);
						$('#buychest').html("Купить товар");
						$('#buychest').attr('disabled', false);
						timeOut = 0;
						showItem = false;
					}
				}, 1000);
			}
		});
	}
})


$(document).on('click', '#buyset', function () {
	if(!showItem) {
		var timeOut = 5;
		showItem = true;
		var id = $(this).data('id');
		showenId = id;
		$('#buyset').attr('disabled', true);
		$(this).html("<i class='uk-icon-spin uk-icon-circle-o-notch'></i> Покупаем набор...");
		$.post('/store', { action: 'buysets',  hash: memberHash, id: getGlobalID, id: id }, function(data) {
			if(data['status']) notifier(data['text']);
			else {
				$('#setOutput').html(data);
				$('#buyset').html("Подождите пожалуйста "+timeOut+" сек.");
				var timer = setInterval(function() {
					timeOut--;
					$('#buyset').html("Подождите пожалуйста "+timeOut+" сек.");
					if(timeOut <= 0) {
						clearInterval(timer);
						$('#buyset').html("Купить товар");
						$('#buyset').attr('disabled', false);
						timeOut = 0;
						showItem = false;
					}
				}, 1000);
			}
		});
	}
})

$(document).on('click', '#lessItem', function () {
	var stack = $(this).data('stack');
	var price = parseFloat($(this).data('cost'));
	var countitems = parseInt($('#countitems').html());
	var currentStack = parseInt($('#currentStack').val());
	if(currentStack >= 2) {
		currentStack--;
		countitems -= stack;
		$('#countitems').html(countitems);
		$('#currentStack').val(currentStack);
		$('#megatotalprice').html((parseFloat($('#megatotalprice').html())-price).toFixed(2));
	}
})

$(document).on('click', '#moreItem', function () {
	var stack = $(this).data('stack');
	var price = parseFloat($(this).data('cost'));
	var countitems = parseInt($('#countitems').html());
	var currentStack = parseInt($('#currentStack').val());
	if(currentStack) {
		currentStack++;
		countitems += stack;
		$('#countitems').html(countitems);
		$('#currentStack').val(currentStack);
		$('#megatotalprice').html((parseFloat($('#megatotalprice').html())+price).toFixed(2));
	}
})

$(document).on('click', '#buy-item', function () {
	if(!bui_item) {
		var timeOut = 5;
		bui_item = true;
		var itemid = $(this).data('id');
		var currentStack = parseInt($('#currentStack').val());
		$(this).html("<i class='uk-icon-spin uk-icon-circle-o-notch'></i> Покупаем товар...");
		$(this).attr('disabled', true);
		var enchantLevels = "";
		if($('#ench_1').length) {
			var num = 0, comma = "";
			for(var i = 1; i < 23; i++) {
				if(i > 1) comma = ",";
				if($('#ench_'+i).html() == "&nbsp;") num = 0;
				else num = parseInt($('#ench_'+i).html());
				enchantLevels = enchantLevels+comma+num;
			}
			console.log(enchantLevels);
		}
		$.post('/store', { action: 'buy',  hash: memberHash, id: getGlobalID, itemid: itemid, count: currentStack, enchantLevels: enchantLevels }, function(data) {
			if(data['status']) notifier(data['text']);
			else {
				$('#buyOutput').html(data);
				$('#buy-item').html("Подождите пожалуйста "+timeOut+" сек.");
				var timer = setInterval(function() {
					timeOut--;
					$('#buy-item').html("Подождите пожалуйста "+timeOut+" сек.");
					if(timeOut <= 0) {
						clearInterval(timer);
						$('#buy-item').html("Купить товар");
						$('#buy-item').attr('disabled', false);
						bui_item = false;
					}
				}, 1000);
			}
		});
	}
});

$(document).on('click', '.changepage', function () {
	if(!changePage) {
		var page = $(this).data('page');	
		var order = $("select[name='order']").val();
		var category = $("select[name='category']").val();
		var shopid = $("input[name='shopid']").val();
		var search = $("input[name='search']").val();
		if(page >= 1) {
			changePage = true;
			bui_item = true;
			$('#shopListOutput *').attr('disabled', true);
			$.post('/store', { action: 'changepage',  hash: memberHash, id: getGlobalID, page: page, order: order, category: category, shopid: shopid, search:search }, function(data) {
				$('#shopListOutput').html(data);
				bui_item = false;
				setTimeout(function() {
					changePage = false;
					$('#shopListOutput *').attr('disabled', false);
					$('.disabledButton').attr('disabled', true);
				}, 1000);
			});
		}
	}
})


var interval_id;
$(window).focus(function() {
    if (!interval_id)
        interval_id = setInterval(getLastItems, 5000);
});

$(window).blur(function() {
    clearInterval(interval_id);
    interval_id = 0;
});

function getLastItems() {
	$.post('/store', { action: 'lastBuy',  hash: memberHash, id: getGlobalID }, function(data) {
		if(data) $('#lastBuyItems').html(data);
	});
}