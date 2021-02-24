<?php //only copy if required

/**
 * Adds a local_pickup_plus property to the order data used to update a Jilt order via the API.
 * 
 * You can insert the value of that property into a Jilt email using Liquid: http://help.jilt.com/en/articles/1288803-what-is-liquid-and-why-is-it-magic
 *
 * @param array $params order data
 * @param \WC_Jilt_Order $order order object
 * @return array
 */
function sv_add_local_pickup_plus_info_to_jilt_order_params( $params, $order ) {
	
	if ( ! function_exists( 'wc_local_pickup_plus' ) ) {
		return $params;
	}
	
	$order_items_instance = wc_local_pickup_plus()->get_orders_instance()->get_order_items_instance();
	$local_pickup_locations = array();
	
	if ( ! isset( $params['properties'] ) ) {
		$params['properties'] = [];
	}
	

	foreach( $order->get_items( 'shipping' ) as $order_item ) {
	
		// use {{ order.properties.local_pickup_plus.line_items[0].name }} to access the first pickup location name selected on the order and insert it in a Jilt email
		$pickup_location_id 		= $order_items_instance->get_order_item_pickup_location_id( $order_item );
		$pickup_location_name 		= $order_items_instance->get_order_item_pickup_location_name( $order_item );
		$pickup_location_address 	= $order_items_instance->get_order_item_pickup_location_address( $order_item );
		$pickup_location_phone 		= $order_items_instance->get_order_item_pickup_location_phone( $order_item, false );
		$pickup_location_items 		= $order_items_instance->get_order_item_pickup_items( $order_item );
		
		$pickup_location_line_item = array(
			'id' 		=> $pickup_location_id,
			'name' 		=> $pickup_location_name,
			'address' 	=> $pickup_location_address,
			'phone' 	=> $pickup_location_phone,
			'items' 	=> $pickup_location_items,
		);
		
		try {
			
			$appointment = new \SkyVerge\WooCommerce\Local_Pickup_Plus\Appointments\Appointment( $order_item );
			
			$is_anytime				= $appointment->is_anytime();
			$appointment_type		= $is_anytime ? 'anytime' : 'pickup-time';
			$appointment_start_date	= $appointment->get_start()->format( 'Y-m-d' );
			$appointment_start_time	= $appointment->get_start()->format( 'H:i:s' );
			$appointment_end_date	= $appointment->get_start()->format( 'Y-m-d' );
			$appointment_end_time	= $appointment->get_start()->format( 'H:i:s' );

			$pickup_location_line_item['appointment_type'] 			= $appointment_type;
			$pickup_location_line_item['appointment_start_date'] 	= $appointment_start_date;
			$pickup_location_line_item['appointment_start_time'] 	= $appointment_start_time;
			$pickup_location_line_item['appointment_end_date'] 		= $appointment_end_date;
			$pickup_location_line_item['appointment_end_time'] 		= $appointment_end_time;
		} catch ( \Exception $e ) {
			// no appointment data or invalid order item
			continue;
		}
		
		$params['properties']['local_pickup_plus']['line_items'][] = $pickup_location_line_item;
	}
	
    return $params;
}
add_filter( 'wc_jilt_order_params', 'sv_add_local_pickup_plus_info_to_jilt_order_params', 10, 2 );
