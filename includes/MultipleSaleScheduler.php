<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization.
 *
 * @package MSS
 * @since 1.0.0
 */

namespace Multiplesalescheduler\Mss;

/**
 * Core plugin class.
 */
class MultipleSaleScheduler {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'mss_enqueue_scripts_and_styles' ) );
		new \Multiplesalescheduler\Mss\ProductMetaFields();
		new \Multiplesalescheduler\Mss\SaleScheduler();
	}

	/**
	 * Enqueue plugin style and script.
	 */
	public function mss_enqueue_scripts_and_styles() {
		wp_register_style( 'mss-style', MSS_PLUGIN_DIR_URL . '/assets/css/style.css', '', MSS_VERSION );
		wp_enqueue_style( 'mss-style' );

		wp_register_script( 'mss-sale-scheduler', MSS_PLUGIN_DIR_URL . '/assets/js/sale-scheduler.js', array(), MSS_VERSION, true );
		wp_enqueue_script( 'mss-sale-scheduler' );
	}
}
