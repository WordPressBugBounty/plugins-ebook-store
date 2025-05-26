jQuery(function() {
	jQuery('input[type="file"]').show();
	if (typeof ebook_store_license_key != 'undefined') {
		if (ebook_store_license_key != '') {
			jQuery.getJSON('https://www.shopfiles.com/api/wordpress_license.php?product=ebook_store&key=' + ebook_store_license_key,function(data) {
				if (data.found == 1) {
					//console.log(data);
					// jQuery('.goPro').last().remove();
					// jQuery('.goPro').last().remove();
					//accept=".pdf,.zip"
					jQuery('#ebook_wp_custom_attachment_ebook_pdf').attr('accept','*');
				} else {
					alert(data.error);
					ebook_store_no_license();
				}
			});
		} else {
			ebook_store_no_license();
		}
	}
	// new issue page
	jQuery('#new_issue_purchase_period, #new_issue_ebook_id, #past_order_ebook_id').change(function(e){
		jQuery.get('edit.php?post_type=ebook&page=ebook-store-add-issue-page&action=ajax_get_orders_count&new_issue_purchase_period=' + jQuery('#new_issue_purchase_period').val() + '&new_issue_ebook_id=' + jQuery('#new_issue_ebook_id').val()+ '&ebook_id=' + jQuery('#past_order_ebook_id').val(), function(data) {
			var ajax_get_orders_count = jQuery('.ajax_get_orders_count',data).html();
			jQuery('#ajax_get_orders_count').html(ajax_get_orders_count);
			if (jQuery('#new_issue_ebook_id').val() != '') {
				jQuery('#new_issue_submit_button').removeAttr('disabled');
			} else {
				jQuery('#new_issue_submit_button').attr('disabled','disabled');
			}
			
		});
	});

});
function ebook_store_no_license() {
	jQuery('.goPro input,.goPro2').click(function(e) {
	jQuery('.goPro input').prop('checked',false);
	jQuery('.goPro input[type="text"]').attr('readonly',true);
	jQuery('.goPro select').attr('readonly',true);
		if (confirm('Sorry, this feature is available in the Pro version only, would you like to upgrade now?')) {
			window.location = 'http://www.shopfiles.com/index.php/products/wordpress-ebook-store';
		}
	});
	jQuery('.goPro, .goPro2').css({background: '#FFB0B0', opacity: 1});
	jQuery('input[type=radio].goPro2').remove();
	jQuery('.goPro2 input[type=file]').attr('disabled','disabled');
}
function ebook_store_embed_code(ebook_id) {
	//tinyMCE.activeEditor.setContent(tinyMCE.activeEditor.getContent() + '[ebook_store ebook_id="' + ebook_id + '"]', {format : 'raw'});
	// alert('Success! eBook embed code is added to the bottom of the article, you can move it if needed.');
	if (tinyMCE.activeEditor != null) {
		tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[ebook_store ebook_id="' + ebook_id + '"]');
		jQuery('#content').val(jQuery('#content').val() + '[ebook_store ebook_id="' + ebook_id + '"]');
	} else {
		jQuery('#content').val(jQuery('#content').val() + '[ebook_store ebook_id="' + ebook_id + '"]');
	}
	var body = jQuery("html, body");
	body.animate({scrollTop:0}, '500', 'swing', function() { 
	   
	});

}

jQuery(document).ready(function($) {
    // Existing file upload UI enhancements
    $('.ebook_store_upload input[type="file"]').each(function() {
        const $input = $(this);
        const $item = $input.closest('.ebook_store_file_format_item');
        const format = $input.data('format');

        // Handle file selection
        $input.on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const fileName = file.name;
                const fileSize = humanFileSize(file.size);
                
                // Update UI
                $item.find('.ebook_store_filename span').text(fileName);
                $item.find('.ebook_store_size')
                    .text(fileSize)
                    .removeClass('hidden');
                
                // Show delete control
                $item.find('.ebook_store_control').removeClass('hidden');
            }
        });

        // Handle drag and drop
        $input.on('dragenter dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $item.addClass('drag-over');
        });

        $input.on('dragleave drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $item.removeClass('drag-over');
        });
    });

    // Image preview functionality
    function setupImagePreview($input, previewClass) {
        const $wrapper = $input.closest('.ebook_store_image_wrapper');
        const $preview = $wrapper.find('.ebook_store_image_preview');
        
        // Handle file selection
        $input.on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file');
                    $input.val('');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    if ($preview.length === 0) {
                        // Create preview element if it doesn't exist
                        $wrapper.prepend(
                            `<div class="ebook_store_image_preview ${previewClass}">
                                <img src="${e.target.result}" alt="Preview">
                                <div class="remove-image">
                                    <span class="dashicons dashicons-no-alt"></span>
                                </div>
                                <div class="image-size">${humanFileSize(file.size)}</div>
                            </div>`
                        );
                    } else {
                        // Update existing preview
                        $preview.removeClass('empty')
                            .find('img')
                            .attr('src', e.target.result);
                        $preview.find('.image-size').text(humanFileSize(file.size));
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle remove image click
        $wrapper.on('click', '.remove-image', function(e) {
            e.preventDefault();
            const $preview = $(this).closest('.ebook_store_image_preview');
            $preview.addClass('empty').find('img').remove();
            $input.val('');
            // Add checkbox to actually delete the image on save if it exists
            if ($wrapper.find('input[type="checkbox"]').length === 0) {
                const inputName = $input.attr('name').replace('attachment', 'delete');
                $wrapper.append(`<input type="checkbox" name="${inputName}" value="1" checked style="display: none;">`);
            }
        });
    }

    // Setup image previews for cover and side images
    setupImagePreview($('input[name="ebook_wp_custom_attachment_cover"]'), 'cover-image');
    setupImagePreview($('input[name="ebook_wp_custom_attachment_side_photo"]'), 'side-image');

    // Handle delete checkbox
    $('.ebook_store_control input[type="checkbox"]').on('change', function() {
        const $checkbox = $(this);
        const $item = $checkbox.closest('.ebook_store_file_format_item');
        const $label = $checkbox.closest('label');

        if ($checkbox.is(':checked')) {
            $item.addClass('pending-delete');
            $label.attr('title', wp.i18n.__('Undo delete', 'ebook-store'));
        } else {
            $item.removeClass('pending-delete');
            $label.attr('title', wp.i18n.__('Delete file', 'ebook-store'));
        }
    });

    // Helper function to format file size
    function humanFileSize(bytes) {
        const thresh = 1024;
        if (Math.abs(bytes) < thresh) {
            return bytes + ' B';
        }
        const units = ['KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        let u = -1;
        do {
            bytes /= thresh;
            ++u;
        } while (Math.abs(bytes) >= thresh && u < units.length - 1);
        return bytes.toFixed(1) + ' ' + units[u];
    }

    // Add visual feedback for drag and drop
    $('.ebook_store_file_format_item').each(function() {
        const $item = $(this);
        const $upload = $item.find('.ebook_store_upload');

        $upload.append('<div class="upload-overlay">' + 
            '<div class="upload-message">' + 
                '<i class="dashicons dashicons-upload"></i>' + 
                '<span>' + wp.i18n.__('Drop file here or click to upload', 'ebook-store') + '</span>' +
            '</div>' +
        '</div>');
    });

    // Initialize tooltips if jQuery UI is available
    if ($.fn.tooltip) {
        $('.ebook_store_file_format_item a, .ebook_store_control label').tooltip({
            position: {
                my: "center bottom-20",
                at: "center top",
                using: function(position, feedback) {
                    $(this).css(position);
                    $("<div>")
                        .addClass("arrow")
                        .addClass(feedback.vertical)
                        .addClass(feedback.horizontal)
                        .appendTo(this);
                }
            }
        });
    }

    // Initialize existing image previews if images are already uploaded
    function initializeExistingImagePreviews() {
        $('input[name="ebook_wp_custom_attachment_cover"], input[name="ebook_wp_custom_attachment_side_photo"]').each(function() {
            const $input = $(this);
            const $wrapper = $input.closest('p');
            const previewClass = $input.attr('name').includes('side_photo') ? 'side-image' : 'cover-image';
            
            // Convert p to div with wrapper class
            $wrapper.wrap('<div class="ebook_store_image_wrapper"></div>');
            
            // Check if there's an existing image link
            const $existingLink = $wrapper.find('a');
            if ($existingLink.length) {
                const imageUrl = $existingLink.attr('href');
                const fileName = $existingLink.text();
                
                // Create preview element
                $wrapper.parent().prepend(
                    `<div class="ebook_store_image_preview ${previewClass}">
                        <img src="${imageUrl}" alt="${fileName}">
                        <div class="remove-image">
                            <span class="dashicons dashicons-no-alt"></span>
                        </div>
                    </div>`
                );
            } else {
                // Create empty preview placeholder
                $wrapper.parent().prepend(
                    `<div class="ebook_store_image_preview ${previewClass} empty"></div>`
                );
            }
        });
    }

    // Call the initialization function
    initializeExistingImagePreviews();
});