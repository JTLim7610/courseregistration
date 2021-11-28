(function ($) {

	"use strict";

	var fullHeight = function () {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function () {
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
		if(!$("#sidebar").hasClass('active'))
			$('#sidebar').removeClass('expand');
		else 
			$("#sidebar").addClass('expand');
	});



	//On hover menu bar 
	$(document).on('mouseover', '#sidebar', function () {
		$(this).addClass('expand');
		$("#layoutContent").addClass('expand');

	})
	$(document).on('mouseout', '#sidebar', function () {
		$(this).removeClass('expand');
		$("#layoutContent").removeClass('expand');
	})
    
})(jQuery);
