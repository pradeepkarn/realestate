/*
Author       : Dreamguys
Template Name: Findjob - Bootstrap Template
Version      : 1
*/

(function($) {
    "use strict";
	
	// Sidebar
	if($(window).width() <= 991){
	var Sidemenu = function() {
		this.$menuItem = $('.main-nav a');
	};
	
	function init() {
		var $this = Sidemenu;
		$('.main-nav a').on('click', function(e) {
			if($(this).parent().hasClass('has-submenu')) {
				e.preventDefault();
			}
			if(!$(this).hasClass('submenu')) {
				$('ul', $(this).parents('ul:first')).slideUp(350);
				$('a', $(this).parents('ul:first')).removeClass('submenu');
				$(this).next('ul').slideDown(350);
				$(this).addClass('submenu');
			} else if($(this).hasClass('submenu')) {
				$(this).removeClass('submenu');
				$(this).next('ul').slideUp(350);
			}
		});
	}

	// Sidebar Initiate
	init();
	}
	
	
	// Select 2
	if($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}
	
	// Date Time Picker
	if($('.datetimepicker').length > 0) {
		$('.datetimepicker').datetimepicker({
			format: 'DD/MM/YYYY',
			icons: {
				up: "fas fa-chevron-up",
				down: "fas fa-chevron-down",
				next: 'fas fa-chevron-right',
				previous: 'fas fa-chevron-left'
			}
		});
	}
	
	
	// Mobile menu sidebar overlay
	$(document).on('click', '#mobile_btn', function() {
		$('main-wrapper').toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('body').addClass('menu-opened');
		return false;
	});
	
	$(document).on('click', '#menu_close', function() {
		$('body').removeClass('menu-opened');
		$('.sidebar-overlay').removeClass('opened');
		$('main-wrapper').removeClass('slide-nav');
	});

	//Header Height 
	var header_height = $('.header').outerHeight();
	$('body').css('padding-top',header_height);

	//Trending Ads Slider
	if($('.trending-ads .fulltime-slider').length > 0) {
		var swiper = new Swiper(".trending-ads .fulltime-slider", {
		slidesPerView: 1,
		speed: 1500,
		observer: true,
		observeParents: true,
	        pagination: {
	          	el: ".swiper-pagination",
	          	clickable: true
	        },
      	});
	}
	if($('.trending-ads .parttime-slider').length > 0) {
		var swiper = new Swiper(".trending-ads .parttime-slider", {
		slidesPerView: 1,
		speed: 1500,
		observer: true,
		observeParents: true,
	        pagination: {
	          	el: ".swiper-pagination",
	          	clickable: true
	        },
      	});
	}
	if($('.trending-ads .remotely-slider').length > 0) {
		var swiper = new Swiper(".trending-ads .remotely-slider", {
		slidesPerView: 1,
		speed: 1500,
		observer: true,
		observeParents: true,
	        pagination: {
	          	el: ".swiper-pagination",
	          	clickable: true
	        },
      	});
	}

	//Top Freelancer Slider
	if($('.top-freelancer .top-freelancer-slider').length > 0) {
		var swiper = new Swiper(".top-freelancer .top-freelancer-slider", {
		slidesPerView: 4,
		speed: 1500,
		loop: true,
		spaceBetween: 35,
	        pagination: {
	          	el: ".swiper-pagination",
	          	clickable: true
	        },
	        breakpoints: {
		        1: {
		          	slidesPerView: 1,
		          	spaceBetween: 15,
		        },
		        768: {
		          	slidesPerView: 2,
		          	spaceBetween: 30,
		        },
		        992: {
		          	slidesPerView: 3,
		          	spaceBetween: 30,
		        },
		        1199: {
		          	slidesPerView: 4,
		          	spaceBetween: 35,
		        },
		    }
      	});
	}

	//Testimonial Slider
	if($('.testimonial-section .testimonial-slider').length > 0) {
		var swiper = new Swiper(".testimonial-section .testimonial-slider", {
		slidesPerView: 1,
		spaceBetween: 20,
		speed: 1500,
		loop: true,
	        pagination: {
	          	el: ".swiper-pagination",
	          	clickable: true
	        },
      	});
	}

	//Save Freelancer
	$(document).on('click', '.save-col a', function(e) {
		e.preventDefault();
		$(this).toggleClass('saved');
	});

	//Header Fixed
	if ($(window).width() > 991) {
		$(window).scroll(function(){
		  	var sticky = $('.header'),
		    scroll = $(window).scrollTop();
		  	if (scroll >= 50) sticky.addClass('fixed');
		  	else sticky.removeClass('fixed');
		});
	}

	// Summernote
	if($('.summernote').length > 0) {
		$('.summernote').summernote({
			height: 300,            
			minHeight: null,
			maxHeight: null, 
			focus: false
		});
	}

})(jQuery);