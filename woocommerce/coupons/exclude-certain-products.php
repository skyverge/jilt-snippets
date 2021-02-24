<?php //only include this line if necessary

add_filter( 'woocommerce_coupon_get_excluded_product_ids', function( $excluded_product_ids, $coupon ) {
	if ( $coupon->meta_exists( 'jilt_discount_id' ) ) {
		// add comma separated numbers for each of the ids of the products to exclude 
		// eg array(20,34,83)
		$excluded_product_ids = array(20); 
	}
	
	return $excluded_product_ids;
}, 10, 2 );
