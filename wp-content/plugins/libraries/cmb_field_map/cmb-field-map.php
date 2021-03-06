<?php
/*
Plugin Name: CMB2 Field Type: Google Maps
Plugin URI: https://github.com/gareth-gillman/cmb_field_map
GitHub Plugin URI: https://github.com/gareth-gillman/cmb_field_map
Description: Google Maps field type for CMB2.
Version: 2.2
Author: Phil Wylie & Gareth Gillman
Author URI:
License: GPLv2+
*/

/**
 * Class PW_CMB2_Field_Google_Maps
 */
class PW_CMB2_Field_Google_Maps {

	/**
	 * Current version number
	 */
	const VERSION = '2.1.1';

	/**
	 * Initialize the plugin by hooking into CMB2
	 */
	public function __construct() {
		add_filter( 'cmb2_render_pw_map', array( $this, 'render_pw_map' ), 10, 5 );
		add_filter( 'cmb2_sanitize_pw_map', array( $this, 'sanitize_pw_map' ), 10, 4 );
	}

	/**
	 * Render field
	 */
	public function render_pw_map( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		$this->setup_admin_scripts();
          
          $api_key = get_option( 'cmb_field_map_settings_option_name' );
          $api_key = $api_key['cmb_field_map_google_map_api'];
          if(!empty($api_key)) {

           echo '<input type="text" class="large-text pw-map-search" id="' . $field->args( 'id' ) . '" />';
  	   echo '<div class="pw-map"></div>';
           $field_type_object->_desc( true, true );
           echo $field_type_object->input(
            array(
             'type'       => 'hidden',
             'name'       => $field->args('_name') . '[latitude]',
             'value'      => isset( $field_escaped_value['latitude'] ) ? $field_escaped_value['latitude'] : '',
             'class'      => 'pw-map-latitude',
             'desc'       => '',
            )
           );
           echo $field_type_object->input(
            array(
             'type'       => 'hidden',
             'name'       => $field->args('_name') . '[longitude]',
             'value'      => isset( $field_escaped_value['longitude'] ) ? $field_escaped_value['longitude'] : '',
             'class'      => 'pw-map-longitude',
             'desc'       => '',
            )
           );

          } else {
           echo '<div class="pw_map_notice">';
            echo '<p>Please add your Google API Key <a href="'.get_admin_url().'options-general.php?page=cmb-field-map-settings">here</a></p>';
           echo '</div>';
          } // end API Key

	}

	/**
	 * Optionally save the latitude/longitude values into two custom fields
	 */
	public function sanitize_pw_map( $override_value, $value, $object_id, $field_args ) {
		if ( isset( $field_args['split_values'] ) && $field_args['split_values'] ) {
			if ( ! empty( $value['latitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_latitude', $value['latitude'] );
			}

			if ( ! empty( $value['longitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_longitude', $value['longitude'] );
			}
		}

		return $value;
	}

 /**
 * Enqueue scripts and styles
 */
 public function setup_admin_scripts() {
  $api_url = '//maps.googleapis.com/maps/api/js?libraries=places';
  $api_key = get_option( 'cmb_field_map_settings_option_name' );
  $api_key = $api_key['cmb_field_map_google_map_api'];
  if ( ! empty( $api_key ) ) {
   $api_url .= '&key=' . $api_key;
   wp_register_script( 'pw-google-maps-api', $api_url, null, null );
  }
  wp_enqueue_script( 'pw-google-maps', plugins_url( 'js/script.js', __FILE__ ), array( 'pw-google-maps-api' ), self::VERSION );
  wp_enqueue_style( 'pw-google-maps', plugins_url( 'css/style.css', __FILE__ ), array(), self::VERSION );
 }

}
$pw_cmb2_field_google_maps = new PW_CMB2_Field_Google_Maps();

/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class CMBFieldMapSettings {
	private $cmb_field_map_settings_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'cmb_field_map_settings_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'cmb_field_map_settings_page_init' ) );
	}

	public function cmb_field_map_settings_add_plugin_page() {
		add_options_page(
			'CMB Field Map Settings', // page_title
			'CMB Field Map Settings', // menu_title
			'manage_options', // capability
			'cmb-field-map-settings', // menu_slug
			array( $this, 'cmb_field_map_settings_create_admin_page' ) // function
		);
	}

	public function cmb_field_map_settings_create_admin_page() {
		$this->cmb_field_map_settings_options = get_option( 'cmb_field_map_settings_option_name' ); ?>

		<div class="wrap">
			<h2>CMB Field Map Settings</h2>
			<p>Settings for the CMB Map Field Plugin</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'cmb_field_map_settings_option_group' );
					do_settings_sections( 'cmb-field-map-settings-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function cmb_field_map_settings_page_init() {
		register_setting(
			'cmb_field_map_settings_option_group', // option_group
			'cmb_field_map_settings_option_name', // option_name
			array( $this, 'cmb_field_map_settings_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'cmb_field_map_settings_setting_section', // id
			'Settings', // title
			array( $this, 'cmb_field_map_settings_section_info' ), // callback
			'cmb-field-map-settings-admin' // page
		);

		add_settings_field(
			'cmb_field_map_google_map_api', // id
			'Google Maps API Key', // title
			array( $this, 'cmb_field_map_google_map_api_callback' ), // callback
			'cmb-field-map-settings-admin', // page
			'cmb_field_map_settings_setting_section' // section
		);
	}

	public function cmb_field_map_settings_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['cmb_field_map_google_map_api'] ) ) {
			$sanitary_values['cmb_field_map_google_map_api'] = sanitize_text_field( $input['cmb_field_map_google_map_api'] );
		}

		return $sanitary_values;
	}

	public function cmb_field_map_settings_section_info() {
		
	}

	public function cmb_field_map_google_map_api_callback() {
		printf(
			'<input class="regular-text" type="text" name="cmb_field_map_settings_option_name[cmb_field_map_google_map_api]" id="cmb_field_map_google_map_api" value="%s">',
			isset( $this->cmb_field_map_settings_options['cmb_field_map_google_map_api'] ) ? esc_attr( $this->cmb_field_map_settings_options['cmb_field_map_google_map_api']) : ''
		);
	}

}
if ( is_admin() )
	$cmb_field_map_settings = new CMBFieldMapSettings();