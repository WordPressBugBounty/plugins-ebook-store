<?php settings_fields( 'ebook-settings-group-pdf-protection' ); ?>
<?php do_settings_sections( 'ebook-settings-group-pdf-protection' );
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
        <th scope="row"><?php echo __('Encrypt PDF Files', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="encrypt_pdf"  value="1" <?php echo (get_option('encrypt_pdf') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This will option will enable encrypted delivery, both via email as attachment (if enabled) and via site download. The password of the encrypted PDF file is always the buyer\'s PayPal email address.', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('QR Code', 'ebook-store'); ?>
        <span class="description">(<a href="http://shopfiles.com/samples/protected_cv.pdf" target="_blank"><?php echo __('see sample', 'ebook-store'); ?></a>, <?php echo __('PDF only', 'ebook-store'); ?>)</span></th>
        <td><input type="checkbox" name="qr_code"  value="1" <?php echo (get_option('qr_code') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('Once enabled, every page will have a QR code watermark on bottom right corner. Once scanned with any Android / iOS device it gives information for the buyer in case the file is pirated online / offline.', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Buyer Info in PDF header', 'ebook-store'); ?>
        </th>
        <td><input type="checkbox" name="buyer_info"  value="1" <?php echo (get_option('buyer_info') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This feature will print/watermark the buyer\'s information in the header of each page.', 'ebook-store'); ?></span></td>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Buyer info text', 'ebook-store'); ?></th>
        <td><input name="buyer_info_text" type="text" size="130" value="<?php 
        echo esc_attr(get_option('buyer_info_text',$op->buyer_info_text));
        ?>" /></td>
        
        </tr>        
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Use Random Password', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_random_password"  value="1" <?php echo (get_option('ebook_store_random_password') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('If this feature is enabled, instead of using buyer\'s email address as PDF password, the plugin will generate a random password which will be shown in the email and thank you page template.', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Use Blank Password', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="ebook_store_blank_password"  value="1" <?php echo (get_option('ebook_store_blank_password') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('If this feature is enabled the file will still be encrypted, but without password, which means the watermarking and print/modification will still work and the document will open without password.', 'ebook-store'); ?></span></td>
        </tr>

        
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Encrypt Free Files with Logged in user\'s email', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="encrypt_files_for_logged_in_users"  value="1" <?php echo (get_option('encrypt_files_for_logged_in_users') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This feature enables password encryption for free files if the user is logged in. The account email address is used for the encryption process.', 'ebook-store'); ?></span></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('PDF Master (Owner) password', 'ebook-store'); ?></th>
        <td><input name="ebook_store_owner_password" type="text" size="130" value="<?php 
        echo esc_attr(get_option('ebook_store_owner_password',$op->ebook_store_owner_password));
        ?>" placeholder="If left empty unique password will be generated for each file upon order confirmation." /></td>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('PDF User Password', 'ebook-store'); ?></th>
        <td><?php echo __('User password is always the PayPal email address of the buyer used when buying the PDF ebook.', 'ebook-store'); ?></td>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable PDF Printing', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="disable_pdf_printing"  value="1"  <?php echo (get_option('disable_pdf_printing') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This feature will disable printing for the PDF files you\'re selling.', 'ebook-store'); ?></span></td>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable Copy/Paste from PDF', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="disable_pdf_copy"  value="1"  <?php echo (get_option('disable_pdf_copy') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This feature will disable copying from the PDF files you\'re selling.', 'ebook-store'); ?></span></td>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable PDF Modification', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="disable_pdf_modify"  value="1"  <?php echo (get_option('disable_pdf_modify') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This feature will disable modifications for the PDF files you\'re selling.', 'ebook-store'); ?></span></td>
        </tr>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Disable Annotation forms', 'ebook-store'); ?></span></th>
        <td><input type="checkbox" name="disable_annot-forms"  value="1"  <?php echo (get_option('disable_annot-forms') != '' ? 'checked="checked"' : ''); ?> /><span class="description"><?php echo __('This feature will disable printing for the PDF files you\'re selling.', 'ebook-store'); ?></span></td>
        </tr>


        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Watermark Position', 'ebook-store'); ?></th>
        <td>
        <?php $ebook_store_buyer_info_position = esc_attr(get_option('ebook_store_buyer_info_position',$op->ebook_store_buyer_info_position)); ?>
<input class=""  name="ebook_store_buyer_info_position" type="radio" size="10" value="top" <?php echo ($ebook_store_buyer_info_position == 'top' ? 'checked' : '') ?>  /> <?php _e('top'); ?>
<input class=""  name="ebook_store_buyer_info_position" type="radio" size="10" value="middle" <?php echo ($ebook_store_buyer_info_position == 'middle' ? 'checked' : '') ?> /> <?php _e('middle'); ?>
<input class=""  name="ebook_store_buyer_info_position" type="radio" size="10" value="bottom" <?php echo ($ebook_store_buyer_info_position == 'bottom' ? 'checked' : '') ?> /> <?php _e('bottom'); ?>

        </td>
        </tr>  
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Watermark Mode', 'ebook-store'); ?></th>
        <td>
        <?php $ebook_store_watermark_mode = esc_attr(get_option('ebook_store_watermark_mode',$op->ebook_store_watermark_mode)); ?>
<input class=""  name="ebook_store_watermark_mode" type="radio" size="10" value="first" <?php echo ($ebook_store_watermark_mode == 'first' ? 'checked' : '') ?>  /> <?php _e('First Page'); ?>
<input class=""  name="ebook_store_watermark_mode" type="radio" size="10" value="every" <?php echo ($ebook_store_watermark_mode == 'every' ? 'checked' : '') ?> /> <?php _e('Every Page'); ?>

        </td>
        </tr>        


        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Watermark Color', 'ebook-store'); ?></th>
        <td><input class="color-picker"  name="ebook_store_watermark_color_hex" type="text" size="10" value="<?php 
        echo esc_attr(get_option('ebook_store_watermark_color_hex',$op->ebook_store_watermark_color_hex));
        ?>" /></td>
        </tr>        

