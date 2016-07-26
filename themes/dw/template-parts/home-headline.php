<section id="headlines">
	<div class="headlines__overlay"></div>
	<div class="slider slider--headlines">
		<?php foreach( $manchetes as $key => $manchete ){ ?>
			<div class="slider__item">
		   		<article class="headline headline<?php echo $key; ?>">
					<div class="headline__overlay"></div>
					<div class="headline__text">

						<?php if(get_field('manchete_article', $manchete)): ?>

							<?php $manchete_article = get_field('manchete_article', $manchete);?>
							<h1><a href="<?php echo the_permalink($manchete_article[0]);?>"><?php echo get_the_title($manchete); ?></a></h1>

						<?php elseif(get_field('manchete_static_text', $manchete)) : ?>

							<h1><?php echo get_field('manchete_static_text', $manchete); ?></h1>

						<?php endif; ?>

					</div><!-- headline__text -->
				</article><!-- headline -->
			</div>
		<?php } ?>
	</div>
</section>
