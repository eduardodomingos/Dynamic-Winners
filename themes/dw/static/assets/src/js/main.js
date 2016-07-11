(function($) {
	$(document).ready(function(){

		// Cache references to DOM elements for performance
		//=======================================
		var dom = {
			$window:            				$(window),
			$body:              				$('body'),
			$HomeHeadlinesCarousel: 				$('.home #headlines .carousel'),
			$HomeNewsCarousel: 						$('.home #news .carousel'),
			$HomeServicesCarousel: 					$('.home #services .carousel'),
			$HomeAthletesCarousel: 					$('.home #athletes .carousel')
		};

		// Home / Headlines carousel
		//=======================================
		dom.$HomeHeadlinesCarousel.slick({
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
		dom.$HomeNewsCarousel.slick({
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
		dom.$HomeServicesCarousel.slick({
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
		dom.$HomeAthletesCarousel.slick({
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


	});
}(jQuery));
