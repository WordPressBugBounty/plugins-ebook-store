<?php
/*
Plugin Name: eBook store
Plugin URI: https://www.shopfiles.com/index.php/products/wordpress-ebook-store
Description: eBook Store is a unique and powerful standalone tool for selling ebooks with WordPress (also WooCommerce support is available), allowing you to display beautiful buy now forms for your ebook(s) and giving you the ability to offer encrypted, watermarked and QR code stamped ebooks to your buyers, a proven way to prevent piracy. With the built-in MailChimp integration you can directly subscribe your clients to a mailing list. It supports PDF, ePub, TXT, Mobi and Zip files. Now comes with WP Affiliates Manager integration so you can pay commissions to affiliates for promoting your ebook.
Author: Shopfiles Ltd
Text Domain: ebook-store
Domain Path: /languages
Author URI:https://www.shopfiles.com/index.php/products/wordpress-ebook-store
Version: 5.8001
License: GPLv2
*/

function ebookstoretextdomain( $locale = null ) {
	global $l10n;

	$domain = 'ebook-store';

	if ( get_locale() == $locale ) {
		$locale = null;	
	}

	if ( empty( $locale ) ) {
		if ( is_textdomain_loaded( $domain ) ) {
			return true;
		} else {
			return load_plugin_textdomain( $domain, false, $domain . '/languages' );
		}
	} else {
		$mo_orig = $l10n[$domain];
		unload_textdomain( $domain );

		$mofile = $domain . '-' . $locale . '.mo';
		$path = WP_PLUGIN_DIR . '/' . $domain . '/languages';

		if ( $loaded = load_textdomain( $domain, $path . '/'. $mofile ) ) {
			return $loaded;
		} else {
			$mofile = WP_LANG_DIR . '/plugins/' . $mofile;
			return load_textdomain( $domain, $mofile );
		}

		$l10n[$domain] = $mo_orig;
	}

	return false;
}

add_action( 'plugins_loaded', 'ebookstoretextdomain' );

if (defined('WP_DEBUG')) {
	if (WP_DEBUG == true) {
		error_reporting(E_ALL);
		ini_set('dispaly_errors',true);
	} else {
		error_reporting(0);
	}
} else {
		error_reporting(0);
}

if (@$_REQUEST['do'] != 'subscribe_guestlist') {
	include_once(plugin_dir_path( __FILE__ ) . '/functions.php');
	include_once(plugin_dir_path( __FILE__ ) . '/class_qswpoptions.php');
	include_once(plugin_dir_path( __FILE__ ) . '/ebook_options.php');
}

add_action('init', 'ebook_store_formContent');
add_action('init', 'ebook_store_check_ipn');
add_action('init', 'ebook_store_redirect_add_order');


function ebook_store_check_ipn() {
	$QSWPOptions = new QSWPOptions();
	if (@$_REQUEST['task'] == 'ipn') {
		//wp_mail('deian@motov.net','Debug IPN',print_r($_REQUEST,true));
		$ebook_key = preg_replace("/[^a-zA-Z0-9]+/", "", $_REQUEST['ebook_key']);
		//if order with such ebook key / order key exists, drop order.
		if (ebook_get_order('ebook_key', $ebook_key)) {
			return false;
		}

		global $ebook_email_delivery;
		include_once 'payment_gateways/paypal/ipnlistener.php';
		$listener = new IpnListener();
		if (get_option('paypal_sandbox') > 0) {
			$listener->use_sandbox = true;
		}
		try {
			$listener->requirePostMethod();
			$verified = $listener->processIpn();
		} catch (Exception $e) {
			error_log($e->getMessage());
			die($e->getMessage());
			exit(0);
		}

		if ($verified) {
			ebook_store_get_mailchimp_subscribe($_REQUEST['payer_email']);
			if ($_REQUEST['payment_type'] == 'echeck' && get_option('ebook_store_allow_echeck') == 0) {
				return false; //stop the process if echecks are not accepted.
			}
			$my_post = array(
			  'post_title'    => $_REQUEST['first_name'] . ' ' . $_REQUEST['last_name'],
			  'post_type'	  => 'ebook_order',
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_category' => array(8,39));
			$custom = explode("|",$_REQUEST['custom']);
			$mc_gross = number_format($_REQUEST['mc_gross'], 2, '.', ',');
			$vat = esc_attr(get_option('vat_percent')); 
			if ($vat > 0) {
				$mc_gross = $_REQUEST['mc_gross'] - $_REQUEST['tax'];
			}
			$mc_gross = number_format($mc_gross, 2, '.', ',');
			$ebook = get_post_meta($custom[0], 'ebook', true);
			$md5 = md5(NONCE_KEY . $custom[0] . $mc_gross);
			//error_log("$md5 $custom[1] " . NONCE_KEY . $custom[0] . $mc_gross);
			//if ($md5 == $custom[1] || $ebook['donate_or_download'] == 'donate') {
			if (1) {	
				$post_id = @wp_insert_post( $my_post, $wp_error );
				
				$_REQUEST['user_id'] = ebook_store_silent_registration($_REQUEST);

				foreach ($_REQUEST as $k => $v) {
					update_post_meta($post_id, $k, $v);
					@$order[$k] = $v;
				}
				if ($vat > 0) {
					$order['mc_gross'] = $order['mc_gross'] - $order['tax'];
				}
				$order['order_id'] = $post_id;
				if (get_option('ebook_store_wp_affiliate_integration') == 1) {
					do_action('ebook_store_payment_completed',$_POST, $order['order_id']);
				}
				$order['password'] = $_REQUEST['payer_email'];
				global $formData, $ebook_store_random_password;
				$formData = ebook_store_get_form($_REQUEST['md5_nonce']);
				$formData = json_encode($formData);
				$ebook_order['ebook_key'][0] = $ebook_key;
				$ebook_order['ebook'][0] = $custom[0];
				$order['downloadlink'] = ebook_download_link($ebook_order);
				$order['ebook'][0] = $custom[0];
				
				$order['ebook_key_array'][0] = $ebook_key;
				$order['ebook_key'][0] = $ebook_key;
				$order['md5_nonce'][0] = $_REQUEST['md5_nonce'];

				update_post_meta($post_id,'ebook_key',$ebook_key);
				update_post_meta($post_id,'downloads',0);
				update_post_meta($post_id,'mc_gross',$mc_gross);
				update_post_meta($post_id,'formData',wp_slash($formData));
				update_post_meta($post_id,'downloadlink',$order['downloadlink']);
				update_post_meta($post_id,'ebook',$custom[0]);

				if (get_option('ebook_store_random_password') == 1) {
					$ebook_store_random_password = substr(md5(microtime()),0,8);
					$order['password'] = $ebook_store_random_password;
					update_post_meta($post_id,'password',$ebook_store_random_password);
				} else {
					update_post_meta($post_id,'password',$_REQUEST['payer_email']);
				}

				global $attachment;
				$attachment = ebook_attachment($custom[0],true); //important!!!
				//$order['downloadlink_html'] = '<a href="'.ebook_download_link($ebook_order).'" target="_blank" rel="noopener">'.$_REQUEST['item_name'].'</a> ('.ebook_store_human_filesize(filesize($attachment[0]['file'])).')';

				$ebookObj = new EbookStoreEbook(@$ebook_order['ebook'][0]);
				$ebookObj->setLink['pdf'] = $order['downloadlink'];

				$order['downloadlink_html'] = $ebookObj->format_links();
				$order['ebook_bonus'] = (implode("<br />",ebook_download_links_bonus($order)) != '' ? implode("<br />",ebook_download_links_bonus($order)) : __('None','ebook-store'));

				$ebook_email_delivery = array('to' => $_REQUEST['payer_email'], 'subject' => get_option('email_delivery_subject'), 'text' => get_option('email_delivery_text',$QSWPOptions->email_delivery_text),'attachment' => $attachment, 'order' => $order);
				//mail('deian@motov.net', 'eBook store for WordPress - Verified Order Received', print_r($ebook_email_delivery,true));
				//wp_mail($_REQUEST['payer_email'],get_option('email_delivery_subject'),'Email delivery text');
				$fileExt = pathinfo($attachment[0]['file'],PATHINFO_EXTENSION);
				if ($fileExt == 'pdf' && get_option('encrypt_pdf')) { //$fileExt == 'pdf' && get_option('encrypt_pdf')
					add_action( 'init', 'ebook_encrypt_pdf', 99 );
					// error_log('ecnrypt pdf added to init');
				}
				
				add_action( 'init', 'ebook_email_delivery', 100);
				//error_log('ebook_email_delivery added to plugins_loaded');
				//array('to' => $_REQUEST['payer_email'], 'subject' => get_option('email_delivery_subject'), 'text' => 'teeext', 'file' => $attachment[0]['file'])
			} else {
				mail(get_option( 'admin_email' ), 'eBook store for WordPress - Possible fraud attempt ', $listener->getTextReport());
			}
		header("HTTP/1.1 200 OK");
		//die('OK');
		} else {
			mail(get_option( 'admin_email' ), 'eBook store for WordPress - Possible fraud attempt', $listener->getTextReport() . "\n\n\n" . md5(NONCE_KEY . $custom[0] . $mc_gross) == $custom[1]);
		}
	}
}

add_action( 'wp_loaded', 'ebook_store_add_to_cart');
add_action( 'init', 'ebook_create_post_type', 99);
register_activation_hook( __FILE__, 'ebook_store_activate' );

//register_deactivation_hook( __FILE__, 'ebook_store_activate' );

add_action( 'init', 'ebook_process_download', 100 );

add_action( 'init', 'ebook_process_download_woocomerce', 101 );

add_action( 'init', 'ebook_store_export_orders', 101 );

add_action( 'init', 'ebook_store_wp_super_cache_check',102);


if (isset($_GET['post_type'])) {
	if ($_GET['post_type'] != 'shop_coupon') {
		add_action("manage_posts_custom_column", "order_custom_columns");
	}	
}

add_action('add_meta_boxes', 'ebook_add_custom_meta_boxes');  
add_action('post_edit_form_tag', 'ebook_update_edit_form'); 

if('ebook' == @$_POST['post_type']) {
	add_action('save_post', 'save_custom_meta_data'); 
}
add_action('save_post', 'save_custom_meta_data_order');

//add_action('init','ebook_store_post_type_view');

add_filter( 'the_content', 'ebook_store_post_type_view' );
add_filter( 'enter_title_here', 'custom_enter_title_author' );
add_filter( 'enter_title_here', 'custom_enter_title_publisher' );
add_filter("manage_edit-ebook_order_columns", "order_columns");
add_shortcode( 'ebook_store', 'ebook_store' );
add_shortcode( 'ebook_store_buy', 'ebook_store_buy' );

add_shortcode( 'ebook_thank_you', 'ebook_store' );
if (defined('PHP_VERSlON') == false) define('PHP_VERSlON',1);

add_action('init','ebookstorestylesheet');

if (get_option('ebook_store_checkout_page') == 0) {
	add_action( 'admin_notices', 'ebook_store_admin_notice' );	
} else {
	//wp_die(var_dump(get_option('ebook_store_checkout_page')));
}
if (!function_exists('imagecreatefrompng')) {
	add_action( 'admin_notices', 'ebook_store_missing_gd' );	
}
if (get_option('paypal_account') == '') {
	add_action( 'admin_notices', 'ebook_store_admin_notice_paypal' );	
}

add_action('init','ebook_store_offer_tutorial');



add_filter('post_updated_messages', 'ebook_store_set_messages' );
add_action( 'admin_head-post-new.php', 'ebook_admin_css' );
add_action( 'admin_head-post.php', 'ebook_admin_css' );
add_filter( 'manage_edit-ebook_columns', 'ebook_store_set_columns' ) ;
add_action( 'manage_ebook_posts_custom_column', 'ebook_store_columns_output', 10, 2 );
add_filter('upload_mimes', 'ebook_mime_types');
add_action('admin_menu', 'ebook_store_register_my_custom_submenu_page');


add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'ebook_store_action_links' );


foreach (glob(ABSPATH . "/ebook_store_modules/*.php") as $filename)
{
    include $filename;
}


add_filter("ebook_store_payment_gateway_parameters", "ebook_store_payment_gateway_parameters_wpam");
add_action("ebook_store_payment_completed", "ebook_store_payment_completed_wpam", 10, 2);

function ebook_store_endsWith( $str, $sub ) {
   return ( substr( $str, strlen( $str ) - strlen( $sub ) ) === $sub );
}
add_action( 'init', 'ebook_store_my_taxonomies_product', 0 );
add_action('init','ebook_store_redirect_add_new', 1);

function ebook_store_redirect_add_new() {
	if ($_SERVER['REQUEST_URI'] == '/wp-admin/post-new.php?post_type=ebook_order') {
		wp_die('<script>window.location = "edit.php?post_type=ebook&page=ebook-store-add-order-page"; </script>');
	}
}
//
add_action( 'woocommerce_process_product_meta_ebookstore', 'save_woocommerce_ebook_store_data'  );
add_action( 'woocommerce_process_product_meta', 'save_woocommerce_ebook_store_data'  );

//add_action( 'woocommerce_process_product_meta_variable_rental', 'save_woocommerce_ebook_store_data'  );
add_action( 'woocommerce_order_details_after_order_table', 'ebook_store_woocommerce_order_details', 10, 1 );

//add_filter( 'woocommerce_payment_complete_order_status', 'ebook_store_woocommerce_email_delivery', 10, 2 );
add_filter( 'woocommerce_order_status_completed', 'ebook_store_woocommerce_email_delivery_completed', 10, 2 );
add_filter( 'woocommerce_order_status_pending', 'ebook_store_woocommerce_email_delivery_pending', 10, 2 );
add_filter( 'woocommerce_order_status_processing', 'ebook_store_woocommerce_email_delivery_processing', 10, 2 );
add_filter( 'woocommerce_order_status_on-hold', 'ebook_store_woocommerce_email_delivery_on_hold', 10, 2 );
add_filter( 'woocommerce_order_status_cancelled', 'ebook_store_woocommerce_email_delivery_cancelled', 10, 2 );



add_filter( 'query_vars', 'ebook_store_add_query_vars_filter' );
add_action( 'woocommerce_product_data_panels', 'ebook_store_woocommerce_tab_content' );


//add_filter( 'upload_dir', 'ebook_set_upload_dir' );

// Before VC Init
add_action( 'vc_before_init', 'ebook_store_vc_before_init_actions' );
 
// add_action('init', 'ebook_store_session_start', 1);
// add_action('wp_logout', 'ebook_store_session_end');
// add_action('wp_login', 'ebook_store_session_end');
add_action('ebook_store_file_formats_form','ebook_store_file_formats_form');
add_action( 'init', 'register_ebook_store_woocommerce_type' );

// add_filter( 'woocommerce_data_stores', 'woocommerce_data_stores_ebook_store' );
add_filter( 'woocommerce_product_data_tabs', 'woocommerce_custom_product_tabs_for_ebook_store' );

add_action( 'admin_footer', 'woocommerce_ebook_store_price_field' );


add_action( 'wp_enqueue_scripts', 'ebook_store_custom_color_picker_scripts');

function ebook_store_custom_color_picker_scripts(){
	if (wp_script_is( 'iris', 'enqueued' )) {
		return; // if it's already enqueued, don't enqueue it again.
	
	} else { // since it's NOT enqueued, let's enqueue it
	
	// wp_enqueue_script(
	// 	'iris', //iris.js handle
	// 	admin_url( 'js/iris.min.js' ), //path to wordpress iris file
	// 	array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), //these must load BEFORE iris (i.e. "dependencies)
	// 	false, // don't load it in the footer
	// 	1 // priority
	// 	);
	}
}




add_shortcode( 'ebook_store_row', 'ebook_store_row' );

add_shortcode( 'ebook_store_downloads', 'ebook_store_downloads' );

add_shortcode( 'ebook_store_wpforms', 'ebook_store_wpforms');



//add zip file support for media uploads
function ebook_store_zip_upload_mimes($existing_mimes = array()) {
    $existing_mimes['zip'] = 'application/zip';
    $existing_mimes['gz'] = 'application/x-gzip';
    return $existing_mimes;
}
add_filter('upload_mimes', 'ebook_store_zip_upload_mimes', 999, 1);








