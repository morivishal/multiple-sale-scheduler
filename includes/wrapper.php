<?php
/**
 * Functions that wrap wc_get_product_ids_on_sale() woocommerce function.
 *
 * @package Multiple Sale Scheduler
 */

if ( ! function_exists( 'msswc_get_product_ids_on_sale' ) ) {
	/**
	 * Function that returns an array containing the IDs of the products that are on sale.
	 *
	 * @return array
	 */
	function msswc_get_product_ids_on_sale() {
		$args = array(
			'post_type'      => 'product',
			'meta_key'       => '_schedule_sales',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		);

		$products_with_scheduled_sales = get_posts( $args );
		$product_ids_on_sale           = wc_get_product_ids_on_sale();

		if ( ! empty( $products_with_scheduled_sales ) ) {
			foreach ( $products_with_scheduled_sales as $single_product ) {
				$product_meta = get_post_meta( $single_product, '_schedule_sales', true );

				if ( ! empty( $product_meta ) ) {
					$product       = wc_get_product( $single_product );
					$regular_price = $product->get_regular_price();
					$current_price = $product->get_price();

					if ( $regular_price > $current_price ) {
						$product_ids_on_sale[] = $single_product;
					}
				}
			}
		}
		return array_unique( $product_ids_on_sale );
	}
}
