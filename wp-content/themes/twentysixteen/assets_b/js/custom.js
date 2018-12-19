var ajax_url= 'https://privaposts.vn.cisinlive.com/wp-admin/admin-ajax.php';  
var siteurl='https://privaposts.vn.cisinlive.com/';
$(document).ready(function(e) {
//validation


//end validation

    $('#iphone-carousel').owlCarousel({
        loop:false,
        margin:0,
        nav:false,
        dots:true,
        items:1
    });



$('#how-slide').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    dots:false,
    items:1,
    navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
});


$('#pop-slider').owlCarousel({
    loop:false,
    margin:10,
    nav:false,
    dots:true,
    items:1
});

autoload();


// $("#slider1").slider({
//  tooltip: 'always', 
// 	min: 1000,
// 	max: 1000000,
// 	scale: 'logarithmic',
// 	step: 10,
//  }).on('change', function(event) {
//     calculatesliderPrice();
// });



// // $('#slider1').slider().on('change', function(event) {
// //     alert('dd');
// // });

  

// $("#slider2").slider({
//  tooltip: 'always',
// 	min: 2,
// 	max: 100,
// 	scale: 'logarithmic',
// 	step: 2,
//   change:function() { calculatesliderPrice(); }
// }).on('change', function(event) {
//     calculatesliderPrice();
// });



/*
jQuery('.slimmenu').slimmenu(
	{
		resizeWidth: '991',
		collapserTitle: '',
		animSpeed: 'medium',
		indentChildren: true,
		childrenIndenter: '&raquo;'
	});	
*/
  $('.fancybox').fancybox();
    // Change title type, overlay closing speed
    $(".fancybox-effects-a").fancybox({
        helpers: {
            title: {
                type: 'outside'
            },
            overlay: {
                speedOut: 0
            }
        }
    });

    $('.fancybox-buttons').fancybox({
        openEffect: 'none',
        closeEffect: 'none',
        prevEffect: 'none',
        nextEffect: 'none',
        closeBtn: false,
        helpers: {
            title: {
                type: 'inside'
            },
            buttons: {}
        },
        afterLoad: function () {
            this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
        }
    });


	 /*
     *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
     */

    $('.fancybox-thumbs').fancybox({
        prevEffect: 'none',
        nextEffect: 'none',
        closeBtn: false,
        arrows: false,
        nextClick: true,
        helpers: {
            thumbs: {
                width: 50,
                height: 50
            }
        }
    });

    /*
     *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
     */
    $('.fancybox-media')
        .attr('rel', 'media-gallery')
        .fancybox({
            openEffect: 'none',
            closeEffect: 'none',
            prevEffect: 'none',
            nextEffect: 'none',
            arrows: false,
            helpers: {
                media: {},
                buttons: {}
            }
        });
  
        $("#forget_pwd").click(function(){ 
          var user_email_username= $("#pwd_text").val();
            $.ajax({
                 type: "POST",
                 url: ajax_url,
                 data :{
                       'action': 'user_update_password',
                       'user_value':user_email_username,
                  }, 
                  success: function(response){
                       var obj = jQuery.parseJSON(response);
                       if(obj.status==1){
                        
                         $("#error_msg").show().html(obj.msg);
                         $("#error_msg").addClass('error');
                       }else{
                         $("#error_msg").addClass('sucess');
                         $("#error_msg").show().html(obj.msg);
                       }  
                }
            });
        });

      $("form[name='edit_profile']").validate({
        rules: {
          subscription_price:{
            required: true, 
            number: true,
          },
          username:{
            required: true, 
          },
          useremail:{
            required: true, 
          },
          userbio:{
            required: true, 
            maxlength: 200,
          },
          user_website_url:{
            required: true, 
          },
          user_sex:{
            required: true, 
          },
          user_loaction:{
            required: true, 
          },
          firtsname:{
            required: true, 
          },
          lastname:{
            required: true, 
          },
          dob:{
            required: true, 
          },

          
        },
        messages: {
          username:{ 
            required: "Please enter user name",
          },
        },
        submitHandler: function(form) {
          form.submit();
        }
      });


  $("form[name='change_password']").validate({
      rules: {
        old_pass:{
          required: true, 
        },
        new_pass:{
          required: true,
          minlength:8,
        },

        new_cnf_pass: {  
          equalTo: "#new_pass",
          required: true,
          minlength: 8,
        }, 

      },
      messages: {
        new_pass: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters",
      },

      new_cnf_pass: {
        required: "Password should be match",
        minlength: "Your password must be at least 8 characters",
      },

      },
      submitHandler: function(form) {
        form.submit();
      }
    });

   $("form[name='bank_detail']").validate({
      rules: {
        legal_name:{
          required: true, 
        },
        document_id:{
          required: true,
        },
        bank_country: {  
          required: true,
          
        },
        document: {  
          accept:"jpg,png,jpeg,pdf" 
        },

        

      },
      messages: {
        new_pass: {
        legal_name: "Please provide a password",
      },
      document: {
        accept: "Only image type jpg/png/jpeg/pdf is allowed",
      },

      },
      submitHandler: function(form) {
        form.submit();
      }
    });


$('#dob').datepicker({
    format: 'mm/dd/yyyy'
});

});//end document

jQuery(window).scroll(function() {    
	var scroll = jQuery(window).scrollTop();
	if (scroll >= 165) {
		jQuery("body").addClass("sticky");
	} else {
		jQuery("body").removeClass("sticky");
	}
}); 



jQuery(window).scroll(function() {    
	var scroll = jQuery(window).scrollTop();
	if (scroll >= 165) {
		jQuery(".icon-nav-wrp").addClass("icon-nav-fix");
	} else {
		jQuery(".icon-nav-wrp").removeClass("icon-nav-fix");
	}
}); 




$('.cstm-frm-field').focus(function() {
  tmpval = $(this).val();
    if(tmpval == '') {
      $(this).closest('div.cmn-bx').toggleClass('input-filled');
    } else {
        $(this).closest('div.cmn-bx').removeClass('input-empty');
    }
}).
blur(function() {
tmpval = $(this).val();
    if(tmpval == '') {
      $(this).closest('div.cmn-bx').toggleClass('input-filled');
    } else {
        $(this).closest('div.cmn-bx').removeClass('input-empty');
    }});


function calculatesliderPrice(){
	var slider1 = $('#slider1').val();
	var slider2 = $('#slider2').val();
	var price1  = slider1*slider2*0.01;
	var price2  = slider1*slider2*0.05;
	$('#priceC1').text('$'+Math.round(price1));
	$('#priceC2').text('$'+Math.round(price2)); 
}

function autoload(){

	$('#check-1').click(function(){
		if(this.checked){
			$('#um-signupbtn-btn').prop('disabled', false);
		}else{
			$('#um-signupbtn-btn').prop('disabled', true);	
		}
	});


  $('#new_post').submit(function(){
     var p_content = $("#description").val();
     if(p_content ==""){
      $("#description").css('border','1px solid red');
      return false;  
     }else{
         $.ajax({
                 type: "POST",
                 url: ajax_url,
                 data :{
                       'action': 'add_post',
                       'p_content':p_content,
                  }, 
                  success: function(response){
                       $("#description").val();
                       $("#load-comments").prepend(response);
                       $("#no-postdivId").hide();
                       return false;
                }
            });
         return false;
     }
  });
// delete post
  $(".deletepost").click(function(){
       var postId = $(this).attr("ref");
       if(postId){
            $.ajax({
                 type: "POST",
                 url: ajax_url,
                 data :{
                       'action': 'remove_post',
                       'postId':postId,
                  }, 
                  success: function(response){
                      $("#post_"+postId).remove();
                      return false;
                }
            });
       }
  });

  $(".cancel").click(function(){

   alert("Are you sure you want to cancel ?");
   window.location.href = siteurl+"profile";
 });

}

