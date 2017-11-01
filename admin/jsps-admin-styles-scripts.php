<?php if ( ! defined( 'ABSPATH' ) ) exit;
	echo '
		<!-- ' . JUIZ_SPS_PLUGIN_NAME . ' styles -->
		<style rel="stylesheet">
			#juiz-sps .error { margin: 20px 20px 20px 48px; }
			#juiz-sps .submit { margin-bottom: 3em }
			#juiz-sps th .submit { font-weight:normal; margin-bottom: 0 }
			#juiz-sps .error em { font-weight: normal; }
			#juiz-sps .jsps_info { max-width:800px; padding: 15px; margin-left: 48px; color: #444; line-height: 1.6;  background: #FFF; box-shadow: 1px 1px 3px rgba(0,0,0,.15);}
			#juiz-sps h3 { font-size: 1.65em; color: #444; font-weight:normal; }
			#juiz-sps table + h3 { margin-top: 3em;}
			.juiz_sps_section_intro {font-style: italic; color: #777; }
			#juiz-sps form {padding-left:45px}
			#juiz-sps th {font-weight:bold; padding-left:0}
			#juiz-sps th em {font-weight:normal;font-style: italic; color: #777;}

			.jsps_demo_icon { display: inline-block; width: 16px; height: 16px; margin-right: 5px; vertical-align: middle; background: url('.JUIZ_SPS_PLUGIN_URL.'img/sps_sprites.png) no-repeat 0 -16px;}
			.jsps_demo_icon_google 		{ background-position: -16px -16px }
			.jsps_demo_icon_facebook 	{ background-position: -32px -16px }
			.jsps_demo_icon_mail	 	{ background-position: -48px -16px }
			.jsps_demo_icon_pinterest 	{ background-position: -64px -16px }
			.jsps_demo_icon_viadeo	 	{ background-position: -80px -16px }
			.jsps_demo_icon_linkedin 	{ background-position: -96px -16px }
			.jsps_demo_icon_digg	 	{ background-position: -112px -16px }
			.jsps_demo_icon_stumbleupon	{ background-position: -128px -16px }
			.jsps_demo_icon_weibo		{ background-position: -144px -16px }
			.jsps_demo_icon_vk			{ background-position: -160px -16px }
			.jsps_demo_icon_reddit		{ background-position: -176px -16px }
			.jsps_demo_icon_delicious	{ background-position: -192px -15px }
			.jsps_demo_icon_tumblr		{ background-position: -208px -17px }
			.jsps_demo_icon_bookmark	{ background-position: -224px -16px }
			.jsps_demo_icon_print		{ background-position: -240px -16px }
			
			input[type="checkbox"]:checked + label { font-weight: bold; color: #333; }
			:checked + label .jsps_demo_icon_twitter 	{ background-position: 0 0 }
			:checked + label .jsps_demo_icon_google 	{ background-position: -16px 0 }
			:checked + label .jsps_demo_icon_facebook 	{ background-position: -32px 0 }
			:checked + label .jsps_demo_icon_mail	 	{ background-position: -48px 0 }
			:checked + label .jsps_demo_icon_pinterest 	{ background-position: -64px 0 }
			:checked + label .jsps_demo_icon_viadeo	 	{ background-position: -80px 0 }
			:checked + label .jsps_demo_icon_linkedin 	{ background-position: -96px 0 }
			:checked + label .jsps_demo_icon_digg	 	{ background-position: -112px 0 }
			:checked + label .jsps_demo_icon_stumbleupon{ background-position: -128px 0 }
			:checked + label .jsps_demo_icon_weibo		{ background-position: -144px 0 }
			:checked + label .jsps_demo_icon_vk			{ background-position: -160px 0 }
			:checked + label .jsps_demo_icon_reddit		{ background-position: -176px 0 }
			:checked + label .jsps_demo_icon_delicious	{ background-position: -192px 0 }
			:checked + label .jsps_demo_icon_tumblr		{ background-position: -208px -1px }
			:checked + label .jsps_demo_icon_bookmark	{ background-position: -224px 0 }
			:checked + label .jsps_demo_icon_print		{ background-position: -240px 0 }

			#juiz-sps input[type="radio"] + label { display: inline-block; vertical-align: middle; margin-right: 20px;}
			.juiz_sps_options_p { margin: .2em 5% .2em 0; }
			
			.juiz_sps_styles_options + .juiz_sps_styles_options { margin-top: 1em;}
			.juiz_sps_styles_options label { vertical-align:top;}
			.juiz_sps_styles_options input { vertical-align:8px;}
			.juiz_sps_demo_styles { display:inline-block; vertical-align:middle; width:592px; height:26px; background:url(' . JUIZ_SPS_PLUGIN_URL . 'img/demo-sprites.png) no-repeat 0 -26px}
			[for="jsps_style_2"] .juiz_sps_demo_styles { background-position: 0 0 }
			[for="jsps_style_3"] .juiz_sps_demo_styles { height: 36px; background-position: 0 -93px }
			[for="jsps_style_4"] .juiz_sps_demo_styles { height: 36px; background-position: 0 -129px }
			[for="jsps_style_5"] .juiz_sps_demo_styles { height: 39px; background-position: 0 -165px }
			[for="jsps_style_6"] .juiz_sps_demo_styles { height: 36px; background-position: 0 -204px }
			[for="jsps_style_7"] .juiz_sps_demo_styles { height: 39px; background-position: 0 -242px }
			[for="jsps_style_8"] .juiz_sps_demo_styles { height: 58px; background-position: 0 -282px }
			.juiz_sps_style_name { display:inline-block; margin: 4px 0 0 2px; color: #777;}
			.juiz_sps_demo_hide {display:block; width:592px; height:37px; background:url('.JUIZ_SPS_PLUGIN_URL.'img/demo-sprites.png) no-repeat 0 -52px}

			.jsps_no_icon, .jsps_icon { display:inline-block; vertical-align:-3px; }
			.jsps_no_icon {width:16px;height:16px;background:url(' . admin_url( 'images/menu.png' ) . ') -276px -8px no-repeat; }

			.juiz_bottom_links {margin-bottom:0;border-top: 1px solid #ddd; background: #f2f2f2; padding: 10px 45px; }
			.juiz_paypal, .juiz_twitter, .juiz_rate {display: inline-block; margin-right: 10px; padding: 3px 12px; text-decoration: none; border-radius: 3px;
				background-color: #e48e07; background-image: -webkit-linear-gradient(#e7a439, #e48e07); background-image: linear-gradient(to bottom, #e7a439, #e48e07); border-width:1px; border-style:solid; border-color: #e7a439 #e7a439 #ba7604; box-shadow: 0 1px 0 rgba(230, 192, 120, 0.5) inset; color: #FFFFFF; text-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);}
			.juiz_twitter {background-color: #1094bf; background-image: -webkit-linear-gradient(#2aadd8, #1094bf); background-image: linear-gradient(to bottom, #2aadd8, #1094bf); border-color: #10a1d1 #10a1d1 #0e80a5; box-shadow: 0 1px 0 rgba(120, 203, 230, 0.5) inset;}
			.juiz_rate {background-color: #999; background-image: -webkit-linear-gradient(#888, #666); background-image: linear-gradient(to bottom, #888, #666); border-color: #777 #777 #444; box-shadow: 0 1px 0 rgba(180, 180, 180, 0.5) inset;}
			.juiz_paypal:hover { color: #fff; background: #e48e07;}
			.juiz_twitter:hover { color: #fff; background: #1094bf;}
			.juiz_rate:hover { color: #fff; background: #666;}

			.juiz_disabled th {color: #999;}

			.juiz_bottom_links em {display:block; margin-bottom: .5em; font-style:italic; color:#777;}
			#juiz_sps_mail_body {width: 100%; max-width: 400px;}
			.juiz_hide {display:none;}

			.juiz-twitter-alternative {
				display: block;
				max-width: 100%;
				width: 600px;
				margin: 0.5em 0;
				padding: 10px 15px;
				background: #1094BF;
				color: #FFF;
			}
			.juiz-twitter-alternative a {
				color: #FFF;
				font-weight: bold;
			}

			@media (max-width:640px) {
				#juiz-sps .jsps_info { margin-left: 0; }
				.juiz_bottom_links { padding: 15px; }
				#juiz-sps form { padding-left:0;}
				.juiz_bottom_links a { margin-bottom: 5px;}
				.juiz_sps_demo_styles {width: 110px;}
				#juiz-sps .juiz_sps_styles_options input[type="radio"] + label {margin-right:0}
				.juiz_sps_style_name a {display:block;}
				#jsps_style_5 {vertical-align: 21px;}
				.juiz_sps_demo_hide {width: 92px;}
			}
			@media (min-width: 1380px) {
				.juiz_bottom_links {
					position: fixed;
					top: 50px; right: 15px;
					padding: 10px 15px;
					width: 175px;
					border: 0;
					background: #FFF;
					box-shadow: 1px 1px 3px rgba(0,0,0,.15);
				}
				.juiz_bottom_links a {
					-webkit-box-sizing: border-box;
					box-sizing: border-box;
					width: 100%;
					margin: .2em 0;
				}
			}
			</style>
		<!-- end of ' . JUIZ_SPS_PLUGIN_NAME . ' styles -->

		<!-- ' . JUIZ_SPS_PLUGIN_NAME . ' scripts -->
		<script>
			jQuery(document).ready(function($){
				$("input[disabled]").closest("tr").addClass("juiz_disabled");
				$("#jsps_counter_both").closest("tr").addClass("juiz_hide juiz_counter_option");

				$(\'input[name="juiz_SPS_settings[juiz_sps_counter]"]\').on("change", juiz_on_change_visibility);

				function juiz_on_change_visibility() {
					if( $("#jsps_counter_y").filter(":checked").length == 1) {
						$(".juiz_counter_option").fadeIn(300);
					}
					else {
						$(".juiz_counter_option").fadeOut(300);
					}
				}
				juiz_on_change_visibility();
			});
		</script>
		<!-- end of ' . JUIZ_SPS_PLUGIN_NAME . ' scripts -->
	';
