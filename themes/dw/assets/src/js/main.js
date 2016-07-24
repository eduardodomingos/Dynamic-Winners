(function($) {

	$(window).load(function(){
		// Fade body in
		$('body.home').addClass('active');
	});

	$(document).ready(function(){
		/*
		 * Cache references for DOM elements
		 */
		var dom = {
			$window: 					$(window),
			$body:	 					$('body'),
			$navLinks:					$('a.site-nav__link[href^=#]'),
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
		dom.$menuToggle.click(function(e){
			var menuHeight = dom.$siteNavListList.outerHeight();
			if(dom.$siteNav.hasClass('site-nav--active')) {
				dom.$siteNav.removeClass('site-nav--active');
				dom.$siteNavList.css('max-height', 0);
			} else {
				dom.$siteNav.toggleClass('site-nav--active');
				dom.$siteNavList.css('max-height', menuHeight);
			}
		});





		// Throttle window scroll for performace
		var throttled = _.throttle(updatePosition, 100);
		dom.$window.scroll(throttled);

		// Fix menu
		var isFixed = false;
		var isVisible = false;

		// Throttle callback
		function updatePosition() {
			var current_scroll_top = dom.$window.scrollTop();
			//console.log(current_scroll_top);
			if( window.matchMedia('(min-width: 1024px)').matches ) {
				if(isFixed === false) {
					if( current_scroll_top >= 285 ) {
						$('body').addClass('page-head-is-fixed');
						isFixed = true;
					}
				}

				if( isFixed === true && isVisible === false ) {
					if( current_scroll_top < 285 ) {
						$('body').removeClass('page-head-is-fixed');
						isFixed = false;
					}
					if(current_scroll_top >= 560) {
						$('body').addClass('page-head-is-visible');
						isVisible = true;
					}
				}

				if(isFixed === true && isVisible === true) {
					if(current_scroll_top < 560) {
						$('body').removeClass('page-head-is-visible');
						isVisible = false;
					}
				}

			} else {
				if(isFixed === false) {
					if( current_scroll_top >= 200) {
						$('body').addClass('page-head-is-fixed');
						isFixed = true;
					}
				}
				if( isFixed === true && isVisible === false ) {
					if( current_scroll_top < 200 ) {
						$('body').removeClass('page-head-is-fixed');
						isFixed = false;
					}
					if(current_scroll_top >= 480) {
						$('body').addClass('page-head-is-visible');
						isVisible = true;
					}
				}
				if(isFixed === true && isVisible === true) {
					if(current_scroll_top < 480) {
						$('body').removeClass('page-head-is-visible');
						isVisible = false;
					}
				}
			}
		}




		/*
		 * Homepage Code
		 */
		if(dom.$body.hasClass('home')) {

			/*
			 * Smooth scroll
			 */
			$('.site-nav__link').attr('data-scroll', true);
			smoothScroll.init();
			if ( window.location.hash ) {
				var hash = smoothScroll.escapeCharacters( window.location.hash ); // Escape the hash
				var toggle = document.querySelector( 'a[href*="' + hash + '"]' ); // Get the toggle (if one exists)
				var options = {
					speed: 1000,
				}; // Any custom options you want to use would go here
				smoothScroll.animateScroll( hash, toggle, options );
			}

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
			/*
			 * LOAD POSTS AJAX
			 */
			var $content;
			$('.js-load-more').click(function(e) {
				e.preventDefault();
				$content = $(this).parent().siblings('.loadMoreContainer');
				var postType = $(this).data('post-type');
				var postTax = $(this).data('post-taxonomy');
				var numPosts = $(this).data('display-posts');

				if(!$(this).hasClass('is-loading') && !$(this).hasClass('done'))  {
					$(this).addClass('is-loading');
					var page = $(this).data().page++
					load_posts( $(this) , postType, postTax, numPosts, page);
				}
			});

			function load_posts( $this, postType, postTax, numPosts, page ) {
				$.ajax({
					url: dwjs.ajaxurl,
					type: 'post',
					data: {
						action: 'ajax_pagination',
						postType: postType,
						postTax: postTax,
						numPosts: numPosts,
						page: page
					},
					dataType   : "html",
					beforeSend : function(){
						$this.siblings('.js-loader').show();
					},
					success: function( data ) {
						$data = $(data);
						if(!$content.hasClass('active')) {
							$content.addClass('active');
						}
						$content.append($data);
						$this.removeClass('is-loading');
						$this.siblings('.js-loader').hide();
						if($content.find('article.last').length > 0) {
							$this.addClass('done');
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						// Error stuff here
					}
				});
			}

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
		if(dom.$body.hasClass('single-athlete')) {
			// Athlete slider
			$('.athlete__slider .slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				adaptiveHeight: true,
				asNavFor: '.athlete__slider .slider-nav'
			});

			$('.athlete__slider .slider-nav').slick({
				mobileFirst: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				asNavFor: '.athlete__slider .slider-for',
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

			// Gallery and Videos
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
