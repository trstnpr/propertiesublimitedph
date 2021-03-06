<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://thepixeltribe.com
 * @since      1.0.0
 *
 * @package    Pt_Real_Estate_Proffesional
 * @subpackage Pt_Real_Estate_Proffesional/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pt_Real_Estate_Proffesional
 * @subpackage Pt_Real_Estate_Proffesional/public
 * @author     Pixel Tribe <support@thepixeltribe.com>
 */
class Pt_Real_Estate_Proffesional_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_styles' ));
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts' ));
		add_action( 'admin_enqueue_scripts', array($this, 'admin_scripts'));
	}

	public static function init(){

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pt_Real_Estate_Proffesional_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pt_Real_Estate_Proffesional_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pt-real-estate-proffesional-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pt_Real_Estate_Proffesional_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pt_Real_Estate_Proffesional_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pt-real-estate-proffesional-public.js', array( 'jquery' ), $this->version, true );

	  	//GOOGLE MAPS API
   		 $maps = get_theme_mod('realest_maps');
  		 $mapsapi = "https://maps.googleapis.com/maps/api/js?libraries=places&key=" . ($maps);

    	 wp_enqueue_script( 'realestate-google-maps', $mapsapi ,false );
	}

	/**
	 * Register the JavaScript for the Admin-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function admin_scripts() {
	  	//GOOGLE MAPS API
   		 $maps = get_theme_mod('realest_maps');
  		 $mapsapi = "https://maps.googleapis.com/maps/api/js?libraries=places&key=" . ($maps);

    	 wp_enqueue_script( 'realestate-google-maps', $mapsapi ,false );
	}
}
Pt_Real_Estate_Proffesional_Public::init();