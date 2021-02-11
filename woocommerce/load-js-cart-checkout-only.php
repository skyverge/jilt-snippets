<?php // only copy this line if needed

/**
 * Only load Jilt JS on cart and checkout pages
 * 
 */

add_action( 'wp_print_scripts', function() {

    if ( ! function_exists( 'is_woocommerce' ) ) return;

    if ( ! is_cart() && ! is_checkout() ) {
        wp_dequeue_script( 'wc-jilt' );
        wp_dequeue_script( 'wc-jilt-subscribe-form' );
    }
} );