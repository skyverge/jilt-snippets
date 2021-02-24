<?php // copy this line if needed only

add_action( 'wp_head', function () { ?>
	<script>
    // change each of the translation text strings with the text you would like to translate them to
		jQuery( document ).ready(function() {
		  jQuery('#jilt-sign-up-form-email').attr("placeholder","Email translation");
		  jQuery('#jilt-sign-up-form-first-name').attr("placeholder","First Name translation");
		  jQuery('#jilt-sign-up-form-last-name').attr("placeholder","Last Name translation");
          jQuery('.jilt-sign-up-form__submit').text("Subscribe Translation")
		});

	</script>
<?php } );
