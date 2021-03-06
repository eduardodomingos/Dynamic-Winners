<?php
/**
 * Header
 * @package globalway
 */
?>
<?php

	$body_class = '';
	if( is_home() || is_front_page() ){
		$body_class = 'page--home';
	}
	elseif(is_singular('post')) {
		$body_class = 'page--news';
	}
	elseif(is_singular('service')) {
		$body_class = 'page--services';
	}
	elseif(is_singular('athlete')) {
		$body_class = 'page--athlete';
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--[if lt IE 9]>
		<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
		<script src="//cdn.jsdelivr.net/selectivizr/1.0.3b/selectivizr.min.js"></script>
		<![endif]-->

		<?php wp_head(); ?>

		<script>
			// Picture element HTML5 shiv
			document.createElement( "picture" );
		</script>
		<script src="<?php echo get_bloginfo('template_directory');?>/assets/build/js/picturefill.js" async></script>

	</head>
	<body <?php body_class($body_class); ?>>
		<header class="page-head">
			<div class="wrapper clearfix">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
					<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/logo-dw.svg" alt="Dynamic Winners" class="logo__img">
				</a><!-- logo -->
				<div class="pull-lg-right clearfix">
					<nav class="site-nav">

						<button type="button" class="site-nav__toggle tcon tcon-menu--xcross" aria-label="toggle menu">
							<span class="tcon-menu__lines" aria-hidden="true"></span>
							<span class="tcon-visuallyhidden"><?php esc_html_e( 'Menu', 'dw' ); ?></span>
						</button>

						<div class="site-nav__list">
							<ul>
								<?php echo dynamic_get_nav_menu_main(); ?>
							</ul>
						</div><!-- site-nav__list-->
					</nav><!-- site-nav-->

					<?php wp_nav_menu( array( 'theme_location' => 'social_header', 'container'=> false, 'menu_id' => 'social-menu', 'menu_class' => 'social', 'link_before' => '<span class="sr-only">', 'link_after' => '</span>' ) ); ?>


					<?php
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Custom Widget Area') ) : ?>
					<?php endif; ?>

				</div><!-- pull -->

			</div><!-- wrapper -->
	</header><!-- page-head -->
