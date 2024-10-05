<?php

// error_reporting(E_ALL);

include_once('EbookStoreEbook.class.php');
include_once('EbookStore.Elementor.php');

////

function ebook_activate() {
	// register taxonomies/post types here
	flush_rewrite_rules();
}

function ebook_deactivate() {
	flush_rewrite_rules();
}

function ebook_store_activate() {
	ebook_create_post_type();
	flush_rewrite_rules();
}

function ebook_create_post_type() {
	$labels = array(
			'name' => _x('Ebook Store', 'post type general name', 'ebook-store'),
			'singular_name' => _x('Ebook', 'post type singular name', 'ebook-store'),
			'add_new' => _x('Add New Ebook', 'ebook', 'ebook-store'),
			'add_new_item' => __('Add New Ebook Item', 'ebook-store'),
			'edit_item' => __('Edit Item', 'ebook-store'),
			'all_items'          => __('Ebooks', 'ebook-store'),
			'new_item' => __('New Ebook Item', 'ebook-store'),
			'view_item' => __('View Ebook Item', 'ebook-store'),
			'search_items' => __('Search Ebook', 'ebook-store'),
			'not_found' =>  __('Nothing found', 'ebook-store'),
			'not_found_in_trash' => __('Nothing found in Trash', 'ebook-store'),
			'parent_item_colon' => ''
	);

	$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'query_var' => true,
			'rewrite' => array('slug','ebook'),
			'capability_type' => 'page',
			'hierarchical' => true,
			//'menu_position' => 5,
			'has_archive' => true,
			//'taxonomies' => array('category'),
			'supports' => array('title','editor'),
	        'menu_icon'           => 'dashicons-cart',
	);

	register_post_type( 'ebook' , $args );

	$labels = array(
			'name'               => __('Authors', 'ebook-store'),
			'singular_name'      => __('Author', 'ebook-store'),
			'add_new'            => __('Add New', 'ebook-store'),
			'add_new_item'       => __('Add New Author', 'ebook-store'),
			'edit_item'          => __('Edit Author', 'ebook-store'),
			'new_item'           => __('New Author', 'ebook-store'),
			'all_items'          => __('Authors', 'ebook-store'),
			'view_item'          => __('View Author', 'ebook-store'),
			'search_items'       => __('Search Author', 'ebook-store'),
			'not_found'          => __('No authors found', 'ebook-store'),
			'not_found_in_trash' => __('No authors found in Trash', 'ebook-store'),
			'parent_item_colon'  => '',
			'menu_name'          => __('Authors', 'ebook-store'),

	);

	$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'edit.php?post_type=ebook',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'ebook_author' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			//'menu_position'      => 5,
			'supports'           => array( 'title', 'thumbnail','comments' )
	);

	register_post_type( 'ebook_author', $args );
	/////
	$labels = array(
			'name'               => __('Publishers', 'ebook-store'),
			'singular_name'      => __('Publisher', 'ebook-store'),
			'add_new'            => __('Add New', 'ebook-store'),
			'add_new_item'       => __('Add New Publisher', 'ebook-store'),
			'edit_item'          => __('Edit Publisher', 'ebook-store'),
			'new_item'           => __('New Publisher', 'ebook-store'),
			'all_items'          => __('Publishers', 'ebook-store'),
			'view_item'          => __('View Publisher', 'ebook-store'),
			'search_items'       => __('Search Publisher', 'ebook-store'),
			'not_found'          => __('No Publishers found', 'ebook-store'),
			'not_found_in_trash' => __('No Publishers found in Trash', 'ebook-store'),
			'parent_item_colon'  => '',
			'menu_name'          => __('Publishers', 'ebook-store'));

	$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'edit.php?post_type=ebook',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'publisher' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			//'menu_position'      => 5,
			'supports'           => array( 'title', 'thumbnail','comments' )
	);

	register_post_type( 'ebook_publisher', $args );
	///////
	$labels = array(
			'name'               => __('Orders', 'ebook-store'),
			'singular_name'      => __('Order', 'ebook-store'),
			'add_new'            => __('Add New', 'ebook-store'),
			//'add_new_item'       => 'Add New Order',
			'edit_item'          => __('Edit Order', 'ebook-store'),
			'new_item'           =>__( 'New Order', 'ebook-store'),
			'all_items'          => __('Orders', 'ebook-store'),
			'view_item'          => __('View Order Details', 'ebook-store'),
			'search_items'       => __('Search Order', 'ebook-store'),
			'not_found'          => __('No orders found', 'ebook-store'),
			'not_found_in_trash' => __('No orders found in Trash', 'ebook-store'),
			'parent_item_colon'  => '',
			'menu_name'          => __('Orders', 'ebook-store'),
			);

	$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => 'edit.php?post_type=ebook',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'order' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			//'menu_position'      => 5,
			'supports'           => array('title','excerpt'),
			// 'capabilities' => array(
			//   'order'          => true, 
			//   'read_ebook_order'          => true, 
			//   'delete_ebook_order'        => true, 
			//   // 'delete_posts'        => true, 
			//   // 'edit_posts'         => true, 
			//   // 'edit_others_posts'  => true, 
			//   // 'publish_posts'      => true,       
			//   // 'read_private_posts' => false,
			//   // 'create_posts'       => false,
			// ),
	);

	register_post_type( 'ebook_order', $args );
	//wp_die(print_r($GLOBALS['wp_post_types'],true));
}

function ebook_add_custom_meta_boxes() {

	// Define the custom attachment for posts
	add_meta_box(
	'ebook_wp_custom_attachment',
	__('Ebook Details', 'ebook-store'),
	'ebook_wp_custom_attachment',
	'ebook',
	'advanced'
			);
	add_meta_box(
	'ebook_wp_embed_ebook',
	__('Ebook Store - Click on Ebook to embed it', 'ebook-store'),
	'ebook_wp_embed_ebook',
	'post',
	'advanced'
	);
	add_meta_box(
	'ebook_wp_embed_ebook',
	__('Ebook Store - Click Ebook to Embed', 'ebook-store'),
	'ebook_wp_embed_ebook',
	'page',
	'advanced'
	);
			// Define the custom attachment for posts
			// add_meta_box(
			// 'ebook_code_box',
			// 'Ebook Embed Code Box',
			// 'ebook_code_box',
			// 'ebook',
			// 'side'
			// );
					add_meta_box(
					'ebook_order_box',
					'Order details',
					'ebook_order_box',
					'ebook_order',
					'advanced'
							);
}

function ebook_order_box() {
	$fields = array('mc_gross', 'protection_eligibility', 'payer_id', 'tax', 'payment_date', 'payment_status', 'charset', 'first_name', 'mc_fee', 'notify_version', 'custom', 'payer_status', 'business', 'quantity', 'verify_sign', 'payer_email', 'txn_id', 'payment_type', 'last_name', 'receiver_email', 'payment_fee', 'receiver_id', 'txn_type', 'item_name', 'mc_currency', 'item_number', 'residence_country', 'test_ipn', 'handling_amount', 'transaction_subject', 'payment_gross', 'shipping', 'ipn_track_id');
	wp_nonce_field(plugin_basename(__FILE__), 'ebook_order_nonce');
	$order = get_post_meta(get_the_ID(), 'ebook_order', true);
	foreach ($fields as $f) {
		echo "<p><label>$f</label><br /><input type=text name=\"order[$f]\" value=\"" . get_post_meta(get_the_ID(),$f,true) . "\" size=64 /></p>";
	}
}


function save_custom_meta_data_order($id) {

	/* --- security verification --- */
	if(!wp_verify_nonce(@$_POST['ebook_order_nonce'], plugin_basename(__FILE__))) {
		return $id;
	} // end if

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $id;
	} // end if

	if('page' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $id)) {
			return $id;
		} // end if
	} else {
		if(!current_user_can('edit_page', $id)) {
			return $id;
		} // end if
	} // end if
	/* - end security verification - */
	foreach ($_POST['order'] as $k => $v) {
		update_post_meta($id, $k, $v);
	}
}

function ebook_code_box() {
	wp_reset_postdata();
	$post_id = get_the_ID();
	if ($_REQUEST['post'] > 0 && $_REQUEST['post'] != $post_id) {
		$post_id = $_REQUEST['post'];
	}
	echo '<input id="ebook_code" onClick="this.select()" readonly type="text" size="29" value=\'[ebook_store ebook_id="' . $post_id . '"]\' /> ' . __('Copy and paste this code in your post or page where you want the order form to appear.', 'ebook-store');
}
function ebook_wp_custom_attachment() {
	//
	//error_reporting(E_ALL);
	// wp_die('ddd');
	$ebook_id  = get_the_ID();
	
	$args = array(
	    'post_type' => 'ebook',
	);

	$query = new WP_Query('post_type=ebook&posts_per_page=-1');
	$ebook_bonus_options = '';
	$ebook_bonus_options = "<option>Please select</option>";
	$ebook_bonus_meta = get_post_meta($ebook_id, 'ebook',true);

	if (is_array($ebook_bonus_meta)) {
		if (is_array($ebook_bonus_meta['ebook_bonus']) == false) {
			$ebook_bonus_meta['ebook_bonus'] = array();
		}
		$ebook_bonus_meta = $ebook_bonus_meta['ebook_bonus'];
	} else {
		$ebook_bonus_meta = array();
	}
	
	
	// pr_die($ebook_bonus_meta);
	
		while ( $query->have_posts() ) {
			$query->the_post();
			if (get_the_ID() != $ebook_id) {
				$selected = '';
				if (in_array(get_the_ID(), $ebook_bonus_meta)) { 
					$selected = ' selected="selected"';
				}
				$ebook_bonus_options .= '<option value="' . get_the_ID() . '" ' . $selected . '>' . (get_the_title() != '' ? get_the_title() : '(no title)') . '</option>';
			}
		}
		wp_reset_postdata();
	// } else {
	// 	$ebook_bonus_options = "<option>No other ebooks found</option>";
	// }
	//print_r(get_post_meta(get_the_ID(),'ebook_wp_custom_attachment_epub', true));
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	wp_enqueue_script( 'ebook_store_settings', plugins_url( '/js/ebook_store_settings.js' , __FILE__ ), array(), '1.0.0', true );
	
	wp_register_style( 'ebookstorestylesheet', plugins_url('css/ebook_store.css', __FILE__) );
	wp_enqueue_style( 'ebookstorestylesheet' );
	
	$img = get_post_meta($ebook_id, 'ebook_wp_custom_attachment', true);
	
	$ebook = get_post_meta($ebook_id, 'ebook', true);

	$img_side_photo = get_post_meta($ebook_id, 'ebook_wp_custom_attachment_side_photo', true);
	$img_side_photo = is_array($img_side_photo) ? $img_side_photo  : array();
	$img_cover = get_post_meta($ebook_id, 'ebook_wp_custom_attachment_cover', true);
	$img_cover = is_array($img_cover) ? $img_cover  : array();
	$preview = get_post_meta($ebook_id, 'ebook_wp_custom_attachment_preview', true);
	$preview = is_array($preview) ? $preview  : array();
	wp_nonce_field(plugin_basename(__FILE__), 'ebook_wp_custom_attachment_nonce');
	$new = new WP_Query('post_type=ebook_author&posts_per_page=-1');
	while ($new->have_posts()) : $new->the_post();
	unset($selected);
	if (is_array($ebook) == false) {
		$ebook = array();
	}
	if ($ebook['ebook_author'] == null) {
		$ebook['ebook_author'] = array();
	}
	if (@in_array(get_the_ID(), $ebook['ebook_author'])) {
		$selected = ' selected';
	}
	@$ebook_authors .=  '<option value="' . get_the_ID() . '"' . $selected . '>' . get_the_title() . '</option>';
	endwhile;
	$new = new WP_Query('post_type=ebook_publisher');
	while ($new->have_posts()) : $new->the_post();
	unset($selected);
	if (@is_null($ebook['ebook_publisher'])) {
		$ebook['ebook_publisher'] = array();
	}
	if (@in_array(get_the_ID(), $ebook['ebook_publisher'])) {
		$selected = ' selected';
	}
	@$ebook_publishers .= '<option value="' . get_the_ID() . '"' . $selected . '>' . get_the_title() . '</option>';
	endwhile;
	$upgradeText = '';
	@$html .= "<script>var ebook_store_license_key = '" . get_option('ebook_store_license_key') . "'; </script>";
	$html .= '<div style="float:none; clear:both; overflow:auto;"><div class="ebookSeller50Percent">
			';
	// $html = '<h1 style="line-height:1.5em;">
	// 		To make the order form show up in your post or page, use the shortcode from the Ebook Embed Code Box.
	// 		</h1>';
	wp_reset_postdata();
$ppcurencies = array(
'' => '-- Optional --',
'USD' => 'US Dollar',
'EUR' => 'Euro',
'ILS' => 'Israeli New Sheqel',
'INR' => 'Indian Rupee',
'GBP' => 'Pounds Sterling',
'AUD' => 'Australian Dollar',
'CAD' => 'Canadian Dollar',
'JPY' => 'Japan Yen',
'NZD' => 'New Zealand Dollar',
'CHF' => 'Swiss Franc',
'HKD' => 'Hong Kong Dollar',
'SGD' => 'Singapore Dollar',
'SEK' => 'Sweden Krona',
'DKK' => 'Danish Krone',
'PLN' => 'New Zloty',
'NOK' => 'Norwegian Krone',
'HUF' => 'Forint',
'MXN' => 'Mexican Pesos',
'CZK' => 'Czech Koruna',
'BRL' => 'Brazilian Real',
'TWD' => 'Taiwan New Dollar',
'TRY' => 'Turkish Lira',
'MYR' => 'Malaysian Ringgit',
'ZAR' => 'South African Rands',
'NGN' => 'Nigerian Naira',
'RON' => 'Romanian leu',
'THB' => 'Thai Baht');

        foreach ($ppcurencies as $currency => $name) {
			$selected = '';
			if (isset($ebook['paypal_currency']) == false) {
				$ebook = array();
				$ebook['paypal_currency'] = esc_attr(get_option('paypal_currency','USD'));
			}
			if ($currency == @$ebook['paypal_currency']) {
				$selected = ' selected';
			}
			@$paypal_currency .= "<option value=\"$currency\"$selected>$name</option>";
		}

	$html .= __('Copy and paste this code in your post or page where you want the order form to appear', 'ebook-store') . '
	<br />
	<input id="ebook_code" onClick="this.select()" readonly type="text" size="29" value=\'[ebook_store ebook_id="' . $ebook_id . '"]\' /><br />
	Or use this code to show buy now button only:<br />
	<input id="ebook_code_buy" onClick="this.select()" readonly type="text" size="29" value=\'[ebook_store_buy ebook_id="' . $ebook_id . '"]\' />';
	if (get_option('ebook_store_license_key') == '') {
		$upgradeText = 'Supported file types in free version are: <b style="color:green;">PDF</b>, to use <b style="color:red;">EPUB</b>, <b style="color:red;">MOBI</b>, <b style="color:red;">MP3</b>, <b style="color:red;">TXT</b> and <b style="color:red;">ZIP</b> you can get the full version from here: <a target="_blank" href="https://www.shopfiles.com/index.php/products/wordpress-ebook-store">Upgrade Ebook Store</a>, no data will be lost upon upgrade.<br />';
	}
	$img = is_array($img) ? $img : array();
	if (@$img['url'] == '') {
		$html .= '<h5>Do you need help converting ebooks to all possible formats? Try <a target="_blank" href="http://calibre-ebook.com/download">Calibre</a>, a free software for converting ebook files.</h5>';
	}
	$html .= '<p class="">' . $upgradeText . '
	<br /><b>' . __('Please note the max upload size set on this server is', 'ebook-store') . ':</b> ' . ini_get('upload_max_filesize') . 'B<br />';


	echo $html;
	do_action('ebook_store_file_formats_form', $ebook_id);
	$html = '';




	$html .= '<p><b>'. __('Cover Image', 'ebook-store') . '</b> ('.__('optional', 'ebook-store').')<span class="description"> (180x260 ' . __('recommended', 'ebook-store') .')</span>' . (@$img_cover['url'] != '' ? '<br class="clear">Currently uploaded: <a href="' . @$img_cover['url'] . '">' . @basename($img_cover['url']) . '</a>' : '<br />Cover image is missing.');
	$html .= '<br /><input name="ebook_wp_custom_attachment_cover" type="file"></p>';
	$html .= '<p class=""><b>' . __('Ebook Preview', 'ebook-store') . '</b> ('.__('optional', 'ebook-store').')' . (@$preview['url'] != '' ? '<br class="clear">Uploaded: <a href="' . @$preview['url'] . '">' . @basename($preview['url']) . '</a><br /><label title="' . __('Delete') . '"><input type="checkbox" name="ebook_store_delete_preview"><i class="dashicons dashicons-trash"></i></label>' : '<br />Preview file is not uploaded.');
	$html .= '<br /><input type="file" id="ebook_wp_custom_attachment_preview" name="ebook_wp_custom_attachment_preview" value="" size="25">';
	$html .= '</p>';

	$html .= '<p><b>' . __('Side Image', 'ebook-store') . '</b> ('.__('optional', 'ebook-store').')<span class="description"> (20x260 ' . __('recommended', 'ebook-store') .')</span>' . (@$img_side_photo['url'] != '' ? '<br class="clear">' . __('Currently uploaded', 'ebook-store') . ': <a href="' . @$img_side_photo['url'] . '">' . @basename($img_side_photo['url']) . '</a>' : '<br />Side image is missing.');
	$html .= '<br /><input name="ebook_wp_custom_attachment_side_photo" type="file"></p>';
	$html .= '
<p>'.__('Author', 'ebook-store').' ('.__('optional', 'ebook-store').')<br /><select name="ebook[ebook_author][]" multiple>
<option value="0">' . __('None', 'ebook-store') . '</option>
' . @$ebook_authors . '
</select></p>
</div>
<div class="ebookSeller50Percent">
<p><h3>'.__('Price', 'ebook-store').' <span style="color:red; font-size:15px;"> * </span></h3><input name="ebook[ebook_price]" placeholder="0.00" min="0" type="number" step="any" value="' . @$ebook['ebook_price'] . '"></p>
<p>'.__('Publisher', 'ebook-store').' ('.__('optional', 'ebook-store').')<br /><select name="ebook[ebook_publisher][]" multiple>
<option value="0">' . __('None', 'ebook-store') . '</option>
' . @$ebook_publishers . '
</select></p>
<p>'.__('Date', 'ebook-store').' ('.__('optional', 'ebook-store').')<br /><input id="ebook_date" name="ebook[ebook_date]" type="text" value="' . @$ebook['ebook_date'] . '"></p>
<p>Pages ('.__('optional', 'ebook-store').')<br /><input name="ebook[ebook_pages]" type="number" value="' . @$ebook['ebook_pages'] . '"></p>

<p>'.__('Currency', 'ebook-store').'<br />
<select name="ebook[paypal_currency]">
' . $paypal_currency . '
</select> 
</p>
';

$html .= '<p class="goPro2"><h3>'.__('Bonus ebook', 'ebook-store').'</h3>';
$html .= '<select class="goPro2" multiple size="6" name="ebook[ebook_bonus][]">';
$html .= $ebook_bonus_options;
$html .= '</select></p>';
$extendhtml = apply_filters('ebook_store_form_extend', get_the_ID());
if ($extendhtml != get_the_ID()) {
	$html .= $extendhtml;
}

$html .= '
<h3>'.__('Paid or free download', 'ebook-store').'</h3>
<label><p class=""><input name="ebook[donate_or_download]" type="radio" value="paid" ' . (@$ebook['donate_or_download'] == 'paid' || @$ebook['donate_or_download'] == '' ? 'checked' : '') . '>'.__('Paid download', 'ebook-store').' <SMALL class="description">'.__('Order is placed through PayPal and the user is returned to the site for downloading the product. Email delivery routine will be triggered.', 'ebook-store').'</SMALL></p></label>
<label><p class="goPro2"><input class="goPro2" name="ebook[donate_or_download]" type="radio" value="free" ' . (@$ebook['donate_or_download'] == 'free' ? 'checked' : '') . '>'.__('Allow free download', 'ebook-store').' <small class="description">'.__('User is not sent to PayPal, download starts directly', 'ebook-store').'.</small></p></label>
<label><p class="goPro2"><input class="goPro2" name="ebook[donate_or_download]" type="radio" value="donate" ' . (@$ebook['donate_or_download'] == 'donate' ? 'checked' : '') . '>'.__('Donate to download', 'ebook-store').' <small class="description">'.__('User can set a price for the ebook once it lands on PayPal.', 'ebook-store').'</small></p></label>
</div>
</div>
<script>
jQuery(document).ready(function() {
    jQuery(\'#ebook_date\').datepicker({
        dateFormat : \'dd-mm-yy\'
    });
	jQuery(\'#wp-admin-bar-view\').hide();
	jQuery(\'input[type=file]\').show();
});
</script>
    ';

	echo $html;
} // end ebook_wp_custom_attachment
function ebook_set_upload_dir( $upload ) {
	//wp_error(print_r($upload,true));
	// Override the year / month being based on the post publication date, if year/month organization is enabled
	if ( get_option( 'uploads_use_yearmonth_folders' ) ) {
		// Generate the yearly and monthly dirs
		$time = current_time( 'mysql' );
		$y = substr( $time, 0, 4 );
		$m = substr( $time, 5, 2 );
		$upload['subdir'] = "/$y/$m";
	}

	$upload['subdir'] = '/ebooks' . $upload['subdir'];
	$upload['path']   = $upload['basedir'] . $upload['subdir'];
	$upload['url']    = $upload['baseurl'] . $upload['subdir'];
	$htaccess = "Options -Indexes
deny from all
";
	if (get_option('ebook_store_woocommerce_pdf_reader') == 0) {
		@file_put_contents($upload['basedir'] . '/ebooks/.htaccess', $htaccess);
	} else {
		@rename($upload['basedir'] . '/ebooks/.htaccess', $upload['basedir'] . '/ebooks/.htaccess-backup');
	}
	return $upload;
}
function ebook_set_upload_dir_preview( $upload ) {

	// Override the year / month being based on the post publication date, if year/month organization is enabled
	if ( get_option( 'uploads_use_yearmonth_folders' ) ) {
		// Generate the yearly and monthly dirs
		$time = current_time( 'mysql' );
		$y = substr( $time, 0, 4 );
		$m = substr( $time, 5, 2 );
		$upload['subdir'] = "/$y/$m";
	}

	$upload['subdir'] = '/ebooks_misc' . $upload['subdir'];
	$upload['path']   = $upload['basedir'] . $upload['subdir'];
	$upload['url']    = $upload['baseurl'] . $upload['subdir'];
	return $upload;
}
function save_custom_meta_data($id) {
	add_filter( 'upload_dir', 'ebook_set_upload_dir' );
	/* --- security verification --- */
	if(!wp_verify_nonce(@$_POST['ebook_wp_custom_attachment_nonce'], plugin_basename(__FILE__))) {
		return $id;
	} // end if

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $id;
	} // end if

	if('page' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $id)) {
			return $id;
		} // end if
	} else {
		if(!current_user_can('edit_page', $id)) {
			return $id;
		} // end if
	} // end if
	/* - end security verification - */
	if (strpos($_POST['content'], '[ebook_store') !== false) {
		wp_die("The embed code [ebook_store id=XX] is not meant to be in the ebook description, it must be in the post or page where you want the ebook order form to appear. Click Back, correct that and try again.");
	}
	if ($_POST['ebook']['donate_or_download'] != 'free' && $_POST['ebook']['ebook_price'] == 0) {
		$_POST['ebook']['ebook_price'] = 0.01;
	}
	//die(print_r($_POST['ebook'],true));
	update_post_meta($id, 'ebook', $_POST['ebook']);
	update_post_meta($id, 'ebook_bonus', $_POST['ebook_bonus']);

	// Make sure the file array isn't empty

	if(!empty($_FILES['ebook_wp_custom_attachment_pdf']['name'])) {
		$_FILES['ebook_wp_custom_attachment'] = $_FILES['ebook_wp_custom_attachment_pdf'];
		// Setup the array of supported file types. In this case, it's just PDF.
		$supported_types = array('application/pdf','application/x-mobipocket-ebook','application/epub+zip','application/zip','application/octet-stream');
		
		// Get the file type of the upload
		$arr_file_type = wp_check_filetype(basename($_FILES['ebook_wp_custom_attachment']['name']));
		$uploaded_type = $arr_file_type['type'];

		// Check if the type is supported. If not, throw an error.
		if(1) {

			// Use the WordPress API to upload the file
			$upload = wp_upload_bits($_FILES['ebook_wp_custom_attachment']['name'], null, file_get_contents($_FILES['ebook_wp_custom_attachment']['tmp_name']));

			if(isset($upload['error']) && $upload['error'] != 0) {
				wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
			} else {
				add_post_meta($id, 'ebook_wp_custom_attachment', $upload,true);
				update_post_meta($id, 'ebook_wp_custom_attachment', wp_slash($upload));
				update_post_meta($id, 'ebook_wp_custom_attachment_pdf', wp_slash($upload));
			} // end if/else

		} else {
			wp_die("The file type that you've uploaded is not a mobile book format.");
		} // end if/else

	} // end if
	$loop = array('mobi','txt','epub','zip', 'mp3','mp4');
	foreach ($loop as $l) {
		if(!empty($_FILES['ebook_wp_custom_attachment_' . $l]['name'])) {

			//wp_die(print_r($_FILES['ebook_wp_custom_attachment_' . $l],true));
			// Setup the array of supported file types. In this case, it's just PDF.
			$supported_types = array('application/pdf','application/x-mobipocket-ebook','application/epub+zip','application/zip','application/octet-stream');
			
			// Get the file type of the upload
			$arr_file_type = wp_check_filetype(basename($_FILES['ebook_wp_custom_attachment_' . $l]['name']));
			$uploaded_type = $arr_file_type['type'];

			// Check if the type is supported. If not, throw an error.
			if(1) {

				// Use the WordPress API to upload the file
				$upload = wp_upload_bits($_FILES['ebook_wp_custom_attachment_' . $l]['name'], null, @file_get_contents($_FILES['ebook_wp_custom_attachment_' . $l]['tmp_name']));
				//wp_die(print_r($upload,true));
				if(isset($upload['error']) && $upload['error'] != 0) {
					wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
				} else {
					add_post_meta($id, 'ebook_wp_custom_attachment_' . $l, wp_slash($upload), true);
					update_post_meta($id, 'ebook_wp_custom_attachment_' . $l, wp_slash($upload));
				} // end if/else

			} else {
				wp_die("The file type that you've uploaded is not a mobile book format.");
			} // end if/else

		} // end if
	}
	//separate loop for deleting ebooks
	$loop = array('pdf','mobi','txt','epub','zip', 'mp3', 'mp4');
	foreach ($loop as $l) {
		$li = 'ebook_store_delete_' . $l;
		if (isset($_REQUEST[$li])) {
			$file_meta = get_post_meta($id, 'ebook_wp_custom_attachment_' . $l, true);
			unlink($file_meta['file']);
			delete_post_meta($id, 'ebook_wp_custom_attachment_' . $l);
			if ($l == 'pdf') {
				delete_post_meta($id, 'ebook_wp_custom_attachment');
			}
		}
	}
	//wp_die(print_r($_REQUEST));
	if ($_REQUEST['ebook_store_delete_preview'] == 'on') {
		//wp_die('delete preview');
		delete_post_meta($id, 'ebook_wp_custom_attachment_preview');
	}
	//separate loop for deleting ebooks - end
	add_filter( 'upload_dir', 'ebook_set_upload_dir_preview' );

	if(!empty($_FILES['ebook_wp_custom_attachment_preview']['name'])) {

		// Setup the array of supported file types. In this case, it's just PDF.
		$supported_types = array('application/pdf','application/x-mobipocket-ebook','application/epub+zip','application/zip','application/octet-stream');
		
		// Get the file type of the upload
		$arr_file_type = wp_check_filetype(basename($_FILES['ebook_wp_custom_attachment_preview']['name']));
		$uploaded_type = $arr_file_type['type'];

		// Check if the type is supported. If not, throw an error.
		if(1) {

			// Use the WordPress API to upload the file
			$upload = wp_upload_bits($_FILES['ebook_wp_custom_attachment_preview']['name'], null, file_get_contents($_FILES['ebook_wp_custom_attachment_preview']['tmp_name']));

			if(isset($upload['error']) && $upload['error'] != 0) {
				wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
			} else {
				add_post_meta($id, 'ebook_wp_custom_attachment_preview', $upload);
				update_post_meta($id, 'ebook_wp_custom_attachment_preview', $upload);
			} // end if/else

		} else {
			wp_die("The file type that you've uploaded is not a mobile book format.");
		} // end if/else

	} // end if


	//check the side photo
	if(!empty($_FILES['ebook_wp_custom_attachment_side_photo']['name'])) {

		// Setup the array of supported file types. In this case, it's just PDF.
		$supported_types = array('image/jpeg','image/gif','image/png','image/svg+xml');

		// Get the file type of the upload
		$arr_file_type = wp_check_filetype(basename($_FILES['ebook_wp_custom_attachment_side_photo']['name']));
		$uploaded_type = $arr_file_type['type'];

		// Check if the type is supported. If not, throw an error.
		if(1) {

			// Use the WordPress API to upload the file
			$upload = wp_upload_bits($_FILES['ebook_wp_custom_attachment_side_photo']['name'], null, file_get_contents($_FILES['ebook_wp_custom_attachment_side_photo']['tmp_name']));

			if(isset($upload['error']) && $upload['error'] != 0) {
				wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
			} else {
				add_post_meta($id, 'ebook_wp_custom_attachment_side_photo', $upload);
				update_post_meta($id, 'ebook_wp_custom_attachment_side_photo', $upload);
			} // end if/else

		} else {
			wp_die("The file type that you've uploaded is not a mobile book format.");
		} // end if/else

	} // end if
	//cover photo
	if(!empty($_FILES['ebook_wp_custom_attachment_cover']['name'])) {
		$filename = $_FILES['ebook_wp_custom_attachment_cover']['tmp_name'];
		// Setup the array of supported file types. In this case, it's just PDF.
		$supported_types = array('image/jpeg','image/gif','image/png','image/svg+xml');
			
		// Get the file type of the upload
		$arr_file_type = wp_check_filetype(basename($_FILES['ebook_wp_custom_attachment_cover']['name']));
		$uploaded_type = $arr_file_type['type'];
		$image = @imagecreatefromjpeg($filename);
		if (!$image) {
			$image = imagecreatefrompng($filename);
		}
		// Check if the type is supported. If not, throw an error.
		if(1) {

			// Use the WordPress API to upload the file
			$img_tmp_name = $_FILES['ebook_wp_custom_attachment_cover']['tmp_name'];
			list($width, $height) = getimagesize($img_tmp_name);
			if ($width != 180 || $height != 260) {
				$image_p = imagecreatetruecolor(180, 260);
				$image = @imagecreatefromjpeg($img_tmp_name);
				if (!$image) {
					$image = imagecreatefrompng($img_tmp_name);
				}
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, 180, 260, $width, $height);
				imagejpeg($image_p, $img_tmp_name,100);

			}
			$upload = wp_upload_bits($_FILES['ebook_wp_custom_attachment_cover']['name'], null, file_get_contents($_FILES['ebook_wp_custom_attachment_cover']['tmp_name']));

			if(isset($upload['error']) && $upload['error'] != 0) {
				wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
			} else {
				add_post_meta($id, 'ebook_wp_custom_attachment_cover', $upload);
				update_post_meta($id, 'ebook_wp_custom_attachment_cover', $upload);
			} // end if/else

		} else {
			wp_die("The file type that you've uploaded is not a mobile book format.");
		} // end if/else

	} // end if



} // end save_custom_meta_data

function ebook_update_edit_form() {
	echo ' enctype="multipart/form-data"';
} // end ebook_update_edit_form
function ebook_download_link($ebook_order, $free = false, $bonus = false, $bonus_ebook_id = null) {

	if ($free == 0) {
		$action_name = 'download';
	} else {
		$action_name = 'download_free';
	}
	$link = add_query_arg(array('ebook_key' => $ebook_order['ebook_key'][0], 'action' => $action_name, 'md5_nonce' => @$ebook_order['md5_nonce'][0]),get_permalink($ebook_order['ebook'][0]));
	$link = remove_query_arg('p',$link);
	if ($action_name == 'download_free') {
		$link = add_query_arg(array('p' => $ebook_order['ebook'][0]),$link);
	}
	$post = get_post($ebook_order['ebook'][0]);
	$slug = $post->post_name;
	$link = add_query_arg(array('ebook' => $slug),$link);

	if ($bonus > 0) {
		$link = add_query_arg(array('type' => 'bonus'),$link);
		$link = add_query_arg(array('ebook_id' => $bonus_ebook_id),$link);
		$link = add_query_arg(array('order_id' => $ebook_order['order_id'][0]),$link);
	}
	//die('Bonus ' . $bonus);
	return $link;
}
function humanFileSize($size,$unit="") {
	if( (!$unit && $size >= 1<<30) || $unit == "GB")
		return number_format($size/(1<<30),2)."GB";
	if( (!$unit && $size >= 1<<20) || $unit == "MB")
		return number_format($size/(1<<20),2)."MB";
	if( (!$unit && $size >= 1<<10) || $unit == "KB")
		return number_format($size/(1<<10),2)."KB";
	return number_format($size)." bytes";
}
function ebook_store_buy( $atts ){
	return ebook_store($atts, true);
}	
function ebook_store_wp_super_cache_check() {
	// error_reporting(E_ALL);
	// ini_set('display_errors',true);
	
	if (file_exists(WP_PLUGIN_DIR . '/wp-super-cache/wp-cache.php')) {		
		if (strpos($_SERVER['QUERY_STRING'], 'action=thank_you') || strpos($_SERVER['QUERY_STRING'], 'ebook') || strpos($_SERVER['QUERY_STRING'], 'ipn')) {
			define('DONOTCACHEPAGE',true);
		}
	}

}
function ebook_store( $atts, $buyNowOnly = false ){

	define('DONOTCACHEPAGE',true);
	//@error_reporting(E_ALL);
	ini_set('display_errors',1);
	if (is_array($atts) == false) {
		$atts = array('ebook_id' => $atts);
	}
	
	
	include('locale.php');

	global $ebook_store_messages;
	global $woocommerce;

	if (is_array($ebook_store_messages) and count($ebook_store_messages) > 0) {
		foreach ($ebook_store_messages as $ebook_store_messages => $message) {
			echo $message;
		}
	}
	wp_register_style( 'ebookstorestylesheet', plugins_url('css/ebook_store.css', __FILE__) );
	wp_enqueue_style( 'ebookstorestylesheet' );

	//wp_enqueue_script( 'ebook_store_settings', plugins_url( '/js/ebook_store_settings.js' , __FILE__ ), array(), '1.0.0', true );
	$post_id = $atts['ebook_id'];

	if (@$_REQUEST['ebook_key'] != false && @$_REQUEST['action'] == 'thank_you') {
		add_action( 'wp_footer', 'ebook_store_deregister_embeds' );
		if ($_REQUEST['ebook_key'] == -1) {
			$wp_query_statement =  array (
				'post_type' => 'ebook_order',
				'meta_key' => 'user_id',
				'meta_value' => get_current_user_id(),
				'orderby'   => 'date',
				'posts_per_page' => -1,
				'order' => 'DESC' );
				// print_r($wp_query_statement);
				// die();
			$loop = new WP_Query($wp_query_statement);
			while ( $loop->have_posts() ) {
				$loop->the_post();	
				$ebook_key = get_post_meta(get_the_ID(), 'ebook_key', true);
				$_REQUEST['ebook_key'] = $ebook_key;
				$uri = $_SERVER['REQUEST_URI'];
				$uri = remove_query_arg('ebook_key',$uri);
				die("<script> if (window.location != window.parent.location) { window.parent.location = '".add_query_arg('ebook_key',$ebook_key)."'; } else { window.location = '".add_query_arg('ebook_key',$ebook_key)."'; }</script>");
				echo get_the_ID() . '<br />';
				@$toReset = 1;
				//break;
			}
			die();
			if (@$toReset) {
				wp_reset_postdata();
			}
	
		}
		$QSWPOptions = new QSWPOptions();
		$content = get_option('thankyou_page',$QSWPOptions->thankyou_page);
		
		$ebook_order = ebook_get_order('ebook_key', $_REQUEST['ebook_key']);
		//wp_die(var_dump($ebook_order));
		$time = strtotime(@$ebook_order['payment_date'][0]);
		//wp_die("$time-".time().'='.$time - time() );
		//print_r($ebook_order);
		if (@$ebook_order['item_name'][0] == '') {
			$ebook_order['item_name'][0] = get_the_title(@$ebook_order['ebook'][0]);
		}
		
		//wp_die('ebook order var ' . var_export($ebook_order,true));
		if (!$ebook_order ||  @strtotime($ebook_order['payment_date'][0]) == 0 || isset($ebook_order['ebook']) == false) { //  || time() < @strtotime($ebook_order['payment_date'][0]) + 25 ||
			return '<img src="' . plugins_url( 'img/pp_logo.png', __FILE__ ) . '"><h4>' . $locale['confirmation'] . '</h4>' . '<script>   window.setTimeout(\'location.reload()\', 5000);
</script>';
		}
		$file = get_post_meta($ebook_order['ebook'][0],'ebook_wp_custom_attachment',true);
		//wp_die(print_r($file,true));
		if (@!$file) {
			$file = array();
		}
		$ebook_order['downloadlink'][0] = ebook_download_link($ebook_order);
		//<a href="%%downloadlink%%" target="_blank" rel="noopener">%%item_name%%</a> (%%filesize%%)
		@$ebook_order['pdf_reader'][0] = ebook_pdf_reader($ebook_order);
		@$ebook_order['download_links'][0] = implode("<br />",ebook_download_links($ebook_order));
		@$ebook_order['ebook_bonus'][0] = (implode("<br />",ebook_download_links_bonus($ebook_order)) != '' ? implode("<br />",ebook_download_links_bonus($ebook_order)) : __('None','ebook-store'));
		@$ebook_order['filesize'][0] = humanFileSize(filesize($file['file']));
		// $ebook_order['downloadlink_html'][0] = '<a href="'.ebook_download_link($ebook_order).'" target="_blank" rel="noopener">'.$ebook_order['item_name'][0].'</a> ('.$ebook_order['filesize'][0].')';
		//print_r($ebook_order);

		$ebookObj = new EbookStoreEbook(@$ebook_order['ebook'][0]);
		$ebookObj->setLink['pdf'] = $ebook_order['downloadlink'][0];
		$ebook_order['downloadlink_html'][0] = $ebookObj->format_links();
		//$ebook_order['downloadlink_html'][0] = $ebookObj->format_links();
		
		if (@$ebook_order['password'] == '') {
			$ebook_order['password'] = $ebook_order['payer_email'];
		}
		if (get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_1', true) != '') {
			$ebook_order['ebook_store_alternative_location_1'] = array(0 => '<p style="color:gray;">Download to Your Device: (This will take a very long time and requires some technical knowledge but we have provided an instructions page)</p><a href="' . get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_1', true) . '" target="_blank"><h1 style="color:red;"">Add to Your Device</h1>
				</a>');

		}
		if (get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_2', true) != '') {
			$ebook_order['ebook_store_alternative_location_2'] = array(0 => '<a href="' . get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_2', true) . '" target="_blank">
				<h1 style="color:red;">View Book Online Now</h1>
			</a>');
		}

		if (get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_3', true) != '') {
			$ebook_order['ebook_store_alternative_location_3'] = array(0 => '<a href="' . get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_3', true) . '" target="_blank">
				<h1 style="color:red;">Download PDF</h1>
			</a>');
		}
		foreach ($ebook_order as $k => $arr) {
			$content = str_replace('%%' . $k . '%%', $arr[0], $content);
		}
		return apply_filters('the_content',$content);
		//return 'test 123' . $content;
	}


	$items = '';
	$args = array( 'post_type' => 'ebook', 'posts_per_page' => -1, 'p' => @$atts['ebook_id'] );
	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post();
	/*the_title();
	 echo '<div class="entry-content">';
	the_content();
	echo '</div>';*/
	$ebook = get_post_meta(get_the_ID(), 'ebook', true);
	$ebook['ebook_price'] = floatval($ebook['ebook_price']);
	//error_log(var_export($ebook,true));
	$ebook_key = md5(NONCE_KEY . get_the_ID() . $ebook['ebook_price'] . mt_rand(1,100000));
	//$ebook['ebook_price'] = is_float($ebook['ebook_price']) ? $ebook['ebook_price'] : 0.0;
	$md5_nonce = md5(mt_rand(1,9999) . NONCE_KEY . get_the_ID() . @number_format($ebook['ebook_price'], 2, '.', ','));
	//$custom = get_the_ID() . '|' . $md5_nonce;
	$custom = get_the_ID() . '|' . md5(NONCE_KEY . get_the_ID() . @number_format($ebook['ebook_price'], 2, '.', ','));
	
	if (get_option('ebook_store_wp_affiliate_integration') == 1) { /* && file_exists('../affiliates-manager/config.php')*/
		$parameters = apply_filters('ebook_store_payment_gateway_parameters', array('custom' => $custom));
	}

	$c = new Currencies();
	$img = get_post_meta(get_the_ID(), 'ebook_wp_custom_attachment', true);
	$preview = get_post_meta(get_the_ID(), 'ebook_wp_custom_attachment_preview', true);
	if (is_array($preview) == false) { $preview = array(); }
	if (@$preview['url'] != '') {
		if (get_option( 'ebook_store_no_viewerjs_previews', false ) == false) {
			@$preview['url'] = plugins_url('',__FILE__) .  '/includes/ViewerJS/index.html#' . $preview['url'];
		}
	}

	$cover = get_post_meta(get_the_ID(),'ebook_wp_custom_attachment_cover',true);
	$side = get_post_meta(get_the_ID(),'ebook_wp_custom_attachment_side_photo',true);
	if (!$side) {
		$side = $cover;
	}
	//style="background-url:(' . $side['url'] . ');"
	if (is_array(@$ebook['ebook_publisher'])) {
		$publishers = array();
		foreach ($ebook['ebook_publisher'] as $p => $pp) {
			$publishers[] = get_the_title($pp);
		}		
	}
	if (is_array(@$ebook['ebook_author'])) {
		$authors = array();
		foreach ($ebook['ebook_author'] as $p => $pp) {
			$authors[] = get_the_title($pp);
		}
	}
	@$publishers = is_array($publishers) ? $publishers : array();
	@$authors = is_array($authors) ? $authors : array();
	$publishers = @implode(", ", $publishers);
	$authors = @implode(", ", $authors);
	/* div class front, where is it?*/

	if ($img == '' && get_option( 'ebook_store_license_key') == '') {
		error_reporting(0);
		echo "<h3>The Ebook embedded in this page is missing the Ebook file, please edit the ebook and upload a file to remove this message.</h3>";
		echo "Click <a href=\"" . home_url() . "/wp-admin/post.php?post=" . get_the_ID() . "&action=edit\">here</a> to open the Ebook editor.";
	}
	$paypal_currency = (@$ebook['paypal_currency'] != '' ? @$ebook['paypal_currency'] : get_option('paypal_currency'));
	$md5rand = md5(rand(1,10000) . microtime());

	$buyNowLinkText = $locale['buy'] . ' (' . $c->getSymbol($paypal_currency) . @number_format(ebook_store_price_plus_vat($ebook['ebook_price']),2) . ')';
	$buyNowLinkOnClick = 'document.getElementById(\'' . $md5rand . '\').submit(); return false;';
	if ($ebook['ebook_price'] === 0 || $ebook['donate_or_download'] == 'free') {
		$buyNowLinkText = $locale['download'];
		$buyNowLinkOnClickOriginal = ebook_download_link(array('ebook' => array(0 => get_the_ID()), 'ebook_key' => array(0 => $ebook_key), 'md5_nonce' => array(0 => $md5_nonce)),1);
		$buyNowLinkOnClick = "window.location = '" .  $buyNowLinkOnClickOriginal . "'; return false;";
	} else if ($ebook['ebook_price'] === 0 || $ebook['donate_or_download'] == 'donate') {
		$buyNowLinkText = $locale['download'];
		$ebook['ebook_price'] = 0;
	}

	if ($img == '' && get_option( 'ebook_store_license_key') == '') {
		$buyNowLinkOnClick = 'alert(\'There is no ebook file uploaded. Please upload a file first in the Ebook Store plugin.\');';
	}
	if (get_option('formEnabled') == 1) {
		$buyNowLinkOnClickOriginal = $buyNowLinkOnClick;
		$buyNowLinkOnClick = "ebook_store_popup(function () {" . $buyNowLinkOnClick . "}, this);";
		wp_register_style( 'ebook_store_tinglecss', plugins_url('/includes/tingle-master/dist/tingle.min.css', __FILE__) );
		wp_enqueue_style( 'ebook_store_tinglecss' );
		wp_enqueue_script( 'ebook_store_site_modal', plugins_url( '/includes/tingle-master/dist/tingle.min.js' , __FILE__ ), array(), '1.0.0', true );
		wp_enqueue_script( 'ebook_store_site', plugins_url( '/js/ebook_store_site.js' , __FILE__ ), array(), '1.0.0', true );

	}

	wp_register_style( 'ebookstorestylesheet', plugins_url('css/ebook_store.css', __FILE__) );
	wp_enqueue_style( 'ebookstorestylesheet' );
	$checkoutPage = esc_attr(get_option('ebook_store_checkout_page'));
	if (!$checkoutPage) {
		$checkoutPage = $post_id;
	}

	
	$woocommerce_product_id = get_post_meta($post_id, 'woocommerce_product_id', true);
	//echo "$post_id - $woocommerce_product_id<br />";
	if ($woocommerce_product_id > 0 && class_exists('woocommerce') && get_option('ebook_store_woocommerce_integration')) {
$addToCartButton = '<a  href="' . add_query_arg(array('woocommerce_product_id' => $woocommerce_product_id), get_permalink(get_the_ID())) . '"  class="add_to_cart_link">' . $locale['addtocart'] . '</a>';
	}
	$bookpost = get_post(get_the_ID());
	if (!is_array($cover)) {
		$cover = array();
	}
	if (!is_array(@$extraButtons)) {
		@$extraButtons = array();
	}
	if (!is_array($side)) {
		$side = array();
	}
	@$extraButtons = apply_filters('ebook_store_extra_buttons',$extraButtons, $ebook['ebook_price'], $bookpost->post_title, $cover['url'], $md5_nonce, $post_id);
	$extraButtons = is_array($extraButtons) ? $extraButtons : array();
	$form = '<form method="post" id="' . $md5rand . '" name="dmp_order_form" action="https://www' . (get_option('paypal_sandbox') != '' ? '.sandbox' : '') . '.paypal.com/cgi-bin/webscr">
		<input type="hidden" name="rm" value="0">
		<input type="hidden" name="discount_rate" value="0">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="charset" value="utf-8">
		<input type="hidden" name="md5_nonce" value="' . $md5_nonce . '">
		<input type="hidden" name="lc" value="' . get_option('paypal_language') . '">
		<input type="hidden" name="no_shipping" value="' . get_option('ebook_store_require_shipping') . '">
		<input type="hidden" name="button_subtype" value="products">
		<input type="hidden" name="return" value="' . add_query_arg(array('ebook_key' => $ebook_key, 'action' => 'thank_you'),get_permalink($checkoutPage)) . '">
		<input type="hidden" name="cancel_return" value="' . (get_option('paypal_sandbox') == 1 ? add_query_arg(array('ebook_key' => $ebook_key, 'action' => 'thank_you'),get_permalink($checkoutPage)) : add_query_arg(array('ebook_key' => $ebook_key, 'action' => 'cancel'),get_permalink(get_option('ebook_store_cancel_page')))) . '">
		<input type="hidden" name="notify_url" value="' . add_query_arg(array('task' => 'ipn','ebook_key' => $ebook_key, 'md5_nonce' => $md5_nonce), home_url('/')) . '">
		<input type="hidden" name="item_name" value="' . $bookpost->post_title . '">
		<input type="hidden" name="item_number" value="1">
		<input type="hidden" name="tax_rate" value="' . get_option('vat_percent') . '">
		<input type="hidden" name="amount" value="' . $ebook['ebook_price'] . '">
		<input type="hidden" name="upload" value="1">
		<input type="hidden" name="custom" value="' . $custom .'">
		<input type="hidden" name="business" id="af69ae50c1be74757508c8f7fae10abd" value="' . get_option('paypal_account') . '">
		<input type="hidden" name="receiver_email" id="af69ae50c1be74757508c8f7fae10abd0xff" value="' . get_option('paypal_account') . '">
		<input type="hidden" name="currency_code" value="' . $paypal_currency . '">
		<input type="hidden" name="cbt" value="' . get_option('paypal_return_button_text') . '">
		<input type="hidden" name="no_note" value="1">
		</form>';
		
		//$form .= var_export($bookpost, true);
		if (@$_GET['task'] == 'direct_order') {
			if ($ebook['ebook_price'] > 0) {
				die($form . 
					'<script>
						document.getElementById("' . $md5rand . '").submit();
					</script>'
				);
			} else {
				die($form . 
					'<script>
						'.$buyNowLinkOnClick.'
						jQuery("body").html("");
					</script>'
				);
		}	
	}
	// wp_die(var_export(get_option('ebook_store_hide_buy_now',0)));
	$items .= '<div id="ebook_formData" class="ebook_formData"></div>
            <figure>
                            <div class="perspective"><div class="book" data-book="book-' . get_the_ID() . '"><div onClick="' . (get_option('ebook_store_disable_cover_buy_now',0) == 0 ? $buyNowLinkOnClick : '') . '" class="cover"><div data-dd="dd" class="front" style="cursor: pointer; cursor: hand; background: url(' . @$cover['url'] . ');"></div><div class="inner inner-left"></div></div><div class="inner inner-right"></div></div></div><div class="buttons">
                            		<a href="#" style="display:none;">Look inside</a>
                            		<a href="#" class="details_link" >' . $locale['details'] . '</a>
                            		' . @$addToCartButton . '
                            		' . @implode($extraButtons) . '
                            		<a target="_blank" href="' . (@$preview['url'] != '' ? $preview['url'] : '" style="display:none;') . '" class="">' . $locale['preview'] . '</a>
									<a style="' . (get_option('ebook_store_hide_buy_now',0) > 0 ? 'display: none' : '')  . '" class="ebook_buy_link" data-md5_nonce="' . $md5_nonce . '" href="' . @$buyNowLinkOnClickOriginal . '" onClick="' . $buyNowLinkOnClick . '">' . $buyNowLinkText . '</a>
' . $form . '
</div>
                            <figcaption><h2>' . $bookpost->post_title . ' <span>' . $authors . '</span></h2></figcaption>
                            <div class="details">
                                <ul>
                                    <li><div class="ebookStorEbookContent">' . get_the_content() . '</div></li>
                                    <li>' . $publishers . '</li>
                                    <li>' . ($ebook['ebook_date'] > 0 ? date(get_option( 'date_format' ),strtotime($ebook['ebook_date'])) : '') . '</li>
                                    <li>' . ($ebook['ebook_pages'] > 0 ? $ebook['ebook_pages'] . ' ' . $locale['pages'] : '') . '</li>
                                </ul>
                            <span class="close-details"></span></div>
            </figure>
            <style>
.book[data-book="book-' . get_the_ID() . '"] .cover::before {
background: url(' . @$side['url'] . ');
}
.bookshelf figure .buttons a {
	font-size:' . get_option('ebook_store_buy_link_font_size', 0.65) . 'em !important;
}
.bookshelf figure h2 {
	font-size:' . get_option('ebook_store_title_font_size', 1.8) . 'em !important;
}
div#bookshelf {
    -ms-transform: scale(' . get_option('form_scale', 1) . ', ' . get_option('form_scale', 1) . '); /* IE 9 */
    -webkit-transform: scale(' . get_option('form_scale', 1) . ', ' . get_option('form_scale', 1) . '); /* Safari */
    transform: scale(' . get_option('form_scale', 1) . ', ' . get_option('form_scale', 1) . ');
}            </style>
            ';
	endwhile;
	wp_reset_postdata();
	
	if ($buyNowOnly == true) {
		return $form . '<button title="' . $locale['buy'] . '" aria-label="' . $locale['buy'] . '" onClick="' . $buyNowLinkOnClick . '">' . $locale['buy'] . '</button>';
	}
	return '
        <link rel="stylesheet" type="text/css" href="' . plugins_url('css/bookblock.css',__FILE__) . '" />
        <link rel="stylesheet" type="text/css" href="' . plugins_url('css/component.css',__FILE__) . '" />
        <script src="' . plugins_url('js/modernizr.custom.js',__FILE__) . '"></script>
<div id="bookshelf" class="bookshelf">
                    ' . $items . '
                </div>

        <script src="' . plugins_url('js/bookblock.min.js',__FILE__) . '"></script>
        <script src="' . plugins_url('js/classie.js',__FILE__) . '"></script>
        <script src="' . plugins_url('js/bookshelf.js',__FILE__) . '"></script>
    ';
}
function custom_enter_title_author( $input ) {
	global $post_type;

	if ( is_admin() && 'ebook_author' == $post_type )
		return __( 'Enter Author Name' );

	return $input;
}

function custom_enter_title_publisher( $input ) {
	global $post_type;

	if ( is_admin() && 'ebook_publisher' == $post_type )
		return __( 'Enter Publisher Name' );

	return $input;
}

class Currencies {

	public $currencies = array(

			'AUD' => array('name' => "Australian Dollar", 'symbol' => "A$", 'ASCII' => "A&#36;"),

			'CAD' => array('name' => "Canadian Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),

			'CZK' => array('name' => "Czech Koruna", 'symbol' => "kr", 'ASCII' => "kr"),

			'DKK' => array('name' => "Danish Krone", 'symbol' => "Kr", 'ASCII' => ""),

			'EUR' => array('name' => "Euro", 'symbol' => "â‚¬", 'ASCII' => "&#128;"),

			'HKD' => array('name' => "Hong Kong Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),

			'HUF' => array('name' => "Hungarian Forint", 'symbol' => "Ft", 'ASCII' => "Ft"),

			'ILS' => array('name' => "Israeli New Sheqel", 'symbol' => "₪", 'ASCII' => "&#x20AA;"),
			
			'INR' => array('name' => "Indian Rupee", 'symbol' => "₹", 'ASCII' => "&#8377;"),

			'JPY' => array('name' => "Japanese Yen", 'symbol' => "¥", 'ASCII' => "&#165;"),

			'MXN' => array('name' => "Mexican Peso", 'symbol' => "$", 'ASCII' => "&#36;"),

			'NOK' => array('name' => "Norwegian Krone", 'symbol' => "Kr", 'ASCII' => ""),

			'NZD' => array('name' => "New Zealand Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),

			'PHP' => array('name' => "Philippine Peso", 'symbol' => "₱", 'ASCII' => ""),

			'PLN' => array('name' => "Polish Zloty", 'symbol' => "zł‚", 'ASCII' => "zł"),

			'GBP' => array('name' => "Pound Sterling", 'symbol' => "£", 'ASCII' => "&#163;"),

			'SGD' => array('name' => "Singapore Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),

			'SEK' => array('name' => "Swedish Krona", 'symbol' => "kr", 'ASCII' => ""),

			'CHF' => array('name' => "Swiss Franc", 'symbol' => "CHF", 'ASCII' => "Fr"),

			'TWD' => array('name' => "Taiwan New Dollar", 'symbol' => "NT$", 'ASCII' => "NT&#36;"),

			'THB' => array('name' => "Thai Baht", 'symbol' => "฿", 'ASCII' => "&#3647;"),

			'USD' => array('name' => "U.S. Dollar", 'symbol' => "$", 'ASCII' => "&#36;"),

			'BRL' => array('name' => "Brazilian Real", 'symbol' => "R$", 'ASCII' => "&#x0024;"),

			'TRY' => array('name' => "Turkish Lira", 'symbol' => "TL", 'ASCII' => "TL"),

			'MYR' => array('name' => "Malaysian Ringgit", 'symbol' => "RM", 'ASCII' => "RM"),

			'NGN' => array('name' => "Nigerian naira", 'symbol' => "₦", 'ASCII' => "₦"),
			
			'RON' => array('name' => "Romanian Leu", 'symbol' => "Lei", 'ASCII' => "Lei"),
			
			'ZAR' => array('name' => "South African Rands", 'symbol' => "R", 'ASCII' => "R"),
	);

	public function getSymbol($code = 'USD') {

		if (!empty($this->currencies[$code]['ASCII'])) {

			return (string) $this->currencies[$code]['ASCII'];

		}

		return (string) @$this->currencies[$code]['symbol'];

	}

}

function order_columns($columns)
{
	$columns = array(
			'cb'	 	=> '<input type="checkbox" />',
	//		'thumbnail'	=>	'Thumbnail',
			'order_id' 	=> 'Order ID',
			'title' 	=> 'Buyer',
			'paypal'	=> 'PayPal',
			//		'featured' 	=> 'Featured',
			'product'	=>	'Product',
			'formData'	=>	'Form Data',
			'amount'	=>	'Amount',
			'country'	=> 	'Country',
			'password'	=> 	'Password (if any)',
			'shipping_address'	=> 	'Shipping Address',
			'downloadlink'	=> 	'Download Link',
			'date'		=>	'Date',
			'downloads'		=>	'Downloads',
	);
	return $columns;
}
function order_custom_columns($column)
{
	global $post;
	$c = new Currencies();
	switch ($column) {
		case 'order_id':
			echo $post->ID;
			break;
		case "product":
			echo '<a href="post.php?post='. get_post_meta($post->ID,'ebook',true) . '&action=edit">' . get_the_title(get_post_meta($post->ID,'ebook',true)). '</a>';

			break;
		case "amount":
			$mc_currency = get_post_meta($post->ID,'mc_currency',true);
			$mc_gross = get_post_meta($post->ID,'mc_gross',true);
			$mc_fee = get_post_meta($post->ID,'mc_fee',true);
			$total = floatval($mc_gross) - floatval($mc_fee);
			$mc_fee = "Fee -" . $c->getSymbol($mc_currency) . @number_format(floatval(get_post_meta($post->ID,'mc_fee',true)),2);
			echo $c->getSymbol($mc_currency) . @number_format($mc_gross,2) . "<br /><small>$mc_fee<br />Net: {$c->getSymbol($mc_currency)}$total</small>";
			break;
		case "country":
			echo get_post_meta($post->ID,'residence_country',true);
			break;
		case "shipping_address":
			$address_name = get_post_meta($post->ID,'address_name',true);
			$address_state = get_post_meta($post->ID,'address_state',true);
			$address_status = get_post_meta($post->ID,'address_status',true);
			$address_country_code = get_post_meta($post->ID,'address_country_code',true);
			$address_country = get_post_meta($post->ID,'address_country',true);
			$address_city = get_post_meta($post->ID,'address_city',true);
			$address_zip = get_post_meta($post->ID,'address_zip',true);
			$address_street = get_post_meta($post->ID,'address_street',true);
			echo "$address_name<br />$address_street<br />$address_city, $address_state, $address_zip<br />$address_country<br />Status: $address_status";
			break;
		case "paypal":
			$mail = get_post_meta($post->ID,'payer_email',true);
			echo "<a href=\"mailto:$mail\">$mail</a>"; //set mailto link
			break;
		case "downloads":
			echo get_post_meta($post->ID,'downloads',true);
			break;
		case "password":
			echo get_post_meta($post->ID,'password',true);
			break;
		case 'downloadlink':
			$downloadlink = get_post_meta($post->ID,'downloadlink',true);
			echo ($downloadlink != '' ? "<a href=\"$downloadlink\">Download</a>" : 'N/A');
			echo '<hr />';
			$checkoutPage = esc_attr(get_option('ebook_store_checkout_page'));
			$link = add_query_arg(array('ebook_key' => get_post_meta($post->ID,'ebook_key',true), 'action' => 'thank_you'),get_permalink($checkoutPage));
			echo '<a href="' . $link . '">See Thank you page</a>';
			break;
		case 'formData':
			$md5_nonce = get_post_meta($post->ID,'md5_nonce',true);
			$data = get_post_meta($post->ID,'formData',true);		
			$data = json_decode($data);
			if ($data) {
			unset($data->md5_nonce);
				foreach ($data as $key => $value) {
					echo "<b>$key</b>: $value<br />";
				}

			}
			
			break;
	}
}
function ebook_readfile_chunked( $file, $retbytes = TRUE ) {
	$chunksize = 1 * (1024 * 1024);
	$buffer    = '';
	$cnt       = 0;
	$handle    = fopen( $file, 'r' );
	header('Cache-Control: no-store');

	if( $size = @filesize( $file ) ) header("Content-Length: " . $size );
	return readfile($file);
	//if ob_clean / flush are executed on some hosts, the file is not properly downloaded.

	if( $size = @filesize( $file ) ) header("Content-Length: " . $size );
	//wp_die($file);
    ob_clean();
    flush();
	return readfile($file);

	if ( $handle === FALSE ) return FALSE;

	while ( ! feof( $handle ) ) :
	$buffer = fread( $handle, $chunksize );
	echo $buffer;
	//ob_flush();
	//flush();

	if ( $retbytes ) $cnt += strlen( $buffer );
	endwhile;

	$status = fclose( $handle );

	if ( $retbytes AND $status ) return $cnt;

	return $status;
}
function ebook_get_file_ctype( $extension ) {
	switch( $extension ):
	case 'ac'       : $ctype = "application/pkix-attr-cert"; break;
	case 'adp'      : $ctype = "audio/adpcm"; break;
	case 'ai'       : $ctype = "application/postscript"; break;
	case 'aif'      : $ctype = "audio/x-aiff"; break;
	case 'aifc'     : $ctype = "audio/x-aiff"; break;
	case 'aiff'     : $ctype = "audio/x-aiff"; break;
	case 'air'      : $ctype = "application/vnd.adobe.air-application-installer-package+zip"; break;
	case 'apk'      : $ctype = "application/vnd.android.package-archive"; break;
	case 'asc'      : $ctype = "application/pgp-signature"; break;
	case 'atom'     : $ctype = "application/atom+xml"; break;
	case 'atomcat'  : $ctype = "application/atomcat+xml"; break;
	case 'atomsvc'  : $ctype = "application/atomsvc+xml"; break;
	case 'au'       : $ctype = "audio/basic"; break;
	case 'aw'       : $ctype = "application/applixware"; break;
	case 'avi'      : $ctype = "video/x-msvideo"; break;
	case 'bcpio'    : $ctype = "application/x-bcpio"; break;
	case 'bin'      : $ctype = "application/octet-stream"; break;
	case 'bmp'      : $ctype = "image/bmp"; break;
	case 'boz'      : $ctype = "application/x-bzip2"; break;
	case 'bpk'      : $ctype = "application/octet-stream"; break;
	case 'bz'       : $ctype = "application/x-bzip"; break;
	case 'bz2'      : $ctype = "application/x-bzip2"; break;
	case 'ccxml'    : $ctype = "application/ccxml+xml"; break;
	case 'cdmia'    : $ctype = "application/cdmi-capability"; break;
	case 'cdmic'    : $ctype = "application/cdmi-container"; break;
	case 'cdmid'    : $ctype = "application/cdmi-domain"; break;
	case 'cdmio'    : $ctype = "application/cdmi-object"; break;
	case 'cdmiq'    : $ctype = "application/cdmi-queue"; break;
	case 'cdf'      : $ctype = "application/x-netcdf"; break;
	case 'cer'      : $ctype = "application/pkix-cert"; break;
	case 'cgm'      : $ctype = "image/cgm"; break;
	case 'class'    : $ctype = "application/octet-stream"; break;
	case 'cpio'     : $ctype = "application/x-cpio"; break;
	case 'cpt'      : $ctype = "application/mac-compactpro"; break;
	case 'crl'      : $ctype = "application/pkix-crl"; break;
	case 'csh'      : $ctype = "application/x-csh"; break;
	case 'css'      : $ctype = "text/css"; break;
	case 'cu'       : $ctype = "application/cu-seeme"; break;
	case 'davmount' : $ctype = "application/davmount+xml"; break;
	case 'dbk'      : $ctype = "application/docbook+xml"; break;
	case 'dcr'      : $ctype = "application/x-director"; break;
	case 'deploy'   : $ctype = "application/octet-stream"; break;
	case 'dif'      : $ctype = "video/x-dv"; break;
	case 'dir'      : $ctype = "application/x-director"; break;
	case 'dist'     : $ctype = "application/octet-stream"; break;
	case 'distz'    : $ctype = "application/octet-stream"; break;
	case 'djv'      : $ctype = "image/vnd.djvu"; break;
	case 'djvu'     : $ctype = "image/vnd.djvu"; break;
	case 'dll'      : $ctype = "application/octet-stream"; break;
	case 'dmg'      : $ctype = "application/octet-stream"; break;
	case 'dms'      : $ctype = "application/octet-stream"; break;
	case 'doc'      : $ctype = "application/msword"; break;
	case 'docx'     : $ctype = "application/vnd.openxmlformats-officedocument.wordprocessingml.document"; break;
	case 'dotx'     : $ctype = "application/vnd.openxmlformats-officedocument.wordprocessingml.template"; break;
	case 'dssc'     : $ctype = "application/dssc+der"; break;
	case 'dtd'      : $ctype = "application/xml-dtd"; break;
	case 'dump'     : $ctype = "application/octet-stream"; break;
	case 'dv'       : $ctype = "video/x-dv"; break;
	case 'dvi'      : $ctype = "application/x-dvi"; break;
	case 'dxr'      : $ctype = "application/x-director"; break;
	case 'ecma'     : $ctype = "application/ecmascript"; break;
	case 'elc'      : $ctype = "application/octet-stream"; break;
	case 'emma'     : $ctype = "application/emma+xml"; break;
	case 'eps'      : $ctype = "application/postscript"; break;
	case 'epub'     : $ctype = "application/epub+zip"; break;
	case 'etx'      : $ctype = "text/x-setext"; break;
	case 'exe'      : $ctype = "application/octet-stream"; break;
	case 'exi'      : $ctype = "application/exi"; break;
	case 'ez'       : $ctype = "application/andrew-inset"; break;
	case 'f4v'      : $ctype = "video/x-f4v"; break;
	case 'fli'      : $ctype = "video/x-fli"; break;
	case 'flv'      : $ctype = "video/x-flv"; break;
	case 'gif'      : $ctype = "image/gif"; break;
	case 'gml'      : $ctype = "application/srgs"; break;
	case 'gpx'      : $ctype = "application/gml+xml"; break;
	case 'gram'     : $ctype = "application/gpx+xml"; break;
	case 'grxml'    : $ctype = "application/srgs+xml"; break;
	case 'gtar'     : $ctype = "application/x-gtar"; break;
	case 'gxf'      : $ctype = "application/gxf"; break;
	case 'hdf'      : $ctype = "application/x-hdf"; break;
	case 'hqx'      : $ctype = "application/mac-binhex40"; break;
	case 'htm'      : $ctype = "text/html"; break;
	case 'html'     : $ctype = "text/html"; break;
	case 'ice'      : $ctype = "x-conference/x-cooltalk"; break;
	case 'ico'      : $ctype = "image/x-icon"; break;
	case 'ics'      : $ctype = "text/calendar"; break;
	case 'ief'      : $ctype = "image/ief"; break;
	case 'ifb'      : $ctype = "text/calendar"; break;
	case 'iges'     : $ctype = "model/iges"; break;
	case 'igs'      : $ctype = "model/iges"; break;
	case 'ink'      : $ctype = "application/inkml+xml"; break;
	case 'inkml'    : $ctype = "application/inkml+xml"; break;
	case 'ipfix'    : $ctype = "application/ipfix"; break;
	case 'jar'      : $ctype = "application/java-archive"; break;
	case 'jnlp'     : $ctype = "application/x-java-jnlp-file"; break;
	case 'jp2'      : $ctype = "image/jp2"; break;
	case 'jpe'      : $ctype = "image/jpeg"; break;
	case 'jpeg'     : $ctype = "image/jpeg"; break;
	case 'jpg'      : $ctype = "image/jpeg"; break;
	case 'js'       : $ctype = "application/javascript"; break;
	case 'json'     : $ctype = "application/json"; break;
	case 'jsonml'   : $ctype = "application/jsonml+json"; break;
	case 'kar'      : $ctype = "audio/midi"; break;
	case 'latex'    : $ctype = "application/x-latex"; break;
	case 'lha'      : $ctype = "application/octet-stream"; break;
	case 'lrf'      : $ctype = "application/octet-stream"; break;
	case 'lzh'      : $ctype = "application/octet-stream"; break;
	case 'lostxml'  : $ctype = "application/lost+xml"; break;
	case 'm3u'      : $ctype = "audio/x-mpegurl"; break;
	case 'm4a'      : $ctype = "audio/mp4a-latm"; break;
	case 'm4b'      : $ctype = "audio/mp4a-latm"; break;
	case 'm4p'      : $ctype = "audio/mp4a-latm"; break;
	case 'm4u'      : $ctype = "video/vnd.mpegurl"; break;
	case 'm4v'      : $ctype = "video/x-m4v"; break;
	case 'm21'      : $ctype = "application/mp21"; break;
	case 'ma'       : $ctype = "application/mathematica"; break;
	case 'mac'      : $ctype = "image/x-macpaint"; break;
	case 'mads'     : $ctype = "application/mads+xml"; break;
	case 'man'      : $ctype = "application/x-troff-man"; break;
	case 'mar'      : $ctype = "application/octet-stream"; break;
	case 'mathml'   : $ctype = "application/mathml+xml"; break;
	case 'mbox'     : $ctype = "application/mbox"; break;
	case 'me'       : $ctype = "application/x-troff-me"; break;
	case 'mesh'     : $ctype = "model/mesh"; break;
	case 'metalink' : $ctype = "application/metalink+xml"; break;
	case 'meta4'    : $ctype = "application/metalink4+xml"; break;
	case 'mets'     : $ctype = "application/mets+xml"; break;
	case 'mid'      : $ctype = "audio/midi"; break;
	case 'midi'     : $ctype = "audio/midi"; break;
	case 'mif'      : $ctype = "application/vnd.mif"; break;
	case 'mods'     : $ctype = "application/mods+xml"; break;
	case 'mov'      : $ctype = "video/quicktime"; break;
	case 'movie'    : $ctype = "video/x-sgi-movie"; break;
	case 'm1v'      : $ctype = "video/mpeg"; break;
	case 'm2v'      : $ctype = "video/mpeg"; break;
	case 'mp2'      : $ctype = "audio/mpeg"; break;
	case 'mp2a'     : $ctype = "audio/mpeg"; break;
	case 'mp21'     : $ctype = "application/mp21"; break;
	case 'mp3'      : $ctype = "audio/mpeg"; break;
	case 'mp3a'     : $ctype = "audio/mpeg"; break;
	case 'mp4'      : $ctype = "video/mp4"; break;
	case 'mp4s'     : $ctype = "application/mp4"; break;
	case 'mpe'      : $ctype = "video/mpeg"; break;
	case 'mpeg'     : $ctype = "video/mpeg"; break;
	case 'mpg'      : $ctype = "video/mpeg"; break;
	case 'mpg4'     : $ctype = "video/mpeg"; break;
	case 'mpga'     : $ctype = "audio/mpeg"; break;
	case 'mrc'      : $ctype = "application/marc"; break;
	case 'mrcx'     : $ctype = "application/marcxml+xml"; break;
	case 'ms'       : $ctype = "application/x-troff-ms"; break;
	case 'mscml'    : $ctype = "application/mediaservercontrol+xml"; break;
	case 'msh'      : $ctype = "model/mesh"; break;
	case 'mxf'      : $ctype = "application/mxf"; break;
	case 'mxu'      : $ctype = "video/vnd.mpegurl"; break;
	case 'nc'       : $ctype = "application/x-netcdf"; break;
	case 'oda'      : $ctype = "application/oda"; break;
	case 'oga'      : $ctype = "application/ogg"; break;
	case 'ogg'      : $ctype = "application/ogg"; break;
	case 'ogx'      : $ctype = "application/ogg"; break;
	case 'omdoc'    : $ctype = "application/omdoc+xml"; break;
	case 'onetoc'   : $ctype = "application/onenote"; break;
	case 'onetoc2'  : $ctype = "application/onenote"; break;
	case 'onetmp'   : $ctype = "application/onenote"; break;
	case 'onepkg'   : $ctype = "application/onenote"; break;
	case 'opf'      : $ctype = "application/oebps-package+xml"; break;
	case 'oxps'     : $ctype = "application/oxps"; break;
	case 'p7c'      : $ctype = "application/pkcs7-mime"; break;
	case 'p7m'      : $ctype = "application/pkcs7-mime"; break;
	case 'p7s'      : $ctype = "application/pkcs7-signature"; break;
	case 'p8'       : $ctype = "application/pkcs8"; break;
	case 'p10'      : $ctype = "application/pkcs10"; break;
	case 'pbm'      : $ctype = "image/x-portable-bitmap"; break;
	case 'pct'      : $ctype = "image/pict"; break;
	case 'pdb'      : $ctype = "chemical/x-pdb"; break;
	case 'pdf'      : $ctype = "application/pdf"; break;
	case 'pki'      : $ctype = "application/pkixcmp"; break;
	case 'pkipath'  : $ctype = "application/pkix-pkipath"; break;
	case 'pfr'      : $ctype = "application/font-tdpfr"; break;
	case 'pgm'      : $ctype = "image/x-portable-graymap"; break;
	case 'pgn'      : $ctype = "application/x-chess-pgn"; break;
	case 'pgp'      : $ctype = "application/pgp-encrypted"; break;
	case 'pic'      : $ctype = "image/pict"; break;
	case 'pict'     : $ctype = "image/pict"; break;
	case 'pkg'      : $ctype = "application/octet-stream"; break;
	case 'png'      : $ctype = "image/png"; break;
	case 'pnm'      : $ctype = "image/x-portable-anymap"; break;
	case 'pnt'      : $ctype = "image/x-macpaint"; break;
	case 'pntg'     : $ctype = "image/x-macpaint"; break;
	case 'pot'      : $ctype = "application/vnd.ms-powerpoint"; break;
	case 'potx'     : $ctype = "application/vnd.openxmlformats-officedocument.presentationml.template"; break;
	case 'ppm'      : $ctype = "image/x-portable-pixmap"; break;
	case 'pps'      : $ctype = "application/vnd.ms-powerpoint"; break;
	case 'ppsx'     : $ctype = "application/vnd.openxmlformats-officedocument.presentationml.slideshow"; break;
	case 'ppt'      : $ctype = "application/vnd.ms-powerpoint"; break;
	case 'pptx'     : $ctype = "application/vnd.openxmlformats-officedocument.presentationml.presentation"; break;
	case 'prf'      : $ctype = "application/pics-rules"; break;
	case 'ps'       : $ctype = "application/postscript"; break;
	case 'psd'      : $ctype = "image/photoshop"; break;
	case 'qt'       : $ctype = "video/quicktime"; break;
	case 'qti'      : $ctype = "image/x-quicktime"; break;
	case 'qtif'     : $ctype = "image/x-quicktime"; break;
	case 'ra'       : $ctype = "audio/x-pn-realaudio"; break;
	case 'ram'      : $ctype = "audio/x-pn-realaudio"; break;
	case 'ras'      : $ctype = "image/x-cmu-raster"; break;
	case 'rdf'      : $ctype = "application/rdf+xml"; break;
	case 'rgb'      : $ctype = "image/x-rgb"; break;
	case 'rm'       : $ctype = "application/vnd.rn-realmedia"; break;
	case 'rmi'      : $ctype = "audio/midi"; break;
	case 'roff'     : $ctype = "application/x-troff"; break;
	case 'rss'      : $ctype = "application/rss+xml"; break;
	case 'rtf'      : $ctype = "text/rtf"; break;
	case 'rtx'      : $ctype = "text/richtext"; break;
	case 'sgm'      : $ctype = "text/sgml"; break;
	case 'sgml'     : $ctype = "text/sgml"; break;
	case 'sh'       : $ctype = "application/x-sh"; break;
	case 'shar'     : $ctype = "application/x-shar"; break;
	case 'sig'      : $ctype = "application/pgp-signature"; break;
	case 'silo'     : $ctype = "model/mesh"; break;
	case 'sit'      : $ctype = "application/x-stuffit"; break;
	case 'skd'      : $ctype = "application/x-koan"; break;
	case 'skm'      : $ctype = "application/x-koan"; break;
	case 'skp'      : $ctype = "application/x-koan"; break;
	case 'skt'      : $ctype = "application/x-koan"; break;
	case 'sldx'     : $ctype = "application/vnd.openxmlformats-officedocument.presentationml.slide"; break;
	case 'smi'      : $ctype = "application/smil"; break;
	case 'smil'     : $ctype = "application/smil"; break;
	case 'snd'      : $ctype = "audio/basic"; break;
	case 'so'       : $ctype = "application/octet-stream"; break;
	case 'spl'      : $ctype = "application/x-futuresplash"; break;
	case 'spx'      : $ctype = "audio/ogg"; break;
	case 'src'      : $ctype = "application/x-wais-source"; break;
	case 'stk'      : $ctype = "application/hyperstudio"; break;
	case 'sv4cpio'  : $ctype = "application/x-sv4cpio"; break;
	case 'sv4crc'   : $ctype = "application/x-sv4crc"; break;
	case 'svg'      : $ctype = "image/svg+xml"; break;
	case 'swf'      : $ctype = "application/x-shockwave-flash"; break;
	case 't'        : $ctype = "application/x-troff"; break;
	case 'tar'      : $ctype = "application/x-tar"; break;
	case 'tcl'      : $ctype = "application/x-tcl"; break;
	case 'tex'      : $ctype = "application/x-tex"; break;
	case 'texi'     : $ctype = "application/x-texinfo"; break;
	case 'texinfo'  : $ctype = "application/x-texinfo"; break;
	case 'tif'      : $ctype = "image/tiff"; break;
	case 'tiff'     : $ctype = "image/tiff"; break;
	case 'torrent'  : $ctype = "application/x-bittorrent"; break;
	case 'tr'       : $ctype = "application/x-troff"; break;
	case 'tsv'      : $ctype = "text/tab-separated-values"; break;
	case 'txt'      : $ctype = "text/plain"; break;
	case 'ustar'    : $ctype = "application/x-ustar"; break;
	case 'vcd'      : $ctype = "application/x-cdlink"; break;
	case 'vrml'     : $ctype = "model/vrml"; break;
	case 'vsd'      : $ctype = "application/vnd.visio"; break;
	case 'vss'      : $ctype = "application/vnd.visio"; break;
	case 'vst'      : $ctype = "application/vnd.visio"; break;
	case 'vsw'      : $ctype = "application/vnd.visio"; break;
	case 'vxml'     : $ctype = "application/voicexml+xml"; break;
	case 'wav'      : $ctype = "audio/x-wav"; break;
	case 'wbmp'     : $ctype = "image/vnd.wap.wbmp"; break;
	case 'wbmxl'    : $ctype = "application/vnd.wap.wbxml"; break;
	case 'wm'       : $ctype = "video/x-ms-wm"; break;
	case 'wml'      : $ctype = "text/vnd.wap.wml"; break;
	case 'wmlc'     : $ctype = "application/vnd.wap.wmlc"; break;
	case 'wmls'     : $ctype = "text/vnd.wap.wmlscript"; break;
	case 'wmlsc'    : $ctype = "application/vnd.wap.wmlscriptc"; break;
	case 'wmv'      : $ctype = "video/x-ms-wmv"; break;
	case 'wmx'      : $ctype = "video/x-ms-wmx"; break;
	case 'wrl'      : $ctype = "model/vrml"; break;
	case 'xbm'      : $ctype = "image/x-xbitmap"; break;
	case 'xdssc'    : $ctype = "application/dssc+xml"; break;
	case 'xer'      : $ctype = "application/patch-ops-error+xml"; break;
	case 'xht'      : $ctype = "application/xhtml+xml"; break;
	case 'xhtml'    : $ctype = "application/xhtml+xml"; break;
	case 'xla'      : $ctype = "application/vnd.ms-excel"; break;
	case 'xlam'     : $ctype = "application/vnd.ms-excel.addin.macroEnabled.12"; break;
	case 'xlc'      : $ctype = "application/vnd.ms-excel"; break;
	case 'xlm'      : $ctype = "application/vnd.ms-excel"; break;
	case 'xls'      : $ctype = "application/vnd.ms-excel"; break;
	case 'xlsx'     : $ctype = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; break;
	case 'xlsb'     : $ctype = "application/vnd.ms-excel.sheet.binary.macroEnabled.12"; break;
	case 'xlt'      : $ctype = "application/vnd.ms-excel"; break;
	case 'xltx'     : $ctype = "application/vnd.openxmlformats-officedocument.spreadsheetml.template"; break;
	case 'xlw'      : $ctype = "application/vnd.ms-excel"; break;
	case 'xml'      : $ctype = "application/xml"; break;
	case 'xpm'      : $ctype = "image/x-xpixmap"; break;
	case 'xsl'      : $ctype = "application/xml"; break;
	case 'xslt'     : $ctype = "application/xslt+xml"; break;
	case 'xul'      : $ctype = "application/vnd.mozilla.xul+xml"; break;
	case 'xwd'      : $ctype = "image/x-xwindowdump"; break;
	case 'xyz'      : $ctype = "chemical/x-xyz"; break;
	case 'zip'      : $ctype = "application/zip"; break;
	default         : $ctype = "application/force-download";
	endswitch;

	return apply_filters( 'ebook_file_ctype', $ctype );
}
function ebook_process_download($data = false) {
	$QSWPOptions = new QSWPOptions();
	if ($data) {
		extract($data);
	}
	ini_set('display_errors',0);
	error_reporting(0);

	$formats = array('mobi','txt','epub','zip', 'mp3','mp4');
	if (@$_GET['wc_order'] != '') {
		$formats[] = 'pdf';
	}
	if ((@$_REQUEST['ebook_key'] != false && $_REQUEST['action'] == 'download') || (@$_REQUEST['action'] == 'wc_order_download')) {
		//error_reporting(E_ALL);
		if( function_exists( 'apache_setenv' ) ) @apache_setenv('no-gzip', 1);
		@ini_set( 'zlib.output_compression', 'Off' );
		nocache_headers();
		$loop = new WP_Query( array ( 'post_type' => 'ebook_order', 'meta_key' => 'ebook_key', 'meta_value' => @$_REQUEST['ebook_key'] ) );
		//wp_die(var_export($loop));
		while ( $loop->have_posts() ) : $loop->the_post();
		//return get_post_meta(get_the_ID(),'ebook_key',true);
		$order_id = get_the_ID();
		$ebook = get_post_meta(get_the_ID(),'ebook',true);
		endwhile;

		if (@$_REQUEST['action'] == 'wc_order_download') {
			$order_id = (int)$_GET['order_id'];
			$ebook_id = (int)$_GET['ebook_id'];
			$ebook = $ebook_id;
		}
		if (@$_REQUEST['action'] == 'download' && @$_REQUEST['type'] == 'bonus') {
			$ebook_id = (int)$_GET['ebook_id'];
			$ebook = $ebook_id;			
			$ebookObj = new EbookStoreEbook($ebook);
			$requested_file = $ebookObj->encrypted((int)$_GET['order_id'], 'pdf');
			
		}
		$attachment = get_post_meta($ebook,'ebook_wp_custom_attachment');
		//wp_die(print_r($attachment,true));
		if (@!$requested_file) { 
			$requested_file = $attachment[0]['file'];
		}

		if (get_post_meta($order_id,'encrypted_pdf',true) == 'in_progress') {
			if (!ebook_store_encryptable($requested_file)) {
				wp_die('The uploaded file is not in the proper format and can not be encrypted, please re-upload it in Acrobat 5.0 PDF 1.5 Compatibility mode or disable encryption. See video tutorial here: <a href="https://youtu.be/-yDr-76W4gk" target="_blank">https://youtu.be/-yDr-76W4gk</a>');
			}
			if (get_option('ebook_store_no_autorefresh', false) == false) {
			wp_die('<h3>Your copy is being generated right now, the page will refresh automatically and the download will start shortly...</h3><script type="text/javascript">
			    setInterval(\'window.location.reload()\', 15000);
				</script>');	
			} else {
				wp_die("Your copy is being generated right now, please try again by refreshing the page in a few minutes or by clicking <a href='#' onClick='window.location.reload();' id='retryLink'>retry download</a>
					");
			}
			
		}
		if (get_post_meta($order_id,'encrypted_pdf',true) != '' && $_REQUEST['type'] != 'bonus') {
			$requested_file = get_post_meta($order_id,'encrypted_pdf',true);
		}
		if (@in_array($_GET['format'], $formats)) {
			$format_meta_tag = 'ebook_wp_custom_attachment' . (@$_GET['format'] != 'pdf' ? '_' . $_GET['format'] : '');
			$attachment = get_post_meta($ebook,$format_meta_tag);
			//wp_die(print_r($attachment,true));
			$requested_file = $attachment[0]['file'];
			if (@$_GET['wc_order'] != '') {
				$wc_order = sanitize_text_field($_GET['wc_order']);
				$ebookObj = new EbookStoreEbook($ebook);
				$requested_file = $ebookObj->encrypted((int)$_GET['order_id'], $_GET['format']);
			}
		}
		$ctype = ebook_get_file_ctype(pathinfo($requested_file,PATHINFO_EXTENSION));
		$downloads = get_post_meta($order_id,'downloads',true);
		//wp_die('Downloads ' . $downloads);
		if ($downloads >= esc_attr(get_option('downloads_limit',$QSWPOptions->downloads_limit))) {
			wp_die('Oops, you have reached the maximum amount of downloads for this order, you need to order again.');
		}
		// $gmt_timestamp = get_post_time();
		// if (!$gmt_timestamp) {
		// 	$gmt_timestamp = get_post_time('U', false, (int)$_GET['order_id']);
		// }
		//wp_die("GMT timestamp $gmt_timestamp, time " . time() . ' post id ' . get_the_ID());


		$gmt_timestamp = get_post_time('U', false, ($order_id > 0 ? $order_id : get_the_ID()));
		if (!$gmt_timestamp) {
			$gmt_timestamp = get_post_time('U', false, (int)$_GET['order_id']);
		}


		$strtotime = strtotime("+" . get_option('link_expiration', $QSWPOptions->link_expiration),$gmt_timestamp);

		if (WP_DEBUG == true) {
			//error_log("strtotime $strtotime vs time " . time() . ' vs GMT TIMESTAMP ' . $gmt_timestamp);
		}
		if ($strtotime < time()) {
			wp_die('Oops, the link you are using has expired, you need to order again.');
		}

		if (!file_exists($requested_file) && @$_REQUEST['action'] != 'wc_order_download') {
			wp_die('Sorry, the ebook file was not found for that order, may be it expired?');
		}

		header("Robots: none");
		header("Content-Type: " . $ctype . "");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=\"" . apply_filters( 'ebook_requested_file_name', basename( $requested_file ) ) . "\";");
		header("Content-Transfer-Encoding: binary");
		ebook_readfile_chunked($requested_file);
		ebook_count_download($order_id);
		die();
		//endwhile;
	} else if (@$_REQUEST['action'] == 'download_free') {

		@$formData = ebook_store_get_form($_REQUEST['md5_nonce']);
		if (is_object($formData)) {
			if ($formData->email != '') {
				ebook_store_get_mailchimp_subscribe($formData->email);
			}
			if ($formData->payer_email != '') {
				ebook_store_get_mailchimp_subscribe($formData->payer_email);
			}
		}
		error_reporting(0);
		ini_set('display_errors', 0);
		
		//die(print_r($formData,true));
		
		$id = $_REQUEST['p'];
		$loop = new WP_Query( array ( 'post_type' => 'ebook', 'p' => $id ) );
		

		

		while ( $loop->have_posts() ) : $loop->the_post();
			$attachment = get_post_meta($id,'ebook_wp_custom_attachment');
			$ebook = get_post_meta(get_the_ID(), 'ebook', true);

			if (get_option('encrypt_pdf') == 1) {
				if (!ebook_store_encryptable($attachment[0]['file'])) {
					echo('The uploaded file is not in the proper format, please re-upload it in Acrobat 5.0 PDF 1.5 Compatibility mode. See video tutorial here: <a href="https://youtu.be/-yDr-76W4gk" target="_blank">https://youtu.be/-yDr-76W4gk</a>');
				}
			}
			//die();
			if ($ebook['ebook_price'] == 0) {
				$ebook['donate_or_download'] = 'free';
			}
			if ($ebook['ebook_price'] > 0 && $ebook['donate_or_download'] != 'free') {
				wp_die('You are trying to download a file that is not free - ' . get_the_title());
			}
			$status = get_post_status();
			erl($status);

			if ($status != 'publish') {
				wp_die('You are trying to download a file that is not available.');
			}
			
			$requested_file = $attachment[0]['file'];

			$ctype = ebook_get_file_ctype(pathinfo($requested_file,PATHINFO_EXTENSION));
			$gmt_timestamp = get_post_time('U');
			//insert order
			$my_post = array(
			  'post_title'    => 'Free Download',
			  'post_type'	  => 'ebook_order',
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_category' => array(8,39));
			$post_id = wp_insert_post( $my_post, @$wp_error );
			//txn_id payment_date payer_email
			//encrypt here.
			global $current_user;
		    get_currentuserinfo();
		    $data = array();

			$data['txn_id'] = 'free';
			//$data['payment_date'] = date("F j, Y, g:i a");
			$data['payment_date'] = current_time('mysql');



			if (get_option('encrypt_files_for_logged_in_users') == 1) {
				$data['payer_email'] = $current_user->user_email;
			} else {
				$data['payer_email'] = '';
				if (@$formData->email != '') {
					$data['payer_email'] = $formData->email;
				}
			}
			
			if ($formData->payer_email != '') {
				$data['payer_email'] = $formData->payer_email;
			}
			
			//error_log(print_r($formData,true));
			

			$data['first_name'] = $current_user->user_firstname;
			$data['last_name'] = $current_user->user_lastname;
			$data['mc_currency'] = '';
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
			$data['residence_country'] = 'n/a';
			//error_log('data ' . print_r($data,true));
			if ($data['first_name'] == '') {
				if ($formData->name != '') {
					$data['first_name'] = $formData->name;
					$data['last_name'] = '';
				} else if ($formData->first_name != '') {
					$data['first_name'] = $formData->first_name;
					$data['last_name'] = $formData->last_name;
				} else {
					$data['first_name'] = 'Anonymous';
					$data['last_name'] = 'User';

				}
			}
			
			
			//wp_die($data['payer_email']);

			global $attachment;
			@$attachment[0]['file'] = $requested_file;

			$fileExt = pathinfo($attachment[0]['file'],PATHINFO_EXTENSION);
			if ($fileExt == 'pdf' && get_option('encrypt_pdf')) {
				//ebook_encrypt_pdf($data, $post_id);
				$requested_file = ebook_encrypt_pdf($data, $post_id);
			}

			$md5_nonce = strip_tags($_REQUEST['md5_nonce']);
			$formData = ebook_store_get_form($md5_nonce);
			$formData = json_encode($formData);
			$item_name = get_the_title((int)$_REQUEST['p']);
			//die($item_name);
			update_post_meta($post_id,'ebook_key',$md5_nonce);
			update_post_meta($post_id,'downloads',1);
			update_post_meta($post_id,'formData',wp_slash($formData));
			update_post_meta($post_id,'downloadlink',"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
			update_post_meta($post_id,'ebook',(int)$_REQUEST['p']);
			update_post_meta($post_id,'item_name',$item_name);
			update_post_meta($post_id,'payer_email',(@$data['payer_email'] != '' ? $data['payer_email'] : 'N/A'));
			update_post_meta($post_id,'mc_gross',0);
			update_post_meta($post_id,'mc_fee',0);
			update_post_meta($post_id,'payment_date',date("F j, Y, g:i a"));
			foreach ($data as $dk => $dv) {
				update_post_meta($post_id,$dk,$dv);
			}
			//get_post_meta($post->ID,'item_name',true)
			//insert order end
			if (headers_sent()) {
				die('Sorry, headers sent.');
			}
			$checkoutPage = esc_attr(get_option('ebook_store_checkout_page'));
			if (!$checkoutPage) {
				$checkoutPage = $post_id;
			}
			update_post_meta($post_id,'encrypted_pdf',wp_slash($requested_file));
			header("Location: ". add_query_arg(array('ebook_key' => $md5_nonce, 'action' => 'thank_you'),get_permalink($checkoutPage)));
			
			// header("Robots: none");
			// header("Content-Type: " . $ctype . "");
			// header("Content-Description: File Transfer");
			// header("Content-Disposition: attachment; filename=\"" . apply_filters( 'ebook_requested_file_name', basename( $requested_file ) ) . "\";");
			// header("Content-Transfer-Encoding: binary");
			// ebook_readfile_chunked($requested_file);
		endwhile;
		die();
	} else if ($_REQUEST['action'] == 'ebook_bonus_download') {
		$ebook_id = (int)$_GET['ebook_id'];
		$ebook_key = $_GET['ebook_key'];
		$data['ebook'] = get_post_meta($ebook_id, 'ebook_bonus', true);
		$ebook_order_meta = ebook_get_order('ebook_key',$ebook_key);
		$data['txn_id'] = 'Bonus Download (' . $ebook_order_meta['item_name'][0] . ')';
		// wp_die(print_r($ebook_order_meta));
		$data['payer_email'] = $ebook_order_meta['payer_email'][0];
		$data['first_name'] = 'Bonus';
		$data['last_name'] = 'Download (Order #' . $ebook_order_meta['order_id'][0] . ')';
		ebook_store_add_order($data, true);
		@$ebook_order['ebook_key'][0] = $ebook_key;
		@$ebook_order['ebook'][0] = $data['ebook'];
		$downloadlink = ebook_download_link($ebook_order, 0, 1);
		header("Location: " . $downloadlink); //add proper ebook id here and allow it.
		//wp_die($downloadlink);
	}
}
function ebook_count_download($order_id) {
	$downloads = get_post_meta($order_id,'downloads',true);
	return update_post_meta($order_id,'downloads',floatval($downloads) + 1);
}
function ebook_get_order($key = 'ebook_key',$val = '') {
	$loop = new WP_Query( array ( 'post_type' => 'ebook_order', 'meta_key' => $key, 'meta_value' => $val ) );
	while ( $loop->have_posts() ) : $loop->the_post();
	$meta = get_post_meta(get_the_ID(),null,true);
	$meta['order_id'][0] = get_the_ID();
	@$meta['total'][0] = number_format(round($meta['mc_gross'][0] + $meta['tax'][0],2),2);
	return $meta;
	endwhile;
}

function toMoney($val,$symbol='',$r=2)
{


    return number_format($val,2);

}

function ebook_email_delivery($post_id = null) {
	$QSWPOptions = new QSWPOptions();
	global $ebook_email_delivery, $formData;
	if (@$ebook_email_delivery['done'] == 1) {
		return;
	}
	$ebook_email_delivery['done'] = 1;

	if (isset($formData)) {
		$formData = (array)json_decode($formData);
	}
	
	// error_log(var_export(debug_backtrace(),true));
	$ebook_email_delivery['order']['download_links'] = implode("<br />",ebook_download_links($ebook_email_delivery['order']));
	$ebook_email_delivery['order']['downloadlinks'] = implode("<br />",ebook_download_links($ebook_email_delivery['order']));
	$ebook_email_delivery['order']['ebook_bonus'] = (implode("<br />",ebook_download_links_bonus($ebook_email_delivery['order'])) != '' ? implode("<br />",ebook_download_links_bonus($ebook_email_delivery['order'])) : __('None','ebook-store'));
	
	if (@$ebook_email_delivery['order']['total'] == false) {
		@$ebook_email_delivery['order']['total'] = $ebook_email_delivery['order']['mc_gross'] + $ebook_email_delivery['order']['tax'];
	}
	
	@$ebook_email_delivery['order']['total'] = toMoney(@$ebook_email_delivery['order']['total']);
	@$ebook_email_delivery['order']['tax'] = toMoney(@$ebook_email_delivery['order']['tax']);
	
	@$attachmentFile = $ebook_email_delivery['attachment'][0]['file'];
	$ebook_email_delivery['order']['filesize'] = ebook_store_human_filesize(filesize($attachmentFile)); 
	if (get_option('attach_files') != 1) {
		$attachmentFile = null;
	}
	
	
	//error_reporting(E_ALL);
	foreach ($ebook_email_delivery['order'] as $k => $v) {
		if (is_array($v)) {
			$v = $v[0];
		}
		$ebook_email_delivery['text'] = str_replace('%%' . $k . '%%', $v, $ebook_email_delivery['text']);
	}

	
	$ebook_email_delivery['text'] = nl2br($ebook_email_delivery['text']);
	//$ebook_email_delivery['text'] = apply_filters('the_content',$ebook_email_delivery['text']);
	//error_log('ebook_email_delivery ' . print_r($ebook_email_delivery,true));
	add_filter( 'wp_mail_content_type', 'ebook_set_content_type' );
	if (floatval(get_option('email_delivery',$QSWPOptions->email_delivery)) == 1) {
		//echo "Sending mail, data: " . implode("; ", $ebook_email_delivery);
		if (floatval(get_option('kindleDelivery',$QSWPOptions->kindleDelivery)) == 1) {
			if (strpos($formData['kindle_email'], '@kindle.com')) {
			// if (1) {
				$formData['kindle_email'] = filter_var($formData['kindle_email'], FILTER_VALIDATE_EMAIL);
				$ebook_email_delivery['to'] = $formData['kindle_email'];
			} else {
				return true; //not a kind
			}
		}
		if (@$formData['gift_email']) {
			$formData['gift_email'] = filter_var($formData['gift_email'], FILTER_VALIDATE_EMAIL);
			$ebook_email_delivery['to'] = $formData['gift_email'];
		}
		$headers = array('Content-Type: text/html; charset=UTF-8');
		
		wp_mail($ebook_email_delivery['to'],$ebook_email_delivery['subject'], $ebook_email_delivery['text'],$headers,$attachmentFile);
	}
}

function ebook_set_content_type( $content_type ){
	return 'text/html';
}
function ebook_attachment($post_id, $ignoreSetting = false) {
	if (get_option('attach_files') == 1 || $ignoreSetting == true) {
		$attachment = get_post_meta($post_id,'ebook_wp_custom_attachment');
		if (WP_DEBUG == true) error_log('attachment - ' . print_r($attachment,true));
		return $attachment;
	}
}
function ebook_encrypt_pdf($r = null, $post_id = null) {
	//@ini_set('display_errors',1);
	//@error_reporting(E_ALL);
	if ($r == false) {
		$r = $_REQUEST;
	}

	global $ebook_email_delivery, $ebook_qr_text, $ebook_png_path, $ebook_pngname, $attachment, $pdfHeaderText;
	global $ebook_store_random_password;
	// require_once('fpdi/FPDF-master/fpdf.php');
	// require_once('fpdi/FPDI-master/src/autoload.php');
	// require_once('fpdi/fpdi-protection-master/src/autoload.php');
	require_once('fpdi/qrcode.class.php');
	$ebook_qr_text = "Txn: " . $r['txn_id'] . ' Date: ' . $r['payment_date'] . ' Buyer:' . $r['payer_email'] . ' IP: ' . $_SERVER['REMOTE_ADDR'];
	$pdfHeaderText = esc_attr(get_option('buyer_info_text'));

	foreach ($r as $k => $v) {
		$pdfHeaderText = str_replace("%%$k%%", $v, $pdfHeaderText);
	}
	$qrclass = new QRClass;
	$path = $qrclass->text($ebook_qr_text, 100, 100);
	$ebook_pngname = md5($path) . '.png';
	$ebook_png_path = plugin_dir_path( __FILE__ ) . '/cache/' . $ebook_pngname;
	$qrclass->save($path, $ebook_png_path);
	//
	if (@is_array($attachment)) {
		@$file = $attachment[0]['file'];
	}
	if (@!$file) {
		$file = $ebook_email_delivery['attachment'][0]['file'];
	}
	$password = $r['payer_email'];
	if (get_option('ebook_store_random_password') == 1) {
		if ($ebook_store_random_password != '') {
			$r['password']	= $ebook_store_random_password;
		}
		if (@$r['password'] != '') {
			$password = $r['password'];
		} 
	}

	if (get_option('ebook_store_blank_password') == 1) {
		$r['password'] = '';
		$password = '';
	}
	//random password for non logged in users
	if (!is_user_logged_in() && get_option('formEnabled') < 1) {
	    if (get_option('ebook_store_random_password') == 1) {
	        $password = substr(md5(rand()),0,8);
	        //$password = 'proba';
	        $ebook_store_random_password = $password;
	        if ($post_id != null) {
	        	@update_post_meta($post_id,'password',$password);
	        } 
	        
	        // Additional code to handle the generated password
	    }
	}
	if (is_user_logged_in()) {
	    if (get_option('ebook_store_random_password') == 1) {
	        $password = substr(md5(rand()),0,8);
	        //$password = 'proba';
	        $ebook_store_random_password = $password;
	        if ($post_id != null) {
	        	@update_post_meta($post_id,'password',$password);
	        } 
	        
	        // Additional code to handle the generated password
	    } else {
	    	if (get_option('ebook_store_blank_password') < 1) {
		    	$current_user = wp_get_current_user();
		    	$password = $current_user->user_email;
		    	if ($post_id != null) {
		        	@update_post_meta($post_id,'password',$password);
		        } 
	    	}
	    }		
	}
	//wp_die($password . ' post id ' . $post_id);
	//error_log('password ' . $password);

	$owner_password = esc_attr(get_option('ebook_store_owner_password'));

	@mkdir(plugin_dir_path( __FILE__ ) . 'cache/' . md5($path), 0755, true);
	$destfile = plugin_dir_path( __FILE__ ) . 'cache/' . md5($path) . '/' . basename($file);
	
	// error_log('encrypting ' . $file);


	update_post_meta(@$ebook_email_delivery['order']['order_id'],'encrypted_pdf','in_progress');
	$pdf = new QRPDF();
	//$pdf->FPDF('P', 'in', 'a4');
	try {
		$pagecount = $pdf->setSourceFile($file);	
	} catch (Exception $e) {
		wp_die("Please make sure the PDF you are trying to encrypt is in PDF 1.4 Acrobat 5.0 format or disable encryption. Exact error: " . $e->getMessage());
	}
	$pagecount = $pdf->setSourceFile($file);

	for ($loop = 1; $loop <= $pagecount; $loop++) {
		$tplidx = $pdf->importPage($loop);
		$size = $pdf->getTemplateSize($tplidx);
		// if ($size['w'] > $size['h']) {
	        $pdf->AddPage($size['orientation'], $size);
	    // } else {
	    //     $pdf->AddPage('P', array($size['w'], $size['h']));
	    // }		
		$pdf->useTemplate($tplidx);
	}


	$protection = array();
	$protection['print'] = 'print';
	$protection['annot-forms'] = 'annot-forms';
	$protection['copy'] = 'copy';
	$protection['modify'] = 'modify';

	if (get_option('disable_pdf_printing') == 1) {
		unset($protection['print']);
	}
	if (get_option('disable_annot-forms') == 1) {
		unset($protection['annot-forms']);	
	}
	if (get_option('disable_pdf_copy') == 1) {
		unset($protection['copy']);
	}
	if (get_option('disable_pdf_modify') == 1) {
		unset($protection['modify']);
	}
	$pdf->SetProtection((array)$protection, $password, $owner_password);
	
	$pdf->Output($destfile, 'F');
	update_post_meta(@$ebook_email_delivery['order']['order_id'],'encrypted_pdf',wp_slash($destfile));
	//make sure enc file is attached
	//file_put_contents('ebook-store-password-debug.txt', $password . "\n" . print_r($r, true), FILE_APPEND);

	$ebook_email_delivery['attachment'][0]['file'] = $destfile;
	$isPdf = true;
	return $destfile;
} 
function ebook_store_missing_gd() {
    ?>
    <div class="updated">
        <p><?php _e( 'Your hosting provide is missing GD PNG support, please contact your provider to enable GD in order to be able to process PNG files.', 'ebook-store' ); ?></p>
    </div>
    <?php
}
function ebook_store_admin_notice() {
    ?>
    <div class="updated">
        <p><?php _e( 'You need to create a "Thank you" landing page with the text/shortcode <input type="text" size=20 value="[ebook_thank_you]" />, where you want the "Thank You" page content to appear, then select that page in Ebook Store options under Settings menu.
<br />
<p class="submit"><input type="button" name="button" id="button" class="button button-primary" value="Fix automatically" onClick="window.location = \'options-general.php?page=ebook_options.php&task=fixThankYouPage\';"></p>
        ', 'ebook-store' ); ?></p>
    </div>
    <?php
}
function ebook_store_admin_notice_paypal() {
    ?>
    <div class="updated">
        <p><?php _e( 'You have not yet filled in your <b>PayPal account</b>. Please do that in <a href="options-general.php?page=ebook_options.php&tab=PayPal">Settings > Ebook Store > PayPal</a> in order to be able to receive payments.', 'ebooks-store' ); ?></p>
    </div>
    <?php
}

function ebook_store_set_messages($messages) {
	global $post, $post_ID;
	$post_type = get_post_type( $post_ID );

	$obj = get_post_type_object($post_type);
	$singular = $obj->labels->singular_name;
	if ($post_type == 'ebook') {
		$messages[$post_type][1] = 'Ebook has been saved! Now copy and paste this code in the article / page where you want the ebook order form to appear: <input onClick="" type="text" size=30 value=\'[ebook_store ebook_id="' . $post_ID . '"]\'>';
	}
	return $messages;
}
function ebook_store_remove_parmelink( $return ) {
	if (@$post_id == false) {
		$post_id = get_the_ID();
	}
	if ('ebook' === get_post_type( $post_id )) {
		$return = '';
	}
    return $return;
}

function ebook_admin_css() {
    global $post_type;
    $post_types = array(
                        /* set post types */
                        'ebook',
                  );
    if(in_array($post_type, $post_types))
    echo '<style type="text/css">#post-preview, #view-post-btn{display: none;}</style>';
}
function ebook_store_set_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'cover' => __( 'Cover', 'ebook-store' ),
		'title' => __( 'Book Title', 'ebook-store' ),
		//'duration' => __( 'Duration' ),
		//'genre' => __( 'Genre' ),
		'date' => __( 'Date', 'ebook-store' ),
		'price' => __( 'Price', 'ebook-store' ),
		'formats' => __( 'Formats', 'ebook-store' ),
		'sales' => __( 'Sales', 'ebook-store' ),
		'embed_code' => __('Embed Code for posts and pages', 'ebook-store')
	);

	return $columns;
}

function ebook_store_columns_output( $column, $post_id ) {
	global $post;
	$ebook = new EbookStoreEbook($post_id);
	switch( $column ) {

		/* If displaying the 'duration' column. */
		
		case 'embed_code':
		echo '[ebook_store ebook_id="' . $post_id . '"]<hr />' . __('Direct Order Link', 'ebook-store') .':<br />';
		$order_url = get_permalink($post_id);
		$order_url = add_query_arg( 'task', 'direct_order', $order_url );

		echo '<input type="text" style="width:100%;" value="' . $order_url . '" onClick="this.select();" />';
		break;
		case 'sales':
		$c = new Currencies();
		$total = $c->getSymbol(get_option('paypal_currency','USD')) . number_format(ebook_store_stats($post_id, 0),2);
		$week = $c->getSymbol(get_option('paypal_currency','USD')) . number_format(ebook_store_stats($post_id, 7),2);
		$month = $c->getSymbol(get_option('paypal_currency','USD')) . number_format(ebook_store_stats($post_id, 30.4),2);
		echo __('Total', 'ebook-store').": $total<br />" . __('7 Days', 'ebook-store') . ": $week<br />" . __('30 Days', 'ebook-store') . ": $month";
		break;
		case 'price':
		$ebook = get_post_meta(get_the_ID(), 'ebook', true);
		$c = new Currencies();
		if ($ebook == false) { echo '-'; break; }
		echo $c->getSymbol(get_option('paypal_currency','USD')) . number_format((float)$ebook['ebook_price'],2);
		break;
		case 'cover':
		$cover = @get_post_meta(get_the_ID(), 'ebook_wp_custom_attachment_cover', true);
		$cover = is_array($cover) ? $cover  : array();
		if (!@$cover['url']) {
			$cover['url'] = plugins_url( 'images/no-cover.png', dirname(__FILE__) );	
			$cover = "N/A";
		} else {
			$cover = "<img src=\"{$cover['url']}\" style=\"max-width:100px;\" />
<style>
.column-cover {
	width:120px;
}
</style>
			";
		}
		
		echo $cover;

		break;
		case 'formats':

		if (is_array($ebook->files)) {
			foreach (array_keys($ebook->files) as $key => $value) {
				if (strpos($value, '_size') == false) {
					$format = $value;
					$value = plugins_url( 'img/'.$value.'.png', __FILE__ );
					$value = '<img title="'. basename($ebook->files["$format"]) . ' ' . $ebook->human_filesize($ebook->files["$format" . "_size"]) . '" width=64 src="'.$value.'" />';
					@$formats_found[] =  $value;
				}
			}			
			echo @implode('', $formats_found);
		}

		
		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

function ebook_store_pre_get_shortlink( $false, $post_id ) {
     return 'ebook' === get_post_type( $post_id ) ? '' : $false;
}
function ebook_mime_types($mime_types){
    $mime_types['epub'] = 'application/octet-stream';
    $mime_types['mobi'] = 'application/octet-stream';
    $mime_types['txt'] = 'text/plain';
    $mime_types['mp3'] = 'audio/mpeg';

    return $mime_types;
}
function ebook_store_formContent() {
	if (@$_REQUEST['task'] == 'formContent') {
		// if (get_option('ebook_store_wpforms_default_form_force') == 1 && get_option('ebook_store_wpforms_default_form') > 0) {
		// 	wpforms_display( get_option('ebook_store_wpforms_default_form'), true, true );
		// 	//show WPForm
		// 	return true;
		// 	//die();
		// }//else show standard

		echo get_option('formContent');
		die();
	} else if (@$_REQUEST['task'] == 'ebook_store_form_input') {
		ebook_store_save_form($_POST['md5_nonce'],$_POST);
	}
}
function ebook_store_save_form($md5_nonce, $data) {
foreach ($data as $k => $v) {
			@$json[$k] = $v; 
		}
		$json = json_encode($json);
		file_put_contents(get_temp_dir() . '/ebook_store_form_' . $md5_nonce , $json);
		header("HTTP/1.1 200 OK");
		die();
}
function ebook_store_get_form($md5_nonce){ 
	//error_log('TEMP dir ' . get_temp_dir());
	@$formData = file_get_contents(get_temp_dir() . '/ebook_store_form_' . $md5_nonce);
	if ($formData) {
		return json_decode($formData);
	} else {
		return false;
	}
}
function ebook_store_get_mailchimp_lists() {
	$api_key = esc_attr(get_option('mailchimp_api_key'));
	$rest = '{
    "apikey": "' . $api_key . '"
}';
	if (!$api_key) {
		return false;
	}
	$dcurl = "https://" . substr($api_key, strpos($api_key, '-')+1) . ".api.mailchimp.com/2.0/lists/list.json?apikey=" . $api_key;

	// error_reporting(E_ALL);
	// ini_set('display_errors',1);
	
	$content = file_get_contents($dcurl);
	//wp_die($dcurl);//
	$out = json_decode($content);
	//print_r($out);
	return (array)$out->data;
}
function ebook_store_get_mailchimp_subscribe($email) {
	//error_log('MAILCHIMP Subscribing ' . $email);
	if (get_option('mailchimp_lists') == '') {
		return false;
	}
	$api_key = esc_attr(get_option('mailchimp_api_key'));
	$rest = '{
    "apikey": "' . $api_key . '"
}';
	if (!$api_key) {
		return false;
	}
	$dcurl = "https://" . substr($api_key, strpos($api_key, '-')+1) . ".api.mailchimp.com/2.0/lists/subscribe.json?apikey=" . $api_key . "&id=" . get_option('mailchimp_lists') . "&double_optin=false&email[email]=" . $email;
	//error_log($dcurl);
	return file_get_contents($dcurl);
}
function ebook_wp_embed_ebook() {
	wp_enqueue_script( 'ebook_store_settings', plugins_url( '/js/ebook_store_settings.js' , __FILE__ ), array(), '1.0.0', true );
	?>
	<div class="ebook_store_embed_all_items" style=" display:inline-block; clear:both; max-height:200px; overflow-x:auto; width:100%;">
	<?php
	$new = new WP_Query('post_type=ebook');
	while ($new->have_posts()) : $new->the_post();
	@$ebooks_found++;
	$img_cover = get_post_meta(get_the_ID(), 'ebook_wp_custom_attachment_cover', true);
	$ebook = get_post_meta(get_the_ID(), 'ebook', true);
	$c = new Currencies();
	$price = $c->getSymbol(get_option('paypal_currency','USD')) . number_format((float)$ebook['ebook_price'],2)
		?>
		<div class="ebook_store_embed_ebook_item" style="width:100%; clear:both;">
			<?php
			if (!is_array($img_cover)) {
				$img_cover = array();
			}
			if (@$img_cover['url'] != '') {
			?><img src="<?php echo $img_cover['url']; ?>" onClick="ebook_store_embed_code(<?php echo get_the_ID(); ?>);" style="background:gray; width:45px; height:65px; float: left; margin:10px; cursor: pointer; cursor: hand;" />
			<?php
			} else {
				?>
					<div style="background:gray; width:45px; height:65px; float: left; margin:10px;" onClick="ebook_store_embed_code(<?php echo get_the_ID(); ?>);"></div>
				<?php
			}

			?><span class="ebook_store_embed_ebook_item_title" style="margin-top: 11px;display: inline-block;">
				<a href="javascript:void(0);" onClick="ebook_store_embed_code(<?php echo get_the_ID(); ?>);" title="Click to embed this ebook in the post"><b><?php echo get_the_title() ?></b></a>
				<a href="post.php?post=<?php echo get_the_ID(); ?>&action=edit" title="Click to edit this ebook in a new window." target="_blank"><small>[Edit]</small></a>
				<br />Form: <input  onClick="this.select()" readonly type="text" size="29" value='[ebook_store ebook_id="<?php echo get_the_ID(); ?>"]' />
				<label style="white-space: nowrap;">Buy Button Only: <input onClick="this.select()" readonly type="text" size="29" value='[ebook_store_buy ebook_id="<?php echo get_the_ID(); ?>"]' /></label>

			</span>
			<p>
				Price: <?php echo $price; ?> Download type: <?php echo $ebook['donate_or_download']; ?>
				
			</p>
		</div>
		<?php
	endwhile;	
	if (@$ebooks_found == 0) {
		echo "<p>You have not created any ebooks yet, please click <a href='post-new.php?post_type=ebook'>here</a> to start.</p>";
	}
	?>
	</div>
	<?php
}
function ebookstorestylesheet() {
	wp_enqueue_style( 'ebookstorestylesheet' );
	wp_register_style( 'ebookstorestylesheet', plugins_url('css/ebook_store.css', __FILE__) );		
}
function ebook_store_post_type_view($content) {
	//if (get_post_type() == 'ebook') {
	if (is_singular('ebook')) {
		return ebook_store(get_the_ID());
	} else {
		return $content;
	}
}
function ebook_download_links($ebook_order, $free = 0) {
	include('locale.php');
	if ($free == 0) {
		$action_name = 'download';
	} else {
		$action_name = 'download_free';
	}
	$ebook_id = $ebook_order['ebook'][0];
	$loop = array('mobi','txt','epub','zip', 'mp3', 'mp4');
	$meta = get_post_meta($ebook_id);
	$links = array();
	$post = get_post($ebook_order['ebook'][0]);
	@$slug = $post->post_name;
	foreach ($loop as $l) {
		if (@is_array($meta['ebook_wp_custom_attachment_' . $l])) {
			$book = unserialize($meta['ebook_wp_custom_attachment_' . $l][0]);
			$file = $book['file'];
			$ebook_key = (strlen(@$ebook_order['ebook_key'][0]) == 32 ? @$ebook_order['ebook_key'][0] : @$ebook_order['ebook_key_array'][0]);
			
			$link = add_query_arg(array('format' => $l, 'ebook_key' => $ebook_key, 'action' => $action_name, 'md5_nonce' => @$ebook_order['md5_nonce'][0]),get_permalink($ebook_order['ebook'][0]));
			$link = remove_query_arg('p',$link);
			$link = add_query_arg(array('ebook' => $slug),$link);

			@$links[] = "<a href=\"$link\">" . $formats_locale[$l] . " Format</a>";
		}
	}
	if (count($links) == 0) {
		$links[] = 'No other file formats are available for this ebook.';
	}
	//error_log($link);
	return $links;
}
function ebook_download_links_bonus($ebook_order, $free = 0) {
	if (@is_array($ebook_order['ebook_key']) == false) {
		foreach ($ebook_order as $k => $v) {
			if (is_array($v)) {
				$v = $v[0];
			}
			@$new_order[$k][0] = $v;
		}
		$ebook_order = $new_order;
	}
	//error_log(__LINE__ . ' ' . print_r($ebook_order,true));

	$ebook_id = $ebook_order['ebook'][0];
	$ebook_bonus = get_post_meta($ebook_id, 'ebook', true);
	$ebook_bonus = @$ebook_bonus['ebook_bonus'];
	$links = array();
	if (is_array($ebook_bonus)) {
		if (count($ebook_bonus) > 0) {
			foreach ($ebook_bonus as $ebook_id) {
				$post = get_post($ebook_id);
				$ebook_key = (strlen($ebook_order['ebook_key'][0]) == 32 ? $ebook_order['ebook_key'][0] : $ebook_order['ebook_key_array'][0]);
				// $link //= add_query_arg(array('ebook_key' => $ebook_key,'ebook_id' => $ebook_id,'action' => 'ebook_bonus_download', 'md5_nonce' => @$ebook_order['md5_nonce'][0]),get_permalink($ebook_id));
				$link = ebook_download_link($ebook_order, 0, 1, $ebook_id);
				$links[] = "<a href=\"$link\" target=\"_blank\">" . $post->post_title ."</a>";
			}
		}
		
	}
	//$links[] = '<pre>'.print_r($ebook_order,true) . '</pre>';
	return $links;
}
function ebook_store_stats($ebook_id, $days) {
	$seconds = 86400 * $days;
	if ($seconds == 0) {
		$seconds = 157680000;
	}
	$args = array(
		'post_type' => 'ebook_order',
		'meta_query' => array(
			array(
			'key' => 'ebook',
			'value' => $ebook_id,
			)
		),
		'date_query' => array(
		array(
			'column' => 'post_date_gmt',
			'after'  => $seconds . ' seconds ago',
		),
	));
	// The Query
	$the_query = new WP_Query( $args );
	$out = 0;
	// The Loop
	if ( $the_query->have_posts() ) {
//		echo '<ul>';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$id = get_the_ID();
			//echo "$id<br/>";
			$meta = get_post_meta($id);
			//print_r($meta);
			$out += $meta['mc_gross'][0];
//			echo '<li>' . get_the_title() . '</li>';
		}
//		echo '</ul>';
	} else {
		// no posts found
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	return $out;
}

function ebook_store_stats_report_30days() {
	$seconds = 2592000;

	$args = array(
		'post_type' => 'ebook_order',
		'date_query' => array(
		array(
			'column' => 'post_date_gmt',
			'after'  => $seconds . '',
		),

	));
	// The Query
	$the_query = new WP_Query( $args );
	for ($i = 0; $i < 30; $i++)
		{
		    $timestamp = time();
		    $tm = 86400 * $i; // 60 * 60 * 24 = 86400 = 1 day in seconds
		    $tm = $timestamp - $tm;

		    $the_date = date("Y-m-d", $tm);
		    $out[$the_date] = 0;
		}

	// The Loop
	if ( $the_query->have_posts() ) {
//		echo '<ul>';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$id = get_the_ID();
			//echo "$id<br/>";
			$meta = get_post_meta($id);
			//print_r($meta);
			$date = $meta['payment_date'][0];
			$date = strtotime($date);
			$date = date("Y-m-d", $date);
			@$out[$date] += $meta['mc_gross'][0];
//			echo '<li>' . get_the_title() . '</li>';
		}
//		echo '</ul>';
	} else {
		// no posts found
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	return $out;
}

function ebook_store_stats_report_2years() {
	$seconds = 63072000;

	$args = array(
		'post_type' => 'ebook_order',
		'date_query' => array(
		array(
			'column' => 'post_date_gmt',
			'after'  => $seconds . '',
		),

	));
	// The Query
	$the_query = new WP_Query( $args );
	for ($i = 0; $i < 24; $i++)
		{
		    $timestamp = time();
		    $tm = 86400 * 30.4 * $i; // 60 * 60 * 24 = 86400 = 1 day in seconds
		    $tm = $timestamp - $tm;

		    $the_date = date("Y-m", $tm);
		    $out[$the_date] = 0;
		}

	// The Loop
	if ( $the_query->have_posts() ) {
//		echo '<ul>';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$id = get_the_ID();
			//echo "$id<br/>";
			$meta = get_post_meta($id);
			//print_r($meta);
			$date = $meta['payment_date'][0];
			$date = strtotime($date);
			$date = date("Y-m", $date);
			@$out[$date] += $meta['mc_gross'][0];
//			echo '<li>' . get_the_title() . '</li>';
		}
//		echo '</ul>';
	} else {
		// no posts found
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	return $out;
}

function ebook_store_register_my_custom_submenu_page() {
   
add_submenu_page( 
          'edit.php?post_type=ebook'   //or 'options.php' 
        , __('Orders - Add New', 'ebook-store') 
        , __('Orders - Add New', 'ebook-store')
        , 'manage_options'
        , 'ebook-store-add-order-page'
        , 'ebook_store_add_order_page_callback'
    );
   
add_submenu_page( 
          'edit.php?post_type=ebook'   //or 'options.php' 
        , __('Orders - Reports', 'ebook-store') 
        , __('Orders - Reports', 'ebook-store')
        , 'manage_options'
        , 'ebook-store-order_reports'
        , 'ebook_store_order_reports_callback'
    );
   
add_submenu_page( 
          'edit.php?post_type=ebook'   //or 'options.php' 
        , __('Orders - New Issue', 'ebook-store') 
        , __('Orders - New Issue', 'ebook-store')
        , 'manage_options'
        , 'ebook-store-add-issue-page'
        , 'ebook_store_add_issue_page_callback'
    );
   
add_submenu_page(
        'edit.php?post_type=ebook',
        'Settings',
        __('Settings', 'ebook-store'),
        'manage_options',
        'settings-page',
        'ebook_store_settings_callback' );

}
function ebook_store_settings_callback() {
	echo '<script>window.location = "options-general.php?page=ebook_options.php"; </script>';
}
function ebook_store_add_query_vars_filter( $vars ){
  $vars[] = "new_issue_purchase_period";
  $vars[] = "new_issue_ebook_id";
  $vars[] = "woocommerce_product_id";
 return $vars;
}

//Add custom query vars

function ebook_store_add_issue_page_callback() {
	require_once 'ebook_store_add_issue_page_callback.php';

}

function ebook_store_add_order_page_callback() {
	require_once 'ebook_store_add_order_page_callback.php';
}
function ebook_store_add_order($data, $silent = false, $thankYouRedirect = false, $ebook_key = false) {
	$QSWPOptions = new QSWPOptions();
	
	if (@$ebook_key == '') {
		$ebook_key = md5(microtime() . rand(1,10000000));	
	}
	
	$data['md5_nonce'] = md5(microtime() . mt_rand(1,99999999) . NONCE_KEY);
	$data['mc_fee'] = 0;
	$data['item_name'] = get_the_title($data['ebook']);
	$data['payment_date'] = date("m/d/Y H:i:s");
	@$data['txn_id'] = (@$data['txn_id'] != '' ? @$data['txn_id'] : 'Manual Payment');
	$data['mc_currency'] = esc_attr(get_option('paypal_currency'));
	$data['residence_country'] = 'n/a';
	
	ebook_store_get_mailchimp_subscribe($data['payer_email']);
	if (@$data['user_id'] == 0) {
		$data['user_id'] = ebook_store_silent_registration($data);
	}
	

			$my_post = array(
			  'post_title'    => $data['first_name'] . ' ' . $data['last_name'],
			  'post_type'	  => 'ebook_order',
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  //'post_category' => array(8,39),
			  );
			if ($data['mc_gross'] == false) { 
			$data['mc_gross'] = 0;
			}
			$mc_gross = number_format(floatval($data['mc_gross']), 2, '.', ',');
			$vat = esc_attr(get_option('vat_percent')); 
			// if ($vat > 0) {
			// 	$data['tax'] = $mc_gross * ($vat / 100);
			// 	$mc_gross = $data['mc_gross'] - $data['tax'];
			// }
			$mc_gross = number_format($mc_gross, 2, '.', ',');
			$ebook = get_post_meta($data['ebook'], 'ebook', true);
			$ebookObj = new EbookStoreEbook($data['ebook']);

			$md5 = md5(NONCE_KEY . $data['ebook'] . $mc_gross);
			if (1) {
				ini_set('display_errors', 0);
				$post_id = @wp_insert_post( $my_post, $wp_error );
				foreach ($data as $k => $v) {
					update_post_meta($post_id, $k, $v);
					@$order[$k] = $v;
				}
				
				$order['order_id'] = $post_id;
				$order['password'] = $data['payer_email'];
				if (get_option('ebook_store_random_password') == 1) {
					$order['password'] = substr(md5(microtime()),0,8);
					$order['password_random'] = $order['password'];
					$data['password'] = $order['password'];
				}
				if (get_option('ebook_store_blank_password') == 1) {
					$order['password'] = '';
					$data['password'] = '';
				}
				
				global $attachment, $ebook_email_delivery;
				$attachment = ebook_attachment($data['ebook'],true);

				$formData = ebook_store_get_form($data['md5_nonce']);
				$formData = json_encode($formData);
				$ebook_order['ebook_key'][0] = $ebook_key;
				$ebook_order['ebook'][0] = $data['ebook'];
				$order['downloadlink'] = ebook_download_link($ebook_order);
				
				$ebookObj->order_id = $post_id;

				$order['downloadlink_html'] = $ebookObj->format_links();
				$ebook_order['downloadlink_html'][0] = $ebookObj->format_links();

				$order['ebook_key'] = $ebook_key;
				$order['order_id'] = $post_id;
				$order['md5_nonce'] = $data['md5_nonce'];
				update_post_meta($post_id,'ebook_key',$ebook_key);
				update_post_meta($post_id,'downloads',0);
				update_post_meta($post_id,'mc_gross',$mc_gross);
				update_post_meta($post_id,'formData',wp_slash($formData));
				update_post_meta($post_id,'downloadlink',$order['downloadlink']);
				update_post_meta($post_id,'ebook',$data['ebook']);
				@update_post_meta($post_id,'password',$order['password']);
				
				
				$ebook_email_delivery = array('to' => $data['payer_email'], 'subject' => get_option('email_delivery_subject'), 'text' => get_option('email_delivery_text',$QSWPOptions->email_delivery_text),'attachment' => $attachment, 'order' => $order);
				//mail(get_option( 'admin_email' ), 'Ebook store for WordPress - Verified Order Received', print_r($ebook_email_delivery,true));
				@$fileExt = pathinfo($attachment[0]['file'],PATHINFO_EXTENSION);
				//wp_mail('deian@motov.net','test','test');
				if ($fileExt == 'pdf' && get_option('encrypt_pdf')) {
					ebook_encrypt_pdf($data, null, $data);
				}
				if ($silent == false) {
					?>
					<div class="updated">
				        <p><?php _e( 'Order has been generated and email was sent to the buyer!<br /><small>If your email has not arrived, we strongly recommend using Easy WP SMTP to send emails trough a service like Gmail to ensure inbox delivery.</small>', 'ebook-store' ); ?></p>
				    </div><?php						
				}				ebook_email_delivery($post_id);
				
				add_action( 'init', 'ebook_email_delivery', 100);
				if ($thankYouRedirect) {
					$checkoutPage = esc_attr(get_option('ebook_store_checkout_page'));
					$link = add_query_arg(array('ebook_key' => $ebook_key, 'action' => 'thank_you'),get_permalink($checkoutPage));
					header("Location: $link");
				}
				if ($silent) {
					return $post_id;
				}
				//error_log('ebook_email_delivery added to plugins_loaded');
			}
}





function erl($var) {
	if (is_array($var)) {
		$varOut = print_r($varOut,true);
	} else {
		$varOut = $var;
	}
	error_log(debug_backtrace()[1]['function']);
	error_log($varOut);
}


function file_upload_max_size() {
  static $max_size = -1;

  if ($max_size < 0) {
    // Start with post_max_size.
    $max_size = parse_size(ini_get('post_max_size'));

    // If upload_max_size is less, then reduce. Except if upload_max_size is
    // zero, which indicates no limit.
    $upload_max = parse_size(ini_get('upload_max_filesize'));
    if ($upload_max > 0 && $upload_max < $max_size) {
      $max_size = $upload_max;
    }
  }
  return $max_size;
}

function parse_size($size) {
  $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
  $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
  if ($unit) {
    // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
    return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
  }
  else {
    return round($size);
  }
}


function register_ebook_store_woocommerce_type() {
	/**
	 * This should be in its own separate file.
	 */
	// if (class_exists('WC_Product_Simple')) {
	// 	class WC_Product_Ebook_Store extends WC_Product_Simple {

	// 	public function __construct( $product ) {

	// 		$this->product_type = 'ebook_store';

	// 		parent::__construct( $product );

	// 	}
	// 	public function get_type() {
	// 		return 'ebook_store';
	// 	}

	// 	}
	// }
	if (class_exists('WC_Product')) {
		class WC_Product_ebookstore extends WC_Product {

		function __construct($product) {
			$this->supports[]   = 'ajax_add_to_cart';
			parent::__construct($product);
			$this->product_type = 'ebookstore';
		}

	    /**
	     * Method to read a product from the database.
	     * @param WC_Product
	     */

	    public function get_product_type( $product_id ) {
	        return 'ebookstore';
	    
	    }
		public function get_type() {
			return 'ebookstore';
		}	    
    }


	}

}
function woocommerce_custom_product_tabs_for_ebook_store( $tabs) {
	$tabs['ebookstore'] = array(
		'label'		=> __( 'Ebook Store', 'woocommerce' ),
		'target'	=> 'ebook_store_options',
		'class'		=> array( 'show_if_ebook_store', 'show_if_variable_ebook_store'  ),
	);
	return $tabs;
}




function add_ebook_store_item( $types ){

	// Key should be exactly the same as in the class product_type parameter
	//$types[ 'ebookstore' ] = __( 'Ebook Store', 'ebook-store' );

	return $types;

}
add_filter( 'product_type_selector', 'add_ebook_store_item' );

function woocommerce_ebook_store_price_field() {

	if ( 'product' != get_post_type() ) :
		//return;
	endif;

	?><script type='text/javascript'>
		jQuery( document ).ready( function() {
			jQuery( '.options_group.pricing' ).addClass( 'show_if_ebook_store' ).show();
			jQuery( '.general_options' ).show();
			jQuery(	'label[for="_virtual"]').show().addClass( 'show_if_ebook_store' ).show();;
			jQuery(	'label[for="_downloadable"]').show().addClass( 'show_if_ebook_store' ).show();;
		});
		jQuery( '#product-type' ).change( function(e) {
			jQuery( '.general_options' ).show();
			setTimeout(500,"jQuery('label[for=\"_virtual\"]').show();jQuery('label[for=\"_downloadable\"]').show(); ");

			
		});
		
	</script><?php
}



/*-----------------------------------*/
/**
 * Add a custom product tab.
 */

/**
 * Contents of the rental options product tab.
 */
function ebook_store_woocommerce_tab_content() {
	global $post;
	$postOrig = $post;
	?><div id='ebook_store_options' class='panel woocommerce_options_panel' style=""><?php	
		?><div class='options_group'>
		<?php
			if (get_option('ebook_store_woocommerce_integration') == 0) {
		?>
<h4>To use this feature please get the full version of the Ebook Store plugin by clicking <a href="https://www.shopfiles.com/index.php/products/wordpress-ebook-store" target="_blank">here</a>, and enable WooCommerce integration in <a href="options-general.php?page=ebook_options.php&tab=Integrations">Settings > Ebook Store > Integrations</a>.</h4>
		<?php
		return true;
	}

			woocommerce_wp_select(array(
				'id'			=> 'ebook_store_book_id',
				'label'			=> __( 'Select Ebook', 'woocommerce' ),
				'desc_tip'		=> 'true',
				'description'	=> __( 'The selected ebook will be delivered to your customer. Encryption and watermarking will be handled by ebook store plugin.' ),
				'type' 			=> 'text',
				'value'			=> get_post_meta(get_the_ID(), 'ebook_store_book_id', true),
				'options'		=> ebook_store_get_woocommerce_options(),
			) );

				
		?></div>

	</div><?php
	$post = $postOrig;
}
/**
 * Save the custom fields.
 */
function save_woocommerce_ebook_store_data( $post_id ) {
	
	$ebook_store_ebook_id = isset( $_POST['_enable_ebook_store_option'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_enable_ebook_store_option', $ebook_store_ebook_id );
	
	if ( isset( $_POST['ebook_store_book_id'] ) ) {
		//first reset the old ebook store item to 0 in case id of the assigned woocommerce prduct is changed
		$ebook_store_book_id = get_post_meta($post_id, 'ebook_store_book_id', true);
		update_post_meta( $ebook_store_book_id, 'woocommerce_product_id', 0 );
		//then update to the currently set it.
		$ebook_store_book_id = sanitize_text_field( $_POST['ebook_store_book_id'] );
		update_post_meta( $post_id, 'ebook_store_book_id', $ebook_store_book_id );
		update_post_meta( $ebook_store_book_id, 'woocommerce_product_id', $post_id );
		//wp_die('woocommerce_product_id - ' . get_post_meta($ebook_store_book_id, 'woocommerce_product_id', true));
	}
	
}
function ebook_store_get_woocommerce_options() {
	$new = new WP_Query(
			array(
				'posts_per_page' => -1,
				'post_type' => 'ebook',
				'post_status' => 'publish',
				)
		);
	$ebooks = array();
	$ebooks[0] = '-- Please select --';
	while ($new->have_posts()) : $new->the_post();
		$ebook_title = get_the_title(get_the_ID());
		if ($ebook_title == '') {
			$ebook_title = '(no title)';
		}
		$ebooks[get_the_ID()] = $ebook_title;
	endwhile;
	
	return $ebooks;
}

function ebook_store_woocommerce_email_delivery_pending($order_id) {
	if ('pending' != esc_attr(get_option('ebook_store_woocommerce_required_order_status'))) return;
	ebook_store_woocommerce_email_delivery($order_id);
}

function ebook_store_woocommerce_email_delivery_processing($order_id) {
	if ('processing' != esc_attr(get_option('ebook_store_woocommerce_required_order_status'))) return;
	ebook_store_woocommerce_email_delivery($order_id);
}

function ebook_store_woocommerce_email_delivery_on_hold($order_id) {
	if ('on-hold' != esc_attr(get_option('ebook_store_woocommerce_required_order_status'))) return;
	ebook_store_woocommerce_email_delivery($order_id);
}

function ebook_store_woocommerce_email_delivery_cancelled($order_id) {
	if ('cancelled' != esc_attr(get_option('ebook_store_woocommerce_required_order_status'))) return;
	ebook_store_woocommerce_email_delivery($order_id);
}
function ebook_store_woocommerce_email_delivery_completed($order_id) {
	if ('completed' != esc_attr(get_option('ebook_store_woocommerce_required_order_status'))) return;
	ebook_store_woocommerce_email_delivery($order_id);
}
 
function ebook_store_woocommerce_email_delivery($order_id = 0, $event = 'completed' ) {
	
	if (is_numeric($order_status)) { //fix for using the order completed status hook
		$order_id = $order_status;
		$order_status = 'completed';
	}
	global $ebook_email_delivery;
	// erl('triggered completed');
	//error_reporting(E_ALL);
	$ebook_email_delivery = array();
	$order = new WC_Order( $order_id );
	$order_items = $order->get_items();
	$order->address = $order->get_address();
	// error_log('WC ORDER' . print_r($order, true));

	foreach ($order_items as $id => $item) {
	$ebook_email_delivery = array(
		'to' => $order->address['email'], 
		'subject' => get_option('email_delivery_subject'), 
		'text' => get_option('email_delivery_text'),
		//'attachment' => $attachment, 'order' => $order
		);
		// error_log(print_r($item,true));
		$product_id = $item['product_id'];
		$ebook_store_book_id = get_post_meta($product_id, 'ebook_store_book_id', true);
		if ($ebook_store_book_id == 0) {
			continue;
		}
		//create new order array to make email delivery work
		$ebook = new EbookStoreEbook($ebook_store_book_id);
		$ebook->order_id = $order_id;
		$ebook->wc_order = get_post_meta($order_id, '_order_key', true);
		$taxes = $order->get_taxes();
		
		// error_log('taxes' . print_r($taxes,true));
		// foreach ($taxes as $tax) {
		// 	$total_taxes = $tax->get_tax_total();
		// 	error_log('total_taxes' . print_r($total_taxes,true));
		// 	//break;
		// }
		$vat = esc_attr(get_option('vat_percent')); 
		if ($vat > 0) {
			$tax = $ebook->price * ($vat / 100);
		} else {
			$tax = 0;
		}
		$md5_nonce = md5(microtime() . mt_rand(1,99999999) . NONCE_KEY);
		$ebook_key = md5($md5_nonce);
		update_post_meta( $order_id, 'md5_nonce', $md5_nonce );
		update_post_meta( $order_id, 'ebook_key', $ebook_key );

		$ebook_email_delivery['order'] = array(
			'first_name' => $order->address['first_name'],
			'last_name' => $order->address['last_name'],
			'mc_gross' => $item['line_subtotal'],
			'ebook' => $ebook_store_book_id,
			'payer_email' => $order->address['email'],
			'md5_nonce' => $md5_nonce,
			'ebook_key' => $ebook_key,
			'mc_fee' => '',
			'item_name' => get_the_title($ebook_store_book_id),
			'payment_date' => $order->get_date_created()->__toString(),
			'mc_currency' => $order->get_currency(),
			'residence_country' => $order->address['country'],
			'order_id' => $order_id,
			'password' => $ebook->password(),
			'txn_id' => $order->get_transaction_id(),
			'downloadlink' => $ebook->format_links(),
			'downloadlink_html' => $ebook->format_links(),
			'downloadlinks' => $ebook->format_links(),
			'tax' => $tax,
			'ip' => $_SERVER['REMOTE_ADDR'],
			);
		

		$ebook_email_delivery['attachment'][0]['file'] = $ebook->file;
		$ebook_email_delivery['attachment'][0]['file'] = $ebook_email_delivery['attachment'][0]['file']['file'];
		
		@$fileExt = pathinfo($ebook_email_delivery['attachment'][0]['file'],PATHINFO_EXTENSION);

		//wp_mail('deian@motov.net','test','test');
		if ($fileExt == 'pdf' && get_option('encrypt_pdf')) {
			$ebook_email_delivery['attachment'][0]['file'] = ebook_encrypt_pdf($ebook_email_delivery['order']);
		}
		
		$ebook_store_woocommerce_required_order_status = esc_attr(get_option('ebook_store_woocommerce_required_order_status', 0));
		// if ($order_status != $ebook_store_woocommerce_required_order_status && $ebook_store_woocommerce_required_order_status != '0') {
		// 	error_log('ORDER STATUS ' . $ebook_store_woocommerce_required_order_status . ' VS ' . $order_status);
		// 	erl('will return now');
		// 	return $order_status;
		// }

		ebook_email_delivery();
		// error_log('ebook id ' . $ebook_store_book_id);
		# code...
	}
	// if ( 'processing' == $order_status && ( 'on-hold' == $order->status || 'pending' == $order->status || 'failed' == $order->status ) ) {
	// return 'completed';
	// }
	return true;
}

function ebook_store_woocommerce_order_details($order, $skipHeaders = false){
	$order_items = $order->get_items();
	$order_status = $order->get_status();
	$ebook_store_woocommerce_required_order_status = esc_attr(get_option('ebook_store_woocommerce_required_order_status', 0));
	if ($order_status != $ebook_store_woocommerce_required_order_status && $ebook_store_woocommerce_required_order_status != '0') {
		return true;
	}
	if ($skipHeaders == false) {
		@$out .= "<h2>". __('Downloads', 'ebook-store') . "</h2>"; 
		@$out .= '<table class="shop_table order_downloads_ebook_store">
		<thead>
			<tr>
				<th class="product-name">'. __('Ebook (digital copy)', 'ebook-store') . '</th>
				<th class="product-total">'. __('Download', 'ebook-store') . '</th>
			</tr>
		</thead>
		<tbody>';

	}
	// echo "<pre>";
	// print_r($order_items);
	// echo "<pre>";
	foreach ($order_items as $item_id => $item) {
		$woocommerce_product_id = $item->get_product_id();
		$product = $item->get_product();
		$title = $product->get_title();

		//wp_die("ID is $woocommerce_product_id");
		//$woocommerce_product_id = 100;
		$ebook_store_book_id = get_post_meta($woocommerce_product_id, 'ebook_store_book_id', true);

		if ($ebook_store_book_id != 0) {
			@$ebooks++;
		}

		$ebook = new EbookStoreEbook($ebook_store_book_id);
		$ebook->order_id = $order->id;
		$ebook->wc_order = get_post_meta($order->id, '_order_key', true);
		$cell = '<span class="amount">' . $ebook->format_links() . '</span><br /><small>' . $ebook->password_desc() . '</small>';
		if (get_option( 'ebook_store_woocommerce_pdf_reader', false )) {
			$cell = ebook_pdf_reader(false, $ebook_store_book_id);
		}

		if ($ebook_store_book_id > 0) {
			@$out .= '
				<tr class="order_item">
					<td class="product-name">
						' . $title .	 '</td>
					<td class="product-total">
						' .  $cell . '
					</td>
				</tr>';

		} 
	}
	if ($skipHeaders == false) {
		@$out .= '
		</tbody>
	</table>';		
	}

	if (@$ebooks > 0) {
		echo $out;
	}
	
	// echo '<pre>' . print_r($order,true) . '</pre>';
	// echo '<pre>' . print_r($ord,true) . '</pre>';
	
    // echo '<p><strong>'.__('Pickup Location').':</strong> ' . get_post_meta( $order->id, 'ebook_store_book_id', true ). '</p>';
    // echo '<p><strong>'.__('Pickup Date').':</strong> ' . get_post_meta( $order->id, 'ebook_store_book_id', true ). '</p>';
}
function ebook_process_download_woocomerce() {
	if (@$_GET['action'] != 'wc_order_download') {
		return false;
	} 
	//if wc_order == post meta by _order_key order_id, allow.
	$wc_order = sanitize_text_field($_GET['wc_order']);
	$order_id = sanitize_text_field($_GET['order_id']);
	$_order_key = get_post_meta($order_id, '_order_key',true);

	if ($_order_key != $wc_order) {
		wp_die('Ivalid request has been made.');
	}
	//wp_die('all good sir.');
	ebook_process_download($wc_order);
	die();
}

function ebook_store_add_to_cart() {
	include_once('locale.php');

	if ($_GET['woocommerce_product_id'] > 0) {
		global $woocommerce;
		$woocommerce_product_id = (int)$_GET['woocommerce_product_id'];

		//$woocommerce_product_id = 2268; // This line overwrites the previous value, so you may want to remove or comment it
		$cart_items = WC()->cart->get_cart();

		$product_ids = array();

		foreach ($cart_items as $cart_item) {
		    $product_ids[] = $cart_item['product_id'];
		}

		$count = WC()->cart->get_cart_contents_count() + 1;

		for ($i=0;$i<$count;$i++) {
			if (in_array($woocommerce_product_id, $product_ids) == false) {
				WC()->cart->add_to_cart($woocommerce_product_id);
				$product_ids[] = $woocommerce_product_id;
			}
			
		}

		global $ebook_store_messages;

		if (get_option('ebook_store_woocommerce_integration_no_added_to_cart') < 1) {
			$ebook_store_messages[$woocommerce_product_id] = '<div class="ebook-store-alert ebook-store-alert-success">“' . get_the_title($woocommerce_product_id) . '” ' . $locale['addedToCart'] . '. <a href="' . $woocommerce->cart->get_cart_url() . '" class="ebook_store_button">View Cart</a></div>';
		}
	}
}



function ebook_store_action_links ( $links ) {
 $mylinks = array(
 '<a href="' . admin_url( 'options-general.php?page=ebook_options.php' ) . '">Settings</a>',
 '<a href="https://www.youtube.com/watch?v=T0mrdvrbmbc&list=PL9hp_4MJ0h1sDTf05H6aguzlYqcg47QJ-" target="_blank">Video Tutorials</a>',
 '<a href="https://shopfiles.com/index.php/products/wordpress-ebook-store" target="_blank">Upgrade</a>',
 );
return array_merge( $links, $mylinks );
}

function ebook_store_payment_completed_wpam($ipn_data, $order_id)
{
    $custom_data = $ipn_data['custom'];
    WPAM_Logger::log_debug('Ebook Store for WordPress Integration - payment completed hook fired. Custom field value: '.$custom_data);
    $custom_values = array();
    parse_str($custom_data, $custom_values);
    if(isset($custom_values['wpam_tracking']) && !empty($custom_values['wpam_tracking']))
    {
        $tracking_value = $custom_values['wpam_tracking'];
        WPAM_Logger::log_debug('Ebook Store for WordPress Integration - Tracking data present. Need to track affiliate commission. Tracking value: '.$tracking_value);
        $purchaseLogId = $ipn_data['txn_id'];
        $purchaseAmount = $ipn_data['mc_gross']; //TODO - later calculate sub-total only
        $strRefKey = $tracking_value;
        $requestTracker = new WPAM_Tracking_RequestTracker();
        $requestTracker->handleCheckoutWithRefKey( $purchaseLogId, $purchaseAmount, $strRefKey);
        WPAM_Logger::log_debug('Ebook Store for WordPress Integration - Commission tracked for transaction ID: '.$purchaseLogId.'. Purchase amt: '.$purchaseAmount);
    }
}

function ebook_store_payment_gateway_parameters_wpam($parameters)
{
	if (class_exists('WPAM_PluginConfig') == false) {
		return;
	}
    if(isset($_COOKIE['wpam_id']))
    {
        $name = 'wpam_tracking';
        $value = $_COOKIE['wpam_id'];
        $new_val = $name.'='.$value;
        $current_val = $parameters['custom'];
        if(empty($current_val)){
            $parameters['custom'] = $new_val;
        }
        else{
            $parameters['custom'] = $current_val.'&'.$new_val;
        }
        WPAM_Logger::log_debug('Ebook Store for WordPress Integration - Adding custom field value. New value: '.$parameters['custom']);
    }
    
    else if(isset($_COOKIE[WPAM_PluginConfig::$RefKey]))
    {
        $name = 'wpam_tracking';
        $value = $_COOKIE[WPAM_PluginConfig::$RefKey];
        $new_val = $name.'='.$value;
        $current_val = $parameters['custom'];
        if(empty($current_val)){
            $parameters['custom'] = $new_val;
        }
        else{
            $parameters['custom'] = $current_val.'&'.$new_val;
        }
        WPAM_Logger::log_debug('Ebook Store for WordPress Integration - Adding custom field value. New value: '.$parameters['custom']);
    }

    return $parameters;
}

function ebook_store_my_taxonomies_product() {
  $labels = array(
    'name'              => _x( 'Ebook Categories', 'Ebook Categories', 'ebook-store' ),
    'singular_name'     => _x( 'Ebook Category', 'Ebook Category', 'ebook-store' ),
    'search_items'      => __( 'Search Ebook Categories', 'ebook-store' ),
    'all_items'         => __( 'All Ebook Categories', 'ebook-store' ),
    'parent_item'       => __( 'Parent Ebook Category', 'ebook-store' ),
    'parent_item_colon' => __( 'Parent Ebook Category:', 'ebook-store' ),
    'edit_item'         => __( 'Edit Ebook Category', 'ebook-store' ), 
    'update_item'       => __( 'Update Ebook Category', 'ebook-store' ),
    'add_new_item'      => __( 'Add New Ebook Category', 'ebook-store' ),
    'new_item_name'     => __( 'New Ebook Category', 'ebook-store' ),
    'menu_name'         => __( 'Ebook Categories', 'ebook-store' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'ebook_category', 'ebook', $args );
}

function ebook_store_vc_before_init_actions() {
	class vcInfoBox extends WPBakeryShortCode {
	     
	    // Element Init
	    function __construct() {
	        add_action( 'init', array( $this, 'vc_infobox_mapping' ) );
	        add_shortcode( 'vc_infobox', array( $this, 'vc_infobox_html' ) );
	    }
	     
	    // Element Mapping
	    public function vc_infobox_mapping() {
	         
	        // Stop all if VC is not enabled
	        if ( !defined( 'WPB_VC_VERSION' ) ) {
	            return;
	        }
	         
	        // Map the block with vc_map()
	        vc_map( 
	            array(
	                'name' => __('Ebook Order Form', 'text-domain'),
	                'base' => 'ebook_store',
	                'description' => __('Inserts shortcode that will call the Ebook Order form.', 'text-domain'), 
	                'category' => __('Ebook Store', 'ebook-store'),   
	                'icon' => 'dashicons-cart', //get_template_directory_uri().'/assets/img/vc-icon.png',            
	                'params' => array(   
	                         
	                    array(
	                        'type' => 'dropdown',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Select Ebook', 'text-domain' ),
	                        'param_name' => 'ebook_id',
	                        'value' => vc_ebook_store_array(),
	                        'description' => __( 'You are embedding a direct order form for the Ebook via Ebook Store plugin.', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Ebook Store',
	                    ),  
	                                      
	                        
	                ),
	            )
	        );                                
	        
	    }
	     
	     
	    // Element HTML
	    public function vc_infobox_html( $atts ) {
	         
	        // Params extraction
	        extract(
	            shortcode_atts(
	                array(
	                    'title'   => '',
	                    'text' => '',
	                    'ebook_id' => '',
	                ), 
	                $atts
	            )
	        );
	         
	        // Fill $html var with data
	        $html = '
	        <div class="vc-infobox-wrap">
	         
	            <h2 class="vc-infobox-title">' . $title . '</h2>
	             
	            <div class="vc-infobox-text"></div>


	         
	        </div>';      
	         
	        return $html;
	         
	    }
	     
	} // End Element Class
	 
	 
	// Element Class Init
	new vcInfoBox();     
}
function vc_ebook_store_array() {
	$args = array(
	   'post_type' => 'ebook',
	);
	$out = array();
	$query = new WP_Query($args);
	while ($query->have_posts()) {
		$query->the_post();
		$out[get_the_title()] = get_the_ID();
	}
	return $out;
}
function ebook_store_order_reports_callback() {
	include_once('ebook_store_order_reports_callback.php');
}
function ebook_store_export_orders() {
	if (is_admin()) {
		if ($_GET['export'] == 1) {
			if ( ! current_user_can( 'manage_options' ) ) {
			        wp_die( 'You do not have permission to access this page.' );
    			}

			$query = new WP_Query('post_type=ebook_order');
			$lines = array();
			$lines[] = "sep=\t";
			header("Content-type: text/csv; charset=utf-8");
			header("Content-Disposition: attachment; filename=file.csv");
			header("Pragma: no-cache");
			header("Expires: 0");

			// echo implode("\n", $lines);
			// die();
			while ($query->have_posts()) {
				$query->the_post();
				$meta = get_post_meta(get_The_ID());
				if ($keys_added == false) {
					$keys = array_keys($meta);
					//$lines[] = implode("\t",$keys);
					$keys_added = 1;
				}
				
				
				//print_r($meta);
				unset($line);
				// foreach ($meta as $key => $value) {
				// 	foreach ($value as $val) {
				// 		if ($val === 0) {
				// 			$val = '0';
				// 		}
				// 		$line[] = var_export($val, true);
				// 	}
				// }
				foreach ($keys as $key) {
					$line[] = $meta[$key][0];
					# code...
				}
				$line = implode("\t", $line);
				$lines[] = $line;
				
				//die();
				@$orders++;
			}
			if ($orders == 0) {
				wp_die(__('There must be orders first.', 'ebook-store'));
			}

			//print_r($lines);

			die(implode("\n", $lines));
		}
	}


}



function ebook_store_session_end() {
    session_destroy ();
}
function ebook_store_encryptable($file) {
	if (version_compare(phpversion(), '8.0', '<')) {
		    // php version isn't high enough
		return true;
	}
	require_once('includes/fpdi/fpdi_pdf_parser.php');	
	// ini_set('display_errors', 1);
	// error_reporting(E_ALL);
	try {
		$parser = new fpdi_pdf_parser($file);
	} catch (Exception $e) {
		return false;
	}
	
	return true;

}

function ebook_store_offer_tutorial() {
	if (ebook_store_endsWith($_SERVER['REQUEST_URI'], 'edit.php?post_type=ebook')) {
		$args = array(
	   'post_type' => 'ebook',
	);
		$myquery = new WP_Query($args);
		if ($myquery->found_posts == 0) {
			?>
			<div class="updated">
        <p><?php _e( 'You have not created any ebooks yet, do you want to see the sample videos how to help you get started with it?<br />
        	<a href="https://www.youtube.com/watch?v=HxYzlaEHPU4&list=PL9hp_4MJ0h1sDTf05H6aguzlYqcg47QJ-&index=1" target="_blank">Watch Tutorials on YouTube</a>', 'ebooks-store' ); ?></p>
    </div>
    		<?php
		}
	}	
}
function ebook_store_not_encryptable() {
	$class = 'notice notice-error';
	$message = __( 'This file is can not be encrypted. Please save it in Adobe Acrobat 5.0 PDF 1.5 compatibility format. See video tutorial here: <a href="https://youtu.be/-yDr-76W4gk" target="_blank">https://youtu.be/-yDr-76W4gk</a>', 'ebook-store' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
}

function ebook_store_file_formats_form($ebook_id) {

	$formats = array('pdf','zip','mobi','txt','mp3','epub','mp4');
	$meta = get_post_meta($ebook_id);
	$ebook = new EbookStoreEbook($ebook_id);
	//print_r($ebook->files);
	?>
	<div class="ebook_store_file_formats_form">
	<?php
		foreach ($formats as $format) {
			$ebook->formats = is_array($ebook->formats) ? $ebook->formats : array();
			$exists = (@in_array($format,$ebook->formats) ? '' : 'hidden');
			//if (!isset($ebook->files[$format])) continue;
			if ($format == 'pdf') {
				if (get_option('encrypt_pdf')) {
					if (!ebook_store_encryptable($ebook->files[$format]) && @$ebook->files[$format] != '') {
						//add_action( 'admin_notices', 'ebook_store_not_encryptable' );
						ebook_store_not_encryptable();
					}
				}
			}
			@$i++;
			?>
			<div class="ebook_store_file_format_item <?php echo ($i > 1 ? 'goPro2' : ''); ?>">
				<div class="ebook_store_file_format_item_left">
					<span class="ebook_store_icon">
						<img src="<?php echo plugins_url( 'img/'.$format.'.png', __FILE__ ); ?>" width=64 />
					</span>
					<span class="ebook_store_size <?php echo $exists; ?>"><?php echo $ebook->human_filesize(@$ebook->files["$format" . "_size"]); ?></span>
				</div>
				<div class="ebook_store_file_format_item_right">
					<?php
					if ($exists == '') {
					?>
					<span class="ebook_store_filename"><a href="#"><?php echo basename($ebook->files[$format]); ?></a></span>
					<?php
					} else {
						?>
					<span class="ebook_store_filename">File is not uploaded.</span>
						<?php
					}
					?>
					
					<span class="ebook_store_upload"><input type="file" accept=".<?php echo $format; ?>" name="ebook_wp_custom_attachment_<?php echo $format; ?>"></span>
					<span class="ebook_store_control <?php echo $exists; ?>">
						<label title="<?php echo __('Delete'); ?>">
						<input type="checkbox" name="ebook_store_delete_<?php echo $format; ?>"><i class="dashicons dashicons-trash"></i>
						</label>
					</span>
				</div>
			</div>
			<?php
		}
	?>
	</div>
	<?php
}

function ebook_store_price_plus_vat($price) {
	$vat = esc_attr(get_option('vat_percent'));
	if ($vat == 0) {
		return $price;
	} else {
		return $price + ($price * ((float)$vat / 100));
	}
}



function ebook_store_row( $atts, $content = "") {
	return "<div class=\"ebook_store_row ebook_store_row_{$atts[col]}\">" . do_shortcode($content) . "</div>";
}

function ebook_store_silent_registration($data) {
	if (get_option('ebook_store_silent_registration') != 1) {
		error_log('No auto registration enabled. Exiting.');
		return get_current_user_id();
	}

	$user_name = $data['first_name'] . '_' . $data['last_name'];
	$user_id = username_exists( $user_name );
	$user_email = $data['payer_email'];
	$user_email_exists = email_exists($user_email);

	if ($user_email_exists) {
		error_log('User exists.. no new accounts created');
		return $user_email_exists; //user_id
	}

	if (!$user_id and email_exists($user_email) == false ) {
		$random_password = wp_generate_password( $length=12, false );
		$user_id = wp_create_user( $user_name, $random_password, $user_email );
		wp_new_user_notification($user_id, null, 'both');
		error_log('New user with id added ' . $user_id);
		return $user_id;
	} else {
		$random_password = __('User already exists.  Password inherited.');
		error_log('User already exists ' . $user_id);
		return $user_id;
	}
}



function ebook_store_downloads($atts) {
	$args = array(
		'post_type' => 'ebook_order',
		'meta_query' => array(
			array(
			'key' => 'user_id',
			'value' => get_current_user_id(),
			)
	));
	// The Query
	$the_query = new WP_Query( $args );
	$out = 0;
	// The Loop
	$checkoutPage = esc_attr(get_option('ebook_store_checkout_page'));
	if ( $the_query->have_posts() ) {

		$the_query->the_post();
		$link = add_query_arg(array('ebook_key' => get_post_meta(get_the_ID(),'ebook_key',true), 'action' => 'thank_you'),get_permalink($checkoutPage));
		echo '<h4><a href="' . $link . '">'.__('Order','ebook-store') . ' #' . get_the_ID().'</a></h4>';
	} else {
		echo __('No orders found.');
	}	
	wp_reset_postdata();
}
function ebook_pdf_reader($ebook_order = false, $ebook_post_id = false) {
	$src = plugins_url('',__FILE__) .  '/includes/ViewerJS/index.html';
	// /return $src;
	$src = add_query_arg('title',__('Online Viewer','ebook-store'),$src);
	if ($ebook_order) {
		return '<iframe style="float:left;" src="'.$src.'#' . $ebook_order['downloadlink'][0] . '" width=\'100%\' height=\'' . get_option('pdf_viewer_height',600) . '\' allowfullscreen webkitallowfullscreen></iframe>';
	} else {
		$meta = get_post_meta($ebook_post_id, 'ebook_wp_custom_attachment', true);
		
		if (is_array($meta)) {
		    $pdf_url = $meta['url'];
		} else {
			$pdf_url = '';
		}

		//wp_die('URL ' . $pdf_url);
		if (is_ssl()) {
			$pdf_url = str_replace('http://', 'https://', $pdf_url);
		}
		return '<iframe style="float:left;" src="'.$src.'#' . $pdf_url . '" width=\'100%\' height=\'' . get_option('pdf_viewer_height',600) . '\' allowfullscreen webkitallowfullscreen></iframe>';
	}
	
}
function pr_die($array) { 
	wp_die('<pre>'.print_r($array,true).'</pre>');
}
function ebook_store_redirect_add_order() {
	if (endswith($_SERVER['REQUEST_URI'], 'post-new.php?post_type=ebook_order')) {
		header("Location: edit.php?post_type=ebook&page=ebook-store-add-order-page");
	}
}

if (!function_exists('endswith')) {
    function endswith($string, $test) {
        $strlen = strlen($string);
        $testlen = strlen($test);
        if ($testlen > $strlen) return false;
        return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    }
}
add_action( 'woocommerce_after_account_downloads', 'ebook_store_woocommerce_after_account_downloads', 10, 1 );
function ebook_store_woocommerce_after_account_downloads() {

	echo '<h3>Ebook Downloads</h3>';
	//echo '<p>You can access your ebook downloads by going to the Orders section and clicking on an order number that will open the order confirmation page containing the download links.</p>';
	echo '<table class="woocommerce-MyAccount-downloads shop_table shop_table_responsive">
		<thead>
			<tr>
				<th class="download-product"><span class="nobr">'.__('Product','ebook-store').'</span></th>
				<th class="download-remaining"><span class="nobr">'.__('Download Links','ebook-store').'</span></th>
<!--				<th class="download-expires"><span class="nobr">'.__('Expires','ebook-store').'</span></th>
				<th class="download-file"><span class="nobr">'.__('File','ebook-store').'</span></th>-->
			</tr>
			</thead>
			<tbody>';
			$customer_user_id = get_current_user_id();

			$customer_orders = wc_get_orders( array(
			    'meta_key' => '_customer_user',
			    'meta_value' => $customer_user_id,
			    'limit'    => -1,
			));
			foreach ( $customer_orders as $order ) {
			    ebook_store_woocommerce_order_details($order, true);

		    	continue;
			}
			echo '
			</tbody></table>';
}

function ebook_store_wp_super_cache_warning() {
	error_reporting(0);
	if (!file_exists(WP_PLUGIN_DIR . '/wp-super-cache/wp-cache.php')) {
		return true;
	}

	if ($_GET['dismiss'] == 'wpsc') {
		update_option( 'ebookstorewpsc', 1 );
		return true;
	}
	if (get_option( 'ebookstorewpsc') < 1) {
?>
<div id="wpsc-index-warning" class="error notice" style="padding: 10px 10px 50px 10px"><h1>Warning!</h1><p>You are using WP Super Cache, in order to have <b>ebook store</b> working properly with it, you must add these lines to the "Ignore strings" section <a href="options-general.php?page=wpsupercache&tab=settings">here</a>. Exactly where it says "Add here strings (not a filename) that forces a page not to be cached.". The lines you must add are:<br /><textarea>ipn
ebook
</textarea></p><a id="wpsc-dismiss" href="<?php echo $_SERVER['REQUEST_URI']; ?>&dismiss=wpsc">Dismiss</a></div>
<?php

	}
}

function ebook_store_deregister_embeds(){
	wp_dequeue_script( 'wp-embed' );
}
