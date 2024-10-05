<?php settings_fields( 'ebook-settings-group-fonts' ); ?>
<?php do_settings_sections( 'ebook-settings-group-fonts' ); ?>

        <tr valign="top" class="">
        <th scope="row"><?php echo __('Ebook Title Font Size', 'ebook-store'); ?></th>
        <td>
            <select name="ebook_store_title_font_size">
        <?php 
        //echo get_option('paypal_account');
        for ($i=0;$i<200;$i++) {
            $selected = '';
            $ebook_store_title_font_size = $i / 100;
            if ($ebook_store_title_font_size == esc_attr(get_option('ebook_store_title_font_size',$op->ebook_store_title_font_size))) {
                $selected = ' selected';
            }
            echo "<option value=\"$ebook_store_title_font_size\"$selected>$ebook_store_title_font_size" . "em</option>";
        }
        ?>
        </select>
        </td>
        </tr>

        <tr valign="top" class="">
        <th scope="row"><?php echo __('Links Font Size', 'ebook-store'); ?></th>
        <td>
            <select name="ebook_store_buy_link_font_size">
        <?php 
        //echo get_option('paypal_account');
        for ($i=0;$i<200;$i++) {
            $selected = '';
            $ebook_store_buy_link_font_size = $i / 100;
            if ($ebook_store_buy_link_font_size == esc_attr(get_option('ebook_store_buy_link_font_size',$op->ebook_store_buy_link_font_size))) {
                $selected = ' selected';
            }
            echo "<option value=\"$ebook_store_buy_link_font_size\"$selected>$ebook_store_buy_link_font_size" . "em</option>";
        }
        ?>
        </select>
        </td>
        </tr>