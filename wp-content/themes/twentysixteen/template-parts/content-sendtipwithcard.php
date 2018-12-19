<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
 <?php 
  $current_user = get_user_by('id', um_profile_id());
 ?>
 
<div class="modal modal-sec modal-sub fade in" id="sendtipwithcard-popup" role="dialog" >
  <div class="modal-dialog"> 
   <!-- Modal content-->
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Shape-1.png" alt="Shape-1"> </button>
     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pop-icon.png" alt="pop-icon">
     <h6>Send a tip to</h6>
     <h4 class="modal-title"><?php echo isset($current_user->first_name) && $current_user->first_name != ''?$current_user->first_name.' '.$current_user->last_name:'---'; ?></h4>
    </div>
  <div class="modal-body">
     <div class="center-text"> 
      <h6>Enter Amount</h6>
      <form id="sendtipform" method="post">
      <div class="cent-in">
        <div class="form-group"> 
        <span class="input-icon"><i class="fa fa-usd" aria-hidden="true"></i></span>
       <input class="form-control" name="amount" id="amount" placeholder="Enter amount" type="text">
       <input class="form-control" name="um_profile_id" id="um_profile_id" value="<?php echo um_profile_id(); ?>" type="hidden">
      </div>
      </div>
      <div class="btns clearfix">
       <button type="submit" class="btn btn-default save blue-btn-hover">Send</button>
      </div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>

