// Prevents loading of admin-ajax requests on non WC pages. For edd see https://gist.github.com/jonathanpike/43dd9ce7a1b4cd0bea7407424f6edc7e

add_action( 'wp_print_scripts', function() {

    if ( ! function_exists( 'is_woocommerce' ) ) return;

    if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
        wp_dequeue_script( 'wc-jilt' );
        wp_dequeue_script( 'wc-jilt-subscribe-form' );
    }
} );
