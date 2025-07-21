<?php
// error_reporting(E_ALL);

// Handle form submission
if (
    isset($_POST['action'], $_POST['data'], $_POST['ebook_add_order_nonce']) &&
    $_POST['action'] === 'add_order' &&
    wp_verify_nonce($_POST['ebook_add_order_nonce'], 'ebook_add_order_action')
) {
    $clean_data = [];

    // Sanitize user input
    $clean_data['first_name']   = sanitize_text_field($_POST['data']['first_name'] ?? '');
    $clean_data['last_name']    = sanitize_text_field($_POST['data']['last_name'] ?? '');
    $clean_data['mc_gross']     = floatval($_POST['data']['mc_gross'] ?? 0);
    $clean_data['ebook']        = intval($_POST['data']['ebook'] ?? 0);
    $clean_data['payer_email']  = sanitize_email($_POST['data']['payer_email'] ?? '');

    // Optionally validate values
    if (
        !empty($clean_data['first_name']) &&
        !empty($clean_data['last_name']) &&
        $clean_data['mc_gross'] > 0 &&
        is_email($clean_data['payer_email']) &&
        $clean_data['ebook'] > 0
    ) {
        ebook_store_add_order($clean_data);
    } else {
        echo '<div class="notice notice-error"><p>' . esc_html__('Invalid input provided.', 'ebook-store') . '</p></div>';
    }
}

// Fetch all eBooks
$new = new WP_Query([
    'post_type' => 'ebook',
    'posts_per_page' => -1
]);

$ebooks = [];
while ($new->have_posts()) {
    $new->the_post();
    $ebook_id = get_the_ID();
    $ebook_title = get_the_title();
    $ebooks[] = '<option value="' . esc_attr($ebook_id) . '">' . esc_html($ebook_title) . '</option>';
}
wp_reset_postdata();
?>

<form method="post">
    <h1><?php echo esc_html__('Orders - Add New', 'ebook-store'); ?></h1>
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="first_name"><?php esc_html_e('First Name', 'ebook-store'); ?></label></th>
                <td><input name="data[first_name]" type="text" id="first_name" value="" placeholder="John" class="regular-text" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="last_name"><?php esc_html_e('Last Name', 'ebook-store'); ?></label></th>
                <td><input name="data[last_name]" type="text" id="last_name" value="" placeholder="Smith" class="regular-text" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="mc_gross"><?php esc_html_e('Amount Paid', 'ebook-store'); ?></label></th>
                <td><input name="data[mc_gross]" type="text" id="mc_gross" value="" placeholder="9.99" class="regular-text" /></td>
            </tr>
            <tr>
                <th scope="row"><label for="ebook"><?php esc_html_e('Select Ebook', 'ebook-store'); ?></label></th>
                <td>
                    <select name="data[ebook]" id="ebook" class="regular-text">
                        <?php echo implode("\n", $ebooks); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="payer_email"><?php esc_html_e('Buyer Email', 'ebook-store'); ?></label></th>
                <td>
                    <input name="data[payer_email]" type="email" id="payer_email" value="" placeholder="buyer@email.com" class="regular-text" />
                    <p class="description" id="tagline-description">
                        <?php esc_html_e('The buyer will now receive a thank you email with the appropriate download links for the ebook and its formats.', 'ebook-store'); ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <?php submit_button(); ?>
    
    <h4><?php esc_html_e('"Thank you" email will be sent immediately with the download links for the ebook. If encryption is enabled, the file will be encrypted.', 'ebook-store'); ?></h4>
    <input type="hidden" name="action" value="add_order" />
    <?php wp_nonce_field('ebook_add_order_action', 'ebook_add_order_nonce'); ?>

</form>
