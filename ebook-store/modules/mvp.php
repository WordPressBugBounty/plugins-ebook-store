<?php

add_action( 'init', 'ebook_create_post_type_series', 98);
add_action('save_post', 'ebook_store_save_custom_meta_data_graduation'); 
add_action('ebook_store_extend_options','ebook_store_graduation_add_options');
add_action('ebook_settings_page_extend','ebook_store_graduation_options');


function ebook_create_post_type_series() {
		$labels = array(
			'name'               => 'Series',
			'singular_name'      => 'Series',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Series',
			'edit_item'          => 'Edit Series',
			'new_item'           => 'New Series',
			'all_items'          => 'Series',
			'view_item'          => 'View Series',
			'search_items'       => 'Search Series',
			'not_found'          => 'No Series found',
			'not_found_in_trash' => 'No Series found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Series',

	);

	$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'edit.php?post_type=ebook',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'series' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			//'menu_position'      => 5,
			'supports'           => array( 'title', 'thumbnail','comments' )
	);

	register_post_type( 'ebook_series', $args );
}
//add_filter('ebook_store_form_extend','ebook_store_graduation_dates', 9);
add_filter('ebook_store_form_extend','ebook_store_grad_date_and_series', 10);

function ebook_store_graduation_dates($post_id) {
	$month = get_post_meta($post_id, 'ebook_store_graduation_date_month', true);
	$year = get_post_meta($post_id, 'ebook_store_graduation_date_year', true);
	$day = get_post_meta($post_id, 'ebook_store_graduation_date_day', true);

	$out .= 'Graduation date:<br />';
	$out .= 'Month: ';
	$out .= '<select name="ebook_store_graduation_date_month"> ';
	for ($i=0; $i<12; $i++) {
		$k = $i+1;
		$out .= '<option' . ($k == $month ? ' selected="selected"' : '') . ' value="' . $k . '">'. $k . '</option>';
	}
	$out .= '</select>';

	$out .= 'Day: ';
	$out .= '<select name="ebook_store_graduation_date_day"> ';
	for ($i=0; $i<31; $i++) {
		$k = $i+1;
		$out .= '<option' . ($k == $day ? ' selected="selected"' : '') . ' value="' . $k . '">'. $k . '</option>';
	}
	$out .= '</select>';

	$out .= 'Year: ';
	$out .= '<select name="ebook_store_graduation_date_year"> ';
	for ($i=2015; $i<2100; $i++) {
		$k = $i+1;
		$out .= '<option' . ($k == $year ? ' selected="selected"' : '') . ' value="' . $k . '">'. $k . '</option>';
	}
	$out .= '</select>';




	$out .= '<br />';
	return $out;
}
function ebook_store_series($post_id) {
	$args = array('post_type' => 'ebook_series');
	$the_query = new WP_Query( $args );
	$ebook_store_graduation_date_series = get_post_meta($post_id, 'ebook_store_graduation_date_series', true);
	// The Loop
	if ( $the_query->have_posts() ) {
		$out .= 'Series<br />';
		$out .= '<select name="ebook_store_graduation_date_series">' ;
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$selected = '';
			if ($ebook_store_graduation_date_series == get_the_title()) {
				$selected = ' selected';
			}
			$out .= '<option' . $selected . '>' . get_the_title() . '</option>';
		}
		$out .= '</select>';
	}	
	$out .= '<br />';
	return $out;
}
function ebook_store_grad_date_and_series($post_id) {
	$post_id = $_GET['post'];
	$out .= ebook_store_series($post_id);	
	$out .= ebook_store_graduation_dates($post_id);	
	return $out;
}
function ebook_store_save_custom_meta_data_graduation($post_id) {
	update_post_meta($post_id, 'ebook_store_graduation_date_day', $_POST['ebook_store_graduation_date_day']);
	update_post_meta($post_id, 'ebook_store_graduation_date_month', $_POST['ebook_store_graduation_date_month']);
	update_post_meta($post_id, 'ebook_store_graduation_date_year', $_POST['ebook_store_graduation_date_year']);
	update_post_meta($post_id, 'ebook_store_graduation_date_series', $_POST['ebook_store_graduation_date_series']);
	//
}
add_shortcode('ebook_store_graduation_form', 'ebook_store_graduation_form');
function ebook_store_graduation_form() {
	// if (is_user_logged_in() == false) {
	// 	return 'You need to be logged in the site in order to be able to download the yearbook. Please use <a href="' . wp_login_url() . '">this</a> link to login.';
	// }
	$args = array('post_type' => 'ebook_series');
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$selected = '';
			if ($ebook_store_graduation_date_series == get_the_title()) {
				$selected = ' selected';
			}
			$series_options .= '<option' . $selected . '>' . get_the_title() . '</option>';
		}
		$series_options .= '</select>';
	}	
	$current_user = wp_get_current_user();

	for ($i=1;$i<32; $i++) @$day_options .= '<option value="' . $i . '">' . $i . '</option>';
	for ($i=2016;$i<2030; $i++) @$year_options .= '<option value="' . $i . '">' . $i . '</option>';
	return '<form class="form-horizontal" method="post" action="">
	<input type="hidden" name="task" value="grad_submit" />
<fieldset>

<!-- Form Name -->
<legend>Enter your graduation information</legend>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="day">Day</label>
  <div class="col-md-4">
    <select id="day" name="day" class="form-control">
      ' . $day_options . '
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="month">Month</label>
  <div class="col-md-4">
    <select id="month" name="month" class="form-control">
      <option value="1">January</option>
      <option value="2">February</option>
      <option value="3">March</option>
      <option value="4">April</option>
      <option value="5">May</option>
      <option value="6">June</option>
      <option value="7">July</option>
      <option value="8">August</option>
      <option value="9">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="year">Year</label>
  <div class="col-md-4">
    <select id="year" name="year" class="form-control">
      ' . $year_options . '
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="series">Series</label>
  <div class="col-md-4">
    <select id="series" name="series" class="form-control">
      ' . $series_options . '
    </select>
  </div>
</div>
<!-- Text Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="series">Personal Code</label>
  <div class="col-md-4">
    <input type"text" name="code" class="form-control" value="" />
  </div>
</div>
<!-- Text Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="series">Email</label>
  <div class="col-md-4">
    <input type="email" name="email" class="form-control" value="' . $current_user->user_email . '" />
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit">Submit and Download</label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>
';
}
add_action('init', 'grad_submit');
function grad_submit() {
	if (@$_POST['task'] == 'grad_submit') {
		$args = array('post_type' => 'ebook',
			'meta_query' => array(
				array(
					'key'     => 'ebook_store_graduation_date_series',
					'value'   => $_POST['series'],
					'compare' => '=',
				),
				array(
					'key'     => 'ebook_store_graduation_date_year',
					'value'   => $_POST['year'],
					'compare' => '=',
				),
				array(
					'key'     => 'ebook_store_graduation_date_month',
					'value'   => $_POST['month'],
					'compare' => '=',
				),
				array(
					'key'     => 'ebook_store_graduation_date_day',
					'value'   => $_POST['day'],
					'compare' => '=',
				),
			),
		);
		if (get_option('graduation_notification_email')) {
			$graduation_notification_email = esc_attr(get_option('graduation_notification_email'));
			$mail_text = esc_attr(get_option('graduation_notification_email_text'));
			foreach ($_POST as $pk => $pv) {
				$search[] = '%%' . $pk . '%%';
				$replace[] = $pv;
			}
			$mail_text = str_replace($search, $replace, $mail_text);
		}
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			wp_mail($graduation_notification_email, 'Notification for new download',$mail_text);

			while ( $the_query->have_posts() ) {
				//wp_die('post found!');
				$the_query->the_post();
				$current_user = wp_get_current_user();
				$checkoutPage = esc_attr(get_option('ebook_store_checkout_page'));
				$order_id = ebook_store_add_order(array(
					'mc_gross' => 0,
					'payer_email' => $current_user->user_email,
					'first_name' => $current_user->user_firstname,
					'last_name' => $current_user->user_lastname,
					'ebook' => get_the_ID(),
				), true);
				$link = add_query_arg(array('ebook_key' => get_post_meta($order_id, 'ebook_key',true), 'action' => 'thank_you'),get_permalink($checkoutPage));

				header("Location: $link");
				die($link);
//				die();
//				wp_reset_query();
				return true;
			}
		}	
		wp_die('No yearbook has been found for the selected graduation date and series, please check your information and try again.');
	}
}
function ebook_store_graduation_add_options() {
	register_setting( 'ebook-settings-group', 'graduation_notification_email' );
	register_setting( 'ebook-settings-group', 'graduation_notification_email_text' );
	//wp_die('action started');
}

function ebook_store_graduation_options() {
	?>
        <tr valign="top">
        <th scope="row">Graduation notification email</th>
        <td><input type="text" name="graduation_notification_email" style="width:250px;" value="<?php echo get_option('graduation_notification_email',$op->graduation_notification_email); ?>" placeholder="andys@gmail.com" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Notification email content</th>
        <td>
        <?php
        $editor_id = 'graduation_notification_email_text';
        wp_editor( get_option('graduation_notification_email_text',$op->graduation_notification_email_text), $editor_id );
        ?></td>
        </tr>       <?php
}