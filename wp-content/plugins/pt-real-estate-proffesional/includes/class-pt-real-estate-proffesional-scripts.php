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
class Pt_Real_Estate_Proffesional_Scripts{

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
  public function __construct( ) {


    add_action( 'init', array($this, 'enqueue_frontend' ));
    add_action( 'wp_enqueue_scripts', array($this, 'enqueue_backend' ));

  }

  public static function init(){


  }

 	/* Loads frontend files
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue_frontend() {

  //GOOGLE MAPS API
    $maps = get_theme_mod('realest_maps');
    
    $mapsapi = "https://maps.googleapis.com/maps/api/js?libraries=places&key=" . ($maps);

    wp_enqueue_script( 'realestate-google-maps', $mapsapi  );

	  wp_enqueue_style('flexlsider', REALEST_DIR . '/public/css/flexslider.css');

    wp_enqueue_script('realest-slider', REALEST_DIR . '/public/js/slider.js', array( 'jquery' ), '1.3.0', true);

    wp_enqueue_script('realest-pro-scripts', REALEST_DIR . '/public/js/scripts.js', array('jquery'), '1.3.0', true);

	}	


 	/* Loads backend files
	 *
	 * @access public
	 * @return void
	 */
	public function enqueue_backend() {



	}	
}
Pt_Real_Estate_Proffesional_Scripts::init();