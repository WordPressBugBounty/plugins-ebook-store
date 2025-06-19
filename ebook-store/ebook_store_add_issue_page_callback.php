<?php
wp_enqueue_script(
    'ebook_store_settings',
    plugins_url('/js/ebook_store_settings.js', __FILE__),
    array(),
    '1.0.0',
    true
);

$action = isset($_REQUEST['action']) ? sanitize_key($_REQUEST['action']) : '';

switch ($action) {

    case 'go':

        // Security: Nonce check
        if (!isset($_REQUEST['_wpnonce']) || !wp_verify_nonce($_REQUEST['_wpnonce'], 'process_new_issue')) {
            wp_die(esc_html__('Failed security check.', 'ebook-store'));
        }

        // Sanitize and validate incoming IDs
        $ebook_id = isset($_REQUEST['ebook_id']) ? absint($_REQUEST['ebook_id']) : 0;
        $new_issue_ebook_id = isset($_REQUEST['new_issue_ebook_id']) ? absint($_REQUEST['new_issue_ebook_id']) : 0;

        // Allow only digits, letters, spaces (e.g., "1 month", "6 weeks") for period
        $raw_period = isset($_REQUEST['new_issue_purchase_period']) ? wp_unslash($_REQUEST['new_issue_purchase_period']) : '';
        $new_issue_purchase_period = preg_replace('/[^0-9a-z\s]/i', '', $raw_period);

        $args = array(
            'post_type'           => 'ebook_order',
            'posts_per_page'      => -1,
            'ignore_sticky_posts' => 1,
            'meta_key'            => 'ebook',
            'meta_value'          => $ebook_id,
            'date_query'          => array(
                array(
                    'after' => $new_issue_purchase_period . ' ago',
                )
            )
        );

        $the_posts = new WP_Query($args);
        $count = $the_posts->post_count;

        echo '<h3>' . esc_html__('Ebook Store', 'ebook-store') . ' - ' . esc_html__('Sending new issue for', 'ebook-store') . ' ' . esc_html($count) . ' ' . esc_html__('orders matching the criteria', 'ebook-store') . '</h3>';

        $post_ids = wp_list_pluck($the_posts->posts, 'ID');
        $step = isset($_REQUEST['step']) ? absint($_REQUEST['step']) : 0;
        if (!$step) {
            $step = 0;
        }

        // Defensive: check bounds
        if (!isset($post_ids[$step])) {
            echo '<p>' . esc_html__('No more orders to process.', 'ebook-store') . '</p>';
            break;
        }

        $order_meta = get_post_meta($post_ids[$step]);
        $new_order_data = array(
            'first_name'        => sanitize_text_field($order_meta['first_name'][0] ?? ''),
            'last_name'         => sanitize_text_field($order_meta['last_name'][0] ?? ''),
            'mc_gross'          => 0,
            'ebook'             => $new_issue_ebook_id,
            'payer_email'       => sanitize_email($order_meta['payer_email'][0] ?? ''),
            'mc_fee'            => 0,
            'item_name'         => get_the_title($new_issue_ebook_id),
            'payment_date'      => date("m/d/Y H:i:s"),
            'txn_id'            => 'n/a',
            'residence_country' => '',
            'md5_nonce'         => md5(microtime() . mt_rand(1,99999999) . NONCE_KEY),
        );
        echo '<p>' . esc_html__('Adding a new order for order id', 'ebook-store') . ' #' . esc_html($post_ids[$step]) . '</p>';
        echo '<p>' . esc_html($step + 1) . ' / ' . esc_html(count($post_ids)) . '</p>';
        ebook_store_add_order($new_order_data);
        $step++;
        ?>
        <form method="get" id="ebook_store_add_issue_form" action="edit.php">
            <input type="hidden" name="post_type" value="ebook">
            <input type="hidden" name="page" value="ebook-store-add-issue-page">
            <input type="hidden" name="ebook_id" value="<?php echo esc_attr($ebook_id); ?>">
            <input type="hidden" name="new_issue_purchase_period" value="<?php echo esc_attr($new_issue_purchase_period); ?>">
            <input type="hidden" name="new_issue_ebook_id" value="<?php echo esc_attr($new_issue_ebook_id); ?>">
            <input type="hidden" name="action" value="go">
            <input type="hidden" name="step" value="<?php echo esc_attr($step); ?>">
            <?php wp_nonce_field('process_new_issue'); ?>
        </form>
        <script>
        jQuery(document).ready(function() {
            <?php if ($step < count($post_ids)) : ?>
                jQuery('#ebook_store_add_issue_form').submit();
            <?php endif; ?>
        });
        </script>
        <?php
        break;

    case 'ajax_get_orders_count':
        $ebook_id = isset($_REQUEST['ebook_id']) ? absint($_REQUEST['ebook_id']) : 0;
        $raw_period = isset($_REQUEST['new_issue_purchase_period']) ? wp_unslash($_REQUEST['new_issue_purchase_period']) : '';
        $new_issue_purchase_period = preg_replace('/[^0-9a-z\s]/i', '', $raw_period);

        $args = array(
            'post_type'           => 'ebook_order',
            'posts_per_page'      => -1,
            'ignore_sticky_posts' => 1,
            'meta_key'            => 'ebook',
            'meta_value'          => $ebook_id,
            'date_query'          => array(
                array(
                    'after' => $new_issue_purchase_period . ' ago',
                )
            )
        );

        $the_posts = new WP_Query($args);
        $count = $the_posts->post_count;

        die('<div class="ajax_get_orders_count">' . esc_html($count) . ' ' . esc_html__('Records found', 'ebook-store') .  '</div>');
        break;

    default:
        ?>
        <h1><?php echo esc_html__('Orders - Add New Issue', 'ebook-store'); ?></h1>
        <p><?php echo wp_kses_post(__('This feature will generate new orders and allow people who previously purchased a certain ebook to download the new issue. Like a magazine subscription. <br /><b>Use the purchase period field to enter the period back in time for which the orders will be processed. If you set it for 1 year, only orders placed in the last year will be processed and customers will be sent the new issue / version of the magazine / book.</b>', 'ebook-store')); ?></p>
        <form method="get" action="edit.php">
            <input type="hidden" name="post_type" value="ebook">
            <input type="hidden" name="page" value="ebook-store-add-issue-page">
            <?php wp_nonce_field('process_new_issue'); ?>
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row"><label for="ebook_id"><?php echo esc_html__('Select Ebook', 'ebook-store'); ?></label></th>
                    <td>
                        <?php
                        $args = array(
                            'depth'                 => 0,
                            'child_of'              => 0,
                            'selected'              => 0,
                            'echo'                  => 1,
                            'name'                  => 'ebook_id',
                            'id'                    => 'past_order_ebook_id',
                            'class'                 => null,
                            'show_option_none'      => '-- ' . __('Select') . ' --',
                            'show_option_no_change' => null,
                            'option_none_value'     => null,
                            'post_type'             => 'ebook',
                        );
                        wp_dropdown_pages($args);
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="new_issue_ebook_id"><?php echo esc_html__('Select Ebook (new Issue)', 'ebook-store'); ?></label></th>
                    <td>
                        <?php
                        $args = array(
                            'depth'                 => 0,
                            'child_of'              => 0,
                            'selected'              => 0,
                            'echo'                  => 1,
                            'name'                  => 'new_issue_ebook_id',
                            'id'                    => 'new_issue_ebook_id',
                            'class'                 => null,
                            'show_option_none'      => '-- ' . __('Select') . ' --',
                            'show_option_no_change' => null,
                            'option_none_value'     => null,
                            'post_type'             => 'ebook',
                        );
                        wp_dropdown_pages($args);
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo esc_html__('Purchase Period', 'ebook-store'); ?></th>
                    <td>
                        <input type="text" name="new_issue_purchase_period" id="new_issue_purchase_period" value="<?php echo esc_attr(get_option('link_expiration','1 year')); ?>" />
                    </td>
                </tr>
                <tr>
                    <th></th>
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
        </form>
        <?php
        break;
}
?>
