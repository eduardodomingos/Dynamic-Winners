<?php
/**
 * Header
 * @package globalway
 */
?>
<?php

	$body_class = '';
	if( is_home() || is_front_page() ){
		$body_class = 'home';
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
	</head>
	<body <?php body_class($body_class); ?>>
		<header class="page-head">
			<div class="wrapper clearfix">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
					<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/logo-dw.svg" alt="Dynamic Winners" class="logo__img">
				</a><!-- logo -->
				<div class="pull-lg-right clearfix">
					<nav class="site-nav">
						<button class="site-nav__toggle"><span class="sr-only"><?php esc_html_e( 'Menu', 'dw' ); ?></span></button>
						<div class="site-nav__list">
							<ul>
								<?php echo dynamic_get_nav_menu_main(); ?>
							</ul>
						</div><!-- site-nav__list-->
					</nav><!-- site-nav-->

					<?php wp_nav_menu( array( 'theme_location' => 'social_header', 'container'=> false, 'menu_id' => 'social-menu', 'menu_class' => 'social', 'link_before' => '<span class="sr-only">', 'link_after' => '</span>' ) ); ?>

					<nav class="languages-nav">
						<ul class="languages-nav__list">
							<li class="languages-nav__item">
								<a href="" class="languages-nav__link languages-nav__link--current">pt</a>
							</li>
							<li class="languages-nav__item">
								<a href="" class="languages-nav__link">en</a>
							</li>
						</ul><!-- languages-nav__list-->
					</nav><!-- languages-nav -->
				</div><!-- pull -->

			</div><!-- wrapper -->
	</header><!-- page-head -->
