<?php

$home_id = dynamic_get_active_homepage();
$phone = get_field('phone', $home_id );
$email = get_field('email', $home_id );
?>
<section id="contacts" class="band section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-8 col-lg-offset-2">
					<div class="section__header">
						<h2 class="heading">Contacte-nos</h2>
					</div><!-- section__header -->
					<form action="" class="contact-form">
						<div class="form-group row">
							<label for="inputName" class="col-lg-3 form-control-label">Nome</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="inputName">
							</div><!-- col -->
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="inputEmail" class="col-lg-3 form-control-label">Email</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="inputEmail">
							</div><!-- col -->
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="inputPhone" class="col-lg-3 form-control-label">Tel.:</label>
							<div class="col-lg-9">
								<input type="tel" class="form-control" id="inputPhone">
							</div><!-- col -->
						</div><!-- form-group -->

						<div class="form-group row">
							<label for="inputMessage" class="col-lg-3 form-control-label">Mensagem</label>
							<div class="col-lg-9">
								<textarea class="form-control" id="inputMessage" rows="3"></textarea>
							</div><!-- col -->
						</div><!-- form-group -->
						<div class="text-xs-center">
							<button type="submit" class="btn btn--slanted">Enviar</button>
						</div>
					</form><!-- contact-form -->

					<ul class="social text-xs-center">
						<li class="social__item">
							<a href="" class="social__link social__link--twitter"><span class="sr-only">Twitter</span></a>
						</li>
						<li class="social__item">
							<a href="" class="social__link social__link--gplus"><span class="sr-only">Google+</span></a>
						</li>
						<li class="social__item">
							<a href="" class="social__link social__link--linkedin"><span class="sr-only">Linkedin</span></a>
						</li>
						<li class="social__item">
							<a href="" class="social__link social__link--youtube"><span class="sr-only">Youtube</span></a>
						</li>
					</ul><!-- social -->

					<div class="text-xs-center">
						<p><a href="tel:+244937924432" class="contacts__link">+<?php echo $phone; ?></a></p>
						<p><a href="mailto:geral@dynamicwinners.com" class="contacts__link"><?php echo $email; ?></a></p>
					</div>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- contacts -->
