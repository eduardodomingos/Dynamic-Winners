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
				dots: true
			});

			// Services Slider DotDotDot
			dom.$homeServicesSlider.on('init', function(event, slick){
				dom.$homeServicesSlider.find('.dotdotdot').dotdotdot({
					height: 63,
					watch: true
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
						height: 63,
						watch: true
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

				// Athletes Slider DotDotDot
				dom.$homeAthletesSlider.on('init', function(event, slick){
					dom.$homeAthletesSlider.find('.dotdotdot').dotdotdot({
						height: 63,
						watch: true
					});
				});
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

			// Load more athletes
			$('#athletes .js-load-more-athletes').click(function (e) {
				e.preventDefault();
				//dom.$loadingAnimation.show();

				var $activeTab = $('#athletes .tab-pane.active');
				var $loading = $activeTab.find('.js-loader');
				$loading.show();
				var context = $activeTab.attr('id');
				var $loadContainer = $activeTab.find('.loadMoreContainer');

				var dummyHtml = '<article class="card entry entry--athlete text-xs-center m-b-0">';
					dummyHtml += '<div class="img-wrapper">';
					dummyHtml += '<a href="http://localhost:8888/athlete/anderson-talisca/" tabindex="0"><img alt="" srcset="http://localhost:8888/wp-content/uploads/2016/07/456702062_520x390_acf_cropped-224x168.jpg 224w, http://localhost:8888/wp-content/uploads/2016/07/456702062_520x390_acf_cropped-263x197.jpg 263w" sizes="(min-width: 480px) 50vw, 100vw" class="img-fluid"></a>';
					dummyHtml += '</div><!-- img-wrapper -->';
					dummyHtml += '<div class="card-block">';
					dummyHtml += '<h2 class="entry__title"><a href="http://localhost:8888/athlete/anderson-talisca/" tabindex="0">Anderson Talisca</a></h2>';
					dummyHtml += '<div class="dotdotdot">';
					dummyHtml += '<p class="entry__text card-text"></p>';
					dummyHtml += '</div><!-- dotdotdot -->';
					dummyHtml += '</div><!-- card-block -->';
					dummyHtml += '</article>';

				// Fake set time out simulates the response time
				setTimeout(function(){
					$loadContainer.append(dummyHtml);
					$loading.hide();
				}, 2000);
				
			});


			// On window resize:
			$(window).resize(function(event){
				dom.$homeNewsSlider.trigger('afterChange');
				dom.$homeAthletesSlider.trigger('afterChange');
			});

		} // end Homepage JS


		/*
		 * Single Services
		 */
		if(dom.$body.hasClass('single-service')) {
			// Latest posts slider
			$('#latest-posts .slider').slick({
				mobileFirst: true,
				responsive: [
					{
						breakpoint: 1023,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					}
				]
			});
		}



		/*
		 * Single Pages
		 */
		if(dom.$body.hasClass('single-post')) {
			// Latest posts slider
			// $('#latest-posts .slider').slick({
			// 	mobileFirst: true
			// });

			// Athlete slider
			// $('.athlete__slider .slider-for').slick({
			// 	slidesToShow: 1,
			// 	slidesToScroll: 1,
			// 	arrows: false,
			// 	fade: true,
			// 	asNavFor: '.athlete__slider .slider-nav'
			// });

			// $('.athlete__slider .slider-nav').slick({
			// 	mobileFirst: true,
			// 	slidesToShow: 1,
			// 	slidesToScroll: 1,
			// 	asNavFor: '.athlete__slider .slider-for',
			// 	centerMode: false,
			// 	focusOnSelect: true,
			// 	responsive: [
			// 		{
			// 			breakpoint: 479,
			// 			settings: {
			// 				slidesToShow: 3,
			// 				slidesToScroll: 1
			// 			}
			// 		},
			// 		{
			// 			breakpoint: 1023,
			// 			settings: {
			// 				slidesToShow: 5,
			// 				slidesToScroll: 1
			// 			}
			// 		}
			// 	]
			// });

		}



		/*
		 * Article share buttons
		 */
		if( dom.$body.hasClass('single-post') || dom.$body.hasClass('single-service') ) {
			var $share = $('.share-this'); // cache share
			if ( $share.length ) {

				// Facebook
				$share.find('.link-share-facebook').on('click', function(e){
					e.preventDefault();
					window.open( $(this).attr('href'), 'sharer', 'toolbar=0,status=0,width=548,height=325');
				});

				// Twitter Share
				$share.find('.link-share-twitter').on('click', function(e){
					e.preventDefault();
					window.open( $(this).attr('href'), 'twitter', 'toolbar=0,status=0,width=548,height=325');
				});

				// Share Google Plus
				$share.find('.link-share-gplus').on('click', function(e){
					e.preventDefault();
					window.open( $(this).attr('href'), 'gplus', 'toolbar=0,status=0,width=548,height=325');
				});

				// Share LinkedIn
				$share.find('.link-share-in').on('click', function(e){
					e.preventDefault();
					window.open( $(this).attr('href'), 'LinkedIn','toolbar=0,status=0,width=520,height=570');
				});

				// Show share WhatsApp only on iOS devices
				// if ( navigator.userAgent && navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)/i) ) {
				//   $share.find('.link-share-whatsapp').show();
				// }

			}
		}



		/*
		 * Athlete Page Code
		 */
		if(dom.$body.hasClass('athlete')) {
			// Gallery
			// $('.athlete__media .slider').slick({
			// 	mobileFirst: true,
			// 	responsive: [
			// 		{
			// 			breakpoint: 1023,
			// 			settings: {
			// 				slidesToShow: 2,
			// 				slidesToScroll: 2
			// 			}
			// 		}
			// 	]
			// });
		}
	});

	function fixVerticalArrows(event){
		var h =  $(event.target).find('.slick-active img').height()/2;
		$(event.target).find('.slick-arrow').css('top',h+'px');
	}

}(jQuery));
