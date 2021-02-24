<?php

/**
 * Adds custom properties to Customer data included in Jilt webhooks.
 * 
 * @param array $payload webhook payload
 * @param string $resource resource type (i.e customer)
 * @param int $resource_id resource ID (i.e User ID)
 * @param int $webhook_id webhook ID
 */
add_filter( 'woocommerce_webhook_payload', function ( $payload, $resource, $resource_id, $webhook_id ) {

    if ( 'customer' !== $resource ) {
        return $payload;
    }

    try {

        $webhook = new \WC_Webhook( $webhook_id );
        
        // confirm the webhook payload is being delivered to Jilt
        if ( false !== strpos( $webhook->get_delivery_url(), wc_jilt()->get_app_hostname() ) ) {

            // TODO: update to include custom properties for the User being updated (use $resource_id)
            $payload['custom_properties'] = [
                'user_id' => $resource_id,
                'foo' => 'bar',
            ];
        }

        return $payload;

    } catch ( Exception $exception ) {
        
        return $payload;
    }
}, 10, 4 );
