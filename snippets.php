<?php
/**
 * Remove flat_rate from checkout page
 */
add_filter( 'woocommerce_package_rates', 'remove_flat_rate', 10, 2 );
function remove_flat_rate( $rates, $package ) {
	// If blog ID is 2 go further
	$blog_id = get_current_blog_id();
	if ( $blog_id === 2 ) {
		// If time is between 0 and 14 go further
		$time = (int)current_time('H');
		if ( $time >= 0 && $time < 14 ) {
			foreach( $rates as $key => $rate ) {
				// If flat_rate then unset()
				if ( $rate->get_method_id() === 'flat_rate' ) {
					unset( $rates[$key] );
				}
			}
		}
	}
	return $rates;
}