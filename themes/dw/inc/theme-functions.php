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
	//get one page services
	$more_services = dynamic_get_posts_to_widgets('service', $highlight_services, 1 );
	//merge services 
	$all_services = array_merge( $highlight_services, $more_services );
	
	return $services_field;
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


function dynamic_get_posts_to_widgets( $post_type, $posts_to_exclude = array(), $tax_query = '', $page = 1 ){

	$nb_posts = 12;
	
	$args = [
		'post_type' => $post_type,
		'post_status' => 'publish',
		'posts__not_in' => $posts_to_exclude,
		'posts_per_page' => $nb_posts,
		'page' => $page,
		'fields' => 'ids'
	];


	$posts = new WP_Query( $args );
	$posts_ids = $posts->posts;

	
	return $posts_ids;


}