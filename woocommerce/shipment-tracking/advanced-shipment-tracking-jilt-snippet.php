<?php // only copy this line if needed

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

	if ( class_exists( 'WC_Advanced_Shipment_Tracking_Actions' ) ) {

		$order_id = $order->get_id();

		if ( function_exists( 'ast_get_tracking_items' ) ) {
			$tracking_items = ast_get_tracking_items($order_id);

			if ( ! empty( $tracking_items ) ) {
				if ( ! isset( $params['properties'] ) ) {
					$params['properties'] = [];
				}
			}		
			
			$params['properties']['tracking_code'] = $tracking_items[0]['tracking_number'];
			$params['properties']['tracking_url'] = $tracking_items[0]['formatted_tracking_link'];

			foreach($tracking_items as $tracking_item){		
				$params['properties']['tracking']['tracking_code'] = $tracking_item['tracking_number'];
				$params['properties']['tracking']['tracking_provider'] = $tracking_item['formatted_tracking_provider'];
				$params['properties']['tracking']['tracking_url'] = $tracking_item['formatted_tracking_link'];							
			}

		}	
	}

    return $params;
}
add_filter( 'wc_jilt_order_params', 'sv_add_tracking_info_to_jilt_order_params', 10, 2 );
