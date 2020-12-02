<?php // only copy this line if needed

/**
 * Force individual use for unique discount codes created by Jilt
 * http://help.jilt.com/en/articles/4283033-how-do-i-create-a-unique-discount-code
 * 
 */

add_filter( 'woocommerce_coupon_get_individual_use', function( $individual_use, $coupon ) {
	if ( $coupon->meta_exists( 'jilt_discount_id' ) ) {
		$individual_use = true;
	}
	
	return $individual_use;
}, 10, 2 );