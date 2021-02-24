/**
 * Adds a tracking_code property to the order data used to update a Jilt order via the API.
 * 
 * You can insert the value of that property into a Jilt email using Liquid: http://help.jilt.com/en/articles/1288803-what-is-liquid-and-why-is-it-magic
 *
 * @param array $params order data
 * @param \WC_Jilt_Order $order order object
 * @return array
 */
function sv_add_tracking_info_to_jilt_order_params( $params, $order ) {

    // TODO: replace with code to retrieve the tracking code for the given order
    // For example: $tracking_code = get_post_meta( $order->get_id() , 'ups_shipment_ids', true );
    // will get the tracking code for the https://www.pluginhive.com/product/woocommerce-ups-shipping-plugin-with-print-label/ plugin
    $tracking_code = get_post_meta($order_id, 'wf_auspost_tracking_ids', true);

    if ( $tracking_code ) {

        if ( ! isset( $params['properties'] ) ) {
            $params['properties'] = [];
        }

        // use {{ order.properties.tracking_code }} to access this value and insert it in a Jilt email
        $params['properties']['tracking_code'] = $tracking_code;
    }

    return $params;
}
add_filter( 'wc_jilt_order_params', 'sv_add_tracking_info_to_jilt_order_params', 10, 2 );
