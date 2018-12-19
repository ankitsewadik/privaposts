$(document).ready(function(e) {
//validation

$('.pop-slider').owlCarousel({
    loop:false,
    autoHeight : true,
    margin:10,
    lazyLoad:true,
    nav:true,
    dots:true,
    video:true,
    autoPlay : true,
    autoplaySpeed:2000,
    items:1
});

autoload();




  
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
$('.commenticon').on('click', function(e){
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
  //$("#cmntbx-"+postID).toggle('slow');


    /*var postID = $(this).attr('data-id');
    $("#cmntbx-"+postID).toggle('slow');*/

});
//end post comment display not
//payment done




});//end document


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

