=== Juiz Social Post Sharer ===
Contributors: CreativeJuiz
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=P39NJPCWVXGDY&lc=FR&item_name=Juiz%20Social%20Post%20Sharer%20%2d%20WP%20Plugin&item_number=%23wp%2djsps&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: social, twitter, google, facebook, digg, stumbleupon, linkedin, pinterest, viadeo, weibo, vkontakte, post, share
Requires at least: 3.3
Tested up to: 4.7.4
Stable tag: 1.4.8

Add smart designed buttons after/before your posts to allow visitors sharing your content (includes no JavaScript mode & counters)

== Description ==

Add smart designed buttons after/before your posts to allow visitors sharing your content (includes no JavaScript mode & counters). Buttons are Retina/HDPI-ready, translation-ready and come with useful options and hooks.

Select your favorites social networks among a little list.
Display an optional sharings counter.

**You can donate to support**

* [Donate what you want with Paypal](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=P39NJPCWVXGDY&lc=FR&item_name=Juiz%20Social%20Post%20Sharer%20%2d%20WP%20Plugin&item_number=%23wp%2djsps&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted)
* [Flattr this thing!](https://flattr.com/submit/auto?user_id=CreativeJuiz&url=http://wordpress.org/plugins/juiz-social-post-sharer/&title=Juiz%20Social%20Post%20Sharer%20-%20WordPress%20Plugin&description=Awesome%20WordPress%20Plugin%20helping%20you%20to%20add%20buttons%20at%20the%20beginning%20or%20the%20end%20of%20your%20WordPress%20contents%20easily&tags=WordPress,Social,Share,Buttons,Network,Twitter,Facebook,Linkedin&category=software)

**Please, use the support forum to tell me bugs encountered, and be patient**


Social networks supported:

* Delicious
* Digg
* Facebook 
* Google+
* LinkedIn
* Pinterest
* Reddit
* StumbleUpon
* Tumblr
* Twitter
* Viadeo
* Weibo
* VKontakte

Other actions supported:

* Send by Mail (mailto:)
* Print
* Add to bookmark

Options plugin:

* 8 graphic templates available
* Choose from all available networks
* Open links in a new window (deactivated by default)
* Choose to display only the social network icon
* Add your Twitter account name to add "via" during a share
* Choose to display buttons only on certain type of post
* Choose to hide buttons only on certain posts directly in the edit page (metabox).
* Choose to display buttons at the bottom, the top of the content, or both (or just with shortcode)
* Customize mail texts (subject and body)
* Display a sharings counter (optional and in beta)
* Some hooks are available for markup customization (or add some things)
* A hook is available and offer you the opportunity to add the bouton you need
* Use shortcode <code>[juiz_sps]</code> or <code>[juiz_social]</code> where you want
* Use template function <code>juiz_sps()</code> or <code>get_juiz_sps()</code> in your code

Languages available:

* Deutsch (thank to [Dennis Schmitz](http://compcardinmotion.de "Dennis Schmitz's website")!)
* English
* French
* Japanese (thank to [半月 (Hangetsu)](http://wp.fruit-frappe.net/ "Hangetsu's website")!)
* Russian (thank you [Fandia](http://fandia.w.pw "Fandia's website")!)
* Serbian (thank to [Borisa Djuraskovic](http://www.webhostinghub.com "Borisa Djuraskovic's website")!)
* Spanish (thank to [Roberto Castiñeira](www.mediapartner.es "Roberto Castiñeira's website")!)
* Turkish (thanks to [Hakaner](http://hakanertr.wordpress.com/ "His website")!)

<strong>Full <a href="http://creativejuiz.fr/blog/doc/juiz-social-post-sharer-documentation.html">Documentation</a> available</strong>.


This tool relies on third-party applications (API), so if you say "it's broken", please tell me why ;)
Before adding a bad rating, thanks to open a support ticket to solve your issue.


== Installation ==

You can use one of both method :

**Installation via your Wordpress website**

1. Go to the **admin menu 'Plugins' -> 'Install'** and **search** for 'Juiz Social Post Sharer'
1. **Click** 'install' and **activate it**
1. (optional) Configure the Plugin in **Settings**

**Manual Installation**

1. **Download** the plugin (it's better :p)
1. **Unzip** `juiz-social-post-sharer` folder to the `/wp-content/plugins/` directory
1. **Activate the plugin** through the 'Plugins' menu in WordPress
1. It's finished !


== Frequently Asked Questions ==

Find a complete documentation on <a href="http://creativejuiz.fr/blog/doc/juiz-social-post-sharer-documentation.html">this official documentation</a>

= Twitter counter doesn't appear OR the count seems to be not exact =
Yep, sorry about that, but <a href="https://twittercommunity.com/t/a-new-design-for-tweet-and-follow-buttons/52791">Twitter decided to shut down counter</a>.

Use the version 1.4.3 or more of this plugin to get an alternative of the native counter. But, keep in mind that alternative is not 100% precise, but better than nothing, I guess.

= The text shared by default is very ugly, something like "Share the post "YOUR POST TITLE" FacebookTwitterGoogle+E-mail [SOME OTHER WORDS]"? =
You certainly activated the buttons in the top of your post. It's your choice, but in this case, you need to improve by yourself the SEO-description of your article/page. You can try using the <a href="https://wordpress.org/plugins/wordpress-seo/">WordPress SEO plugin by Yoast</a>. 

= Can I add a "Like" ou "Google +1" button with this plugin? =
Yes, but not with the page options of this plugin. You need to use a hook to add an item in your buttons list.
See the `juiz_sps_before_first_item` or `juiz_sps_after_last_item` hook in <a href="http://creativejuiz.fr/blog/doc/juiz-social-post-sharer-documentation.html">the documentation</a>. 

= I have a fatal error or a 500 server error since update to 1.2.3 =
Yes, you surely use pinterest button. It's a bug, update to 1.2.4.
Thank you.

= I can't just use shortcode by deactivating all the checkbox display option in admin option page? since 1.2.0 =
Yes, it's a bug, please, use the plugin version 1.2.2. 

= New style is not visible? =
Please update to 1.1.3

= Some options are not visible (if it's not the first installation, but an update of the plugin) =
Deactivate and reactivate the plugin to force the options rebuild.


== Screenshots ==

1. Themes available
2. After a post
3. The new 1.3.0 Black theme and sharings counter
4. The metabox to hide buttons on a post
5. Both new themes: Brands Colors & Material Design

== Other plugins ==

**Try the new plugin <a href="http://wordpress.org/plugins/juiz-user-login-by-email/">User Log-in by email</a>**
Find my plugins at <a href="http://profiles.wordpress.org/creativejuiz/">http://profiles.wordpress.org/creativejuiz/</a>


== Changelog ==

= 1.4.8 =
* Security Update: Fixes XSS vulnerability.

= 1.4.7 =
* Compatibility on network (multisite) thanks to Marie Comet ([Marie Comet](http://mariecomet.fr/))

= 1.4.6 =
* Tested up to WordPress 4.6
* Facebook counter is back thanks to Jean-Baptiste (from [Whodunit](http://www.whodunit.fr/))

= 1.4.5 =
* Fixes a weird bug when you select Pinterest and "Open in new window" option: networks that follow the Pinterest button will open in a new window now! (thanks to <a href="https://wordpress.org/support/topic/some-buttons-doesnt-open-in-separate-window?replies=4#post-8322706">Éric</a>'s report)
* Fixes a bug in Safari (`Chrome undefined` message)

= 1.4.4 =
* Translation
 * Error fixed with an untranslatable english string
* Fixes
 * Google+ and StumbleUpon counters fixed
 * CURLOPT_FOLLOWLOCATION PHP error fixed

= 1.4.3 =
* Compatibility
 * Tested up to WordPress 4.5 (I took advance that time!)
 * Tested up to PHP 7 (Did you try that version? The Fast And Furious version of PHP)
* Features
 * Twitter counter is back from the death thanks to NewShareCounts Services, a third-party that try to bring back your preciouuuus… counter. Golum!

= 1.4.2 =
* Tested in WordPress 4.4.1
* Networks:
 * New Fav button
 * New Print button
* Security:
 * Better translation controls
* Support info:
 * No more support for this plugin version 1.1.0 (0,2% of plugin users)
* Better URL encode (hope so)

= 1.4.1 =
* Tested in WordPress 4.4
* Interface:
 * Better dashicons support for your custom post types
 * Some CSS reworks on admin settings
 * "Metro", "Modern" and "Black" styles are now Retina-ready
 * Button styles CSS updated (each one)
* Engine:
 * Code rewrite to follow WordPress convention
 * Buttons are optionnaly added to excerpt (deactivated by default, see doc)
* Networks :
 * New Delicious button
 * New Tumblr button
 * New Reddit button

= 1.4.0 =
* Tested in WordPress 4.3.1
* Code rewrite to follow WordPress convention
* Explicit Text Domain for better translation (coming with <a href="https://translate.wordpress.org/locale/fr/default/wp-plugins">translate.wordpress.org</a>)
* Bug fix when you select option "Total Only" for counters

= 1.3.9 =
* Tested in WordPress 4.3.0
* Notice PHP fixed in admin area.

= 1.3.8 =
* Better Viadeo support
* Should include a better HTTPS support
 * Thanks to [evelyette](https://wordpress.org/support/topic/contributing-the-code?replies=5#post-6635057) and [Adam](https://wordpress.org/support/topic/some-counters-wont-work-under-https)

= 1.3.7 =
* **Tested up to WordPress 4.1.1**
* New style "Brands Colors" available (7 themes available now)
* New themes and "Black" theme by Fandia support Retina and HDPI screens (font-icons)
* Some little bugs in other styles fixed
* RTL languages compatibility
* Note: Plurk, Appnet and Flattr buttons should coming...

= 1.3.6.1 =
* Russian Translation update (Thank you [Fandia](http://fandia.w.pw "Fandia's website")!) 
* Tested in WordPress 4.0
* New plugin icons
* Style 6 URL update (Fandia's website, sorry :p)

= 1.3.6 =
* Some page admin improvements
* **Fixes**
 * Notice PHP removed (thanks to [Daniel Roch](http://seomix.fr))
 * Some other improvements (thanks to [Julien Maury](http://tweetpressfr.github.io/blog/))

= 1.3.5 =
* Readme.txt updated
* **Translation**
 * New Japanese support, thank you [半月 (Hangetsu)](http://wp.fruit-frappe.net/ "Hangetsu's website")!
 * New Serbian support, thank you [Borisa Djuraskovic](http://www.webhostinghub.com "Borisa Djuraskovic's website")!

= 1.3.4 =
* We lose our nice 1.3.3.7 version number :/
* **Fixes**
 * bug fix on e-mail button when post title use HTML tags (XSS - Thank you [Julio](http://blog.secupress.fr))
 * bug fix on hidden sentence when post title use HTML tags (XSS - Thank you [Julio](http://blog.secupress.fr))
* **New**
 * Spanish translation by [Roberto Castiñeira](www.mediapartner.es "Roberto Castiñeira's website")! Thank you guy!


= 1.3.3.7 =
* WordPress 3.9.x compatibility
* **Bug fixes**
 * remove PHP Warning in some cases in post/page/cpt edit pages
 * remove notice error in translation ([more info](http://wordpress.org/support/topic/notice-error?replies=2#post-5514485 "WordPress forum support"))
 * remove notice in debug mode and with Pinterest option activated ([more info](http://wordpress.org/support/topic/minor-undefined-index-juiz_sps_force_pinterest_snif?replies=2#post-5127804 "WordPress forum support"))
* **Improvements**
 * Add "title" parameter for Weibo API (thank you Aili!)
 * HTML tag for "total count" is customizable (it was an LI element)
 * New hook `juiz_sps_share_name_for_[network]` to adjust networks name-text ([more info](http://wordpress.org/support/topic/button-text-and-image?replies=2#post-5510471))
 * New hook `juiz_sps_use_default_css` to remove default CSS request (you can use your own CSS)
 * New in Shortcode : use the `url` parameter to share "permalink", "siteurl" or "customurl" instead of current URL
 * New in Template function : use the $url_to_share parameter to share "permalink", "siteurl" or "customurl" instead of current URL
* **New**
 * Counters option: display sub-totals only, total only or both
 * Deutsch translation by [Dennis Schmitz](http://compcardinmotion.de "Dennis Schmitz's website")

= 1.3.3 = 
* Bug fix for Tony's style buttons (lake of rules for VK social network)
* Bug fix for Facebook counters (little JS error)
* Readme updated

= 1.3.2 =
* Bug fix when your theme has wp_autop activated on your content (thank you [Jérémy](http://www.out-the-box.fr)).

= 1.3.1 =
* Typo fix on CSS files (Metro styles only)
* Bug fix on Pinterest button when target option is activated (find on Firefox by [synthview](http://wordpress.org/support/topic/pinterest-on-124-dont-work-as-axpected?replies=16#post-4874699))

= 1.3.0 =
* New feature: choose directly in the edit page of a post if you want to hide buttons (just a box to check)
* New feature: optional counter available (needs JavaScript) - CSS improved for that - Note it's in beta test
* New feature: optional "force Pinterest sniffing for image" feature (needs JavaScript)
* New: russian network VKontakte
* New: black style by [Fandia](http://fandia.w.pw "Fandia's website")!
* Translation: new Turkish language (thanks to [Hakaner](http://hakanertr.wordpress.com/ "His website")!)
* Translation: new Russian language (thanks to [Fandia](http://fandia.w.pw "Fandia's website")!)
* New hook: `juiz_sps_intro_phrase_text` to help you change (see [the documentation](http://creativejuiz.fr/blog/doc/juiz-social-post-sharer-documentation.html "Official Documentation"))
* New hook: `juiz_sps_hide_intro_phrase` (see [the documentation](http://creativejuiz.fr/blog/doc/juiz-social-post-sharer-documentation.html "Official Documentation"))
* New hook: `juiz_sps_share_text_for_[network]` (see [the documentation](http://creativejuiz.fr/blog/doc/juiz-social-post-sharer-documentation.html "Official Documentation"))

= 1.2.4 =
* IMPORTANT: bug fix for Pinterest button's users (thanks to <a href="http://wordpress.org/support/topic/getting-500-internal-error-on-some-pages?replies=6#post-4204030">jamesdodd</a>)
* IMPORTANT: hook juiz_sps_the_permalink replaced by juiz_sps_the_shared_permalink
* New hook: `juiz_sps_the_shared_permalink_for_[network]` (see [the documentation](http://creativejuiz.fr/blog/doc/juiz-social-post-sharer-documentation.html "Official Documentation"))

= 1.2.3 =
* Removes new Facebook API because of the complexity of use for the user (old API always works)

= 1.2.2 =
* New: Facebook and Pinterest new API integrated
* New hook to remove `rel="nofollow"` on links
* New hook to customize container element (div by default)
* New hook to remove intro sentence, or its container tag
* New: to perform customization, you can use %%title%% (insert the post title), %%siteurl%% (insert the site URL) or %%permalink%% (insert the post URL) variables
* Bug fix: you can now use shortcode or template function only by choosing option "I'm a ninja, I want to use the shortcode only!"
* Translation updates (French, English)

= 1.2.1 =
* [juiz_sps] shortcode added (you now have [juiz_social] and [juiz_sps])
* CSS improvement for themes not really well thought ;)

= 1.2.0 =
* New social networks available : weibo
* CSS improvement
* Documentation available! (see the bottom of settings page)
* New hooks and template functions available (see [the documentation](http://creativejuiz.fr/blog/doc/juiz-social-post-sharer-documentation.html "Official Documentation"))

= 1.1.4 =
* New choice: displaying button on all lists of articles (blog, archive, tag, search result, etc.)
* Admin page improvement
* New dynamic classes on HTML generated code
* Partial [documentation](http://creativejuiz.fr/blog/doc/juiz-social-post-sharer-documentation.html "Official Documentation") available with plugin (see the footer links)

= 1.1.3 =
* Bug fix on new style

= 1.1.2 =
* New hook for developper (can now hook shared url)
* Styles : New optionnal style for buttons (thanks to <a href="http://tonytrancard.fr">Tony</a>)
* Styles : bug correction for Chrome
* Styles : little margin added before and after line of buttons

= 1.1.1 =
* Styles bug correction

= 1.1.0 =
* Add your Twitter account name to add "via" during a share
* Choose to display button only on certain type of post
* Choose to display button at the bottom, the top of the content, or both
* Some hooks are available for markup customization (or add some things)
* Customize mail texts (subject and body)

= 1.0.1 =
* Performance enhancement (thank you <a href="http://profiles.wordpress.org/juliobox/">Julio</a>)
* Some typos corrected

= 1.0.0 =
* The first beta version


== Upgrade Notice ==

= 1.3.0 =
Major update, new features and some optimization. You need it!

= 1.2.2 =
Several bug fixes, you can update ;)

= 1.1.0 =
Some new things, update it :)

= 1.0.0 =
Try it ;)
