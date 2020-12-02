<?php // only copy this line if needed

/**
 * Exclude product categories from Jilt coupons
 * http://help.jilt.com/en/articles/4283033-how-do-i-create-a-unique-discount-code
 * 
 */

add_filter( 'woocommerce_coupon_get_excluded_product_categories', function( $excluded_product_categories, $coupon ) {
	if ( $coupon->meta_exists( 'jilt_discount_id' ) ) {
		// add comma separated numbers for each of the ids of the categories to exclude 
		// eg array(20,34,83)
		$excluded_product_categories = array(20); 
	}
	
	return $excluded_product_categories;
}, 10, 2 );