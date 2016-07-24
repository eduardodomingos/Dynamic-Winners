<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Dynamic_Winners
 */

get_header(); ?>
	<section class="featured-image">
		<div class="featured-image__overlay"></div>
	</section>


	<!-- PRIMARY SECTION
        ========================================================= -->
	<div class="band band--primary">
		<main id="content" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-xs-center lead">
						<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'dw' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go back home', 'dw' ); ?></a>
					</div><!-- col -->
				</div><!-- row -->
			</div><!-- container -->
		</main>
	</div><!-- band--primary -->


<?php
get_template_part( 'template-parts/singles', 'footer' );
get_footer();
