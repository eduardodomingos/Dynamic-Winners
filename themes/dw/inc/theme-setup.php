<?php 

function dynamic_remove_home_post_type_support() {
    
    remove_post_type_support(  'home', 'editor' );
}

add_action( 'init', 'dynamic_remove_home_post_type_support' );


function dynamic_widgets_init() {

	// Homepage sections
	register_sidebar( array(
		'name'          => __( 'Homepage sections', 'dynamic' ),
		'id'            => 'dinamic-homepage-sections',
		'description'	=> '',
		'before_widget' => '<section id="%1$s" class="%2$s"><div class="container">',
		'after_widget'  => '</div></section>',
		'before_title'  => '',
		'after_title'   => '',
	) );

	
}

add_action( 'widgets_init', 'dynamic_widgets_init' );

