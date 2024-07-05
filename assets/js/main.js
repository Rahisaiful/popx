(function($) {
"use stric";

const popupItemFetch = () => {

	$.ajax({

		type: "POST",
		url: popxScript.ajaxUrl,
		data: {
			action: "render_popx_popup",
			page_id: popxScript.pageid,
			is_home: popxScript.is_home,
			is_front_page: popxScript.is_front_page,
			is_shop: popxScript.is_shop,
			is_single_archive: popxScript.is_single_archive
		},
		success: function( res ) {
			$('.popx-base-wrap').html(res);
			//
			popupShow();
		}

	})

}

popupItemFetch();



const popupShow = () => {


	$('.popx-modal-activate').each( function() {

        let $t = $(this),
            $delayTime = $t.data('delay-time');
            $popxId = $t.data('popx-id'),
            $expiry = localStorage.getItem( "popx_modal_"+$popxId ),
            $expiry = $expiry != null ? JSON.parse($expiry) : '';

            console.log( $expiry );

            checkVisibilityExpiry( $expiry, "popx_modal_"+$popxId );

            if( $expiry == '' || $expiry.value != 'yes' ) {

            	setTimeout( function() {
	            	$t.addClass('popx-modal-show');
	          	}, $delayTime);

            }


      } )

      // Close Modal

      $('.popx-modal-close').on( 'click', function() {

      	let $this = $(this).closest('.popx-modal-activate'),
      		$id = $this.data('popx-id'),
      		now = new Date();

        	$this.removeClass('popx-modal-show');
        	let $data = {'value': 'yes', 'expiry_time': now.getTime() + 60000}; //6000 = 6sec
        	localStorage.setItem("popx_modal_"+$id, JSON.stringify($data));

      } )


}


const checkVisibilityExpiry = ( data, key ) => {
	let now = new Date();
	if( data != '' && now.getTime() > data.expiry_time ) {
		
		localStorage.removeItem(key)
	}

}
	







})(jQuery);