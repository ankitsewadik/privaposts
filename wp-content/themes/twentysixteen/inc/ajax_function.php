<?php 
/*Define All Ajax Functions**/  

 // Function: script_load_more posts dispaly
 // Description: Add Short code for load more in profile page
function script_load_more($args = array()) {
    //initial posts load

    echo '<div id="ajax-primary" class="">';
        echo '<div id="ajax-content" class="">';
            ajax_script_load_more($args);
        echo '</div>';
        echo '<center><a href="#" id="loadMore" style="display:none;" data-page="1" data-url="'.admin_url("admin-ajax.php").'" class="btn btn-lg">Load More</a></center>';
    echo '</div></div>';
}
add_shortcode('ajax_posts', 'script_load_more');

 // Function: ajax_script_load_more
 // Description: Load more post in profile 5 post at a time and when scroll load more
function ajax_script_load_more($args) {
    //init ajax

    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num =5;
    //page number

    $paged = $_POST['page'] + 1;
    //args

    $profile_id = isset($_POST['profile_id'])?$_POST['profile_id']:um_profile_id();
    
    $args = array(
      'author'        =>  $profile_id,
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' =>$num,
        'paged'=>$paged
    );
    //query
    $query = new WP_Query($args);

   if(is_currentUser()){
    $subscribed = true;
   }else{
    $subscribed = UM()->Followers_API()->api()->followed( um_profile_id(), get_current_user_id() );  
   }

    if ($query->have_posts()):
        //loop articales
        while ($query->have_posts()): $query->the_post();
          get_template_part( 'template-parts/content', 'ajaxcontent' );
          if(!$subscribed){
                       break; 
                }
        endwhile;
    else:
       if(is_pu_user(um_profile_id()) && !$subscribed){ 
          echo ' <div class="botm-ban">
                     <div class="follow-prv-host-one">
                        <img src="'.get_template_directory_uri().'/assets/images/ban-logo-2.png" alt="ban-logo">
                       <h3><span>Follow to see all my private posts</span></h3>
                        <a data-toggle="modal" class="btn btn-default" href="javascript:void(0)" data-target="#subscription-popup">FOLLOW</a>
                     </div>
                  </div>';
       }else{
        //echo 0;   
       }  
    endif;
    //reset post data
    wp_reset_postdata();
    //check ajax call
    if($ajax) die();
}

add_action('wp_ajax_nopriv_ajax_script_load_more', 'ajax_script_load_more');
add_action('wp_ajax_ajax_script_load_more', 'ajax_script_load_more');


function script_load_home_more($args = array()) {
    //initial posts load
    echo '<div id="ajax-primary" class="">';
        echo '<div id="ajax-content" class="">';
            ajax_script_home_load_more($args);
        echo '</div>';
        echo '<center><a href="#" id="loadMore" style="display:none;" data-page="1" data-url="'.admin_url("admin-ajax.php").'" class="btn btn-lg">Load More</a></center>';
    echo '</div></div>';
}
/*
 * create short code.
 */
add_shortcode('ajax_home_posts', 'script_load_home_more');


function ajax_script_home_load_more($args) {
    //init ajax
    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num =5;
    //page number
    $paged = $_POST['page'] + 1;
    //args
   $author_ids = array();
   $subscribe_user_ids = UM()->Followers_API()->api()->following(get_current_user_id());

   if(!empty($subscribe_user_ids)){
         foreach($subscribe_user_ids as $following){
                    array_push($author_ids, $following['user_id1']);

          }
   }
   $author_ids[] = get_current_user_id();
   



    
    $args = array(
      'author__in'        =>  $author_ids,
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' =>$num,
        'paged'=>$paged
    );
    //query
    $query = new WP_Query($args);

    if ($query->have_posts()):
        //loop articales
        while ($query->have_posts()): $query->the_post();
          get_template_part( 'template-parts/content', 'ajaxcontent' );
        endwhile;
    else:
       echo '';
    endif;
    //reset post data
    wp_reset_postdata();
    //check ajax call
    if($ajax) die();
}
 /* load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_script_home_load_more', 'ajax_script_home_load_more');
add_action('wp_ajax_ajax_script_home_load_more', 'ajax_script_home_load_more');



// do payment stripe
add_action("wp_ajax_nopriv_sendtipamount", "sendtipamount");
add_action("wp_ajax_sendtipamount", "sendtipamount");

function sendtipamount(){
  $um_profile_id = $_POST['um_profile_id'];
  $currentuserId = get_current_user_id();
  $amount = $_POST['amount'];
  
  global $wpdb; 
  if($um_profile_id && $amount){
    include ABSPATH."wp-content/themes/twentysixteen/stripe/init.php";     
     
        $check =  is_addedpaymentinfo($currentuserId);
        if($check){
            $check = unserialize($check); 
            $customerId = $check['customer_id'];
             $stripe = array(
                      "secret_key"      => STRIPE_KEY,
                      "publishable_key" => PUBLISHED_KEY
              );
          \Stripe\Stripe::setApiKey($stripe['secret_key']); 

         try
        { 

        $fees = get_withfees_amount($amount);

        $tipamnt = $amount;

        $amount = ($fees+$amount)*100; // because it is in cent 

        $response = \Stripe\Charge::create(array(
                  "amount" => round($amount),
                  "currency" => "usd",
                  "customer" => $customerId,
                  "description" => "Send tip"
                ));

        $errors =  array('error'=>0,'msg'=>'Successfully send tip.');
          
        $amountvalue = $response->amount;
        $insertedArray=array('plan_id'=>$response->id,
                     'amount'=> $tipamnt,
                     'fees'  => $fees,
                     'created_date'=>$response->created,
                     'currency'=>$response->currency,
                     'interval'=>0,
                     'from_pay_userid'=>$currentuserId,
                     'to_pay_userid'=>$um_profile_id,
                     'subscription_id'=>$response->id,
                     'subscription_object'=>$response->description,
                     'billing'=>0,
                     'current_period_end'=>$response->created,
                     'current_period_start'=>$response->created,
                     'customer_id'=>$response->customer,
                     'ended_at'=>$response->created,
                     'status'=>$response->status
        );

        $table=$wpdb->prefix."stripe_transaction";
        $wpdb->insert(
              $table,
              $insertedArray
              );
        $userdata = get_userdata( get_current_user_id());
        
      $userdata = get_userdata( get_current_user_id());
      $table_name = $wpdb->prefix . "um_notifications";
      
    $wpdb->insert(
      $table_name,
      array(
        'time' => current_time( 'mysql' ),
        'user' => $um_profile_id,
        'status' => 'unread',
        'photo' => um_get_avatar_url( get_avatar( get_current_user_id(), 40 ) ),
        'type' => 'tip',
        'url' => get_permalink(get_current_user_id()),
        'content' => "<strong>".$userdata->display_name."</strong> has just sent you a tip for $".$tipamnt."!"
        
      )
    );

    //email
        $userdata = get_userdata( $currentuserId);
        $pu_data = get_userdata( $um_profile_id);
        $toemail =  $pu_data->user_email;
        $data['amount'] =  ($tipamnt);
        $data['pu_name'] =  $pu_data->display_name;
        $data['su_name'] =  $userdata->display_name;
        sendCustomEmail(3, $toemail, $data);
    //end email
         $msg = "I have just sent you a tip for $".$data['amount']." ❤ ";
         insertMessage($currentuserId, $um_profile_id, $msg); //send message

        echo json_encode($errors); exit();

    }catch(Exception $e){
       
        $errors =  array('error'=>1,'msg'=>'Send tip to '.$userdata->data->display_name.' failed. Please contact your bank and or check your credit card payment details and try to subscribe again later.');
        echo json_encode($errors); exit();
      }

      $errors =  array('error'=>0,'msg'=>'You have Send tip successfully');
      echo json_encode($errors); exit();
     }
  
  }else{
    $errors  = array('error'=>1, 'msg'=>'Some thing wrong with the user');
    echo json_encode($errors); exit();
  }
  exit(0);
}//end function



// private post view payment stripe
add_action("wp_ajax_nopriv_sendppvamount", "sendppvamount");
add_action("wp_ajax_sendppvamount", "sendppvamount");

function sendppvamount(){

  $um_profile_id = $_POST['um_profile_id'];
  $currentuserId = get_current_user_id();

  $userdata = get_userdata( $currentuserId);
  $amount = $_POST['amount'];
  $msgid=$_POST['msgid'];
   //ini_set("display_errors", "1");
   //error_reporting(E_ALL);
  if($um_profile_id && $amount){
    include ABSPATH."wp-content/themes/twentysixteen/stripe/init.php";     
    global $wpdb;
        $check =  is_addedpaymentinfo($currentuserId);
        if($check){
            $check = unserialize($check); 
            $customerId = $check['customer_id'];
             $stripe = array(
                      "secret_key"      => STRIPE_KEY,
                      "publishable_key" => PUBLISHED_KEY
              );
          \Stripe\Stripe::setApiKey($stripe['secret_key']); 

           try
    {   
        //$amount = $amount*100; // because it is in cent 

        $fees = get_withfees_amount($amount); 
        $amountprice = ($fees + $amount) *100;  // convert dollar to cent

        $response = \Stripe\Charge::create(array(
                  "amount" => round($amountprice),
                  "currency" => "usd",
                  "customer" => $customerId,
                  "description" => "PPV"
                ));

        $errors =  array('error'=>0,'msg'=>'Successfully paid');

        $amountvalue = $response->amount;
        $insertedArray=array('plan_id'=>$response->id,
                     'amount'=>$amount,
                     'fees'=>$fees,
                     'created_date'=>$response->created,
                     'currency'=>$response->currency,
                     'interval'=>0,
                     'from_pay_userid'=>$currentuserId,
                     'to_pay_userid'=>$um_profile_id,
                     'subscription_id'=>$response->id,
                     'subscription_object'=>$response->description,
                     'billing'=>0,
                     'current_period_end'=>$response->created,
                     'current_period_start'=>$response->created,
                     'customer_id'=>$response->customer,
                     'ended_at'=>$response->created,
                     'status'=>$response->status
        );

        $table=$wpdb->prefix."stripe_transaction";
        $wpdb->insert(
              $table,
              $insertedArray
              );
      $userdata = get_userdata( $currentuserId);
      $table_name = $wpdb->prefix . "um_notifications";
      
    $wpdb->insert(
      $table_name,
      array(
        'time' => current_time( 'mysql' ),
        'user' => $um_profile_id,
        'status' => 'unread',
        'photo' => um_get_avatar_url( get_avatar( get_current_user_id(), 40 ) ),
        'type' => 'ppv',
        'url' => get_permalink(get_current_user_id()),
        'content' => "<strong>".$userdata->display_name."</strong> has sent you PPV amount $".$amount."!"
      )
    );


    //email
        $userdata = get_userdata( $currentuserId);
        $pu_data = get_userdata( $um_profile_id);
        $puemail =  $pu_data->user_email;
        $suemail =  $userdata->user_email;
        $data['amount'] =  ($amount);
        $data['pu_name'] =  $pu_data->display_name;
        $data['su_name'] =  $userdata->display_name;


       if ( $msgid ) {
          $tablemessages = $wpdb->prefix . "um_messages";
          $wpdb->query( $wpdb->prepare(
            "UPDATE {$tablemessages} 
            SET msg_type = 2 
            WHERE message_id = %d ",
            $msgid
          ) );
        }
        
        sendCustomEmail(5, $suemail, $data);
        
        sendCustomEmail(6, $puemail, $data);
    //end email
        echo json_encode($errors); exit();

    }catch(Exception $e){
        $errors =  array('error'=>1,'msg'=>'pay to '.$userdata->data->display_name.' failed. Please contact your bank and or check your credit card payment details and try to pay again later.');
        echo json_encode($errors); exit();
      }

      $errors =  array('error'=>0,'msg'=>'You have paid successfully');
      echo json_encode($errors); exit();
     }
  
  }else{
    $errors  = array('error'=>1, 'msg'=>'Some thing wrong with the user');
    echo json_encode($errors); exit();
  }
  exit(0);
}//end function


/*get PU Details*/
add_action("wp_ajax_nopriv_pu_details", "pu_details");
add_action("wp_ajax_pu_details", "pu_details");
function pu_details(){

  if($_POST){
     if($_POST['um_profile_id'] && $_POST['um_profile_id']!=''){
       $image =get_avatar( $_POST['um_profile_id'], 240 );
       $current_user = get_user_by('id', $_POST['um_profile_id']);
       $name=$current_user->user_login;
     }
     if($_POST['amntval'] && $_POST['amntval']!=''){
       $fees=get_withfees_amount($amount);
     }
     $msg  = array('error'=>0, 'puimage'=>$image,'fees'=>$fees,'puname'=>$name);
  }else{
      $msg  = array('error'=>1, 'msg'=>'Some thing wrong with the user');  
  }
 echo json_encode($msg); exit();
}



/*PPV payment by card*/
add_action("wp_ajax_nopriv_ppv_payment", "ppv_payment");
add_action("wp_ajax_ppv_payment", "ppv_payment");

function ppv_payment(){

  include ABSPATH."wp-content/themes/twentysixteen/stripe/init.php";  
  global $wpdb;    
   $stripe = array(
              "secret_key"      => STRIPE_KEY,
              "publishable_key" => PUBLISHED_KEY
            );
  $formdata = $_POST['data'];
  $loginuser_id = get_current_user_id();
  $userdata = get_userdata( $loginuser_id);
  $params = array();
  parse_str($_POST['data'], $params);

    if(isset($params['c_stripeToken'])){
      
      $token = $params['c_stripeToken'];
      $profile_id = $params['um_profile_id'];
      $zipcode = $params['c_postalcode'];
      $amount =$params['paymsg_amount'];
      $pu_id = $params['sent_pu_id'];
      $msgid  =$params['paymsg_id'];

      \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $customer = \Stripe\Customer::create(array(
                    'email' => $userdata->data->user_email,
                    'source' => $token,
                )); 
          $custmerId =  $customer->id;
          $user_payment_details=array('customer_id'=>$custmerId,'zipcode'=>$zipcode,'email'=>$userdata->data->user_email,'holdername'=>''); 
          update_user_meta( $loginuser_id, 'user_payment_details', serialize($user_payment_details));

     $userID = $profile_id;
     $currentuserId = get_current_user_id();
  
  if($pu_id){

        $fees = get_withfees_amount($amount); 
        $amountprice = ($fees + $amount) *100;  // convert dollar to cent
       
      try{    

        $response = \Stripe\Charge::create(array(
                  "amount" => round($amountprice),
                  "currency" => "usd",
                  "customer" => $custmerId,
                  "description" => "PPV"
                ));    

        if ( $msgid ) {
          $tablemessages = $wpdb->prefix . "um_messages";
          $wpdb->query( $wpdb->prepare(
            "UPDATE {$tablemessages} 
            SET msg_type = 2 
            WHERE message_id = %d ",
            $msgid
          ) );
        }

         //$amountprice = $subscription_price/100;
         $insertedArray=array('plan_id'=>$response->id,
                     'amount'=>$amount,
                     'fees'  => $fees,
                     'created_date'=>$response->created,
                     'currency'=>$response->currency,
                     'interval'=>0,
                     'from_pay_userid'=>$currentuserId,
                     'to_pay_userid'=>$um_profile_id,
                     'subscription_id'=>$response->id,
                     'subscription_object'=>$response->description,
                     'billing'=>0,
                     'current_period_end'=>$response->created,
                     'current_period_start'=>$response->created,
                     'customer_id'=>$response->customer,
                     'ended_at'=>$response->created,
                     'status'=>$response->status
        );
        $table=$wpdb->prefix."stripe_transaction";
        $InsertresultArr = $wpdb->insert($table,$insertedArray);
        $pu_data = get_userdata( $pu_id);
      // end insert transaction details

    }catch(Exception $e){
        $errors =  array('error'=>1,'msg'=>'Paid to '.$pu_data->data->display_name.' failed. Please contact your bank and or check your credit card payment details and try to pay again later.');
        echo json_encode($errors); exit();
      }
        //email
        $su_data = get_userdata( $currentuserId);
        $pu_data = get_userdata( $pu_id);

        $data['amount'] =  $amount;
        $data['pu_name'] =  $pu_data->display_name;
        $data['su_name'] =  $su_data->display_name;

        $puemail =  $pu_data->user_email;
        $suemail =  $su_data->user_email;
        
        sendCustomEmail(5, $suemail, $data);
        sendCustomEmail(6, $pu_data, $data);
      
  //end email

         //startcode
    $userdata = get_userdata( $currentuserId);
    $table_name = $wpdb->prefix . "um_notifications";
    $wpdb->insert(
      $table_name,
      array(
        'time' => current_time( 'mysql' ),
        'user' => $userID,
        'status' => 'unread',
        'photo' => um_get_avatar_url( get_avatar( um_user('ID'), 40 ) ),
        'type' => 'new_follow',
        'url' => get_permalink(um_user('ID')),
        'content' => "<strong>".$userdata->data->user_nicename."</strong> have sent you PPV amount $".$amount."!"
      )
    );
        //endcode
        $errors =  array('error'=>0,'msg'=>'You have paid successfully');
        echo json_encode($errors); exit();
     }//customerid
  }else{
    $errors  = array('error'=>1, 'msg'=>'Some thing wrong with the user');
    echo json_encode($errors); exit();
  }
  exit(0);
}

add_action("wp_ajax_nopriv_do_payment", "do_payment");
add_action("wp_ajax_do_payment", "do_payment");

function do_payment(){
  include ABSPATH."wp-content/themes/twentysixteen/stripe/init.php";     
  $userID = $_POST['u_id'];
  $currentuserId = get_current_user_id();
  global $wpdb; 


  if($userID){
    $userdata = get_userdata( $userID);
    
        $subscription_price =  get_user_meta( $userID, 'subscription_price', true); 
        $fees = get_withfees_amount($subscription_price);

        $subscription_price =  ($subscription_price)?$subscription_price:'0.00';
        $amnt_withoutfees = $subscription_price;

        $subscription_price = ($fees+$subscription_price)*100;  // convert dollar to cent
      
        $check =  is_addedpaymentinfo($currentuserId);

        if($check){
            $check = unserialize($check); 
            $customerId = $check['customer_id'];
             $stripe = array(
                      "secret_key"      => STRIPE_KEY,
                      "publishable_key" => PUBLISHED_KEY
              );
            
        \Stripe\Stripe::setApiKey($stripe['secret_key']); 
           try
    {   


          $time = time();
          $subscription =   \Stripe\Plan::create(array(
                    "amount" => round($subscription_price),
                    "interval" => "month",
                    "product" => array(
                       "name" => "subscription monthly"
                     ),
                    "currency" => "usd",
                    "id" => "$customerId-subscription-$userID-$time"
                  ));
      // Subscribe the customer to the plan
      $subscription = \Stripe\Subscription::create(array(
                    "customer" => $customerId,
                    "plan" => "$customerId-subscription-$userID-$time"
                  ));

      // insert transaction details
        //$decData=json_decode($subscription);
        $amountprice = $amount/100;
        $planData=$subscription->plan;
        $insertedArray=array('plan_id'=>$planData->id,
                     'amount'=>$amnt_withoutfees,
                     'fees'  => $fees,
                     'created_date'=>$planData->created,
                     'currency'=>$planData->currency,
                     'interval'=>$planData->interval,
                     'from_pay_userid'=>$currentuserId,
                     'to_pay_userid'=>$userID,
                     'subscription_id'=>$subscription->id,
                     'subscription_object'=>$subscription->object,
                     'billing'=>$subscription->billing,
                     'current_period_end'=>$subscription->current_period_end,
                     'current_period_start'=>$subscription->current_period_start,
                     'customer_id'=>$subscription->customer,
                     'ended_at'=>$subscription->ended_at,
                     'status'=>$subscription->status,
                     'trial_end'=>$subscription->trial_end,
                     'trial_start'=>$subscription->trial_start
        );
        $table=$wpdb->prefix."stripe_transaction";
        $InsertresultArr = $wpdb->insert($table,$insertedArray);

      // end insert transaction details
      //print_r($subscription->id); die;
      update_user_meta($currentuserId, 'subscription_userid_'.$userID, $subscription->id);
    }catch(Exception $e){
        $errors =  array('error'=>1,'msg'=>'Subscription to '.$userdata->data->display_name.' failed. Please contact your bank and or check your credit card payment details and try to subscribe again later.');
        echo json_encode($errors); exit();
      }

      UM()->Followers_API()->api()->add( $userID, $currentuserId ); // After payment code 

      //email
          $su_data = get_userdata( $currentuserId);
        $pu_data = get_userdata( $userID);
        $toemail =  $pu_data->user_email;
        $data['amount'] =  $amnt_withoutfees;
        $data['pu_name'] =  $pu_data->display_name;
        $data['su_name'] =  $su_data->display_name;
        sendCustomEmail(2, $toemail, $data);
        //email sent to SU
        $su_data = get_userdata( $userID);
        $pu_data = get_userdata( $currentuserId);
        $toemail =  $pu_data->user_email;
        $data['amount'] =  $amnt_withoutfees;
        $data['pu_name'] =  $su_data->display_name;
        $data['su_name'] =  $pu_data->display_name;
        sendCustomEmail(1, $toemail, $data);
  //end email

         //startcode
        $userdata = get_userdata( $currentuserId);
      $table_name = $wpdb->prefix . "um_notifications";
    $wpdb->insert(
      $table_name,
      array(
        'time' => current_time( 'mysql' ),
        'user' => $userID,
        'status' => 'unread',
        'photo' => um_get_avatar_url( get_avatar( um_user('ID'), 40 ) ),
        'type' => 'new_follow',
        'url' => get_permalink(um_user('ID')),
        'content' => "<strong>".$userdata->data->display_name."</strong> has just followed your profile!"
      )
    );

     // $wpdb->insert(
      //    $wpdb->prefix.'um_conversations',
      //    array(
      //      'user_a' => $currentuserId,
      //      'user_b' => $userID
      //    )
      //  );
    insertMessage($currentuserId, $userID, '');

        //endcode
      $errors =  array('error'=>0,'msg'=>'You have subscribed successfully');
      echo json_encode($errors); exit();
     }
  
  }else{
    $errors  = array('error'=>1, 'msg'=>'Some thing wrong with the user');
    echo json_encode($errors); exit();
  }
  exit(0);
}//end function








add_action("wp_ajax_nopriv_ajaxregistration", "ajax_registration");
add_action("wp_ajax_ajaxregistration", "ajax_registration");

function ajax_registration() {
  
 //print_r($_POST);die;

    global $wpdb;

    if ($_POST["username"]!='' && $_POST["user_email"]!='' && $_POST["password"]!='' && $_POST["confirm_password"]!='') {
    $user_login   = $_POST["username"]; 
    $user_email   = $_POST["user_email"];
    $user_pass    = $_POST["password"];
    $pass_confirm   = $_POST["confirm_password"];
 
    // this is required for username checks
    //require_once(ABSPATH . WPINC . '/registration.php');
 
    if(username_exists($user_login)) {
      // Username already registered
      //pippin_errors()->add('username_unavailable', __('Username already taken'));

      echo json_encode(array('status'=>0, 'message'=>__('Username already taken')));
        die();
    }
    if(!validate_username($user_login)) {
      // invalid username
      pippin_errors()->add('username_invalid', __('Invalid username'));

      echo json_encode(array('status'=>0, 'message'=>__('Invalid username')));
        die();
    }
    if($user_login == '') {
      // empty username
      pippin_errors()->add('username_empty', __('Please enter a username'));

      echo json_encode(array('status'=>0, 'message'=>__('Please enter a username')));
        die();
    }
    if(!is_email($user_email)) {
      //invalid email
      pippin_errors()->add('email_invalid', __('Invalid email'));
      echo json_encode(array('status'=>0, 'message'=>__('Invalid email')));
        die();
    }
    if(email_exists($user_email)) {
      //Email address already registered
      pippin_errors()->add('email_used', __('Email already registered'));

      echo json_encode(array('status'=>0, 'message'=>__('Email already registered')));
        die();
    }
    if($user_pass == '') {
      // passwords do not match
      pippin_errors()->add('password_empty', __('Please enter a password'));

      echo json_encode(array('status'=>0, 'message'=>__('Please enter a password')));
        die();
    }
    if($user_pass != $pass_confirm) {
      // passwords do not match
      pippin_errors()->add('password_mismatch', __('Passwords do not match'));

      echo json_encode(array('status'=>0, 'message'=>__('Passwords do not match')));
        die();
    }
 
    $errors = pippin_errors()->get_error_messages();
 
    // only create the user in if there are no errors
    if(empty($errors)) {
   
            $table_name = $wpdb->prefix . "user_ref_record";


        $new_user_id = wp_insert_user(array(
          'user_login'    => $user_login,
          'user_pass'     => $user_pass,
          'user_email'    => $user_email,
          'user_registered' => date('Y-m-d H:i:s'),
          'role'        => 'subscriber'
        )
      );

      if($new_user_id) {

                //$id= numhash($_POST['ref_id']);

        // send an email to the admin alerting them of the registration
        wp_new_user_notification($new_user_id);

     //            if($_POST['ref_id'] && $_POST['ref_id']!=''){
     //               $table_name = $wpdb->prefix . "user_ref_record";
          // $wpdb->insert(
          //  $table_name,
          //  array(
          //    'user_id' => $id,
          //    'reffer_id' =>$new_user_id ,
          //    'status' => '1',
          //    'percent' => 10
          //  )
          // );
     //            }
           
        // log the new user in
        wp_setcookie($user_login, $user_pass, true);
        wp_set_current_user($new_user_id, $user_login); 
        UM()->Followers_API()->api()->add( 1, $new_user_id ); // Default follow to admin
        do_action('wp_login', $user_login);
        echo json_encode(array('status'=>1, 'message'=>__('Registration Successfully')));
              die();
      }
 
    }
  }else{
    echo json_encode(array('status'=>0, 'message'=>__('All fields are required.')));
      die();
  }

}


add_action("wp_ajax_nopriv_ajaxlogin", "ajax_login");
add_action("wp_ajax_ajaxlogin", "ajax_login");

function ajax_login(){
  if($_POST['username']!='' && $_POST['password']!='') {
    // this returns the user ID and other info from the user name
    $user = get_userdatabylogin($_POST['username']);
        $userlogin =$_POST['username'];
        if(empty($user)){
           $user = get_user_by('email', $_POST['username']);
           $userdata=$user->data;
           $userlogin=$userdata->user_login;
        }
    if(!empty($user)) {
      // if the user name doesn't exist
      if(!wp_check_password($_POST['password'], $user->user_pass, $user->ID)) {
      // if the password is incorrect for the specified user
        echo json_encode(array('status'=>0, 'message'=>__('Wrong password.')));
        die();
        }else{
          $profile_id = $_POST['profile_id'];
          $login_user_id = $user->ID;

        wp_setcookie($userlogin, $_POST['password'], true);
        wp_set_current_user($user->ID, $userlogin); 
        $following = 0;
        if ( UM()->Followers_API()->api()->followed( $profile_id, $login_user_id ) ) {
             $following = 1;
        }
        if($profile_id == $login_user_id){  // check user should follow to him self
             $following = 1;
        }
        $check =  is_addedpaymentinfo($user->ID);
        $html = "";
        if($check){
          $html = '<a id="subscription-monthly" data-user="'.$profile_id.'" class="btn btn-theme-sm" href="javascript:void(0);">Follow</a>';
        }else{
          $html = '<a id="paymentpopup" data-keyboard="false" data-backdrop="static" class="btn btn-theme-sm" data-toggle="modal" href="javascript:void(0)" data-target="#payment-popup">Follow</a>  <script>$(document).ready(function(e) {
      $("#paymentpopup").click(function(){
            $("#subscription-popup").modal("hide");
      });
  });</script>';
        }

        echo json_encode(array('status'=>1,'html'=>$html,'following'=>$following, 'message'=>__('successfully')));
        die();
        }
    }else{
        echo json_encode(array('status'=>0, 'message'=>__('Wrong username password.')));
        die();
    }
    }else{
            echo json_encode(array('status'=>0, 'message'=>__('Please enter your username and password')));
      die();
    }
}



add_action("wp_ajax_nopriv_do_unsubscribedpayment", "do_unsubscribedpayment");
add_action("wp_ajax_do_unsubscribedpayment", "do_unsubscribedpayment");

function do_unsubscribedpayment(){
  $unsubuser_id = $_POST['u_id'];
  $login_userId = $_POST['lu_id'];
  $unfollow_reason = $_POST['unfollow_reason'];

  $check =  is_addedpaymentinfo($login_userId);

        if($check){
          include ABSPATH."wp-content/themes/twentysixteen/stripe/init.php";     

            $check = unserialize($check); 
            $customerId = $check['customer_id'];
            
            $stripe = array(
                      "secret_key"      => STRIPE_KEY,
                      "publishable_key" => PUBLISHED_KEY
              );

               $user_last = get_user_meta( $login_userId, 'subscription_userid_'.$unsubuser_id, true); 

             try{
                \Stripe\Stripe::setApiKey($stripe['secret_key']); 

                $subscription = \Stripe\Subscription::retrieve($user_last);
                $subscription->cancel();
          UM()->Followers_API()->api()->remove( $unsubuser_id, $login_userId ); // After payment code 
          update_user_meta($currentuserId, 'subscription_userid_'.$unsubuser_id, 'false');
          $errors =  array('error'=>0,'msg'=>'You have remove successfully');
            echo json_encode($errors); exit();

            }catch(Exception $e){
                
                $errors =  array('error'=>1,'msg'=>'getting problem in payment gateway');
              echo json_encode($errors); exit();
           }
    }          
  $errors =  array('error'=>1,'msg'=>'getting problem in payment gateway');
    echo json_encode($errors); exit();
}




add_action("wp_ajax_nopriv_subscription_payment", "subscription_payment");
add_action("wp_ajax_subscription_payment", "subscription_payment");

function subscription_payment(){
  include ABSPATH."wp-content/themes/twentysixteen/stripe/init.php";  
  global $wpdb;    
   $stripe = array(
              "secret_key"      => STRIPE_KEY,
              "publishable_key" => PUBLISHED_KEY
            );
  //$formdata = $_POST['data'];
  $loginuser_id = get_current_user_id();

  $userdata = get_userdata( $loginuser_id);
  $params = array();
    parse_str($_POST['data'], $params);

    if(isset($params['stripeToken'])){
      $token = $params['stripeToken'];
      $profile_id = $params['um_profile_id'];
      $zipcode = $params['postalcode'];

      \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $customer = \Stripe\Customer::create(array(
                    'email' => $userdata->data->user_email,
                    'source' => $token,
                )); 
          $custmerId =  $customer->id;
          $user_payment_details=array('customer_id'=>$custmerId,'zipcode'=>$zipcode,'email'=>$userdata->data->user_email,'holdername'=>''); 
          update_user_meta( $loginuser_id, 'user_payment_details', serialize($user_payment_details));

         $userID = $profile_id;
         $currentuserId = get_current_user_id();
   
  if($userID){
        $userdata = get_userdata( $userID);
        $subscription_price =  get_user_meta( $userID, 'subscription_price', true); 
        $fees = get_withfees_amount($subscription_price);
        $subscription_price =  ($subscription_price)?$subscription_price:'0.00';
        $amnt_withoutfees = $subscription_price;
        $amoutwithfees = $subscription_price;
        $subscription_price = ($fees + $subscription_price) *100;  // convert dollar to cent
      
        if($custmerId){

           try
         {    
          $time = time();

        $subscription =   \Stripe\Plan::create(array(
                    "amount" => round($subscription_price),
                    "interval" => "month",
                    "product" => array(
                       "name" => "subscription monthly"
                     ),
                    "currency" => "usd",
                    "id" => "$custmerId-subscription-$userID-$time"
                  ));

      // Subscribe the customer to the plan
      $subscription = \Stripe\Subscription::create(array(
                    "customer" => $custmerId,
                    "plan" => "$custmerId-subscription-$userID-$time"
                  ));

      // insert transaction details
          $planData = $subscription->plan;
          
        $amountprice = $subscription_price/100;
        $insertedArray=array('plan_id'=>$planData->id,
                     'amount'=>$amnt_withoutfees,
                     'fees' => $fees, 
                     'created_date'=>$planData->created,
                     'currency'=>$planData->currency,
                     'interval'=>$planData->interval,
                     'from_pay_userid'=>$currentuserId,
                     'to_pay_userid'=>$userID,
                     'subscription_id'=>$subscription->id,
                     'subscription_object'=>$subscription->object,
                     'billing'=>$subscription->billing,
                     'current_period_end'=>$subscription->current_period_end,
                     'current_period_start'=>$subscription->current_period_start,
                     'customer_id'=>$subscription->customer,
                     'ended_at'=>$subscription->ended_at,
                     'status'=>$subscription->status,
                     'trial_end'=>$subscription->trial_end,
                     'trial_start'=>$subscription->trial_start
        );
        $table=$wpdb->prefix."stripe_transaction";
        $InsertresultArr = $wpdb->insert($table,$insertedArray);

      // end insert transaction details
      update_user_meta($currentuserId, 'subscription_userid_'.$userID, $subscription->id);
    }catch(Exception $e){
       
        $errors =  array('error'=>1,'msg'=>'Subscription to '.$userdata->data->display_name.' failed. Please contact your bank and or check your credit card payment details and try to subscribe again later.');
        echo json_encode($errors); exit();
      }

      UM()->Followers_API()->api()->add( $userID, $currentuserId ); // After payment code 

        //email
        $su_data = get_userdata( $currentuserId);
        $pu_data = get_userdata( $userID);
        $toemail =  $pu_data->user_email;
        $data['amount'] =  $amnt_withoutfees;
        $data['pu_name'] =  $pu_data->display_name;
        $data['su_name'] =  $su_data->display_name;
        sendCustomEmail(2, $toemail, $data);
        //email sent to SU
        $su_data = get_userdata( $userID);
        $pu_data = get_userdata( $currentuserId);
        $toemail =  $pu_data->user_email;
        $data['amount'] = $amnt_withoutfees;
        $data['pu_name'] =  $su_data->display_name;
        $data['su_name'] =  $pu_data->display_name;
        sendCustomEmail(1, $toemail, $data);
  //end email

         //startcode
        $userdata = get_userdata( $currentuserId);
      $table_name = $wpdb->prefix . "um_notifications";
    $wpdb->insert(
      $table_name,
      array(
        'time' => current_time( 'mysql' ),
        'user' => $userID,
        'status' => 'unread',
        'photo' => um_get_avatar_url( get_avatar( um_user('ID'), 40 ) ),
        'type' => 'new_follow',
        'url' => get_permalink(um_user('ID')),
        'content' => "<strong>".$userdata->data->user_nicename."</strong> has just followed your profile!"
      )
    );

     $wpdb->insert(
          $wpdb->prefix.'um_conversations',
          array(
            'user_a' => $currentuserId,
            'user_b' => $userID
          )
        );
     
        //endcode
      $errors =  array('error'=>0,'msg'=>'You have subscribed successfully');
      echo json_encode($errors); exit();
     }
  }else{
    $errors  = array('error'=>1, 'msg'=>'Some thing wrong with the user');
    echo json_encode($errors); exit();
  }
  exit(0);
       exit();  
    }else{
      $errors =  array('error'=>1,'msg'=>'Credit card information is wrong.');
      echo json_encode($errors); exit();
    }
}




add_action("wp_ajax_nopriv_get_comment_box", "get_comment_box");
add_action("wp_ajax_get_comment_box", "get_comment_box");

function get_comment_box(){

  if($_POST['postid'] && $_POST['postid']!=''){

    $postid=$_POST['postid'];
   ?>
   <style type="text/css">
    .says, .comment-reply-title{
      display: none;
    }
   </style>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/ajax-comment.js?ver=4.9.8"></script>
<script type="text/javascript">
  $('.simpleAjaxLike_comment').on('click', function(e){

      e.preventDefault();
      var userAction = $(this).attr('data-option');
      var check = $(this).attr('data-check');
      var commentID = $(this).attr('data-id');
      
  //    $('#likesErrorMsg').slideUp('1000');
    //  $('#errorMsg').slideUp('1000');
     var self = $(this);
      $.ajax({
        type : "POST",
        dataType: 'json',
        url : ajax_url,
        data : {
          action: "sal_simpleAjaxCount_comment",
          commentID : commentID,
          userAction: userAction
        },
        success: function(data) {

          var like = data.like_count;
          var dislike = data.dislike_count;
          var errorMsg = data.like_message;
          var error = data.error_msg;
           var islike_user = data.islike_user;
        

        if(like >= 1){
            $(self).html('<i class="fa fa-heart" aria-hidden="true"></i>'+like);
         }else{
            $(self).html('<i class="fa fa-heart-o" aria-hidden="true"></i>'+like);
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
</script>
      <div id="cmntbx-<?php echo $postid;  ?>" class="pbox" >
                        <?php if(get_comments_number($postid)){ // check user has post comment
                           
                           ?>
                        <ol id="commentlisting" class="commentlist">
                           <?php    
                              //Gather comments for a specific page/post 
                              $comments = get_comments(array(
                                  'post_id' => $postid
                              ));
                              //Display the list of comments
                              wp_list_comments(array(
                                  'reverse_top_level' => true,//Show the latest comments at the top of the list
                                  'callback' => 'addCommentReplyForm',
                                  'short_ping'        => true,
                                  'max_depth'=> '15'
                              ), $comments);  
                              ?>
                        </ol>
                        <?php 
                           $fields='';
                           $args = array(
                             'id_form'           => 'commentform2',
                             'class_form'      => 'commentform',
                             'id_submit'         => 'submit',
                             'class_submit'      => 'submit',
                             'name_submit'       => 'submit',
                           
                             'title_reply_to'    => __( 'Leave a Reply to %s' ),
                             'cancel_reply_link' => __( 'Cancel Reply' ),
                             'label_submit'      => __( 'Post Comment' ),
                             'format'            => 'xhtml',
                           
                             'comment_field' =>  '<div class="rply-bx"><textarea id="comment" placeholder="Write a reply..." name="comment"  aria-required="true">' .
                               '</textarea></div>',
                           
                             'must_log_in' => '<p class="must-log-in">' .
                               sprintf(
                                 __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                                 wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                               ) . '</p>',
                           
                             'fields' => apply_filters( 'comment_form_default_fields', $fields ),
                           );
                           comment_form( $args, $postid ); ?>
                     
                     <?php   }else{
                        ?>
                     <div id="respond" class="comment-respond">
                        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                        <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
                        <?php else : ?>
                        <form class="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" >
                          
                           <?php if ($req) echo '<span class="required">*</span>'; ?>
                              <textarea placeholder="Write a comment..." name="comment" id="comment"  tabindex="4" style=""></textarea>

                              
                          
                           <p class="form-submit">
                              <input name="submit" id="submit" tabindex="5" value="Post Comment" type="submit">
                              <input name="comment_post_ID" value="<?php echo $postid; ?>" id="comment_post_ID" type="hidden">
                              <input name="comment_parent" id="comment_parent" value="0" type="hidden">
                           </p>
                           <?php do_action('comment_form', $postid); ?>           
                        </form>
                        <?php endif; // If registration required and not logged in ?>
                     </div>
                     <?php } //end else ?>
                  </div>

   <?php 
    die();
  }
}

add_action("wp_ajax_nopriv_update_post", "update_post");
add_action("wp_ajax_update_post", "update_post");
function update_post(){

  if(isset($_POST['postid']) && $_POST['postid']!=''){

        $my_post = array(
            'ID'           => $_POST['postid'],
            'post_content' => $_POST['p_content'],
        );

      if ( $_FILES ) {
         $files = $_FILES['files'];

         $dir_path = __DIR__;
         $dir_path =  str_replace('/inc','', $dir_path);
         
        require_once( $dir_path. '/assets/fileuploader/src/class.fileuploader.php' );

        $p_id = wp_update_post($my_post);
        $prevfile = get_post_meta($p_id, 'post_image');

        
        $path = $dir_path.'/uploads/'.$p_id.'/media/'; 
        $dir = $dir_path.'/uploads/'.$p_id;
        if(file_exists($dir)){
          deleteDir($dir);    
        }                      
        /*echo "test";die();*/
        createPath($path);

        $FileUploader = new FileUploader('files', array(
            'limit' => 20,
            'maxSize' => null,
            'fileMaxSize' => null,
            'required' => false,
            'uploadDir' => $path,
            'title' => 'name',
            'replace' => false,
            'editor' => array(
            'quality' => 100
          ),
          'listInput' => true,
          'files' => null
      ));

      // file upload
      $data = $FileUploader->upload();

     
      //
      // if uploaded and success
    foreach ($data['files'] as $value) {
          $url = $value['file'];
          $url = str_replace("privaposts/","",$url);
          $last = explode("/", $url, 6);
          deleteDir(site_url().'/'.$last[5]);
          $nurls[] = site_url().'/'.$last[5];
    }
    
    if($prevfile){
      foreach ($prevfile as $img) {
        # code...
        foreach ($img as $v) {
          $nurls[] = $v;
        }
      }
    }
     
    if($data['hasWarnings']) {
          $warnings = $data['warnings'];
          wp_delete_post($p_id);
          $record = array('error'=>1,'msg'=>"Post created successfully");
        echo json_encode($record); exit();
      }

    update_post_meta( $p_id, 'post_image', $nurls );
    $record = array('error'=>0,'msg'=>"Post created successfully");
    echo json_encode($record); exit();
  
  }else{
    $resp = wp_update_post( $my_post );
  
  }
    
      if(!empty($resp)){
      $data = array('error' => 0,'msg' => '<div class="alert alert-success"><strong>Success! </strong>Post updated successfully.</div>');
    }else{
        $data = array('error' => 1,'msg' => '<div class="alert alert-danger"><strong>Error! </strong> Something goes wrong please try again.</div>');
    }
    echo json_encode($data);
  }else{
    $data = array('error' => 1,'msg' => '<div class="alert alert-danger"><strong>Error! </strong> Something goes wrong please try again</div>');
    echo json_encode($data);
  }
  /*}else{
    $data = array('error' => 1,'msg' => '<div class="alert alert-danger"><strong>Error! </strong> Please add post content.</div>');
    echo json_encode($data);  

  }*/
  
  die;
}

add_action("wp_ajax_nopriv_editpost", "editpost");
add_action("wp_ajax_editpost", "editpost");
function editpost(){
  $my_postid = $_REQUEST['post_id'];
  $content_post = get_post($my_postid);
  $content = $content_post->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  echo strip_tags($content); die;
} 



function sal_simpleAjaxCount_comment(){
  global $wpdb;
  $table_name = $wpdb->prefix . "commentlikecounter";
  global $current_user;
  $current_user = wp_get_current_user();
  $userID = $current_user->ID;  
  $ipAddress = get_client_ip_server();
  store_like_notification($_REQUEST['commentID']);
  $userAction = $_REQUEST['userAction'];
  $postID = $_REQUEST['commentID'];
  $loginOption = get_option('only_logged_in_users');
  $resultdata = array();

  if($loginOption == 'yes'){
    if(is_user_logged_in()){
      if($userAction == 'like'){
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND commentID = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->dislike_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '1',
                'dislike_count' => '0'
              ),
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'commentID' => $postID, 
            'user_id' => $userID,
            'dislike_count' => '0',
            'like_count' => '1',
            'user_ip_address' => '0'
          ));
        }
      }
      else{
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND commentID = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->like_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '0',
                'dislike_count' => '1'
              ),
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'commentID' => $postID, 
            'user_id' => $userID,
            'dislike_count' => '1',
            'like_count' => '0',
            'user_ip_address' => '0'
          ));
        }
      }
    }
    else{
      $resultdata['error_msg'] = 'Need to be logged in to Like/Dislike';
    }
  }
  else{
    if(is_user_logged_in()){
      if($userAction == 'like'){
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND commentID = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->dislike_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '1',
                'dislike_count' => '0'
              ),
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'commentID' => $postID, 
            'user_id' => $userID,
            'dislike_count' => '0',
            'like_count' => '1',
            'user_ip_address' => '0'
          ));
        }
      }
      else{
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND commentID = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->like_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '0',
                'dislike_count' => '1'
              ),
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'commentID' => $postID, 
            'user_id' => $userID,
            'dislike_count' => '1',
            'like_count' => '0',
            'user_ip_address' => '0'
          ));
        }
      }
    } //Logged in user functionality ends
  
    //Normal user functionality begins
    else{
      if($userAction == 'like'){
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_ip_address = %s AND commentID = %d AND ( dislike_count = '1' OR like_count = '1' )", array($ipAddress, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->dislike_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '1',
                'dislike_count' => '0'
              ),
              array(
                'commentID' => $postID,
                'user_ip_address' => $ipAddress
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'commentID' => $postID, 
            'user_id' => '0',
            'dislike_count' => '0',
            'like_count' => '1',
            'user_ip_address' => $ipAddress
          ));
        }
      }
      else{
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_ip_address = %s AND commentID = %d AND ( dislike_count = '1' OR like_count = '1' )", array($ipAddress, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->like_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '0',
                'dislike_count' => '1'
              ),
              array(
                'commentID' => $postID,
                'user_ip_address' => $ipAddress
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'commentID' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'commentID' => $postID, 
            'user_id' => '0',
            'dislike_count' => '1',
            'like_count' => '0',
            'user_ip_address' => $ipAddress
          ));
        }
      } 
    }
  }
  $resultdata['dislike_count'] = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE dislike_count='1' AND commentID='$postID'" );
  $resultdata['like_count'] = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE like_count='1' AND commentID='$postID'" );

  $resultdata['islike_user'] = get_likeCommentuserByPost(get_current_user_id(), $postID);

  echo json_encode($resultdata);
  wp_die();
}
add_action("wp_ajax_nopriv_sal_simpleAjaxCount_comment", "sal_simpleAjaxCount_comment");
add_action("wp_ajax_sal_simpleAjaxCount_comment", "sal_simpleAjaxCount_comment");



// Main function to process ajax like and dislike clicks
function sal_simpleAjaxCount(){
  global $wpdb;
  $table_name = $wpdb->prefix . "simplelikecounter";
  global $current_user;
  $current_user = wp_get_current_user();
  $userID = $current_user->ID;  


  $ipAddress = get_client_ip_server();
  store_like_notification($_REQUEST['postID']);
  $userAction = $_REQUEST['userAction'];
  $postID = $_REQUEST['postID'];
  
  $loginOption = get_option('only_logged_in_users');
  $resultdata = array();

  if($loginOption == 'yes'){
    if(is_user_logged_in()){
      if($userAction == 'like'){
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->dislike_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '1',
                'dislike_count' => '0'
              ),
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'post_id' => $postID, 
            'user_id' => $userID,
            'dislike_count' => '0',
            'like_count' => '1',
            'user_ip_address' => '0'
          ));
        }
      }
      else{
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->like_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '0',
                'dislike_count' => '1'
              ),
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'post_id' => $postID, 
            'user_id' => $userID,
            'dislike_count' => '1',
            'like_count' => '0',
            'user_ip_address' => '0'
          ));
        }
      }
    }
    else{
      $resultdata['error_msg'] = 'Need to be logged in to Like/Dislike';
    }
  }
  else{
    if(is_user_logged_in()){
      if($userAction == 'like'){
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->dislike_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '1',
                'dislike_count' => '0'
              ),
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'post_id' => $postID, 
            'user_id' => $userID,
            'dislike_count' => '0',
            'like_count' => '1',
            'user_ip_address' => '0'
          ));
        }
      }
      else{
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_id = %d AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($userID, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->like_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '0',
                'dislike_count' => '1'
              ),
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'post_id' => $postID, 
            'user_id' => $userID,
            'dislike_count' => '1',
            'like_count' => '0',
            'user_ip_address' => '0'
          ));
        }
      }
    } //Logged in user functionality ends
  
    //Normal user functionality begins
    else{
      if($userAction == 'like'){
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_ip_address = %s AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($ipAddress, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->dislike_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '1',
                'dislike_count' => '0'
              ),
              array(
                'post_id' => $postID,
                'user_ip_address' => $ipAddress
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'post_id' => $postID, 
            'user_id' => '0',
            'dislike_count' => '0',
            'like_count' => '1',
            'user_ip_address' => $ipAddress
          ));
        }
      }
      else{
        $result = $wpdb->get_row($wpdb->prepare( "SELECT like_count,dislike_count FROM $table_name WHERE user_ip_address = %s AND post_id = %d AND ( dislike_count = '1' OR like_count = '1' )", array($ipAddress, $postID ) ));
        $resultCount = $wpdb->num_rows;
        if($resultCount > 0){
          if($result->like_count == '1'){
            $wpdb->update(
              $table_name, 
              array( 
                'like_count' => '0',
                'dislike_count' => '1'
              ),
              array(
                'post_id' => $postID,
                'user_ip_address' => $ipAddress
              )  
            );
          }
          else{
            $wpdb->delete(
              $table_name, 
              array(
                'post_id' => $postID,
                'user_id' => $userID
              )  
            );
          }
        }
        else{
          $wpdb->insert($table_name, array(
            'post_id' => $postID, 
            'user_id' => '0',
            'dislike_count' => '1',
            'like_count' => '0',
            'user_ip_address' => $ipAddress
          ));
        }
      } 
    }
  }
  $resultdata['dislike_count'] = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE dislike_count='1' AND post_id='$postID'" );
  $resultdata['like_count'] = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE like_count='1' AND post_id='$postID'" );
  $resultdata['islike_user'] = get_likeuserByPost(get_current_user_id(), $postID);
  echo json_encode($resultdata);
  wp_die();
}
add_action("wp_ajax_nopriv_sal_simpleAjaxCount", "sal_simpleAjaxCount");
add_action("wp_ajax_sal_simpleAjaxCount", "sal_simpleAjaxCount");

add_action( 'wp_ajax_ajaxcomments', 'misha_submit_ajax_comment' ); // wp_ajax_{action} for registered user
add_action( 'wp_ajax_nopriv_ajaxcomments', 'misha_submit_ajax_comment' ); // wp_ajax_nopriv_{action} for not registered users
 
function misha_submit_ajax_comment(){


    $data=$_POST;
   // print_r($data);
  /*
   * Wow, this cool function appeared in WordPress 4.4.0, before that my code was muuuuch mooore longer
   *
   * @since 4.4.0
   */
  $comment = wp_handle_comment_submission( wp_unslash( $data ) );
  //sprint_r($comment);die;
  if ( is_wp_error( $comment ) ) {
    $error_data = intval( $comment->get_error_data() );
    if ( ! empty( $error_data ) ) {
      wp_die( '<p>' . $comment->get_error_message() . '</p>', __( 'Comment Submission Failure' ), array( 'response' => $error_data, 'back_link' => true ) );
    } else {
      wp_die( 'Unknown error' );
    }
  }
 
  /*
   * Set Cookies
   */
  $user = wp_get_current_user();
  do_action('set_comment_cookies', $comment, $user);
 
  /*
   * If you do not like this loop, pass the comment depth from JavaScript code
   */
  $comment_depth = 1;
  $comment_parent = $comment->comment_parent;
  while( $comment_parent ){
    $comment_depth++;
    $parent_comment = get_comment( $comment_parent );
    $comment_parent = $parent_comment->comment_parent;
  }
 
  /*
   * Set the globals, so our comment functions below will work correctly
   */
  $GLOBALS['comment'] = $comment;
  $GLOBALS['comment_depth'] = $comment_depth;
 
  /*
   * Here is the comment template, you can configure it for your website
   * or you can try to find a ready function in your theme files
   */
  /*
  $comment_html = '<li ' . comment_class('', null, null, false ) . ' id="comment-' . get_comment_ID() . '">
    <article class="comment-body" id="div-comment-' . get_comment_ID() . '">
      <footer class="comment-meta">
        <div class="comment-author vcard">
          ' . get_avatar( $comment, 100 ) . '
          ' . get_comment_author_link() . '
        </div>
        <div class="comment-metadata">
     <span class="cmt-time">' 
                    .timeAgo(get_comment_date().get_comment_time()).'</span>';
          if( $edit_link = get_edit_comment_link() )
            $comment_html .= '<span class="edit-link"><a class="comment-edit-link" href="' . $edit_link . '">Edit</a></span>';
 
        $comment_html .= '</div>';
        if ( $comment->comment_approved == '0' )
          $comment_html .= '<p class="comment-awaiting-moderation">Your comment is awaiting moderation.</p>';
 
      $comment_html .= '</footer>
      <div class="comment-content">' . apply_filters( 'comment_text', get_comment_text( $comment ), $comment ) . '</div>
    </article>
  </li>';

*/

    $authorid =  get_comment(get_comment_ID());
    $authorid = $authorid->user_id; 
    $user_info = get_userdata($authorid);
    $url     = home_url().'/'.$user_info->data->user_login;

    $comment_html = '<li ' . comment_class('', null, null, false ) . ' id="comment-' . get_comment_ID() . '">';

    $commenlikecnt = (get_likecount(get_comment_ID()) =='0')?'':get_likecount(get_comment_ID());
      
    //get_userdata
     $comment_html = '<div id="div-comment-179" class="cmnt-view">
    <style type="text/css">h3#reply-title{ display: none; }</style>
<div class="cmnt-thread">
                <div class="cmt-usr-img-lft">
                ' . get_avatar( $comment, 100 ) . '
                </div>
                <div class="cmt-usr-rgt">
                    <div class="cmt-usr-rply">
                        <div class="cmt-usr-nme"><span><cite class="fn">
                        <a href="'.$url.'">' . $user_info->data->user_login . '</a>
                        </cite></span></div>
                        <div class="cmt-rply-txt"><p>' . apply_filters( 'comment_text', get_comment_text( $comment ), $comment ) . '</p>
</div>
                    </div>
                    <div class="time-reply">
                         <span class="cmt-time">' 
                    .timeAgo(get_comment_date().get_comment_time()).'</span>
                        '.get_cancel_comment_reply_link('cancel').'
                        



                    </div>
                    <div class="like-btn">
                        <a class="ad-fav simpleAjaxLike_comment" data-option="like" data-check="1" data-id="'.get_comment_ID().'">
                          <i class="fa fa-heart-o"></i>'.$commenlikecnt.'
                      </a>
                    </div>
                </div>
            </div>
                

        <div class="comment-meta commentmetadata">
                    </div>

        

                </div></li>';

  echo $comment_html;



 
  die();
}

/*Code for remove post*/
add_action("wp_ajax_remove_post", "remove_post");
add_action("wp_ajax_nopriv_remove_post", "remove_post");

function remove_post(){
  $post_id = $_POST['postId'];
  global $post_type;   
    global $wpdb;

    $args = array(
        'post_type'         => 'attachment',
        'post_status'       => 'any',
        'posts_per_page'    => -1,
        'post_parent'       => $post_id
    );
    $attachments = new WP_Query($args);
    $attachment_ids = array();
    if($attachments->have_posts()) : while($attachments->have_posts()) : $attachments->the_post();
            $attachment_ids[] = get_the_id();
        endwhile;
    endif;
    wp_reset_postdata();

    if(!empty($attachment_ids)) :
        $delete_attachments_query = $wpdb->prepare('DELETE FROM %1$s WHERE %1$s.ID IN (%2$s)', $wpdb->posts, join(',', $attachment_ids));
        $wpdb->query($delete_attachments_query);
    endif;
    
    wp_delete_post($post_id);
     $meta_value = get_post_meta($post_id, $meta_key, true);
    if($meta_value){
          delete_post_meta($post_id, $meta_key, $meta_value);
          $record = array('error'=>1,'msg'=>"File deleted successfully.");
        echo json_encode($record); exit();
  }else{
      $record = array('error'=>0,'msg'=>"Something goes wrong.");
        echo json_encode($record); exit();
  }
  exit(0);
}
/*End Code*/

/*Code for add post*/
add_action("wp_ajax_add_post", "add_post");
add_action("wp_ajax_nopriv_add_post", "add_post");

function add_post(){
  
  
  // Add the content of the form to $post as an array
  $post = array(
    'post_title'  => 'Post Content',
    'post_content'  => $_POST['p_content'],
    'post_status' => 'publish',     // Choose: publish, preview, future, etc.
    'comment_count' => '1'
  );
  

   if (!function_exists('wp_handle_upload')) {
           require_once(ABSPATH . 'wp-admin/includes/file.php');
       }
      
      if ( $_FILES ) {
        $files = $_FILES['files'];
        $dir_path = __DIR__;
        $dir_path =  str_replace('/inc','', $dir_path);
         
        

      require_once( $dir_path. '/assets/fileuploader/src/class.fileuploader.php' );


    $p_id = wp_insert_post($post);
    $path = $dir_path.'/uploads/'.$p_id.'/media/'; 
    createPath($path);

    
      $FileUploader = new FileUploader('files', array(
            'limit' => 20,
          'maxSize' => null,
      'fileMaxSize' => null,
          'required' => false,
          'uploadDir' => $path,
          'title' => 'name',
      'replace' => false,
      'editor' => array(
        'quality' => 100
      ),
          'listInput' => true,
          'files' => null
      ));

      // file upload
      $data = $FileUploader->upload();
      //
      // if uploaded and success
    foreach ($data['files'] as $value) {
          $url = $value['file'];
          $url = str_replace("privaposts/","",$url);
        $last = explode("/", $url, 6);
        $urls[] = site_url().'/'.$last[5];
    }
     
    if($data['hasWarnings']) {
          $warnings = $data['warnings'];
          wp_delete_post($p_id);
          $record = array('error'=>1,'msg'=>"Post created successfully");
        echo json_encode($record); exit();
      }

    update_post_meta( $p_id, 'post_image', $urls );
    $record = array('error'=>0,'msg'=>"Post created successfully");
    echo json_encode($record); exit();
  
  }else{
    $id = wp_insert_post($post);
    $record = array('error'=>0,'msg'=>"Post created successfully");
    echo json_encode($record); exit();
  }
  exit();
}
/*Code for reset password*/
add_action("wp_ajax_user_update_password", "user_update_password");
add_action("wp_ajax_nopriv_user_update_password", "user_update_password");

function user_update_password(){
        
    $email = trim($_POST['user_value']);
  if( empty( $email ) ) {
    $error = 'Please enter username or e-mail address.';
  } else if( ! is_email( $email )) {
    $error = 'Invalid username or e-mail address.';
  } else if( ! email_exists( $email ) ) {
    $error = 'There is no user registered with that email address.';
  } else {
    
    $random_password = wp_generate_password( 12, false );
    $user = get_user_by( 'email', $email );
  
    // if  update user return true then lets send user an email containing the new password
    if( $user ) {

    $to = $email;
    $sender = get_option('name');
    $message = 'Your new password is: '.$random_password;
    $user = get_user_by('email', $email);
    $firstname = $user->first_name;
    $email = $user->user_email;
    $adt_rp_key = get_password_reset_key( $user );
    $user_login = $user->user_login;
    $time = round(time() / 300) * 300; // Allow for next 5 minute
    //$rp_link = site_url()."/forgetPassReset/?u=$adt_rp_key&time=$time&login=" . rawurlencode($user_login);
    $rp_link = network_site_url("wp-resetpassword.php?action=rp&key=$adt_rp_key&time=$time&login=" . rawurlencode($user_login), 'login') ;

    $data['reset_url'] = $rp_link;

    $mail = sendCustomEmail(7, $to, $data); // forgot password email.

      if( $mail ){
        $success = 'We have just sent you url, Please check your Inbox for password reset link.';
      }
      else{
           $error = 'System is unable to send you email with password reset link.';     
      }
    }else {
       $error = 'Oops something went wrong updating your account.';
    }
    
  }
  if( ! empty( $error ) )
    $data=array('status'=>0,'msg'=>$error);
  
  if( ! empty( $success ) )
    $data=array('status'=>1,'msg'=>$success);

    echo json_encode($data);
  die();
}
/*Code for send PPV Message*/
add_action("wp_ajax_ppv_message", "ppv_message");
add_action("wp_ajax_nopriv_ppv_message", "ppv_message");

function ppv_message(){
     $description = $_POST['description'];
     $ppv_amount = $_POST['ppv_amount'];
     $um_profile_id = $_POST['um_profile_id'];
     if(isset($description) && isset($ppv_amount) && isset($um_profile_id) ){
          global $wpdb;
          $current_user_id = get_current_user_id();
          $ppv_amount = number_format((float)$ppv_amount, 2, '.', '');
          // Add Notification to user
          $pu_data = get_userdata($um_profile_id);
          $msg='Hi '.$pu_data->display_name.',
                I would like to please request the following Pay Per View content for $'.$ppv_amount.': '.$description;
          insertMessage($current_user_id , $um_profile_id, $msg);
          // Add Notification to user
          $userdata = get_userdata( $current_user_id);
          $table_name = $wpdb->prefix . "um_notifications";
          $wpdb->insert(
                $table_name,
                array(
                    'time' => current_time( 'mysql' ),
                    'user' => $um_profile_id,
                    'status' => 'unread',
                    'photo' => um_get_avatar_url( get_avatar( $current_user_id, 40 ) ),
                    'type' => 'tip',
                    'url' => get_permalink(get_current_user_id()),
                    'content' => "<strong>".$userdata->display_name."</strong> You have a new Pay Per View message request!"
            )
        );
        //email PPV
        $userdata = get_userdata( $current_user_id);
        $pu_data = get_userdata( $um_profile_id);
        $toemail =  $pu_data->user_email;
        $data['amount'] =  $ppv_amount;
        $data['pu_name'] =  $pu_data->display_name;
        $data['su_name'] =  $userdata->display_name;
        sendCustomEmail(4, $toemail, $data);
      //end email
         $data=array('status'=>0,'msg'=>'PPV Message sent successfully!');
         echo json_encode($data); 
     }else{
        $data=array('status'=>1,'msg'=>'Oops something went wrong!');
        echo json_encode($data); 
     }
  die();
}

function bankaccount_status() {
    //init ajax
     global $wpdb;
     $table = $wpdb->prefix.'bank_details';
     $bank_id = $_POST['b_id'];
     $status = $_POST['status'];
     $wpdb->update($table, array('status'=>$status), array('bank_id'=>$bank_id));
     exit();
}

add_action('wp_ajax_nopriv_bankaccount_status', 'bankaccount_status');
add_action('wp_ajax_bankaccount_status', 'bankaccount_status');


function loadmodelsendtip() {
    //init ajax
     $um_profile_id = $_POST['um_profile_id'];
     if($um_profile_id){
      $current_user = get_user_by('id', $um_profile_id);
        $html = '<div class="center-text send-tip-wrap"> 
      <button type="button" class="close" data-dismiss="modal">x</button>
      <img src="'.get_template_directory_uri().'/assets/images/pop-icon.png" alt="pop-icon">
      <h6>Send a tip to</h6>
      <h4 class="modal-title">@'.$current_user->user_login.'</h4>
      <div class="card-imgusr">
         <div class="card-in">'.get_avatar($um_profile_id, 140 ).'</div>
         <span class="chek">
           <img src="'.get_template_directory_uri().'/assets/images/tick_small_edit.png" />
         </span>
      </div>  
      <form id="sendtipform" method="post">
      <div class="cent-in">
        <div class="form-group"> 
        <span class="input-icon"><i class="fa fa-usd" aria-hidden="true"></i></span>
       <input class="form-control" name="amount" id="tip_amount" maxlength="4" placeholder="Enter amount" type="tel">
       <input class="form-control" name="um_profile_id" id="tip_profile_id" value="'.$um_profile_id.'" type="hidden">
      </div>
      </div>
      <div class="btns clearfix">
       <button type="submit" class="btn btn-default sendtip blue-btn-hover" href="javascript:void(0)"><img src="'.get_template_directory_uri().'/assets/images/dolar-w-ico.png">&nbsp;&nbsp;SEND TIP</button>
        <div class="text-infom">
          <p>*Credit card processing fee of <span id="tipccfees">0.00</span> USD will be charged <!-- <i class="fa fa-question-circle" aria-hidden="true"></i> --></p>
       </div>
      </div>
      </form>
     </div>
      <script type="text/javascript">
  $(document).ready(function() { 
     $("#sendtipform").validate({
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
                type: "POST",
                dataType: "json",
                url: ajax_url,
                data: {
                    "action": "sendtipamount", //calls wp_ajax_nopriv_ajaxlogin
                    "amount": $("form#sendtipform #tip_amount").val(),
                    "um_profile_id": $("form#sendtipform #tip_profile_id").val(),
                },
                success: function(data) {
                    $(".loader").hide();
                    if (data.error == "0") {
                        $("#sendtipwithcard-popup").modal("hide");
                        $("#thanksyou-popup").modal({
                            backdrop: "static",
                            keyboard: true,
                            show: true
                        });
                    } else {
                        alert(data.msg);
                    }
                }
            });
            return false;
            //form.submit();
        }
    })
       $("#tip_amount").keyup(function(){   
              var tipfees = (2.9*$(this).val())/100;
              tipfees = tipfees + 0.30; 
              var tipfees = tipfees.toFixed(2);
              if(tipfees=="NaN"){
                $("#tipccfees").html("0.00");  
              }else{
                $("#tipccfees").html(tipfees);  
              }
       });
  })
</script>  
     ';
      $respose = array('html'=>$html,'error'=>0);
      echo json_encode($respose);
     }
     exit();
}

add_action('wp_ajax_nopriv_loadmodelsendtip', 'loadmodelsendtip');
add_action('wp_ajax_loadmodelsendtip', 'loadmodelsendtip');



function deleteDir($dirPath) {


  /* if (! is_dir($dirPath)) {
      echo $dirPath;die();

        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }*/
    rmdir($dirPath);
    /*if(is_dir($target)){

        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );      
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }*/
}



/*Load popup window*/
add_action('wp_ajax_nopriv_load_message_popup', 'mutiplemessagepopup');
add_action('wp_ajax_load_message_popup', 'mutiplemessagepopup');

function mutiplemessagepopup(){
  ?>

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
          <?php
            if(is_pu_user(get_current_user_id())){ ?>
                  <div class="act-dollar" id="dol_price">
                      <div class="add-dollar-image">
                        <img src="<?php echo site_url();?>/wp-content/themes/twentysixteen/assets/images/dollar-eye.png" alt="">
                      </div>
                      <span class="pay-per-view-txt">Pay Per View</span>
                  </div>

                  <div class="price_div">
                    <input class="msg_price" type="text" name="msg_price" id="msg_price" style="display: none;" value="">
                    <span class="msgtxt" style="display: none;">Attach media file</span>
                  </div>
          <?php } ?>
        </div>
    </form>
<?php die();
}