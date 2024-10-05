<?php settings_fields( 'ebook-settings-group-hosting' ); ?>
<?php do_settings_sections( 'ebook-settings-group-hosting' ); 

?>
<tr valign="top" class="">
<th scope="row"><?php echo __('Hide this section', 'ebook-store'); ?></span></th>
<td><input type="checkbox" name="hideHostingSection"  value="1" <?php echo (get_option('hideHostingSection') != 0 ? 'checked="checked"' : ''); ?> /><span class="description">
<?php echo __('If you are not interested just check this box and you will never see this section again.', 'ebook-store'); ?>
</span></td>
</tr>

<tr valign="top" class="">
	<th scope="row">Our Managed Hosting Service</span></th>
	<td><p>Ebook Store users have a free month of cPanel web hosting with coupon code <b>EBOOKSTORE</b> at our SSD Powered WordPress optimized web hosting service at <a href="https://ssdshared.com/wordpress-ssd-web-hosting/" target="_blank">SSDShared.com</a></p>

		<p>
			The coupon matches the price of Mocha Latte plan ($4.99), which gives you a completely free fully functional hosting account, but you can use it on <b>all products and services</b>.
		</p>

		<h3>All customers on our hosting service can use the plugin for free!</h3>
		<p>
			We have the following offers for you:<br /><br />
			<a href="https://ssdshared.com/order/cart.php?a=add&pid=5&promocode=EBOOKSTORE" target="_blank"><img class="ebookStoreCoupon" src="<?php echo plugins_url( 'img/coupons1-min.png', __FILE__ ); ?>"></a>
			<p>Using the above coupon you will see $0.00 on the final step of the checkout!</p>
			<br />
			<br />
			<a href="https://ssdshared.com/order/cart.php?gid=1&promocode=EBOOKSTORE1YEAR" target="_blank"><img class="ebookStoreCoupon" src="<?php echo plugins_url( 'img/coupons2-min.png', __FILE__ ); ?>"></a>
				<p>This coupon will give you 50% discount on all Managed WordPress cPanel Web Hosting Plans when you buy for a year!</p>
		</p>

	</td>
</tr>

