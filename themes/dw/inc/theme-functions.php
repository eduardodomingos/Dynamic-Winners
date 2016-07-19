<?php


function dynamic_get_template_part( $slug, $name = null, $data=array() ) {
	
	extract( $data );

	if ( $name )
		$file = "{$slug}-{$name}.php";
	else
		$file = "{$slug}.php";

	include locate_template( $file );
}

function dynamic_get_active_homepage(){

	$home_active_id = 0;

	//arguments to find the 
	$args = [
		'post_type' => 'home',
		'post_status' => 'publish',
		'orderby' => 'date',
		'posts_per_page' => 1,
		'fields' => 'ids'
	];

	$home_query = new WP_Query( $args );
	$home_active = $home_query->posts;

	if( !empty( $home_active  ) ){
		$home_active_id = $home_active[0];
	}
	
	return $home_active_id;

}

function dynamic_get_homepage_services( $home_id ){
	
	//get homepage highlight services
	$highlight_services = get_field('home_services', (int)$home_id);
	$highlight_services_ids = [];
	
	foreach ($highlight_services as $highlight_service) {
		$highlight_services_ids[] = $highlight_service->ID;
	}

	$args = [
		'post_type' => 'service',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'post__not_in' => $highlight_services_ids,
		'ignore_sticky_posts' => false
	];
	
	$more_services = new WP_Query($args);
	
	$all_services = new WP_Query();
	$all_services->posts = array_merge( $highlight_services, $more_services->posts );
	
	// we also need to set post count correctly so as to enable the looping
	$all_services->post_count = count( $all_services->posts );
	return $all_services;
}


function dynamic_get_homepage_athletes( $home_id, $page = 1 ){

	$athletes = [ 
		'player' => 
			[
				'cf' => 'players', 
				'posts' => array(), 
				
			],  
		'coach' => 
			[
				'cf' =>'managers',
				'posts' => array(),
				
			],
		'team' => 
			[ 
				'cf' => 'teams',
				'posts' => array(),
				
			]
	];
	
	$tax_query = ['field' => 'slug', 'taxonommy' => 'athlete_type'];
	$nb_posts = 12;

	$args = [
		'post_type' => 'athlete',
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		'page' => 1
	];


	foreach( $athletes  as $tax => $athlete_vars ){
		
		$highlight_athletes = get_field( $athlete_vars['cf'], $home_id);
		
		if( $page = 1 ){
			$nb_posts = $nb_posts - count($highlight_athletes);
		}

		$tax_query['term'] = $tax;
		$athlete_type_ids = [];
		
		foreach( $highlight_athletes  as $highlight_athlete){
			$athlete_type_ids[] = $highlight_athlete->ID;
		}

		$args['post__not_in'] = $athlete_type_ids;
		$args['tax_query'] = array( $tax_query );
		$args['posts_per_page'] = $nb_posts;
		
		$more_athletes = new WP_Query($args);
		$all_athletes  = new WP_Query();

		$all_athletes->posts      = array_merge( $highlight_athletes, $more_athletes->posts);
		$all_athletes->post_count = count( $all_athletes->posts );
		
		$athletes[$tax]['posts'] = $all_athletes;
	
	}
	
	return $athletes;
	
}


add_filter('wp_head', 'dynamic_add_manchetes_css_to_header');

function dynamic_add_manchetes_css_to_header(){

	$css = '';

	if( is_home() ){
		
		$css = '<style>';
		$home_id = dynamic_get_active_homepage();

		$manchetes = get_field('highlights_manager', $home_id);
		
		foreach( $manchetes as $key => $manchete ){
			
			$fullscreen_image = get_field('fullscreen_photo', $manchete);
			
			$css .= ".headline$key {
				background-image: url('$fullscreen_image');
			} ";
		}
		
		$css .= '@media (min-width: 480px) { ';
		
		foreach( $manchetes as $key => $manchete ){
			$mobile_image = get_field('mobile_photo', $manchete);
			$css .= ".headline$key {
				background-image: url('$mobile_image');
			} ";
		}

		$css .= '} @media (min-width: 1024px) { ';

		foreach( $manchetes as $key => $manchete ){
			$tablet_image = get_field('mobile_photo', $manchete);
			$css .= ".headline$key {
				background-image: url('$tablet_image');
			} ";
		}

		$css .= '} </style>';
		
	}

	echo $css;


}



function dynamic_get_latest_news(){
	
	$home_id = dynamic_get_active_homepage();
	$nb_posts = get_field('news_count', $home_id);

	$args = [
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $nb_posts,
		'orderby' => 'date',
	];

	return new WP_Query($args);

}

function dynamic_get_headline_manchetes(){

	$home_id = dynamic_get_active_homepage();

	$manchetes = get_field('highlights_manager', $home_id);
	
	$before_headline = '<section id="headlines">
							<div class="headlines__overlay"></div>
								<div class="slider slider--headlines">';

	$after_headline = '<div>
					</section>';

	foreach( $manchetes as $key => $manchete ){

		$title = get_the_title($manchete);
		$headline_html .= 	'<div class="slider__item">
						   		<article class="headline headline' . $key . '">
									<div class="headline__text">
										<h1>' . get_the_title($manchete) . '</h1>
									</div><!-- headline__text -->
								</article><!-- headline -->
							</div>
							';
	}
	
	return $before_headline . $headline_html .  $after_headline;


}


function dynamic_get_posts_to_widgets( $post_type, $posts_to_exclude = array(), $posts_per_page = 12, $tax_query = array(), $page = 1 ){

	$args = [
		
		'post_type' => $post_type,
		'post_status' => 'publish',
		'post__not_in' => $posts_to_exclude,
		'posts_per_page' => $posts_per_page,
		'fields' => 'ids'
	];


	if( $posts_per_page > 0 ){
		$args['page'] = $page;
	}

	if( !empty( $tax_query ) ){
		$args['tax_query'] = $tax_query;
	}
	
	$posts = new WP_Query( $args );
	$posts_ids = $posts->posts;

	return $posts_ids;


}