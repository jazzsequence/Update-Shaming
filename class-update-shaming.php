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
	 * Check if the passed date is more than five years old.
	 *
	 * @since 	0.1
	 *
	 * @uses 	SHAMING_FIVE_YEARS_AGO
	 *
	 * @param 	string 		$post_date 		the date of the post
	 *
	 * @return 	boolean
	 */
	public function five_years_check($post_date) {

		if ( $post_date <= SHAMING_FIVE_YEARS_AGO )
			return true;

		return false;
	}

	/**
	 * Check if the passed date is between four and five years old.
	 *
	 * @since 	0.1
	 *
	 * @uses 	SHAMING_FOUR_YEARS_AGO
	 *
	 * @param 	string 		$post_date 		the date of the post
	 *
	 * @return 	boolean
	 */
	public function four_years_check($post_date) {

		if ( ( $post_date <= SHAMING_FOUR_YEARS_AGO ) && ( $post_date > SHAMING_FIVE_YEARS_AGO ) )
			return true;

		return false;
	}

	/**
	 * Check if the passed date is between three and four years old.
	 *
	 * @since 	0.1
	 *
	 * @uses 	SHAMING_THREE_YEARS_AGO
	 *
	 * @param 	string 		$post_date 		the date of the post
	 *
	 * @return 	boolean
	 */
	public function three_years_check($post_date) {

		if ( ( $post_date <= SHAMING_THREE_YEARS_AGO ) && ( $post_date > SHAMING_FOUR_YEARS_AGO ) )
			return true;

		return false;
	}

	/**
	 * Check if the passed date is between two and three years old.
	 *
	 * @since 	0.1
	 *
	 * @uses 	SHAMING_TWO_YEARS_AGO
	 *
	 * @param 	string 		$post_date 		the date of the post
	 *
	 * @return 	boolean
	 */
	public function two_years_check($post_date) {

		if ( ( $post_date <= SHAMING_TWO_YEARS_AGO ) && ( $post_date > SHAMING_THREE_YEARS_AGO ) )
			return true;

		return false;
	}

	/**
	 * Check if the passed date is between one and two years old.
	 *
	 * @since 	0.1
	 *
	 * @uses 	SHAMING_ONE_YEARS_AGO
	 *
	 * @param 	string 		$post_date 		the date of the post
	 *
	 * @return 	boolean
	 */
	public function one_year_check($post_date) {

		if ( ( $post_date <= SHAMING_ONE_YEAR_AGO ) && ( $post_date > SHAMING_TWO_YEARS_AGO ) )
			return true;

		return false;
	}

	/**
	 * Check if the passed date is between six months and one year old.
	 *
	 * @since 	0.1
	 *
	 * @uses 	SHAMING_FIVE_YEARS_AGO
	 *
	 * @param 	string 		$post_date 		the date of the post
	 *
	 * @return 	boolean
	 */
	public function six_months_check($post_date) {

		if ( ( $post_date <= SHAMING_SIX_MONTHS_AGO ) && ( $post_date > SHAMING_ONE_YEAR_AGO ) )
			return true;

		return false;
	}

	/**
	 * Check if the passed date is less than six months old.
	 *
	 * @since 	0.1
	 *
	 * @uses 	SHAMING_FIVE_YEARS_AGO
	 *
	 * @param 	string 		$post_date 		the date of the post
	 *
	 * @return 	boolean
	 */
	public function up_to_date_check($post_date) {

		if ( $post_date > SHAMING_SIX_MONTHS_AGO )
			return true;

		return false;
	}

	/**
	 * Reactions array
	 *
	 * an array for...reactions
	 *
	 * @since 	0.1
	 *
	 * @return 	array 		return the array of possible reactions
	 */
	public function reactions() {
		$reactions = array(
			'five-years' => array(
				0 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2012/11/do-not-want-jump.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('There\'s no hope!', 'update-shaming')
				),
				1 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2012/07/Abandon.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Excuse me.', 'update-shaming')
				),
				2 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2011/05/tumblr_ljkgrvQ9yZ1qafrh6.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('OMG!', 'update-shaming')
				),
				3 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2011/05/oprah.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Oprah says "uh-uh".', 'update-shaming')
				),
				4 => array(
					'url' => 'http://stream1.gifsoup.com/view7/2905513/fix-it-o.gif',
					'source' => 'gifsoup.com',
					'caption' => __('FIX IT!', 'update-shaming')
				)
			),
			'four-years' => array(
				0 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/08/OMG-WHAT.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('WAT?!', 'update-shaming')
				),
				1 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/08/Rickey-OMG.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('*facepalm*', 'update-shaming')
				),
				2 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/06/Shocked.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('That is shocking.', 'update-shaming')
				),
				3 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2012/08/Ralph_Furley.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Ralph Furley is terrified.', 'update-shaming')
				),
				4 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/02/Incredulous_Buscimi.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('WTF?', 'update-shaming')
				)
			),
			'three-years' => array(
				0 => array(
					'url' => 'http://i.imgur.com/0QpiKCi.gif',
					'source' => 'imgur.com',
					'caption' => __('Rowan Atkinson is at a loss for words.', 'update-shaming')
				),
				1 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/07/disappointed.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('I just...*sigh* whatever.', 'update-shaming')
				),
				2 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/06/George-Clooney.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('George Clooney is judging you.', 'update-shaming')
				),
				3 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/06/oh-lord-no.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Sad grandma is sad.', 'update-shaming')
				),
				4 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/06/disappointed1.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('That\'s very disappointing.', 'update-shaming')
				)
			),
			'two-years' => array(
				0 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2012/12/really-tell-me-more.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Tell me more about how you keep your content updated.', 'update-shaming')
				),
				1 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/02/imgur_9CUtI.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Great job! Wait...what?', 'update-shaming')
				),
				2 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/01/elvis-pensive.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('The King is unimpressed.', 'update-shaming')
				),
				3 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2012/12/Bowie-disapproves.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('David Bowie disapproves.', 'update-shaming')
				),
				4 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2012/12/grumpy-cat.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Grumpy Cat is not amused.', 'update-shaming')
				)
			),
			'one-year' => array(
				0 => array(
					'url' => 'http://i.imgur.com/Dg5J7.gif',
					'source' => 'imgur.com',
					'caption' => __('This makes Mr. T sad.', 'update-shaming')
				),
				1 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/07/tense.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Brad Pitt is bored.', 'update-shaming')
				),
				2 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/06/ok-then.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Nice try.', 'update-shaming')
				),
				3 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/06/eyeroll.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Nice work! (I guess...)', 'update-shaming')
				),
				4 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/03/1264319881771.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Not good enough.', 'update-shaming')
				)
			),
			'six-months' => array(
				0 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/06/oh-really-now.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Really?', 'update-shaming')
				),
				1 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2012/10/jb.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Joe Biden suspects some malarkey.', 'update-shaming')
				),
				2 => array(
					'url' => 'http://i.imgur.com/trwrzPg.gif',
					'source' => 'imgur.com',
					'caption' => __('*sarcastic clapping*', 'update-shaming')
				),
				3 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/06/Jay-Z-so-so.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('Jay-Z thinks this is so-so.', 'update-shaming')
				),
				4 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/01/oh-please.gif',
					'source' => 'reactiongifs.com',
					'caption' => __('John Cleese is not impressed.', 'update-shaming')
				)
			),
			'winning' => array(
				0 => array(
					'url' => 'http://alfa.gifs-planet.com/new/1696.gif',
					'source' => 'gifs-planet.com',
				),
				1 => array(
					'url' => 'http://i.imgur.com/X9d5tnd.gif',
					'source' => 'imgur.com',
				),
				2 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/08/dancer.gif',
					'source' => 'reactiongifs.com',
				),
				3 => array(
					'url' => 'http://i.imgur.com/MIj6o.gif',
					'source' => 'imgur.com',
				),
				4 => array(
					'url' => 'http://www.reactiongifs.com/wp-content/uploads/2013/03/in-the-zone.gif',
					'source' => 'reactiongifs.com'
				)
			)
		);
		return $reactions;
	}

}