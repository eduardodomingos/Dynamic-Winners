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


$athlete_info = array('formation' => 'Formação', 'career' => 'Carreira', 'prizes' => 'Palmarés', 'managers' => 'Treinadores');
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
						<li class="social__item social__item--facebook-squared">
							<a href="" class="social__link"><span class="sr-only">Facebook</span></a>
						</li>
						<li class="social__item social__item--instagram">
							<a href="" class="social__link"><span class="sr-only">Instagram</span></a>
						</li>
					</ul><!-- social -->
				</div>

			</header><!-- athlete__head -->
			<div class="athlete__body band section">
				<div class="container">
					<div class="athlete__slider">
						<div class="slider slider--athlete slider-nav">
							<div class="slider__item">
								<div class="card m-b-0 text-xs-center">
									<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-biography.svg" alt="biography icon" class="card-img-top img-fluid">
									<div class="card-block p-l-0 p-r-0">
										<p class="card-text">Biografia</p>
									</div>
								</div><!-- card -->
							</div><!-- slider__item -->
							<div class="slider__item">
								<div class="card m-b-0 text-xs-center">
									<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-academic.svg" alt="academic icon" class="card-img-top img-fluid">
									<div class="card-block p-l-0 p-r-0">
										<p class="card-text">Formação</p>
									</div>
								</div><!-- card -->
							</div><!-- slider__item -->
							<div class="slider__item">
								<div class="card m-b-0 text-xs-center">
									<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-career.svg" alt="career icon" class="card-img-top img-fluid">
									<div class="card-block p-l-0 p-r-0">
										<p class="card-text">Carreira</p>
									</div>
								</div><!-- card -->
							</div><!-- slider__item -->
							<div class="slider__item">
								<div class="card m-b-0 text-xs-center">
									<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-achievments.svg" alt="achievments icon" class="card-img-top img-fluid">
									<div class="card-block p-l-0 p-r-0">
										<p class="card-text">Palmarés</p>
									</div>
								</div><!-- card -->
							</div><!-- slider__item -->
							<div class="slider__item">
								<div class="card m-b-0 text-xs-center">
									<img src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-managers.svg" alt="manager icon" class="card-img-top img-fluid">
									<div class="card-block p-l-0 p-r-0">
										<p class="card-text">Treinadores</p>
									</div>
								</div><!-- card -->
							</div><!-- slider__item -->
						</div><!-- slider-nav -->
						<div class="slider slider-for">
							<div class="slider__item">
								<div class="row">
									<div class="col-sm-12">
										<div class="col-md-5">
											<div class="media">
												<a class="media-left" href="#">
													<img class="media-object" src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-biography.svg" alt="biography icon">
												</a><!-- media-left -->
												<div class="media-body">
													<h4 class="media-heading">Biografia</h4>
												</div><!-- media-body -->
											</div><!-- media -->
										</div><!-- col -->
										<div class="col-md-7">
											<div class="col-lg-6">
												<p>Nome: <?php echo $biography['name'] ?><br>
													<?php if( !empty( $biography['team'] ) ){ ?>
														Equipa: <?php echo $biography['team']; ?><br>
													<?php } ?>
													<?php if( isset( $biography['position'] ) ) : ?>
														Posição: <?php echo implode('/', $biography['position']); ?><br>
													<?php endif; ?>
													<?php if( !empty( $biography['birthday'] ) ){ ?>
													Data de nascimento: <?php echo $biography['birthday']; ?></p>
												<?php } ?>
											</div><!-- col -->
											<div class="col-lg-6">
												<p><?php if( !empty( $biography['origin'] ) ){ ?>
														Nacionalidade: <?php echo $biography['origin']; ?><br>
													<?php }
													if( !empty( $biography['height'] ) ){ ?>
														Altura: <?php echo $biography['height']; ?> cm<br>
													<?php }
													if( !empty( $biography['weight'] ) ){ ?>
													Peso: <?php echo $biography['weight']; ?> kg</p>
												<?php } ?>
											</div><!-- col -->
										</div><!-- col -->
									</div><!-- col -->
								</div><!-- row -->
							</div><!-- slider__item -->

							<?php foreach( $athlete_info as $field => $name ){ ?>
							<?php if( !empty( get_field($field) ) ) : ?>
							<div class="slider__item">
								<div class="row">
									<div class="col-sm-12 col-md-4 col-lg-4 col-lg-offset-0 hidden-sm-down">
										<div class="media">
											<a class="media-left" href="#">
												<img class="media-object" src="<?php echo get_bloginfo('template_directory');?>/assets/build/img/icon-academic.svg" alt="academic icon">
											</a>
											<div class="media-body">
												<h4 class="media-heading"><?php echo $name; ?></h4>
											</div>
										</div>
									</div><!-- col -->
									<div class="col-sm-12 col-md-8 col-md-offset-4 col-lg-4 col-lg-offset-0">
										<?php echo get_field($field); ?>
									</div><!-- col -->
								</div><!-- row -->
							</div><!-- slider__item -->
							<?php endif; ?>
							<?php } ?>

						</div><!-- slider-for -->
					</div><!-- athlete__slider -->
				</div><!-- container -->
			</div><!-- athlete__body -->

			<div class="athlete__media section">
				<div class="container">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#photos" role="tab">Galeria</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#video" role="tab">Vídeo</a>
						</li>
					</ul><!-- nav-tabs -->
				</div><!-- container -->

				<div class="tab-content-container">
					<div class="tab-content">
						<div class="tab-pane active" id="photos" role="tabpanel">
							<?php echo get_field('athlete_gallery'); ?>
						</div>
						<div class="tab-pane" id="video" role="tabpanel">
							<?php $videos = get_field('athlete_videos');
							$split  = preg_split('/\r\n|[\r\n]/', $videos);
							//echo wp_oembed_get($video);
							?>
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
