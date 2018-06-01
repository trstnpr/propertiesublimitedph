<?php
/**
 * The template for displaying a single property.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package realest
 */

get_header(); ?>

	<div id="primary" class="content-area grid">
     	<main id="main" class="site-main <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>col-9-12 <?php else : ?>col-1-1<?php endif; ?>"  role="main">

		<?php 
		
		echo Pt_Real_Estate_Proffesional_Functions::single_property_slider();
	if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="property-section">
				<?php the_title( '<h1 class="entry-title">', '</h1>' );

				$price = get_post_meta( get_the_ID(), '_realest_price', true );
            	if ( ! empty( $price ) ) :
              	 	echo '<h3 class="price">' . esc_attr( $price ) .'</h3>';
            	endif; 
            	the_content();
			 endwhile; ?>
			</div>

			<?php if ( true == get_theme_mod( 'prperty-details-switch', true ) ) { ?>
			<div class="col-1-1 property-section">
				<h2 class="entry-title"><?php echo esc_html__('Property Details', 'pt-real-estate-proffesional')?></h2>
				<?php echo Pt_Real_Estate_Proffesional_Functions::realest_property_details(); ?>
			</div>
			<?php } ?>

			<?php if ( true == get_theme_mod( 'amenities', true ) ) { ?>
			<div class="col-1-1 property-section">
				<h2 class="entry-title"><?php echo esc_html__('Amenities', 'pt-real-estate-proffesional')?></h2>
				<?php echo Pt_Real_Estate_Proffesional_Functions::realest_property_amenities(); ?>
			</div>
			<?php } ?>

			<?php if ( true == get_post_meta( get_the_ID(), '_realest_property_video', 1 ) ) { ?>
			<div class="col-1-1 property-section">
			<h2 class="entry-title"><?php echo esc_html__('Video Tour', 'pt-real-estate-proffesional')?></h2>
			<?php $url = esc_url( get_post_meta( get_the_ID(), '_realest_property_video', 1 ) );
				echo wp_oembed_get( $url );
			?>
			</div>
			<?php } ?>

			<?php if ( true == get_post_meta( get_the_ID(), '_realest_location', 1 ) ) { ?>
			<div class="col-1-1 property-section">
			<h2 class="entry-title"><?php echo esc_html__('Location', 'pt-real-estate-proffesional')?></h2>
			<?php echo Pt_Real_Estate_Proffesional_Functions::realest_property_map(); ?>

			</div>
			<?php } ?>

		
		<?php wp_reset_postdata();  endif; ?>

		</main><!-- #main -->
     	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="secondary" class="widget-area col-3-12" role="complementary">

		<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>


		<?php endif; ?>
	</div><!-- #primary -->
	</div><!-- /.content -->


<?php get_footer(); ?>
