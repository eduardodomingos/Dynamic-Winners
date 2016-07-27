<?php
$main_image_id = get_field('main_image');

$thumbnail_small = wp_get_attachment_image_src($main_image_id, 'grid-small');
$thumbnail_medium = wp_get_attachment_image_src($main_image_id, 'grid-medium');

$position = __(dw_get_athlete_positions( $post->ID ), 'dw');
?>

<?php if($is_slider):?>
<div class="slider__item">
<?php endif; ?>
	<article class="card entry entry--athlete text-xs-center m-b-0 <?php echo $is_last ? 'last' : ''; ?>">
		<a href="<?php echo get_the_permalink();?>"><img alt="" srcset="<?php echo $thumbnail_small[0]; ?> 224w, <?php echo $thumbnail_medium[0]; ?> 263w" sizes="(min-width: 480px) 50vw, 100vw" class="img-fluid"></a>
		<div class="card-block p-l-0 p-r-0">
			<h2 class="entry__title"><a href="<?php echo get_the_permalink();?>"><?php echo get_the_title(); ?></a></h2>
			<?php if( !empty( $position ) ): ?>
				<p class="category"><?php echo implode(' / ', $position); ?></p>
			<?php endif; ?>
		</div><!-- card-block -->
	</article><!-- card -->
<?php if($is_slider):?>
</div><!-- slider__item -->
<?php endif; ?>
