<?php
/**
 * Adds the products' purchase notes to the order data used to update a Jilt order via the API.
 *
 * You can insert the value of that property into a Jilt email using Liquid: http://help.jilt.com/en/articles/1288803-what-is-liquid-and-why-is-it-magic
 *
 * @param array          $params order data
 * @param \WC_Jilt_Order $order  order object
 *
 * @return array
 */

function sv_add_purchase_note_to_order_notes($params, $order) {
    foreach ( $order->get_items() as $item ) {
        if ( $item instanceof \WC_Order_Item_Product && ( $product = $item->get_product() ) ) {
            $params['properties']['notes'][] = $product->get_purchase_note();
        }
    }
    return $params;
}

add_filter('wc_jilt_order_params', 'sv_add_purchase_note_to_order_notes', 10, 2 );