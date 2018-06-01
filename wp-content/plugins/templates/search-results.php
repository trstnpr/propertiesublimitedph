<?php
/**
 * Template name: search-property.
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
get_header();
?>
<div id="primary" class="content-area grid">
     	<main id="main" class="site-main <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>col-9-12 <?php else : ?>col-1-1<?php endif; ?>"  role="main">


<?php
// Get data from URL into variables
$_location = $_GET['location'] != '' ? $_GET['location'] : '';
$_type = $_GET['type'] != '' ? $_GET['type'] : '';
$_contract = $_GET['contract'] != '' ? $_GET['contract'] : '';

// Start the Query
$v_args = array(
        'post_type'     =>  'property', // your CPT
        's'             =>  $_name, // looks into everything with the keyword from your 'name field'
        'meta_or_tax' => FALSE,

        'tax_query'    =>  array(
        					'relation' => 'OR',
                                array(
                                    'taxonomy'     => 'type', // assumed your meta_key is 'car_model'
                                    'field'    => 'term_id',
                                    'terms'   => $_type,
                                ),
                       		  array(
                                    'taxonomy'     => 'location', // assumed your meta_key is 'car_model'
                                    'field'    => 'term_id',
                                    'terms'   => $_location,
                                ),

                            ),
      	'meta_query'    =>  array(
      						'relation' => 'AND',
                                array(
                                    'key'     => '_realest_contract', // assumed your meta_key is 'car_model'
                                    'value'   => $_contract,
                                    'compare' => '=', // finds models that matches 'model' from the select field
                                )),
    );
$vehicleSearchQuery = new WPSE_OR_Query( $v_args );

// Open this line to Debug what's query WP has just run
 //var_dump($vehicleSearchQuery->request);

// Show the results
if( $vehicleSearchQuery->have_posts() ) :
    while( $vehicleSearchQuery->have_posts() ) : $vehicleSearchQuery->the_post();
        the_title(); // Assumed your cars' names are stored as a CPT post title
    endwhile;
else :
    _e( 'Sorry, nothing matched your search criteria', 'textdomain' );
endif;
wp_reset_postdata();
?>

		</main><!-- #main -->
				<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="secondary" class="widget-area col-3-12" role="complementary">

		<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
		<?php endif; ?>
	</div><!-- #primary -->

<?php get_footer(); ?>