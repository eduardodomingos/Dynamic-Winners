(function($) {
	$(document).ready(function(){

		// Cache references to DOM elements for performance
		//=======================================
		var dom = {
			$window:            					$(window),
			$body:              					$('body'),
			$menuToggle: 							$('#site-header .site-nav__toggle'),
			$menuToggleIcon: 						$('#site-header .site-nav__toggle i'),
			$navPocket: 							$('#site-header .site-nav__pocket'),
			$homeHeadlinesCarousel: 				$('.home #headlines .carousel'),
			$homeNewsCarousel: 						$('.home #news .carousel'),
			$homeServicesCarousel: 					$('.home #services .carousel'),
			$homeAthletesCarousel: 					$('.home #athletes .carousel'),
			$latestPostsCarousel: 					$('.blog #latest-posts .carousel'),
			$athleteDetailsCarouselImages: 			$('.detail #athlete-details .carousel.slider-nav'),
			$athleteDetailsCarouselText: 			$('.detail #athlete-details .carousel.slider-for')
		};

		// Toggle Mobile nav
		//=======================================
		dom.$menuToggle.click(function(e){
			dom.$navPocket.toggleClass('active');
			if(dom.$menuToggleIcon.hasClass('icon-menu')) {
				dom.$menuToggleIcon.removeClass('icon-menu').addClass('icon-cancel');
			}
			else {
				dom.$menuToggleIcon.removeClass('icon-cancel').addClass('icon-menu');
			}
		});

		// Home / Headlines carousel
		//=======================================
		dom.$homeHeadlinesCarousel.slick({
			mobileFirst: true,
			autoplay: false,
			dots: true,
			arrows: false,
			appendDots: $('.home #headlines .carousel-wrapper .dots .container'),
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						arrows: true
					}
				}
			]
		});

		// Home / News carousel
		//=======================================
		dom.$homeNewsCarousel.slick({
			mobileFirst: true,
			appendArrows: $('.home #news .arrows'),
			responsive: [
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}
			]
		});

		// Home / Services carousel
		//=======================================
		dom.$homeServicesCarousel.slick({
			mobileFirst: true,
			dots: true,
			responsive: [
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				}
			]
		});

		// Home / Athletes carousel
		//=======================================
		dom.$homeAthletesCarousel.slick({
			mobileFirst: true,
			appendArrows: $('.home #athletes .arrows'),
			dots: true,
			responsive: [
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3
					}
				}
			]
		});

		// Blog / Latest posts carousel
		//=======================================
		dom.$latestPostsCarousel.slick({
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}
			]
		});

		// Detail / Athlete details carousel
		//=======================================
		dom.$athleteDetailsCarouselText.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.slider-nav'
		});
		dom.$athleteDetailsCarouselImages.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			asNavFor: '.slider-for',
			focusOnSelect: true,
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 5
					}
				}
			]
		});






		// dom.$athleteDetailsCarousel.slick({
		// 	mobileFirst: true,
		// 	responsive: [
		// 		{
		// 			breakpoint: 480,
		// 			settings: {
		// 				slidesToShow: 3,
		// 				slidesToScroll: 1
		// 			}
		// 		}
		// 	]
		// });
	});
}(jQuery));
