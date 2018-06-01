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
class Pt_Real_Estate_Proffesional_Posts {

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

		add_action( 'init', array($this, 'realest_post_custom_types' ));
		add_action( 'init', array($this, 'realest_post_taxes' ));
	}

	public static function init(){

	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */


	public function realest_post_custom_types() {

	/**
	 * Post Type: Properties.
	 */

	$labels = array(
		"name" => __( 'Properties', 'pt-real-estate-proffesional' ),
		"singular_name" => __( 'Property', 'pt-real-estate-proffesional' ),
	);

	$args = array(
		"label" => __( 'Properties', 'pt-real-estate-proffesional' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "property", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "custom-fields" ),
	);

	register_post_type( "property", $args );

	/**
	 * Post Type: Agents.
	 */

	$labels = array(
		"name" => __( 'Agents', 'pt-real-estate-proffesional' ),
		"singular_name" => __( 'Agent', 'pt-real-estate-proffesional' ),
	);

	$args = array(
		"label" => __( 'Agents', 'pt-real-estate-proffesional' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "agent", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "agent", $args );

	/**
	 * Post Type: Testimonials.
	 */

	$labels = array(
		"name" => __( 'Testimonials', 'pt-real-estate-proffesional' ),
		"singular_name" => __( 'Testimony', 'pt-real-estate-proffesional' ),
	);

	$args = array(
		"label" => __( 'Testimonials', 'pt-real-estate-proffesional' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "testimonial", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "testimonial", $args );
	}

	public function realest_post_taxes() {

	/**
	 * Taxonomy: Location.
	 */

	$labels = array(
		"name" => __( 'Location', 'pt-real-estate-proffesional' ),
		"singular_name" => __( 'Location', 'pt-real-estate-proffesional' ),
	);

	$args = array(
		"label" => __( 'Location', 'pt-real-estate-proffesional' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Location",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'location', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "location", array( "property" ), $args );

	/**
	 * Taxonomy: Type.
	 */

	$labels = array(
		"name" => __( 'Type', 'pt-real-estate-proffesional' ),
		"singular_name" => __( 'Type', 'pt-real-estate-proffesional' ),
	);

	$args = array(
		"label" => __( 'Type', 'pt-real-estate-proffesional' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Type",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'types', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "types", array( "property" ), $args );

	/**
	 * Taxonomy: Amenities.
	 */

	$labels = array(
		"name" => __( 'Amenities', 'pt-real-estate-proffesional' ),
		"singular_name" => __( 'Amenity', 'pt-real-estate-proffesional' ),
	);

	$args = array(
		"label" => __( 'Amenities', 'pt-real-estate-proffesional' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Amenities",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'amenity', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "amenity", array( "property" ), $args );
	}


}
