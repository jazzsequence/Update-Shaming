<?php
/**
 * Plugin Name.
 *
 * @package   Update_Shaming
 * @author    Chris Reynolds <hello@chrisreynolds.io>
 * @license   GPL-3.0
 * @link      http://chrisreynolds.io
 * @copyright 2013 Chris Reynolds
 */

/**
 * Plugin class.
 *
 * @package Update_Shaming
 * @author  Chris Reynolds <hello@chrisreynolds.io>
 */
class Update_Shaming {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   0.1
	 *
	 * @var     string
	 */
	protected $version = '0.1';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since   0.1
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'update-shaming';

	/**
	 * Instance of this class.
	 *
	 * @since   0.1
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since   0.1
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since   0.1.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Define custom functionality. Read more about actions and filters: http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		add_action( 'TODO', array( $this, 'action_method_name' ) );
		add_filter( 'TODO', array( $this, 'filter_method_name' ) );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since   0.1.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since   0.1
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		// TODO: Define activation functionality here
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since   0.1
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		// TODO: Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since   0.1
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since   0.1.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $screen->id == $this->plugin_screen_hook_suffix ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), $this->version );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since   0.1.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $screen->id == $this->plugin_screen_hook_suffix ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), $this->version );
		}

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since   0.1
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), array(), $this->version );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since   0.1
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'js/public.js', __FILE__ ), array( 'jquery' ), $this->version );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since   0.1
	 */
	public function add_plugin_admin_menu() {

		/*
		 * TODO:
		 *
		 * Change 'Page Title' to the title of your plugin admin page
		 * Change 'Menu Text' to the text for menu item for the plugin settings page
		 */
		$this->plugin_screen_hook_suffix = add_submenu_page(
			'edit.php?post_type=page',
			__( 'Out of date pages', 'update-shaming' ),
			__( 'Outdated Pages', 'update-shaming' ),
			'publish_page',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since   0.1
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * NOTE:  Actions are points in the execution of a page or process
	 *        lifecycle that WordPress fires.
	 *
	 *        WordPress Actions: http://codex.wordpress.org/Plugin_API#Actions
	 *        Action Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since   0.1
	 */
	public function action_method_name() {
		// TODO: Define your action hook callback here
	}

	/**
	 * NOTE:  Filters are points of execution in which WordPress modifies data
	 *        before saving it or sending it to the browser.
	 *
	 *        WordPress Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *        Filter Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since   0.1
	 */
	public function filter_method_name() {
		// TODO: Define your filter hook callback here
	}

	public function five_years_check($post_date) {
		$today = date('Y-m-d');
		$five_years_ago = date( 'Ymd', strtotime( $today . ' -5 years' ) );

		if ( $post_date <= $five_years_ago )
			return true;

		return false;
	}

	public function four_years_check($post_date) {
		$today = date('Y-m-d');
		$four_years_ago = date( 'Ymd', strtotime( $today . ' -4 years' ) );
		$five_years_ago = date( 'Ymd', strtotime( $today . ' -5 years' ) );

		if ( ( $post_date <= $four_years_ago ) && ( $post_date > $five_years_ago ) )
			return true;

		return false;
	}

	public function three_years_check($post_date) {
		$today = date('Y-m-d');
		$three_years_ago = date( 'Ymd', strtotime( $today . ' -3 years' ) );
		$four_years_ago = date( 'Ymd', strtotime( $today . ' -4 years' ) );

		if ( ( $post_date <= $three_years_ago ) && ( $post_date > $four_years_ago ) )
			return true;

		return false;
	}

	public function two_years_check($post_date) {
		$today = date('Y-m-d');
		$two_years_ago = date( 'Ymd', strtotime( $today . ' -2 years' ) );
		$three_years_ago = date( 'Ymd', strtotime( $today . ' -3 years' ) );

		if ( ( $post_date <= $two_years_ago ) && ( $post_date > $three_years_ago ) )
			return true;

		return false;
	}

	public function one_year_check($post_date) {
		$today = date('Y-m-d');
		$one_year_ago = date( 'Ymd', strtotime( $today . ' -1 year' ) );
		$two_years_ago = date( 'Ymd', strtotime( $today . ' -2 years' ) );

		if ( ( $post_date <= $one_year_ago ) && ( $post_date > $two_years_ago ) )
			return true;

		return false;
	}

	public function six_months_check($post_date) {
		$today = date('Y-m-d');
		$six_months_ago = date( 'Ymd', strtotime( $today . ' -6 months' ) );
		$one_year_ago = date( 'Ymd', strtotime( $today . ' -1 years' ) );

		if ( ( $post_date <= $six_months_ago ) && ( $post_date > $one_year_ago ) )
			return true;

		return false;
	}

}