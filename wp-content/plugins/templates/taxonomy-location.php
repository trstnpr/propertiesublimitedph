

<?php
/**
 * Template Name: Home
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package real-estate-lite
 */

get_header(); ?>



	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php 
/*
* Template Section for Properties
*/
$propertyno = get_theme_mod('realest-property-number');

 echo "<div class='section props'><div class='grid'>";

 $slug = get_queried_object()->slug;

  $args = array(

    
    //Type & Status Parameters
    'post_type'   => 'property',
  
    //Pagination Parameters
    'posts_per_page'  => $propertyno,

    'tax_query' => array(
            array(
                'taxonomy' => 'location',
                'field' => 'slug',
                'terms' => $slug
            ))
  
  );


$the_query = new WP_Query( $args );

echo "<h2 class='section-title'>" . get_theme_mod('property-section-title') . "</h2>";

// The Loop
if ( $the_query->have_posts() ) {
  echo '<ul class="properties">';
  while ( $the_query->have_posts() ) {
    $the_query->the_post(); ?>

    <li class="col-4-12">
      <div class="property-thumb">
      <?php if (get_the_post_thumbnail()) : ?>
      <a href="<?php the_permalink();?>" >
        <?php the_post_thumbnail('realest_property'); ?>
      </a>
      <?php endif; ?>
      <?php $price = get_post_meta( get_the_ID(), '_realest_price', true ); ?>
        <?php if ( ! empty( $price ) ) : ?>
          <span class="price"><?php echo get_theme_mod('realest_currency') ;  echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); echo get_post_meta( get_the_ID(), '_realest_suffix', true );?></span>
        <?php endif; ?>

      <?php $featured = get_post_meta( get_the_ID(), '_realest_featured', true ); ?>
        <?php if ( ! empty( $featured ) ) : ?>
          <span class="featured"><?php  _e( 'Featured', 'pt-real-estate-proffesional' ); ?></span>
        <?php endif; ?>
      </div>

      <ul class="property-info">
      <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
      <span class="location-marker">
        <i class="fa fa-map-marker"></i>
        <?php the_terms( $post->ID, 'location' );
        ?>
      </span>
          <?php $beds = get_post_meta( get_the_ID(), '_realest_bedrooms', true ); ?>
          <?php if ( ! empty( $beds ) ) : ?>
            <li><i class="fa fa-bed"></i><span><?php _e( 'Beds', 'pt-real-estate-proffesional' ); ?></span><span class="alignright"><?php echo esc_attr( $beds ); ?></span></li>
          <?php endif; ?>

          <?php $baths = get_post_meta( get_the_ID(), '_realest_baths', true ); ?>
          <?php if ( ! empty( $baths ) ) : ?>
            <li><i class="fa fa-bath"></i><span><?php _e( 'Baths', 'pt-real-estate-proffesional' ); ?></span><span class="alignright"><?php echo esc_attr( $baths ); ?></span></li>
          <?php endif;?>

          <?php $rooms = get_post_meta( get_the_ID(), '_realest_rooms', true ); ?>
          <?php if ( ! empty( $rooms ) ) : ?>
            <li><i class="fa fa-th-large"></i><span><?php _e( 'Rooms', 'pt-real-estate-proffesional' ); ?></span><span class="alignright"><?php echo esc_attr( $rooms ); ?></span></li>
          <?php endif;?>  
          </ul> 
    </li>

  <?php }
  echo '</ul>';
  /* Restore original Post Data */
  wp_reset_postdata();

} else {
  // no posts found
}
echo "</div></div>";

?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
