<?php //only include this line if necessary

add_action( 'wp_print_footer_scripts', function() {

	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		ob_start();
		?>
		<script>
            		window._klarnaCheckout(function(api) {  
			  api.on({    
				'change': function(data) {    
				  jilt.setCustomer({ email: data.email })    
				}  
			  });
			});
		</script>
		<?php
		echo ob_get_clean();
	}
} );
