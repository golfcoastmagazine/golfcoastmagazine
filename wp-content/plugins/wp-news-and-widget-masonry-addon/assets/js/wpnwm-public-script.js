jQuery( document ).ready(function($) {

	// Initialize masonry
	jQuery('.wpnwm-news-masonry').each(function( index ) {
		
		var obj_id = jQuery(this).attr('id');
		
		// Creating object
		var masonry_param_obj = {itemSelector: '.wpnwm-news-grid'};
		
		if( !$(this).hasClass('wpnwm-effect-1') ) {
			masonry_param_obj['transitionDuration'] = 0;
		}
		
		// jQuery
		$('#'+obj_id).masonry(masonry_param_obj);
	});

	$(document).on('click', '.wpnwm-load-more-btn', function(){

		var current_obj = $(this);
		var site_html 	= $('body');
		var masonry_obj = current_obj.closest('.wpnwm-news-masonry-wrp').find('.wpnwm-news-masonry').attr('id');
		var paged 		= (parseInt(current_obj.attr('data-paged')) + 1);
		var count 		= parseInt(current_obj.attr('data-count'));
		var shortcode_param = $.parseJSON(current_obj.parent().find('.wpnwm-shortcode-param').text());

		$('.wpnwm-info').remove();
		current_obj.addClass('wpnwm-btn-active');
		current_obj.attr('disabled', 'disabled');

		// Creating object
		var shortcode_obj = {};

		// Creating object
		$.each(shortcode_param, function (key,val) {
			shortcode_obj[key] = val;
		});

		var data = {
                        action     	: 'wpnwm_get_more_post',
                        paged 		: paged,
                        count 		: count,
                        shrt_param 	: shortcode_obj
                    };

        $.post(Wpnwm.ajaxurl,data,function(response) {
			
			var result = $.parseJSON(response);

			if( result.sucess = 1 && (result.data != '') ) {

				current_obj.attr('data-paged', paged);
				current_obj.attr('data-count', result.count);

				var $content = $( result.data );
				//$grid.append( $content ).masonry( 'appended', $content );
				$('#'+masonry_obj).append( $content ).masonry( 'appended', $content );
				current_obj.closest('.wpnwm-news-masonry').append( $content ).masonry( 'appended', $content );

				// Required for jetpack sharing on ajax loading
				if ( $content && result.jet_sharing == 1 ) {
					$( document.body ).trigger( 'post-load', { html: $content } );
				}

			} else if(result.data == '') {
				
				current_obj.parent('.wpnwm-ajax-btn-wrap').hide();
				var info_html = '<div class="wpnwm-info">'+Wpnwm.no_post_msg+'</div>';

				current_obj.parent().after(info_html);
				setTimeout(function() {
					$(".wpnwm-info").fadeOut("normal", function() {
						$(this).remove();
				    });
				}, 2000 );
			}

			current_obj.removeAttr('disabled', 'disabled');
			current_obj.removeClass('wpnwm-btn-active');
		});
	});

	$(document).on('click', '.wpnwm-share-icon', function() {
		$(this).closest('.wpnwm-news-grid').find('.wpnwm-jet-sharing').fadeIn();
	});
	
	$(document).on('click', '.wpnwm-share-close', function() {
		$(this).closest('.wpnwm-news-grid').find('.wpnwm-jet-sharing').fadeOut();
	});

});