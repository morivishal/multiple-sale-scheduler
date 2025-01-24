<?php
/**
 * Plugin name: Multiple Sale Scheduler for WooCommerce
 *
 * Description: Plugin that enables you to easily schedule multiple sales in WooCommerce. It has been tested and works seamlessly with both simple and grouped product types.
 * Author: Vishal Mori
 * Author URI: https://profiles.wordpress.org/vishalmori/
 * Requires Plugins: woocommerce
 * Text Domain:     multiple-sale-scheduler
 * License:         GPL v2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Version:         1.0.0
 *
 * @package Multiple Sale Scheduler
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'MSSWC_VERSION' ) ) {
	define( 'MSSWC_VERSION', '1.0.0' );
}

if ( ! defined( 'MSSWC_PLUGIN_DIR_URL' ) ) {
	define( 'MSSWC_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/wrapper.php';

if ( ! function_exists( 'msswc_plugin_activation' ) ) {
	/**
	 * Register plugin activation hook.
	 */
	function msswc_plugin_activation() {
		new MSSWC\Includes\MSSWC_MultipleSaleScheduler();
	}
	add_action( 'plugins_loaded', 'msswc_plugin_activation' );
}
