<?php //only include this line if necessary

/**
 * Adds a custom property to the order data used to update a Jilt order via the API.
 * 
 * You can insert the value of that property into a Jilt email using Liquid: http://help.jilt.com/en/articles/1288803-what-is-liquid-and-why-is-it-magic
 *
 * @param array $params order data
 * @param \WC_Jilt_Order $order order object
 * @return array
 */

function sv_add_meta_to_jilt_order_params( $params, $order ) {

    // TODO: replace with code to retrieve the custom data for the given order
    // For example: $custom_meta_data = get_post_meta( $order->get_id() , 'ups_shipment_ids', true );

    $custom_meta_data = get_post_meta( $order->get_id() , 'cb_address_house_number', true );
  
    if ( $custom_meta_data ) {

        if ( ! isset( $params['properties'] ) ) {
            $params['properties'] = [];
        }

        // use {{ order.properties.cb_address_house_number }} to access this value and insert it in a Jilt email
        $params['properties']['cb_address_house_number'] = $custom_meta_data;
    }

    return $params;
}
add_filter( 'wc_jilt_order_params', 'sv_add_meta_to_jilt_order_params', 10, 2 );
