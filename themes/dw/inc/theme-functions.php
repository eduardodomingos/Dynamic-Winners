<?php

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


function dynamic_get_homepage_athletes( $home_id ){

	$athletes = [ 'player' => 'players', 'coach' => 'coaches', 'team' => 'teams'];
	$tax_query = ['field' => 'slug', 'taxonommy' => 'athlete_type'];

	foreach( $athletes  as $tax => $cf_athlete ){
		
		$highlight_athlets = get_field( $cf_athlete, $home_id);
		$tax_query['term'] = $tax;
		$more_athletes = dynamic_get_posts_to_widgets('athlete', $highlight_athlets, $tax_query );
		$athletes[$tax] = array_merge($highlight_athlets, $more_athletes);
	
	}

	return $athletes;
	
}


add_filter('wp_head', 'dynamic_add_manchetes_css_to_header');

function dynamic_add_manchetes_css_to_header(){

	$css = '';

	if( is_home() ){
		$css = '<style>';
		$manchetes = dynamic_get_published_manchetes();
		
		foreach( $manchetes as $key => $manchete ){
			
			$fullscreen_image = get_field('fullscreen_photo', $manchete);
			error_log($fullscreen_image);
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
	return true;
}

function dynamic_get_headline_manchetes(){

	$before_headline = '<section id="headlines">
		<div class="headlines__overlay"></div>
		<div class="slider slider--headlines">';

	$after_headline = '<div></section>';

	$manchetes = dynamic_get_published_manchetes();
	
	foreach( $manchetes as $key => $manchete ){

		$title = get_the_title($manchete);
		$headline_html = '<div class="slider__item">
				<article class="headline headline' . $key . '">
					<div class="headline__text">
						<h1>' . get_the_title($manchete) . '</h1>
					</div><!-- headline__text -->
				</article><!-- headline -->
			</div>';
	}

	return $before_headline . $headline_html .  $after_headline;


}

function dynamic_get_published_manchetes(){
	
	$args = [
		'post_type' => 'highlight',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'fields' => 'ids',
	];

	$manchetes = new WP_Query($args);

	return $manchetes->posts;
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