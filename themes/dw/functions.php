<?php

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

/**
 * Dynamic Winners functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dynamic_Winners
 */

if ( ! function_exists( 'dw_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dw_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Dynamic Winners, use a find and replace
	 * to change 'dw' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dw', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'dw' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dw_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );



}
endif;
add_action( 'after_setup_theme', 'dw_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dw_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dw_content_width', 640 );
}
add_action( 'after_setup_theme', 'dw_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dw_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dw' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dw' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dw_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dw_scripts() {
	//wp_enqueue_style( 'dw-style', get_stylesheet_uri() );
	wp_enqueue_style( 'dw-style', get_template_directory_uri() . '/assets/build/css/main.css' );

	wp_enqueue_script( 'dw-js', get_template_directory_uri() . '/assets/build/js/main.js', array( 'jquery', 'underscore' ), '', true );

	wp_localize_script( 'dw-js', 'dwjs', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	));

	//wp_enqueue_script( 'dw-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( 'dw-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dw_scripts' );

add_action( 'wp_ajax_nopriv_ajax_pagination', 'dw_ajax_pagination' );
add_action( 'wp_ajax_ajax_pagination', 'dw_ajax_pagination' );

function dw_ajax_pagination() {
	// Get posted variables
	$postType = (isset($_POST['postType'])) ? $_POST['postType'] : 'post';
	$postTax = (isset($_POST['postTax'])) ? $_POST['postTax'] : 'tag';
	$page = (isset($_POST['page'])) ? $_POST['page'] : 1;
	$numPosts= (isset($_POST['numPosts'])) ? $_POST['numPosts'] : 1;

	$tax_query = ['field' => 'slug', 'taxonomy' => 'athlete_type', 'terms' => $postTax];

	$args = [
		'post_type' => $postType,
		'paged' => $page,
		'pagination'             => true,
		'posts_per_page' => $numPosts,
		'tax_query' =>  array( $tax_query ),
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		'post__not_in' => dw_get_homepage_athletes_ids($postTax),
	];

	$is_last = false;
	$posts = new WP_Query($args);

	if( $posts->have_posts() ) {

		if($page == $posts->max_num_pages) {
			$is_last = true;
		}

		while ( $posts->have_posts() ) {
			$posts->the_post();
			dynamic_get_template_part( 'template-parts/home-grid', 'athlete', array('is_slider' => false, 'is_last' => $is_last ) );
		}

	}
	wp_reset_query();

	die();
}

function dw_login_logo() { ?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/logo-dw-black.svg);
			background-size: 100%;
			width: 130px;
			height: 90px;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'dw_login_logo' );

function dw_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'dw_login_logo_url' );

function dw_login_logo_url_title() {
	return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'dw_login_logo_url_title' );



//if ( 'localhost' == $_SERVER['SERVER_NAME'] ) {
//	define( 'ACF_LITE', true );
//	require_once get_template_directory() . '/custom-fields.php';
//}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/theme-setup.php';

require get_template_directory() . '/inc/theme-widgets.php';

require get_template_directory() . '/inc/theme-functions.php';

require get_template_directory() . '/inc/theme-menus.php';



