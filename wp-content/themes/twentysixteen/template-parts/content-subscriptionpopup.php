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
         $subscription_price =  get_user_meta( um_profile_id(), 'subscription_price', true); 
         $subscription_price =  ($subscription_price)?$subscription_price:'0.00';
          $current_user = get_user_by('id', um_profile_id());
?>
<div class="modal modal-sec modal-sub  model-subcription fade" id="subscription-popup" role="dialog">
  <div class="modal-dialog"> 
   <!-- Modal content-->
   <div class="modal-content">
   
   <div class="wra-cont clearfix">
    <button type="button" id="closebtn" class="close cls-sub" data-dismiss="modal"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Shape-1.png" alt="Shape-1"> </button>
    <div class="wrp-left pull-left">
     <div class="wrp-img"> <?php echo get_avatar(  um_profile_id(), 240 ); ?> </div>
     <p><?php echo isset($current_user->first_name) && $current_user->first_name != ''?$current_user->first_name.' '.$current_user->last_name:$current_user->user_login; ?>
     <span class="apptickicon"><img src="<?php echo get_template_directory_uri()?>/assets/images/tick_small_edit.png" /></span>
   </p>
     <p><span>@<?php echo $current_user->user_login; ?></span></p>
     <div class="appicon"><img src="<?php echo get_template_directory_uri()?>/assets/images/Priva_app_icon.png" /></div>
    </div>
    <div class="wrp-right pull-right">
     <div class="flwheader">Follow <span>@<?php echo $current_user->user_login; ?></span></div>
     <div><span class="flwuserprice">$<?php echo $subscription_price; ?></span>
     </div>
     <ul>
      <li>Full Access to this user's exclusive content </li>
      <li>Direct message with this user </li>
      <li>Request personalised pay per view content from this user</li>
      <li>Cancel your subscription at any time </li>
     </ul>
     <div id="dynamicinfo" class="login-info">
          <?php $check =  is_addedpaymentinfo(get_current_user_id()); ?>
          <?php if($check){  ?> 
               <!--  <a href="#" class="um-follow-btn btn btn-theme-sm" data-user_id1="<?php// echo um_profile_id(); ?>" data-user_id2="<?php //echo get_current_user_id(); ?>">Follow $<?php //echo $subscription_price; ?> <span>(per month)</span></a> -->
               <a id="subscription-monthly" data-user="<?php echo um_profile_id(); ?>" class="btn btn-theme-sm blue-btn-hover" href="javascript:void(0);">Follow</a>

          <?php }else{  ?>
             <a id="paymentpopup" data-keyboard="false" data-backdrop="static" class="btn btn-theme-sm blue-btn-hover" data-toggle="modal" href="javascript:void(0)" data-target="#payment-popup">Follow</a>
          <?php } ?>

            <?php 
          $fees = (2.9*$subscription_price)/100;
          $fees = $fees + 0.30;
     ?>
     
       <div class="text-infom">
         <p> By clicking "Follow“ you confirm payment of $<?php echo $subscription_price; ?> USD monthly plus credit card fees* until you cancel your subscription.</p>
          <p>*Credit card processing fee of <?php echo number_format((float)$fees, 2, '.', ''); ?> USD will be charged <i class="fa fa-question-circle" aria-hidden="true"></i></p>
       </div>
     
     </div>
    </div>
   </div>
   </div>
  </div>
</div>
<script type="text/javascript">
  $("#paymentpopup").click(function(){
     $('#subscription-popup').modal('hide');
  });

     <?php if(!is_user_logged_in()){ ?>
         $("#closebtn").click(function(){
             window.location.reload();
          });
    <?php } ?>  

  
  
</script>