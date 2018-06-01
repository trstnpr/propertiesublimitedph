<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://thepixeltribe.com
 * @since      1.0.0
 *
 * @package    Pt_Real_Estate_Proffesional
 * @subpackage Pt_Real_Estate_Proffesional/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pt_Real_Estate_Proffesional
 * @subpackage Pt_Real_Estate_Proffesional/admin
 * @author     Pixel Tribe <support@thepixeltribe.com>
 */

Pt_Real_Estate_Proffesional_Functions::init();

class Pt_Real_Estate_Proffesional_Functions {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plugin_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct() {
    $this->templates = array();
    
    add_shortcode('property-listing', array( $this, 'realest_properties_query_shortcode' ) , 30 );
    add_action( 'realest_top_bar', array( $this, 'realest_top_bar' ) , 30 ); 
    add_action( 'slider', array( $this, 'realest_main_slider' ) , 30 ); 
    add_action( 'realest_display_properties', array( $this, 'realest_properties_query' ) , 30 ); 
    add_action( 'realest_display_search_form' , array( $this, 'realest_search') , 30 );
    add_action( 'realest_display_testimonials', array( $this, 'realest_testimonials') , 30 );
    add_action( 'realest_single_slider', array( $this, 'single_property_slider') , 30 );
    add_action('init', array( $this, 'remove_upgrade'), 15);
    add_action( 'wp_enqueue_scripts', array($this, 'load_google_scripts' ), 10);
    
  }
	
	public static function init() {

  
	}


public static function single_property_slider() {
    ob_start();
    // Get the list of files
    $files = get_post_meta( get_the_ID(), '_realest_gallery', 1 );

    echo '<div id="slider" class="flexslider"><ul class="slides">';
    // Loop through them and output an image
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
        echo '<li>';
        echo wp_get_attachment_image( $attachment_id, 'realest_property_slider' );
        echo '</li>';

    }
    echo '</ul></div>';

    echo '<div id="carousel" class="flexslider"><ul class="slides">';
    // Loop through them and output an image
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
        echo '<li>';
        echo wp_get_attachment_image( $attachment_id, 'thumbnail' );
        echo '</li>';

    }
    echo '</ul></div>';
    $property_slider = ob_get_clean();
    return $property_slider;
}
public static function realest_property_details(){
    echo '<ul class="pdetails">';
            $year = get_post_meta( get_the_ID(), '_realest_year', true );
            if ( ! empty( $year ) ) :

                $timestamp= $year;
                $yr = gmdate("Y", $timestamp);

               echo '<li>' . esc_html__( 'Year Built: ', 'pt-real-estate-proffesional' ) , esc_attr( $yr ) .'</li>';
            endif;

            $ID = get_post_meta( get_the_ID(), '_realest_ID', true );
            if ( ! empty( $ID ) ) :
               echo '<li>' . esc_html__( 'Property ID: ', 'pt-real-estate-proffesional' ), esc_attr( $ID ) .'</li>';
            endif;

            $rooms = get_post_meta( get_the_ID(), '_realest_rooms', true );
            if ( ! empty( $rooms ) ) :
               echo '<li>' . esc_html__( 'Rooms: ', 'pt-real-estate-proffesional' ), esc_attr( $rooms ) .'</li>';
            endif;

            $bedrooms = get_post_meta( get_the_ID(), '_realest_bedrooms', true );
            if ( ! empty( $bedrooms ) ) :
               echo '<li>' . esc_html__( 'Beds: ', 'pt-real-estate-proffesional' ), esc_attr( $bedrooms ) .'</li>';
            endif;

            $baths = get_post_meta( get_the_ID(), '_realest_baths', true );
            if ( ! empty( $baths ) ) :
               echo '<li>' . esc_html__( 'Baths: ', 'pt-real-estate-proffesional' ), esc_attr( $baths ) .'</li>';
            endif;

            $garages = get_post_meta( get_the_ID(), '_realest_garages', true );
            if ( ! empty( $garages ) ) :
               echo '<li>' . esc_html__( 'garages: ', 'pt-real-estate-proffesional' ), esc_attr( $garages ) .'</li>';
            endif;

            $lot = get_post_meta( get_the_ID(), '_realest_area', true );
            if ( ! empty( $lot ) ) :
               echo '<li>' . esc_html__( 'Lot Area: ', 'pt-real-estate-proffesional' ), esc_attr( $lot ) .'</li>';
            endif;

            $contract = get_post_meta( get_the_ID(), '_realest_contract', true );
            if ( ! empty( $lot ) ) :
               echo '<li>' . esc_html__( 'Contract: ', 'pt-real-estate-proffesional' ), esc_attr( $contract ) .'</li>';
            endif;

    echo '</ul>';
}

public function realest_slider_property_details(){
    echo '<ul class="pdetails cleared">';
            $year = get_post_meta( get_the_ID(), '_realest_year', true );
            if ( ! empty( $year ) ) :

                $timestamp= $year;
                $yr = gmdate("Y", $timestamp);

               echo '<li>' . esc_attr__( 'Year Built: ', 'pt-real-estate-proffesional' ) , '<span>' .  $yr .'</span></li>';
            endif;


            $rooms = get_post_meta( get_the_ID(), '_realest_rooms', true );
            if ( ! empty( $rooms ) ) :
               echo '<li>' . esc_html__( 'Rooms: ', 'pt-real-estate-proffesional' ), '<span>' . $rooms . '</span></li>';
            endif;

            $bedrooms = get_post_meta( get_the_ID(), '_realest_bedrooms', true );
            if ( ! empty( $bedrooms ) ) :
               echo '<li>' . esc_html__( 'Beds: ', 'pt-real-estate-proffesional' ), '<span>' .$bedrooms  .'</span></li>';
            endif;

            $baths = get_post_meta( get_the_ID(), '_realest_baths', true );
            if ( ! empty( $baths ) ) :
               echo '<li>' . esc_html__( 'Baths: ', 'pt-real-estate-proffesional' ), '<span>' . $baths .'</span></li>';
            endif;

            $garages = get_post_meta( get_the_ID(), '_realest_garages', true );
            if ( ! empty( $garages ) ) :
               echo '<li>' . esc_html__( 'garages: ', 'pt-real-estate-proffesional' ), '<span>' . $garages .'</span></li>';
            endif;

            $lot = get_post_meta( get_the_ID(), '_realest_area', true );
            if ( ! empty( $lot ) ) :
               echo '<li>' . esc_html__( 'Lot Area: ', 'pt-real-estate-proffesional' ), '<span>' . $lot  .'</li>';
            endif;

    echo '</ul>';
}



public static function realest_property_amenities(){
  ob_start();
    echo '<ul class="double">';
    global $post;
              $terms = wp_get_post_terms( get_the_ID(), 'amenity');

        foreach ( $terms as $term) { 
                         echo '<li>' . $term->name .'</li>';
                        }   
                        echo '</ul>';

     $output = ob_get_clean();
     //print $output; // debug
     return $output;
}
public static function realest_property_map(){
$mapGPS =  get_post_meta( get_the_ID(), '_realest_location', 1 );
                
?>
<div id="gmap_canvas" style="height:500px;width:100%;"></div>
<script type="text/javascript">
    function init_map(){
        // Options
        var myOptions = {
            zoom:14,
            center:new google.maps.LatLng(<?php echo $mapGPS[latitude]; ?>,<?php echo $mapGPS[longitude]; ?>)
        };
        // Setting map using options
        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
        // Setting marker to our GPS coordinates
        marker = new google.maps.Marker({map: map,clickable: false,position: new google.maps.LatLng(<?php echo $mapGPS[latitude]; ?>,<?php echo $mapGPS[longitude]; ?>)});
    }
    // Initializes google map
    google.maps.event.addDomListener(window, 'load', init_map);
</script>
<?php
}

function realest_contract_type() {
    $contracts = get_post_meta( get_the_ID(), '_realest_contract', true);
    if ( $contracts != '') {
      switch ( $contracts ) {
        case 'rental':
          echo '<div class="contract">' .  esc_html( 'Rent', 'pt-real-estate-proffesional' ) .'</div>';
          break;
        
        case 'sale' :
          echo '<div class="contract">' .  esc_html( 'For Sale', 'pt-real-estate-proffesional' ) .'</div>';
          break;
      }
    
           }
}

public function realest_properties_query() {
  global $post;
ob_start();
$propertyno = get_theme_mod('realest-property-number');

 echo "<div class='section props'><div class='grid'>";

if ( get_theme_mod('realest-featured-properties') != 0 ) {
  $args = array(

    
    //Type & Status Parameters
    'post_type'   => 'property',
  
    //Pagination Parameters
    'posts_per_page'  => $propertyno,

    'meta_query' => array(
        array(
            'key'     => '_realest_featured',
        ),
    ),
  
  );
} else {

  $args = array(

    
    //Type & Status Parameters
    'post_type'   => 'property',
  
    //Pagination Parameters
    'posts_per_page'  => $propertyno,
  
  );

}
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
      <?php //if (term_exists($term, 'location')) { ?>
        <i class="fa fa-map-marker"></i>
        <?php the_terms( $post->ID, 'location' ); ?>
      <?php  //} ?>
      </span>
      
          <?php $beds = get_post_meta( get_the_ID(), '_realest_bedrooms', true ); ?>
          <?php if ( ! empty( $beds ) ) : ?>
            <li><i class="fa fa-bed"></i><span><?php echo esc_html__( 'Beds', 'pt-real-estate-proffesional' ); ?></span><span class="alignright"><?php echo esc_attr( $beds ); ?></span></li>
          <?php endif; ?>

          <?php $baths = get_post_meta( get_the_ID(), '_realest_baths', true ); ?>
          <?php if ( ! empty( $baths ) ) : ?>
            <li><i class="fa fa-shower"></i><span><?php echo esc_html__( 'Baths', 'pt-real-estate-proffesional' ); ?></span><span class="alignright"><?php echo esc_attr( $baths ); ?></span></li>
          <?php endif;?>

          <?php $rooms = get_post_meta( get_the_ID(), '_realest_rooms', true ); ?>
          <?php if ( ! empty( $rooms ) ) : ?>
            <li><i class="fa fa-th-large"></i><span><?php echo esc_html__( 'Rooms', 'pt-real-estate-proffesional' ); ?></span><span class="alignright"><?php echo esc_attr( $rooms ); ?></span></li>
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

     $propertiez = ob_get_clean();
     //print $output; // debug
     echo $propertiez;
}

public function realest_main_slider() {

ob_start();
if ( get_theme_mod('realest_slider_switch') != 0 ) { ?>

<div class="slider">

<?php
$nPosts = esc_html( get_theme_mod ('realest_slides_number'));

$filters = array(
  'post_type' => 'property',

  'posts_per_page' =>  3,
  );
// The Query
$property_query = new WP_Query( $filters );

// The Loop
if ( $property_query->have_posts() ) { ?>
<ul class="rslides">
<?php
  while ( $property_query->have_posts() ) {
    $property_query->the_post(); ?>
    
<li class="instance cleared">
    <div class="slider-image ig-mayfair">
    <?php the_post_thumbnail('slider'); ?>
    </div>
    <div class="grid">
      <div class="slider-info col-5-12 cleared">
        <h2 class="widget-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
          <?php
          Pt_Real_Estate_Proffesional_Functions::realest_contract_type();
          $location = get_post_meta( get_the_ID(), '_realest_address', true )
                  ?>
            <span>
            <i class="fa fa-map-marker"></i><?php echo esc_html( $location ); ?>
            </span>
          
          <?php $price = get_post_meta( get_the_ID(), '_realest_price', true ); ?>
          <?php if ( ! empty( $price ) ); { ?>
            <div class="price">
             <?php echo get_theme_mod('realest_currency'); echo esc_html( $price ); ?> 
             </div>
          <?php } ?>
        <?php Pt_Real_Estate_Proffesional_Functions::realest_slider_property_details(); ?>
      </div>
    </div>
</li>
    
  <?php } ?>
  </ul>
  <div class="navcontrols"></div>
<?php } else {
  // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

     $slider = ob_get_clean();
     //print $output; // debug
     echo $slider;
     echo "</div>";
}
}




public function realest_properties_query_shortcode( $atts , $content = NULL ) {

ob_start();

//Attributes
$atts = shortcode_atts( array(
        'contract' => array( 'rental', 'sale'),
        ), $atts
);
 echo "<div class='grid'>";
 $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $args = array(

    
    //Type & Status Parameters
    'post_type'   => 'property',
    'posts_per_page' => 12,
    'paged' => $paged,
  
    'meta_query' => array(
                    array(
                        'key' => '_realest_contract',
                        'value' => $atts['contract'],
                        'compare' => 'IN',
                    )
                )
  
  );

$the_query = new WP_Query( $args );


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
          <span class="featured"><?php  echo esc_html__( 'Featured', 'pt-real-estate-proffesional' ); ?></span>
        <?php endif; ?>
      </div>

      <ul class="property-info">
      <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
      <span class="location-marker">
        <i class="fa fa-map-marker"></i><?php //echo esc_html( $location ); ?><?php the_terms( $post->ID, 'location' ); ?>
      </span>
          <?php $beds = get_post_meta( get_the_ID(), '_realest_bedrooms', true ); ?>
          <?php if ( ! empty( $beds ) ) : ?>
            <li><i class="fa fa-bed"></i><span><?php echo esc_html__( 'Beds', 'pt-real-estate-proffesional' ); ?></span><span class="alignright"><?php echo esc_attr( $beds ); ?></span></li>
          <?php endif; ?>

          <?php $baths = get_post_meta( get_the_ID(), '_realest_baths', true ); ?>
          <?php if ( ! empty( $baths ) ) : ?>
            <li><i class="fa fa-shower"></i><span><?php echo esc_html__( 'Baths', 'pt-real-estate-proffesional' ); ?></span><span class="alignright"><?php echo esc_attr( $baths ); ?></span></li>
          <?php endif;?>

          <?php $rooms = get_post_meta( get_the_ID(), '_realest_rooms', true ); ?>
          <?php if ( ! empty( $rooms ) ) : ?>
            <li><i class="fa fa-th-large"></i><span><?php echo esc_html__( 'Rooms', 'pt-real-estate-proffesional' ); ?></span><span class="alignright"><?php echo esc_attr( $rooms ); ?></span></li>
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
    echo '<div class="col-1-1">';
                
                $GLOBALS['wp_query']->max_num_pages = $the_query->max_num_pages;
                the_posts_pagination( array(
                   'mid_size' => 1,
                   'prev_text' => __( 'Back', 'green' ),
                   'next_text' => __( 'Next', 'green' ),
                   'screen_reader_text' => __( 'Posts navigation' )
                ) ); 
    echo '</div>';
echo "</div></div>";

     $output = ob_get_clean();
     //print $output; // debug
     return $output;
}

public function realest_top_bar(){

 if ( get_theme_mod('realest_topbar_switch') != 0 ) { ?>
  <div class="top-bar">
  <div class="grid">
  
  <ul class="bar-top pull-left">
    <li><?php if ( get_theme_mod( 'realest_tel' ) ) { ?><i class="fa fa-phone"></i> <?php echo esc_attr( get_theme_mod('realest_tel')); } ?></li>
    <li><?php if ( get_theme_mod( 'realest_mail' ) ) { ?><i class="fa fa-envelope"></i> <?php echo esc_attr( get_theme_mod('realest_mail')); } ?></li>
  </ul>

  </ul>
    <ul class="bar-top pull-right hide-on-mobile">
    <?php if ( get_theme_mod( 'realest_fb' ) ) { ?><li><a href="<?php echo esc_url( get_theme_mod('realest_fb')); ?>" class="fb"><i class="fa fa-facebook-official"></i></a></li><?php }?>

    <?php if ( get_theme_mod( 'realest_google' ) ) { ?><li><a href="<?php echo esc_url( get_theme_mod('realest_google'));?>" class="google"><i class="fa fa-google-plus"></i></a></li><?php } ?>

    <?php if ( get_theme_mod( 'realest_twitter' ) ) { ?><li><a href="<?php echo esc_url( get_theme_mod('realest_twitter'));?>" class="twitter"><i class="fa fa-twitter"></i></a></li><?php } ?>

    <?php if ( get_theme_mod( 'realest_youtube' ) ) { ?><li><a href="<?php echo esc_url( get_theme_mod('realest_youtube'));?>" class="tube"><i class="fa fa-youtube-play"></i></a></li><?php } ?>
    
    <?php if ( get_theme_mod( 'realest_link' ) ) { ?><li><a href="<?php echo esc_url( get_theme_mod('realest_link'));?>" class="tube"><i class="fa fa-linkedin"></i></a></li><?php } ?>

  </ul>
  </div>
  </div>
  <?php }}

public function realest_search() {
?>
  <div class="sproperty">
    <div class="grid">

      <h2 class="section-title">Property Search</h2>
      <!-- <h5 class="section-sub-title"> This is a little bit about us</h5> -->

      <form role="search" method="get" class="searchform group property-search" action="<?php echo home_url( '/' ); ?>">

        <input type="hidden" name="search" value="property">

        <div class="col-3-12">
          <?php 
          $location = array(
              'taxonomy'=> 'location',
              'show_count'=> 1,
              'show_option_all' => __('All Locations','pt-real-estate-proffesional'),
              'name'=> 'location',
              'value_field' => 'id',
            );
          wp_dropdown_categories( $location );
          ?>
          </div>
          <div class="col-3-12">
          <?php 
          $type = array(
              'taxonomy'=> 'types',
              'show_count'=> 0,
              'show_option_all' => __('All Property Types','pt-real-estate-proffesional'),
              'name'=> 'type',
              'value_field' => 'id',
            );
          wp_dropdown_categories( $type );

          ?>
        </div>
        <div class="col-3-12">

            <select name="listing_type" id="listing_type">
                
                <option <?php echo (isset($_GET['listing_type']) && $_GET['listing_type'] == 'rent') ? 'selected' : ''?> value=""><?php esc_html_e( 'Contract Type', 'pt-real-estate-proffesional' ); ?></option>

                <option <?php echo (isset($_GET['listing_type']) && $_GET['listing_type'] == 'rent') ?  : ''?> value="rental"><?php esc_html_e( 'Rent', 'pt-real-estate-proffesional' ); ?></option>

                <option <?php echo (isset($_GET['listing_type']) && $_GET['listing_type'] == 'sale') ?  : ''?> value="sale"><?php esc_html_e( 'Sale', 'pt-real-estate-proffesional' ); ?></option>
            </select>

        </div>
        <div class="col-3-12">
         <input type="hidden" name="post_type" value="property" />
         <input type="submit" id="searchsubmit" value="Search" />
         </div>
      </form>

    </div>
  </div>
<?php
}

public function realest_testimonials(){
  ?>
  <div class="section alizarin">
  <div class="grid">
<?php
$arg = array(
    'post_type' => 'testimonial',
);
$testimony = new WP_Query( $arg );

if ($testimony->have_posts()) {
   echo '<div id="slider" class="flexslider testimonial"><ul class="slides">';
  while($testimony->have_posts())  {
    echo"<li class='testimony'>";
    $testimony->the_post();

    if(has_post_thumbnail()){
      echo "<div class='testimonial-avatar'>";
      the_post_thumbnail('thumbnail');
      echo "</div>";
    }

    the_content("<p class='testimony-content'>","</p>");
    the_title();
    echo"</li'>";
    }
  echo "</ul></div>";
    wp_reset_postdata();
}?>

</div>
</div>
<?php
}

public function remove_upgrade()
{
    remove_action('admin_menu', 'real_estate_lite_admin_menu');
}

 /**
 * Enqueue scripts and styles
 */
 public function load_google_scripts() {
  $api_url = '//maps.googleapis.com/maps/api/js?libraries=places';
  $api_key = get_option( 'cmb_field_map_settings_option_name' );
  $api_key = $api_key['cmb_field_map_google_map_api'];
  if ( ! empty( $api_key ) ) {
   $api_url .= '&key=' . $api_key;
   wp_register_script( 'pw-google-maps-api', $api_url, null, null );
  }
  //wp_enqueue_script( 'pt-google-maps', plugins_url( 'js/script.js', __FILE__ ), array( 'pw-google-maps-api' ));
  //wp_enqueue_style( 'pt-google-maps', plugins_url( 'css/style.css', __FILE__ ), array() );
 }
 
public function admin_notice() {

   
    
    echo '<div class="notice notice-info is-dismissible">
          <p>Need help setting up Real Estate Site?  click here for <a class="noticebtn" href="support.thepixeltribe.com/docs/real-estate/">Set Up Guide</a></p>
         </div>';
    

}

}// End Of Functions Class