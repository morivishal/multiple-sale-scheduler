<?php
/**
 * Plugin name: Multiple Sale Scheduler
 *
 * Description: Schedule multiple sale in woocommerce.
 * Version: 1.0.0
 * Author: Vishal Mori
 * Author URI: https://profiles.wordpress.org/vishalmori/
 * Requires Plugins: woocommerce
 * Text Domain:     multiple-sale-scheduler
 * License:         GPL v2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path:     /i18n/languages
 * Version:         1.0.0
 *
 * @package Multiple Sale Scheduler
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'MSS_VERSION' ) ) {
	define( 'MSS_VERSION', '1.0.0' );
}

if ( ! defined( 'MSS_PLUGIN_DIR_URL' ) ) {
	define( 'MSS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

require_once __DIR__ . '/vendor/autoload.php';


/**
 * Register plugin activation hook.
 */
function mss_plugin_activation() {
	new Multiplesalescheduler\Mss\MultipleSaleScheduler();
}
add_action( 'plugins_loaded', 'mss_plugin_activation' );
