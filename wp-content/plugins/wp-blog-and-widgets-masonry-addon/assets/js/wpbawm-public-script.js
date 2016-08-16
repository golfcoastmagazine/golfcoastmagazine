jQuery( document ).ready(function($) {

	// Initialize masonry
	jQuery('.wpbawm-blog-masonry').each(function( index ) {
		
		var obj_id = jQuery(this).attr('id');
		
		// Creating object
		var masonry_param_obj = {itemSelector: '.wpbawm-blog-grid'};
		
		if( !$(this).hasClass('wpbawm-effect-1') ) {
			masonry_param_obj['transitionDuration'] = 0;
		}
		
		// jQuery
		$('#'+obj_id).masonry(masonry_param_obj);
	});
	
	// Ajax load more
	$(document).on('click', '.wpbawm-load-more-btn', function() {
		
		var current_obj = $(this);
		var site_html 	= $('body');
		var masonry_obj = current_obj.closest('.wpbawm-blog-masonry-wrp').find('.wpbawm-blog-masonry').attr('id');
		var paged 		= (parseInt(current_obj.attr('data-paged')) + 1);
		var count 		= parseInt(current_obj.attr('data-count'));
		var shortcode_param = $.parseJSON(current_obj.parent().find('.wpbawm-shortcode-param').text());

		$('.wpbawm-info').remove();
		current_obj.addClass('wpbawm-btn-active');
		current_obj.attr('disabled', 'disabled');

		// Creating object
		var shortcode_obj = {};

		// Creating object
		$.each(shortcode_param, function (key,val) {
			shortcode_obj[key] = val;
		});

		var data = {
                        action     	: 'wpbawm_get_more_post',
                        paged 		: paged,
                        count 		: count,
                        shrt_param 	: shortcode_obj
                    };

        $.post(Wpbawm.ajaxurl,data,function(response) {
			
			var result = $.parseJSON(response);

			if( result.sucess = 1 && (result.data != '') ) {

				current_obj.attr('data-paged', paged);
				current_obj.attr('data-count', result.count);

				var $content = $( result.data );
				$('#'+masonry_obj).append( $content ).masonry( 'appended', $content );
				current_obj.closest('.wpbawm-blog-masonry').append( $content ).masonry( 'appended', $content );

				// Required for jetpack sharing on ajax loading
				if ( $content && result.jet_sharing == 1 ) {
					$( document.body ).trigger( 'post-load', { html: $content } );
				}

			} else if(result.data == '') {
				
				current_obj.parent('.wpbawm-ajax-btn-wrap').hide();
				var info_html = '<div class="wpbawm-info">'+Wpbawm.no_post_msg+'</div>';

				current_obj.parent().after(info_html);
				setTimeout(function() {
					$(".wpbawm-info").fadeOut("normal", function() {
						$(this).remove();
				    });
				}, 2000 );
			}

			current_obj.removeAttr('disabled', 'disabled');
			current_obj.removeClass('wpbawm-btn-active');
		});
	});

	// On click of share icon
	$(document).on('click', '.wpbawm-share-icon', function() {
		$(this).closest('.wpbawm-blog-grid').find('.wpbawm-jet-sharing').fadeIn();
	});
	
	// Close share
	$(document).on('click', '.wpbawm-share-close', function() {
		$(this).closest('.wpbawm-blog-grid').find('.wpbawm-jet-sharing').fadeOut();
	});

});