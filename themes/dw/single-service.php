<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dynamic_Winners
 */

get_header();

$main_image_id = get_field('main_image');
$thumbnail_small = wp_get_attachment_image_src($main_image_id, 'grid-small');
$thumbnail_medium = wp_get_attachment_image_src($main_image_id, 'grid-medium');
$thumbnail_large = wp_get_attachment_image_src($main_image_id, 'full');
?>


<section class="featured-image">
	<div class="featured-image__overlay"></div>
</section>

	<!-- PRIMARY SECTION
	========================================================= -->
	<div class="band band--primary">
		<main id="content" class="section">

			<!-- POST
			========================================================= -->
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="post">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<img alt="" srcset="echo $thumbnail_small[0]; ?> 224w, <?php echo $thumbnail_medium[0]; ?> 263w, <?php echo $thumbnail_large[0]; ?> 520w" sizes="(min-width: 480px) 50vw, 100vw" class="post__main-photo img-fluid">
						</div><!-- col -->
						<div class="col-md-6">
							<header class="post__header">
								<h3 class="post__title"><?php echo get_the_title(); ?></h3>
								<?php echo dw_posted_on(); ?>
							</header><!-- post-header -->
							<div class="post__body"><?php the_content(); ?></div><!-- post-body -->
						</div><!-- col -->
					</div><!-- row -->
				</div><!-- container -->
			</article><!-- post -->
			<?php endwhile; ?>
			<?php  $all_services = dynamic_get_all_services(array(get_the_ID()));

			?>
			<!-- LATEST POSTS
			========================================================= -->
			<section id="latest-posts" class="band section">
				<div class="container">
					<div class="row">
						<div class="col-sm-11 col-sm-offset-1 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 box-right">
							<div class="slider">
								<?php while( $all_services->have_posts() ) : $all_services->the_post(); ?>

									<div class="slider__item">
										<article class="entry entry--latest">
											<h2 class="entry__title"><a href="<?php echo  get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<a href="<?php echo  get_the_permalink(); ?>" class="entry__read-more">Ver mais</a>
										</article><!-- entry -->
									</div><!-- slider__item -->
								<?php
								endwhile;
								wp_reset_postdata();
								?>

							</div><!-- slider -->
						</div><!-- col -->
					</div><!-- row -->
				</div><!-- container -->
			</section><!-- latest-posts -->

			<div class="band">
				<div class="container text-xs-right">
					<?php echo dw_share_buttons( esc_html__( 'Share', 'dw' ), get_permalink(), get_the_title() ); ?>
				</div><!-- container -->
			</div><!-- band -->

		</main><!-- content -->
	</div><!-- band--primary -->

<?php
get_template_part( 'template-parts/singles', 'footer' );
get_footer();
