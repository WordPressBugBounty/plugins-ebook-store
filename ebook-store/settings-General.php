<?php settings_fields( 'ebook-settings-group-general' ); ?>
<?php do_settings_sections( 'ebook-settings-group-general' ); ?>
        <tr valign="top" class="goPro">
        <td><img src="<?php echo plugins_url( 'img/woologo.png', __FILE__ ); ?>">
        <br />
        <?php
        if (get_option('ebook_store_license_key') == '') {
            echo __('If you own the PRO version you can also enable Ebook Store to work with WooCommerce via the <a href="options-general.php?page=ebook_options.php&tab=Integrations">Integrations</a> page. See <a target="_blank" href="https://www.youtube.com/watch?v=kaEKQ0yTaWA">video demo</a>. <br />', 'ebook-store');
        } else {
            echo __('Thank you for choosing the full version of Ebook Store!', 'ebook-store');
        }
        ?>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php echo __('License key', 'ebook-store'); ?></th>
        <td><input type="email" name="ebook_store_license_key" style="width:250px;" value="<?php echo sanitize_email(get_option('ebook_store_license_key',$op->ebook_store_license_key)); ?>" placeholder="(Pro only) your@paypal.email" /><span class="description"><?php echo __('If you purchased the full version of the plugin, just fill in your PayPal email used when ordering and you will be able to unlock the pro features and keep them active after updating.', 'ebook-store'); ?></span></td>
        </tr>


        <tr valign="top" class="goPro">
                <tr valign="top">
        <th scope="row"><?php echo __('Frontend Language', 'ebook-store'); ?></th>
        <td>
        <select name="ebook_store_locale">
        <?php 
        //echo get_option('paypal_account');
        foreach ($languages as $locale_code => $name) {
            $selected = '';
            if ($locale_code == esc_attr(get_option('ebook_store_locale',$op->ebook_store_locale))) {
                $selected = ' selected';
            }
            echo "<option value=\"$locale_code\"$selected>$name</option>";
        }
        ?>
        </select> 
        <?php echo __('You can enforce language for the frontend in case you do not want to use the default one inherited from WordPress.', 'ebook-store'); ?>
        </td>
        <tr valign="top" class="goPro">

        
        <tr valign="top">
        <th scope="row"><?php echo __('Link Expiration', 'ebook-store'); ?></th>
        <td><input type="text" name="link_expiration" value="<?php echo esc_attr( get_option( 'link_expiration', $op->link_expiration ) ); ?>" placeholder="1 year" />
        <?php echo __('How long the link will remain active, possible formats are for example "1 year", "12 months", "120 days", "168 hours" etc.', 'ebook-store'); ?>
        </td>
        </tr>

                
        <tr valign="top">
        <th scope="row"><?php echo __('Downloads limit', 'ebook-store'); ?></th>
        <td><input type="text" name="downloads_limit" value="<?php echo esc_attr(get_option('downloads_limit',$op->downloads_limit) ); ?>" placeholder="3" />
        <span class="description"><?php echo __('After how many successful downloads (per order) link becomes inactive', 'ebook-store'); ?></span>
        </td>
        </tr>
                
        <tr valign="top">
        <th scope="row"><?php echo __('Email Delivery', 'ebook-store'); ?></th>
        <td><input type="checkbox" name="email_delivery"  value="1" <?php echo (esc_attr( get_option('email_delivery',$op->email_delivery)) != '' ? 'checked="checked"' : ''); ?> />
        <span class="description"><?php echo __('Send e-mails to customers containing order details, download link with all formats and a backup copy of the purchased ebook.', 'ebook-store'); ?></span>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php echo __('Attach Files', 'ebook-store'); ?></th>
        <td><input type="checkbox" name="attach_files"  value="1" <?php echo (esc_attr(get_option('attach_files')) != '' ? 'checked="checked"' : ''); ?> />
            <span class="description"><?php echo __('Add a copy of the purchased ebook as an attachment to the e-mail delivery e-mail message.', 'ebook-store'); ?></span>

            <?php echo var_export(get_option('attach_files')); ?>
        </td>
        </tr>
        
        
        <tr valign="top">
        <th scope="row"><?php echo __('VAT Percent', 'ebook-store'); ?></th>
        <td><input type="text" name="vat_percent" value="<?php echo esc_attr(get_option('vat_percent', '0')); ?>" placeholder="" />
            <span class="description"><?php echo __('Specify VAT Percentage if you want to use VAT. Use "20" for 20%.', 'ebook-store'); ?></span>
        </td>
        </tr>


        <tr valign="top" class="">
        <th scope="row"><?php echo __('Form Size (Scale ratio)', 'ebook-store'); ?></th>
        <td>
            <select name="form_scale">
        <?php 
        //echo get_option('paypal_account');
        for ($i=0;$i<300;$i++) {
            $selected = '';
            $form_scale = $i / 100;
            if ($form_scale == esc_attr(get_option('form_scale',$op->form_scale))) {
                $selected = ' selected';
            }
            echo "<option value=\"$form_scale\"$selected>$form_scale" . "</option>";
        }
        ?>
        </select>
        <span class="description"><?php echo __('If you want to scale the form and make it bigger you can use this setting. Example: Ratio 1.10 makes the form 10% bigger.', 'ebook-store'); ?></span>
        </td>
        </tr>
