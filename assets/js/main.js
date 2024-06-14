(function($) {
"use stric";

const popupShow = () => {

	$.ajax({

		type: "POST",
		url: popxScript.ajaxUrl,
		data: {
			action: "render_popx_popup"
		},
		success: function( res ) {

			$('.popx-base-wrap').html(res);
			console.log( res );
		}

	})

}

popupShow();

// Modal Close
$(document).on( 'click', '.popx-modal-close', function() {
	$(this).closest('.popx-modal-wrap').removeClass('popx-modal-open');
} );





})(jQuery);