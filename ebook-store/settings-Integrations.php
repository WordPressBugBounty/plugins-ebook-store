<?php settings_fields( 'ebook-settings-group-integrations' ); ?>
<?php do_settings_sections( 'ebook-settings-group-integrations' ); ?>
        
        <?php
        if (get_option('ebook_store_license_key') == '') {
            ?><tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Upgrade to Pro', 'ebook-store'); ?></span></th>
        <td><?php echo __('These features are available in the Pro version, which you can find', 'ebook-store'); ?> <a href="http://www.shopfiles.com/index.php/products/wordpress-ebook-store" target="_blank" colspan="2"><?php echo __('here', 'ebook-store'); ?></a></td>
        </tr>

        <tr valign="top" class="goPro">
        <th colspan="2" scope="row"> </th>
        </tr>
        <?php } ?>
        
        <!-- WooCommerce Integration Section -->
        <tr valign="top">
            <th colspan="2" scope="row"><h3><?php echo __('WooCommerce Integration', 'ebook-store'); ?></h3></th>
        </tr>
        
        <tr valign="top" class="goPro">
        <th scope="row" class="goPro"><?php echo __('Enable WooCommerce Integration', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_woocommerce_integration"  value="1" <?php echo (get_option('ebook_store_woocommerce_integration') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('Connect your eBooks to WooCommerce products to use WooCommerce payment gateways while keeping PDF protection features.', 'ebook-store'); ?><br /> <a href="https://www.youtube.com/watch?v=kaEKQ0yTaWA" target="_blank"><?php echo __('Watch video tutorial', 'ebook-store'); ?></a>
            <p>
                    <?php _e( '<b>If you plan to use Ebook Store + WooCommerce integration, we recommend installing the free plugin <a target="_blank" href="https://wordpress.org/plugins/autocomplete-woocommerce-orders/">Autocomplete WooCommerce Orders</a> so you can set it up to automatically complete orders for virtual goods to avoid processing status and allow immediate email delivery.</b>', 'ebooks-store' ); ?>
            </p>
        </span></td>
        </tr>
     
        <tr valign="top" class="goPro">
        <th scope="row" class="goPro"><?php echo __('Hide "Added to Cart" Message', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_woocommerce_integration_no_added_to_cart"  value="1" <?php echo (get_option('ebook_store_woocommerce_integration_no_added_to_cart') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('Suppress the "Added to Cart" notification when customers add eBooks to their WooCommerce cart.'); ?>
        </span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row" class="goPro"><?php echo __('Required Order Status for Downloads', 'ebook-store'); ?></span></th>
        <td>
        <select name="ebook_store_woocommerce_required_order_status">
        <?php 
        //echo get_option('paypal_account');
        //processing, pending, on-hold, completed, cancelled, refunded, failed
        $wc_order_status = array(
                'completed' => __('Completed','woocommerce'),
                'pending' => __('Pending Payment','woocommerce'),
                'processing' => __('Processing','woocommerce'),
                'on-hold' => __('On Hold','woocommerce'),
                'cancelled' => __('Canceled','woocommerce'),
            );
        foreach ($wc_order_status as $status => $name) {
            $selected = '';
            if ($status == esc_attr(get_option('ebook_store_woocommerce_required_order_status', '0'))) {
                $selected = ' selected';
            }
            echo "<option value=\"$status\"$selected>$name</option>";
        }
        ?>
        </select>

        <span class="description">
            <?php echo __('Only allow customers to download eBooks when their WooCommerce order reaches this status.'); ?>
        </span></td>
        </tr>
     
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Enable Online PDF Reader', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_woocommerce_pdf_reader"  value="1" <?php echo (get_option('ebook_store_woocommerce_pdf_reader') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('Add a "Read Online" option to WooCommerce order pages so customers can read PDFs in their browser. Note: PDF encryption must be disabled for this feature to work.', 'ebook-store'); ?>
        </span></td>
        </tr>

        <!-- Display Options Section -->
        <tr valign="top">
            <th colspan="2" scope="row"><h3><?php echo __('Display & Purchase Options', 'ebook-store'); ?></h3></th>
        </tr>
        
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable Auto-Refresh During Encryption', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_no_autorefresh"  value="1" <?php echo (get_option('ebook_store_no_autorefresh') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('For large files: Shows a manual "Retry Download" button instead of auto-refreshing, preventing multiple simultaneous downloads when encryption takes time.', 'ebook-store'); ?>
        </span></td>
        </tr>
        
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable Cover Image Purchase', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="ebook_store_disable_cover_buy_now"  value="1" <?php echo (get_option('ebook_store_disable_cover_buy_now') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This can be enabled in combination with the option below, to prevent standalone orders and use only WooCommerce cart.', 'ebook-store'); ?></span></td>
        </tr>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Hide "Buy Now" Button', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="ebook_store_hide_buy_now"  value="1" <?php echo (get_option('ebook_store_hide_buy_now') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This feature is useful when WooCommerce integration is used and you want to disallow standalone orders', 'ebook-store'); ?></span></td>
        </tr>
        </tr>
        
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable Preview Viewer', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="ebook_store_no_viewerjs_previews"  value="1" <?php echo (get_option('ebook_store_no_viewerjs_previews') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('If your preview files have troubles with embedded links when customers are browsing the previews file, this will turn it off.', 'ebook-store'); ?></span></td>
        </tr>

        <!-- Customer Experience Section -->
        <tr valign="top">
            <th colspan="2" scope="row"><h3><?php echo __('Customer Experience', 'ebook-store'); ?></h3></th>
        </tr>
        
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Enable Customer Information Form', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="formEnabled"  value="1" <?php echo (get_option('formEnabled') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('If this feature is enabled the user will be asked to fill in a form with more details, the form you can edit as you wish with your own html editor and paste the code on this page\'s section with the form content.', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Use WPForms Instead of Default Form', 'ebook-store'); ?></th>
        <td>
          <input type="checkbox" name="ebook_store_wpforms_default_form_force" value="1" <?php echo (get_option('ebook_store_wpforms_default_form_force') != '' ? 'checked="checked"' : ''); ?> />
          <span class="description"><?php echo __('If this feature is enabled, WP Forms will be used instead of the default form.', 'ebook-store'); ?></span>
        </td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Enable Kindle Email Delivery', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="kindleDelivery"  value="1" <?php echo (get_option('kindleDelivery') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('You can use that with combination of "Fill a form feature" to get the kindle email of the user (use field name "kindle_email").', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Online Reading Mode', 'ebook-store'); ?>
        </th>
        <td><span class="description"><?php echo __('Use %%pdf_reader%% in Thank You page body to activate it. The keyword will be replaced with a PDF Viewer instead. See <a href="http://viewerjs.org" target="_blank">DEMO</a> here.', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Auto-Create Customer Accounts', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="ebook_store_silent_registration"  value="1" <?php echo (get_option('ebook_store_silent_registration') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('Once the customers complete payment for your ebook, a new account will be created for them and order will be assigned to their account so they can access it under Downloads page.', 'ebook-store'); ?></span></td>
        </tr>

        <!-- Third-Party Integrations Section -->
        <tr valign="top">
            <th colspan="2" scope="row"><h3><?php echo __('Third-Party Integrations', 'ebook-store'); ?></h3></th>
        </tr>
        
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Enable Affiliate Program Integration', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_wp_affiliate_integration"  value="1" <?php echo (get_option('ebook_store_wp_affiliate_integration') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('Connect with', 'ebook-store'); ?> <a href="https://wordpress.org/plugins/affiliates-manager/" target="_blank">WP Affiliates Manager</a> <?php echo __('to track and pay commissions to affiliates who promote and sell your eBooks.', 'ebook-store'); ?>.
        </span></td>
        </tr>

<?php
// Ensure we're able to use is_plugin_active()
if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if ( get_option('ebook_store_woocommerce_integration') && ! is_plugin_active( 'autocomplete-woocommerce-orders/autocomplete-woocommerce-orders.php' ) ) {
    echo '<div style="padding:10px; border:1px solid #ccc; background:#fff3cd; margin-bottom:20px;">
    <strong>Recommendation:</strong> The <em>Autocomplete WooCommerce Orders</em> plugin is not active. It is highly recommended to install and enable it for most WooCommerce setups so that orders with Virtual Goods are automatically marked as Completed. You can download and install it from <a href="https://wordpress.org/plugins/autocomplete-woocommerce-orders/" target="_blank">here</a>.
    </div>';
}
?>
