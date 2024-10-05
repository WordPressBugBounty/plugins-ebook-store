<?php settings_fields( 'ebook-settings-group-paypal' ); ?>
<?php do_settings_sections( 'ebook-settings-group-paypal' ); ?>
        <tr valign="top">
        <th scope="row"><?php echo __('PayPal account', 'ebook-store'); ?></th>
        <td><input type="email" name="paypal_account" value="<?php echo esc_attr(get_option('paypal_account')); ?>" placeholder="Your@PayPal" /><br />
        <span class="description"><?php echo __('Enter the e-mail of the PayPal account that will receive the payments.', 'ebook-store'); ?></span>
        <span class="description ebook_store_warning"><a href="https://www.paypal.com/cgi-bin/customerprofileweb?cmd=%5fprofile%2dipn%2dnotify" target="_blank">
        <?php echo __('enable PayPal IPN in your PayPal account</a>. That\'s under Profile > My selling tools > Instant payment notifications. In the IPN url field enter your website address.', 'ebook-store'); ?></span></td>
        </tr>
        
                <tr valign="top">
        <th scope="row"><?php echo __('PayPal currency', 'ebook-store'); ?></th>
        <td>
        <select name="paypal_currency">
        <?php 
        //echo get_option('paypal_account');
        foreach ($ppcurencies as $currency => $name) {
                        $selected = '';
                        if ($currency == esc_attr(get_option('paypal_currency',$op->paypal_currency))) {
                                $selected = ' selected';
                        }
                        echo "<option value=\"$currency\"$selected>$name</option>";
                }
        ?>
                </select> 
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php echo __('PayPal language', 'ebook-store'); ?></th>
        <td>
        <select name="paypal_language">
        <?php 
        //echo get_option('paypal_account');
        foreach ($lc as $lang => $name) {
                        $selected = '';
                        if ($lang == esc_attr(get_option('paypal_language'))) {
                                $selected = ' selected';
                        }
                        echo "<option value=\"$lang\"$selected>$name</option>";
                }
        ?>
                </select> 
        </td>
        </tr>
                </tr>
        <tr valign="top">
        <th scope="row"><?php echo __('PayPal Return to site button text', 'ebook-store'); ?></th>
        <td><input type="text" name="paypal_return_button_text" value="<?php echo esc_attr(get_option('paypal_return_button_text',$op->paypal_return_button_text)); ?>" placeholder="Click here to go to download page" /></td>
        </tr>
                <tr valign="top">
        <th scope="row">PayPal sandbox <span class="description">(<?php echo __('test mode', 'ebook-store'); ?>)</span></span></th>
        <td><input type="checkbox" class="paypal_sandbox" name="paypal_sandbox" value="1" <?php echo (get_option('paypal_sandbox') != '' ? 'checked="checked"' : ''); ?> />
        <span class="description"><?php echo __('Sandbox mode allows you to test without using real money, keep in mind that PayPal often delays the sandbox transactions IPN resulting in an infinity-loop like behaviour while waiting for order confirmation.', 'ebook-store'); ?></span>
        <?php
                echo (get_option('paypal_sandbox') != 0 ? '<br /><b>'.__('Please note that sandbox account logins are different from PayPal live mode and you must create accounts there too and enable PayPal IPN.', 'ebook-store') . '<br />' . __('​Sign up for a developer account <a href="https://developer.paypal.com/developer/accounts/" target="_blank">here</a>.', 'ebook-store') .'</b>' : "");

        ?>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php echo __('Allow eCheck via PayPal', 'ebook-store'); ?></th>
        <td><input type="checkbox" name="ebook_store_allow_echeck" value="1" <?php echo (get_option('ebook_store_allow_echeck') != '' ? 'checked="checked"' : ''); ?> />
        <span class="description"><?php echo __('This will enable users paying with eCheck via PayPal that takes days or up to a week to clear download before the actual payment arrives in your account. For more info on eCheck click', 'ebook-store'); ?> <a href="https://www.paypal.com/us/selfhelp/article/What-is-an-eCheck-FAQ1082" target="_blank"><?php echo __('here', 'ebook-store'); ?></a>.</span>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php echo __('PayPal Transaction Verification', 'ebook-store'); ?></th>
        <td><input type="checkbox" name="paypal_verify_transactions" value="1" <?php echo (get_option('paypal_verify_transactions',$op->paypal_verify_transactions) > 0 ? 'checked="checked"' : ''); ?> />
        <span class="description">(<?php echo __('turn off if experiencing problems', 'ebook-store'); ?>)</span></span>
        </td>
        </tr>
        
        <tr valign="top" class="">
        <th scope="row"><?php echo __('Ask buyer for address at PayPal', 'ebook-store'); ?></span></th>
        <td><select name="ebook_store_require_shipping"><option value="0"<?php echo (get_option('ebook_store_require_shipping') == '0' ? ' selected="selected"' : ''); ?>><?php echo __('Optional', 'ebook-store'); ?></option><option value="1"<?php echo (get_option('ebook_store_require_shipping') == '1' ? ' selected="selected"' : ''); ?>><?php echo __('Do not require address', 'ebook-store'); ?></option><option value="2"<?php echo (get_option('ebook_store_require_shipping') == '2' ? ' selected="selected"' : ''); ?>><?php echo __('Require Address', 'ebook-store'); ?></option></select></td>
        </tr>
