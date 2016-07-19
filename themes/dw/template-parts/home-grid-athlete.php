<?php
$thumbnail_id = get_post_thumbnail_id( $post->ID );
$thumbnail_small = wp_get_attachment_image_src($thumbnail_id, 'grid-small');
$thumbnail_medium = wp_get_attachment_image_src($thumbnail_id, 'grid-medium');

$position = get_field('position', $post->ID );
?>

<div class="slider__item">
	<article class="card entry entry--athlete text-xs-center  m-b-0">
		<div class="img-wrapper">
			<?php if( !empty( $position ) ): ?>
				<p class="category"><?php echo $position; ?></p>
			<?php endif; ?>
			<a href=""><img alt="" srcset="<?php echo $thumbnail_small[0]; ?> 224w, <?php echo $thumbnail_medium[0]; ?> 263w" sizes="(min-width: 480px) 50vw, 100vw" class="img-fluid"></a>
		</div><!-- img-wrapper -->
		<div class="card-block">
			<h2 class="entry__title"><a href=""><?php the_title(); ?></a></h2>
			<p class="entry__text card-text"><?php the_excerpt(); ?></p>
		</div><!-- card-block -->
	</article><!-- card -->
</div><!-- slider__item -->