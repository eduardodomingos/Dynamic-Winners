<?php
$main_image_id = get_field('main_image');

$thumbnail_small = wp_get_attachment_image_src($main_image_id, 'grid-small');
$thumbnail_medium = wp_get_attachment_image_src($main_image_id, 'grid-medium');

$position = get_field('position', $post->ID );
?>

<?php if($is_slider):?>
<div class="slider__item">
<?php endif; ?>
	<article class="card entry entry--athlete text-xs-center m-b-0">
		<div class="img-wrapper">
			<?php if( !empty( $position ) ): ?>
				<p class="category"><?php echo $position; ?></p>
			<?php endif; ?>
			<a href="<?php echo get_the_permalink();?>"><img alt="" srcset="<?php echo $thumbnail_small[0]; ?> 224w, <?php echo $thumbnail_medium[0]; ?> 263w" sizes="(min-width: 480px) 50vw, 100vw" class="img-fluid"></a>
		</div><!-- img-wrapper -->
		<div class="card-block">
			<h2 class="entry__title"><a href="<?php echo get_the_permalink();?>"><?php echo get_the_title(); ?></a></h2>
			<div class="dotdotdot">
				<p class="entry__text card-text"><?php echo get_the_excerpt(); ?></p>
			</div><!-- dotdotdot -->
		</div><!-- card-block -->
	</article><!-- card -->
<?php if($is_slider):?>
</div><!-- slider__item -->
<?php endif; ?>
