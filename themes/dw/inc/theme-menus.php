<?php


function dynamic_get_nav_menu_main() {

	$args = array(
		'menu' => 'primary',

		'container'       => false,
		'menu_class'      => '',
		'echo'            => false,
		'fallback_cb'     => false,
		'items_wrap'      => '%3$s',
		'depth'           => 1
	);


	$main = wp_nav_menu( $args );

	return $main;
}

function dynamic_get_nav_menu_athletes(){
	$args = array(
		'menu' => 'athletes_widget',
		'container'       => false,
		'menu_class'      => 'nav-tabs',
		'echo'            => false,
		'fallback_cb'     => false,
		'items_wrap'      => '%3$s',
		'depth'           => 1
	);


	$main = wp_nav_menu( $args );

	return $main;
}

add_filter( 'nav_menu_link_attributes', 'dynamic_menu_link_class', 10, 3);

function dynamic_menu_link_class($atts, $item, $args){

	if( $args->menu == 'primary' ) {
		$atts['class'] = 'site-nav__link';
	}
	elseif( $args->menu == 'athletes_widget' ){
		$atts['class'] = 'nav-link';
	}

	return $atts;
}

function dynamic_menu_item_class( $classes, $item ) {

    $classes[] = 'site-nav__item';
    return $classes;
}

add_filter( 'nav_menu_css_class', 'dynamic_menu_item_class', 10, 2 );
