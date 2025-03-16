<?php settings_fields( 'ebook-settings-group-general' ); ?>
<?php do_settings_sections( 'ebook-settings-group-general' ); ?>

       <!-- License Information -->
       <tr valign="top">
           <th colspan="2" scope="row"><h3><?php echo __('License Information', 'ebook-store'); ?></h3></th>
       </tr>
       
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
       <th scope="row"><?php echo __('Pro License Key', 'ebook-store'); ?></th>
       <td><input type="email" name="ebook_store_license_key" style="width:250px;" value="<?php echo sanitize_email(get_option('ebook_store_license_key',$op->ebook_store_license_key)); ?>" placeholder="(Pro only) your@paypal.email" /><span class="description"><?php echo __('If you purchased the full version of the plugin, just fill in your PayPal email used when ordering and you will be able to unlock the pro features and keep them active after updating.', 'ebook-store'); ?></span></td>
       </tr>

       <!-- Language & Localization -->
       <tr valign="top">
           <th colspan="2" scope="row"><h3><?php echo __('Language & Localization', 'ebook-store'); ?></h3></th>
       </tr>
       
       <tr valign="top" class="goPro">
               <tr valign="top">
       <th scope="row"><?php echo __('Store Display Language', 'ebook-store'); ?></th>
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
       <?php echo __('Choose a specific language for your store frontend, overriding the WordPress site language.', 'ebook-store'); ?>
       </td>
       <tr valign="top" class="goPro">

       <!-- Download Settings -->
       <tr valign="top">
           <th colspan="2" scope="row"><h3><?php echo __('Download Settings', 'ebook-store'); ?></h3></th>
       </tr>
       
       <tr valign="top">
       <th scope="row"><?php echo __('Download Link Expiration', 'ebook-store'); ?></th>
       <td><input type="text" name="link_expiration" value="<?php echo esc_attr( get_option( 'link_expiration', $op->link_expiration ) ); ?>" placeholder="1 year" />
       <?php echo __('Set how long download links remain active. Examples: "1 year", "12 months", "120 days", "168 hours".', 'ebook-store'); ?>
       </td>
       </tr>


       <tr valign="top">
       <th scope="row"><?php echo __('Maximum Download Attempts', 'ebook-store'); ?></th>
       <td><input type="text" name="downloads_limit" value="<?php echo esc_attr(get_option('downloads_limit',$op->downloads_limit) ); ?>" placeholder="3" />
       <span class="description"><?php echo __('Maximum number of times a customer can download their purchase before the link becomes inactive.', 'ebook-store'); ?></span>
       </td>
       </tr>

       <!-- Email Delivery -->
       <tr valign="top">
           <th colspan="2" scope="row"><h3><?php echo __('Email Delivery', 'ebook-store'); ?></h3></th>
       </tr>
       
       <tr valign="top">
       <th scope="row"><?php echo __('Send Order Confirmation Emails', 'ebook-store'); ?></th>
       <td><input type="checkbox" name="email_delivery"  value="1" <?php echo (esc_attr( get_option('email_delivery',$op->email_delivery)) != '' ? 'checked="checked"' : ''); ?> />
       <span class="description"><?php echo __('Send customers an email with their order details and download links after purchase.', 'ebook-store'); ?></span>
       </td>
       </tr>

       <tr valign="top">
       <th scope="row"><?php echo __('Include eBook as Email Attachment', 'ebook-store'); ?></th>
       <td><input type="checkbox" name="attach_files"  value="1" <?php echo (esc_attr(get_option('attach_files')) != '' ? 'checked="checked"' : ''); ?> />
           <span class="description"><?php echo __('Attach a copy of the purchased eBook directly to the confirmation email (in addition to download links).', 'ebook-store'); ?></span>

           <?php echo var_export(get_option('attach_files')); ?>
       </td>
       </tr>

       <!-- Pricing & Tax -->
       <tr valign="top">
           <th colspan="2" scope="row"><h3><?php echo __('Pricing & Tax', 'ebook-store'); ?></h3></th>
       </tr>
       
       <tr valign="top">
       <th scope="row"><?php echo __('Tax Rate (%)', 'ebook-store'); ?></th>
       <td><input type="text" name="vat_percent" value="<?php echo esc_attr( get_option('vat_percent',$op->vat_percent) ); ?>" placeholder="0" />
       <span class="description"><?php echo __('Set the tax percentage to add to eBook prices. Enter 0 for no tax.', 'ebook-store'); ?></span>
       </td>
       </tr>

       <tr valign="top">
       <th scope="row"><?php echo __('Store Currency', 'ebook-store'); ?></th>
       <td>
           <select name="paypal_currency">
               <?php
                   // Define currencies with their support info
                   $ppcurencies = array(
                       // Both PayPal & Stripe
                       'USD' => array('name' => 'US Dollar', 'support' => 'PayPal & Stripe'),
                       'EUR' => array('name' => 'Euro', 'support' => 'PayPal & Stripe'),
                       'GBP' => array('name' => 'British Pound', 'support' => 'PayPal & Stripe'),
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
               <p class="description">Choose the currency for all transactions. Note that currency support varies between payment gateways.</p>
           </td>
       </tr>