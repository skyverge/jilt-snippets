<?php // only copy this line if needed

/**
 * Add consent checkbox to Jilt WooCommerce signup forms
 * http://help.jilt.com/en/articles/3431443-adding-signup-forms-to-your-store
 * 
 */

add_action( 'wc_jilt_subscribe_form_tag', 'jilt_add_id_tag', 10, 2 );

function jilt_add_id_tag() {
  echo 'id="jilt-signup-form"';
}

add_action( 'wc_jilt_subscribe_form_end', 'jilt_add_consent_input', 10, 2 );

function jilt_add_consent_input() {
  echo '<input type="checkbox" form="jilt-signup-form" id="jilt-consent-input" name="jilt-consent-input" checked required><label for="jilt-consent">This is my consent</label>';
}