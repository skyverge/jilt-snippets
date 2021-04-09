<?php // only copy this line if needed

/**
 * Force individual use for unique discount codes created by Jilt
 * https://help.jilt.com/en/articles/5026072-how-to-force-individual-use-coupons
 * 
 */

add_filter( 'woocommerce_coupon_get_individual_use', function( $individual_use, $coupon ) {
	if ( $coupon->meta_exists( 'jilt_discount_id' ) ) {
		$individual_use = true;
	}
	
	return $individual_use;
}, 10, 2 );