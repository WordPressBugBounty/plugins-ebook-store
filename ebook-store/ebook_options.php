<?php
// create custom plugin settings menu

add_action('admin_menu', 'ebook_create_menu');

function ebook_create_menu() {

    //create new top-level menu
    add_options_page('Ebook Store', 'Ebook Store', 'manage_options', 'ebook_options.php', 'ebook_settings_page');

}

if ( is_admin() ){ // admin actions
    add_action( 'admin_init', 'register_ebook_store_settings' );
} else {
    // non-admin enqueues, actions, and filters
}

function register_ebook_store_settings() {

    //register our settings
    //register_setting( 'ebook-settings-group-pdf-protection', 'pdf_orientation' );
    register_setting( 'ebook-settings-group-fonts', 'ebook_store_buy_link_font_size' );
    register_setting( 'ebook-settings-group-fonts', 'ebook_store_title_font_size' );
    register_setting( 'ebook-settings-group-general', 'attach_files' );
    register_setting( 'ebook-settings-group-general', 'downloads_limit' );
    register_setting( 'ebook-settings-group-general', 'ebook_store_license_key' );
    register_setting( 'ebook-settings-group-general', 'ebook_store_locale' );
    register_setting( 'ebook-settings-group-general', 'email_delivery' );
    register_setting( 'ebook-settings-group-general', 'link_expiration' );
    register_setting( 'ebook-settings-group-general', 'form_scale' );
    register_setting( 'ebook-settings-group-paypal', 'paypal_account' );
    register_setting( 'ebook-settings-group-general', 'vat_percent' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_woocommerce_integration' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_wp_affiliate_integration' );
    register_setting( 'ebook-settings-group-integrations', 'formEnabled' );
    register_setting( 'ebook-settings-group-integrations', 'kindleDelivery' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_woocommerce_integration_no_added_to_cart' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_woocommerce_required_order_status' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_disable_cover_buy_now' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_hide_buy_now' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_viewer_js' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_silent_registration' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_woocommerce_pdf_reader' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_no_autorefresh' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_no_viewerjs_previews' );
    register_setting( 'ebook-settings-group-integrations', 'ebook_store_wpforms_default_form_force' );
    
    register_setting( 'ebook-settings-group-mailchimp', 'mailchimp_api_key' );
    register_setting( 'ebook-settings-group-mailchimp', 'mailchimp_lists' );
    register_setting( 'ebook-settings-group-paypal', 'ebook_store_allow_echeck' );
    register_setting( 'ebook-settings-group-paypal', 'ebook_store_require_shipping' );
    register_setting( 'ebook-settings-group-paypal', 'paypal_currency' );
    register_setting( 'ebook-settings-group-paypal', 'paypal_language' );
    register_setting( 'ebook-settings-group-paypal', 'paypal_return_button_text' );
    register_setting( 'ebook-settings-group-paypal', 'paypal_sandbox' );
    register_setting( 'ebook-settings-group-paypal', 'paypal_verify_transactions' );
    register_setting( 'ebook-settings-group-pdf-protection', 'buyer_info' );
    register_setting( 'ebook-settings-group-pdf-protection', 'buyer_info_text' );
    register_setting( 'ebook-settings-group-pdf-protection', 'disable_annot-forms' );
    register_setting( 'ebook-settings-group-pdf-protection', 'disable_pdf_copy' );
    register_setting( 'ebook-settings-group-pdf-protection', 'disable_pdf_modify' );
    register_setting( 'ebook-settings-group-pdf-protection', 'disable_pdf_printing' );
    register_setting( 'ebook-settings-group-pdf-protection', 'ebook_store_blank_password' );
    register_setting( 'ebook-settings-group-pdf-protection', 'ebook_store_watermark_color_hex' );
    register_setting( 'ebook-settings-group-pdf-protection', 'ebook_store_buyer_info_position' );
    register_setting( 'ebook-settings-group-pdf-protection', 'ebook_store_watermark_mode' );
    
    
    register_setting( 'ebook-settings-group-templates', 'ebook_store_checkout_page' );
    register_setting( 'ebook-settings-group-pdf-protection', 'ebook_store_owner_password' );
    register_setting( 'ebook-settings-group-pdf-protection', 'ebook_store_random_password' );
    register_setting( 'ebook-settings-group-pdf-protection', 'encrypt_files_for_logged_in_users' );
    register_setting( 'ebook-settings-group-pdf-protection', 'encrypt_pdf' );
    register_setting( 'ebook-settings-group-pdf-protection', 'pdf_orientation' );
    register_setting( 'ebook-settings-group-pdf-protection', 'qr_code' );
    register_setting( 'ebook-settings-group-pdf-protection', 'ebook_store_pdfjs' );
    register_setting( 'ebook-settings-group-templates', 'thankyou_page' );
    register_setting( 'ebook-settings-group-templates', 'ebook_store_cancel_page' );
    register_setting( 'ebook-settings-group-templates', 'email_delivery_subject' );
    register_setting( 'ebook-settings-group-templates', 'email_delivery_text' );
    register_setting( 'ebook-settings-group-templates', 'formContent' );
    register_setting( 'ebook-settings-group-hosting', 'hideHostingSection' );
    register_setting( 'ebook-settings-group-general', 'ebookstorewpsc' ); //doesn't really matter where is assigned.
    
    do_action('ebook_store_extend_options');
}



function ebook_settings_page() {
    wp_register_style( 'ebookstorestylesheet', plugins_url('css/ebook_store.css', __FILE__) );
    wp_enqueue_style( 'ebookstorestylesheet' ); 

    if (@$_GET['task'] == 'fixThankYouPage') {
        $post = array(
            'ID'             => null,
            'post_content'   => '[ebook_thank_you]',
            'post_name'      => 'thank-you',
            'post_title'     => 'Thank you for ordering!',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            );  
        $post_id = wp_insert_post( $post, $wp_error );
        update_option('ebook_store_checkout_page',$post_id);
        
        $post = array(
            'ID'             => null,
            'post_content'   => '[ebook_store_downloads]',
            'post_name'      => 'my-ebook-orders',
            'post_title'     => 'My Ebook Orders',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            );  
        $post_id = wp_insert_post( $post, $wp_error );
        echo '<script>window.location = "options-general.php?page=ebook_options.php";</script>';
    }
    if (get_option('email_delivery') == 1) {
        if (is_plugin_active('easy-wp-smtp/easy-wp-smtp.php') == false) {
            ?>
                <div class="updated">
                        <p><?php echo __('You have enabled email delivery, we recommend using plugin <a href="plugin-install.php?tab=search&s=easy+wp+smtp">Easy WP SMTP</a> in order to make sure your WordPress emails are properly delivered.', 'ebook-store'); ?></p>
                </div>
            <?php
        }
    }
    if ($task == 'fixThankYouPageFeedback') {
            ?>
                <div class="updated">
                        <p><?php echo __('The "Thank You!" page has been successfully created and selected automatically!', 'ebook-store'); ?></p>
                </div>
            <?php

    }
    include_once('locale.php');
    $languages = array(
        0 => __("Default"),
        'en' => 'English',
        'de' => 'German',
        'fr' => 'French',
        'es' => 'Spanish',
        'zh' => 'Chinese',
        'hi' => 'Hindi',
        'ru' => 'Russian',
        'jp' => 'Japanese',
        'tr' => 'Turkish',
        'fi' => 'Finish',
        'it' => 'Italian',
        'ru' => 'Russian',
        );

    $op = new QSWPOptions();
$ppcurencies = array('USD' => 'US Dollar',
'EUR' => 'Euro',
'ILS' => 'Israeli New Sheqel',
'INR' => 'Indian Rupee',
'GBP' => 'Pounds Sterling',
'AUD' => 'Australian Dollar',
'CAD' => 'Canadian Dollar',
'JPY' => 'Japan Yen',
'NZD' => 'New Zealand Dollar',
'CHF' => 'Swiss Franc',
'HKD' => 'Hong Kong Dollar',
'SGD' => 'Singapore Dollar',
'SEK' => 'Sweden Krona',
'DKK' => 'Danish Krone',
'PLN' => 'New Zloty',
'NOK' => 'Norwegian Krone',
'HUF' => 'Forint',
'MXN' => 'Mexican Pesos',
'CZK' => 'Czech Koruna',
'BRL' => 'Brazilian Real',
'TWD' => 'Taiwan New Dollar',
'TRY' => 'Turkish Lira',
'MYR' => 'Malaysian Ringgit',
'ZAR' => 'South African Rands',
'NGN' => 'Nigerian Naira',
'RUB' => 'Russian Ruble',
'RON' => 'Romanian leu',
'THB' => 'Thai Baht');
    $lc = array(
'' => '-- Optional --',
'AU' => 'Australia',
'AT' => 'Austria',
'BE' => 'Belgium',
'BR' => 'Brazil',
'CA' => 'Canada',
'CH' => 'Switzerland',
'CN' => 'China',
'DE' => 'Germany',
'ES' => 'Spain',
'GB' => 'United Kingdom',
'FR' => 'France',
'IR' => 'Ireland',
'IT' => 'Italy',
'NL' => 'Netherlands',
'PL' => 'Poland',
'PT' => 'Portugal',
'RU' => 'Russia',
'US' => 'United States',
'da_DK' => 'Danish',
'he_IL' => 'Hebrew',
'id_ID' => 'Indonesian',
'jp_JP' => 'Japanese',
'no_NO' => 'Norwegian',
'pt_BR' => 'Brazilian Portuguese',
'ru_RU' => 'Russian',
'sv_SE' => 'Swedish',
'th_TH' => 'Thai',
'tr_TR' => 'Turkish',
'zh_CN' => 'Chinese (China)',
'zh_HK' => 'Chinese (Hong Kong)',
'zh_TW' => 'Chinese (Taiwan)'
        );

wp_enqueue_script( 'ebook_store_settings', plugins_url( '/js/ebook_store_settings.js' , __FILE__ ), array(), '1.0.0', true );

ebook_store_wp_super_cache_warning();
    ?>


<h2><?php echo __('eBook Store', 'ebook-store'); ?> - <?php echo __('Settings', 'ebook-store'); ?>
<?php if (get_option('ebook_store_license_key') == '') { ?>
 FREE (<a href="https://www.shopfiles.com/index.php/products/wordpress-ebook-store" target="_blank"><?php echo __('Upgrade to Pro', 'ebook-store'); ?></a>)
<?php } ?>
</h2>
<?php

$tab = $_GET['tab'];
if ($tab == '') { $tab = 'General'; }

$tabs = array();


$tabs['General'] = __('General', 'ebook-store');
$tabs['Integrations'] = __('Integrations', 'ebook-store');
$tabs['PayPal'] = __('PayPal', 'ebook-store');
$tabs = apply_filters('ebook_store_options_add_tab',$tabs);
$tabs['Fonts'] = __('Fonts', 'ebook-store');
$tabs['PDF-Protection'] = __('PDF-Protection', 'ebook-store');
$tabs['MailChimp'] = __('MailChimp', 'ebook-store');
$tabs['Templates'] = __('Templates', 'ebook-store');
if (get_option( 'hideHostingSection', 0 ) == 0) {
    $tabs['Hosting'] = __('Coupon Code for Hosting', 'ebook-store');    
}




?>
<nav class="nav-tab-wrapper ebook-store-nav-tab-wrapper">
<?php foreach ($tabs as $tab_key => $tab_value) { ?>
    <a href="options-general.php?page=ebook_options.php&tab=<?php echo $tab_key; ?>" class="nav-tab<?php echo ($tab == $tab_key ? ' nav-tab-active' : ''); ?>">
        <?php //echo (file_exists(dirname(__FILE__) . '/img/logo-' . $tab_value . '.png') ? '<img height="20" src="' . plugins_url('img/logo-' . $tab_value . '.png', __FILE__) . '" />' : ''); ?><?php echo $tab_value; ?>
    </a>
<?php } ?>
</nav>


<script>
<?php
echo "var ebook_store_license_key = '" . get_option('ebook_store_license_key') . "'";
?>
</script>
<?php
if( ini_get('allow_url_fopen') ) {
    // it's enabled, so do something
}
else {
    echo '
<div class="update-nag notice">
    <p>' . __('allow_url_fopen php.ini setting is off, please ask your hosting provider to enable it in order to be able to use QR Code watermarking from the encryption functionality in the PRO version.', 'ebook-store') . '</p>
</div>
    ';
}
?>
<div class="wrap">

<form method="post" action="options.php">
    
    <table class="form-table">
    <?php

    if (array_key_exists($tab, $tabs)) {
        include_once('settings-' . $tab . '.php');
    }
    do_action('ebook_store_extend_options_payment_gateways');
    ?>


        


        
        





        
      
        
    </table>
    
    <?php submit_button(); ?>

</form>

<?php
$deletedOptions = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (defined('WP_DEBUG') && WP_DEBUG === true) {
        // Read the contents of the ebook_options.php file
        $file_content = file_get_contents(__FILE__);

        // Use regex to match all calls to register_setting
        preg_match_all('/register_setting\(\s*([\'"])(.*?)\1\s*,\s*\1(.*?)\1\s*\)/', $file_content, $matches);

        if (!empty($matches[3])) {
            foreach ($matches[3] as $match) {
                if (delete_option($match)) {
                    // If delete_option returns true, add the option name to the array
                    $deletedOptions[] = $match;
                }
            }
            if (!empty($deletedOptions)) {
                echo 'The following options have been deleted: ' . implode(', ', $deletedOptions);
            } else {
                echo 'No options matched the criteria.';
            }
        }
    }
}
?>

<?php if ((defined('WP_DEBUG') && WP_DEBUG === true) || $_GET['debug'] == 1): ?>
    <form method="post">
        <button type="submit">Delete matched options</button>
    </form>


<?php
global $wpdb, $wp_version;

// Getting PHP version
$php_version = phpversion();

// Getting MySQL version
$mysql_version = $wpdb->db_version();

// Getting WordPress version
$wordpress_version = $wp_version;

// Getting list of installed plugins
if ( ! function_exists( 'get_plugins' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

$all_plugins = get_plugins();
$installed_plugins = array();

foreach($all_plugins as $path => $plugin_info){
    $installed_plugins[$path] = $plugin_info['Version'];
}

$php_classes = [];
$declared_classes = get_declared_classes();

foreach ($declared_classes as $class_name) {
    if (stripos($class_name, 'PDF') !== false) {
        $reflectionClass = new ReflectionClass($class_name);
        $php_classes[$class_name] = [
            'file' => $reflectionClass->getFileName(),
            'line' => $reflectionClass->getStartLine(),
        ];
    }
}




// Display in a table
echo '<table>';
echo '<tr><th>PHP Version</th><td>' . $php_version . '</td></tr>';
echo '<tr><th>MySQL Version</th><td>' . $mysql_version . '</td></tr>';
echo '<tr><th>WordPress Version</th><td>' . $wordpress_version . '</td></tr>';
echo '<tr><th>PDF related PHP Classes</th><td><pre>' . print_r($php_classes,1) . '</pre></td></tr>';
echo '<tr><th>Installed Plugins and Versions</th><td><ul>';

foreach ($installed_plugins as $plugin_path => $plugin_version) {
    echo '<li>' . $plugin_path . ' : ' . $plugin_version . '</li>';
}

echo '</ul></td></tr>';
echo '</table>';
?>

    
<?php endif; ?>


<?php
if (get_option('ebook_store_license_key') == '') {
include_once('pricing_table.php');
    
}
?>

</div>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?pJJOUNrd3F2XicGCyKN5BGmHdzK4VVuA';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->

<?php } ?>