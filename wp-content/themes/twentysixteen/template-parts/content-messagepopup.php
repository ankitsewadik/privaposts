<!-- Modal -->
<!-- <link rel="stylesheet" href="https://rawgit.com/dbrekalo/attire/master/dist/css/build.min.css"> -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/dist/fastselect.min.css">
<style>
.fstElement { font-size: 1.2em; }
.fstToggleBtn { min-width: 16.5em; }

.submitBtn { display: none; }

.fstMultipleMode { display: block; }
.fstMultipleMode .fstControls { width: 100%; }

.errortext textarea{border: 1px solid red !important;}
</style>
<?php 
global $wpdb;
global $current_user; 
$id=$current_user->ID;
$conversations = $wpdb->get_results(' 
SELECT * FROM '.$wpdb->prefix.'um_conversations where user_b = '.$id.' OR user_a = '.$id.'');
?>

<div class="all-pop"> 
<div id="new-msg" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close blue-btn-hover" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="newmsgtxt">New Message</h4>
            </div>
            <div class="modal-body">
                <section id="section-examples" class="attireBlock mod1">

        <form class="attireCodeToggleBlock" action="">
            To
            <select class="multipleSelect" multiple name="senduser" id="senduser">
                <!-- <option value="Afghanistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="Andorra">Andorra</option> -->
                <?php 
                $allsubscribeids='';
                foreach ( $conversations as $conversation ) {
                    if ( $conversation->user_a == um_profile_id() ) {
                      $user = $conversation->user_b;
                    } else {
                      $user = $conversation->user_a;
                    }
                    $allsubscribeids .= $user.",";
                    um_fetch_user( $user );
                     $user_name = ( um_user( 'display_name' ) ) ? um_user( 'display_name' ) : __( 'Deleted User', 'um-messaging' );
                 echo '<option value="'.$user.'">'.$user_name.'</option>';

                }

                ?>
            </select>
            <input type="hidden" name="allsubscribeids" id="allsubscribeids" value="<?php echo substr($allsubscribeids, 0, -1);?>">
            <button class="submitBtn" type="submit">Submit</button>
            <script>
                 $('.multipleSelect').fastselect();    
            </script>
        </form>       
    
</section>

               <!--  <div class="search-user">
                    To
                    <input type="text" id="addeduser" name="addeduser">
                </div> -->
                <div class="all-sub-next">
                    <div class="all-sub-select">
                        <label>
                            <input type="checkbox" name="allsub" id="allsub" value="<?php echo substr($allsubscribeids, 0, -1);?>"><span>All Subscribers</span></label>
                    </div>

                    <div class="next-btn">
                       
                       <button type="button" data-toggle="modal" data-target="#nextmodelpopup" >
                        <a href="#" id="next-btn" style="display: none;"> Next</a></button>
                    </div>


                </div>
                <div class="avail-user">
                    <h4>Available Users</h4>
 <?php //echo do_shortcode('[ultimatemember_online max="11" roles="all" ]'); 

 ?>
                    <ul class="avail-user-lst">
                     <?php
                     $i = 0;
                  foreach ( $conversations as $conversation ) {
                    if ( $conversation->user_a == um_profile_id() ) {
                      $user = $conversation->user_b;
                    } else {
                      $user = $conversation->user_a;
                    }

                    if ( UM()->Messaging_API()->api()->blocked_user( $user ) ) {
                      continue;
                    }

                    if ( UM()->Messaging_API()->api()->hidden_conversation( $conversation->conversation_id ) ) {
                      continue;
                    }

                    $i++;

                    if ( $i == 1 && ! isset( $current_conversation ) ) {
                      $current_conversation = $conversation->conversation_id;
                    }

                    um_fetch_user( $user );

                    $user_name = ( um_user( 'display_name' ) ) ? um_user( 'display_name' ) : __( 'Deleted User', 'um-messaging' );

                    $is_unread = UM()->Messaging_API()->api()->unread_conversation( $conversation->conversation_id, um_profile_id() );

                    //echo um_messaging_conversation_online_list_name();

                     //if(do_action( 'um_messaging_conversation_online_list_name')){

                        ?>
                        <li>
                            <div class="ava-usr-img">
                                <?php echo get_avatar( $user, 100 ); ?>
                            </div>
                            <div class="ava-usr-name"><?php echo $user_name; ?></span>
                            </div>
                            <?php do_action( 'um_messaging_conversation_list_name' ); ?>
                        </li>

                     <?php } 
                     ?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div id="nextmodelpopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close blue-btn-hover" data-dismiss="modal">&times;</button>
        <div class="back-btn"><a href="#" data-toggle="modal" data-target="#new-msg" id="backtoselectwindow"><i class="fa fa-angle-left"></i></a></div>

        <h4 class="modal-title" id="nosubscriber">Next message to x users</h4>
      </div>
      <div class="modal-body">
            
            <form name="multimessage" id="multimessage" method="post" action="" onsubmit="return false;">
                <div class="act-reply-bx ">
                    <div class="act-text um-message-textarea">
                        <?php ///echo $this->emoji(); ?>
                        <textarea name="um_mul_message_text" id="um_mul_message_text" data-maxchar="" placeholder="Type your message"></textarea>
                        </div>
                    <div class="act-send um-message-buttons">
                        <a href="#" class="um-message-send send-btn">
                        <i class="fa fa-paper-plane"></i>
                    <input type="submit" name="Save"></a>
                    </div>
                </div> 
                <div class="act-icons">
                    <div class="act-gallry">
                        <div class="up-load">
                         <!--  <input type="file" name="mul_msg_image[]" id="mul_msg_image"> -->
<input type="file" class="files" name="files">
                        </div>

                    </div>
                    <div class="act-dollar">
                        <img src="<?php echo site_url();?>/wp-content/themes/twentysixteen/assets/images/dollar-eye.png" alt="">
                    </div>
                </div>
                

            </form>

      </div>
    </div>
  </div>
</div>

</div>
<script type="text/javascript">

$(document).ready(function(){
    
    $("#backtoselectwindow").click(function(){
          jQuery("#nextmodelpopup").hide();
          jQuery("button.close" ).trigger( "click" );
    })

   /* $("#senduser").change(function(){
      $('#allsub').prop('checked', false);
    })*/
    $("#senduser").change(function(){
      $('#allsub').prop('checked', false);
        var count1=0;
       var userids1 = [];
        $("#senduser :selected").map(function(i, el) {
              userids1.push($(el).val());
              count1++;
        });
        if(count1!=0){
          $(".next-btn #next-btn").show();
          $('.inputDisabled').removeAttr("disabled")
        }else{
          $(".next-btn #next-btn").hide();
        }
    });

    $("#allsub").change(function(){
      if ($('#allsub').is(":checked")){
        $(".next-btn #next-btn").show();
      }else{
        var selectedval=$("#senduser").val();
        if(selectedval == null || selectedval==''){
         $(".next-btn #next-btn").hide();
        }
      }
    });

    
    $(".next-btn #next-btn").click(function(){
            $(".act-gallry .fileuploader-items-list").remove();
            $('input[name^="fileuploader-list-files"]').val('');
            $('input[name^="files"]').val('');
            multipleFileUploaderCode();
            var count=0;        
            var userids = [];
            if ($('#allsub').is(":checked")){

               var userids = $('#allsub').val();
               var result  =$('#allsub').val().split(',');
               count=result.length;
            }else{
                $("#senduser :selected").map(function(i, el) {
                    userids.push($(el).val());
                count++;
                });
            }
      
    if(count!=0){
        
        jQuery("#new-msg").hide();
        jQuery("button.close" ).trigger( "click" );
        $("#multimessage").show();
        $("#nosubscriber").html('Next message to '+count+' users');

        if(count==1){

            UM_Conv_Ajax = true;
            
            var link = jQuery(this);
            var savehtml = jQuery(this).html();
            jQuery(this).find('img').replaceWith('<span class="um-message-cssload"><i class="um-faicon-circle-o-notch"></i></span>');
            
            window.history.pushState("string", "Conversation",  jQuery(this).attr('href') );
            
            jQuery.ajax({
                url: wp.ajax.settings.url,
                type: 'post',
                data: {
                    action:'um_messaging_start',
                    message_to: userids[0]
                },
                success: function(data){
                    if ( data ) {
                        UM_Update_UTC_to_LocalTime();
                        jQuery('.um-message-conv-view').html( data );
                        link.html( savehtml );
                        jQuery('.um-message-conv-item').removeClass('active');
                        link.addClass('active');
                        Init_BodyConv();
                        jQuery('.um-tip-n').tipsy({gravity: 'n', opacity: 1, offset: 3, delayIn: 500 });
                        jQuery('.um-tip-w').tipsy({gravity: 'w', opacity: 1, offset: 3, delayIn: 500 });
                        jQuery('.um-tip-e').tipsy({gravity: 'e', opacity: 1, offset: 3, delayIn: 500 });
                        jQuery('.um-tip-s').tipsy({gravity: 's', opacity: 1, offset: 3, delayIn: 500 });
                        jQuery("#new-msg").hide();
                        jQuery("button.close" ).trigger( "click" );
                        UM_Conv_Ajax = false;
                        setTimeout(function(){ multipleFileUploaderCode(); }, 500);
                        
                    } else {

                    }
                },
                error: function(e){
                    console.log(e);
                }
            });
                return false;
         }

    }else{

            $("#multimessage").hide();
            $("#nosubscriber").html('No Subscribers selected.');
            jQuery("#new-msg").hide();
            jQuery("button.close" ).trigger( "click" );
    }
    });


  /*  $("#mul_msg_image").fileinput({
        browseClass: "btn btn-primary",
        showUpload: false,
        showRemove: false,
        allowedFileExtensions:["png","gif","jpg","jpeg","mp4","webm","3gp","mov"],
        required: false,
        validateInitialCount: false,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });*/

   jQuery(document).on('submit','#multimessage',function(){        
                var userids = [];
                if ($('#allsub').is(":checked")){
                   var userids = $('#allsub').val();
                }else{
                    var count=0;
                    $("#senduser :selected").map(function(i, el) {
                        userids.push($(el).val());
                    count++;
                    });
                }
             
               
                  var add_post_value = jQuery("#add_post_value").val();
                  var p_content = jQuery('#um_mul_message_text').val();
                  var message_to = userids;
                  var form_data = new FormData();
                  var files_data = jQuery('.files');
                 
                  /*jQuery.each(jQuery(files_data), function(i, obj) {
                      $.each(obj.files,function(j,file){
                        form_data.append('files[' + j + ']', file);
                      })
                  });
                 */

                  var cnt = 0;
                  jQuery.each(jQuery(files_data), function(i, obj) {
                    jQuery.each(obj.files,function(j,file){
                      form_data.append('files[' + cnt + ']', file);
                      cnt++;
                    })
                  });

                  form_data.append('action', 'um_multimessaging_send');
                  form_data.append('content', p_content);
                  form_data.append('message_to', message_to);

                  
                 if(p_content == "" && cnt == 0){                  
                      jQuery(".act-text").removeClass('um-message-textarea');
                      jQuery(".act-text").addClass('errortext');
                      return false;  
                  }else{ 
                      jQuery(".act-text").addClass('um-message-textarea');
                      jQuery(".act-text").removeClass('errortext');

                      $.ajax({
                          type: "POST",
                          url: ajax_url,
                          dataType: "JSON",
                          data : form_data,
                          contentType: false,
                          processData: false,
                        
                          
                      success: function(response){
                        
                            UM_Update_UTC_to_LocalTime();
                            jQuery('#um_mul_message_text').val('');
                            jQuery('.um-message-body:visible').find('.um-message-ajax:visible').html( response.messages );
                            //jQuery(".um-message-body").hide();
                            jQuery(".um-message-body").animate({ scrollTop: jQuery('.um-message-body').prop("scrollHeight")}, 1000);
                            if ( response.limit_hit ) {
                                jQuery('.um-message-footer:visible').html( jQuery('.um-message-footer:visible').attr('data-limit_hit') );
                            }
                            jQuery('.um-popup-autogrow:visible').mCustomScrollbar('update').mCustomScrollbar("scrollTo", "bottom",{ scrollInertia:0});
                            jQuery( ".close" ).trigger( "click" );
                            jQuery("li.fileuploader-item.file-has-popup.file-type-image.file-ext-png").hide();
                            if( response.is_table_exist != true ){
                                console.log( response.is_table_exist );
                            }
                        },
                        error: function(e){
                            console.log(e);
                        }
                        
                    });
                }

    });

});
</script>






 

