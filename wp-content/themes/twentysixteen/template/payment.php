 <?php

  include ABSPATH."wp-content/themes/twentysixteen/stripe/init.php";     
  //print_r($_POST);die;
 global $current_user; 
session_start();
 $stripe = array(
              "secret_key"      => STRIPE_KEY,
              "publishable_key" => PUBLISHED_KEY
            );
 
            $paymentInfo=get_user_meta($current_user->ID,'user_payment_details',true);
            $userpaymentInfo= unserialize($paymentInfo);
            $cusid=$userpaymentInfo['customer_id'];
            $addedcardNo='';$exp_month='';$exp_year='';
            $street    =  ($userpaymentInfo['street'])?$userpaymentInfo['street']:'';
            $city      =  ($userpaymentInfo['city'])?$userpaymentInfo['city']:'';
            $state     =  ($userpaymentInfo['state'])?$userpaymentInfo['state']:'';
            $zipcode   =  ($userpaymentInfo['zipcode'])?$userpaymentInfo['zipcode']:'';
            $country   =  ($userpaymentInfo['country'])?$userpaymentInfo['country']:'';
            $email     =  ($userpaymentInfo['email'])?$userpaymentInfo['email']:'';
            $holdername     =  ($userpaymentInfo['holdername'])?$userpaymentInfo['holdername']:'';

        if($cusid && $cusid!=''){
          
            
            \Stripe\Stripe::setApiKey($stripe['secret_key']);
         
            $cu = \Stripe\Customer::Retrieve(
              array("id" => $cusid, "expand" => array("default_source"))
            );
            
           $addedcardNo=($cu->default_source->last4)? "xxxx-xxxx-xxxx-".$cu->default_source->last4:'';


          if($cu){
            $addedcardNo=($cu->default_source->last4)? "xxxx-xxxx-xxxx-".$cu->default_source->last4:'';
            $exp_month=($cu->default_source->exp_month)? $cu->default_source->exp_month:'';
            $exp_year=($cu->default_source->exp_year)?$cu->default_source->exp_year:'';
          }
        }
            

/*echo $cu->default_source->brand . " ending in xxxxxxxxxxx" . $cu->default_source->last4.'<br>';
      echo '<b>Expiration Month:</b> '.$cu->default_source->exp_month . "/" . $cu->default_source->exp_year;*/

if(!empty($_POST['stripeToken'])){


$customer=array();
$paymentInfo=get_user_meta($current_user->ID,'user_payment_details',true);
$userpaymentInfo= unserialize($paymentInfo);
$cusid=(isset($userpaymentInfo['customer_id']) && $userpaymentInfo['customer_id']!='')?$userpaymentInfo['customer_id']:'';


            $token  = $_POST['stripeToken'];
            $name = $_POST['holdername'];
            //$lastname = $_POST['last_name'];
            $email = $_POST['email'];
          
            
           $stripe = array(
              "secret_key"      => STRIPE_KEY,
              "publishable_key" => PUBLISHED_KEY
            );
            
            \Stripe\Stripe::setApiKey($stripe['secret_key']); 
           if(isset($cusid) && $cusid!=''){

            //add customer to stripe

                $cu = \Stripe\Customer::Retrieve(
                  array("id" => $cusid, "expand" => array("default_source"))
                );   
                
                $cu->source = $token; // obtained with Stripe.js
                     $cu->description = "Customer for jenny.rosen@example.com";
                     $cu->email = $email;
                     $cu->save(); 
           }else{

              $customer = \Stripe\Customer::create(array(
                    'email' => $email,
                    'source' => $token,
                ));

           }


            if($customer->id!='' || $cusid!=''){

                $cisid=($customer->id)?$customer->id:$cusid;
                $street=(isset($_POST['street']) && $_POST['street']!='')?$_POST['street']:'';
                $city=(isset($_POST['city']) && $_POST['city']!='')?$_POST['city']:'';
                $state=(isset($_POST['state']) && $_POST['state']!='')?$_POST['state']:'';
                $zipcode=(isset($_POST['zipcode']) && $_POST['zipcode']!='')?$_POST['zipcode']:'';
                $country=(isset($_POST['country']) && $_POST['country']!='')?$_POST['country']:'';
                $email=(isset($_POST['email']) && $_POST['email']!='')?$_POST['email']:'';
                $holdername=(isset($_POST['holdername']) && $_POST['holdername']!='')?$_POST['holdername']:'';

                $user_payment_details=array('customer_id'=>$cisid,'street'=>$street,'city'=>$city,'state'=>$state,'zipcode'=>$zipcode,'country'=>$country,'email'=>$email,'holdername'=>$holdername); 
                 update_user_meta( $current_user->ID, 'user_payment_details', serialize($user_payment_details));
                  $_SESSION['message'] = '<div class="alert alert-success"><strong>Success!</strong> Save successfully</div> ';
                  wp_redirect( site_url('/payment-details') );
            }else{
                $_SESSION['message'] = '<div class="alert alert-danger"><strong>Error!</strong> Some thin goes wrong please try again latter.</div> ';
                wp_redirect( site_url('/payment-details') );
            }

   }
   if(isset($_SESSION['message']) && $_SESSION['message']!=''){
     echo $_SESSION['message'];
     $_SESSION['message']='';   
    }
 ?>
 <div class="haed-set">
    <h1>
        <?php the_title(); ?>
    </h1>
</div>
 <div class="payment-d">
 <form method="post" id="paymentFrm" enctype="multipart/form-data" name="paymentFrm" action="">
                        
         <div id="payment-errors"></div>               
        <div class="set-panels bec-set">
        <div class="panel panel-default">
            <div class="panel-heading"> Billing Details
                <div class="right-text">
                    <p>We are fully compliant with payment card industry data security standards.</p>
                </div>
            </div>
            <div class="panel-body clearfix">
                <div class="info-text">
                    <p>You may need to complete all appropriate address details below that are linked to your credit card in order to validate your credit card transaction.
                    </p>
                    <br>
                </div>
                          
                <div class="cover-fom">
                   
                        <input type="hidden" name="payment_detail" value="payment_detail">  
                        <div class="form-group clearfix">
                            <label for="st">Street<span class="mandatory-star">*</span></label>
                            <input type="text" class="form-control required" id="street" name="street" value="<?php echo $street; ?>">
                        </div>
                        <div class="form-group clearfix">
                            <label for="st">City<span class="mandatory-star">*</span></label>
                            <input type="text" class="form-control required" id="city" name="city" value="<?php echo $city; ?>">
                        </div>
                        <div class="form-group clearfix">
                            <label for="st">Zip/Post Code<span class="mandatory-star">*</span></label>
                            <input type="text" class="form-control required" id="zipcode" name="zipcode" value="<?php echo $zipcode; ?>">
                        </div>
                       
                </div>
            </div>
        </div>
    </div>   

     <div class="set-panels bec-set">
        <div class="panel panel-default">
            <div class="panel-heading">Card Details</div> 

        <div class="panel-body clearfix">
                <div class="cards">
                    <ul>
                        <li></li>
                        <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/card1.png"></li>
                        <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/card2.png"></li>
                    </ul>
                </div>
         
         
                 <!--Card Payment New Design Start-->
                <div class="payement-card-detail cover-fom">
                     <div class="form-group clearfix">
                         <label for="st">Card Number<span class="mandatory-star">*</span></label>

                         <input type="text" class="form-control required" id="card_num" name="card_num" value="<?php echo $addedcardNo;?>">
                     </div>         
                     <div class="row">
                       <div class="form-group col-md-6  clearfix">
                           <label for="st">Expiration (MM/YYYY)<span class="mandatory-star">*</span></label>
                           <input type="text" id="expire" maxlength="5" maxle name="expire" class="form-control required" value="<?php echo $exp_month.'/'.$exp_year;?>" placeholder="Expiry">
                       </div>
                       <div class="form-group col-md-6 clearfix cv-detail">
                           <label for="st">CVC<span class="mandatory-star">*</span></label>
                           <input type="text" id="card-cvc" name="cvc" class="form-control required" placeholder="CVV">
                       </div>
                     </div>
                 
                 
                     <div class="form-group clearfix">
                          <label for="st">Cardholder Name<span class="mandatory-star">*</span></label>
                           <input type="text" name="holdername" id="holdername" class="form-control required" placeholder="Cardholder Name" value="<?php echo $holdername;?>" />
                      </div>
                 
                </div>
         
         <!--Card Payment New Design End-->
         
                    <div class="cover-fom">
                  
                       <!--  <div class="form-group clearfix">
                            <label for="st">Card Number<span class="mandatory-star">*</span></label>

                            <input type="text" class="form-control required" id="card_num" name="card_num" value="<?php //echo $addedcardNo;?>">
                        </div> -->
                       <!--  <div class="form-group small-t clearfix">
                            <label for="st">Expiration (MM/YYYY)<span class="mandatory-star">*</span></label>
                            
                        <input type="text" name="exp_year" class="form-control" maxlength="4" id="card-expiry-year" placeholder="YYYY" value="<?php// echo $exp_year;?>">
                        <input type="text" name="exp_month" maxlength="2" class="form-control required" id="card-expiry-month" placeholder="MM" value="<?php// echo $exp_month;?>">
                        </div> -->
                     <!--    <div class="form-group clearfix">
                            <label for="st">Cardholder Name<span class="mandatory-star">*</span></label>
                             <input type="text" name="holdername" id="holdername" class="form-control required" placeholder="Cardholder Name" value="<?php //echo $holdername;?>" />
                        </div> -->
                       <!--  <div class="form-group clearfix">
                            <label for="st">CVC<span class="mandatory-star">*</span></label>
                            <input type="text" class="form-control required" id="card-cvc" name="cvc">
                        </div> -->
                        <div class="form-group text-right">
                            <div class="check-rem">
                                <input type="checkbox" name="check" id="check-1" class="required">
                                <label for="check-1">Tick here to confirm that you are at least 18 years old and the age of majority in your place of residence<span class="mandatory-star">*</span></label>
                                
                            </div>
                            <div class="sub-btn-p">
                                <button type="submit" id="payBtn" class="btn theme-btn btn-default blue-btn-hover">Save Details</button>
                               
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
  </form>     

   </div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script> 
                <script type="text/javascript">
                    Stripe.setPublishableKey('<?php echo PUBLISHED_KEY; ?>');
        
        //callback to handle the response from stripe
        function stripeResponseHandler_paymentform(status, response) {

            if (response.error) {
                //enable the submit button
                $('#payBtn').removeAttr("disabled");
            
                $('#payment-errors').addClass('alert alert-danger');
                $("#payment-errors").html(response.error.message);
                
            } else {
                $(".loader").show();
                var form$ = $("#paymentFrm");
                //get token id
                var token = response['id'];
                //insert the token into the form
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                //submit form to the server
                form$.get(0).submit();
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

         $('#card-cvc').focus(function() {
    $(this).attr('placeholder', '123')
}).blur(function() {
    $(this).attr('placeholder', 'CVV')
})

 $('#expire').focus(function() {
    $(this).attr('placeholder', 'MM/YY')
}).blur(function() {
    $(this).attr('placeholder', 'Expiry')
})



            $("#paymentFrm").validate();
            //on form submit
            $("#paymentFrm").submit(function(event) {

                $("#paymentFrm").validate();
                //disable the submit button to prevent repeated clicks
                $('#payBtn').attr("disabled", "disabled");

                var expire = $("#expire").val();
                var arrVars = expire.split("/");
                var month = arrVars[0];
                var year = arrVars[1];
                
                //create single-use token to charge the user
                Stripe.createToken({
                    number: $('#card_num').val(),
                    cvc: $('#card-cvc').val(),
                    exp_month: month,
                    exp_year: year
                }, stripeResponseHandler_paymentform);
                
                //submit from callback
                return false;
            });
        });
                </script>