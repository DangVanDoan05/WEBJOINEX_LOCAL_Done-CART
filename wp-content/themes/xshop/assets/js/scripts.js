(function ($) {
	"use strict";

	//document ready function
	jQuery(document).ready(function($){

		$("#xshop-menu").xshopAccessibleDropDown();

	}); // end document ready

	$.fn.xshopAccessibleDropDown = function () {
		var el = $(this);

		/* Make dropdown menus keyboard accessible */

		$("a", el).focus(function() {
			$(this).parents("li").addClass("hover");
		}).blur(function() {
			$(this).parents("li").removeClass("hover");
		});
	}

}(jQuery));	

window.onload = function() {
    // Find all elements with the class "wp-block-woocommerce-filter-wrapper"
    var filterWrappers = document.querySelectorAll('.wp-block-woocommerce-filter-wrapper');
    
    // Loop through each found element
    filterWrappers.forEach(function(filterWrapper) {
        // Get its parent element
        var parentDiv = filterWrapper.parentElement;
        
        // Add a new class to the parent div
        parentDiv.classList.add('xshop-filter-parent');
    });
};


