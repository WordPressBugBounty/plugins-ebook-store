<?php settings_fields( 'ebook-settings-group-mailchimp' ); ?>
<?php do_settings_sections( 'ebook-settings-group-mailchimp' ); ?>
        <?php
        if (get_option('ebook_store_license_key') == '') {
            ?>
        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Upgrade to Pro', 'ebook-store'); ?></span></th>
        <td><?php echo __('These features are available in the Pro version, which you can find', 'ebook-store'); ?> <a href="http://www.shopfiles.com/index.php/products/wordpress-ebook-store" target="_blank" colspan="2"><?php echo __('here', 'ebook-store'); ?></a></td>
        </tr>
        <?php
        }
        ?>
        <tr valign="top" class="goPro">
        <th colspan="2" scope="row"> </th>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row">MailChimp API Key</th>
        <td><input type="text" name="mailchimp_api_key" style="width:500px;" value="<?php echo esc_attr(get_option('mailchimp_api_key',$op->mailchimp_api_key)); ?>" placeholder="<?php echo __('Get it from', 'ebook-store'); ?> https://admin.mailchimp.com/account/api-key-popup/" /></td>
        </tr>

        <tr valign="top" class="goPro">
        <th scope="row"><?php echo __('Subscribe buyers to MailChimp list', 'ebook-store'); ?></th>
        <td>
            <select name="mailchimp_lists">
        <?php 
        
        $mailchimp_lists = ebook_store_get_mailchimp_lists();
        //print_r($mailchimp_lists);
		if (is_array($mailchimp_lists)) {
			foreach ($mailchimp_lists as $list) {
				$selected = '';
				if ($list->id == esc_attr(get_option('mailchimp_lists'))) {
					$selected = ' selected';
				}
				echo "<option value=\"" . $list->id . "\"$selected>" . $list->name . "</option>";
			}
		}

        ?>
            </select> 
            <?php
$allow_url_fopen = ini_get('allow_url_fopen');
if (!$allow_url_fopen) {
    echo "<span style='background: red; border:1px solid yellow; padding:10px; display: inline-block;'><b>Warning:</b>allow_url_fopen php setting is disabled and the plugin will not be able to contact mailchimp to work with the API. Contact your hosting provider and ask for the setting to be enabled.</span>";
}
            ?>

<p>It is important to create a MailChimp API key from <a href="https://us19.admin.mailchimp.com/account/api/manage/#create" target="_blank">here</a> before you will be able to use it with the plugin.</p>

        </td>
        </tr>
