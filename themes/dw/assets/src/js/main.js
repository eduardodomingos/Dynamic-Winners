(function($) {
	$(document).ready(function(){

		/*
		 * Cache references for DOM elements
		 */
		var dom = {
			$window: 					$(window),
			$body:	 					$('body'),
			$homeNewsSlider:			$('.home #news .slider'),
			$homeServicesSlider:		$('.home #services .slider'),
			$homeAthletesSlider:		$('.home #athletes .slider'),
			$menuToggle:				$('.site-nav__toggle'),
			$menuToggleIcon:			$('.site-nav__toggle'),
			$siteNav:					$('.site-nav'),
			$siteNavList:				$('.site-nav__list'),
			$siteNavListList:			$('.site-nav__list ul')
		};

		/*
		 * Code that runs on all pages
		 */
		// Toggle mobile menu
		var menuHeight = dom.$siteNavListList.outerHeight();
		dom.$menuToggle.click(function(e){
			if(dom.$siteNav.hasClass('site-nav--active')) {
				dom.$siteNav.removeClass('site-nav--active');
				dom.$siteNavList.css('max-height', 0);
			} else {
				dom.$siteNav.toggleClass('site-nav--active');
				dom.$siteNavList.css('max-height', menuHeight);
			}
		});

		/*
		 * Homepage Code
		 */
		if(dom.$body.hasClass('home')) {
			/*
			 * Sliders
			 */
			// Headlines slider
			$('#headlines .slider').slick({
				mobileFirst: true,
				autoplay: false,
				dots: true,
			});

			// Services Slider DotDotDot
			dom.$homeServicesSlider.on('init', function(event, slick){
				dom.$homeServicesSlider.find('.dotdotdot').dotdotdot({
					height: 63
				});
			});

			// Services Slider
			dom.$homeServicesSlider.slick({
				mobileFirst: true,
				dots: true,
				responsive: [
					{
						breakpoint: 479,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 1023,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					}
				]
			});

			dom.$window.load(function(){

				// News Slider DotDotDot
				dom.$homeNewsSlider.on('init', function(event, slick){
					dom.$homeNewsSlider.find('.dotdotdot').dotdotdot({
						height: 63
					});
				});

				// News Slider
				dom.$homeNewsSlider.slick({
					mobileFirst: true,
					responsive: [
						{
							breakpoint: 479,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						}
					]
				}).on('afterChange',function(event){
					fixVerticalArrows(event);
				}).trigger('afterChange');

				// Athletes Slider
				dom.$homeAthletesSlider.slick({
					mobileFirst: true,
					dots: true,
					responsive: [
						{
							breakpoint: 479,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						},
						{
							breakpoint: 1023,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 3
							}
						}
					]
				}).on('afterChange',function(event){
					fixVerticalArrows(event);
				}).trigger('afterChange');
			});

			// Autosize contact form textarea
			autosize($('.contact-form #inputMessage'));

			// // DotDotDot
			// $("#news .dotdotdot").dotdotdot({
			// 	height: 63 // 3 lines: this value should be the same as in sass/base/_typography.scss
			// });
            //
			// $("#services .dotdotdot").dotdotdot({
			// 	height: 63 // 3 lines: this value should be the same as in sass/base/_typography.scss
			// });


			// On window resize:
			$(window).resize(function(event){
				dom.$homeNewsSlider.trigger('afterChange');
				dom.$homeAthletesSlider.trigger('afterChange');
			});

		} // end Homepage JS

		/*
		 * Blog Page Code
		 */
		if(dom.$body.hasClass('blog')) {
			// Latest posts slider
			$('#latest-posts .slider').slick({
				mobileFirst: true
			});

			// Athlete slider
			$('.athlete__slider .slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.athlete__slider .slider-nav'
			});
			$('.athlete__slider .slider-nav').slick({
				mobileFirst: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				asNavFor: '.athlete__slider .slider-for',
				centerMode: false,
				focusOnSelect: true,
				responsive: [
					{
						breakpoint: 479,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 1023,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1
						}
					}
				]
			});



		} // end Blog JS


		/*
		 * Athlete Page Code
		 */
		if(dom.$body.hasClass('athlete')) {
			// Gallery
			$('.athlete__media .slider').slick({
				mobileFirst: true,
				responsive: [
					{
						breakpoint: 1023,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					}
				]
			});
		}
	});

	function fixVerticalArrows(event){
		var h =  $(event.target).find('.slick-active img').height()/2;
		$(event.target).find('.slick-arrow').css('top',h+'px');
	}

}(jQuery));
