( function( $ ) {

	'use strict';

	$(document).ready(function($){

		$('.xshop-about-notice .btn-dismiss').on('click',function(e) {

			e.preventDefault();

			var $this = $(this);

			var userid = $(this).data('userid');
			var nonce = $(this).data('nonce');

			$.ajax({
				type     : 'GET',
				dataType : 'json',
				url      : ajaxurl,
				data     : {
					'action'   : 'xshop_dismiss',
					'userid'   : userid,
					'_wpnonce' : nonce
				},
				success  : function (response) {
					if ( true === response.status ) {
						$this.parents('.xshop-about-notice').fadeOut('slow');
					}
				}
			});
		});
		
		$('.eye-notice .notice-dismiss').on('click',function(){
			var url = new URL(location.href);
			url.searchParams.append('hnotice',1);
			location.href= url;
		});

	// Click-to-copy coupon code
	$(document).on('click', '.xshop-coupon-code', function() {
		var code = $(this).text().trim();
		if (navigator.clipboard) {
			navigator.clipboard.writeText(code).then(function() {
				// success - handled by visual feedback below
			});
		} else {
			// Fallback
			var $tmp = $('<input>').val(code).appendTo('body').select();
			document.execCommand('copy');
			$tmp.remove();
		}
		var $el = $(this);
		var origText = $el.text();
		$el.text('Copied!').css('background', '#22c55e');
		setTimeout(function() {
			$el.text(origText).css('background', '');
		}, 1800);
	});

