<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dynamic_Winners
 */

get_header();

$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
$thumbnail_small = wp_get_attachment_image_src($thumbnail_id, 'grid-small');
$thumbnail_medium = wp_get_attachment_image_src($thumbnail_id, 'grid-medium');
$biography = dw_get_athlete_biography();

$athlete_id = get_the_ID();

$athlete_info = array(
	'formation' => array( 'name' => __( 'Training', 'dw' ), 'icon' => 'icon-academic-1' ),
	'career' => array( 'name' => __( 'Career', 'dw' ), 'icon' => 'icon-career-1' ),
	'prizes' => array( 'name' => __( 'Awards', 'dw' ), 'icon' => 'icon-history-1' ),
	'managers' => array( 'name' => __( 'Coaches', 'dw' ), 'icon' => 'icon-managers-1' ),
	);
?>

<section class="featured-image">
	<div class="featured-image__overlay"></div>
</section>

	<!-- PRIMARY SECTION
	========================================================= -->

	<main id="content" class="section">
		<!-- ATHLETE
		========================================================= -->
		<?php while ( have_posts() ) : the_post(); ?>
		<section class="athlete">
			<header class="athlete__head">
				<div class="bg"></div>

				<div class="content">
					<h1 class="athlete__name"><?php echo get_field('name'); ?></h1>
					<?php if( isset($biography['position']  ) ) : ?>
						<ul class="athlete__main-features">
							<?php foreach( $biography['position'] as $position ){ ?>
								<li><?php echo $position; ?></li>
							<?php } ?>
						</ul>
					<?php endif; ?>
					<ul class="social">
						<?php $facebook = get_field('facebook', $athlete_id);
						if( !empty( $facebook ) ) : ?>
							<li class="social__item social__item--facebook-squared">
								<a href="<?php echo $facebook; ?>" class="social__link"><span class="sr-only">Facebook</span></a>
							</li>
						<?php endif; ?>
						<?php $instagram = get_field('instagram', $athlete_id);
						if( !empty( $instagram ) ) : ?>
							<li class="social__item social__item--instagram">
								<a href="<?php echo $instagram; ?>" class="social__link"><span class="sr-only">Instagram</span></a>
							</li>
						<?php endif; ?>
					</ul><!-- social -->
				</div>

			</header><!-- athlete__head -->
			<div class="athlete__body band section">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2">
							<div class="athlete__slider">
								<div class="slider slider--athlete slider-nav">
									<div class="slider__item">
										<div class="card m-b-0 text-xs-center">
											<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-bio-2.svg" alt="biography icon" class="card-img-top img-fluid">
											<div class="card-block p-l-0 p-r-0">
												<p class="card-text"><?php esc_html_e( 'Biography', 'dw' ); ?></p>
											</div>
										</div><!-- card -->
									</div><!-- slider__item -->
									<?php $field_content = get_field( 'formation', $athlete_id); ?>
									<?php if( !empty( $field_content ) ) : ?>
									<div class="slider__item">
										<div class="card m-b-0 text-xs-center">
											<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-academic-2.svg" alt="academic icon" class="card-img-top img-fluid">
											<div class="card-block p-l-0 p-r-0">
												<p class="card-text"><?php esc_html_e( 'Training', 'dw' ); ?></p>
											</div>
										</div><!-- card -->
									</div><!-- slider__item -->
									<?php endif; ?>
									<?php $field_content = get_field( 'career', $athlete_id); ?>
									<?php if( !empty( $field_content ) ) : ?>
									<div class="slider__item">
										<div class="card m-b-0 text-xs-center">
											<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-career-2.svg" alt="career icon" class="card-img-top img-fluid">
											<div class="card-block p-l-0 p-r-0">
												<p class="card-text"><?php esc_html_e( 'Career', 'dw' ); ?></p>
											</div>
										</div><!-- card -->
									</div><!-- slider__item -->
									<?php endif; ?>
									<?php $field_content = get_field( 'prizes', $athlete_id); ?>
									<?php if( !empty( $field_content ) ) : ?>
									<div class="slider__item">
										<div class="card m-b-0 text-xs-center">
											<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-history-2.svg" alt="achievments icon" class="card-img-top img-fluid">
											<div class="card-block p-l-0 p-r-0">
												<p class="card-text"><?php esc_html_e( 'Awards', 'dw' ); ?></p>
											</div>
										</div><!-- card -->
									</div><!-- slider__item -->
									<?php endif; ?>
									<?php $field_content = get_field( 'managers', $athlete_id); ?>
									<?php if( !empty( $field_content ) ) : ?>
									<div class="slider__item">
										<div class="card m-b-0 text-xs-center">
											<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-managers-2.svg" alt="manager icon" class="card-img-top img-fluid">
											<div class="card-block p-l-0 p-r-0">
												<p class="card-text"><?php esc_html_e( 'Coaches', 'dw' ); ?></p>
											</div>
										</div><!-- card -->
									</div><!-- slider__item -->
									<?php endif; ?>
								</div><!-- slider-nav -->

								<div class="row">
									<div class="col-sm-12">
										<div class="slider slider-for">
											<div class="slider__item">
												<div class="row band">

													<div class="col-md-5 col-lg-4">
														<div class="media hidden-sm-down">
															<a class="media-left" href="#">
																<img class="media-object" src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-bio-1.svg" alt="biography icon">
															</a><!-- media-left -->
															<div class="media-body">
																<h4 class="media-heading"><?php esc_html_e( 'Biography', 'dw' ); ?></h4>
															</div><!-- media-body -->
														</div><!-- media -->
													</div><!-- col -->
													<div class="col-md-7 col-lg-8">
														<div class="col-lg-6">
															<p><?php esc_html_e( 'Name', 'dw' ); ?>: <?php echo $biography['name'] ?><br>
																<?php if( !empty( $biography['team'] ) ){ ?>
																	<?php esc_html_e( 'Team', 'dw' ); ?>: <?php echo $biography['team']; ?><br>
																<?php } ?>
																<?php if( isset( $biography['position'] ) ) : ?>
																	<?php esc_html_e( 'Position', 'dw' ); ?>: <?php echo implode('/', $biography['position']); ?><br>
																<?php endif; ?>
																<?php if( !empty( $biography['birthday'] ) ){ ?>
																<?php esc_html_e( 'Birthday', 'dw' ); ?>: <?php echo $biography['birthday']; ?></p>
															<?php } ?>
														</div><!-- col -->
														<div class="col-lg-6">
															<p><?php if( !empty( $biography['origin'] ) ){ ?>
																	<?php esc_html_e( 'Nationality', 'dw' ); ?>: <?php echo $biography['origin']; ?><br>
																<?php }
																if( !empty( $biography['height'] ) ){ ?>
																	<?php esc_html_e( 'Height', 'dw' ); ?>: <?php echo $biography['height']; ?> cm<br>
																<?php }
																if( !empty( $biography['weight'] ) ){ ?>
																<?php esc_html_e( 'Weight', 'dw' ); ?>: <?php echo $biography['weight']; ?> kg</p>
															<?php } ?>
														</div><!-- col -->
													</div><!-- col -->

												</div><!-- row -->
											</div><!-- slider__item -->

											<?php foreach( $athlete_info as $field => $options ){ ?>
											<?php $field_content = get_field( $field, $athlete_id); ?>
											<?php if( !empty( $field_content ) ) : ?>
													<?php
													$opts = array('name' => $options['name'], 'content' => $field_content, 'icon_name' => $options['icon']);

													dynamic_get_template_part('template-parts/athlete', 'features', $opts); ?>
											<?php endif; ?>
											<?php } ?>

										</div><!-- slider-for -->
									</div>
								</div>
							</div><!-- athlete__slider -->

						</div><!-- col -->
					</div><!-- row -->
				</div><!-- container -->
			</div><!-- athlete__body -->

			<div class="athlete__media section">
				<div class="container">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#photos" role="tab"><?php esc_html_e( 'Gallery', 'dw' ); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#video" role="tab"><?php esc_html_e( 'Video', 'dw' ); ?></a>
						</li>
					</ul><!-- nav-tabs -->
				</div><!-- container -->

				<div class="tab-content-container">
					<div class="tab-content">
						<div class="tab-pane active" id="photos" role="tabpanel">
							<?php echo get_field('athlete_gallery'); ?>
						</div>
						<div class="tab-pane" id="video" role="tabpanel">
							<div class="slider">
							<?php $videos = get_field('athlete_videos');
							$split  = preg_split('/\r\n|[\r\n]/', $videos);
							foreach( $split as $video ){ ?>
								<div class="slider__item">
									<?php echo wp_oembed_get($video); ?>
								</div>
							<?php } ?>
							</div>
						</div>
					</div><!-- tab-content -->
				</div><!-- container -->

			</div><!-- athlete__media -->
		</section><!-- athlete -->


		<?php endwhile; ?>
	</main><!-- content -->

<?php
get_template_part( 'template-parts/singles', 'footer' );
get_footer();
