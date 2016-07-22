<?php

$home_id = dynamic_get_active_homepage();
$phone = get_field('phone', $home_id );
$email = get_field('email', $home_id );
?>
<section id="contacts" class="band section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8 col-lg-offset-2">
				<div class="section__header">
					<h2 class="heading"><?php esc_html_e( 'Contact us', 'dw' ); ?></h2>
				</div><!-- section__header -->
				
				<?php
				if (qtranxf_getLanguage() == 'en') {
					echo do_shortcode('[contact-form-7 id="4" title="Contact form EN" html_class="contact-form"]');
				} elseif (qtranxf_getLanguage() == 'pt') {
					echo do_shortcode('[contact-form-7 id="474" title="Contact form PT" html_class="contact-form"]');
				}
				?>

				<?php wp_nav_menu( array( 'theme_location' => 'social_footer', 'container'=> false, 'menu_id' => 'social-menu', 'menu_class' => 'social text-xs-center', 'link_before' => '<span class="sr-only">', 'link_after' => '</span>' ) ); ?>

				<div class="text-xs-center">
					<p><a href="tel:+<?php echo str_replace(' ', '', $phone); ?>" class="contacts__link">+<?php echo $phone; ?></a></p>
					<p><a href="mailto:geral@dynamicwinners.com" class="contacts__link"><?php echo $email; ?></a></p>
				</div>
			</div><!-- col -->
		</div><!-- row -->
	</div><!-- container -->
</section><!-- contacts -->
