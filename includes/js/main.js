jQuery(document).ready(function ($) {
    var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

    jQuery('.cscs_uploadbutton').click(function (e) {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(this);
        var id = button.data('input');
        _custom_media = true;
        wp.media.editor.send.attachment = function (props, attachment) {
            if (_custom_media) {
                $("#" + id).val(attachment.url);
            } else {
                return _orig_send_attachment.apply(this, [props, attachment]);
            }
            ;
        }

        wp.media.editor.open(button);
        return false;
    });

    jQuery('.add_media').on('click', function () {
        _custom_media = false;
    });

    jQuery('.cs-color-picker').wpColorPicker();
    jQuery('.cs-date-picker').datepicker({
        dateFormat: 'mm/dd/yy'
    });
});

/*
 * 
 * Create and let user to download subscriber list CSV.
 * 
 */

jQuery(document).on('click', '.downcsv', function () {
    window.open("index.php?rockython_createcsv=mailsubs&sub=true", '_blank');
});

jQuery(document).on('click', '.downbcc', function () {
    window.open("index.php?rockython_createbcc=mailsubs&sub=true", '_blank');
});


/*
 * 
 * Template options saving
 * 
 */

jQuery(document).ready(function () {
    jQuery('body.igniteup_page_cscs_options .preview-igniteup').on('click', function () {
        jQuery('body.igniteup_page_cscs_options .preview-igniteup, body.igniteup_page_cscs_options .submit').attr('disabled', 'disabled');
        jQuery('#saveResult').html("<span id='saveMessage' class='successModal'></span>");
        jQuery('#saveMessage').append("<span>Saving . . .</span>").show();
        prwindow = window.open('', 'igniteup');
        jQuery('#igniteup-template-options').ajaxSubmit({
            success: function () {
                jQuery('#saveMessage').html("<span>" + jQuery('#saveResult').data('text') + "</span>").show();
                jQuery('body.igniteup_page_cscs_options .preview-igniteup, body.igniteup_page_cscs_options .submit').removeAttr('disabled');
                var theurl = jQuery('body.igniteup_page_cscs_options .preview-igniteup').data('forward');
                prwindow.location = theurl;
                setTimeout("jQuery('#saveMessage').hide('slow');", 3000);
            },
            timeout: 10000,
            error: function () {
                jQuery('#saveMessage').hide('slow');
                alert('Saving process reached timeout! Please try again.');
                jQuery('body.igniteup_page_cscs_options .preview-igniteup, body.igniteup_page_cscs_options .submit').removeAttr('disabled');
            }
        });
        return false;
    });
});

/*
 * 
 * Reset defaults button action
 * 
 */

jQuery(document).on('click', 'body.igniteup_page_cscs_options .reset-igniteup', function (e) {
    if (!confirm("Are you sure to reset template options to defaults?"))
        return false;
    jQuery('.reset-supported').each(function () {
        var defval_ = jQuery(this).data('defval');
        jQuery(this).val(defval_);
    });
    jQuery('#igniteup-template-options').submit();
    e.preventDefault();
});

/*
 * 
 * Integration page manage sections
 * 
 */

jQuery(document).ready(function () {
    showHideIntegrationSection(true);
});

jQuery(document).on('change', '#cs-selected-provider', function () {
    showHideIntegrationSection();
});

function showHideIntegrationSection(load) {
    if (load !== true)
        jQuery('.cs-hidden-section').slideUp();
    var selected_val = jQuery('#cs-selected-provider').val();
    jQuery('#cs-section-' + selected_val).slideDown();
}