/*
Plugin Name: Juiz Social Post Sharer
Plugin URI: http://creativejuiz.fr
Author: Geoffrey Crofte
*/


/* Juiz SPS core */

;jQuery(document).ready(function($){
	
	jQuery.fn.juiz_get_counters = function(){
		return this.each(function(){
			
			var nonce       = $(this).find('.juiz_sps_nonce').val(),
				url         = $(this).find('.juiz_sps_info_permalink').val(),
				$twitter    = $(this).find('.juiz_sps_link_twitter'),
				$linkedin   = $(this).find('.juiz_sps_link_linkedin'),
				$delicious  = $(this).find('.juiz_sps_link_delicious'),
				$facebook   = $(this).find('.juiz_sps_link_facebook'),
				$pinterest  = $(this).find('.juiz_sps_link_pinterest'),
				$stumble    = $(this).find('.juiz_sps_link_stumbleupon'),
				item_class  = '';
				
			if ( $(this).hasClass('counters_total') ) {
				item_class = ' juiz_hidden_counter';
			}

			var twitter_url		= "//public.newsharecounts.com/count.json?url=" + url; 
			// return : {"count":18,"url":"http:\/\/www.creativejuiz.fr\/blog\/"}
			var delicious_url	= "//feeds.delicious.com/v2/json/urlinfo/data?url=" + url + "&callback=?" ;
			// return : [{"url": "http://www.creativejuiz.fr/blog", "total_posts": 2}]
			var linkedin_url	= "//www.linkedin.com/countserv/count/share?format=jsonp&url=" + url + "&callback=?";
			// return : {"count":17,"fCnt":"17","fCntPlusOne":"18","url":"http:\/\/stylehatch.co"}
			var pinterest_url   = "//api.pinterest.com/v1/urls/count.json?callback=?&url=" + url;
			// return : ({"count": 0, "url": "http://stylehatch.co"})
			var facebook_url	= "//graph.facebook.com/?id=" + url;
			// return : {"data": [{"like_count": 6,"total_count": 25,"share_count": 9,"click_count": 0,"comment_count": 10}]}
			var stumble_url		= ajaxurl + "?action=get_network_counters&_wpnonce=" + nonce + "&nw=stumble&url=" + url;


			if ( $twitter.length ) {
				$.getJSON(twitter_url)
					.done(function(data){
						$twitter.prepend('<span class="juiz_sps_counter'+item_class+'">' + data.count + '</span>');
					});
			}
			if ( $linkedin.length ) {
				$.getJSON(linkedin_url)
					.done(function(data){
						$linkedin.prepend('<span class="juiz_sps_counter'+item_class+'">' + data.count + '</span>');
					});
			}
			if ( $pinterest.length ) {
				$.getJSON(pinterest_url)
					.done(function(data){
						$pinterest.prepend('<span class="juiz_sps_counter'+item_class+'">' + data.count + '</span>');
					});
			}
			if ( $stumble.length ) {
				$.getJSON(stumble_url)
					.done(function(data){
						$stumble.prepend('<span class="juiz_sps_counter'+item_class+'">' + data.data + '</span>');
					})
			}
			if ( $facebook.length ) {
				$.getJSON(facebook_url)
					.done(function(data){
						var facebookdata = data.share.share_count;
						if ( facebookdata ) {
							$facebook.prepend('<span class="juiz_sps_counter'+item_class+'">' + facebookdata + '</span>');
						}
					});
			}
			if ( $delicious.length ) {
				$.getJSON(delicious_url)
					.done(function(data){
						$delicious.prepend('<span class="juiz_sps_counter'+item_class+'">' + data[0].total_posts + '</span>');
					});
			}
		});
	}; // juiz_get_counters()

	jQuery.fn.juiz_update_counters = function(){
		return this.each(function(){

			var $group			= $(this);
			var $total_count 	= $group.find('.juiz_sps_totalcount');
			var $total_count_nb = $total_count.find('.juiz_sps_t_nb');
			var total_text = $total_count.attr('title');
			$total_count.prepend('<span class="juiz_sps_total_text">'+total_text+'</span>');

			function count_total() {
				var total = 0;
				$group.find('.juiz_sps_counter').each(function(){
					total += parseInt($(this).text());
				});
				$total_count_nb.text(total);
			}
			setInterval(count_total, 1200);

		});
	}; // juiz_get_counters()

	$('.juiz_sps_links.juiz_sps_counters').juiz_get_counters();
	// only when total or both option is checked
	if ($('.juiz_sps_links.juiz_sps_counters.counters_subtotal').length == 0) {
		$('.juiz_sps_counters .juiz_sps_links_list').juiz_update_counters();
	}

	/**
	 * Print button
	 */
	if ( window.print ) {
		$('.juiz_sps_link_print').on('click', function(){
			window.print();
			return false;
		});
	}
	else {
		$('.juiz_sps_link_print').remove();
	}
	
	/**
	 * Bokmark button
	 *
	 * Contributions : Kilbourne fix https://github.com/creativejuiz/juiz-social-post-sharer/issues/6#issuecomment-191647422
	 */
	if (
		( 'addToHomescreen' in window && window.addToHomescreen.isCompatible )
		||
		( window.sidebar && window.sidebar.addPanel )
		||
		( (window.sidebar && /Firefox/i.test(navigator.userAgent)) || (window.opera && window.print) )
		||
		( window.external && ('AddFavorite' in window.external) )
		||
		( typeof chrome === 'undefined' )
		||
		( typeof chrome !== 'undefined' )
	) {
		$('.juiz_sps_link_bookmark').find('a').on('click', function(e){
			// Thanks to:
			// https://www.thewebflash.com/how-to-add-a-cross-browser-add-to-favorites-bookmark-button-to-your-website/
			var bookmarkURL = window.location.href;
			var bookmarkTitle = document.title;

			if ( 'addToHomescreen' in window && window.addToHomescreen.isCompatible ) {
				// Mobile browsers
				addToHomescreen({ autostart: false, startDelay: 0 }).show(true);
			}
			else if ( window.sidebar && window.sidebar.addPanel ) {
				// Firefox version < 23
				window.sidebar.addPanel(bookmarkTitle, bookmarkURL, '');
			}
			else if ( ( window.sidebar && /Firefox/i.test(navigator.userAgent) ) || ( window.opera && window.print ) ) {
				// Firefox version >= 23 and Opera Hotlist
				$(this).attr({
					href: bookmarkURL,
					title: bookmarkTitle,
					rel: 'sidebar'
				}).off( e );
				return true;
			}
			else if ( window.external && ( 'AddFavorite' in window.external ) ) {
				// IE Favorite
				window.external.AddFavorite(bookmarkURL, bookmarkTitle);
			}
			else {
				// Other browsers (mainly WebKit - Chrome/Safari)
				command = (/Mac/i.test(navigator.userAgent) ? 'Cmd' : 'Ctrl') + '+D';
				message = $(this).data('alert');
				message = message.replace(/%s/, command);
				alert( message );

				return false;

			}
			return false;
		});
	}
	else {
		$('.juiz_sps_link_bookmark').remove();
	}

});
/*
//var google_url = "https://clients6.google.com/rpc?key=YOUR_API_KEY";
//var digg_url = "http://services.digg.com/2.0/story.getInfo?links=" + url + "&type=javascript&callback=?"; 
*/