<?php
/**
 * Template Name: FrontPage PRO
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package realest
 */

get_header(); ?>

<?php do_action('slider' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php
	if ( true == get_theme_mod( 'search-switch', true ) ) {
		get_template_part( 'sections/search');
	}
	if ( true == get_theme_mod( 'service-switch', true ) ) {
		get_template_part( 'sections/services');
	}
	if ( true == get_theme_mod( 'about-switch', true ) ) {
		get_template_part( 'sections/about');
	}
	if ( true == get_theme_mod( 'property-switch', true ) ) {
		get_template_part( 'sections/properties');
	}
	if ( true == get_theme_mod( 'testimonial-switch', true ) ) {
		get_template_part( 'sections/testimonial');
	}
	if ( true == get_theme_mod( 'blog-switch', true ) ) {
		get_template_part( 'sections/blog');
	}
	if ( true == get_theme_mod( 'contact-switch', true ) ) {
		get_template_part( 'sections/address');
	}

?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
