<?php
	wp_enqueue_script( 'ebook_store_settings', plugins_url( '/js/ebook_store_settings.js' , __FILE__ ), array(), '1.0.0', true );
	switch ($_REQUEST['action']) {
		case 'go':
		$retrieved_nonce = sanitize_text_field($_REQUEST['_wpnonce']);
		//if (!wp_verify_nonce($retrieved_nonce, 'process_new_issue' ) ) die( 'Failed security check' );
		$ebook_id = sanitize_text_field($_REQUEST['ebook_id']);
		$new_issue_purchase_period = sanitize_text_field($_REQUEST['new_issue_purchase_period']);
		$new_issue_ebook_id = sanitize_text_field($_REQUEST['new_issue_ebook_id']);
		$args = array(
			'post_type'  		=> 'ebook_order',
			'posts_per_page'	=> -1,
			'ignore_sticky_posts' => 1,
			'meta_key' => 'ebook', 'meta_value' => $ebook_id,
			'date_query' 		=> array(
			    array(
			        //'after' => get_query_var('new_issue_purchase_period') . ' ago'
			        'after' => filter_var($_REQUEST['new_issue_purchase_period'], FILTER_SANITIZE_SPECIAL_CHARS) . ' ago'
			        )
			    )
			);

		$the_posts = new WP_Query( $args );
		$count = $the_posts->post_count;
		//print_r($_REQUEST);

		echo '<h3>'.__('Ebook Store', 'ebook-store') . ' - ' . __('Sending new issue for', 'ebook-store') . ' ' . $count . ' ' . __('orders matching the criteria', 'ebook-store').'</h3>';


		

		$post_ids = wp_list_pluck( $the_posts->posts, 'ID' );
		@$step = $_REQUEST['step'];
		if (!$step) { $step = 0; }
		$order_meta = get_post_meta($post_ids[$step]);
		
		$new_order_data = array(
			'first_name' 	=> $order_meta['first_name'][0],
			'last_name' 	=> $order_meta['last_name'][0],
			'mc_gross' 		=> 0,
			'ebook' 		=> $new_issue_ebook_id,
			'payer_email' 	=> $order_meta['payer_email'][0],
			'mc_fee' 		=> 0,
			'item_name'		=> get_the_title($new_issue_ebook_id),
			'payment_date' 	=> date("m/d/Y H:i:s"),
			'txn_id' 		=> 'n/a',
			'residence_country' => '',
			'md5_nonce' => md5(microtime() . mt_rand(1,99999999) . NONCE_KEY),
			);
		echo '<p>'.__('Adding a new order for order id', 'ebook-store') . ' #' . $post_ids[$step]. '</p>';
		echo $step+1 . '/' . count($post_ids);
		ebook_store_add_order($new_order_data);
		///wp-admin/edit.php?post_type=ebook&page=ebook-store-add-issue-page&_wpnonce=695d1e53d4&_wp_http_referer=%2Fwp-admin%2Fedit.php%3Fpost_type%3Debook%26page%3Debook-store-add-issue-page&ebook_id=665&new_issue_ebook_id=665&new_issue_purchase_period=1+month&action=go
		$step++;
		?><form method="get" id="ebook_store_add_issue_form" action="edit.php">
		<input type="hidden" name="post_type" value="ebook">
		<input type="hidden" name="page" value="ebook-store-add-issue-page">
		<input type="hidden" name="ebook_id" value="<?php echo $ebook_id; ?>">
		<input type="hidden" name="new_issue_purchase_period" value="<?php echo $new_issue_purchase_period; ?>">
		<input type="hidden" name="new_issue_ebook_id" value="<?php echo $new_issue_ebook_id; ?>">
		<input type="hidden" name="action" value="go">
		<input type="hidden" name="step" value="<?php echo $step; ?>">
		<?php echo wp_nonce_field('process_new_issue',null,false,true); ?>
		</form>
		<script>
		<?php
		if ($step != count($post_ids)) {
		?>
		jQuery(document).ready(function() {
			jQuery('#ebook_store_add_issue_form').submit();
		});
		<?php
		}
		?>

		</script>
		<?php
		//phpinfo();
		

		// Array
// (
//     [first_name] =&gt; Deian
//     [last_name] =&gt; Motov
//     [mc_gross] =&gt; 1
//     [ebook] =&gt; 665
//     [payer_email] =&gt; deian@motov.net
//     [md5_nonce] =&gt; d2d649d02102a0bb8f28022a9fafa8b0
//     [mc_fee] =&gt; 0
//     [item_name] =&gt; A Test Ebook
//     [payment_date] =&gt; 01/31/2017 14:47:16
//     [txn_id] =&gt; Manual Payment
//     [mc_currency] =&gt; EUR
//     [residence_country] =&gt; n/a
// )


/*

Array
(
    [_vc_post_settings] =&gt; Array
        (
            [0] =&gt; a:1:{s:10:"vc_grid_id";a:0:{}}
        )

    [first_name] =&gt; Array
        (
            [0] =&gt; Deian
        )

    [last_name] =&gt; Array
        (
            [0] =&gt; Motov
        )

    [mc_gross] =&gt; Array
        (
            [0] =&gt; 0.80
        )

    [ebook] =&gt; Array
        (
            [0] =&gt; 665
        )

    [payer_email] =&gt; Array
        (
            [0] =&gt; deian@motov.net
        )

    [md5_nonce] =&gt; Array
        (
            [0] =&gt; d2d649d02102a0bb8f28022a9fafa8b0
        )

    [mc_fee] =&gt; Array
        (
            [0] =&gt; 0
        )

    [item_name] =&gt; Array
        (
            [0] =&gt; A Test Ebook
        )

    [payment_date] =&gt; Array
        (
            [0] =&gt; 01/31/2017 14:47:16
        )

    [txn_id] =&gt; Array
        (
            [0] =&gt; Manual Payment
        )

    [mc_currency] =&gt; Array
        (
            [0] =&gt; EUR
        )

    [residence_country] =&gt; Array
        (
            [0] =&gt; n/a
        )

    [tax] =&gt; Array
        (
            [0] =&gt; 0.2
        )

    [ebook_key] =&gt; Array
        (
            [0] =&gt; 472df70dd77aa3a0a6caf7f8e601afa4
        )

    [downloads] =&gt; Array
        (
            [0] =&gt; 0
        )

    [formData] =&gt; Array
        (
            [0] =&gt; false
        )

    [downloadlink] =&gt; Array
        (
            [0] =&gt; http://wp2.shopfiles.com/ebook/a-test-ebook/?ebook_key=472df70dd77aa3a0a6caf7f8e601afa4&amp;action=download&amp;ebook=a-test-ebook
        )

    [encrypted_pdf] =&gt; Array
        (
            [0] =&gt; /home/wp2/public_html/wp-content/plugins/ebook-store/cache/b0003b41d2ec263a2d7e55ed44c5bded/test-portrait.pdf
        )

)

		


*/

						
		?>

		<?php

		break;
		case 'ajax_get_orders_count':
		$args = array(
			'post_type'  		=> 'ebook_order',
			'posts_per_page'	=> -1,
			'ignore_sticky_posts' => 1,
			'meta_key' => 'ebook', 'meta_value' => (int)$_REQUEST['ebook_id'],
			'date_query' 		=> array(
			    array(
			        //'after' => get_query_var('new_issue_purchase_period') . ' ago'
			        'after' => filter_var($_REQUEST['new_issue_purchase_period'], FILTER_SANITIZE_SPECIAL_CHARS) . ' ago'
			        )
			    )
			);

		$the_posts = new WP_Query( $args );
		$count = $the_posts->post_count;

		die('<div class="ajax_get_orders_count">' . $count . ' ' . __('Records found', 'ebook-store') .  '</div>');
			break;
		
		default:
		?>
<h1><?php echo __('Orders - Add New Issue', 'ebook-store'); ?></h1>
<p><?php echo __('This feature will generate new orders and allow people who previously purchased a certain ebook to download the new issue. Like a magazine subscription. <br /><b>Use the purchase period field to enter the period back in time for which the orders will be processed. If you set it for 1 year, only orders placed in the last year will be processed and customers will be sent the new issue / version of the magazine / book.</b>', 'ebook-store'); ?></p>
<form method="get" action="edit.php">
<input type="hidden" name="post_type" value="ebook">
<input type="hidden" name="page" value="ebook-store-add-issue-page">
<?php
wp_nonce_field( 'process_new_issue');
?>
<table class="form-table">
<tbody>

<tr>
<th scope="row"><label for="ebook_id"><?php echo __('Select Ebook', 'ebook-store'); ?></label></th>
<td>
<?php
$args = array(
    'depth'                 => 0,
    'child_of'              => 0,
    'selected'              => 0,
    'echo'                  => 1,
    'name'                  => 'ebook_id',
    'id'                    => 'past_order_ebook_id', // string
    'class'                 => null, // string
    'show_option_none'      => '-- ' . __('Select') . ' --', // string
    'show_option_no_change' => null, // string
    'option_none_value'     => null, // string
    'post_type'				=> 'ebook',
);
wp_dropdown_pages($args);
?>


</td>
</tr>

<tr>
<th scope="row"><label for="new_issue_ebook_id"><?php echo __('Select Ebook (new Issue)', 'ebook-store'); ?></label></th>
<td>
<?php
$args = array(
    'depth'                 => 0,
    'child_of'              => 0,
    'selected'              => 0,
    'echo'                  => 1,
    'name'                  => 'new_issue_ebook_id',
    'id'                    => 'new_issue_ebook_id', // string
    'class'                 => null, // string
    'show_option_none'      => '-- ' . __('Select') . ' --', // string
    'show_option_no_change' => null, // string
    'option_none_value'     => null, // string
    'post_type'				=> 'ebook',
);
wp_dropdown_pages($args);
?>


</td>
</tr>
<tr>
	<th>
	<?php echo __('Purchase Period', 'ebook-store'); ?>
	</th>
	<td>
	<input type="text" name="new_issue_purchase_period" id="new_issue_purchase_period" value="<?php echo get_option('link_expiration','1 year'); ?>" />
	</td>
</tr>
<tr>
	<th>
	
	</th>
	<td>
	<span id="ajax_get_orders_count"></span>
	</td>
</tr>

</tbody>
</table>
<input type="hidden" name="action" value="go" />
<?php


echo get_submit_button(__('Send New Issue To Customers', 'ebook-store'), null, null, null, ' id="new_issue_submit_button" disabled=disabled');

?>

</form> <?php
			break;
	}