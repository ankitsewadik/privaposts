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
<style type="text/css">
  input.error{
    border-bottom: 2px solid red;
  }
  label.error{
    display: none !important;
  }


</style>
 <div class="modal fade" id="sendppv-popup" role="dialog">
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content ">
                  <div class="modal-body">
                   <div class="pay-pop">
                     <div class="pay-header">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pay-white-logo.png">
                        <button type="button" id="paymentclsbtn" class="close" data-dismiss="modal">×</button>
                     </div>
                     <div class="comp-text">Request custom <span>Pay Per View</span>  content</div>
                     <div class="user-name-price">
                        <span>from</span>   @<?php echo $current_user->user_login; ?> 
                     </div>
                     <div class="card-imgusr">
                        <div class="card-in">
                                 <?php echo get_avatar(  um_profile_id(), 240 ); ?>
                        </div>
                      
                         <span class="chek">
                           <img src="<?php echo get_template_directory_uri()?>/assets/images/tick_small_edit.png" />
                       </span>
                     </div>
                    
                     <div class="cust-box">
                        <div class="outer-border">
                           <div class="head-out">
                              <p> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/dollar-eye.png" alt=""> Offer price $ (USD)<sup>*</sup>:</p>
                           </div>
                           <div class="in-text">
                             <input type="text" name="" placeholder="00.00">
                           </div>
                        </div>
                        <div class="outer-border">
                           <div class="head-out">
                              <p> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/edit-pencil.png" alt=""> discription<sup>*</sup>:</p>
                           </div>
                           <div class="text-area">
                              <textarea class="form-control" rows="3" placeholder="Write your request..."></textarea>
                           </div>
                        </div>
                        <div class="footer-btn">
                           <button type="submit" data-dismiss="modal" class="btn btn-default blue-btn-hover">Cancel</button>
                           <button type="submit" class="btn btn-default blue-btn-hover">Submit</button>
                        </div>
                     </div>
                   </div>
                  </div>
               </div>
            </div>
         </div>

 
<script type="text/javascript">
   
        $(document).ready(function() {

   $('#paymentform').validate({
       rules: {
            "card_number": {
                     required: true,
                     number: true
                  },
        "expire": {
                     required: true,
                  },
        "cvv": {
                     required: true,
                     number: true
                  },
        "postalcode": {
                     required: true,
                  }                         
                              
        },
  messages: {
            card_number: {
                     required: "",
                     number: ""
                  },
            expire: {
                     required: "",
                     number: ""
                  },
            postalcode: {
                     required: "",
                     number: ""
                  },
            cvv: {
                     required: "",
                     number: ""
                },               
        },
 submitHandler: function(form) {
         
                return false;
  }             
})

           
        });
                </script>