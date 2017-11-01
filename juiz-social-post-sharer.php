<?php if ( ! defined( 'ABSPATH' ) ) exit;
/*
Plugin Name: Juiz Social Post Sharer
Plugin URI: http://wordpress.org/extend/plugins/juiz-social-post-sharer/
Description: Add buttons after (or before, or both) your posts to allow visitors share your content (includes no JavaScript mode). You can also use <code>juiz_sps($array)</code> template function or <code>[juiz_sps]</code> shortcode. For more informations see the setting page located in <strong>Settings</strong> submenu.
Author: Geoffrey Crofte
Version: 1.4.8
Author URI: http://geoffrey.crofte.fr
License: GPLv2 or later
Text Domain: juiz-social-post-sharer
Domain Path: /languages



Copyright 2012-2017  Geoffrey Crofte  (email : support@creativejuiz.com)

    
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

define( 'JUIZ_SPS_PLUGIN_NAME',	 'Juiz Social Post Sharer' );
define( 'JUIZ_SPS_VERSION',		 '1.4.8' );
define( 'JUIZ_SPS_FILE',		 __FILE__ );
define( 'JUIZ_SPS_DIRNAME',		 basename( dirname( __FILE__ ) ) );
define( 'JUIZ_SPS_PLUGIN_URL',	 plugin_dir_url( __FILE__ ));
define( 'JUIZ_SPS_SLUG',		 'juiz-social-post-sharer' );
define( 'JUIZ_SPS_SETTING_NAME', 'juiz_SPS_settings' );

// Checking network activation.
$is_nw_activated = function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( JUIZ_SPS_SLUG . '/' . JUIZ_SPS_SLUG . '.php' ) ? true : false;

define( 'JUIZ_SPS_NETWORK_ACTIVATED', $is_nw_activated );

	
// Multilingal.
add_action( 'init', 'make_juiz_sps_multilang' );
function make_juiz_sps_multilang() {
	load_plugin_textdomain( 'juiz-social-post-sharer', false, JUIZ_SPS_DIRNAME.'/languages' );
}

/**
 * Getting options from the right place.
 * Multisite compatibility.
 *
 * @author Marie Comet, Geoffrey Crofte
 * @since 1.4.7
 */
function jsps_get_option( $option_name = '' ) {

	// When we want a precise option in a network activated website.
	if ( ! empty( $option_name ) && true === JUIZ_SPS_NETWORK_ACTIVATED ) {
		$options = get_blog_option( get_current_blog_id(), JUIZ_SPS_SETTING_NAME );
		return $options[ $option_name ];
	}

	// When we want all options in a network activated website.
	else if ( empty( $option_name ) && true === JUIZ_SPS_NETWORK_ACTIVATED ) {
		return get_blog_option( get_current_blog_id(), JUIZ_SPS_SETTING_NAME );
	}

	// When we want a precise option in a simple website.
	else if ( ! empty( $option_name ) && false === JUIZ_SPS_NETWORK_ACTIVATED ) {
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
 * @author Marie Comet, Geoffrey Crofte
 * @since 1.4.7
 */
function jsps_update_option( $options ) {

	if ( ! is_array( $options ) ) {
		die( '$options has to be an array' );
	}

	// When we want to update options in a network activated website.
	if ( true === JUIZ_SPS_NETWORK_ACTIVATED ) {
		$options = update_blog_option( get_current_blog_id(), JUIZ_SPS_SETTING_NAME, $options );
		return $options;
	}

	// When we want to update options in a simple website.
	else {
		$options = update_option( JUIZ_SPS_SETTING_NAME, $options );
	}
}

if ( is_admin() || ( defined( 'DOING_AJAX' ) && ! DOING_AJAX ) ) {
	
	include('admin/jsps-admin.inc.php');

} // end if is_admin


if ( ! is_admin() ) {

	// Enqueue & deregister
	add_action( 'wp_enqueue_scripts', 'juiz_sps_style_and_script');
	if ( ! function_exists( 'juiz_sps_style_and_script' ) ) {

		function juiz_sps_style_and_script() {

			$juiz_sps_options = jsps_get_option();

			if ( is_array( $juiz_sps_options ) ) {

				// TODO future : if(is_numeric($juiz_sps_options['juiz_sps_style'] ) && $juiz_sps_options['juiz_sps_write_css_in_html']==0)
				if ( is_numeric( $juiz_sps_options['juiz_sps_style'] ) && apply_filters( 'juiz_sps_use_default_css', true ) ) {

					wp_enqueue_style( 'juiz_sps_styles', JUIZ_SPS_PLUGIN_URL . 'css/' . JUIZ_SPS_SLUG . '-' . $juiz_sps_options['juiz_sps_style'] . '.min.css', false, JUIZ_SPS_VERSION, 'all' );
				}
				if (
					( is_numeric ( $juiz_sps_options['juiz_sps_counter'] ) && $juiz_sps_options['juiz_sps_counter'] == 1 )
					||
					( isset( $juiz_sps_options['juiz_sps_networks']['print'] ) && $juiz_sps_options['juiz_sps_networks']['print'][0] === 1 )
					||
					( isset( $juiz_sps_options['juiz_sps_networks']['bookmark'] ) && $juiz_sps_options['juiz_sps_networks']['bookmark'][0] === 1 )
				) {

					wp_enqueue_script( 'juiz_sps_scripts', JUIZ_SPS_PLUGIN_URL . 'js/' . JUIZ_SPS_SLUG . '.min.js', array('jquery'), JUIZ_SPS_VERSION, true );
				}
			}
		}
	}


	// Thanks to http://boiteaweb.fr/sf_get_current_url-obtenir-url-courante-fonction-semaine-5-6765.html
	if ( ! function_exists( 'sf_get_current_url' ) ) {
		function sf_get_current_url( $mode = 'base' ) {
			
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


	// template function
	if ( ! function_exists( 'get_juiz_sps' ) ) {
		function get_juiz_sps( $networks = array(), $counters = 0, $is_current_page_url = 0, $is_shortcode = 0, $url_to_share = NULL ) {

			global $post;

			$show_me =  ( get_post_meta( $post->ID, '_jsps_metabox_hide_buttons', true) == 'on' ) ? false : true;
			$show_me = 	$is_shortcode ? true : $show_me;

			// show buttons only if post meta don't ask to hide it, and if it's not a shortcode.
			if ( $show_me ) {

				// url needed by user ?
				$url_needed_by_user = ( $url_to_share != NULL ) ? $url_to_share : false;
				if ( in_array( $url_needed_by_user, array( 'permalink', 'siteurl' ) ) ) {
					switch( $url_needed_by_user ) {
						case 'permalink' :
							$url_needed_by_user = get_permalink();
							break;
						case 'siteurl' :
							$url_needed_by_user = get_bloginfo('url');
							break;
					}
				}
				else {
					$url_needed_by_user = esc_url( $url_needed_by_user );
				}

				// texts, URL and image to share
				$text = wp_strip_all_tags( esc_attr( rawurlencode( $post->post_title ) ) );
				$url = $post ? get_permalink() : sf_get_current_url( 'raw' );
				$url = ( $url_needed_by_user == false ) ? $url : $url_needed_by_user;
				//$url = urlencode(get_permalink());
				if ( $is_current_page_url &&  $url_needed_by_user == false ) {
					$url = sf_get_current_url( 'raw' );
				}

				$url = apply_filters( 'juiz_sps_the_shared_permalink', $url );
				$image = has_post_thumbnail( $post->ID ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ) : '';

				// some text filters
				$total_word = apply_filters( 'juiz_sps_total_count_word', __( 'Total: ', 'juiz-social-post-sharer' ) );

				// some markup filters
				$hide_intro_phrase 			= apply_filters( 'juiz_sps_network_name', false );
				$share_the_post_sentence 	= apply_filters( 'juiz_sps_intro_phrase_text', __('Share the post', 'juiz-social-post-sharer') );
				$before_the_sps_content 	= apply_filters( 'juiz_sps_before_the_sps', '' );
				$after_the_sps_content 		= apply_filters( 'juiz_sps_after_the_sps', '' );
				$before_the_list 			= apply_filters( 'juiz_sps_before_the_list', '' );
				$after_the_list 			= apply_filters( 'juiz_sps_after_the_list', '' );
				$before_first_i 			= apply_filters( 'juiz_sps_before_first_item', '' );
				$after_last_i 				= apply_filters( 'juiz_sps_after_last_item', '' );
				$container_classes 			= apply_filters( 'juiz_sps_container_classes', '' );
				$rel_nofollow 				= apply_filters( 'juiz_sps_links_nofollow', 'rel="nofollow"' );

				// markup filters
				$div 	= apply_filters( 'juiz_sps_container_tag', 'div' );
				$p 		= apply_filters( 'juiz_sps_phrase_tag', 'p' );
				$ul 	= apply_filters( 'juiz_sps_list_container_tag', 'ul' ); 
				$li 	= apply_filters( 'juiz_sps_list_of_item_tag', 'li' );


				// get the plugin options
				$juiz_sps_options = jsps_get_option();

				// classes and attributes options
				$juiz_sps_target_link = ( isset( $juiz_sps_options['juiz_sps_target_link'] ) && $juiz_sps_options['juiz_sps_target_link'] == 1 ) ? ' target="_blank"' : '';
				$juiz_sps_hidden_name_class = ( isset( $juiz_sps_options['juiz_sps_hide_social_name'] ) && $juiz_sps_options['juiz_sps_hide_social_name'] == 1 ) ? ' juiz_sps_hide_name' : '';
				$container_classes .= ( intval( $counters ) == 1 ) ? ' juiz_sps_counters' : '';
				$container_classes .= ( isset( $juiz_sps_options['juiz_sps_counter_option'] ) ) ? ' counters_' . $juiz_sps_options['juiz_sps_counter_option'] : ' counters_both';

				// other options
				$juiz_sps_display_where = isset( $juiz_sps_options['juiz_sps_display_where'] ) ? $juiz_sps_options['juiz_sps_display_where'] : '';
				$force_pinterest_snif = isset( $juiz_sps_options['juiz_sps_force_pinterest_snif'] ) ? intval( $juiz_sps_options['juiz_sps_force_pinterest_snif'] ) : 0;

				// beginning markup
				$juiz_sps_content = $before_the_sps_content;
				$juiz_sps_content .= "\n" . '<' . $div . ' class="juiz_sps_links ' . esc_attr( $container_classes ) . ' juiz_sps_displayed_' . $juiz_sps_display_where . '">';
				$juiz_sps_content .= $hide_intro_phrase ? '' : "\n" . '<' . $p . ' class="screen-reader-text juiz_sps_maybe_hidden_text">' . $share_the_post_sentence . ' "' . wp_strip_all_tags( get_the_title() ) . '"</' . $p . '>' . "\n";
				$juiz_sps_content .= $before_the_list;
				$juiz_sps_content .= "\n\t" . '<' . $ul . ' class="juiz_sps_links_list' . esc_attr( $juiz_sps_hidden_name_class ) . '">';
				$juiz_sps_content .= $before_first_i;

				// networks to display
				// 2 differents results by: 
				// -- using hook (options from admin panel)
				// -- using shortcode/template-function (the array $networks in parameter of this function)
				$juiz_sps_networks = array();

				if ( ! empty( $networks ) ) {
					// compare $juiz_sps_options['juiz_sps_networks'] array and $networks array and conserve form the first one all that correspond to the second one's keys
					$juiz_sps_networks = array();

					foreach( $juiz_sps_options['juiz_sps_networks'] as $k => $v ) {
						if ( in_array( $k, $networks ) ) {
							$juiz_sps_networks[ $k ] = $v;
							$juiz_sps_networks[ $k ][0] = 1; // set its visible value to 1 (visible)
						}
					}

				}
				else {
					$juiz_sps_networks = $juiz_sps_options['juiz_sps_networks'];
				}


				// each links (come from options or manual array)
				foreach( $juiz_sps_networks as $k => $v ) {
					if ( $v[0] == 1 ) {
						$api_link = $api_text = '';
						$url  = apply_filters( 'juiz_sps_the_shared_permalink_for_' . $k, $url );
						$network_name = isset( $v[1] ) ? $v[1] : $k;
						$network_name = apply_filters( 'juiz_sps_share_name_for_' . $k, $network_name );

						$twitter_user = $juiz_sps_options['juiz_sps_twitter_user'] != '' ? '&amp;related=' . $juiz_sps_options['juiz_sps_twitter_user'] . '&amp;via=' . $juiz_sps_options['juiz_sps_twitter_user'] : '';

						$api_text = apply_filters( 'juiz_sps_share_text_for_' . $k, sprintf( __( 'Share this article on %s', 'juiz-social-post-sharer' ), $network_name ) );

						$more_attr = $juiz_sps_target_link;

						switch ( $k ) {
							case 'twitter' :
								$api_link = 'https://twitter.com/intent/tweet?source=webclient&amp;original_referer=' . $url . '&amp;text=' . $text . '&amp;url=' . $url . $twitter_user;
								break;

							case 'facebook' :
								$api_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
								break;

							case 'google' :
								$api_link = 'https://plus.google.com/share?url=' . $url;
								break;

							case 'pinterest' :
								if ( $image != '' && $force_pinterest_snif == 0 ) {
									$api_link = 'https://pinterest.com/pin/create/bookmarklet/?media=' . $image[0] . '&amp;url=' . $url . '&amp;title=' . get_the_title() . '&amp;description=' . $post->post_excerpt;
								}
								else {
									$api_link = "javascript:void((function(){var%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());";
									$more_attr = '';
								}
								$api_text = apply_filters( 'juiz_sps_share_text_for_' . $k, __( 'Share an image of this article on Pinterest', 'juiz-social-post-sharer' ) );
								break;

							case 'viadeo' :
								$api_link = 'https://www.viadeo.com/?url=' . $url . '&amp;title=' . $text;
								break;

							case 'linkedin':
								$api_link = 'https://www.linkedin.com/shareArticle?mini=true&amp;ro=true&amp;trk=JuizSocialPostSharer&amp;title=' . $text . '&amp;url=' . $url;
								break;

							case 'digg':
								$api_link = 'https://digg.com/submit?phase=2%20&amp;url=' . $url . '&amp;title=' . $text;
								break;

							case 'stumbleupon':
								$api_link = 'https://www.stumbleupon.com/badge/?url=' . $url;
								break;

							case 'tumblr':
								$api_link = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $url;
								break;

							case 'reddit':
								$api_link = 'https://www.reddit.com/submit?url=' . $url . '&amp;title=' . $text;
								break;

							case 'delicious':
								$api_link = 'https://delicious.com/save?v=5&amp;provider=JSPS&amp;url=' . $url . '&amp;title=' . $text;
								break;

							case 'weibo':
								// title tips by Aili (thank you ;p)
        						$simplecontent = $text . esc_attr( urlencode( " : " . mb_substr( strip_tags( $post->post_content ), 0, 90, 'utf-8') ) );
        						$api_link = 'http://service.weibo.com/share/share.php?title=' . $simplecontent . '&amp;url=' . $url;
        						break;

							case 'vk':
								$api_link = 'https://vkontakte.ru/share.php?url=' . $url;
								break;

							case 'mail' :
								if ( strpos( $juiz_sps_options['juiz_sps_mail_body'], '%%' ) || strpos( $juiz_sps_options['juiz_sps_mail_subject'], '%%' ) ) {
									$api_link = 'mailto:?subject=' . $juiz_sps_options['juiz_sps_mail_subject'] . '&amp;body=' . $juiz_sps_options['juiz_sps_mail_body'];
									$api_link = preg_replace( array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#', '#%%url%%#'), array( get_the_title(), get_site_url(), get_permalink(), $url ), $api_link );
								}
								else {
									$api_link = 'mailto:?subject=' . $juiz_sps_options['juiz_sps_mail_subject'] . '&amp;body=' . $juiz_sps_options['juiz_sps_mail_body'] . ":" . $url;
								}
								$api_text = apply_filters( 'juiz_sps_share_text_for_' . $k, __( 'Share this article with a friend (email)', 'juiz-social-post-sharer') );
								break;

							case 'bookmark' :
								$api_link = $url;
								$api_text = apply_filters( 'juiz_sps_share_text_for_' . $k, __( 'Bookmark this article (on your browser)', 'juiz-social-post-sharer') );
								$more_attr = ' data-alert="' . esc_attr( __( 'Press %s to bookmark this page.', 'juiz-social-post-sharer' ) ) . '"';
								break;

							case 'print' :
								$api_link = '#';
								$api_text = apply_filters( 'juiz_sps_share_text_for_' . $k, __( 'Print this page', 'juiz-social-post-sharer') );
								$more_attr = '';
								break;
						}

						$juiz_sps_content .= '<' . $li . ' class="juiz_sps_item juiz_sps_link_' . esc_attr( $k ) . '"><a href="' . wp_strip_all_tags( esc_attr( $api_link ) ) . '" ' . $rel_nofollow . '' . $more_attr . ' title="' . esc_attr( $api_text ) . '"><span class="juiz_sps_icon jsps-' . esc_attr( $k ) . '"></span><span class="juiz_sps_network_name">' . esc_html( $network_name ) . '</span></a></' . $li . '>';

					}
				}

				$general_counters = ( isset( $juiz_sps_options['juiz_sps_counter'] ) && $juiz_sps_options['juiz_sps_counter'] == 1 ) ? 1 : 0;

				// no data-* attribute if user markup is not HTML5 :/
				$hidden_info = '<input type="hidden" class="juiz_sps_nonce" value="' . wp_create_nonce('get_network_counters') . '" /><input type="hidden" class="juiz_sps_info_permalink" value="' . $url . '" />';

				$juiz_sps_content .= $after_last_i;

				// show total counter only when "both" or "total" is selected
				if ( isset( $juiz_sps_options['juiz_sps_counter_option'] ) ) {
					if ( $juiz_sps_options['juiz_sps_counter_option'] == 'both' || $juiz_sps_options['juiz_sps_counter_option'] == 'total' ) {
						$juiz_sps_content .= ( 
												( $general_counters == 1 && intval( $counters ) == 1)
												||
												( $general_counters == 0 && intval( $counters ) == 1 )
											 )
											 ?
											 '<' . $li . ' class="juiz_sps_item juiz_sps_totalcount_item"><span class="juiz_sps_totalcount" title="' . esc_attr( $total_word ) . '"><span class="juiz_sps_t_nb"></span></span></' . $li . '>'
											 : '';
					}
				}
				$juiz_sps_content .= '</' . $ul . '>' . "\n\t";
				$juiz_sps_content .= $after_the_list;
				$juiz_sps_content .= ( ( $general_counters == 1 && intval( $counters ) == 1 ) || ( $general_counters == 0 && intval( $counters ) == 1 ) )  ? $hidden_info : '';
				$juiz_sps_content .= '</' . $div . '>' . "\n\n";
				$juiz_sps_content .= $after_the_sps_content;


				// final markup

				return $juiz_sps_content;

			} // end of if post meta hide sharing buttons

		} // end of get_juiz_sps()
	} // end of if exists


	// just a little alias
	if ( ! function_exists( 'juiz_sps' ) ) {
		function juiz_sps( $networks = array(), $counters = 0, $current_page = 0, $is_shortcode = 0, $url_to_share = NULL ) {
			echo get_juiz_sps( $networks, $counters, $current_page, $is_shortcode, $url_to_share );
		}
	}

	// write buttons in content
	add_filter( 'the_content', 'juiz_sps_print_links', 10, 1 );
	if ( apply_filters( 'juiz_sps_buttons_in_excerpt', false ) ) {
		add_filter( 'the_excerpt', 'juiz_sps_print_links', 10, 1 );
	}

	if ( ! function_exists( 'juiz_sps_print_links' ) ) {
		function juiz_sps_print_links( $content ) {
			
			$juiz_sps_options = jsps_get_option();

			if ( isset( $juiz_sps_options['juiz_sps_display_in_types'] ) ) {

				// write buttons only if administrator checked this type
				$is_all_lists = in_array( 'all_lists', $juiz_sps_options['juiz_sps_display_in_types'] );
				$singular_options = $juiz_sps_options['juiz_sps_display_in_types'];
				unset( $singular_options['all_lists'] );

				$is_lists_authorized = ( is_archive() || is_front_page() || is_search() || is_tag() || is_post_type_archive() || is_home()) && $is_all_lists ? true : false;
				$is_singular = is_singular( $singular_options );

				if ( $is_singular || $is_lists_authorized ) {

					$need_counters = $juiz_sps_options['juiz_sps_counter'] ? 1 : 0;

					$jsps_links = get_juiz_sps( array(), $need_counters );

					$juiz_sps_display_where = isset( $juiz_sps_options['juiz_sps_display_where'] ) ? $juiz_sps_options['juiz_sps_display_where'] : '';

					if ( 'top' == $juiz_sps_display_where || 'both' == $juiz_sps_display_where ) {
						$content = $jsps_links . $content;
					}
					if ( 'bottom' == $juiz_sps_display_where || 'both' == $juiz_sps_display_where ) {
						$content = $content . $jsps_links;
					}

					return $content;
				}
				else { 
					return $content;
				}
			}
			else {
				return $content;
			}

		} // end function
	} // end if function exists


	/*
	 * Add shortcode
	 */
	if ( ! function_exists( 'sc_4_jsps' ) ) {

		function sc_4_jsps( $atts ) {
			
			$atts = shortcode_atts( array(
				'buttons' 	=> 'facebook,twitter,mail,google,stumbleupon,linkedin,pinterest,viadeo,digg,weibo',
				'counters'	=> 0,
				'current'	=> 1,
				'url'		=> NULL
			), $atts );
			
			// buttons become array ("digg,mail", "digg ,mail", "digg, mail", "digg , mail", are right syntaxes)
			$jsps_networks 		= preg_split( '#[\s+,\s+]#', $atts['buttons'] );
			$jsps_counters 		= intval( $atts['counters'] );
			$jsps_current_page 	= intval( $atts['current'] );
			$jsps_url 			= $atts['url'];

			if ( $jsps_current_page == 1 ) {
				wp_enqueue_script( 'juiz_sps_scripts', JUIZ_SPS_PLUGIN_URL . 'js/' . JUIZ_SPS_SLUG . '.min.js', array( 'jquery' ), false, true );
			}
			
			ob_start();
			juiz_sps( $jsps_networks, $jsps_counters, $jsps_current_page, 1, $jsps_url ); //do an echo
			$jsps_sc_output = ob_get_contents();
			ob_end_clean();
			

			return $jsps_sc_output;
		}
		add_shortcode( 'juiz_social','sc_4_jsps' );
		add_shortcode( 'juiz_sps'   ,'sc_4_jsps' );
	}

} // end of if not admin

function jsps_get_network_counters() {
	if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'get_network_counters' ) || ! isset( $_GET['nw'] ) || ! isset( $_GET['url'] ) ) {
		wp_send_json_error( 'Something’s wrong with the request. Sorry.' );
		exit;
	}
	
	$data = '';
	$remote_args = array(
		'timeout'     => 5,
		'redirection' => 10,
		'user-agent'  => 'WordPress; JSPS ' . home_url(),
		'sslverify'   => false,
	);

	// Stumble case.
	if ( 'stumble' === $_GET['nw'] ) {
		$data = wp_remote_get( esc_url( 'http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $_GET['url'] ), $remote_args );
		if ( is_array( $data ) ) {
			$body = $data['body'];
			$result = json_decode( $body );

			if ( isset( $result->result->views ) ) {
				$data = $result->result->views;
			}
		}

		wp_send_json_success( $data );
		exit;
	} else {
		wp_send_json_error( 'Not a stumble Request' );
		exit;
	}
}
add_action( 'wp_ajax_nopriv_get_network_counters', 'jsps_get_network_counters' );
add_action( 'wp_ajax_get_network_counters', 'jsps_get_network_counters' );
