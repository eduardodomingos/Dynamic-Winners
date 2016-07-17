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