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
<div id="payment-popup" class="modal fade" role="dialog">
 <div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-body">
    <div class="payemtn-popup">
     
     <div class="payement-header">
       <a>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/privaposts-white-logo.png">
       </a>
       <button type="button" id="paymentclsbtn" class="close" data-dismiss="modal">×</button>
     </div>
     <div class="complete-text">Complete your monthly payment to</div> 
     <div class="user-nme-price">
      @<?php echo $current_user->user_login; ?> <span>for</span> $<?php echo $subscription_price; ?>
     </div>
     <div class="card-img-usr">
      <?php echo get_avatar(  um_profile_id(), 240 ); ?>
     </div>
     <div class="panel panel-default">
       <div class="panel-heading">
         <div class="cards-logo">
          <ul class="list-inline">
           <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/card1.png"></li>
           <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/card2.png"></li>
          </ul>
         </div>
       </div>
       <form method="post" action="" id="paymentform">
       <div class="panel-body">
        <div class="card-no">
         <input type="text" id="card_number" name="card_number"  placeholder="Credit Card Number" >
         <i class="fa fa-lock"></i>
        </div>   
        <div class="card-detail">
         <input type="text" id="expire" maxlength="5" name="expire" placeholder="Expiry">
         <input type="text" id="cvv" maxlength="3" name="cvv" placeholder="CVV">
         <input type="text" id="postalcode"  name="postalcode" placeholder="Zip/Postal">
        </div> 
        <input type="hidden" id="um_profile_id" name="um_profile_id" value="<?php echo um_profile_id(); ?>">
        <div class="follow-btn">
         <button type="submit"  id="payBtn" class="btn btn-theme-sm blue-btn-hover">Follow</button>
        </div>
       </div>
     </form>
     </div>
     <?php 
          $fees = (2.9*$subscription_price)/100;
          $fees = $fees + 0.30;
     ?>
     <div id="payment-errors"></div>
     <div class="secure-payment"><i class="fa fa-lock"></i>Secure Checkout</div>     
     <p> By clicking "Follow“ you confirm payment of $<?php echo $subscription_price; ?> USD monthly plus credit card fees* until you cancel your subscription.</p>
     <p>*Credit card processing fee of <?php echo number_format((float)$fees, 2, '.', ''); ?> USD will be charged per monthly transaction.<i class="fa fa-question-circle"></i></p> 
     <p>By making this payment, you agree to <a href="<?php echo site_url(); ?>/terms/">Privaposts Terms of Use</a>.</p> 
    </div>
   </div>
  </div>
 </div>
</div>
 
<script type="text/javascript" src="https://js.stripe.com/v2/"></script> 
<script type="text/javascript">
    Stripe.setPublishableKey('pk_test_wEHLUFS6Z3HoSDmXOUruSfAo');
        //callback to handle the response from stripe
        function stripeResponseHandler(status, response) {

            if (response.error) {
                $('#payment-errors').addClass('alert alert-danger');
                $("#payment-errors").html(response.error.message);
            } else {
                $(".loader").show();
                $('#payment-errors').removeClass('alert alert-danger');
                $("#payment-errors").html('');
              $('#payBtn').removeAttr("disabled");
                var form$ = $("#paymentform");
                var token = response['id'];
                form$.append("<input type='hidden' id='stripeToken' name='stripeToken' value='" + token + "' />");
            $.ajax({
                   type: 'POST',
                   dataType: 'json',
                   url: ajax_url,
                   data: { 
                          'action': 'subscription_payment', //calls wp_ajax_nopriv_ajaxlogin
                          'data': $('#paymentform').serialize(), 
                        },
              success: function(data){
                $(".loader").hide();
                 if (data.error == '0'){
                      $('#payment-popup').modal('hide');
                      $('#subscription-popup').modal('hide');
                      $('#thanksyou-popup').modal({
                              backdrop: 'static',
                              keyboard: false  // to prevent closing with Esc button (if you want this too)
                      });
                 }else{
                     alert(data.msg);
                //      $('#sendtipwithcard-popup').modal('hide');
                //       $('#thanksyou-popup').modal('show');
                }
            }
        });

                //form$.get(0).submit();
            }
        }
        $(document).ready(function() {

        

         $('#expire').bind('keyup','keydown', function(event) {
           var inputLength = event.target.value.length;
          if (event.keyCode != 8){
            if(inputLength === 2 || inputLength === 6){
                var thisVal = event.target.value;
                thisVal += '/';
                $(event.target).val(thisVal);
              }
            }
        });


            $('#cvv').focus(function() {
    $(this).attr('placeholder', '123')
}).blur(function() {
    $(this).attr('placeholder', 'CVV')
})

 $('#expire').focus(function() {
    $(this).attr('placeholder', 'MM/YY')
}).blur(function() {
    $(this).attr('placeholder', 'Expiry')
})

 $('#postalcode').focus(function() {
    $(this).attr('placeholder', '2562')
}).blur(function() {
    $(this).attr('placeholder', 'Zip/Postal')
})


        <?php if(!is_user_logged_in()){ ?>

          $("#paymentclsbtn").click(function(){
              window.location.reload();
          });

        <?php } ?>  

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
                $("#stripeToken").remove();
                var expire = $("#expire").val();
                var arrVars = expire.split("/");
                var month = arrVars[0];
                var year = arrVars[1];
                Stripe.createToken({
                    number: $('#card_number').val(),
                    cvc: $('#cvv').val(),
                    exp_month: month,
                    exp_year: year
                }, stripeResponseHandler);
                return false;
  }             
})

           
        });
                </script>