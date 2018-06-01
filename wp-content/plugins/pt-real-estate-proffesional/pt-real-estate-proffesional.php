<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://thepixeltribe.com
 * @since             1.0.9
 * @package           Pt_Real_Estate_Proffesional
 *
 * @wordpress-plugin
 * Plugin Name:       PT Real Estate Professional
 * Plugin URI:        http://thepixeltribe.com
 * Description:       Add premium features to real estate lite theme
 * Version:           1.2.5
 * Author:            Pixel Tribe
 * Author URI:        http://thepixeltribe.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pt-real-estate-proffesional
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pt-real-estate-proffesional-activator.php
 */
function activate_pt_real_estate_proffesional() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pt-real-estate-proffesional-activator.php';
	Pt_Real_Estate_Proffesional_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pt-real-estate-proffesional-deactivator.php
 */
function deactivate_pt_real_estate_proffesional() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pt-real-estate-proffesional-deactivator.php';
	Pt_Real_Estate_Proffesional_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pt_real_estate_proffesional' );
register_deactivation_hook( __FILE__, 'deactivate_pt_real_estate_proffesional' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pt-real-estate-proffesional.php';


require plugin_dir_path( __FILE__ ) . 'updater/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'http://updates.thepixeltribe.com/real-estate/update.json',
	__FILE__,
	'pt-real-estate-proffesional'
);
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pt_real_estate_proffesional() {

	$plugin = new Pt_Real_Estate_Proffesional();
	$plugin->run();

}
run_pt_real_estate_proffesional();
