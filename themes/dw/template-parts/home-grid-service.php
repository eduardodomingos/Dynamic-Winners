<div class="slider__item">
	<article class="card entry entry--service text-xs-center m-b-0">
		<div class="card-block p-t-0 p-l-0 p-r-0">
			<h4 class="entry__title" data-order="<?php echo $order; ?>"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
			<div class="dotdotdot">
				<p class="entry__text card-text"><?php the_content(); ?></p>
			</div><!-- dotdotdot -->
			<a href="<?php echo get_the_permalink(); ?>" class="entry__read-more">Ver mais</a>
		</div><!-- card-block -->
	</article><!-- card -->
</div><!-- slider__item -->
