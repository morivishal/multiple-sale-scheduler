<?php
/**
 * Add new fields in product meta tabs.
 *
 * @class ProductMetaFields
 * @package MSSW\Classes
 * @since 1.0.0
 */

namespace MSSWC\Includes;

/**
 * Add new fields in product meta tabs.
 */
class MSSWC_ProductMetaFields {

	/**
	 * Constructer function to init Sale_Scheduler.
	 */
	public function __construct() {
		add_action( 'woocommerce_product_options_pricing', array( $this, 'msswc_add_product_meta_fields' ) );
	}

	/**
	 * Add custom fields in product edit page.
	 */
	public function msswc_add_product_meta_fields() {
		global $post;
		$schedule_prices = get_post_meta( $post->ID, '_schedule_sales', true ) ? get_post_meta( $post->ID, '_schedule_sales', true ) : array(
			array(
				'start_date' => '',
				'end_date'   => '',
				'price'      => '',
			),
		);

		?>
	<p id="multiple_sale_scheduler" class="options_group show_if_simple multiple_scheduler">
		<p>
			<strong>Set Multiple Sale Prices:</strong>
			<span class="woocommerce-help-tip" data-tip="In case of sale date overlap, earlier sale price will be shown."></span>
		</p>
		<div id="schedule_container">
			<?php
			foreach ( $schedule_prices as $sale ) :
				$sale_price = $sale['price'] ? $sale['price'] : '';
				$start_date = $sale['start_date'] ? gmdate( 'Y-m-d', $sale['start_date'] ) : '';
				$end_date   = $sale['end_date'] ? gmdate( 'Y-m-d', $sale['end_date'] ) : '';
				?>
			<p class="schedule-pricing-fields">
				<input type="number" class="schedule-sale-price" value="<?php echo esc_attr( $sale_price ); ?>"
				name="schedule_price[]" placeholder="Sale Price" step="0.01" style="width: 30%; margin-left: 1%;">
				<input type="text" class="input-text start-date" name="schedule_start[]" value="<?php echo esc_attr( $start_date ); ?>"
				placeholder="Start Date ( YYYY-MM-DD )*" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"
				autocomplete="off" style="width: 30%; margin-left: 1%;">
				<input type="text" class="input-text end-date" name="schedule_end[]" value="<?php echo esc_attr( $end_date ); ?>"
				placeholder="End Date ( YYYY-MM-DD )*" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"
				autocomplete="off" style="width: 30%; margin-left: 1%;">
				<a href="#" class="remove_sale remove_row delete">Remove</a>
				<?php wp_nonce_field( 'msswc_save_scheduled_sales_nonce', 'msswc_meta_nonce' ); ?>
			</p>
			<?php endforeach; ?>
		</div>
		<p>
			<button type="button" class="button" id="add-schedule">Add Schedule</button>
		</p>
		<span class="woocommerce-help-tip" data-tip='The sale will start at 00:00:00 of "From" date and
		end at 23:59:59 of "To" date.'></span>
	</p>
		<?php
	}
}
