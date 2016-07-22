<?php

function dynamic_register_widgets() {

	register_widget( 'Dynamic_Widget_Home_Last_News' );

	register_widget( 'Dynamic_Widget_Home_Services' );

	register_widget( 'Dynamic_Widget_Home_Athletes' );

	register_widget( 'Dynamic_Widget_Home_About' );

}

add_action( 'widgets_init', 'dynamic_register_widgets' );

class Dynamic_Widget_Home_Last_News extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'news', 'description' => __( 'Display the latest Dynamic Winners news', 'dynamic' ) );
		parent::__construct( 'news', __('Dynamic Latest Posts','dynamic' ), $widget_ops );

	}

	function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$news = dynamic_get_latest_news();

		echo $args['before_widget'];
		?>

		<div class="col-sm-12 col-lg-8 col-lg-offset-2">
			<div class="section__header">
				<h2 class="heading sr-only">Notícias</h2>
			</div><!-- section__header -->
			<div class="slider slider--entries">
		<?php

			while( $news->have_posts() ) : $news->the_post();
				get_template_part( 'template-parts/home-grid', 'post' );
			endwhile;
			wp_reset_postdata();
		?>

			</div>
		</div>

		<?php
		echo $args['after_widget'];

	}

}

class Dynamic_Widget_Home_Services extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'services', 'description' => __( 'Display the services widgets at homepage', 'dw' ) );
		parent::__construct( 'services', __('Dynamic Services','dw' ), $widget_ops );

	}

	function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		echo $args['before_widget'];

		$home_id = dynamic_get_active_homepage();

		$services = dynamic_get_homepage_services( $home_id );

		?>
		<div class="col-sm-12">
			<div class="section__header">
				<h2 class="heading sr-only">Serviços</h2>
			</div><!-- section__header -->
			<div class="slider slider--entries">

		<?php
			$i = 1;
			while( $services->have_posts() ) : $services->the_post();
				dynamic_get_template_part( 'template-parts/home-grid', 'service', array('order' => $i) );
				++$i;
			endwhile;
			wp_reset_postdata();
		?>

			</div>
		</div>
		<?php

		echo $args['after_widget'];

	}

}


class Dynamic_Widget_Home_Athletes extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'athletes', 'description' => __( 'Display the athlets ( players, coaches ans teams ) inside a widget inside at homepage', 'dynamic' ) );
		parent::__construct( 'athletes', __('Dynamic Athlets','dw' ), $widget_ops );

	}

	function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		echo $args['before_widget'];

		$home_id = dynamic_get_active_homepage();
		$athletes = dynamic_get_homepage_athletes( $home_id );

		?>
		<div class="col-sm-12">
			<div class="section__header">
				<h2 class="heading"><?php esc_html_e( 'Athletes', 'dw' ); ?></h2>
			</div><!-- section__header -->
		</div><!-- col -->
				<div class="col-sm-12 col-lg-6 col-lg-offset-3">

						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#players" role="tab"><?php esc_html_e( 'Players', 'dw' ); ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#managers" role="tab"><?php esc_html_e( 'Coaches', 'dw' ); ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#teams" role="tab"><?php esc_html_e( 'Teams', 'dw' ); ?></a>
							</li>
						</ul><!-- nav-tabs -->

					</ul>
				</div>
			</div>
		</div>
		<div class="tab-content">
		<?php

		foreach( $athletes as $athlete ){ ?>

			<div class="tab-pane <?php if( $athlete['cf'] == 'players') : echo 'active'; endif; ?> " id="<?php echo $athlete['cf'] ?>" role="tabpanel">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="slider slider--entries">
							<?php
							while( $athlete['posts']->have_posts() ) : $athlete['posts']->the_post();
								get_template_part( 'template-parts/home-grid', 'athlete' );
							endwhile;
							wp_reset_postdata();
							?>
							</div>
							<div class="loadMoreContainer clearfix"></div>
							<div class="text-xs-center">
								<button class="btn btn--load-more js-load-more-athletes"><?php esc_html_e( 'Load more', 'dw' ); ?></button>
								<div class="loading js-loader" style="display: none; margin-bottom:40px"><span class="sr-only"><?php esc_html_e( 'Loading...', 'dw' ); ?></span></div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php
		}
		?>
		</div>
	</section>

	<?php
	}

}

class Dynamic_Widget_Home_About extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'about', 'description' => __( 'Display the about section at homepage', 'dynamic' ) );
		parent::__construct( 'hero', __('Dynamic About section','dw' ), $widget_ops );
	}

	function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = $instance['title'];
		$description = empty( $instance['description'] ) ? '' : $instance['description'];

		?>

		<?php echo $args['before_widget']; ?>

		<div class="col-sm-12 col-lg-6 col-lg-offset-3">
			<div class="section__header">
				<h2 class="heading"><?php echo $title ?></h2>
			</div><!-- section__header -->
			<p class="text-xs-center m-b-0"><?php echo $description ?></p>
		</div><!-- col -->



		<?php echo $args['after_widget'];

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['description'] =  $new_instance['description'];
		$instance['title'] = !empty( $new_instance['title'] ) ? $new_instance['title'] : '';

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'description' => '', 'title' => '') );

		?>

		<p><label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php esc_html_e( 'Título:', 'dw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'description' ); ?>"><?php esc_html_e( 'Description:', 'dw'); ?></label>
			<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
		</p>



		<?php
	}
}
