=== Multiple Sale Scheduler for WooCommerce ===
Contributors: vishalmori
Tags: Sale, Sale Scheduler, Product Discounts, sale Schedulerfor WooCommerce
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Effortlessly schedule multiple sales for your WooCommerce products, ensuring timely discounts and seamless promotions.

== Description ==

**Multiple Sale Scheduler**
Effortlessly schedule and manage multiple sales for your WooCommerce products—both single and grouped. Plan sales periods in advance to boost customer engagement and drive conversions with well-timed promotions.

Default WooCommerce sale functionality is in priority. If product is already on sale then
Multiple sale scheduler will not override it.

== Note ==
The WooCommerce default sale scheduler may not be overridden in the following scenarios:
1. When only the sale price is set, but no start or end dates are defined in the default WooCommerce fields.
2. When the sale price, along with both the start and end dates, is set in the default WooCommerce fields.
3. When the sale price is set, but only one of the start or end dates is defined in the default WooCommerce fields.

== Developer Note ==

Ensure the use of msswc_get_product_ids_on_sale() instead of wc_get_product_ids_on_sale().

 - msswc_get_product_ids_on_sale() will return all product IDs on sale, including those scheduled using the Multiple Sale Scheduler plugin.

 - In contrast, wc_get_product_ids_on_sale() only retrieves product IDs set on sale via the default WooCommerce sale functionality.

== Features ==

Schedule multiple sales for WooCommerce products.

Works seamlessly with the REST API, ideal for headless WooCommerce setups.

Set start and end dates for each sale.

Automatically apply sale prices during the scheduled period.

Easy-to-use interface within WooCommerce product settings.

Compatible with the latest WooCommerce and WordPress versions.

== Why Use Multiple Sale Scheduler? ==

Manually managing multiple sales can be time-consuming and prone to errors. Multiple Sale Scheduler simplifies the process by automating sales scheduling, ensuring they start and stop on time. Focus on growing your business while the plugin handles your promotions.

== Installation ==

From the WordPress admin panel, navigate to **Plugins > Add New**. Search for "Multiple Sale Scheduler for WooCommerce," then install and activate it.

Alternatively, upload the plugin files to the /wp-content/plugins/ directory and activate the plugin via the **Plugins** screen.

Activate the plugin through the 'Plugins' screen in WordPress.

Navigate to the product edit page in WooCommerce to start scheduling sales.

In general product data tab you can see new field if product type is simple or grouped.

Frequently Asked Questions

Q: Is Multiple Sale Scheduler free?

A: Yes, the plugin is licensed under GPL-2.0 and is free to use and modify.

Q: Does this plugin support variable products?

A: No, this plugin curently supports only simple and grouped products.

Q: Can I use this plugin for headless WooCommerce?

A: Yes, this plugin is fully compatible with the WooCommerce REST API, making it ideal for headless setups.

Q: Does the plugin work with custom product types?

A: The plugin supports standard WooCommerce product types. For custom types, additional compatibility may be needed.

Changelog

1.0.0

Initial release.

Schedule sales for products.

License

Multiple Sale Scheduler for WooCommerce is licensed under the GNU General Public License v2.0 or later. See LICENSE for more details.