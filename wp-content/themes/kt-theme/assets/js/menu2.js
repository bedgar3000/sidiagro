(function($) { 
    "use strict";

	$(function() {
		var header = $(".start-style");

		scrollOn();
		$(window).scroll(function() {
			scrollOn();
		});

		function scrollOn() {
			var scroll = $(window).scrollTop();
			if (scroll >= 100) {
				header.removeClass('start-style').addClass("scroll-on");
			} else {
				header.removeClass("scroll-on").addClass('start-style');
			}
		}
	});		
		
	//  Animation
	$(document).ready(function() {
	});

	//  Menu On Hover
	$('body').on('mouseenter mouseleave','.menu-item',function(e){
		if ($(window).width() > 750) {
			var _d=$(e.target).closest('.menu-item');_d.addClass('show');
			setTimeout(function(){
			_d[_d.is(':hover')?'addClass':'removeClass']('show');
			},1);
		}
	});
	
	/**
	 * landing page
	 */
	const sections = document.querySelectorAll("section");
	const navLi = document.querySelectorAll("#navbarSupportedContent .menu-item");
	window.onscroll = () => {
		var current = "";

		sections.forEach((section) => {
			const sectionTop = section.offsetTop;
			if (pageYOffset >= sectionTop - 120) {
				current = section.getAttribute("id");
			}
		});

		navLi.forEach((li) => {
			li.classList.remove("current_page_item");
			var href = li.children[0].getAttribute("href");
			if ('#' + current == href) {
				li.classList.add("current_page_item");
			}
		});
	};
	
  })(jQuery); 