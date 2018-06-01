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
class Pt_Real_Estate_Proffesional_Customizations {

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
	public function __construct() {

		$this->templates = array();

		add_action('init', array($this, 'init'));
		add_action( 'customization', array($this, 'realest_customization' ));
	}

	public static function init(){
		
	}


public function realest_remove_upsell () {
	wp_enqueue_style( 'admine', REALEST_DIR . 'admin/css/style.css', array(), $this->version, 'all' );

}
public function realest_customization() {


Kirki::add_config( 'pt-real-estate-proffesional', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

/*
**GENERRAL SETTINGS
*/
Kirki::add_panel( 'general', array(
    'priority'    => 2,
    'title'       => __( 'General', 'pt-real-estate-proffesional' ),
    'description' => __( 'General Settings', 'pt-real-estate-proffesional' ),
) );

Kirki::add_panel( 'single', array(
    'priority'    => 3,
    'title'       => __( 'Single Property', 'pt-real-estate-proffesional' ),
    'description' => __( 'Single Property Settings', 'pt-real-estate-proffesional' ),
) );
/*Kirki::add_section( 'sort_section', array(
    'title'          => __( 'Sort Front Page', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    //'panel' 		 => 'general',
) );
*/
Kirki::add_section( 'maps_section', array(
    'title'          => __( 'Google Maps API', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'general',

) );

Kirki::add_section( 'general_section', array(
    'title'          => __( 'General Settings', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'general',
) );

Kirki::add_section( 'contact_section', array(
    'title'          => __( 'Contacts', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'general',
) );
Kirki::add_section( 'footer_section', array(
    'title'          => __( 'Footer Settings', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'general',
) );

Kirki::add_section( 'property_section', array(
    'title'          => __( 'Property Listing', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'section',
) );

Kirki::add_section( 'search_section', array(
    'title'          => __( 'Search Properties', 'pt-real-estate-proffesional' ),
    'description'    => __( 'search', 'pt-real-estate-proffesional' ),
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'section',
) );
Kirki::add_section( 'testimonial_section', array(
    'title'          => __( 'Testimonials', 'pt-real-estate-proffesional' ),
    'description'    => __( 'Testimonials Sections', 'pt-real-estate-proffesional' ),
    'priority'       => 6,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'section',
) );

Kirki::add_section( 'property_details', array(
    'title'          => __( 'Property Details', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'single',
) );
Kirki::add_section( 'amenities', array(
    'title'          => __( 'Amenities', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'single',
) );
Kirki::add_section( 'video_tour', array(
    'title'          => __( 'Video Tour', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'single',
) );
Kirki::add_section( 'location', array(
    'title'          => __( 'location', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'single',
) );
//property section 
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'text',
	'settings' => 'property-section-title',
	'label'    => __( 'Section title', 'pt-real-estate-proffesional' ),
	'section'  => 'property_section',
	'priority' => 2,
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'number',
	'settings' => 'realest-property-number',
	'label'    => __( 'Number of Posts', 'pt-real-estate-proffesional' ),
	'section'  => 'property_section',
	'default'  => 6,
	'priority' => 2,
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'realest-featured-properties',
	'label'       => __( 'Show Featured properties Only', 'pt-real-estate-proffesional' ),
	'section'     => 'property_section',
	'default'     => '0',
	'priority'    => 2,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
//Google Maps API

/*Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'text',
	'settings' => 'realest_maps',
	'label'    => __( 'Your Google Maps API', 'pt-real-estate-proffesional' ),
	'section'  => 'maps_section',
    'description'    => __( 'Enter Google maps API here. <a traget="_blank" href="https://thepixeltribe.com/how-to-fix-google-maps-api-error-missingkeymaperror-on-wordpress/">How to get Your API from Google</a> ', 'pt-real-estate-proffesional' ),
	'priority' => 1,
) );
*/

//Currency

Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'text',
	'settings' => 'realest_currency',
	'label'    => __( 'Currency', 'pt-real-estate-proffesional' ),
	'section'  => 'general_section',
	'default'  => esc_attr__( '$', 'pt-real-estate-proffesional' ),
	'priority' => 1,
) );


//Contacts & Social
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'realest_topbar_switch',
	'label'       => __( 'Toggle Top bar', 'pt-real-estate-proffesional' ),
	'section'     => 'contact_section',
	'default'     => '0',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'text',
	'settings' => 'realest_tel',
	'label'    => __( 'Telephone', 'pt-real-estate-proffesional' ),
	'section'  => 'contact_section',
	'default'  => esc_attr__( '$', 'pt-real-estate-proffesional' ),
	'priority' => 2,
) );

Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'email',
	'settings' => 'realest_mail',
	'label'    => __( 'Email', 'pt-real-estate-proffesional' ),
	'section'  => 'contact_section',
	'default'  => esc_attr__( '$', 'pt-real-estate-proffesional' ),
	'priority' => 2,
) );

Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'text',
	'settings' => 'realest_fb',
	'label'    => __( 'Facebook', 'pt-real-estate-proffesional' ),
	'section'  => 'contact_section',
	'priority' => 4,
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'text',
	'settings' => 'realest_twitter',
	'label'    => __( 'Twitter', 'pt-real-estate-proffesional' ),
	'section'  => 'contact_section',
	'priority' => 4,
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'text',
	'settings' => 'realest_link',
	'label'    => __( 'LinkedIn', 'pt-real-estate-proffesional' ),
	'section'  => 'contact_section',
	'priority' => 4,
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'text',
	'settings' => 'realest_google',
	'label'    => __( 'G+', 'pt-real-estate-proffesional' ),
	'section'  => 'contact_section',
	'priority' => 4,
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'text',
	'settings' => 'realest_youtube',
	'label'    => __( 'YouTube', 'pt-real-estate-proffesional' ),
	'section'  => 'contact_section',
	'priority' => 4,
) );

//Home Page Slider
Kirki::add_section( 'slider_section', array(
    'title'          => __( 'Property Slider', 'pt-real-estate-proffesional' ),
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'general',
    'description'    => __( 'The Property sliders displays properties that have the "featured" checkbox ticked', 'pt-real-estate-proffesional' ),
) );

Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'realest_slider_switch',
	'label'       => __( 'Toggle Slider', 'pt-real-estate-proffesional' ),
	'section'     => 'slider_section',
	'default'     => '0',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );

Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'     => 'number',
	'settings' => 'realest_slides_number',
	'label'    => __( 'Number of Slides', 'pt-real-estate-proffesional' ),
	'section'  => 'slider_section',
	'default'  => 3,
	'priority' => 2,
) );

/*SECTIONS */
//general settings
Kirki::add_section( 'general', array(
    'title'          => __( 'General', 'pt-real-estate-proffesional' ),
    'description'    => __( 'General Settings', 'pt-real-estate-proffesional' ),
    'panel'          => '', // Not typically needed.
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'panel' 		 => 'general',
) );
//Home Page
Kirki::add_panel( 'section', array(
    'priority'    => 2,
    'title'       => __( 'Front Page Sections', 'pt-real-estate-proffesional' ),
    'description' => __( 'Front Page Sections', 'pt-real-estate-proffesional' ),
) );


Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'color',
	'settings'    => 'realest_footerz_bg_color',
	'label'       => __( 'Footer background color', 'pt-real-estate-proffesional' ),
	'section'     => 'footer_section',
	'default'     => '#333',
	'priority'    => 1,
	'choices'     => array(
		'alpha' => true,
	),
	array(
		'element' => '.site-footer',
		'property' => 'background-color',
		),
));

Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'color',
	'settings'    => 'realest_footerz_text_color',
	'label'       => __( 'Footer Text Color', 'pt-real-estate-proffesional' ),
	'section'     => 'footer_section',
	'default'     => '#ccc',
	'priority'    => 1,
	'choices'     => array(
		'alpha' => true,
	),
	array(
		'element' => '#colophon a, #colophon, .site-footer .widget',
		'property' => 'color',
		),
));

//Sort Setions
/*
Kirki::add_section( 'sort_sections', array(
    'title'          => __( 'Sort Front Page Sections', 'pt-real-estate-proffesional' ),
    'description'    => __( 'Drag to Sort the Front Page Sections', 'pt-real-estate-proffesional' ),
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
) );

Kirki::add_field( 'pt-real-estate-proffesional', array(
    'type'        => 'sortable',
    'settings'    => 'realest_sort_front_page',
    'label'       => __( 'Sort Front page Sections', 'pt-real-estate-proffesional' ),
    'section'     => 'sort_sections',

    'choices'     => array(
    	'search' => esc_attr__( 'Search', 'kirki' ),
        'services' => esc_attr__( 'Services', 'kirki' ),
        'about' => esc_attr__( 'About Us', 'kirki' ),
        'properties' => esc_attr__( 'Properties', 'kirki' ),
        'blog' => esc_attr__( 'Blog', 'kirki' ),
        'testimonial' => esc_attr__( 'Testimonials', 'kirki' ),
        'address' => esc_attr__( 'Contact Us', 'kirki' ),
    ),
    'priority'    => 10,
) );
*/

//Switches
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'search-switch',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'search_section',
	'default'     => '0',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );

Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'service-switch',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'services_section',
	'default'     => '0',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'about-switch',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'about_section',
	'default'     => '0',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'property-switch',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'property_section',
	'default'     => '0',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'blog-switch',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'blog_section',
	'default'     => '0',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'testimonial-switch',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'testimonial_section',
	'default'     => '0',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'contacts-switch',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'address_section',
	'default'     => '0',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );

//Single Property Options
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'property-details-switch',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'property_details',
	'default'     => '1',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'amenities-switch',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'amenities',
	'default'     => '1',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'video_tour',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'video_tour',
	'default'     => '1',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
Kirki::add_field( 'pt-real-estate-proffesional', array(
	'type'        => 'switch',
	'settings'    => 'location',
	'label'       => __( 'Show This Section', 'pt-real-estate-proffesional' ),
	'section'     => 'location',
	'default'     => '1',
	'priority'    => 1,
	'choices'     => array(
		'on'  => esc_attr__( 'Enable', 'pt-real-estate-proffesional' ),
		'off' => esc_attr__( 'Disable', 'pt-real-estate-proffesional' ),
	),
) );
}}