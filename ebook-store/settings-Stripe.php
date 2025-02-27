<?php
if (!defined('ABSPATH')) exit;
ebook_store_stripe_settings();

function ebook_store_stripe_settings() {
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }

    // Get installed languages
    $installed_languages = get_available_languages();
    
    // Always include default language
    $active_languages = array(
        0 => __("Default")
    );
    
    // Define all supported languages
    $all_languages = array(
        'en' => 'English',
        'de' => 'German',
        'fr' => 'French',
        'es' => 'Spanish',
        'zh' => 'Chinese',
        'hi' => 'Hindi',
        'ru' => 'Russian',
        'jp' => 'Japanese',
        'tr' => 'Turkish',
        'fi' => 'Finnish',
        'it' => 'Italian'
    );

    // Only include languages that are installed
    foreach ($installed_languages as $lang_code) {
        $short_code = substr($lang_code, 0, 2); // Convert codes like 'en_US' to 'en'
        if (isset($all_languages[$short_code])) {
            $active_languages[$short_code] = $all_languages[$short_code];
        }
    }

    // Save settings if form was submitted
    if (isset($_POST['ebook_store_stripe_settings'])) {
        check_admin_referer('ebook_store_stripe_settings');
        
        update_option('stripe_publishable_key', sanitize_text_field($_POST['stripe_publishable_key']));
        update_option('stripe_secret_key', sanitize_text_field($_POST['stripe_secret_key']));
        update_option('stripe_webhook_secret', sanitize_text_field($_POST['stripe_webhook_secret']));
        update_option('stripe_cancel_url', esc_url_raw($_POST['stripe_cancel_url']));
        update_option('stripe_integration_enabled', isset($_POST['stripe_integration_enabled']) ? 1 : 0);
        
        // Save button text for each language
        $button_text = array();
        foreach ($active_languages as $code => $name) {
            if (isset($_POST['stripe_button_text'][$code])) {
                $button_text[$code] = sanitize_text_field($_POST['stripe_button_text'][$code]);
            }
        }
        update_option('stripe_button_text', $button_text);
        
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    // Get current values
    $publishable_key = esc_attr(get_option('stripe_publishable_key'));
    $secret_key = esc_attr(get_option('stripe_secret_key')); 
    $webhook_secret = esc_attr(get_option('stripe_webhook_secret'));
    $cancel_url = esc_url(get_option('stripe_cancel_url'));
    $integration_enabled = get_option('stripe_integration_enabled', 0);
    $button_text = get_option('stripe_button_text', array());
    
    // Set default button text if not set
    if (empty($button_text[0])) {
        $button_text[0] = 'Buy with Stripe (%%price%%)';
    }
    ?>

        <h2>Stripe Payment Settings</h2>
        <div class="stripe-upgrade-ad" style="background: #eef5f9; border: 1px solid #b3d7ff; padding: 10px; margin: 20px 0; <?php if (get_option('ebook_store_license_key') != '') { echo 'display: none;'; } ?>">
            <h3><?php _e('Upgrade to Ebook Store Pro', 'ebook-store'); ?></h3>
            <p><?php _e('Boost your sales by up to 30% when you upgrade to Ebook Store Pro! With the Pro version, you get an enhanced Stripe integration that adds a variety of payment options:', 'ebook-store'); ?></p>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('Apple Pay:', 'ebook-store'); ?></strong> <?php _e('Popular in the US and Europe, offering a fast and seamless checkout on Apple devices.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('Google Pay:', 'ebook-store'); ?></strong> <?php _e('Widely used on Android devices, ensuring simplicity and security globally.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('Credit Card:', 'ebook-store'); ?></strong> <?php _e('Accepted worldwide, enabling fast payments with extensive fraud protection.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('PayPal (via Stripe):', 'ebook-store'); ?></strong> <?php _e('A popular choice for online transactions with buyer protection and ease-of-use.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('Link:', 'ebook-store'); ?></strong> <?php _e('Provides secure, efficient reuse of stored payment details.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('Klarna:', 'ebook-store'); ?></strong> <?php _e('Favored in Europe, offering flexible installment options and financing benefits.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('CashApp Pay:', 'ebook-store'); ?></strong> <?php _e('Widely used in the US for quick, peer-to-peer transactions.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('US Bank Account Direct Debit:', 'ebook-store'); ?></strong> <?php _e('Preferred in the US for secure, low-cost direct debit transfers.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('Affirm:', 'ebook-store'); ?></strong> <?php _e('Offers buy-now, pay-later options that boost conversion rates.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('Afterpay:', 'ebook-store'); ?></strong> <?php _e('Popular in Australia and the US, enabling payment splits over time.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('WeChat Pay:', 'ebook-store'); ?></strong> <?php _e('Dominant in China, integrated with social platforms and trusted by local consumers.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('SEPA:', 'ebook-store'); ?></strong> <?php _e('The European standard for direct debits, ensuring low-cost, secure Euro transfers.', 'ebook-store'); ?>
                </li>
                <li style="margin-bottom: 10px;">
                    <strong><?php _e('AliPay:', 'ebook-store'); ?></strong> <?php _e('Predominantly used in China, offering a mobile-first, secure payment solution for global Chinese consumers.', 'ebook-store'); ?>
                </li>
            </ul>
            <p><?php _e('One integration empowers you with access to over 100+ payment processors worldwide—all from a single streamlined platform.', 'ebook-store'); ?></p>
            <p><a href="http://www.shopfiles.com/index.php/products/wordpress-ebook-store" target="_blank" class="button button-primary"><?php _e('Upgrade to Pro', 'ebook-store'); ?></a></p>
        </div>
        
            <?php 
            settings_fields('ebook-settings-group-stripe');
            do_settings_sections('ebook-settings-group-stripe');
            ?>
            
            <table class="form-table">
                <tr class="goPro">
                    <th scope="row">
                        <label for="stripe_integration_enabled">Enable Stripe</label>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" id="stripe_integration_enabled" 
                                   name="stripe_integration_enabled" value="1" 
                                   <?php checked(1, $integration_enabled); ?>>
                            Enable Stripe payment integration
                        </label>
                        <p class="description">Check this to enable Stripe as a payment method</p>
                    </td>
                </tr>

                <tr class="goPro">
                    <th scope="row">
                        <label>Button Text</label>
                    </th>
                    <td>
                        <?php foreach ($active_languages as $code => $name): ?>
                            <p>
                                <label>
                                    <?php echo $name; ?>:<br>
                                    <input type="text" 
                                           name="stripe_button_text[<?php echo $code; ?>]" 
                                           value="<?php echo esc_attr(isset($button_text[$code]) ? $button_text[$code] : ''); ?>" 
                                           class="regular-text"
                                           placeholder="<?php echo esc_attr($button_text[0]); ?>">
                                </label>
                            </p>
                        <?php endforeach; ?>
                        <p class="description">Enter the text to display on the Stripe payment button for each active language. If left empty, the default text will be used.</p>
                    </td>
                </tr>

                <tr class="goPro">
                    <th scope="row">
                        <label for="stripe_publishable_key">Publishable Key</label>
                    </th>
                    <td>
                        <input type="text" id="stripe_publishable_key" name="stripe_publishable_key" 
                               value="<?php echo $publishable_key; ?>" class="regular-text">
                        <p class="description">Your Stripe Publishable Key (starts with pk_)</p>
                    </td>
                </tr>

                <tr class="goPro">
                    <th scope="row">
                        <label for="stripe_secret_key">Secret Key</label>
                    </th>
                    <td>
                        <input type="text" id="stripe_secret_key" name="stripe_secret_key" 
                               value="<?php echo $secret_key; ?>" class="regular-text">
                        <p class="description">Your Stripe Secret Key (starts with sk_)</p>
                    </td>
                </tr>

                <tr class="goPro">
                    <th scope="row">
                        <label for="stripe_webhook_secret">Webhook Secret</label>
                    </th>
                    <td>
                        <input type="text" id="stripe_webhook_secret" name="stripe_webhook_secret" 
                               value="<?php echo $webhook_secret; ?>" class="regular-text">
                        <p class="description">Your Stripe Webhook Signing Secret (starts with whsec_)</p>
                    </td>
                </tr>

                <tr class="goPro">
                    <th scope="row">
                        <label for="stripe_cancel_url">Cancel URL</label>
                    </th>
                    <td>
                        <input type="url" id="stripe_cancel_url" name="stripe_cancel_url" 
                               value="<?php echo $cancel_url; ?>" class="regular-text">
                        <p class="description">URL to redirect if customer cancels payment</p>
                    </td>
                </tr>
            </table>



        <div class="stripe-setup-instructions">
            <h3>Setup Instructions</h3>
            <ol>
                <li>Create a Stripe account at <a href="https://stripe.com" target="_blank">stripe.com</a> if you haven't already</li>
                <li>Get your API keys from your <a href="https://dashboard.stripe.com/apikeys" target="_blank">Stripe Dashboard → Developers → API keys</a></li>
                <li>Set up a webhook in your <a href="https://dashboard.stripe.com/webhooks" target="_blank">Stripe Dashboard → Developers → Webhooks</a> pointing to: <code><?php echo site_url('wp-json/ebook-store/v1/stripe-webhook'); ?></code></li>
                <li>Copy the webhook signing secret from the webhook details page and add it above</li>
                <li>Set a cancel URL where customers will be redirected if they cancel payment</li>
            </ol>
        </div>
    <?php
} 