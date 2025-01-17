<?php
/**
 * Plugin Name: Leadbook
 * Description: Leadbook is a lead generation plugin for WordPress.
 * Version: 1.0.0
 * Author: Shibaji Debnath
 * Author URI: https://shibajidebnath.com
 * Text Domain: leadbook
 * Domain Path: /languages
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 6.3
 * Requires PHP: 7.0
 */
defined( 'ABSPATH' ) || exit;

global $leadbook_db_version;
$leadbook_db_version = '1.0';
define( 'LEADBOOK_VERSION', '1.0' );
define( 'LEADBOOK_PATH', plugin_dir_path( __FILE__ ) );
define( 'LEADBOOK_URL', plugin_dir_url( __FILE__ ) );

require_once LEADBOOK_PATH . 'includes/core/paths.php';
require_once LEADBOOK_PATH . 'includes/core/helpers.php';
require_once LEADBOOK_PATH . 'includes/core/loaders.php';


register_activation_hook( __FILE__, 'leadbook_activation' );
register_deactivation_hook( __FILE__, 'leadbook_deactivation' );
register_uninstall_hook( __FILE__, 'leadbook_uninstallation' );