$(document).ready(function(e) {
//validation

 $('.subscription_price').focusin(function () {
        $(this).attr('placeholder', '');
    });

  $('.subscription_price').focusout(function () {
        $(this).attr('placeholder', '$0.00');
    });


// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);

  });

 var showChar = 90;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "See more ";
    var lesstext = "&nbsp;See less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span><a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
    

//end validation

$('.pop-slider').owlCarousel({
    loop:false,
    autoHeight : true,
    margin:10,
    nav:true,
    dots:true,
    video:true,
    items:1
});

autoload();




$('.slimmenu').slimmenu(
  {
    resizeWidth: '991',
    collapserTitle: '',
    animSpeed: 'medium',
    indentChildren: true,
    childrenIndenter: '&raquo;'
  }); 


$('.foot-lnks').slimmenu( 
  {
    resizeWidth: '991',
    collapserTitle: '',
    animSpeed: 'medium',
    indentChildren: true,
    childrenIndenter: '&raquo;'
  }); 
  
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
                       if(obj.status==0){
                        
                         $(".login-info p").show().html(obj.msg);
                         $(".login-info p").addClass('error');
                       }else{
                         $(".login-info p").addClass('sucess');
                         $("#pwd_text").val('');
                         $(".login-info p").show().html(obj.msg);
                       }  
                }
            });
        });

      $("form[name='edit_profile']").validate({
        rules: {
         
          username:{
            required: true, 
          },
          useremail:{
            required: true, 
          },
        subscription_price1:{
          number: true,
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
        subscription_price:{
          number: true,
        },
        document: {  
          accept:"jpg,png,jpeg,pdf" 
        },
        

      },
      messages: {
        
      document: {
        accept: "Only image type jpg/png/jpeg/pdf is allowed",
      },

      },
      submitHandler: function(form) {
        form.submit();
      }
    });

    $("form[name='subscription_price_detail']").validate({
      rules: {
        subscription_price:{
          required: true,
          number: true,
        },
      },
      submitHandler: function(form) {
        form.submit();
      }
    });

    $("form[name='edit_subscription']").validate({
      rules: {
        subscription_price1:{
          required: true,
          number: true,
        },
      },
      submitHandler: function(form) {
        form.submit();
      }
    });

 $("#registration_form").validate({
      rules: {
        user_login:{
          required: true, 
        },
        user_email:{
          required: true, 
        },
        user_password:{
          required: true,
           minlength:8,
        },

        confirm_password: {  
          equalTo: "#user_password",
          required: true,
          minlength: 8,
        }, 

      },
      messages: {
        user_password: {
        required: "Please enter password",
        minlength: "Your password must be at least 8 characters",
      },

      confirm_password: {
          required: "Please enter same password again",
          minlength: "Your password must be at least 8 characters",
        }
      },
      submitHandler: function(form) {
        $(".loader").show();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: { 
                'action': 'ajaxregistration', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#registration_form #user_login').val(), 
                'user_email': $('form#registration_form #user_email').val(), 
                'password': $('form#registration_form #user_password').val(),
                'confirm_password': $('form#registration_form #confirm_password').val(),
                'ref_id': $('form#registration_form #refid').val(),
                 },
            success: function(data){
              $(".loader").hide();
                if (data.status == 0){
                   $('p.status').text(data.message);
                   return false;
                }else{
                 $('#subscription-popup').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                 }); 
                  $('#loginpopup-popup').modal('hide');
                }
            }
        });
        return false;  
      }
    });



$('#dob').datepicker({
    format: 'mm/dd/yyyy'
});

//add comment count like
$('.simpleAjaxLike').on('click', function(e){

      e.preventDefault();
      var userAction = $(this).attr('data-option');
      var check = $(this).attr('data-check');
      var postID = $(this).attr('data-id');
      
  //    $('#likesErrorMsg').slideUp('1000');
    //  $('#errorMsg').slideUp('1000');
     var self = $(this);
      $.ajax({
        type : "POST",
        dataType: 'json',
        url : ajax_url,
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

        

        if(like >= 1){
            $(self).html('<i class="fa fa-heart" aria-hidden="true"></i>&nbsp;'+like);
         }else{
            $(self).html('<i class="fa fa-heart-o" aria-hidden="true"></i>&nbsp;'+like);
         }
          
         // $(self).html('<i class="fa fa-thumbs-o-down" aria-hidden="true"></i> '+dislike);
          //alert(theme_path);
          if(errorMsg != null){
            //$('#likesErrorMsg').slideDown('1000');
            //$('#likesErrorMsg').html(errorMsg);
            //$('#likesErrorMsg').css({'visibility':'visible'});
          }
          if(error != null){
           // $('#errorMsg').slideDown('1000');
           // $('#errorMsg').html(error);
           // $('#errorMsg').css({'visibility':'visible'});
          }
        }
      })   
    });
//end code like
 

// post commetn display not
//add comment count like

/*$('.commenticon').on('click', function(e){
  $(".remove-div-comment").html('');
  var postID = $(this).attr('data-id');
     if(postID){
      $.ajax({
                 type: "POST",
                 url: ajax_url,
                 data :{
                       'action': 'get_comment_box',
                       'postid':postID,
                  }, 
                  success: function(response){

                      $("#comment-content-div-"+postID).html(response);
                       return false;
                }
            });
     }
});*/

$('.commenticon').on('click', function(e){
 
      var postID = $(this).attr('data-id');
      var vigval = $("#cmntbx-"+postID).is(":visible");     
       if(vigval){
         $("#cmntbx-"+postID).hide();
       }else{

            $(".show-div-comment").addClass("remove-div-comment");
            $(".remove-div-comment").html('');

            if(postID){
                $.ajax({

                   type: "POST",
                   url: ajax_url,
                   data :{
                         'action': 'get_comment_box',
                         'postid':postID,
                    }, 
                    success: function(response){

                        $("#comment-content-div-"+postID).html(response);
                        $("#comment-content-div-"+postID).addClass("show-div-comment");
                        $("#comment-content-div-"+postID).removeClass("remove-div-comment");
                         return false;
                  }
                });
            }
                //$("#cmntbx-"+postID).show();
       }  
});



//end post comment display not
//payment done

$("#subscription-monthly").click(function(){
     $(".loader").show();
     var userId =  $(this).attr('data-user');
     $.ajax({
               type: "POST",
               url: ajax_url,
               data :{
                     'action': 'do_payment',
                     'u_id':userId,
                }, 
                success: function(response){
                  $(".loader").hide();
                  var response= $.parseJSON(response);
                    if(response.error==0){
                      
                       $('#subscription-popup').modal('hide');
                       
                        $('#thanksyou-popup').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                 });

                    }else{
                      alert(response.msg);
                    }
                  return false;
               }
          });
});


function monthlysubscription(){
$("#subscription-monthly").click(function(){
     $(".loader").show();
     var userId =  $(this).attr('data-user');
     $.ajax({
               type: "POST",
               url: ajax_url,
               data :{
                     'action': 'do_payment',
                     'u_id':userId,
                }, 
                success: function(response){
                  $(".loader").hide();
                  var response= $.parseJSON(response);
                    if(response.error==0){
                      
                       $('#subscription-popup').modal('hide');
                       
                        $('#thanksyou-popup').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                 });

                    }else{
                      alert(response.msg);
                    }
                  return false;
               }
          });
});

}
//end payment done

$(".subscription-monthly").click(function(){
   $(".loader").show();
     var userId =  $(this).attr('data-user');
     $.ajax({
               type: "POST",
               url: ajax_url,
               data :{
                     'action': 'do_payment',
                     'u_id':userId,
                }, 
                success: function(response){
                   $(".loader").hide();
                  var response= $.parseJSON(response);
                    if(response.error==0){
                       $('#subscription-popup').modal('hide');
                       $('#thanksyou-popup').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                 });
                    }else{
                      alert(response.msg);
                    }
                  return false;
               }
          });
});


//payment done

$("#unfollow").click(function(){
   $(".loader").show();
     var unsbuserId =  $(this).attr('data-user_id1');
     var currentuserId =  $(this).attr('data-user_id2');
     $.ajax({
               type: "POST",
               url: ajax_url,
               data :{
                     'action': 'do_unsubscribedpayment',
                     'u_id':unsbuserId,
                     'lu_id':currentuserId,
                }, 
                success: function(response){
                   $(".loader").hide();
                  var response= $.parseJSON(response);
                    if(response.error==0){
                       window.location.reload();
                    }else{
                      alert(response.msg);
                    }
                  return false;
               }
          });
});


$(".unfollow").click(function(){
   $(".loader").show();
     var unsbuserId =  $(this).attr('data-user_id1');
     var currentuserId =  $(this).attr('data-user_id2');
     
     $.ajax({
               type: "POST",
               url: ajax_url,
               data :{
                     'action': 'do_unsubscribedpayment',
                     'u_id':unsbuserId,
                     'lu_id':currentuserId,
                }, 
                success: function(response){
                   $(".loader").hide();
                  var response= $.parseJSON(response);
                    if(response.error==0){
                       window.location.reload();
                    }else{
                      alert(response.msg);
                    }
                  return false;
               }
          });
});


$('form#login_1').on('submit', function(e){
        $(".loader").show();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login_1 #username').val(), 
                'password': $('form#login_1 #password').val(),
                'profile_id': $('form#login_1 #um_profile_id').val()
                },
            success: function(data){
              $(".loader").hide();
                if (data.status == 0){
                   $('p.status').text(data.message);
                   return false;
                }else{
                  //$('#subscription-popup').modal('show');
                   if(data.following==1){
                      window.location.reload();
                   }else{

                      $('#subscription-popup').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                      }); 

                      $("#dynamicinfo").html(data.html);
                      monthlysubscription();
                      $('#loginpopup-popup').modal('hide');
                   }
                  /*$('p.status').text(data.message);
                  $('p.status').removeClass('error');
                  window.location.reload(); */ 
                }
            }
        });
        e.preventDefault();
});

$("#forgetpassDiv").click(function(){

$('#loginpopup-popup').modal('hide');

 $('#reset_password_myModal').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                 });

});





//end payment done
//validation start
$('#sendtipform').validate({
   rules: {
       "amount": {
                     required: true,
                     number: true
                  }
        },
  messages: {
       amount: {
                     required: "Enter amount",
                     number: "Enter number only"
                  }
        },
 submitHandler: function(form) {
      $(".loader").show();
     $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data: { 
                'action': 'sendtipamount', //calls wp_ajax_nopriv_ajaxlogin
                'amount': $('form#sendtipform #amount').val(), 
                'um_profile_id': $('form#sendtipform #um_profile_id').val(),
               },
            success: function(data){
              $(".loader").hide();
                if (data.error == '0'){
                     $('#sendtipwithcard-popup').modal('hide');
                      $('#thanksyou-popup').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                 });
                }else{
                    alert(data.msg);
                }
            }
        });
   return false;
    //form.submit();
  }             
})

//validation end
$(".send_tip").click(function(){
	var profileId =  $(this).attr('data-profileId');
	$("#um_profile_id").val(profileId);
	//$('#sendtipwithcard-popup').modal('show');
   $('#sendtipwithcard-popup').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                 });

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






function autoload(){

	$('#check-1').click(function(){
		if(this.checked){
			$('#um-signupbtn-btn').prop('disabled', false);
		}else{
			$('#um-signupbtn-btn').prop('disabled', true);	
		}
	});

 $("#image").click(function(){
            if(!is_puuser){
                $('#becomecreator-popup').modal('show');
                   
                return false;  
            }
      });

// delete post
  $(".deletepost").click(function(){
       var postId = $(this).attr("ref");
       if(postId){
            $.ajax({
                 type: "POST",
                 dataType: "JSON",
                 url: ajax_url,
                 data :{
                       'action': 'remove_post',
                       'postId':postId,
                  }, 
                  success: function(response){
                    alert(response.msg);
                      $("#post_"+postId).remove();
                      return false;
                }
            });
       }
  });

  $(".cancel-btn").click(function(){

   var r = confirm("Are you sure you want to cancel ?");
    if (r == true) {
        txt = "You pressed OK!";
        window.location.href = siteurl+"profile";
    } else {
        txt = "You pressed Cancel!";
    }
 });

$("#edit_post").submit(function(){
 
    var postid = $("#postid").val();
    var p_content = $("#description2").val();
    $.ajax({
       type: "POST",
       url: ajax_url,
       data :{
         'action': 'update_post',
         'post_content':p_content,
         'postid':postid
        }, 
        success: function(response){
          var obj = JSON.parse(response);
            if(obj.error == 0){
               $("#error_msg").html(obj.msg);
               window.location.reload();  
            }
            if(obj.error == 1){
               $("#error_msg").html(obj.msg);
             }
                            
          }
      });
   
  });



// $('#paymentform').validate({
//    rules: {
//        "card_number": {
//                      required: true,
//                      number: true
//                   },
//        "expiremonth": {
//                      required: true,
//                      number: true
//                   },
//        "expireyear": {
//                      required: true,
//                      number: true
//                   },           
//       "cvv": {
//                      required: true,
//                      number: true
//                   }             
                              
//         },
//   messages: {
//             card_number: {
//                      required: "",
//                      number: ""
//                   },
//             expiremonth: {
//                      required: "",
//                      number: ""
//                   },
//             expireyear: {
//                      required: "",
//                      number: ""
//                   },
//             cvv: {
//                      required: "",
//                      number: ""
//                 },               
//         },
//  submitHandler: function(form) {
//      $.ajax({
//             type: 'POST',
//             dataType: 'json',
//             url: ajax_url,
//             data: { 
//                 'action': 'subscription_payment', //calls wp_ajax_nopriv_ajaxlogin
//                 'data': $('#paymentform').serialize(), 
//                },
//             success: function(data){
//               alert(data);
//                 // if (data.status == '0'){
//                 //     alert(data.msg);
//                 //     $('#sendtipwithcard-popup').modal('hide');
//                 // }else{
//                 //     alert(data.msg);
//                 //      $('#sendtipwithcard-popup').modal('hide');
//                 //       $('#thanksyou-popup').modal('show');
//                 // }
//             }
//         });
//    return false;
//     //form.submit();
//   }             
// })


$("#subscription_price").focusout(function(){
     var subscription_priceval=$(this).val();
     
     if(subscription_priceval<=4.99 && subscription_priceval!=''){
      $("#subscription_price").val('4.99');
      $("#subscription_price").css("background-color", "#ddd");
     }
    return false;
})

$("#subscription_price1").focusout(function(){
     var subscription_priceval=$(this).val();
     
     if(subscription_priceval<=4.99 && subscription_priceval!=''){
      $("#subscription_price1").val('4.99');
      $("#subscription_price1").css("background-color", "#ddd");
     }

     return false;
    
})

$(".um-follow-btn").click(function(){
  location.reload();
 });


 $(".um-unfollow-btn").click(function(){
  location.reload();
 });


//  $("#image").fileinput({
//     browseClass: "btn btn-primary",
//     showUpload: false,
//     showRemove: false,
//     allowedFileExtensions:["png","gif","jpg","jpeg","mp4","webm","3gp","mov"],
//     required: false,
//     validateInitialCount: false,
//     previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
// });
 
/* $("#msg_image").fileinput({
    browseClass: "btn btn-primary",
    showUpload: false,
    showRemove: false,
    allowedFileExtensions:["png","gif","jpg","jpeg","mp4","webm","3gp","mov"],
    required: false,
    validateInitialCount: false,
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
});*/

}


 /** Edit Post **/

  function getPostId(pid){
   
    $("#edit-post").show();
     // $("#postid").val(postid);
         $.ajax({
               type: "POST",
               url: ajax_url,
               data :{
                     'action': 'editpost',
                     'post_id':pid,
                }, 
                success: function(response){
                  $("#description2").val(response);
                  $("#postid").val(pid);
                  return false;
               }
          });
   }


function Copyurl() {
  var copyText = document.getElementById("referralurl");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}


