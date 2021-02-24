<?php

	/**
     * Adds a order notes to the order data used to update a Jilt order via the API.
     *
     * You can insert the value of that property into a Jilt email using Liquid: http://help.jilt.com/en/articles/1288803-what-is-liquid-and-why-is-it-magic
     *
     * @param array          $params order data
     * @param \WC_Jilt_Order $order  order object
     *
     * @return array
     */
    function sv_add_tracking_info_to_jilt_order_params($params, $order)
    {
        if ($notes = $order->get_customer_order_notes()) {
            
            // use {{ order.properties.notes }} to access this value and insert it in a Jilt email
            foreach ($notes as $note) {
                $params['properties']['notes'][] = $note->comment_content;
            }
        }

        return $params;
    }
    
    add_filter('wc_jilt_order_params', 'sv_add_tracking_info_to_jilt_order_params', 10, 2 );
