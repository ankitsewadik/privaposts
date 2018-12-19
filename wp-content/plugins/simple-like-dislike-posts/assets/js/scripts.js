(function($){

	$(document).ready(function(){
		if($('input:radio[name="display_in_template"]:checked').val() == 'no'){
				$('#content_position').hide('slow');
		}
		$('input:radio[name="display_in_template"]').on('change', function(){
			if($(this).val() == 'yes'){
				$('#content_position').show('slow');
			}
			else{
				$('#content_position').hide('slow');
			}
		})

		$('#likesErrorMsg').slideUp('1000');
		$('#simpleAjaxLike').on('click', function(e){
			e.preventDefault();
			var userAction = $(this).attr('data-option');
			var postID = $(this).attr('data-id');
			$('#likesErrorMsg').slideUp('1000');
			$('#errorMsg').slideUp('1000');

			$.ajax({
				type : "POST",
				dataType: 'json',
				url : count_ajax.ajaxurl,
				data : {
					action: "sal_simpleAjaxCount",
					postID : postID,
					userAction: userAction
				},
				success: function(data) {
					var like = data.like_count;
					var dislike = data.dislike_count;
					var errorMsg = data.like_message;
					var error = data.error_msg;
					$('#simpleAjaxLike').html('<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> '+like);
					$('#simpleAjaxDislike').html('<i class="fa fa-thumbs-o-down" aria-hidden="true"></i> '+dislike);
					if(errorMsg != null){
						$('#likesErrorMsg').slideDown('1000');
						$('#likesErrorMsg').html(errorMsg);
						$('#likesErrorMsg').css({'visibility':'visible'});
					}
					if(error != null){
						$('#errorMsg').slideDown('1000');
						$('#errorMsg').html(error);
						$('#errorMsg').css({'visibility':'visible'});
					}
				}
			})   
		});
		$('#simpleAjaxDislike').on('click', function(e){
			e.preventDefault();
			var userAction = $(this).attr('data-option');
			var postID = $(this).attr('data-id');
			$('#likesErrorMsg').slideUp('1000');
			$('#errorMsg').slideUp('1000');
			
			$.ajax({
				type : "POST",
				dataType: 'json',
				url : count_ajax.ajaxurl,
				data : {
					action: 'sal_simpleAjaxCount',
					postID : postID,
					userAction: userAction
				},
				success: function(data) {
					var like = data.like_count;
					var dislike = data.dislike_count;
					var errorMsg = data.dislike_message;
					var error = data.error_msg;
					$('#simpleAjaxLike').html('<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> '+like);
					$('#simpleAjaxDislike').html('<i class="fa fa-thumbs-o-down" aria-hidden="true"></i> '+dislike);
					if(errorMsg != null){
						$('#likesErrorMsg').slideDown('1000');
						$('#likesErrorMsg').html(errorMsg);
						$('#likesErrorMsg').css({'visibility':'visible'});
					}
					if(error != null){
						$('#errorMsg').slideDown('1000');
						$('#errorMsg').html(error);
						$('#errorMsg').css({'visibility':'visible'});
					}

				}
			})   
		});
	});
	
})(jQuery); 