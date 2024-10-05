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
        <tr valign="top" class="goPro">
        <th scope="row" class="goPro"><?php echo __('Integrate with WooCommerce', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_woocommerce_integration"  value="1" <?php echo (get_option('ebook_store_woocommerce_integration') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('This feature will let you assign ebook store items to your WooCommerce products which lets you benefit from the PDF protection features of the plugin but also use all payment gateways available for WooCommerce.', 'ebook-store'); ?><br /> <a href="https://www.youtube.com/watch?v=kaEKQ0yTaWA" target="_blank"><?php echo __('See video demo of WooCommerce integration', 'ebook-store'); ?></a>
        </span></td>
        </tr>
     
        <tr valign="top" class="goPro">
        <th scope="row" class="goPro"><?php echo __('Hide WooCommerce Added To Cart Message', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_woocommerce_integration_no_added_to_cart"  value="1" <?php echo (get_option('ebook_store_woocommerce_integration_no_added_to_cart') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('If this feature is enabled, no message will be displayed when item is added to WooCommerce cart if integration with WooCommerce is enabled.'); ?>
        </span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row" class="goPro"><?php echo __('Require specific order status in WooCommerce for Downloads', 'ebook-store'); ?></span></th>
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
            <?php echo __('If you select a specific order status, the Downloads table will show only if the status matches the one specified here.'); ?>
        </span></td>
        </tr>
     
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('WooCommerce - Enable Online Reader', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_woocommerce_pdf_reader"  value="1" <?php echo (get_option('ebook_store_woocommerce_pdf_reader') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('This will add a "Read Online" link to your WooCommerce order confirmation page so customers can read the ebook online instead of downloading it. Encryption must be off for JavaScript to be able to parse your PDF file.', 'ebook-store'); ?>
        </span></td>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable Auto refresh if the encryption is still in progress.', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_no_autorefresh"  value="1" <?php echo (get_option('ebook_store_no_autorefresh') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('If you experience multiple downloads starting at once after encryption of large files, enable this feature to resolve the problem. It will show a retry download link instead of doing automated refresh.', 'ebook-store'); ?>
        </span></td>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Integrate with WP Affiliates Manager', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_wp_affiliate_integration"  value="1" <?php echo (get_option('ebook_store_wp_affiliate_integration') != '' ? 'checked="checked"' : ''); ?> /><span class="description">
            <?php echo __('Enable integration with', 'ebook-store'); ?> <a href="https://wordpress.org/plugins/affiliates-manager/" target="_blank">WP Affiliates Manager</a> <?php echo __('and pay commissions to affiliates that promote your ebook', 'ebook-store'); ?>.
        </span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Fill a form upon order', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="formEnabled"  value="1" <?php echo (get_option('formEnabled') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('If this feature is enabled the user will be asked to fill in a form with more details, the form you can edit as you wish with your own html editor and paste the code on this page\'s section with the form content.', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
  <th scope="row"><?php echo __('Force WP Forms to be used instead of default form', 'ebook-store'); ?></th>
  <td>
    <input type="checkbox" name="ebook_store_wpforms_default_form_force" value="1" <?php echo (get_option('ebook_store_wpforms_default_form_force') != '' ? 'checked="checked"' : ''); ?> />
    <span class="description"><?php echo __('If this feature is enabled, WP Forms will be used instead of the default form.', 'ebook-store'); ?></span>
  </td>
</tr>


        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable cover clicking', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="ebook_store_disable_cover_buy_now"  value="1" <?php echo (get_option('ebook_store_disable_cover_buy_now') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This can be enabled in combination with the option below, to prevent standalone orders and use only WooCommerce cart.', 'ebook-store'); ?></span></td>
        </tr>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Hide Buy Now button', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="ebook_store_hide_buy_now"  value="1" <?php echo (get_option('ebook_store_hide_buy_now') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This feature is useful when WooCommerce integration is used and you want to disallow standalone orders', 'ebook-store'); ?></span></td>
        </tr>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Require @kindle.com email for delivery', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="kindleDelivery"  value="1" <?php echo (get_option('kindleDelivery') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('You can use that with combination of "Fill a form feature" to get the kindle email of the user (use field name "kindle_email").', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Read online and disallow download', 'ebook-store'); ?>
        </th>
        <td><span class="description"><?php echo __('Use %%pdf_reader%% in Thank You page body to activate it. The keyword will be replaced with a PDF Viewer instead. See <a href="http://viewerjs.org" target="_blank">DEMO</a> here.', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Auto register buyers', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="ebook_store_silent_registration"  value="1" <?php echo (get_option('ebook_store_silent_registration') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('Once the customers complete payment for your ebook, a new account will be created for them and order will be assigned to their account so they can access it under Downloads page.', 'ebook-store'); ?></span></td>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable ViewerJS for previews', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="ebook_store_no_viewerjs_previews"  value="1" <?php echo (get_option('ebook_store_no_viewerjs_previews') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('If your preview files have troubles with embedded links when customers are browsing the previews file, this will turn it off.', 'ebook-store'); ?></span></td>
        </tr>
