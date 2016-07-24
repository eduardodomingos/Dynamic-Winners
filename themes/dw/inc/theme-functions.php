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
		'athlete' =>
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

	$tax_query = ['field' => 'slug', 'taxonomy' => 'athlete_type'];
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

		$tax_query['terms'] = $tax;
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

	$css = '<style>';

	if( is_home() ){


		$home_id = dynamic_get_active_homepage();
		$manchetes = get_field('highlights_manager', $home_id);

		foreach( $manchetes as $key => $manchete ){
			$mobile_photo = get_field('mobile_photo', $manchete);

			$css .= ".headline$key {
				background-image: url('$mobile_photo');
			} ";
		}

		$css .= '@media (min-width: 480px) { ';

		foreach( $manchetes as $key => $manchete ){
			$tablet_photo = get_field('tablet_photo', $manchete);
			$css .= ".headline$key {
				background-image: url('$tablet_photo');
			} ";
		}
		$css .= '} @media (min-width: 1024px) { ';
		foreach( $manchetes as $key => $manchete ){
			$fullscreen_photo = get_field('fullscreen_photo', $manchete);
			$css .= ".headline$key {
				background-image: url('$fullscreen_photo');
			} ";
		}
		$css .= '}';

	}
	elseif( is_single() ){

		global $post;

		$background_single_photos = array(

			'post' => array(
					'mobile' =>  get_template_directory_uri() . '/assets/build/img/bg-blog--sm.jpg',
					'tablet' => get_template_directory_uri() . '/assets/build/img/bg-blog--md.jpg',
					'fullscreen' => get_template_directory_uri() . '/assets/build/img/bg-blog--lg.jpg',
				),
			'service' => array(
					'mobile' => get_template_directory_uri() . '/assets/build/img/bg-services--sm.jpg',
					'tablet' => get_template_directory_uri() . '/assets/build/img/bg-services--md.jpg',
					'fullscreen' => get_template_directory_uri() . '/assets/build/img/bg-services--lg.jpg',
				),


			'athlete' => array(
					'mobile' => get_template_directory_uri() . '/assets/build/img/bg-athletes--sm.jpg',
					'tablet' => get_template_directory_uri() . '/assets/build/img/bg-athletes--sm.jpg',
					'fullscreen' => get_template_directory_uri() . '/assets/build/img/bg-athletes--sm.jpg',
				)
		);

		$post_type = $post->post_type;

		$mobile_photo = $background_single_photos[$post_type]['mobile'];
		$tablet_photo = $background_single_photos[$post_type]['tablet'];
		$fullscreen_photo = $background_single_photos[$post_type]['fullscreen'];

		$css .= ".featured-image {
					background-image: url('$mobile_photo');
					}

				@media (min-width: 480px) {
					.featured-image {
						background-image: url('$tablet_photo');
					}
				}

				@media (min-width: 1024px) {
					.featured-image {
						background-image: url('$fullscreen_photo');
					}
				}";



	}
	$css .=  '</style>';
	echo $css;


}

function dynamic_get_before_and_after_posts(){

	$previous = get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	$html = '';


	if( !empty( $previous ) ){

		$to_show = empty( $next ) ? 'show' : '';

		$html .= '<article class="entry entry--latest prev ' . $to_show . '">' . dw_posted_on($previous->ID)
					. '<h2 class="entry__title"><a href="'. get_the_permalink($previous->ID) .'">' . $previous->post_title . '</a></h2>
					<a href="' . get_the_permalink($previous->ID) . '" class="entry__read-more">Ver notícia</a>
					<a href="' . get_the_permalink($previous->ID) . '" class="arrow"><i class="icon-left-open-big"></i></a>
				</article><!-- entry -->';
	}

	if( !empty( $next ) ){
		$html .=  '<article class="entry entry--latest next show">' . dw_posted_on($next->ID)
					. '<h2 class="entry__title">' . $next->post_title . '</h2>
					<a href="' . get_the_permalink($next->ID) . '" class="entry__read-more">Ver notícia</a>
					<a href="' . get_the_permalink($next->ID) . '" class="arrow"><i class="icon-right-open-big"></i></a>
				</article><!-- entry -->';
	}


	return $html;

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


function dw_get_athlete_positions( $athlete_id = 0 ){

	$athlete_id = empty( $athlete_id ) ? get_the_ID() : $athlete_id;

	if( empty($athlete_id) ){
		return false;
	}
	$field_obj = get_field_object('position');
	$choices = $field_obj['choices'];

	$positions = get_field('position', $athlete_id);
	if( !empty( $positions ) ){
		foreach( $positions as $key => $position ){
			$positions[$key] = $choices[$position];
		}
	}
	else{
		$positions = array();
	}
	

	return $positions;


}


function dw_get_athlete_biography(){

	$fields = array( 'athlete' => array('name', 'birthday', 'weight', 'height', 'team', 'position', 'origin'),
					  'coach' => array('name', 'birthday', 'weight', 'height', 'team', 'origin'),
					  'team' => array('name', 'foundation', 'country') );


	$athlete_biography = array();
	
	$terms = wp_get_post_terms(get_the_ID(), 'athlete_type');
	$tax = $terms[0]->slug;
	
	foreach( $fields[$tax] as $field ){
		
		if( $field == 'position'){
			$positions = dw_get_athlete_positions();
			if( !empty($positions)){
				$athlete_biography[$field] = dw_get_athlete_positions();
			}
			
		}
		
		else{
			
			$field_value= get_field($field);
			if( ! empty($field_value) ){
				$athlete_biography[$field] = $field_value;
			}
		}	
		
	}
	
	return $athlete_biography;

}

function dynamic_get_headline_manchetes(){

	$home_id = dynamic_get_active_homepage();

	$manchetes = get_field('highlights_manager', $home_id);

	dynamic_get_template_part('template-parts/home', 'headline', array('manchetes' => $manchetes));

}


function dynamic_get_all_services( $posts_to_exclude = array() ){

	$args = [

		'post_type' => 'service',
		'post_status' => 'publish',
		'post__not_in' => $posts_to_exclude,
		'posts_per_page' => -1,
		'orderby' => 'date'

	];

	$services = new WP_Query( $args );

	return $services;


}




// Remove hook for the default shortcode...
remove_shortcode('gallery', 'gallery_shortcode');
// .. and create a new shortcode with the default WordPress shortcode name (tag) for the gallery
add_shortcode('gallery', function($atts)
{
    $attrs =
        shortcode_atts(array(
            'slider'              => md5(microtime().rand()), // Slider ID (is per default unique)
            'slider_class_name'   => '', // Optional slider css class
            'ids'                 => '', // Comma separated list of image ids
            'size'                => 'full', // Image format (could be an custom image format)
          
        ), $atts);

    extract($attrs);

    // Verify if the chosen image format really exist
    

    // Iterate over attribute array, cleanup and make the array elements JavaScript ready
    foreach( $attrs as $key => $attr )
    {
        // CamelCase the array keys
        $new_key_name = lcfirst(str_replace(array(' ', 'Css'), array('', 'CSS'), ucwords(str_replace('_', ' ', $key))));

        // Remove unnecessary array elements
        if( in_array($key, array('size', 'ids', 'slider_class_name')) || strpos($key, '_') !== false )
        {
            unset($attrs[$key]);
        }

        // Fix the type before passing the array elements to JavaScript
        if( is_numeric($attr) )
        {
            $attrs[$new_key_name] = (int) $attr;
        }else if( is_bool($attr) || (strpos($attr, 'true') !== false || strpos($attr, 'false') !== false) )
        {
            $attrs[$new_key_name] = filter_var($attr, FILTER_VALIDATE_BOOLEAN);
        }else if( is_int($attr) )
        {
            $attrs[$new_key_name] = filter_var($attr, FILTER_VALIDATE_INT);
        }
    }

    // Determine if the script has already been registered and register the script and stylesheets only once
   
    // Create an empty variable for return html content
    $html_output = '';


    // Build the html slider structure (open)
    $html_output .= '<div class="slider wp-slick-slider">';

    // Iterate over the comma separated list of image ids and keep only the real numeric ids
    foreach( array_filter( array_map(function($id){ return (int) $id; }, explode(',', $ids)) ) as $media_id)
    {
        // Get the image by media id and build the html div group with the image source, width and height
        if( $image_data = wp_get_attachment_image_src( $media_id, 'grid-medium' ) )
        {
            $html_output .= '<div><div class="image"><img src="'.esc_url($image_data[0]).'" height="'.$image_data[0].'" width="'.$image_data[0].'" /></div></div>';
        }
    }

    // Close the html slider structure and return the html output
    return $html_output.'</div>';
});