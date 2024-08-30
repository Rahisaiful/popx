( function($) {
	"use strict";


	/**************************
	 * Color Picker
	 * *************************/
	$('.color-field').wpColorPicker();

	/**************************
	 * Media Upload
	 * ************************/
	var mediaUploader, t;

	$('.admintosh_image_upload_btn').on( 'click', function(e) {

		e.preventDefault();

		t = $(this).parent().find('.admintosh_background_image');

		if (mediaUploader) {
		  mediaUploader.open();
		  return;
		}
		mediaUploader = wp.media.frames.file_frame = wp.media({
		  title: 'Choose Image',
		  button: {
		  text: 'Choose Image'
		}, multiple: false });
		mediaUploader.on('select', function() {
		var attachment = mediaUploader.state().get('selection').first().toJSON();

			t.val( attachment.url )

		});
		mediaUploader.open();
	});



} )(jQuery);