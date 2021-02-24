<?php //only include this line if necessary

add_filter( 'woocommerce_coupon_get_product_ids', function( $product_ids, $coupon ) {
	if ( $coupon->meta_exists( 'jilt_discount_id' ) ) {
		// add comma separated numbers for each of the ids of the products to include 
		// eg array(20,34,83)
		$product_ids = array(75391, 21844); 
	}
	
	return $product_ids;
}, 10, 2 );
