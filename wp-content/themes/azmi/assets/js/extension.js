
$(function() {
	$('[data-toggle="tab"]').click(function(e) {
		e.preventDefault();
		var target = $(this).attr('href');
		var $target = $(target).eq(0);
		if($target.length) {
			var $tabs = $(this).parents('.tabs').eq(0);
					$tabs.find('.tab-pane').removeClass('active');
					$tabs.find('li').removeClass('active');
			
			$(this).parents('li').eq(0).addClass('active');
			$target.addClass('active');
		}
		return false;
	});
	
	$('[data-toggle="selector"]').on('click',function(e) {
		var target = $(e.target).attr('data-target');
		var $target = (target !== 'undefined' && target) ? $(target) : null;
		
		if($target && $target.length) $target.sidepanel('show');
	});
	
	$('[data-toggle="dropdown"]').on('click',function(e) {
		$('.dropdown').removeClass('on');
		var $dropdown = $(e.target).parents('.dropdown').eq(0);
		if($dropdown.length) $dropdown.addClass('on');
	});
	
	$('[data-toggle="modal"]').on('click',function(e) {
		var target = $(e.target).attr('data-target');
				target = (~target.indexOf('#')) ? target : '#'+target;
		var $target = (typeof target !== 'undefined' && target) ? $(target) : null;
		
		if($target === null) {
			$target = $(e.target).parents('.modal').eq(0);
			if(typeof $target !== 'undefined' && $target.length) $target.modal('hide');
		} else if($target.length) {
			$target.modal('show');
		}
	});
	
	$(document).click(function(e) {
		if(!$(e.target).parents('.dropdown').length) $('.dropdown').removeClass('on');
	});
});

/** SELECTOR SIDE PANEL */
(function ($) {
	var Selector = function($e, param) {
		var self = this;
				self.$e = $e;
				self.param = param;
		
		function showSelector() {
			self.$e.addClass('show');
			
			var onShow = (self.param && self.param.hasOwnProperty('onShow')) ? self.param.onShow : null;
			if(typeof onShow === 'string') {
				setTimeout(function() {
					callback(onShow, window, self.$e);
				},100);
			} else if (typeof onShow === 'function') {
				setTimeout(function() {
					onShow(self.$e);
				},100);
			}
			
			return self;
		};
		
		function hideSelector() {
			self.$e.removeClass('show');
			
			var onHide = (self.param && self.param.hasOwnProperty('onHide')) ? self.param.onHide : null;
			if(typeof onHide === 'string') {
				setTimeout(function() {
					callback(onHide, window, self.$e);
				},100);
			} else if (typeof onHide === 'function') {
				setTimeout(function() {
					onHide(self.$e);
				},100);
			}
			
			return self;
		};
		
		function setTitle(v) {
			if(v === false) {
				self.$e.find('.selector-title').hide();
			} else {
				self.$e.find('.selector-title').html(v);
			}
			return self;
		}
		
		function setBody(v) {
			if(v === false) {
				self.$e.find('.selector-body').hide();
			} else {
				self.$e.find('.selector-body').html(v);
			}
			return self;
		}
		
		function setFooter(v) {
			if(v === false) {
				self.$e.find('.selector-footer').hide();
			} else {
				self.$e.find('.selector-footer').html(v);
			}
			return self;
		}
			
		function createPanel() {	
			var $selector = $('<div />', { 'class' : 'selector' });
				var $wrapper = $('<div />', { 'class' : 'selector-wrapper' });
					var $header = $('<div />', { 'class' : 'selector-header' });
						var $close = $('<div />', { 'class' : 'selector-close' });
								$close.html('<span></span><span></span>');
								$close.appendTo($header);
						var $title = $('<div />', { 'class' : 'selector-title' });
								$title.appendTo($header);
							$header.appendTo($wrapper);
					var $body = $('<div />', { 'class' : 'selector-body' });
							$body.html(	self.$e	);
							$body.appendTo($wrapper);
					var $footer = $('<div />', { 'class' : 'selector-footer' });
							$footer.appendTo($wrapper);
						$wrapper.appendTo($selector);
					$selector.appendTo($('body'));
				
			self.$e = $selector;
		}
		
		function initCloser() {
			self.$e.find('.selector-close').off('click').on('click',hideSelector);
			return self;
		}
		
		function callback(name, context /*, args */) {
			var args = [].slice.call(arguments).splice(2);
			var namespaces = name.split(".");
			var func = namespaces.pop();
			for (var i = 0; i < namespaces.length; i++) {
				context = context[namespaces[i]];
			}
			var exists = (typeof context[func] === 'function');
			return (exists) ? context[func].apply(context,args) : null;
		}
		
		function init() {
			if(typeof self.param === 'string' && $.trim(self.param) == 'show') {
				setTimeout(showSelector,250);
			} else if(typeof self.param === 'string' && $.trim(self.param) == 'hide') {
				hideSelector();
			} else {
				if(!self.$e.hasClass('selector')) createPanel();
				
				if(self.param) {
					if(self.param.hasOwnProperty('title')) {
						var title = self.param.title;
						setTitle( (typeof title === 'function') ? title() : title );
					}
					
					if(self.param.hasOwnProperty('body')) {
						var body = self.param.body;
						setBody( (typeof body === 'function') ? body() : body );
					}
					
					if(self.param.hasOwnProperty('footer')) {
						var footer = self.param.footer;
						setFooter( (typeof footer === 'function') ? footer() : footer );
					}
				}
				
				initCloser();
				setTimeout(showSelector,250);
			}
			
			return self;
		}
		
		return init();
	}

	$.selector = $.fn.selector = function(param) {
		return this.each(function() {
			var p = (typeof param !== 'undefined' && param) ? param : null;
			return new Selector(	$(this), p	);
		});
	};
	
})(jQuery);

/** MODAL */
(function ($) {
	var Modal = function($e, param) {
		var self = this;
				self.$e = $e;
				self.param = param;
		
		function showModal() {
			initCloser();
			self.$e.addClass('show');
			self.$e.trigger('modal:show',[self.$e]);
			return self;
		};
		
		function hideModal() {
			self.$e.removeClass('show');
			self.$e.trigger('modal:hide',[self.$e]);
			return self;
		};
		
		function initCloser() {
			self.$e.find('.modal-close, [data-toggle="modal"], [data-close="modal"]').off('click').on('click',hideModal);
			self.$e.off('click').on('click',function(e) {
				if(!$(e.target).parents('.modal-dialog').eq(0).length) hideModal();
			});
			return self;
		}
		
		function callback(name, context /*, args */) {
			var args = [].slice.call(arguments).splice(2);
			var namespaces = name.split(".");
			var func = namespaces.pop();
			for (var i = 0; i < namespaces.length; i++) {
				context = context[namespaces[i]];
			}
			var exists = (typeof context[func] === 'function');
			return (exists) ? context[func].apply(context,args) : null;
		}
		
		function init() {
			if(typeof self.param === 'string' && $.trim(self.param) == 'show') {
				setTimeout(showModal,250);
			} else if(typeof self.param === 'string' && $.trim(self.param) == 'hide') {
				hideModal();
			} else {
				setTimeout(showModal,250);
			}
			
			return self;
		}
		
		return init();
	}

	$.modal = $.fn.modal = function(param) {
		return this.each(function() {
			var p = (typeof param !== 'undefined' && param) ? param : null;
			return new Modal(	$(this), p	);
		});
	};
	
})(jQuery);




















