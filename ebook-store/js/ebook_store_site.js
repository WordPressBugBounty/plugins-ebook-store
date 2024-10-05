var fd;
function ebook_store_popup(callback, obj) {
	fd = obj;
	// alert('started');
	// jQuery(function() {
	// 	jQuery('body *').css('z-index','auto');
	// 	jQuery('.lean-overlay').css('z-index','100000');
	// 	jQuery('#ebook_formData').css('z-index','100001');
		//fd = jQuery('#ebook_formData').first();
		
	// 	//var closeButton = jQuery('<div class="closeModal"><a href="javascript:fd.trigger(\'closeModal\');">CLOSE BUTTON</a></div>');
	// 	//
	// 	//var closeButton = jQuery('<button id="closeModal" class="btn btn-primary function_set" onclick="fd.trigger(\'closeModal\');" name="closeModal">Close</button>');
	// 	//.appendTo(jQuery('button.btn-primary', fd));

	// 	//jQuery('body').append(closeButton);
	// 	//console.log(closeButton);

	//     fd.easyModal({
	// 	//top: 100,
	// 	//autoOpen: true,
	// 	overlayOpacity: 0.3,
	// 	overlayColor: "#333",
	// 	overlayClose: true,
	// 	closeOnEscape: true
	// });
	var modal = new tingle.modal({
    footer: true,
    stickyFooter: false,
    closeMethods: ['overlay', 'button', 'escape'],
    closeLabel: "Close",
    cssClass: ['custom-class-1', 'custom-class-2'],
    onOpen: function() {
        console.log('modal open');
    },
    onClose: function() {
        console.log('modal closed');
    },
    beforeClose: function() {
        // here's goes some logic
        // e.g. save content before closing the modal
        return true; // close the modal
    	return false; // nothing happens
	    }
	});

    	// modal.setContent('<h1>here\'s some content</h1>');

    jQuery.get('index.php?task=formContent',function(formHTML) {
    	//closeButton.after("button#submit",data);
    	//fd.html(data);
    	modal.setContent(formHTML);
    	// fd.fadeIn().trigger('openModal');
    	jQuery('button[name="submit"]:not(.function_set)').click(function(e) {
    		e.preventDefault();
    		var formData = jQuery('form',fd).first().serialize();
    		formData = formData + '&md5_nonce=' + jQuery(obj).attr('data-md5_nonce');
    		// fd.fadeOut();
    		jQuery.post('index.php?task=ebook_store_form_input',formData,function(ret) {
				// ebook_formData.trigger('closeModal');
				callback();
				//jQuery('.lean-overlay').remove();
    		});
   		}).addClass('function_set');
    });

modal.addFooterBtn('Submit', 'tingle-btn tingle-btn--primary', function() {
    // e.preventDefault();
    //console.log(modal.getContent());
    var form = jQuery('form', modal.getContent()).first();
    var requiredFields = form.find('.required');
    var isFormValid = true;

    requiredFields.each(function() {
        var field = jQuery(this);
        if (field.val().trim() === '') {
            isFormValid = false;
            field.addClass('error');
            setTimeout(function() {
                field.removeClass('error');
            }, 1000);
        } else {
            field.removeClass('error');
        }
    });

    if (!isFormValid) {
        return;
    }
    var formData = form.serialize();
    formData = formData + '&md5_nonce=' + jQuery(obj).attr('data-md5_nonce');
    // fd.fadeOut();

    jQuery.post('index.php?task=ebook_store_form_input', formData, function(ret) {
        modal.close();
        console.log('fd is', fd);
        callback();
        //jQuery('.lean-overlay').remove();
    });
});



	// add another button
	modal.addFooterBtn('Close', 'tingle-btn tingle-btn--danger', function() {
	    // here goes some logic
	    modal.close();
	});

	// open modal
	modal.open();

	jQuery('.lean-overlay').click(function (e){
		jQuery('.lean-overlay').remove();
	});
}

jQuery(document).ready(function () {
	jQuery('.ebook_buy_link').click(function(e) {
		e.preventDefault();
		// jQuery('body *').css('z-index','auto');			
		// jQuery('#ebook_formData').css('z-index',10001);
		jQuery('.lean-overlay').css('z-index',10000).remove();

	});
	jQuery('.bookshelf .inner-right').css('height','auto');
});