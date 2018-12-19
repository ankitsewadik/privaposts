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
<div class="modal modal-sec modal-sub fade in" id="subscriptionpayment-popup" role="dialog" >
  <div class="modal-dialog"> 
   <!-- Modal content-->
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Shape-1.png" alt="Shape-1"> </button>
     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pop-icon.png" alt="pop-icon">
     <!-- <h6>Send a tip to</h6> -->
     <?php /* ?>
     <h4 class="modal-title"><?php echo isset($current_user->first_name) && $current_user->first_name != ''?$current_user->first_name.' '.$current_user->last_name:'---'; ?></h4>
     <?php */ ?>
    </div>
    <div class="modal-body">
     <div class="center-text"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Forma-1.png" alt="Forma-1">
      <h6>You need to <span><a href="<?php echo home_url('payment-details'); ?>">add a payment card</a></span></h6>
      <div class="btns clearfix">
       <button type="button" data-dismiss="modal" class="blue-btn-hover btn btn-default save close">OK</button>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 