<?php // only copy this line if needed

/**
 * Adds a tracking_code property to the order data used to update a Jilt order via the API.
 * 
 * This snippet is configured specifically for use with the WooCommerce Shipment Tracking plugin: https://woocommerce.com/products/shipment-tracking/
 * 
 * You can insert the value of that property into a Jilt email using Liquid: http://help.jilt.com/en/articles/1288803-what-is-liquid-and-why-is-it-magic
 *
 * @param array $params order data
 * @param \WC_Jilt_Order $order order object
 * @return array
 */
function sv_add_tracking_info_to_jilt_order_params( $params, $order ) {
	if ( ! function_exists( 'wc_shipment_tracking' ) ) {
		return $params;
	}
	$shipment_tracking = WC_Shipment_Tracking_Actions::get_instance();
	$tracking_items = $shipment_tracking->get_tracking_items( $order->get_id(), true );
	if ( ! empty( $tracking_items ) ) {
		if ( ! isset( $params['properties'] ) ) {
    		$params['properties'] = [];
    	}
		// use {{ order.properties.tracking[0].tracking_code }} to access the first providers tracking_code and insert it in a Jilt email
		$params['properties']['tracking'] = $tracking_items;
		// use {{ order.properties.tracking_code }} to access the tracking_number and insert it in a Jilt email
		$params['properties']['tracking_code'] = $tracking_items[0]['tracking_number'];
	}
    return $params;
}
add_filter( 'wc_jilt_order_params', 'sv_add_tracking_info_to_jilt_order_params', 10, 2 );