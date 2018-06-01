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
class Pt_Real_Estate_Proffesional_Metaboxes {

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
    public function __construct(  ) {

        add_action('init', array(&$this, 'init'));
        add_action( 'cmb2_admin_init', array($this, 'property_metaboxes' ));
        add_action( 'cmb2_admin_init', array($this, 'agents_metaboxes' ));
        add_action( 'cmb2_init', array($this, 'realest_agents_to_property' ));

    }

    public static function init(){

    }


    
/**
 * Define the metabox and field configurations.
 */
public function property_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_realest_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'realest_metabox',
        'title'         => __( 'Property Features', 'cmb2' ),
        'object_types'  => array( 'property', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

$cmb->add_field( array(
    'name' => 'Property ID',
    'id'   =>  $prefix . 'ID',
    'type' => 'text',
    // 'timezone_meta_key' => 'wiki_test_timezone',
    // 'date_format' => 'l jS \of F Y',
) );


$cmb->add_field( array(
    'name' => 'Price',
    'desc' => 'Sale/Rental Price',
    'id' => $prefix . 'price',
    'type' => 'text',
    // 'before_field' => '£', // Replaces default '$'
) );

$cmb->add_field( array(
    'name'    => 'Contract',
    'id'      => $prefix . 'contract',
    'type'    => 'radio_inline',
    'options' => array(
        'rental' => __( 'Rental', 'cmb2' ),
        'sale'   => __( 'Sale', 'cmb2' ),
        'sold'   => __( 'Sold', 'cmb2' ),
    ),
    'default' => 'rental',
) );

$cmb->add_field( array(
    'name' => 'Date Built',
    'id'   =>  $prefix . 'year',
    'type' => 'text_date_timestamp',
    // 'timezone_meta_key' => 'wiki_test_timezone',
    // 'date_format' => 'l jS \of F Y',
) );

$cmb->add_field( array(
    'name'    => 'Featured',
    'desc'    => 'Featured Property',
    'id'      =>  $prefix . 'featured',
    'type'    => 'checkbox',
    'options' => array(
        'featured' => 'featured',
    ),
) );
    // Regular text field
    $cmb->add_field( array(
        'name'       => __( 'Rooms', 'pt-real-estate-proffesional' ),
        'desc'       => __( 'Number of Rooms', 'pt-real-estate-proffesional' ),
        'id'         => $prefix . 'rooms',
        'type'       => 'text',
        'show_on_cb' => 'realest_hide_if_no_cats', // function should return a bool value
        // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
        // 'on_front'        => false, // Optionally designate a field to wp-admin only
        // 'repeatable'      => true,
    ) );

$cmb->add_field( array(
    'name'    => 'Bed room',
    'desc'    => 'Number of Bedrooms',
    'id'      => $prefix . 'bedrooms',
    'type'    => 'text',
) );

$cmb->add_field( array(
    'name'    => 'Baths',
    'desc'    => 'Number of Bathrooms',
    'id'      => $prefix . 'baths',
    'type'    => 'text',
) );

$cmb->add_field( array(
    'name'    => 'garage',
    'desc'    => 'number of garages',
    'default' => '0',
    'id'      => $prefix . 'garages',
    'type'    => 'text',
) );

$cmb->add_field( array(
    'name'    => 'Lot Area',
    'desc'    => 'Area in Meters',
    'id'      => $prefix . 'area',
    'type'    => 'text',
) );



$cmb->add_field( array(
    'name'    => 'Suffix',
    'desc'    => 'If is rental, add pm or pa',
    'id'      => $prefix . 'suffix',
    'type'    => 'text',
) );

$cmb->add_field( array(
    'name'    => 'Sold',
    'desc'    => 'If property is sold, check this',
    'id'      =>  $prefix . 'sold',
    'type'    => 'checkbox',
    'options' => array(
        'check1' => 'Sold',
    ),
) );


$cmb->add_field( array(
    'name' => 'Property Video',
    'desc' => 'Enter a youtube or Vimeo URL.',
    'id'   => $prefix . 'property_video',
    'type' => 'oembed',
) );
$cmb->add_field( array(
    'name' => 'Property Gallery',
    'desc' => 'Upload all property images here',
    'id'   =>  $prefix . 'gallery',
    'type' => 'file_list',
    // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
    // Optional, override default text strings
    'text' => array(
        'add_upload_files_text' => 'Add or Upload Images', // default: "Add or Upload Files"
        'remove_image_text' => 'Remove Image', // default: "Remove Image"
        'file_text' => 'Image', // default: "File:"
        'file_download_text' => 'Replacement', // default: "Download"
        'remove_text' => 'Remove', // default: "Remove"
    ),
) );

$cmb->add_field( array(
    'name' => 'Property Address',
    'desc' => 'Physical Address',
    'id' =>  $prefix . 'address',
    'type' => 'textarea'
) );

$cmb->add_field( array(
    'name'    => 'Zip / Postcode',
    'id'      => $prefix . 'postcode',
    'type'    => 'text',
) );

$cmb->add_field(array(
    'name' => 'Location',
    'desc' => 'Drag the marker to set the exact location',
    'id' => $prefix . 'location',
    'type' => 'pw_map',
    // 'split_values' => true, // Save latitude and longitude as two separate fields
) );
}


/**
 * Define the metabox and field configurations.
 */
public function agents_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'agent_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'realest_agent_metabox',
        'title'         => __( 'Agent Contacts', 'cmb2' ),
        'object_types'  => array( 'agent', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

   // Regular text field

    $cmb->add_field( array(
        'name'       => __( 'title', 'cmb2' ),
        'desc'       => __( 'Your Title, e.g Owner, Landlord, Agent etc', 'cmb2' ),
        'id'         => $prefix . 'title',
        'type'       => 'text',
    ) );
    $cmb->add_field( array(
        'name'       => __( 'Telephone', 'cmb2' ),
        'desc'       => __( 'Telephone Number', 'cmb2' ),
        'id'         => $prefix . 'telephone',
        'type'       => 'text',
    ) );
    $cmb->add_field( array(
        'name'       => __( 'Mobile', 'cmb2' ),
        'desc'       => __( 'Mobile Number', 'cmb2' ),
        'id'         => $prefix . 'mobile',
        'type'       => 'text',
    ) );

    // Email text field
    $cmb->add_field( array(
        'name' => __( 'Email', 'cmb2' ),
        'desc' => __( 'Email Address', 'cmb2' ),
        'id'   => $prefix . 'email',
        'type' => 'text_email',
        // 'repeatable' => true,
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Address', 'cmb2' ),
        'desc'       => __( 'Your Location', 'cmb2' ),
        'id'         => $prefix . 'address',
        'type'       => 'text',
    ) );
    }



//Add Property/Agent relationship 
/*
 * Example setup for the custom Attached Posts field for CMB2.
 */

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function realest_agents_to_property() {
    $example_meta = new_cmb2_box( array(
        'id'           => 'cmb2_attached_posts_field',
        'title'        => __( 'Assign Agent', 'cmb2' ),
        'object_types' => array( 'property' ), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => false, // Show field names on the left
    ) );
    $example_meta->add_field( array(
        'name'    => __( 'Assign Agent', 'cmb2' ),
        'desc'    => __( 'Drag agents from the left column to the right column to attach them to this property.<br />You may rearrange the order of the agents in the right column by dragging and dropping.', 'cmb2' ),
        'id'      => 'attached_cmb2_attached_posts',
        'type'    => 'custom_attached_posts',
        'options' => array(
            'show_thumbnails' => true, // Show thumbnails on the left
            'filter_boxes'    => true, // Show a text box for filtering the results
            'query_args'      => array(
                'posts_per_page' => 10,
                'post_type'      => 'agent',
            ), // override the get_posts args
        ),
    ) );

}
}
Pt_Real_Estate_Proffesional_Metaboxes::init();