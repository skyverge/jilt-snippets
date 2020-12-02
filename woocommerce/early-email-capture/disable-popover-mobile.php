<?php // only copy this line if needed

/**
 * Disable early email capture add-to-cart popover on mobile devices 
 * http://help.jilt.com/en/articles/2082915-early-email-capture-with-jilt
 * 
 */

function wc_jilt_disable_capture_email_on_add_to_cart_on_mobile( $jilt_settings ) {
	if ( ! is_admin() && wp_is_mobile() ) {
		$jilt_settings['capture_email_on_add_to_cart'] = 'no';
	}
	return $jilt_settings;
}
add_filter( 'option_jilt_storefront_params', 'wc_jilt_disable_capture_email_on_add_to_cart_on_mobile' );