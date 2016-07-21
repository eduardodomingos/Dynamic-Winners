<?php
$main_image_id = get_field('main_image');
$thumbnail_small = wp_get_attachment_image_src($main_image_id, 'grid-small');
$thumbnail_medium = wp_get_attachment_image_src($main_image_id, 'grid-medium');
?>

<div class="slider__item">
	<article class="card entry m-b-0">
		<a href="<?php echo esc_url( get_permalink()); ?>"><img alt="" srcset="<?php echo $thumbnail_small[0]; ?> 224w, <?php echo $thumbnail_medium[0]; ?> 263w" sizes="(min-width: 480px) 50vw, 100vw" class="img-fluid"></a>
		<div class="card-block p-l-0 p-r-0 p-b-0">
			<?php echo dw_posted_on(); ?>
			<h2 class="entry__title"><a href="<?php echo esc_url( get_permalink()); ?>"><?php echo get_the_title(); ?></a></h2>
			<div class="dotdotdot">
				<p class="entry__text card-text"><?php echo get_the_excerpt(); ?></p>
			</div><!-- dotdotdot -->
			<a href="<?php echo esc_url( get_permalink()); ?>" class="entry__read-more">Ver mais</a>
		</div><!-- card-block -->
	</article><!-- card -->
</div><!-- slider__item -->
