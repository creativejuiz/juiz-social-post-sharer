<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin’ uh?' );
}

/**
 * Getting options from the right place.
 * Multisite compatibility.
 *
 * @since   1.4.7
 * @since   1.4.11 Includes $site parameter.
 *
 * @author  Marie Comet, Geoffrey Crofte
 */
function jsps_get_option( $option_name = '', $site = null ) {

	$is_network_active = function_exists( 'is_plugin_active_for_network' ) &&is_plugin_active_for_network( JUIZ_SPS_SLUG . '/' . JUIZ_SPS_SLUG . '.php' ) ? true : false;

	// When we want a precise option in a network activated website.
	if ( ! empty( $option_name ) && true === $is_network_active ) {
		$options = get_blog_option( $site === null ? get_current_blog_id() : (int) $site, JUIZ_SPS_SETTING_NAME );
		return $options[ $option_name ];
	}

	// When we want all options in a network activated website.
	else if ( empty( $option_name ) && true === $is_network_active ) {
		return get_blog_option( $site === null ? get_current_blog_id() : (int) $site, JUIZ_SPS_SETTING_NAME );
	}

	// When we want a precise option in a simple website.
	else if ( ! empty( $option_name ) && false === $is_network_active ) {
		$options = get_option( JUIZ_SPS_SETTING_NAME );
		return $options[ $option_name ];
	}

	// When we want all options in a simple website.
	else {
		return get_option( JUIZ_SPS_SETTING_NAME );
	}

}

/**
 * Updating options to the right place.
 * Multisite compatibility.
 *
 * @since   1.4.7
 * @since   1.4.11 Includes $site parameter.
 *
 * @author  Marie Comet, Geoffrey Crofte
 */
function jsps_update_option( $options, $site = null ) {

	if ( ! is_array( $options ) ) {
		die( '$options has to be an array' );
	}

	$is_network_active = function_exists( 'is_plugin_active_for_network' ) &&is_plugin_active_for_network( JUIZ_SPS_SLUG . '/' . JUIZ_SPS_SLUG . '.php' ) ? true : false;

	/**
	 * Add action before updating the options.
	 * 
	 * @hook jsps_before_update_option
	 *
 	 * @since  2.0.0 First version
 	 * @param  {array}    $options  The plugin options in one array.
 	 * @param  {int|null} $site     The site ID in multisite context, or null
	 */
	do_action( 'jsps_before_update_option', $options, $site );

	// When we want to update options in a network activated website.
	if ( true === $is_network_active ) {
		$options = update_blog_option( $site === null ? get_current_blog_id() : (int) $site, JUIZ_SPS_SETTING_NAME, $options );
	}

	// When we want to update options in a simple website.
	else {
		$options = update_option( JUIZ_SPS_SETTING_NAME, $options );
	}

	return $options;
}

/**
 * Init options for multi-sites when plugin is activated.
 * 
 * @param  array $init_options For a better Multisite support
 * @return (void)
 *
 * @since 1.4.11
 * @author Geoffrey Crofte
 */
function jsps_init_option_ms( $init_options ) {

	$is_network_active = function_exists( 'is_plugin_active_for_network' ) &&is_plugin_active_for_network( JUIZ_SPS_SLUG . '/' . JUIZ_SPS_SLUG . '.php' ) ? true : false;
	
	if ( ! $is_network_active ) {
		return;
	}

	$sites = get_sites( array( 'fields' => 'ids' ) );
	foreach ($sites as $site ) {
		$options = jsps_get_option( '', $site );

		// If $options isn't an array, init for this site.
		if ( ! is_array( $options) ) {
			jsps_update_option( $init_options, $site );
		}
	}
}
