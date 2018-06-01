<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://thepixeltribe.com
 * @since      1.0.0
 *
 * @package    Pt_Real_Estate_Proffesional
 * @subpackage Pt_Real_Estate_Proffesional/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Pt_Real_Estate_Proffesional
 * @subpackage Pt_Real_Estate_Proffesional/includes
 * @author     Pixel Tribe <support@thepixeltribe.com>
 */
class Pt_Real_Estate_Proffesional {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Pt_Real_Estate_Proffesional_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'pt-real-estate-proffesional';
		$this->version = '1.0.0';

		$this->constants();
		$this->libraries();
		$this->widgets();
		$this->load_widgets();
		$this->load_dependencies();
		$this->load_customizer();
		$this->custom_post_types();
		$this->load_template();
		$this->load_slider();
		$this->set_locale();
		$this->register_functions();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_custom_hooks();

	}

		/**
		 * Defines constastants
		 *
		 * @access public
		 * @return void
		 */
		public function constants() {
			define( 'REALEST_DIR', plugin_dir_path( dirname( __FILE__ ) ) );
			define( 'REALEST_PROPERTY_PREFIX', '_realest_' );
			define( 'REALEST_AGENT_PREFIX', 'agent_' );
		}


	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Pt_Real_Estate_Proffesional_Loader. Orchestrates the hooks of the plugin.
	 * - Pt_Real_Estate_Proffesional_i18n. Defines internationalization functionality.
	 * - Pt_Real_Estate_Proffesional_Admin. Defines all hooks for the admin area.
	 * - Pt_Real_Estate_Proffesional_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once REALEST_DIR . 'includes/class-pt-real-estate-proffesional-loader.php';

		/**
		 * Load the customizer
		 * 
		 */
		require_once REALEST_DIR . 'includes/class-pt-real-estate-proffesional-customizer.php';


		/**
		 * Load Post Types
		 * 
		 */
		require_once REALEST_DIR . 'includes/class-pt-real-estate-proffesional-post-types.php';



		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * 
		 */
		


		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once REALEST_DIR . 'includes/class-pt-real-estate-proffesional-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once REALEST_DIR . 'admin/class-pt-real-estate-proffesional-admin.php';



		$this->loader = new Pt_Real_Estate_Proffesional_Loader();

	}

	/**
	* Loads all the libraries
	*/
	public function libraries(){
		require_once REALEST_DIR . 'libraries/tgm/class-tgm-plugin-activation.php';
		require_once REALEST_DIR . 'libraries/kirki/kirki.php';
		require_once REALEST_DIR . 'libraries/cmb_field_map/cmb-field-map.php';
		require_once REALEST_DIR . 'libraries/cmb2-attached-posts/cmb2-attached-posts-field.php';

		require_once REALEST_DIR . 'includes/class-pt-real-estate-proffesional-functions.php';

		require_once REALEST_DIR . 'libraries/merlin/merlin.php';
		require_once REALEST_DIR . 'libraries/merlin/merlin-config.php';

	
		/**
		 * Loadi styles & scripts
		 * 
		 */
		//require_once REALEST_DIR . 'includes/class-pt-real-estate-proffesional-scripts.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once REALEST_DIR . 'public/class-pt-real-estate-proffesional-public.php';

		/**
		 * Load CMB2 metabox
		 * 
		 */
		require_once REALEST_DIR . 'includes/class-pt-real-estate-proffesional-metabox.php';


		/**
		 * Hooks
		 * 
		 */
		require_once REALEST_DIR . 'includes/class-pt-real-estate-proffesional-hooks.php';

		/**
		 * Page & single Template System
		 * 
		 */
		require_once REALEST_DIR . 'templates/class-pt-real-estate-professional-page-template.php';

		require_once REALEST_DIR . 'templates/class-pt-real-estate-professional-template.php';
	}

	/**
	* Widgets
	*/
	public function widgets(){
		require_once REALEST_DIR . 'includes/widgets/agent-widget.php';
		require_once REALEST_DIR . 'includes/widgets/property-widget.php';
		require_once REALEST_DIR . 'includes/widgets/contract-property.php';

	}

	/**
	 * Register all of the hooks related to the Custom Post Types
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_widgets() {



	}

	private function load_customizer(){

		Pt_Real_Estate_Proffesional_Customizations::init();

	    $customization = new Pt_Real_Estate_Proffesional_Customizations();

		$this->loader->add_action( 'plugins_loaded', $customization, 'realest_customization' );

		$this->loader->add_action( 'admin_init', $customization, 'realest_remove_upsell' );

	    $metabox = new Pt_Real_Estate_Proffesional_Metaboxes();

		$this->loader->add_action( 'plugins_loaded', $metabox, 'init' );
	}
	/**
	 * Register all of the hooks related to the Custom Post Types
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_scripts() {


	}

	/**
	 * Register all of the hooks related to the Custom Post Types
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function custom_post_types() {

	    $cpt = new Pt_Real_Estate_Proffesional_Posts();

	    $this->loader->add_action( 'plugins_loaded', $cpt, 'init' );


	}

	/**
	 * load PRO Templates
	 * 
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_template() {
		$plugin_templates = new Pt_Real_Estate_Proffesional_Template( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'template_include', $plugin_templates, 'templates', 10 );

	}

	private function load_slider() {


	}
	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Pt_Real_Estate_Proffesional_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Pt_Real_Estate_Proffesional_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}



		/**
		 * Load Functions
		 *
		 * @access private
		 * @return void
		 */
		private function register_functions() {

		$functions = new Pt_Real_Estate_Proffesional_Functions();

		$this->loader->add_action( 'init', $functions, 'init' );

		$this->loader->add_action('admin_notices', $functions , 'admin_notice');
}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Pt_Real_Estate_Proffesional_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		//$this->loader->add_action( 'init', $plugin_admin, 'init' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Pt_Real_Estate_Proffesional_Public( $this->get_plugin_name(), $this->get_version() );



		$this->loader->add_action( 'init', $plugin_public, 'init' );

		

	}
	private function define_custom_hooks() {

	    $hooks = new Pt_Real_Estate_Proffesional_Hooks();

	    $this->loader->add_action( 'after_setup_theme', $hooks, 'init' );
	    //add_action('after_setup_theme', array($this, 'realest_main_slider', 10 ));





	}
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Pt_Real_Estate_Proffesional_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
