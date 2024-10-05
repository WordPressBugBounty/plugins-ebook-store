<?php 

$QSWPOptions = new QSWPOptions();
		$content = get_option('thankyou_page',$QSWPOptions->thankyou_page);
		
		$ebook_order = ebook_get_order('ebook_key', $_REQUEST['ebook_key']);
		$time = strtotime(@$ebook_order['payment_date'][0]);
		//wp_die("$time-".time().'='.$time - time() );
		//print_r($ebook_order);
		if (@$ebook_order['item_name'][0] == '') {
			$ebook_order['item_name'][0] = get_the_title(@$ebook_order['ebook'][0]);
		}
		
		//wp_die('ebook order var ' . var_export($ebook_order,true));
		if (!$ebook_order ||  @strtotime($ebook_order['payment_date'][0]) == 0 || isset($ebook_order['ebook']) == false) { //  || time() < @strtotime($ebook_order['payment_date'][0]) + 25 ||
			return '<img src="' . plugins_url( 'img/pp_logo.png', __FILE__ ) . '"><h4>' . $locale['confirmation'] . '</h4>' . '<script>   window.setTimeout(\'location.reload()\', 5000);
</script>';
		}
		$file = get_post_meta($ebook_order['ebook'][0],'ebook_wp_custom_attachment',true);
		//wp_die(print_r($file,true));
		$ebook_order['downloadlink'][0] = ebook_download_link($ebook_order);
		$ebook_order['download_links'][0] = implode("<br />",ebook_download_links($ebook_order));
		$ebook_order['ebook_bonus'][0] = implode("<br />",ebook_download_links_bonus($ebook_order));
		$ebook_order['filesize'][0] = humanFileSize(filesize($file['file']));
		if (@$ebook_order['password'] == '') {
			$ebook_order['password'] = $ebook_order['payer_email'];
		}
		if (get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_1', true) != '') {
			$ebook_order['ebook_store_alternative_location_1'] = array(0 => '<p style="color:gray;">Download to Your Device: (This will take a very long time and requires some technical knowledge but we have provided an instructions page)</p><a href="' . get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_1', true) . '" target="_blank">
					<h1 style="color:red;"">Add to Your Device</h1>
				</a>');

		}
		if (get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_2', true) != '') {
			$ebook_order['ebook_store_alternative_location_2'] = array(0 => '<a href="' . get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_2', true) . '" target="_blank">
				<h1 style="color:red;">View Book Online Now</h1>
			</a>');
		}

		if (get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_3', true) != '') {
			$ebook_order['ebook_store_alternative_location_3'] = array(0 => '<a href="' . get_post_meta($ebook_order['ebook'][0],'ebook_store_alternative_location_3', true) . '" target="_blank">
				<h1 style="color:red;">Download PDF</h1>
			</a>');
		}
		foreach ($ebook_order as $k => $arr) {
			$content = str_replace('%%' . $k . '%%', $arr[0], $content);
		}
		return apply_filters('the_content',$content);

		?>