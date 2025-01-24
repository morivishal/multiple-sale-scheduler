<?php
/**
 * The core plugin class.
 *
 * @package Multiple Sale Scheduler
 * @since 1.0.0
 */

namespace MSSWC\Includes;

/**
 * Core plugin class.
 *
 * @version 1.0.0
 */
class MSSWC_MultipleSaleScheduler {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'msswc_enqueue_scripts_and_styles' ) );
		new \MSSWC\Includes\MSSWC_ProductMetaFields();
		new \MSSWC\Includes\MSSWC_SaleScheduler();
	}

	/**
	 * Enqueue plugin style and script.
	 */
	public function msswc_enqueue_scripts_and_styles() {
		wp_register_style( 'msswc-style', MSSWC_PLUGIN_DIR_URL . '/assets/css/style.css', '', MSSWC_VERSION );
		wp_enqueue_style( 'msswc-style' );

		wp_register_script( 'msswc-sale-scheduler', MSSWC_PLUGIN_DIR_URL . '/assets/js/sale-scheduler.min.js', array(), MSSWC_VERSION, true );
		wp_enqueue_script( 'msswc-sale-scheduler' );
	}
}
