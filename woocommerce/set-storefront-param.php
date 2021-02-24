<?php // copy this line if needed only

/**
 * Updates the checkout consent text that Jilt for WooCommerce shows on the Checkout page. Can be used if Storefront params options are not applying from the admin
 */

add_action( 'init', static function() {

	$params = (array) get_option( 'jilt_storefront_params', array() );

	$params['show_marketing_consent_opt_in'] = 'yes';

	$params['checkout_consent_prompt'] = 'REPLACE THIS TEXT WITH THE NEW CONSENT TEXT';

	update_option( 'jilt_storefront_params', $params );
} );
