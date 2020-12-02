<?php // only copy this line if needed

/**
 * Prevent Jilt coupons from being used with sale prices
 * http://help.jilt.com/en/articles/4283033-how-do-i-create-a-unique-discount-code
 * 
 */

add_filter( 'woocommerce_coupon_get_exclude_sale_items', function( $exclude_sale_items, $coupon ) {
	if ( $coupon->meta_exists( 'jilt_discount_id' ) ) {
		$exclude_sale_items = true;
	}
	
	return $exclude_sale_items;
}, 10, 2 );