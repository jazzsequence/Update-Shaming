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
 * Description: Shaming content editors into updating page content that has not been touched in a long time, while simultaneously providing an overview of the oldest pages on a site.
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

define( SHAMING_TODAY, date('Y-m-d') );
define( SHAMING_FIVE_YEARS_AGO, date( 'Ymd', strtotime( SHAMING_TODAY . ' -5 years' ) ) );
define( SHAMING_FOUR_YEARS_AGO, date( 'Ymd', strtotime( SHAMING_TODAY . ' -4 years' ) ) );
define( SHAMING_THREE_YEARS_AGO, date( 'Ymd', strtotime( SHAMING_TODAY . ' -3 years' ) ) );
define( SHAMING_TWO_YEARS_AGO, date( 'Ymd', strtotime( SHAMING_TODAY . ' -2 years' ) ) );
define( SHAMING_ONE_YEAR_AGO, date( 'Ymd', strtotime( SHAMING_TODAY . ' -1 years' ) ) );
define( SHAMING_SIX_MONTHS_AGO, date( 'Ymd', strtotime( SHAMING_TODAY . ' -6 months' ) ) );

// TODO: replace `class-plugin-name.php` with the name of the actual plugin's class file
require_once( plugin_dir_path( __FILE__ ) . 'class-update-shaming.php' );

// TODO: replace Update_Shaming with the name of the plugin defined in `class-plugin-name.php`
Update_Shaming::get_instance();