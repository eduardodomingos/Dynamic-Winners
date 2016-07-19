<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dynamic_Winners
 */

get_header(); ?>

<?php dynamic_get_headline_manchetes(); ?>
<div class="band band--primary">
	<?php dynamic_sidebar( 'dynamic-homepage-sections' ); ?>
</div>
<?php get_template_part( 'template-parts/home-grid', 'contacts' ); ?>

<?php get_footer(); ?>

