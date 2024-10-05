<?php settings_fields( 'ebook-settings-group-templates' ); ?>
<?php do_settings_sections( 'ebook-settings-group-templates' ); ?>
        <tr>
        <th scope="row"><?php echo __('Thank You page', 'ebook-store'); ?>
        </th>
        <td valign="top">        
            <?php
$args = array(
    'depth'                 => 0,
    'child_of'              => 0,
    'selected'              => get_option('ebook_store_checkout_page'),
    'echo'                  => 1,
    'name'                  => 'ebook_store_checkout_page',
    'id'                    => null, // string
    'show_option_none'      => '-- Please select --', // string
    'show_option_no_change' => null, // string
    'option_none_value'     => '0', // string
    'post_type' => 'page'
);
wp_dropdown_pages($args);

            ?>
            <span class="description">
        <?php echo __('This page should contain the shortcode <b>[ebook_thank_you]</b>, where you want the "Thank you" page content to appear.', 'ebook-store'); ?>
        </span>
        </td>
        </tr>

        <tr>
        <th scope="row"><?php echo __('Order Cancelled Page', 'ebook-store'); ?>
        </th>
        <td valign="top">        
            <?php
$args = array(
    'depth'                 => 0,
    'child_of'              => 0,
    'selected'              => get_option('ebook_store_cancel_page'),
    'echo'                  => 1,
    'name'                  => 'ebook_store_cancel_page',
    'id'                    => null, // string
    'show_option_none'      => '-- Optional --', // string
    'show_option_no_change' => null, // string
    'option_none_value'     => '0', // string
    'post_type' => 'page'
);
wp_dropdown_pages($args);

            ?>
            <span class="description">
        <?php echo __('This page will be shown if the customer decides to cancel the order at PayPal.', 'ebook-store'); ?>
        </span>
        </td>
        </tr>


  <tr valign="top">
        <th scope="row"><?php echo __('Thank you page Content', 'ebook-store'); ?></th>
        <td><?php 
        $editor_id = 'thankyou_page';
        wp_editor( get_option('thankyou_page',$op->thankyou_page), $editor_id );
        ?>
            <p><small>Other possible keywords are: pdf_reader (requires pdf encryption enabled and blank password mode), mc_gross, protection_eligibility, payer_id, tax, payment_date, payment_status, charset, first_name, mc_fee, notify_version, custom, payer_status, business, quantity, verify_sign, payer_email, txn_id, payment_type, last_name, receiver_email, payment_fee, receiver_id, txn_type, item_name, mc_currency, item_number, residence_country, test_ipn, handling_amount, transaction_subject, payment_gross, shipping, ipn_track_id, all surrounded by %%Keyword%% as in the default page.</small></p>
        </td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php echo __('Email delivery content', 'ebook-store'); ?></th>
        <td><?php echo __('Subject', 'ebook-store'); ?>:<br /><input type="text" name="email_delivery_subject" value="<?php echo esc_attr(get_option('email_delivery_subject',$op->email_delivery_subject)); ?>" /><?php 
        $editor_id = 'email_delivery_text';
        wp_editor( get_option('email_delivery_text',$op->email_delivery_text), $editor_id );
        ?></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php echo __('Form Content', 'ebook-store'); ?></th>
        <td>
        <?php
        $editor_id = 'formContent';
        wp_editor( get_option('formContent',$op->formContent), $editor_id );
        ?></td>
        </tr>
        
        <?php
            do_action('ebook_settings_page_extend');
        ?>