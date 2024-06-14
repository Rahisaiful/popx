(function($) {
"use stric";

// Modal Close
$(document).on( 'click', '.popx-modal-close', function() {
	$(this).closest('.popx-modal-wrap').removeClass('popx-modal-open');
} );



})(jQuery);