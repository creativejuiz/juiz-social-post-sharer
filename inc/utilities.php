<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}


if ( ! function_exists( 'juiz_sf_get_current_url' ) ) {
	/**
	 * Get the real current page URL.
	 *
	 * @param (string) $mode The mode of the URL.
	 * @return (string) The current page URL.
	 *
	 * @since 1.5
	 * @author  BoiteAWeb.fr, Geoffrey Crofte
	 * @see http://boiteaweb.fr/sf_get_current_url-obtenir-url-courante-fonction-semaine-5-6765.html
	 */
	function juiz_sf_get_current_url( $mode = 'base' ) {
		
		$url = 'http' . ( is_ssl() ? 's' : '' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		
		switch ( $mode ) {
			case 'raw' :
				return $url;
				break;
			case 'base' :
				return reset( explode( '?', $url ) );
				break;
			case 'uri' :
				$exp = explode( '?', $url );
				return trim( str_replace( home_url(), '', reset( $exp ) ), '/' );
				break;
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'juiz_sps_get_ordered_networks') ) {
	/**
	 * Get the user-ordered list of networks.
	 *
	 * @param  (array) $networks A formated list of network (backward compatible before 2.0.0)
	 * @param  (array) $order    A list of network slugs.
	 * 
	 * @return (array)           An exploitable ordered list of networks.
	 * 
	 * @since  2.0.0
	 * @author Geoffrey Crofte
	 */
	function juiz_sps_get_ordered_networks( $networks, $order ) {
		$order = isset( $order ) && is_array( $order ) ? $order : null;

		// Sort networks by user choice order.
		// @see: https://stackoverflow.com/questions/348410/sort-an-array-by-keys-based-on-another-array/9098675#9098675
		return $order !== null ? array_replace( array_flip( $order ), $networks ) : $networks;
	}
}

if ( ! function_exists('juiz_sps_get_notification_markup') ) {
	/**
	 * Print the HTML code needed for JS notifications.
	 * 
	 * @return void
	 *
	 * @since  2.0.0
	 * @author Geoffrey Crofte
	 */
	function juiz_sps_get_notification_markup() {
		?>

		<div class="juiz-sps-notif">
			<div class="juiz-sps-notif-icon">
				<i class="dashicons" role="presentation"></i>
			</div>
			<p class="juiz-sps-notif-text"></p>
		</div>

		<?php
	}
}

if ( ! function_exists('juiz_sps_get_skin_css_name') ) {
	/**
	 * Return the name of the CSS file name for Button Skins
	 * 
	 * @return (string) The name of the file.
	 *
	 * @since  2.0.0
	 * @author Geoffrey Crofte
	 */
	function juiz_sps_get_skin_css_name() {
		return 'styles.css';
	}
}

if ( ! function_exists('juiz_sps_get_skin_img_name') ) {
	/**
	 * Return the name of the image name for Button Skins
	 * 
	 * @return (string) The name of the file.
	 *
	 * @since  2.0.0
	 * @author Geoffrey Crofte
	 */
	function juiz_sps_get_skin_img_name() {
		return 'screenshot.png';
	}
}

if ( ! function_exists('juiz_sps_remove_old_networks') ) {
	/**
	 * Return an array of networks without the old ones.
	 * 
	 * @return (array) The cleaned array
	 *
	 * @since  2.0.0
	 * @author Geoffrey Crofte
	 */
	function juiz_sps_remove_old_networks( $networks ) {
		unset( $networks['delicious']   );
		unset( $networks['digg']        );
		unset( $networks['stumbleupon'] );
		unset( $networks['google']      );

		return $networks;
	}
}

if ( ! function_exists( 'jsps_get_all_registered_networks' ) ) {
	/**
	 * Return a merged array of custom and core networks.
	 * 
	 * @return (array) The merged array.
	 *
	 * @since  2.0.0
	 * @author Geoffrey Crofte
	 */
	function jsps_get_all_registered_networks() {
		$custom_networks = jsps_get_custom_networks();
		$core_networks   = jsps_get_core_networks();

		return array_merge( $custom_networks, $core_networks );
	}
}

if ( ! function_exists( 'jsps_get_displayable_networks' ) ) {
	/**
	 * Get an array of exploitable ordered list of networks for front and admin purpose
	 *
	 * @param  (array) $networks A formated list of network (backward compatible before 2.0.0)
	 * @param  (array) $order    A list of network slugs.
	 * 
	 * @return (array)           An exploitable ordered list of networks.
	 * 
	 * @since  2.0.0
	 * @author Geoffrey Crofte
	 */
	function jsps_get_displayable_networks( $networks, $order ) {
		
		$core_networks   = jsps_get_core_networks();
		$custom_networks = jsps_get_custom_networks();

		// Backward compatibility / Conversion
		$reformated_old_list = array();
		if ( isset( $networks['google'] ) ) {
			foreach ( $networks as $k => $v ) {
				$reformated_old_list[ $k ] = array(
					'name' => $v[1],
					'visible' => $v[0],
				);
			}
			
			$reformated_old_list = juiz_sps_remove_old_networks( $reformated_old_list );
		}

		// Merge old list with the new registered core networks
		// To keep options of the users.
		$merged_core_networks = array_replace( $core_networks, $reformated_old_list );

		// Merge Custom and Core Networks, Core has the priority here.
		$merged_networks = array_merge( $custom_networks, $core_networks );

		// Merge Options registered by user woth complete list
		if ( ! isset( $networks['google'] ) ) {
			$merged_networks = array_merge( $merged_networks, $networks );
		}

		$networks = juiz_sps_get_ordered_networks( $merged_networks, $order );
		$networks = juiz_sps_remove_old_networks( $networks );

		return $networks;
	}
}

/**
 * A function that return the old network array option (before v2.0.0)
 * Used for debug purpose.
 *
 * @return (array) The old array of network options
 * 
 * @author  Geoffrey Crofte
 * @since  2.0.0
 */
function jsps_get_old_network_array() {
	return array(
		'delicious'		=>	array( 0, 'Delicious' ), // new 1.4.1
		'digg'	 		=>	array( 0, 'Digg' ),
		'facebook'		=>	array( 1, 'Facebook' ), 
		'google'		=>	array( 0, 'Google+' ),
		'linkedin' 		=>	array( 0, 'LinkedIn' ),
		'pinterest' 	=>	array( 0, 'Pinterest' ),
		'reddit'		=>	array( 0, 'Reddit' ), // new 1.4.1
		'stumbleupon'	=>	array( 0, 'StumbleUpon' ),
		'twitter'		=>	array( 1, 'Twitter' ), 
		'tumblr'		=>	array( 0, 'Tumblr' ), // new 1.4.1
		'viadeo' 		=>	array( 0, 'Viadeo' ),
		'vk'			=>	array( 0, 'VKontakte' ), // new 1.3.0
		'weibo'			=>	array( 0, 'Weibo' ), // new 1.2.0
		'mail'			=>	array( 1, 'Email' ),
		'bookmark'		=>	array( 0, 'Bookmark' ), // new 1.4.2
		'print'			=>	array( 0, 'Print' ) // new 1.4.2
	);
}

if ( ! function_exists('juiz_get_excerpt') ) {
	/**
	 * Get an excerpt from the post_content
	 * @param  (object) $post   The WP Post object.
	 * @param  (int)    $count  The number of letter needed.
	 * @return (string)         The excerpt.
	 *
	 * @author Geoffrey Crofte
	 * @since  2.0.0
	 */
	function juiz_get_excerpt( $post, $count = 80 ) {
		$count = apply_filters( 'juiz_get_excerpt_letter_count', $count );
		$text  = wordwrap( wp_strip_all_tags( $post->post_content ), (int) $count, "***", true );
		$tcut  = explode("***", $text);

		return $tcut[0];
	}
}