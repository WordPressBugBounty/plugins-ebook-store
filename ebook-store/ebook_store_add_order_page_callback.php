<?php
error_reporting(E_ALL);
	if (@$_POST['action'] == 'add_order') {
		ebook_store_add_order($_POST['data']);
	}
	$new = new WP_Query('post_type=ebook&posts_per_page=-1');
	$ebooks = array();
	while ($new->have_posts()) : $new->the_post();
		$img_cover = get_post_meta(get_the_ID(), 'ebook_wp_custom_attachment_cover', true);
		$ebook = get_post_meta(get_the_ID(), 'ebook', true);
		if (is_array($ebook) == false ) { $ebook = array(); }
		$ebook['title'] = get_the_title();
		$ebook['id'] = get_the_ID();
		$ebooks[] = "<option value=\"$ebook[id]\">$ebook[title]</option>";
	endwhile;
	echo '
<form method="post">
	<h1>' . __('Orders - Add New', 'ebook-store') .'</h1>
<table class="form-table">
<tbody>

<tr>
<th scope="row"><label for="first_name">' . __('First Name', 'ebook-store') . '</label></th>
<td><input name="data[first_name]" type="text" id="first_name" aria-describedby="tagline-description" value="" placeholder="John" class="regular-text">
</td>
</tr>
<tr>
<th scope="row"><label for="last_name">' . __('Last Name', 'ebook-store') . '</label></th>
<td><input name="data[last_name]" type="text" id="last_name" aria-describedby="tagline-description" value="" placeholder="Smith" class="regular-text">
</td>
</tr>
<tr>
<th scope="row"><label for="mc_gross">' . __('Amount Paid', 'ebook-store') . '</label></th>
<td><input name="data[mc_gross]" type="text" id="mc_gross" aria-describedby="tagline-description" value="" placeholder="9.99" class="regular-text">
</td>
</tr>

<tr>
<th scope="row"><label for="ebook">' . __('Select Ebook', 'ebook-store') . '</label></th>
<td><select name="data[ebook]" type="text" id="ebook" value="WP2 Test" class="regular-text">
' . implode($ebooks) . '
</select></td>
</tr>
<tr>
<th scope="row"><label for="payer_email">' . __('Buyer Email', 'ebook-store') . '</label></th>
<td><input name="data[payer_email]" type="text" id="payer_email" aria-describedby="tagline-description" value="" placeholder="buyer@email.com" class="regular-text">
<p class="description" id="tagline-description">' . __('The buyer will be now send a thank you email with the appropriate download links for the ebook and it\'s formats.', 'ebook-store') . '.</p></td>
</tr>
</tbody></table>
' . get_submit_button() . '</p>
<h4>'.__('"Thank you" email will be sent immediately with the download links for the ebook. If encryption is enabled, the file will be encrypted.', 'ebook-store').'</h4>
<input type="hidden" name="action" value="add_order" />
</form>
';