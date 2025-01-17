<?php
/**
 * Save product data to database.
 *
 * @class SaleScheduler
 * @package MSSW\Classes
 * @since 1.0.0
 */

namespace MSSWC\Includes;

use Exception;

/**
 * Save scheduled sales class.
 */
class MSSWC_SaleScheduler {

	/**
	 * Constructer function to init Sale_Scheduler.
	 */
	public function __construct() {
		add_action( 'save_post', array( $this, 'msswc_save_scheduled_sales' ) );
		add_filter( 'woocommerce_product_get_price', array( $this, 'msswc_display_scheduled_sale_prices' ), 10, 2 );
		add_filter( 'woocommwrce_product_get_sale_price', array( $this, 'msswc_display_scheduled_sale_prices' ), 10, 2 );
		add_filter( 'woocommerce_get_price_html', array( $this, 'msswc_update_sale_price_html' ), 10, 2 );
	}

	/**
	 * Save scheduled sale.
	 *
	 * @param int $post_id Post ID.
	 */
	public function msswc_save_scheduled_sales( $post_id ) {

		try {
			if ( ! isset( $_POST['msswc_meta_nonce'] ) || wp_verify_nonce( sanitize_key( $_POST['msswc_meta_nonce'] ) ) ) {
				throw new \Error( 'Security check failed.' );
			}

			if ( ! current_user_can( 'edit_products', $post_id ) ) {
				throw new \Error( 'User is not capabal.' );
			}

			$product = wc_get_product( $post_id );

			// If the product doesn't exist.
			if ( ! $product ) {
				return;
			}

			$sale_prices    = isset( $_POST['schedule_price'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['schedule_price'] ) ) : array();
			$schedule_start = isset( $_POST['schedule_start'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['schedule_start'] ) ) : array();
			$schedule_end   = isset( $_POST['schedule_end'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['schedule_end'] ) ) : array();

			if ( empty( $sale_prices ) || empty( $schedule_start ) || empty( $schedule_end ) ) {
				return;
			}
			if ( count( $sale_prices ) !== count( $schedule_start ) || count( $sale_prices ) !== count( $schedule_end ) ) {
				return;
			}

			$sale_array = array(
				'sale_prices'   => $sale_prices,
				'start_dates'   => $schedule_start,
				'end_dates'     => $schedule_end,
				'regular_price' => $product->get_regular_price(),
				'id'            => $post_id,
			);

			$this->msswc_update_product_meta( $sale_array );
		} catch ( Exception $e ) {
			wc_add_notice( $e->getMessage(), 'error' );
		}
	}

	/**
	 * Update product meta for multi sale scheduler.
	 *
	 * @param array $sale_array Sale array.
	 */
	private function msswc_update_product_meta( $sale_array ) {
		$schedule_sale = array();

		foreach ( $sale_array['sale_prices'] as $index => $sale_price ) {
			if (
			! empty( $sale_array['sale_prices'][ $index ] ) && ! empty( $sale_array['start_dates'][ $index ] ) &&
			! empty( $sale_array['end_dates'][ $index ] ) && 0 < $sale_array['regular_price'] && $sale_array['regular_price'] > $sale_price
			) {
				$schedule_sale[] = array(
					'start_date' => strtotime( sanitize_text_field( $sale_array['start_dates'][ $index ] ) ),
					'end_date'   => strtotime( sanitize_text_field( $sale_array['end_dates'][ $index ] ) ),
					'price'      => floatval( sanitize_text_field( $sale_price ) ),
				);
			}
		}
		update_post_meta( $sale_array['id'], '_schedule_sales', $schedule_sale );
	}

	/**
	 * Display scheduled sale prices.
	 *
	 * @param string     $price The product price (can be regular or sale price).
	 * @param WC_Product $product WC_Product object.
	 */
	public function msswc_display_scheduled_sale_prices( $price, $product ) {
		$schedule_sales = get_post_meta( $product->get_id(), '_schedule_sales', true );

		if ( empty( $schedule_sales ) ) {
			return $price;
		}

		$is_on_sale   = $product->is_on_sale();
		$current_date = new \DateTime( 'now' );
		$current_date = $current_date->format( 'Y-m-d' );

		foreach ( $schedule_sales as $sale ) {
			$start_date = new \DateTime( gmdate( 'c', $sale['start_date'] ) );
			$start_date = $start_date->format( 'Y-m-d' );

			$end_date = new \DateTime( gmdate( 'c', $sale['end_date'] ) );
			$end_date = $end_date->format( 'Y-m-d' );

			if ( $current_date >= $start_date && $current_date <= $end_date ) {
				if ( ! $is_on_sale && $price > $sale['price'] ) {
					return $sale['price'];
				}
			}
		}
		return $price;
	}

	/**
	 * Update sale price HTML.
	 *
	 * @param string     $price_html The sale price HTML.
	 * @param WC_Product $product WC_Product object.
	 *
	 * @return string
	 */
	public function msswc_update_sale_price_html( $price_html, $product ) {
		$regular_price = $product->get_regular_price();
		$price         = $product->get_price();
		$is_on_sale    = $product->is_on_sale();

		if ( ! $is_on_sale && $regular_price > $price ) {
			$price_html = '<del>' . wc_price( $regular_price ) . '</del> <ins>' . wc_price( $price ) . '</ins>';
		}
		return $price_html;
	}
}
