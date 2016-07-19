<section id="headlines">
	<div class="headlines__overlay"></div>
	<div class="slider slider--headlines">
		<?php foreach( $manchetes as $key => $manchete ){ ?>
			<div class="slider__item">
		   		<article class="headline headline<?php echo $key; ?>">
					<div class="headline__text">
						<h1><?php echo get_the_title($manchete); ?></h1>
					</div><!-- headline__text -->
				</article><!-- headline -->
			</div>
		<?php } ?>
	</div>
</section>