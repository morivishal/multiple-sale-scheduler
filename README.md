# multiple-sale-scheduler

# Developer Note
Ensure the use of msswc_get_product_ids_on_sale() instead of wc_get_product_ids_on_sale().

 - msswc_get_product_ids_on_sale() will return all product IDs on sale, including those scheduled using the Multiple Sale Scheduler plugin.

 - In contrast, wc_get_product_ids_on_sale() only retrieves product IDs set on sale via the default WooCommerce sale functionality.