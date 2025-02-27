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

        <tr>
            <th scope="row">
                <label for="paypal_currency">Currency</label>
            </th>
            <td>
                <select name="paypal_currency" id="paypal_currency">
                    <?php
                    // Define currencies with payment method support
                    $ppcurencies = array(
                        'USD' => array('name' => 'US Dollar', 'support' => 'PayPal & Stripe'),
                        'EUR' => array('name' => 'Euro', 'support' => 'PayPal & Stripe'),
                        'GBP' => array('name' => 'Pounds Sterling', 'support' => 'PayPal & Stripe'),
                        'AUD' => array('name' => 'Australian Dollar', 'support' => 'PayPal & Stripe'),
                        'CAD' => array('name' => 'Canadian Dollar', 'support' => 'PayPal & Stripe'),
                        'JPY' => array('name' => 'Japan Yen', 'support' => 'PayPal & Stripe'),
                        'NZD' => array('name' => 'New Zealand Dollar', 'support' => 'PayPal & Stripe'),
                        'CHF' => array('name' => 'Swiss Franc', 'support' => 'PayPal & Stripe'),
                        'HKD' => array('name' => 'Hong Kong Dollar', 'support' => 'PayPal & Stripe'),
                        'SGD' => array('name' => 'Singapore Dollar', 'support' => 'PayPal & Stripe'),
                        'SEK' => array('name' => 'Sweden Krona', 'support' => 'PayPal & Stripe'),
                        'DKK' => array('name' => 'Danish Krone', 'support' => 'PayPal & Stripe'),
                        'NOK' => array('name' => 'Norwegian Krone', 'support' => 'PayPal & Stripe'),
                        'MXN' => array('name' => 'Mexican Pesos', 'support' => 'PayPal & Stripe'),
                        'PLN' => array('name' => 'Polish Złoty', 'support' => 'PayPal & Stripe'),
                        'BRL' => array('name' => 'Brazilian Real', 'support' => 'PayPal & Stripe'),
                        
                        // PayPal Only
                        'CZK' => array('name' => 'Czech Koruna', 'support' => 'PayPal only'),
                        'ILS' => array('name' => 'Israeli New Sheqel', 'support' => 'PayPal only'),
                        'HUF' => array('name' => 'Hungarian Forint', 'support' => 'PayPal only'),
                        'MYR' => array('name' => 'Malaysian Ringgit', 'support' => 'PayPal only'),
                        'PHP' => array('name' => 'Philippine Peso', 'support' => 'PayPal only'),
                        'TWD' => array('name' => 'Taiwan New Dollar', 'support' => 'PayPal only'),
                        'THB' => array('name' => 'Thai Baht', 'support' => 'PayPal only'),
                        'INR' => array('name' => 'Indian Rupee', 'support' => 'PayPal only'),
                        
                        // Stripe Only
                        'AED' => array('name' => 'United Arab Emirates Dirham', 'support' => 'Stripe only'),
                        'BGN' => array('name' => 'Bulgarian Lev', 'support' => 'Stripe only'),
                        'HRK' => array('name' => 'Croatian Kuna', 'support' => 'Stripe only'),
                        'COP' => array('name' => 'Colombian Peso', 'support' => 'Stripe only'),
                        'IDR' => array('name' => 'Indonesian Rupiah', 'support' => 'Stripe only'),
                        'ISK' => array('name' => 'Icelandic Króna', 'support' => 'Stripe only'),
                        'KRW' => array('name' => 'South Korean Won', 'support' => 'Stripe only'),
                        'LVL' => array('name' => 'Latvian Lat', 'support' => 'Stripe only'),
                        'RON' => array('name' => 'Romanian Leu', 'support' => 'Stripe only'),
                        'ZAR' => array('name' => 'South African Rand', 'support' => 'Stripe only')
                    );

                    // Get current currency
                    $current_currency = get_option('paypal_currency', 'USD');

                    // First show currencies that work with both payment methods
                    echo '<optgroup label="Supported by both PayPal and Stripe">';
                    foreach ($ppcurencies as $code => $details) {
                        if ($details['support'] === 'PayPal & Stripe') {
                            echo '<option value="' . esc_attr($code) . '" ' . selected($current_currency, $code, false) . '>';
                            echo esc_html($details['name']) . ' (' . esc_html($code) . ') ';
                            echo '</option>';
                        }
                    }
                    echo '</optgroup>';

                    // Then show PayPal-only currencies
                    echo '<optgroup label="PayPal Only">';
                    foreach ($ppcurencies as $code => $details) {
                        if ($details['support'] === 'PayPal only') {
                            echo '<option value="' . esc_attr($code) . '" ' . selected($current_currency, $code, false) . '>';
                            echo esc_html($details['name']) . ' (' . esc_html($code) . ') ';
                            echo '</option>';
                        }
                    }
                    echo '</optgroup>';

                    // Finally show Stripe-only currencies
                    echo '<optgroup label="Stripe Only">';
                    foreach ($ppcurencies as $code => $details) {
                        if ($details['support'] === 'Stripe only') {
                            echo '<option value="' . esc_attr($code) . '" ' . selected($current_currency, $code, false) . '>';
                            echo esc_html($details['name']) . ' (' . esc_html($code) . ') ';
                            echo '</option>';
                        }
                    }
                    echo '</optgroup>';
                    ?>
                </select>
                <p class="description">Select the currency to use for all transactions. Note that some currencies are only supported by either PayPal or Stripe.</p>
            </td>
        </tr>