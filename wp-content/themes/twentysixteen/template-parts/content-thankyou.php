<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

 <?php  $current_user = get_user_by('id',get_current_user_id());
       $subscribed_user = get_user_by('id', um_profile_id());
 ?>
 <div id="thanksyou-popup" class="modal fade in" role="dialog">
 <div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-body">
    <div class="thanku-message">
     <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
     <h3>Thank you <span><?php echo $current_user->user_login; ?></span> </h3>
     <h4>I appreciate your amazing support!</h4>
     <div class="thanku-user-img"> <span><?php echo get_avatar(um_profile_id(), 180 ); ?></span></div>
     <div class="thanks-user-name"><?php echo isset($subscribed_user->first_name) && $subscribed_user->first_name != ''?$subscribed_user->first_name.' '.$subscribed_user->last_name:$subscribed_user->user_login; ?><img src="<?php echo get_template_directory_uri()?>/assets/images/tick_small_edit.png" /></div>
     <div class="thanks-user-email">@<?php echo $subscribed_user->user_login; ?></div>
     <div class="btns-vup-msg"> <a href="<?php echo home_url().'/'.$subscribed_user->user_login;?>" class="btn btn-default">View profile</a> <a href="<?php echo site_url().'/messages/'; ?>" class="btn btn-default blue-btn-hover">Message</a> </div>
     <p>View my <a class="blue-btn-hover" href="<?php echo home_url().'/'.$subscribed_user->user_login;?>">profile</a> and enjoy all my premium private posts!</p>
     <p><a href="<?php echo site_url().'/messages/'; ?>">Message</a> me to request custom pay per view content :)</p>
    </div>
   </div>
  </div>
 </div>
</div>