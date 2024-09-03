( function($) {
	"use strict";


	/**************************
	 * Tabs
	 * ************************/
	$( '.popx-tab' ).on( 'click', function(e) {
 		e.preventDefault();

		let $selector = $(this).attr('id'),
			$contentWrap = $('.popx-meta-tabs-content-area');

			console.log($selector);

		$('#'+$selector).closest('.popx-meta-tabs').find('.popx-active').removeClass('popx-active');
		$('#'+$selector).addClass('popx-active');
		
		$contentWrap.find('.popx-active').removeClass('popx-active').addClass('popx-hide');
		$('[data-tabref="'+$selector+'"]').removeClass('popx-hide').addClass('popx-active');
		

	} );


	/**************************
	 * Color Picker
	 * *************************/
	$('.color-field').wpColorPicker();

	/**************************
	 * Media Upload
	 * ************************/
	var mediaUploader, t;

	$('.popx_image_upload_btn').on( 'click', function(e) {

		e.preventDefault();

		t = $(this).parent().find('.popx_background_image');

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


	/**************************
	 * conditional fields
	 * ************************/

    $('[data-condition]').each( function( i, item ) {

        let $item =  $(item).data('condition');
        
        $.each( $item, function( i, val ) {

            // type Switch 
            let s = $( '[name="'+i+'"]' );


            switch( s.attr('type') ) {

                case 'checkbox':
                    // On click
                    s.on( 'click', function() {
                
                        let t = $(this).is(':checked') == true ? 'yes' : '';

                        if( $(this).val() == t ) {
                            $(item).fadeIn();
                        } else {
                            $(item).fadeOut();
                        }
                        
                    } )
                    // On load 
                    if( s.is(':checked') != false ) {
                        $(item).fadeIn();
                    } else {
                        $(item).fadeOut();
                    }
                break;
                default:
                    // On change
                    s.on( 'change', function() {

                        if( $.inArray( $(this).val(), val ) != -1 ) {
                            $(item).fadeIn();
                        } else {
                            $(item).fadeOut();
                        }
                        
                    } )
                    // On load
                    if( $.inArray( s.val(), val ) != -1 ) {
                        $(item).fadeIn();
                    } else {
                        $(item).fadeOut();
                    }
                break;

            }
            
        } )

    } )



} )(jQuery);