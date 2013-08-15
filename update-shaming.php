<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that also follow
 * WordPress coding standards and PHP best practices.
 *
 * @package   Update_Shaming
 * @author    Chris Reynolds <hello@chrisreynolds.io>
 * @license   GPL-3.0
 * @link      http://chrisreynolds.io
 * @copyright 2013 Chris Reynolds
 *
 * @wordpress-plugin
 * Plugin Name: Update Shaming
 * Plugin URI:  TODO
 * Description: TODO
 * Version:     0.1
 * Author:      Chris Reynolds
 * Author URI:  http://museumthemes.com
 * Text Domain: update-shaming
 * License:     GPL-3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// TODO: replace `class-plugin-name.php` with the name of the actual plugin's class file
require_once( plugin_dir_path( __FILE__ ) . 'class-update-shaming.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
// TODO: replace Update_Shaming with the name of the plugin defined in `class-plugin-name.php`
register_activation_hook( __FILE__, array( 'Update_Shaming', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Update_Shaming', 'deactivate' ) );

// TODO: replace Update_Shaming with the name of the plugin defined in `class-plugin-name.php`
Update_Shaming::get_instance();