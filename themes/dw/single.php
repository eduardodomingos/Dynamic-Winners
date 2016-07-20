<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

			<!-- POST
			========================================================= -->
			<article class="post">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<img alt="" srcset="http://placehold.it/260x195?text=4:3 260w, http://placehold.it/240x180?text=4:3 240w, , http://placehold.it/1000x750?text=4:3 1000w" sizes="(min-width: 480px) 50vw, 100vw" class="post__main-photo img-fluid">
						</div><!-- col -->
						<div class="col-md-6">
							<header class="post__header">
								<p class="post__category">Regionais 2016</p>
								<h3 class="post__title"><?php the_title(); ?></h3>
								<p class="post__date">27 jun 2016</p>
							</header><!-- post-header -->
							<div class="post__body"><?php the_body(); ?></div><!-- post-body -->
						</div><!-- col -->
					</div><!-- row -->
				</div><!-- container -->
			</article><!-- post -->

			<!-- LATEST POSTS
			========================================================= -->
			<section id="latest-posts" class="band section">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-9 col-md-offset-2 col-lg-6 col-lg-offset-6 box-right">
							<div class="slider">

								<div class="slider__item">
									<article class="entry entry--latest">
										<p class="entry__date">12 out 2016</p>
										<h2 class="entry__title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias delectus, enim harum inventore officia perferendis tenetur? Accusamus aut beatae deserunt dolore earum facere laudantium officiis quas quis, rerum soluta.</h2>
										<a href="" class="entry__read-more">Ver notícia</a>
									</article><!-- entry -->
								</div><!-- slider__item -->
								<div class="slider__item">
									<article class="entry entry--latest">
										<p class="entry__date">12 out 2016</p>
										<h2 class="entry__title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias delectus, enim harum inventore officia perferendis tenetur? Accusamus aut beatae deserunt dolore earum facere laudantium officiis quas quis, rerum soluta.</h2>
										<a href="" class="entry__read-more">Ver notícia</a>
									</article><!-- entry -->
								</div><!-- slider__item -->

							</div><!-- slider -->
						</div><!-- col -->
					</div><!-- row -->
				</div><!-- container -->
			</section><!-- latest-posts -->
		</main><!-- content -->
	</div><!-- band--primary -->

<?php
get_sidebar();
get_footer();
