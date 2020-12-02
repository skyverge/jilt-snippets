<?php // only copy this line if needed

/**
 * Change redirect from checkout page to cart
 * 
 */


add_filter( 'woocommerce_get_checkout_url', function( $checkout_url ) {
	global $wp;

	if ( isset( $wp->query_vars ) && ! empty( $wp->query_vars['wc-api'] ) && 'jilt' === $wp->query_vars['wc-api'] && ! empty( $_GET['token'] ) ) {
		$checkout_url = wc_get_cart_url();
	}
	
	return $checkout_url;
} );