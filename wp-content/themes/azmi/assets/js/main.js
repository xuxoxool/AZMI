$(window).on('load', function() {
	
	$('#main_wrapper').hide();
	$("#preloader_loader").fadeOut("slow", function() {
		$("#preloader").delay(300).fadeOut("slow");
		$("#main_wrapper").fadeIn("slow");
	}); 
});

$(function() {
	setTimeout(function() {
		$('#page').removeClass('loading');
	}, 250);
	
	initMenu();
	
	$('body').on('scroll',$.debounce(100,function() {
		initBackToTop();
	}));
	
	$(window).resize(function() {
	});
});

function initMenu() {
	$('[data-action="menu"]').off('click').on('click',function() {
		var $menu = $('#main_menu');
		var $wrapper = $('#main_menu_wrapper');
		var $list = $('#main_menu_list');
		var $header = $('#main_menu_header');
		var $mainHeader = $('#header');
		var mainHeaderHeight = $mainHeader.outerHeight();
		var isMenuShown = $menu.is(':visible');
		var timing = 100;
		var easing = 'linear';
		
		if(isMenuShown) {
			$mainHeader.removeClass('in');
			$header.animate({ 'top' : '-500px' }, timing, easing, function() {
				$list.animate({ 'right' : '-600px' }, timing, easing, function() {
					$wrapper.animate({ 'opacity' : 0 }, timing, easing, function() {
						setTimeout(function() { $menu.hide(); }, timing);
					});
				});
			});
		} else {
			$mainHeader.addClass('in');
			$menu.show();
			$wrapper.animate({ 'opacity' : 1 }, timing, easing, function() {
				$list.animate({ 'right' : '0' }, timing, easing, function() {
					$header.animate({ 'top' : mainHeaderHeight+'px' }, timing, easing);
				});
			});
		}
	});
}

function initBackToTop() {
	if($('body').scrollTop() <= 100) {
		$('#back_to_top').removeClass('in');
	} else {
		$('#back_to_top').addClass('in');
	}
	
	$('#back_to_top').off('click').on('click',function() {
		$('body').animate({ scrollTop : 0 }, 250);
	});
}































