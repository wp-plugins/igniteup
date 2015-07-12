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
        dateFormat : 'mm/dd/yy'
    });
});

	/*
     * 
     * Create and let user to download subscriber list CSV.
     * 
     */
	 
	 jQuery(document).on('click','.downcsv',function(){
		window.open("index.php?rockython_createcsv=mailsubs&sub=true", '_blank');
	 });
	 
	 jQuery(document).on('click','.downbcc',function(){
		window.open("index.php?rockython_createbcc=mailsubs&sub=true", '_blank');
	 });
	 