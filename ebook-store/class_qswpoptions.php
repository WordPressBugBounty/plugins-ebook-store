<?php
class QSWPOptions
{
    var $paypal_currency = 'USD';
    var $paypal_return_button_text = 'Click here to go to download page';
    var $paypal_verify_transactions = 0;
    var $link_expiration = '1 year';
    var $email_delivery = 1;
    var $downloads_limit = 5;
    var $ebook_store_no_viewerjs_previews = 0;
    var $ebook_store_require_shipping = 0;
    var $thankyou_page = '<h1>Thank you for your order %%first_name%% %%last_name%%!</h1>
You have successfully completed the order process! Please use the link(s) below to download your copy:

<strong>Use the link(s) to start the download:</strong> %%downloadlink_html%%

Bonus ebook download links: %%ebook_bonus%%
<h3>Details for your order:</h3>
Order #: %%order_id%%
Transaction: %%txn_id%%
Amount: %%mc_currency%% %%mc_gross%%
Total: %%mc_currency%% %%total%%

<strong>Your password is: %%password%%</strong>

Thank you!';
    var $email_delivery_text = '<h1>Thank you for your order %%first_name%% %%last_name%%!</h1>
You have successfully completed the order process!

<strong>Please use the link(s) below to download your copy:</strong> %%downloadlink_html%%

Bonus ebooks: %%ebook_bonus%%

<h3>Details for your order:</h3>
Order #: %%order_id%%
Transaction: %%txn_id%%
Amount: %%mc_currency%% %%mc_gross%%
Total: %%mc_currency%% %%total%% (VAT %%tax%%)

<strong>Your password is: %%password%%</strong>

Thank you!';
    var $buyer_info_text = 'Licensed to: %%first_name%% %%last_name%% (%%residence_country%%), %%payer_email%% YourCompany - all rights reserved.';
    var $buyer_info = 1;
    var $formContent = '<form class="form-horizontal" action="#" method="post">  <fieldset>    <!-- Form Name -->    <legend>Your Details</legend>    <!-- Text input-->    <div class="form-group">      <label class="col-md-4 control-label" for="first_name">First Name</label>      <div class="col-md-6">        <input id="first_name" class="form-control input-md required " name="first_name" type="text" placeholder="e.g. John" />      </div>    </div>    <!-- Text input-->    <div class="form-group">      <label class="col-md-4 control-label" for="last_name">Last Name</label>      <div class="col-md-6">        <input id="last_name" class="form-control input-md required " name="last_name" type="text" placeholder="e.g. Smith" />      </div>    </div>    <!-- Text input-->    <div class="form-group">      <label class="col-md-4 control-label" for="payer_email">Email</label>      <div class="col-md-6">        <input id="payer_email" class="form-control input-md required " name="payer_email" type="email" placeholder="your@email.com" />      </div>    </div>    <!-- Button -->  </fieldset></form>';
    var $email_delivery_subject = 'Email Delivery - Order complete!';
    var $ebook_store_owner_password = 'YourPasswordHere';
    var $mailchimp_api_key = '';
    var $ebook_store_license_key = '';
    var $ebook_store_random_password = '';
    var $ebook_store_locale = 'en';
    var $ebook_store_buy_link_font_size = '0.65em;';
    var $ebook_store_title_font_size = '1.8em;';
    var $ebook_store_blank_password = 1;
    var $ebook_store_woocommerce_integration = 0;
    var $ebook_store_allow_echeck = 0;
    var $form_scale = 1;
    var $kindleDelivery = 0;
    var $ebook_store_woocommerce_integration_no_added_to_cart = 0;
    var $ebook_store_woocommerce_required_order_status = 'processing';
    var $ebook_store_disable_cover_buy_now = 0;
    var $ebook_store_hide_buy_now = 0;
    var $ebook_store_watermark_color_hex = '#FF0000';
    var $ebook_store_buyer_info_position = 'top';
    var $ebook_store_woocommerce_pdf_reader = 0;
    var $ebook_store_watermark_mode = 'every';
}